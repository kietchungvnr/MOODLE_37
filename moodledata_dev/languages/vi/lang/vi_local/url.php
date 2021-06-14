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
 * @package    mod
 * @subpackage url
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['chooseavariable'] = 'Chọn một biến ...';
$string['clicktoopen'] = 'Nhấp vào liên kết {$a} để mở tài nguyên.';
$string['configdisplayoptions'] = 'Chọn tất cả các tùy chọn sẽ có sẵn, các cài đặt hiện có không được sửa đổi. Giữ phím CTRL để chọn nhiều trường.';
$string['configframesize'] = 'Khi một trang web hoặc một tệp đã tải lên được hiển thị trong một khung, giá trị này là chiều cao (tính bằng pixel) của khung trên cùng 
(chứa điều hướng).';
$string['configrolesinparams'] = 'Bật nếu bạn muốn bao gồm tên vai trò đã bản địa hóa trong danh sách các biến tham số có sẵn.';
$string['configsecretphrase'] = 'Cụm từ bí mật này được sử dụng để tạo ra giá trị mã được mã hóa có thể được gửi đến một số máy chủ dưới dạng tham số. Mã được mã hóa 
được tạo bởi giá trị md5 của địa chỉ IP người dùng hiện tại được nối với cụm từ bí mật của bạn. tức là mã = ​​md5 (IP.secretphrase). Xin lưu ý rằng điều này không đáng tin cậy vì địa chỉ IP có thể thay đổi và thường được chia sẻ bởi các máy tính khác nhau.';
$string['contentheader'] = 'Nội dung';
$string['createurl'] = 'Tạo một URL';
$string['displayoptions'] = 'Các tùy chọn hiển thị có sẵn';
$string['displayselect'] = 'Hiển thị';
$string['displayselect_help'] = 'Cài đặt này, cùng với loại tệp URL và trình duyệt có cho phép nhúng hay không, sẽ xác định cách URL được hiển thị. Các tùy chọn có thể bao gồm: * Tự động - Tùy chọn hiển thị tốt nhất cho URL được chọn tự động * Nhúng - URL được hiển thị trong trang bên dưới thanh điều hướng cùng với mô tả URL và bất kỳ khối nào * Mở - Chỉ URL được hiển thị trong trình duyệt cửa sổ * Trong cửa sổ bật lên - URL được hiển thị trong cửa sổ trình duyệt mới không có menu hoặc thanh địa chỉ * Trong khung - URL được hiển thị trong khung bên dưới thanh điều hướng và mô tả URL * Cửa sổ mới - URL được hiển thị trong một cửa sổ trình duyệt mới với các menu và thanh địa chỉ';
$string['displayselectexplain'] = 'Chọn loại hiển thị, tiếc là không phải tất cả các loại đều phù hợp với tất cả các URL.';
$string['externalurl'] = 'URL bên ngoài';
$string['framesize'] = 'Chiều cao khung';
$string['indicator:cognitivedepth'] = 'URL nhận thức';
$string['indicator:cognitivedepth_help'] = 'Chỉ số này dựa trên độ sâu nhận thức mà sinh viên đạt được trong tài nguyên URL.';
$string['indicator:socialbreadth'] = 'URL xã hội';
$string['indicator:socialbreadth_help'] = 'Chỉ số này dựa trên phạm vi xã hội mà sinh viên đạt được trong tài nguyên URL.';
$string['invalidstoredurl'] = 'Không thể hiển thị tài nguyên này, URL không hợp lệ.';
$string['invalidurl'] = 'URL đã nhập không hợp lệ';
$string['modulename_help'] = 'Mô-đun URL cho phép giáo viên cung cấp liên kết web làm tài nguyên khóa học. Bất cứ thứ gì có sẵn trực tuyến miễn phí, chẳng hạn như tài liệu hoặc hình ảnh, đều có thể được liên kết với; URL không nhất thiết phải là trang chủ của một trang web. URL của một trang web cụ thể có thể được sao chép và dán hoặc giáo viên có thể sử dụng bộ chọn tệp và chọn liên kết từ hệ thống lưu trữ như Flickr, YouTube hoặc Wikimedia (tùy thuộc vào hệ thống lưu trữ nào được kích hoạt cho trang web). Có một số tùy chọn hiển thị cho URL, chẳng hạn như nhúng hoặc mở trong cửa sổ mới và các tùy chọn nâng cao để chuyển thông tin, chẳng hạn như tên của sinh viên, đến URL nếu được yêu cầu. Lưu ý rằng URL cũng có thể được thêm vào bất kỳ loại tài nguyên hoặc hoạt động nào khác thông qua trình soạn thảo văn bản.';
$string['modulenameplural'] = 'URL';
$string['page-mod-url-x'] = 'Bất kỳ trang mô-đun URL nào';
$string['parameterinfo'] = '& amp; tham số = biến';
$string['parametersheader'] = 'Biến URL';
$string['parametersheader_help'] = 'Một số biến Moodle nội bộ có thể được tự động thêm vào URL. Nhập tên của bạn cho tham số vào mỗi hộp văn bản và sau đó chọn biến phù hợp bắt buộc.';
$string['pluginadministration'] = 'Quản trị mô-đun URL';
$string['popupheight'] = 'Chiều cao cửa sổ bật lên (tính bằng pixel)';
$string['popupheightexplain'] = 'Chỉ định chiều cao mặc định của cửa sổ bật lên.';
$string['popupwidth'] = 'Chiều rộng cửa sổ bật lên (tính bằng pixel)';
$string['popupwidthexplain'] = 'Chỉ định chiều rộng mặc định của cửa sổ bật lên.';
$string['printintro'] = 'Mô tả URL hiển thị';
$string['printintroexplain'] = 'Hiển thị mô tả URL bên dưới nội dung? Một số kiểu hiển thị có thể không hiển thị mô tả ngay cả khi được bật.';
$string['privacy:metadata'] = 'Plugin tài nguyên URL không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['rolesinparams'] = 'Bao gồm tên vai trò trong các tham số';
$string['serverurl'] = 'URL máy chủ';
$string['url:addinstance'] = 'Thêm tài nguyên URL mới';
