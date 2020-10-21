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
defined('MOODLE_INTERNAL') || die;

use plugin_renderer_base;

class renderer extends plugin_renderer_base {

    /**
     * Return the main content for the block.
     *
     * @param main $main The main renderable
     * @return string HTML string
     */
    public function render_lptimeline_userplan_page(lptimeline_userplan_page $page) {
        return $this->render_from_template('block_vnr_db_lptimeline_userplan/lptimeline_userplan',
            $page->export_for_template($this));
    }
    public function render_lptimeline_usercoursecomp_page(lptimeline_usercoursecomp_page $page) {
        return $this->render_from_template('block_vnr_db_lptimeline_userplan/lptimeline_usercoursecomp',
            $page->export_for_template($this));
    }
}
