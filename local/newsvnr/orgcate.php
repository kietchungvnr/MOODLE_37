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
require_once('orgcate_form.php');
require_login();
require_capability('moodle/site:approvecourse', context_system::instance());
$id = optional_param('id',0,PARAM_INT);
$delete = optional_param('delete',0,PARAM_BOOL);
$confirm   = optional_param('confirm', 0, PARAM_BOOL);
$orgmanagertitle = get_string('orgmanagertitle','local_newsvnr');
$strInsert = get_string('insert','local_newsvnr');
$strDelete = get_string('delete', 'local_newsvnr');
$strupdate = get_string('edit', 'local_newsvnr');
$title = get_string('orgcatepage','local_newsvnr');

$params = [];
if($id){
  $params['id'] = $id;
}


$url = new moodle_url('/local/newsvnr/orgcate.php',$params);
$orgmanagerurl = new moodle_url('/local/newsvnr/orgmanager.php');


if($id){
    $heading = get_string('orgcateupdate','local_newsvnr');

    $orgcatedb = $DB->get_records('orgstructure_category',array('id'=>$id));
    $orgcate = new stdClass();
    foreach($orgcatedb as $value){
        $orgcate->id = $value->id;
        $orgcate->catename = $value->name;
        $orgcate->orgcate_description = $value->description;
    }
}else{
    $heading = get_string('orgcatecreate','local_newsvnr');

    $orgcate = new stdClass();
    // $orgcate->id = 0;
    // $orgcate->name = '';
    // $orgcate->description = '';
}



$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($heading);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add($orgmanagertitle,$orgmanagerurl);
$PAGE->navbar->add($title);

// $PAGE->requires->js('/local/newsvnr/js/orgstructure.js', true);
// $PAGE->requires->js_call_amd('local_hackfest/main', 'Init');

if($delete){
   $PAGE->url->param('delete', 1);
    if ($confirm and confirm_sesskey()) {
        delete_orgcategory($orgcate->id);
        redirect($orgmanagerurl,$strDelete);
    }
    $strheading = get_string('deleteorgcate', 'local_newsvnr');
    $PAGE->navbar->add($strheading);
    $PAGE->set_title($strheading);
    $PAGE->set_heading($COURSE->fullname);
    echo $OUTPUT->header();
    echo $OUTPUT->heading($strheading);
    $yesurl = new moodle_url('/local/newsvnr/orgcate.php', array('id' => $orgcate->id, 'delete' => 1,
        'confirm' => 1, 'sesskey' => sesskey()));
    $message = get_string('confirmdeleteorgcate', 'local_newsvnr', format_string($orgcate->catename));
    echo $OUTPUT->confirm($message, $yesurl, $orgmanagerurl);
    echo $OUTPUT->footer();
    die;
}

$mform_orgcate = new orgcate_form(null,array('orgcate' => $orgcate));
if ($mform_orgcate->is_cancelled()){ 
      redirect($orgmanagerurl);
} else if ($orgcate = $mform_orgcate->get_data()) {
  if($id){
      $orgcateupdate = (object)array('id' => $orgcate->id, 'name' => $orgcate->catename,'description' => $orgcate->orgcate_description);
      if (isset($orgcate->submitbutton)) {
          $message = $strupdate;
      }
      if (isset($message)) {
          update_orgcategory($orgcateupdate);
          redirect($url, $message);
      }
  }
  else{
      $orgcate->name = $orgcate->catename;
      $orgcate->description = $orgcate->orgcate_description;

      if (isset($orgcate->submitbutton)) {
          $message = $strInsert;
      }
      if (isset($message)) {
          insert_orgcategory($orgcate);
          redirect($url, $message);
      }
  }
}

echo $OUTPUT->header();
if(empty($id)){
  $currenttab = 'orgcate';
  require('tabs.php');
}


echo $mform_orgcate->display();


echo $OUTPUT->footer();
