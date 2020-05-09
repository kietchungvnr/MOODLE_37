<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;
use stdClass;
use core_course_category;

class CourseCategoryController extends BaseController {

	private $table = 'course_categories';

	public $id;
	public $name;
	public $code;
	public $parentname;
	public $description;
	public $check_code;
	public $check_parentname;
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
            'code' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'name' => $this->v::notEmpty()->notBlank(),
            /*'parentname' => $this->v::notEmpty()->notBlank(),*/
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
		    $this->data->idnumber = $request->getParam('code');
		    $this->data->parent = $request->getParam('parentname');
		    $this->data->description = $request->getParam('description');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
		

		if (!empty($this->data->idnumber)) {
            $this->check_code = $DB->get_record($this->table,['idnumber' => $this->data->idnumber], 'idnumber');
			if($this->check_code) {
				$check_code = $this->check_code->idnumber;
				$this->resp->data['code'] = "Mã danh mục khoá '$check_code' đã tồn tại";
			}
        }

		if($this->data->parent == '') {
			$this->data->parent = 0;
		} else {
			$this->check_parentname = $DB->get_field($this->table,'id',['name' => $this->data->parent]);
			if($this->check_parentname) {
				$this->data->parent = $this->check_parentname;
			} else {
				$check_parentname = $this->data->parent;
				$this->resp->data['parentname'] = "Tên danh mục khoá cha '$check_parentname' không tồn tại";
			}
		}

		if(empty($this->resp->data)) {
			$success = core_course_category::create($this->data);
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
		    $this->data->idnumber = $request->getParam('code');
		    $this->data->parent = $request->getParam('parentname');
		    $this->data->description = $request->getParam('description');
	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }

		$coursecategoryid = $request->getAttribute('id');
		if($coursecategoryid) {
			$coursecat = core_course_category::get($coursecategoryid, MUST_EXIST, true);
			if (!empty($this->data->idnumber) && $coursecat->idnumber !== $this->data->idnumber ) {
	            $this->check_code = $DB->get_record($this->table,['idnumber' => $this->data->idnumber], 'idnumber');
				if($this->check_code) {
					$check_code = $this->check_code->idnumber;
					$this->resp->data['code'] = "Mã danh mục khoá '$check_code' đã tồn tại";
				}
	        }
			

			if($this->data->parent == '') {
				$this->data->parent = 0;
			} else {
				$this->check_parentname = $DB->get_field($this->table,'id',['name' => $this->data->parent]);
				if($this->check_parentname) {
					$this->data->parent = $this->check_parentname;
				} else {
					$check_parentname = $this->data->parent;
					$this->resp->data['parentname'] = "Tên danh mục khoá cha '$check_parentname' không tồn tại";
				}
			}

			
			if(empty($this->resp->data)) {
				
				if (isset($coursecat)) {
			        if ((int)$this->data->parent !== (int)$coursecat->parent && !$coursecat->can_change_parent($this->data->parent)) {
			            print_error('cannotmovecategory');
			        }
			        $coursecat->update($this->data);
			        $this->resp->error = false;
					$this->resp->message['info'] = "Chỉnh sửa thành công";
					$this->resp->data[] = $this->data;
			    } else {
					$this->resp->error = true;
					$this->resp->data->message['info'] = "Thêm thất bại";
				}
			} else {
				$this->resp->error = true;
			}
		} else {
			$this->resp->data->message['id'] = "Không tìm thấy danh mục khoá với id '$coursecategoryid'";
			
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function delete() {

	}
}