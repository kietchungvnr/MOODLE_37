<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;
use stdClass;

class TokenController extends BaseController {

	private $table = 'orgstructure';

	public $id;
	public $name;
	public $code;
	public $managerid;
	public $orgstructuretypeid;
	public $parentid;
	public $numbermargin;
	public $numbercurrent;
	public $description;


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

	public function update() {

	}

	public function delete() {

	}
}