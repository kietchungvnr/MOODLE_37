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
 * @subpackage dbtransfer
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['clidriverlist'] = 'Trình điều khiển cơ sở dữ liệu có sẵn để di chuyển';
$string['cliheading'] = 'Di chuyển cơ sở dữ liệu - đảm bảo không ai đang truy cập vào máy chủ trong quá trình di chuyển!';
$string['climigrationnotice'] = 'Đang di chuyển cơ sở dữ liệu, vui lòng đợi cho đến khi quá trình di chuyển hoàn tất và quản trị viên máy chủ cập nhật cấu hình và xóa tệp $CFG->dataroot / 
climaintenance.html.';
$string['convertinglogdisplay'] = 'Chuyển đổi các hành động hiển thị nhật ký';
$string['dbexport'] = 'Xuất cơ sở dữ liệu';
$string['dbtransfer'] = 'Chuyển đổi cơ sở dữ liệu';
$string['enablemaintenance'] = 'Bật chế độ bảo trì';
$string['enablemaintenance_help'] = 'Tùy chọn này cho phép chế độ bảo trì trong và sau khi di chuyển cơ sở dữ liệu, nó ngăn chặn quyền truy cập của tất cả người dùng cho đến khi quá trình di chuyển hoàn tất. Xin 
lưu ý rằng quản trị viên phải xóa thủ công tệp $CFG->dataroot / climaintenance.html sau khi cập nhật cài đặt config.php để tiếp tục hoạt động bình thường.';
$string['exportdata'] = 'Xuất dữ liệu';
$string['notargetconectexception'] = 'Không thể kết nối cơ sở dữ liệu đích, xin lỗi.';
$string['options'] = 'Tùy chọn';
$string['pluginname'] = 'Chuyển cơ sở dữ liệu';
$string['privacy:metadata'] = 'Plugin chuyển Cơ sở dữ liệu không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['targetdatabase'] = 'Cơ sở dữ liệu mục tiêu';
$string['targetdatabasenotempty'] = 'Cơ sở dữ liệu đích không được chứa bất kỳ bảng nào có tiền tố đã cho!';
$string['transferdata'] = 'Truyền tải dữ liệu';
$string['transferdbintro'] = 'Tập lệnh này sẽ chuyển toàn bộ nội dung của cơ sở dữ liệu này sang máy chủ cơ sở dữ liệu khác. Nó thường được sử dụng để di chuyển dữ liệu sang loại cơ sở dữ liệu khác 
nhau.';
$string['transferdbtoserver'] = 'Chuyển cơ sở dữ liệu Moodle này sang máy chủ khác';
$string['transferringdbto'] = 'Chuyển cơ sở dữ liệu {$a->dbtypefrom} này sang cơ sở dữ liệu {$a->dbtype} "{$a->dbname}" trên "{$a->dbhost}"';
