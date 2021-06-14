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
 * @package    assignfeedback
 * @subpackage offline
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['confirmimport'] = 'Xác nhận nhập điểm';
$string['default'] = 'Được bật theo mặc định';
$string['default_help'] = 'Nếu được đặt, tính điểm ngoại tuyến với trang tính sẽ được bật theo mặc định cho tất cả các bài tập mới.';
$string['downloadgrades'] = 'Tải xuống bảng tính chấm điểm';
$string['enabled'] = 'Bảng tính chấm điểm ngoại tuyến';
$string['enabled_help'] = 'Nếu được bật, giáo viên sẽ có thể tải xuống và tải lên trang tính có điểm của học sinh khi chấm bài tập.';
$string['feedbackupdate'] = 'Đặt trường "{$a->field}" cho "{$a->student}" thành "{$a->text}"';
$string['gradelockedingradebook'] = 'Điểm đã được khóa trong sổ điểm cho {$a}';
$string['graderecentlymodified'] = 'Điểm đã được sửa đổi trong Moodle gần đây hơn trong bảng tính điểm cho {$a}';
$string['gradesfile'] = 'Bảng tính chấm điểm (định dạng csv)';
$string['gradesfile_help'] = 'Bảng tính chấm điểm với các điểm đã sửa đổi. Tệp này phải là tệp CSV có mã hóa UTF-8 đã được tải xuống từ bài tập, với các cột cho điểm và số nhận dạng của học sinh.';
$string['gradeupdate'] = 'Đặt điểm cho {$a->student} thành {$a->grade}';
$string['ignoremodified'] = 'Cho phép cập nhật các bản ghi đã được sửa đổi gần đây trong Moodle hơn là trong bảng tính.';
$string['ignoremodified_help'] = 'Khi bảng tính chấm điểm được tải xuống từ Moodle, nó chứa ngày sửa đổi cuối cùng cho mỗi điểm. Nếu bất kỳ điểm nào được cập nhật trong Moodle sau khi trang tính này được tải xuống, theo mặc định, Moodle sẽ từ chối ghi đè thông tin cập nhật này khi nhập điểm. Bằng cách chọn tùy chọn này, Moodle sẽ tắt tính năng kiểm tra an toàn này và có thể có nhiều điểm đánh dấu ghi đè lên các điểm khác.';
$string['importgrades'] = 'Xác nhận các thay đổi trong bảng tính điểm';
$string['invalidgradeimport'] = 'Moodle không thể đọc trang tính đã tải lên. Đảm bảo rằng nó được lưu ở định dạng giá trị được phân tách bằng dấu phẩy (.csv) và thử lại.';
$string['nochanges'] = 'Không tìm thấy điểm sửa đổi nào trong trang tính đã tải lên';
$string['offlinegradingworksheet'] = 'Điểm';
$string['pluginname'] = 'File chấm điểm dạng spreadsheet';
$string['privacy:nullproviderreason'] = 'Plugin này không có cơ sở dữ liệu để lưu trữ thông tin người dùng. Nó chỉ sử dụng các API trong mod_assign để giúp hiển thị giao diện chấm điểm.';
$string['processgrades'] = 'Nhập điểm';
$string['skiprecord'] = 'Bỏ qua bản ghi';
$string['updatedgrades'] = 'Đã cập nhật điểm và phản hồi của {$a}';
$string['updaterecord'] = 'Cập nhật bản ghi';
$string['uploadgrades'] = 'Tải lên bảng tính điểm';
