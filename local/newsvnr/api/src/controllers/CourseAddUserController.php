<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;

use stdClass;
use context_system;
use core_competency\api as api;
use core_competency\competency;

class CourseAddUserController extends BaseController {

	private $table = 'competency_position';
	private $student = 'student';
	private $teacher = 'editingteacher';
	public $check_code;
	public $data;
	public $resp;

	public function __construct($container) {
		global $USER, $CFG;
		parent::__construct($container);
		if(isloggedin()) {
            $CFG->sessiontimeout += 7200;
        } else {
            $adminuser = get_complete_user_data('id', 2);
            complete_user_login($adminuser);
        }
   		$this->data = new stdClass;
   		$this->resp = new stdClass;
   		
   	}

   	public function validate() {
        //Khai báo  rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'fullname' => $this->v::notEmpty()->notBlank(),
            'email' => $this->v::notEmpty()->notBlank(),
            'coursecode' => $this->v::notEmpty()->notBlank(),
            // 'orgpositioncode' => $this->v::notEmpty()->notBlank(),
        ]);
    }

   	public function read() {

	}

	public function read_single() {

	}

	public function create_and_enroll_user($request, $response, $args) {
		global $DB;
		require_once __DiR__ . '/../../../lib.php';
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'fullname' => $this->v::notEmpty()->notBlank(),
            'email' => $this->v::notEmpty()->notBlank(),
            'orgpositioncode' => $this->v::notEmpty()->notBlank(),
            'orgjobtitlecode' => $this->v::notEmpty()->notBlank(),
            'orgstructurecode' => $this->v::notEmpty()->notBlank(),
        ]);
      	if ($this->validate->isValid()) {
	    	$this->data->usercode = $request->getParam('usercode');
	    	$this->data->coursecode = $request->getParam('coursecode');
		    $this->data->orgpositioncode = $request->getParam('orgpositioncode');
		    $this->data->orgjobtitlecode = $request->getParam('orgjobtitlecode');
		    $this->data->orgstructurecode = $request->getParam('orgpositioncode');
		    $this->data->teacherloginname = $request->getParam('teacherloginname');
		    $this->data->fullname = $request->getParam('fullname');
		    $this->data->email = $request->getParam('email');
		    $this->data->userlogin = $request->getParam('userlogin');
		    $this->data->phone1 = $request->getParam('phone1');
		    $this->data->phone2 = $request->getParam('phone2');
		    $this->data->identitycard = $request->getParam('identitycard');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }

	    $parts = explode(" ", $this->data->fullname);
		if(count($parts) > 1) {
			$lastname = array_pop($parts);
			$firstname = implode(" ", $parts);
		}
		else
		{
			$firstname = $this->data->fullname;
			$lastname = " ";
		}
		$fullname_user = preg_replace('/\s+/', '', $this->data->fullname);
		$fullname_tolower = mb_strtolower($fullname_user, 'UTF-8');
		$fullname_without_tone = convert_name($fullname_tolower);

		if(empty($this->data->userlogin)) {
			$userlogin = $fullname_without_tone;
			$userlognin_user = find_username($fullname_without_tone);
			if($userlognin_user) {
				$time = time();
				$userlogin = $fullname_without_tone . $time;
			}
		} else {
			$userlogin = $this->data->userlogin;
		}
		$check_orgpositioncode = find_id_orgpostion_by_code($this->data->orgpositioncode);
		$check_orgstructurecode = find_id_orgstructure_by_code($this->data->orgstructurecode);
		$check_orgjobtitlecode = find_id_orgjobtitle_by_code($this->data->orgjobtitlecode);
		if(!$check_orgpositioncode) {
			$this->resp->error = true;
			$this->resp->data['orgpositioncode'] = "orgpositioncode(Mã chức vụ) không tồn tại chức vụ ".$this->orgpositioncode;
		}
		if(!$check_orgstructurecode) {
			$this->resp->error = true;
			$this->resp->data['orgstructurecode'] = "orgstructurecode(Mã phòng ban) không tồn tại phòng ban ".$this->orgstructurecode;
		}
		if(!$check_orgjobtitlecode) {
			$this->resp->error = true;
			$this->resp->data['orgjobtitlecode'] = "orgjobtitlecode(Mã chức vụ) không tồn tại chức danh ".$this->orgjobtitlecode;
		}
		$email = $this->data->email;
		if (!validate_email($email)) {
			$this->resp->error = true;
			$this->resp->data['email'] = "email '$email' không đúng định dạng";
		} else if (empty($CFG->allowaccountssameemail) and $DB->record_exists('user', array('email' => $email))) {
			$this->resp->error = true;
			$this->resp->data['email'] = "email '$email' đã được sử dụng vui lòng chọn email khác";
		}

		if(empty($this->resp->data)) {
			$check_usercode = find_usercode_by_code($this->data->usercode);
		   	if(!$check_usercode) {	
				$usernew = new stdClass();
				$usernew->username = $userlogin;
				$usernew->usercode = $this->data->usercode;
				$usernew->orgpositionid = $check_orgpositioncode->id;
				$usernew->mnethostid = $CFG->mnet_localhost_id;
				$usernew->confirmed= 1;
				$usernew->password = hash_internal_user_password('Vnr@1234');
				$usernew->firstname = $firstname;
				$usernew->lastname = $lastname;
				$usernew->email = $this->data->email;
				$usernew->identitycard = $this->data->identitycard;
				$usernew->phone1 = $this->data->phone1;
				$usernew->phone2 = $this->data->phone2;
				$usernew->country = 'VN';
				$usernew->lang = 'vi';
				if($this->data->coursecode) {
					$data = $DB->get_record('course',['code' => $this->data->coursecode]);
					if($data)
						$courseid = $data->id;
				} else {
					$data = get_course_by_orgpositioncode($this->data->check_orgpositioncode->id,$this->data->check_orgjobtitlecode->id,$this->data->check_orgstructurecode->id,1);
					if($data)
						$courseid = $course_for_orgpositioncode->id;
				}
				if($courseid) {
					$userlogin_teacher = find_username($this->data->teacherloginname);
					if($userlogin_teacher) {
						$teacherid = $userlogin_teacher->id;
						$teacher_name = check_teacher_in_course($courseid,$teacherid);

						if(!$teacher_name) {
							enrol_user($teacherid, $courseid, 'editingteacher');
						} 
					}

					$usernew->id = user_create_user($usernew,false,false);

					$user_in_course = check_user_in_course($courseid,$usernew->id);
					if(!$user_in_course) {
						enrol_user($usernew->id, $courseid, 'student');
						$this->resp->error = false;
						$this->resp->message['info'] = "Thêm thành công";
						$this->resp->data[] = $usernew;
					}

					\core\event\user_created::create_from_userid($usernew->id)->trigger();
					
				} else {
					$orgjobtitlecode = $this->data->orgjobtitlecode;
					$orgjobtitlecode = $this->data->orgjobtitlecode;
					$orgstructurecode = $this->data->orgstructurecode;
					$coursecode = $this->data->coursecode;
					$this->resp->error = true;
					$this->resp->error['course'] = "Không tìm thấy khóa học phù hợp với 'vị trí - $orgpositioncode , chức danh - $orgjobtitlecode , phòng ban - $orgstructurecode' và mã khoá học '$coursecode'";
				}
			} else {
				$this->resp->error = true;
				$this->reps->data['usercode'] = "usercode(Mã ứng viên) '".$this->data->usercode."' đã tồn tại";
			}
		} else {
			$this->resp->error = true;
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function enrol_user($userid, $courseid, $roleidorshortname = null, $enrol = 'manual',
    $timestart = 0, $timeend = 0, $status = null) {
    global $DB;
        // If role is specified by shortname, convert it into an id.
    if (!is_numeric($roleidorshortname) && is_string($roleidorshortname)) {
        $roleid = $DB->get_field('role', 'id', array('shortname' => $roleidorshortname), MUST_EXIST);
    } else {
        $roleid = $roleidorshortname;
    }
    if (!$plugin = enrol_get_plugin($enrol)) {
        return false;
    }
    $instances = $DB->get_records('enrol', array('courseid'=>$courseid, 'enrol'=>$enrol));
    if (count($instances) != 1) {
        return false;
    }
    $instance = reset($instances);
    if (is_null($roleid) and $instance->roleid) {
        $roleid = $instance->roleid;
    }
    $plugin->enrol_user($instance, $userid, $roleid, $timestart, $timeend, $status);
    return true;
}

	public function add($request, $response, $args, $roleidorshortname) {
		global $DB, $CFG;
		require_once("$CFG->dirroot/user/lib.php");
		require_once("$CFG->dirroot/local/newsvnr/lib.php");
		
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'coursecode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
        ]);

		if($this->validate->isValid()) {
			$this->data->usercode = $request->getParam('usercode');
			$this->data->coursecode = $request->getParam('coursecode');
		} else {
			$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
		}
		if($this->data->usercode) {
			$userid = find_usercode_by_code($this->data->usercode);
			$usercode = $this->data->usercode;
			$coursecode = $this->data->coursecode;
			if($userid) {
				$courseid = $DB->get_field('course', 'id', ['shortname' => $coursecode]);
				if($courseid) {
					$user_in_course = check_user_in_course($courseid,$userid->id);

					if(!$user_in_course) {
						enrol_user($userid->id, $courseid, $roleidorshortname);
						$this->resp->error = false;
						if($roleidorshortname == 'student')
							$this->resp->message['info'] = "Thêm thành công mã nhân viên'$usercode' vào mã lớp '$coursecode'";
						else
							$this->resp->message['info'] = "Thêm thành công giáo viên với mã '$usercode' vào mã lớp '$coursecode'";
						$this->resp->data[] = $this->data;
					} else {
						$this->resp->error = false;
						if($roleidorshortname == 'student')
							$this->resp->message['info'] = "Mã nhân viên '$usercode' đã tồn tại trong mã lớp '$coursecode'";
						else
							$this->resp->message['info'] = "Mã nhân viên '$usercode' với vai trò giáo viên đã tồn tại trong mã lớp '$coursecode'";
					} 
				}
				else {
					$this->resp->error = true;
					$this->resp->data['coursecode'] = "Không tìm thấy khoá học với mã '$coursecode'";
				}
			} else {
				$this->resp->error = true;
				$this->resp->data['usercode'] = "Không tìm thấy học viên với mã nhân viên '$usercode'";
			}
		}
		return $response->withStatus(200)->withJson($this->resp);
	}

	public function add_student($request, $response, $args) {
		return $this->add($request, $response, $args, $this->student);
	}
	public function add_teacher($request, $response, $args) {
		return $this->add($request, $response, $args, $this->teacher);
	}

	

	public function update($request, $response, $args) {
	
	}

	public function delete() {

	}
}