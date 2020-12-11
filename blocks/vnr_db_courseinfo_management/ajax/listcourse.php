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

require_once __DIR__ . '/../../../config.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_login();
$PAGE->set_context(context_system::instance());

$pagesize = optional_param('pagesize', 10, PARAM_INT);
$pagetake = optional_param('take', 0, PARAM_INT);
$pageskip = optional_param('skip', 0, PARAM_INT);
$q        = optional_param('q', '', PARAM_RAW);
$userid   = optional_param('userid', '', PARAM_INT);
$role     = optional_param('role', '', PARAM_INT);
$data     = array();
$odersql  = "";
$wheresql = "WHERE ra.roleid=$role AND u.id = $userid";
if ($q) {
    $wheresql = "WHERE ra.roleid=$role AND u.id = $userid AND c.fullname like N'%$q%'";
}
if ($pagetake == 0) {
    $ordersql = "RowNum";
} else {
    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
}
$sql = "SELECT *,(SELECT COUNT(DiSTINCT c.id)
                    FROM mdl_user_enrolments ue
                        JOIN mdl_enrol e ON ue.enrolid = e.id
                        JOIN mdl_course c ON e.courseid = c.id
                        JOIN mdl_role_assignments ra ON ra.userid = ue.userid
                        JOIN mdl_user u ON u.id = ra.userid
                        JOIN mdl_context as ct on ra.contextid= ct.id AND ct.instanceid = c.id
                        LEFT JOIN mdl_course_completions cc ON cc.userid = c.id $wheresql) AS total
        FROM (SELECT ROW_NUMBER() OVER (ORDER BY c.id) AS RowNum,c.*,cc.timecompleted,u.usercode
              FROM mdl_user_enrolments ue
                JOIN mdl_enrol e ON ue.enrolid = e.id
                JOIN mdl_course c ON e.courseid = c.id
                JOIN mdl_role_assignments ra ON ra.userid = ue.userid
                JOIN mdl_user u ON u.id = ra.userid
                JOIN mdl_context as ct on ra.contextid= ct.id AND ct.instanceid = c.id 
                LEFT JOIN mdl_course_completions cc ON cc.userid = c.id AND cc.course = c.id $wheresql) AS Mydata
        ORDER BY $ordersql";
$get_list = $DB->get_records_sql($sql);
foreach ($get_list as $value) {
    $student          = $DB->get_record('user', ['id' => $userid]);
    $get_grade        = get_finalgrade_student($userid, $value->id);
    $obj              = new stdCLass();
    $course           = $DB->get_record('course', ['id' => $value->id]);
    $process          = round(\core_completion\progress::get_course_progress_percentage($course, $userid));
    $obj->number      = $value->rownum;
    $obj->usercode    = ($value->usercode) ? $value->usercode : "-";
    $obj->studentname = $student->firstname . ' ' . $student->lastname;
    $obj->coursename  = $value->fullname;
    $obj->courseid    = $value->shortname;
    $obj->total       = $value->total;
    if (!empty($get_grade)) {
        $obj->rank       = $get_grade->rank;
        $obj->gradefinal = $get_grade->gradefinal;
    } else {
        $obj->rank       = '-';
        $obj->gradefinal = '-';
    }
    $obj->process = ($role == 5) ? $process . '%' : "-";
    if ($value->timecompleted != null) {
        $obj->timecompleted = convertunixtime('d/m/Y', $value->timecompleted, 'Asia/Ho_Chi_Minh');
    } else {
        $obj->timecompleted = '-';
    }
    $data[] = $obj;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
die;
