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

class block_vnr_db_coursesuggest_position extends block_base {
    public function init() {
        global $USER, $DB;
        $this->title = get_string('pluginname', 'block_vnr_db_coursesuggest_position') . ' ('. $DB->get_field('orgstructure_position', 'name', ['id' => $USER->orgpositionid]) .')';
    }

    function get_content() {
        if($this->content !== NULL) {
            return $this->content;
        }

        $renderable = new \block_vnr_db_coursesuggest_position\output\coursesuggest_position_page();
        $renderer = $this->page->get_renderer('block_vnr_db_coursesuggest_position');
        if($renderer->render($renderable) !== '') {
            $this->content = new stdClass();
            $this->content->text = $renderer->render($renderable);
            $this->content->footer = '';    
        } else {
            $this->content;    
        }
        return $this->content;
    }

    public function applicable_formats() {
        return array('my' => true);
    }
}


