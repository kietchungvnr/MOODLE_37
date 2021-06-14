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
 * @subpackage mnet
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['error_multiplehost'] = 'Một số phiên bản của plugin đăng ký MNet đã tồn tại cho máy chủ này. Chỉ cho phép một phiên bản cho mỗi máy chủ và / hoặc một phiên bản cho \'Tất cả máy chủ\'.';
$string['instancename'] = 'Tên phương thức ghi danh';
$string['instancename_help'] = 'Bạn có thể tùy ý đổi tên phiên bản này của phương thức đăng ký MNet. Nếu bạn để trống trường này, tên phiên bản mặc định sẽ được sử dụng, chứa tên của máy chủ từ
 xa và vai trò được chỉ định cho người dùng của họ.';
$string['mnet:config'] = 'Cấu hình các phiên bản đăng ký MNet';
$string['mnet_enrol_description'] = 'Xuất bản dịch vụ này để cho phép quản trị viên tại {$a} đăng ký học viên của họ vào các khóa học bạn đã tạo trên máy chủ của mình. <br/> <ul><<ul><ul><ul><ul><ul><ul> 
<li> </strong> vào dịch vụ SSO (Nhà cung cấp danh tính) trên {$a}. </li> <li> <em> Sự phụ thuộc </em>: Bạn cũng phải <strong> xuất bản </strong> SSO (Nhà cung cấp dịch vụ ) dịch vụ cho {$a}. </li> </ul> <br/> Đăng ký dịch vụ này để có thể ghi danh sinh viên của bạn vào các khóa học trên {$a}. <br/> <ul> <li> < em> Người phụ thuộc </em>: Bạn cũng phải <strong> xuất bản </strong> dịch vụ SSO (Nhà cung cấp danh tính) lên {$a}. </li> <li> <em> Người phụ thuộc </em>: Bạn phải cũng <strong> đăng ký </strong>tới dịch vụ SSO (Nhà cung cấp dịch vụ) trên {$a}. </li> </ul> <br/>';
$string['mnet_enrol_name'] = 'Dịch vụ ghi danh từ xa';
$string['pluginname'] = 'Đăng ký từ xa MNet';
$string['pluginname_desc'] = 'Cho phép máy chủ MNet từ xa đăng ký người dùng của họ vào các khóa học của chúng tôi.';
$string['privacy:metadata'] = 'Plugin ghi danh từ xa MNet không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['remotesubscriber'] = 'Máy chủ từ xa';
$string['remotesubscriber_help'] = 'Chọn \'Tất cả các máy chủ\' để mở khóa học này cho tất cả các đồng nghiệp MNet mà chúng tôi đang cung cấp dịch vụ ghi danh từ xa. Hoặc chọn một máy chủ duy nhất để 
cung cấp khóa học này chỉ cho người dùng của họ.';
$string['remotesubscribersall'] = 'Tất cả các máy chủ';
$string['roleforremoteusers'] = 'Vai trò đối với người dùng của họ';
$string['roleforremoteusers_help'] = 'Những người dùng từ xa từ máy chủ đã chọn sẽ nhận được vai trò gì.';
