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
 * @subpackage mnet
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['badcert'] = 'Đây không phải là một chứng chỉ hợp lệ.';
$string['couldnotgetcert'] = 'Không tìm thấy chứng chỉ nào tại {$a}. <br/> Máy chủ lưu trữ có thể bị lỗi hoặc được định cấu hình không chính xác.';
$string['couldnotmatchcert'] = 'Điều này không khớp với chứng chỉ hiện được xuất bản bởi máy chủ web.';
$string['current_transport'] = 'Đường truyền hiện tại';
$string['databaseerror'] = 'Không thể ghi chi tiết vào cơ sở dữ liệu.';
$string['deletehost'] = 'Xóa máy chủ';
$string['duplicate_usernames'] = 'Chúng tôi không thể tạo chỉ mục trên các cột "mnethostid" và "tên người dùng" trong bảng người dùng của bạn. <br /> Điều này có thể xảy ra khi bạn có <a href="{$a}" target="_blank"> tên người dùng trùng lặp trong bảng người dùng của bạn </a>.<br /> Nâng cấp của bạn sẽ vẫn hoàn tất thành công. Nhấp vào liên kết ở trên và hướng dẫn khắc phục sự cố này sẽ xuất hiện trong một cửa sổ mới. Bạn có thể tham gia vào điều đó khi kết thúc nâng cấp. <br />';
$string['enabled_for_all'] = '(Dịch vụ này đã được kích hoạt cho tất cả các máy chủ).';
$string['error7020'] = 'Lỗi này thường xảy ra nếu trang web từ xa đã tạo bản ghi cho bạn với wwwroot sai, ví dụ: https://yoursite.com thay vì https://www.yoursite.com. Vui lòng liên hệ với quản trị viên của trang web từ xa bằng wwwroot của bạn (như được chỉ định trong config.php) và yêu cầu họ cập nhật bản ghi cho máy chủ của bạn.';
$string['error7023'] = 'Trang web từ xa đã cố gắng giải mã thông điệp của bạn bằng tất cả các khóa mà nó có trong hồ sơ cho trang web của bạn. Họ đều đã thất bại. Bạn có thể khắc phục sự cố này bằng cách khóa lại theo cách thủ công với trang web từ xa. Điều này khó có thể xảy ra trừ khi bạn không liên lạc với trang web từ xa trong một vài tháng.';
$string['error7024'] = 'Bạn gửi một thông báo không được mã hóa đến trang web từ xa, nhưng trang web từ xa không chấp nhận thông tin liên lạc không được mã hóa từ trang web của bạn. Điều này rất bất ngờ; bạn có thể nên gửi lỗi nếu điều này xảy ra (cung cấp càng nhiều thông tin càng tốt về các phiên bản ứng dụng được đề cập, v.v.';
$string['error7026'] = 'Khóa mà thư của bạn đã được ký khác với khóa mà máy chủ từ xa có trong hồ sơ cho máy chủ của bạn. Hơn nữa, máy chủ từ xa đã cố gắng tìm nạp khóa hiện tại của bạn nhưng không thực hiện được. Vui lòng nhập lại thủ công bằng máy chủ từ xa và thử lại.';
$string['error709'] = 'Trang web từ xa không lấy được khóa SSL từ bạn.';
$string['failedaclwrite'] = 'Không thể ghi vào danh sách kiểm soát truy cập MNet cho người dùng \'{$a}\'.';
$string['findlogin'] = 'Tìm thông tin đăng nhập';
$string['forbidden-function'] = 'Chức năng đó chưa được kích hoạt cho RPC.';
$string['forcesavechanges'] = 'Buộc lưu các thay đổi';
$string['helpnetworksettings'] = 'Định cấu hình giao tiếp MNet';
$string['hidelocal'] = 'Ẩn người dùng cục bộ';
$string['hideremote'] = 'Ẩn người dùng từ xa';
$string['hostcoursenotfound'] = 'Máy chủ hoặc khóa học không tìm thấy';
$string['hostnamehelp'] = 'Tên miền đủ điều kiện của máy chủ từ xa, ví dụ: www.example.com';
$string['id'] = 'ID';
$string['idhelp'] = 'Giá trị này được chỉ định tự động và không thể thay đổi';
$string['invalidhost'] = 'Bạn phải cung cấp số nhận dạng máy chủ hợp lệ';
$string['loginlinkmnetuser'] = '<br /> Nếu bạn là người dùng từ xa MNet và có thể <a href="{$a}"> xác nhận địa chỉ email của mình tại đây </a>, bạn có thể được chuyển hướng đến trang đăng nhập của mình. <br />';
$string['mnet'] = 'MNet';
$string['mnetidproviderdesc'] = 'Bạn có thể sử dụng tiện ích này để truy xuất một liên kết mà bạn có thể đăng nhập, nếu bạn có thể cung cấp địa chỉ email chính xác để khớp với tên người dùng mà bạn đã cố gắng đăng nhập trước đó.';
$string['mnetidprovidermsg'] = 'Bạn sẽ có thể đăng nhập tại nhà cung cấp {$a} của mình.';
$string['mnetidprovidernotfound'] = 'Xin lỗi, nhưng không có thêm thông tin nào có thể được tìm thấy.';
$string['mnetpeers'] = 'Giống nhau';
$string['mnetsettings'] = 'Cài đặt MNet';
$string['networksettings'] = 'Thiết lạp mạng lưới';
$string['nopubkey'] = 'Đã xảy ra sự cố khi truy xuất khóa công khai. <br /> Có thể máy chủ không cho phép MNet hoặc khóa không hợp lệ.';
$string['nosuchmodule'] = 'Hàm đã được định địa chỉ không chính xác và không thể định vị được. Vui lòng sử dụng định dạng mod/modulename/lib/functionname.';
$string['nosuchpublickey'] = 'Không thể lấy khóa công khai để xác minh chữ ký.';
$string['nosuchtransport'] = 'Không có phương tiện nào có ID đó tồn tại.';
$string['notBASE64'] = 'Chuỗi này không ở định dạng được mã hóa base64. Nó không thể là một khóa hợp lệ.';
$string['notPEM'] = 'Khóa này không ở định dạng PEM. Nó sẽ không làm việc.';
$string['permittedtransports'] = 'Vận chuyển được phép';
$string['postrequired'] = 'Chức năng xóa yêu cầu yêu cầu ĐĂNG.';
$string['privacy:metadata'] = 'Plugin MNet không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['receivedwarnings'] = 'Các cảnh báo sau đã được nhận';
$string['reenableserver'] = 'Không - chọn tùy chọn này để kích hoạt lại máy chủ này.';
$string['registerallhosts'] = 'Đăng kí tất cả máy chủ';
$string['remoteuser'] = 'Người dùng {$a->remotetype} từ xa';
$string['reviewhostservices'] = 'Xem lại các dịch vụ máy chủ lưu trữ';
$string['RPC_HTTP_PLAINTEXT'] = 'HTTP không được mã hóa';
$string['RPC_HTTP_SELF_SIGNED'] = 'HTTP (tự ký)';
$string['RPC_HTTP_VERIFIED'] = 'HTTP (đã ký)';
$string['RPC_HTTPS_SELF_SIGNED'] = 'HTTPS (tự ký)';
$string['RPC_HTTPS_VERIFIED'] = 'HTTPS (đã ký)';
$string['serviceswepublish'] = 'Các dịch vụ chúng tôi xuất bản cho {$a}.';
$string['serviceswesubscribeto'] = 'Các dịch vụ trên {$a} mà chúng tôi đăng ký.';
$string['showlocal'] = 'Hiển thị người dùng địa phương';
$string['showremote'] = 'Hiển thị người dùng từ xa';
$string['sslverification'] = 'Xác minh SSL';
$string['sslverification_help'] = 'Tùy chọn này cho phép bạn định cấu hình mức độ bảo mật khi kết nối với mạng ngang hàng bằng HTTPS. * Không có: không có mức độ bảo mật * Chỉ xác minh máy chủ: xác thực miền của chứng chỉ SSL * Xác minh máy chủ và máy chủ ngang hàng (được khuyến nghị): xác thực miền và nhà phát hành chứng chỉ SSL';
$string['turnitoff'] = 'Tắt';
$string['turniton'] = 'Bật';
$string['verifyhostandpeer'] = 'Xác minh máy chủ và máy chủ ngang hàng';
$string['verifyhostonly'] = 'Chỉ xác minh máy chủ';
$string['wrong-ip'] = 'Địa chỉ IP của bạn không khớp với địa chỉ mà chúng tôi có trong hồ sơ.';
$string['yourpeers'] = 'Máy chủ giống nhau của bạn';
