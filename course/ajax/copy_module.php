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

 
define('AJAX_SCRIPT', false);

require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/../../local/newsvnr/lib.php');
$PAGE->set_context(context_system::instance());
require_login();
$action  = required_param('action',PARAM_ALPHANUMEXT);
$courseid  = optional_param('courseid', 0,PARAM_INT);
$userid  = optional_param('userid', 0,PARAM_INT);

$pagesize = optional_param('pagesize', 10, PARAM_INT);
$pagetake = optional_param('take',0, PARAM_INT);
$pageskip = optional_param('skip',0, PARAM_INT);
$q = optional_param('q','', PARAM_RAW);
$data = [];
switch ($action) {
	case 'list_module':
		$course = $DB->get_record('course', ['id' => $courseid]);
		$allmodinfo = get_fast_modinfo($course)->get_cms();
		foreach ($allmodinfo as $modinfo) {
			if($modinfo->modname == 'resource') {
				$img = $OUTPUT->image_url($modinfo->icon);
			} else {
				$img = $OUTPUT->image_url('icon', $modinfo->modname);
			}
			$modules = new stdClass;
			$modules->name = $modinfo->name;
			$modules->value = $modinfo->id;
			$modules->module_icon = '<img  class="pr-2 img-module" src="' . $img . '">';
			$data[] = $modules;
		}
	break;
	case 'list_course':
		if(is_siteadmin()) {
			$ist_course = get_list_courseinfo_by_admin_kendo($pagetake, $pageskip, $q);
		} else {
			$ist_course = get_list_courseinfo_by_teacher_kendo($userid, $pagetake, $pageskip, $q);
		}
    	foreach($ist_course as $course) {
    		$obj = new stdclass;
    		$obj->value = $course->courseid;
    		$obj->name = $course->coursename;
    		$data[] = $obj;
    	}
		break;
	case 'copy_module':
		$listmodule  = optional_param('listmodule', '',PARAM_RAW);
		$listcourse  = optional_param('listcourse', '',PARAM_RAW);
		$listmodules = explode(",", $listmodule);
		$listcourses = explode(",", $listcourse);
		foreach (array_values($listcourses) as $coursekey => $courseid) {
			foreach (array_values($listmodules) as $modulekey => $module) {
				list($courseinfo, $cm) = get_course_and_cm_from_cmid($module);
		        $courseinfo            = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
		        $newcm             = new stdClass;
		        $newcm->id         = $cm->id;
		        $newcm->modname    = $cm->modname;
		        $newcm->name       = $cm->name;
		        $newcm->section    = (int)$DB->get_field_sql('SELECT TOP 1 * 
		        												FROM mdl_course_sections 
		        												WHERE course = :courseid', ['courseid' => $courseid]);
		        $newcm->course     = (int)$courseid;
		        $newcm             = duplicate_module_library($courseinfo, $newcm);
			}
		}
	    $data['success']   = get_string('sharemodulesuccess', 'local_newsvnr');

		break;
	default:
	break;
}   

echo json_encode($data,JSON_UNESCAPED_UNICODE);

die();