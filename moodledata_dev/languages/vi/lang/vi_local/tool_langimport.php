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
 * @package    tool
 * @subpackage langimport
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['downloadnotavailable'] = 'Không thể kết nối với máy chủ tải xuống. Không thể tự động cài đặt hoặc cập nhật các gói ngôn ngữ. Vui lòng tải xuống (các) tệp ZIP thích hợp từ <a href="{$a->src} "> {$a-
>src} </a> và giải nén chúng theo cách thủ công vào thư mục dữ liệu của bạn <code> {$a->dest} </code>';
$string['langimportdisabled'] = 'Tính năng nhập ngôn ngữ đã bị tắt. Bạn phải cập nhật gói ngôn ngữ của mình theo cách thủ công ở cấp hệ thống tệp. Đừng quên xóa bộ nhớ cache chuỗi sau khi bạn 
làm như vậy.';
$string['langpackinstalledevent'] = 'Gói ngôn ngữ đã được cài đặt';
$string['langpacknotremoved'] = 'Một lỗi đã xảy ra; gói ngôn ngữ \'{$a}\' chưa được gỡ cài đặt hoàn toàn. Vui lòng kiểm tra quyền đối với tệp.';
$string['langpackremovedevent'] = 'Gói ngôn ngữ đã được gỡ cài đặt';
$string['langpackupdated'] = 'Gói ngôn ngữ \'{$a}\' đã được cập nhật thành công';
$string['langpackupdatedevent'] = 'Đã cập nhật gói ngôn ngữ';
$string['langpackuptodate'] = 'Gói ngôn ngữ \'{$a}\' được cập nhật';
$string['langunsupported'] = '<p> Máy chủ của bạn dường như không hỗ trợ đầy đủ các ngôn ngữ sau: </p> <ul> {$a->misslocales} </ul> <p> Thay vào đó, ngôn ngữ chung ({$a->globallocale}) sẽ được sử dụng để định dạng các chuỗi nhất định như ngày tháng hoặc số. </p>';
$string['missingcfglangotherroot'] = 'Thiếu giá trị cấu hình $CFG->langotherroot';
$string['missinglangparent'] = 'Thiếu ngôn ngữ gốc <em> {$a->parent} </em> của <em> {$a->lang} </em>.';
$string['noenglishuninstall'] = 'Không thể gỡ cài đặt gói ngôn ngữ tiếng Anh.';
$string['nolangupdateneeded'] = 'Tất cả các gói ngôn ngữ của bạn đều được cập nhật, không cần cập nhật';
$string['privacy:metadata'] = 'Plugin Gói ngôn ngữ không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['purgestringcaches'] = 'Xóa bộ đệm chuỗi';
$string['selectlangs'] = 'Chọn ngôn ngữ để gỡ cài đặt';
