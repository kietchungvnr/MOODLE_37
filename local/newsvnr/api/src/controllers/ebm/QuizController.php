<?php 

namespace local_newsvnr\api\controllers\ebm;

use stdClass;
use local_newsvnr\api\controllers\BaseController as BaseController;

defined('MOODLE_INTERNAL') || die;
global $CFG;

require_once("$CFG->dirroot/user/lib.php");
require_once("$CFG->dirroot/course/lib.php");
require_once("$CFG->dirroot/local/newsvnr/lib.php");

class QuizController extends BaseController {

	public $data;
	public $resp;
	public $check_code;

	public function __construct($container) {
		global $CFG;
		parent::__construct($container);
		if(isloggedin()) {
            $CFG->sessiontimeout += 120;
        } else {
            $adminuser = get_complete_user_data('id', 2);
            $user = complete_user_login($adminuser);
        }
   		$this->data = new stdClass;
   		$this->resp = new stdClass;
   	}

   	public function validate_testregister() {
        //Khai báo  rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'examname' => $this->v::notEmpty()->notBlank(),
            'examcode' => $this->v::notEmpty()->notBlank(),
            // 'teachercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'quizname' => $this->v::notEmpty()->notBlank(),
            'quizcode' => $this->v::notEmpty()->notBlank(),
            // 'startdate' => $this->v::notEmpty()->notBlank()->DateTime(),
            // 'enddate' => $this->v::notEmpty()->notBlank()->DateTime(),
            // 'studentcode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'kindofcourse' => $this->v::notEmpty()->notBlank(),
            // 'sectionname' => $this->v::notEmpty()->notBlank(),
        ]);
    }

    public function validate_exam() {
        //Khai báo  rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'coursecode' => $this->v::notEmpty()->notBlank(),
            // 'teachercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'quizname' => $this->v::notEmpty()->notBlank(),
            'quizcode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            // 'sectionname' => $this->v::notEmpty()->notBlank()
            // 'startdate' => $this->v::notEmpty()->notBlank()->DateTime(),
            // 'enddate' => $this->v::notEmpty()->notBlank()->DateTime(),
            // 'studentcode' => $this->v::notEmpty()->notBlank()->noWhitespace()
        ]);
    }
	
	public function create_and_update_testregister($request, $response, $args) {
		global $DB;
		
		$this->validate_testregister();
      	if ($this->validate->isValid()) {
	    	$this->data->coursecode = $request->getParam('coursecode');
	    	$this->data->teachercode = $request->getParam('teachercode');
	    	$this->data->quizname = $request->getParam('quizname');
	    	$this->data->quizcode = $request->getParam('quizcode');
	    	$this->data->examname = $request->getParam('examname');
	    	$this->data->examcode = $request->getParam('examcode');
	    	$this->data->studentcode = $request->getParam('studentcode');
	    	$this->data->kindofcourse = $request->getParam('kindofcourse');
	    	// $this->data->sectionname = $request->getParam('sectionname');
	    	if($request->getParam('startdate') == '') 
		    	$this->data->startdate = time();
		    else
		    	$this->data->startdate = strtotime($request->getParam('startdate'));
		    if($request->getParam('enddate'))
		    	$this->data->enddate = strtotime($request->getParam('enddate'));
		    else 
		    	$this->data->enddate = 0;
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    } 
		$courseid = $DB->get_field('course', 'id', ['shortname' => $this->data->examcode]);
	  //   if($this->data->studentcode && $this->data->teachercode) {
	  //   	$userid = find_usercode_by_code($this->data->studentcode);
			// $teacherid = find_usercode_by_code($this->data->teachercode);
			// if(!$userid) {
			// 	$this->resp->data['studentcode'] = "Mã học viên không tồn tại";
			// }
			// if(!$teacherid) {
			// 	$this->resp->data['usercode'] = "Mã giáo viên không tồn tại";
			// }
	  //   }
	    
		$courses = new stdClass;
		$courses->fullname = $this->data->examname;
	    $courses->shortname = $this->data->examcode;
	    // $courses->coursesetup = $request->getParam('setupcode');
		$courses->idnumber = '';
		$courses->format = 'topics';
		$courses->showgrades = 1;
		$courses->numsections = 0;
		$courses->newsitems = 10;
		$courses->visible = 1;
		$courses->showreports = 1;
		$courses->summary = '';
		$courses->summaryformat = FORMAT_HTML;
		$courses->lang = 'vi';
		$courses->typeofcourse = 3;
		$courses->enablecompletion = 1;	
		$message = '';
		if($courseid) {
			$courses->id = $courseid;
			$course = $DB->get_record('course', ['id' => $courseid]);
			if (!empty($courses->shortname) && $course->shortname !== $courses->shortname ) {
	            $check_course = $DB->get_record('course',['shortname' => $courses->shortname], 'shortname');
				if($check_course) {
					$check_code = $check_course->shortname;
					$this->resp->data['examcode'] = "Mã khoá học'$check_code' đã tồn tại";
				}
	        }

	        if($this->data->kindofcourse) {
	        	$categoryid = $DB->get_field('course_categories', 'id', ['name' => $this->data->kindofcourse]);
				if($categoryid) {
					$courses->category = $categoryid;
				} else {
					$this->resp->data['kindofcourse'] = "Chương trình học không tồn tại";
				}
			} else {
				$this->resp->data['kindofcourse'] = "Thiếu kindofcourse";
			}
			if(empty($this->resp->data)) {
				try {
					update_course($courses);
					$allmodinfo = get_fast_modinfo($courseid)->get_section_info_all();
					$allsectionname = [];
					$quizcode = explode('_', $this->data->quizcode);
					foreach ($allmodinfo as $value) {
						$allsectionname[] = $value->name; 
					}
					if(!in_array($quizcode[1], $allsectionname)) {
						$section = count($allmodinfo);
					} else {
						$section = array_search($quizcode[1], $allsectionname);
					}
					course_create_sections_if_missing($courseid, $section, $quizcode[1]);
					$message .= 'Chỉnh sửa khóa học thành công, ';
					$quiznamearr = explode(',', $this->data->quizname);
					// $quizcodearr = explode(',', $this->data->quizcode);
					foreach($quiznamearr as $key => $quizname) {
				    	$modinfo = new stdClass;
					    $modinfo->name = $quizname;
					    $modinfo->code = $this->data->quizcode;
					    $modinfo->modulename = 'quiz';
					    $modinfo->course = $course->id;
					    $modinfo->grade = 10;
					    $modinfo->sectionname = $quizcode[1];
					    $modinfo->section = $section;
					    $modinfo->visible = 1;
					    $modinfo->quizpassword  = '';
					    $modinfo->introeditor = ['text' => '', 'format' => '1','itemid' => '0'];
					    $modinfo->timeclose = $this->data->enddate;
					    $modinfo->timeopen = $this->data->startdate;
					    $modinfo->shuffleanswers = 1;
					    $modinfo->decimalpoints  = 2;
					    $modinfo->grademethod  = 1;
					    $modinfo->timelimit = 0;
					    $modinfo->cmidnumber = '';
					    $modinfo->graceperiod = 0;
					    $modinfo->questiondecimalpoints  = -1;
					    $modinfo->preferredbehaviour = 'deferredfeedback';
					    $modinfo->overduehandling = 'autosubmit';
					    $modinfo->completion = 2;
				        $modinfo->completionusegrade = 1;
				        $modinfo->attempts = 1;
					    $message = '';

						// $allmodinfo = get_fast_modinfo($courses)->get_section_info_all();
						// $allsectionname = [];
					 //    foreach ($allmodinfo as $value) {
						// 	$allsectionname[] = $value->name; 
						// }
						// if(!in_array($quizname, $allsectionname)) {
						// 	$modinfo->section = count($allmodinfo);
						// } else {
						// 	$modinfo->section = array_search($quizname, $allsectionname);
						// }

				    	if($DB->record_exists('quiz', ['code' => $this->data->quizcode, 'name' => $quizname, 'course' => $courses->id])) {
				    		$quizid = $DB->get_field('quiz', 'id', ['course' => $course->id, 'name' => $modinfo->name]);
						    $cm = get_coursemodule_from_instance('quiz', $quizid);
						    $modinfo->coursemodule = $cm->id;
				    		$modulequiz = update_module($modinfo);
							if($modulequiz) {
								$message .= 'Chỉnh sửa kì thi thành công, ';
							}
				    	} else {
				    		$modinfo->cmidnumber = '';
							$modulequiz = create_module($modinfo);
							if($modulequiz) {
								$message .= 'Tạo kì thi thành công';
							}
				    	}
			    	}
			    	if($modulequiz) {
			    		if($this->data->studentcode && $this->data->teachercode) {
			    			$studentarr = explode(',', $this->data->studentcode);
			    			$teacherarr = explode(',', $this->data->teachercode);
			    			foreach ($studentarr as $student) {
			    				$userid = find_usercode_by_code($student);
								$enrol_user = check_user_in_course($course->id,$userid);
								if(!$enrol_user) {
									enrol_user($userid, $course->id, 'student');
								}
			    			}
			    			foreach ($teacherarr as $teacher) {
								$teacherid = find_usercode_by_code($teacher);
								$enrol_user = check_user_in_course($course->id,$teacherid);
								if(!$enrol_user) {
									enrol_user($teacherid, $course->id, 'editingteacher');
								}
			    			}
			    		}
						$this->resp->error = false;
						$this->resp->message['info'] = $message;
						$this->resp->data[] = $modulequiz;
			    	}
				} catch (Exception $e) {
					$this->resp->error = true;
					$this->resp->data->message['info'] = "Thêm thất bại với lỗi: $e->getMessage()";
				}		
			    
			} else {
				$this->resp->error = true;
			}
		} else {
			if (!empty($courses->shortname)) {
	            $coursecode = $DB->get_record('course',['shortname' => $courses->shortname], 'shortname');
				if($coursecode) {
					$this->resp->data['examcode'] = "Mã kì thi đã tồn tại!";
				}
	        }
	        if($this->data->kindofcourse) {
	        	$categoryid = $DB->get_field('course_categories', 'id', ['name' => $this->data->kindofcourse]);
				if($categoryid) {
					$courses->category = $categoryid;
				} else {
					$this->resp->data['kindofcourse'] = "Chương trình học không tồn tại";
				}
			} else {
				$this->resp->data['kindofcourse'] = "Thiếu kindofcourse";
			}
			if(empty($this->resp->data)) {
				try {
					$course = create_course($courses);
					$allmodinfo = get_fast_modinfo($course)->get_section_info_all();
					$allsectionname = [];
					$quizcode = explode('_', $this->data->quizcode);
					foreach ($allmodinfo as $value) {
						$allsectionname[] = $value->name; 
					}
					if(!in_array($quizcode[1], $allsectionname)) {
						$section = count($allmodinfo);
					} else {
						$section = array_search($quizcode[1], $allsectionname);
					}
					course_create_sections_if_missing($course, $section, $quizcode[1]);
					$message .= 'Tạo khóa học thành công, ';
			    	$modinfo = new stdClass;
					$quiznamearr = explode(',', $this->data->quizname);
					// $quizcodearr = explode(',', $this->data->quizcode);
					foreach($quiznamearr as $key => $quizname) {
						$modinfo = new stdClass;
					    $modinfo->name = $quizname;
					    $modinfo->code = $this->data->quizcode;
					    $modinfo->modulename = 'quiz';
					    $modinfo->course = $course->id;
					    $modinfo->grade = 10;
					    $modinfo->section = $section;
					    $modinfo->visible = 1;
					    $modinfo->quizpassword  = '';
					    $modinfo->introeditor = ['text' => '', 'format' => '1','itemid' => '0'];
					    $modinfo->timeclose = $this->data->enddate;
					    $modinfo->timeopen = $this->data->startdate;
					    $modinfo->shuffleanswers = 1;
					    $modinfo->decimalpoints  = 2;
					    $modinfo->grademethod  = 1;
					    $modinfo->sectionname = $quizcode[1];
					    $modinfo->timelimit = 0;
					    $modinfo->cmidnumber = '';
					    $modinfo->graceperiod = 0;
					    $modinfo->questiondecimalpoints  = -1;
					    $modinfo->preferredbehaviour = 'deferredfeedback';
					    $modinfo->overduehandling = 'autosubmit';
					    $modinfo->completion = 2;
				        $modinfo->completionusegrade = 1;
				        $modinfo->attempts = 1;
						$message = '';
						
						// $allmodinfo = get_fast_modinfo($courses)->get_section_info_all();
						// $allsectionname = [];
					 //    foreach ($allmodinfo as $value) {
						// 	$allsectionname[] = $value->name; 
						// }
						// if(!in_array($quizname, $allsectionname)) {
						// 	$modinfo->section = count($allmodinfo);
						// } else {
						// 	$modinfo->section = array_search($quizname, $allsectionname);
						// }

				    	if($DB->record_exists('quiz', ['code' => $this->data->quizcode, 'name' => $quizname, 'course' => $course->id])) {
				    		$quizid = $DB->get_field('quiz', 'id', ['course' => $course->id, 'name' => $modinfo->name]);
						    $cm = get_coursemodule_from_instance('quiz', $quizid);
						    $modinfo->coursemodule = $cm->id;
				    		$modulequiz = update_module($modinfo);
							if($modulequiz) {
								$message .= 'Chỉnh sửa kì thi thành công, ';
							}
				    	} else {
				    		$modinfo->cmidnumber = '';
							$modulequiz = create_module($modinfo);
							if($modulequiz) {
								$message .= 'Tạo kì thi thành công';
							}
				    	}
			    	}
			    	if($modulequiz) {
			    		if($this->data->studentcode && $this->data->teachercode) {
			    			$studentarr = explode(',', $this->data->studentcode);
			    			$teacherarr = explode(',', $this->data->teachercode);
			    			foreach ($studentarr as $student) {
			    				$userid = find_usercode_by_code($student);
								$enrol_user = check_user_in_course($course->id,$userid);
								if(!$enrol_user) {
									enrol_user($userid, $course->id, 'student');
								}
			    			}
			    			foreach ($teacherarr as $teacher) {
								$teacherid = find_usercode_by_code($teacher);
								$enrol_user = check_user_in_course($course->id,$teacherid);
								if(!$enrol_user) {
									enrol_user($teacherid, $course->id, 'editingteacher');
								}
			    			}
			    		}
						$this->resp->error = false;
						$this->resp->message['info'] = $message;
						$this->resp->data[] = $modulequiz;
			    	}
				} catch (Exception $e) {
					$this->resp->error = true;
					$this->resp->data->message['info'] = "Thêm thất bại với lỗi: $e->getMessage()";
				}		
			    
			} else {
				$this->resp->error = true;
			}
		}

	    
		return $response->withStatus(200)->withJson($this->resp);	
		
	}

	public function create_and_update_exam($request, $response, $args) {
		global $DB;
		
		$this->validate_exam();
      	if ($this->validate->isValid()) {
	    	$this->data->coursecode = $request->getParam('coursecode');
	    	$this->data->teachercode = $request->getParam('teachercode');
	    	$this->data->quizname = $request->getParam('quizname');
	    	$this->data->quizcode = $request->getParam('quizcode');
	    	$this->data->studentcode = $request->getParam('studentcode');
	    	$this->data->categoryname = $request->getParam('categoryname');
	    	$this->data->categorycode = $request->getParam('categorycode');
	    	$this->data->fullname = $request->getParam('fullname');
	    	$this->data->shortname = $request->getParam('shortname');
	    	// $this->data->sectionname = $request->getParam('sectionname');
	    	if($request->getParam('startdate') == '') 
		    	$this->data->startdate = time();
		    else
		    	$this->data->startdate = strtotime($request->getParam('startdate'));
		    if($request->getParam('enddate'))
		    	$this->data->enddate = strtotime($request->getParam('enddate'));
		    else 
		    	$this->data->enddate = 0;
		   
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
	  //   if($this->data->studentcode && $this->data->teachercode) {
	  //   	$userid = find_usercode_by_code($this->data->studentcode);
			// $teacherid = find_usercode_by_code($this->data->teachercode);
			// if(!$userid) {
			// 	$this->resp->data['studentcode'] = "Mã học viên không tồn tại";
			// }
			// if(!$teacherid) {
			// 	$this->resp->data['usercode'] = "Mã giáo viên không tồn tại";
			// }
	  //   }
	    if($this->data->categoryname and $this->data->categorycode) {
			$existing = $DB->get_field('course_categories','id',['name' => $this->data->categoryname, 'idnumber' => $this->data->categorycode]);
			if($existing) {
				$this->data->category = $existing;
			} else {
				$categoryname = $this->data->categoryname;
				$this->resp->data['categoryname'] = "Không tìm thấy tên '$categoryname' trong danh mục khoá học ";
			}
		}
		if(empty($this->resp->data)) {
			$course = $DB->get_record('course', ['shortname' => $this->data->coursecode]);
		    if($course) {
		    	$allmodinfo = get_fast_modinfo($course->id)->get_section_info_all();
				$allsectionname = [];
				$quizcode = explode('_', $this->data->quizcode);
				foreach ($allmodinfo as $value) {
					$allsectionname[] = $value->name; 
				}
				if(!in_array($quizcode[1], $allsectionname)) {
					$section = count($allmodinfo);
				} else {
					$section = array_search($quizcode[1], $allsectionname);
				}
				course_create_sections_if_missing($course->id, $section, $quizcode[1]);
				$message .= 'Chỉnh sửa khóa học thành công, ';
				$quiznamearr = explode(',', $this->data->quizname);
				// $quizcodearr = explode(',', $this->data->quizcode);
				foreach($quiznamearr as $key => $quizname) {
			    	$modinfo = new stdClass;
				    $modinfo->name = $quizname;
				    $modinfo->code = $this->data->quizcode;
				    $modinfo->modulename = 'quiz';
				    $modinfo->course = $course->id;
				    $modinfo->grade = 10;
				    $modinfo->sectionname = $quizcode[1];
				    $modinfo->section = $section;
				    $modinfo->visible = 1;
				    $modinfo->quizpassword  = '';
				    $modinfo->introeditor = ['text' => '', 'format' => '1','itemid' => '0'];
				    $modinfo->timeclose = $this->data->enddate;
				    $modinfo->timeopen = $this->data->startdate;
				    $modinfo->shuffleanswers = 1;
				    $modinfo->decimalpoints  = 2;
				    $modinfo->grademethod  = 1;
				    $modinfo->timelimit = 0;
				    $modinfo->cmidnumber = '';
				    $modinfo->graceperiod = 0;
				    $modinfo->questiondecimalpoints  = -1;
				    $modinfo->preferredbehaviour = 'deferredfeedback';
				    $modinfo->overduehandling = 'autosubmit';
				    $modinfo->completion = 2;
			        $modinfo->completionusegrade = 1;
			        $modinfo->attempts = 1;
				    $message = '';

				    // $allmodinfo = get_fast_modinfo($course)->get_section_info_all();
					// $allsectionname = [];
				 //    foreach ($allmodinfo as $value) {
					// 	$allsectionname[] = $value->name; 
					// }
					// if(!in_array($this->data->sectionname, $allsectionname)) {
					// 	$modinfo->section = count($allmodinfo) + 1;
					// } else {
					// 	$modinfo->section = array_search($this->data->sectionname, $allsectionname);
					// }

			    	if($DB->record_exists('quiz', ['code' => $this->data->quizcode, 'name' => $this->data->quizname, 'course' => $course->id])) {
			    		$quizid = $DB->get_field('quiz', 'id', ['course' => $course->id, 'name' => $modinfo->name]);
					    $cm = get_coursemodule_from_instance('quiz', $quizid);
					    $modinfo->coursemodule = $cm->id;
			    		$modulequiz = update_module($modinfo);
						if($modulequiz) {
							$message .= 'Chỉnh sửa kì thi thành công, ';
						}
			    	} else {
			    		$modinfo->cmidnumber = '';
						$modulequiz = create_module($modinfo);
						if($modulequiz) {
							$message .= 'Tạo kì thi thành công';
						}
			    	}
		    	}
		    	if($modulequiz) {
		    		if($this->data->studentcode && $this->data->teachercode) {
		    			$studentarr = explode(',', $this->data->studentcode);
		    			$teacherarr = explode(',', $this->data->teachercode);
		    			foreach ($studentarr as $student) {
		    				$userid = find_usercode_by_code($student);
							$enrol_user = check_user_in_course($course->id,$userid);
							if(!$enrol_user) {
								enrol_user($userid, $course->id, 'student');
							}
		    			}
		    			foreach ($teacherarr as $teacher) {
							$teacherid = find_usercode_by_code($teacher);
							$enrol_user = check_user_in_course($course->id,$teacherid);
							if(!$enrol_user) {
								enrol_user($teacherid, $course->id, 'editingteacher');
							}
		    			}
		    		}
					$this->resp->error = false;
					$this->resp->message['info'] = $message;
					$this->resp->data[] = $this->data;
		    	}
		    } else {
		  //   	$course = new stdClass;
				// $course->fullname = $this->data->fullname;
			 //    $course->shortname = $this->data->shortname;
			 //    // $course->courseetup = $request->getParam('setupcode');
				// $course->idnumber = '';
				// $course->format = 'topics';
				// $course->showgrades = 1;
				// $course->numsections = 0;
				// $course->newsitems = 10;
				// $course->visible = 1;
				// $course->showreports = 1;
				// $course->summary = '';
				// $course->summaryformat = FORMAT_HTML;
				// $course->lang = 'vi';
				// $course->typeofcourse = 3;
				// $course->enablecompletion = 1;	
				// $data = create_course($course);
				// $this->resp->error = false;
				// $this->resp->message['info'] = 'Tạo thành công khóa online';
				// $this->resp->data[] = $data;
				$this->resp->error = true;
		    }
		} else {
			$this->resp->error = true;
		}
	    
		return $response->withStatus(200)->withJson($this->resp);	
		
	}
	
	public function delete($request, $response, $args) {
		global $DB;
		$this->validate = $this->validator->validate($this->request, [
            'quizname' => $this->v::notEmpty()->notBlank(),
            'quizcode' => $this->v::notEmpty()->notBlank(),
            'coursecode' => $this->v::notEmpty()->notBlank()
        ]);
      	if ($this->validate->isValid()) {
	    	$this->data->quizname = $request->getParam('quizname');
	    	$this->data->quizcode = $request->getParam('quizcode');
	    	$this->data->shortname = $request->getParam('coursecode');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
	    $courseid = $DB->get_field('course', 'id', ['shortname' => $this->data->shortname]);
	    if($courseid) {
	    	$quizid = $DB->get_field('quiz', 'id', ['course' => $courseid, 'name' => $this->data->quizname, 'code' => $this->data->quizname]);
	    	if($quizid) {
	    		$cm = get_coursemodule_from_instance('quiz', $quizid);
	    		course_delete_module($cm->id);
	    		$this->data->error = false;
	    		$this->data->message['info'] = 'Xóa Môn thi thành công';
	    	} else {
	    		$this->data->error = true;
	    		$this->data->message['info'] = 'Môn thi không tồn tại';
	    	}			
	    } else {
	    	$this->data->error = false;
	    	$this->data->message['info'] = 'Kì thi không tồn tại';
	    }
	    return $response->withStatus(200)->withJson($this->resp);
	}

}

