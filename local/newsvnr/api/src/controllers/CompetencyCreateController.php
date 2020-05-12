<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;

use stdClass;
use context_system;
use core_competency\api as api;
use core_competency\competency_framework;
use core_competency\competency;
class CompetencyCreateController extends BaseController {

	private $table = 'competency';

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
            'code' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'name' => $this->v::notEmpty()->notBlank(),
            // 'parentname' => $this->v::notEmpty()->notBlank(),
            // 'parentcode' => $this->v::notEmpty()->notBlank(),
            'frameworkname' => $this->v::notEmpty()->notBlank(),
            'frameworkcode' => $this->v::notEmpty()->notBlank(),
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
	    	$this->data->name = $request->getParam('name'); //tên khung năng lực
		    $this->data->code = $request->getParam('code'); // mã khung năng lực
		    $this->data->parentid = 0;
		    //không cần truyền parent 
		    //$this->data->parentname = $request->getParam('parentname');
		    //$this->data->parentcode = $request->getParam('parentcode');
		    $this->data->frameworkname = $request->getParam('frameworkname');
		    $this->data->frameworkcode = $request->getParam('frameworkcode');
		    $this->data->description = $request->getParam('description');

	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }

		$frameworkid = $DB->get_field('competency_framework', 'id', ['shortname' => $this->data->frameworkname, 'idnumber' => $this->data->frameworkcode]);
		$competencyid = $DB->get_field('competency', 'id', ['competencyframeworkid' => $frameworkid, 'idnumber' => $this->data->code]); 
		if(!$frameworkid) {
			$this->resp->data['frameworkname'] = "Tên khung năng lực không tồn tại";
		}
		
		if(empty($this->resp->data)) {
			$data = new stdClass;
        	$data->shortname = $this->data->name;
        	$data->idnumber = $this->data->code;
        	$data->description = $this->data->description;
        	$data->parentid = $this->data->parentid;
        	$data->descriptionformat = FORMAT_HTML;
    		$data->competencyframeworkid = $frameworkid;
			if($competencyid) {
				$data->id = $competencyid;
	        	$competency = api::update_competency($data);
			   	if($competency) {
			   		$this->resp->error = false;
					$this->resp->message['info'] = "Chỉnh sửa thành công";
					$this->resp->data[] = $data;
			   	} else {
			   		$this->resp->error = true;
					$this->resp->message['info'] = "Chỉnh sửa thất bại";
			   	}
			} else {
				$sql = 'idnumber = :idnumber AND competencyframeworkid = :competencyframeworkid';
		        $params = array(
		            'idnumber' => $this->data->code,
		            'competencyframeworkid' => $frameworkid
		        );
		        if ($DB->record_exists_select($this->table, $sql, $params)) {
		        	$code = $this->data->code;
		        	$this->resp->error = true;
		            $this->resp->data['code'] = "Mã năng lực '$code' đã tồn tại";
		        }
		        if(empty($this->resp->data)) {
		        	$competency = api::create_competency($data);
				   	if($competency) {
				   		$this->resp->error = false;
						$this->resp->message['info'] = "Thêm thành công";
						$this->resp->data[] = $data;
				   	} else {
				   		$this->resp->error = true;
						$this->resp->message['info'] = "Thêm thất bại";
				   	}
			     } 
			}
		} else {
			$this->resp->error = true;
			$this->resp->message['info'] = "Thêm/Chỉnh sửa thất bại";
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function update($request, $response, $args) {
		
	}

	public function delete() {

	}
}