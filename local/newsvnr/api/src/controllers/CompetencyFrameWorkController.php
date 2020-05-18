<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;

use stdClass;
use context_system;
use core_competency\api as api;
use core_competency\competency_framework;
use core_competency\competency;
class CompetencyFrameWorkController extends BaseController {

	private $table = 'competency_framework';

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
            // 'competencyname' => $this->v::notEmpty()->notBlank(),
            // 'competencycode' => $this->v::notEmpty()->notBlank(),
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
		    // $this->data->parentid = 0;
		    //không cần truyền parent 
		    //$this->data->parentname = $request->getParam('parentname');
		    //$this->data->parentcode = $request->getParam('parentcode');
		    // $this->data->competencyname = $request->getParam('competencyname');
		    // $this->data->competencycode = $request->getParam('competencycode');
		    $this->data->description = $request->getParam('description');

	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
	    if($this->data->name and $this->data->code) {
	    	$data = new stdClass;
			$data->shortname = $this->data->name;
            $data->idnumber = $this->data->code;
            $data->description = $this->data->description;
            $data->descriptionformat = FORMAT_HTML;
            $data->visible = true;
            $data->contextid = context_system::instance()->id;
            $data->scaleid = 2;
	        $data->taxonomies = 'competency,competency,competency,competency';
	        $data->usermodified = $USER->id;
	        if (!isset($data->scaleconfiguration)) {
	            $data->scaleconfiguration = '[{"scaleid":"2"},{"id":2,"scaledefault":1,"proficient":1}]';
	        }
	        
	    	$frameworkid = $DB->get_field('competency_framework','id',['shortname' => $this->data->name, 'idnumber' => $this->data->code]);
		    if($frameworkid) {
		    	try {
		    		$data->id = $frameworkid;
	       			$framework = api::update_framework($data);
		       		if($framework) {
				   		$this->resp->error = false;
						$this->resp->message['info'] = "Chỉnh sửa thành công";
						$this->resp->data[] = $data;
				   	} else {
				   		$this->resp->error = true;
						$this->resp->message['info'] = "Chỉnh sửa thất bại";
				   	}
		       	} catch (Exception $e) {
		       		$this->resp->data[] = "Lỗi: $e->getMessage()";
		       	}
		       	
		    } else {
		    	try {
		    		if($DB->record_exists($this->table, ['idnumber' => $this->data->code])) {
			        	$this->resp->data['idnumber'] = 'Mã khung năng lực đã tồn tại';
			        }
		    		if(empty($this->resp->data)) {
		    			$framework = api::create_framework($data);
			       		if($framework) {
					   		$this->resp->error = false;
							$this->resp->message['info'] = "Thêm thành công";
							$this->resp->data[] = $data;
					   	} else {
					   		$this->resp->error = true;
							$this->resp->message['info'] = "Thêm thất bại";
					   	}
					} 
		       	} catch (Exception $e) {
		       		$this->resp->data[] = "Lỗi: $e->getMessage()";
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