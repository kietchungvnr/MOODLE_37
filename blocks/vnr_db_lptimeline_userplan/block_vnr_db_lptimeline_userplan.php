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

class block_vnr_db_lptimeline_userplan extends block_base {
     public function init() {
        $this->title = get_string('pluginname', 'block_vnr_db_lptimeline_userplan');
    }
    
    function get_content() {
        global $USER;
        if($this->content !== NULL) {
            return $this->content;
        }

        $competency_api = new \core_competency\api();
        $plans = array_values($competency_api::list_user_plans($USER->id));
        
        if(isset($plans)) {
            $renderable = new \block_vnr_db_lptimeline_userplan\output\lptimeline_userplan_page();
            $renderer = $this->page->get_renderer('block_vnr_db_lptimeline_userplan');
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


