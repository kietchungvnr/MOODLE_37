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
 * @subpackage oauth2
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['authconfirm'] = 'Hành động này sẽ cấp quyền truy cập API vĩnh viễn vào Moodle cho tài khoản đã xác thực. Điều này nhằm mục đích được sử dụng như một tài khoản hệ thống để quản lý các tệp do Moodle sở hữu.';
$string['authconnected'] = 'Tài khoản hệ thống hiện đã được kết nối để truy cập ngoại tuyến';
$string['authnotconnected'] = 'Tài khoản hệ thống không được kết nối để truy cập ngoại tuyến';
$string['configured'] = 'Đã cấu hình';
$string['configuredstatus'] = 'Đã cấu hình';
$string['connectsystemaccount'] = 'Kết nối với tài khoản hệ thống';
$string['createfromtemplate'] = 'Tạo dịch vụ OAuth 2 từ mẫu';
$string['createfromtemplatedesc'] = 'Chọn một trong các mẫu dịch vụ OAuth 2 bên dưới để tạo dịch vụ OAuth có cấu hình hợp lệ cho một trong các loại dịch vụ đã biết. Thao tác này sẽ tạo dịch vụ OAuth 2, với tất cả các điểm cuối chính xác và các thông số cần thiết để xác thực, mặc dù bạn vẫn cần nhập ID ứng dụng khách và bí mật cho dịch vụ mới trước khi có thể sử dụng.';
$string['createnewendpoint'] = 'Tạo điểm cuối mới cho nhà phát hành "{$a}"';
$string['createnewfacebookissuer'] = 'Tạo dịch vụ Facebook mới';
$string['createnewgoogleissuer'] = 'Tạo dịch vụ mới của Google';
$string['createnewissuer'] = 'Tạo dịch vụ tùy chỉnh mới';
$string['createnewmicrosoftissuer'] = 'Tạo dịch vụ mới của Microsoft';
$string['createnewnextcloudissuer'] = 'Tạo dịch vụ Nextcloud mới';
$string['createnewuserfieldmapping'] = 'Tạo ánh xạ trường người dùng mới cho nhà phát hành "{$a}"';
$string['deleteconfirm'] = 'Bạn có chắc chắn muốn xóa công ty cấp danh tính "{$a}" không? Bất kỳ plugin nào dựa vào nhà phát hành này sẽ ngừng hoạt động.';
$string['deleteendpointconfirm'] = 'Bạn có chắc chắn muốn xóa điểm cuối "{$a->endpoint}" cho tổ chức phát hành "{$a->releaseer}" không? Bất kỳ plugin nào dựa vào điểm cuối này sẽ ngừng hoạt động.';
$string['deleteuserfieldmappingconfirm'] = 'Bạn có chắc chắn muốn xóa ánh xạ trường người dùng cho tổ chức phát hành "{$a}" không?';
$string['discovered'] = 'Khám phá dịch vụ thành công';
$string['discovered_help'] = 'Khám phá có nghĩa là các điểm cuối OAuth 2 có thể được xác định tự động từ URL cơ sở cho dịch vụ OAuth. Không phải tất cả các dịch vụ đều bắt buộc phải được "phát hiện", nhưng nếu không, thì các điểm cuối và thông tin ánh xạ người dùng sẽ cần được nhập theo cách thủ công.';
$string['discoverystatus'] = 'Khám phá';
$string['editendpoint'] = 'Chỉnh sửa điểm cuối: {$a->endpoint} cho công ty phát hành {$a->issuer}';
$string['editendpoints'] = 'Định cấu hình điểm cuối';
$string['editissuer'] = 'Chỉnh sửa công ty phát hành danh tính: {$a}';
$string['edituserfieldmapping'] = 'Chỉnh sửa ánh xạ trường người dùng cho công ty phát hành {$a}';
$string['edituserfieldmappings'] = 'Định cấu hình ánh xạ trường người dùng';
$string['endpointdeleted'] = 'Đã xóa điểm cuối';
$string['endpointname'] = 'Tên';
$string['endpointname_help'] = 'Khóa được sử dụng để tìm kiếm điểm cuối này. Phải kết thúc bằng "_endpoint".';
$string['endpointsforissuer'] = 'Điểm cuối cho công ty phát hành: {$a}';
$string['endpointurl'] = 'URL';
$string['endpointurl_help'] = 'URL cho điểm cuối này. Phải sử dụng giao thức https: //.';
$string['issueralloweddomains'] = 'Đăng nhập miền';
$string['issueralloweddomains_help'] = 'Nếu được đặt, cài đặt này là danh sách các miền được phân tách bằng dấu phẩy mà thông tin đăng nhập sẽ bị hạn chế khi sử dụng nhà cung cấp này.';
$string['issuerbaseurl'] = 'URL cơ sở dịch vụ';
$string['issuerbaseurl_help'] = 'URL cơ sở được sử dụng để truy cập dịch vụ.';
$string['issuerclientid'] = 'ID khách hàng';
$string['issuerclientid_help'] = 'ID ứng dụng khách OAuth cho nhà phát hành này.';
$string['issuerclientsecret'] = 'Bí mật khách hàng';
$string['issuerclientsecret_help'] = 'Ứng dụng khách OAuth bí mật cho nhà phát hành này.';
$string['issuerdeleted'] = 'Tổ chức phát hành danh tính đã bị xóa';
$string['issuerdisabled'] = 'Nhà phát hành danh tính bị vô hiệu hóa';
$string['issuerenabled'] = 'Đã bật công ty phát hành danh tính';
$string['issuerimage'] = 'Biểu trưng URL';
$string['issuerimage_help'] = 'URL hình ảnh được sử dụng để hiển thị biểu trưng cho công ty phát hành này. Có thể được hiển thị trên trang đăng nhập.';
$string['issuerloginparams'] = 'Các thông số bổ sung có trong một yêu cầu đăng nhập.';
$string['issuerloginparams_help'] = 'Một số hệ thống yêu cầu các thông số bổ sung cho yêu cầu đăng nhập để đọc hồ sơ cơ bản của người dùng.';
$string['issuerloginparamsoffline'] = 'Các thông số bổ sung có trong yêu cầu đăng nhập để truy cập ngoại tuyến.';
$string['issuerloginparamsoffline_help'] = 'Mỗi hệ thống OAuth xác định một cách khác nhau để yêu cầu quyền truy cập ngoại tuyến. Ví dụ: Google yêu cầu các thông số bổ sung: "access_type = offline & prompt = agree". Các tham số này phải ở định dạng tham số truy vấn URL.';
$string['issuerloginscopes'] = 'Các phạm vi bao gồm trong một yêu cầu đăng nhập.';
$string['issuerloginscopes_help'] = 'Một số hệ thống yêu cầu phạm vi bổ sung cho một yêu cầu đăng nhập để đọc hồ sơ cơ bản của người dùng. Phạm vi tiêu chuẩn cho một hệ thống tuân thủ OpenID Connect là "email hồ sơ openid".';
$string['issuerloginscopesoffline'] = 'Các phạm vi bao gồm trong một yêu cầu đăng nhập để truy cập ngoại tuyến.';
$string['issuerloginscopesoffline_help'] = 'Mỗi hệ thống OAuth xác định một cách khác nhau để yêu cầu quyền truy cập ngoại tuyến. Ví dụ: Microsoft yêu cầu một phạm vi bổ sung "offline_access".';
$string['issuername'] = 'Tên';
$string['issuername_help'] = 'Tên của tổ chức phát hành danh tính. Có thể được hiển thị trên trang đăng nhập.';
$string['issuerrequireconfirmation'] = 'Yêu cầu xác minh email';
$string['issuerrequireconfirmation_help'] = 'Yêu cầu tất cả người dùng xác minh địa chỉ email của họ trước khi họ có thể đăng nhập bằng OAuth. Điều này áp dụng cho các tài khoản mới được tạo như một phần của quá trình đăng nhập hoặc khi tài khoản Moodle hiện có được kết nối với thông tin đăng nhập OAuth qua các địa chỉ email phù hợp.';
$string['issuers'] = 'Tổ chức phát hành';
$string['issuersetup'] = 'Hướng dẫn chi tiết về cách định cấu hình các dịch vụ OAuth 2 phổ biến';
$string['issuersetuptype'] = 'Hướng dẫn chi tiết về cách thiết lập nhà cung cấp {$a} OAuth 2';
$string['issuershowonloginpage'] = 'Hiển thị trên trang đăng nhập';
$string['issuershowonloginpage_help'] = 'Nếu plugin xác thực OAuth 2 được bật, nhà phát hành đăng nhập này sẽ được liệt kê trên trang đăng nhập để cho phép người dùng đăng nhập bằng tài khoản từ nhà phát hành này.';
$string['loginissuer'] = 'Cho phép đăng nhập';
$string['notconfigured'] = 'Không được định cấu hình';
$string['notdiscovered'] = 'Khám phá dịch vụ không thành công';
$string['notloginissuer'] = 'Không cho phép đăng nhập';
$string['pluginname'] = 'Dịch vụ OAuth 2';
$string['privacy:metadata'] = 'Plugin dịch vụ OAuth 2 không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['savechanges'] = 'Lưu thay đổi';
$string['serviceshelp'] = 'Hướng dẫn thiết lập nhà cung cấp dịch vụ.';
$string['systemaccountconnected'] = 'Đã kết nối tài khoản hệ thống';
$string['systemaccountconnected_help'] = 'Tài khoản hệ thống được sử dụng để cung cấp chức năng nâng cao cho plugin. Chúng không chỉ bắt buộc đối với chức năng đăng nhập, nhưng các plugin khác sử dụng dịch vụ OAuth có thể cung cấp một số tính năng giảm bớt nếu tài khoản hệ thống chưa được kết nối. Ví dụ: kho lưu trữ không thể hỗ trợ "liên kết được kiểm soát" nếu không có tài khoản hệ thống để thực hiện các hoạt động tệp.';
$string['systemaccountnotconnected'] = 'Tài khoản hệ thống không được kết nối';
$string['systemauthstatus'] = 'Đã kết nối tài khoản hệ thống';
$string['usebasicauth'] = 'Xác thực yêu cầu mã thông báo qua tiêu đề HTTP';
$string['usebasicauth_help'] = 'Sử dụng lược đồ xác thực HTTP cơ bản khi gửi ID khách hàng và mật khẩu với yêu cầu mã thông báo làm mới. Được đề xuất bởi tiêu chuẩn OAuth 2, nhưng có thể không khả dụng với một số nhà phát hành.';
$string['userfieldexternalfield'] = 'Tên trường bên ngoài';
$string['userfieldexternalfield_error'] = 'Trường này không được chứa HTML.';
$string['userfieldexternalfield_help'] = 'Tên của trường do hệ thống OAuth bên ngoài cung cấp.';
$string['userfieldinternalfield'] = 'Tên trường nội bộ';
$string['userfieldinternalfield_help'] = 'Tên của trường người dùng Moodle sẽ được ánh xạ từ trường bên ngoài.';
$string['userfieldmappingdeleted'] = 'Ánh xạ trường người dùng đã bị xóa';
$string['userfieldmappingsforissuer'] = 'Ánh xạ trường người dùng cho nhà phát hành: {$a}';
