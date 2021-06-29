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
 * @package    mlbackend
 * @subpackage php
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['datasetsizelimited'] = 'Chỉ một phần của tập dữ liệu đã được đánh giá do kích thước của nó. Đặt $CFG->mlbackend_php_no_memory_limit nếu bạn tin tưởng rằng hệ thống của mình có thể xử lý tập dữ liệu {$a}.';
$string['errorcantloadmodel'] = 'Tệp mô hình {$a} không tồn tại. Mô hình nên được đào tạo trước khi sử dụng nó để dự đoán.';
$string['errorlowscore'] = 'Độ chính xác dự đoán của mô hình được đánh giá không cao nên một số dự đoán có thể không chính xác. Điểm mô hình = {$a->score}, điểm tối thiểu = {$a->minscore}';
$string['errornotenoughdata'] = 'Không có đủ dữ liệu để đánh giá mô hình này bằng phương pháp chia tách thời gian.';
$string['errornotenoughdatadev'] = 'Các kết quả đánh giá khác nhau quá nhiều. Bạn nên thu thập thêm dữ liệu để đảm bảo mô hình hợp lệ. Độ lệch chuẩn của kết quả đánh giá = {$a->deviation}, độ lệch chuẩn được đề xuất tối đa = {$a->accepteddeviation}';
$string['errorphp7required'] = 'Máy học sử dụng  PHP yêu cầu PHP 7';
$string['pluginname'] = 'Máy học PHP';
$string['privacy:metadata'] = 'Plugin máy học php không lưu trữ bất kỳ dữ liệu cá nhân nào.';
