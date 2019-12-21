<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;
use stdClass;

class QuizController extends BaseController {

	private $table = 'orgstructure_category';

	public $id;
	public $name;
	public $code;
	public $description;

	public function __construct($container) {
   		parent::__construct($container);
   	}

   	public function read() {
   		global $DB;
   		$data = new stdClass();
   		$data->errors = false;
   		$data->messages['data'] = $DB->get_records('course', ['typeofcourse' => 1], 'id', 'id, fullname');
        return $this->response->withStatus(200)->withJson($data);
	}

	public function read_single() {

	}

	public function create() {
		
	}

	public function update() {

	}

	public function delete() {

	}
}