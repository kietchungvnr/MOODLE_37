<?php 

namespace local_newsvnr\api\controllers;

defined('MOODLE_INTERNAL') || die;

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
   	}

   	public function read() {

	}

	public function read_single() {

	}

	public function create() {
		global $DB;

	}

	public function update() {

	}

	public function delete() {

	}
}