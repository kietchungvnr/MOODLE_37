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
 * @subpackage legacy
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['eventlegacylogged'] = 'Sự kiện kế thừa được ghi nhật ký';
$string['loglegacy'] = 'Ghi dữ liệu kế thừa';
$string['loglegacy_help'] = 'Plugin này ghi lại dữ liệu nhật ký vào bảng nhật ký kế thừa (mdl_log). Chức năng này đã được thay thế bằng các plugin ghi nhật ký mới hơn, phong phú hơn và hiệu quả hơn, vì vậy bạn chỉ nên chạy plugin này nếu bạn có các báo cáo tùy chỉnh cũ truy vấn trực tiếp bảng nhật ký cũ. Việc ghi vào nhật ký kế thừa sẽ làm tăng tải, vì vậy bạn nên tắt plugin này vì lý do hiệu suất khi không cần thiết.';
$string['pluginname'] = 'Nhật ký kế thừa';
$string['pluginname_desc'] = 'Một plugin nhật ký lưu trữ các mục nhật ký trong bảng nhật ký kế thừa.';
$string['privacy:metadata:log'] = 'Tập hợp các sự kiện trong quá khứ';
$string['privacy:metadata:log:action'] = 'Mô tả hành động';
$string['privacy:metadata:log:info'] = 'Thông tin thêm';
$string['privacy:metadata:log:ip'] = 'Địa chỉ IP được sử dụng tại thời điểm diễn ra sự kiện';
$string['privacy:metadata:log:time'] = 'Thời điểm hành động diễn ra';
$string['privacy:metadata:log:url'] = 'URL liên quan đến sự kiện';
$string['privacy:metadata:log:userid'] = 'ID của người dùng đã thực hiện hành động';
$string['taskcleanup'] = 'Dọn dẹp bảng nhật ký kế thừa';
