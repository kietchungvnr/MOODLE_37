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
 * @subpackage lti
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowframeembedding'] = 'Lưu ý: Bạn nên bật cài đặt quản trị trang \'Cho phép nhúng khung\', để các công cụ được hiển thị trong khung thay vì trong cửa sổ mới.';
$string['authltimustbeenabled'] = 'Lưu ý: Plugin này cũng yêu cầu phải bật plugin xác thực LTI.';
$string['couldnotestablishproxy'] = 'Không thể thiết lập proxy với người dùng.';
$string['enrolenddate'] = 'Ngày kết thúc';
$string['enrolenddate_help'] = 'Nếu được bật, người dùng chỉ có thể truy cập cho đến ngày này.';
$string['enrolenddateerror'] = 'Ngày kết thúc đăng ký không được sớm hơn ngày bắt đầu';
$string['enrolisdisabled'] = 'Plugin \'Xuất bản dưới dạng công cụ LTI\' đã bị tắt.';
$string['enrolmentfinished'] = 'Đã đăng ký xong.';
$string['enrolmentnotstarted'] = 'Ghi danh chưa bắt đầu.';
$string['enrolperiod'] = 'Thời hạn ghi danh';
$string['enrolperiod_help'] = 'Khoảng thời gian mà đăng ký hợp lệ, bắt đầu từ thời điểm người dùng tự đăng ký từ hệ thống từ xa. Nếu bị vô hiệu hóa, thời lượng đăng ký sẽ không giới hạn.';
$string['enrolstartdate'] = 'Ngày bắt đầu';
$string['enrolstartdate_help'] = 'Nếu được bật, người dùng chỉ có thể truy cập từ ngày này trở đi.';
$string['failedrequest'] = 'Yêu cầu không thành công. Lý do: {$a->reason}';
$string['frameembeddingnotenabled'] = 'Để truy cập công cụ, vui lòng vào liên kết bên dưới.';
$string['gradesync'] = 'Đồng bộ lớp';
$string['gradesync_help'] = 'Điểm từ công cụ có được gửi đến hệ thống từ xa (người tiêu dùng LTI) hay không.';
$string['incorrecttoken'] = 'Mã thông báo không chính xác. Vui lòng kiểm tra URL và thử lại hoặc liên hệ với quản trị viên của công cụ này.';
$string['invalidrequest'] = 'Yêu cầu không hợp lệ';
$string['invalidtoolconsumer'] = 'Công cụ của người tiêu dùng không hợp lệ.';
$string['launchdetails'] = 'Chi tiết khởi chạy';
$string['launchdetails_help'] = 'Cần có URL catridge (còn được gọi là URL cấu hình) cùng với URL bí mật hoặc URL khởi chạy để định cấu hình công cụ';
$string['launchurl'] = 'Khời chạy URL';
$string['lti:config'] = 'Định cấu hình các phiên bản \'Xuất bản dưới dạng công cụ LTI';
$string['lti:unenrol'] = 'Hủy người dùng đăng ký khỏi khóa học';
$string['maxenrolled'] = 'Người dùng đã đăng ký tối đa';
$string['maxenrolled_help'] = 'Số lượng tối đa người dùng từ xa có thể truy cập công cụ. Nếu được đặt thành 0, số lượng người dùng đã đăng ký là không giới hạn';
$string['maxenrolledreached'] = 'Đã đạt đến số lượng tối đa người dùng từ xa được phép truy cập công cụ.';
$string['membersync'] = 'Đồng bộ người dùng';
$string['membersync_help'] = 'Liệu một tác vụ đã lên lịch có đồng bộ hóa người dùng đã đăng ký trong hệ thống từ xa với đăng ký trong khóa học này hay không, tạo tài khoản cho từng người dùng từ xa nếu cần và đăng ký hoặc hủy đăng ký họ theo yêu cầu. Nếu được đặt thành không, tại thời điểm người dùng từ xa truy cập vào công cụ, một tài khoản sẽ được tạo cho họ và họ sẽ tự động được đăng ký.';
$string['membersyncmode'] = 'Chế độ đồng bộ hóa người dùng';
$string['membersyncmode_help'] = 'Người dùng từ xa có nên đăng ký hoặc hủy đăng ký khóa học này hay không.';
$string['membersyncmodeenrolandunenrol'] = 'Đăng ký mới và bỏ đăng ký người dùng bị thiếu';
$string['membersyncmodeenrolnew'] = 'Đăng ký người dùng mới';
$string['membersyncmodeunenrolmissing'] = 'Hủy đăng ký người dùng bị thiếu';
$string['notoolsprovided'] = 'Không có công cụ được cung cấp';
$string['opentool'] = 'Mở công cụ';
$string['pluginname'] = 'Xuất bản dưới dạng công cụ LTI';
$string['pluginname_desc'] = 'Plugin \'Publish as LTI tool\', cùng với plugin xác thực LTI, cho phép người dùng từ xa truy cập các khóa học và hoạt động đã chọn. Nói cách khác, Moodle hoạt động như một nhà cung cấp công cụ LTI.';
$string['privacy:metadata:enrol_lti_users'] = 'Danh sách người dùng đã đăng ký qua nhà cung cấp LTI';
$string['privacy:metadata:enrol_lti_users:lastaccess'] = 'Thời điểm cuối cùng người dùng truy cập khóa học';
$string['privacy:metadata:enrol_lti_users:lastgrade'] = 'Điểmcuối cùng mà người dùng được ghi nhận';
$string['privacy:metadata:enrol_lti_users:timecreated'] = 'Thời gian khi người dùng đã đăng ký';
$string['privacy:metadata:enrol_lti_users:userid'] = 'ID của người dùng';
$string['registration'] = 'Công cụ đăng ký đã xuất bản';
$string['registrationurl'] = 'Đăng ký URl';
$string['registrationurl_help'] = 'Nếu sử dụng URL đăng ký (còn gọi là URL proxy), thì công cụ sẽ tự động được cấu hình.';
$string['remotesystem'] = 'Hệ thống từ xa';
$string['requirecompletion'] = 'Yêu cầu hoàn thành khóa học hoặc hoạt động trước khi đồng bộ hóa điểm';
$string['returnurlnotset'] = 'URL trả về không được đặt.';
$string['roleinstructor'] = 'Vai trò của giáo viên';
$string['roleinstructor_help'] = 'Vai trò được giao trong công cụ cho giáo viên từ xa';
$string['rolelearner'] = 'Vai trò của học viên';
$string['rolelearner_help'] = 'Vai trò được giao trong công cụ cho giáo viên từ xa';
$string['secret'] = 'Bí mật';
$string['secret_help'] = 'Một chuỗi ký tự được chia sẻ với hệ thống từ xa (người tiêu dùng LTI) để cung cấp quyền truy cập vào công cụ.';
$string['sharedexternaltools'] = 'Được xuất bản dưới dạng công cụ LTI';
$string['successfulregistration'] = 'Đăng ký thành công';
$string['tasksyncgrades'] = 'Xuất bản dưới dạng đồng bộ hóa cấp công cụ LTI';
$string['tasksyncmembers'] = 'Xuất bản dưới dạng người dùng đồng bộ hóa công cụ LTI';
$string['toolsprovided'] = 'Các công cụ đã xuất bản';
$string['toolsprovided_help'] = 'Một công cụ có thể được chia sẻ với trang web khác bằng cách cung cấp thông tin khởi chạy hoặc URL đăng ký.';
$string['tooltobeprovided'] = 'Công cụ được xuất bản';
$string['toolurl'] = 'Công cụ URL';
$string['userdefaultvalues'] = 'Giá trị mặc định của người dùng';
