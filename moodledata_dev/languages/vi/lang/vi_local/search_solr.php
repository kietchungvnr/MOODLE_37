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
 * @package    search
 * @subpackage solr
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['connectionerror'] = 'Máy chủ Solr được chỉ định không khả dụng hoặc chỉ mục được chỉ định không tồn tại';
$string['connectionsettings'] = 'Cài đặt kết nối';
$string['errorcreatingschema'] = 'Lỗi khi tạo lược đồ Solr: {$a}';
$string['errorvalidatingschema'] = 'Lỗi xác thực lược đồ Solr: trường {$a->fieldname} không tồn tại. Vui lòng <a href="{$a->setupurl} "> nhấp vào liên kết này </a> để thiết lập các trường bắt buộc.';
$string['extensionerror'] = 'Phần mở rộng Apache Solr PHP chưa được cài đặt. Vui lòng kiểm tra tài liệu.';
$string['fileindexing'] = 'Bật lập chỉ mục tệp';
$string['fileindexing_help'] = 'Nếu cài đặt Solr của bạn hỗ trợ nó, tính năng này cho phép Moodle gửi các tệp được lập chỉ mục. <br/> Bạn sẽ cần lập chỉ mục lại tất cả nội dung trang web sau khi bật tùy chọn này cho tất cả các tệp được thêm vào.';
$string['fileindexsettings'] = 'Cài đặt lập chỉ mục tệp';
$string['maxindexfilekb'] = 'Kích thước tệp tối đa để lập chỉ mục (kB)';
$string['maxindexfilekb_help'] = 'Các tệp lớn hơn số kilobyte này sẽ không được đưa vào lập chỉ mục tìm kiếm. Nếu được đặt thành 0, các tệp có kích thước bất kỳ sẽ được lập chỉ mục.';
$string['minimumsolr4'] = 'Solr 4.0 là phiên bản tối thiểu cần thiết cho Moodle';
$string['missingconfig'] = 'Máy chủ Apache Solr của bạn chưa được định cấu hình trong Moodle.';
$string['multivaluedfield'] = 'Trường "{$a}" trả về một mảng thay vì một đại lượng vô hướng. Vui lòng xóa chỉ mục hiện tại, tạo một chỉ mục mới và chạy setup_schema.php trước khi lập chỉ mục dữ liệu trong Solr.';
$string['nodatafromserver'] = 'Không có dữ liệu từ máy chủ';
$string['pluginname'] = 'Solr';
$string['privacy:metadata'] = 'Plugin này gửi dữ liệu ra bên ngoài tới công cụ tìm kiếm Solr được liên kết. Nó không lưu trữ dữ liệu cục bộ.';
$string['privacy:metadata:data'] = 'Dữ liệu cá nhân được chuyển qua hệ thống con tìm kiếm.';
$string['schemafieldautocreated'] = 'Trường "{$a}" đã tồn tại trong lược đồ Solr. Có thể bạn đã quên chạy tập lệnh này trước khi lập chỉ mục dữ liệu và các trường được Solr tự động tạo. Vui lòng xóa chỉ mục hiện tại, tạo một chỉ mục mới và chạy lại setup_schema.php trước khi lập chỉ mục dữ liệu trong Solr.';
$string['schemasetupfromsolr5'] = 'Phiên bản máy chủ Solr của bạn thấp hơn 5.0. Tập lệnh này chỉ có thể thiết lập lược đồ của bạn nếu phiên bản Solr của bạn là 5.0 trở lên. Bạn cần đặt thủ công các trường trong lược đồ của mình theo \\ search_solr \\ document :: get_default_fields_definition ().';
$string['searchinfo'] = 'Truy vấn tìm kiếm';
$string['searchinfo_help'] = 'Trường được tìm kiếm có thể được chỉ định bằng cách đặt trước truy vấn tìm kiếm với \'title:\', \'content:\', \'name:\', hoặc \'intro:\'. Ví dụ: tìm kiếm \'title: news\' sẽ trả về kết quả có từ \'news\' trong tiêu đề. Toán tử boolean (\'VÀ\', \'HOẶC\', \'KHÔNG\') có thể được sử dụng để kết hợp hoặc loại trừ các từ khóa. Các ký tự đại diện (\'*\' hoặc \'?\') Có thể được sử dụng để biểu thị các ký tự trong truy vấn tìm kiếm.';
$string['setupok'] = 'Lược đồ đã sẵn sàng để sử dụng.';
$string['solrauthpassword'] = 'Mật khẩu xác thực HTTP';
$string['solrauthuser'] = 'Tên người dùng xác thực HTTP';
$string['solrhttpconnectionport'] = 'Hải cảng';
$string['solrhttpconnectiontimeout'] = 'Hết giờ';
$string['solrhttpconnectiontimeout_desc'] = 'Thời gian chờ kết nối HTTP là thời gian tối đa tính bằng giây cho phép hoạt động truyền dữ liệu HTTP.';
$string['solrindexname'] = 'Tên chỉ mục';
$string['solrinfo'] = 'Solr';
$string['solrnotselected'] = 'Công cụ Solr không phải là công cụ tìm kiếm được định cấu hình';
$string['solrsecuremode'] = 'Chế độ bảo mật';
$string['solrserverhostname'] = 'Tên máy chủ';
$string['solrserverhostname_desc'] = 'Tên miền của máy chủ Solr.';
$string['solrsetting'] = 'Cài đặt Solr';
$string['solrsslcainfo'] = 'Tên chứng chỉ SSL CA';
$string['solrsslcainfo_desc'] = 'Tên tệp chứa một hoặc nhiều chứng chỉ CA để xác minh tính năng ngang hàng với';
$string['solrsslcapath'] = 'Đường dẫn chứng chỉ SSL CA';
$string['solrsslcapath_desc'] = 'Đường dẫn thư mục chứa nhiều chứng chỉ CA để xác minh tính năng ngang hàng với';
$string['solrsslcert'] = 'Chứng chỉ SSL';
$string['solrsslcert_desc'] = 'Tên tệp cho chứng chỉ riêng tư có định dạng PEM';
$string['solrsslkey'] = 'Khóa SSL';
$string['solrsslkey_desc'] = 'Tên tệp thành khóa cá nhân có định dạng PEM';
$string['solrsslkeypassword'] = 'Mật khẩu khóa SSL';
$string['solrsslkeypassword_desc'] = 'Mật khẩu cho tệp khóa cá nhân định dạng PEM';
