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

namespace block_vnr_db_matrix_competency\output;
defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

class renderer extends plugin_renderer_base {

    /**
     * Return the main content for the block.
     *
     * @param main $main The main renderable
     * @return string HTML string
     */
    public function render_matrix_competency_page(matrix_competency_page $page) {
        return $this->render_from_template('block_vnr_db_matrix_competency/matrix_competency',
            $page->export_for_template($this));
    }
}
