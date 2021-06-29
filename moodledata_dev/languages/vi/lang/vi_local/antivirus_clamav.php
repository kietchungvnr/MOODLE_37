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
 * @package    antivirus
 * @subpackage clamav
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['clamfailureonupload'] = 'Khi bị lỗi ClamAV';
$string['configclamactlikevirus'] = 'Xử lý tệp vi-rút';
$string['configclamdonothing'] = 'Xử lý các tệp là OK';
$string['configclamfailureonupload'] = 'Nếu bạn đã định cấu hình để quét các tệp đã tải lên, nhưng nó được định cấu hình không chính xác hoặc không chạy được vì một số lý do không xác định, thì nó phải hoạt động như thế nào? Nếu bạn chọn \'Xử lý tệp như vi-rút\', chúng sẽ được chuyển vào khu vực cách ly hoặc bị xóa. Nếu bạn chọn \'Xử lý tệp là OK\', tệp sẽ được chuyển đến thư mục đích như bình thường. Dù bằng cách nào, quản trị viên sẽ được thông báo rằng ngao không thành công. Nếu bạn chọn \'Xử lý tệp như vi-rút\' và vì một lý do nào đó, ngao không chạy được (thường là do bạn đã nhập đường dẫn không hợp lệ), TẤT CẢ các tệp được tải lên sẽ được chuyển đến khu vực cách ly nhất định ho
ặc bị xóa. Hãy cẩn thận với cài đặt này.';
$string['errorcantopensocket'] = 'Kết nối với ổ cắm miền Unix dẫn đến lỗi {$a}';
$string['errorclamavnoresponse'] = 'ClamAV không phản hồi; kiểm tra trạng thái chạy daemon.';
$string['errornounixsocketssupported'] = 'Hệ thống này không hỗ trợ truyền tải ổ cắm miền Unix. Vui lòng sử dụng tùy chọn dòng lệnh thay thế.';
$string['pathtoclam'] = 'Dòng lệnh';
$string['pathtoclamdesc'] = 'Nếu phương thức đang chạy được đặt thành "dòng lệnh", hãy nhập đường dẫn đến ClamAV tại đây. Trên Linux, nó sẽ là / usr / bin / 
clamscan hoặc / usr / bin / clamscan.';
$string['pathtounixsocket'] = 'Ổ cắm miền Unix';
$string['pathtounixsocketdesc'] = 'Nếu phương thức đang chạy được đặt thành "Ổ cắm miền Unix", hãy nhập đường dẫn đến ổ cắm ClamAV Unix tại đây. Trên Debian Linux, nó sẽ là /var/run/clamav/clamd.ctl. Vui lòng đảm bảo rằng daemonemonav có quyền đọc các tệp đã tải lên, cách dễ nhất để đảm bảo điều đó là thêm người dùng \'ngaoav\' vào nhóm máy chủ web của bạn (\'www-data\' trên Debian Linux).';
$string['pluginname'] = 'Chống vi-rút ClamAV';
$string['privacy:metadata'] = 'Plugin chống vi-rút ClamAV không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['quarantinedir'] = 'Thư mục cách ly';
$string['runningmethod'] = 'Phương thức chạy';
$string['runningmethodcommandline'] = 'Dòng lệnh';
$string['runningmethoddesc'] = 'Phương pháp chạy ClamAV. Dòng lệnh được sử dụng theo mặc định, tuy nhiên trên hệ thống Unix, hiệu suất tốt hơn có thể đạt được 
bằng cách sử dụng ổ cắm hệ thống.';
$string['runningmethodunixsocket'] = 'Ổ cắm miền Unix';
