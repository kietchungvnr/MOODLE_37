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
 * @subpackage flatfile
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['encoding'] = 'Mã hóa tệp';
$string['expiredaction'] = 'Hoạt động hết hạn đăng ký';
$string['expiredaction_help'] = 'Chọn hành động để thực hiện khi đăng ký người dùng hết hạn. Xin lưu ý rằng một số dữ liệu người dùng và cài đặt được xóa khỏi khóa học trong quá trình hủy đăng ký khóa 
học.';
$string['filelockedmail'] = 'Không thể xóa tệp văn bản bạn đang sử dụng cho đăng ký dựa trên tệp ({$a}) bằng quy trình cron. Điều này thường có nghĩa là các quyền trên nó bị sai. Vui lòng sửa các 
quyền để Moodle có thể xóa tệp, nếu không nó có thể được xử lý nhiều lần.';
$string['filelockedmailsubject'] = 'Lỗi quan trọng: Tệp đăng ký';
$string['flatfile:manage'] = 'Quản lý đăng ký người dùng theo cách thủ công';
$string['flatfile:unenrol'] = 'Hủy đăng ký người dùng khỏi khóa học theo cách thủ công';
$string['flatfileenrolments'] = 'Đăng ký tệp phẳng (CSV)';
$string['flatfilesync'] = 'Đồng bộ hóa đăng ký tệp phẳng';
$string['location'] = 'Vị trí tập tin';
$string['location_desc'] = 'Chỉ định đường dẫn đầy đủ đến tệp đăng ký. Tệp sẽ tự động bị xóa sau khi xử lý.';
$string['mapping'] = 'Ánh xạ vai trò tệp phẳng';
$string['messageprovider:flatfile_enrolment'] = 'Thông báo đăng ký tệp phẳng';
$string['notifyadmin'] = 'Thông báo cho quản trị viên';
$string['notifyenrolled'] = 'Thông báo cho người dùng đã đăng ký';
$string['notifyenroller'] = 'Thông báo cho người dùng chịu trách nhiệm đăng ký';
$string['pluginname'] = 'Tệp gửi nhanh (CSV)';
$string['pluginname_desc'] = 'Phương pháp này sẽ liên tục kiểm tra và xử lý tệp văn bản có định dạng đặc biệt ở vị trí mà bạn chỉ định. Tệp là một tệp được phân tách bằng dấu phẩy được giả định có bốn 
hoặc sáu trường trên mỗi dòng: hoạt động, vai trò, idnumber người dùng, idnumber khóa học [, starttime [, endtime]] trong đó: * operation - add | del * role - học sinh | cô giáo | teaheredit * user idnumber - idnumber trong bảng người dùng NB không phải id * idnumber khóa học - idnumber trong bảng khóa học NB not id * starttime - thời gian bắt đầu (tính bằng giây kể từ kỷ nguyên) - tùy chọn * thời gian kết thúc - thời gian kết thúc (tính bằng giây kể từ kỷ nguyên) - tùy chọn Nó có thể trông giống như sau: <pre class = "informationbox"> thêm, học sinh, 5, CF101 thêm, giáo viên, 6, CF101 thêm, teaheredit, 7, CF101 del, học sinh, 8, CF101 del, học sinh, 17, Thêm CF101, sinh viên, 21, CF101, 1091115000,';
$string['privacy:metadata:enrol_flatfile'] = 'Plugin đăng ký Flat file (CSV) có thể lưu trữ dữ liệu cá nhân liên quan đến việc đăng ký trong tương lai trong bảng enrol_flatfile.';
$string['privacy:metadata:enrol_flatfile:action'] = 'Hành động đăng ký dự kiến ​​vào ngày nhất định';
$string['privacy:metadata:enrol_flatfile:courseid'] = 'ID khóa học liên quan đến đăng ký';
$string['privacy:metadata:enrol_flatfile:roleid'] = 'ID của vai trò được chỉ định hoặc chưa được chỉ định';
$string['privacy:metadata:enrol_flatfile:timeend'] = 'Thời gian kết thúc tuyển sinh';
$string['privacy:metadata:enrol_flatfile:timemodified'] = 'Thời gian đăng ký được sửa đổi';
$string['privacy:metadata:enrol_flatfile:timestart'] = 'Thời điểm bắt đầu tuyển sinh';
$string['privacy:metadata:enrol_flatfile:userid'] = 'ID của người dùng liên quan đến việc phân công vai trò';
