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
 * @package    workshopallocation
 * @subpackage random
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addselfassessment'] = 'Thêm tự đánh giá';
$string['allocationaddeddetail'] = 'Bài đánh giá mới sẽ được thực hiện: <strong>{$a->reviewername}</strong> là người đánh giá của <strong>{$a->authorname}</strong>';
$string['allocationdeallocategraded'] = 'Không thể phân bổ bài đánh giá đã được xếp loại: người đánh giá <strong>{$a->reviewername}</strong>, tác giả bài nộp <strong>{$a->authorname}</strong>';
$string['allocationreuseddetail'] = 'Bài đánh giá được sử dụng lại: <strong>{$a->reviewername}</strong> được giữ làm người đánh giá của <strong>{$a->authorname}</strong>';
$string['allocationsettings'] = 'Cài đặt phân bổ';
$string['assessmentdeleteddetail'] = 'Bài đánh giá đã được phân bổ: <strong>{$a->eviewername}</strong> không còn là người đánh giá của <strong>{$a->authorname}</strong>';
$string['assesswosubmission'] = 'Người tham gia có thể đánh giá mà không cần nộp bất cứ thứ gì';
$string['confignumofreviews'] = 'Số lần gửi mặc định được phân bổ ngẫu nhiên';
$string['excludesamegroup'] = 'Ngăn chặn đánh giá của các đồng nghiệp trong cùng một nhóm';
$string['noallocationtoadd'] = 'Không có phân bổ để thêm';
$string['nogroupusers'] = '<p>Cảnh báo: Nếu hội thảo ở chế độ "nhóm hiển thị" hoặc chế độ "nhóm riêng biệt", thì người dùng PHẢI là thành viên của ít nhất một nhóm để được công cụ này phân bổ các đánh giá ngang hàng cho họ. Những người dùng không được nhóm vẫn có thể được đưa ra các bài tự đánh giá mới hoặc bị xóa các bài đánh giá hiện có. </p> <p> Những người dùng này hiện không thuộc nhóm: {$a}</p>';
$string['numofdeallocatedassessment'] = 'Phân bổ {$a} đánh giá';
$string['numofrandomlyallocatedsubmissions'] = 'Chỉ định ngẫu nhiên phân bổ {$a}';
$string['numofreviews'] = 'Số lượt đánh giá';
$string['numofselfallocatedsubmissions'] = 'Tự phân bổ {$a} bài nộp';
$string['numperauthor'] = 'mỗi lần nộp';
$string['numperreviewer'] = 'mỗi người đánh giá';
$string['pluginname'] = 'Phân bổ ngẫu nhiên';
$string['privacy:metadata'] = 'Plugin phân bổ ngẫu nhiên không lưu trữ bất kỳ dữ liệu cá nhân nào. Dữ liệu cá nhân thực tế về người sẽ đánh giá ai được chính mô-đun Hội thảo lưu trữ và chúng là cơ sở để xuất các chi tiết đánh giá.';
$string['randomallocationdone'] = 'Phân bổ ngẫu nhiên được thực hiện';
$string['removecurrentallocations'] = 'Xóa phân bổ hiện tại';
$string['resultnomorepeers'] = 'Không còn đồng nghiệp nào nữa';
$string['resultnomorepeersingroup'] = 'Không có thêm đồng nghiệp nào trong nhóm riêng biệt này';
$string['resultnotenoughpeers'] = 'Không có đủ đồng nghiệp';
$string['resultnumperauthor'] = 'Đang cố gắng phân bổ {$a} bài đánh giá cho mỗi tác giả';
$string['resultnumperreviewer'] = 'Đang cố gắng phân bổ {$a} bài đánh giá cho mỗi người đánh giá';
$string['stats'] = 'Thống kê phân bổ hiện tại';
