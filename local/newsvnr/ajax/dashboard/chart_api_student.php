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
 * lấy dữ liệu cho chart trong dashboard student
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package local_newsvnr
 * @copyright 2020 VnResource
 * @author   Le Thanh Vu
 **/

define('AJAX_SCRIPT', false);

require_once __DIR__ . '/../../../../config.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
$action   = optional_param('action', null, PARAM_RAW);
$pagesize = optional_param('pagesize', 10, PARAM_INT);
$pagetake = optional_param('take', 0, PARAM_INT);
$pageskip = optional_param('skip', 0, PARAM_INT);
$odersql  = "";
$data     = [];
if ($pagetake == 0) {
    $ordersql = "RowNum";
} else {
    $ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
}
require_login();
$PAGE->set_context(context_system::instance());

switch ($action) {
    case 'quizchart':
        $listcourse = get_list_course_by_student($USER->id);
        foreach ($listcourse as $value) {
            $obj              = new stdClass();
            $obj->name        = $value->fullname;
            $listuser         = get_listuser_in_course($value->id);
            $grade            = get_finalgrade_student($USER->id, $value->id);
            $obj->rank        = get_rank_student_incourse($value->id, $USER->id) . '/' . count($listuser);
            $obj->y           = ($grade != false) ? (int) $grade->gradefinal : 0;
            $obj->drilldown   = $value->id;
            $avggrade[]       = $obj;
            $avggradecourse[] = (int) get_course_grade_avg($value->id)[0]->courseavg;
        }
        $data['avggradecourse'] = $avggradecourse;
        // Diểm trung bình học viên trong khóa
        $data['avggrade'] = $avggrade;
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    case 'moduledetail':
        $courseid  = optional_param('courseid', 0, PARAM_INT);
        $listgrade = $DB->get_records_sql("SELECT ROW_NUMBER() OVER (ORDER BY gi.id) AS RowNum,gi.id,gi.itemname,gg.finalgrade,gi.grademax,q.timeclose,gi.gradepass,gi.itemmodule FROM mdl_grade_grades gg
                                                JOIN mdl_grade_items gi ON gg.itemid = gi.id
                                                JOIN mdl_quiz q ON q.id = gi.iteminstance
                                            WHERE gg.userid = :userid AND gi.courseid = :courseid AND rawgrade IS NOT NULL
                                            ORDER BY $ordersql", ['userid' => $USER->id, 'courseid' => $courseid]);
        $i = 1;
        foreach ($listgrade as $value) {
            $obj             = new stdClass();
            $img             = '<img class="pr-2 img-module" src="' . $OUTPUT->image_url('icon', $value->itemmodule) . '">';
            $obj->name       = ($value->finalgrade > $value->gradepass) ? '<img src="' . $CFG->wwwroot . '\theme\moove\pix\iconsuccess.png" class="icon-success mr-2">' . $img . '' . $value->itemname : '<img src="' . $CFG->wwwroot . '\theme\moove\pix\iconfail.png" class="icon-fail mr-2">' . $value->itemname;
            $obj->finalgrade = $value->finalgrade;
            $obj->finalgradecourse = (int) get_course_grade_avg($courseid,false)[$i]->moduleavg;
            $obj->timeclose  = convertunixtime('d/m/Y', $value->timeclose, 'Asia/Ho_Chi_Minh');
            $obj->total      = count($listgrade);
            $data[]          = $obj;
            $i ++;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;
    case 'mycourse':
        $sql = "SELECT *,(SELECT COUNT(DiSTINCT c.id)
                    FROM mdl_user_enrolments ue
                        JOIN mdl_enrol e ON ue.enrolid = e.id
                        JOIN mdl_course c ON e.courseid = c.id
                        JOIN mdl_role_assignments ra ON ra.userid = ue.userid
                        JOIN mdl_user u ON u.id = ra.userid
                        JOIN mdl_context as ct on ra.contextid= ct.id AND ct.instanceid = c.id
                        LEFT JOIN mdl_course_completions cc ON cc.userid = c.id WHERE u.id = $USER->id) AS total
        FROM (SELECT ROW_NUMBER() OVER (ORDER BY c.id) AS RowNum,c.*,cc.timecompleted,ue.timestart
              FROM mdl_user_enrolments ue
                JOIN mdl_enrol e ON ue.enrolid = e.id
                JOIN mdl_course c ON e.courseid = c.id
                JOIN mdl_role_assignments ra ON ra.userid = ue.userid
                JOIN mdl_user u ON u.id = ra.userid
                JOIN mdl_context as ct on ra.contextid= ct.id AND ct.instanceid = c.id
                LEFT JOIN mdl_course_completions cc ON cc.userid = c.id AND cc.course = c.id WHERE u.id = $USER->id) AS Mydata
        ORDER BY $ordersql";
        $get_list = $DB->get_records_sql($sql);
        foreach ($get_list as $value) {
            $get_grade       = get_finalgrade_student($USER->id, $value->id);
            $obj             = new stdCLass();
            $course          = $DB->get_record('course', ['id' => $value->id]);
            $obj->courseid   = $value->id;
            $process         = round(\core_completion\progress::get_course_progress_percentage($course, $USER->id));
            $obj->href       = $CFG->wwwroot . '/course/view.php?id=' . $value->id;
            $obj->total      = $value->total;
            $obj->process    = '<div class="d-flex participants-collum"><div class="progress course"><div class="progress-bar" role="progressbar" aria-valuenow="' . $process . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $process . '%"></div></div><div>' . $process . '%</div></div></div>';
            $obj->gradefinal = (!empty($get_grade)) ? $get_grade->gradefinal : $obj->gradefinal = '-';
            $obj->timestart  = convertunixtime('d/m/Y', $value->timestart, 'Asia/Ho_Chi_Minh');
            if ($value->timecompleted != null) {
                $obj->timecompleted = convertunixtime('d/m/Y', $value->timecompleted, 'Asia/Ho_Chi_Minh');
                $obj->coursename    = '<img src="' . $CFG->wwwroot . '\theme\moove\pix\iconsuccess.png" class="icon-success mr-2"><a href="' . $obj->href . '" target="_blank">' . $value->fullname . '</a>';
            } else {
                $obj->timecompleted = '-';
                $obj->coursename    = '<a href="' . $obj->href . '" target="_blank">' . $value->fullname . '</a>';
            }
            $data[] = $obj;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;
    case 'homework':
        $listhomework = $DB->get_records_sql("SELECT ROW_NUMBER() OVER (ORDER BY a.id) AS RowNum,*
                                                    FROM {assignment} a
                                                    JOIN {assignment_submissions} ass on a.id = ass.assignment
                                            WHERE ass.userid =:userid ORDER BY $ordersql", ['userid' => $USER->id]);
        foreach ($listhomework as $value) {
            $obj = new stdClass();
            // $href         = $CFG->wwwroot . '/mod/quiz/view.php?id=' .
            $obj->name    = ($value->grade) ? '<img src="' . $CFG->wwwroot . '\theme\moove\pix\iconsuccess.png" class="icon-success mr-2">' . $value->name : $value->name;
            $obj->grade   = ($value->grade) ? $value->grade : '-';
            $obj->timedue = $value->timedue;
            $obj->total   = count($listhomework);
            $data[]       = $obj;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;
    case 'myquiz':
        $myquiz = $DB->get_records_sql("SELECT ROW_NUMBER() OVER (ORDER BY q.id) AS RowNum,c.id,q.name,gg.finalgrade,gg.userid,q.timeclose,cm.id as moduleid
                                        FROM mdl_role_assignments AS ra
                                            JOIN mdl_user AS u ON u.id= ra.userid
                                            JOIN mdl_user_enrolments AS ue ON ue.userid=u.id
                                            JOIN mdl_enrol AS e ON e.id=ue.enrolid
                                            JOIN mdl_course AS c ON c.id=e.courseid
                                            JOIN mdl_context AS ct ON ct.id=ra.contextid AND ct.instanceid= c.id
                                            JOIN mdl_role AS r ON r.id= ra.roleid
                                            JOIN mdl_course_modules cm ON cm.course = c.id
                                            JOIN mdl_quiz q ON q.id = cm.instance
                                            LEFT JOIN mdl_grade_items gi ON gi.courseid = c.id AND gi.itemmodule = 'quiz' AND gi.iteminstance = q.id
                                            LEFT JOIN mdl_grade_grades gg ON gg.itemid = gi.id AND gg.userid = u.id
                                        WHERE  ra.roleid=5 AND ue.status = 0 AND u.id =:userid AND c.visible = 1 AND cm.deletioninprogress = 0 AND cm.visible = 1 AND cm.module = 16 ORDER BY $ordersql", ['userid' => $USER->id]);
        foreach ($myquiz as $value) {
            $obj          = new stdClass();
            $href         = $CFG->wwwroot . '/mod/quiz/view.php?id=' . $value->moduleid;
            $obj->name    = ($value->finalgrade) ? '<img src="' . $CFG->wwwroot . '\theme\moove\pix\iconsuccess.png" class="icon-success mr-2"><a href="' . $href . '" target="_blank">' . $value->name . '</a>' : '<a href="' . $href . '" target="_blank">' . $value->name . '</a></div>';
            $obj->grade   = ($value->finalgrade) ? $value->finalgrade : '-';
            $obj->timedue = convertunixtime('d/m/Y', $value->timeclose, 'Asia/Ho_Chi_Minh');
            $obj->total   = count($myquiz);
            $data[]       = $obj;
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;
    case 'piechart':
        require_once "{$CFG->libdir}/completionlib.php";
        $outputfinish = '';
        $outputlearn  = '';
        $listcourse   = get_list_course_by_student($USER->id);
        $i            = 0;
        foreach ($listcourse as $value) {
            $course     = $DB->get_record('course', ['id' => $value->id]);
            $cinfo      = new completion_info($course);
            $iscomplete = $cinfo->is_course_complete($USER->id);
            if ($iscomplete == true) {
                $i++;
                $outputfinish .= $value->fullname . '<br>';
            } else {
                $outputlearn .= $value->fullname . '<br>';
            }
        }
        $data[0] = ['name' => 'Đã hoàn thành', 'y' => $i, 'course' => $outputfinish];
        $data[1] = ['name' => 'Đang học', 'y' => (count($listcourse) - $i), 'course' => $outputlearn];
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        break;
    default:
        break;
}
die();
