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
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_once $CFG->dirroot . '/course/lib.php';
require_login();
$PAGE->set_context(context_system::instance());

$moduleid = optional_param('moduleid', 0, PARAM_INT);
$action   = optional_param('action', '', PARAM_TEXT);
if (isset($_POST['dataselect'])) {
    $dataselect = json_decode($_POST['dataselect']);
}
switch ($action) {
    case 'delete':
        $DB->delete_records('library_module', ['coursemoduleid' => $moduleid]);
        course_delete_module($moduleid);
        break;
    case 'hide':
        $DB->update_record('course_modules', ['id' => $moduleid, 'visible' => 0]);
        break;
    case 'show':
        $DB->update_record('course_modules', ['id' => $moduleid, 'visible' => 1]);
        break;
    case 'approval':
        $getid = $DB->get_record('library_module', ['coursemoduleid' => $moduleid], 'id');
        $DB->update_record('library_module', ['id' => $getid->id, 'approval' => 1]);
        break;
    case 'deleteselect':
        foreach ($dataselect as $value) {
            $DB->delete_records('library_module', ['coursemoduleid' => $value->id]);
            course_delete_module($value->id);
        }
        break;
    case 'approvalselect':
        foreach ($dataselect as $value) {
            $getid = $DB->get_record('library_module', ['coursemoduleid' => $value->id], 'id');
            $DB->update_record('library_module', ['id' => $getid->id, 'approval' => 1]);
        }
        break;
    default:

        break;
}

die;
