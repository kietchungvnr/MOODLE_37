<?php 

namespace local_newsvnr\api\controllers\hrm;

use stdClass;
use context_system;
use local_newsvnr\api\controllers\BaseController as BaseController;
use core_competency\api as api;
use core_competency\competency;

defined('MOODLE_INTERNAL') || die;

class CompetencyAddOrgPositionController extends BaseController {

	private $table = 'competency_position';

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
            'orgpositioncode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
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
		global $DB;

		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->orgpositioncode = $request->getParam('orgpositioncode');
		    $this->data->competencyname = $request->getParam('competencyname');
		    $this->data->competencycode = $request->getParam('competencycode');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
	    if($this->data->orgpositioncode) {
	    	$existing = $DB->get_field('orgstructure_position','id',['code' => $this->data->orgpositioncode]);
	    	if($existing) {
	    		$this->data->positionid = $existing;
	    	} else {
	    		$orgpositioncode = $this->data->orgpositioncode;
	    		$this->resp->data['orgpositioncode'] = "Không tím thấy chức vụ '$orgpositioncode' trong danh sách chức vụ";
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

		if(isset($this->data->positionid) and isset($this->data->competencyid)) {
			$existing = $DB->record_exists($this->table, ['competencyid' => $this->data->competencyid, 'positionid' => $this->data->positionid]);
			if($existing) {
				$competencyname = $this->data->competencyname;
				$orgpositioncode = $this->data->orgpositioncode;
				$this->resp->data['competency'] = "Năng lực '$competencyname' đã tồn tại trong vị trí '$orgpositioncode'";
			}
		}

		if(empty($this->resp->data)) {
        	$this->data->timecreate = time();
        	$this->data->timemodified = time();
		   	$data = $DB->insert_record($this->table, $this->data);

		   	if($data) {
		   		$this->resp->error = false;
				$this->resp->message['info'] = "Thêm thành công";
				$this->resp->data[] = $this->data;
		   	} else {
		   		$competencyname = $this->data->competencyname;
		   		$this->resp->error = true;
				$this->resp->message['info'] = "Năng lực '$competencyname' đã được thêm vào vị trí";
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