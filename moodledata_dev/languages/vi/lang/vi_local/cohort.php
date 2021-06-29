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
 * @package    core
 * @subpackage cohort
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcohort'] = 'Thêm nhóm mới';
$string['allcohorts'] = 'Tất cả nhóm';
$string['assigncohorts'] = 'Chỉ định thành viên nhóm thuần tập';
$string['categorynotfound'] = 'Không tìm thấy danh mục <b> {$a} </b> hoặc bạn không có quyền tạo nhóm thuần tập ở đó. Ngữ cảnh mặc định sẽ được sử dụng.';
$string['cohorts'] = 'Các nhóm';
$string['contextnotfound'] = 'Không tìm thấy ngữ cảnh <b> {$a} </b> hoặc bạn không có quyền tạo nhóm thuần tập ở đó. Ngữ cảnh mặc định sẽ được sử dụng.';
$string['csvcontainserrors'] = 'Đã tìm thấy lỗi trong dữ liệu CSV. Xem chi tiết bên dưới.';
$string['csvcontainswarnings'] = 'Đã tìm thấy cảnh báo trong dữ liệu CSV. Xem chi tiết bên dưới.';
$string['csvextracolumns'] = '(Các) cột <b> {$a} </b> sẽ bị bỏ qua.';
$string['defaultcontext'] = 'Ngữ cảnh mặc định';
$string['displayedrows'] = '{$a->display} hàng được hiển thị trong tổng số {$a->total}.';
$string['editcohortidnumber'] = 'Chỉnh sửa ID nhóm';
$string['editcohortname'] = 'Chỉnh sửa tên nhóm';
$string['invalidtheme'] = 'Chủ đề nhóm thuần tập không tồn tại';
$string['namecolumnmissing'] = 'Đã xảy ra lỗi với định dạng của tệp CSV. Vui lòng kiểm tra xem nó có bao gồm tên cột chính xác không. Để thêm người dùng vào nhóm thuần tập, hãy chuyển đến \'Tải lên người dùng\' trong quản trị Trang web.';
$string['namefieldempty'] = 'Tên trường không được để trống';
$string['newidnumberfor'] = 'Số ID mới cho nhóm thuần tập {$a}';
$string['newnamefor'] = 'Tên mới cho nhóm thuần tập {$a}';
$string['preview'] = 'Xem trước';
$string['privacy:metadata:cohort_members'] = 'Thông tin về nhóm thuần tập của người dùng.';
$string['privacy:metadata:cohort_members:cohortid'] = 'ID của nhóm';
$string['privacy:metadata:cohort_members:timeadded'] = 'Dấu thời gian cho biết thời điểm người dùng được thêm vào nhóm thuần tập';
$string['privacy:metadata:cohort_members:userid'] = 'ID của người dùng được liên kết với nhóm';
$string['systemcohorts'] = 'Cài đặt nhóm';
$string['uploadcohorts'] = 'Tải lên các nhóm';
$string['uploadcohorts_help'] = 'Các nhóm có thể được tải lên qua tệp văn bản. Định dạng của tệp phải như sau: * Mỗi dòng của tệp chứa một bản ghi * Mỗi bản ghi là một chuỗi dữ liệu được phân tách bằng dấu phẩy (hoặc các dấu phân cách khác) * Bản ghi đầu tiên chứa danh sách các tên trường xác định định dạng của phần còn lại của tệp * Tên trường bắt buộc là tên * Các tên trường tùy chọn là idnumber, mô tả, định dạng mô tả, hiển thị, ngữ cảnh, danh mục, category_id, category_idnumber, category_path';
$string['uploadedcohorts'] = 'Đã tải lên nhóm thuần tập {$a}';
$string['visible_help'] = 'Người dùng có khả năng \'moodle/cohort: view\' có thể xem bất kỳ nhóm nào trong ngữ cảnh nhóm. <br/> Người dùng trong các khóa học cơ bản cũng có thể xem các nhóm hiển thị.';
