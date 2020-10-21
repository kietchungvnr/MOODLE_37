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
require_once('orgjobtitle_form.php');
require_login();
require_capability('moodle/site:approvecourse', context_system::instance());
$id = optional_param('id',0,PARAM_INT);
$delete = optional_param('delete',0,PARAM_BOOL);
$confirm   = optional_param('confirm', 0, PARAM_BOOL);
$orgmanagertitle = get_string('orgmanagertitle','local_newsvnr');
$strInsert = get_string('insert','local_newsvnr');
$strDelete = get_string('delete', 'local_newsvnr');
$strupdate = get_string('edit', 'local_newsvnr');
$title = get_string('orgjobtitlepage','local_newsvnr');

$params = [];
if($id){
  $params['id'] = $id;
}


$url = new moodle_url('/local/newsvnr/orgjobtitle.php',$params);
$orgmanagerurl = new moodle_url('/local/newsvnr/orgmanager.php');


if($id){
    $heading = get_string('orgjobtitleupdate','local_newsvnr');

    $orgjobtitledb = $DB->get_records('orgstructure_jobtitle',array('id'=>$id));
    $orgjobtitle = new stdClass();
    foreach($orgjobtitledb as $value){
        $orgjobtitle->id = $value->id;
        $orgjobtitle->jobtitlename = $value->name;
        $orgjobtitle->jobtitlecode = $value->code;
        $orgjobtitle->jobtitle_namebylaw = $value->namebylaw;
        $orgjobtitle->orgjobtitle_description = $value->description;
    }
}else{
    $heading = get_string('orgjobtitlecreate','local_newsvnr');

    $orgjobtitle = new stdClass();
    // $orgjobtitle->id = 0;
    // $orgjobtitle->name = '';
    // $orgjobtitle->code = '';
    // $orgjobtitle->namebylaw = '';
    // $orgjobtitle->description = '';
}



$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($heading);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add($orgmanagertitle,$orgmanagerurl);
$PAGE->navbar->add($title);

if($delete){
   $PAGE->url->param('delete', 1);
    if ($confirm and confirm_sesskey()) {
        delete_orgjobtitle($orgjobtitle->id);
        redirect($orgmanagerurl,$strDelete);
    }
    $strheading = get_string('deleteorgposition', 'local_newsvnr');
    $PAGE->navbar->add($strheading);
    $PAGE->set_title($strheading);
    $PAGE->set_heading($COURSE->fullname);
    echo $OUTPUT->header();
    echo $OUTPUT->heading($strheading);
    $yesurl = new moodle_url('/local/newsvnr/orgjobtitle.php', array('id' => $orgjobtitle->id, 'delete' => 1,
        'confirm' => 1, 'sesskey' => sesskey()));
    $message = get_string('confirmdeleteorgjobtitle', 'local_newsvnr', format_string($orgjobtitle->jobtitlename));
    echo $OUTPUT->confirm($message, $yesurl, $orgmanagerurl);
    echo $OUTPUT->footer();
    die;
}

$mform_orgjobtitle = new orgjobtitle_form(null,array('orgjobtitle' => $orgjobtitle));
if ($mform_orgjobtitle->is_cancelled()){ 
      redirect($orgmanagerurl);
} else if ($orgjobtitle = $mform_orgjobtitle->get_data()) {
  if($id){
      $orgjobtitleupdate = (object)array('id' => $orgjobtitle->id, 'name' => $orgjobtitle->jobtitlename,'code' => $orgjobtitle->jobtitlecode,'namebylaw' => $orgjobtitle->jobtitle_namebylaw,'description' => $orgjobtitle->orgjobtitle_description);
      if (isset($orgjobtitle->submitbutton)) {
          $message = $strupdate;
      }
      if (isset($message)) {
          update_orgjobtitle($orgjobtitleupdate);
          redirect($url, $message);
      }
  }
  else{
      $orgjobtitle->name = $orgjobtitle->jobtitlename;
      $orgjobtitle->code = $orgjobtitle->jobtitlecode;
      $orgjobtitle->namebylaw = $orgjobtitle->jobtitle_namebylaw;
      $orgjobtitle->description = $orgjobtitle->orgjobtitle_description;

      if (isset($orgjobtitle->submitbutton)) {
          $message = $strInsert;
      }
      if (isset($message)) {
          insert_orgjobtitle($orgjobtitle);
          redirect($url, $message);
      }
  }
}

echo $OUTPUT->header();
if(empty($id)){
  $currenttab = 'orgjobtitle';
  require('tabs.php');
}


echo $mform_orgjobtitle->display();


echo $OUTPUT->footer();
