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
 * @subpackage installaddon
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['acknowledgement'] = 'Nhìn nhận';
$string['acknowledgementtext'] = 'Tôi hiểu rằng trách nhiệm của tôi là phải có các bản sao lưu đầy đủ của trang web này trước khi cài đặt các plugin bổ sung. Tôi chấp
 nhận và hiểu rằng các plugin (đặc biệt không chỉ những plugin bắt nguồn từ các nguồn không chính thức) có thể chứa các lỗ hổng bảo mật, có thể làm cho trang web không khả dụng hoặc gây rò rỉ hoặc mất mát dữ liệu cá nhân.';
$string['featuredisabled'] = 'Trình cài đặt plugin bị tắt trên trang web này.';
$string['installaddon'] = 'Cài đặt plugin!';
$string['installaddons'] = 'Cài đặt plugin';
$string['installfromrepo'] = 'Cài đặt các plugin từ thư mục plugin Moodle';
$string['installfromrepo_help'] = 'Bạn sẽ được chuyển hướng đến thư mục plugin Moodle để tìm kiếm và cài đặt plugin. Lưu ý rằng tên đầy đủ, URL và phiên bản Moodle 
của trang web của bạn cũng sẽ được gửi để giúp bạn quá trình cài đặt dễ dàng hơn.';
$string['installfromzip'] = 'Cài đặt plugin từ tệp ZIP';
$string['installfromzip_help'] = 'Một cách thay thế để cài đặt plugin trực tiếp từ thư mục plugin Moodle là tải lên gói ZIP của plugin. Gói ZIP phải có cấu trúc giống 
như một gói được tải xuống từ thư mục plugin Moodle.';
$string['installfromzipfile'] = 'Gói ZIP';
$string['installfromzipfile_help'] = 'Gói ZIP của plugin phải chỉ chứa một thư mục, được đặt tên trùng với tên plugin. ZIP sẽ được trích xuất vào một vị trí thích hợp cho loại
plugin. Nếu gói đã được tải xuống từ thư mục plugin Moodle thì nó sẽ có cấu trúc này.';
$string['installfromzipinvalid'] = 'Gói ZIP của plugin chỉ chứa một thư mục, được đặt tên trùng với tên plugin. Tệp được cung cấp không phải là gói ZIP plugin hợp lệ.';
$string['installfromziprootdir'] = 'Đổi tên thư mục gốc';
$string['installfromziprootdir_help'] = 'Một số gói ZIP, chẳng hạn như những gói được tạo bởi Github, có thể chứa tên thư mục gốc không chính xác. Nếu vậy, tên chính xác 
có thể được nhập ở đây.';
$string['installfromzipsubmit'] = 'Cài đặt plugin từ tệp ZIP';
$string['installfromziptype'] = 'Loại plugin';
$string['installfromziptype_help'] = 'Đối với các plugin khai báo chính xác tên thành phần của chúng, trình cài đặt có thể tự động phát hiện loại plugin. Nếu tính năng tự động phát hiện không thành công, hãy chọn đúng loại plugin theo cách thủ công. Cảnh báo: Quy trình cài đặt có thể không thành công nếu chỉ định loại plugin không chính xác.';
$string['permcheck'] = 'Đảm bảo rằng vị trí gốc của loại plugin có thể ghi được bởi quy trình máy chủ web.';
$string['permcheckerror'] = 'Lỗi khi kiểm tra quyền ghi';
$string['permcheckprogress'] = 'Đang kiểm tra quyền ghi ...';
$string['permcheckrepeat'] = 'Kiểm tra lại';
$string['permcheckresultno'] = 'Vị trí loại trình cắm <em> {$a->path} </em> không thể ghi';
$string['permcheckresultyes'] = 'Vị trí loại trình cắm <em> {$a->path} </em> có thể ghi được';
$string['pluginname'] = 'Trình cài đặt plugin';
$string['privacy:metadata'] = 'Plugin trình cài đặt Plugin không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['remoterequestalreadyinstalled'] = 'Có một yêu cầu cài đặt plugin {$a->name} ({$a->component}) phiên bản {$a->version} từ thư mục plugin Moodle trên trang web 
này. Tuy nhiên, plugin này <strong> đã được cài đặt </strong> trên trang web.';
$string['remoterequestconfirm'] = 'Có một yêu cầu cài đặt plugin <strong> {$a->name} </strong> ({$a->component}) phiên bản {$a->version} từ thư mục plugin Moodle 
trên trang web này. Nếu bạn tiếp tục, gói ZIP của plugin sẽ được tải xuống để xác thực. Chưa có gì được cài đặt.';
$string['remoterequestinvalid'] = 'Có một yêu cầu cài đặt một plugin từ thư mục plugin Moodle trên trang web này. Thật không may, yêu cầu không hợp lệ và do đó 
không thể cài đặt plugin.';
$string['remoterequestnoninstallable'] = 'Có một yêu cầu cài đặt plugin {$a->name} ({$a->component}) phiên bản {$a->version} từ thư mục plugin Moodle trên trang web 
này. Tuy nhiên, kiểm tra trước cài đặt plugin không thành công (mã lý do: {$a->reason}).';
$string['remoterequestpermcheck'] = 'Có một yêu cầu cài đặt plugin {$a->name} ({$a->component}) phiên bản {$a->version} từ thư mục plugin Moodle trên trang web 
này. Tuy nhiên, vị trí <strong> {$a->typepath} </strong> <strong> không thể ghi </strong>. Bạn cần cấp quyền ghi cho người dùng máy chủ web, sau đó nhấn nút tiếp tục để lặp lại kiểm tra.';
$string['remoterequestpluginfoexception'] = 'Rất tiếc ... Đã xảy ra lỗi khi cố gắng lấy thông tin về plugin {$a->name} ({$a->component}) phiên bản {$a->version}. Không thể cà
i đặt plugin. Bật chế độ gỡ lỗi để xem chi tiết về lỗi.';
$string['typedetectionfailed'] = 'Không thể phát hiện loại plugin. Vui lòng chọn loại plugin theo cách thủ công.';
$string['typedetectionmismatch'] = 'Loại plugin đã chọn không khớp với loại được plugin khai báo: {$a}';
