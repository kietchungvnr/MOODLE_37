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
 * @subpackage task
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['asap'] = 'ASAP';
$string['backtoscheduledtasks'] = 'Quay lại nhiệm vụ đã lên lịch';
$string['blocking'] = 'Chặn';
$string['cannotfindthepathtothecli'] = 'Không thể tìm thấy đường dẫn đến tệp thực thi PHP CLI nên việc thực thi tác vụ bị hủy bỏ. Đặt cài đặt \'Đường dẫn đến PHP CLI\' trong Quản trị trang web / Đường dẫn máy chủ / Hệ thống.';
$string['clearfaildelay_confirm'] = 'Bạn có chắc chắn muốn xóa lỗi trễ cho tác vụ \'{$a}\' không? Sau khi xóa độ trễ, tác vụ sẽ chạy theo lịch trình bình thường của nó.';
$string['component'] = 'Thành phần';
$string['corecomponent'] = 'Core';
$string['default'] = 'Mặc định';
$string['disabled'] = 'Vô hiệu hóa';
$string['disabled_help'] = 'Các tác vụ đã lên lịch đã tắt không được thực thi từ cron, tuy nhiên chúng vẫn có thể được thực thi theo cách thủ công thông qua công cụ CLI.';
$string['edittaskschedule'] = 'Chỉnh sửa lịch công việc: {$a}';
$string['enablerunnow'] = 'Cho phép \'Chạy ngay bây giờ\' cho các tác vụ đã lên lịch';
$string['enablerunnow_desc'] = 'Cho phép quản trị viên chạy một tác vụ đã lên lịch ngay lập tức, thay vì đợi nó chạy theo lịch trình. Tính năng này yêu cầu đặt \'Đường dẫn tới PHP CLI\' (pathtophp) trong Đường dẫn hệ thống. Tác vụ chạy trên máy chủ web, vì vậy bạn có thể tắt tính năng này để tránh các vấn đề về hiệu suất tiềm ẩn.';
$string['faildelay'] = 'Trì hoãn thất bại';
$string['lastruntime'] = 'Lần chạy cuối cùng';
$string['nextruntime'] = 'Lần chạy tiếp theo';
$string['plugindisabled'] = 'Đã vô hiệu hóa plugin';
$string['pluginname'] = 'Cấu hình tác vụ đã lên lịch';
$string['privacy:metadata'] = 'Plugin cấu hình tác vụ đã lên lịch không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['resettasktodefaults'] = 'Đặt lại lịch tác vụ về mặc định';
$string['resettasktodefaults_help'] = 'Thao tác này sẽ loại bỏ mọi thay đổi cục bộ và hoàn nguyên lịch trình cho tác vụ này về cài đặt ban đầu.';
$string['runnow'] = 'Chạy bây giờ';
$string['runnow_confirm'] = 'Bạn có chắc chắn muốn chạy tác vụ \'{$a}\' này ngay bây giờ không? Tác vụ sẽ chạy trên máy chủ web và có thể mất một khoảng thời gian để hoàn thành.';
$string['runpattern'] = 'Chạy mẫu';
$string['scheduledtaskchangesdisabled'] = 'Các sửa đổi đối với danh sách nhiệm vụ đã lên lịch đã bị ngăn chặn trong cấu hình Moodle';
$string['scheduledtasks'] = 'Công việc đã lên lịch';
$string['taskdisabled'] = 'Đã tắt tác vụ';
$string['tasklogs'] = 'Nhật ký công việc';
$string['taskscheduleday'] = 'Ngày';
$string['taskscheduleday_help'] = 'Trường ngày trong tháng cho lịch trình tác vụ. Trường sử dụng cùng một định dạng với unix cron. Một số ví dụ là: * <strong> * </strong> Mỗi ngày * <strong> * / 2 </strong> Ngày thứ 2 hàng tuần * <strong> 1 </strong> Ngày đầu tiên của mỗi tháng * <strong> 1,15 </strong> Ngày đầu tiên và ngày 15 hàng tháng';
$string['taskscheduledayofweek'] = 'Ngày trong tuần';
$string['taskscheduledayofweek_help'] = 'Trường ngày trong tuần cho lịch trình tác vụ. Trường sử dụng cùng một định dạng với unix cron. Một số ví dụ là: * <strong> * </strong> Mỗi ngày * <strong> 0 </strong> Chủ Nhật hàng tuần * <strong> 6 </strong> Thứ Bảy hàng tuần * <strong> 1,5 </strong> Thứ Hai hàng tuần và thứ sáu';
$string['taskschedulehour'] = 'Giờ';
$string['taskschedulehour_help'] = 'Trường giờ cho lịch trình tác vụ. Trường sử dụng cùng một định dạng với unix cron. Một số ví dụ là: * <strong> * </strong> Mỗi giờ * <strong> * / 2 </strong> 2 giờ một lần * <strong> 2-10 </strong> Mỗi giờ từ 2 giờ sáng đến 10 giờ sáng (bao gồm cả) * <strong> 2,6,9 </strong> 2 giờ sáng, 6 giờ sáng và 9 giờ sáng';
$string['taskscheduleminute'] = 'Phút';
$string['taskscheduleminute_help'] = 'Trường phút cho lịch trình tác vụ. Trường sử dụng cùng một định dạng với unix cron. Một số ví dụ là: * <strong> * </strong> Mỗi phút * <strong> * / 5 </strong> 5 phút một lần * <strong> 2-10 </strong> Mỗi phút từ 2 đến 10 giờ ( bao gồm) * <strong> 2,6,9 </strong> 2, 6 và 9 phút trước giờ';
$string['taskschedulemonth'] = 'Tháng';
$string['taskschedulemonth_help'] = 'Trường tháng cho lịch trình tác vụ. Trường sử dụng cùng một định dạng với unix cron. Một số ví dụ là: * <strong>*</strong> Hàng tháng * <strong> */2 </strong> Hàng tháng thứ hai * <strong>1</strong> Tháng 1 hàng năm * <strong>1,5</strong> Tháng 1 và tháng 5 hàng năm';
$string['viewlogs'] = 'Xem nhật ký cho {$a}';
