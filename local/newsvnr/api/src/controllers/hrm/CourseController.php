<?php 

namespace local_newsvnr\api\controllers\hrm;

use stdClass;
use local_newsvnr\api\controllers\BaseController as BaseController;

defined('MOODLE_INTERNAL') || die;

class CourseController extends BaseController {

	private $table = 'course';

	public $id;
	public $name;
	public $code;
	public $categoryname;
	public $categorycode;
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
            'categoryname' => $this->v::notEmpty()->notBlank(),
            'categorycode' => $this->v::notEmpty()->notBlank(),
            'setupcode' => $this->v::notEmpty()->notBlank(),
        ]);
    }

   	public function read() {

	}

	public function read_single() {

	}

	public function create($request, $response, $args) {
		global $DB, $CFG;
		require_once("$CFG->dirroot/course/lib.php");
		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->fullname = $request->getParam('name');
		    $this->data->shortname = $request->getParam('code');
		    $this->data->coursesetup = $request->getParam('setupcode');
		    $this->data->categoryname = $request->getParam('categoryname');
		    $this->data->categorycode = $request->getParam('categorycode');
		    $this->data->startdate = $request->getParam('startdate');
		    $this->data->enddate = $request->getParam('enddate');
		    if($request->getParam('startdate') == '') 
		    	$this->data->startdate = time();
		    else
		    	$this->data->startdate = strtotime($request->getParam('startdate'));
		    if($request->getParam('enddate'))
		    	$this->data->enddate = strtotime($request->getParam('enddate'));
		    else 
		    	$this->data->enddate = 0;
		    $this->data->description = $request->getParam('description');

	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
		
		$courseid = $DB->get_field('course', 'id', ['fullname' => $this->data->fullname, 'shortname' => $this->data->shortname]);
		if($courseid) {
			$this->data->id = $courseid;
			$course = $DB->get_record($this->table, ['id' => $courseid]);
			if (!empty($this->data->shortname) && $course->shortname !== $this->data->shortname ) {
	            $this->check_code = $DB->get_record($this->table,['shortname' => $this->data->shortname], 'shortname');
				if($this->check_code) {
					$check_code = $this->check_code->shortname;
					$this->resp->data['code'] = "Mã khoá học'$check_code' đã tồn tại";
				}
	        }

	        if($this->data->categoryname and $this->data->categorycode) {
				$existing = $DB->get_field('course_categories','id',['name' => $this->data->categoryname, 'idnumber' => $this->data->categorycode]);
				if($existing) {
					$this->data->category = $existing;
				} else {
					$categoryname = $this->data->categoryname;
					$this->resp->data['categoryname'] = "Không tìm thấy tên '$categoryname' trong danh mục khoá học ";
				}
			} else {
				$this->resp->data['category'] = "Thiếu 'categoryname' hoặc 'categorycode";
			}
			if(!empty($this->data->coursesetup)) {
	        	$this->data->coursesetup = $DB->get_field('course_setup', 'id', ['shortname' => $this->data->coursesetup]);
	        	if(!$this->data->coursesetup) {
	        		$coursesetup = $this->data->coursesetup;
					$this->resp->data['coursesetup'] = "Mã khoá setup '$coursesetup' không tồn tại!";
	        	}
	        }
			
			if(empty($this->resp->data)) {
				$this->data->idnumber = '';
				$this->data->format = 'topcoll';
				$this->data->showgrades = 1;
				$this->data->numsections = 4;
				$this->data->newsitems = 10;
				$this->data->visible = 1;
				$this->data->showreports = 1;
				$this->data->summary = '';
				$this->data->summaryformat = FORMAT_HTML;
				$this->data->lang = 'vi';
				$this->data->typeofcourse = 2;
				$this->data->enablecompletion = 1;	
				try {
					update_course($this->data);
					$this->resp->error = false;
					$this->resp->message['info'] = "Chỉnh sửa thành công";
					$this->resp->data[] = $this->data;
				} catch (Exception $e) {
					$this->resp->error = true;
					$this->resp->data->message['info'] = "Thêm thất bại với lỗi: $e->getMessage()";
				}		
			} else {
				$this->resp->error = true;
			}
		} else {

			if($this->data->categoryname and $this->data->categorycode) {
				$existing = $DB->get_field('course_categories','id',['name' => $this->data->categoryname, 'idnumber' => $this->data->categorycode]);
				if($existing) {
					$this->data->category = $existing;
				} else {
					$categoryname = $this->data->categoryname;
					$this->resp->data['categoryname'] = "Không tìm thấy tên '$categoryname' trong danh mục khoá học ";
				}
			} else {
				$this->resp->data['category'] = "Thiếu 'categoryname' hoặc 'categorycode";
			}

			if (!empty($this->data->shortname)) {
	            $this->check_code = $DB->get_record($this->table,['shortname' => $this->data->shortname], 'shortname');
				if($this->check_code) {
					$check_code = $this->check_code->shortname;
					$this->resp->data['code'] = "Mã khoá học '$check_code' đã tồn tại!";
				}
	        }
	        if(!empty($this->data->coursesetup)) {
	        	$this->data->coursesetup = $DB->get_field('course_setup', 'id', ['shortname' => $this->data->coursesetup]);
	        	if(!$this->data->coursesetup) {
	        		$coursesetup = $this->data->coursesetup;
					$this->resp->data['coursesetup'] = "Mã khoá setup '$coursesetup' không tồn tại!";
	        	}
	        }
			if(empty($this->resp->data)) {
				$this->data->idnumber = '';
				$this->data->format = 'topcoll';
				$this->data->showgrades = 1;
				$this->data->numsections = 4;
				$this->data->newsitems = 10;
				$this->data->visible = 1;
				$this->data->showreports = 1;
				$this->data->summary = '';
				$this->data->summaryformat = FORMAT_HTML;
				$this->data->lang = 'vi';
				$this->data->typeofcourse = 2;
				$this->data->enablecompletion = 1;
				
			    $success = create_course($this->data);

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
		global $DB, $CFG;
		require_once("$CFG->dirroot/course/lib.php");
		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->fullname = $request->getParam('name');
		    $this->data->shortname = $request->getParam('code');
		    $this->data->coursesetup = $request->getParam('setupcode');
		    $this->data->categoryname = $request->getParam('categoryname');
		    $this->data->categorycode = $request->getParam('categorycode');
		    $this->data->startdate = $request->getParam('startdate');
		    $this->data->enddate = $request->getParam('enddate');
		    if($request->getParam('startdate') == '') 
		    	$this->data->startdate = time();
		    if($request->getParam('enddate'))
		    	$this->data->enddate = strtotime($request->getParam('enddate'));
		    else 
		    	$this->data->enddate = 0;
		    $this->data->description = $request->getParam('description');

	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }

		$courseid = $request->getAttribute('id');
		if($courseid) {
			$this->data->id = $courseid;
			$course = $DB->get_record($this->table, ['id' => $courseid]);
			if (!empty($this->data->shortname) && $course->shortname !== $this->data->shortname ) {
	            $this->check_code = $DB->get_record($this->table,['shortname' => $this->data->shortname], 'shortname');
				if($this->check_code) {
					$check_code = $this->check_code->shortname;
					$this->resp->data['code'] = "Mã khoá học'$check_code' đã tồn tại";
				}
	        }

	        if($this->data->categoryname and $this->data->categorycode) {
				$existing = $DB->get_field('course_categories','id',['name' => $this->data->categoryname, 'idnumber' => $this->data->categorycode]);
				if($existing) {
					$this->data->category = $existing;
				} else {
					$categoryname = $this->data->categoryname;
					$this->resp->data['categoryname'] = "Không tìm thấy tên '$categoryname' trong danh mục khoá học ";
				}
			} else {
				$this->resp->data['category'] = "Thiếu 'categoryname' hoặc 'categorycode";
			}
			if(!empty($this->data->coursesetup)) {
	        	$this->data->coursesetup = $DB->get_field('course_setup', 'id', ['shortname' => $this->data->coursesetup]);
	        	if(!$this->data->coursesetup) {
	        		$coursesetup = $this->data->coursesetup;
					$this->resp->data['coursesetup'] = "Mã khoá setup '$coursesetup' không tồn tại!";
	        	}
	        }
			
			if(empty($this->resp->data)) {
				$this->data->idnumber = '';
				$this->data->format = 'topcoll';
				$this->data->showgrades = 1;
				$this->data->numsections = 4;
				$this->data->newsitems = 10;
				$this->data->visible = 0;
				$this->data->showreports = 1;
				$this->data->summary = '';
				$this->data->summaryformat = FORMAT_HTML;
				$this->data->lang = 'vi';
				$this->data->typeofcourse = 2;
				$this->data->enablecompletion = 1;	
				try {
					update_course($this->data);
					$this->resp->error = false;
					$this->resp->message['info'] = "Chỉnh sửa thành công";
					$this->resp->data[] = $this->data;
				} catch (Exception $e) {
					$this->resp->error = true;
					$this->resp->data->message['info'] = "Thêm thất bại với lỗi: $e->getMessage()";
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