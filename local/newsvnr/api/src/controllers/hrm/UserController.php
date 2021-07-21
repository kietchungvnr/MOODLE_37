<?php 

namespace local_newsvnr\api\controllers\hrm;

use stdClass;
use context_system;
use local_newsvnr\api\controllers\BaseController as BaseController;
use core_competency\api as api;
use core_competency\competency;

defined('MOODLE_INTERNAL') || die;

class UserController extends BaseController {

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

	public function create_and_update($request, $response, $args) {
		global $DB, $CFG;
		require_once __DiR__ . '/../../../../lib.php';
		require_once("$CFG->dirroot/user/lib.php");
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'userlogin' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'fullname' => $this->v::notEmpty()->notBlank(),
        ]);
      	if ($this->validate->isValid()) {
	    	$this->data->usercode = $request->getParam('usercode');
		    $this->data->orgpositioncode = $request->getParam('orgpositioncode');
		    $this->data->orgjobtitlecode = $request->getParam('orgjobtitlecode');
		    $this->data->orgstructurecode = $request->getParam('orgpositioncode');
		    $this->data->fullname = $request->getParam('fullname');
		    $this->data->email = $request->getParam('email');
		    $this->data->userlogin = $request->getParam('userlogin');
		    if($request->getParam('password'))
		    	$this->data->password = $request->getParam('password');
		    else
		    	$this->data->password = '123';
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
		$check_usercode = find_usercode_by_code($this->data->usercode);
		$get_orgpositionid = get_orgpositionid_by_code($this->data->orgpositioncode);
		if(!empty($this->data->orgpositioncode)) {
			if(!$get_orgpositionid) {
				$this->resp->error = true;
				$this->resp->data['orgpositioncode'] = "orgpositioncode(Mã chức vụ) không tồn tại";
			}
		}
		
		if(!$check_usercode) {
			if(isset($this->data->email)) {
				$email = $this->data->email;
			} else {
				$email = $this->data->email = $this->data->userlogin . '@temporary.com';
			}
			if (!validate_email($email)) {
				$this->resp->error = true;
				$this->resp->data['email'] = "email '$email' không đúng định dạng";
			} else if (empty($CFG->allowaccountssameemail) and $DB->record_exists('user', array('email' => $email))) {
				$this->resp->error = true;
				$this->resp->data['email'] = "email '$email' đã tồn tại";
			}
			if($DB->record_exists('user', ['usercode' => $this->data->usercode, 'suspended' => 0])) {
				$this->resp->error = true;
				$this->resp->data['usercode'] = "usercode(Mã nhân viên) đã tồn tại";
			}
			if($DB->record_exists('user', ['username' => $this->data->userlogin])) {
				$this->resp->error = true;
				$this->resp->data['userlogin'] = "userlogin đã tồn tại!";
			}
		} else {
			if(isset($this->data->email)) {
				$email = $this->data->email;
			} else {
				$email = $this->data->email = $this->data->userlogin . '@temporary.com';
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
				$usernew->id = user_create_user($usernew,false);
				\core\event\user_created::create_from_userid($usernew->id)->trigger();

				$this->resp->error = false;
				$this->resp->message['info'] = "Tạo mới user '$userlogin' thành công";
				$this->resp->data[] = $usernew;
			} else {
				$user = $DB->get_record('user', ['id' => $check_usercode]);
				$user->username = strtolower($userlogin);
				$user->usercode = $this->data->usercode;
				$user->orgpositionid = $get_orgpositionid;
				$user->password = hash_internal_user_password($this->data->password);
				$user->firstname = $firstname;
				$user->lastname = $lastname;
				$user->email = $this->data->email;
				user_update_user($user,false);
				\core\event\user_updated::create_from_userid($user->id)->trigger();

				$this->resp->error = false;
				$this->resp->message['info'] = "Cập nhập user '$userlogin' thành công";
				$this->resp->data[] = $user;
			}
		} else {
			$this->resp->error = true;
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	/**
	 * API đình chỉ user(suspended)
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $args     [description]
	 * @return [type]           [description]
	 */
	public function suspended_user($request, $response, $args) {
		global $DB,$CFG;
		require_once($CFG->dirroot . '/enrol/locallib.php');
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
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
		
		$user = $DB->get_record('user',['usercode' => $this->data->usercode]);
		if(!$user) {
			$this->resp->error = true;
			$this->resp->data['usercode'] = "usercode(Mã học viên) không tồn tại";
		}

		if(empty($this->resp->data)) {
			$user->suspended = 1;
			$fullname = fullname($user);
			$DB->update_record('user', $user);
			$this->resp->error = false;
			$this->resp->message['info'] = "Tài khoản '$fullname' đã bị khóa";
		}
		return $response->withStatus(200)->withJson($this->resp);
	}
}