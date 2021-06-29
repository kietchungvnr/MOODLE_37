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
 * @subpackage nextcloud
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['both'] = 'Trong và ngoài';
$string['cannotconnect'] = 'Người dùng không thể được xác thực. Vui lòng đăng nhập và sau đó tải tệp lên.';
$string['chooseissuer'] = 'Người phát hành';
$string['chooseissuer_help'] = 'Để thêm nhà phát hành mới, hãy chuyển đến Dịch vụ quản trị trang web / Máy chủ / OAuth 2.';
$string['configplugin'] = 'Cấu hình kho lưu trữ Nextcloud';
$string['configuration_exception'] = 'Đã xảy ra lỗi trong cấu hình của ứng dụng khách OAuth 2: {$a}';
$string['contactadminwith'] = 'Không thể thực hiện hành động được yêu cầu. Nếu điều này xảy ra nhiều lần, vui lòng liên hệ với quản trị viên trang web với thông tin bổ sung sau: <br> "<i> {$a} </i>".';
$string['couldnotmove'] = 'Không thể di chuyển tệp đã yêu cầu trong thư mục {$a}.';
$string['defaultreturntype'] = 'Loại trả lại mặc định';
$string['endpointnotdefined'] = 'Điểm cuối {$a} chưa được xác định.';
$string['external'] = 'Bên ngoài (chỉ các liên kết được lưu trữ trong Moodle)';
$string['filenotaccessed'] = 'Không thể truy cập tệp được yêu cầu. Vui lòng kiểm tra xem bạn đã chọn một tệp hợp lệ và bạn đã được xác thực bằng đúng tài khoản chưa.';
$string['fileoptions'] = 'Có thể định cấu hình các loại và mặc định cho các tệp trả về tại đây. Lưu ý rằng tất cả các tệp được liên kết bên ngoài sẽ được cập nhật để chủ sở hữu là tài khoản hệ thống Moodle.';
$string['foldername'] = 'Tên của thư mục được tạo trong không gian riêng tư của người dùng Nextcloud chứa tất cả các liên kết được kiểm soát truy cập.';
$string['foldername_help'] = 'Để đảm bảo rằng người dùng tìm thấy các tệp được chia sẻ với họ, các chia sẻ được lưu vào một thư mục cụ thể. <br> Cài đặt này xác định tên của thư mục. Bạn nên chọn một tên liên quan đến phiên bản Moodle của bạn.';
$string['internal'] = 'Nội bộ (tệp được lưu trữ trong Moodle)';
$string['invalidresponse'] = 'Phản hồi của máy chủ không hợp lệ.';
$string['issuervalidation_invalid'] = 'Hiện tại, công ty phát hành {$a} đang hoạt động, tuy nhiên, nó không triển khai tất cả các điểm cuối cần thiết. Kho lưu trữ sẽ không hoạt động.';
$string['issuervalidation_valid'] = 'Hiện tại, công ty phát hành {$a} đang hoạt động.';
$string['issuervalidation_without'] = 'Bạn chưa chọn máy chủ Nextcloud làm nhà phát hành OAuth 2.';
$string['nextcloud'] = 'Nextcloud';
$string['nextcloud:view'] = 'Xem Nextcloud';
$string['no_right_issuers'] = 'Không có tổ chức phát hành hiện tại nào triển khai tất cả các điểm cuối bắt buộc. Vui lòng đăng ký một công ty phát hành thích hợp.';
$string['noclientconnection'] = 'Không thể kết nối các ứng dụng khách OAuth.';
$string['notauthorized'] = 'Bạn không được phép thực hiện yêu cầu này. Hãy đảm bảo rằng bạn đã được xác thực với đúng tài khoản.';
$string['oauth2serviceslink'] = '<a href="{$a}" title="Link tới cấu hình dịch vụ OAuth 2"> cấu hình dịch vụ OAuth 2 </a>';
$string['pathnotcreated'] = 'Không thể tạo đường dẫn thư mục {$a} trong tài khoản hệ thống.';
$string['pluginname'] = 'Nextcloud';
$string['pluginname_help'] = 'Kho Nextcloud';
$string['privacy:metadata'] = 'Plugin kho lưu trữ Nextcloud không lưu trữ bất kỳ dữ liệu cá nhân nào cũng như không truyền dữ liệu người dùng đến hệ thống từ xa.';
$string['request_exception'] = 'Yêu cầu đến {$a->instance} không thành công. {$a->errormessage}';
$string['requestnotexecuted'] = 'Không thể thực hiện yêu cầu. Nếu điều này xảy ra nhiều lần, vui lòng liên hệ với quản trị viên trang web.';
$string['right_issuers'] = 'Các tổ chức phát hành sau đây triển khai các điểm cuối bắt buộc: <br> {$a}';
$string['supportedreturntypes'] = 'Các tệp được hỗ trợ';
