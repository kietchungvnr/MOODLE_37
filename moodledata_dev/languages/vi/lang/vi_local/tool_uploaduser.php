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
 * @package    tool
 * @subpackage uploaduser
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowsuspends'] = 'Cho phép tạm ngừng và kích hoạt tài khoản';
$string['assignedsysrole'] = 'Vai trò hệ thống được chỉ định {$a}';
$string['csvdelimiter'] = 'Dấu phân cách CSV';
$string['errormnetadd'] = 'Không thể thêm người dùng từ xa';
$string['invalidtheme'] = 'Chủ đề "{$a}" chưa được cài đặt và sẽ bị bỏ qua.';
$string['invalidupdatetype'] = 'Không thể chọn tùy chọn này với loại tải lên đã chọn.';
$string['invaliduserdata'] = 'Dữ liệu không hợp lệ được phát hiện cho người dùng {$a} và dữ liệu đó đã được tự động xóa.';
$string['notheme'] = 'Không có chủ đề nào được xác định cho người dùng này.';
$string['pluginname'] = 'Người dùng tải lên';
$string['privacy:metadata'] = 'Người dùng tải plugin lên không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['requiredtemplate'] = 'Cần thiết. Bạn có thể sử dụng cú pháp mẫu tại đây (%l = lastname,%f = firstname,%u = username). Xem trợ giúp để biết chi tiết và ví dụ.';
$string['unassignedsysrole'] = 'Vai trò hệ thống chưa được chỉ định {$a}';
$string['uploadpicture_baduserfield'] = 'Thuộc tính người dùng được chỉ định không hợp lệ. Vui lòng thử lại.';
$string['uploadpicture_cannotmovezip'] = 'Không thể di chuyển tệp zip vào thư mục tạm thời.';
$string['uploadpicture_cannotprocessdir'] = 'Không thể xử lý các tệp đã giải nén.';
$string['uploadpicture_cannotsave'] = 'Không thể lưu ảnh cho người dùng {$a}. Kiểm tra tệp ảnh gốc.';
$string['uploadpicture_cannotunzip'] = 'Không thể giải nén tệp ảnh.';
$string['uploadpicture_invalidfilename'] = 'Tệp ảnh {$a} có các ký tự không hợp lệ trong tên của nó. Bỏ qua.';
$string['uploadpicture_overwrite'] = 'Ghi đè hình ảnh người dùng hiện có?';
$string['uploadpicture_userfield'] = 'Thuộc tính người dùng sử dụng để ghép ảnh:';
$string['uploadpicture_usernotfound'] = 'Người dùng có giá trị \'{$a->userfield}\' là \'{$a->uservalue}\' không tồn tại. Bỏ qua.';
$string['uploadpicture_userskipped'] = 'Đang bỏ qua người dùng {$a} (đã có ảnh).';
$string['uploadpicture_userupdated'] = 'Đã cập nhật hình ảnh cho người dùng {$a}.';
$string['uploadpictures'] = 'Tải ảnh người dùng';
$string['uploadpictures_help'] = 'Hình ảnh của người dùng có thể được tải lên dưới dạng tệp nén tệp hình ảnh. Các tệp hình ảnh phải được đặt tên là select-user-property.extension, ví dụ: user1234.jpg cho người dùng có tên người dùng user1234.';
$string['uploaduser:uploaduserpictures'] = 'Tải ảnh người dùng lên';
$string['uploadusers_help'] = 'Người dùng có thể được tải lên (và tùy chọn đăng ký các khóa học) qua tệp văn bản. Định dạng của tệp phải như sau: * Mỗi dòng của tệp chứa một bản ghi * Mỗi bản ghi là một chuỗi dữ liệu được phân tách bằng dấu phẩy (hoặc các dấu phân cách khác) * Bản ghi đầu tiên chứa danh sách các tên trường xác định định dạng của phần còn lại của tệp * Các tên trường bắt buộc là tên người dùng, mật khẩu, tên, họ, email';
$string['uploaduserspreview'] = 'Tải lên bản xem trước của người dùng';
$string['uploadusersresult'] = 'Tải lên kết quả của người dùng';
$string['useraccountuptodate'] = 'Người dùng cập nhật';
$string['usersweakpassword'] = 'Người dùng có mật khẩu yếu';
$string['userthemesnotallowed'] = 'Chủ đề người dùng không được bật, vì vậy bất kỳ chủ đề nào có trong tệp người dùng tải lên sẽ bị bỏ qua.';
$string['uubulk'] = 'Chọn cho hàng loạt hành động của người dùng';
$string['uulegacy1role'] = '(Sinh viên ban đầu) typeN= 1';
$string['uulegacy2role'] = '(Giáo viên gốc) typeN = 2';
$string['uulegacy3role'] = '(Giáo viên gốc không chỉnh sửa) typeN = 3';
$string['uunoemailduplicates'] = 'Ngăn trùng lặp địa chỉ email';
$string['uuoptype_addinc'] = 'Thêm tất cả, thêm số vào tên người dùng nếu cần';
$string['uuoptype_addnew'] = 'Chỉ thêm mới, bỏ qua người dùng hiện có';
$string['uuoptype_addupdate'] = 'Thêm mới và cập nhật người dùng hiện có';
$string['uuoptype_update'] = 'Chỉ cập nhật những người dùng hiện có';
$string['uupasswordcron'] = 'Được tạo bằng cron';
$string['uustandardusernames'] = 'Chuẩn hóa tên người dùng';
$string['uuupdateall'] = 'Ghi đè bằng tệp và mặc định';
$string['uuupdatefromfile'] = 'Ghi đè bằng tệp';
$string['uuupdatemissing'] = 'Điền vào phần còn thiếu trong tệp và mặc định';
$string['uuusernametemplate'] = 'Mẫu tên người dùng';
