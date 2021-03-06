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
require_once __DIR__ . '/../../../../config.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_once $CFG->dirroot . '\theme\moove\classes\output\core_renderer.php';
require_once "../system_paginationAll.class.php";
// require_login();
$PAGE->set_context(context_system::instance());
$perPage         = new PerPage();
$folderid        = optional_param('folderid', 0, PARAM_INT);
$page            = optional_param('page', 0, PARAM_INT);
$search          = optional_param('search', "", PARAM_TEXT);
$modulefilter    = optional_param('modulefilter', "", PARAM_TEXT);
$searchtype      = optional_param('searchtype', "", PARAM_TEXT);
$strsearch       = "N'" . '%' . $search . '%' . "'";
$strmodulefilter = "N'" . '%' . $modulefilter . '%' . "'";
$data            = [];
$modulebyfolder  = [];
$output          = '';
$allowmodule     = ['book', 'lesson', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt'];
$paginationlink  = $CFG->wwwroot . '/local/newsvnr/ajax/library_online/library_module_ajax.php?folderid=' . $folderid . '&search=' . $search . '&page=';
if ($searchtype == "searchcontent") {
    $searchsql = "(lp.title LIKE $strsearch OR lp.contents LIKE $strsearch OR pa.intro LIKE $strsearch OR pa.content LIKE $strsearch OR ur.externalurl LIKE $strsearch OR (bc.CONTENT LIKE $strsearch OR bc.title LIKE $strsearch))";
} else {
    $searchsql = "CONCAT(rs.name,b.name,l.name,i.name,pa.name,ur.name) LIKE $strsearch";
}
$sql = "SELECT DISTINCT lm.*,cm.id,CONCAT(rs.name,b.name,l.name,i.name,pa.name,ur.name) AS name,cm.visible,CONCAT(u.firstname,' ', u.lastname) as fullnamet,cm.deletioninprogress,cm.instance
                    FROM mdl_library_module lm
                        JOIN mdl_course_modules cm on cm.id = lm.coursemoduleid
                        LEFT JOIN mdl_resource rs on cm.instance = rs.id AND rs.course = 1
                        LEFT JOIN mdl_book b on cm.instance = b.id AND b.course = 1
                        LEFT JOIN mdl_book_chapters bc on bc.bookid = b.id
                        LEFT JOIN mdl_page pa on cm.instance = pa.id AND pa.course = 1
                        LEFT JOIN mdl_url ur on cm.instance = ur.id AND ur.course = 1
                        LEFT JOIN mdl_lesson l on cm.instance = l.id AND l.course = 1
                        LEFT JOIN mdl_lesson_pages lp on l.id = lp.lessonid
                        LEFT JOIN mdl_imscp i on cm.instance = i.id AND i.course = 1
                        JOIN mdl_user u on u.id = lm.userid
                        JOIN mdl_library_folder lf on lf.id = lm.folderid
                        LEFT JOIN mdl_library_folder_permissions fp on fp.folderlibraryid = lf.id
                        LEFT JOIN mdl_library_user_permissions up on up.permissionid = fp.id
                        LEFT JOIN mdl_user uss on uss.orgpositionid = up.permissionid
                    WHERE (uss.id is NULL or uss.id = $USER->id) AND $searchsql AND lm.approval = 1 AND (lm.moduletype LIKE $strmodulefilter OR lm.minetype LIKE $strmodulefilter)";
$start = $perPage->getStart($page); 
if ($folderid == 0) {
    $modulebyfolder = $DB->get_records_sql("$sql ORDER BY timecreated DESC OFFSET $start ROWS FETCH NEXT $perPage->itemPerPage ROWS only");
    $countall       = $DB->get_records_sql("$sql");
    foreach ($countall as $key => $value) {
        $listposition = folder_permission_list($value->folderid);
        if (!empty($listposition) AND !is_siteadmin()) {
            if (!in_array($USER->orgpositionid, $listposition)) {
                unset($countall[$key]);
                unset($modulebyfolder[$key]);
            }
        }
    }
} else {
    $modulebyfolder = $DB->get_records_sql("$sql AND lm.folderid =:folderid ORDER BY timecreated DESC OFFSET $start ROWS FETCH NEXT $perPage->itemPerPage ROWS only", ['folderid' => $folderid]);
    $countall       = $DB->get_records_sql("$sql AND lm.folderid =:folderid", ['folderid' => $folderid]);
}
if (!empty($modulebyfolder)) {
    foreach ($modulebyfolder as $module) {
        if (($module->visible == 1 && $module->deletioninprogress == 0) || is_siteadmin()) {
            if ($module->moduletype == "resource") {
                $url          = get_link_file($module);
                $typeresource = mime2ext($module->minetype);
                $img          = mimetype2Img($module->minetype);
            } else {
                $img = '<img title="' . $module->moduletype . '" class="pr-1 img-module" src="' . $OUTPUT->image_url('icon', $module->moduletype) . '">';
                $url = $CFG->wwwroot . '/mod/' . $module->moduletype . '/view.php?id=' . $module->id;
            }
            $output .= '<tr>';
            if (($module->moduletype != 'resource' && in_array($module->moduletype, $allowmodule)) || ($module->moduletype == 'resource' && in_array($typeresource, $allowmodule))) {
                $output .= '<td><a onclick="iFrameLibrary(\'' . $url . '\',\'' . $module->moduletype . '\')">' . $img . '' . $module->name . '</a></td>';
            } else {
                $output .= '<td><a href="' . $url . '" target="_blank" >' . $img . '' . $module->name . '</a></td>';
            }
            // Xử lý đạng module
            if ($module->moduletype == "resource") {
                $output .= '<td>' . strtoupper($typeresource) . '</td>';
            } else {
                $output .= '<td>' . strtoupper($module->moduletype) . '</td>';
            }
            // Xử lý file size của module resource
            if ($module->filesize > 0) {
                $output .= '<td>' . display_size($module->filesize) . '</td>';
            } else {
                $output .= '<td></td>';
            }
            $output .= '<td>' . convertunixtime('d/m/Y', $module->timecreated, 'Asia/Ho_Chi_Minh') . '</td>';
            $output .= '<td>' . $module->fullnamet . '</td>';
            $output .= '<td>';
            if (is_siteadmin() || check_teacherrole($USER->id) != 0) {
                $output .= html_writer::link('javascript:void(0)', '<i class="icon fa fa-share mr-2" aria-hidden="true"></i>', array('id' => 'share-module-library', 'moduleid' => $module->id));
            }
            if (is_siteadmin()) {

                $output .= html_writer::link('javascript:void(0)', $OUTPUT->pix_icon('t/delete', get_string('delete')), array("onclick" => "actionModule($module->id,'delete',$folderid)"));
                $output .= html_writer::link("/course/modedit.php?update=$module->id&return=0&sr=", $OUTPUT->pix_icon('t/edit', get_string('edit')));

                if ($module->visible == 1) {
                    $output .= html_writer::link('javascript:void(0)', $OUTPUT->pix_icon('t/hide', get_string('hide')), array("onclick" => "actionModule($module->id,'hide',$folderid)"));
                } else {
                    $output .= html_writer::link('javascript:void(0)', $OUTPUT->pix_icon('t/show', get_string('show')), array("onclick" => "actionModule($module->id,'show',$folderid)"));
                }
            }
            if ($module->moduletype == 'resource') {
                $output .= '<a href="' . $url . '" download><i class="fa fa-download" aria-hidden="true"></i></a>';
            }
            $output .= '</td>';
            $output .= '</tr>';
        }
    }
}
$perpageresult = $perPage->getAllPageLinks(count($countall), $paginationlink, '#table-library');
if (!empty($perpageresult)) {
    $pagination = '<div class="col-md-12 mb-2" id="pagination" folderid="' . $folderid . '" search="' . $search . '">' . $perpageresult . '</div> </div>';
} else {
    $pagination = '<div class="col-md-12 mb-2" id="pagination" folderid="' . $folderid . '" search="' . $search . '"></div>';
}
if (empty($countall)) {
    $alert         = '<div class="alert alert-warning" role="alert">' . get_string('nomodule', 'local_newsvnr') . '</div>';
    $data['alert'] = $alert;
}
$data['pagination'] = $pagination;
$data['header']     = $OUTPUT->count_module_by_folder($countall, $folderid);
$data['result']     = $output;
echo json_encode($data, JSON_UNESCAPED_UNICODE);
die();
