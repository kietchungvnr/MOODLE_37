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
 * Khối block Báo cáo học tập hiện thị dữ liệu tình trạng của 1 kỳ thi/lớp học dựa theo tiêu chí: Đạt, Không đạt, Khác. 
 * Mặc định sẽ hiện thị kỳ thi/lớp học truy cập gần đây nhất. Muốn hiện thị chi tiết danh sách học viên vui lòng nhấn vào Đạt, Không đạt, Khác trên biểu đồ
 *
 * @package    block_user(admin)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Competency matrix';
$string['competencyframework'] = 'Competency framework';
$string['competency'] = 'Competency';
$string['noenroll'] = 'No enroll';
$string['vnr_db_matrix_competency:addinstance'] = 'Add a new matrix_competency block';
$string['vnr_db_matrix_competency:myaddinstance'] = 'Add a new matrix_competency block to Dashboard';
$string['vnr_db_matrix_competency:editblocks'] = 'Edit a new matrix_competency block to Dashboard';
$string['privacy:metadata'] = 'The matrix_competency block only shows data stored in other locations.';