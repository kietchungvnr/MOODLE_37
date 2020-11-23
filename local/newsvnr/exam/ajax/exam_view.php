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
require_once __DIR__ . '/../../lib.php';
require_login();
$context_system = context_system::instance();
$PAGE->set_context($context_system);

$action = required_param('action', PARAM_ALPHANUMEXT);
$pagesize = optional_param('pagesize',10, PARAM_INT);
$pagetake = optional_param('take',0, PARAM_INT);
$pageskip = optional_param('skip',0, PARAM_INT);
$q = optional_param('q','', PARAM_RAW);
$data = [];
switch ($action) {
	case 'exam_category':
		$type = optional_param('examtype', 0, PARAM_INT);
		$exams = $DB->get_records('exam', ['type' => $type, 'visible' => 1]);
		$output = '';
		if($exams) {
			foreach ($exams as $exam) {
				$output .= '<li class="list-category" data-exam='.$exam->id.'>
								<a href="javascript:;" class="ajax-load">'.$exam->name.'</a>
							</li>';
			}
			$data['category'] = $output;
		} else {
			$data['nocategory'] = get_string('noexam', 'local_newsvnr');
		}
		
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
		break;
	case 'exam_description':
		$examid = optional_param('examid', 0, PARAM_INT);
		$exams = $DB->get_records('exam', ['id' => $examid]);
		$fullname = '';
		$getstudent = 0;
		foreach ($exams as $exam) {
			$obj_examdescription = new stdClass;
			$obj_examdescription->name = $exam->name;
			$obj_examdescription->code = $exam->code;
			if($exam->type == 0) {
				$obj_examdescription->type = get_string('required', 'local_newsvnr');
			} else {
				$obj_examdescription->type = get_string('free', 'local_newsvnr');
			}
			$obj_examdescription->datestart = convertunixtime('d/m/Y, H:i A',$exam->datestart);
			$obj_examdescription->dateend = convertunixtime('d/m/Y, H:i A',$exam->dateend);
			$obj_examdescription->description = $exam->description;
			$getteacher = $DB->get_records_sql("SELECT eu.userid, CONCAT(u.firstname, ' ', u.lastname) AS fullname 
												FROM {exam_user} eu
													LEFT JOIN {user} u ON eu.userid = u.id
													WHERE eu.examid = :examid AND eu.roleid = :roleid", ['examid' => $examid, 'roleid' => 4]);
			$getstudent = $DB->count_records('exam_user', ['examid' => $examid,'roleid' => 5]);
			if($getteacher) {
				foreach($getteacher as $keyteacher => $teacher) {
					$fullname .= $teacher->fullname;
					if(end($getteacher)->userid != $teacher->userid) {
						$fullname .= ', ';
					} 
				}
			} else {
				$fullname = get_string('noteacher', 'local_newsvnr');
			}
			$obj_examdescription->numberstudent = $getstudent;
			$obj_examdescription->teacher = $fullname;

			$data['examdescription'] = $obj_examdescription;
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'exam_listsubjectexam_grid':
		$examid = optional_param('examid', 0, PARAM_INT);
		$wheresql = "";
		$ordersql = "";
		if($q) {
			$wheresql .= "WHERE es.name LIKE N'%$q%' AND es.visible = 1 AND esx.examid = $examid";
		} else {
			$wheresql .= "WHERE esx.examid = $examid AND es.visible = 1";
		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
		$sql = "SELECT *, ( SELECT COUNT(esx.examid)
							FROM mdl_exam_subject_exam esx 
								LEFT JOIN mdl_exam_subject es ON es.id = esx.subjectid 
							$wheresql
							) AS total
				FROM (SELECT ROW_NUMBER() OVER (ORDER BY esx.examid) AS RowNum, esx.examid, es.name, esx.subjectid, COUNT(eq.coursemoduleid) AS numberquiz
						FROM mdl_exam_subject_exam esx 
							LEFT JOIN mdl_exam_subject es ON es.id = esx.subjectid
							LEFT JOIN mdl_exam_quiz eq ON eq.subjectexamid = esx.id
						$wheresql
						GROUP BY esx.examid, es.name, esx.subjectid
					) AS Mydata
				ORDER BY $ordersql";
		$get_list = $DB->get_records_sql($sql);
    	foreach($get_list as $quiz) {
    		$obj = new stdclass;
    		$obj->name = $quiz->name;
    		$obj->numberquiz = $quiz->numberquiz;
    		$obj->total = $quiz->total;
    		$data[] = $obj;
    	}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'exam_listsubjectexam':
		$examid = optional_param('examid', 0, PARAM_INT);
		$wheresql = "";
		$ordersql = "";
		if($q) {
			$wheresql .= "WHERE es.name LIKE N'%$q%' AND esx.examid = $examid AND es.name IS NOT NULL";
		} else {
			$wheresql .= "WHERE esx.examid = $examid AND es.name IS NOT NULL";
		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
		$sql = "SELECT es.id, es.name 
				FROM mdl_exam_subject_exam esx 
					LEFT JOIN mdl_exam_subject es ON esx.subjectid = es.id 
				$wheresql";
		$get_list = $DB->get_records_sql($sql);
		$firstobj = new stdClass;
		$firstobj->id = -1;
		$firstobj->name = 'Chọn môn thi';
		$data[] = $firstobj;
		foreach($get_list as $subjectexam) {
    		$obj = new stdclass;
    		$obj->id = $subjectexam->id;
    		$obj->name = $subjectexam->name;
    		$data[] = $obj;
    	}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'exam_listusersexam_grid':
		$examid = optional_param('examid', 0, PARAM_INT);
		$wheresql = "";
		$ordersql = "";
		if($q) {
			$wheresql .= "WHERE CONCAT(u.firstname, ' ', u.lastname) LIKE N'%$q%' AND eu.examid = $examid";
		} else {
			$wheresql .= "WHERE eu.examid = $examid";
		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
		$sql = "SELECT *, 
				(SELECT COUNT(eu.id) 
					FROM mdl_exam_user eu 
						LEFT JOIN mdl_user u ON eu.userid = u.id
					$wheresql
				) AS total
				FROM (SELECT ROW_NUMBER() OVER (ORDER BY eu.id) AS RowNum, e.name, CONCAT(u.firstname, ' ', u.lastname) AS fullname, eu.*, u.email
						FROM mdl_exam_user eu 
							LEFT JOIN mdl_exam e ON eu.examid = e.id 
							LEFT JOIN mdl_user u ON eu.userid = u.id 
							LEFT JOIN mdl_role r ON eu.roleid = r.id
						$wheresql
					) AS Mydata
				ORDER BY $ordersql";
		$get_list = $DB->get_records_sql($sql);
    	foreach($get_list as $user) {
    		$obj = new stdclass;
    		// $obj->id = $user->id;
    		$obj->fullname = $user->fullname;
    		$obj->email = $user->email;
    		$obj->enrolltime = convertunixtime('d/m/Y, H:i A',$user->timecreated);
    		$obj->total = $user->total;
    		$data[] = $obj;
    	}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'exam_userresult_grid':
		$examid = optional_param('examid', 0, PARAM_INT);
		$subjectid = optional_param('subjectid', 0, PARAM_INT);
		$wheresql = "";
		$ordersql = "";
		if($q) {
			$wheresql .= "WHERE esx.examid = $examid AND esx.subjectid = $subjectid AND CONCAT(u.firstname, ' ', u.lastname) LIKE N'%$q%' AND eq.coursemoduleid IS NOT NULL";
		} else {
			$wheresql .= "WHERE esx.examid = $examid AND esx.subjectid = $subjectid";
		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
		$sql = "SELECT *, (SELECT COUNT(eu.userid) 
							FROM mdl_exam_subject_exam esx 
								LEFT JOIN mdl_exam_subject es ON esx.subjectid = es.id
								LEFT JOIN mdl_exam_user eu ON esx.examid = eu.examid
								LEFT JOIN mdl_user u ON u.id = eu.userid
								LEFT JOIN mdl_exam_quiz eq ON eq.subjectexamid = esx.id 
							$wheresql) AS total 
				FROM (
					SELECT ROW_NUMBER() OVER (ORDER BY esx.examid) AS RowNum, u.id AS userid, es.id AS subjectid, es.name, u.username, eq.coursemoduleid
					FROM mdl_exam_subject_exam esx 
						LEFT JOIN mdl_exam_subject es ON esx.subjectid = es.id
						LEFT JOIN mdl_exam_user eu ON esx.examid = eu.examid
						LEFT JOIN mdl_user u ON u.id = eu.userid
						LEFT JOIN mdl_exam_quiz eq ON eq.subjectexamid = esx.id 
					$wheresql
					) AS Mydata
				ORDER BY $ordersql";
		$get_list = $DB->get_records_sql($sql);
		$results = [];
		$coursemodulearr = [];
		$columns = [];
		$userarr = [];
		$firsttime = true;
		$listcoursemodule = $DB->get_records_sql('SELECT eq.coursemoduleid 
													FROM mdl_exam_subject_exam esx 
														RIGHT JOIN mdl_exam_quiz eq ON esx.id = eq.subjectexamid
													WHERE esx.examid = :examid AND esx.subjectid = :subjectid', ['examid' => $examid, 'subjectid' => $subjectid]);
		if($listcoursemodule) {
			$objuser = new stdClass;
			$objuser->field = "fullname";
			$objuser->template = "function(e) { return e.fullname; }";
			$objuser->title = get_string('studentrole', 'local_newsvnr');
			$objuser->width = "200px";
			$columns[] = $objuser;
			foreach($listcoursemodule as $coursemodule) {
				if(!in_array($coursemodule, $coursemodulearr)) {
					$coursemodulearr[] = $coursemodule->coursemoduleid;
				}
				$quizid = $DB->get_field('course_modules', 'instance',['id' => $coursemodule->coursemoduleid]);
				$quiz = $DB->get_record('quiz', ['id' => $quizid]);
				$objquiz = new stdClass;
				$objquiz->field = "quiz" . $quiz->id;
				$objquiz->title = $quiz->name;
				$objquiz->width = "200px";
				$columns[] = $objquiz;
			}
		} else {
			$data['success'] = 'Không có môn thi trong kỳ thi';
			echo json_encode($data, JSON_UNESCAPED_UNICODE);
			die;
		}
		
		foreach(array_values($get_list) as $keyvalue => $value) {
			if(in_array($value->coursemoduleid, $coursemodulearr)) {
			
				if($firsttime == true) {
					$obj = new stdClass;
					$user = $DB->get_record('user', ['id' => $value->userid]);
					$obj->fullname = $OUTPUT->user_picture($user, array('size'=>35)) . fullname($user);
					$obj->userid = $value->userid;
					$quizid = $DB->get_field('course_modules', 'instance',['id' => $value->coursemoduleid]);
					$quiz = $DB->get_record('quiz', ['id' => $quizid]); 
					$quizcolumn = "quiz" . $quiz->id;
					$obj->$quizcolumn = 0;
					$obj->total = $value->total;
					$results[$value->userid] = $obj;
					$firsttime = false;
					$userarr[] = $value->userid;
					continue;
				}
				if(isset($results)) {
					if(in_array($value->userid, $userarr)) {
						$quizid = $DB->get_field('course_modules', 'instance',['id' => $value->coursemoduleid]);
						$quiz = $DB->get_record('quiz', ['id' => $quizid]); 
						$quizcolumn = "quiz" . $quiz->id;
						$results[$value->userid]->$quizcolumn = 0;
					} else {
						$obj = new stdClass;
						$user = $DB->get_record('user', ['id' => $value->userid]);
						$obj->fullname = $OUTPUT->user_picture($user, array('size'=>35)) . fullname($user);
						$obj->userid = $value->userid;
						$quizid = $DB->get_field('course_modules', 'instance',['id' => $value->coursemoduleid]);
						$quiz = $DB->get_record('quiz', ['id' => $quizid]); 
						$quizcolumn = "quiz" . $quiz->id;
						$obj->$quizcolumn = 0;
						$obj->total = $value->total;
						$results[$value->userid] = $obj;
						$userarr[] = $value->userid;
					}
				}
			}
		}
		$data['data_grid'] = array_values($results);
		$data['data_columns'] = $columns;
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	default:
		# code...
		break;
}