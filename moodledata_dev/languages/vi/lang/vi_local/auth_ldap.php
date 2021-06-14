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
 * @subpackage ldap
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_ldap_ad_create_req'] = 'Không thể tạo tài khoản mới trong Active Directory. Đảm bảo rằng bạn đáp ứng tất cả các yêu cầu để điều này hoạt động (kết nối LDAPS, ràng buộc người dùng có đủ 
quyền, v.v.)';
$string['auth_ldap_attrcreators'] = 'Danh sách các nhóm hoặc ngữ cảnh có các thành viên được phép tạo thuộc tính. Tách nhiều nhóm bằng \';\'. Thông thường những thứ như \'cn = teacher, ou = staff, o = myorg\'';
$string['auth_ldap_attrcreators_key'] = 'Người tạo thuộc tính';
$string['auth_ldap_auth_user_create_key'] = 'Tạo người dùng bên ngoài';
$string['auth_ldap_bind_dn_key'] = 'Tên riêng biệt';
$string['auth_ldap_bind_pw_key'] = 'Mật khẩu';
$string['auth_ldap_changepasswordurl_key'] = 'URL thay đổi mật khẩu';
$string['auth_ldap_contexts_key'] = 'Bối cảnh';
$string['auth_ldap_create_context_key'] = 'Bối cảnh cho người dùng mới';
$string['auth_ldap_create_error'] = 'Lỗi khi tạo người dùng trong LDAP.';
$string['auth_ldap_creators_key'] = 'Người sáng tạo';
$string['auth_ldap_expiration_key'] = 'Hết hạn';
$string['auth_ldap_expiration_warning_key'] = 'Cảnh báo hết hạn';
$string['auth_ldap_expireattr_key'] = 'Thuộc tính hết hạn';
$string['auth_ldap_gracelogin_key'] = 'Thuộc tính đăng nhập gia hạn';
$string['auth_ldap_gracelogins_key'] = 'Hạn đăng nhập';
$string['auth_ldap_groupecreators'] = 'Danh sách các nhóm hoặc ngữ cảnh có các thành viên được phép tạo nhóm. Tách nhiều nhóm bằng \';\'. Thông thường những thứ như \'cn = teacher, ou = staff, o = myorg\'';
$string['auth_ldap_groupecreators_key'] = 'Người tạo nhóm';
$string['auth_ldap_host_url_key'] = 'URL máy chủ';
$string['auth_ldap_ldap_encoding'] = 'Mã hóa được sử dụng bởi máy chủ LDAP, rất có thể là utf-8. Nếu LDAP v2 được chọn, Active Directory sử dụng mã hóa đã định cấu hình, chẳng hạn như cp1252 hoặc cp1250.';
$string['auth_ldap_ldap_encoding_key'] = 'Mã hóa LDAP';
$string['auth_ldap_memberattribute_isdn'] = 'Tùy chọn: Ghi đè xử lý các giá trị thuộc tính thành viên, 0 hoặc 1';
$string['auth_ldap_memberattribute_isdn_key'] = 'Thuộc tính thành viên sử dụng dn';
$string['auth_ldap_memberattribute_key'] = 'Thuộc tính thành viên';
$string['auth_ldap_no_mbstring'] = 'Bạn cần phần mở rộng mbstring để tạo người dùng trong Active Directory.';
$string['auth_ldap_noconnect'] = 'LDAP-mô-đun không thể kết nối với máy chủ: {$a}';
$string['auth_ldap_noconnect_all'] = 'LDAP-module không thể kết nối với bất kỳ máy chủ nào: {$a}';
$string['auth_ldap_noextension'] = '<em> Mô-đun LDAP PHP dường như không có. Hãy đảm bảo rằng nó đã được cài đặt và kích hoạt nếu bạn muốn sử dụng plugin xác thực này. </em>';
$string['auth_ldap_objectclass_key'] = 'Lớp đối tượng';
$string['auth_ldap_opt_deref_key'] = 'Bí danh tham khảo';
$string['auth_ldap_passtype'] = 'Chỉ định định dạng của mật khẩu mới hoặc đã thay đổi trong máy chủ LDAP.';
$string['auth_ldap_passtype_key'] = 'Định dạng mật khẩu';
$string['auth_ldap_preventpassindb'] = 'Chọn có để ngăn mật khẩu được lưu trữ trong Cơ sở dữ liệu của Moodle.';
$string['auth_ldap_preventpassindb_key'] = 'Ngăn chặn mật khẩu lưu vào bộ nhớ đệm';
$string['auth_ldap_rolecontext'] = 'Ngữ cảnh của {$a->localname}';
$string['auth_ldap_rolecontext_help'] = 'Ngữ cảnh LDAP được sử dụng để chọn ánh xạ <i> {$a->localname} </i>. Tách nhiều nhóm bằng \';\'. Thường là một cái gì đó như "cn = {$a->shortname}, ou = staff, o = myorg".';
$string['auth_ldap_search_sub_key'] = 'Tìm kiếm các điều kiện phụ';
$string['auth_ldap_suspended_attribute'] = 'Tùy chọn: Khi được cung cấp, thuộc tính này sẽ được sử dụng để bật / tạm dừng tài khoản người dùng được tạo cục bộ.';
$string['auth_ldap_suspended_attribute_key'] = 'Thuộc tính bị treo';
$string['auth_ldap_unsupportedusertype'] = 'auth: ldap user_create () không hỗ trợ loại người dùng đã chọn: {$a}';
$string['auth_ldap_user_attribute_key'] = 'Thuộc tính người dùng';
$string['auth_ldap_user_exists'] = 'Tên người dùng LDAP đã tồn tại.';
$string['auth_ldap_user_type_key'] = 'Loại người dùng';
$string['auth_ldap_usertypeundefined'] = 'config.user_type không được xác định hoặc chức năng ldap_expirationtime2unix không hỗ trợ loại đã chọn!';
$string['auth_ldap_usertypeundefined2'] = 'config.user_type không được xác định hoặc chức năng ldap_unixi2expirationtime không hỗ trợ loại đã chọn!';
$string['auth_ldap_version_key'] = 'Phiên bản';
$string['auth_ldapnotinstalled'] = 'Không thể sử dụng xác thực LDAP. Mô-đun LDAP PHP chưa được cài đặt.';
$string['auth_ntlmsso'] = 'NTLM SSO';
$string['auth_ntlmsso_enabled'] = 'Đặt thành có để thử Đăng nhập một lần với miền NTLM. Lưu ý rằng điều này yêu cầu thiết lập bổ sung trên máy chủ để hoạt động. Để biết thêm chi tiết, hãy xem tài liệu <a 
href="https://docs.moodle.org/en/NTLM_authentication"> Xác thực NTLM </a>.';
$string['auth_ntlmsso_enabled_key'] = 'Kích hoạt';
$string['auth_ntlmsso_ie_fastpath'] = 'Đặt để bật đường dẫn nhanh NTLM SSO (bỏ qua các bước nhất định nếu trình duyệt của khách hàng là MS Internet Explorer).';
$string['auth_ntlmsso_ie_fastpath_attempt'] = 'Cố gắng NTLM với tất cả các trình duyệt';
$string['auth_ntlmsso_ie_fastpath_key'] = 'MS IE đường dẫn nhanh?';
$string['auth_ntlmsso_ie_fastpath_yesattempt'] = 'Có, hãy thử NTLM các trình duyệt khác';
$string['auth_ntlmsso_ie_fastpath_yesform'] = 'Có, tất cả các trình duyệt khác đều sử dụng biểu mẫu đăng nhập chuẩn';
$string['auth_ntlmsso_maybeinvalidformat'] = 'Không thể trích xuất tên người dùng từ tiêu đề REMOTE_USER. Định dạng đã cấu hình có đúng không?';
$string['auth_ntlmsso_missing_username'] = 'Bạn cần chỉ định ít nhất% tên người dùng% ở định dạng tên người dùng từ xa';
$string['auth_ntlmsso_remoteuserformat'] = 'Nếu bạn đã chọn \'NTLM\' trong \'Loại xác thực\', bạn có thể chỉ định định dạng tên người dùng từ xa tại đây. Nếu bạn để trống phần này, định dạng DOMAIN \\ tên người dùng 
mặc định sẽ được sử dụng. Bạn có thể sử dụng trình giữ chỗ <b>% domain% </b> tùy chọn để chỉ định nơi tên miền xuất hiện và trình giữ chỗ <b>% tên người dùng% </b> bắt buộc để chỉ định nơi tên người dùng xuất hiện. <br /> <br /> Một số định dạng được sử dụng rộng rãi là <tt>% domain% \\% username% </tt> (MS Windows mặc định), <tt>% domain% /% username% </tt>, <tt >% tên miền% +% tên người dùng% </tt> và chỉ <tt>% tên người dùng% </tt> (nếu không có phần tên miền).';
$string['auth_ntlmsso_remoteuserformat_key'] = 'Định dạng tên người dùng từ xa';
$string['auth_ntlmsso_subnet'] = 'Nếu được đặt, nó sẽ chỉ thử SSO với các máy khách trong mạng con này. Định dạng: xxx.xxx.xxx.xxx/bitmask. Tách nhiều mạng con bằng \',\' (dấu phẩy)
.';
$string['auth_ntlmsso_subnet_key'] = 'Mạng con';
$string['auth_ntlmsso_type'] = 'Phương thức xác thực được định cấu hình trong máy chủ web để xác thực người dùng (nếu nghi ngờ, hãy chọn NTLM)';
$string['auth_ntlmsso_type_key'] = 'Loại xác thực';
$string['cannotmaprole'] = 'Không thể ánh xạ vai trò "{$a->rolename}" vì tên viết tắt của nó "{$a->shortname}" quá dài và / hoặc chứa dấu gạch nối. Để cho phép nó được ánh xạ, tên ngắn cần được giảm xuống còn tối đa {$a->charlimit} ký tự và loại bỏ bất kỳ dấu gạch nối nào. <a href="{$a->link} "> Chỉnh sửa vai trò </a>';
$string['connectingldap'] = 'Đang kết nối với máy chủ LDAP ...';
$string['connectingldapsuccess'] = 'Kết nối với máy chủ LDAP của bạn đã thành công';
$string['creatingtemptable'] = 'Tạo bảng tạm thời {$a}';
$string['diag_contextnotfound'] = 'Ngữ cảnh {$a} không tồn tại hoặc không thể đọc được bởi bind DN.';
$string['diag_emptycontext'] = 'Đã tìm thấy ngữ cảnh trống.';
$string['diag_genericerror'] = 'Lỗi LDAP {$a->code} đọc {$a->subject}: {$a->message}.';
$string['diag_rolegroupnotfound'] = 'Nhóm {$a->group} cho vai trò {$a->localname} không tồn tại hoặc không thể đọc được bởi bind DN.';
$string['diag_toooldversion'] = 'Rất ít khả năng máy chủ LDAP hiện đại sử dụng giao thức LDAPv2. Cài đặt sai có thể làm hỏng giá trị trong trường người dùng. Kiểm tra với quản trị viên LDAP của bạn.';
$string['didntfindexpiretime'] = 'password_expire () không tìm thấy thời gian hết hạn.';
$string['didntgetusersfromldap'] = 'Không nhận được bất kỳ người dùng nào từ LDAP - lỗi? - thoát ra';
$string['gotcountrecordsfromldap'] = 'Nhận bản ghi {$a} từ LDAP';
$string['ldapnotconfigured'] = 'Url máy chủ LDAP hiện chưa được định cấu hình';
$string['morethanoneuser'] = 'Đã tìm thấy nhiều bản ghi người dùng trong LDAP. Chỉ sử dụng cái đầu tiên.';
$string['needbcmath'] = 'Bạn cần phần mở rộng BCMath để sử dụng tính năng kiểm tra mật khẩu đã hết hạn với Active Directory.';
$string['needmbstring'] = 'Bạn cần phần mở rộng mbstring để thay đổi mật khẩu trong Active Directory';
$string['nodnforusername'] = 'Lỗi trong user_update_password (). Không có DN cho: {$a->tên người dùng}';
$string['noemail'] = 'Đã cố gắng gửi cho bạn một email nhưng không thành công!';
$string['notcalledfromserver'] = 'Không nên được gọi từ máy chủ web!';
$string['noupdatestobedone'] = 'Không có cập nhật nào được thực hiện';
$string['nouserentriestoremove'] = 'Không có mục nhập người dùng nào bị xóa';
$string['nouserentriestorevive'] = 'Không có mục nhập người dùng nào được hồi sinh';
$string['nouserstobeadded'] = 'Không có mục nhập người dùng nào được thêm vào';
$string['ntlmsso_attempting'] = 'Đang cố gắng Đăng nhập một lần qua NTLM ...';
$string['ntlmsso_failed'] = 'Đăng nhập tự động không thành công, hãy thử trang đăng nhập bình thường ...';
$string['ntlmsso_isdisabled'] = 'NTLM SSO bị tắt.';
$string['ntlmsso_unknowntype'] = 'Loại ntlmsso không rõ!';
$string['pagedresultsnotsupp'] = 'Kết quả phân trang LDAP không được hỗ trợ (phiên bản PHP của bạn thiếu hỗ trợ, bạn đã định cấu hình Moodle để sử dụng giao thức LDAP phiên bản 2 hoặc Moodle không thể liên hệ với máy chủ LDAP của bạn để xem có hỗ trợ phân trang hay không.)';
$string['pagesize'] = 'Đảm bảo giá trị này nhỏ hơn giới hạn kích thước tập hợp kết quả của máy chủ LDAP của bạn (số lượng mục nhập tối đa có thể được trả về trong một truy vấn)';
$string['pagesize_key'] = 'Kích thước trang';
$string['pluginnotenabled'] = 'Plugin chưa được kích hoạt!';
$string['privacy:metadata'] = 'Plugin xác thực máy chủ LDAP không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['renamingnotallowed'] = 'Đổi tên người dùng không được phép trong LDAP';
$string['rootdseerror'] = 'Lỗi khi truy vấn rootDSE cho Active Directory';
$string['start_tls'] = 'Sử dụng dịch vụ LDAP thông thường (cổng 389) với mã hóa TLS';
$string['start_tls_key'] = 'Sử dụng TLS';
$string['syncroles'] = 'Đồng bộ hóa các vai trò hệ thống từ LDAP';
$string['synctask'] = 'Công việc đồng bộ hóa người dùng LDAP';
$string['systemrolemapping'] = 'Ánh xạ vai trò hệ thống';
$string['updatepasserror'] = 'Lỗi trong user_update_password (). Mã lỗi: {$a->errno}; Chuỗi lỗi: {$a->errstring}';
$string['updatepasserrorexpire'] = 'Lỗi trong user_update_password () khi đọc thời gian hết hạn của mật khẩu. Mã lỗi: {$a->errno}; Chuỗi lỗi: {$a->errstring}';
$string['updatepasserrorexpiregrace'] = 'Lỗi trong user_update_password () khi sửa đổi thời gian hết hạn và / hoặc đăng nhập gia hạn. Mã lỗi: {$a->errno}; Chuỗi lỗi: {$a->errstring}';
$string['updateremfail'] = 'Lỗi khi cập nhật bản ghi LDAP. Mã lỗi: {$a->errno}; Chuỗi lỗi: {$a->errstring} <br/> Khóa ({$a->key}) - giá trị moodle cũ: \'{$a->ouvalue}\' giá trị mới: \'{$a->nuvalue}\'';
$string['updateremfailamb'] = 'Không cập nhật được LDAP với trường không rõ ràng {$a->key}; giá trị moodle cũ: \'{$a->ouvalue}\', giá trị mới: \'{$a->nuvalue}\'';
$string['updateremfailfield'] = 'Không cập nhật được LDAP với trường không tồn tại (\'{$a->ldapkey}\'). Khóa ({$a->key}) - giá trị Moodle cũ: \'{$a->ouvalue}\' giá trị mới: \'{$a->nuvalue}\'';
$string['updateusernotfound'] = 'Không thể tìm thấy người dùng khi cập nhật bên ngoài. Thông tin chi tiết theo sau: cơ sở tìm kiếm: \'{$a->userdn}\'; bộ lọc tìm kiếm: \'(objectClass = *)\'; thuộc tính tìm kiếm: {$a->attribs}';
$string['user_activatenotsupportusertype'] = 'auth: ldap user_activate () không hỗ trợ loại người dùng đã chọn: {$a}';
$string['user_disablenotsupportusertype'] = 'auth: ldap user_disable () không hỗ trợ loại người dùng đã chọn: {$a}';
$string['useracctctrlerror'] = 'Lỗi khi tải userAccountControl cho {$a}';
$string['userentriestoadd'] = 'Các mục nhập của người dùng sẽ được thêm vào: {$a}';
$string['userentriestoremove'] = 'Các mục nhập của người dùng sẽ bị xóa: {$a}';
$string['userentriestorevive'] = 'Các mục nhập của người dùng sẽ được phục hồi: {$a}';
$string['userentriestoupdate'] = 'Các mục nhập của người dùng sẽ được cập nhật: {$a}';
$string['usernotfound'] = 'Không tìm thấy người dùng trong LDAP';
