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
 * @package    auth
 * @subpackage db
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_dbcannotconnect'] = 'Không thể kết nối với cơ sở dữ liệu bên ngoài.';
$string['auth_dbcannotreadtable'] = 'Không thể đọc bảng bên ngoài.';
$string['auth_dbcantconnect'] = 'Không thể kết nối với cơ sở dữ liệu xác thực được chỉ định ...';
$string['auth_dbchangepasswordurl_key'] = 'URL thay đổi mật khẩu';
$string['auth_dbcolumnlist'] = 'Bảng bên ngoài chứa các cột sau: <br /> {$a}';
$string['auth_dbdebugauthdb'] = 'Gỡ lỗi ADOdb';
$string['auth_dbdebugauthdbhelp'] = 'Gỡ lỗi kết nối ADOdb với cơ sở dữ liệu bên ngoài - sử dụng khi nhận được trang trống trong khi đăng nhập. Không phù hợp với địa điểm sản xuất.';
$string['auth_dbdeleteuser'] = 'Người dùng đã xóa {$a->name} id {$a->id}';
$string['auth_dbdeleteusererror'] = 'Lỗi khi xóa người dùng {$a}';
$string['auth_dbextencoding'] = 'Mã hóa db bên ngoài';
$string['auth_dbextencodinghelp'] = 'Mã hóa được sử dụng trong cơ sở dữ liệu bên ngoài';
$string['auth_dbfieldpass_key'] = 'Trường mật khẩu';
$string['auth_dbfielduser_key'] = 'Trường tên người dùng';
$string['auth_dbhost_key'] = 'Host';
$string['auth_dbinsertuser'] = 'Đã chèn người dùng {$a->name} id {$a->id}';
$string['auth_dbinsertuserduplicate'] = 'Lỗi khi chèn người dùng {$a->username} - người dùng có tên người dùng này đã được tạo thông qua plugin \'{$a->auth}\'.';
$string['auth_dbinsertusererror'] = 'Lỗi khi chèn người dùng {$a}';
$string['auth_dbname_key'] = 'Tên DB';
$string['auth_dbnoexttable'] = 'Bảng bên ngoài không được chỉ định.';
$string['auth_dbnouserfield'] = 'Trường người dùng bên ngoài không được chỉ định.';
$string['auth_dbpass_key'] = 'Mật khẩu';
$string['auth_dbpasstype_key'] = 'Định dạng mật khẩu';
$string['auth_dbreviveduser'] = 'Người dùng được hồi sinh {$a->name} id {$a->id}';
$string['auth_dbrevivedusererror'] = 'Lỗi khi phục hồi người dùng {$a}';
$string['auth_dbsaltedcrypt'] = 'Mã hóa băm chuỗi một chiều';
$string['auth_dbsetupsql'] = 'Lệnh thiết lập SQL';
$string['auth_dbsetupsqlhelp'] = 'Lệnh SQL để thiết lập cơ sở dữ liệu đặc biệt, thường được sử dụng để thiết lập mã hóa giao tiếp - ví dụ cho MySQL và PostgreSQL: <em> SET NAMES \'utf8\' </em>';
$string['auth_dbsuspenduser'] = 'Người dùng bị tạm ngưng {$a->name} id {$a->id}';
$string['auth_dbsuspendusererror'] = 'Lỗi khi tạm ngưng người dùng {$a}';
$string['auth_dbsybasequoting'] = 'Sử dụng báo giá sybase';
$string['auth_dbsybasequotinghelp'] = 'Thoát trích dẫn đơn kiểu Sybase - cần thiết cho Oracle, MS SQL và một số cơ sở dữ liệu khác. Không sử dụng cho MySQL!';
$string['auth_dbsyncuserstask'] = 'Đồng bộ hóa tác vụ của người dùng';
$string['auth_dbtable_key'] = 'Bàn';
$string['auth_dbtableempty'] = 'Bảng bên ngoài trống.';
$string['auth_dbupdateusers'] = 'Cập nhật người dùng';
$string['auth_dbupdateusers_description'] = 'Cũng như chèn người dùng mới, cập nhật người dùng hiện có.';
$string['auth_dbupdatinguser'] = 'Đang cập nhật người dùng {$a->name} id {$a->id}';
$string['auth_dbuser_key'] = 'Người dùng DB';
$string['auth_dbuserstoadd'] = 'Các mục nhập của người dùng để thêm: {$a}';
$string['auth_dbuserstoremove'] = 'Các mục người dùng cần xóa: {$a}';
$string['privacy:metadata'] = 'Plugin xác thực cơ sở dữ liệu bên ngoài không lưu trữ bất kỳ dữ liệu cá nhân nào.';
