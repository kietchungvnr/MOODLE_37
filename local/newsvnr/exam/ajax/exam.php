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
// require_login();
$PAGE->set_context(context_system::instance());

$action = required_param('action', PARAM_ALPHANUMEXT);
$subjectexam_params = optional_param_array('subjectexam', '',PARAM_RAW);
$pagesize = optional_param('pagesize',10, PARAM_INT);
$pagetake = optional_param('take',0, PARAM_INT);
$pageskip = optional_param('skip',0, PARAM_INT);
$q = optional_param('q','', PARAM_RAW);
$data = array();

switch ($action) {
    case 'subjectexam':
        $obj              = new stdclass;
        $obj->name        = $subjectexam_params['name'];
        $obj->code        = $subjectexam_params['code'];
        $obj->shortname        = $subjectexam_params['shortname'];
        $obj->usercreate        = $USER->id;
        $obj->usermodified        = $USER->id;
        $obj->timecreated        = time();
        $obj->timemodified        = time();
        $obj->visible        = $subjectexam_params['visible'];
        $obj->description = $subjectexam_params['description'];
        // $DB->insert_record('exam_subject', $obj);
        $data['success'] = 'Thêm kì thi thành công';
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die;
    case 'subjectexam_grid':
    	$odersql = "";
		$wheresql = "";
		if($q) {
			$wheresql = "WHERE name LIKE N'%$q%'";
		}
		if($pagetake == 0) {
			$ordersql = "RowNum";
		} else {
			$ordersql = "RowNum OFFSET $pageskip ROWS FETCH NEXT $pagetake ROWS only";
		}
    	$sql = "SELECT *, (SELECT COUNT(id) FROM mdl_exam_subject wheresql) AS total
					FROM (SELECT *, ROW_NUMBER() OVER (ORDER BY id) AS RowNum
						  FROM mdl_exam_subject wheresql
						 ) AS Mydata
					ORDER BY $ordersql";
    	$get_list = $DB->get_records_sql($sql);
		$data = [];
		foreach ($get_list as $value) {
			$buttons = array();
			if($value->visible == 1) {
				$buttons[] = html_writer::link('javascript:void(0)',
				$OUTPUT->pix_icon('t/hide', get_string('hide')),
				array('title' => get_string('hide'),'id' => $value->id, 'class' => 'hide-item','data-active' => 'orgcate_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',0)'));	
			} else {
				$buttons[] = html_writer::link('javascript:void(0)',
				$OUTPUT->pix_icon('t/show', get_string('show')),
				array('title' => get_string('show'),'id' => $value->id, 'class' => 'show-item','data-active' => 'orgcate_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',1)'));	
			}
			$buttons[] = html_writer::link(new moodle_url('/local/newsvnr/orgcate.php',array('id' => $value->id)),
				$OUTPUT->pix_icon('t/edit', get_string('edit')),
				array('title' => get_string('edit')));
			$buttons[] = html_writer::link('javascript:void(0)',
				$OUTPUT->pix_icon('t/delete', get_string('delete')),
				array('title' => get_string('delete'),'id' => $value->id, 'class' => 'delete-item','data-section' => 'orgcate','id' => $value->id,'onclick' => 'org_delete('.$value->id.')'));
			$showbuttons = implode(' ', $buttons);
			$object = new stdclass;
			$object->id = $value->id;		
			$object->name = $value->name;		
			$object->code = $value->code;
			$object->shortname = $value->shortname;
			$object->description = $value->description;
			$object->listbtn = $showbuttons;
			$object->total = $value->total;
			$data[] = $object;		
		}
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
		die;
	case 'subjectexam_edit':
		var_dump($subjectexam_params);die;
    default:
        # code...
        break;
}
