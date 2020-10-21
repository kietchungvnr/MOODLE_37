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
require_once('orgstructure_form.php');
require_once('orgjobtitle_form.php');
require_once('orgposition_form.php');


require_login();
$url = new moodle_url("/local/newsvnr/orgmanager.php");
$orgmainurl = new moodle_url("/local/newsvnr/orgmain.php");
$returnurl = new moodle_url('/local/newsvnr/orgmanager.php');


$title = get_string('orgmanagertitle','local_newsvnr');
$orgmaintitle = get_string('orgmaintitle','local_newsvnr');
$strInsert = get_string('insert','local_newsvnr');

$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add($title);
$PAGE->navbar->add($orgmaintitle,$orgmainurl);
$PAGE->requires->js_call_amd('local_newsvnr/orgmanager','orgmanager');

$orgstructure = new stdClass();
$orgcate = new stdClass();
$orgjobtitle = new stdClass();
$orgposition = new stdClass();


$mform_orgstructure = new orgstructure_form(null,array('orgstructure' => $orgstructure));
$mform_orgjobtitle = new orgjobtitle_form(null,array('orgjobtitle' => $orgjobtitle));
$mform_orgposition = new orgposition_form(null,array('orgposition' => $orgposition));
$mform_orgcate = new orgcate_form(null,array('orgcate' => $orgcate));
if ($mform_orgcate->is_cancelled()){ 
      redirect($returnurl);
} else if ($orgcate = $mform_orgcate->get_data()) {
      $orgcate->name = $orgcate->catename;
      $orgcate->description = $orgcate->orgcate_description;

      if (isset($orgcate->submitbutton)) {
          $message = $strInsert;
      }
      if (isset($message)) {
          insert_orgcategory($orgcate);
          redirect($returnurl, $message);
      }
  }
if ($mform_orgcate->is_cancelled()) {
    redirect($returnurl);
} else if ($orgcate = $mform_orgcate->get_data()) {
  $orgcate->name = $orgcate->catename;
   $orgcate->descriptionformat = $orgcate->orgcate_description['format'];
   $orgcate->description = $orgcate->orgcate_description['text'];
   if (isset($orgcate->submitbutton)) {
      $message = $strInsert;
   }
   if (isset($message)) {
        insert_orgcategory($orgcate);
        redirect($returnurl, $message);
   } 
}

if ($mform_orgstructure->is_cancelled()) {
    redirect($returnurl);
} else if ($orgstructure = $mform_orgstructure->get_data()) {
      $orgstructure->name = $orgstructure->orgname;
      $orgstructure->code = $orgstructure->orgcode;
      $orgstructure->managerid = $orgstructure->managerid;
      $orgstructure->orgstructuretypeid = $orgstructure->orgstructuretypeid;
      $orgstructure->parentid = $orgstructure->parentid;
      $orgstructure->numbermargin = $orgstructure->numbermargin;
      $orgstructure->numbercurrent = $orgstructure->numbercurrent;
      $orgstructure->description = $orgstructure->org_description;
      if (isset($orgstructure->submitbutton)) {
          $message = $strInsert;
      }
      if (isset($message)) {
          insert_orgstructure($orgstructure);
          redirect($returnurl, $message);
      }
}

if ($mform_orgjobtitle->is_cancelled()) {
    redirect($returnurl);
} else if ($orgjobtitle = $mform_orgjobtitle->get_data()) {
    $orgjobtitle->name = $orgjobtitle->jobtitlename;
    $orgjobtitle->code = $orgjobtitle->jobtitlecode;
    $orgjobtitle->namebylaw = $orgjobtitle->jobtitle_namebylaw;
    $orgjobtitle->description = $orgjobtitle->orgjobtitle_description;
    if (isset($orgjobtitle->submitbutton)) {
      $message = $strInsert;
    }
    if (isset($message)) {
        insert_orgjobtitle($orgjobtitle);
        redirect($returnurl, $message);
    } 
}


if ($mform_orgposition->is_cancelled()) {
    redirect($returnurl);
} else if ($orgposition = $mform_orgposition->get_data()) {
    $orgposition->name = $orgposition->posname;
    $orgposition->code = $orgposition->poscode;
    $orgposition->namebylaw = $orgposition->position_namebylaw;
    $orgposition->description = $orgposition->orgposition_description;
    if (isset($orgposition->submitbutton)) {
      $message = $strInsert;
    }
    if (isset($message)) {
        insert_orgposition($orgposition);
        redirect($returnurl, $message);
    }
}
$output = $PAGE->get_renderer('local_newsvnr');
$page = new \local_newsvnr\output\orgmanager_page();

echo $output->header();
echo $output->render($page);

echo $output->footer();