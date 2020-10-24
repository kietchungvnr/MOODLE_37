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
$modulebyfolder = [];
$output         = '';
$paginationlink = $CFG->wwwroot . '/local/newsvnr/ajax/library_module_ajax.php?page=';
$sql            = "SELECT lm.*,cm.id,CONCAT(rs.name,b.name,l.name,i.name) AS name,cm.visible,CONCAT(u.firstname,' ', u.lastname) as fullnamet,cm.deletioninprogress,cm.instance
					FROM mdl_library_module lm
						JOIN mdl_course_modules cm on cm.id = lm.coursemoduleid
						LEFT JOIN mdl_resource rs on cm.instance = rs.id
						LEFT JOIN mdl_book b on cm.instance = b.id
						LEFT JOIN mdl_lesson l on cm.instance = l.id
						LEFT JOIN mdl_imscp i on cm.instance = i.id
						JOIN mdl_user u on u.id = lm.userid
					WHERE CONCAT(rs.name,b.name,l.name,i.name) LIKE $strsearch";
if ($page < 1) {
    $page = 1;
}
$start = ($page - 1) * $perPage->perpageModule;
if ($start < 10) {
    $start = 0;
}
if ($folderid == 0) {
    $modulebyfolder = $DB->get_records_sql("$sql ORDER BY timecreated DESC OFFSET 0 ROWS FETCH NEXT 10 ROWS only");
    $countall       = $modulebyfolder;
} else {
    $modulebyfolder = $DB->get_records_sql("$sql AND lm.folderid =:folderid ORDER BY timecreated DESC OFFSET $start ROWS FETCH NEXT 10 ROWS only", ['folderid' => $folderid]);
    $countall       = $DB->get_records_sql("$sql AND lm.folderid =:folderid", ['folderid' => $folderid]);
}
if (!empty($modulebyfolder)) {
    foreach ($modulebyfolder as $module) {
    	
        if (($module->visible == 1 && $module->deletioninprogress == 0) || is_siteadmin()) {
            if ($module->moduletype == "resource") {
            	$url = get_link_file($module);
                $typeresource = mime2ext($module->minetype);
                if ($typeresource == 'xls' || $typeresource == 'xlsx' || $typeresource == 'xlsm') {
                    $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('f/spreadsheet-24') . '">';
                } elseif ($typeresource == 'ppt') {
                    $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('f/powerpoint-24') . '">';
                } elseif ($typeresource == 'docx' || $typeresource == 'doc' || $typeresource == 'docm') {
                    $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('f/document-24') . '">';
                } elseif ($typeresource == 'pdf') {
                    $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('f/pdf-24') . '">';
                }
            } else {
                $img = '<img title="' . $module->moduletype . '" class="pr-1" src="' . $OUTPUT->image_url('icon', $module->moduletype) . '">';
                $url = $CFG->wwwroot . '/mod/' . $module->moduletype . '/view.php?id=' . $module->id;
            }
            $output .= '<tr>';
            $output .= '<td><a onclick="iFrameLibrary(\'' . $url . '\',\'' . $module->moduletype . '\')">' . $img . '' . $module->name . '</a></td>';
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
            $output .= '<td>' . $module->fullnamet . '</td>';
            if (is_siteadmin()) {
                $output .= '<td>';
                $output .= '<a  href="' . $CFG->wwwroot . '/course/mod.php?sesskey=IfaneUnu2h&delete=' . $module->id . '">' . $OUTPUT->pix_icon('t/delete', get_string('delete')) . '</a>';
                $output .= '<a href="' . $CFG->wwwroot . '/course/modedit.php?update=' . $module->id . '&return=0&sr=">' . $OUTPUT->pix_icon('t/edit', get_string('edit')) . '</a>';
                if ($module->visible == 1) {
                    $output .= '<a href="' . $CFG->wwwroot . '/course/mod.php?sesskey='.$USER->sesskey.'&hide=' . $module->id . '">' . $OUTPUT->pix_icon('t/hide', get_string('hide')) . '</a>';
                } else {
                    $output .= '<a href="' . $CFG->wwwroot . '/course/mod.php?sesskey='.$USER->sesskey.'&show=' . $module->id . '">' . $OUTPUT->pix_icon('t/show', get_string('show')) . '</a>';
                }
                if ($module->moduletype == 'resource') {
                    $output .= '<a href="' . $url . '" download><i class="fa fa-download" aria-hidden="true"></i></a>';
                }
                $output .= '</td>';
            }
            $output .= '</tr>';
        }
    }
}
$perpageresult = $perPage->getAllPageLinks(count($countall), $paginationlink);
if (!empty($perpageresult && $folderid != 0)) {
    $pagination = '<div class="col-md-12 mb-2" id="pagination" folderid="' . $folderid . '" search="' . $search . '">' . $perpageresult . '</div> </div>';
} else {
    $pagination = '<div class="col-md-12 mb-2" id="pagination" folderid="' . $folderid . '" search="' . $search . '"></div>';
}
if (empty($countall)) {
    $alert         = '<div class="alert alert-warning" role="alert">' . get_string('nomodule', 'local_newsvnr') . '</div>';
    $data['alert'] = $alert;
}
$data['pagination'] = $pagination;
$data['header']     = $OUTPUT->count_module_by_folder($folderid, $search);
$data['result']     = $output;
echo json_encode($data, JSON_UNESCAPED_UNICODE);
die();
