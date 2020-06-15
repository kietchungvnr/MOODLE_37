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

class UserController extends BaseController {

	private $student = 'student';
	private $teacher = 'editingteacher';
	public $data;
	public $resp;

	public function __construct($container) {
		parent::__construct($container);
   		$this->data = new stdClass;
   		$this->resp = new stdClass;
   		
   	}

   	public function validate() {
        //Khai báo  rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'name' => $this->v::notEmpty()->notBlank(),
            'email' => $this->v::notEmpty()->notBlank(),
            'username' => $this->v::notEmpty()->notBlank(),
            'password' => $this->v::notEmpty()->notBlank(),
        ]);
    }
	
	public function create_and_update($request, $response, $args) {
		global $DB, $CFG;
		

		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->usercode = $request->getParam('usercode');
	    	$this->data->fullname = $request->getParam('name');
		    $this->data->phone = $request->getParam('phone');
		    $this->data->email = $request->getParam('email');
		    $this->data->username = $request->getParam('username');
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
		} else {
			$firstname = $fullname;
			$lastname = " ";
		}
		
		// $email = $this->data->email;
		// if (!validate_email($email)) {
		// 	$this->resp->error = true;
		// 	$this->resp->data['email'] = "email '$email' không đúng định dạng";
		// } else if (empty($CFG->allowaccountssameemail) and $DB->record_exists('user', array('email' => $email))) {
		// 	$this->resp->error = true;
		// 	$this->resp->data['email'] = "email '$email' đã tồn tại";
		// }
		$userid = find_usercode_by_code($this->data->usercode);
		$usernew = new stdClass();
		$usernew->course = 1;
		$usernew->username = trim(strtolower($this->data->username));
		$usernew->usercode = $this->data->usercode;
		$usernew->auth = 'manual';
		$usernew->suspended = '0';
		$usernew->password = hash_internal_user_password($this->data->password);
		$usernew->newpassword = hash_internal_user_password($this->data->password);
		$usernew->preference_auth_forcepasswordchange = 0;
		$usernew->mnethostid = $CFG->mnet_localhost_id;
		$usernew->confirmed= 1;
		$usernew->firstname = $firstname;
		$usernew->lastname = $lastname;
		$usernew->email = $this->data->email;
		$usernew->maildisplay = 2;
		$usernew->country = 'VN';
		$usernew->lang = 'vi';
		if($userid) {
			$usernew->id = $userid;
			$user = $DB->get_record('user', array('id' => $usernew->id));
		} else {
			$user = '';
		}
        
        $err = array();

        if (!$user and !empty($usernew->createpassword)) {
            if ($usernew->suspended) {
                // Show some error because we can not mail suspended users.
                $err['suspended'] = get_string('error');
            }
        } else {
            if (!empty($usernew->newpassword)) {
                $errmsg = ''; // Prevent eclipse warning.
                if (!check_password_policy($usernew->newpassword, $errmsg)) {
                    $err['newpassword'] = $errmsg;
                }
            } else if (!$user) {
                $auth = get_auth_plugin($usernew->auth);
                if ($auth->is_internal()) {
                    // Internal accounts require password!
                    $err['newpassword'] = get_string('required');
                }
            }
        }

        if (empty($usernew->username)) {
            // Might be only whitespace.
            $err['username'] = get_string('required');
        } else if (!$user or $user->username !== $usernew->username) {
            // Check new username does not exist.
            if ($DB->record_exists('user', array('username' => $usernew->username, 'mnethostid' => $CFG->mnet_localhost_id))) {
                $err['username'] = get_string('usernameexists');
            }
            // Check allowed characters.
            if ($usernew->username !== core_text::strtolower($usernew->username)) {
                $err['username'] = get_string('usernamelowercase');
            } else {
                if ($usernew->username !== core_user::clean_field($usernew->username, 'username')) {
                    $err['username'] = get_string('invalidusername');
                }
            }
        }

        if (!$user or (isset($usernew->email) && $user->email !== $usernew->email)) {
            if (!validate_email($usernew->email)) {
                $err['email'] = get_string('invalidemail');
            } else if (empty($CFG->allowaccountssameemail)) {
                // Make a case-insensitive query for the given email address.
                $select = $DB->sql_equal('email', ':email', false) . ' AND mnethostid = :mnethostid';
                $params = array(
                    'email' => $usernew->email,
                    'mnethostid' => $CFG->mnet_localhost_id
                );
                // If there are other user(s) that already have the same email, show an error.
                if ($DB->record_exists_select('user', $select, $params)) {
                    $err['email'] = get_string('emailexists');
                }
            }
        }
        if($err) {
        	$this->resp->error = true;
        	$this->resp->data[] = $err;
        }
		if(!$userid) {
			if(empty($this->resp->data) && empty($err)) {
				$usernew->id = user_create_user($usernew,false,false);
		    	$this->resp->error = false;
				$this->resp->message['info'] = "Tạo mới user thành công";
				$this->resp->data[] = $usernew;
			    \core\event\user_created::create_from_userid($usernew->id)->trigger();
			}
		} else {
			if(empty($this->resp->data) && empty($err)) {
				user_update_user($usernew,false,false);
		    	$this->resp->error = false;
				$this->resp->message['info'] = "Chỉnh sửa user thành công";
				$this->resp->data[] = $usernew;
			    \core\event\user_updated::create_from_userid($usernew->id)->trigger();
			}
		}
		
		return $response->withStatus(200)->withJson($this->resp);	
		
	}
	
	public function delete($request, $response, $args) {
		global $DB;
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace()
        ]);
        if ($this->validate->isValid()) {
			$this->data->user = $request->getParam('user');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
	    $user = $DB->get_record('user', ['usercode' => $this->data->user]);
	    $deleteuser = user_delete_user($user);
	    if($deleteuser) {
	    	$this->resp->error = false;
			$this->resp->message['info'] = "Xóa user thành công";
			$this->resp->data[] = $user;
	    }
	    

	}
}