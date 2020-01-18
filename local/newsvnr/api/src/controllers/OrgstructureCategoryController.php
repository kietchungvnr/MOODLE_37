<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;
use stdClass;

class OrgstructureCategoryController extends BaseController {

	private $table = 'orgstructure_category';

	public $id;
	public $name;
	public $code;
	public $description;
	public $check_categoryname;
	public $check_categorycode;
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
        $this->check_categoryname =  find_orgstructure_category_by_name($this->data->name);
		if($this->check_categoryname) {
			$this->resp->data['name'] = "Tên loại phòng ban '$this->check_categoryname' đã tồn tại";
		}
		$this->check_categorycode = find_orgstructure_category_by_code($this->data->code);
		if($this->check_categorycode) {
			$check_categorycode = $this->check_categorycode->code;
			$this->resp->data['code'] = "Mã loại phòng ban '$check_categorycode' đã tồn tại";
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
  //       $this->check_categoryname =  find_orgstructure_category_by_name($this->data->name);
		// if($this->check_categoryname) {
		// 	$this->resp->data['name'] = "Tên loại phòng ban '$this->check_categoryname' đã tồn tại";
		// }
		// $this->check_categorycode = find_orgstructure_category_by_code($this->data->code);
		// if($this->check_categorycode) {
		// 	$check_categorycode = $this->check_categorycode->code;
		// 	$this->resp->data['code'] = "Mã loại phòng ban '$check_categorycode' đã tồn tại";
		// }
		$orgcategoryid = $request->getAttribute('id');
		$check_orgcategoryid = $DB->get_record($this->table, ['id' => $orgcategoryid], '*');
		if($check_orgcategoryid) {
			if($check_orgcategoryid->name == $this->data->name || $check_orgcategoryid->code == $this->data->code) {
				if(empty($this->resp->data)) {
					$this->data->id = $orgcategoryid;
					$success = $DB->update_record($this->table, $this->data);
					if($success) {
						$this->resp->error = false;
						$this->resp->message['info'] = "Chỉnh sửa thành công";
						$this->resp->data[] = $this->data;
					}
					else {
						$this->resp->error = true;
						$this->resp->data->message['info'] = "Thêm thất bại";
					}
				} else {
					$this->resp->error = true;
				}
			} else {
				$this->resp->error = true;
				$this->resp->data->message['info'] = "Thêm thất bại";	
			}
		} else {
			$this->resp->data->message['id'] = "Không tìm thấy loại phòng ban với id '$orgcategoryid'";
			
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}


	public function delete() {

	}
}