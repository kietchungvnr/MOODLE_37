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
 * Block hiện thị thứ hạng điểm trong 1 kì thi(khóa học) của user
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_studentuser_topcourse\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');
    

use renderable;
use templatable;
use renderer_base;

class studentuser_topcourse_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
    	global $DB, $USER;
        $data = array();
        $list_course = get_list_course_by_student($USER->id);
        $data['list_course'] = $list_course;
        $get_list_topgrade = $DB->get_records_sql("
                            SELECT CONCAT(u.firstname, ' ', u.lastname) AS fullname, cccc.userid, CONVERT(DECIMAL(10,2),cccc.gradefinal) AS gradefinal, RANK() OVER (ORDER BY cccc.gradefinal DESC) AS rank  
                            FROM mdl_course_completion_criteria ccc JOIN mdl_course_completion_crit_compl cccc ON ccc.id = cccc.criteriaid AND ccc.course = cccc.course JOIN mdl_user u ON cccc.userid = u.id  
                            WHERE ccc.criteriatype = 6 AND cccc.course = ?
                            ORDER BY cccc.gradefinal DESC", [$list_course[0]->id]);
        if($get_list_topgrade) {
            foreach($get_list_topgrade as $value) {
                if($value->userid == $USER->id) {
                    $get_rank = $value->rank;
                    $value->color = 'text-danger';
                }
            }
            $has_list_topgrade = true;
        } else {
            $has_list_topgrade = false;
            
        }
        $data = [
            'haslisttopgrade' => $has_list_topgrade,
            'list_course' => $list_course,
        ];
        return $data;
    }
}