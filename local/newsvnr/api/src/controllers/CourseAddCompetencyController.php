<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;

use stdClass;
use context_system;
use core_competency\api as api;
use core_competency\competency;

class CourseAddCompetencyController extends BaseController {

	private $table = 'competency_coursecomp';

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
            'coursecode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'competencyname' => $this->v::notEmpty()->notBlank(),
            'competencycode' => $this->v::notEmpty()->notBlank(),
            // 'ruleoutcome' => $this->v::notEmpty()->notBlank(),
        ]);
    }

   	public function read() {

	}

	public function read_single() {

	}

	public function create($request, $response, $args) {
		global $DB, $USER;

		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->coursecode = $request->getParam('coursecode');
		    $this->data->competencyname = $request->getParam('competencyname');
		    $this->data->competencycode = $request->getParam('competencycode');
		    $this->data->ruleoutcome = $request->getParam('ruleoutcome');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
	    if($this->data->coursecode) {
	    	$existing = $DB->get_field('course','id',['shortname' => $this->data->coursecode]);
	    	if($existing) {
	    		$this->data->courseid = $existing;
	    	} else {
	    		$coursecode = $this->data->coursecode;
	    		$this->resp->data['coursecode'] = "Không tím thấy khoá học '$coursecode' trong danh sách khoá học";
	    	}
	    }
		if($this->data->competencyname and $this->data->competencycode) {
			$existing = $DB->get_field('competency','id',['shortname' => $this->data->competencyname, 'idnumber' => $this->data->competencycode]);
			if($existing) {
				$this->data->competencyid = $existing;
			} else {
				$competencyname = $this->data->competencyname;
				$this->resp->data['competency'] = "Không tìm thấy năng lực '$competencyname' trong danh sách năng lực ";
			}
		} elseif($this->data->competencyname or $this->data->competencycode) {
			$this->resp->data['competency'] = "Thiếu 'competencyname' hoặc 'competencycode";
		} 

		if(empty($this->resp->data)) {
        	
		   	$coursecomp = api::add_competency_to_course($this->data->courseid, $this->data->competencyid);

		   	if($coursecomp) {
		   		$this->resp->error = false;
				$this->resp->message['info'] = "Thêm thành công";
				$this->resp->data[] = $this->data;
		   	} else {
		   		$competencyname = $this->data->competencyname;
		   		$this->resp->error = true;
				$this->resp->message['info'] = "Năng lực '$competencyname' đã được thêm vào khoá học";
		   	}
		} else {
			$this->resp->error = true;
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function update($request, $response, $args) {
	
	}

	public function delete() {

	}
}