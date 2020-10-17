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
require_once('filelibrary_form.php');
require_once('rolepermissions_form.php');

require_login();

$context = context_system::instance();
$user_context = context_user::instance($USER->id);
$url = $CFG->wwwroot . '/local/newsvnr/generallibrary.php';
$strbtnrole = get_string('btnrole', 'local_newsvnr'); 
$strgenerallibrary = get_string('generallibrary', 'local_newsvnr');
$strrolepermissions = get_string('rolepermissions', 'local_newsvnr');
$strlistsharefile = get_string('listsharefile', 'local_newsvnr');

$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());


$PAGE->set_title($strgenerallibrary);
$PAGE->set_heading($strgenerallibrary);

$PAGE->navbar->ignore_active();

$PAGE->navbar->add($strgenerallibrary);


$js = $PAGE->requires->js_call_amd('local_newsvnr/requestfiles', 'init');
$output = $PAGE->get_renderer('local_newsvnr');
$page = new \local_newsvnr\output\generallibrary_page();

$data = new stdClass();
$maxbytes = get_user_max_upload_file_size($context, $CFG->maxbytes);

if(has_capability('local/newsvnr:createfoldersystem', $user_context)) {
    $subdirs = 1;
} else {
    $subdirs = 0;
}

$options = array('subdirs' => $subdirs, 'maxbytes' => $maxbytes, 'maxfiles' => -1, 'accepted_types' => '*');


// $options['generallibrary'] = true;
file_prepare_standard_filemanager_filelibrary($data, 'files', $options, $context, 'local_newsvnr', 'content', 0);

$filelibraryform = new local_newsvnr_filelibrary_form(null, array('data'=>$data, 'options'=>$options));
$redirecturl = $url;

if ($filelibraryform->is_cancelled()) {
    redirect($redirecturl);
} else if ($formdata = $filelibraryform->get_data()) {
    $formdata = file_postupdate_standard_filemanager($formdata, 'files', $options, $context, 'local_newsvnr', 'content', 0);

}

$rolepermissionsform = new local_newsvnr_rolepremissions_form(null);

echo $OUTPUT->header();
echo $OUTPUT->heading(format_string(''));

echo '<ul class="nav-tabs nav" id="generallibrary-tab">';
echo '  <li class="nav-item active font-weight-bold " data-key="systemfiles">
            <a class="nav-link text-dark" href="#systemfiles" data-toggle="tab">'.$strgenerallibrary.'</a>
        </li>
       
        <li class="nav-item " data-key="requestaccecpt">
            <a class="nav-link" href="#requestaccecpt" data-toggle="tab">'.$strlistsharefile.'</a>
        </li>';
if(is_siteadmin()) {
    echo '  <li class="nav-item " data-key="rolepermissions">
            <a class="nav-link" href="#rolepermissions" data-toggle="tab">'.$strrolepermissions.'</a>
        </li>';
}

echo '</ul>';

echo '<div id="generallibrary-content" class="tab-content">';

// Tab tài nguyên hệ thống
echo '<div class="tab-pane fade in active" id="systemfiles">';
echo $OUTPUT->box_start('generalbox foldertree');
$filelibraryform->display();
echo $OUTPUT->box_end();
echo '</div>';

// Tab duyệt file
echo '<div class="tab-pane fade" id="requestaccecpt">';
echo $output->render($page);
echo '</div>';

if(is_siteadmin()) {
    // Tab phân quyền
    echo '<div class="tab-pane fade" id="rolepermissions">';
    echo $OUTPUT->box_start('generalbox foldertree');
    $rolepermissionsform->display();
    echo '<button type="button" class="btn btn-primary mb-3" id="checkrole" onclick="checkRoles()">'.$strbtnrole.'</button>';
    echo '<div id="iframepermissions" style="height: 190px"></div>';
    echo $OUTPUT->box_end();
    echo '</div>';
}

echo '</div>';

echo $OUTPUT->footer();