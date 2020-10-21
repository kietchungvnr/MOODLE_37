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
require_once('orgposition_edit_form.php');
require_login();
require_capability('moodle/site:approvecourse', context_system::instance());
$id = optional_param('id',0,PARAM_INT);
$delete = optional_param('delete',0,PARAM_BOOL);
$confirm   = optional_param('confirm', 0, PARAM_BOOL);
$orgmanagertitle = get_string('orgmanagertitle','local_newsvnr');
$strInsert = get_string('insert','local_newsvnr');
$strDelete = get_string('delete', 'local_newsvnr');
$strupdate = get_string('edit', 'local_newsvnr');
$title = get_string('orgpositionpage','local_newsvnr');

$params = [];
if($id){
  $params['id'] = $id;
}


$url = new moodle_url('/local/newsvnr/orgposition.php',$params);
$orgmanagerurl = new moodle_url('/local/newsvnr/orgmanager.php');


if($id){
    $heading = get_string('orgpositionupdate','local_newsvnr');

    $orgpositiondb = $DB->get_records('orgstructure_position',array('id'=>$id));
    $orgposition = new stdClass();
    foreach($orgpositiondb as $value){
        $orgposition->id = $value->id;
        $orgposition->posname = $value->name;
        $orgposition->poscode = $value->code;
        $orgposition->position_namebylaw = $value->namebylaw;
        $orgposition->jobtitleid = $value->jobtitleid;
		    $orgposition->orgstructureid = $DB->get_field('orgstructure','name',['id' => $value->orgstructureid]);
        $orgposition->orgposition_description = $value->description;
    }
}else{
    $heading = get_string('orgpositioncreate','local_newsvnr');

    $orgposition = new stdClass();
    // $orgposition->id = 0;
    // $orgposition->name = '';
    // $orgposition->code = '';
    // $orgposition->namebylaw = '';
    // $orgposition->jobtitleid = 0;
    // $orgposition->orgstructureid = 0;
    // $orgposition->description = '';
}



$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($heading);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add($orgmanagertitle,$orgmanagerurl);
$PAGE->navbar->add($title);

$PAGE->requires->js_call_amd('local_newsvnr/orgposition','orgposition');

if($delete){
   $PAGE->url->param('delete', 1);
    if ($confirm and confirm_sesskey()) {
        delete_orgposition($orgposition->id);
        redirect($orgmanagerurl,$strDelete);
    }
    $strheading = get_string('deleteorgposition', 'local_newsvnr');
    $PAGE->navbar->add($strheading);
    $PAGE->set_title($strheading);
    $PAGE->set_heading($COURSE->fullname);
    echo $OUTPUT->header();
    echo $OUTPUT->heading($strheading);
    $yesurl = new moodle_url('/local/newsvnr/orgposition.php', array('id' => $orgposition->id, 'delete' => 1,
        'confirm' => 1, 'sesskey' => sesskey()));
    $message = get_string('confirmdeleteorgposition', 'local_newsvnr', format_string($orgposition->posname));
    echo $OUTPUT->confirm($message, $yesurl, $orgmanagerurl);
    echo $OUTPUT->footer();
    die;
}

$mform_orgposition = new orgposition_edit_form(null,array('orgposition' => $orgposition));
if ($mform_orgposition->is_cancelled()){ 
      redirect($orgmanagerurl);
} else if ($orgposition = $mform_orgposition->get_data()) {
  if($orgposition->orgstructureid)
      $getorgstructeid = $DB->get_field('orgstructure','id',['name' => $orgposition->orgstructureid]);
  if($id){
      
      $orgpositionupdate = (object)array('id' => $orgposition->id, 'name' => $orgposition->posname,'code' => $orgposition->poscode,'namebylaw' => $orgposition->position_namebylaw,'jobtitleid' => $orgposition->jobtitleid,'orgstructureid' => $getorgstructeid,'description' => $orgposition->orgposition_description);
      if (isset($orgposition->submitbutton)) {
          $message = $strupdate;
      }
      if (isset($message)) {
          update_orgposition($orgpositionupdate);
          redirect($url, $message);
      }
  }
  else{

  	  $orgposition->name = $orgposition->posname;
      $orgposition->code = $orgposition->poscode;
      $orgposition->namebylaw = $orgposition->position_namebylaw;
      $orgposition->jobtitleid = $orgposition->jobtitleid;
      $orgposition->orgstructureid = $getorgstructeid;
      $orgposition->description = $orgposition->orgposition_description;

      if (isset($orgposition->submitbutton)) {
          $message = $strInsert;
      }
      if (isset($message)) {
          insert_orgposition($orgposition);
          redirect($url, $message);
      }
  }
}

echo $OUTPUT->header();
if(empty($id)){
  $currenttab = 'orgposition';
  require('tabs.php');
}


echo $mform_orgposition->display();


echo $OUTPUT->footer();