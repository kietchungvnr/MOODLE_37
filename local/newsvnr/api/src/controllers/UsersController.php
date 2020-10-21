<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;

class UsersController extends BaseController {

   	public function __construct($container) {
   		parent::__construct($container);
   	}

    public function getUser() {
    	global $DB;
        $arr = $DB->get_records('user', []); 
        return $this->response->withJson($arr);
    }

   
}