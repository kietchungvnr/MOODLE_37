<?php 

namespace local_newsvnr\api\controllers\hrm;

use stdClass;
use local_newsvnr\api\controllers\BaseController as BaseController;

defined('MOODLE_INTERNAL') || die;

class OrgstructurePositionController extends BaseController {

	private $table = 'orgstructure_position';

	
	public $data;
	public $resp;

	public function __construct($container) {
		parent::__construct($container);
   		$this->data = new stdClass;
   		$this->resp = new stdClass;
   		
   	}

   	public function validate() {
        //Khai báo new rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'code' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'name' => $this->v::notEmpty()->notBlank(),
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
	    	$this->data->name = $request->getParam('name');
		    $this->data->code = $request->getParam('code');
		    $this->data->jobtitlecode = $request->getParam('jobtitlecode');
		    $this->data->orgstructurecode = $request->getParam('orgstructurecode');
		    $this->data->description = $request->getParam('description');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
	    $check_orgstructure_jobtitle = find_orgstructure_jobtitle_by_code($this->data->jobtitlecode);
			$check_orgstructure = find_orgstructure_by_code($this->data->orgstructurecode);
		$check_orgstructure_position = find_orgstructure_position_by_code($this->data->code);
		if($check_orgstructure_position) {
			$check_orgstructure_position = $check_orgstructure_position->code;
			$this->resp->error = true;
			$this->resp->data['code'] = "Mã loại phòng ban '$check_orgstructure_position' đã tồn tại";
		}
		if(empty($this->resp->data)) {
			$this->data->jobtitleid = $check_orgstructure_jobtitle->id;
			$this->data->orgstructureid = $check_orgstructure->id;
			$success = $DB->insert_record($this->table, $this->data);
			if($success) {
				$this->resp->error = false;
				$this->resp->message['info'] = "Thêm thành công";
				$this->resp->data[] = $this->data;
			}
			else {
				$this->resp->error = true;
				$this->resp->message['info'] = "Thêm thất bại";
			}
		} else {
			$this->resp->error = true;
		}
		
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function update($request, $response, $args) {
		global $DB;
		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->name = $request->getParam('name');
		    $this->data->code = $request->getParam('code');
		    $this->data->description = $request->getParam('description');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
  
		$orgpositionid = $request->getAttribute('id');
		$check_orgpositionid = $DB->get_record($this->table, ['id' => $orgpositionid], '*');
		if($check_orgpositionid) {
			if($check_orgpositionid->name == $this->data->name || $check_orgpositionid->code == $this->data->code) {
				if(empty($this->resp->data)) {
					$this->data->id = $orgpositionid;
					$success = $DB->update_record($this->table, $this->data);
					if($success) {
						$this->resp->error = false;
						$this->resp->message['info'] = "Chỉnh sửa thành công";
						$this->resp->data[] = $this->data;
					}
					else {
						$this->resp->error = true;
						$this->resp->message['info'] = "Chỉnh sửa thất bại";
					}
				} else {
					$this->resp->error = true;
				}
			} else {
				$this->resp->error = true;
				$this->resp->message['info'] = "Chỉnh sửa thất bại";	
			}
		} else {
			$this->resp->error = true;
			$this->resp->message['info'] = "Chỉnh sửa thất bại";
			$this->resp->data['id'] = "Không tìm thấy chức danh với id '$orgpositionid'";
			
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}


	public function delete() {

	}
}