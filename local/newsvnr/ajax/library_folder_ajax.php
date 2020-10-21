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
require_once $CFG->dirroot . '\theme\moove\classes\output\core_renderer.php';
// require_login();
$PAGE->set_context(context_system::instance());

$foldername = optional_param('foldername', "", PARAM_TEXT);
$parentid   = optional_param('parentid', 0, PARAM_INT);
$folderdes  = optional_param('folderdes', "", PARAM_TEXT);
$action     = optional_param('action', "", PARAM_TEXT);
$folderid   = optional_param('folderid', 0, PARAM_INT);
$data       = array();
$obj        = new stdClass();

switch ($action) {
    case 'add':
        $obj->name        = $foldername;
        $obj->parent      = $parentid;
        $obj->description = $folderdes;
        $DB->insert_record('library_folder', $obj);
        $data['alert'] = get_string('alertaddfolder','local_newsvnr');
        break;
    case 'delete':
        $DB->update_record('library_folder', array('id' => $folderid, 'visible' => 0));
        $objupdates = $DB->get_records('library_folder', ['parent' => $folderid]);
        foreach ($objupdates as $value) {
            $DB->update_record('library_folder', array('id' => $value->id, 'visible' => 0));
        }
        $data['alert'] = get_string('alertdeletefolder','local_newsvnr');
        break;
    case 'update':
        $obj->name        = $foldername;
        $obj->parent      = $parentid;
        $obj->description = $folderdes;
        $obj->id          = $folderid;
        $obj->visible     = 0;
        $DB->update_record('library_folder', $obj);
        $data['alert'] = get_string('alerteditfolder','local_newsvnr');
        break;
    case 'edit':
        $folder       = $DB->get_record_sql('SELECT * FROM {library_folder} WHERE id = :id', ['id' => $folderid]);
        $folderparent = $DB->get_record_sql('SELECT * FROM {library_folder} WHERE id = :parentid', ['parentid' => $folder->parent]);
        if ($folderparent == false) {
            $input = '<input autocomplete="off" class="form-control" id="folderparent">';
        } else {
            $input = '<input autocomplete="off" class="form-control" id="folderparent" parentid="' . $folderparent->id . '" value="' . $folderparent->name . '">';
        }
        $output = '<div class="modal fade" id="edit-popup-modal-folder" role="dialog">
					    <div class="modal-dialog">
					      <!-- Modal content-->
					      <div class="modal-content">
					        <div class="modal-header">
					          <h4 class="modal-title">'.get_string('editfolder','local_newsvnr').'</h4>
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					        </div>
					        <div class="modal-body edit-folder-popup">
					        	 <div class="form-group	">
							      <label for="email">'.get_string('foldername','local_newsvnr').':</label>
							      <input autocomplete="off" class="form-control" id="foldername" value="' . $folder->name . '">
							    </div>
							    <div class="form-group">
							      <label for="pwd">'.get_string('folderparent','local_newsvnr').':</label>
							      ' . $input . '
							      <div id="tree-view-folder">' . $OUTPUT->library_folder() . '</div>
							    </div>
							   	<div class="form-group">
							      <label for="pwd">'.get_string('description','local_newsvnr').':</label>
							      <textarea autocomplete="off" class="form-control" id="folderdes" value="' . $folder->description . '"></textarea>
							    </div>
					        </div>
					        <div class="modal-footer">
					          <button type="button" class="btn btn-primary" action="update" onclick="updateFolder(' . $folder->id . ')" id="edit-folder-popup">'.get_string('finisheditfolder','local_newsvnr').'</button>
					          <button type="button" class="btn btn-default" data-dismiss="modal">'.get_string('cancel','local_newsvnr').'</button>
					        </div>
					      </div>

					    </div>
				  </div>';
        $data['result'] = $output;
        break;
    default:
        break;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);

die();
