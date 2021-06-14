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
 * @subpackage httpsreplace
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['complete'] = 'Đã hoàn thành';
$string['count'] = 'Số lượng mục nội dung được nhúng';
$string['disclaimer'] = 'Tôi hiểu những rủi ro của hoạt động này';
$string['doclink'] = 'Công cụ chuyển đổi HTTPS';
$string['doit'] = 'Thực hiện chuyển đổi';
$string['domain'] = 'Miền có vấn đề';
$string['domainexplain'] = 'Khi một trang web được chuyển từ HTTP sang HTTPS, tất cả nội dung HTTP được nhúng sẽ ngừng hoạt động. Công cụ này cho phép bạn tự động chuyển đổi nội dung 
HTTP sang HTTPS. Trước khi thực hiện chuyển đổi, nội dung sẽ được quét để tìm bất kỳ URL nào có thể không hoạt động sau khi chuyển đổi. Bạn có thể muốn kiểm tra xem từng cái có sẵn HTTPS hay không, hoặc tìm các tài nguyên thay thế.';
$string['domainexplainhelp'] = 'Các miền này được tìm thấy trong nội dung của bạn, nhưng dường như không hỗ trợ nội dung HTTPS. Sau khi chuyển sang HTTPS, nội dung bao gồm từ các trang web 
này sẽ không còn hiển thị trong Moodle đối với người dùng có trình duyệt hiện đại an toàn. Có thể các trang web này tạm thời hoặc vĩnh viễn không khả dụng và sẽ không hoạt động với một trong hai cài đặt bảo mật. Chỉ tiến hành sau khi xem xét các kết quả này và xác định xem nội dung được lưu trữ bên ngoài này có phải là nội dung không cần thiết hay không. Lưu ý: Nội dung này sẽ không còn hoạt động khi chuyển sang HTTPS.';
$string['httpwarning'] = 'Phiên bản này vẫn đang chạy trên HTTP. Bạn vẫn có thể chạy công cụ này và nội dung bên ngoài sẽ được thay đổi thành HTTPS, nhưng nội dung bên trong sẽ vẫn ở 
trên HTTP. Bạn sẽ cần chạy lại tập lệnh này sau khi chuyển sang HTTPS để chuyển đổi nội dung bên trong.';
$string['notimplemented'] = 'Xin lỗi, tính năng này không được triển khai trong trình điều khiển cơ sở dữ liệu của bạn.';
$string['oktoprocede'] = 'Quá trình quét không tìm thấy vấn đề gì với nội dung của bạn. Bạn có thể tiến hành nâng cấp bất kỳ nội dung HTTP nào để sử dụng HTTPS.';
$string['pageheader'] = 'Nâng cấp URL nội dung được lưu trữ bên ngoài lên HTTPS';
$string['pluginname'] = 'Công cụ chuyển đổi HTTPS';
$string['privacy:metadata'] = 'Plugin công cụ chuyển đổi HTTPS không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['replacing'] = 'Thay thế nội dung HTTP bằng HTTPS ...';
$string['searching'] = 'Tìm kiếm {$a}';
$string['takeabackupwarning'] = 'Cảnh báo: Sau khi chạy công cụ này, không thể hoàn nguyên các thay đổi. Bạn nên sao lưu trang web trước khi tiếp tục, vì có một rủi ro nhỏ là nội dung sai bị thay thế.';
$string['toolintro'] = 'Nếu bạn đang lên kế hoạch chuyển đổi trang web của mình sang HTTPS, bạn có thể sử dụng <a href="{$a}"> công cụ chuyển đổi HTTPS </a> để chuyển đổi nội dung 
được nhúng sang HTTPS.';
