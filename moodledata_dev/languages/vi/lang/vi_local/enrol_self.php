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
 * @subpackage self
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['canntenrol'] = 'Đăng ký bị vô hiệu hóa hoặc không hoạt động';
$string['canntenrolearly'] = 'Bạn chưa thể đăng ký; đăng ký bắt đầu vào {$a}.';
$string['canntenrollate'] = 'Bạn không thể đăng ký nữa vì đăng ký đã kết thúc vào {$a}.';
$string['cohortnonmemberinfo'] = 'Chỉ thành viên của nhóm thuần tập \'{$a}\' mới có thể tự đăng ký.';
$string['cohortonly'] = 'Chỉ có thành viên nhóm';
$string['cohortonly_help'] = 'Chỉ có thể giới hạn tự đăng ký cho các thành viên của một nhóm được chỉ định. Lưu ý rằng việc thay đổi cài đặt này không ảnh hưởng đến các đăng ký hiện có.';
$string['confirmbulkdeleteenrolment'] = 'Bạn có chắc chắn muốn xóa các đăng ký người dùng này không?';
$string['customwelcomemessage'] = 'Thư chào mừng tùy chỉnh';
$string['customwelcomemessage_help'] = 'Thông báo chào mừng tùy chỉnh có thể được thêm dưới dạng văn bản thuần túy hoặc định dạng Moodle-auto, bao gồm các thẻ HTML và thẻ nhiều ngôn ngữ. Các phần giữ chỗ sau có thể được đưa vào thư: * Tên khóa học {$a->coursename} * Liên kết đến trang tiểu sử của người dùng {$a->profileurl} * Email của người dùng {$a->email} * Tên đầy đủ của người dùng {$a->fullname}';
$string['defaultrole'] = 'Phân công vai trò mặc định';
$string['defaultrole_desc'] = 'Chọn vai trò sẽ được chỉ định cho người dùng trong quá trình tự đăng ký';
$string['deleteselectedusers'] = 'Xóa ghi danh người dùng đã chọn';
$string['editselectedusers'] = 'Chỉnh sửa ghi danh người dùng đã chọn';
$string['enrolenddate_help'] = 'Nếu được bật, người dùng chỉ có thể tự đăng ký cho đến ngày này.';
$string['enrolme'] = 'Ghi danh';
$string['enrolperiod'] = 'Thời gian ghi danh';
$string['enrolperiod_desc'] = 'Khoảng thời gian mặc định mà đăng ký hợp lệ. Nếu được đặt thành 0, thời lượng đăng ký sẽ không giới hạn theo mặc định.';
$string['enrolperiod_help'] = 'Khoảng thời gian mà đăng ký hợp lệ, bắt đầu từ thời điểm người dùng tự đăng ký. Nếu bị vô hiệu hóa, thời hạn đăng ký sẽ không giới hạn.';
$string['enrolstartdate_help'] = 'Nếu được bật, người dùng chỉ có thể tự đăng ký từ ngày này trở đi.';
$string['expiredaction'] = 'Hành động hết hạn đăng ký';
$string['expiredaction_help'] = 'Chọn hành động để thực hiện khi đăng ký người dùng hết hạn. Xin lưu ý rằng một số dữ liệu người dùng và cài đặt được xóa khỏi khóa học trong quá trình hủy đăng ký khóa học.';
$string['expirymessageenrolledbody'] = 'Kính gửi {$a->user}, Đây là thông báo rằng đăng ký tham gia khóa học \'{$a->course}\' của bạn sẽ hết hạn vào {$a->timeend}. Nếu bạn cần trợ giúp, vui lòng liên hệ với {$a-
>register}.';
$string['expirymessageenrolledsubject'] = 'Thông báo hết hạn tự đăng ký';
$string['expirymessageenrollerbody'] = 'Việc tự đăng ký khóa học \'{$a->course}\' sẽ hết hạn trong {$a->threshold} tiếp theo cho những người dùng sau: {$a->users} Để gia hạn đăng ký của họ, hãy truy cập {$a->extensionurl}';
$string['expirymessageenrollersubject'] = 'Thông báo hết hạn đăng ký tự đăng ký';
$string['groupkey'] = 'Sử dụng mã ghi danh nhóm';
$string['groupkey_desc'] = 'Sử dụng các khóa đăng ký nhóm theo mặc định.';
$string['groupkey_help'] = 'Ngoài việc giới hạn quyền truy cập vào khóa học chỉ cho những người biết khóa, việc sử dụng khóa đăng ký nhóm có nghĩa là người dùng được tự động thêm vào nhóm khi họ đăng ký khóa học. Lưu ý: Khóa đăng ký cho khóa học phải được chỉ định trong cài đặt tự đăng ký cũng như khóa đăng ký nhóm trong cài đặt nhóm.';
$string['keyholder'] = 'Bạn sẽ nhận được khóa đăng ký này từ:';
$string['longtimenosee'] = 'Hủy đăng ký ghi danh sau';
$string['longtimenosee_help'] = 'Nếu người dùng không truy cập vào một khóa học trong một thời gian dài, thì họ sẽ tự động bị hủy đăng ký. Tham số này chỉ định giới hạn thời gian đó.';
$string['maxenrolled'] = 'Người dùng đăng ký tối đa';
$string['maxenrolled_help'] = 'Chỉ định số lượng người dùng tối đa có thể tự đăng ký. 0 có nghĩa là không có giới hạn.';
$string['maxenrolledreached'] = 'Đã đạt đến số lượng người dùng được phép tự đăng ký tối đa.';
$string['messageprovider:expiry_notification'] = 'Thông báo hết hạn đăng ký theo phương thức nhập mã';
$string['newenrols'] = 'Cho phép ghi danh mới';
$string['newenrols_desc'] = 'Cho phép người dùng tự đăng ký các khóa học mới theo mặc định.';
$string['newenrols_help'] = 'Cài đặt này xác định liệu người dùng có thể đăng ký vào khóa học này hay không.';
$string['nopassword'] = 'Không yêu cầu mã đăng ký ghi danh';
$string['password'] = 'Mã ghi danh';
$string['password_help'] = 'Khóa ghi danh cho phép chỉ những người biết khóa mới có thể truy cập vào khóa học. Nếu trường để trống, bất kỳ người dùng nào cũng có thể đăng ký khóa học. Nếu một khóa đăng ký được chỉ định, bất kỳ người dùng nào cố gắng đăng ký vào khóa học sẽ được yêu cầu cung cấp khóa. Lưu ý rằng người dùng chỉ cần cung cấp khóa đăng ký MỘT LẦN, khi họ đăng ký khóa học.';
$string['passwordinvalid'] = 'Đăng ký khóa học không chính xác, vui lòng thử lại';
$string['pluginname'] = 'Tự ghi danh';
$string['pluginname_desc'] = 'Plugin tự đăng ký cho phép người dùng chọn các khóa học mà họ muốn tham gia. Các khóa học có thể được bảo vệ bằng khóa đăng ký. Nội bộ đăng ký được thực hiện thông 
qua plugin đăng ký thủ công phải được bật trong cùng một khóa học.';
$string['privacy:metadata'] = 'Plugin Tự đăng ký không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['requirepassword'] = 'Yêu cầu đăng ký khóa học';
$string['requirepassword_desc'] = 'Yêu cầu đăng ký  trong các khóa học mới và ngăn chặn việc xóa khóa đăng ký khỏi các khóa học hiện có.';
$string['role'] = 'Vai trò được gán mặc định';
$string['self:config'] = 'Cấu hình các phiên bản tự đăng ký';
$string['self:holdkey'] = 'Xuất hiện dưới dạng người giữ khóa tự đăng ký';
$string['self:manage'] = 'Quản lý người dùng đã đăng ký';
$string['self:unenrol'] = 'Bỏ kiểm soát người dùng khỏi khóa học';
$string['self:unenrolself'] = 'Hủy kiểm soát bản thân khỏi khóa học';
$string['sendcoursewelcomemessage_help'] = 'Khi người dùng tự đăng ký tham gia khóa học, họ có thể nhận được email thông báo chào mừng. Nếu được gửi từ người liên hệ trong khóa học (theo mặc định là giáo viên) và nhiều người dùng có vai trò này, thì email sẽ được gửi từ người dùng đầu tiên được chỉ định vai trò.';
$string['sendexpirynotificationstask'] = 'Tự đăng ký gửi tác vụ thông báo hết hạn';
$string['showhint'] = 'Hiển thị gợi ý';
$string['showhint_desc'] = 'Hiển thị chữ cái đầu tiên của khóa truy cập khách.';
$string['status'] = 'Cho phép ghi danh hiện có';
$string['status_desc'] = 'Bật phương thức tự đăng ký trong các khóa học mới.';
$string['status_help'] = 'Nếu được bật cùng với \'Cho phép đăng ký mới\' bị tắt, chỉ những người dùng đã tự đăng ký trước đó mới có thể truy cập khóa học. Nếu bị vô hiệu hóa, phương pháp tự đăng ký này sẽ bị vô hiệu hóa hiệu quả, vì tất cả các đăng ký tự hiện có đều bị tạm ngưng và người dùng mới không thể tự đăng ký.';
$string['syncenrolmentstask'] = 'Đồng bộ hóa nhiệm vụ tự đăng ký';
$string['unenrol'] = 'Hủy đăng ký người dùng';
$string['unenrolselfconfirm'] = 'Bạn có thực sự muốn hủy đăng ký tham gia khóa học "{$a}" không?';
$string['unenroluser'] = 'Bạn có thực sự muốn hủy đăng ký "{$a->user}" khỏi khóa học "{$a->course}" không?';
$string['unenrolusers'] = 'Hủy đăng ký người dùng';
$string['usepasswordpolicy'] = 'Sử dụng chính sách mật khẩu';
$string['usepasswordpolicy_desc'] = 'Sử dụng chính sách mật khẩu tiêu chuẩn cho các khóa đăng ký.';
