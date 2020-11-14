<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package local_newsvnr
 * @copyright 2019 VnResource
 * @author   Le Thanh Vu
 **/

define('AJAX_SCRIPT', false);
require_once __DIR__ . '/../../../../config.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_login();
$PAGE->set_context(context_system::instance());
$examid    = optional_param('examid', '', PARAM_INT);
$subjectid = optional_param('subjectid', 0, PARAM_INT);
$examtype  = required_param('examtype', PARAM_TEXT);
$context   = context_system::instance();
$output    = '';
$data      = [];
$arrtemp   = [];
$sql       = "SELECT esx.id, es.id AS subjectid ,es.name, esx.subjectid, e.name AS examname
                        FROM mdl_exam_subject_exam esx
                        LEFT JOIN mdl_exam e ON esx.examid = e.id
                        LEFT JOIN mdl_exam_subject es ON esx.subjectid = es.id";

if ($examtype == 'required') {
    //diều kiện khóa học bắt buộc
    $sql .= " WHERE e.type = 0";
}
if ($examtype == 'free') {
    //diều kiện khóa học tự do
    $sql .= " WHERE e.type = 1";
}
if ($examid) {
    //Lọc theo kì thi
    $sql .= " AND e.id = $examid";
}
if ($subjectid) {
    //Lọc theo môn thi
    $sql .= " AND es.id = $subjectid";
}
$datasubject = $DB->get_records_sql($sql);
$output .= '<div class="border">';
$output .= '<table class="table">';
$output .= '<thead>';
$output .= '<tr>';
$output .= '<th scope="col" class="exam-first-col">' . get_string('exam', 'local_newsvnr') . '</th>';
$output .= '<th scope="col">' . get_string('quiztime', 'local_newsvnr') . '</th>';
$output .= '<th scope="col">' . get_string('grade', 'local_newsvnr') . '</th>';
$output .= '<th scope="col"></th>';
$output .= '<tr>';
$output .= '<thead>';
$output .= '<tbody id="table-library">';
foreach ($datasubject as $subject) {
    $img      = '<img title="quiz" class="pr-2" src="' . $OUTPUT->image_url('icon', 'quiz') . '">';
    $quizdata = $DB->get_records_sql("SELECT cm.id,q.name,qg.grade as usergrade,q.attempts,cm.id as coursemoduleid,q.grade,q.id as quizid
                                        FROM {exam_quiz} eq
                                            JOIN {exam_subject_exam} esx ON esx.id = eq.subjectexamid
                                            JOIN {course_modules} cm ON cm.id = eq.coursemoduleid
                                            JOIN {quiz} q ON q.id = cm.instance
                                            LEFT JOIN {quiz_grades} qg ON qg.quiz = q.id
                                        WHERE eq.subjectexamid = :subjectid", ['subjectid' => $subject->id]);
    foreach ($quizdata as $quiz) {
        $attempt = $DB->get_record_sql("SELECT TOP 1 qa.* FROM {quiz_attempts} qa
                                                JOIN {user} us ON us.id = qa.userid
                                                WHERE qa.quiz = :quizid AND us.id = :userid", ['quizid' => $quiz->quizid, 'userid' => $USER->id]);
        if (!empty($attempt)) {
            $timelimit = $attempt->timefinish - $attempt->timestart;
            $output .= '<tr>';
            $output .= '<td>' . $img . '' . $quiz->name . '</td>';
            $output .= '<td>' . convertTimeExam($timelimit) . '</td>';
            $output .= '<td>' . number_format($quiz->usergrade) . ' / ' . number_format($quiz->grade) . '</td>';
            $output .= '<td>';
            if (has_capability('mod/quiz:preview', $context)) {
                $output .= '<a title="' . get_string('reviewquiz', 'local_newsvnr') . '" target="_blank" href="' . $CFG->wwwroot . '/mod/quiz/review.php?attempt=' . $attempt->id . '&cmid=' . $quiz->coursemoduleid . '"><i class="fa fa-eye" aria-hidden="true"></i></a>';
            }
            $output .= '<a title="' . get_string('attemptquiz', 'local_newsvnr') . '" target="_blank" href="' . $CFG->wwwroot . '/mod/quiz/view.php?id=' . $quiz->coursemoduleid . '"><i class="fa fa-refresh ml-2" aria-hidden="true"></i></a>';
            $output .= '</td>';
            $output .= '</tr>';
        }
    }
    $arrtemp = array_merge($quizdata, $arrtemp);
}
$output .= '</tbody>';
$output .= '</table>';
$output .= '</div>';
if (empty($arrtemp)) {
    $output = '<div class="alert alert-danger" role="alert">' . get_string('noquiz', 'local_newsvnr') . '</div>';
}
$data['result'] = $output;
echo json_encode($data, JSON_UNESCAPED_UNICODE);
die();
