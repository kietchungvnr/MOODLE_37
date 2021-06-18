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
require_once __DIR__ . '/../../lib.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_login();
$action     = optional_param('action', '', PARAM_RAW);
$name       = optional_param('name', '', PARAM_RAW);
$shortname  = optional_param('shortname', '', PARAM_RAW);
$code       = optional_param('code', '', PARAM_RAW);
$fax        = optional_param('fax', '', PARAM_RAW);
$phone      = optional_param('phone', '', PARAM_RAW);
$website    = optional_param('website', '', PARAM_RAW);
$address    = optional_param('address', '', PARAM_RAW);
$isactive   = optional_param('isactive', '', PARAM_BOOL);
$divisionid = optional_param('divisionid', '', PARAM_INT);
$data       = array();
switch ($action) {
    case 'add':
        $object               = new stdClass();
        $object->code         = $code;
        $object->divisionname = $name;
        $object->address      = $address;
        $object->datecreated  = time();
        $object->usercreated  = $USER->id;
        $object->shortname    = $shortname;
        $object->fax          = $fax;
        $object->phone        = $phone;
        $object->website      = $website;
        $object->isactive     = $isactive;
        if ($DB->insert_record('division', $object)) {
            $data['result'] = 'Thêm thành công';
        }
        break;

    case 'deleteselected':
        if (isset($_POST['dataselect'])) {
            $divisions = json_decode($_POST['dataselect']);
        }
        foreach ($divisions as $division) {
            if ($DB->delete_records('division', ['id' => $division->id])) {
                $data['result'] = 'Xóa thành công';
            }
        }
        break;

    case 'delete':
        if ($DB->delete_records('division', ['id' => $divisionid])) {
            $data['result'] = 'Xóa thành công';
        }
        break;

    case 'update':
        $object               = new stdClass();
        $object->id           = $divisionid;
        $object->code         = $code;
        $object->divisionname = $name;
        $object->address      = $address;
        $object->usercreated  = $USER->id;
        $object->shortname    = $shortname;
        $object->fax          = $fax;
        $object->phone        = $phone;
        $object->website      = $website;
        $object->isactive     = $isactive;
        $object->userupdate   = $USER->id;
        $object->dateupdate   = time();
        if ($DB->update_record('division', $object)) {
            $data['result'] = 'Chỉnh sửa thành công';
        }
        break;

    case 'active':
        $object           = new stdClass();
        $object->id       = $divisionid;
        $object->isactive = 1;
        if ($DB->update_record('division', $object)) {
            $data['result'] = 'Kích hoạt thành công';
        }
        break;

    case 'unactive':
        $object           = new stdClass();
        $object->id       = $divisionid;
        $object->isactive = 0;
        if ($DB->update_record('division', $object)) {
            $data['result'] = 'Hủy kích hoạt thành công';
        }
        break;

    default:
        break;
}
echo json_encode($data, JSON_UNESCAPED_UNICODE);
