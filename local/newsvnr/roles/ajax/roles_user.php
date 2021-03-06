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
$pagesize = optional_param('pagesize', 10, PARAM_INT);
$pagetake = optional_param('take', 0, PARAM_INT);
$pageskip = optional_param('skip', 0, PARAM_INT);
$action   = optional_param('action', '', PARAM_RAW);
$wheresql = "";
if ($pagetake == 0) {
    $ordersql = "RowNum";
} else {
    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
}
$data   = array();
switch ($action) {
    case 'get_userstatus':
        $data = [
            ['name' => 'Tài khoản bị đình chỉ', 'value' => 1],
            ['name' => 'Tài khoản bình thường', 'value' => 0],
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
            ['name' => 'Người quản lý', 'value' => 1],
            ['name' => 'Giáo viên biên soạn', 'value' => 3],
            ['name' => 'supervisor', 'value' => 11],
        ];
        break;
    case 'get_course_role';
        $data = [
            ['name' => 'Học viên', 'value' => 5],
            ['name' => 'Giáo viên', 'value' => 3],
            ['name' => 'Người quản lý', 'value' => 1],
        ];
        break;
    case 'get_course';
        $courses = $DB->get_records('course', ['visible' => 1]);
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
            ['name' => 'Hoàn thành', 'value' => 2],
            ['name' => 'Chưa hoàn thành', 'value' => 1],
        ];
        break;
    case 'get_report':
        $data = [
            ['name' => 'Báo cáo tiến độ học tập', 'value' => 'learning'],
            ['name' => 'Báo cáo kế hoạch đào tạo', 'value' => 'trainingplan'],
            ['name' => 'Báo cáo hồ sơ năng lực', 'value' => 'competency'],
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
    case 'get_list_user':
        $users = $DB->get_records_sql('SELECT * FROM {user} WHERE confirmed = 1 AND deleted = 0 AND suspended = 0 AND id > 2');
        foreach ($users as $user) {
            $object             = new stdClass();
            $object->name       = $user->firstname . ' ' . $user->lastname;
            $object->value      = $user->id;
            $data[]             = $object;
        }
        break;
    case 'get_capabilities_user':
        $userid = optional_param('userid', '', PARAM_RAW);
        $context = context_user::instance($userid);
        $capabilities = $context->get_capabilities();
        $data[] = $capabilities;
        break;
    default:
        break;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
