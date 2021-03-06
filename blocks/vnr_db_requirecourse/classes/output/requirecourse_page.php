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
 * Block hiện thị khóa học bắt buộc chung
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_requirecourse\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');
require_once($CFG->libdir . '/badgeslib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;

use theme_moove\util\theme_settings;
class requirecourse_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = array();
        $theme_settings = new theme_settings();
        $pinned = 0;
        //Lấy danh sách khoá học bắt buộc với required = 1
        $data['requiredcourse'] = $theme_settings->get_courses_data($pinned);
        if(isset($data['requiredcourse']['newscourse'])) {
            $data['hascourse'] = true;
        } else {
            $data['hascourse'] = false;
        }
        return $data;
    }
}