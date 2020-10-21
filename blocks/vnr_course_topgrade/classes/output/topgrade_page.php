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
 * Top grade block
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_course_topgrade\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');
require_once($CFG->libdir . '/badgeslib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;
use badge;
use user_picture;
class topgrade_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $DB,$USER,$CFG,$OUTPUT;
        $data = array();
        $courseid = optional_param('id',0,PARAM_RAW);
        $listcourse = get_list_course_by_teacher($USER->id);
        if($listcourse) {
            $course = new stdClass;
            foreach ($listcourse as $course) {
                $course->name = $course->fullname;
                $course->id = $course->id;
            }

            $data['course'] = $course;
        }
        $listuser = $DB->get_records_sql("
                                        SELECT TOP 5 gg.userid,gi.courseid,gi.itemmodule, gg.finalgrade, CONCAT(u.lastname,' ',u.firstname) AS fullname 
                                        FROM mdl_grade_grades gg 
                                            JOIN mdl_grade_items gi ON gi.id=gg.itemid 
                                            JOIN mdl_user u ON gg.userid = u.id
                                        WHERE gg.finalgrade IS NOT NULL AND gi.itemtype= ? AND gi.courseid = ? 
                                        ORDER BY gg.finalgrade DESC", ['course', $courseid]);
        if($listuser) {
            $listuser_arr = [];
            $stt = 1;
            foreach ($listuser as $user) {
                $listuser_obj = new stdClass();
                $listuser_obj->link = $CFG->wwwroot . "/user/profile.php?id=" . $user->userid;
                $listuser_obj->fullname = $user->fullname;
                $listuser_obj->finalgrade = round($user->finalgrade, 2);
                $listuser_obj->stt = $stt;
                $listuser_obj->image = $OUTPUT->user_picture($DB->get_record('user', ['id' => $user->userid]), ['size' => 35]);
                if($stt == 1) {
                    $listuser_obj->ace = 'red';
                }
                $listuser_arr[] = $listuser_obj;
            }
            $data['haslistuser'] = true;
            $data['listuser'] = $listuser_arr;
        }
        return $data;
    }
}