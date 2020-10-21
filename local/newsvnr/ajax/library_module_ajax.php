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

define('AJAX_SCRIPT', false);
require_once __DIR__ . '/../../../config.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_once $CFG->dirroot . '\theme\moove\classes\output\core_renderer.php';
require_once "pagination_library.php";
// require_login();
$PAGE->set_context(context_system::instance());
$perPage        = new PerPage();
$folderid       = optional_param('folderid', 0, PARAM_INT);
$page           = optional_param('page', 0, PARAM_INT);
$search         = optional_param('search', "", PARAM_TEXT);
$strsearch      = "N'" . '%' . $search . '%' . "'";
$data           = [];
$output         = '';
$paginationlink = $CFG->wwwroot . '/local/newsvnr/ajax/library_module_ajax.php?page=';
if ($page < 1) {
    $page = 1;
}
$start = ($page - 1) * $perPage->perpageCourseNews;
if ($start < 15) {
    $start = 0;
}
if ($folderid == 0) {
    $modulebyfolder  = $DB->get_records('library_module', [], 'timecreated DESC', '*', 0, 10);
    $allmodulefolder = $modulebyfolder;
} else {
    $modulebyfolder  = $DB->get_records('library_module', ['folderid' => $folderid], 'timecreated DESC', '*', $start, 15);
    $allmodulefolder = $DB->get_records('library_module', ['folderid' => $folderid]);
}
$perpageresult = $perPage->getAllCourseNewsPageLinks(count($allmodulefolder), $paginationlink);
foreach ($modulebyfolder as $module) {
    $alldatamodule = $DB->get_record_sql("SELECT cm.id,rs.name,cm.visible,CONCAT(u.firstname,' ', u.lastname) as fullnamet,cm.deletioninprogress
 											FROM {course_modules} cm
 											JOIN mdl_$module->moduletype rs on cm.instance = rs.id
 											JOIN {user} u on u.id = :userid
 										WHERE cm.id = :coursemoduleid AND rs.name LIKE $strsearch", ['userid' => $module->userid, 'coursemoduleid' => $module->coursemoduleid]);
    if (!empty($alldatamodule)) {
        if (($alldatamodule->visible == 1 && $alldatamodule->deletioninprogress == 0) || is_siteadmin()) {
            if ($module->moduletype == "resource") {
                $typeresource = mime2ext($module->minetype);
                if ($typeresource == 'xls' || $typeresource == 'xlsx') {
                    $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('f/spreadsheet-24') . '">';
                } elseif ($typeresource == 'ppt') {
                    $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('f/powerpoint-24') . '">';
                } elseif ($typeresource == 'docx') {
                    $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('f/document-24') . '">';
                } elseif ($typeresource == 'pdf') {
                    $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('f/pdf-24') . '">';
                }
            } else {
                $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('icon', $module->moduletype) . '">';
            }
            $url = $CFG->wwwroot . '/mod/' . $module->moduletype . '/view.php?id=' . $alldatamodule->id;
            $output .= '<tr>';
            $output .= '<td><a href="' . $url . '" target="_blank">' . $img . '' . $alldatamodule->name . '</a></td>';
            if ($module->moduletype == "resource") {
                $output .= '<td>' . strtoupper($typeresource) . '</td>';
            } else {
                $output .= '<td>' . strtoupper($module->moduletype) . '</td>';
            }
            if ($module->filesize > 0) {
                $output .= '<td>' . display_size($module->filesize) . '</td>';
            } else {
                $output .= '<td></td>';
            }
            $output .= '<td>' . convertunixtime('d/m/Y', $module->timecreated, 'Asia/Ho_Chi_Minh') . '</td>';
            $output .= '<td>' . $alldatamodule->fullnamet . '</td>';
            if (is_siteadmin()) {
                $output .= '<td>';
                $output .= '<a href="' . $CFG->wwwroot . '/course/mod.php?sesskey=IfaneUnu2h&delete=' . $alldatamodule->id . '">' . $OUTPUT->pix_icon('t/delete', get_string('delete')) . '</a>';
                $output .= '<a href="' . $CFG->wwwroot . '/course/modedit.php?update=' . $alldatamodule->id . '&return=0&sr=">' . $OUTPUT->pix_icon('t/edit', get_string('edit')) . '</a>';
                if ($alldatamodule->visible == 1) {
                    $output .= '<a href="' . $CFG->wwwroot . '/course/mod.php?sesskey=cd6mxlcQgF&hide=' . $alldatamodule->id . '">' . $OUTPUT->pix_icon('t/hide', get_string('hide')) . '</a>';
                } else {
                    $output .= '<a href="' . $CFG->wwwroot . '/course/mod.php?sesskey=cd6mxlcQgF&show=' . $alldatamodule->id . '">' . $OUTPUT->pix_icon('t/show', get_string('show')) . '</a>';
                }
                $output .= '</td>';
            }
            $output .= '</tr>';
        }
    }
}
if (empty($allmodulefolder)) {
    $output2 = '<div class="alert alert-warning" role="alert">'.get_string('nomodule','local_newsvnr').'</div>';
    $data['alert']  = $output2;
}

$data['result'] = $output;
$data['header'] = $OUTPUT->count_module_by_folder($folderid);
echo json_encode($data, JSON_UNESCAPED_UNICODE);

if (!empty($perpageresult && $folderid != 0)) {
    echo '<div class="col-md-12" id="load-course"> <div id="pagination" folderid="' . $folderid . '">' . $perpageresult . '</div> </div>';
}

die();
