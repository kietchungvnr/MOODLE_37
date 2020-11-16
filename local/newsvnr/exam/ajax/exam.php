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

define('AJAX_SCRIPT', true);

require_once __DIR__ . '/../../../../config.php';
require_once __DIR__ . '/../../lib.php';
require_login();
$PAGE->set_context(context_system::instance());

$action = required_param('action', PARAM_ALPHANUMEXT);
$exam_params = optional_param_array('exam', '',PARAM_RAW);
$pagesize = optional_param('pagesize', 10, PARAM_INT);
$pagetake = optional_param('take',0, PARAM_INT);
$pageskip = optional_param('skip',0, PARAM_INT);
$q = optional_param('q','', PARAM_RAW);
$data = array();

switch ($action) {
    case 'subjectexam_add':
        $obj              = new stdclass;
        $obj->name        = $exam_params['sxname'];
        $obj->code        = $exam_params['sxcode'];
        $obj->shortname        = $exam_params['sxshortname'];
        $obj->usercreate        = $USER->id;
        $obj->usermodified        = $USER->id;
        $obj->timecreated        = time();
		$obj->timemodified        = time();
		if($exam_params['sxvisible'] == 'true') {
			$obj->visible = 1;
		} else {
			$obj->visible = 0;
		}
        $obj->description = $exam_params['sxdescription'];
        $DB->insert_record('exam_subject', $obj);
        $data['success'] = get_string('add_success', 'local_newsvnr');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    case 'subjectexam_edit':
    	$obj              = new stdclass;
        $obj->id        = (int)$exam_params['sxid'];
        $obj->name        = $exam_params['sxname'];
        $obj->code        = $exam_params['sxcode'];
        $obj->shortname        = $exam_params['sxshortname'];
        $obj->usercreate        = $USER->id;
        $obj->usermodified        = $USER->id;
        $obj->timecreated        = time();
		$obj->timemodified        = time();
		if($exam_params['sxvisible'] == 'true') {
			$obj->visible = 1;
		} else {
			$obj->visible = 0;
		}
        $obj->description = $exam_params['sxdescription'];
        $DB->update_record('exam_subject', $obj);
        $data['success'] = get_string('edit_success', 'local_newsvnr');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    	die;
    case 'subjectexam_delete':
    	$subjectexamid = optional_param('id', 0, PARAM_INT);
    	$DB->delete_records('exam_subject', ['id' => $subjectexamid]);
    	$data['success'] = get_string('delete_success', 'local_newsvnr');
    	echo json_encode($data, JSON_UNESCAPED_UNICODE);
    	die;
    case 'subjectexam_delete_all':
		$dataselect = json_decode($_POST['rowselected']);
    	foreach ($dataselect as $subjectexam) {
            $DB->delete_records('exam_subject', ['id' => $subjectexam->id]);
        }
        $data['success'] = get_string('delete_success', 'local_newsvnr');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    case 'subjectexam_validate':
    	if($DB->record_exists('exam_subject', ['name' => $exam_params['sxname']])) {
    		$data['errors'] = false;
    	} else {
    		$data['errors'] = true;
    	}
    	echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    case 'subjectexam_grid':
    	$ordersql = "";
		$wheresql = "";
		if($q) {
			$wheresql = "WHERE name LIKE N'%$q%'";
		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
    	$sql = "SELECT *, (SELECT COUNT(id) FROM mdl_exam_subject $wheresql) AS total
					FROM (SELECT *, ROW_NUMBER() OVER (ORDER BY id) AS RowNum
						  FROM mdl_exam_subject $wheresql
						 ) AS Mydata
					ORDER BY $ordersql";
    	$get_list = $DB->get_records_sql($sql);
		$data = [];
		foreach ($get_list as $value) {
			$obj = new stdclass;
			$obj->id = $value->id;		
			$obj->name = $value->name;		
			$obj->code = $value->code;
			$obj->shortname = $value->shortname;
			$obj->visible = $value->visible;
			$obj->description = $value->description;
			$obj->total = $value->total;
			$data[] = $obj;		
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die;
	case 'exam_grid':
		$ordersql = "";
		$wheresql = "";
		if($q) {
			$wheresql = "WHERE name LIKE N'%$q%'";
		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
    	$sql = "SELECT *, (SELECT COUNT(id) FROM mdl_exam $wheresql) AS total
					FROM (SELECT *, ROW_NUMBER() OVER (ORDER BY id) AS RowNum
						  FROM mdl_exam $wheresql
						 ) AS Mydata
					ORDER BY $ordersql";
    	$get_list = $DB->get_records_sql($sql);
		$data = [];
		foreach ($get_list as $value) {
			$obj = new stdclass;
			$obj->id = $value->id;		
			$obj->name = $value->name;		
			$obj->code = $value->code;
			if($value->type == 1) {
				$obj->type = get_string('free', 'local_newsvnr');
			} else {
				$obj->type = get_string('required', 'local_newsvnr');
			}
			// $obj->datestart =  new \DateTime($value->datestart, core_date::get_user_timezone_object(99));
			$obj->datestart =  convertunixtime('d/m/Y, H:i A',$value->datestart, 'Asia/Ho_Chi_Minh');
			$obj->dateend = convertunixtime('d/m/Y, H:i A',$value->dateend, 'Asia/Ho_Chi_Minh');
			$obj->usercreate = fullname($DB->get_record('user',['id' => $value->usercreate]));
			$obj->visible = $value->visible;
			$obj->description = $value->description;
			$obj->total = $value->total;
			$data[] = $obj;		
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die;
	case 'exam_add':
		$obj              = new stdclass;
        $obj->name        = $exam_params['examname'];
        $obj->code        = $exam_params['examcode'];
        $obj->type        = (int)$exam_params['examtype'];
        $obj->datestart        = (int)$exam_params['examdatestart'];
        $obj->dateend        = (int)$exam_params['examdateend'];
        $obj->visible        = (int)$exam_params['visible'];
        $obj->usercreate        = $USER->id;
        $obj->usermodified        = $USER->id;
        $obj->timecreated        = time();
		$obj->timemodified        = time();
        $obj->description = $exam_params['examdescription'];
        $exam = $DB->insert_record('exam', $obj);

        if(isset($exam_params['subjectexam'])) {
        	$subjectexam_arr = explode(",", $exam_params['subjectexam']);
        	$allSubjectExam = [];
        	foreach($subjectexam_arr as $subjectexam) {
        		if($DB->record_exists('exam_subject_exam', ['examid' => $exam, 'subjectid' => $subjectexam])) {
        			continue;
        		}
        		$objSubjectExam = new stdclass;
        		$objSubjectExam->examid = $exam;
        		$objSubjectExam->subjectid = $subjectexam;
        		$objSubjectExam->usercreate        = $USER->id;
		        $objSubjectExam->usermodified        = $USER->id;
		        $objSubjectExam->timecreated        = time();
				$objSubjectExam->timemodified        = time();
				$allSubjectExam[] = $objSubjectExam;
        	}
        	if($allSubjectExam) {
        		$DB->insert_records('exam_subject_exam', $allSubjectExam);
        	}
        }
        $data['success'] = get_string('add_success', 'local_newsvnr');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    case 'exam_edit':
    	$obj              = new stdclass;
    	$obj->id = (int)$exam_params['examid'];
        $obj->name        = $exam_params['examname'];
        $obj->code        = $exam_params['examcode'];
        $obj->type        = (int)$exam_params['examtype'];
        $obj->datestart        = (int)$exam_params['examdatestart'];
        $obj->dateend        = (int)$exam_params['examdateend'];
        if($exam_params['examvisible'] == 'true') {
			$obj->visible = 1;
		} else {
			$obj->visible = 0;
		}
        $obj->usercreate        = $USER->id;
        $obj->usermodified        = $USER->id;
        $obj->timecreated        = time();
		$obj->timemodified        = time();
        $obj->description = $exam_params['examdescription'];
        $exam = $DB->update_record('exam', $obj);
        if($exam_params['subjectexam']) {
        	$current_subjectexams = $DB->get_records('exam_subject_exam', ['examid' => $obj->id]);
        	$subjectexams = explode(",", $exam_params['subjectexam']);
        	foreach($subjectexams as $keysexam => $subjectexam) {
				$exsit_subjectexam = false;
        		foreach($current_subjectexams as $keycurrentsexam => $current_subjectexam) {
        			if($current_subjectexam->subjectid == $subjectexam) {
						$objCurSubjectexam = new stdClass;
						$objCurSubjectexam->id = $current_subjectexam->id;
						$objCurSubjectexam->usermodified = $USER->id;
						$objCurSubjectexam->timemodified = time();
						$DB->update_record('exam_subject_exam', $objCurSubjectexam);
						unset($current_subjectexams[$keycurrentsexam]);
						$exsit_subjectexam = true;
						break;
					} else {
						$DB->delete_records('exam_subject_exam', ['examid' => $obj->id, 'subjectid' => $current_subjectexam->subjectid]);
					}
				}
				if($exsit_subjectexam == false) {
					$objSubjectexam = new stdClass;
					$objSubjectexam->examid = $obj->id;
					$objSubjectexam->subjectid = $subjectexam;
					$objSubjectexam->usercreate        = $USER->id;
					$objSubjectexam->usermodified        = $USER->id;
					$objSubjectexam->timecreated        = time();
					$objSubjectexam->timemodified        = time();
					$DB->insert_record('exam_subject_exam', $objSubjectexam);
				}
			}
		}
		$data['success'] = get_string('edit_success', 'local_newsvnr');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'exam_delete':
		$examid = optional_param('id', 0, PARAM_INT);
		$DB->delete_records('exam_user', ['examid' => $examid]);
		$examsubjectexamid = $DB->get_field('exam_subject_exam', 'id', ['examid' => $exam->id]);
		$DB->delete_records('exam_quiz', ['subjectexamid' => $examsubjectexamid]);
		$DB->delete_records('exam_subject_exam', ['examid' => $examid]);
    	$DB->delete_records('exam', ['id' => $examid]);
    	$data['success'] = get_string('delete_success', 'local_newsvnr');
    	echo json_encode($data, JSON_UNESCAPED_UNICODE);
    	die;
    case 'exam_delete_all':
		$dataselect = json_decode($_POST['rowselected']);
    	foreach ($dataselect as $exam) {
            $DB->delete_records('exam_user', ['examid' => $exam->id]);
            $examsubjectexamid = $DB->get_field('exam_subject_exam', 'id', ['examid' => $exam->id]);
            $DB->delete_records('exam_quiz', ['subjectexamid' => $examsubjectexamid]);
            $DB->delete_records('exam_subject_exam', ['examid' => $exam->id]);
            $DB->delete_records('exam', ['id' => $exam->id]);
        }
        $data['success'] = get_string('delete_success', 'local_newsvnr');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
	case 'list_subjectexam';
		$ordersql = "";
		$wheresql = "";
		if($q) {
			$wheresql .= "WHERE name LIKE N'%$q%' AND visible = 1";
		} else {
			$wheresql .= "WHERE visible = 1";
 		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
    	$sql = "SELECT *, (SELECT COUNT(id) FROM mdl_exam_subject $wheresql) AS total
					FROM (SELECT *, ROW_NUMBER() OVER (ORDER BY id) AS RowNum
						  FROM mdl_exam_subject $wheresql
						 ) AS Mydata
					ORDER BY $ordersql";
    	$get_list = $DB->get_records_sql($sql);
    	foreach($get_list as $subjectexam) {
    		$obj = new stdclass;
    		$obj->id = $subjectexam->id;
    		$obj->name = $subjectexam->name;
    		$obj->code = $subjectexam->code;
    		$data[] = $obj;
    	}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'list_subjectexam_by_examid':
		$examid = optional_param('examid', 0, PARAM_INT);
		$get_list = $DB->get_records('exam_subject_exam', ['examid' => $examid], 'subjectid', 'subjectid');
		foreach($get_list as $subjectexam) {
			$data[] = $subjectexam->subjectid;
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'list_users':
		$examid = optional_param('examid', 0, PARAM_RAW);
		$ordersql = "";
		$wheresql = "";
		if($q) {
			$wheresql .= "WHERE CONCAT(firstname, ' ', lastname) LIKE N'%$q%' AND deleted = 0 AND id > 1";
		} else {
			$wheresql .= "WHERE deleted = 0 AND id > 1";
		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
    	$sql = "SELECT *, (SELECT COUNT(id) FROM mdl_user $wheresql) AS total
					FROM (SELECT *, ROW_NUMBER() OVER (ORDER BY id) AS RowNum
						  FROM mdl_user $wheresql
						 ) AS Mydata
					ORDER BY $ordersql";
    	$get_list = $DB->get_records_sql($sql);
    	foreach($get_list as $user) {
    		if($DB->record_exists('exam_user', ['userid' => $user->id, 'examid' => $examid])) {
				continue;
			}
    		$obj = new stdclass;
    		$obj->id = $user->id;
    		$obj->fullname = fullname($user);
    		$data[] = $obj;
    	}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'list_cohort':
		$ordersql = "";
		$wheresql = "";
		if($q) {
			$wheresql = "WHERE name LIKE N'%$q%'";
		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
    	$sql = "SELECT *, (SELECT COUNT(id) FROM mdl_cohort $wheresql) AS total
					FROM (SELECT *, ROW_NUMBER() OVER (ORDER BY id) AS RowNum
						  FROM mdl_cohort $wheresql
						 ) AS Mydata
					ORDER BY $ordersql";
    	$get_list = $DB->get_records_sql($sql);
    	foreach($get_list as $cohort) {
    		$obj = new stdclass;
    		$obj->id = $cohort->id;
    		$obj->fullname = $cohort->name;
    		$data[] = $obj;
    	}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'examusers_grid':
		$examid = optional_param('examid', 0, PARAM_INT);
		$ordersql = "";
		$wheresql = "";
		if($q) {
			$wheresql .= "WHERE CONCAT(u.firstname, ' ', u.lastname) LIKE N'%$q%' AND eu.examid = $examid";
		} else {
			$wheresql .= "WHERE eu.examid = $examid";
		}
		if($pagetake == 0) {
			$ordersql .= "RowNum";
		} else {
			$ordersql .= "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
    	$sql = "SELECT *, (SELECT COUNT(eu.examid) FROM mdl_exam_user eu 
    							LEFT JOIN mdl_user u ON eu.userid = u.id 
    							$wheresql) AS total
				FROM (SELECT ROW_NUMBER() OVER (ORDER BY eu.examid) AS RowNum, e.name, CONCAT(u.firstname, ' ', u.lastname) AS fullname, eu.*
						FROM mdl_exam_user eu 
							LEFT JOIN mdl_user u ON eu.userid = u.id
							LEFT JOIN mdl_exam e ON e.id = eu.examid
						$wheresql
					) AS Mydata
				ORDER BY $ordersql";
    	$get_list = $DB->get_records_sql($sql);
		$data = [];
		foreach ($get_list as $examuser) {
			$obj = new stdclass;
			$obj->id = $examuser->id;		
			$obj->examname = $examuser->name;		
			$obj->fullname = $examuser->fullname;
			$obj->userid = $examuser->userid;
			$obj->roleid = $examuser->roleid;
			if($examuser->roleid == 5) {
				$obj->rolename = get_string('studentrole', 'local_newsvnr');
			} else if($examuser->roleid == 4){
				$obj->rolename = get_string('teacherrole', 'local_newsvnr');
			}
			$obj->usercreate = fullname($DB->get_record('user', ['id' => $examuser->usercreate]));
			$obj->total = $examuser->total;
			$data[] = $obj;		
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die;
	case 'examusers_enroll':
		$examid = $exam_params['examid'];
		$roleid = $exam_params['examusersrole'];
		$alluser = [];
		if($exam_params['examusers'] && $exam_params['examcohort']) {
			$cvert_examusers = explode(",", $exam_params['examusers']);
			$cvert_examcohort  = explode(",", $exam_params['examcohort']);
			$allcohort_member = [];
			foreach ($cvert_examcohort as $cohort) {
				$cohort_members = $DB->get_records('cohort_members', ['cohortid' => $cohort]);
				foreach($cohort_members as $member) {
					
					if(array_search($member->id, $cvert_examusers)) {
						continue;
					} else {
						$allcohort_member[] = $member->userid;
					}
				}
			}
			$users = array_merge($cvert_examusers, $allcohort_member);
			foreach($users as $user) {
				if($DB->record_exists('exam_user', ['userid' => $user, 'examid' => $examid])) {
					continue;
				}
				$obj = new stdClass;
				$obj->examid = $examid;
				$obj->userid = $user;
				$obj->enrolmethod = 'manual';
				$obj->roleid = $roleid;
				$obj->usercreate        = $USER->id;
				$obj->usermodified        = $USER->id;
				$obj->timecreated        = time();
				$obj->timemodified        = time();
				$alluser[] = $obj;
			}
			$DB->insert_records('exam_user', $alluser);
		} else if($exam_params['examusers']) {
			$cvert_examusers = explode(",", $exam_params['examusers']);
			foreach($cvert_examusers as $examusers) {
				if($DB->record_exists('exam_user', ['userid' => $examusers, 'examid' => $examid])) {
					continue;
				}
				$obj = new stdClass;
				$obj->examid = $examid;
				$obj->userid = $examusers;
				$obj->enrolmethod = 'manual';
				$obj->roleid = $roleid;
				$obj->usercreate        = $USER->id;
				$obj->usermodified        = $USER->id;
				$obj->timecreated        = time();
				$obj->timemodified        = time();
				$alluser[] = $obj;
			}
			$DB->insert_records('exam_user', $alluser);
		} else if($exam_params['examcohort']) {
			$cvert_examcohort  = explode(",", $exam_params['examcohort']);
			foreach($cvert_examcohort as $cohort) {
				$cohort_members = $DB->get_records('cohort_members', ['cohortid' => $cohort]);
				foreach($cohort_members as $user) {
					if($DB->record_exists('exam_user', ['userid' => $user->userid, 'examid' => $examid])) {
						continue;
					} else {
						$obj = new stdClass;
						$obj->examid = $examid;
						$obj->userid = $user->userid;
						$obj->enrolmethod = 'manual';
						$obj->roleid = $roleid;
						$obj->usercreate        = $USER->id;
						$obj->usermodified        = $USER->id;
						$obj->timecreated        = time();
						$obj->timemodified        = time();
						$alluser[] = $obj;
					}
					
				}
				if($alluser)
					$DB->insert_records('exam_user', $alluser);
			}
		}
		$data['success'] = get_string('enrolluser_success', 'local_newsvnr');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'examusers_enroll_edit':
		$obj = new stdClass;
		$obj->id = $exam_params['enrolluserid'];
		$obj->examid = $exam_params['examid'];
		$obj->userid = $exam_params['examuserid'];
		$obj->roleid = $exam_params['examusersrole'];
		$obj->usermodified = $USER->id;
		$obj->timemodified = time();
		$DB->update_record('exam_user', $obj);
		$data['success'] = get_string('edit_success', 'local_newsvnr');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'examusers_enroll_delete':
		$id = optional_param('id', 0, PARAM_INT);
		$DB->delete_records('exam_user', ['id' => $id]);
		$data['success'] = get_string('unenrollexamuser_success', 'local_newsvnr');
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die();
	case 'enrolexamusers_delete_all':
		$dataselect = json_decode($_POST['rowselected']);
    	foreach ($dataselect as $examuser) {
            $DB->delete_records('exam_user', ['id' => $examuser->id]);
        }
        $data['success'] = get_string('delete_success', 'local_newsvnr');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    default:
        # code...
        break;
}
