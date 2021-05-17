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
 * Version details
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package local_newsvnr
 * @copyright 2019 VnResource
 * @author   Le Thanh Vu
 **/
 
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/lib.php');
$id = optional_param('id',0,PARAM_INT);
$baseurl = new moodle_url('/local/newsvnr/index.php');
$url = new moodle_url('/local/newsvnr/emailmanagement.php');
if($id)
{
	//Đếm views trang tin tức
	news_countviews($id);

}
$PAGE->set_url($url);
$title = get_string('emailmanagement', 'local_newsvnr');
$PAGE->set_context(context_system::instance());
$PAGE->set_title($title);
$PAGE->set_heading($title);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add($title,$baseurl);
$PAGE->requires->js_call_amd('local_newsvnr/email_management', 'initEmailTemplate');
$PAGE->requires->strings_for_js(
                                array('required', 'name', 'code', 'emailtype', 'description', 'addnew', 'clear', 'templateemailconfig', 'action', 'edit', 'emailcontentconfig', 'fieldrequired', 'emptydata', 'add_success'), 'local_newsvnr');

echo $OUTPUT->header();

echo $OUTPUT->render_from_template('local_newsvnr/emailmanagement', $context = []);


echo $OUTPUT->footer();
