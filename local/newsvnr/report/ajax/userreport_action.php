<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package local_newsvnr
 * @copyright 2019 VnResource
 * @author   Le Thanh Vu
 **/

define('AJAX_SCRIPT', false);

require_once __DIR__ . '/../../../../config.php';
require_once __DIR__ . '/../../lib.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_login();
$action = optional_param('action','', PARAM_RAW);
$userid = optional_param('userid',0, PARAM_INT);
switch ($action) {
	case 'delete':
		$user = $DB->get_record('user', array('id'=> $userid), '*');
		if(delete_user($user)) {
			$data['result'] = 'Xóa thành công';
		}
		break;
	case 'hide':
		$obj = new stdClass;
		$obj->id = $userid;
		$obj->suspended = 1;
		if($DB->update_record('user',$obj)) {
			$data['result'] = "Ẩn thành công";
		}
		break;
	case 'show';
		$obj = new stdClass;
		$obj->id = $userid;
		$obj->suspended = 0;
		if($DB->update_record('user',$obj)) {
			$data['result'] = "Hiện thành công";
		}
		break;
	case 'deleteselected';
		if (isset($_POST['dataselect'])) {
		    $users = json_decode($_POST['dataselect']);
		}
		foreach ($users as $user) {
			$obj = $DB->get_record('user', array('id'=> $user->id), '*');
			if(delete_user($obj)) {
				$data['result'] = 'Xóa thành công';
			}
		}
		break;
	case 'addsession';
		if (isset($_POST['dataselect'])) {
		    $users = json_decode($_POST['dataselect']);
		}
		$bulk_users = [];
		foreach ($users as $user) {
			$bulk_users[] = $user->id;
		}
		$SESSION->bulk_users = $bulk_users;
		var_dump($SESSION->bulk_users);
		break;
	default:
		break;
}
echo json_encode($data,JSON_UNESCAPED_UNICODE);

