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
 * @subpackage lpmigrate
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowedcourses'] = 'Các khóa học được phép';
$string['allowedcourses_help'] = 'Chọn các khóa học sẽ được chuyển sang khung mới. Nếu không có khóa học nào được chỉ định, thì tất cả các khóa học sẽ được di chuyển.';
$string['continuetoframeworks'] = 'Tiếp tục đến khung năng lực';
$string['coursecompetencymigrations'] = 'Di chuyển năng lực khóa học';
$string['coursemodulecompetencymigrations'] = 'Di chuyển năng lực theo tài nguyên và hoạt động của khóa học';
$string['coursemodulesfound'] = 'Các hoạt động hoặc tài nguyên của khóa học tìm thấy';
$string['coursesfound'] = 'Các khóa học được tìm thấy';
$string['coursestartdate'] = 'Ngày bắt đầu khóa học';
$string['coursestartdate_help'] = 'Nếu được bật, các khóa học có ngày bắt đầu trước ngày được chỉ định sẽ không được di chuyển.';
$string['disallowedcourses'] = 'Các khóa học không được phép';
$string['disallowedcourses_help'] = 'Chọn bất kỳ khóa học nào KHÔNG được chuyển sang khung năng lực mới.';
$string['errorcannotmigratetosameframework'] = 'Không thể di chuyển từ và sang cùng một khung năng lực';
$string['errorcouldnotmapcompetenciesinframework'] = 'Không thể liên kết với bất kỳ năng lực nào trong khung này.';
$string['errors'] = 'Lỗi';
$string['errorwhilemigratingcoursecompetencywithexception'] = 'Lỗi khi di chuyển năng lực của khóa học: {$a}';
$string['errorwhilemigratingmodulecompetencywithexception'] = 'Lỗi khi di chuyển năng lực của hoạt động hoặc tài nguyên: {$a}';
$string['excludethese'] = 'Loại trừ';
$string['explanation'] = 'Công cụ này có thể được sử dụng để cập nhật khung năng lực lên phiên bản mới hơn. Nó tìm kiếm các năng lực trong các khóa học và hoạt động bằng cách sử dụng khuôn khổ cũ hơn và cập nhật các liên kết để trỏ đến khuôn khổ mới. Không nên chỉnh sửa trực tiếp nhóm năng lực cũ vì điều này sẽ thay đổi tất cả các năng lực đã được cấp trong kế hoạch học tập của người dùng. Thông thường, bạn sẽ nhập phiên bản mới của khung, ẩn khung cũ, sau đó sử dụng công cụ này để chuyển các khóa học mới sang khung mới.';
$string['findingcoursecompetencies'] = 'Tìm kiếm năng lực khóa học';
$string['findingmodulecompetencies'] = 'Tìm kiếm năng lực theo hoạt động và tài nguyên';
$string['frameworks'] = 'Khung';
$string['limittothese'] = 'Giới hạn';
$string['lpmigrate:frameworksmigrate'] = 'Di chuyển khung';
$string['migrateframeworks'] = 'Di chuyển khung';
$string['migratefrom'] = 'Di chuyển từ';
$string['migratefrom_help'] = 'Chọn khung năng lực cũ hơn hiện đang được sử dụng.';
$string['migratemore'] = 'Di cư nhiều hơn';
$string['migrateto'] = 'Di chuyển đến';
$string['migrateto_help'] = 'Chọn phiên bản mới hơn của khuôn khổ. Chỉ có thể chọn một khuôn khổ không bị ẩn.';
$string['migratingcourses'] = 'Các khóa học di chuyên';
$string['missingmappings'] = 'Thiếu ánh xạ';
$string['performmigration'] = 'Thực hiện di chuyển';
$string['pluginname'] = 'Công cụ di chuyển năng lực';
$string['privacy:metadata'] = 'Plugin công cụ di chuyển năng lực không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['results'] = 'Các kết quả';
$string['startdatefrom'] = 'Ngày bắt đầu từ';
$string['unmappedin'] = 'Chưa được ánh xạ trong {$a}';
$string['warningcouldnotremovecoursecompetency'] = 'Không thể xóa năng lực trong khóa học.';
$string['warningcouldnotremovemodulecompetency'] = 'Không thể xóa năng lực của tài nguyên hoặc hoạt động.';
$string['warningdestinationcoursecompetencyalreadyexists'] = 'Năng lực của khóa học đã tồn tại.';
$string['warningdestinationmodulecompetencyalreadyexists'] = 'Năng lực của tài nguyên hoặc hoạt động đã tồn tại.';
$string['warnings'] = 'Cảnh báo';
