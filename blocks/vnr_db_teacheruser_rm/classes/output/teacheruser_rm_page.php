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
 * Block nhắc nhở các sự kiện cho giáo viên
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_teacheruser_rm\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;
use user_picture;
use html_writer;

class teacheruser_rm_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $DB,$USER,$CFG;
       
        $data = array();
        //danh sách khóa học theo user giáo viên
        $list_course_by_user_sql = "SELECT DISTINCT c.fullname,c.id
                                    from mdl_role_assignments as ra
                                    join mdl_user as u on u.id= ra.userid
                                    join mdl_user_enrolments as ue on ue.userid=u.id
                                    join mdl_enrol as e on e.id=ue.enrolid
                                    join mdl_course as c on c.id=e.courseid
                                    join mdl_context as ct on ct.id=ra.contextid and ct.instanceid= c.id
                                    join mdl_role as r on r.id= ra.roleid
                                    join mdl_course_modules cm on c.id = cm.course
                                    join mdl_course_modules_completion cmc on cm.id = cmc.coursemoduleid
                                where  ra.roleid=3 and u.id = ?";
        $list_course_by_user_ex = $DB->get_records_sql($list_course_by_user_sql,[$USER->id]);
        
         if (!empty($list_course_by_user_ex)) {
            foreach ($list_course_by_user_ex as $value) {
                $list_courseid[] = $value->id;
            }
            $str_courseid = implode(',',$list_courseid);
        } else
            $str_courseid = '';
        $list_course_by_user_arr = array();
        $stt = 1;

        foreach ($list_course_by_user_ex as $value) {
            $list_course_by_user_std = new stdClass();
            $context = \context_course::instance($value->id);
            $count_user = count_enrolled_users($context);
            $list_user = get_enrolled_users($context);
            $list_user_arr = array();
            foreach ($list_user as $username) {
                $userlink = $CFG->wwwroot."/user/profile.php?id=".$username->id;
                $list_user_arr[] = \html_writer::link($userlink,fullname($username,true));    
            }
            $courselink = $CFG->wwwroot."/course/view.php?id=".$value->id;
            $list_course_by_user_std->courselink = \html_writer::link($courselink,$value->fullname);
            $list_course_by_user_std->count_user = $count_user;
            $list_course_by_user_std->list_user = $list_user_arr;
            $list_course_by_user_std->stt = $stt;
            $list_course_by_user_arr[] = $list_course_by_user_std;
            $stt++;
        }
        $data['list_course'] = $list_course_by_user_arr;
        //quản lý học tập, quản lý các user có trong lớp học của giáo viên
        $list_assignment_ex = $DB->get_records_sql("SELECT a.course,c.fullname,c.id,
                                                     COUNT(a.id) as assignnumber,SUM(COUNT(a.id)) OVER() AS total_count  from mdl_assign_grades ag  right join mdl_assign a on a.id = ag.assignment join mdl_course c on c.id = a.course
                                                    where a.course in($str_courseid) and ag.assignment is null
                                                    group by a.course,c.fullname,c.id",[]);
        
        $list_assignment_arr = array();
        if($list_assignment_ex) {
            foreach ($list_assignment_ex as $assign) {
                $courselink = html_writer::link($CFG->wwwroot . '/course/view.php?id='.$assign->id,$assign->fullname);
                $list_assignment_arr[] = '<div class="mb-1 cl-cursor" onClick="get_assignment_submit('.$assign->course.')">'.$courselink.'</div>';
                $data['list_assignment']['assignnumber'] = $assign->total_count;
            }
            $data['list_assignment']['list_course_assign'] = $list_assignment_arr;
        }
        //quản lý học tập, quản lý các feedback trong khóa học của giáo viên
        $list_feedback_sql = "SELECT DISTINCT c.id, c.fullname,c.id
                                 FROM mdl_course_modules cm 
                                 JOIN mdl_feedback f ON cm.instance = f.id AND cm.course = f.course
                                 JOIN mdl_course c ON f.course = c.id
                                 WHERE cm.course in($str_courseid)";
        $list_feedback_ex = $DB->get_records_sql($list_feedback_sql,[]);
        $list_feedback_count_ex = $DB->get_field_sql("SELECT SUM(COUNT(f.id)) OVER() AS total_count
                                                         FROM mdl_course_modules cm 
                                                         JOIN mdl_feedback f ON cm.instance = f.id AND cm.course = f.course
                                                         WHERE cm.course in($str_courseid)",[]);
        $list_feedback_arr = array();
        foreach ($list_feedback_ex as $feedback) {
            $courselink = html_writer::link($CFG->wwwroot . '/course/view.php?id='.$feedback->id,$feedback->fullname);
            $list_feedback_arr[] = '<div class="mb-1 cl-cursor" onClick="get_feedback('.$feedback->id.')">'.$courselink.'</div>';
        }
        $data['list_feedback']['feedbacknumber'] = $list_feedback_count_ex;
        $data['list_feedback']['list_course_feedback'] = $list_feedback_arr;
        return $data;
    }
}