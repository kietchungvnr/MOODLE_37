<?php 

namespace local_newsvnr\api\controllers\lms\chatbot;

use stdClass;
use context_system;
use local_newsvnr\api\controllers\BaseController as BaseController;


defined('MOODLE_INTERNAL') || die;

class ReportController extends BaseController {
	public $data;
	public $resp;

	public function __construct($container) {
		parent::__construct($container);
   		$this->data = new stdClass;
   		$this->resp = new stdClass;
        $data = $this->data;
        $resp = $this->resp;
    }

    public function validate() {
        //Khai báo new rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'userid' => $this->v::notEmpty()->notBlank(),
        ]);
    }

    public function chat_response($contenthtml) {
        $html = '
                    <ul class="list-group">
                        <div class="help-content-chatbot">'
                            .$contenthtml.
                        '</div>
                    </ul>
                ';
        return $html;
    }

    public function list_course($request, $response, $args) {
        global $DB, $CFG;
        require_once __DiR__ . '/../../../../../lib.php';
        $this->validate();
        if ($this->validate->isValid()) {
             $data->userid = $request->getParam('userid');
             $data->roleid = $request->getParam('roleid');
        } else {
            $errors = $this->validate->getErrors();
            $resp->error = true;
            $resp->data[] = $errors;
            return $response->withStatus(422)->withJson($resp);
        }
        $userid = $data->userid;
        if($data->roleid == 3) {
            $strole = 'giảng';
            $listcourse = get_list_course_by_teacher($userid);    
        } else if($data->roleid == 5) {
            $strole = 'học';
            $listcourse = get_list_course_by_student($userid);    
        }
        
        $contenthtml = ''; 
        if($listcourse) {
            foreach($listcourse as $course) {
                $courseurl = '<a href="'. $CFG->wwwroot . '/course/view.php?id=' . $course->id. '" target="_blank">' . $course->fullname . '</a>';
                $contenthtml .= '<li class="list-group-item"><img src="' . $CFG->wwwroot . '\theme\moove\pix\learnicon.png" class="img-module mr-2">'.$courseurl.'</li>';
            }
            $data->html = $this->chat_response($contenthtml);
        } else {
            $data->html = $contenthtml;
        }
		$count_course = count($listcourse);
        if($count_course > 0) 
            $data->message = 'Hiện tại bạn có ' . $count_course . ' khóa ' . $strole;
        else
            $data->message = 'Bạn không có khóa ' . $strole;

		$resp->error = false;
		$resp->data[] = $data;
		return $this->response->withStatus(200)->withJson($resp);
	}
}