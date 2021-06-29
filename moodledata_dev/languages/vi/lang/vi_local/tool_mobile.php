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
 * @subpackage mobile
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adodbdebugwarning'] = 'Gỡ lỗi ADOdb được bật. Nó sẽ bị vô hiệu hóa trong cài đặt xác thực cơ sở dữ liệu bên ngoài hoặc cài đặt plugin đăng ký cơ sở dữ liệu bên ngoài.';
$string['androidappid'] = 'Mã nhận dạng duy nhất của ứng dụng Android';
$string['androidappid_desc'] = 'Cài đặt này có thể được để làm mặc định trừ khi bạn có ứng dụng Android tùy chỉnh.';
$string['apppolicy'] = 'URL chính sách ứng dụng';
$string['apppolicy_help'] = 'URL của chính sách dành cho người dùng ứng dụng được liệt kê trên trang Giới thiệu trong ứng dụng. Nếu trường để trống, URL chính sách trang web sẽ được sử dụng
 thay thế.';
$string['apprequired'] = 'Chức năng này chỉ khả dụng khi được truy cập qua ứng dụng Moodle dành cho thiết bị di động hoặc máy tính để bàn.';
$string['autologinkeygenerationlockout'] = 'Tự động tạo khóa đăng nhập bị chặn. Bạn cần đợi 6 phút giữa các lần yêu cầu.';
$string['autologinnotallowedtoadmins'] = 'Quản trị viên trang web không được phép đăng nhập tự động.';
$string['cachedef_plugininfo'] = 'Điều này lưu trữ danh sách các plugin với các addon di động';
$string['clickheretolaunchtheapp'] = 'Bấm vào đây nếu ứng dụng không tự động mở.';
$string['customlangstrings'] = 'Chuỗi ngôn ngữ tùy chỉnh';
$string['customlangstrings_desc'] = 'Các từ và cụm từ hiển thị trong ứng dụng có thể được tùy chỉnh tại đây. Nhập từng chuỗi ngôn ngữ tùy chỉnh trên một dòng mới có định dạng: chuỗi nhận dạng, chuỗi 
ngôn ngữ tùy chỉnh và mã ngôn ngữ, được phân tách bằng ký tự ống dẫn. Ví dụ: <pre> mm.user.student | Learner | en mm.user.student | Aprendiz | es </pre> Để có danh sách đầy đủ các số nhận dạng chuỗi, hãy xem tài liệu.';
$string['custommenuitems'] = 'Các mục menu tùy chỉnh';
$string['custommenuitems_desc'] = 'Các mục bổ sung có thể được thêm vào menu chính của ứng dụng bằng cách chỉ định chúng tại đây. Nhập từng mục menu tùy chỉnh trên một dòng mới với định dạng: văn 
bản mục, URL liên kết, phương pháp mở liên kết và mã ngôn ngữ (tùy chọn, để hiển thị mục chỉ cho người dùng ngôn ngữ được chỉ định), được phân tách bằng ký tự ống dẫn. Các phương pháp mở liên kết là: ứng dụng (để liên kết đến một hoạt động được ứng dụng hỗ trợ), inappbrowser (để mở liên kết trong trình duyệt mà không cần thoát khỏi ứng dụng), trình duyệt (để mở liên kết trong trình duyệt mặc định của thiết bị bên ngoài ứng dụng) và được nhúng (để hiển thị liên kết trong iframe ở trang mới trong ứng dụng). Ví dụ: <pre> App help | https: //someurl.xyz/help | inappbrowser Điểm của tôi | https: //someurl.xyz/local/mygrades/index.php | nhúng | vi Mis calificaciones | https: // someurl .xyz / local / mygrades / index.php | nhúng | es <';
$string['disabledfeatures'] = 'Các tính năng bị tắt';
$string['disabledfeatures_desc'] = 'Chọn ở đây các tính năng bạn muốn tắt trong ứng dụng Di động cho trang web của bạn. Xin lưu ý rằng một số tính năng được liệt kê ở đây có thể đã bị tắt thông qua cài 
đặt trang web khác. Bạn sẽ phải đăng xuất và đăng nhập lại vào ứng dụng để xem các thay đổi.';
$string['displayerrorswarning'] = 'Hiển thị thông báo gỡ lỗi (debugdisplay) được bật. Nó nên được vô hiệu hóa.';
$string['downloadcourse'] = 'Tải xuống khóa học';
$string['downloadcourses'] = 'Tải xuống các khóa học';
$string['enablesmartappbanners'] = 'Bật biểu ngữ ứng dụng';
$string['enablesmartappbanners_desc'] = 'Nếu được bật, biểu ngữ quảng cáo ứng dụng dành cho thiết bị di động sẽ được hiển thị khi truy cập trang web bằng trình duyệt dành cho thiết bị di động.';
$string['forcedurlscheme'] = 'Nếu bạn muốn chỉ cho phép ứng dụng có thương hiệu tùy chỉnh của mình được mở qua cửa sổ trình duyệt, hãy chỉ định lược đồ URL của nó tại đây; nếu không thì để 
trống trường.';
$string['forcedurlscheme_key'] = 'Lược đồ URL';
$string['forcelogout'] = 'Buộc đăng xuất';
$string['forcelogout_desc'] = 'Nếu được bật, tùy chọn ứng dụng \'Thay đổi trang web\' sẽ được thay thế bằng \'Đăng xuất\'. Điều này dẫn đến việc người dùng bị đăng xuất hoàn toàn. Sau đó, họ phải nhập 
lại mật khẩu của mình vào lần sau khi họ muốn truy cập trang web.';
$string['getmoodleonyourmobile'] = 'Tải ứng dụng di động';
$string['httpsrequired'] = 'HTTPS bắt buộc';
$string['insecurealgorithmwarning'] = 'Có vẻ như chứng chỉ HTTPS sử dụng thuật toán ký không an toàn (SHA-1). Vui lòng thử cập nhật chứng chỉ.';
$string['invalidcertificatechainwarning'] = 'Có vẻ như chuỗi chứng chỉ không hợp lệ.';
$string['invalidcertificateexpiredatewarning'] = 'Có vẻ như chứng chỉ HTTPS cho trang web đã hết hạn.';
$string['invalidcertificatestartdatewarning'] = 'Có vẻ như chứng chỉ HTTPS cho trang web chưa hợp lệ (với ngày bắt đầu trong tương lai).';
$string['invalidprivatetoken'] = 'Mã thông báo riêng không hợp lệ. Mã thông báo không được để trống hoặc được chuyển qua tham số GET.';
$string['invaliduserquotawarning'] = 'Hạn ngạch người dùng (userquota) được đặt thành một số không hợp lệ. Nó phải được đặt thành một số hợp lệ (một giá trị số nguyên) trong cài đặt bảo mật Trang web.';
$string['iosappid'] = 'Mã nhận dạng duy nhất của ứng dụng iOS';
$string['iosappid_desc'] = 'Cài đặt này có thể được để làm mặc định trừ khi bạn có ứng dụng iOS tùy chỉnh.';
$string['loginintheapp'] = 'Qua ứng dụng';
$string['logininthebrowser'] = 'Qua cửa sổ trình duyệt (đối với plugin SSO)';
$string['loginintheembeddedbrowser'] = 'Qua trình duyệt được nhúng (đối với plugin SSO)';
$string['mainmenu'] = 'Thực đơn chính';
$string['mobileapp'] = 'Ứng dụng di động';
$string['mobileappconnected'] = 'Ứng dụng di động được kết nối';
$string['mobileappearance'] = 'Giao diện di động';
$string['mobileappenabled'] = 'Trang web này đã bật quyền truy cập ứng dụng dành cho thiết bị di động. <br /> <a href="{$a}"> Tải xuống ứng dụng dành cho thiết bị di động </a>.';
$string['mobileauthentication'] = 'Xác thực di động';
$string['mobilecssurl'] = 'CSS';
$string['mobilefeatures'] = 'Tính năng di động';
$string['mobilenotificationsdisabledwarning'] = 'Thông báo di động không được bật. Chúng phải được bật trong cài đặt Thông báo.';
$string['mobilesettings'] = 'Cài đặt di động';
$string['offlineuse'] = 'Sử dụng ngoại tuyến';
$string['pluginname'] = 'Công cụ ứng dụng Moodle';
$string['pluginnotenabledorconfigured'] = 'Plugin chưa được bật hoặc chưa được định cấu hình.';
$string['privacy:metadata:core_userkey'] = 'Khóa của người dùng được sử dụng để tạo khóa đăng nhập tự động cho người dùng hiện tại.';
$string['privacy:metadata:preference:tool_mobile_autologin_request_last'] = 'Ngày yêu cầu khóa đăng nhập tự động cuối cùng. Giữa mỗi yêu cầu 6 phút được yêu cầu.';
$string['readingthisemailgettheapp'] = 'Đọc cái này trong một email? <a href="{$a}"> Tải xuống ứng dụng di động và nhận thông báo trên thiết bị di động của bạn </a>.';
$string['remoteaddons'] = 'Tiện ích bổ sung từ xa';
$string['responsivemainmenuitems'] = 'Các mục menu đáp ứng';
$string['selfsignedoruntrustedcertificatewarning'] = 'Có vẻ như chứng chỉ HTTPS được tự ký hoặc không đáng tin cậy. Ứng dụng di động sẽ chỉ hoạt động với các trang web đáng tin cậy.';
$string['setuplink'] = 'Trang tải xuống ứng dụng';
$string['setuplink_desc'] = 'URL của trang có liên kết để tải xuống ứng dụng di động từ App Store và Google Play.';
$string['smartappbanners'] = 'Biểu ngữ ứng dụng';
$string['typeoflogin'] = 'Loại đăng nhập';
$string['typeoflogin_desc'] = 'Nếu trang web sử dụng phương pháp xác thực SSO, hãy chọn qua cửa sổ trình duyệt hoặc qua trình duyệt được nhúng. Một trình duyệt nhúng cung cấp trải nghiệm người
 dùng tốt hơn, mặc dù nó không hoạt động với tất cả các plugin SSO.';
