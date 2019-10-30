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
 * Lists the course categories
 *
 * @copyright 1999 Martin Dougiamas  http://dougiamas.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package course
 */

require_once("../config.php");
require_once($CFG->dirroot. '/course/lib.php');

$categoryid = optional_param('categoryid', 0, PARAM_INT); // Category id
$site = get_site();

if ($CFG->forcelogin) {
    require_login();
}

$heading = $site->fullname;
if ($categoryid) {
    $category = core_course_category::get($categoryid); // This will validate access.
    $PAGE->set_category_by_id($categoryid);
    $PAGE->set_url(new moodle_url('/course/index.php', array('categoryid' => $categoryid)));
    $PAGE->set_pagetype('course-index-category');
    $heading = $category->get_formatted_name();
} else if ($category = core_course_category::user_top()) {
    // Check if there is only one top-level category, if so use that.
    $categoryid = $category->id;
    $PAGE->set_url('/course/index.php');
    if ($category->is_uservisible() && $categoryid) {
        $PAGE->set_category_by_id($categoryid);
        $PAGE->set_context($category->get_context());
        if (!core_course_category::is_simple_site()) {
            $PAGE->set_url(new moodle_url('/course/index.php', array('categoryid' => $categoryid)));
            $heading = $category->get_formatted_name();
        }
    } else {
        $PAGE->set_context(context_system::instance());
    }
    $PAGE->set_pagetype('course-index-category');
} else {
    throw new moodle_exception('cannotviewcategory');
}

$PAGE->set_pagelayout('coursecategory');
$courserenderer = $PAGE->get_renderer('core', 'course');

$PAGE->set_heading($heading);
$content = $courserenderer->course_category($categoryid);

echo $OUTPUT->header();
echo $OUTPUT->skip_link_target();

// Sửa ở đây

echo '<style type="text/css">';
echo '.card-title > a {    padding-top: 5px; overflow: hidden;text-overflow: ellipsis; -webkit-line-clamp: 3; height: 38px; display: -webkit-box; -webkit-box-orient: vertical;}';
echo '.no-overflow{padding-top: 5px; overflow: hidden;text-overflow: ellipsis; -webkit-line-clamp: 3;height: 70px;display: -webkit-box; -webkit-box-orient: vertical;}';
echo '.buttons {float:left;}';
echo '.courses .card-body{padding: 0 10px;}';
echo '.courses .card-title{margin-top: 20px}';
echo '.courses .grid-stud{ height: 50px; background-color: #00000063; margin-top: -50px;}';
echo '.courses .grid-stud p { padding: 15px; display: block; color: #fff;}';
echo '.courses .grid-stud p > span { padding-left: 5px;}';
echo '.courses .card-img-top{ height: 175px;}';
echo '.courses .course-contacts{ margin: -15px 6px -20px 6px; }';
echo '</style>';

echo $content;

// Trigger event, course category viewed.
$eventparams = array('context' => $PAGE->context, 'objectid' => $categoryid);
$event = \core\event\course_category_viewed::create($eventparams);
$event->trigger();

echo $OUTPUT->footer();
