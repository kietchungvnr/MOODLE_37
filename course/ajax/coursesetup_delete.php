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

require_once('../../config.php');

$id = required_param('id', PARAM_INT);
$visible = optional_param('visible', 0, PARAM_INT);
$action = required_param('action', PARAM_TEXT);
require_login();
$PAGE->set_context(context_system::instance());
$data = [];
switch ($action) {
    case 'delete':
        $DB->delete_records('course_setup',array('id' => $id));
        $data['message'] = get_string('confirmdeleterecord', 'local_newsvnr');
        break;
    case 'hide':
        $obj = new stdClass;
        $obj->id = $id;
        $obj->visible = $visible;
        $DB->update_record('course_setup', $obj);
        $data['message'] = get_string('hiderecord', 'local_newsvnr');
        break;
    default:
        // code...
        break;
}

echo json_encode($data,JSON_UNESCAPED_UNICODE);

die();