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
 * @subpackage plugin
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cancelinstallall'] = 'Hủy cài đặt mới ({$a})';
$string['cancelinstallhead'] = 'Hủy cài đặt plugin';
$string['cancelinstallinfo'] = 'Các plugin sau chưa được cài đặt đầy đủ nên quá trình cài đặt của chúng có thể bị hủy. Để làm như vậy, thư mục plugin phải được xóa 
khỏi máy chủ ngay bây giờ. Đảm bảo rằng đây thực sự là những gì bạn muốn để ngăn mất dữ liệu ngẫu nhiên (chẳng hạn như sửa đổi mã của riêng bạn).';
$string['cancelinstallinfodir'] = 'Thư mục sẽ bị xóa: {$a}';
$string['cancelinstallone'] = 'Hủy cài đặt này';
$string['cancelupgradeall'] = 'Hủy nâng cấp ({$a})';
$string['cancelupgradehead'] = 'Khôi phục phiên bản trước của plugin';
$string['cancelupgradeone'] = 'Hủy nâng cấp này';
$string['dependencyavailable'] = 'Có sẵn';
$string['dependencyfails'] = 'Thất bại';
$string['dependencyinstallhead'] = 'Cài đặt phần phụ thuộc bị thiếu';
$string['dependencyinstallmissing'] = 'Cài đặt các phần phụ thuộc bị thiếu ({$a})';
$string['dependencymissing'] = 'Còn thiếu';
$string['dependencyunavailable'] = 'Không có sẵn';
$string['dependencyuploadmissing'] = 'Tải lên các tệp ZIP';
$string['isenabled'] = 'Đã bật?';
$string['misdepinfoplugin'] = 'Thông tin plugin';
$string['misdepinfoversion'] = 'Thông tin phiên bản';
$string['misdepsavail'] = 'Các phần phụ thuộc có sẵn';
$string['misdepsunavail'] = 'Các phần phụ thuộc bị thiếu không có sẵn';
$string['misdepsunavaillist'] = 'Không tìm thấy phiên bản nào đáp ứng các yêu cầu phụ thuộc: {$a}.';
$string['misdepsunknownlist'] = 'Không có trong thư mục Plugin: <strong> {$a} </strong>.';
$string['moodleversion'] = 'Moodle {$a}';
$string['otherplugin'] = '{$a->component}';
$string['otherpluginversion'] = '{$a->component} ({$a->version})';
$string['overviewall'] = 'Tất cả các plugin';
$string['overviewext'] = 'Bổ sung plugin';
$string['overviewupdatable'] = 'Có bản cập nhật mới';
$string['packagesdebug'] = 'Đã bật debug output';
$string['packagesdownloading'] = 'Đang tải xuống {$a}';
$string['packagesextracting'] = 'Đang trích xuất {$a}';
$string['packagesvalidating'] = 'Đang xác thực {$a}';
$string['packagesvalidatingfailed'] = 'Cài đặt bị hủy bỏ do không xác thực được';
$string['packagesvalidatingok'] = 'Xác thực thành công, cài đặt có thể tiếp tục';
$string['plugincheckall'] = 'Tất cả các plugin';
$string['plugincheckattention'] = 'Các plugin cần chú ý';
$string['pluginchecknone'] = 'Hiện không có plugin nào yêu cầu bạn chú ý';
$string['supportedconversions'] = 'Chuyển đổi tài liệu được hỗ trợ';
$string['supportedmoodleversions'] = 'Các phiên bản Moodle được hỗ trợ';
$string['type_antivirus'] = 'Plugin chống vi-rút';
$string['type_antivirus_plural'] = 'Plugin chống vi-rút';
$string['type_customfield'] = 'Trường tùy chỉnh';
$string['type_customfield_plural'] = 'Các trường tùy chỉnh';
$string['type_dataformat'] = 'Định dạng dữ liệu';
$string['type_dataformat_plural'] = 'Định dạng dữ liệu';
$string['type_fileconverter'] = 'Công cụ chuyển đổi tài liệu';
$string['type_fileconverter_plural'] = 'Trình chuyển đổi tài liệu';
$string['type_fileconvertermanage'] = 'Quản lý trình chuyển đổi tài liệu';
$string['type_media'] = 'Media Player';
$string['type_media_plural'] = 'Trình phát media';
$string['type_mlbackend'] = 'Chương trình phụ trợ học máy';
$string['type_mlbackend_plural'] = 'Phụ trợ học máy';
$string['type_repository_plural'] = 'Kho lưu trữ';
$string['type_search'] = 'Máy tìm kiếm';
$string['type_search_plural'] = 'Công cụ tìm kiếm';
$string['type_tool'] = 'Công cụ quản trị';
$string['type_tool_plural'] = 'Công cụ quản trị';
$string['type_webservice'] = 'Giao thức dịch vụ trang web';
$string['type_webservice_plural'] = 'Các giao thức dịch vụ trang web';
$string['uninstall'] = 'Gỡ cài đặt';
$string['uninstallconfirm'] = 'Bạn sắp gỡ cài đặt plugin <em> {$a->name}</em>. Thao tác này sẽ xóa hoàn toàn mọi thứ trong cơ sở dữ liệu được liên kết với 
plugin này, bao gồm cấu hình của nó, bản ghi nhật ký, tệp người dùng do plugin quản lý, v.v. Không có cách nào quay lại và bản thân Moodle không tạo bất kỳ bản sao lưu phục hồi nào. Bạn có CHẮC CHẮN muốn tiếp tục không?';
$string['uninstalldelete'] = 'Tất cả dữ liệu được liên kết với plugin <em> {$a->name} </em> đã bị xóa khỏi cơ sở dữ liệu. Để ngăn plugin tự cài đặt lại, thư mục 
<em> {$a->rootdir} </em> của nó phải được xóa thủ công khỏi máy chủ của bạn ngay bây giờ. Bản thân Moodle không thể xóa thư mục do quyền ghi.';
$string['uninstalldeleteconfirm'] = 'Tất cả dữ liệu được liên kết với plugin <em> {$a->name} </em> đã bị xóa khỏi cơ sở dữ liệu. Để ngăn plugin tự cài đặt lại, thư mục 
<em> {$a->rootdir} </em> của plugin phải được xóa khỏi máy chủ của bạn. Bạn có muốn xóa thư mục plugin ngay bây giờ không?';
$string['uninstalldeleteconfirmexternal'] = 'Có vẻ như phiên bản hiện tại của plugin đã được lấy qua kiểm tra của hệ thống quản lý mã nguồn ({$a}). Nếu bạn xóa thư mục plugin
, bạn có thể mất các sửa đổi cục bộ quan trọng của mã. Hãy đảm bảo rằng bạn chắc chắn muốn xóa thư mục plugin trước khi tiếp tục.';
$string['uninstallextraconfirmblock'] = 'Có {$a->instances} bản sao của khối này.';
$string['uninstallextraconfirmenrol'] = 'Có {$a->registerments} đăng ký người dùng.';
$string['uninstallextraconfirmmod'] = 'Có {$a->instances} bản sao của mô-đun này trong các khóa học {$a->course}.';
$string['uninstalling'] = 'Gỡ cài đặt {$a->name}';
$string['updateavailable'] = 'Đã có phiên bản {$a} mới!';
$string['updateavailable_moreinfo'] = 'Thêm thông tin...';
$string['updateavailable_release'] = 'Phát hành {$a}';
$string['updatepluginconfirm'] = 'Xác nhận cập nhật plugin';
$string['updatepluginconfirmexternal'] = 'Có vẻ như phiên bản hiện tại của plugin đã được lấy qua kiểm tra của hệ thống quản lý mã nguồn ({$a}). Nếu bạn cài đặt bản cập nhật 
này, bạn sẽ không thể nhận được các bản cập nhật plugin từ hệ thống quản lý mã nguồn nữa. Hãy đảm bảo rằng bạn chắc chắn muốn cập nhật plugin trước khi tiếp tục.';
$string['updatepluginconfirminfo'] = 'Bạn sắp cài đặt phiên bản mới của plugin <strong> {$a->name} </strong>. Gói zip có phiên bản {$a->version} của plugin sẽ được 
tải xuống từ <a href="{$a->url} "> {$a->url} </a> và được trích xuất vào cài đặt Moodle của bạn vì vậy nó có thể nâng cấp cài đặt của bạn.';
$string['updatepluginconfirmwarning'] = 'Xin lưu ý rằng Moodle sẽ không tự động sao lưu cơ sở dữ liệu của bạn trước khi nâng cấp. Chúng tôi thực sự khuyên bạn nên tạo một 
bản sao lưu ảnh chụp nhanh đầy đủ ngay bây giờ, để đối phó với trường hợp hiếm gặp là mã mới có lỗi khiến trang web của bạn không khả dụng hoặc thậm chí làm hỏng cơ sở dữ liệu của bạn. Tiến hành với rủi ro của riêng bạn.';
$string['validationmsg_componentmatch'] = 'Tên thành phần đầy đủ';
$string['validationmsg_componentmismatchname'] = 'Tên plugin không khớp';
$string['validationmsg_componentmismatchname_help'] = 'Một số gói ZIP, chẳng hạn như những gói được tạo bởi Github, có thể chứa tên thư mục gốc không chính xác. Bạn cần sửa tên của thư 
mục gốc để khớp với tên plugin đã khai báo.';
$string['validationmsg_componentmismatchname_info'] = 'Plugin khai báo tên của nó là \'{$a}\' nhưng tên đó không khớp với tên của thư mục gốc.';
$string['validationmsg_componentmismatchtype'] = 'Loại plugin không khớp';
$string['validationmsg_componentmismatchtype_info'] = 'Loại mong đợi \'{$a->expected}\' nhưng plugin khai báo loại của nó là \'{$a->found}\'.';
$string['validationmsg_filenotexists'] = 'Không tìm thấy tệp đã giải nén';
$string['validationmsg_filesnumber'] = 'Không tìm thấy đủ tệp trong gói';
$string['validationmsg_filestatus'] = 'Không thể giải nén tất cả các tệp';
$string['validationmsg_filestatus_info'] = 'Cố gắng giải nén tệp {$a->file} đã dẫn đến lỗi \'{$a->status}\'.';
$string['validationmsg_foundlangfile'] = 'Tìm thấy tệp ngôn ngữ';
$string['validationmsg_maturity'] = 'Đã công bố mức độ trưởng thành';
$string['validationmsg_maturity_help'] = 'Plugin có thể khai báo mức độ trưởng thành của nó. Nếu người bảo trì cho rằng plugin ổn định, thì mức độ trưởng thành đã khai báo sẽ 
đọc MATURITY_STABLE. Tất cả các mức độ trưởng thành khác (chẳng hạn như alpha hoặc beta) nên được coi là không ổn định và cảnh báo được đưa ra.';
$string['validationmsg_missingcomponent'] = 'Plugin không khai báo tên thành phần của nó';
$string['validationmsg_missingcomponent_help'] = 'Tất cả các plugin phải cung cấp tên thành phần đầy đủ của chúng thông qua khai báo `$plugin->component` trong tệp version.php.';
$string['validationmsg_missingexpectedlangenfile'] = 'Tên tệp ngôn ngữ tiếng Anh không khớp';
$string['validationmsg_missingexpectedlangenfile_info'] = 'Loại plugin đã cho thiếu tệp ngôn ngữ tiếng Anh mong đợi {$a}.';
$string['validationmsg_missinglangenfile'] = 'Không tìm thấy tệp ngôn ngữ tiếng Anh';
$string['validationmsg_missinglangenfolder'] = 'Thiếu thư mục ngôn ngữ tiếng Anh';
$string['validationmsg_missingversion'] = 'Plugin không khai báo phiên bản của nó';
$string['validationmsg_missingversionphp'] = 'Không tìm thấy tệp version.php';
$string['validationmsg_multiplelangenfiles'] = 'Đã tìm thấy nhiều tệp ngôn ngữ tiếng Anh';
$string['validationmsg_onedir'] = 'Cấu trúc gói ZIP không hợp lệ.';
$string['validationmsg_onedir_help'] = 'Gói ZIP chỉ được chứa một thư mục gốc chứa mã plugin. Tên của thư mục gốc đó phải khớp với tên của plugin.';
$string['validationmsg_pathwritable'] = 'Viết kiểm tra quyền truy cập';
$string['validationmsg_pluginversion'] = 'Phiên bản plugin';
$string['validationmsg_release'] = 'Bản phát hành plugin';
$string['validationmsg_requiresmoodle'] = 'Phiên bản Moodle bắt buộc';
$string['validationmsg_rootdir'] = 'Tên của plugin sẽ được cài đặt';
$string['validationmsg_rootdir_help'] = 'Tên của thư mục gốc trong gói ZIP tạo thành tên của plugin sẽ được cài đặt. Nếu tên không đúng, bạn có thể đổi tên thư mục gốc trong ZIP trước khi cài đặt plugin.';
$string['validationmsg_rootdirinvalid'] = 'Tên plugin không hợp lệ';
$string['validationmsg_rootdirinvalid_help'] = 'Tên của thư mục gốc trong gói ZIP vi phạm các yêu cầu về cú pháp chính thức. Một số gói ZIP, chẳng hạn như những gói được tạo bởi Github, có thể chứa tên thư mục gốc không chính xác. Bạn cần sửa tên của thư mục gốc để khớp với tên plugin.';
$string['validationmsg_targetexists'] = 'Vị trí mục tiêu đã tồn tại và sẽ bị xóa';
$string['validationmsg_targetexists_help'] = 'Thư mục plugin đã tồn tại và sẽ được thay thế bằng nội dung gói plugin.';
$string['validationmsg_targetnotdir'] = 'Vị trí mục tiêu bị chiếm bởi một tệp';
$string['validationmsg_unknowntype'] = 'Loại plugin không xác định';
$string['validationmsg_versionphpsyntax'] = 'Đã phát hiện cú pháp không được hỗ trợ trong tệp version.php';
$string['validationmsglevel_debug'] = 'Gỡ lỗi';
$string['validationmsglevel_error'] = 'lỗi';
$string['validationmsglevel_info'] = 'đồng ý';
$string['validationmsglevel_warning'] = 'Cảnh báo';
$string['versiondb'] = 'Phiên bản hiện tại';
$string['versiondisk'] = 'Phiên bản mới';
