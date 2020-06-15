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
        var_dump($user);die;
   		$this->data = new stdClass;
   		$this->resp = new stdClass;
   	}

   	public function validate_testregister() {
        //Khai báo  rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'examname' => $this->v::notEmpty()->notBlank(),
            'examcode' => $this->v::notEmpty()->notBlank(),
            'teachercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'quizname' => $this->v::notEmpty()->notBlank(),
            'quizcode' => $this->v::notEmpty()->notBlank(),
            // 'startdate' => $this->v::notEmpty()->notBlank()->DateTime(),
            // 'enddate' => $this->v::notEmpty()->notBlank()->DateTime(),
            'studentcode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'kindofcourse' => $this->v::notEmpty()->notBlank()
        ]);
    }

    public function validate_exam() {
        //Khai báo  rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'coursecode' => $this->v::notEmpty()->notBlank(),
            'teachercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'quizname' => $this->v::notEmpty()->notBlank(),
            'quizcode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            // 'startdate' => $this->v::notEmpty()->notBlank()->DateTime(),
            // 'enddate' => $this->v::notEmpty()->notBlank()->DateTime(),
            'studentcode' => $this->v::notEmpty()->notBlank()->noWhitespace()
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
	    $userid = find_usercode_by_code($this->data->studentcode);
		$teacherid = find_usercode_by_code($this->data->teachercode);
		$courseid = $DB->get_field('course', 'id', ['shortname' => $this->data->examcode]);
		if(!$userid) {
			$this->resp->data['studentcode'] = "Mã học viên không tồn tại";
		}
		if(!$teacherid) {
			$this->resp->data['usercode'] = "Mã giáo viên không tồn tại";
		}
		$courses = new stdClass;
		$courses->fullname = $this->data->examname;
	    $courses->shortname = $this->data->examcode;
	    // $courses->coursesetup = $request->getParam('setupcode');
		$courses->idnumber = '';
		$courses->format = 'topics';
		$courses->showgrades = 1;
		$courses->numsections = 4;
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
					$message .= 'Chỉnh sửa khóa học thành công, ';
			    	$modinfo = new stdClass;
				    $modinfo->name = $this->data->quizname;
				    $modinfo->code = $this->data->quizcode;
				    $modinfo->modulename = 'quiz';
				    $modinfo->course = $course->id;
				    $modinfo->grade = 10;
				    $modinfo->section = 1;
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
				    $message = '';
			    	if($DB->record_exists('quiz', ['code' => $this->data->quizcode, 'name' => $this->data->quizname])) {
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
			    	if($modulequiz) {
			    		$enrol_user = check_user_in_course($course->id,$userid);
						$enrol_teahcer = check_teacher_in_course($course->id,$teacherid);
						if(!$enrol_user) {
							enrol_user($userid, $course->id, 'student');
							$message .= "Thêm thành công thêm user học viên vào khóa học, ";
						} else {
							$message .= "Học viên đã tham gia vào khóa, ";
						}
						if(!$enrol_teahcer) {
							enrol_user($teacherid, $course->id, 'editingteacher');
							$message .= "Thêm thành công thêm user giáo viên khóa học";
						} else {
							$message .= "Giáo viên đã tham gia vào khóa";
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
					$course->id = create_course($courses);
					$message .= 'Tạo khóa học thành công, ';
			    	$modinfo = new stdClass;
				    $modinfo->name = $this->data->quizname;
				    $modinfo->code = $this->data->quizcode;
				    $modinfo->modulename = 'quiz';
				    $modinfo->course = $course->id;
				    $modinfo->grade = 10;
				    $modinfo->section = 1;
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
				    $message = '';
			    	if($DB->record_exists('quiz', ['code' => $this->data->quizcode, 'name' => $this->data->quizname])) {
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
			    	if($modulequiz) {
			    		$enrol_user = check_user_in_course($course->id,$userid);
						$enrol_teahcer = check_teacher_in_course($course->id,$teacherid);
						if(!$enrol_user) {
							enrol_user($userid, $course->id, 'student');
							$message .= "Thêm thành công thêm user học viên vào khóa học, ";
						} else {
							$message .= "Học viên đã tham gia vào khóa, ";
						}
						if(!$enrol_teahcer) {
							enrol_user($teacherid, $course->id, 'editingteacher');
							$message .= "Thêm thành công thêm user giáo viên khóa học";
						} else {
							$message .= "Giáo viên đã tham gia vào khóa";
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
	    $userid = find_usercode_by_code($this->data->studentcode);
		$teacherid = find_usercode_by_code($this->data->teachercode);
		if(!$userid) {
			$this->resp->data['studentcode'] = "Mã học viên không tồn tại";
		}
		if(!$teacherid) {
			$this->resp->data['usercode'] = "Mã giáo viên không tồn tại";
		}
		if(empty($this->resp->data)) {
			$course = $DB->get_record('course', ['shortname' => $this->data->coursecode]);
		    if($course) {
		    	$modinfo = new stdClass;
			    $modinfo->name = $this->data->quizname;
			    $modinfo->code = $this->data->quizcode;
			    $modinfo->modulename = 'quiz';
			    $modinfo->course = $course->id;
			    $modinfo->grade = 10;
			    $modinfo->section = 1;
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
			    $message = '';
		    	if($DB->record_exists('quiz', ['code' => $this->data->quizcode, 'name' => $this->data->quizname])) {
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
		    	if($modulequiz) {
		    		$enrol_user = check_user_in_course($course->id,$userid);
					$enrol_teahcer = check_teacher_in_course($course->id,$teacherid);
					// var_dump($enrol_teahcer, $enrol_user);die;
					if(!$enrol_user) {
						enrol_user($userid, $course->id, 'student');
						$message .= "Thêm thành công thêm user học viên vào khóa học, ";
					} else {
						$message .= "Học viên đã tham gia vào khóa, ";
					}
					if(!$enrol_teahcer) {
						enrol_user($teacherid, $course->id, 'editingteacher');
						$message .= "Thêm thành công thêm user giáo viên khóa học";
					} else {
						$message .= "Giáo viên đã tham gia vào khóa";
					}
					$this->resp->error = false;
					$this->resp->message['info'] = $message;
					$this->resp->data[] = $this->data;
		    	}
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

