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
 * @subpackage manual
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['advanced'] = 'Nâng cao';
$string['alterstatus'] = 'Thay đổi trạng thái';
$string['altertimeend'] = 'Thay đổi thời gian kết thúc';
$string['altertimestart'] = 'Thay đổi thời gian bắt đầu';
$string['assignrole'] = 'Phân vai trò';
$string['assignroles'] = 'Chỉ định vai trò';
$string['browsecohorts'] = 'Duyệt qua các nhóm';
$string['browseusers'] = 'Duyệt qua người dùng';
$string['confirmbulkdeleteenrolment'] = 'Bạn có chắc chắn muốn xóa các đăng ký người dùng này không?';
$string['defaultperiod'] = 'Thời gian ghi danh mặc định';
$string['defaultperiod_desc'] = 'Khoảng thời gian mặc định mà đăng ký hợp lệ. Nếu được đặt thành 0, thời lượng đăng ký sẽ không giới hạn theo mặc định.';
$string['defaultperiod_help'] = 'Khoảng thời gian mặc định mà đăng ký hợp lệ, bắt đầu từ thời điểm người dùng được đăng ký. Nếu bị vô hiệu hóa, thời lượng đăng ký 
sẽ không giới hạn theo mặc định.';
$string['defaultstart'] = 'Bắt đầu đăng ký mặc định';
$string['deleteselectedusers'] = 'Xóa ghi danh người dùng đã chọn';
$string['editselectedusers'] = 'Chỉnh sửa ghi danh người dùng đã chọn';
$string['enrolusers'] = 'Ghi danh';
$string['enroluserscohorts'] = 'Ghi danh người dùng và nhóm đã chọn';
$string['expiredaction'] = 'Hành động hết hạn đăng ký';
$string['expiredaction_help'] = 'Chọn hành động để thực hiện khi đăng ký người dùng hết hạn. Xin lưu ý rằng một số dữ liệu người dùng và cài đặt được xóa khỏi khóa 
học trong quá trình hủy đăng ký khóa học.';
$string['expirymessageenrolledbody'] = 'Kính gửi {$a->user}, Đây là thông báo rằng đăng ký của bạn trong khóa học \'{$a->course}\' sẽ hết hạn vào {$a->timeend}. Nếu bạn cần trợ giúp, vui lòng liên hệ với {$a->register}.';
$string['expirymessageenrolledsubject'] = 'Thông báo hết hạn đăng ký';
$string['expirymessageenrollerbody'] = 'Đăng ký khóa học \'{$a->course}\' sẽ hết hạn trong {$a->threshold} tiếp theo cho những người dùng sau: {$a->users} Để gia hạn đăng
 ký của họ, hãy truy cập {$a->expandurl }';
$string['expirymessageenrollersubject'] = 'Thông báo hết hạn đăng ký';
$string['manual:config'] = 'Định cấu hình các phiên bản đăng ký thủ công';
$string['manual:enrol'] = 'Đăng ký người dùng';
$string['manual:manage'] = 'Quản lý đăng ký người dùng';
$string['manual:unenrol'] = 'Hủy quản lý người dùng khỏi khóa học';
$string['manual:unenrolself'] = 'Hủy đăng ký bản thân khỏi khóa học';
$string['manualpluginnotinstalled'] = 'Plugin "Thủ công" chưa được cài đặt';
$string['messageprovider:expiry_notification'] = 'Thông báo hết hạn đăng ký khóa học';
$string['now'] = 'Bây giờ';
$string['pluginname'] = 'Ghi danh thủ công';
$string['pluginname_desc'] = 'Plugin đăng ký thủ công cho phép người dùng đăng ký theo cách thủ công thông qua liên kết trong cài đặt quản trị khóa học, bởi người
 dùng có quyền thích hợp, chẳng hạn như giáo viên. Plugin thường phải được bật, vì một số plugin đăng ký khác, chẳng hạn như tự đăng ký, yêu cầu nó.';
$string['privacy:metadata'] = 'Plugin đăng ký thủ công không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['selectcohorts'] = 'Chọn nhóm';
$string['selection'] = 'Lựa chọn';
$string['selectusers'] = 'Chọn người dùng';
$string['sendexpirynotificationstask'] = 'Đăng ký thủ công gửi tác vụ thông báo hết hạn';
$string['status'] = 'Cho phép ghi danh thủ công';
$string['status_desc'] = 'Cho phép truy cập khóa học của người dùng đã đăng ký nội bộ. Điều này nên được kích hoạt trong hầu hết các trường hợp.';
$string['status_help'] = 'Cài đặt này xác định liệu người dùng có thể được đăng ký theo cách thủ công, thông qua liên kết trong cài đặt quản lý khóa học, bởi người dùng có quyền thích hợp như giáo viên hay không.';
$string['statusdisabled'] = 'Đã tắt';
$string['statusenabled'] = 'Đã bật';
$string['syncenrolmentstask'] = 'Đồng bộ hóa tác vụ đăng ký thủ công';
$string['unenrol'] = 'Hủy ghi danh người dùng';
$string['unenrolselectedusers'] = 'Hủy ghi danh những người dùng đã chọn';
$string['unenrolselfconfirm'] = 'Bạn có thực sự muốn hủy đăng ký tham gia khóa học "{$a}" không?';
$string['unenroluser'] = 'Bạn có thực sự muốn hủy đăng ký "{$a->user}" khỏi khóa học "{$a->course}" không?';
$string['unenrolusers'] = 'Hủy ghi danh người dùng';
$string['wscannotenrol'] = 'Phiên bản plugin không thể đăng ký thủ công người dùng trong khóa học id = {$a->courseid}';
$string['wsnoinstance'] = 'Phiên bản plugin đăng ký thủ công không tồn tại hoặc bị tắt cho khóa học (id = {$a->courseid})';
$string['wsusercannotassign'] = 'Bạn không có quyền chỉ định vai trò này ({$a->roleid}) cho người dùng này ({$a->userid}) trong khóa học này ({$a->courseid}).';
