<?php 

namespace local_newsvnr\api\controllers\lms\chatbot;

use stdClass;
use context_system;
use local_newsvnr\api\controllers\BaseController as BaseController;


defined('MOODLE_INTERNAL') || die;

class HelloController extends BaseController {

	public $data;
	public $resp;

	public function __construct($container) {
		parent::__construct($container);
   		$this->data = new stdClass;
   		$this->resp = new stdClass;
        $resp = $this->resp;
        $data = $this->data;
    }

    public function validate() {
        //Khai báo new rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'userid' => $this->v::notEmpty()->notBlank(),
        ]);
    }


    public function hello($request, $response, $args) {
        global $DB;
        $this->validate();
        if ($this->validate->isValid()) {
             $data->userid = $request->getParam('userid');
        } else {
            $errors = $this->validate->getErrors();
            $resp->error = true;
            $resp->data[] = $errors;
            return $this->response->withStatus(422)->withJson($resp);
        }
        $user = $DB->get_record('user', ['id' => $data->userid]);
		$data->message = '👋 Xin chào ' . $user->firstname . ' ' . $user->lastname . ', tôi là E-Learning Assistant!';
		$resp->error = false;
		$resp->data[] = $data;
		return $this->response->withStatus(200)->withJson($resp);
	}
}