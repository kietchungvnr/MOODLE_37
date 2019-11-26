<?php 

Class orgstructure {

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
	public $visible;

	public function read() {
		global $DB;
		return $DB->get_records($this->table,[]);
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