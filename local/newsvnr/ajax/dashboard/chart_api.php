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
 * lấy dữ liệu cho chart trong dashboard student 
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package local_newsvnr
 * @copyright 2020 VnResource
 * @author   Le Thanh Vu
 **/

define('AJAX_SCRIPT', false);

use core_competency\api as competency_api;

require_once __DIR__ . '/../../../../config.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_once $CFG->dirroot . '/blocks/analytics_graphs/lib.php';
require_once $CFG->dirroot . '/course/lib.php';
require_once $CFG->libdir . '/gradelib.php';

require_login();
$PAGE->set_context(context_system::instance());
$pagesize = optional_param('pagesize', 10, PARAM_INT);
$pagetake = optional_param('take', 0, PARAM_INT);
$pageskip = optional_param('skip', 0, PARAM_INT);
$q        = optional_param('q', '', PARAM_RAW);
$action = optional_param('action', null, PARAM_RAW);


switch ($action) {
	case 'quiz_chart':
		$response     = new stdClass;
		$sql = "SELECT ROW_NUMBER() OVER (ORDER BY q.id) AS RowNum, q.id quizid, q.course, c.fullname coursename, q.name quizname, CONVERT(DECIMAL(10,2),qg.grade) grade
				FROM mdl_quiz q 
					LEFT JOIN mdl_quiz_grades qg ON q.id = qg.quiz 
					LEFT JOIN mdl_course c ON q.course = c.id
				WHERE qg.userid = :userid";
		$data = $DB->get_records_sql($sql, ['userid' => 276]);
		$coursenames = [];
		$grades = [];
		$attemptarr = [];
		$lowestgrades = [];
		$temp_coursename = -1;

		foreach ($data as $key => $value) {
			$grademin = -1;
			if($temp_coursename == -1) {
				$coursenames[] = trim($value->coursename);
				$temp_coursename = 0;
			}
			if($coursenames) {
				foreach($coursenames as $keycoursename => $coursename) {
					if($coursename === trim($value->coursename)) {
						continue;
					}
					
				}
			}
			
			$gradeobj = new stdClass;
			$gradeobj->name = $value->quizname;
			$gradeobj->y = (int)$value->grade;
			// $gradeobj->drilldown = $value->coursename;
			$grades[] = $gradeobj;
			$gradeattempts = new stdClass;
			$gradeattempts->name = $value->quizname;
			$gradeattempts->id = $value->quizname;
			$attempts = $DB->get_records('quiz_attempts', ['quiz' => $value->quizid, 'state' => 'finished', 'userid' => 276]);
			foreach($attempts as $attempt) {
				$temp_attemptarr = [];
				if($grademin == -1) {
					$grademin = round($attempt->sumgrades, 2);
				}
				if(round($attempt->sumgrades, 2) < $grademin) {
					$grademin = round($attempt->sumgrades, 2);
				}
				$temp_attemptarr[] = $attempt->attempt; 
				$temp_attemptarr[] = round($attempt->sumgrades, 2);
				$attemptarr[] = $temp_attemptarr;
			}
			$lowestgrades[] = $grademin;
		}
		$response->coursenames = $coursenames;
		$response->grades = $grades;
		$response->attemptarr = $attemptarr;
		$response->lowestgrades = $lowestgrades;
		echo json_encode($response,JSON_UNESCAPED_UNICODE);
		die;
	case 'listcourse_grid':
		$userid = $USER->id;
		$odersql  = "";
		$wheresql = "WHERE ra.roleid= 3 AND u.id = $userid";
		if ($q) {
		    $wheresql = "WHERE ra.roleid= 3 AND u.id = $userid AND c.fullname like N'%$q%'";
		}
		if ($pagetake == 0) {
		    $ordersql = "RowNum";
		} else {
		    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
		$sql = "SELECT *, (SELECT COUNT(c.id)
                            FROM mdl_role_assignments AS ra
                                JOIN mdl_user AS u ON u.id= ra.userid
                                JOIN mdl_user_enrolments AS ue ON ue.userid=u.id
                                JOIN mdl_enrol AS e ON e.id=ue.enrolid
                                JOIN mdl_course AS c ON c.id=e.courseid
                                JOIN mdl_context AS ct ON ct.id=ra.contextid AND ct.instanceid= c.id
                                JOIN mdl_role AS r ON r.id= ra.roleid
                            $wheresql) AS total
				FROM (SELECT ROW_NUMBER() OVER (ORDER BY c.id) AS RowNum, c.*
                        FROM mdl_role_assignments AS ra
                            JOIN mdl_user AS u ON u.id= ra.userid
                            JOIN mdl_user_enrolments AS ue ON ue.userid=u.id
                            JOIN mdl_enrol AS e ON e.id=ue.enrolid
                            JOIN mdl_course AS c ON c.id=e.courseid
                            JOIN mdl_context AS ct ON ct.id=ra.contextid AND ct.instanceid= c.id
                            JOIN mdl_role AS r ON r.id= ra.roleid
                        $wheresql) AS Mydata
                ORDER BY $ordersql";
		$courses = $DB->get_records_sql($sql);
		$data = [];
		foreach ($courses as $course) {
			$obj = new stdClass;
			$coursenameurl = $CFG->wwwroot . '/course/view.php?id=' . $course->id;
			$obj->coursename = '<a href="'.$coursenameurl.'" target="_blank">' . $course->fullname . '</a>';
			$coursecontext = context_course::instance($course->id, IGNORE_MISSING);
			$studenttotal = '<a href="javascript:;" onclick="viewStudentDetail('.$course->id.')">'.count_enrolled_users($coursecontext).'</a>';
			$obj->studenttotal = $studenttotal;
			$obj->coursestartdate = convertunixtime('d/m/Y', $course->startdate);
			$obj->courseenddate = convertunixtime('d/m/Y', $course->enddate);
			// $obj->comp = competency_api::count_competencies_in_course($course->id);
			$coursecompletionurl = $CFG->wwwroot . '/course/completion.php?id=' . $course->id;
			$obj->coursecompletion = '<a href="'.$coursecompletionurl.'" target="_blank">' . $DB->count_records('course_completion_criteria', ['course' => $course->id]) . '</a>';
			$obj->coursemodules = $DB->count_records('course_modules', ['course' => $course->id]);
			if($course->startdate > time()) {
				$obj->status = '<span class="db-teaacher-course-status bg-green">Kế hoạch</span>';
			} else if($course->startdate <= time()) {
				$obj->status = '<span class="db-teaacher-course-status bg-red">Kết thúc</span>';
			} else if($course->startdate > time() && $course->enddate <= time()) {
				$obj->status = '<span class="db-teaacher-course-status bg-yellow">Đang thực hiện</span>';
			}
			$obj->total = $course->total;
			$data[] = $obj;
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die;
	case 'view_students_detail':
		$courseid     = optional_param('courseid', '', PARAM_INT);
		$role     = optional_param('role', '', PARAM_INT);
		$data     = array();
		$odersql  = "";
		$wheresql = "WHERE ra.roleid=$role AND c.id = $courseid";
		if ($q) {
		    $wheresql = "WHERE ra.roleid=$role AND c.id = $courseid AND CONCAT(u.firstname, ' ', u.lastname) like N'%$q%'";
		}
		if ($pagetake == 0) {
		    $ordersql = "RowNum";
		} else {
		    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
		$sql = "SELECT *,(SELECT COUNT(u.id)
		                    FROM mdl_user_enrolments ue
		                        JOIN mdl_enrol e ON ue.enrolid = e.id
		                        JOIN mdl_course c ON e.courseid = c.id
		                        JOIN mdl_role_assignments ra ON ra.userid = ue.userid
		                        JOIN mdl_user u ON u.id = ra.userid
		                        JOIN mdl_context as ct on ra.contextid= ct.id AND ct.instanceid = c.id
		                        LEFT JOIN mdl_course_completions cc ON cc.userid = c.id $wheresql) AS total
		        FROM (SELECT ROW_NUMBER() OVER (ORDER BY c.id) AS RowNum,c.*,cc.timecompleted,u.usercode, u.id userid, CONCAT(u.firstname, ' ', u.lastname) studentname
		              FROM mdl_user_enrolments ue
		                JOIN mdl_enrol e ON ue.enrolid = e.id
		                JOIN mdl_course c ON e.courseid = c.id
		                JOIN mdl_role_assignments ra ON ra.userid = ue.userid
		                JOIN mdl_user u ON u.id = ra.userid
		                JOIN mdl_context as ct on ra.contextid= ct.id AND ct.instanceid = c.id 
		                LEFT JOIN mdl_course_completions cc ON cc.userid = c.id AND cc.course = c.id $wheresql) AS Mydata
		        ORDER BY $ordersql";
		$get_list = $DB->get_records_sql($sql);
		foreach ($get_list as $value) {
		    $get_grade        = get_finalgrade_student($value->userid, $value->id);
		    $obj              = new stdCLass();
		    $course           = $DB->get_record('course', ['id' => $value->id]);
		    $process          = round(\core_completion\progress::get_course_progress_percentage($course, $value->userid));
		    $obj->number      = $value->rownum;
		    $obj->usercode    = ($value->usercode) ? $value->usercode : "-";
		    $obj->studentname = $value->studentname;
		    $obj->coursename  = $value->fullname;
		    $obj->courseid    = $value->shortname;
		    $obj->total       = $value->total;
		    if (!empty($get_grade)) {
		        $obj->rank       = $get_grade->rank;
		        $obj->gradefinal = $get_grade->gradefinal;
		    } else {
		        $obj->rank       = '-';
		        $obj->gradefinal = '-';
		    }
		    $obj->process = ($role == 5) ? $process . '%' : "-";
		    if ($value->timecompleted != null) {
		        $obj->timecompleted = convertunixtime('d/m/Y', $value->timecompleted, 'Asia/Ho_Chi_Minh');
		        $obj->status = "<span>Hoàn thành</span>";
		    } else {
		        $obj->timecompleted = '-';
		        $obj->status = "<span>Chưa hoàn thành</span>";
		    }
		    $data[] = $obj;
		}
		echo json_encode($data, JSON_UNESCAPED_UNICODE);
		die;
	case 'get_listcourse':
		$userid = $USER->id;
		$data = [];
		$courses = get_list_courseinfo_by_teacher($userid);
		foreach ($courses as $course) {
            $obj         = new stdclass();
            $obj->name   = $course->fullname;
            $obj->courseid = $course->id;
            $data[]         = $obj;
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die;
    case 'access_view':
    	$data = [];
    	$requestedtypes = [
    			// 			"feedback"
							// ,"forum"
							// ,"lesson"
							// "quiz"
							// ,"scorm"
							// ,"book"
							"resource"
							// ,"label"
							// ,"page"
		];	
		$students = block_analytics_graphs_get_students(150);
		$numberofstudents = count($students);
		if ($numberofstudents == 0) {
		    echo (get_string('no_students', 'block_analytics_graphs'));
		    exit;
		}
		foreach ($students as $tuple) {
		    $arrayofstudents[] = array('userid' => $tuple->id, 'nome' => $tuple->firstname . ' ' . $tuple->lastname, 'email' => $tuple->email);
		}


		$result = block_analytics_graphs_get_resource_url_access(150, $students, $requestedtypes, 1592240400, true);
		$counter = 0;
		$numberofaccesses = 0;
		$numberofresourcesintopic = 0;
		$resourceid = 0;
		$numberofresourcesintopic = array();
		$statistics = [];
		foreach ($result as $tuple) {
			if ($resourceid == 0) { /* First time in loop -> get topic and content name */
				$numberofresourcesintopic[$tuple->section] = 1;
				$statistics[$counter]['topico'] = $tuple->section;
				$statistics[$counter]['tipo'] = $tuple->tipo;
				if ($tuple->tipo == 'activequiz') {
					$statistics[$counter]['material'] = $tuple->activequiz;
				} else if ($tuple->tipo == 'assign') {
					$statistics[$counter]['material'] = $tuple->assign;
				} else if ($tuple->tipo == 'attendance') {
					$statistics[$counter]['material'] = $tuple->attendance;
				} else if ($tuple->tipo == 'bigbluebuttonbn') {
					$statistics[$counter]['material'] = $tuple->bigbluebuttonbn;
				} else if ($tuple->tipo == 'booking') {
					$statistics[$counter]['material'] = $tuple->booking;
				} else if ($tuple->tipo == 'certificate') {
					$statistics[$counter]['material'] = $tuple->certificate;
				} else if ($tuple->tipo == 'chat') {
					$statistics[$counter]['material'] = $tuple->chat;
				} else if ($tuple->tipo == 'checklist') {
					$statistics[$counter]['material'] = $tuple->checklist;
				} else if ($tuple->tipo == 'choice') {
					$statistics[$counter]['material'] = $tuple->choice;
				} else if ($tuple->tipo == 'icontent') {
					$statistics[$counter]['material'] = $tuple->icontent;
				} else if ($tuple->tipo == 'customcert') {
					$statistics[$counter]['material'] = $tuple->customcert;
				} else if ($tuple->tipo == 'data') {
					$statistics[$counter]['material'] = $tuple->data;
				} else if ($tuple->tipo == 'dataform') {
					$statistics[$counter]['material'] = $tuple->dataform;
				} else if ($tuple->tipo == 'lti') {
					$statistics[$counter]['material'] = $tuple->lti;
				} else if ($tuple->tipo == 'feedback') {
					$statistics[$counter]['material'] = $tuple->feedback;
				} else if ($tuple->tipo == 'forum') {
					$statistics[$counter]['material'] = $tuple->forum;
				} else if ($tuple->tipo == 'game') {
					$statistics[$counter]['material'] = $tuple->game;
				} else if ($tuple->tipo == 'choicegroup') {
					$statistics[$counter]['material'] = $tuple->choicegroup;
				} else if ($tuple->tipo == 'glossary') {
					$statistics[$counter]['material'] = $tuple->glossary;
				} else if ($tuple->tipo == 'choicegroup') {
					$statistics[$counter]['material'] = $tuple->choicegroup;
				} else if ($tuple->tipo == 'groupselect') {
					$statistics[$counter]['material'] = $tuple->groupselect;
				} else if ($tuple->tipo == 'hotpot') {
					$statistics[$counter]['material'] = $tuple->hotpot;
				} else if ($tuple->tipo == 'turnitintooltwo') {
					$statistics[$counter]['material'] = $tuple->turnitintooltwo;
				} else if ($tuple->tipo == 'hvp') {
					$statistics[$counter]['material'] = $tuple->hvp;
				} else if ($tuple->tipo == 'lesson') {
					$statistics[$counter]['material'] = $tuple->lesson;
				} else if ($tuple->tipo == 'openmeetings') {
					$statistics[$counter]['material'] = $tuple->openmeetings;
				} else if ($tuple->tipo == 'questionnaire') {
					$statistics[$counter]['material'] = $tuple->questionnaire;
				} else if ($tuple->tipo == 'quiz') {
					$statistics[$counter]['material'] = $tuple->quiz;
				} else if ($tuple->tipo == 'quizgame') {
					$statistics[$counter]['material'] = $tuple->quizgame;
				} else if ($tuple->tipo == 'scheduler') {
					$statistics[$counter]['material'] = $tuple->scheduler;
				} else if ($tuple->tipo == 'scorm') {
					$statistics[$counter]['material'] = $tuple->scorm;
				} else if ($tuple->tipo == 'subcourse') {
					$statistics[$counter]['material'] = $tuple->subcourse;
				} else if ($tuple->tipo == 'survey') {
					$statistics[$counter]['material'] = $tuple->survey;
				} else if ($tuple->tipo == 'vpl') {
					$statistics[$counter]['material'] = $tuple->vpl;
				} else if ($tuple->tipo == 'wiki') {
					$statistics[$counter]['material'] = $tuple->wiki;
				} else if ($tuple->tipo == 'workshop') {
					$statistics[$counter]['material'] = $tuple->workshop;
				} else if ($tuple->tipo == 'book') {
					$statistics[$counter]['material'] = $tuple->book;
				} else if ($tuple->tipo == 'resource') {
					$statistics[$counter]['material'] = $tuple->resource;
				} else if ($tuple->tipo == 'folder') {
					$statistics[$counter]['material'] = $tuple->folder;
				} else if ($tuple->tipo == 'imscp') {
					$statistics[$counter]['material'] = $tuple->imscp;
				} else if ($tuple->tipo == 'label') {
					$statistics[$counter]['material'] = $tuple->label;
				} else if ($tuple->tipo == 'lightboxgallery') {
					$statistics[$counter]['material'] = $tuple->lightboxgallery;
				} else if ($tuple->tipo == 'page') {
					$statistics[$counter]['material'] = $tuple->page;
				} else if ($tuple->tipo == 'poster') {
					$statistics[$counter]['material'] = $tuple->poster;
				} else if ($tuple->tipo == 'recordingsbn') {
					$statistics[$counter]['material'] = $tuple->recordingsbn;
				} else if ($tuple->tipo == 'url') {
					$statistics[$counter]['material'] = $tuple->url;
				}

				if ($tuple->userid) { /* If a user accessed -> get name */
					$statistics[$counter]['studentswithaccess'][] = array(
						'userid' => $tuple->userid,
						'nome' => $tuple->firstname . " " . $tuple->lastname, 'email' => $tuple->email
					);
					$numberofaccesses++;
				}
				$resourceid = $tuple->ident;
			} else { // Not first time in loop.
				if ($resourceid == $tuple->ident and $tuple->userid) {
					// If same resource and someone accessed, add student.
					$statistics[$counter]['studentswithaccess'][] = array(
						'userid' => $tuple->userid,
						'nome' => $tuple->firstname . " " . $tuple->lastname, 'email' => $tuple->email
					);
					$numberofaccesses++;
				}
				if ($resourceid != $tuple->ident) {
					// If new resource, finish previous and create new.
					if ($statistics[$counter]['topico'] == $tuple->section) {
						$numberofresourcesintopic[$tuple->section]++;
					} else {
						$numberofresourcesintopic[$tuple->section] = 1;
					}
					$statistics[$counter]['numberofaccesses'] = $numberofaccesses;
					$statistics[$counter]['numberofnoaccess'] = $numberofstudents - $numberofaccesses;
					if ($numberofaccesses == 0) {
						$statistics[$counter]['studentswithnoaccess'] = $arrayofstudents;
					} else if ($statistics[$counter]['numberofnoaccess'] > 0) {
						$statistics[$counter]['studentswithnoaccess'] = block_analytics_graphs_subtract_student_arrays(
							$arrayofstudents,
							$statistics[$counter]['studentswithaccess']
						);
					}
					$counter++;
					$statistics[$counter]['topico'] = $tuple->section;
					$statistics[$counter]['tipo'] = $tuple->tipo;
					$resourceid = $tuple->ident;

					if ($tuple->tipo == 'activequiz') {
						$statistics[$counter]['material'] = $tuple->activequiz;
					} else if ($tuple->tipo == 'assign') {
						$statistics[$counter]['material'] = $tuple->assign;
					} else if ($tuple->tipo == 'attendance') {
						$statistics[$counter]['material'] = $tuple->attendance;
					} else if ($tuple->tipo == 'bigbluebuttonbn') {
						$statistics[$counter]['material'] = $tuple->bigbluebuttonbn;
					} else if ($tuple->tipo == 'booking') {
						$statistics[$counter]['material'] = $tuple->booking;
					} else if ($tuple->tipo == 'certificate') {
						$statistics[$counter]['material'] = $tuple->certificate;
					} else if ($tuple->tipo == 'chat') {
						$statistics[$counter]['material'] = $tuple->chat;
					} else if ($tuple->tipo == 'checklist') {
						$statistics[$counter]['material'] = $tuple->checklist;
					} else if ($tuple->tipo == 'choice') {
						$statistics[$counter]['material'] = $tuple->choice;
					} else if ($tuple->tipo == 'icontent') {
						$statistics[$counter]['material'] = $tuple->icontent;
					} else if ($tuple->tipo == 'customcert') {
						$statistics[$counter]['material'] = $tuple->customcert;
					} else if ($tuple->tipo == 'data') {
						$statistics[$counter]['material'] = $tuple->data;
					} else if ($tuple->tipo == 'dataform') {
						$statistics[$counter]['material'] = $tuple->dataform;
					} else if ($tuple->tipo == 'lti') {
						$statistics[$counter]['material'] = $tuple->lti;
					} else if ($tuple->tipo == 'feedback') {
						$statistics[$counter]['material'] = $tuple->feedback;
					} else if ($tuple->tipo == 'forum') {
						$statistics[$counter]['material'] = $tuple->forum;
					} else if ($tuple->tipo == 'game') {
						$statistics[$counter]['material'] = $tuple->game;
					} else if ($tuple->tipo == 'choicegroup') {
						$statistics[$counter]['material'] = $tuple->choicegroup;
					} else if ($tuple->tipo == 'glossary') {
						$statistics[$counter]['material'] = $tuple->glossary;
					} else if ($tuple->tipo == 'choicegroup') {
						$statistics[$counter]['material'] = $tuple->choicegroup;
					} else if ($tuple->tipo == 'groupselect') {
						$statistics[$counter]['material'] = $tuple->groupselect;
					} else if ($tuple->tipo == 'hotpot') {
						$statistics[$counter]['material'] = $tuple->hotpot;
					} else if ($tuple->tipo == 'turnitintooltwo') {
						$statistics[$counter]['material'] = $tuple->turnitintooltwo;
					} else if ($tuple->tipo == 'hvp') {
						$statistics[$counter]['material'] = $tuple->hvp;
					} else if ($tuple->tipo == 'lesson') {
						$statistics[$counter]['material'] = $tuple->lesson;
					} else if ($tuple->tipo == 'openmeetings') {
						$statistics[$counter]['material'] = $tuple->openmeetings;
					} else if ($tuple->tipo == 'questionnaire') {
						$statistics[$counter]['material'] = $tuple->questionnaire;
					} else if ($tuple->tipo == 'quiz') {
						$statistics[$counter]['material'] = $tuple->quiz;
					} else if ($tuple->tipo == 'quizgame') {
						$statistics[$counter]['material'] = $tuple->quizgame;
					} else if ($tuple->tipo == 'scheduler') {
						$statistics[$counter]['material'] = $tuple->scheduler;
					} else if ($tuple->tipo == 'scorm') {
						$statistics[$counter]['material'] = $tuple->scorm;
					} else if ($tuple->tipo == 'subcourse') {
						$statistics[$counter]['material'] = $tuple->subcourse;
					} else if ($tuple->tipo == 'survey') {
						$statistics[$counter]['material'] = $tuple->survey;
					} else if ($tuple->tipo == 'vpl') {
						$statistics[$counter]['material'] = $tuple->vpl;
					} else if ($tuple->tipo == 'wiki') {
						$statistics[$counter]['material'] = $tuple->wiki;
					} else if ($tuple->tipo == 'workshop') {
						$statistics[$counter]['material'] = $tuple->workshop;
					} else if ($tuple->tipo == 'book') {
						$statistics[$counter]['material'] = $tuple->book;
					} else if ($tuple->tipo == 'resource') {
						$statistics[$counter]['material'] = $tuple->resource;
					} else if ($tuple->tipo == 'folder') {
						$statistics[$counter]['material'] = $tuple->folder;
					} else if ($tuple->tipo == 'imscp') {
						$statistics[$counter]['material'] = $tuple->imscp;
					} else if ($tuple->tipo == 'label') {
						$statistics[$counter]['material'] = $tuple->label;
					} else if ($tuple->tipo == 'lightboxgallery') {
						$statistics[$counter]['material'] = $tuple->lightboxgallery;
					} else if ($tuple->tipo == 'page') {
						$statistics[$counter]['material'] = $tuple->page;
					} else if ($tuple->tipo == 'poster') {
						$statistics[$counter]['material'] = $tuple->poster;
					} else if ($tuple->tipo == 'recordingsbn') {
						$statistics[$counter]['material'] = $tuple->recordingsbn;
					} else if ($tuple->tipo == 'url') {
						$statistics[$counter]['material'] = $tuple->url;
					}

					if ($tuple->userid) {
						$statistics[$counter]['studentswithaccess'][] = array(
							'userid' => $tuple->userid,
							'nome' => $tuple->firstname . " " . $tuple->lastname, 'email' => $tuple->email
						);
						$numberofaccesses = 1;
					} else {
						$numberofaccesses = 0;
					}
				}
			}
		}
		/* Adjust last access  */
		$statistics[$counter]['numberofaccesses'] = $numberofaccesses;
		$statistics[$counter]['numberofnoaccess'] = $numberofstudents - $numberofaccesses;
		if ($numberofaccesses == 0) {
			$statistics[$counter]['studentswithnoaccess'] = $arrayofstudents;
		} else if ($statistics[$counter]['numberofnoaccess'] > 0) {
			$statistics[$counter]['studentswithnoaccess'] = block_analytics_graphs_subtract_student_arrays(
				$arrayofstudents,
				$statistics[$counter]['studentswithaccess']
			);
		}
		$inicio = -0.5;
		$par = 2;
		$plot = '';
		foreach ($numberofresourcesintopic as $topico => $numberoftopics) {
		    $fim = $inicio + $numberoftopics;
		    $color = $par % 2 ? 'rgba(0, 0, 0, 0)' : 'rgba(68, 170, 213, 0.1)';
		    $plot .= "{ color: ".$color.",
                        label: {
                            align: 'right',
                            x: -10,
                            verticalAlign: 'middle' ,
                            text: topic ".$topico.",
                            style: {
                            	fontStyle: 'italic',
                            }
                        },
                        from: ".$inicio.", // Start of the plot band
                        to: ".$fim.", // End of the plot band
                    },";
                    
			$inicio = $fim;
			$par++;
		}
		$data['statistics'] = $statistics;
		$data['plot'] = $plot;
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die;
	case 'grade_view':
		$users = get_listuser_in_course(150);
		$gradeavg = [];
		
		$modulesname = [];
		$data_module = [];
		// $count_module_incourse = $DB->count_records('')
		foreach($users as $user) {
			$userid = $user->id;
			$usersname[] = $user->userfullname;
			$grades_sql = "SELECT * 
						FROM mdl_grade_grades gg 
							LEFT JOIN mdl_grade_items gi ON gg.itemid = gi.id 
						WHERE gi.courseid = :courseid AND gg.userid = :userid";
			$grades = $DB->get_records_sql($grades_sql, ['courseid' => 150, 'userid' => $userid]);
			$count_module = 0;
			foreach($grades as $grade) {
				if($grade->itemmodule == '') {
					continue;
				}
				if(!in_array($grade->itemname, $modulesname)) {
					$modulesname[] = $grade->itemname;
					$data_module[$grade->itemname] = '';
					if ($grade->finalgrade == '') {
						$grade->finalgrade = 0;
					}
					if (in_array($grade->itemname, $data_module)) {
						array_push($data_module[$grade->itemname], $grade->finalgrade);
					} else {
						$data_module[$grade->itemname] .= (int)round($grade->finalgrade,2 ) . ',';
					}
				} else {
					if ($grade->finalgrade == '') {
						$grade->finalgrade = 0;
					}
					if (in_array($grade->itemname, $data_module)) {
						array_push($data_module[$grade->itemname], $grade->finalgrade);
					} else {
						$data_module[$grade->itemname] .= (int)round($grade->finalgrade, 2) . ',';
					}
				}
			}
			
		}
		$data = [];
		foreach($data_module as $keymodule => $module) {
			$obj = new stdClass;
			$obj->name = $keymodule;
			str_replace('"', '', $module);
			$str_to_array = explode(",", $module);
			array_pop($str_to_array);
			$temp = [];
			foreach($str_to_array as $value) {
				$temp[] = (int)$value;
 			}
			$obj->data = $temp;
			$data[] = $obj;
		}
		$obj = new stdClass;
		$obj->name = "AVG grade";
		$obj->type = "spline";
		$obj->data = [5, 1, 10, 9, 4];
		$data[] = $obj;
		$response->usersname = $usersname;
		// $response->gradeavg = $grades;
		$response->modulesdata = $data;
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		die;
	case 'assignment_view':
		die;
	case 'quiz_view':
		die;
	default:
		# code...
		break;
}