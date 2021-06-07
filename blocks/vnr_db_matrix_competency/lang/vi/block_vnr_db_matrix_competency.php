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
 * Khối cho quản trị viên
 * Khối block Báo cáo học tập hiện thị dữ liệu tình trạng của 1 kỳ thi/lớp học dựa theo tiêu chí: Đạt, Không đạt, Khác. 
 * Mặc định sẽ hiện thị kỳ thi/lớp học truy cập gần đây nhất. Muốn hiện thị chi tiết danh sách học viên vui lòng nhấn vào Đạt, Không đạt, Khác trên biểu đồ
 *
 * @package    block_user(admin)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Ma trận năng lực';
$string['competencyframework'] = 'Khung năng lực';
$string['competency'] = 'Năng lực';
$string['noenroll'] = 'Chưa ghi danh';
$string['vnr_db_matrix_competency:addinstance'] = 'Thêm mới khối ma trận năng lực';
$string['vnr_db_matrix_competency:myaddinstance'] = 'Thêm mới khối ma trận năng lực đến trang cá nhân';
$string['vnr_db_matrix_competency:editblocks'] = 'Chỉnh sửa khối ma trận năng lực đến trang cá nhân';
$string['privacy:metadata'] = 'Khối ma trận năng lực chỉ hiển thị dữ liệu được lưu trữ ở các vị trí khác';