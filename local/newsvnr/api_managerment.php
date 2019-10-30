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

// $id = optional_param('id',0,PARAM_INT);
// $array_id = array('id' => $id);

$url = new moodle_url('/local/newsvnr/api_managerment.php');


$PAGE->set_url($url);

$title = get_string('api_title','local_newsvnr');
$navbarcourse = get_string('navbarcourse','local_newsvnr');
$search = get_string('search','local_newsvnr');
$PAGE->set_context(context_system::instance());


$PAGE->set_title($title);
// $PAGE->set_heading($title);

$PAGE->navbar->ignore_active();

	$PAGE->navbar->add($title);

// $PAGE->requires->css('/local/newsvnr/css/owl.carousel.min.css');
// $PAGE->requires->css('/local/newsvnr/css/owl.theme.default.min.css');



$PAGE->requires->css('/local/newsvnr/css/api.css');
$PAGE->requires->js('/local/newsvnr/js/jquery-3.2.1.min.js', true);

// $PAGE->requires->js('/local/newsvnr/js/owl.carousel.min.js', true);
// $PAGE->requires->js('/local/newsvnr/js/khoahoc.js', true);
$output = $PAGE->get_renderer('local_newsvnr');
$page = new \local_newsvnr\output\api_managerment();

echo $output->header();

echo $output->render($page);

echo $output->footer();

