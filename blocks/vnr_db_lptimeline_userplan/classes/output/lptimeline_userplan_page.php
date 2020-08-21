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
 * Block khóa học theo kế hoạch cá nhân của user
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_lptimeline_userplan\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;
use theme_moove\util\theme_settings;

class lptimeline_userplan_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $DB,$USER;
        $data = [];
        $listuserplan = array_values($DB->get_records_sql('SELECT * FROM {competency_plan} WHERE userid = ?', [$USER->id]));
        $data['listuserplan'] = $listuserplan;
        $theme_settings = new theme_settings();
        $planid = end($listuserplan);
        if($planid) {
            //Lấy danh sách khoá học theo lộ trình cá nhân
            $data['listusercoursecomp'] = $theme_settings->get_courses_data($pinned = null, $required = null, $suggest = null, $userplancourse = 1, $planid->id);
            if(!$data['listusercoursecomp']) {
                 $data['nohascusercoursecomp'] = true;
            }    
        }
        
        return $data;
    }
}