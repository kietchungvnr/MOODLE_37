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
 * Block hiện thị tiến độ học tập của học viên như:
 * Khóa học hoàn thành, chưa hoàn thành, bắt buộc, không bắt buộc...
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Thống kê học tập';
$string['coursecompleted'] = 'Khóa học đã tham gia';
$string['coursenotcompleted'] = 'Khóa học đã hoàn thành';
$string['requiredcoursecompletedrate'] = 'Tỉ lệ hoàn thành khoá học đào tạo bắt buộc';
$string['coursecompletedbyuserplanrate'] = 'Tỉ lệ hoàn thành khoá học đào tạo theo vị trí';
$string['userplancompletedrate'] = 'Tỉ lệ hoàn thành lộ trình cá nhân';
$string['competencyachieved'] = 'Năng lực đạt được';
$string['badgeachieved'] = 'Huy hiệu đạt được';
$string['totalcompetencycompleted'] = 'Tổng số năng lực(chứng chỉ) học viên đã đạt được';
$string['totalbadgecompleted'] = 'Tổng số huy hiệu học viên đã đạt được';
$string['course'] = 'khóa học';
$string['vnr_db_studentuser_learning_rp:addinstance'] = 'Thêm mới block tống kê học tập';
$string['vnr_db_studentuser_learning_rp:myaddinstance'] = 'Thêm mới block thống kê học tập ở nhà của tôi';
$string['privacy:metadata'] = 'Block thống kê học tập chỉ hiển thị dữ liệu được lưu trữ ở các vị trí khác';