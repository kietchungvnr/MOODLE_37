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
 * @package    portfolio
 * @subpackage flickr
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apikey'] = 'Mã API';
$string['contenttype'] = 'Loại nội dung';
$string['err_noapikey'] = 'Không có khóa API';
$string['err_noapikey_help'] = 'Không có khóa API nào được định cấu hình cho plugin này. Bạn có thể lấy một trong những thứ này từ trang dịch vụ Flickr.';
$string['hidefrompublicsearches'] = 'Ẩn những hình ảnh này khỏi các tìm kiếm công khai?';
$string['isfamily'] = 'Hiển thị với gia đình';
$string['isfriend'] = 'Hiển thị với bạn bè';
$string['ispublic'] = 'Công khai (bất kỳ ai cũng có thể xem chúng)';
$string['moderate'] = 'Vừa phải';
$string['noauthtoken'] = 'Không thể truy xuất mã xác thực để sử dụng trong phiên này';
$string['other'] = 'Hình ảnh nghệ thuật, minh họa, CGI hoặc các hình ảnh không phải nhiếp ảnh khác';
$string['photo'] = 'Ảnh';
$string['pluginname'] = 'Flickr.com';
$string['privacy:metadata'] = 'Plugin này gửi dữ liệu ra bên ngoài đến tài khoản Flickr được liên kết. Nó không lưu trữ dữ liệu cục bộ.';
$string['privacy:metadata:data'] = 'Dữ liệu cá nhân được chuyển qua hệ thống con của danh mục đầu tư.';
$string['restricted'] = 'Bị hạn chế';
$string['safe'] = 'An toàn';
$string['safetylevel'] = 'Mức độ an toàn';
$string['screenshot'] = 'Ảnh chụp màn hình';
$string['set'] = 'Đặt';
$string['setupinfo'] = 'Hướng dẫn thiết lập';
$string['setupinfodetails'] = 'Để nhận khóa API và chuỗi bí mật, hãy đăng nhập vào Flickr và <a href="{$a->applyurl} "> đăng ký khóa mới </a>. Khi khóa và bí mật mới được tạo cho bạn, hãy làm theo liên kết \'Chỉnh sửa quy trình xác thực cho ứng dụng này\' tại trang. Chọn \'Loại ứng dụng\' thành \'Ứng dụng web\'. Vào trường \'URL gọi lại\', đặt giá trị: <br /> <code> {$a->callbackurl} </code> <br /> Theo tùy chọn, bạn cũng có thể cung cấp mô tả và biểu trưng trang web Moodle của mình. Các giá trị này có thể được đặt sau tại <a href="{$a->keyurl} "> trang </a> liệt kê các ứng dụng Flickr của bạn.';
$string['sharedsecret'] = 'Chuỗi bí mật';
$string['title'] = 'Tiêu đề';
$string['uploadfailed'] = 'Không tải được (các) hình ảnh lên flickr.com: {$a}';
