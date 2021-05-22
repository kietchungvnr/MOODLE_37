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
require_once $CFG->dirroot . '/blocks/dedication/dedication_lib.php';
require_login();
$PAGE->set_context(context_system::instance());
$pagesize = optional_param('pagesize', 10, PARAM_INT);
$pagetake = optional_param('take', 0, PARAM_INT);
$pageskip = optional_param('skip', 0, PARAM_INT);
$action   = optional_param('action', '', PARAM_RAW);
$wheresql = "WHERE deleted <> 1 AND id <> $CFG->siteguest ";
if ($pagetake == 0) {
    $ordersql = "RowNum";
} else {
    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
}
switch ($action) {
    case 'searchaccount':
        $username      = optional_param('username', '', PARAM_RAW);
        $useremail     = optional_param('useremail', '', PARAM_RAW);
        $usercode      = optional_param('usercode', '', PARAM_RAW);
        $userstatus    = optional_param('userstatus', 0, PARAM_INT);
        $notaccess     = optional_param('notaccess', '', PARAM_BOOL);
        $notmodify     = optional_param('notmodify', '', PARAM_BOOL);
        $notcourse     = optional_param('notcourse', '', PARAM_BOOL);
        $conditionplus = '';
        $conditionplus .= ($notaccess == 1) ? 'AND lastaccess = 0' : '';
        $conditionplus .= ($notmodify == 1) ? 'AND timecreated = timemodified' : '';
        $wheresql .= "AND username LIKE '%$username%' AND email LIKE '%$useremail%' AND usercode LIKE '%$usercode%' AND suspended = $userstatus $conditionplus";
        break;
    case 'searchorgstructure':
        $orgstructureid = optional_param('orgstructureid', 0, PARAM_INT);
        $positionid     = optional_param('positionid', 0, PARAM_INT);
        if ($orgstructureid || $positionid) {
            $conditionplus = '';
            $conditionplus .= ($positionid) ? "AND op.id = $positionid " : '';
            $conditionplus .= ($orgstructureid) ? "AND org.id = $orgstructureid " : '';
            $wheresql .= "AND orgpositionid in (select op.id from {orgstructure_position} op
                            JOIN {orgstructure} org on org.id = op.orgstructureid
                        where 1 = 1 $conditionplus)";
        }

        break;
    case 'searchadvance':
        $systemroleid = optional_param('systemroleid', 0, PARAM_INT);
        $courseroleid = optional_param('courseroleid', 0, PARAM_INT);
        $courseid     = optional_param('courseid', 0, PARAM_INT);
        $datestart    = optional_param('datestart', 0, PARAM_INT);
        $dateend      = optional_param('dateend', 0, PARAM_INT);
        if ($systemroleid) {
            $wheresql .= "AND id IN (SELECT userid
                                        FROM {role_assignments} ra
                                    WHERE ra.roleid = $systemroleid AND ra.contextid = 1)";
        }
        if ($courseroleid) {
            $conditioncourse = '';
            if ($courseid) {
                $conditioncourse = "AND c.id = $courseid";
            }
            $wheresql .= "AND id IN (SELECT userid
                            FROM {role_assignments} a
                        INNER JOIN {context} b ON a.contextid=b.id
                        INNER JOIN {course} c ON b.instanceid=c.id
                            WHERE b.contextlevel=50 AND a.roleid = $courseroleid $conditioncourse)";
        }
        if ($datestart != 0 && $dateend != 0) {
            $wheresql .= "AND lastaccess > $datestart AND lastaccess < $dateend";
        } elseif ($datestart != 0) {
            $wheresql .= "AND lastaccess > $datestart";
        } elseif ($dateend != 0) {
            $wheresql .= "AND lastaccess < $dateend";
        }
        break;
    default:
        break;
}
$sql = "SELECT *, (SELECT COUNT(id) FROM {user} $wheresql) AS total
                FROM (
                    SELECT *,CONCAT(firstname,' ',lastname) as name,ROW_NUMBER() OVER (ORDER BY id) AS RowNum
                    FROM {user} $wheresql
                ) AS Mydata
                ORDER BY $ordersql";
$get_list = $DB->get_records_sql($sql);
$data     = [];
foreach ($get_list as $value) {
    $object              = new stdClass();
    $object->id          = $value->id;
    $user                = $DB->get_record("user", ['id' => $value->id]);
    $object->suspended   = $value->suspended;
    $object->useravatar  = $OUTPUT->user_picture($user);
    $object->name        = $value->name;
    $object->href        = $CFG->wwwroot . '/user/profile.php?id=' . $value->id;
    $object->shortname   = (isset($value->shortname)) ? $value->shortname : '';
    $object->email       = $value->email;
    $object->timecreated = convertunixtime('d/m/Y', $value->timecreated, 'Asia/Ho_Chi_Minh');
    $timespenttotal      = 0;
    $courses             = enrol_get_all_users_courses($value->id);
    foreach ($courses as $course) {
        // Số giờ truy cập của user
        $dm   = new block_dedication_manager($course, $course->startdate, time(), 3600);
        $rows = $dm->get_user_dedication($USER);
        foreach ($rows as $index => $row) {
            $timespenttotal += $row->dedicationtime;
        }
    }
    $object->timeaccess = block_dedication_utils::format_dedication($timespenttotal);
    if ($value->lastaccess) {
        $object->lastaccess = convertunixtime('d/m/Y', $value->lastaccess, 'Asia/Ho_Chi_Minh') . " (" . format_time(time() - $value->lastaccess) . ")";
    } else {
        $object->lastaccess = get_string("never");
    }
    $object->total = $value->total;
    $data[]        = $object;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
