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
 * @package    portfolio
 * @subpackage mahara
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['enableleap2a'] = 'Bật hỗ trợ danh mục đầu tư Leap2A (yêu cầu Mahara 1.3 trở lên)';
$string['err_invalidhost'] = 'Máy chủ MNet không hợp lệ';
$string['err_invalidhost_help'] = 'Plugin này được định cấu hình sai để trỏ đến một máy chủ MNet không hợp lệ (hoặc đã bị xóa). Plugin này dựa trên Moodle Networking ngang 
hàng với SSO IDP được xuất bản, SSO_SP đã đăng ký và danh mục đầu tư đã đăng ký <b> và </b> được xuất bản.';
$string['err_networkingoff'] = 'MNet đã tắt';
$string['err_networkingoff_help'] = 'Xác thực MNet hiện đã bị vô hiệu hóa. Vui lòng kích hoạt nó trước khi cố gắng định cấu hình plugin này. Mọi phiên bản của plugin này đã bị ẩn cho đến khi MNet được kích hoạt. Sau đó, chúng sẽ cần được đặt thủ công để hiển thị lại.';
$string['err_nomnetauth'] = 'Plugin xác thực MNet bị tắt';
$string['err_nomnetauth_help'] = 'Plugin xác thực MNet đã bị tắt, nhưng là bắt buộc đối với dịch vụ này';
$string['err_nomnethosts'] = 'Tín nhiệm vào MNet';
$string['err_nomnethosts_help'] = 'Plugin này dựa trên MNet ngang hàng với SSO IDP được xuất bản, SSO SP đã đăng ký, dịch vụ danh mục đầu tư được xuất bản <b> và 
</b> đã đăng ký cũng như plugin xác thực MNet. Mọi phiên bản của plugin này đã bị ẩn cho đến khi đáp ứng các điều kiện này. Sau đó, chúng sẽ cần cài đặt theo cách thủ công để hiển thị lại.';
$string['failedtojump'] = 'Không thể bắt đầu giao tiếp với máy chủ từ xa';
$string['failedtoping'] = 'Không thể bắt đầu giao tiếp với máy chủ từ xa: {$a}';
$string['mnet_nofile'] = 'Không thể tìm thấy tệp trong đối tượng truyền - lỗi lạ';
$string['mnet_nofilecontents'] = 'Đã tìm thấy tệp trong đối tượng chuyển, nhưng không thể nhận nội dung - lỗi lạ: {$a}';
$string['mnet_noid'] = 'Không thể tìm thấy bản ghi chuyển phù hợp cho mã thông báo này';
$string['mnet_notoken'] = 'Không thể tìm thấy mã thông báo khớp với chuyển khoản này';
$string['mnet_wronghost'] = 'Máy chủ từ xa không khớp với bản ghi chuyển cho mã thông báo này';
$string['mnethost'] = 'Máy chủ MNet';
$string['pf_description'] = 'Cho phép người dùng đẩy nội dung Moodle lên máy chủ lưu trữ này <br /> Đăng ký <b> và </b> xuất bản dịch vụ này để cho phép người dùng 
đã xác thực trong trang web của bạn đẩy nội dung lên {$a} <br /> <ul> <li> > <em> Người phụ thuộc </em>: Bạn cũng phải <strong> xuất bản </strong> dịch vụ SSO (Nhận dạng nhà cung cấp) cho {$a}. </li> <li> <em> Người phụ thuộc </em>: Bạn cũng phải <strong> đăng ký </strong> dịch vụ SSO (Nhà cung cấp dịch vụ) trên {$a} </li> <li> <em> Sự phụ thuộc </em>: Bạn cũng phải bật plugin xác thực MNet. < / li> </ul> <br />';
$string['pf_name'] = 'Dịch vụ danh mục đầu tư';
$string['pluginname'] = 'Hãy nhớ ePortfolio';
$string['privacy:metadata'] = 'Plugin này gửi dữ liệu ra bên ngoài đến một ứng dụng Mahara được liên kết. Nó không lưu trữ dữ liệu cục bộ.';
$string['privacy:metadata:data'] = 'Dữ liệu cá nhân được chuyển qua hệ thống con của danh mục đầu tư.';
$string['senddisallowed'] = 'Bạn không thể chuyển tệp sang Mahara vào lúc này';
$string['url'] = 'URL';
