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
 * @subpackage benchmark
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminreport'] = 'Điểm chuẩn hệ thống';
$string['benchfail'] = '<b> Hãy chú ý! </b> <br /> Hiệu suất Moodle của bạn không tối ưu.';
$string['benchmark'] = 'Benchmark hệ thống';
$string['benchmark:view'] = 'Xem báo cáo Điểm chuẩn';
$string['benchshare'] = 'Chia sẻ điểm của tôi trên diễn đàn';
$string['benchsuccess'] = '<b> Xin chúc mừng! </b> <br /> Hiệu suất Moodle của bạn có vẻ hoàn hảo.';
$string['cloadmoreinfo'] = 'Tải tệp cấu hình "config.php"';
$string['cloadname'] = 'Thời gian tải Moodle';
$string['coursereadmoreinfo'] = 'Đọc một khóa học nhiều lần để kiểm tra tốc độ đọc của cơ sở dữ liệu';
$string['coursereadname'] = 'Hiệu suất khóa học đọc';
$string['coursewritemoreinfo'] = 'Viết một khóa học nhiều lần để kiểm tra tốc độ ghi của cơ sở dữ liệu';
$string['coursewritename'] = 'Hiệu suất khóa học viết';
$string['description'] = 'Sự miêu tả';
$string['duration'] = '{$a} s';
$string['during'] = 'Thời gian (giây)';
$string['filereadmoreinfo'] = 'Đọc một tệp nhiều lần để kiểm tra tốc độ đọc của thư mục tạm thời Moodle';
$string['filereadname'] = 'Đọc hiệu suất tệp';
$string['filewritemoreinfo'] = 'Viết một tệp nhiều lần để kiểm tra tốc độ ghi của thư mục tạm thời Moodle';
$string['filewritename'] = 'Ghi hiệu suất tệp';
$string['info'] = 'Điểm chuẩn này sẽ kéo dài dưới 1 phút và sẽ bị hủy bỏ sau 2 phút. Vui lòng đợi cho đến khi kết quả hiển thị.';
$string['infoaverage'] = 'Nên thực hiện thử nghiệm này nhiều lần để thu được giá trị trung bình đáng kể.';
$string['infodisclaimer'] = 'Không nên khởi chạy điểm chuẩn này trên nền tảng sản xuất.';
$string['infodisclamer'] = 'Không nên khởi chạy điểm chuẩn này trên nền tảng sản xuất.';
$string['limit'] = 'Giới hạn cho phép';
$string['loginguestmoreinfo'] = 'Kiểm tra thời gian tải trang đăng nhập tài khoản khách';
$string['loginguestname'] = 'Hiệu suất thời gian đăng nhập cho tài khoản khách';
$string['loginusermoreinfo'] = 'Kiểm tra thời gian tải trang đăng nhập tài khoản người dùng giả mạo';
$string['loginusername'] = 'Hiệu suất thời gian đăng nhập cho tài khoản người dùng giả mạo';
$string['modulename'] = 'Điểm chuẩn Moodle';
$string['modulenameplural'] = 'Điểm chuẩn Moodle';
$string['over'] = 'Giới hạn tới hạn';
$string['pluginname'] = 'Điểm chuẩn Moodle';
$string['points'] = '{$a} điểm';
$string['privacy:no_data_reason'] = 'Các plugin điểm chuẩn báo cáo không tự lưu trữ dữ liệu. Nó chỉ truy cập vào dữ liệu từ các plugin khác';
$string['processormoreinfo'] = 'Gọi một hàm PHP với một vòng lặp để kiểm tra tốc độ bộ xử lý';
$string['processorname'] = 'Tốc độ xử lý của bộ xử lý';
$string['querytype1moreinfo'] = 'Chạy truy vấn SQL phức tạp để kiểm tra tốc độ của cơ sở dữ liệu';
$string['querytype1name'] = 'Hiệu suất cơ sở dữ liệu (#1)';
$string['querytype2moreinfo'] = 'Chạy truy vấn SQL phức tạp để kiểm tra tốc độ của cơ sở dữ liệu';
$string['querytype2name'] = 'Hiệu suất cơ sở dữ liệu (#2)';
$string['redo'] = 'Bắt đầu lại điểm chuẩn';
$string['score'] = 'Ghi bàn';
$string['scoremsg'] = 'Điểm chuẩn:';
$string['seconde'] = '{$a} s';
$string['slowdatabaselabel'] = 'Cơ sở dữ liệu có vẻ quá chậm.';
$string['slowdatabasesolution'] = '<ul> <li> Kiểm tra <a href="https://mariadb.com/kb/en/library/mysqlcheck/" 
target="_blank"> tính toàn vẹn của cơ sở dữ liệu </a>. </li> <li> Tối ưu hóa <a href="https://mariadb.com/kb/en/library/optimization-and-tuning/" target="_blank"> cơ sở dữ liệu </a>. </li> </ul>';
$string['slowharddrivelabel'] = 'Ổ cứng có vẻ quá chậm.';
$string['slowharddrivesolution'] = '<ul> <li> Kiểm tra trạng thái của ổ cứng và / hoặc thư mục tạm thời. </li> <li> Thay đổi ổ cứng và / hoặc thư mục tạm thời. </li> </ul>';
$string['slowprocessorlabel'] = 'Bộ xử lý có vẻ quá chậm.';
$string['slowprocessorsolution'] = '<ul> <li> Kiểm tra xem cấu hình phần cứng của bạn có đủ cao để chạy Moodle không. </li> </ul>';
$string['slowserverlabel'] = 'Máy chủ web có vẻ quá chậm.';
$string['slowserversolution'] = '<ul> <li> Đặt Apache của bạn ở chế độ <a href="https://httpd.apache.org/docs/2.4/en/mpm.html" target="_blank"> đa xử lý </a> hoặc chuyển sang <a href="https://nginx.org/" target="_blank"> NGinx </a>. </li> <li> Nếu Moodle được cài đặt trên máy tính của bạn, hãy định cấu hình cẩn thận chương trình chống vi-rút của bạn để nó không kiểm tra việc cài đặt Moodle. </li> </ul>';
$string['slowweblabel'] = 'Trang đăng nhập đang được tải quá chậm.';
$string['slowwebsolution'] = '<ul> <li> <a href="/admin/purgecaches.php" target="_blank"> Xóa bộ nhớ cache của Moodle </a>. </li> </ul>';
$string['start'] = 'Bắt đầu điểm chuẩn';
$string['total'] = 'Tổng thời gian';
