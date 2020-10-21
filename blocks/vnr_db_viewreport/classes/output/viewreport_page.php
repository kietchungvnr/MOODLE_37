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
 * Block xem chi tiết biểu đồ, báo cáo....
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_viewreport\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;

class viewreport_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $DB,$USER;
        $data = array();
        $list_chart = [];
        $list_chart_std = new stdClass();
        $list_chart_std->id = 1;
        $list_chart_std->name = get_string('reportcompletedcourse', 'block_vnr_db_viewreport');
        $list_chart[] = $list_chart_std;

        $list_course = get_list_course_by_teacher($USER->id);

        $data['list_course'] = $list_course;
        $data['list_chart'] = $list_chart;

        // $resp = new stdClass();
        // $resp->type = 'line';
        // $resp->title = (object)['text' => ''];
        // $resp->subtitle = (object)['text' => ''];
        // $resp->xAxis = (object)['categories' => '123'];
        // $resp->yAxis = (object)['title' => (object)['text' => 'Số lượng học viên']];
        // $resp->credits = (object)['enabled' => false];
        // $resp->plotOptions = (object)['line' => (object)['dateLabels' => (object)['enabled' => true], 'enableMouseTracking' => false]];
        // $resp->series = [(object)['name' => 'Học viên mới tham gia lớp học','data' => $list_joincourse,'color' => '#ef4914']];


        // var_dump(json_encode($resp,JSON_UNESCAPED_UNICODE));die;


        return $data;
    }
}