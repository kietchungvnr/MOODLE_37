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
 * @module     core_course/format_multitopic
 * @package    core_course
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('AJAX_SCRIPT', true);
require_once(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/mod/resource/lib.php');
require_once($CFG->dirroot . '/mod/resource/locallib.php');
require_once($CFG->libdir . '/completionlib.php');

const SHOW_RESOURCE = 1;
const COMPLETION_RESOURCE = 2;

$cmid = required_param('cmid',PARAM_INT);
$instance = required_param('instance',PARAM_INT);
$action = required_param('action',PARAM_INT);
// $hasseenmodule = optional_param('hasseenmodule', '',PARAM_ALPHA);
// $spenttime = optional_param('lastseentime', 0, PARAM_INT);
// $hasseenmodule = required_param('hasseenmodule', PARAM_ALPHA);
$spenttime = required_param('spenttime', PARAM_INT);
$url = $CFG->wwwwroot . '/course/format/multitopic/ajax.php'; 
$PAGE->set_url($url);

$context = \context_module::instance($cmid);
$PAGE->set_context($context);

$data = new stdClass;
$module = $DB->get_record('course_modules_completion_rule', ['moduleid' => $cmid]);
$completion = $DB->get_record('course_modules_completion_timer', ['completionruleid' => $module->id, 'userid' => $USER->id]);
// $resource = $DB->get_record('resource', array('id' => $instance), '*', MUST_EXIST);
// $cm = get_coursemodule_from_instance('resource', $resource->id, $resource->course, false, MUST_EXIST);
switch (true) {
	case $action == SHOW_RESOURCE:
		$resource = $DB->get_record('resource', array('id' => $instance), '*', MUST_EXIST);
		$user = new stdClass;
		// Kiểm tra xem module này đã được học viên xem chưa?
		if(!$completion) {
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
	
		// Lấy URL của file
		$fs = get_file_storage();
		$files = $fs->get_area_files(
		    $context->id, 'mod_resource', 'content', 0, 'sortorder DESC, id ASC', false
		);
		$fileurl = '';
		if(count($files) >= 1 ) {
		    $file = reset($files);
		    unset($files);
		    $resource->mainfile = $file->get_filename();
		    $fileurl = $CFG->wwwroot . '/pluginfile.php/' . $context->id . '/mod_resource/content/'
		        . $resource->revision . $file->get_filepath() . rawurlencode($file->get_filename());
		    
			$data->url = $fileurl;
			$data->reousrucename = $DB->get_field('resource', 'name',['id' => $instance]);  
		}
		break;
	case $action == COMPLETION_RESOURCE:
		$user = new stdClass;
		$user->id = $completion->id;
		$user->lastseentime = $completion->lastseentime + $spenttime;
		$DB->update_record('course_modules_completion_timer', $user);
		if($instance) {
		    if(!$resource = $DB->get_record('resource', array('id' => $instance))) {
		        resource_redirect_if_migrated($instance, 0);
		        print_error('invalidaccessparameter');
		    }
		    $cm = get_coursemodule_from_instance('resource', $resource->id, $resource->course, false, MUST_EXIST);

		} else {
		    if(!$cm = get_coursemodule_from_id('resource', $id)) {
		        resource_redirect_if_migrated(0, $id);
		        print_error('invalidcoursemodule');
		    }
		    $resource = $DB->get_record('resource', array('id' => $cm->instance), '*', MUST_EXIST);
		}
		$course = $DB->get_record('course', array('id' => $resource->course), '*', MUST_EXIST);
		resource_view($resource, $course, $cm, $context);
		$data->result = 'success';
		break;
	default:
		break;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
