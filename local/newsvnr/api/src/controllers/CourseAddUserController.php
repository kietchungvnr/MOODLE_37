<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;

use stdClass;
use context_system;
use core_competency\api as api;
use core_competency\competency;

class CourseAddUserController extends BaseController {

	private $student = 'student';
	private $teacher = 'editingteacher';
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

	/**
	 * API tạo user và thêm user vào khóa học (Phân hệ tuyển dụng) - Pharse 1
	*/
	public function create_and_enroll_user_interview($request, $response, $args) {
		global $DB, $CFG;
		require_once __DiR__ . '/../../../lib.php';
		require_once("$CFG->dirroot/user/lib.php");
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'fullname' => $this->v::notEmpty()->notBlank(),
            'email' => $this->v::notEmpty()->notBlank(),
            'orgpositioncode' => $this->v::notEmpty()->notBlank(),
            // 'password' => $this->v::notEmpty()->notBlank()->noWhitespace()
            // 'orgstructurecode' => $this->v::notEmpty()->notBlank(),
        ]);
      	if ($this->validate->isValid()) {
	    	$this->data->usercode = $request->getParam('usercode');
	    	$this->data->code = $request->getParam('coursecode');
		    $this->data->orgpositioncode = $request->getParam('orgpositioncode');
		    $this->data->orgjobtitlecode = $request->getParam('orgjobtitlecode');
		    $this->data->orgstructurecode = $request->getParam('orgpositioncode');
		    $this->data->teacherloginname = $request->getParam('teacherloginname');
		    $this->data->fullname = $request->getParam('fullname');
		    $this->data->email = $request->getParam('email');
		    $this->data->userlogin = $request->getParam('userlogin');
		    $this->data->password = $request->getParam('password');
		    // $this->data->phone1 = $request->getParam('phone1');
		    // $this->data->phone2 = $request->getParam('phone2');
		    // $this->data->identitycard = $request->getParam('identitycard');
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
			if($DB->record_exists('user', ['username' => $this->data->userlogin])) {
				$this->resp->error = true;
				$this->resp->data['userlogin'] = "userlogin đã tồn tại!";
			} else {
				$userlogin = $this->data->userlogin;	
			}
		}
		switch (true) {
			case isset($this->data->code):
				$courseid = $DB->get_field('course', 'id', ['code' => $this->data->code]);
				if(!$courseid) {
					$this->resp->error = true;
					$this->resp->data['coursecode'] = "coursecode(Mã khoá học) không tồn tại khoá học";
				}
				break;
			case !isset($this->data->orgpositioncode, $this->data->orgjobtitlecode, $this->data->orgstructurecode):
				$this->resp->error = true;
				$this->resp->data['missingparameter'] = "Thiếu phòng ban, chức danh hoặc chức vụ (Phải có cả 3 params PB - CD - CV)";
				break;
			case isset($this->data->orgpositioncode, $this->data->orgjobtitlecode, $this->data->orgstructurecode):
				$orgpositioncode = find_id_orgpostion_by_code($this->data->orgpositioncode);
				$orgstructurecode = find_id_orgstructure_by_code($this->data->orgstructurecode);
				$orgjobtitlecode = find_id_orgjobtitle_by_code($this->data->orgjobtitlecode);
				if(!$orgpositioncode) {
					$this->resp->data['orgpositioncode'] = "orgpositioncode(Mã chức vụ) không tồn tại chức vụ";
				}
				if(!$orgstructurecode) {
					$this->resp->data['orgstructurecode'] = "orgstructurecode(Mã phòng ban) không tồn tại phòng ban";
				}
				if(!$orgjobtitlecode) {
					$this->resp->data['orgjobtitlecode'] = "orgjobtitlecode(Mã chức danh) không tồn tại chức danh";
				}
				if(empty($this->resp->data)) {
					$courseid = $DB->get_field('course_position', 'course', ['courseofposition' => $orgjobtitlecode, 'courseofjobtitle' => $orgjobtitlecode, 'courseoforgstructure' => $orgstructurecode]);
					if(!$courseid) {
						$this->resp->error = true;
						$this->resp->data['notfound'] = "Không tìm thấy mã khoá học theo phòng ban, chức danh, chức vụ";
					}
				} else {
					$this->resp->error = true;
				}
				break;
				
			default:
				$this->resp->error = true;
				$this->resp->data['missingparameter'] = 'Phải 1 trong 2 mã là mã khoá học hoặc mã phòng ban, chức danh, chức vụ. Lưu ý: Nếu lấy khoá học theo phòng ban, chức danh, chức vụ thì phải đầy đủ cả 3 PB - CD - CV';
				break;
		}
		$check_usercode = find_usercode_by_code($this->data->usercode);
		$get_orgpositionid = get_orgpositionid_by_code($this->data->orgpositioncode);
		if(!$get_orgpositionid) {
			$this->resp->error = true;
			$this->resp->data['orgpositioncode'] = "orgpositioncode(Mã chức vụ) không tồn tại";
		}
		if(!$check_usercode) {
			$email = $this->data->email;
			if (!validate_email($email)) {
				$this->resp->error = true;
				$this->resp->data['email'] = "email '$email' không đúng định dạng";
			} else if (empty($CFG->allowaccountssameemail) and $DB->record_exists('user', array('email' => $email))) {
				$this->resp->error = true;
				$this->resp->data['email'] = "email '$email' đã tồn tại";
			}
			if($DB->record_exists('user', ['usercode' => $this->data->usercode])) {
				$this->resp->error = true;
				$this->resp->data['usercode'] = "usercode(Mã nhân viên) đã tồn tại";
			}
		}

		if(empty($this->resp->data)) {
		   	if(!$check_usercode) {	
				$usernew = new stdClass();
				$usernew->course = 1;
				$usernew->username = strtolower($userlogin);
				$usernew->usercode = $this->data->usercode;
				$usernew->orgpositionid = $get_orgpositionid;
				$usernew->auth = 'manual';
				$usernew->suspended = '0';
				$usernew->password = hash_internal_user_password($this->data->password);
				$usernew->preference_auth_forcepasswordchange = 0;
				$usernew->mnethostid = $CFG->mnet_localhost_id;
				$usernew->confirmed= 1;
				$usernew->firstname = $firstname;
				$usernew->lastname = $lastname;
				$usernew->email = $this->data->email;
				$usernew->maildisplay = 2;
				$usernew->country = 'VN';
				$usernew->lang = 'vi';
				
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
					$this->resp->error = true;
					$this->resp->data['coursecode'] = "Không tìm thấy khóa học với mã khoá học hoặc phòng ban, chức danh, chức vụ";
				}
			} else {
				if($courseid) {
	
				    $user_in_course = check_user_in_course($courseid,$check_usercode);

				    if(!$user_in_course) {
				    	$this->enrol_user($check_usercode, $courseid, 'student');
				    	$this->resp->error = false;
						$this->resp->message['info'] = "Thêm thành công thêm user vào khóa học";
						$this->resp->data[] = $usernew;
				    } else {
				    	$this->resp->error = false;
				    	$this->resp->message['info'] = "User '$userlogin' đã tham gia vào khóa";
				    }
				} else {
					$this->resp->error = true;
					$this->resp->data['coursecode'] = "Không tìm thấy khóa học với mã khoá học hoặc phòng ban, chức danh, chức vụ";
				}
			}
		} else {
			$this->resp->error = true;
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	/**
	 * API thêm user vào khóa học (Phân hệ đào tạo) - Pharse 1
	*/
	public function enroll_user_training($request, $response, $args) {
		global $DB, $CFG;
		require_once("$CFG->dirroot/user/lib.php");

		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'fullname' => $this->v::notEmpty()->notBlank(),
            'email' => $this->v::notEmpty()->notBlank(),
            // 'coursecode' => $this->v::notEmpty()->notBlank(),
            // 'password' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'orgpositioncode' => $this->v::notEmpty()->notBlank(),
        ]);
      	if ($this->validate->isValid()) {
	    	$this->data->usercode = $request->getParam('usercode');
	    	$this->data->fullname = $request->getParam('fullname');
		    $this->data->email = $request->getParam('email');
		    $this->data->userlogin = $request->getParam('userlogin');
		    $this->data->code = $request->getParam('coursecode');
		    $this->data->orgpositioncode = $request->getParam('orgpositioncode');
		    $this->data->orgjobtitlecode = $request->getParam('orgjobtitlecode');
		    $this->data->orgstructurecode = $request->getParam('orgstructurecode');
		    $this->data->password = $request->getParam('password');
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
			$firstname = $fullname;
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
			if($DB->record_exists('user', ['username' => $this->data->userlogin])) {
				$this->resp->error = true;
				$this->resp->data['userlogin'] = "userlogin đã tồn tại!";
			} else {
				$userlogin = $this->data->userlogin;	
			}
		}
		
		switch (true) {
			case isset($this->data->code):
				$courseid = $DB->get_field('course', 'id', ['code' => $this->data->code]);
				if(!$courseid) {
					$this->resp->error = true;
					$this->resp->data['coursecode'] = "coursecode(Mã khoá học) không tồn tại khoá học";
				}
				break;
			case !isset($this->data->orgpositioncode, $this->data->orgjobtitlecode, $this->data->orgstructurecode):
				$this->resp->error = true;
				$this->resp->data['missingparameter'] = "Thiếu phòng ban, chức danh hoặc chức vụ (Phải có cả 3 params PB - CD - CV)";
				break;
			case isset($this->data->orgpositioncode, $this->data->orgjobtitlecode, $this->data->orgstructurecode):
				$orgpositioncode = find_id_orgpostion_by_code($this->data->orgpositioncode);
				$orgstructurecode = find_id_orgstructure_by_code($this->data->orgstructurecode);
				$orgjobtitlecode = find_id_orgjobtitle_by_code($this->data->orgjobtitlecode);
				if(!$orgpositioncode) {
					$this->resp->data['orgpositioncode'] = "orgpositioncode(Mã chức vụ) không tồn tại chức vụ";
				}
				if(!$orgstructurecode) {
					$this->resp->data['orgstructurecode'] = "orgstructurecode(Mã phòng ban) không tồn tại phòng ban";
				}
				if(!$orgjobtitlecode) {
					$this->resp->data['orgjobtitlecode'] = "orgjobtitlecode(Mã chức danh) không tồn tại chức danh";
				}
				if(empty($this->resp->data)) {
					$courseid = $DB->get_field('course_position', 'course', ['courseofposition' => $orgjobtitlecode, 'courseofjobtitle' => $orgjobtitlecode, 'courseoforgstructure' => $orgstructurecode]);
					if(!$courseid) {
						$this->resp->error = true;
						$this->resp->data['notfound'] = "Không tìm thấy mã khoá học theo phòng ban, chức danh, chức vụ";
					}
				} else {
					$this->resp->error = true;
				}
				break;
				
			default:
				$this->resp->error = true;
				$this->resp->data['missingparameter'] = 'Phải 1 trong 2 mã là mã khoá học hoặc mã phòng ban, chức danh, chức vụ. Lưu ý: Nếu lấy khoá học theo phòng ban, chức danh, chức vụ thì phải đầy đủ cả 3 PB - CD - CV';
				break;
		}
		$check_usercode = find_usercode_by_code($this->data->usercode);
		$get_orgpositionid = get_orgpositionid_by_code($this->data->orgpositioncode);
		if(!$get_orgpositionid) {
			$this->resp->error = true;
			$this->resp->data['orgpositioncode'] = "orgpositioncode(Mã chức vụ) không tồn tại";
		}
		if(!$check_usercode) {
			$email = $this->data->email;
			if (!validate_email($email)) {
				$this->resp->error = true;
				$this->resp->data['email'] = "email '$email' không đúng định dạng";
			} else if (empty($CFG->allowaccountssameemail) and $DB->record_exists('user', array('email' => $email))) {
				$this->resp->error = true;
				$this->resp->data['email'] = "email '$email' đã tồn tại";
			}
			if($DB->record_exists('user', ['usercode' => $this->data->usercode])) {
				$this->resp->error = true;
				$this->resp->data['usercode'] = "usercode(Mã nhân viên) đã tồn tại";
			}
		}
		
		if(empty($this->resp->data)) {
			$usernew = new stdClass();
			$usernew->course = 1;
			$usernew->username = strtolower($userlogin);
			$usernew->usercode = $this->data->usercode;
			$usernew->orgpositionid = $get_orgpositionid;
			$usernew->auth = 'manual';
			$usernew->suspended = '0';
			$usernew->password = hash_internal_user_password($this->data->password);
			$usernew->preference_auth_forcepasswordchange = 0;
			$usernew->mnethostid = $CFG->mnet_localhost_id;
			$usernew->confirmed= 1;
			$usernew->firstname = $firstname;
			$usernew->lastname = $lastname;
			$usernew->email = $this->data->email;
			$usernew->maildisplay = 2;
			$usernew->country = 'VN';
			$usernew->lang = 'vi';
			// $createpassword = true;
			if(!$check_usercode) {	
				if($courseid) {
				    $usernew->id = user_create_user($usernew,false,false);
				    $usernew = $DB->get_record('user', array('id' => $usernew->id));
				    $user_in_course = check_user_in_course($courseid,$usernew->id);
				    if(!$user_in_course) {
				    	$this->enrol_user($usernew->id, $courseid, 'student');
				    	$this->resp->error = false;
						$this->resp->message['info'] = "Thêm thành công và tạo mới user '$userlogin'";
						$this->resp->data[] = $usernew;
				    }

				    // $usercontext = context_user::instance($usernew->id);
				    
				    // if ($createpassword) {
				    // 	setnew_password_and_mail($usernew);
				    // 	unset_user_preference('create_password', $usernew);
				    // 	set_user_preference('auth_forcepasswordchange', 1, $usernew);
				    // }
				    \core\event\user_created::create_from_userid($usernew->id)->trigger();

				} else {
					$this->resp->error = true;
					$this->resp->data['coursecode'] = "Không tìm thấy khóa học với mã khoá học hoặc phòng ban, chức danh, chức vụ";
				}
				
			} else {
				if($courseid) {
	
				    $user_in_course = check_user_in_course($courseid,$check_usercode);

				    if(!$user_in_course) {
				    	$this->enrol_user($check_usercode, $courseid, 'student');
				    	$this->resp->error = false;
						$this->resp->message['info'] = "Thêm thành công thêm user vào khóa học";
						$this->resp->data[] = $usernew;
				    } else {
				    	$this->resp->error = false;
				    	$this->resp->message['info'] = "User '$userlognin' đã tham gia vào khóa";
				    }
				} else {
					$this->resp->error = true;
					$this->resp->data['coursecode'] = "Không tìm thấy khóa học với mã khoá học hoặc phòng ban, chức danh, chức vụ";
				}
			}
		} else {
			$this->resp->error = true;
		}
		return $response->withStatus(200)->withJson($this->resp);	
		
	}
	/**
	 * Add học viên vào khoá
	 * @param  [type]  $userid            [description]
	 * @param  [type]  $courseid          [description]
	 * @param  [type]  $roleidorshortname [description]
	 * @param  string  $enrol             [description]
	 * @param  integer $timestart         [description]
	 * @param  integer $timeend           [description]
	 * @param  [type]  $status            [description]
	 * @return [type]                     [description]
	 */
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
	/**
	 * API add học viên vào khoá - Pharse 2
	 * @param [type] $request           [description]
	 * @param [type] $response          [description]
	 * @param [type] $args              [description]
	 * @param [type] $roleidorshortname [description]
	 */
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
			$this->data->code = $request->getParam('coursecode');
		} else {
			$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
		}
		if($this->data->usercode) {
			$userid = find_usercode_by_code($this->data->usercode);
			$usercode = $this->data->usercode;
			$coursecode = $this->data->code;
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
					$this->resp->data['code'] = "Không tìm thấy khoá học với mã '$coursecode'";
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
	/**
	 * API rút tên học viên khỏi khoá học phân hệ đào tạo - Pharse 1
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $args     [description]
	 * @return [type]           [description]
	 */
	public function delete_enroll_course($request, $response, $args) {
		global $DB,$CFG;
		global $DB,$CFG;
		require_once($CFG->dirroot . '/enrol/locallib.php');
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            // 'orgpositioncode' => $this->v::notEmpty()->notBlank(),
            // 'orgjobtitlecode' => $this->v::notEmpty()->notBlank(),
            // 'orgstructurecode' => $this->v::notEmpty()->notBlank(),
        ]);

		if($this->validate->isValid()) {
			$this->data->usercode = $request->getParam('usercode');
			$this->data->orgpositioncode = $request->getParam('orgpositioncode');
			$this->data->orgjobtitlecode = $request->getParam('orgjobtitlecode');
			$this->data->orgstructurecode = $request->getParam('orgstructurecode');
			$this->data->code = $request->getParam('coursecode');
		} else {
			$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
		}
		
		if(empty($this->data->code)) {
			$check_orgpositioncode = find_id_orgpostion_by_code($this->data->orgpositioncode);
			$check_orgstructurecode = find_id_orgstructure_by_code($this->data->orgstructurecode);
			$check_orgjobtitlecode = find_id_orgjobtitle_by_code($this->data->orgjobtitlecode);
			if(!$check_orgpositioncode) {
				$this->resp->error = true;
				$this->resp->data['orgpositioncode'] = "orgpositioncode(Mã chức vụ) không tồn tại chức vụ";
			}
			if(!$check_orgstructurecode) {
				$this->resp->error = true;
				$this->resp->data['orgstructurecode'] = "orgstructurecode(Mã phòng ban) không tồn tại phòng ban";
			}
			if(!$check_orgjobtitlecode) {
				$this->resp->error = true;
				$this->resp->data['orgjobtitlecode'] = "orgjobtitlecode(Mã chức danh) không tồn tại chức danh";
			}
		} else {
			$courseid = $DB->get_field('course', 'id', ['code' => $this->data->code]);
			if(!$courseid) {
				$this->resp->error = true;
				$this->resp->data['code'] = "coursecode(Mã khoá học) không tồn tại khoá học";
			}
		}
		
		if(!$DB->record_exists('user',['usercode' => $this->data->usercode])) {
			$this->resp->error = true;
			$this->resp->data['usercode'] = "usercode(Mã học viên) không tồn tại";
		}

		if(empty($this->resp->data)) {
			$usercode = $this->data->usercode;
			if(empty($this->data->code)) {
				$course = get_course_by_orgpositioncode($check_orgpositioncode->id,$check_orgjobtitlecode->id,$check_orgstructurecode->id,2);
			} else {
				$course = $DB->get_record('course', ['code' => $this->data->code]);
			}
			
			if(!$course) {
				$this->resp->message['info'] = "Ứng viên với mã '$usercode' chưa tham gia khóa học";
			} else {
				$get_userid = find_usercode_by_code($usercode);
				if($get_userid) {
					$instance = $DB->get_record('enrol', array('courseid'=>$course->id, 'enrol'=>'manual'), '*', MUST_EXIST);
					$get_ueid = find_ueid_by_enrolid($instance->id,$get_userid->id);
					$plugin = enrol_get_plugin($instance->enrol);
					$plugin->unenrol_user($instance, $get_ueid->userid);
					$this->resp->message['info'] = "Rút ứng viên với mã '$usercode' từ khóa '$course->fullname' thành công";
				}
			}
				
		}
	}
	/**
	 * API rút tên học viên khỏi khoá học phân hệ tuyển dụng - Pharse 1
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $args     [description]
	 * @return [type]           [description]
	 */
	public function delete_recruitment($request, $response, $args) {
		global $DB,$CFG;
		require_once($CFG->dirroot . '/enrol/locallib.php');
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            // 'orgpositioncode' => $this->v::notEmpty()->notBlank(),
            // 'orgjobtitlecode' => $this->v::notEmpty()->notBlank(),
            // 'orgstructurecode' => $this->v::notEmpty()->notBlank(),
        ]);

		if($this->validate->isValid()) {
			$this->data->usercode = $request->getParam('usercode');
			$this->data->orgpositioncode = $request->getParam('orgpositioncode');
			$this->data->orgjobtitlecode = $request->getParam('orgjobtitlecode');
			$this->data->orgstructurecode = $request->getParam('orgstructurecode');
			$this->data->code = $request->getParam('coursecode');
		} else {
			$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
		}
		
		if(empty($this->data->code)) {
			$check_orgpositioncode = find_id_orgpostion_by_code($this->data->orgpositioncode);
			$check_orgstructurecode = find_id_orgstructure_by_code($this->data->orgstructurecode);
			$check_orgjobtitlecode = find_id_orgjobtitle_by_code($this->data->orgjobtitlecode);
			if(!$check_orgpositioncode) {
				$this->resp->error = true;
				$this->resp->data['orgpositioncode'] = "orgpositioncode(Mã chức vụ) không tồn tại chức vụ";
			}
			if(!$check_orgstructurecode) {
				$this->resp->error = true;
				$this->resp->data['orgstructurecode'] = "orgstructurecode(Mã phòng ban) không tồn tại phòng ban";
			}
			if(!$check_orgjobtitlecode) {
				$this->resp->error = true;
				$this->resp->data['orgjobtitlecode'] = "orgjobtitlecode(Mã chức danh) không tồn tại chức danh";
			}
		} else {
			$courseid = $DB->get_field('course', 'id', ['code' => $this->data->code]);
			if(!$courseid) {
				$this->resp->error = true;
				$this->resp->data['code'] = "coursecode(Mã khoá học) không tồn tại khoá học";
			}
		}
		
		if(!$DB->record_exists('user',['usercode' => $this->data->usercode])) {
			$this->resp->error = true;
			$this->resp->data['usercode'] = "usercode(Mã học viên) không tồn tại";
		}

		if(empty($this->resp->data)) {
			$usercode = $this->data->usercode;
			if(empty($this->data->code)) {
				$course = get_course_by_orgpositioncode($check_orgpositioncode->id,$check_orgjobtitlecode->id,$check_orgstructurecode->id,1);
			} else {
				$course = $DB->get_record('course', ['code' => $this->data->code]);
			}
			
			if(!$course) {
				$this->resp->message['info'] = "Ứng viên với mã '$usercode' chưa tham gia khóa học";
			} else {
				$get_userid = find_usercode_by_code($usercode);
				if($get_userid) {
					$instance = $DB->get_record('enrol', array('courseid'=>$course->id, 'enrol'=>'manual'), '*', MUST_EXIST);
					$get_ueid = find_ueid_by_enrolid($instance->id,$get_userid->id);
					$plugin = enrol_get_plugin($instance->enrol);
					$plugin->unenrol_user($instance, $get_ueid->userid);
					$this->resp->message['info'] = "Rút ứng viên với mã '$usercode' từ khóa '$course->fullname' thành công";
				}
			}
				
		}
		return $response->withStatus(200)->withJson($this->resp);
	}
	
}