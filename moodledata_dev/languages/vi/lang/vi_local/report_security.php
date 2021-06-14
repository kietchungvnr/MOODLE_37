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
 * @package    report
 * @subpackage security
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['check_configrw_details'] = '<p> Bạn nên thay đổi các quyền đối với tệp config.php sau khi cài đặt để máy chủ web không thể sửa đổi tệp. Xin lưu ý rằng biện pháp
 này không cải thiện đáng kể tính bảo mật của máy chủ, mặc dù nó có thể làm chậm hoặc hạn chế việc khai thác chung. </p>';
$string['check_configrw_name'] = 'Có thể ghi config.php';
$string['check_configrw_ok'] = 'config.php không thể được sửa đổi bằng tập lệnh PHP.';
$string['check_configrw_warning'] = 'Các tập lệnh PHP có thể sửa đổi config.php.';
$string['check_cookiesecure_details'] = '<p> Nếu giao tiếp https được bật, bạn nên cho phép gửi cookie an toàn. Bạn nên chuyển hướng vĩnh viễn từ http sang https và lý tưởng nhất là phân phát các tiêu đề HSTS. </p>';
$string['check_cookiesecure_error'] = 'Vui lòng bật cookie bảo mật';
$string['check_cookiesecure_name'] = 'Cookie bảo mật';
$string['check_cookiesecure_ok'] = 'Đã bật cookie bảo mật.';
$string['check_defaultuserrole_details'] = '<p> Tất cả người dùng đã đăng nhập đều được cung cấp các khả năng của vai trò người dùng mặc định. Vui lòng đảm bảo rằng không có khả năng rủi ro nào được phép
 trong vai trò này. </p> <p> Loại kế thừa duy nhất được hỗ trợ cho vai trò người dùng mặc định là <em> Người dùng đã xác thực </em>. Khả năng xem khóa học không được bật. </p>';
$string['check_defaultuserrole_error'] = 'Vai trò người dùng mặc định "{$a}" được xác định không chính xác!';
$string['check_defaultuserrole_name'] = 'Vai trò mặc định cho tất cả người dùng';
$string['check_defaultuserrole_notset'] = 'Vai trò mặc định không được đặt.';
$string['check_defaultuserrole_ok'] = 'Vai trò mặc định cho định nghĩa của tất cả người dùng là OK.';
$string['check_displayerrors_details'] = '<p> Việc bật cài đặt PHP <code> display_errors </code> không được khuyến nghị trên các trang web sản xuất vì thông báo lỗi có thể tiết lộ thông tin nhạy cảm về máy chủ của bạn. </p>';
$string['check_displayerrors_error'] = 'Cài đặt PHP để hiển thị lỗi được bật. Chúng tôi khuyến nghị rằng điều này bị vô hiệu hóa.';
$string['check_displayerrors_name'] = 'Hiển thị lỗi PHP';
$string['check_displayerrors_ok'] = 'Hiển thị lỗi PHP bị tắt.';
$string['check_emailchangeconfirmation_details'] = '<p> Bạn nên thực hiện bước xác nhận email khi người dùng thay đổi địa chỉ email trong hồ sơ của họ. Nếu bị vô hiệu hóa, những người gửi spam có thể cố gắng khai thác máy
 chủ để gửi spam. </p> <p> Trường email cũng có thể bị khóa khỏi plugin xác thực, khả năng này không được xem xét ở đây. </p>';
$string['check_emailchangeconfirmation_error'] = 'Người dùng có thể nhập bất kỳ địa chỉ email nào.';
$string['check_emailchangeconfirmation_info'] = 'Người dùng chỉ có thể nhập địa chỉ email từ các miền được phép.';
$string['check_emailchangeconfirmation_name'] = 'Xác nhận thay đổi email';
$string['check_emailchangeconfirmation_ok'] = 'Xác nhận thay đổi địa chỉ email trong hồ sơ người dùng.';
$string['check_embed_details'] = '<p> Việc nhúng đối tượng không giới hạn là rất nguy hiểm - bất kỳ người dùng đã đăng ký nào cũng có thể khởi động một cuộc tấn công XSS chống lại những người dùng máy chủ khác. Cài đặt này sẽ bị tắt trên máy chủ sản xuất. </p>';
$string['check_embed_error'] = 'Đã bật tính năng nhúng đối tượng không giới hạn - điều này rất nguy hiểm đối với phần lớn các máy chủ.';
$string['check_embed_name'] = 'Cho phép EMBED và OBJECT';
$string['check_embed_ok'] = 'Không cho phép nhúng đối tượng không giới hạn.';
$string['check_frontpagerole_details'] = '<p> Vai trò trang chủ mặc định được trao cho tất cả người dùng đã đăng ký cho các hoạt động trên trang chủ. Vui lòng đảm bảo rằng không có khả năng rủi ro nào được phép
 cho vai trò này. </p> <p> Bạn nên tạo một vai trò đặc biệt cho mục đích này và không sử dụng vai trò loại kế thừa. </p>';
$string['check_frontpagerole_error'] = 'Đã phát hiện vai trò trang chủ "{$a}" được xác định không chính xác!';
$string['check_frontpagerole_name'] = 'Vai trò trang chủ';
$string['check_frontpagerole_notset'] = 'Vai trò trang chủ không được đặt.';
$string['check_frontpagerole_ok'] = 'Định nghĩa vai trò frontpage là OK.';
$string['check_google_details'] = '<p> Cài đặt Mở cho Google cho phép các công cụ tìm kiếm tham gia các khóa học với quyền truy cập của khách. Không có ích gì khi bật cài đặt này nếu đăng nhập với tư cách 
khách không được phép. </p>';
$string['check_google_error'] = 'Quyền truy cập của công cụ tìm kiếm được phép nhưng quyền truy cập của khách bị vô hiệu hóa.';
$string['check_google_info'] = 'Công cụ tìm kiếm có thể nhập với tư cách khách.';
$string['check_google_name'] = 'Mở cho Google';
$string['check_google_ok'] = 'Quyền truy cập công cụ tìm kiếm không được kích hoạt.';
$string['check_guestrole_details'] = '<p> Vai trò khách được sử dụng cho khách, không phải người dùng đã đăng nhập và quyền truy cập khóa học dành cho khách tạm thời. Vui lòng đảm bảo không cho phép 
khả năng rủi ro nào trong vai trò này. </p> <p> Loại kế thừa được hỗ trợ duy nhất cho vai trò khách mời là <em> Khách mời </em>. </p>';
$string['check_guestrole_error'] = 'Vai trò khách "{$a}" được xác định không chính xác!';
$string['check_guestrole_name'] = 'Vai trò khách mời';
$string['check_guestrole_notset'] = 'Vai trò khách chưa được đặt.';
$string['check_guestrole_ok'] = 'Định nghĩa vai trò khách mời là OK.';
$string['check_mediafilterswf_details'] = '<p> Nhúng swf tự động rất nguy hiểm - bất kỳ người dùng đã đăng ký nào cũng có thể khởi chạy một cuộc tấn công XSS chống lại những người dùng máy chủ khác. Vui lòng
tắt nó trên máy chủ sản xuất. </p>';
$string['check_mediafilterswf_error'] = 'Bộ lọc phương tiện flash được bật - điều này rất nguy hiểm đối với phần lớn các máy chủ.';
$string['check_mediafilterswf_name'] = 'Đã bật bộ lọc phương tiện .swf';
$string['check_mediafilterswf_ok'] = 'Bộ lọc phương tiện flash chưa được bật.';
$string['check_noauth_details'] = '<p> Plugin <em> Không xác thực </em> không dành cho các trang web sản xuất. Vui lòng tắt nó trừ khi đây là một trang web thử nghiệm phát triển. </p>';
$string['check_noauth_error'] = 'Không thể sử dụng plugin Không xác thực trên các trang web sản xuất.';
$string['check_noauth_name'] = 'Không có chứng thực';
$string['check_noauth_ok'] = 'Không có plugin xác thực nào bị tắt.';
$string['check_nodemodules_details'] = '<p> Thư mục <em> {$a->path} </em> chứa các mô-đun Node.js và các phần phụ thuộc của chúng, thường được cài đặt bởi tiện ích NPM. Các mô-đun này có thể cần thiết để 
phát triển Moodle cục bộ, chẳng hạn như để sử dụng khuôn khổ grunt. Chúng không cần thiết để chạy trang web Moodle trong quá trình sản xuất và chúng có thể chứa mã nguy hiểm tiềm ẩn khiến trang web của bạn bị tấn công từ xa. </p> <p> Bạn nên xóa thư mục nếu trang web có sẵn qua URL công khai, hoặc ít nhất là cấm web truy cập vào nó trong cấu hình máy chủ web của bạn. </p>';
$string['check_nodemodules_info'] = 'Thư mục node_modules không được xuất hiện trên các trang web công cộng.';
$string['check_nodemodules_name'] = 'Thư mục mô-đun Node.js';
$string['check_openprofiles_details'] = 'Hồ sơ người dùng mở có thể bị lạm dụng bởi những kẻ gửi thư rác. Bạn nên bật <code> Buộc người dùng đăng nhập vào cấu hình </code> hoặc <code> Buộc người dùng đăng 
nhập </code>.';
$string['check_openprofiles_error'] = 'Bất kỳ ai cũng có thể xem hồ sơ người dùng mà không cần đăng nhập.';
$string['check_openprofiles_name'] = 'Mở hồ sơ người dùng';
$string['check_openprofiles_ok'] = 'Đăng nhập là bắt buộc trước khi xem hồ sơ người dùng.';
$string['check_passwordpolicy_details'] = '<p> Bạn nên đặt chính sách mật khẩu, vì đoán mật khẩu thường là cách dễ nhất để truy cập trái phép. Tuy nhiên, đừng đặt ra các yêu cầu quá khắt khe vì điều này có thể dẫn 
đến việc người dùng không thể nhớ mật khẩu của họ và có thể quên hoặc ghi chúng ra giấy. </p>';
$string['check_passwordpolicy_error'] = 'Chính sách mật khẩu chưa được đặt.';
$string['check_passwordpolicy_name'] = 'Chính sách mật khẩu';
$string['check_passwordpolicy_ok'] = 'Đã bật chính sách mật khẩu.';
$string['check_preventexecpath_details'] = '<p> Việc cho phép đặt đường dẫn thực thi qua GUI quản trị là một vectơ để báo cáo đặc quyền. </p>';
$string['check_preventexecpath_name'] = 'Đường dẫn thực thi';
$string['check_preventexecpath_ok'] = 'Các đường dẫn thực thi chỉ có thể thiết lập trong config.php.';
$string['check_preventexecpath_warning'] = 'Đường dẫn thực thi có thể được đặt trong GUI quản trị.';
$string['check_riskadmin_detailsok'] = '<p> Vui lòng xác minh danh sách quản trị viên hệ thống sau: </p> {$a}';
$string['check_riskadmin_detailswarning'] = '<p> Vui lòng xác minh danh sách quản trị viên hệ thống sau: </p> {$a->admins} <p> Chỉ nên chỉ định vai trò quản trị viên trong ngữ cảnh hệ thống. Những người dùng 
sau có nhiệm vụ quản trị viên (không được hỗ trợ) trong các ngữ cảnh khác: </p> {$a->unsupported}';
$string['check_riskadmin_name'] = 'Quản trị viên';
$string['check_riskadmin_ok'] = 'Đã tìm thấy {$a} quản trị viên máy chủ.';
$string['check_riskadmin_unassign'] = '<a href="{$a->url} "> {$a->fullname} ({$a->email}) xem xét phân công vai trò </a>';
$string['check_riskadmin_warning'] = 'Đã tìm thấy quản trị viên máy chủ {$a->admincount} và {$a->unsupcount} nhiệm vụ quản trị viên không được hỗ trợ.';
$string['check_riskbackup_details_overriddenroles'] = '<p> Những ghi đè đang hoạt động này cung cấp cho người dùng khả năng đưa dữ liệu người dùng vào các bản sao lưu. Hãy đảm bảo rằng quyền này là cần thiết. </p> {$a}';
$string['check_riskbackup_details_systemroles'] = '<p> Các vai trò hệ thống sau hiện cho phép người dùng bao gồm dữ liệu người dùng trong các bản sao lưu. Hãy đảm bảo rằng quyền này là cần thiết. </p> {$a}';
$string['check_riskbackup_details_users'] = '<p> Do các vai trò hoặc ghi đè cục bộ ở trên, các tài khoản người dùng sau hiện có quyền tạo bản sao lưu chứa dữ liệu cá nhân từ bất kỳ người dùng nào đã đăng ký trong
 khóa học của họ. Đảm bảo rằng chúng (a) đáng tin cậy và (b) được bảo vệ bằng mật khẩu mạnh: </p> {$a}';
$string['check_riskbackup_detailsok'] = 'Không có vai trò nào cho phép sao lưu dữ liệu người dùng một cách rõ ràng. Tuy nhiên, hãy lưu ý rằng quản trị viên có khả năng "doanything" vẫn có thể làm được điều này.';
$string['check_riskbackup_editoverride'] = '<a href="{$a->url} "> {$a->name} trong {$a->contextname} </a>';
$string['check_riskbackup_editrole'] = '<a href="{$a->url} "> {$a->name} </a>';
$string['check_riskbackup_name'] = 'Sao lưu dữ liệu người dùng';
$string['check_riskbackup_ok'] = 'Không có vai trò nào cho phép sao lưu dữ liệu người dùng một cách rõ ràng';
$string['check_riskbackup_unassign'] = '<a href="{$a->url} "> {$a->fullname} ({$a->email}) trong {$a->contextname} </a>';
$string['check_riskbackup_warning'] = 'Đã tìm thấy các vai trò {$a->rolecount}, ghi đè {$a->overridecount} và người dùng {$a->usercount} có khả năng sao lưu dữ liệu người dùng.';
$string['check_riskxss_details'] = '<p> RISK_XSS biểu thị tất cả các khả năng nguy hiểm mà chỉ những người dùng đáng tin cậy mới có thể sử dụng. </p> <p> Vui lòng xác minh danh sách người dùng sau và 
đảm bảo rằng bạn hoàn toàn tin tưởng họ trên máy chủ này: </p> <p> {$a} </p>';
$string['check_riskxss_name'] = 'Người dùng tin cậy XSS';
$string['check_riskxss_warning'] = 'RISK_XSS - đã tìm thấy {$a} người dùng đáng tin cậy.';
$string['check_unsecuredataroot_details'] = '<p> Không được phép truy cập thư mục dataroot qua web. Cách tốt nhất để đảm bảo không thể truy cập thư mục là sử dụng thư mục bên ngoài thư mục web công cộng. </p>
 <p> Nếu di chuyển thư mục, bạn cần cập nhật <code> $ CFG->dataroot </ code> cài đặt trong <code> config.php </code> cho phù hợp. </p>';
$string['check_unsecuredataroot_error'] = 'Thư mục dataroot của bạn <code> {$a} </code> ở sai vị trí và được hiển thị trên web!';
$string['check_unsecuredataroot_name'] = 'Dữ liệu không an toàn';
$string['check_unsecuredataroot_ok'] = 'Thư mục Dataroot không được truy cập qua web.';
$string['check_unsecuredataroot_warning'] = 'Thư mục dataroot của bạn <code> {$a} </code> ở sai vị trí và có thể được hiển thị trên web.';
$string['check_vendordir_details'] = '<p> Thư mục <em> {$a->path} </em> chứa nhiều thư viện của bên thứ ba và các phần phụ thuộc của chúng, thường được cài đặt bởi PHP Composer. Các thư viện này có thể cần thiết để phát triển Moodle cục bộ, chẳng hạn như để cài đặt khung PHPUnit. Chúng không cần thiết để chạy trang web Moodle trong quá trình sản xuất và chúng có thể chứa mã nguy hiểm tiềm ẩn khiến trang web của bạn bị tấn công từ xa. </p> <p> Bạn nên xóa thư mục nếu trang web có sẵn qua URL công khai, hoặc ít nhất là cấm web truy cập vào nó trong cấu hình máy chủ web của bạn. </p>';
$string['check_vendordir_info'] = 'Thư mục nhà cung cấp không được xuất hiện trên các trang web công cộng.';
$string['check_vendordir_name'] = 'Thư mục nhà cung cấp';
$string['check_webcron_details'] = '<p> Chạy cron từ trình duyệt web có thể để lộ thông tin đặc quyền cho người dùng ẩn danh. Bạn chỉ nên chạy cron từ dòng lệnh hoặc đặt mật khẩu cron để truy cập từ xa. </p>';
$string['check_webcron_name'] = 'Web cron';
$string['check_webcron_ok'] = 'Người dùng ẩn danh không thể truy cập cron.';
$string['check_webcron_warning'] = 'Người dùng ẩn danh có thể truy cập cron.';
$string['configuration'] = 'Cấu hình';
$string['description'] = 'Mô tả';
$string['details'] = 'Chi tiết';
$string['issue'] = 'Vấn đề';
$string['pluginname'] = 'Tổng quan về bảo mật';
$string['privacy:metadata'] = 'Plugin tổng quan về bảo mật không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['security:view'] = 'Xem báo cáo bảo mật';
$string['status'] = 'Trạng thái';
$string['statuscritical'] = 'Chí mạng';
$string['statusinfo'] = 'Thông tin';
$string['statusok'] = 'Đồng ý';
$string['statusserious'] = 'Nghiêm trọng';
$string['statuswarning'] = 'Cảnh báo';
$string['timewarning'] = 'Quá trình xử lý dữ liệu có thể mất nhiều thời gian, hãy kiên nhẫn ...';
