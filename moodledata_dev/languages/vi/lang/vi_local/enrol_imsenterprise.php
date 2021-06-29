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
 * @subpackage imsenterprise
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aftersaving...'] = 'Bạn có thể muốn lưu cài đặt của mình';
$string['allowunenrol'] = 'Cho phép dữ liệu IMS để <strong> hủy đăng ký </strong> học sinh / giáo viên';
$string['allowunenrol_desc'] = 'Nếu được bật, đăng ký khóa học sẽ bị xóa khi được chỉ định trong dữ liệu Doanh nghiệp.';
$string['categoryidnumber'] = 'Cho phép mã số danh mục';
$string['categoryidnumber_desc'] = 'Nếu được bật IMS Enterprise sẽ tạo danh mục với idnumber';
$string['categoryseparator'] = 'Ký tự phân cách danh mục';
$string['categoryseparator_desc'] = 'Bắt buộc khi "Mã số danh mục" được bật. Ký tự để tách biệt tên danh mục và mã số.';
$string['coursesettings'] = 'Tùy chọn dữ liệu khóa học';
$string['createnewcategories'] = 'Tạo danh mục khóa học mới (ẩn) nếu không tìm thấy trong Moodle';
$string['createnewcategories_desc'] = 'Nếu phần tử <org> <orgunit> có trong dữ liệu đến của một khóa học, thì nội dung của nó sẽ được sử dụng để chỉ định một danh mục nếu khóa học được tạo từ đầu. Plugin sẽ KHÔNG phân loại lại các khóa học hiện có. Nếu không có danh mục nào tồn tại với tên mong muốn, thì danh mục ẩn sẽ được tạo.';
$string['createnewcourses'] = 'Tạo các khóa học mới (ẩn) nếu không tìm thấy trong Moodle';
$string['createnewcourses_desc'] = 'Nếu được bật, plugin đăng ký IMS Enterprise có thể tạo các khóa học mới cho bất kỳ khóa học nào mà nó tìm thấy trong dữ liệu IMS nhưng không có trong cơ sở dữ liệu của Moodle. Mọi khóa học mới được tạo ban đầu đều bị ẩn.';
$string['createnewusers'] = 'Tạo tài khoản người dùng cho người dùng chưa đăng ký trong Moodle';
$string['createnewusers_desc'] = 'Dữ liệu đăng ký IMS Enterprise thường mô tả một nhóm người dùng. Nếu được bật, có thể tạo tài khoản cho bất kỳ người dùng nào không có trong cơ sở dữ liệu của Moodle. Người dùng được tìm kiếm đầu tiên theo "idnumber" và thứ hai là tên người dùng Moodle của họ. Mật khẩu không được nhập bởi plugin IMS Enterprise. Nên sử dụng plugin xác thực để xác thực người dùng.';
$string['cronfrequency'] = 'Tần suất xử lý';
$string['deleteusers'] = 'Xóa tài khoản người dùng khi được chỉ định trong dữ liệu IMS';
$string['deleteusers_desc'] = 'Nếu được bật, dữ liệu đăng ký IMS Enterprise có thể chỉ định việc xóa tài khoản người dùng (nếu cờ "recstatus" được đặt thành 3, biểu thị việc xóa tài khoản). Theo tiêu chuẩn trong Moodle, bản ghi người dùng không thực sự bị xóa khỏi cơ sở dữ liệu của Moodle, nhưng một cờ được đặt để đánh dấu tài khoản là đã bị xóa.';
$string['doitnow'] = 'thực hiện nhập IMS Enterprise ngay bây giờ';
$string['emptyattribute'] = 'Để trống';
$string['filelockedmail'] = 'Không thể xóa tệp văn bản bạn đang sử dụng cho đăng ký dựa trên tệp IMS ({$a}) bằng quy trình cron. Điều này thường có nghĩa là các quyền trên nó bị sai. Vui lòng sửa 
các quyền để Moodle có thể xóa tệp, nếu không nó có thể được xử lý nhiều lần.';
$string['filelockedmailsubject'] = 'Lỗi quan trọng: Tệp đăng ký';
$string['fixcasepersonalnames'] = 'Thay đổi tên cá nhân thành Viết hoa tiêu đề';
$string['fixcaseusernames'] = 'Thay đổi tên người dùng thành chữ thường';
$string['ignore'] = 'Bỏ qua';
$string['importimsfile'] = 'Nhập tệp IMS Enterprise';
$string['imsenterprise:config'] = 'Định cấu hình các phiên bản đăng ký IMS Enterprise';
$string['imsenterprisecrontask'] = 'Xử lý tệp tuyển sinh';
$string['imsrolesdescription'] = 'Đặc tả IMS Enterprise bao gồm 8 loại vai trò riêng biệt. Vui lòng chọn cách bạn muốn chỉ định chúng trong Moodle, bao gồm cả việc có nên bỏ qua bất kỳ mục nào trong số chúng hay không.';
$string['location'] = 'Vị trí tập tin';
$string['logtolocation'] = 'Vị trí đầu ra tệp nhật ký (trống để không ghi nhật ký)';
$string['mailadmins'] = 'Thông báo cho quản trị viên qua email';
$string['mailusers'] = 'Thông báo cho người dùng qua email';
$string['messageprovider:imsenterprise_enrolment'] = 'Thông báo đăng ký IMS Enterprise';
$string['miscsettings'] = 'Điều khoản khác';
$string['nestedcategories'] = 'Cho phép các danh mục lồng nhau';
$string['nestedcategories_desc'] = 'Nếu được bật IMS Enterprise sẽ tạo các danh mục lồng nhau';
$string['pluginname'] = 'Tệp IMS Enterprise';
$string['pluginname_desc'] = 'Phương pháp này sẽ liên tục kiểm tra và xử lý tệp văn bản có định dạng đặc biệt ở vị trí mà bạn chỉ định. Tệp phải tuân theo các thông số kỹ thuật của IMS Enterprise chứa các phần tử XML của người, nhóm và thành viên.';
$string['privacy:metadata'] = 'Plugin đăng ký tệp IMS Enterprise không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['processphoto'] = 'Thêm dữ liệu ảnh của người dùng vào hồ sơ';
$string['processphotowarning'] = 'Cảnh báo: Xử lý hình ảnh có thể tạo thêm gánh nặng đáng kể cho máy chủ. Bạn không nên kích hoạt tùy chọn này nếu số lượng lớn học sinh dự kiến ​​sẽ được xử lý.';
$string['restricttarget'] = 'Chỉ xử lý dữ liệu nếu mục tiêu sau được chỉ định';
$string['restricttarget_desc'] = 'Tệp dữ liệu IMS Enterprise có thể dành cho nhiều "mục tiêu" - các LMS khác nhau hoặc các hệ thống khác nhau trong một trường học / trường đại học. Có thể chỉ định trong 
tệp Enterprise rằng dữ liệu dành cho một hoặc nhiều hệ thống đích được đặt tên, bằng cách đặt tên chúng trong các thẻ <target> có trong thẻ <properties>. Nói chung bạn không cần lo lắng về điều này. Để trống cài đặt và Moodle sẽ luôn xử lý tệp dữ liệu, bất kể mục tiêu có được chỉ định hay không. Nếu không, hãy điền tên chính xác sẽ được xuất bên trong thẻ <target>.';
$string['roles'] = 'Vai trò';
$string['settingfullname'] = 'Thẻ mô tả IMS cho tên đầy đủ của khóa học';
$string['settingfullnamedescription'] = 'Tên đầy đủ là trường bắt buộc của khóa học, vì vậy bạn phải xác định thẻ mô tả đã chọn trong tệp IMS Enterprise của mình';
$string['settingshortname'] = 'Thẻ mô tả IMS cho tên viết tắt của khóa học';
$string['settingshortnamedescription'] = 'Tên ngắn là trường bắt buộc của khóa học, vì vậy bạn phải xác định thẻ mô tả đã chọn trong tệp IMS Enterprise của mình';
$string['settingsummary'] = 'Thẻ mô tả IMS cho phần tóm tắt khóa học';
$string['settingsummarydescription'] = 'Là trường tùy chọn, hãy chọn \'Để trống\' nếu bạn không muốn chỉ định tóm tắt khóa học';
$string['sourcedidfallback'] = 'Sử dụng \'nguồn gốc\' cho userid của người dùng nếu trường \'userid\' không được tìm thấy';
$string['sourcedidfallback_desc'] = 'Trong dữ liệu IMS, trường <sourcedid> đại diện cho mã ID liên tục cho một người như được sử dụng trong hệ thống nguồn. Trường <userid> là một trường riêng biệt phải 
chứa mã ID được người dùng sử dụng khi đăng nhập. Trong nhiều trường hợp, hai mã này có thể giống nhau - nhưng không phải lúc nào cũng vậy. Một số hệ thống thông tin sinh viên không xuất được trường <userid>. Nếu đúng như vậy, bạn nên bật cài đặt này để cho phép sử dụng <sourcedid> làm ID người dùng Moodle. Nếu không, hãy tắt cài đặt này.';
$string['truncatecoursecodes'] = 'Cắt ngắn mã khóa học theo độ dài này';
$string['truncatecoursecodes_desc'] = 'Trong một số tình huống, bạn có thể có mã khóa học mà bạn muốn cắt bớt đến một độ dài được chỉ định trước khi xử lý. Nếu vậy, hãy nhập số ký tự vào ô này. Nếu không, hãy để trống hộp và không xảy ra hiện tượng cắt bớt.';
$string['updatecourses'] = 'Cập nhật khóa học';
$string['updatecourses_desc'] = 'Nếu được bật, plugin đăng ký IMS Enterprise có thể cập nhật tên đầy đủ và tên viết tắt của khóa học (nếu cờ "recstatus" được đặt thành 2, biểu thị một bản cập nhật).';
$string['updateusers'] = 'Cập nhật tài khoản người dùng khi được chỉ định trong dữ liệu IMS';
$string['updateusers_desc'] = 'Nếu được bật, dữ liệu đăng ký IMS Enterprise có thể chỉ định các thay đổi đối với tài khoản người dùng (nếu cờ "recstatus" được đặt thành 2, biểu thị một bản cập nhật).';
$string['usecapitafix'] = 'Đánh dấu vào ô này nếu sử dụng Capita (vì định dạng XML của chúng hơi khác)';
$string['usecapitafix_desc'] = 'Hệ thống dữ liệu sinh viên do Capita tạo ra đã bị phát hiện có một lỗi nhỏ trong kết quả đầu ra XML của nó. Nếu bạn đang sử dụng Capita, bạn nên bật cài đặt này - nếu không, hãy bỏ chọn nó.';
$string['usersettings'] = 'Tùy chọn dữ liệu người dùng';
$string['zeroisnotruncation'] = '0 cho biết không bị cắt bớt';
