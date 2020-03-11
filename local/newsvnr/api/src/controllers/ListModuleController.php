<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;
use stdClass;

class ListModuleController extends BaseController {

	public $resp;

	public function __construct($container) {
		parent::__construct($container);
   		$this->resp = new stdClass;
   		
   	}

   	public function read_course($request, $response, $args) {
   		global $DB;
   		$data = $DB->get_records_sql('SELECT * FROM {course} WHERE id>1 AND typeofcourse = 1');
   		if($data) {
   			$this->resp->error = false;
   			$this->resp->message['info'] = 'Danh sách khoá học';
        	$this->resp->data[] = $data;
   		} else {
   			$this->resp->error = true;
   			$this->resp->message['info'] = 'Lấy danh sách khoá học thất bại';
   		}
   		return $this->response->withStatus(200)->withJson($this->resp);
	}

	public function read_quiz($request, $response, $args) {
   		global $DB;
   		$data = $DB->get_records_sql('SELECT q.name, q.code, c.code FROM {quiz} q LEFT JOIN {course} c ON q.course = c.id WHERE c.typeofcourse = 1');
   		if($data) {
   			$this->resp->error = false;
   			$this->resp->message['info'] = 'Danh sách bài thi';
        	$this->resp->data[] = $data;
   		} else {
   			$this->resp->error = true;
   			$this->resp->message['info'] = 'Lấy danh sách bài thi thất bại';
   		}
   		return $this->response->withStatus(200)->withJson($this->resp);
	}

}