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
 
require_once(__DIR__ . '/../../config.php');
require_once('lib.php');

require_login();
require_capability('moodle/site:approvecourse', context_system::instance());
$url = new moodle_url('/local/newsvnr/orgmain.php');
$orgmanagerurl = new moodle_url('/local/newsvnr/orgmanager.php');
$strorrgmanegertitle = get_string('orgmanagertitle','local_newsvnr');
$strtitle = get_string('orgmaintitle','local_newsvnr');
$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_title($strtitle);
$PAGE->set_heading($strtitle);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add($strorrgmanegertitle,$orgmanagerurl);
$PAGE->navbar->add($strtitle);
$PAGE->requires->js_call_amd('local_newsvnr/orgmain', 'orgmain');

$output = $PAGE->get_renderer('local_newsvnr');
$page = new \local_newsvnr\output\orgmain_page();

echo $output->header();

echo $output->render($page);
// echo $mform_orgstructure->display();

echo $output->footer();
