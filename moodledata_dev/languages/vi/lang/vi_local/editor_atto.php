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
 * @package    editor
 * @subpackage atto
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['autosavefailed'] = 'Không thể kết nối đến máy chủ. Nếu bạn gửi trang này ngay bây giờ, các thay đổi của bạn có thể bị mất.';
$string['autosavefrequency'] = 'Tần suất lưu tự động';
$string['autosavefrequency_desc'] = 'Đây là số giây giữa các lần thử lưu tự động. Atto sẽ tự động lưu văn bản trong trình chỉnh sửa theo cài đặt này, để văn bản có thể được tự động khôi phục khi cùng một 
người dùng trở về cùng một biểu mẫu.';
$string['autosaves'] = 'Biên tập viên tự động lưu thông tin';
$string['autosavesucceeded'] = 'Bản nháp đã được lưu.';
$string['editor_command_keycode'] = 'Cmd + {$a}';
$string['editor_control_keycode'] = 'Ctrl + {$a}';
$string['errorcannotparseline'] = 'Dòng \'{$a}\' không đúng định dạng.';
$string['errorgroupisusedtwice'] = 'Nhóm \'{$a}\' được xác định hai lần; tên nhóm phải là duy nhất.';
$string['errornopluginsorgroupsfound'] = 'Không tìm thấy plugin hoặc nhóm nào; vui lòng thêm một số nhóm và plugin.';
$string['errorpluginisusedtwice'] = 'Plugin \'{$a}\' được sử dụng hai lần; plugin chỉ có thể được xác định một lần.';
$string['errorpluginnotfound'] = 'Không thể sử dụng plugin \'{$a}\'; nó dường như không được cài đặt.';
$string['errortextrecovery'] = 'Rất tiếc, phiên bản nháp không thể được khôi phục.';
$string['infostatus'] = 'Thông tin';
$string['plugin_title_shortcut'] = '{$a->title} [{$a->phím tắt}]';
$string['pluginname'] = 'Chỉnh sửa HTML Atto';
$string['privacy:metadata:database:atto_autosave'] = 'Bản nháp của trình soạn thảo văn bản được lưu tự động.';
$string['privacy:metadata:database:atto_autosave:drafttext'] = 'Văn bản đã được lưu.';
$string['privacy:metadata:database:atto_autosave:timemodified'] = 'Thời gian mà nội dung đã được sửa đổi.';
$string['privacy:metadata:database:atto_autosave:userid'] = 'ID của người dùng có dữ liệu đã được lưu.';
$string['recover'] = 'Hồi phục';
$string['settings'] = 'Cài đặt thanh công cụ Atto';
$string['subplugintype_atto'] = 'Atto plugin';
$string['subplugintype_atto_plural'] = 'Atto plugins';
$string['taskautosavecleanup'] = 'Xóa các bản nháp tự động lưu đã hết hạn';
$string['textrecovered'] = 'Phiên bản nháp của văn bản này đã được tự động khôi phục.';
$string['toolbarconfig'] = 'Cấu hình thanh công cụ';
$string['toolbarconfig_desc'] = 'Danh sách các plugin và thứ tự chúng được hiển thị có thể được định cấu hình tại đây. Cấu hình bao gồm các nhóm (một trên mỗi dòng) theo sau là danh sách thứ tự các 
plugin cho nhóm đó. Nhóm được phân tách khỏi các plugin bằng dấu bằng và các plugin được phân tách bằng dấu phẩy. Tên nhóm phải là duy nhất và phải chỉ ra điểm chung của các nút. Tên nút và tên nhóm không được lặp lại và chỉ có thể chứa các ký tự chữ và số.';
$string['warningstatus'] = 'Cảnh báo';
