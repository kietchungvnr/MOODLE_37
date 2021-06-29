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
 * @package    workshopallocation
 * @subpackage scheduled
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['crontask'] = 'Xử lý nền để phân bổ theo lịch trình';
$string['currentstatus'] = 'Tình trạng hiện tại';
$string['currentstatusexecution'] = 'Trạng thái';
$string['currentstatusexecution1'] = 'Đã thực thi vào {$a->datetime}';
$string['currentstatusexecution2'] = 'Để được thực thi lại vào {$a->datetime}';
$string['currentstatusexecution3'] = 'Được thực thi vào {$a->datetime}';
$string['currentstatusexecution4'] = 'Đang chờ thực thi';
$string['currentstatusnext'] = 'Lần thực hiện tiếp theo';
$string['currentstatusnext_help'] = 'Trong một số trường hợp, phân bổ được lên lịch để tự động thực thi lại ngay cả khi nó đã được thực thi. Điều này có thể xảy ra nếu thời hạn nộp hồ sơ bị kéo dài, chẳng hạn.';
$string['currentstatusreset'] = 'Đặt lại';
$string['currentstatusreset_help'] = 'Lưu biểu mẫu với hộp kiểm này được đánh dấu sẽ dẫn đến việc đặt lại trạng thái hiện tại. Tất cả thông tin về lần thực thi trước đó sẽ bị xóa để phân bổ có thể được thực thi lại (nếu được bật ở trên).';
$string['currentstatusresetinfo'] = 'Chọn hộp và lưu biểu mẫu để đặt lại kết quả thực thi';
$string['currentstatusresult'] = 'Kết quả thực hiện gần đây';
$string['enablescheduled'] = 'Bật phân bổ theo lịch trình';
$string['enablescheduledinfo'] = 'Tự động phân bổ các bài nộp vào cuối giai đoạn gửi';
$string['pluginname'] = 'Phân bổ theo lịch trình';
$string['privacy:metadata'] = 'Plugin phân bổ theo lịch trình không lưu trữ bất kỳ dữ liệu cá nhân nào. Dữ liệu cá nhân thực tế về người sẽ đánh giá ai được chính mô-đun Hội thảo lưu trữ và chúng là cơ sở để xuất các chi tiết đánh giá.';
$string['randomallocationsettings'] = 'Cài đặt phân bổ';
$string['randomallocationsettings_help'] = 'Các tham số cho phương pháp phân bổ ngẫu nhiên được xác định ở đây. Chúng sẽ được plugin phân bổ ngẫu nhiên sử dụng để phân bổ thực tế các bài nộp.';
$string['resultdisabled'] = 'Đã vô hiệu hóa phân bổ theo lịch trình';
$string['resultenabled'] = 'Đã bật phân bổ theo lịch trình';
$string['resultexecuted'] = 'Thành công';
$string['resultfailed'] = 'Không thể tự động phân bổ các bài nộp';
$string['resultfailedconfig'] = 'Đã định cấu hình sai phân bổ đã lên lịch';
$string['resultfaileddeadline'] = 'Hội thảo không xác định thời hạn gửi';
$string['resultfailedphase'] = 'Hội thảo không trong giai đoạn gửi';
$string['resultvoid'] = 'Không có bài nộp nào được phân bổ';
$string['resultvoiddeadline'] = 'Chưa hết hạn nộp hồ sơ';
$string['resultvoidexecuted'] = 'Phân bổ đã được thực hiện';
$string['scheduledallocationsettings'] = 'Cài đặt phân bổ theo lịch trình';
$string['scheduledallocationsettings_help'] = 'Nếu được kích hoạt, phương pháp phân bổ theo lịch trình sẽ tự động phân bổ các bài nộp để đánh giá vào cuối giai đoạn gửi. Kết thúc giai đoạn có thể được xác định trong cài đặt hội thảo \'Thời hạn nộp hồ sơ\'. Trong nội bộ, phương pháp phân bổ ngẫu nhiên được thực hiện với các tham số được xác định trước trong biểu mẫu này. Nó có nghĩa là phân bổ theo lịch trình hoạt động như thể giáo viên tự thực hiện phân bổ ngẫu nhiên vào cuối giai đoạn gửi bằng cách sử dụng cài đặt phân bổ bên dưới. Lưu ý rằng phân bổ theo lịch trình * không * được thực hiện nếu bạn chuyển hội thảo theo cách thủ công sang giai đoạn đánh giá trước thời hạn nộp hồ sơ. Bạn phải tự mình phân bổ các bài nộp trong trường hợp đó. Phương pháp phân bổ theo lịch trình đặc biệt hữu ích khi được sử dụng cùng với tính năng chuyển pha tự động.';
$string['setup'] = 'Thiết lập phân bổ theo lịch trình';
