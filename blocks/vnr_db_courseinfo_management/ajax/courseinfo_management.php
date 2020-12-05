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
require_once "{$CFG->libdir}/completionlib.php";
require_login();
$PAGE->set_context(context_system::instance());

$pagesize  = optional_param('pagesize', 10, PARAM_INT);
$pagetake  = optional_param('take', 0, PARAM_INT);
$pageskip  = optional_param('skip', 0, PARAM_INT);
$q         = optional_param('q', '', PARAM_RAW);
$datestart = optional_param('datestart', 0, PARAM_INT);
$dateend   = optional_param('dateend', 0, PARAM_INT);
$data      = array();
$odersql   = "";
$wheresql  = "WHERE id != 1";
if ($q) {
    $wheresql .= "AND fullname LIKE N'%$q%'";
}
if ($datestart != 0 && $dateend != 0) {
    $wheresql .= "AND startdate > $datestart AND enddate < $dateend";
} elseif ($datestart != 0) {
    $wheresql .= "AND startdate > $datestart";
} elseif ($dateend != 0) {
    $wheresql .= "AND enddate < $dateend";
}
if ($pagetake == 0) {
    $ordersql = "RowNum";
} else {
    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
}

$sql = "SELECT *,
            (SELECT COUNT(id) FROM {course} $wheresql) AS total
                FROM (SELECT *,ROW_NUMBER() OVER (ORDER BY id) AS RowNum
                FROM {course} $wheresql) AS Mydata
            ORDER BY $ordersql";
$get_list = $DB->get_records_sql($sql);
foreach ($get_list as $value) {
    $sttuser       = '';
    $params        = [];
    $i             = $j             = $sum             = $max             = $min             = 0;
    $course_object = $DB->get_record('course', ['id' => $value->id]);
    $cinfo         = new completion_info($course_object);
    $list_user     = $DB->get_records_sql("SELECT u.*
                                        FROM mdl_user_enrolments ue
                                            JOIN mdl_enrol e ON ue.enrolid = e.id
                                            JOIN mdl_course c ON e.courseid = c.id
                                            JOIN mdl_role_assignments ra ON ra.userid = ue.userid
                                            JOIN mdl_user u ON u.id = ra.userid
                                            JOIN mdl_context as ct on ra.contextid= ct.id AND ct.instanceid = c.id
                                        where ra.roleid=5 AND c.id =:courseid", ['courseid' => $value->id]);
    foreach ($list_user as $user) {
        // Kiểm tra số học viên chưa hoàn thành khóa
        $iscomplete = $cinfo->is_course_complete($user->id);
        if ($iscomplete == false) {
            $i++;
        }
        $list_grade = get_finalgrade_student($user->id, $value->id);
        if (!empty($list_grade)) {
            $sum = $list_grade->gradefinal + $sum;
            $j++;
            $max = max($max, $list_grade->gradefinal);
            if ($min == 0) {
                $min = $list_grade->gradefinal;
            }
            $min = min($min, $list_grade->gradefinal);
        }
    }
    $obj             = new stdClass();
    $obj->href       = $CFG->wwwroot . '/course/view.php?id=' . $value->id;
    $obj->courseid   = $value->shortname;
    $obj->coursename = $value->fullname;
    $obj->startdate  = convertunixtime('d/m/Y', $value->startdate, 'Asia/Ho_Chi_Minh');
    if ($value->enddate != 0) {
        $obj->enddate = convertunixtime('d/m/Y', $value->enddate, 'Asia/Ho_Chi_Minh');
    } else {
        $obj->enddate = '-';
    }
    $obj->totalstudent    = count($list_user);
    $obj->studentunfinish = $i . ' / ' . count($list_user);
    if ($sum != 0) {
        $obj->courseaveragepoint = $sum / $j;
        $obj->highestpoint       = $max;
        $obj->lowestpoint        = $min;
    } else {
        $obj->courseaveragepoint = '-';
        $obj->highestpoint       = '-';
        $obj->lowestpoint        = '-';
    }
    $obj->total = $value->total;
    $data[]     = $obj;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
die;
