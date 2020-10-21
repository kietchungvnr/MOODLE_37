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
 * Edit course settings
 *
 * @package    core_course
 * @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../config.php');
require_once('lib.php');
require_once('coursesetup_form.php');


$PAGE->set_pagelayout('admin');

$url = new moodle_url('/course/coursesetup_management.php');
$PAGE->set_url($url);


require_login();
$coursesetup = new stdClass();

$context = context_system::instance();
require_capability('moodle/course:create', $context);
$PAGE->set_context($context);


$mform_coursesetup = new coursesetup_form(null,array('coursesetup' => $coursesetup));
$strtitle = get_string('coursesetup_management', 'local_newsvnr');


$PAGE->set_title($strtitle);
$PAGE->navbar->add($strtitle);
$PAGE->set_heading($strtitle);
$PAGE->requires->js_call_amd('core_course/coursesetup_management','coursesetup_management');
$output = $PAGE->get_renderer('core_course');
$page = new \core_course\output\coursesetup_management_page();
echo $output->header();
echo $output->render($page);

echo $output->footer();

