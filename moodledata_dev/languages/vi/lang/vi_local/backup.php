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
 * @package    core
 * @subpackage backup
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['asyncbackupcomplete'] = 'Quá trình sao lưu đã hoàn thành';
$string['asyncbackupcompletebutton'] = 'Tiếp tục';
$string['asyncbackupcompletedetail'] = 'Quá trình sao lưu đã hoàn tất thành công. <br/> Bạn có thể truy cập bản sao lưu trên <a href="{$a}"> trang khôi phục. </a>';
$string['asyncbackuperror'] = 'Quá trình sao lưu không thành công';
$string['asyncbackuperrordetail'] = 'Quá trình sao lưu không thành công. Xin vui lòng liên hệ với quản trị hệ thống của bạn.';
$string['asyncbackuppending'] = 'Quá trình sao lưu đang chờ xử lý';
$string['asyncbackupprocessing'] = 'Đang sao lưu';
$string['asyncbadexecution'] = 'Thực thi bộ điều khiển sao lưu không hợp lệ. Nó là {$a} và phải là 2.';
$string['asynccheckprogress'] = 'Bạn có thể kiểm tra tiến trình bất kỳ lúc nào trên <a href="{$a}"> trang khôi phục </a>.';
$string['asyncemailenable'] = 'Bật thông báo tin nhắn';
$string['asyncemailenabledetail'] = 'Nếu được bật, người dùng sẽ nhận được thông báo khi quá trình sao lưu hoặc khôi phục không đồng bộ hoàn tất.';
$string['asyncgeneralsettings'] = 'Sao lưu / khôi phục không đồng bộ';
$string['asyncmessagebody'] = 'Thông điệp';
$string['asyncmessagebodydefault'] = 'Xin chào {user_firstname}! <br/> {Operation} (ID: {backupid}) của bạn đã hoàn tất thành công. <br/> <br/> Bạn có thể truy cập tại đây: {link}.';
$string['asyncmessagebodydetail'] = 'Tin nhắn để gửi khi sao lưu hoặc khôi phục không đồng bộ hoàn tất.';
$string['asyncmessagesubject'] = 'Môn học';
$string['asyncmessagesubjectdefault'] = 'Moodle {operation} đã hoàn tất thành công';
$string['asyncmessagesubjectdetail'] = 'Chủ đề tin nhắn';
$string['asyncnowait'] = 'Bạn không cần phải đợi ở đây vì quá trình này sẽ tiếp tục trong nền.';
$string['asyncprocesspending'] = 'Đang chờ xử lý';
$string['asyncrestorecomplete'] = 'Quá trình khôi phục đã hoàn thành';
$string['asyncrestorecompletebutton'] = 'Tiếp tục';
$string['asyncrestorecompletedetail'] = 'Quá trình khôi phục đã hoàn tất thành công. Nhấp vào tiếp tục sẽ đưa bạn đến <a href="{$a}"> khóa học dành cho mục đã khôi phục. </a>';
$string['asyncrestoreerror'] = 'Quá trình khôi phục không thành công';
$string['asyncrestoreerrordetail'] = 'Quá trình khôi phục không thành công. Xin vui lòng liên hệ với quản trị hệ thống của bạn.';
$string['asyncrestoreinprogress'] = 'Đang khôi phục';
$string['asyncrestoreinprogress_help'] = 'Quá trình khôi phục khóa học không đồng bộ đang được hiển thị ở đây.';
$string['asyncrestorepending'] = 'Quá trình khôi phục đang chờ xử lý';
$string['asyncrestoreprocessing'] = 'Đang khôi phục';
$string['asyncreturn'] = 'Trở lại khóa học';
$string['automateddeletedays'] = 'Xóa các bản sao lưu cũ hơn';
$string['automatedmaxkept'] = 'Số lượng bản sao lưu tối đa được giữ';
$string['automatedmaxkepthelp'] = 'Điều này chỉ định số lượng tối đa các bản sao lưu tự động gần đây sẽ được giữ cho mỗi khóa học. Các bản sao lưu cũ hơn sẽ tự động bị xóa.';
$string['automatedminkept'] = 'Số lượng bản sao lưu tối thiểu được giữ';
$string['automatedminkepthelp'] = 'Nếu các bản sao lưu cũ hơn một số ngày cụ thể bị xóa, có thể xảy ra trường hợp khóa học không hoạt động kết thúc mà không có bản sao lưu. Để ngăn chặn điều này, cần chỉ định số lượng bản sao lưu tối thiểu được lưu giữ.';
$string['backupformatimscc1'] = 'IMS Common Cartridge 1.0';
$string['backupformatimscc11'] = 'IMS Common Cartridge 1.1';
$string['backupformatmoodle1'] = 'Moodle 1';
$string['backupformatmoodle2'] = 'Moodle 2';
$string['backupmode30'] = 'Hub';
$string['backupmode70'] = 'Không đồng bộ';
$string['config_keep_groups_and_groupings'] = 'Theo mặc định, giữ các nhóm và nhóm hiện tại.';
$string['config_keep_roles_and_enrolments'] = 'Theo mặc định, giữ các vai trò và đăng ký hiện tại.';
$string['config_overwrite_conf'] = 'Cho phép người dùng ghi đè cấu hình khóa học hiện tại';
$string['config_overwrite_course_fullname'] = 'Theo mặc định ghi đè tên đầy đủ của khóa học bằng tên từ tệp sao lưu. Điều này yêu cầu "Ghi đè cấu hình khóa học" phải được kiểm tra và người dùng hiện tại có khả năng thay đổi tên đầy đủ của khóa học (moodle / course: changefullname)';
$string['config_overwrite_course_shortname'] = 'Theo mặc định ghi đè tên ngắn của khóa học bằng tên từ tệp sao lưu. Điều này yêu cầu "Ghi đè cấu hình khóa học" phải được kiểm tra và người dùng hiện tại có khả năng thay đổi tên ngắn của khóa học (moodle / course: changeshortname)';
$string['config_overwrite_course_startdate'] = 'Theo mặc định ghi đè ngày bắt đầu khóa học bằng ngày bắt đầu từ tệp sao lưu. Điều này yêu cầu "Ghi đè cấu hình khóa học" phải được kiểm tra và người dùng hiện tại có khả năng đưa ngày khóa học vào khôi phục (moodle / restore: rolldates)';
$string['configgeneralcalendarevents'] = 'Đặt mặc định để bao gồm các sự kiện lịch trong bản sao lưu.';
$string['configgeneralcompetencies'] = 'Đặt mặc định để bao gồm các năng lực trong một bản sao lưu.';
$string['configrestoreactivities'] = 'Đặt mặc định để khôi phục hoạt động.';
$string['configrestorebadges'] = 'Đặt mặc định để khôi phục huy hiệu.';
$string['configrestoreblocks'] = 'Đặt mặc định để khôi phục khối.';
$string['configrestorecalendarevents'] = 'Đặt mặc định để khôi phục các sự kiện lịch.';
$string['configrestorecomments'] = 'Đặt mặc định để khôi phục nhận xét.';
$string['configrestorecompetencies'] = 'Đặt giá trị mặc định để khôi phục năng lực.';
$string['configrestoreenrolments'] = 'Đặt mặc định để khôi phục phương thức đăng ký.';
$string['configrestorefilters'] = 'Đặt mặc định để khôi phục bộ lọc.';
$string['configrestoregroups'] = 'Đặt mặc định để khôi phục nhóm và nhóm nếu chúng được đưa vào bản sao lưu.';
$string['configrestorehistories'] = 'Đặt mặc định để khôi phục lịch sử người dùng nếu lịch sử đó được đưa vào bản sao lưu.';
$string['configrestorelogs'] = 'Nếu được bật, nhật ký sẽ được khôi phục theo mặc định nếu chúng được đưa vào bản sao lưu.';
$string['configrestoreroleassignments'] = 'Nếu được bật theo mặc định, các nhiệm vụ sẽ được khôi phục nếu chúng được đưa vào bản sao lưu.';
$string['configrestoreusers'] = 'Đặt mặc định cho việc có khôi phục người dùng nếu họ được đưa vào bản sao lưu hay không.';
$string['configrestoreuserscompletion'] = 'Nếu được bật, thông tin hoàn thành của người dùng sẽ được khôi phục theo mặc định nếu nó được đưa vào bản sao lưu.';
$string['confirmcancelimport'] = 'Hủy nhập';
$string['confirmcancelrestore'] = 'Hủy khôi phục';
$string['enableasyncbackup'] = 'Bật sao lưu không đồng bộ';
$string['enableasyncbackup_help'] = 'Nếu được bật, tất cả các hoạt động sao lưu và khôi phục sẽ được thực hiện không đồng bộ. Điều này không ảnh hưởng đến xuất nhập khẩu. Sao lưu và khôi phục không đồng bộ cho phép người dùng thực hiện các thao tác khác trong khi sao lưu hoặc khôi phục đang diễn ra.';
$string['errorcopyingbackupfile'] = 'Không sao chép được tệp sao lưu vào thư mục tạm thời trước khi khôi phục.';
$string['errorfilenametoolong'] = 'Tên tệp phải có độ dài dưới 255 ký tự.';
$string['failed'] = 'Sao lưu không thành công';
$string['generalcalendarevents'] = 'Bao gồm các sự kiện lịch';
$string['generalcompetencies'] = 'Bao gồm các năng lực';
$string['generalenrolments'] = 'Bao gồm các phương thức tuyển sinh';
$string['generalrestoredefaults'] = 'Mặc định khôi phục chung';
$string['generalrestoresettings'] = 'Cài đặt khôi phục chung';
$string['importgeneralduplicateadminallowed'] = 'Cho phép giải quyết xung đột quản trị viên';
$string['importgeneralduplicateadminallowed_desc'] = 'Nếu trang web có tài khoản với tên người dùng \'admin\', thì việc cố gắng khôi phục tệp sao lưu chứa tài khoản có tên người dùng \'admin\' có thể gây ra xung đột. Nếu cài đặt này được bật, xung đột sẽ được giải quyết bằng cách thay đổi tên người dùng trong tệp sao lưu thành \'admin_xyz\'.';
$string['importrootsettings'] = 'Nhập cài đặt';
$string['importsettings'] = 'Cài đặt nhập chung';
$string['inprogress'] = 'Đang sao lưu';
$string['keep'] = 'Giữ';
$string['mergerestoredefaults'] = 'Khôi phục mặc định khi hợp nhất vào một khóa học khác';
$string['overwrite'] = 'Ghi đè';
$string['pendingasyncdeletedetail'] = 'Khóa học này có một bản sao lưu không đồng bộ đang chờ xử lý. <br/> Không thể xóa các khóa học cho đến khi quá trình sao lưu này kết thúc.';
$string['pendingasyncdetail'] = 'Sao lưu không đồng bộ chỉ cho phép người dùng có một bản sao lưu đang chờ xử lý cho một tài nguyên tại một thời điểm. <br/> Không thể xếp hàng đợi nhiều bản sao lưu không đồng bộ của cùng một tài nguyên, vì điều này có thể dẫn đến nhiều bản sao lưu có cùng nội dung.';
$string['pendingasyncedit'] = 'Có một bản sao lưu không đồng bộ đang chờ xử lý cho khóa học này. Vui lòng không chỉnh sửa khóa học này cho đến khi sao lưu hoàn tất.';
$string['pendingasyncerror'] = 'Bản sao lưu đang chờ xử lý cho tài nguyên này';
$string['privacy:metadata:backup:detailsofarchive'] = 'Kho lưu trữ này có thể chứa nhiều dữ liệu người dùng khác nhau liên quan đến một khóa học, chẳng hạn như điểm, đăng ký người dùng và dữ liệu hoạt động.';
$string['privacy:metadata:backup:externalpurpose'] = 'Mục đích của kho lưu trữ này là để lưu trữ thông tin liên quan đến một khóa học, có thể được khôi phục trong tương lai.';
$string['privacy:metadata:backup_controllers'] = 'Danh sách các hoạt động sao lưu';
$string['privacy:metadata:backup_controllers:itemid'] = 'ID của khóa học';
$string['privacy:metadata:backup_controllers:operation'] = 'Thao tác đã được thực hiện, ví dụ: khôi phục lại.';
$string['privacy:metadata:backup_controllers:timecreated'] = 'Thời điểm hành động được tạo';
$string['privacy:metadata:backup_controllers:timemodified'] = 'Thời điểm hành động được sửa đổi';
$string['privacy:metadata:backup_controllers:type'] = 'Loại vật phẩm đang được vận hành, ví dụ. Hoạt động.';
$string['recyclebin_desc'] = 'Lưu ý rằng các cài đặt này cũng sẽ được sử dụng cho thùng rác.';
$string['replacerestoredefaults'] = 'Khôi phục mặc định khi khôi phục vào khóa học khác xóa nội dung';
$string['rootsettingcompetencies'] = 'Bao gồm các năng lực';
$string['rootsettingcustomfield'] = 'Bao gồm các trường tùy chỉnh';
$string['rootsettingenrolments'] = 'Bao gồm các phương thức tuyển sinh';
$string['rootsettingenrolments_always'] = 'Vâng, luôn luôn';
$string['rootsettingenrolments_never'] = 'Không, khôi phục người dùng dưới dạng đăng ký thủ công';
$string['rootsettingenrolments_withusers'] = 'Có, nhưng chỉ khi người dùng được bao gồm';
$string['setting_overwrite_conf'] = 'Ghi đè cấu hình khóa học';
$string['setting_overwrite_course_fullname'] = 'Ghi đè tên đầy đủ của khóa học';
$string['setting_overwrite_course_shortname'] = 'Ghi đè tên ngắn của khóa học';
$string['setting_overwrite_course_startdate'] = 'Ghi đè ngày bắt đầu khóa học';
$string['status'] = 'Trạng thái';
$string['successful'] = 'Sao lưu thành công';
$string['successfulrestore'] = 'Khôi phục thành công';
$string['undefinedrolemapping'] = 'Ánh xạ vai trò chưa được xác định cho kiểu mẫu \'{$a}\'.';
