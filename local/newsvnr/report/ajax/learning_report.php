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
require_once $CFG->dirroot . '/lib/completionlib.php';
require_login();
$PAGE->set_context(context_system::instance());
$pagesize     = optional_param('pagesize', 10, PARAM_INT);
$pagetake     = optional_param('take', 0, PARAM_INT);
$pageskip     = optional_param('skip', 0, PARAM_INT);
$action       = optional_param('action', '', PARAM_RAW);
$startprocess = optional_param('startprocess', 0, PARAM_INT);
$endprocess   = optional_param('endprocess', 0, PARAM_INT);
$wheresql     = "WHERE ra.roleid=5 AND ue.status = 0 AND c.visible = 1 ";
$status       = optional_param('status', 0, PARAM_INT);
if ($pagetake == 0) {
    $ordersql = "RowNum";
} else {
    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
}
switch ($action) {
    case 'searchaccount':
        $username  = optional_param('username', '', PARAM_RAW);
        $courseid  = optional_param('courseid', 0, PARAM_INT);
        $datestart = optional_param('datestart', 0, PARAM_INT);
        $dateend   = optional_param('dateend', 0, PARAM_INT);
        $wheresql .= "AND CONCAT(u.firstname,' ',u.lastname) LIKE '%$username%'";
        $wheresql .= ($courseid) ? "AND c.id = $courseid" : '';
        if ($datestart != 0 && $dateend != 0) {
            $wheresql .= "AND ue.timestart > $datestart AND ue.timestart < $dateend";
        } elseif ($datestart != 0) {
            $wheresql .= "AND ue.timestart > $datestart";
        } elseif ($dateend != 0) {
            $wheresql .= "AND ue.timestart < $dateend";
        }
        break;
    case 'searchorgstructure':
        $orgstructureid = optional_param('orgstructureid', 0, PARAM_INT);
        $positionid     = optional_param('positionid', 0, PARAM_INT);
        if ($orgstructureid || $positionid) {
            $conditionplus = '';
            $conditionplus .= ($positionid) ? "AND op.id = $positionid " : '';
            $conditionplus .= ($orgstructureid) ? "AND org.id = $orgstructureid " : '';
            $wheresql .= "AND u.orgpositionid in (select op.id from {orgstructure_position} op
                            JOIN {orgstructure} org on org.id = op.orgstructureid
                        where 1 = 1 $conditionplus)";
        }
        break;
    default:
        break;
}
$all = $DB->get_records_sql("SELECT ROW_NUMBER() OVER (ORDER BY c.id) AS RowNum,CONCAT(u.firstname,' ',u.lastname) as name,c.fullname as coursename,u.id as userid,c.id as courseid
                                FROM {role_assignments} AS ra
                                    JOIN {user} AS u ON u.id= ra.userid
                                    JOIN {user_enrolments} AS ue ON ue.userid=u.id
                                    JOIN {enrol} AS e ON e.id=ue.enrolid
                                    JOIN {course} AS c ON c.id=e.courseid
                                    JOIN {context} AS ct ON ct.id=ra.contextid AND ct.instanceid= c.id
                                    JOIN {role} AS r ON r.id= ra.roleid
                                    LEFT JOIN mdl_course_completions cc ON cc.userid = c.id AND cc.course = c.id $wheresql");
$sql = "SELECT ROW_NUMBER() OVER (ORDER BY c.id) AS RowNum,CONCAT(u.firstname,' ',u.lastname) as name,c.fullname as coursename,c.*,cc.timecompleted,u.id as userid,c.id as courseid,ue.timestart
        FROM {role_assignments} AS ra
            JOIN {user} AS u ON u.id= ra.userid
            JOIN {user_enrolments} AS ue ON ue.userid=u.id
            JOIN {enrol} AS e ON e.id=ue.enrolid
            JOIN {course} AS c ON c.id=e.courseid
            JOIN {context} AS ct ON ct.id=ra.contextid AND ct.instanceid= c.id
            JOIN {role} AS r ON r.id= ra.roleid
            LEFT JOIN mdl_course_completions cc ON cc.userid = c.id AND cc.course = c.id $wheresql ORDER BY $ordersql";
if ($startprocess || $endprocess || $status) {
    foreach ($all as $key => $value) {
        $course     = $DB->get_record('course', ['id' => $value->courseid]);
        $cinfo      = new completion_info($course);
        $iscomplete = $cinfo->is_course_complete($value->userid);
        if ($startprocess) {
            if ($process < $startprocess) {
                unset($all[$key]);
            }
        }
        if ($endprocess) {
            if ($process > $endprocess) {
                unset($all[$key]);
            }
        }
        if ($status) {
            if ($status == 2 && $iscomplete == false) {
                unset($all[$key]);
            }
            if ($status == 1 && $iscomplete == true) {
                unset($all[$key]);
            }
        }
    }
}
$get_list = $DB->get_records_sql($sql);
$data     = [];
foreach ($get_list as $value) {
    $course     = $DB->get_record('course', ['id' => $value->courseid]);
    $process    = round(\core_completion\progress::get_course_progress_percentage($course, $value->userid));
    $cinfo      = new completion_info($course);
    $iscomplete = $cinfo->is_course_complete($value->userid);
    if ($startprocess) {
        if ($process < $startprocess) {
            continue;
        }
    }
    if ($endprocess) {
        if ($process > $endprocess) {
            continue;
        }
    }
    if ($status) {
        if ($status == 2 && $iscomplete == false) {
            continue;
        }
        if ($status == 1 && $iscomplete == true) {
            continue;
        }
    }
    $timespenttotal     = 0;
    $get_grade          = get_finalgrade_student($value->userid, $value->courseid);
    $object             = new stdClass();
    $user               = $DB->get_record("user", ['id' => $value->userid]);
    $object->name       = $OUTPUT->user_picture($user) . '<a target="_blank" href="' . $CFG->wwwroot . '/user/profile.php?id=' . $value->id . '">' . $value->name . '</a>';
    $object->coursename = '<a target="_blank" href="' . $CFG->wwwroot . '/course/view.php?id=' . $value->courseid . '">' . $value->coursename . '</a>';
    $object->grade      = (!empty($get_grade)) ? $get_grade->gradefinal : '-';
    $object->timestart  = convertunixtime('d/m/Y', $value->timestart, 'Asia/Ho_Chi_Minh');
    $object->process    = $process . '%';
    $object->status     = ($iscomplete == false) ? '<div class="text-center"><span class="badge text-white teacher-bg-2 font-weight-bold rounded p-2">Chưa hoàn thành</span></div<>' : '<div class="text-center"><span class="badge text-white teacher-bg-3 font-weight-bold rounded p-2">' . get_string('finished', 'local_newsvnr') . '</span></div>';
    if ($value->timecompleted != null) {
        $object->timecompleted = convertunixtime('d/m/Y', $value->timecompleted, 'Asia/Ho_Chi_Minh');
    } else {
        $object->timecompleted = '-';
    }
    $dm   = new block_dedication_manager($course, $course->startdate, time(), 3600);
    $rows = $dm->get_user_dedication($user);
    foreach ($rows as $index => $row) {
        $timespenttotal += $row->dedicationtime;
    }
    $object->timeaccess = block_dedication_utils::format_dedication($timespenttotal);
    $object->total      = count($all);
    $data[]             = $object;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
