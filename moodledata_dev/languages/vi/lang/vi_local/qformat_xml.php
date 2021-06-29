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
 * Local language pack from http://221.132.17.180:888
 *
 * @package    qformat
 * @subpackage xml
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['invalidxml'] = 'Tệp XML không hợp lệ - chuỗi được mong đợi (sử dụng CDATA?)';
$string['pluginname'] = 'Định dạng Moodle XML';
$string['pluginname_help'] = 'Đây là định dạng dành riêng cho Moodle để nhập và xuất câu hỏi.';
$string['privacy:metadata'] = 'Plugin định dạng câu hỏi XML không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['truefalseimporterror'] = '<b> Cảnh báo </b>: Không thể nhập câu hỏi đúng/sai \'{$a->questiontext}\'. Không rõ câu trả lời đúng là đúng hay sai. Câu hỏi đã được nhập với giả định rằng câu trả lời là \'{$a->answer}\'. Nếu điều này không chính xác, bạn sẽ cần phải chỉnh sửa câu hỏi.';
$string['unsupportedexport'] = 'Loại câu hỏi {$a} không được xuất XML hỗ trợ';
$string['xmlimportnoname'] = 'Thiếu tên câu hỏi trong tệp XML';
$string['xmlimportnoquestion'] = 'Thiếu văn bản câu hỏi trong tệp XML';
$string['xmltypeunsupported'] = 'Nhập XML không hỗ trợ loại câu hỏi {$a}';
