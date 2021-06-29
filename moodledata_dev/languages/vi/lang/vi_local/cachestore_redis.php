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
 * @package    cachestore
 * @subpackage redis
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['password'] = 'Mật khẩu';
$string['password_help'] = 'Điều này đặt mật khẩu của máy chủ Redis.';
$string['pluginname'] = 'Redis';
$string['prefix'] = 'Tiền tố chính';
$string['prefix_help'] = 'Tiền tố này được sử dụng cho tất cả các tên khóa trên máy chủ Redis. * Nếu bạn chỉ có một phiên bản Moodle sử dụng máy chủ này, bạn có thể để giá trị này mặc định. * Do các hạn chế về độ dài khóa, chỉ cho phép tối đa 5 ký tự.';
$string['prefixinvalid'] = 'Tiền tố không hợp lệ. Bạn chỉ có thể sử dụng az AZ 0-9-_.';
$string['privacy:metadata:redis'] = 'Plugin Redis cachestore lưu trữ dữ liệu ngắn gọn như một phần của chức năng lưu vào bộ nhớ đệm của nó. Dữ liệu này được lưu trữ trên 
máy chủ Redis nơi dữ liệu thường xuyên bị xóa.';
$string['privacy:metadata:redis:data'] = 'Các dữ liệu khác nhau được lưu trữ trong bộ nhớ cache';
$string['serializer_igbinary'] = 'Bộ nối tiếp igbinary.';
$string['serializer_php'] = 'Bộ tuần tự PHP mặc định.';
$string['server'] = 'Máy chủ';
$string['server_help'] = 'Điều này đặt tên máy chủ hoặc địa chỉ IP của máy chủ Redis để sử dụng.';
$string['test_password'] = 'Kiểm tra mật khẩu máy chủ';
$string['test_password_desc'] = 'Redis mật khẩu máy chủ thử nghiệm.';
$string['test_serializer'] = 'Bộ nối tiếp';
$string['test_serializer_desc'] = 'Bộ nối tiếp để sử dụng để thử nghiệm.';
$string['test_server'] = 'Máy chủ thử nghiệm';
$string['test_server_desc'] = 'Máy chủ Redis để sử dụng để thử nghiệm.';
$string['useserializer'] = 'Sử dụng bộ nối tiếp';
$string['useserializer_help'] = 'Chỉ định bộ tuần tự hóa sẽ sử dụng để tuần tự hóa. Bộ tuần tự hợp lệ là Redis :: SERIALIZER_PHP hoặc Redis :: SERIALIZER_IGBINARY. Phần sau chỉ được hỗ trợ khi phpredis được định cấu hình với tùy chọn --enable-redis-igbinary và phần mở rộng igbinary được tải.';
