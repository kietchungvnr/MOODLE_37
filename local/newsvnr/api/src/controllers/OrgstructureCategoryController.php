<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;


class OrgstructureCategoryController extends BaseController {

	private $table = 'orgstructure_category';

	public $id;
	public $name;
	public $code;
	public $description;

	public function __construct($container) {
   		parent::__construct($container);
   	}

   	public function read() {

	}

	public function read_single() {

	}

	public function create() {
		global $DB;
		
		$this->validate();
		$this->validate->value('code', $this->v::MyRule(), 'code');
		if ($this->validate->isValid()) {
	    	$name = $this->request->getParam('name');
		    $code = $this->request->getParam('code');
		    $description = $this->request->getParam('description');

	    } else {
	        $errors = $this->validate->getErrors();
	        // if($)
	        return $this->response->withStatus(422)->withJson($errors);
	    }
	}

	public function update() {

	}

	public function delete() {

	}
}