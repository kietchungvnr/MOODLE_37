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

require_once(__DIR__ . '/../../config.php');
// $section  = required_param('section',PARAM_RAW);
$id = required_param('id',PARAM_RAW);

require_login();

$context = context_system::instance();
$params = [];
if($id){
  $params['id'] = $id;
}
$baseurl = new moodle_url('/blocks/vnr_db_viewreport/viewreport.php',$params);
$dashboardurl = new moodle_url('/my/index.php');
$strviewreport = get_string('detailreport', 'block_vnr_db_viewreport');
$PAGE->set_context($context);
$PAGE->set_url($baseurl);
$PAGE->set_pagelayout('standard');
$PAGE->set_title($strviewreport);
$PAGE->set_heading($strviewreport);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add(get_string('dashboard', 'block_vnr_db_viewreport'),$dashboardurl);
$PAGE->navbar->add($strviewreport);
$output = $PAGE->get_renderer('block_vnr_db_viewreport');
$page = new \block_vnr_db_viewreport\output\viewreport_page();
echo $output->header();

echo $output->render($page);

echo $output->footer();