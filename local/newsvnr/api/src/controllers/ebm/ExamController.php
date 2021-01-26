<?php 

namespace local_newsvnr\api\controllers\ebm;

use stdClass;
use context_system;
use core_text;
use core_user;
use local_newsvnr\api\controllers\BaseController as BaseController;

defined('MOODLE_INTERNAL') || die;
global $CFG;

require_once("$CFG->dirroot/user/lib.php");
require_once("$CFG->dirroot/course/lib.php");

class ExamController extends BaseController {

	public $data;
	public $resp;

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

   	public function validate() {
        //Khai báo  rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'examname' => $this->v::notEmpty()->notBlank(),
            'examcode' => $this->v::notEmpty()->notBlank(),
            // 'quizname' => $this->v::notEmpty()->notBlank(),
            // 'quizcode' => $this->v::notEmpty()->notBlank(),
            'quizopen' => $this->v::notEmpty()->notBlank(),
            'quizclose' => $this->v::notEmpty()->notBlank(),
            'subjectname' => $this->v::notEmpty()->notBlank(),
            'subjectcode' => $this->v::notEmpty()->notBlank(),
            'subjectshortname' => $this->v::notEmpty()->notBlank()
        ]);
    }
	
	public function create_and_update($request, $response, $args) {
		global $DB, $SITE, $USER;

		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->examname = $request->getParam('examname');
	    	$this->data->examcode = $request->getParam('examcode');
	    	// $this->data->quizname = trim($request->getParam('quizname'));
	    	// $this->data->quizcode = trim($request->getParam('quizcode'));
	    	$this->data->quizopen = $request->getParam('quizopen');
	    	$this->data->quizclose = $request->getParam('quizclose');
	    	$this->data->subjectname = $request->getParam('subjectname');
		    $this->data->subjectcode = $request->getParam('subjectcode');
		    $this->data->subjectshortname = $request->getParam('subjectshortname');
	    	if($request->getParam('teachercode')) {
		    	$this->data->teachercode = $request->getParam('teachercode');
	    	} else {
	    		$this->data->teachercode = '';
	    	}
	    	if($request->getParam('studentcode')) {
		    	$this->data->studentcode = $request->getParam('studentcode');
	    	} else {
	    		$this->data->studentcode = $request->getParam('studentcode');
	    	}
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }

	    if($this->data->examcode) {
	    	// tồn tại kì thi
    		$examid = $DB->get_field('exam', 'id', ['code' => $this->data->examcode]);
			if (!$examid) {
				// Tạo kì thi
				$exam = new stdClass;
				$exam->name = $this->data->examname;
				$exam->code = $this->data->examcode;
				$exam->type = 1;
				$exam->datestart = 0;
				$exam->dateend = 0;
				$exam->timecreated = time();
				$exam->timemodified = time();
				$exam->usercreate = $USER->id;
				$exam->usermodified = $USER->id;
				$examid = $DB->insert_record('exam', $exam);	
			} else {
				$exam = new stdClass;
				$exam->id = $examid;
				$exam->name = $this->data->examname;
				$exam->code = $this->data->examcode;
				$exam->timemodified = time();
				$exam->usermodified = $USER->id;
				$DB->update_record('exam', $exam);
			}
		}
	   	
	   	$subjectcodearr = explode(',', $this->data->subjectcode);
	   	$subjectnamearr = explode(',', $this->data->subjectname);
	   	
	   	foreach ($subjectcodearr as $key => $subjectcode) {
	    	$subjectid = $DB->get_field('exam_subject', 'id', ['code' => $subjectcode]);
	    	if(!$subjectid) {
				// if($DB->record_exists('exam_subject', ['code' => $this->data->subjectcode])) {
				// 	$this->resp->er ror = true;
				// 	$this->resp->message['info'] = "Mã môn thi đã tồn tại";
				// 	return $response->withStatus(200)->withJson($this->resp);
				// }
	    		$subject = new stdClass;
		    	$subject->name = $subjectnamearr[$key];
		    	$subject->code = $subjectcode;
		    	$subject->shortname = $subjectnamearr[$key];
		    	$subject->timecreated = time();
		    	$subject->timemodified = time();
		    	$subject->usercreate = $USER->id;
		    	$subject->usermodified = $USER->id;
		    	$subject->visible = 1;
		    	$subject->description = '';
		    	$subjectid = $DB->insert_record('exam_subject', $subject);
	    	} else {
 	    		$subject = new stdClass;
	    		$subject->id = $subjectid;
		    	$subject->name = $subjectnamearr[$key];
		    	$subject->code = $subjectcode;
		    	$subject->shortname = $subjectnamearr[$key];
		    	$subject->timemodified = time();
		    	$subject->usermodified = $USER->id;
		    	$DB->update_record('exam_subject', $subject);
	    	}
	    	if($subjectid) {
		    	// Tạo đề thi cho môn thi
				$quiz = new stdClass;
				$quiz->name = $this->data->examname . '_' . $subjectnamearr[$key];
				$quiz->code = $this->data->examcode . '_' . $subjectcode;
				$quiz->modulename = 'quiz';
				$quiz->course = $SITE->id;
				$quiz->grade = 10;
				$quiz->sectionname = '';
				$quiz->section = 1;
				$quiz->visible = 1;
				$quiz->quizpassword  = '';
				$quiz->introeditor = ['text' => '', 'format' => '1', 'itemid' => '0'];
				$quiz->timeclose = $this->data->quizclose;
				$quiz->timeopen = $this->data->quizopen;
				$quiz->shuffleanswers = 1;
				$quiz->decimalpoints  = 2;
				$quiz->grademethod  = 1;
				$quiz->timelimit = 0;
				$quiz->cmidnumber = '';
				$quiz->graceperiod = 0;
				$quiz->questiondecimalpoints  = -1;
				$quiz->preferredbehaviour = 'deferredfeedback';
				$quiz->overduehandling = 'autosubmit';
				$quiz->completion = 2;
				$quiz->completionusegrade = 1;
				$quiz->attempts = 1;
				if ($DB->record_exists('quiz', ['code' => $quiz->code, 'course' => $SITE->id])) {
					$quizid = $DB->get_field('quiz', 'id', ['course' => $SITE->id, 'code' => $quiz->code]);
					$cm = get_coursemodule_from_instance('quiz', $quizid);
					$quiz->coursemodule = $cm->id;
					$modulequiz = update_module($quiz);
				} else {
					$quiz->cmidnumber = '';
					$modulequiz = create_module($quiz);
				}
				if($modulequiz) {
					$subjectexamid = $DB->get_field('exam_subject_exam', 'id', ['examid' => $examid, 'subjectid' => $subjectid]);
					if(!$subjectexamid) {
						$subjectexam = new stdClass;
						$subjectexam->examid = $examid;
						$subjectexam->subjectid = $subjectid;
						$subjectexam->timecreated = time();
						$subjectexam->timemodified = time();
						$subjectexam->usercreate = $USER->id;
						$subjectexam->usermodified = $USER->id;
						$subjectexamid = $DB->insert_record('exam_subject_exam', $subjectexam);	
					} else {
						$subjectexam = new stdClass;
						$subjectexam->id = $subjectexamid;
						$subjectexam->examid = $examid;
						$subjectexam->subjectid = $subjectid;
						$subjectexam->timemodified = time();
						$subjectexam->usermodified = $USER->id;
						$DB->update_record('exam_subject_exam', $subjectexam);	

					}
					
					$quizexamid = $DB->get_field('exam_quiz', 'id', ['coursemoduleid' => $modulequiz->coursemodule, 'subjectexamid' => $subjectexamid ]);
					if(!$quizexamid) {
						$quizexam = new stdClass;
						$quizexam->coursemoduleid = $modulequiz->coursemodule;
						$quizexam->subjectexamid = $subjectexamid;
						$quizexam->timecreated = time();
						$quizexam->timemodified = time();
						$quizexam->usercreate = $USER->id;
						$quizexam->usermodified = $USER->id;
						$quizexamid = $DB->insert_record('exam_quiz', $quizexam);	
					} else {
						$quizexam = new stdClass;
						$quizexam->id = $quizexamid;
						$quizexam->coursemoduleid = $modulequiz->coursemodule;
						$quizexam->subjectexamid = $subjectexamid;
						$quizexam->timemodified = time();
						$quizexam->usermodified = $USER->id;
						$DB->update_record('exam_quiz', $quizexam);	
					}

					if($this->data->studentcode) {
						$studentcodearr = explode(',', $this->data->studentcode);
						foreach ($studentcodearr as $key => $studentcode) {
							$userid = $DB->get_field('user', 'id', ['usercode' => $studentcode]);
							if($userid) {
								$examuser = new stdClass;
								$examuser->examid = $examid;
								$examuser->userid = $userid;
								$examuser->enrolmethod = 'manual';
								$examuser->roleid = 5;
								$examuser->timecreated = time();
								$examuser->timemodified = time();
								$examuser->usercreate = $USER->id;
								$examuser->usermodified = $USER->id;
								$DB->insert_record('exam_user', $examuser);	
							}
						}
					}
					if($this->data->teachercode) {
						$teachercodearr = explode(',', $this->data->teachercode);
						foreach ($studentcodearr as $key => $studentcode) {
							$userid = $DB->get_field('user', 'id', ['usercode' => $this->data->teachercode]);
							if($userid) {
								$examuser = new stdClass;
								$examuser->examid = $examid;
								$examuser->userid = $userid;
								$examuser->enrolmethod = 'manual';
								$examuser->roleid = 4;
								$examuser->timecreated = time();
								$examuser->timemodified = time();
								$examuser->usercreate = $USER->id;
								$examuser->usermodified = $USER->id;
								$DB->insert_record('exam_user', $examuser);	
							}
						}
					}
				}
	    	}
	   	}
	   	$this->resp->error = false;
		$this->resp->message['info'] = "Thêm mới hoặc chỉnh sửa thành công";
		return $response->withStatus(200)->withJson($this->resp);	
		
	}

	public function enrol_exam_user($request, $response, $args) {
		global $DB, $USER;
		$this->validate = $this->validator->validate($this->request, [
			'examcode' => $this->v::notEmpty()->notBlank()
        ]);

		if($this->validate->isValid()) {
			$this->data->examcode = $request->getParam('examcode');
			$this->data->studentcode = $request->getParam('studentcode');
			$this->data->teachercode = $request->getParam('teachercode');
			if(!$this->data->studentcode && !$this->data->teachercode) {
				$this->resp->data[] = 'Phải truyền 1 trong 2 là mã giáo viên hoặc mã học viên';
				return $response->withStatus(422)->withJson($this->resp);
			}
		} else {
			$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
		}

		$exam = $DB->get_field('exam', 'id', ['code' => $this->data->examcode]);
		if($exam) {
			if($this->data->studentcode) {
				$userid = $DB->get_field('user', 'id', ['usercode' => $this->data->studentcode]);
				if($userid) {
					$examuser = new stdClass;
					$examuser->examid = $exam;
					$examuser->userid = $userid;
					$examuser->enrolmethod = 'manual';
					$examuser->roleid = 5;
					$examuser->timecreated = time();
					$examuser->timemodified = time();
					$examuser->usercreate = $USER->id;
					$examuser->usermodified = $USER->id;
					$DB->insert_record('exam_user', $examuser);	
				}
			}
			if($this->data->teachercode) {
				$userid = $DB->get_field('user', 'id', ['usercode' => $this->data->teachercode]);
				if($userid) {
					$examuser = new stdClass;
					$examuser->examid = $exam;
					$examuser->userid = $userid;
					$examuser->enrolmethod = 'manual';
					$examuser->roleid = 4;
					$examuser->timecreated = time();
					$examuser->timemodified = time();
					$examuser->usercreate = $USER->id;
					$examuser->usermodified = $USER->id;
					$DB->insert_record('exam_user', $examuser);	
				}
			}
			$this->resp->error = false;
			$this->resp->message['info'] = "Thêm giáo viên hoặc học viên vào kỳ thi thành công!";
		} else {
			$this->resp->error = true;
			$this->resp->message['info'] = "Không tìm thấy kỳ thi";
		}
		
		return $response->withStatus(200)->withJson($this->resp);
	}
	
	public function unenrol_exam_user($request, $response, $args) {
		global $DB, $USER;
		$this->validate = $this->validator->validate($this->request, [
			'examid' => $this->v::notEmpty()->notBlank()
        ]);

		if($this->validate->isValid()) {
			$this->data->examid = $request->getParam('examid');
			$this->data->studentcode = $request->getParam('studentcode');
			$this->data->teachercode = $request->getParam('teachercode');
			if(!$this->data->studentcode && !$this->data->teachercode) {
				$this->resp->data[] = 'Phải truyền 1 trong 2 là mã giáo viên hoặc mã học viên';
				return $response->withStatus(422)->withJson($this->resp);
			}
		} else {
			$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
		}
		
		if($this->data->studentcode) {
			$userid = $DB->get_field('user', 'id', ['usercode' => $this->data->studentcode]);
			if($DB->record_exists('exam_user', ['examid' => $this->data->examid, 'userid' => $userid])) {
				$DB->delete_record('exam_user', ['examid' => $this->data->examid, 'userid' => $userid]);
			}
		}
		if($this->data->teachercode) {
			$userid = $DB->get_field('user', 'id', ['usercode' => $this->data->teachercode]);
			if($DB->record_exists('exam_user', ['examid' => $this->data->examid, 'userid' => $userid])) {
				$DB->delete_record('exam_user', ['examid' => $this->data->examid, 'userid' => $userid]);
			}
		}

		$this->resp->error = false;
		$this->resp->message['info'] = "Xóa giáo viên hoặc học viên khỏi kỳ thi thành công!";

		return $response->withStatus(200)->withJson($this->resp);
	}

	// public function exam_score($request, $response, $args) {
	// 	global $DB;
	// 	$this->validate = $this->validator->validate($this->request, [
	// 		'quizcode' => $this->v::notEmpty()->notBlank(),
	// 		'subjectcode' => $this->v::notEmpty()->notBlank(),
	// 		'examname' => $this->v::notEmpty()->notBlank(),
	// 		'examcode' => $this->v::notEmpty()->notBlank(),
	// 		'studentcode' => $this->v::notEmpty()->notBlank(),
	// 		'examscore' => $this->v::notEmpty()->notBlank()
	// 	]);
	// 	if ($this->validate->isValid()) {
	// 		$this->data->quizcode = $request->getParam('quizcode');
	// 		$this->data->subjectcode = $request->getParam('subjectcode');
	// 		$this->data->examname = $request->getParam('examname');
	// 		$this->data->examcode = $request->getParam('examcode');
	// 		$this->data->studentcode = $request->getParam('studentcode');
	// 		$this->data->examscore = $request->getParam('examscore');
	// 	} else {
	// 		$errors = $this->validate->getErrors();
	// 		$this->resp->error = true;
	// 		$this->resp->data[] = $errors;
	// 		return $response->withStatus(422)->withJson($this->resp);
	// 	}

	// 	$exam = $DB->get_field('exam', 'id', ['exam' => $this->data->examcode]);

	// 	if($exam) {
	// 		$quiz = $DB->get_field('quiz', 'id',['code' => $this->data->quizcode]);
	// 		if($quiz) {
	// 			$subject = $DB->get_field('quiz', 'id',['code' => $this->data->quizcode]);
	// 		} else {
	// 			$this->resp->error = true;
	// 			$this->resp->message['info'] = 'Không tìm thấy đề thi';
	// 		}
	// 	} else {
	// 		$this->resp->error = true;
	// 		$this->resp->message['info'] = 'Không tìm thấy kỳ thi';
	// 	}

	
	// 	$this->resp->error = false;
	// 	$this->resp->message['info'] = get_string('delete_success', 'local_newsvnr');

	// 	return $response->withStatus(200)->withJson($this->resp);
	// }

	public function delete($request, $response, $args) {
		global $DB;
		$this->validate = $this->validator->validate($this->request, [
            'examid' => $this->v::notEmpty()->notBlank()
        ]);
        if ($this->validate->isValid()) {
			$this->data->examid = $request->getParam('examid');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }

	    $examid = $this->data->examid;

	    $DB->delete_records('exam_user', ['examid' => $examid]);
		$examsubjectexamid = $DB->get_field_sql('SELECT TOP 1 examid FROM {exam_subject_exam}', ['examid' => $examid]);
		$DB->delete_records('exam_quiz', ['subjectexamid' => $examsubjectexamid]);
		$DB->delete_records('exam_subject_exam', ['examid' => $examid]);
    	$DB->delete_records('exam', ['id' => $examid]);

    	$this->resp->error = false;
		$this->resp->message['info'] = get_string('delete_success', 'local_newsvnr');
	    
	    return $response->withStatus(200)->withJson($this->resp);
	}
}