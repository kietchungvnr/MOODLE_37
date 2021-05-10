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
$wheresql = "";
if ($pagetake == 0) {
    $ordersql = "RowNum";
} else {
    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
}
switch ($action) {
    case 'searchaccount':
        $username       = optional_param('username', '', PARAM_RAW);
        $competency     = optional_param('competency', '', PARAM_RAW);
        $competencyplan = optional_param('competencyplan', '', PARAM_RAW);
        $course         = optional_param('course', 0, PARAM_INT);
        $wheresql .= "WHERE us.username LIKE N'%$username%' ";
        $wheresql .= ($competency) ? "AND cm.id = $competency" : "";
        $wheresql .= ($competencyplan) ? "AND cmp.name LIKE N'%$competency%'" : "";
        $wheresql .= ($course) ? "AND c.id = $course" : "";
        break;
    case 'searchorgstructure':
        $orgstructureid = optional_param('orgstructureid', 0, PARAM_INT);
        $positionid     = optional_param('positionid', 0, PARAM_INT);
        if ($orgstructureid || $positionid) {
            $conditionplus = '';
            $conditionplus .= ($positionid) ? "AND op.id = $positionid " : '';
            $conditionplus .= ($orgstructureid) ? "AND org.id = $orgstructureid " : '';
            $wheresql .= "WHERE us.orgpositionid in (select op.id from {orgstructure_position} op
							JOIN {orgstructure} org on org.id = op.orgstructureid
						WHERE 1 = 1 $conditionplus)";
        }
        break;
    default:

        break;
}
$sql = "SELECT *, (SELECT COUNT(*) FROM mdl_competency cm
					JOIN mdl_competency_usercompcourse cmu on cmu.competencyid = cm.id
					JOIN mdl_course c on c.id = cmu.courseid
					JOIN mdl_user us on us.id = cmu.userid
					LEFT JOIN mdl_competency_usercompplan cmus on cmus.competencyid = cm.id and cmus.userid = us.id
					left join mdl_competency_plan cmp on cmp.id = cmus.planid
					LEFT JOIN mdl_competency_usercomp cmmu on cmmu.userid = us.id AND cmmu.competencyid = cm.id $wheresql) AS total
						FROM (
						    select ROW_NUMBER() OVER (ORDER BY cm.id) AS RowNum,us.orgpositionid,us.id as userid,c.id as courseid,cm.id,CONCAT(us.firstname,' ',us.lastname) as name,cm.shortname,c.fullname,cmmu.grade,cmp.name as planname,cmp.reviewerid,cmp.duedate
						    FROM mdl_competency cm
					JOIN mdl_competency_usercompcourse cmu on cmu.competencyid = cm.id
					JOIN mdl_course c on c.id = cmu.courseid
					JOIN mdl_user us on us.id = cmu.userid
					LEFT JOIN mdl_competency_usercompplan cmus on cmus.competencyid = cm.id and cmus.userid = us.id
					left join mdl_competency_plan cmp on cmp.id = cmus.planid
					LEFT JOIN mdl_competency_usercomp cmmu on cmmu.userid = us.id AND cmmu.competencyid = cm.id $wheresql
						) AS Mydata
						ORDER BY $ordersql";
$get_list = $DB->get_records_sql($sql);
$data     = [];
foreach ($get_list as $value) {
    $object   = new stdClass();
    $activity = '';
    $modules  = $DB->get_records_sql("SELECT DISTINCT com.id as moduleid,com.instance,m.name,cm.id FROM mdl_competency cm
										JOIN mdl_competency_modulecomp cmm on cmm.competencyid = cm.id
										JOIN mdl_course_modules com on com.id = cmm.cmid
										JOIN mdl_modules m on m.id = com.module
									WHERE cm.id = $value->id AND com.visible = 1 AND com.deletioninprogress = 0");
    foreach ($modules as $module) {
        $modulename = $DB->get_record_sql("SELECT name from mdl_$module->name where id = $module->instance");
        if ($modulename) {
            $imgmodule = $OUTPUT->image_url('icon', $module->name);
            $activity .= '<div class="mb-1"><a target="_blank" href="' . $CFG->wwwroot . '/mod/' . $module->name . '/view.php?id=' . $module->moduleid . '"><img class="mr-1 img-module" src="' . $imgmodule . '">' . $modulename->name . '</a></div>';
        }
    }
    if ($value->reviewerid) {
        $reviewer         = $DB->get_record("user", ['id' => $value->reviewerid], "CONCAT(firstname,' ',lastname) as name");
        $object->reviewer = $reviewer->name;
    } else {
        $object->reviewer = '-';
    }
    $user                   = $DB->get_record("user", ['id' => $value->userid]);
    $object->name           = $OUTPUT->user_picture($user) . '<a target="_blank" href="' . $CFG->wwwroot . '/user/profile.php?id=' . $value->userid . '">' . $value->name . '</a>';
    $object->competencyname = $value->shortname;
    $object->coursename     = '<a target="_blank" href="' . $CFG->wwwroot . '/course/view.php?id=' . $value->courseid . '">' . $value->fullname . '</a>';
    $object->activity       = ($activity) ? $activity : '-';
    $object->duedate        = '-';
    $object->planname       = ($value->planname) ? $value->planname : "-";
    $object->status         = ($value->grade == 2) ? "<span class='badge text-white teacher-bg-3 font-weight-bold rounded p-2'>Hoàn thành</span>" : "<span class='badge text-white teacher-bg-2 font-weight-bold rounded p-2'>Chưa hoàn thành</span>";
    $object->total          = $value->total;
    $data[]                 = $object;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
