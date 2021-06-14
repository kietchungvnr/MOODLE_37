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
 * @package    repository
 * @subpackage googledocs
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['both'] = 'Trong và ngoài';
$string['cachedef_folder'] = 'ID tệp Google cho các thư mục trong tài khoản hệ thống';
$string['clientid'] = 'ID khách hàng';
$string['configplugin'] = 'Định cấu hình plugin Google Drive';
$string['defaultreturntype'] = 'Loại trả lại mặc định';
$string['docsformat'] = 'Định dạng nhập tài liệu mặc định';
$string['drawingformat'] = 'Định dạng nhập bản vẽ mặc định';
$string['external'] = 'Bên ngoài (chỉ các liên kết được lưu trữ trong Moodle)';
$string['fileoptions'] = 'Có thể định cấu hình các loại và mặc định cho các tệp trả về tại đây. Lưu ý rằng tất cả các tệp được liên kết bên ngoài sẽ được cập nhật để chủ sở hữu là tài khoản hệ thống
 Moodle.';
$string['googledocs:view'] = 'Xem kho lưu trữ Google Drive';
$string['importformat'] = 'Định cấu hình các định dạng nhập mặc định từ Google';
$string['internal'] = 'Nội bộ (tệp được lưu trữ trong Moodle)';
$string['issuer'] = 'Dịch vụ OAuth 2';
$string['issuer_help'] = 'Chọn dịch vụ OAuth 2 được định cấu hình để nói chuyện với API Google Drive. Nếu dịch vụ chưa tồn tại, bạn sẽ cần tạo nó.';
$string['oauth2serviceslink'] = '<a href="{$a}" title="Link tới cấu hình dịch vụ OAuth 2"> cấu hình dịch vụ OAuth 2 </a>';
$string['oauthinfo'] = '<p> Để sử dụng plugin này, bạn phải đăng ký trang web của mình với Google, như được mô tả trong tài liệu <a href="{$a->docsurl} "> thiết lập Google OAuth 2.0 </a>. 
</p> <p > Là một phần của quy trình đăng ký, bạn cần nhập URL sau làm \'URI chuyển hướng được ủy quyền\': </p> <p> {$a->callbackurl} </p> <p> Sau khi đăng ký, bạn sẽ được cung cấp ID ứng dụng khách và bí mật có thể được sử dụng để định cấu hình một số plugin Google Drive và Picasa khác. </p> <p> Cũng xin lưu ý rằng bạn sẽ phải bật dịch vụ \'API Drive\'. </p>';
$string['owner'] = 'Sở hữu bởi: {$a}';
$string['pluginname'] = 'Google Drive';
$string['presentationformat'] = 'Định dạng nhập bản trình bày mặc định';
$string['privacy:metadata:repository_googledocs'] = 'Plugin kho lưu trữ Google Drive không lưu trữ bất kỳ dữ liệu cá nhân nào, nhưng truyền dữ liệu người dùng từ Moodle đến hệ thống từ xa.';
$string['privacy:metadata:repository_googledocs:email'] = 'Email của người dùng kho lưu trữ Google Drive.';
$string['privacy:metadata:repository_googledocs:searchtext'] = 'Truy vấn văn bản tìm kiếm người dùng trong kho lưu trữ Google Drive.';
$string['searchfor'] = 'Tìm kiếm {$a}';
$string['secret'] = 'Bí mật';
$string['servicenotenabled'] = 'Quyền truy cập chưa được định cấu hình. Đảm bảo rằng dịch vụ \'API Drive\' đã được bật.';
$string['spreadsheetformat'] = 'Định dạng nhập bảng tính mặc định';
$string['supportedreturntypes'] = 'Các tệp được hỗ trợ';
