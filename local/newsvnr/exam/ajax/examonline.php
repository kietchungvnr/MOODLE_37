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
$examid            = optional_param('examid', 0, PARAM_INT);
$examname          = optional_param('examname', '', PARAM_TEXT);
$subjectname       = optional_param('subjectname', '', PARAM_TEXT);
$date              = optional_param('date', 0, PARAM_INT);
$action            = optional_param('action', '', PARAM_TEXT);
$examsubjectexamid = optional_param('examsubjectexamid', 0, PARAM_INT);
$examtype          = optional_param('examtype', 0, PARAM_INT);
$output            = '';
$category_exam     = '';
$arrtemp           = [];
$examdata          = $DB->get_record('exam', ['id' => $examid]);
$data              = [];
$conditionquiz     = '';
$strexamname       = "N'" . '%' . $examname . '%' . "'";
$strsubjectname    = "N'" . '%' . $subjectname . '%' . "'";

$sql               = 'SELECT DISTINCT esx.id, es.id AS subjectid ,es.name, esx.subjectid, e.name AS examname
                      FROM mdl_exam_subject_exam esx
                        LEFT JOIN mdl_exam e ON esx.examid = e.id
                        LEFT JOIN mdl_exam_subject es ON esx.subjectid = es.id';

if($examtype == 0) {
    $sql = $sql . " LEFT JOIN mdl_exam_user eu ON eu.examid = e.id";
}
// điều kiện khi lọc loại kỳ thi
if ($action == "exam_category") {
    if($examtype == 0) {
        if(is_siteadmin()) {
            $wheresql = "WHERE e.type = :examtype AND e.visible = 1";
        } else {
            $wheresql = "WHERE eu.userid = :userid AND e.type = :examtype AND e.visible = 1";
        }
        $list_exam = $DB->get_records_sql("SELECT DISTINCT e.id, e.name 
                                            FROM mdl_exam e 
                                                LEFT JOIN mdl_exam_subject_exam esx ON e.id = esx.examid
                                                LEFT JOIN mdl_exam_user eu ON eu.examid = e.id
                                            $wheresql", ['userid' => $USER->id, 'examtype' => $examtype]);
    } else {
        $list_exam = $DB->get_records('exam', ['type' => $examtype, 'visible' => 1]);
    }
    foreach ($list_exam as $exam) {
        $category_exam .= '<li class="list-category click-expand exam" id="' . $exam->id . '"><a>' . $exam->name . '</a><i data="33" class="fa fa-angle-right rotate-icon float-right"></i></li>';
        $category_exam .= '<ul class="dropdown-menu-tree content-expand ' . $exam->id . '">';
        $list_subject = $DB->get_records_sql("SELECT DISTINCT es.id,es.name,ese.id as examsubjectexam
                                                FROM mdl_exam_subject es
                                                    JOIN mdl_exam_subject_exam ese ON ese.subjectid = es.id
                                                    JOIN mdl_exam e ON ese.examid = e.id
                                                WHERE e.id = :examid AND e.visible = 1 AND es.visible = 1", ['examid' => $exam->id]);
        if($DB->record_exists('exam_user', ['examid' => $exam->id, 'userid' => $USER->id, 'roleid' => 4]))
            $cancreateexam = 'true';
        else
            $cancreateexam = 'false';
        foreach ($list_subject as $subject) {
            $category_exam .= '<li class="list-subcategory subject-exam" data-cancreate="'.$cancreateexam.'" data-examsujbectexam="' . $subject->examsubjectexam . '" id="' . $subject->id . '"><a>' . $subject->name . '</a></li>';
        }
        $category_exam .= '</ul>';
    }
}
// Tìm kiếm theo ngày thi
if ($date != 0) {
    $conditionquiz = "AND (q.timeopen <= $date AND q.timeclose >= $date)";
}
// Tìm kiếm theo kỳ thi và môn thi
if($examtype == 0) {
    if(!is_siteadmin()) {
        $wheresql = "AND eu.userid = $USER->id";
    } else {
        $wheresql = "";
    }
} else {
    $wheresql = "";
}
if ($examid == 0 && $examsubjectexamid == 0) {
    // Trường hợp mặc định khi lần đầu vào trang
    $subjectdata = $DB->get_records_sql($sql . " WHERE e.name like $strexamname AND es.visible = 1 AND e.visible = 1 AND es.name like $strsubjectname AND e.type = $examtype $wheresql");
    if ($action == 'search') {
        $output .= '<div class="exam-title mt-1">' . get_string('resultsearch', 'local_newsvnr') . '</div>';
    } else {
        $output .= '<div class="exam-title mt-1">' . get_string('allsubjectexam', 'local_newsvnr') . '</div>';
    }
} else {
    
    if ($examsubjectexamid == 0) {
        // Load theo kì thi
        $subjectdata = $DB->get_records_sql($sql . " WHERE e.id = :examid AND e.type = :examtype AND es.visible = 1 AND e.visible = 1 $wheresql", ['examid' => $examid, 'examtype' => $examtype]);
        $output .= '<div class="exam-title mt-1">' . $examdata->name . '</div>';
    } elseif($examsubjectexamid != 0) {
        // Load theo môn thi
        $subjectdata = $DB->get_records_sql($sql . " WHERE esx.id = :examsubjectexamid AND e.type = :examtype AND es.visible = 1 AND e.visible = 1 $wheresql", ['examsubjectexamid' => $examsubjectexamid, 'examtype' => $examtype]);
    }
    // if ($examid == 0) {
    //     $subjectdata = $DB->get_records_sql($sql . " WHERE esx.id = :examsubjectexamid AND e.type = :examtype", ['examsubjectexamid' => $examsubjectexamid, 'examtype' => $examtype]);
    // } 
    else {
        // Load theo kì thi và môn thi
        $subjectdata = $DB->get_records_sql($sql . " WHERE esx.id = :examsubjectexamid AND e.type = :examtype AND e.id = :examid", ['examsubjectexamid' => $examsubjectexamid, 'examtype' => $examtype, 'examid' => $examid]);
    }
}
foreach ($subjectdata as $subject) {
    if ($examsubjectexamid) {
        $output .= '<div class="exam-title mt-1">' . $subject->name . '</div>';
    }
    $quizdata = $DB->get_records_sql("SELECT q.id as quizid,q.*,eq.*
                                        FROM {exam_quiz} eq
                                            JOIN {exam_subject_exam} esx ON esx.id = eq.subjectexamid
                                            JOIN {course_modules} cm ON cm.id = eq.coursemoduleid
                                            JOIN {quiz} q ON q.id = cm.instance
                                        WHERE eq.subjectexamid = :subjectid $conditionquiz", ['subjectid' => $subject->id]);
    $arrtemp = array_merge($quizdata, $arrtemp);
    if ($date == 0) {
        $output .= '<div class="subject-title mt-1"><i class="fa fa-clock-o mr-2" aria-hidden="true"></i>' . $subject->examname . ' - ' . $subject->name . ' (' . count($quizdata) . ' ' . get_string('quiz', 'local_newsvnr') . ')</div>';
    }
    $output .= '<div class="quiz-in-subject mt-2">';
    foreach ($quizdata as $quiz) {
        $countattempt = $DB->get_record_sql("SELECT COUNT(q.id) as count FROM {quiz} q
                                                JOIN {quiz_attempts} qa ON qa.quiz = q.id
                                                WHERE q.id = :quizid", ['quizid' => $quiz->quizid]);
        $countquestion = $DB->get_record_sql("SELECT COUNT(qs.id) as count FROM {quiz} q
                                                JOIN {quiz_slots} qs ON qs.quizid = q.id
                                                WHERE q.id = :quizid", ['quizid' => $quiz->quizid]);
        $img = '<img title="quiz" class="pr-2 img-module" src="' . $OUTPUT->image_url('icon', 'quiz') . '">';
        $url = $CFG->wwwroot . '/mod/quiz/view.php?id=' . $quiz->coursemoduleid;
        $output .= '<div class="pl-3 pt-2 pb-2 module-quiz-online">';
        $output .= '<div class=""><a class="text-default" target="_blank" href="'.$url.'">' . $img . '' . $quiz->name . '</a><a class="float-right mr-2" href="' . $url . '" target="_blank">' . get_string('enterexam', 'local_newsvnr') . '</a></div>';
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
$data['category_exam'] = $category_exam;
$data['result']        = $output;

echo json_encode($data, JSON_UNESCAPED_UNICODE);

die();
