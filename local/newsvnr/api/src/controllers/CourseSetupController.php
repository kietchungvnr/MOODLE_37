<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;
use stdClass;
use core_course_category;

class CourseSetupController extends BaseController {

	private $table = 'course_setup';

	public $id;
	public $name;
	public $code;
	public $parentname;
	public $parentid;
	public $check_code;
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
            'parentname' => $this->v::notEmpty()->notBlank(),
            'parentid' => $this->v::notEmpty()->notBlank(),
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
	    	$this->data->fullname = $request->getParam('name');
		    $this->data->shortname = $request->getParam('code');
		    $this->data->parentname = $request->getParam('parentname');
		    $this->data->parentid = $request->getParam('parentid');
		    $this->data->description = $request->getParam('description');

	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
		$coursesetupid = $DB->get_field('course_setup', 'id',['fullname' => $this->data->fullname, 'shortname' => $this->data->shortname]);
		if($coursesetupid) {
			$this->data->id = $coursesetupid;
			$coursesetup = $DB->get_record($this->table, ['id' => $coursesetupid]);
			if (!empty($this->data->shortname) && $coursesetup->shortname !== $this->data->shortname ) {
	            $this->check_code = $DB->get_record($this->table,['shortname' => $this->data->shortname], 'shortname');
				if($this->check_code) {
					$check_code = $this->check_code->shortname;
					$this->resp->data['code'] = "Mã khoá setup'$check_code' đã tồn tại";
				}
	        }

	        if($this->data->parentname and $this->data->parentid) {
				$existing = $DB->get_field('course_categories','id',['name' => $this->data->parentname, 'idnumber' => $this->data->parentid]);
				if($existing) {
					$this->data->category = $existing;
				} else {
					$parentname = $this->data->parentname;
					$this->resp->data['parentname'] = "Không tìm thấy tên '$parentname' trong danh mục khoá học ";
				}
			} else {
				$this->resp->data['parent'] = "Thiếu 'parentname' hoặc 'parentid";
			}
			
			
			if(empty($this->resp->data)) {
				unset($this->data->parentid,$this->data->parentname);
				$success = $DB->update_record($this->table, $this->data);
				if($success) {
			        $this->resp->error = false;
					$this->resp->message['info'] = "Chỉnh sửa thành công";
					$this->resp->data[] = $this->data;
			    } else {
					$this->resp->error = true;
					$this->resp->data->message['info'] = "Chỉnh sửa thất bại";
				}
			} else {
				$this->resp->error = true;
			}
		} else {
			if($this->data->parentname and $this->data->parentid) {
				$existing = $DB->get_field('course_categories','id',['name' => $this->data->parentname, 'idnumber' => $this->data->parentid]);
				if($existing) {
					$this->data->category = $existing;
				} else {
					$parentname = $this->data->parentname;
					$this->resp->data['parentname'] = "Không tìm thấy tên '$parentname' trong danh muc khoá học ";
				}
			} else {
				$this->resp->data['parent'] = "Thiếu 'parentname' hoặc 'parentid";
			}

			if (!empty($this->data->shortname)) {
	            $this->check_code = $DB->get_record($this->table,['shortname' => $this->data->shortname], 'shortname');
				if($this->check_code) {
					$check_code = $this->check_code->shortname;
					$this->resp->data['code'] = "Mã khoá setup '$check_code' đã tồn tại";
				}
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
		}
		
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function update($request, $response, $args) {
		global $DB;
		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->fullname = $request->getParam('name');
		    $this->data->shortname = $request->getParam('code');
		    $this->data->parentname = $request->getParam('parentname');
		    $this->data->parentid = $request->getParam('parentid');
		    $this->data->description = $request->getParam('description');

	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }

		$coursesetupid = $request->getAttribute('id');
		if($coursesetupid) {
			$this->data->id = $coursesetupid;
			$coursesetup = $DB->get_record($this->table, ['id' => $coursesetupid]);
			if (!empty($this->data->shortname) && $coursesetup->shortname !== $this->data->shortname ) {
	            $this->check_code = $DB->get_record($this->table,['shortname' => $this->data->shortname], 'shortname');
				if($this->check_code) {
					$check_code = $this->check_code->shortname;
					$this->resp->data['code'] = "Mã khoá setup'$check_code' đã tồn tại";
				}
	        }

	        if($this->data->parentname and $this->data->parentid) {
				$existing = $DB->get_field('course_categories','id',['name' => $this->data->parentname, 'idnumber' => $this->data->parentid]);
				if($existing) {
					$this->data->category = $existing;
				} else {
					$parentname = $this->data->parentname;
					$this->resp->data['parentname'] = "Không tìm thấy tên '$parentname' trong danh mục khoá học ";
				}
			} else {
				$this->resp->data['parent'] = "Thiếu 'parentname' hoặc 'parentid";
			}
			
			
			if(empty($this->resp->data)) {
				unset($this->data->parentid,$this->data->parentname);
				$success = $DB->update_record($this->table, $this->data);
				if($success) {
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
			$this->resp->data->message['id'] = "Không tìm thấy khoá setup với id '$coursecategoryid'";
			
		}
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function delete() {

	}
}