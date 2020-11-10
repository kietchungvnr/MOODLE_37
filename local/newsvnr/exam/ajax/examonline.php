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
// require_login();
$PAGE->set_context(context_system::instance());
$examid         = optional_param('examid', 0, PARAM_INT);
$examname       = optional_param('examname', '', PARAM_TEXT);
$subjectname    = optional_param('subjectname', '', PARAM_TEXT);
$date           = optional_param('date', 0, PARAM_INT);
$action         = optional_param('action', '', PARAM_TEXT);
$subjectid    = optional_param('subjectid', 0, PARAM_INT);
$output         = '';
$arrtemp        = [];
$examdata       = $DB->get_record('exam', ['id' => $examid]);
$data           = [];
$conditionquiz  = '';
$strexamname    = "N'" . '%' . $examname . '%' . "'";
$strsubjectname = "N'" . '%' . $subjectname . '%' . "'";
$sql            = 'SELECT DISTINCT es.id,es.name FROM {exam_subject} es
                JOIN {exam_subject_exam} ese ON ese.subjectid = es.id
                JOIN {exam} e ON ese.examid = e.id';
if ($date != 0) {
    $conditionquiz = "AND (q.timeopen <= $date AND q.timeclose >= $date)";
}
if ($examid == 0 && $subjectid == 0) {
    $subjectdata = $DB->get_records_sql($sql . " WHERE e.name like $strexamname AND es.name like $strsubjectname");
    if ($action == 'search') {
        $output .= '<div class="exam-title mt-3">' . get_string('resultsearch', 'local_newsvnr') . '</div>';
    } else {
        $output .= '<div class="exam-title mt-3">' . get_string('allsubjectexam', 'local_newsvnr') . '</div>';
    }
} else {
    if($subjectid == 0) {
        $subjectdata = $DB->get_records_sql($sql . " WHERE e.id = :examid", ['examid' => $examid]);
        $output .= '<div class="exam-title mt-3">' . $examdata->name . '</div>';
    } else {
        $subjectdata = $DB->get_records_sql($sql . " WHERE es.id = :subjectid", ['subjectid' => $subjectid]);
    }

}
foreach ($subjectdata as $subject) {
    if($subjectid) {
        $output .= '<div class="exam-title mt-3">' . $subject->name . '</div>';
    }
    $quizdata = $DB->get_records_sql("SELECT q.id as quizid,q.*,eq.* FROM {exam_quiz} eq
                            JOIN {exam_subject} es ON es.id = eq.subjectexamid
                            JOIN {course_modules} cm ON cm.id = eq.coursemoduleid
                            JOIN {quiz} q ON q.id = cm.instance
                        WHERE es.id = :subjectid $conditionquiz", ['subjectid' => $subject->id]);
    $arrtemp = array_merge($quizdata, $arrtemp);
    if ($date == 0) {
        $output .= '<div class="subject-title mt-1"><i class="fa fa-clock-o mr-2" aria-hidden="true"></i>' . $subject->name . ' (' . count($quizdata) . ' ' . get_string('quiz', 'local_newsvnr') . ')</div>';
    }
    $output .= '<div class="quiz-in-subject mt-2">';
    foreach ($quizdata as $quiz) {
        $countattempt = $DB->get_record_sql("SELECT COUNT(q.id) as count FROM {quiz} q
                                                JOIN {quiz_attempts} qa ON qa.quiz = q.id
                                                WHERE q.id = :quizid", ['quizid' => $quiz->quizid]);
        $countquestion = $DB->get_record_sql("SELECT COUNT(qs.id) as count FROM {quiz} q
                                                JOIN {quiz_slots} qs ON qs.quizid = q.id
                                                WHERE q.id = :quizid", ['quizid' => $quiz->quizid]);
        $img = '<img title="quiz" class="pr-2" src="' . $OUTPUT->image_url('icon', 'quiz') . '">';
        $url = $CFG->wwwroot . '/mod/quiz/view.php?id=' . $quiz->coursemoduleid;
        $output .= '<div class="pl-3 pt-2 pb-2 module-quiz-online">';
        $output .= '<div class="">' . $img . '' . $quiz->name . '<a class="float-right mr-2" href="' . $url . '">' . get_string('enterexam', 'local_newsvnr') . '</a></div>';
        $output .= '<div class="info-quiz d-flex ml-4">';
        $output .= '<div class="detail-quiz"><i class="fa fa-check-square-o mr-1" aria-hidden="true"></i>' . $countquestion->count . ' ' . get_string('question', 'local_newsvnr') . '</div>';
        $output .= '<div class="detail-quiz"><i class="fa fa-clock-o mr-1" aria-hidden="true"></i>' . convertTimeExam($quiz->timelimit) . '</div>';
        $output .= '<div class="detail-quiz">' . $countattempt->count . ' ' . get_string('attempt', 'local_newsvnr') . '</div>';
        $output .= '</div>';
        $output .= '</div>';
    }
    $output .= '</div>';
}
if (empty($arrtemp)) {
    $output .= '<div class="alert alert-danger" role="alert">' . get_string('noquiz', 'local_newsvnr') . '</div>';
}
$data['result'] = $output;
echo json_encode($data, JSON_UNESCAPED_UNICODE);

die();
