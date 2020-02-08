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
	private $teacher = 'teacher';
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

	// public function create_student($request, $response, $args) {
	// 	global $DB;
	// 	require_once __DiR__ . '/../../../lib.php';
	// 	$this->validate();
 //      	if ($this->validate->isValid()) {
	//     	$this->data->usercode = $request->getParam('usercode');
	// 	    $this->data->fullname = $request->getParam('fullname');
	// 	    $this->data->email = $request->getParam('email');
	// 	    $this->data->coursecode = $request->getParam('coursecode');
	// 	    $this->data->orgpositioncode = $request->getParam('orgpositioncode');
	//     } else {
 //        	$errors = $this->validate->getErrors();
 //        	$this->resp->error = true;
 //        	$this->resp->data[] = $errors;
	//         return $response->withStatus(422)->withJson($this->resp);
	//     }

	//     $parts = explode(" ", $this->data->fullname);
	// 	if(count($parts) > 1) {
	// 		$lastname = array_pop($parts);
	// 		$firstname = implode(" ", $parts);
	// 	}
	// 	else
	// 	{
	// 		$firstname = $this->data->fullname;
	// 		$lastname = " ";
	// 	}
	// 	$fullname_user = preg_replace('/\s+/', '', $this->data->fullname);
	// 	$fullname_tolower = mb_strtolower($fullname_user, 'UTF-8');
	// 	$fullname_without_tone = convert_name($fullname_tolower);

	// 	if(empty($userlogin)) {
	// 		$userlogin = $fullname_without_tone;
	// 		$userlognin_user = find_username($fullname_without_tone);
	// 		if($userlognin_user) {
	// 			$time = time();
	// 			$userlogin = $fullname_without_tone . $time;
	// 		}
	// 	}
	// 	$check_usercode = find_usercode_by_code($this->data->usercode);
	// 	$get_orgpositionid = get_orgpositionid_by_code($this->data->orgpositioncode);
	// 	$get_course = get_course_by_idnumber($this->data->coursecode); 
	// 	if($get_course)
	// 		$courseid = $get_course->id;
	// 	if(!$check_usercode) {
	// 		if (!validate_email($this->data->email)) {
	// 			$this->resp->data['email'] = "email '$email' không đúng định dạng";
	// 		} else if (empty($CFG->allowaccountssameemail) and $DB->record_exists('user', array('email' => $email))) {
	// 			$this->resp->data['email'] = "email '$email' đã được sử dụng vui lòng chọn email khác";
	// 		}
	// 	}

	// 	if(empty($this->resp->data)) {
 //        	$usernew = new stdClass();
	// 		$usernew->course = 1;
	// 		$usernew->username = $userlogin;
	// 		$usernew->usercode = $usercode;
	// 		$usernew->orgpositionid = $get_orgpositionid;
	// 		$usernew->auth = 'manual';
	// 		$usernew->suspended = '0';
	// 		$usernew->password = '';
	// 		$usernew->preference_auth_forcepasswordchange = 0;
	// 		$usernew->mnethostid = $CFG->mnet_localhost_id;
	// 		$usernew->confirmed= 1;
	// 		$usernew->firstname = $firstname;
	// 		$usernew->lastname = $lastname;
	// 		$usernew->email = $email;
	// 		$usernew->maildisplay = 2;
	// 		$usernew->country = 'VN';
	// 		$usernew->lang = 'vi';
	// 		$createpassword = true;
	// 	   	if(!$check_usercode) {	
	// 			if($get_course) {
					
	// 			    $usernew->id = user_create_user($usernew,false,false);
	// 			    $usernew = $DB->get_record('user', array('id' => $usernew->id));
	// 			    $user_in_course = check_user_in_course($courseid,$usernew->id);
	// 			    if(!$user_in_course) {
	// 			    	enrol_user($usernew->id, $courseid, 'student');
	// 					$this->resp->message['info'] = "Thêm thành công và tạo mới user '$fullname'";
	// 					$this->resp->error = false;
	// 					$this->resp->data[] = $usernew;
	// 			    }

	// 			    $usercontext = context_user::instance($usernew->id);
				    
	// 			    if ($createpassword) {
	// 			    	setnew_password_and_mail($usernew);
	// 			    	unset_user_preference('create_password', $usernew);
	// 			    	set_user_preference('auth_forcepasswordchange', 1, $usernew);
	// 			    }
	// 			    \core\event\user_created::create_from_userid($usernew->id)->trigger();

	// 			} else {
	// 				$this->resp->error = true;
	// 				$this->resp->data['coursecode'] = "Không tìm thấy khóa học với mã '$coursecode'";
	// 			}
				
	// 		} else {
	// 			if($get_course) {
	
	// 			    $user_in_course = check_user_in_course($courseid,$check_usercode->id);

	// 			    if(!$user_in_course) {

	// 			    	enrol_user($check_usercode->id, $courseid, 'student');
	// 					$this->resp->message['info'] = "Thêm thành công thêm user vào khóa học '$get_course->fullname'";
	// 					$this->resp->error = false;
	// 					$this->resp->data[] = $usernew;
	// 			    } else {
	// 			    	$this->resp->message['info'] = "User đã tham gia vào khóa '$get_course->fullname'";
	// 			    }
	// 			} else {
	// 				$this->resp->error = true;
	// 				$this->resp->data['coursecode'] = "Không tìm thấy khóa học với mã '$coursecode'";
	// 			}
	// 		}
	// 	} else {
	// 		$this->resp->error = true;
	// 	}
	// 	return $this->response->withStatus(200)->withJson($this->resp);
	// }

	public function create($request, $response, $args, $roleidorshortname) {
		global $DB, $CFG;
		require_once("$CFG->dirroot/user/lib.php");
		
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
			if($userid) {
				$courseid = $DB->get_field('course', 'id', ['shortname' => $this->data->coursecode]);
				if($courseid) {
					$user_in_course = check_user_in_course($courseid,$userid->id);
					if(!$user_in_course) {
						enrol_user($usernew->id, $courseid, $roleidorshortname);
						$this->reps->error = false;
						$this->resp->message['info'] = "Thêm thành công '$roleidorshortname' vào lớp";
						$this->resp->data[] = $this->data;
					} else {
						$this->reps->error = false;
						$this->resp->message['info'] = "Thêm thất bại";
					} 
				}
				else {
					$coursecode = $this->data->coursecode;
					$this->resp->error = true;
					$this->resp->data['coursecode'] = "Không tìm thấy khoá học với mã '$coursecode'";
				}
			} else {
				$usercode = $this->data->usercode;
				$this->resp->error = true;
				$this->resp->data['usercode'] = "Không tìm thấy học viên với mã '$usercode'";
			}
		}
		return $response->withStatus(200)->withJson($this->resp);
	}

	public function create_student($request, $response, $args) {
		$this->create($request, $response, $args, $this->student);
	}
	public function create_teacher($request, $response, $args) {
		$this->create($request, $response, $args, $this->teacher);
	}

	

	public function update($request, $response, $args) {
	
	}

	public function delete() {

	}
}