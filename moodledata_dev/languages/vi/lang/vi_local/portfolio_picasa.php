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
 * @subpackage picasa
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['clientid'] = 'ID khách hàng';
$string['noauthtoken'] = 'Mã thông báo xác thực chưa được nhận từ Google. Hãy đảm bảo rằng bạn đang cho phép Moodle truy cập vào tài khoản Google của mình.';
$string['nooauthcredentials'] = 'Cần có thông tin xác thực OAuth.';
$string['nooauthcredentials_help'] = 'Để sử dụng plugin danh mục đầu tư Picasa, bạn phải định cấu hình thông tin xác thực OAuth trong cài đặt danh mục đầu tư.';
$string['oauthinfo'] = '<p> Để sử dụng plugin này, bạn phải đăng ký trang web của mình với Google, như được mô tả trong tài liệu <a href="{$a->docsurl} "> thiết lập 
Google OAuth 2.0 </a>. </p> <p > Là một phần của quy trình đăng ký, bạn cần nhập URL sau làm \'URI chuyển hướng được ủy quyền\': </p> <p> {$a->callbackurl} </p> <p> Sau khi đăng ký, bạn sẽ được cung cấp ID khách hàng và bí mật có thể được sử dụng để định cấu hình tất cả các plugin Google Drive và Picasa. </p>';
$string['pluginname'] = 'Picasa';
$string['privacy:metadata'] = 'Plugin này gửi dữ liệu ra bên ngoài đến tài khoản Picasa được liên kết. Nó không lưu trữ dữ liệu cục bộ.';
$string['privacy:metadata:data'] = 'Dữ liệu cá nhân được chuyển qua hệ thống con của danh mục đầu tư.';
$string['secret'] = 'Bí mật';
$string['sendfailed'] = 'Tệp {$a} không chuyển được sang Picasa';
