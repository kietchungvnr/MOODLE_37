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

class block_vnr_db_admin_rp extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_admin_rp') . '<i class="fa fa-question-circle btn-help ml-1" aria-hidden="true" data-toggle="modal" data-target="#myModal"></i>';
    }

    function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;
       
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        $get_list_courseid_by_teacher = get_list_courseid_by_teacher($USER->id);
        if($get_list_courseid_by_teacher) {
            $renderable = new \block_vnr_db_admin_rp\output\admin_rp_page();
            $renderer = $this->page->get_renderer('block_vnr_db_admin_rp');
            $this->content = new stdClass();
            $this->content->text = $renderer->render($renderable);
            $this->content->footer = '';
            return $this->content;
        } else {
            return $this->content;
        }
    }

     public function applicable_formats() {
        return array('my' => true, 'my-newsvnr' => true);
    }
}


