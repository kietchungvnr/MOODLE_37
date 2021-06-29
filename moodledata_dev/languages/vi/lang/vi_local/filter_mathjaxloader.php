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
 * @package    filter
 * @subpackage mathjaxloader
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['additionaldelimiters_help'] = 'Bộ lọc MathJax phân tích cú pháp văn bản cho các phương trình chứa trong các ký tự dấu phân cách. Danh sách các ký tự dấu phân cách được công nhận có thể được thêm vào đây (ví dụ: AsciiMath sử dụng `). Dấu phân cách có thể chứa nhiều ký tự và nhiều dấu phân cách có thể được phân tách bằng dấu phẩy.';
$string['filtername'] = 'MathJax';
$string['httpsurl'] = 'URL MathJax';
$string['localinstall_help'] = 'Cấu hình MathJax mặc định sử dụng phiên bản CDN của MathJax, nhưng MathJax có thể được cài đặt cục bộ nếu được yêu cầu. Điều này có thể hữu ích để tiết kiệm băng 
thông hoặc do các hạn chế về proxy cục bộ. Để sử dụng cài đặt cục bộ của MathJax, trước tiên hãy tải xuống thư viện MathJax đầy đủ từ https://www.mathjax.org/. Sau đó, cài đặt nó trên một máy chủ web. Cuối cùng cập nhật cài đặt bộ lọc MathJax httpurl và / hoặc httpsurl để trỏ đến URL MathJax.js cục bộ.';
$string['mathjaxsettings_desc'] = 'Cấu hình MathJax mặc định phải phù hợp với hầu hết người dùng, nhưng MathJax có khả năng cấu hình cao và bất kỳ tùy chọn cấu hình MathJax tiêu chuẩn nào đều có thể 
được thêm vào đây.';
$string['privacy:metadata'] = 'Plugin MathJax không lưu trữ bất kỳ dữ liệu cá nhân nào.';
