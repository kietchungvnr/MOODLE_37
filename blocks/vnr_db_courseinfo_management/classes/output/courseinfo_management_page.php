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
 * Block gợi ý khóa học cho vị trí PB - CD - CV
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_courseinfo_management\output;

defined('MOODLE_INTERNAL') || die();

require_once $CFG->dirroot . '/local/newsvnr/lib.php';

use renderable;
use renderer_base;
use stdClass;
use templatable;

class courseinfo_management_page implements renderable, templatable
{

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output)
    {
        global $DB;
        $data = array();
        if (is_siteadmin()) {
            $data['isadmin'] = true;
        } else {
            $data['isadmin'] = false;
        }
        $countcategory          = $DB->get_record_sql("SELECT COUNT(id) as count FROM {course_categories} WHERE parent = 0");
        $countcourse            = $DB->get_record_sql("SELECT COUNT(id) as count FROM {course} WHERE id != 1");
        $countstudent           = $DB->get_record_sql("SELECT COUNT(DISTINCT u.id) as count FROM {user} u JOIN {role_assignments} ra ON ra.userid = u.id WHERE ra.roleid= 5");
        $countteacher           = $DB->get_record_sql("SELECT COUNT(DISTINCT u.id) as count FROM {user} u JOIN {role_assignments} ra ON ra.userid = u.id WHERE ra.roleid= 3");
        $data['coursecategory'] = $countcategory->count;
        $data['course']         = $countcourse->count;
        $data['student']        = $countstudent->count;
        $data['teacher']        = $countteacher->count;
        return $data;
    }
}
