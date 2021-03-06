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

require_once __DIR__ . '/../../../../config.php';
require_once __DIR__ . '/../../lib.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_login();
$action = optional_param('action', '', PARAM_RAW);
$data   = array();
switch ($action) {
    case 'get_userstatus':
        $data = [
            ['name' => get_string('accoutsuspend', 'local_newsvnr'), 'value' => 1],
            ['name' => get_string('accoutnormal', 'local_newsvnr'), 'value' => 0],
        ];

        break;
    case 'get_orgstructure_category':
        $categorys = $DB->get_records('orgstructure_category', ['visible' => 1]);
        foreach ($categorys as $category) {
            $object             = new stdClass();
            $object->name       = $category->name;
            $object->categoryid = $category->id;
            $data[]             = $object;
        }
        break;
    case 'get_orgstructure';
        $orgs = $DB->get_records('orgstructure', ['visible' => 1]);
        foreach ($orgs as $org) {
            $object             = new stdClass();
            $object->name       = $org->name;
            $object->categoryid = $org->orgstructuretypeid;
            $object->orgid      = $org->id;
            $data[]             = $object;
        }
        break;
    case 'get_orgstructure_jobtitle';
        $jobtitles = $DB->get_records('orgstructure_jobtitle', ['visible' => 1]);
        foreach ($jobtitles as $jobtitle) {
            $object             = new stdClass();
            $object->name       = $jobtitle->name;
            $object->jobtitleid = $jobtitle->id;
            $data[]             = $object;
        }
        break;
    case 'get_orgstructure_position';
        $positions = $DB->get_records('orgstructure_position', ['visible' => 1]);
        foreach ($positions as $position) {
            $object             = new stdClass();
            $object->name       = $position->name;
            $object->jobtitleid = $position->jobtitleid;
            $object->positionid = $position->id;
            $data[]             = $object;
        }
        break;
    case 'get_system_role';
        $data = [
            ['name' => get_string('manager', 'local_newsvnr'), 'value' => 1],
            ['name' => get_string('teachereditor', 'local_newsvnr'), 'value' => 3],
            ['name' => get_string('supervisor', 'local_newsvnr'), 'value' => 11],
        ];
        break;
    case 'get_course_role';
        $data = [
            ['name' => get_string('student', 'local_newsvnr'), 'value' => 5],
            ['name' => get_string('teacher', 'local_newsvnr'), 'value' => 3],
            ['name' => get_string('manager', 'local_newsvnr'), 'value' => 1],
        ];
        break;
    case 'get_course';
        $courses = $DB->get_records('course', ['visible' => 1]);
        $courses = $DB->get_records_sql('select * from {course} where visible = 1 AND id <> 1');
        foreach ($courses as $course) {
            $object       = new stdClass();
            $object->name = $course->fullname;
            $object->id   = $course->id;
            $data[]       = $object;
        }
        break;
    case 'get_competency':
        $competencys = $DB->get_records('competency');
        foreach ($competencys as $competency) {
            $object        = new stdClass();
            $object->name  = $competency->shortname;
            $object->value = $competency->id;
            $data[]        = $object;
        }
        break;
    case 'get_competencyplan':
        $competencyplans = $DB->get_records_sql('select DISTINCT name from mdl_competency_plan');
        foreach ($competencyplans as $competencyplan) {
            $object        = new stdClass();
            $object->name  = $competencyplan->name;
            $object->value = $competencyplan->name;
            $data[]        = $object;
        }
        break;
    case 'get_learning_status':
        $data = [
            ['name' => get_string('finished', 'local_newsvnr'), 'value' => 2],
            ['name' => get_string('unfinished', 'local_newsvnr'), 'value' => 1],
        ];
        break;
    case 'get_report':
        $data = [
            ['name' => get_string('learningreport', 'local_newsvnr'), 'value' => 'learning'],
            ['name' => get_string('trainingplanreport', 'local_newsvnr'), 'value' => 'trainingplan'],
            ['name' => get_string('competencyreport', 'local_newsvnr'), 'value' => 'competency'],
        ];
        break;
    case 'get_route':
        $routes = $DB->get_records('competency_template', ['visible' => 1]);
        foreach ($routes as $route) {
            $object        = new stdClass();
            $object->name  = $route->shortname;
            $object->value = $route->id;
            $data[]        = $object;
        }
        break;
    case 'get_division':
        $divisions = $DB->get_records('division', ['visible' => 1]);
        foreach ($divisions as $division) {
            $object       = new stdClass();
            $object->name = $division->name;
            $object->id   = $division->id;
            $data[]       = $object;
        }
        break;
    default:
        break;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
