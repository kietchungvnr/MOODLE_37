<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.org                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * Allow the administrator to look through a list of course requests and approve or reject them.
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package course
 */

require_once(__DIR__ . '/../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/course/request_form.php');

$reject = optional_param('reject', 0, PARAM_INT);

$courseurl = $CFG->wwwroot . '/course/index.php';
$baseurl = $CFG->wwwroot . '/course/listcourserq.php';
$strheading = get_string('listcourserqtitle', 'local_newsvnr');
$strcourse = get_string('course');
$message = get_string('deletecourserq', 'local_newsvnr');
require_login();
$PAGE->set_context(context_system::instance());
$PAGE->set_url($baseurl);
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add($strcourse,$courseurl);
$PAGE->navbar->add($strheading,$baseurl);

if (!empty($reject)) {
    $DB->delete_records('course_request', array('id' => $reject, 'requester' => $USER->id));
    redirect($baseurl,$message);    
}

/// Print a list of all the pending requests.
echo $OUTPUT->header();

$pending = $DB->get_records('course_request',['requester' => $USER->id]);
if (empty($pending)) {
    echo $OUTPUT->heading(get_string('nocourserq', 'local_newsvnr'));
} else {
 
    $table = new html_table();
    $table->attributes['class'] = 'pendingcourserequests generaltable';
    $table->align = array('center', 'center', 'center', 'center', 'center', 'center');
    $table->head = array(get_string('shortnamecourse'), get_string('fullnamecourse'), get_string('requestedby'),
            get_string('summary'), get_string('category'), get_string('requestreason'), get_string('action'));

    foreach ($pending as $course) {
        $course = new course_request($course);

        // Check here for shortname collisions and warn about them.
        $course->check_shortname_collision();

        $category = $course->get_category();

        $row = array();
        $row[] = format_string($course->shortname);
        $row[] = format_string($course->fullname);
        $row[] = fullname($course->get_requester());
        $row[] = format_text($course->summary, $course->summaryformat);
        $row[] = $category->get_formatted_name();
        $row[] = format_string($course->reason);
        $row[] = $OUTPUT->single_button(new moodle_url($baseurl, array('reject' => $course->id)), get_string('delete'), 'get');
       
    /// Add the row to the table.
        $table->data[] = $row;
    }

/// Display the table.
    echo html_writer::table($table);

/// Message about name collisions, if necessary.
    if (!empty($collision)) {
        print_string('shortnamecollisionwarning');
    }
}

/// Finish off the page.
echo $OUTPUT->single_button($CFG->wwwroot . '/course/index.php', get_string('backtocourselisting'));
echo $OUTPUT->footer();
