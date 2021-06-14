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
 * @subpackage generator
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bigfile'] = 'Tệp lớn {$a}';
$string['courseexplanation'] = 'Công cụ này tạo ra các khóa học kiểm tra tiêu chuẩn bao gồm nhiều phần, hoạt động và tệp. Điều này nhằm cung cấp một thước đo tiêu chuẩn để kiểm tra độ tin cậy và hiệu suất của các thành phần hệ thống khác nhau (chẳng hạn như sao lưu và khôi phục). Việc kiểm tra này rất quan trọng vì trước đây đã có nhiều trường hợp đối mặt với các trường hợp sử dụng thực tế (ví dụ: một khóa học có 1.000 hoạt động), hệ thống không hoạt động. Các khóa học được tạo bằng tính năng này có thể chiếm một lượng lớn không gian cơ sở dữ liệu và hệ thống tệp (hàng chục gigabyte). Bạn sẽ cần phải xóa các khóa học (và đợi các lần dọn dẹp khác nhau) để giải phóng lại dung lượng này. ** Không sử dụng tính năng này trên hệ thống trực tiếp **. Chỉ sử dụng trên máy chủ của nhà phát triển. (Để tránh sử dụng ngẫu nhiên, tính năng này bị tắt trừ khi bạn cũng đã chọn cấp gỡ lỗi DEVELOPER.';
$string['coursesize_0'] = 'XS (~ 10KB; tạo trong ~ 1 giây)';
$string['coursesize_1'] = 'S (~ 10MB; tạo trong ~ 30 giây)';
$string['coursesize_2'] = 'M (~ 100MB; tạo trong ~ 2 phút)';
$string['coursesize_3'] = 'L (~ 1GB; tạo trong ~ 30 phút)';
$string['coursesize_4'] = 'XL (~ 10GB; tạo trong ~ 2 giờ)';
$string['coursesize_5'] = 'XXL (~ 20GB; tạo trong ~ 4 giờ)';
$string['coursewithoutusers'] = 'Khóa học đã chọn không có người dùng';
$string['createcourse'] = 'Tạo khóa học';
$string['createtestplan'] = 'Tạo kế hoạch thử nghiệm';
$string['creating'] = 'Tạo khóa học';
$string['done'] = 'xong ({$a} s)';
$string['downloadtestplan'] = 'Tải xuống kế hoạch thử nghiệm';
$string['downloadusersfile'] = 'Tải xuống tệp người dùng';
$string['error_nocourses'] = 'Không có khóa học nào để tạo kế hoạch kiểm tra';
$string['error_noforumdiscussions'] = 'Khóa học đã chọn không chứa các cuộc thảo luận trên diễn đàn';
$string['error_noforuminstances'] = 'Khóa học đã chọn không chứa các phiên bản mô-đun diễn đàn';
$string['error_noforumreplies'] = 'Khóa học đã chọn không chứa các câu trả lời trên diễn đàn';
$string['error_nonexistingcourse'] = 'Khóa học được chỉ định không tồn tại';
$string['error_nopageinstances'] = 'Khóa học đã chọn không chứa các phiên bản mô-đun trang';
$string['error_notdebugging'] = 'Không khả dụng trên máy chủ này vì gỡ lỗi không được đặt thành DEVELOPER';
$string['error_nouserspassword'] = 'Bạn cần đặt $CFG->tool_generator_users_password trong config.php để tạo kế hoạch thử nghiệm';
$string['fullname'] = 'Khóa học thử nghiệm: {$a->size}';
$string['maketestcourse'] = 'Lập kế hoạch kiểm tra khóa';
$string['maketestplan'] = 'Lập kế hoạch kiểm tra JMeter';
$string['notenoughusers'] = 'Khóa học đã chọn không có đủ người dùng';
$string['pluginname'] = 'Trình tạo dữ liệu phát triển';
$string['privacy:metadata'] = 'Plugin trình tạo dữ liệu phát triển không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['progress_checkaccounts'] = 'Kiểm tra tài khoản người dùng ({$a})';
$string['progress_coursecompleted'] = 'Khóa học đã hoàn thành ({$a} s)';
$string['progress_createaccounts'] = 'Tạo tài khoản người dùng ({$a->from} - {$a->to})';
$string['progress_createassignments'] = 'Tạo bài tập ({$a})';
$string['progress_createbigfiles'] = 'Tạo tệp lớn ({$a})';
$string['progress_createcourse'] = 'Tạo khóa học {$a}';
$string['progress_createforum'] = 'Tạo diễn đàn ({$a} bài đăng)';
$string['progress_createpages'] = 'Tạo trang ({$a})';
$string['progress_createsmallfiles'] = 'Tạo tệp nhỏ ({$a})';
$string['progress_enrol'] = 'Đăng ký người dùng tham gia khóa học ({$a})';
$string['progress_sitecompleted'] = 'Trang web đã hoàn thành ({$a}s)';
$string['shortsize_0'] = 'XS';
$string['shortsize_1'] = 'S';
$string['shortsize_2'] = 'M';
$string['shortsize_3'] = 'L';
$string['shortsize_4'] = 'XL';
$string['shortsize_5'] = 'XXL';
$string['sitesize_0'] = 'XS (~ 10MB; 3 khóa học, được tạo trong ~ 30 giây)';
$string['sitesize_1'] = 'S (~ 50MB; 8 khóa học, được tạo trong ~ 2 phút)';
$string['sitesize_2'] = 'M (~ 200MB; 73 khóa học, được tạo trong ~ 10 phút)';
$string['sitesize_3'] = 'L (~ 1\'5GB; 277 khóa học, được tạo trong ~ 1\'5 giờ)';
$string['sitesize_4'] = 'XL (~ 10GB; 1065 khóa học, được tạo trong ~ 5 giờ)';
$string['sitesize_5'] = 'XXL (~ 20GB; 4177 khóa học, được tạo trong ~ 10 giờ)';
$string['size'] = 'Kích thước tất nhiên';
$string['smallfiles'] = 'Tệp nhỏ';
$string['targetcourse'] = 'Kiểm tra mục tiêu khóa học';
$string['testplanexplanation'] = 'Công cụ này tạo tệp kế hoạch kiểm tra JMeter cùng với tệp thông tin xác thực người dùng. Kế hoạch thử nghiệm này được thiết kế để hoạt động cùng với {$a}, giúp chạy kế hoạch thử nghiệm dễ dàng hơn trong môi trường Moodle cụ thể, thu thập thông tin về các lần chạy và so sánh kết quả, vì vậy bạn cần tải xuống và sử dụng test_runner. tập lệnh sh hoặc làm theo hướng dẫn cài đặt và sử dụng. Bạn cần đặt mật khẩu cho người dùng khóa học trong config.php (ví dụ: $CFG->tool_generator_users_password = \'moodle\';). Không có giá trị mặc định cho mật khẩu này để ngăn việc sử dụng công cụ ngoài ý muốn. Bạn cần sử dụng tùy chọn cập nhật mật khẩu trong trường hợp người dùng khóa học của bạn có mật khẩu khác hoặc chúng được tạo bởi tool_generator nhưng không đặt giá trị $CFG->tool_generator_users_password. Nó là một phần của tool_generator vì vậy nó hoạt động tốt với các khóa học được tạo bởi các khóa học và trình tạo trang web, nó cũng có thể được sử dụng với bất kỳ khóa học nào có chứa, ít nhất: * Đủ người dùng đã đăng ký (tùy thuộc vào kích thước kế hoạch kiểm tra bạn chọn) với mật khẩu được đặt lại thành \'moodle\' * Phiên bản mô-đun trang * Phiên bản mô-đun diễn đàn với ít nhất một cuộc thảo luận và một câu trả lời Bạn có thể muốn xem xét dung lượng máy chủ của mình khi chạy các kế hoạch thử nghiệm lớn vì lượng tải do JMeter tạo ra có thể đặc biệt lớn . Thời gian tăng tốc đã được điều chỉnh theo số lượng chủ đề (người dùng) để giảm bớt loại vấn đề này nhưng tải vẫn rất lớn. ** Không chạy kế hoạch thử nghiệm trên hệ thống đang hoạt động **. Tính năng này chỉ tạo các tệp để cấp cho JMeter nên bản thân nó không nguy hiểm, nhưng bạn nên ** KHÔNG BAO GIỜ ** chạy kế hoạch thử nghiệm này trong trang web sản xuất.';
$string['testplansize_0'] = 'XS ({$a->users} người dùng, vòng lặp {$a->loops} và khoảng thời gian tăng tốc {$a->traceup})';
$string['testplansize_1'] = 'S ({$a->users} người dùng, vòng lặp {$a->loops} và khoảng thời gian tăng tốc {$a->traceup})';
$string['testplansize_2'] = 'M ({$a->users} người dùng, vòng lặp {$a->loops} và giai đoạn tăng tốc {$a->traceup})';
$string['testplansize_3'] = 'L ({$a->users} người dùng, vòng lặp {$a->loops} và khoảng thời gian tăng tốc {$a->traceup})';
$string['testplansize_4'] = 'XL ({$a->users} người dùng, vòng lặp {$a->loops} và khoảng thời gian tăng tốc {$a->traceup})';
$string['testplansize_5'] = 'XXL ({$a->users} người dùng, vòng lặp {$a->loops} và khoảng thời gian tăng tốc {$a->traceup})';
$string['updateuserspassword'] = 'Cập nhật mật khẩu người dùng khóa học';
$string['updateuserspassword_help'] = 'JMeter cần đăng nhập với tư cách người dùng khóa học, bạn có thể đặt mật khẩu người dùng bằng $CFG->tool_generator_users_password trong config.php; cài đặt này cập nhật mật khẩu của người dùng khóa học theo $CFG->tool_generator_users_password. Nó có thể hữu ích trong trường hợp bạn đang sử dụng một khóa học không được tạo bởi tool_generator hoặc $CFG->tool_generator_users_password không được đặt khi bạn tạo các khóa học thử nghiệm.';
