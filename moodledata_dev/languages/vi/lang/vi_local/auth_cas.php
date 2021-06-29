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
 * @subpackage cas
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesCAS'] = 'Người dùng CAS';
$string['accesNOCAS'] = 'những người dùng khác';
$string['auth_cas_auth_logo'] = 'Biểu trưng của phương pháp xác thực';
$string['auth_cas_auth_logo_description'] = 'Cung cấp biểu trưng cho phương thức xác thực CAS quen thuộc với người dùng của bạn.';
$string['auth_cas_auth_name'] = 'Tên phương thức xác thực';
$string['auth_cas_auth_name_description'] = 'Cung cấp tên cho phương thức xác thực CAS quen thuộc với người dùng của bạn.';
$string['auth_cas_auth_service'] = 'CAS';
$string['auth_cas_auth_user_create'] = 'Tạo người dùng bên ngoài';
$string['auth_cas_baseuri'] = 'URI của máy chủ (không có gì nếu không có baseUri) <br /> Ví dụ: nếu máy chủ CAS trả lời host.domaine.fr/CAS/ thì <br /> cas_baseuri = CAS /';
$string['auth_cas_baseuri_key'] = 'Cơ sở URI';
$string['auth_cas_broken_password'] = 'Bạn không thể tiếp tục mà không thay đổi mật khẩu của mình, tuy nhiên không có trang nào để thay đổi mật khẩu. Vui lòng liên hệ với Quản trị viên Moodle của bạn.';
$string['auth_cas_cantconnect'] = 'Phần LDAP của mô-đun CAS không thể kết nối với máy chủ: {$a}';
$string['auth_cas_casversion'] = 'Phiên bản giao thức CAS';
$string['auth_cas_certificate_check'] = 'Chọn \'có\' nếu bạn muốn xác thực chứng chỉ máy chủ';
$string['auth_cas_certificate_check_key'] = 'Xác thực máy chủ';
$string['auth_cas_certificate_path'] = 'Đường dẫn của tệp chuỗi CA (Định dạng PEM) để xác thực chứng chỉ máy chủ';
$string['auth_cas_certificate_path_empty'] = 'Nếu bạn bật Xác thực máy chủ, bạn cần chỉ định đường dẫn chứng chỉ';
$string['auth_cas_certificate_path_key'] = 'Đường dẫn chứng chỉ';
$string['auth_cas_changepasswordurl'] = 'URL thay đổi mật khẩu';
$string['auth_cas_create_user'] = 'Bật tính năng này nếu bạn muốn chèn người dùng được xác thực CAS vào cơ sở dữ liệu Moodle. Nếu không thì chỉ những người dùng đã tồn tại trong cơ sở dữ liệu Moodle mới có thể đăng nhập.';
$string['auth_cas_create_user_key'] = 'Tạo người dùng';
$string['auth_cas_curl_ssl_version'] = 'Phiên bản SSL (2 hoặc 3) để sử dụng. Theo mặc định, PHP sẽ cố gắng tự xác định điều này, mặc dù trong một số trường hợp, điều này phải được đặt theo cách thủ công.';
$string['auth_cas_curl_ssl_version_default'] = 'Mặc định';
$string['auth_cas_curl_ssl_version_key'] = 'Phiên bản SSL cURL';
$string['auth_cas_curl_ssl_version_SSLv2'] = 'SSLv2';
$string['auth_cas_curl_ssl_version_SSLv3'] = 'SSLv3';
$string['auth_cas_curl_ssl_version_TLSv10'] = 'TLSv1.0';
$string['auth_cas_curl_ssl_version_TLSv11'] = 'TLSv1.1';
$string['auth_cas_curl_ssl_version_TLSv12'] = 'TLSv1.2';
$string['auth_cas_curl_ssl_version_TLSv1x'] = 'TLSv1.x';
$string['auth_cas_enabled'] = 'Bật tính năng này nếu bạn muốn sử dụng xác thực CAS.';
$string['auth_cas_hostname'] = 'Tên máy chủ của máy chủ CAS <br /> ví dụ: host.domain.fr';
$string['auth_cas_hostname_key'] = 'Tên máy chủ';
$string['auth_cas_invalidcaslogin'] = 'Xin lỗi, đăng nhập của bạn không thành công - bạn không thể được ủy quyền';
$string['auth_cas_language'] = 'Chọn ngôn ngữ cho các trang xác thực';
$string['auth_cas_language_key'] = 'Ngôn ngữ';
$string['auth_cas_logincas'] = 'Truy cập kết nối an toàn';
$string['auth_cas_logout_return_url'] = 'Cung cấp URL mà người dùng CAS sẽ được chuyển hướng đến sau khi đăng xuất. <br /> Nếu để trống, người dùng sẽ được chuyển hướng đến vị trí mà moodle sẽ chuyển hướng người dùng đến';
$string['auth_cas_logout_return_url_key'] = 'URL trả lại đăng xuất thay thế';
$string['auth_cas_logoutcas'] = 'Chọn \'có\' nếu bạn muốn đăng xuất khỏi CAS khi ngắt kết nối khỏi Moodle';
$string['auth_cas_logoutcas_key'] = 'Tùy chọn đăng xuất CAS';
$string['auth_cas_multiauth'] = 'Chọn \'có\' nếu bạn muốn có đa xác thực (CAS + xác thực khác)';
$string['auth_cas_multiauth_key'] = 'Đa xác thực';
$string['auth_cas_port'] = 'Cổng của máy chủ CAS';
$string['auth_cas_port_key'] = 'Cổng';
$string['auth_cas_proxycas'] = 'Chọn \'có\' nếu bạn sử dụng CAS ở chế độ proxy';
$string['auth_cas_proxycas_key'] = 'Chế độ proxy';
$string['auth_cas_server_settings'] = 'Cấu hình máy chủ CAS';
$string['auth_cas_text'] = 'Kết nối an toàn';
$string['auth_cas_use_cas'] = 'Sử dụng CAS';
$string['auth_cas_version'] = 'Phiên bản giao thức CAS để sử dụng';
$string['auth_casdescription'] = 'Phương pháp này sử dụng máy chủ CAS (Dịch vụ Xác thực Trung tâm) để xác thực người dùng trong môi trường Đăng nhập Một lần (SSO). Bạn cũng có thể sử dụng xác thực LDAP đơn giản. Nếu tên người dùng và mật khẩu đã cho hợp lệ theo CAS, Moodle sẽ tạo một mục nhập người dùng mới trong cơ sở dữ liệu của nó, lấy thuộc tính người dùng từ LDAP nếu được yêu cầu. Khi đăng nhập sau, chỉ có tên người dùng và mật khẩu được kiểm tra.';
$string['auth_casnotinstalled'] = 'Không thể sử dụng xác thực CAS. Mô-đun LDAP PHP chưa được cài đặt.';
$string['CASform'] = 'Lựa chọn xác thực';
$string['noldapserver'] = 'Không có máy chủ LDAP nào được định cấu hình cho CAS! Đồng bộ hóa bị tắt.';
$string['pluginname'] = 'Máy chủ CAS (SSO)';
$string['privacy:metadata'] = 'Plugin xác thực máy chủ CAS (SSO) không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['synctask'] = 'Công việc đồng bộ hóa người dùng CAS';
