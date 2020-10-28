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
require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/../lib.php');

require_login();
$title = 'Trang kì thi';
// $navstr = get_string('navbar','local_newsvnr');
// Set up the page.
$url = new moodle_url("/local/newsvnr/exam/index.php");

$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_title($title);

$PAGE->set_heading($title);
$PAGE->navbar->add($title,$url);
$PAGE->navbar->ignore_active();
$PAGE->requires->js_call_amd('local_newsvnr/exam', 'init');
$output = $PAGE->get_renderer('local_newsvnr');

$page = new \local_newsvnr\output\exam_page();


echo $output->header();

echo $output->render($page);

echo $output->footer();
