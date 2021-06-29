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
 * @subpackage behat
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aim'] = 'Công cụ quản trị này giúp các nhà phát triển và người viết thử tạo các tệp .feature mô tả các chức năng của Moodle và chạy chúng tự động. Định nghĩa bước có sẵn để sử dụng trong tệp .feature được liệt kê bên dưới.';
$string['allavailablesteps'] = 'Tất cả các bước định nghĩa có sẵn';
$string['errorapproot'] = '$CFG->behat_ionic_dirroot không trỏ đến cài đặt dành cho nhà phát triển Moodle Mobile hợp lệ.';
$string['errorbehatcommand'] = 'Lỗi khi chạy lệnh CLI behat. Thử chạy "{$a} --help" truy cập theo cách thủ công từ CLI để tìm hiểu thêm về sự cố.';
$string['errorcomposer'] = 'Phần phụ thuộc của trình soạn chưa được cài đặt.';
$string['errordataroot'] = '$CFG->behat_dataroot không được đặt hoặc không hợp lệ.';
$string['errorsetconfig'] = '$CFG->behat_dataroot, $CFG->behat_prefix và $CFG->behat_wwwroot cần được đặt trong config.php.';
$string['erroruniqueconfig'] = 'Giá trị $CFG->behat_dataroot, $CFG->behat_prefix và $CFG->behat_wwwroot cần phải khác với tiền tố $CFG->dataroot, $CFG->prefix , $CFG->wwwroot, $CFG->phpunit_dataroot và $CFG->phpunit_prefix.';
$string['fieldvalueargument'] = 'Đối số giá trị trường';
$string['fieldvalueargument_help'] = 'Đối số này phải được hoàn thành bởi một giá trị trường. Có nhiều loại trường, bao gồm các loại trường đơn giản như hộp kiểm, vùng chọn hoặc vùng văn bản, hoặc các loại 
trường phức tạp như bộ chọn ngày. Xem tài liệu dành cho nhà phát triển <a href="https://docs.moodle.org/dev/Acceptance_testing" target="_blank"> Acceptance_testing </a> để biết chi tiết về các giá trị trường mong đợi.';
$string['giveninfo'] = 'Được. Quy trình thiết lập môi trường';
$string['infoheading'] = 'Thông tin';
$string['installinfo'] = 'Đọc {$a} để biết thông tin thực thi cài đặt và kiểm tra';
$string['newstepsinfo'] = 'Đọc {$a} để biết thông tin về cách thêm định nghĩa bước mới';
$string['newtestsinfo'] = 'Đọc {$a} để biết thông tin về cách viết thử nghiệm mới';
$string['nostepsdefinitions'] = 'Không có bất kỳ định nghĩa bước nào phù hợp với bộ lọc này';
$string['pluginname'] = 'Kiểm tra chấp nhận';
$string['privacy:metadata'] = 'Plugin kiểm tra Chấp nhận không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['stepsdefinitionscomponent'] = 'Khu vực';
$string['stepsdefinitionscontains'] = 'Chứa đựng';
$string['stepsdefinitionsfilters'] = 'Định nghĩa bước';
$string['stepsdefinitionstype'] = 'Kiểu';
$string['theninfo'] = 'Sau đó. Kiểm tra để đảm bảo kết quả đúng như mong đợi';
$string['unknownexceptioninfo'] = 'Đã xảy ra sự cố với Selenium hoặc trình duyệt của bạn. Hãy đảm bảo rằng bạn đang sử dụng phiên bản Selenium mới nhất. Lỗi:';
$string['viewsteps'] = 'Bộ lọc';
$string['wheninfo'] = 'Khi . Hành động kích động sự kiện';
$string['wrongbehatsetup'] = 'Đã xảy ra lỗi với thiết lập behat nên không thể liệt kê định nghĩa bước: <b> {$a->errormsg} </b> <br/> <br/> Vui lòng kiểm tra: <ul> <li> $CFG->behat_dataroot, $CFG->
behat_prefix và $CFG->behat_wwwroot được đặt trong config.php với các giá trị khác nhau từ tiền tố $CFG->dataroot, $CFG->prefix  và $ CFG->wwwroot. </li> <li> Bạn đã chạy "{$a->inherittinit}" từ thư mục gốc Moodle của bạn. </li> <li> Các phần phụ thuộc được cài đặt trong tệp nhà cung cấp / và {$a->behatcommand} có quyền thực thi. </li> </ul>';
