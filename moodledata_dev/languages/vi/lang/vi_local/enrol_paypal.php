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
 * @subpackage paypal
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['assignrole'] = 'Chỉ định vai trò';
$string['businessemail'] = 'Email doanh nghiệp PayPal';
$string['businessemail_desc'] = 'Địa chỉ email của tài khoản PayPal doanh nghiệp của bạn';
$string['cost'] = 'Chi phí đăng ký';
$string['costerror'] = 'Chi phí ghi danh không phải là số';
$string['costorkey'] = 'Vui lòng chọn một trong các phương thức đăng ký sau.';
$string['currency'] = 'Tiền tệ';
$string['defaultrole'] = 'Phân công vai trò mặc định';
$string['defaultrole_desc'] = 'Chọn vai trò sẽ được chỉ định cho người dùng trong quá trình đăng ký PayPal';
$string['enrolenddate'] = 'Ngày cuối';
$string['enrolenddate_help'] = 'Nếu được bật, người dùng chỉ có thể đăng ký cho đến ngày này.';
$string['enrolenddaterror'] = 'Ngày kết thúc đăng ký không được sớm hơn ngày bắt đầu';
$string['enrolperiod'] = 'Thời hạn ghi danh';
$string['enrolperiod_desc'] = 'Khoảng thời gian mặc định mà đăng ký hợp lệ. Nếu được đặt thành 0, thời lượng đăng ký sẽ không giới hạn theo mặc định.';
$string['enrolperiod_help'] = 'Khoảng thời gian mà đăng ký hợp lệ, bắt đầu từ thời điểm người dùng được đăng ký. Nếu bị vô hiệu hóa, thời hạn đăng ký sẽ không giới hạn.';
$string['enrolstartdate'] = 'Ngày bắt đầu';
$string['enrolstartdate_help'] = 'Nếu được bật, người dùng chỉ có thể được đăng ký từ ngày này trở đi.';
$string['errdisabled'] = 'Plugin đăng ký PayPal bị vô hiệu hóa và không xử lý thông báo thanh toán.';
$string['erripninvalid'] = 'Thông báo thanh toán tức thì chưa được PayPal xác minh.';
$string['errpaypalconnect'] = 'Không thể kết nối với {$a->url} để xác minh thông báo thanh toán tức thì: {$a->result}';
$string['expiredaction'] = 'Hành động hết hạn đăng ký';
$string['expiredaction_help'] = 'Chọn hành động để thực hiện khi đăng ký người dùng hết hạn. Xin lưu ý rằng một số dữ liệu người dùng và cài đặt được xóa khỏi khóa học trong quá trình hủy đăng ký khóa học.';
$string['mailadmins'] = 'Thông báo cho quản trị viên';
$string['mailstudents'] = 'Thông báo cho sinh viên';
$string['mailteachers'] = 'Thông báo cho giáo viên';
$string['messageprovider:paypal_enrolment'] = 'Thông báo đăng ký PayPal';
$string['nocost'] = 'Không có chi phí liên quan đến đăng ký trong khóa học này!';
$string['paypal:config'] = 'Định cấu hình các phiên bản đăng ký PayPal';
$string['paypal:manage'] = 'Quản lý người dùng đã đăng ký';
$string['paypal:unenrol'] = 'Bỏ kiểm soát người dùng khỏi khóa học';
$string['paypal:unenrolself'] = 'Hủy kiểm soát bản thân khỏi khóa học';
$string['paypalaccepted'] = 'Thanh toán PayPal được chấp nhận';
$string['pluginname'] = 'PayPal';
$string['pluginname_desc'] = 'Mô-đun PayPal cho phép bạn thiết lập các khóa học trả phí. Nếu chi phí cho bất kỳ khóa học nào bằng 0, thì sinh viên không được yêu cầu trả tiền để nhập học. Có một 
chi phí trên toàn trang web mà bạn đặt ở đây làm mặc định cho toàn bộ trang web và sau đó là cài đặt khóa học mà bạn có thể đặt cho từng khóa học riêng lẻ. Chi phí khóa học ghi đè chi phí trang web.';
$string['privacy:metadata:enrol_paypal:enrol_paypal'] = 'Thông tin về các giao dịch PayPal để đăng ký PayPal.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:business'] = 'Địa chỉ email hoặc ID tài khoản PayPal của người nhận thanh toán (nghĩa là người bán).';
$string['privacy:metadata:enrol_paypal:enrol_paypal:courseid'] = 'ID của khóa học được bán.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:instanceid'] = 'ID của trường hợp đăng ký trong khóa học.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:item_name'] = 'Tên đầy đủ của khóa học đăng ký đã được bán.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:memo'] = 'Ghi chú do người mua nhập vào trường ghi chú thanh toán trên trang web PayPal.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:option_selection1_x'] = 'Họ và tên người mua.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:parent_txn_id'] = 'Trong trường hợp hoàn lại tiền, đảo ngược hoặc hủy bỏ, đây sẽ là ID giao dịch của giao dịch ban đầu.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:payment_status'] = 'Trạng thái của khoản thanh toán.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:payment_type'] = 'Giữ liệu khoản thanh toán đã được tài trợ bằng eCheck (echeck) hay được tài trợ bằng số dư PayPal, thẻ tín dụng hay chuyển khoản tức thì (tức thì).';
$string['privacy:metadata:enrol_paypal:enrol_paypal:pending_reason'] = 'Lý do tại sao trạng thái thanh toán đang chờ xử lý (nếu đó là).';
$string['privacy:metadata:enrol_paypal:enrol_paypal:reason_code'] = 'Lý do tại sao trạng thái thanh toán là Đảo ngược, Đã hoàn lại, Hủy_Đổi lại hoặc Bị từ chối (nếu trạng thái là một trong số chúng).';
$string['privacy:metadata:enrol_paypal:enrol_paypal:receiver_email'] = 'Địa chỉ email chính của người nhận thanh toán (nghĩa là người bán).';
$string['privacy:metadata:enrol_paypal:enrol_paypal:receiver_id'] = 'ID tài khoản PayPal duy nhất của người nhận thanh toán (tức là người bán).';
$string['privacy:metadata:enrol_paypal:enrol_paypal:tax'] = 'Số thuế tính khi thanh toán.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:timeupdated'] = 'Thời điểm Moodle được PayPal thông báo về việc thanh toán.';
$string['privacy:metadata:enrol_paypal:enrol_paypal:txn_id'] = 'Số nhận dạng giao dịch ban đầu của người bán cho khoản thanh toán từ người mua, mà trường hợp này đã được đăng ký';
$string['privacy:metadata:enrol_paypal:enrol_paypal:userid'] = 'ID của người dùng đã mua đăng ký khóa học.';
$string['privacy:metadata:enrol_paypal:paypal_com'] = 'Plugin đăng ký PayPal truyền dữ liệu người dùng từ Moodle đến trang web PayPal.';
$string['privacy:metadata:enrol_paypal:paypal_com:address'] = 'Địa chỉ của người dùng đang mua khóa học.';
$string['privacy:metadata:enrol_paypal:paypal_com:city'] = 'Thành phố của người dùng đang mua khóa học.';
$string['privacy:metadata:enrol_paypal:paypal_com:country'] = 'Quốc gia của người dùng đang mua khóa học.';
$string['privacy:metadata:enrol_paypal:paypal_com:custom'] = 'Một chuỗi được phân tách bằng dấu gạch nối chứa ID của người dùng (người mua), ID của khóa học, ID của phiên bản đăng ký.';
$string['privacy:metadata:enrol_paypal:paypal_com:email'] = 'Địa chỉ email của người dùng đang mua khóa học.';
$string['privacy:metadata:enrol_paypal:paypal_com:first_name'] = 'Tên của người dùng đang mua khóa học.';
$string['privacy:metadata:enrol_paypal:paypal_com:last_name'] = 'Họ của người dùng đang mua khóa học.';
$string['privacy:metadata:enrol_paypal:paypal_com:os0'] = 'Họ và tên người mua.';
$string['processexpirationstask'] = 'Đăng ký PayPal gửi tác vụ thông báo hết hạn';
$string['sendpaymentbutton'] = 'Gửi thanh toán qua PayPal';
$string['status'] = 'Cho phép đăng ký PayPal';
$string['status_desc'] = 'Cho phép người dùng sử dụng PayPal để đăng ký một khóa học theo mặc định.';
$string['transactions'] = 'Giao dịch PayPal';
$string['unenrolselfconfirm'] = 'Bạn có thực sự muốn hủy đăng ký tham gia khóa học "{$a}" không?';
