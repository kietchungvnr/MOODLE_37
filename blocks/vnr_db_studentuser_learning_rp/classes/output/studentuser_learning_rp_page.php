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
 * Course list block.
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_studentuser_learning_rp\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;
use theme_moove\util\theme_settings;

class studentuser_learning_rp_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $DB,$USER,$CFG,$OUTPUT;
        $data = array();
        //Khoá học đang tham gia của học viên
        $courses = get_list_course_by_student($USER->id);
        if($courses)
            $data['countcourse'] = count($courses);
        $completedcourses = $DB->get_record_sql('
                                SELECT userid ,COUNT(*) AS completed_courses
                                FROM mdl_course_completions
                                WHERE timecompleted IS NOT NULL AND userid = ?
                                GROUP BY userid', [$USER->id]
                            );  
        if($completedcourses)
            $data['completedcourses'] = $completedcourses->completed_courses;
        $countbadges = $DB->get_record_sql('
                                SELECT COUNT(b.id) AS countbadges
                                FROM mdl_badge_issued bi 
                                    LEFT JOIN mdl_badge b ON bi.badgeid=b.id
                                WHERE bi.userid = ?', [$USER->id]
                            );
        if($countbadges->countbadges != '0')
            $data['countbadges'] =  $countbadges->countbadges;
        $countcompencies = $DB->get_record_sql('
                                SELECT COUNT(id) AS countcomp 
                                FROM mdl_competency_usercomp 
                                WHERE status = 0 AND proficiency = 0 AND userid = ?', [$USER->id]
                            );
        if($countcompencies->countcomp != '0')
            $data['countcompencies'] = $countcompencies->countcompencies;
        $completed_requirecourses = $DB->get_record_sql('
                                SELECT COUNT(*) AS completed_requirecourses,(SELECT COUNT(*) FROM mdl_course WHERE required = 1) AS total_requirecourses 
                                FROM mdl_course c JOIN mdl_course_completions cc ON c.id = cc.course 
                                WHERE cc.timecompleted IS NOT NULL AND c.required = 1 AND cc.userid = ?', [$USER->id]
                            );
        if($completed_requirecourses) {
            $data['completed_percent_requirecourses'] = round(($completed_requirecourses->completed_requirecourses / $completed_requirecourses->total_requirecourses) * 100) ;
            $data['total_requirecourses'] = $completed_requirecourses->total_requirecourses;
            $data['completed_requirecourses'] = $completed_requirecourses->completed_requirecourses;
        }
        $completed_positioncourses = $DB->get_record_sql('
                                SELECT COUNT(c.id) AS completed_positioncourses,(SELECT COUNT(*) FROM mdl_course c JOIN mdl_course_position cp ON c.id = cp.course WHERE cp.courseofposition = ?) AS total_positioncourses
                                FROM mdl_course c JOIN mdl_course_completions cc ON c.id = cc.course JOIN mdl_course_position cp ON c.id = cp.course
                                WHERE cc.timecompleted IS NOT NULL AND cc.userid = ? AND cp.courseofposition = ?',[$USER->orgpositionid, $USER->id, $USER->orgpositionid]
                            );
        if($completed_positioncourses) {
            $data['completed_percent_positioncourses'] = round(($completed_positioncourses->completed_positioncourses / $completed_positioncourses->total_positioncourses) * 100) ;
            $data['total_positioncourses'] = $completed_positioncourses->total_positioncourses;
            $data['completed_positioncourses'] = $completed_positioncourses->completed_positioncourses;
        }
        $listuserplan = array_values($DB->get_records_sql('SELECT * FROM {competency_plan} WHERE userid = ?', [$USER->id]));
        if($listuserplan) {
            $theme_settings = new theme_settings();
            $planid = end($listuserplan);
            //Lấy danh sách khoá học theo lộ trình cá nhân
            $countplan = 0;
            $plans = $theme_settings::user_courses_list($pinned = null, $required = null, $suggest = null, $userplancourse = 1, $planid->id);
            foreach ($plans as $course) {
                $completed_plancourses  = $DB->get_record_sql('SELECT id FROM mdl_course_completions WHERE course = ? AND user = ? AND timecompleted IS NOT NULL',[$course->id, $USER->id]);
                if($completed_plancourses ) {
                    $countplan++;
                }
            }
            $data['total_plancourses'] = count($plans);
            $data['completed_percent_plancourses'] = ($countplan / count($plans)) * 100;
            $data['completed_plancourses'] = $countplan;
        }
        
        return $data;
    }
}