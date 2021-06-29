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
 * @subpackage memcached
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['hash_crc'] = 'CRC';
$string['hash_fnv1_32'] = 'FNV1_32';
$string['hash_fnv1_64'] = 'FNV1_64';
$string['hash_fnv1a_32'] = 'FNV1A_32';
$string['hash_fnv1a_64'] = 'FNV1A_64';
$string['hash_hsieh'] = 'Hsieh';
$string['hash_md5'] = 'MD5';
$string['hash_murmur'] = 'Thì thầm';
$string['isshared'] = 'Bộ nhớ đệm đã chia sẻ';
$string['isshared_help'] = 'Máy chủ memcached của bạn cũng đang được sử dụng bởi các ứng dụng khác? Nếu bộ nhớ đệm được chia sẻ bởi các ứng dụng khác thì
 mỗi khóa sẽ bị xóa riêng lẻ để đảm bảo rằng chỉ dữ liệu do ứng dụng này sở hữu mới bị xóa (giữ nguyên dữ liệu bộ đệm ứng dụng bên ngoài). Điều này có thể làm giảm hiệu suất khi xóa bộ nhớ cache, tùy thuộc vào cấu hình máy chủ của bạn. Nếu bạn đang chạy bộ đệm chuyên dụng cho ứng dụng này thì toàn bộ bộ đệm có thể được xóa một cách an toàn mà không có bất kỳ nguy cơ phá hủy dữ liệu bộ đệm của ứng dụng khác. Điều này sẽ làm tăng hiệu suất khi xóa bộ nhớ cache.';
$string['pluginname'] = 'Đã ghi nhớ';
$string['privacy:metadata:memcached'] = 'Plugin Memcached cachestore lưu trữ dữ liệu ngắn gọn như một phần của chức năng lưu vào bộ nhớ đệm của nó. Dữ liệu này được lưu trữ 
trên máy chủ Memcache nơi dữ liệu thường xuyên bị xóa.';
$string['privacy:metadata:memcached:data'] = 'Các dữ liệu khác nhau được lưu trữ trong bộ nhớ cache';
$string['upgrade200recommended'] = 'Chúng tôi khuyên bạn nên nâng cấp tiện ích mở rộng Memcached PHP của mình lên phiên bản 2.0.0 trở lên. Phiên bản của phần mở rộng 
Memcached PHP mà bạn hiện đang sử dụng không cung cấp chức năng mà Moodle sử dụng để đảm bảo bộ nhớ đệm hộp cát. Cho đến khi bạn nâng cấp, chúng tôi khuyên bạn không nên cấu hình bất kỳ ứng dụng nào khác để sử dụng các máy chủ Memcached giống như Moodle được cấu hình để sử dụng.';
