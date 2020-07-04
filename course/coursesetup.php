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

$id = optional_param('id', 0, PARAM_INT); // Course id.
$categoryid = optional_param('category', 0, PARAM_INT); // Course category - can be changed in edit form.
$returnto = optional_param('returnto', 0, PARAM_ALPHANUM); // Generic navigation return page switch.
// $returnurl = optional_param('returnurl', '', PARAM_LOCALURL); // A return URL. returnto must also be set to 'url'.
$returnurl = "/course/coursesetup_management.php";
$strinsert = get_string('insert','local_newsvnr');
$strdelete = get_string('delete', 'local_newsvnr');
$strupdate = get_string('edit', 'local_newsvnr');

$PAGE->set_pagelayout('admin');
$params = [];
if ($id) {
    $params = array('id' => $id);
}
if ($returnto !== 0) {
    $params['returnto'] = $returnto;
    if ($returnto === 'url' && $returnurl) {
        $params['returnurl'] = $returnurl;
    }
}
$url = new moodle_url('/course/coursesetup.php', $params);
$PAGE->set_url('/course/coursesetup.php', $params);


require_login();

$context = context_system::instance();
require_capability('moodle/course:create', $context);
$PAGE->set_context($context);

if($id){
    $coursesetupdb = $DB->get_records('course_setup',array('id'=>$id));
    $competencydb = $DB->get_record('competency',array('id'=>$id));
    $coursesetup = new stdClass();
    foreach($coursesetupdb as $value) {
        $coursesetup->id = $value->id;
        $coursesetup->category_cs = $DB->get_field('course_categories','name',['id' => $value->category]);
        // $coursesetup->competency_cs = $DB->get_field('competency','name',['id' => $competencydb->shortname]);
        $coursesetup->fullname_cs = $value->fullname;
        $coursesetup->shortname_cs =  $value->shortname;
        $coursesetup->description =  $value->description;
       
    }
} else {
    $coursesetup = new stdClass();
}

// First create the form.
$args = array(
    'coursesetup' => $coursesetup
);
$editform = new coursesetup_form(null, $args);
if ($editform->is_cancelled()) {
    // The form has been cancelled, take them back to what ever the return to is.
    redirect($returnurl);
} else if ($data = $editform->get_data()) {
    
    if($data->category_cs)
        $getcategory = $DB->get_field('course_categories','id',['name' => $data->category_cs]);
    if($id){
        $coursesetup_update = (object)array('id' => $data->id, 'category' => $getcategory, 'fullname' => $data->fullname_cs, 'shortname' => $data->shortname_cs, 'description' => $data->description, 'usermodified' => $USER->id, 'timemodified' => time());
        if (isset($data->submitbutton)) {
            $message = $strupdate;
        }
        if (isset($message)) {
            $DB->update_record('course_setup', $coursesetup_update);
            redirect($url, $message);
        }
    }
    else {
        $coursesetup->category = $getcategory;
        $coursesetup->fullname = $data->fullname_cs;
        $coursesetup->shortname =  $data->shortname_cs;
        // $coursesetup->typeofcourse = $data->typeofcourse;
        // $coursesetup->courseoforgstructure = $getorgstructeid;
        // $coursesetup->courseofjobtitle = $data->courseofjobtitle;
        // $coursesetup->courseofposition =  $data->courseofposition;
        $coursesetup->description = $data->description;
        $coursesetup->usermodified = $USER->id;
        $coursesetup->timecreated = time();
        $coursesetup->timemodified = time();

        if (isset($data->submitbutton)) {
            $message = $strinsert;
        }
        if (isset($message)) {
            $DB->insert_record('course_setup',$coursesetup);
            redirect($url, $message);
        }
    }
}

// Print the form.

$site = get_site();

$searchurl = new moodle_url('/admin/search.php');

navigation_node::override_active_url($searchurl, true);
if($id) {
    $strtitle = get_string('editcoursesetup', 'local_newsvnr');
} else {
    $strtitle = get_string('addcoursesetup', 'local_newsvnr');
}

$title = "$site->shortname: $strtitle";
$fullname = $site->fullname;
$PAGE->navbar->add($strtitle);

$PAGE->set_title($title);
$PAGE->set_heading($fullname);
$PAGE->requires->js_call_amd('core_course/orgtreeview','orgtreeview');
echo $OUTPUT->header();

$editform->display();

echo $OUTPUT->footer();
