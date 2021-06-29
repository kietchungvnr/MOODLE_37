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
 * @subpackage shibboleth
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_shib_auth_logo'] = 'Biểu trưng của phương pháp xác thực';
$string['auth_shib_auth_logo_description'] = 'Cung cấp biểu trưng cho phương thức xác thực Shibboleth quen thuộc với người dùng của bạn. Đây có thể là biểu trưng của liên đoàn Shibboleth của bạn, ví dụ: <tt> 
SWITCHaai Login </tt> hoặc <tt> InCommon Login </tt> hoặc tương tự.';
$string['auth_shib_auth_method'] = 'Tên phương thức xác thực';
$string['auth_shib_auth_method_description'] = 'Cung cấp tên cho phương thức xác thực Shibboleth quen thuộc với người dùng của bạn. Đây có thể là tên của liên kết Shibboleth của bạn, ví dụ: <tt> SWITCHaai Login 
</tt> hoặc <tt> InCommon Login </tt> hoặc tương tự.';
$string['auth_shib_changepasswordurl'] = 'URL thay đổi mật khẩu';
$string['auth_shib_contact_administrator'] = 'Trong trường hợp bạn không được liên kết với các tổ chức nhất định và bạn cần quyền truy cập vào một khóa học trên máy chủ này, vui lòng liên hệ với <a href="mailto:{$a}"> 
Quản trị viên Moodle </a>.';
$string['auth_shib_convert_data'] = 'API sửa đổi dữ liệu';
$string['auth_shib_convert_data_description'] = 'Bạn có thể sử dụng API này để sửa đổi thêm dữ liệu do Shibboleth cung cấp. Đọc <a href="../auth/shibboleth/README.txt"> README </a> để được hướng dẫn thêm.';
$string['auth_shib_convert_data_warning'] = 'Tệp không tồn tại hoặc không thể đọc được bằng quy trình máy chủ web!';
$string['auth_shib_idp_list'] = 'Nhà cung cấp danh tính';
$string['auth_shib_idp_list_description'] = 'Cung cấp danh sách các entityID của Nhà cung cấp danh tính để cho phép người dùng lựa chọn trên trang đăng nhập. <br /> Trên mỗi dòng phải có một bộ được phân tách 
bằng dấu phẩy cho entityID của IdP (xem tệp siêu dữ liệu Shibboleth) và Tên của IdP là nó sẽ được hiển thị trong danh sách thả xuống. <br /> Là tham số thứ ba tùy chọn, bạn có thể thêm vị trí của trình khởi tạo phiên Shibboleth sẽ được sử dụng trong trường hợp cài đặt Moodle của bạn là một phần của thiết lập đa liên kết.';
$string['auth_shib_instructions'] = 'Sử dụng <a href="{$a}"> đăng nhập Shibboleth </a> để có quyền truy cập qua Shibboleth, nếu tổ chức của bạn hỗ trợ. Nếu không, hãy sử dụng biểu mẫu đăng nhập
 bình thường được hiển thị ở đây.';
$string['auth_shib_instructions_help'] = 'Tại đây, bạn nên cung cấp hướng dẫn tùy chỉnh cho người dùng của mình để giải thích về Shibboleth. Nó sẽ được hiển thị trên trang đăng nhập trong phần hướng dẫn. Các 
hướng dẫn phải bao gồm một liên kết đến "<b> {$a} </b>" mà người dùng nhấp vào khi họ muốn đăng nhập.';
$string['auth_shib_instructions_key'] = 'Hướng dẫn đăng nhập';
$string['auth_shib_integrated_wayf'] = 'Dịch vụ Moodle WAYF';
$string['auth_shib_integrated_wayf_description'] = 'Nếu bạn bật tính năng này, Moodle sẽ sử dụng dịch vụ WAYF của riêng mình thay vì dịch vụ được định cấu hình cho Shibboleth. Moodle sẽ hiển thị danh sách thả xuống 
trên trang đăng nhập thay thế này, nơi người dùng phải chọn Nhà cung cấp danh tính của mình.';
$string['auth_shib_logout_return_url'] = 'URL trả lại đăng xuất thay thế';
$string['auth_shib_logout_return_url_description'] = 'Cung cấp URL mà người dùng Shibboleth sẽ được chuyển hướng đến sau khi đăng xuất. <br /> Nếu để trống, người dùng sẽ được chuyển hướng đến vị trí mà moodle sẽ 
chuyển hướng người dùng đến';
$string['auth_shib_logout_url'] = 'URL trình xử lý đăng xuất của Nhà cung cấp dịch vụ Shibboleth';
$string['auth_shib_logout_url_description'] = 'Cung cấp URL cho trình xử lý đăng xuất Nhà cung cấp dịch vụ Shibboleth. Đây thường là <tt> /Shibboleth.sso/Logout </tt>';
$string['auth_shib_no_organizations_warning'] = 'Nếu bạn muốn sử dụng dịch vụ WAYF tích hợp, bạn phải cung cấp danh sách ID thực thể Nhà cung cấp danh tính được phân tách riêng biệt, tên của chúng và tùy chọn là 
trình khởi tạo phiên.';
$string['auth_shib_only'] = 'Chỉ Shibboleth';
$string['auth_shib_only_description'] = 'Chọn tùy chọn này nếu xác thực Shibboleth sẽ được thực thi';
$string['auth_shib_username_description'] = 'Tên của biến môi trường Shibboleth của máy chủ web sẽ được sử dụng làm tên người dùng Moodle';
$string['auth_shibboleth_errormsg'] = 'Vui lòng chọn tổ chức bạn là thành viên!';
$string['auth_shibboleth_login'] = 'Đăng nhập Shibboleth';
$string['auth_shibboleth_login_long'] = 'Đăng nhập vào Moodle qua Shibboleth';
$string['auth_shibboleth_manual_login'] = 'Đăng nhập thủ công';
$string['auth_shibboleth_select_member'] = 'Tôi là thành viên của ...';
$string['auth_shibboleth_select_organization'] = 'Để xác thực qua Shibboleth, vui lòng chọn tổ chức của bạn từ menu thả xuống:';
$string['auth_shibbolethdescription'] = 'Sử dụng phương pháp này, người dùng được tạo và xác thực bằng Shibboleth. Để biết chi tiết thiết lập, hãy xem <a href="../auth/shibboleth/README.txt"> Shibboleth README </a>.';
$string['pluginname'] = 'Shibboleth';
$string['privacy:metadata'] = 'Plugin xác thực Shibboleth không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['shib_invalid_account_error'] = 'Có vẻ như bạn đã được Shibboleth xác thực nhưng Moodle không có tài khoản hợp lệ cho tên người dùng của bạn. Tài khoản của bạn có thể không tồn tại hoặc có thể đã bị tạm ngưng.';
$string['shib_no_attributes_error'] = 'Có vẻ như bạn đã được Shibboleth xác thực nhưng Moodle không nhận được bất kỳ thuộc tính người dùng nào. Vui lòng kiểm tra xem Nhà cung cấp danh tính của bạn có phát hành các thuộc tính cần thiết ({$a}) cho Nhà cung cấp dịch vụ mà Moodle đang chạy hay không hoặc thông báo cho quản trị viên web về máy chủ này.';
$string['shib_not_all_attributes_error'] = 'Moodle cần một số thuộc tính Shibboleth không có trong trường hợp của bạn. Các thuộc tính là: {$a} <br /> Vui lòng liên hệ với quản trị viên web của máy chủ này hoặc Nhà cung cấp danh tính của bạn.';
$string['shib_not_set_up_error'] = 'Xác thực Shibboleth dường như không được thiết lập chính xác vì không có biến môi trường Shibboleth nào hiện diện cho trang này. Vui lòng tham khảo <a href="README.txt"> README </a> để được hướng dẫn thêm về cách thiết lập xác thực Shibboleth hoặc liên hệ với quản trị viên web của cài đặt Moodle này.';
