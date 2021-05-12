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
$startprocess = optional_param('startprocess', 0, PARAM_INT);
$endprocess   = optional_param('endprocess', 0, PARAM_INT);
$wheresql = "";
if ($pagetake == 0) {
    $ordersql = "RowNum";
} else {
    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
}
switch ($action) {
    case 'searchaccount':
        $username  = optional_param('username', '', PARAM_RAW);
        $route     = optional_param('route', 0, PARAM_INT);
        $datestart = optional_param('datestart', 0, PARAM_INT);
        $dateend   = optional_param('dateend', 0, PARAM_INT);
        $status       = optional_param('status', 0, PARAM_INT);
        $wheresql .= "AND CONCAT(us.firstname,' ',us.lastname) LIKE N'%$username%' ";
        $wheresql .= ($status == 2) ? "AND cp.status = 2 " : "";
        $wheresql .= ($status == 1) ? "AND cp.status <> 2 " : "";
        $wheresql .= ($route) ? "AND ct.id = $route " : "";
        if ($datestart != 0 && $dateend != 0) {
            $wheresql .= "AND cp.timemodified > $datestart AND cp.timemodified < $dateend";
        } elseif ($datestart != 0) {
            $wheresql .= "AND cp.timemodified > $datestart";
        } elseif ($dateend != 0) {
            $wheresql .= "AND cp.timemodified < $dateend";
        }
        break;
    case 'searchorgstructure':
        $orgstructureid = optional_param('orgstructureid', 0, PARAM_INT);
        $positionid     = optional_param('positionid', 0, PARAM_INT);
        if ($orgstructureid || $positionid) {
            $conditionplus = '';
            $conditionplus .= ($positionid) ? "AND op.id = $positionid " : '';
            $conditionplus .= ($orgstructureid) ? "AND org.id = $orgstructureid " : '';
            $wheresql .= "AND us.orgpositionid in (select op.id from {orgstructure_position} op
                            JOIN {orgstructure} org on org.id = op.orgstructureid
                        where 1 = 1 $conditionplus)";
        }
        break;
    default:
        break;
}
$sql = "SELECT *, (SELECT COUNT(*) from mdl_competency_template ct
                            JOIN mdl_competency_plan cp on cp.templateid = ct.id
                            JOIN mdl_user us on us.id = cp.userid $wheresql) AS total
                FROM (
                    SELECT DISTINCT ROW_NUMBER() OVER (ORDER BY us.id) as RowNum,us.id as userid,ct.shortname as routename,CONCAT(us.firstname,' ',us.lastname) as name,cp.id as planid,cp.status,cp.timemodified
                        from mdl_competency_template ct
                            JOIN mdl_competency_plan cp on cp.templateid = ct.id
                            JOIN mdl_user us on us.id = cp.userid $wheresql
                ) AS Mydata ORDER BY $ordersql";
$get_list = $DB->get_records_sql($sql);
$data     = [];
foreach ($get_list as $value) {
    $proficiency = 0;
    $comptencys  = $DB->get_records_sql('SELECT cuc.competencyid,cuc.proficiency,cp.id
                                            from mdl_competency_plan cp
                                            JOIN mdl_competency_usercompplan cuc on cp.id = cuc.planid
                                        where cuc.planid = :planid and cuc.userid = :userid', ['planid' => $value->planid, 'userid' => $value->userid]);
    foreach ($comptencys as $comptency) {
        if ($comptency->proficiency) {
            $proficiency++;
        }
    }
    $user              = $DB->get_record("user", ['id' => $value->userid]);
    $object            = new stdClass();
    $object->name      = $OUTPUT->user_picture($user) . '<a target="_blank" href="' . $CFG->wwwroot . '/user/profile.php?id=' . $value->userid . '">' . $value->name . '</a>';
    $object->routename = $value->routename;
    if (!empty($comptencys)) {
        $object->process = round(($proficiency / count($comptencys)) * 100);
    } else {
        $object->process = 0;
    }
    $object->status        = ($object->process == 100 || $value->status == 2) ? '<span class="badge text-white teacher-bg-3 font-weight-bold rounded p-2">hoàn thành</span>' : '<span class="badge text-white teacher-bg-2 font-weight-bold rounded p-2">Chưa hoàn thành</span>';
    $object->timecompleted = ($value->status == 2) ? convertunixtime('d/m/Y', $value->timemodified, 'Asia/Ho_Chi_Minh') : '-';
    $object->total         = $value->total;
    $data[]                = $object;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
