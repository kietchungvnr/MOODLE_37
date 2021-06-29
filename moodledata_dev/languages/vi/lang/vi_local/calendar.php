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
 * @package    core
 * @subpackage calendar
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activityevent'] = 'Hoạt động sự kiện';
$string['categoryevent'] = 'Danh mục sự kiện';
$string['categoryevents'] = 'Danh mục các sự kiện';
$string['confirmeventseriesdelete'] = 'Sự kiện "{$a->name}" là một phần của chuỗi sự kiện. Bạn muốn chỉ xóa sự kiện này hay tất cả {$a->count} sự kiện trong chuỗi?';
$string['daynext'] = 'Ngày tiếp theo';
$string['dayprev'] = 'Ngày trước';
$string['deleteallevents'] = 'Xóa tất cả sự kiện';
$string['deleteoneevent'] = 'Xóa sự kiện này';
$string['errorhasuntilandcount'] = 'UNTIL hoặc COUNT có thể xuất hiện trong một quy tắc lặp lại, nhưng UNTIL và COUNT KHÔNG PHẢI xuất hiện trong cùng một quy tắc lặp lại.';
$string['errorinvalidbydayprefix'] = 'Giá trị số nguyên trước quy tắc BYDAY chỉ có thể hiển thị cho quy tắc lặp lại HÀNG THÁNG hoặc HÀNG NĂM.';
$string['errorinvalidbydaysuffix'] = 'Các giá trị hợp lệ cho các phần ngày trong tuần của quy tắc BYDAY là MO, TU, WE, TH, FR, SA và SU';
$string['errorinvalidbyhour'] = 'Các giá trị hợp lệ cho quy tắc BYHOUR là 0 đến 23.';
$string['errorinvalidbyminute'] = 'Các giá trị hợp lệ cho quy tắc BYMINUTE là 0 đến 59.';
$string['errorinvalidbymonth'] = 'Các giá trị hợp lệ cho quy tắc BYMONTH là 1 đến 12.';
$string['errorinvalidbymonthday'] = 'Các giá trị hợp lệ cho quy tắc BYMONTHDAY là 1 đến 31 hoặc -31 đến -1.';
$string['errorinvalidbysecond'] = 'Các giá trị hợp lệ cho quy tắc BYSECOND là 0 đến 59.';
$string['errorinvalidbysetpos'] = 'Các giá trị hợp lệ cho quy tắc BYSETPOS là 1 đến 366 hoặc -366 đến -1.';
$string['errorinvalidbyweekno'] = 'Các giá trị hợp lệ cho quy tắc BYWEEKNO là 1 đến 53 hoặc -53 đến -1.';
$string['errorinvalidbyyearday'] = 'Các giá trị hợp lệ cho quy tắc BYYEARDAY là 1 đến 366 hoặc -366 đến -1.';
$string['errorinvaliddate'] = 'Ngày không khả dụng';
$string['errorinvalidinterval'] = 'Giá trị cho quy tắc INTERVAL phải là một số nguyên dương.';
$string['errormustbeusedwithotherbyrule'] = 'Quy tắc BYSETPOS chỉ được sử dụng cùng với một phần quy tắc BYxxx khác.';
$string['errornonyearlyfreqwithbyweekno'] = 'Quy tắc BYWEEKNO chỉ có hiệu lực cho quy tắc HÀNG NĂM.';
$string['eventendtimewrapped'] = '{$a} (Thời gian kết thúc)';
$string['events'] = 'Sự kiện';
$string['eventsource'] = 'Nguồn sự kiện';
$string['eventspersonal'] = 'Các sự kiện cá nhân';
$string['eventsrelatedtocategories'] = 'Các sự kiện liên quan đến danh mục';
$string['eventsrelatedtogroups'] = 'Các sự kiện liên quan đến nhóm';
$string['eventsskipped'] = 'Sự kiện bị bỏ qua: {$a}';
$string['eventstoexport'] = 'Xuất các sự kiện';
$string['eventsubscriptioncreated'] = 'Đăng ký lịch đã được tạo';
$string['eventsubscriptiondeleted'] = 'Đăng ký lịch đã bị xóa';
$string['eventsubscriptioneditwarning'] = 'Sự kiện lịch này là một phần của đăng ký. Mọi thay đổi bạn thực hiện đối với sự kiện này sẽ bị mất nếu đăng ký bị xóa.';
$string['eventsubscriptionupdated'] = 'Đã cập nhật đăng ký lịch';
$string['eventtype'] = 'Loại sự kiện';
$string['eventtypecategory'] = 'danh mục';
$string['eventtypecourse'] = 'khóa học';
$string['eventtypeglobal'] = 'Chung';
$string['eventtypegroup'] = 'nhóm';
$string['eventtypemodule'] = 'mô-đun';
$string['eventtypesite'] = 'chung';
$string['eventtypeuser'] = 'người dùng';
$string['eventview'] = 'Chi tiết sự kiện';
$string['exporthelp'] = 'Làm cách nào để tôi đăng ký lịch này từ một ứng dụng lịch (Google/Outlook/Other)?';
$string['gotoactivity'] = 'Đi tới hoạt động';
$string['hideeventtype'] = 'Ẩn các sự kiện {$a}';
$string['invalideventtype'] = 'Loại sự kiện bạn đã chọn không hợp lệ.';
$string['less'] = 'Ít hơn';
$string['monthprev'] = 'Tháng trước';
$string['more'] = 'Nhiều hơn';
$string['preferences_available'] = 'Sở thích cá nhân của bạn';
$string['privacy:metadata:calendar:event'] = 'Thành phần Lịch có thể lưu trữ chi tiết sự kiện lịch của người dùng trong hệ thống con cốt lõi.';
$string['privacy:metadata:calendar:event:description'] = 'Mô tả của sự kiện lịch.';
$string['privacy:metadata:calendar:event:eventtype'] = 'Loại sự kiện của sự kiện lịch.';
$string['privacy:metadata:calendar:event:name'] = 'Tên của sự kiện lịch.';
$string['privacy:metadata:calendar:event:timeduration'] = 'Thời lượng của sự kiện lịch.';
$string['privacy:metadata:calendar:event:timestart'] = 'Thời gian bắt đầu của sự kiện lịch.';
$string['privacy:metadata:calendar:event_subscriptions'] = 'Thành phần Lịch có thể lưu trữ chi tiết đăng ký lịch của người dùng trong hệ thống con cốt lõi.';
$string['privacy:metadata:calendar:event_subscriptions:eventtype'] = 'Loại sự kiện của đăng ký lịch.';
$string['privacy:metadata:calendar:event_subscriptions:name'] = 'Tên của đăng ký lịch.';
$string['privacy:metadata:calendar:event_subscriptions:url'] = 'Url của đăng ký lịch.';
$string['privacy:metadata:calendar:preferences:calendar_savedflt'] = 'Loại sự kiện lịch đã định cấu hình hiển thị tùy chọn người dùng.';
$string['showeventtype'] = 'Hiển thị {$a} sự kiện';
$string['subscriptionsource'] = 'Nguồn sự kiện: {$a}';
$string['timeperiod'] = 'Khoảng thời gian';
$string['todayplustitle'] = 'Hôm nay {$a}';
$string['typecategory'] = 'Sự kiện hạng mục';
$string['typeclose'] = 'Sự kiện đóng';
$string['typedue'] = 'Sự kiện hết hạn';
$string['typegradingdue'] = 'Sự kiện chấm điểm';
$string['typeopen'] = 'Sự kiện mở';
$string['viewupcomingactivitiesdue'] = 'Xem các hoạt động sắp tới hạn';
$string['when'] = 'Khi';
