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
 * Contain the logic for the add random question modal.
 *
 * @module     mod_book
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);
require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/mod/book/lib.php');
require_once($CFG->dirroot . '/mod/book/locallib.php');
require_once($CFG->libdir . '/completionlib.php');

const SHOW_BOOK = 1;
const COMPLETION_BOOK = 2;

$cmid = required_param('cmid', PARAM_INT);
$instance = required_param('instance', PARAM_INT);
$action = required_param('action', PARAM_INT);
$spenttime = required_param('spenttime', PARAM_INT);

$url = $CFG->wwwwroot . '/mod/book/ajax.php'; 
$PAGE->set_url($url);

$context = \context_module::instance($cmid);
$PAGE->set_context($context);

$data = new stdClass;
$module = $DB->get_record('course_modules_completion_rule', ['moduleid' => $cmid]);
$completion = $DB->get_record('course_modules_completion_timer', ['completionruleid' => $module->id, 'userid' => $USER->id]);
// $resource = $DB->get_record('resource', array('id' => $instance), '*', MUST_EXIST);
// $cm = get_coursemodule_from_instance('resource', $resource->id, $resource->course, false, MUST_EXIST);
switch (true) {
	case $action == SHOW_BOOK:
		// Kiểm tra xem module này đã được học viên xem chưa?
		if(!$completion) {
			$user = new stdClass;
			$user->userid = $USER->id;
			$user->completionruleid = $module->id;
			$user->starttime = time();
			$user->lastseentime = time();
			$DB->insert_record('course_modules_completion_timer', $user);
			$data->completiontimespent = $module->completiontimespent - $completiontimespent;
		} else {
			$completiontimespent =  $completion->lastseentime - $completion->starttime;
			if($completiontimespent >= $module->completiontimespent) {
				$data->completiontimespent = 'completed';
			} else {
				$data->completiontimespent = $module->completiontimespent - $completiontimespent;
			}
		}
		break;
	case $action == COMPLETION_BOOK:
		$user = new stdClass;
		$user->id = $completion->id;
		$user->lastseentime = $completion->lastseentime + $spenttime;
		$DB->update_record('course_modules_completion_timer', $user);
	
		$data->result = 'success';
		break;
	default:
		break;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
