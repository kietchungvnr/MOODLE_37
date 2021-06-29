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
 * @subpackage ldap
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['assignrole'] = 'Gán vai trò \'{$a->role_shortname}\' cho người dùng \'{$a->user_username}\' trong khóa học \'{$a->course_shortname}\' (id {$a->course_id})';
$string['assignrolefailed'] = 'Không thể gán vai trò \'{$a->role_shortname}\' cho người dùng \'{$a->user_username}\' trong khóa học \'{$a->course_shortname}\' (id {$a->course_id})';
$string['autocreate'] = '<p> Các khóa học có thể được tạo tự động nếu có người đăng ký một khóa học chưa tồn tại trong Moodle </p> <p> Nếu bạn đang sử dụng tính năng tạo khóa học tự động,
 bạn nên xóa các tính năng sau: moodle / khóa học: changeidnumber, moodle / course: changeshortname, moodle / course: changefullname và moodle / course: changesummary, từ các vai trò liên quan để ngăn chặn sửa đổi của bốn trường khóa học được chỉ định ở trên (số ID, tên viết tắt, tên đầy đủ và tóm tắt). </ p >';
$string['autocreate_key'] = 'Tự động tạo';
$string['autocreation_settings'] = 'Cài đặt tạo khóa học tự động';
$string['autoupdate_settings'] = 'Cài đặt cập nhật khóa học tự động';
$string['autoupdate_settings_desc'] = '<p> Chọn các trường để cập nhật khi tập lệnh đồng bộ hóa đang chạy (register / ldap / cli / sync.php). </p> <p> Khi ít nhất một trường được chọn, quá trình cập nhật sẽ xảy ra. </p>';
$string['bind_dn'] = 'Nếu bạn muốn sử dụng ràng buộc người dùng để tìm kiếm người dùng, hãy chỉ định nó ở đây. Một số câu như \'cn = ldapuser, ou = public, o = org\'';
$string['bind_dn_key'] = 'Ràng buộc tên phân biệt của người dùng';
$string['bind_pw'] = 'Mật khẩu cho người dùng ràng buộc';
$string['bind_pw_key'] = 'Mật khẩu';
$string['bind_settings'] = 'Cài đặt ràng buộc';
$string['cannotcreatecourse'] = 'Không thể tạo khóa học: thiếu dữ liệu bắt buộc từ bản ghi LDAP!';
$string['cannotupdatecourse'] = 'Không thể cập nhật khóa học: thiếu dữ liệu bắt buộc từ bản ghi LDAP! Số mã khóa học: \'{$a->idnumber}\'';
$string['cannotupdatecourse_duplicateshortname'] = 'Không thể cập nhật khóa học: Tên viết tắt trùng lặp. Đang bỏ qua khóa học với idnumber \'{$a->idnumber}\' ...';
$string['category'] = 'Danh mục cho các khóa học được tạo tự động';
$string['category_key'] = 'Danh mục';
$string['contexts'] = 'Ngữ cảnh LDAP';
$string['couldnotfinduser'] = 'Không thể tìm thấy người dùng \'{$a}\', đang bỏ qua';
$string['course_fullname'] = 'Tùy chọn: Thuộc tính LDAP để lấy tên đầy đủ từ';
$string['course_fullname_key'] = 'Họ và tên';
$string['course_fullname_updateonsync'] = 'Cập nhật tên đầy đủ trong tập lệnh đồng bộ hóa';
$string['course_fullname_updateonsync_key'] = 'Cập nhật tên đầy đủ';
$string['course_idnumber'] = 'Thuộc tính LDAP để lấy số ID khóa học. Thường là \'cn\' hoặc \'uid\'.';
$string['course_idnumber_key'] = 'số ID';
$string['course_search_sub'] = 'Tìm kiếm tư cách thành viên nhóm từ các điều kiện phụ';
$string['course_search_sub_key'] = 'Tìm kiếm các điều kiện phụ';
$string['course_settings'] = 'Cài đặt đăng ký khóa học';
$string['course_shortname'] = 'Tùy chọn: Thuộc tính LDAP để lấy tên viết tắt từ';
$string['course_shortname_key'] = 'Tên ngắn';
$string['course_shortname_updateonsync'] = 'Cập nhật tên ngắn trong tập lệnh đồng bộ hóa';
$string['course_shortname_updateonsync_key'] = 'Cập nhật tên ngắn';
$string['course_summary'] = 'Tùy chọn: Thuộc tính LDAP để lấy tóm tắt từ';
$string['course_summary_key'] = 'Tóm lược';
$string['course_summary_updateonsync'] = 'Cập nhật tóm tắt trong quá trình đồng bộ hóa tập lệnh';
$string['course_summary_updateonsync_key'] = 'Cập nhật tóm tắt';
$string['coursenotexistskip'] = 'Khóa học \'{$a}\' không tồn tại và tính năng tự động tính toán bị tắt, bỏ qua';
$string['courseupdated'] = 'Đã cập nhật thành công khóa học có idnumber \'{$a->idnumber}\'.';
$string['courseupdateskipped'] = 'Khóa học với idnumber \'{$a->idnumber}\' không yêu cầu cập nhật. Bỏ qua ...';
$string['createcourseextid'] = 'Tạo người dùng đã đăng ký khóa học không tồn tại \'{$a->courseextid}\'';
$string['createnotcourseextid'] = 'Người dùng đã đăng ký một khóa học không tồn tại \'{$a->courseextid}\'';
$string['creatingcourse'] = 'Đang tạo khóa học \'{$a}\' ...';
$string['duplicateshortname'] = 'Không thể tạo khóa học. Tên viết tắt trùng lặp. Đang bỏ qua khóa học với idnumber \'{$a->idnumber}\' ...';
$string['editlock'] = 'Khóa giá trị';
$string['emptyenrolment'] = 'Đăng ký trống cho vai trò \'{$a->role_shortname}\' trong khóa học \'{$a->course_shortname}\'';
$string['enrolname'] = 'LDAP';
$string['enroluser'] = 'Đăng ký người dùng \'{$a->user_username}\' vào khóa học \'{$a->course_shortname}\' (id {$a->course_id})';
$string['enroluserenable'] = 'Đã bật đăng ký cho người dùng \'{$a->user_username}\' trong khóa học \'{$a->course_shortname}\' (id {$a->course_id})';
$string['explodegroupusertypenotsupported'] = 'ldap_explode_group () không hỗ trợ loại người dùng đã chọn: {$a}';
$string['extcourseidinvalid'] = 'Id bên ngoài của khóa học không hợp lệ!';
$string['extremovedsuspend'] = 'Đã tắt đăng ký cho người dùng \'{$a->user_username}\' trong khóa học \'{$a->course_shortname}\' (id {$a->course_id})';
$string['extremovedsuspendnoroles'] = 'Đã vô hiệu hóa đăng ký và đã xóa vai trò cho người dùng \'{$a->user_username}\' trong khóa học \'{$a->course_shortname}\' (id {$a->course_id})';
$string['extremovedunenrol'] = 'Hủy đăng ký người dùng \'{$a->user_username}\' khỏi khóa học \'{$a->course_shortname}\' (id {$a->course_id})';
$string['failed'] = 'Thất bại!';
$string['general_options'] = 'Các tùy chọn chung';
$string['group_memberofattribute'] = 'Tên của thuộc tính chỉ định các nhóm mà một người dùng hoặc nhóm cụ thể thuộc về (ví dụ: memberOf, groupMembership, v.v.)';
$string['group_memberofattribute_key'] = 'Thuộc tính \'thành viên của\'';
$string['host_url'] = 'Chỉ định máy chủ LDAP ở dạng URL như \'ldap: //ldap.myorg.com/\' hoặc \'ldaps: //ldap.myorg.com/\'';
$string['host_url_key'] = 'URL máy chủ';
$string['idnumber_attribute'] = 'Nếu thành viên nhóm chứa các tên phân biệt, hãy chỉ định cùng một thuộc tính mà bạn đã sử dụng cho ánh xạ \'Số ID\' của người dùng trong cài đặt xác thực LDAP.';
$string['idnumber_attribute_key'] = 'Thuộc tính số ID';
$string['ldap:manage'] = 'Quản lý các phiên bản đăng ký LDAP';
$string['ldap_encoding'] = 'Chỉ định mã hóa được sử dụng bởi máy chủ LDAP. Hầu hết có lẽ là utf-8, MS AD v2 sử dụng mã hóa nền tảng mặc định như cp1252, cp1250, v.v.';
$string['ldap_encoding_key'] = 'Mã hóa LDAP';
$string['memberattribute'] = 'Thuộc tính thành viên LDAP';
$string['memberattribute_isdn'] = 'Nếu thành viên nhóm chứa các tên phân biệt, bạn cần chỉ định chúng ở đây. Nếu vậy, bạn cũng cần phải định cấu hình các cài đặt còn lại trong phần này.';
$string['memberattribute_isdn_key'] = 'Thuộc tính thành viên sử dụng dn';
$string['nested_groups'] = 'Bạn có muốn sử dụng các nhóm (nhóm nhóm) lồng nhau để đăng ký không?';
$string['nested_groups_key'] = 'Nhóm lồng nhau';
$string['nested_groups_settings'] = 'Cài đặt nhóm lồng nhau';
$string['nosuchrole'] = 'Không có vai trò như vậy: \'{$a}\'';
$string['objectclass'] = 'objectClass được sử dụng để tìm kiếm các khóa học. Thường là \'nhóm\' hoặc \'posixGroup\'';
$string['objectclass_key'] = 'Lớp đối tượng';
$string['ok'] = 'ĐỒNG Ý!';
$string['opt_deref'] = 'Nếu thành viên nhóm chứa các tên phân biệt, hãy chỉ định cách xử lý bí danh trong quá trình tìm kiếm. Chọn một trong các giá trị sau: \'Không\' (LDAP_DEREF_NEVER) hoặc \'Có\' (LDAP_DEREF_ALWAYS).';
$string['opt_deref_key'] = 'Bí danh tham khảo';
$string['phpldap_noextension'] = '<em> Mô-đun LDAP PHP dường như không có. Hãy đảm bảo rằng nó đã được cài đặt và kích hoạt nếu bạn muốn sử dụng plugin đăng ký này. </em>';
$string['pluginname'] = 'Đăng ký LDAP';
$string['pluginname_desc'] = '<p> Bạn có thể sử dụng máy chủ LDAP để kiểm soát đăng ký của mình. Giả sử cây LDAP của bạn chứa các nhóm ánh xạ đến các khóa học và mỗi nhóm / khóa học đó sẽ 
có các mục nhập thành viên để liên kết với sinh viên. </p> <p> Giả định rằng các khóa học được định nghĩa là nhóm trong LDAP, với mỗi nhóm có nhiều trường thành viên (<em> thành viên </em> hoặc <em> memberUid </em>) chứa thông tin nhận dạng duy nhất của người dùng. </p> <p> Để sử dụng đăng ký LDAP, người dùng của bạn <strong > phải </strong> có trường idnumber hợp lệ. Nhóm LDAP phải có mã số đó trong các trường thành viên để người dùng được đăng ký trong khóa học. Điều này thường sẽ hoạt động tốt nếu bạn đã sử dụng Xác thực LDAP. </p> <p> Các đăng ký sẽ được cập nhật khi người dùng đăng nhập. Bạn cũng có thể chạy một tập lệnh để đồng bộ hóa các đăng ký. Hãy tìm trong <em>enrol/ldap/cli/sync.php</[</blank.</p> <p> Bạn cũng có thể đặt plugin này để tự động tạo các khóa học mới khi các nhóm mới xuất hiện trong LDAP. </p>';
$string['pluginnotenabled'] = 'Plugin chưa được kích hoạt!';
$string['privacy:metadata'] = 'Plugin đăng ký LDAP không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['role_mapping'] = '<p> Đối với mỗi vai trò, bạn cần chỉ định tất cả các ngữ cảnh LDAP nơi đặt các nhóm đại diện cho các khóa học. Phân tách các ngữ cảnh khác nhau bằng dấu chấm phẩy (;). </p> <p> Bạn cũng cần chỉ định thuộc tính mà máy chủ LDAP của bạn sử dụng để chứa các thành viên của nhóm. Đây thường là "thành viên" hoặc "memberUid". </p>';
$string['role_mapping_attribute'] = 'Thuộc tính thành viên LDAP cho {$a}';
$string['role_mapping_context'] = 'Các ngữ cảnh LDAP cho {$a}';
$string['role_mapping_key'] = 'Ánh xạ các vai trò từ LDAP';
$string['roles'] = 'Lập bản đồ vai trò';
$string['server_settings'] = 'Cài đặt máy chủ LDAP';
$string['synccourserole'] = '== Khóa học đồng bộ hóa \'{$a->idnumber}\' cho vai trò \'{$a->role_shortname}\'';
$string['syncenrolmentstask'] = 'Đồng bộ hóa nhiệm vụ đăng ký LDAP';
$string['template'] = 'Tùy chọn: các khóa học được tạo tự động có thể sao chép cài đặt của chúng từ khóa học mẫu';
$string['template_key'] = 'Bản mẫu';
$string['unassignrole'] = 'Bỏ gán vai trò \'{$a->role_shortname}\' cho người dùng \'{$a->user_username}\' khỏi khóa học \'{$a->course_shortname}\' (id {$a->course_id})';
$string['unassignrolefailed'] = 'Không thể bỏ gán vai trò \'{$a->role_shortname}\' cho người dùng \'{$a->user_username}\' từ khóa học \'{$a->course_shortname}\' (id {$a->course_id})';
$string['unassignroleid'] = 'Bỏ gán id vai trò \'{$a->role_id}\' cho id người dùng \'{$a->user_id}\'';
$string['updatelocal'] = 'Cập nhật dữ liệu cục bộ';
$string['user_attribute'] = 'Nếu thành viên nhóm chứa các tên phân biệt, hãy chỉ định thuộc tính được sử dụng để đặt tên / tìm kiếm người dùng. Nếu bạn đang sử dụng xác thực LDAP, giá trị này phải 
khớp với thuộc tính được chỉ định trong ánh xạ \'Số ID\' trong plugin xác thực LDAP.';
$string['user_attribute_key'] = 'Thuộc tính số ID';
$string['user_contexts'] = 'Nếu thành viên nhóm chứa các tên phân biệt, hãy chỉ định danh sách ngữ cảnh nơi người dùng đang ở. Phân tách các ngữ cảnh khác nhau bằng dấu chấm phẩy (;). Ví dụ:
 \'ou = người dùng, o = org; ou = những người khác, o = org \'.';
$string['user_contexts_key'] = 'Bối cảnh';
$string['user_search_sub'] = 'Nếu thành viên nhóm chứa các tên phân biệt, hãy chỉ định xem quá trình tìm kiếm người dùng có được thực hiện trong ngữ cảnh phụ hay không.';
$string['user_search_sub_key'] = 'Tìm kiếm các điều kiện phụ';
$string['user_settings'] = 'Cài đặt tra cứu người dùng';
$string['user_type'] = 'Nếu thành viên nhóm chứa các tên phân biệt, hãy chỉ định cách người dùng được lưu trữ trong LDAP';
$string['user_type_key'] = 'Loại người dùng';
$string['version'] = 'Phiên bản của giao thức LDAP mà máy chủ của bạn đang sử dụng';
$string['version_key'] = 'Phiên bản';
