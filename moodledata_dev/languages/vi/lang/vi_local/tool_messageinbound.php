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
 * @subpackage messageinbound
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['classname'] = 'Tên lớp';
$string['component'] = 'Thành phần';
$string['configmessageinboundhost'] = 'Địa chỉ của máy chủ mà Moodle nên kiểm tra thư. Để chỉ định một cổng không phải mặc định, hãy sử dụng [máy chủ]: [cổng], ví dụ: mail.example.com:587. Nếu một cổng không được chỉ định, cổng mặc định cho loại máy chủ thư sẽ được sử dụng.';
$string['defaultexpiration'] = 'Thời gian hết hạn địa chỉ mặc định';
$string['defaultexpiration_help'] = 'Khi trình xử lý tạo địa chỉ email, địa chỉ này có thể được đặt thành tự động hết hạn sau một khoảng thời gian, do đó không thể sử dụng được nữa. Nên đặt thời hạn sử dụng.';
$string['description'] = 'Miêu tả';
$string['domain'] = 'Miền email';
$string['edit'] = 'Biên tập';
$string['edithandler'] = 'Chỉnh sửa cài đặt cho trình xử lý {$a}';
$string['editinghandler'] = 'Chỉnh sửa {$a}';
$string['enabled'] = 'Đã bật';
$string['fixedenabled_help'] = 'Bạn không thể thay đổi trạng thái của trình xử lý này. Điều này có thể là do trình xử lý được yêu cầu bởi các trình xử lý khác.';
$string['fixedvalidateaddress'] = 'Xác thực địa chỉ người gửi';
$string['fixedvalidateaddress_help'] = 'Bạn không thể thay đổi xác thực địa chỉ cho trình xử lý này. Điều này có thể là do trình xử lý yêu cầu một cài đặt cụ thể.';
$string['handlerdisabled'] = 'Trình xử lý email mà bạn cố gắng liên hệ đã bị vô hiệu hóa. Không thể xử lý tin nhắn vào lúc này.';
$string['incomingmailconfiguration'] = 'Cấu hình thư đến';
$string['incomingmailserversettings'] = 'Cài đặt máy chủ thư đến';
$string['incomingmailserversettings_desc'] = 'Moodle có khả năng kết nối với các máy chủ IMAP được cấu hình thích hợp. Bạn có thể chỉ định cài đặt được sử dụng để kết nối với máy chủ IMAP của mình tại đây.';
$string['invalid_recipient_handler'] = 'Nếu nhận được thư hợp lệ nhưng không thể xác thực được người gửi, thư sẽ được lưu trữ trên máy chủ email và người dùng được liên hệ bằng địa chỉ email trong hồ sơ người dùng của họ. Người dùng có cơ hội trả lời để xác nhận tính xác thực của tin nhắn gốc. Trình xử lý này xử lý các câu trả lời đó. Không thể tắt xác minh người gửi của trình xử lý này vì người dùng có thể trả lời từ một địa chỉ email không chính xác nếu cấu hình ứng dụng email của họ không chính xác.';
$string['invalid_recipient_handler_name'] = 'Trình xử lý người gửi không hợp lệ';
$string['invalidrecipientdescription'] = 'Không thể xác thực thông báo "{$a->subject}" vì nó được gửi từ một địa chỉ email khác với trong hồ sơ người dùng của bạn. Để tin nhắn được xác thực, bạn cần trả lời tin nhắn này.';
$string['invalidrecipientdescriptionhtml'] = 'Không thể xác thực thông báo "{$a->subject}" vì nó được gửi từ một địa chỉ email khác với trong hồ sơ người dùng của bạn. Để tin nhắn được xác thực, bạn cần trả lời tin nhắn này.';
$string['invalidrecipientfinal'] = 'Không thể xác thực thông báo "{$a->subject}". Vui lòng kiểm tra xem bạn có đang gửi thư từ cùng một địa chỉ email như trong hồ sơ của bạn không.';
$string['mailbox'] = 'Tên hộp thư';
$string['mailboxconfiguration'] = 'Cấu hình hộp thư';
$string['mailboxdescription'] = '[hộp thư] + địa chỉ phụ @[miền]';
$string['mailsettings'] = 'Cài đặt thư';
$string['message_handlers'] = 'Trình xử lý tin nhắn';
$string['messageinbound'] = 'Thư đến';
$string['messageinboundenabled'] = 'Bật xử lý thư đến';
$string['messageinboundenabled_desc'] = 'Xử lý thư đến phải được kích hoạt để gửi thư với thông tin thích hợp.';
$string['messageinboundgeneralconfiguration'] = 'Cấu hình chung';
$string['messageinboundgeneralconfiguration_desc'] = 'Xử lý thư đến cho phép bạn nhận và xử lý email trong Moodle. Điều này có các ứng dụng như gửi email trả lời cho các bài đăng trên diễn đàn hoặc thêm tệp vào tệp riêng tư của người dùng.';
$string['messageinboundhost'] = 'Máy chủ thư đến';
$string['messageinboundhostpass'] = 'Mật khẩu';
$string['messageinboundhostpass_desc'] = 'Đây là mật khẩu mà nhà cung cấp dịch vụ của bạn sẽ cung cấp để đăng nhập vào tài khoản email của bạn.';
$string['messageinboundhostssl'] = 'Sử dụng SSL';
$string['messageinboundhostssl_desc'] = 'Một số máy chủ thư hỗ trợ mức độ bảo mật bổ sung bằng cách mã hóa giao tiếp giữa Moodle và máy chủ của bạn. Chúng tôi khuyên bạn nên sử dụng mã hóa SSL này nếu máy chủ của bạn hỗ trợ nó.';
$string['messageinboundhosttype'] = 'Loại máy chủ';
$string['messageinboundhostuser'] = 'Tên tài khoản';
$string['messageinboundhostuser_desc'] = 'Đây là tên người dùng mà nhà cung cấp dịch vụ của bạn sẽ cung cấp để đăng nhập vào tài khoản email của bạn.';
$string['messageinboundmailboxconfiguration_desc'] = 'Khi thư được gửi đi, chúng sẽ phù hợp với định dạng address+data@example.com. Để tạo địa chỉ đáng tin cậy từ Moodle, vui lòng chỉ định địa chỉ mà bạn thường sử dụng trước dấu @ và miền sau dấu @ riêng biệt. Ví dụ, tên Hộp thư trong ví dụ sẽ là "địa chỉ" và miền E-mail sẽ là "example.com". Bạn nên sử dụng tài khoản e-mail chuyên dụng cho mục đích này.';
$string['messageprocessingerror'] = 'Gần đây, bạn đã gửi một email "{$a->subject}" nhưng rất tiếc không thể xử lý được. Chi tiết về lỗi được hiển thị bên dưới. {$a->error}';
$string['messageprocessingerrorhtml'] = '<p>Gần đây, bạn đã gửi một email "{$a->subject}" nhưng rất tiếc không thể xử lý được.</p> <p>Chi tiết về lỗi được hiển thị bên dưới. </p> <p> {$a->error}</p>';
$string['messageprocessingfailed'] = 'Không thể xử lý email "{$a->subject}". Lỗi như sau: "{$a->message}".';
$string['messageprocessingfailedunknown'] = 'Không thể xử lý email "{$a->subject}". Liên hệ với quản trị viên của bạn để biết thêm thông tin.';
$string['messageprocessingsuccess'] = '{$a->plain} Nếu bạn không muốn nhận những thông báo này trong tương lai, bạn có thể chỉnh sửa tùy chọn nhắn tin cá nhân của mình bằng cách mở {$a->messagepreferencesurl} trong trình duyệt của bạn.';
$string['messageprocessingsuccesshtml'] = '{$a->html} <p>Nếu không muốn nhận những thông báo này trong tương lai, bạn có thể <a href="{$a->messagepreferencesurl}"> chỉnh sửa tùy chọn nhắn tin cá nhân của mình </a>.< / p>';
$string['messageprovider:invalidrecipienthandler'] = 'Tin nhắn để xác nhận rằng có một tin nhắn đến là từ bạn';
$string['messageprovider:messageprocessingerror'] = 'Cảnh báo khi không thể xử lý tin nhắn đến';
$string['messageprovider:messageprocessingsuccess'] = 'Xác nhận rằng một tin nhắn đã được xử lý thành công';
$string['name'] = 'Tên';
$string['noencryption'] = 'Tắt - Không mã hóa';
$string['noexpiry'] = 'Không hết hạn';
$string['oldmessagenotfound'] = 'Bạn đã cố gắng xác thực một tin nhắn theo cách thủ công nhưng không thể tìm thấy tin nhắn. Điều này có thể là do nó đã được xử lý hoặc vì tin nhắn đã hết hạn.';
$string['oneday'] = 'Một ngày';
$string['onehour'] = 'Một giờ';
$string['oneweek'] = 'Một tuần';
$string['oneyear'] = 'Một năm';
$string['pluginname'] = 'Cấu hình tin nhắn đến';
$string['privacy:metadata:coreuserkey'] = 'Chìa khóa của người dùng để xác thực email đã nhận';
$string['privacy:metadata:messagelist'] = 'Danh sách các số nhận dạng thư không xác thực được và yêu cầu ủy quyền thêm';
$string['privacy:metadata:messagelist:address'] = 'Địa chỉ nơi email đã được gửi';
$string['privacy:metadata:messagelist:messageid'] = 'ID tin nhắn';
$string['privacy:metadata:messagelist:timecreated'] = 'Thời điểm kỷ lục được lập';
$string['privacy:metadata:messagelist:userid'] = 'ID của người dùng cần phê duyệt tin nhắn';
$string['replysubjectprefix'] = 'Re:';
$string['requirevalidation'] = 'Xác thực địa chỉ người gửi';
$string['ssl'] = 'SSL (Phiên bản SSL tự động phát hiện)';
$string['sslv2'] = 'SSLv2 (Bắt buộc SSL phiên bản 2)';
$string['sslv3'] = 'SSLv3 (Bắt buộc SSL phiên bản 3)';
$string['taskcleanup'] = 'Dọn dẹp email đến chưa được xác minh';
$string['taskpickup'] = 'Nhận email đến';
$string['tls'] = 'TLS (TLS; bắt đầu thông qua thương lượng cấp giao thức qua kênh không được mã hóa; KHUYẾN NGHỊ cách bắt đầu kết nối an toàn)';
$string['tlsv1'] = 'TLSv1 (kết nối trực tiếp với máy chủ TLS phiên bản 1.x)';
$string['validateaddress'] = 'Xác thực địa chỉ email của người gửi';
$string['validateaddress_help'] = 'Khi nhận được tin nhắn từ người dùng, Moodle cố gắng xác thực tin nhắn bằng cách so sánh địa chỉ email của người gửi với địa chỉ email trong hồ sơ người dùng của họ. Nếu người gửi không khớp, thì người dùng sẽ được gửi một thông báo để xác nhận rằng họ đã thực sự gửi email. Nếu cài đặt này bị tắt, thì địa chỉ email của người gửi sẽ không được kiểm tra.';
