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
 * @package    enrol
 * @subpackage meta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addgroup'] = 'Thêm vào nhóm';
$string['coursesort'] = 'Sắp xếp danh sách khóa học';
$string['coursesort_help'] = 'Điều này xác định xem danh sách các khóa học có thể được liên kết được sắp xếp theo thứ tự sắp xếp (tức là thứ tự được đặt trong Quản trị trang> Khóa học> Quản lý khóa học và danh mục) hay theo thứ tự bảng chữ cái theo cài đặt khóa học.';
$string['creategroup'] = 'Tạo nhóm mới';
$string['defaultgroupnametext'] = 'khóa học {$a->name} {$a->increment}';
$string['enrolmetasynctask'] = 'Tác vụ đồng bộ hóa đăng ký meta';
$string['linkedcourse'] = 'Liên kết khóa học';
$string['meta:config'] = 'Định cấu hình các phiên bản đăng ký meta';
$string['meta:selectaslinked'] = 'Chọn khóa học dưới dạng liên kết meta';
$string['meta:unenrol'] = 'Hủy kiểm soát người dùng bị tạm ngưng';
$string['nosyncroleids'] = 'Các vai trò không được đồng bộ hóa';
$string['nosyncroleids_desc'] = 'Theo mặc định, tất cả các nhiệm vụ cấp độ khóa học được đồng bộ hóa từ khóa học cha mẹ đến khóa học con. Các vai trò được chọn ở đây sẽ không được đưa vào quá 
trình đồng bộ hóa. Các vai trò có sẵn để đồng bộ hóa sẽ được cập nhật trong lần thực thi cron tiếp theo.';
$string['pluginname'] = 'Liên kết meta khóa học';
$string['pluginname_desc'] = 'Plugin đăng ký liên kết meta khóa học đồng bộ hóa các đăng ký và vai trò trong hai khóa học khác nhau.';
$string['privacy:metadata:core_group'] = 'Enroll meta plugin có thể tạo một nhóm mới hoặc sử dụng một nhóm hiện có để thêm tất cả những người tham gia khóa học được liên kết.';
$string['syncall'] = 'Đồng bộ hóa tất cả người dùng đã đăng ký';
$string['syncall_desc'] = 'Nếu được bật, tất cả người dùng đã đăng ký sẽ được đồng bộ hóa ngay cả khi họ không có vai trò nào trong khóa học chính, nếu bị vô hiệu hóa, chỉ những người dùng 
có ít nhất một vai trò được đồng bộ hóa mới được đăng ký trong khóa học con.';
