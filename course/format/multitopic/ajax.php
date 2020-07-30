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
$cmid = required_param('cmid',PARAM_INT);
$instance = required_param('instance',PARAM_INT);

$url = $CFG->wwwwroot . '/course/format/multitopic/ajax.php'; 
$PAGE->set_url($url);

$context = \context_module::instance($cmid);
$PAGE->set_context($context);
$resource = $DB->get_record('resource', array('id' => $instance), '*', MUST_EXIST);
$fs = get_file_storage();
$files = $fs->get_area_files(
    $context->id, 'mod_resource', 'content', 0, 'sortorder DESC, id ASC', false
);
$fileurl = '';
if (count($files) >= 1 ) {
    $file = reset($files);
    unset($files);
    $resource->mainfile = $file->get_filename();
    $fileurl = $CFG->wwwroot . '/pluginfile.php/' . $context->id . '/mod_resource/content/'
        . $resource->revision . $file->get_filepath() . rawurlencode($file->get_filename());
    $data = new stdClass;
	$data->url = $fileurl;
	$data->reousrucename = $DB->get_field('resource', 'name',['id' => $instance]);   
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
