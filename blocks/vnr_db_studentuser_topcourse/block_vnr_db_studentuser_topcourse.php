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

class block_vnr_db_studentuser_topcourse extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_studentuser_topcourse');
    }

    function get_content() {
        global $CFG, $USER, $DB, $OUTPUT;
       
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        $renderable = new \block_vnr_db_studentuser_topcourse\output\studentuser_topcourse_page();
        $renderer = $this->page->get_renderer('block_vnr_db_studentuser_topcourse');
        $this->content = new stdClass();
        $listcourse = get_list_course_by_student($USER->id);
        $strjoincourse = get_string('joincourse', 'block_vnr_db_studentuser_topcourse');
        if($listcourse) {
            $this->content->text = $renderer->render($renderable);
        } else {
            $this->content->text = '<div class="d-flex w-100 justify-content-center alert alert-info alert-block fade in ">'.$strjoincourse.'</div>';
        }
        $this->content->footer = '';
        return $this->content;
       
    }

     public function applicable_formats() {
        return array('my' => true, 'my-newsvnr' => true);
    }
}


