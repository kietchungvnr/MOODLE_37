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
$role     = optional_param('role', '', PARAM_INT);
$data     = array();
$odersql  = "";
$wheresql = "WHERE ra.roleid=$role";
if ($q) {
    $wheresql = "WHERE ra.roleid=$role AND CONCAT(u.firstname,' ',u.lastname) like N'%$q%'";
}
if ($pagetake == 0) {
    $ordersql = "RowNum";
} else {
    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
}
$sql = "SELECT *, (SELECT COUNT(DISTINCT u.id)
                    FROM mdl_user u
                        JOIN mdl_role_assignments ra ON ra.userid = u.id $wheresql
                ) AS total
        FROM (SELECT ROW_NUMBER() OVER (ORDER BY u.id) AS RowNum,u.id AS userid,CONCAT(u.firstname,' ',u.lastname) as name
                FROM mdl_user u
                    JOIN mdl_role_assignments ra ON ra.userid = u.id
                $wheresql GROUP BY u.id,CONCAT(u.firstname,' ',u.lastname)
                ) AS Mydata
        ORDER BY $ordersql";

$get_list = $DB->get_records_sql($sql);
// var_dump($get_list);
foreach ($get_list as $value) {
    $enrolledcourse = get_list_course_by_student($value->userid);
    $listcourse     = get_list_course_by_teacher($value->userid);
    $string         = get_string('lastsiteaccess');
    $obj            = new stdCLass();
    $user           = $DB->get_record("user", ['id' => $value->userid]);
    $useravatar     = $OUTPUT->user_picture($user);
    if ($user->lastaccess) {
        $obj->lastaccess = convertunixtime('d/m/Y', $user->lastaccess, 'Asia/Ho_Chi_Minh') . " (" . format_time(time() - $user->lastaccess) . ")";
    } else {
        $obj->lastaccess = get_string("never");
    }
    $obj->useravatar     = $useravatar;
    $obj->href           = $CFG->wwwroot . '/user/profile.php?id=' . $value->userid;
    $obj->number         = $value->rownum;
    $obj->studentcode    = $value->userid;
    $obj->name           = $value->name;
    $obj->total          = $value->total;
    $obj->coursejoin     = count($listcourse);
    $obj->enrolledcourse = count($enrolledcourse);
    $data[]              = $obj;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
die;
