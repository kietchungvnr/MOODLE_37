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
 * @subpackage performance
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['check_backup'] = 'Sao lưu tự động';
$string['check_backup_comment_disable'] = 'Hiệu suất có thể bị ảnh hưởng trong quá trình sao lưu. Nếu được bật, các bản sao lưu sẽ được lên lịch cho những thời gian thấp điểm.';
$string['check_backup_comment_enable'] = 'Hiệu suất có thể bị ảnh hưởng trong quá trình sao lưu. Các bản sao lưu nên được lên lịch vào thời gian thấp điểm.';
$string['check_backup_details'] = 'Bật sao lưu tự động sẽ tự động tạo bản lưu trữ của tất cả các khóa học trên máy chủ vào thời điểm bạn đã chỉ định. <p> Trong quá trình 
này, việc này sẽ tiêu tốn nhiều tài nguyên máy chủ hơn và có thể ảnh hưởng đến hiệu suất. </p>';
$string['check_cachejs_comment_disable'] = 'Nếu được bật, hiệu suất tải trang sẽ được cải thiện.';
$string['check_cachejs_comment_enable'] = 'Nếu bị tắt, trang có thể tải chậm.';
$string['check_cachejs_details'] = 'Bộ nhớ đệm và nén Javascript cải thiện đáng kể hiệu suất tải trang. Nó được khuyến khích cho các địa điểm sản xuất.';
$string['check_debugmsg_comment_developer'] = 'Nếu được đặt thành giá trị khác với DEVELOPER, hiệu suất có thể được cải thiện một chút.';
$string['check_debugmsg_comment_nodeveloper'] = 'Nếu được đặt thành DEVELOPER, hiệu suất có thể bị ảnh hưởng đôi chút.';
$string['check_debugmsg_details'] = 'Hiếm khi có bất kỳ lợi thế nào khi lên cấp Nhà phát triển, trừ khi được nhà phát triển yêu cầu. <p> Khi bạn đã nhận được 
thông báo lỗi và sao chép và dán nó ở đâu đó, bạn nên chuyển Gỡ lỗi trở lại thành KHÔNG CÓ. Thông báo gỡ lỗi có thể cung cấp manh mối cho tin tặc về việc thiết lập trang web của bạn và có thể ảnh hưởng đến hiệu suất. </p>';
$string['check_enablestats_comment_disable'] = 'Hiệu suất có thể bị ảnh hưởng bởi quá trình xử lý thống kê. Nếu được bật, cài đặt thống kê phải được đặt một cách thận trọng.';
$string['check_enablestats_comment_enable'] = 'Hiệu suất có thể bị ảnh hưởng bởi quá trình xử lý thống kê. Cài đặt thống kê nên được đặt một cách thận trọng.';
$string['check_enablestats_details'] = 'Bật tính năng này sẽ xử lý nhật ký trong cronjob và thu thập một số thống kê. Tùy thuộc vào lượng lưu lượng truy cập trên trang we
b của bạn, quá trình này có thể mất một lúc. <p> Trong quá trình này, quá trình này sẽ tiêu tốn nhiều tài nguyên máy chủ hơn và có thể ảnh hưởng đến hiệu suất. </p>';
$string['check_themedesignermode_comment_disable'] = 'Nếu được bật, hình ảnh và biểu định kiểu sẽ không được lưu vào bộ nhớ đệm, dẫn đến giảm hiệu suất đáng kể.';
$string['check_themedesignermode_comment_enable'] = 'Nếu bị tắt, hình ảnh và biểu định kiểu sẽ được lưu vào bộ nhớ đệm, dẫn đến cải thiện hiệu suất đáng kể.';
$string['check_themedesignermode_details'] = 'Đây thường là nguyên nhân khiến các trang Moodle chạy chậm. <p> Trung bình có thể cần ít nhất gấp đôi lượng CPU để chạy một trang web Moodle có bật chế độ thiết kế chủ đề. </p>';
$string['comments'] = 'Bình luận';
$string['disabled'] = 'Đã Tắt';
$string['edit'] = 'Chỉnh sửa';
$string['enabled'] = 'Đã bật';
$string['issue'] = 'Vấn đề';
$string['morehelp'] = 'Cần giúp đỡ nhiều hơn';
$string['performance:view'] = 'Xem báo cáo hiệu suất';
$string['performancereportdesc'] = 'Báo cáo này liệt kê các vấn đề có thể ảnh hưởng đến hiệu suất của trang web {$a}';
$string['pluginname'] = 'Tổng quan về hiệu suất';
$string['privacy:metadata'] = 'Plugin tổng quan về Hiệu suất không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['value'] = 'Giá trị';
