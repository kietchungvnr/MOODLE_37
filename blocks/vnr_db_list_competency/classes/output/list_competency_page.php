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
 * Block hiện thị danh sách năng lực đã đạt được theo user
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_list_competency\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;
use theme_moove\util\theme_settings;

class list_competency_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $DB, $USER;
        $data = array();
        $listcompetency = [];
        $result = $DB->get_records_sql('
            SELECT c.shortname
            FROM mdl_competency c
                LEFT JOIN mdl_competency_usercomp cu ON c.id = cu.competencyid 
            WHERE 
            cu.userid = ? AND 
            (cu.status = 0 AND proficiency = 0)', [268]); 
        foreach ($result as $value) {
            $listcompetency[] = $value->shortname;
        }
        $data['listcompetency'] = $listcompetency;
            
        return $data;
    }
}