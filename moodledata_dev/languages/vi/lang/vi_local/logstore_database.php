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
 * @package    logstore
 * @subpackage database
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['buffersize'] = 'Kích thước bộ đệm';
$string['buffersize_help'] = 'Số lượng mục nhập nhật ký được chèn trong một hoạt động cơ sở dữ liệu hàng loạt, giúp cải thiện hiệu suất.';
$string['conectexception'] = 'Không thể kết nối với cơ sở dữ liệu.';
$string['create'] = 'Tạo';
$string['databasecollation'] = 'Đối chiếu cơ sở dữ liệu';
$string['databasehandlesoptions'] = 'Cơ sở dữ liệu xử lý các tùy chọn';
$string['databasehandlesoptions_help'] = 'Cơ sở dữ liệu từ xa có xử lý các tùy chọn của riêng nó không.';
$string['databasepersist'] = 'Kết nối cơ sở dữ liệu liên tục';
$string['databaseschema'] = 'Lược đồ cơ sở dữ liệu';
$string['databasesettings'] = 'Cài đặt cơ sở dữ liệu';
$string['databasesettings_help'] = 'Chi tiết kết nối cho cơ sở dữ liệu nhật ký bên ngoài: {$a}';
$string['databasetable'] = 'Bảng cơ sở dữ liệu';
$string['databasetable_help'] = 'Tên của bảng nơi các bản ghi sẽ được lưu trữ. Bảng này phải có cấu trúc giống với cấu trúc được sử dụng bởi logstore_standard (mdl_logstore_standard_log).';
$string['filters'] = 'Lọc nhật ký';
$string['filters_help'] = 'Bật các bộ lọc loại trừ một số hành động được ghi lại.';
$string['includeactions'] = 'Bao gồm các hành động của các loại này';
$string['includelevels'] = 'Bao gồm các hành động với các cấp học này';
$string['jsonformat'] = 'Định dạng JSON';
$string['jsonformat_desc'] = 'Sử dụng định dạng JSON tiêu chuẩn thay vì dữ liệu được tuần tự hóa PHP trong trường cơ sở dữ liệu \'khác\'.';
$string['logguests'] = 'Ghi nhật ký các hành động của khách';
$string['other'] = 'Khác';
$string['participating'] = 'Tham gia';
$string['pluginname'] = 'Nhật ký cơ sở dữ liệu bên ngoài';
$string['pluginname_desc'] = 'Một plugin nhật ký lưu trữ các mục nhật ký trong bảng cơ sở dữ liệu bên ngoài.';
$string['privacy:metadata:log'] = 'Tập hợp các sự kiện trong quá khứ';
$string['privacy:metadata:log:anonymous'] = 'Liệu sự kiện có được gắn cờ là ẩn danh hay không';
$string['privacy:metadata:log:eventname'] = 'Tên sự kiện';
$string['privacy:metadata:log:ip'] = 'Địa chỉ IP được sử dụng tại thời điểm diễn ra sự kiện';
$string['privacy:metadata:log:origin'] = 'Nguồn gốc của sự kiện';
$string['privacy:metadata:log:other'] = 'Thông tin bổ sung về sự kiện';
$string['privacy:metadata:log:realuserid'] = 'ID của người dùng thực đằng sau sự kiện, khi giả mạo người dùng.';
$string['privacy:metadata:log:relateduserid'] = 'ID của người dùng liên quan đến sự kiện này';
$string['privacy:metadata:log:timecreated'] = 'Thời điểm sự kiện xảy ra';
$string['privacy:metadata:log:userid'] = 'ID của người dùng đã kích hoạt sự kiện này';
$string['read'] = 'Đọc';
$string['tablenotfound'] = 'Bảng đã chỉ định không tìm thấy';
$string['teaching'] = 'Giảng bài';
$string['testingsettings'] = 'Đang kiểm tra cài đặt cơ sở dữ liệu ...';
$string['testsettings'] = 'Kiểm tra kết nối';
$string['update'] = 'Cập nhật';
