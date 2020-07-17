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
 * Khối block Báo cáo học tập hiện thị dữ liệu tình trạng của 1 kỳ thi/lớp học dựa theo tiêu chí: Đạt, Không đạt, Khác. 
 * Mặc định sẽ hiện thị kỳ thi/lớp học truy cập gần đây nhất. Muốn hiện thị chi tiết danh sách học viên vui lòng nhấn vào Đạt, Không đạt, Khác trên biểu đồ
 *
 * @package    block_user(admin)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_admin_rp\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');


use renderable;
use templatable;
use renderer_base;

class admin_rp_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
    	global $DB;
        $data = array();
        $list_category = $DB->get_records('course_categories', ['visible' => 1], '', 'id, name');
        $data['categories'] = array_values($list_category);
        return $data;
    }
}