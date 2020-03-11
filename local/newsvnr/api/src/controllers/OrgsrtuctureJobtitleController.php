<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;
use stdClass;

class OrgstructureJobtitleController extends BaseController {

	private $table = 'orgstructure_jobtitle';

	
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
            'name' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'code' => $this->v::notEmpty()->notBlank(),
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
		    $this->data->description = $request->getParam('description');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
        $check_jobtitlename =  find_orgstructure_jobtitle_by_name($this->data->name);
		if($check_jobtitlename) {
			$this->resp->error = true;
			$this->resp->data['name'] = "Tên loại phòng ban '$check_jobtitlename' đã tồn tại";
		}
		$check_jobtitlecode = find_orgstructure_jobtitle_by_code($this->data->code);
		if($check_jobtitlecode) {
			$check_jobtitlecode = $check_jobtitlecode->code;
			$this->resp->error = true;
			$this->resp->data['code'] = "Mã loại phòng ban '$check_jobtitlecode' đã tồn tại";
		}
		if(empty($this->resp->data)) {
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
  
		$orgjobtitleid = $request->getAttribute('id');
		$check_orgjobtitleid = $DB->get_record($this->table, ['id' => $orgjobtitleid], '*');
		if($check_orgjobtitleid) {
			if($check_orgjobtitleid->name == $this->data->name || $check_orgjobtitleid->code == $this->data->code) {
				if(empty($this->resp->data)) {
					$this->data->id = $orgjobtitleid;
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
			$this->resp->data['id'] = "Không tìm thấy chức danh với id '$orgjobtitleid'";
			
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}


	public function delete() {

	}
}