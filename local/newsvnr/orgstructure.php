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
require_once('orgstructure_edit_form.php');
require_login();
require_capability('moodle/site:approvecourse', context_system::instance());
$id = optional_param('id',0,PARAM_INT);
$delete = optional_param('delete',0,PARAM_BOOL);
$confirm   = optional_param('confirm', 0, PARAM_BOOL);
$orgmanagertitle = get_string('orgmanagertitle','local_newsvnr');
$strInsert = get_string('insert','local_newsvnr');
$strDelete = get_string('delete', 'local_newsvnr');
$strupdate = get_string('edit', 'local_newsvnr');
$title = get_string('orgtitlepage','local_newsvnr');

$params = [];
if($id){
  $params['id'] = $id;
}


$url = new moodle_url('/local/newsvnr/orgstructure.php',$params);
$orgmanagerurl = new moodle_url('/local/newsvnr/orgmanager.php');


if($id){
    $heading = get_string('orgstructureupdate','local_newsvnr');

    $orgstructuredb = $DB->get_records('orgstructure',array('id'=>$id));
    $orgstructure = new stdClass();
    foreach($orgstructuredb as $value){
      $orgstructure->id = $value->id;
      $orgstructure->orgname = $value->name;
      $orgstructure->orgcode = $value->code;
      $orgstructure->managerid =  $value->managerid;
      $orgstructure->orgstructuretypeid = $value->orgstructuretypeid;
      $orgstructure->parentid = $DB->get_field('orgstructure','name',['id' => $value->parentid]);
      $orgstructure->numbermargin = $value->numbermargin;
      $orgstructure->numbercurrent =  $value->numbercurrent;
      $orgstructure->org_description = $value->description;
    }
}else{
    $heading = get_string('orgstructurecreate','local_newsvnr');

    $orgstructure = new stdClass();
    // $orgstructure->id = 0;
    // $orgstructure->name = '';
    // $orgstructure->code = '';
    // $orgstructure->managerid = 0;
    // $orgstructure->orgstructuretypeid = 0;
    // $orgstructure->parentid = 0;
    // $orgstructure->numbermargin = 0;
    // $orgstructure->numbercurrent = 0;
    // $orgstructure->description = '';
    
}



$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($heading);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add($orgmanagertitle,$orgmanagerurl);
$PAGE->navbar->add($title);

$PAGE->requires->js_call_amd('local_newsvnr/orgstructure','orgstructure');


if($delete){
   $PAGE->url->param('delete', 1);
    if ($confirm and confirm_sesskey()) {
        delete_orgstructure($orgstructure->id);
        redirect($orgmanagerurl,$strDelete);
    }
    $strheading = get_string('deleteorgstructure', 'local_newsvnr');
    $PAGE->navbar->add($strheading);
    $PAGE->set_title($strheading);
    $PAGE->set_heading($COURSE->fullname);
    echo $OUTPUT->header();
    echo $OUTPUT->heading($strheading);
    $yesurl = new moodle_url('/local/newsvnr/orgstructure.php', array('id' => $orgstructure->id, 'delete' => 1,
        'confirm' => 1, 'sesskey' => sesskey()));
    $message = get_string('confirmdeleteorgstructure', 'local_newsvnr', format_string($orgstructure->orgname));
    echo $OUTPUT->confirm($message, $yesurl, $orgmanagerurl);
    echo $OUTPUT->footer();
    die;
}
$mform_orgstructure = new orgstructure_edit_form(null,array('orgstructure' => $orgstructure));

if ($mform_orgstructure->is_cancelled()) {
    redirect($orgmanagerurl);
} else if ($orgstructure = $mform_orgstructure->get_data()) {
  if($orgstructure->parentid)
    $getorgstructeid = $DB->get_field('orgstructure','id',['name' => $orgstructure->parentid]);
  if($id){

    $orgstructureupdate = (object)array('id' => $orgstructure->id,'name' => $orgstructure->orgname,'code' => $orgstructure->orgcode,'managerid' => $orgstructure->managerid,'orgstructuretypeid' => $orgstructure->orgstructuretypeid,'parentid' => $getorgstructeid,'numbermargin' => $orgstructure->numbermargin,'numbercurrent' => $orgstructure->numbercurrent,'description' => $orgstructure->org_description);
    if (isset($orgstructure->submitbutton)) {
        $message = $strupdate;
    }
    if (isset($message)) {
        update_orgstructure($orgstructureupdate);
        redirect($url, $message);
    }
  }
  else{
      $orgstructure->name = $orgstructure->orgname;
      $orgstructure->code = $orgstructure->orgcode;
      $orgstructure->managerid = $orgstructure->managerid;
      $orgstructure->orgstructuretypeid = $orgstructure->orgstructuretypeid;
      $orgstructure->parentid = $getorgstructeid;
      $orgstructure->numbermargin = $orgstructure->numbermargin;
      $orgstructure->numbercurrent = $orgstructure->numbercurrent;
      $orgstructure->description = $orgstructure->org_description;

      if (isset($orgstructure->submitbutton)) {
          $message = $strInsert;
      }
      if (isset($message)) {
          insert_orgstructure($orgstructure);
          redirect($url, $message);
      }
  }
}

echo $OUTPUT->header();
if(empty($id)){
  $currenttab = 'orgstructure';
  require('tabs.php');
}

echo $mform_orgstructure->display();


echo $OUTPUT->footer();
