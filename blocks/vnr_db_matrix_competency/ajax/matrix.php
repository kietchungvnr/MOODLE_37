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

$action   = optional_param('action', '', PARAM_TEXT);

$get_orgstructureid = $DB->get_field('orgstructure_position', 'orgstructureid', ['id' => $USER->orgpositionid]);
$get_all_positions = $DB->get_records_sql("
                                        SELECT op.id positionid, op.name, op.level
                                        FROM mdl_orgstructure_position op
                                            LEFT JOIN mdl_orgstructure org ON org.id = op.orgstructureid
                                        WHERE op.orgstructureid = :orgstructureid
                                        ORDER BY op.level
                                        ", ['orgstructureid' => $get_orgstructureid]);
$all_competency = $data = $columns = [];
$obj_competency_framework_column = new stdClass;
$obj_competency_framework_column->field = "competencyframework";
$obj_competency_framework_column->template = "function(e) { return e.competencyframework; }";
$obj_competency_framework_column->title = get_string('competencyframework', 'block_vnr_db_matrix_competency');
$obj_competency_framework_column->width = 200;
$columns[] = $obj_competency_framework_column;
$obj_competency_column = new stdClass;
$obj_competency_column->field = "competency";
$obj_competency_column->template = "function(e) { return e.competency; }";
$obj_competency_column->title = get_string('competency', 'block_vnr_db_matrix_competency');
$obj_competency_column->width = 200;
$columns[] = $obj_competency_column;
if($get_all_positions) {
    foreach ($get_all_positions as $position) {
        // Lấy danh sách cột cho matrix gird
        $obj_position_column = new stdClass;
        $obj_position_column->field = "positionid" . $position->positionid;
        $obj_position_column->template = "function(e) { return e.". $obj_position_column->field ."; }";
        $obj_position_column->title = $position->name;
        $obj_position_column->width = 200;
        $columns[] = $obj_position_column;
    }
    $competencies = [];
    foreach ($get_all_positions as $position) {
        // Lấy danh sách năng lực theo vị trí
        $get_competencies = $DB->get_records_sql("
                                                SELECT comp.shortname name, comp.id, cp.positionid, cf.shortname frameworkname
                                                    FROM mdl_competency comp
                                                    LEFT JOIN mdl_competency_position cp ON cp.competencyid = comp.id
                                                    LEFT JOIN mdl_orgstructure_position op ON op.id = cp.positionid
                                                    LEFT JOIN mdl_competency_framework cf ON cf.id = comp.competencyframeworkid
                                                WHERE op.id = :positionid
                                                ORDER BY cp.ordernumber
                                                ", ['positionid' => $position->positionid]);
        if($get_competencies) {                                            
            foreach($get_competencies as $competency) {
                // Kiểm tra xem có năng lực đã tồn tại chưa?
                $is_exist = false;
                $obj = new stdClass;
                if($all_competency) {
                    foreach($all_competency as $temp) {
                        if($temp->competency == $competency->name) {
                            $is_exist = true;
                            break;
                        }
                    }
                }
                if($is_exist == true) {
                    continue;
                }
                // Nếu chưa tồn tại thì bỏ vào mảng
                $obj->id = $competency->id;
                $obj->competencyframework = $competency->frameworkname;
                $obj->competency = $competency->name;
                foreach ($columns as $key => $column) {
                    if ($key == 0 || $key == 1)
                        continue;
                    $positionid =  $column->field;
                    $obj->$positionid = '-';
                }
                $all_competency[] = $obj;
            }

        }
    }
    // Lấy danh sách khóa học cho từng năng lực
    foreach($all_competency as $key_comp => $temp_comp) {
        $temp_comp = (array) $temp_comp;
        $get_position_by_competency = $DB->get_records_sql("SELECT * FROM mdl_competency_position WHERE competencyid = :competencyid", ['competencyid' => $temp_comp['id']]);
        foreach($get_position_by_competency as $temp_pos) {
            $position = 'positionid'. $temp_pos->positionid;
            if(isset($temp_comp[$position])) {
                $list_course = '';
                // Lấy danh sách khóa học theo năng lực
                $get_courses_by_competency = array_values($DB->get_records_sql("
                                                                SELECT c.*, cc.competencyid, cc.sortorder
                                                                FROM mdl_competency_coursecomp cc 
                                                                    LEFT JOIN mdl_course c ON cc.courseid = c.id
                                                                WHERE cc.competencyid = :competencyid
                                                                ", ['competencyid' => $temp_comp['id']]));
                $count = count($get_courses_by_competency);
                if($count > 1) {
                    foreach($get_courses_by_competency as $key_course => $course) {
                        // Kiểm tra xem có tham gia khóa học chưa và tiến trình...
                        $process = round(\core_completion\progress::get_course_progress_percentage($course, $USER->id));
                        $course_url = $CFG->wwwroot . '/course/view.php?id=' . $course->id;
                        $list_course .= '
                                        <div><a href="'. $course_url.'">' . $course->fullname . '</a></div>';
                        $is_enrolled = is_enrolled(context_course::instance($course->id), $USER->id);
                        if($is_enrolled == true) {
                            $list_course .=
                                        '<div class="progress">
                                            <div class="progress-bar" data-toggle="tooltip" title="' . $process . '%" role="progressbar" aria-valuenow="' . $process . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $process . '%">
                                            </div>
                                        </div>';
                        } else {
                            $list_course .=
                                        '<div>
                                            <span class="text-danger">'.get_string('noenroll', 'block_vnr_db_matrix_competency').'</span>
                                        </div>';
                        }
                    }
                } else {
                    // Kiểm tra xem có tham gia khóa học chưa và tiến trình...
                    $process = round(\core_completion\progress::get_course_progress_percentage($get_courses_by_competency[0], $USER->id));
                    $course = $get_courses_by_competency[0];
                    $course_url = $CFG->wwwroot . '/course/view.php?id=' . $course->id;
                    $list_course .= '
                                        <div><a href="' . $course_url . '">' . $course->fullname . '</a></div>';
                    $is_enrolled = is_enrolled(context_course::instance($course->id), $USER->id);
                    if ($is_enrolled == true) {
                        $list_course .=
                                        '<div class="progress">
                                            <div class="progress-bar" data-toggle="tooltip" title="' . $process . '%" role="progressbar" aria-valuenow="' . $process . '" aria-valuemin="0" aria-valuemax="100" style="width:' . $process . '%">
                                            </div>
                                        </div>';
                    } else {
                        $list_course .=
                                        '<div>
                                            <span class="text-danger">'.get_string('noenroll', 'block_vnr_db_matrix_competency').'</span>
                                        </div>';
                    }
                }
                $all_competency[$key_comp]->$position = $list_course;
            }
        }

    }
}
$data['data_grid'] = array_values($all_competency);
$data['current_orgposition'] = 'positionid' . $USER->orgpositionid;
$data['data_columns'] = $columns;
echo json_encode($data, JSON_UNESCAPED_UNICODE);
die;
