<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;
use stdClass;

class TokenController extends BaseController {

	private $table = 'orgstructure';

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
            'categoryname' => $this->v::notEmpty()->notBlank(),
            'parentcode' => $this->v::notEmpty()->notBlank(),
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
		    $this->data->categoryname = $request->getParam('categoryname');
		    $this->data->parentcode = $request->getParam('parentcode');
		    $this->data->description = $request->getParam('description');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
        $check_orgstructure_by_code = find_orgstructure_by_code($this->data->code);
		if($check_orgstructure_by_code) {
			$this->resp->error = true;
			$this->resp->data['code'] = "Mã phòng ban '$check_orgstructure_by_code' đã tồn tại";

		}
		$orgstructureTypeData = find_orgstructure_category_by_name($categoryname);
		if(!$orgstructureTypeData) {
			$categoryname = $this->data->categoryname;
			$this->resp->error = true;
			$this->resp->data['categoryname'] = "Loại phòng ban '$categoryname' không tồn tại" ;
		}
		// check xem co phong ban cha hop le k?
		$parentData = find_orgstructure_parrentcode($parentcode);
		if(!$parentData) {
			$parentcode = $this->data->parentcode;
			$this->resp->error = true;
			$this->resp->data['parentcode'] = "Phòng ban cha '$parentcode' không tồn tại" ;
		}
		if(empty($this->resp->data)) {
			// phong ban lon nhat mac dinh parentid = 0
			if($this->data->code == $this->data->parentcode)
				$this->data->parentid = 0
			else
				$this->data->parentid = $parentData->id;

			$this->data->orgstructuretypeid = $orgstructureTypeData->id;
			$this->data->numbermargin = 0;
			$this->data->numbercurrent = 0;
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
			$this->resp->message['info'] = "Thêm thất bại";
		}
		
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function update($request, $response, $args) {
		global $DB;

		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->name = $request->getParam('name');
		    $this->data->code = $request->getParam('code');
		    $this->data->categoryname = $request->getParam('categoryname');
		    $this->data->parentcode = $request->getParam('parentcode');
		    $this->data->description = $request->getParam('description');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
       
		$orgstructureid = $request->getAttribute('id');
		$check_orgstructureid = $DB->get_record($this->table, ['id' => $orgstructureid], '*');
		if($check_orgstructureid) {
			if($check_orgstructureid->name == $this->data->name || $check_orgstructureid->code == $this->data->code) {
				if(empty($this->resp->data)) {
					$this->data->id = $orgstructureid;
					$success = $DB->update_record($this->table, $this->data);
					if($success) {
						$this->resp->error = false;
						$this->resp->message['info'] = "Chỉnh sửa thành công";
						$this->resp->data[] = $this->data;
					}
					else {
						$this->resp->error = true;
						$this->resp->data->message['info'] = "Chỉnh sửa thất bại";
					}
				} else {
					$this->resp->error = true;
				}
			} else {
				$this->resp->error = true;
				$this->resp->data->message['info'] = "Chỉnh sửa thất bại";	
			}
		} else {
			$this->resp->error = true;
			$this->resp->message['info'] = "Chỉnh sửa thất bại";
			$this->resp->data['id'] = "Không tìm thấy phòng ban với id '$orgstructureid'";
		}
		
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function delete() {

	}
}