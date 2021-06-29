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
 * @package    enrol
 * @subpackage database
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['database:config'] = 'Cấu hình các phiên bản đăng ký cơ sở dữ liệu';
$string['database:unenrol'] = 'Hủy kiểm soát người dùng bị tạm ngưng';
$string['dbencoding'] = 'Mã hóa cơ sở dữ liệu';
$string['dbhost'] = 'Máy chủ cơ sở dữ liệu';
$string['dbhost_desc'] = 'Nhập địa chỉ IP máy chủ cơ sở dữ liệu hoặc tên máy chủ. Sử dụng tên DSN hệ thống nếu sử dụng ODBC. Sử dụng PDO DSN nếu sử dụng PDO.';
$string['dbname_desc'] = 'Để trống nếu sử dụng tên DSN trong máy chủ cơ sở dữ liệu.';
$string['dbsetupsql'] = 'Lệnh thiết lập cơ sở dữ liệu';
$string['dbsetupsql_desc'] = 'Lệnh SQL để thiết lập cơ sở dữ liệu đặc biệt, thường được sử dụng để thiết lập mã hóa giao tiếp - ví dụ cho MySQL và PostgreSQL: <em> SET NAMES \'utf8\' </em>';
$string['dbsybasequoting'] = 'Sử dụng báo giá sybase';
$string['dbsybasequoting_desc'] = 'Thoát trích dẫn đơn kiểu Sybase - cần thiết cho Oracle, MS SQL và một số cơ sở dữ liệu khác. Không sử dụng cho MySQL!';
$string['dbtype'] = 'Trình điều khiển cơ sở dữ liệu';
$string['dbtype_desc'] = 'ADOdb tên trình điều khiển cơ sở dữ liệu, loại công cụ cơ sở dữ liệu bên ngoài.';
$string['dbuser'] = 'Người dùng cơ sở dữ liệu';
$string['debugdb'] = 'Gỡ lỗi ADOdb';
$string['debugdb_desc'] = 'Gỡ lỗi kết nối ADOdb với cơ sở dữ liệu bên ngoài - sử dụng khi nhận được trang trống trong khi đăng nhập. Không thích hợp cho các trang web sản xuất!';
$string['defaultcategory'] = 'Loại khóa học mới mặc định';
$string['defaultcategory_desc'] = 'Danh mục mặc định cho các khóa học được tạo tự động. Được sử dụng khi không có id danh mục mới được chỉ định hoặc không tìm thấy.';
$string['defaultrole'] = 'Vai trò mặc định';
$string['defaultrole_desc'] = 'Vai trò sẽ được chỉ định theo mặc định nếu không có vai trò nào khác được chỉ định trong bảng bên ngoài.';
$string['ignorehiddencourses'] = 'Bỏ qua các khóa học ẩn';
$string['ignorehiddencourses_desc'] = 'Nếu được kích hoạt, người dùng sẽ không được đăng ký vào các khóa học được thiết lập là không có sẵn cho sinh viên.';
$string['localcategoryfield'] = 'Trường danh mục địa phương';
$string['localcoursefield'] = 'Trường khóa học địa phương';
$string['localrolefield'] = 'Trường vai trò địa phương';
$string['localuserfield'] = 'Trường người dùng cục bộ';
$string['newcoursecategory'] = 'Trường danh mục khóa học mới';
$string['newcoursefullname'] = 'Trường tên đầy đủ của khóa học mới';
$string['newcourseidnumber'] = 'Trường số ID khóa học mới';
$string['newcourseshortname'] = 'Trường tên ngắn của khóa học mới';
$string['newcoursetable'] = 'Bảng các khóa học mới từ xa';
$string['newcoursetable_desc'] = 'Chỉ định tên của bảng chứa danh sách các khóa học sẽ được tạo tự động. Rỗng có nghĩa là không có khóa học nào được tạo.';
$string['pluginname_desc'] = 'Bạn có thể sử dụng cơ sở dữ liệu bên ngoài (gần như bất kỳ loại nào) để kiểm soát việc đăng ký của mình. Giả sử cơ sở dữ liệu bên ngoài của bạn chứa ít nhất một trường chứa ID khóa học và một trường chứa ID người dùng. Chúng được so sánh với các trường bạn chọn trong khóa học cục bộ và bảng người dùng.';
$string['privacy:metadata'] = 'Plugin đăng ký cơ sở dữ liệu bên ngoài không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['remotecoursefield'] = 'Trường khóa học từ xa';
$string['remotecoursefield_desc'] = 'Tên của trường trong bảng từ xa mà chúng tôi đang sử dụng để khớp với các mục nhập trong bảng khóa học.';
$string['remoteenroltable'] = 'Bảng đăng ký người dùng từ xa';
$string['remoteenroltable_desc'] = 'Chỉ định tên của bảng chứa danh sách đăng ký người dùng. Trống có nghĩa là không có đồng bộ hóa đăng ký người dùng.';
$string['remoteotheruserfield'] = 'Trường Người dùng Khác từ xa';
$string['remoteotheruserfield_desc'] = 'Tên của trường trong bảng từ xa mà chúng tôi đang sử dụng để gắn cờ gán vai trò "Người dùng khác".';
$string['remoterolefield'] = 'Trường vai trò từ xa';
$string['remoterolefield_desc'] = 'Tên của trường trong bảng từ xa mà chúng tôi đang sử dụng để khớp với các mục nhập trong bảng vai trò.';
$string['remoteuserfield'] = 'Trường người dùng từ xa';
$string['remoteuserfield_desc'] = 'Tên của trường trong bảng từ xa mà chúng tôi đang sử dụng để khớp với các mục nhập trong bảng người dùng.';
$string['settingsheaderdb'] = 'Kết nối cơ sở dữ liệu bên ngoài';
$string['settingsheaderlocal'] = 'Lập bản đồ thực địa địa phương';
$string['settingsheadernewcourses'] = 'Tạo các khóa học mới';
$string['settingsheaderremote'] = 'Đồng bộ hóa đăng ký từ xa';
$string['syncenrolmentstask'] = 'Đồng bộ hóa tác vụ đăng ký cơ sở dữ liệu bên ngoài';
$string['templatecourse'] = 'Mẫu khóa học mới';
$string['templatecourse_desc'] = 'Tùy chọn: các khóa học được tạo tự động có thể sao chép cài đặt của chúng từ khóa học mẫu. Nhập vào đây tên viết tắt của khóa học mẫu.';
