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
 * @subpackage auth
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowaccountssameemail'] = 'Cho phép các tài khoản có cùng email';
$string['allowaccountssameemail_desc'] = 'Nếu được bật, nhiều tài khoản người dùng có thể chia sẻ cùng một địa chỉ email. Điều này có thể dẫn đến các vấn đề về bảo mật hoặc quyền riêng tư, chẳng hạn với email xác nhận thay đổi mật khẩu.';
$string['auth_fieldlockfield'] = 'Khóa giá trị ({$a})';
$string['auth_fieldmapping'] = 'Ánh xạ dữ liệu ({$a})';
$string['auth_sync_suspended'] = 'Khi được bật, thuộc tính bị tạm ngưng sẽ được sử dụng để cập nhật trạng thái tạm ngưng của tài khoản người dùng cục bộ.';
$string['auth_sync_suspended_key'] = 'Đồng bộ hóa trạng thái tạm ngưng của người dùng cục bộ';
$string['auth_updatelocalfield'] = 'Cập nhật địa phương ({$a})';
$string['auth_updateremotefield'] = 'Cập nhật bên ngoài ({$a})';
$string['auth_usernotexist'] = 'Không thể cập nhật người dùng không tồn tại: {$a}';
$string['cannotmapfield'] = 'Không thể ánh xạ trường "{$a->fieldname}" vì tên ngắn "{$a->shortname}" của nó quá dài. Để cho phép nó được ánh xạ, bạn cần giảm tên ngắn thành {$a->charlimit} ký tự. <a href="{$a->link} "> Chỉnh sửa trường hồ sơ người dùng </a>';
$string['getrecaptchaapi'] = 'Để sử dụng reCAPTCHA, bạn phải lấy khóa API từ <a href=\'https://www.google.com/recaptcha/admin\'> https://www.google.com/recaptcha/admin </a>';
$string['md5'] = 'MD5 băm';
$string['privacy:metadata:userpref:createpassword'] = 'Cho biết mật khẩu phải được tạo cho người dùng';
$string['privacy:metadata:userpref:forcepasswordchange'] = 'Cho biết liệu người dùng có nên thay đổi mật khẩu của họ khi đăng nhập hay không';
$string['privacy:metadata:userpref:loginfailedcount'] = 'Số lần người dùng không đăng nhập được';
$string['privacy:metadata:userpref:loginfailedcountsincesuccess'] = 'Số lần người dùng không đăng nhập được kể từ lần đăng nhập thành công cuối cùng của họ';
$string['privacy:metadata:userpref:loginfailedlast'] = 'Ngày ghi lại lần đăng nhập thất bại cuối cùng';
$string['privacy:metadata:userpref:loginlockout'] = 'Tài khoản của người dùng có bị khóa do đăng nhập không thành công hay không và ngày tài khoản bị khóa';
$string['privacy:metadata:userpref:loginlockoutignored'] = 'Cho biết rằng tài khoản của người dùng sẽ không bao giờ bị khóa';
$string['privacy:metadata:userpref:loginlockoutsecret'] = 'Khi bị khóa, bí mật mà người dùng phải sử dụng để mở khóa tài khoản của họ';
$string['recaptcha'] = 'reCAPTCHA';
$string['settingmigrationmismatch'] = 'Đã phát hiện thấy giá trị không khớp trong khi sửa tên cài đặt plugin! Plugin xác thực \'{$a->plugin}\' có cài đặt \'{$a->setting}\' được định cấu hình thành \'{$a->legacy}\' dưới tên cũ và thành \'{$a->current}\' dưới tên hiện tại. Giá trị thứ hai đã được đặt là giá trị hợp lệ nhưng bạn nên kiểm tra và xác nhận rằng nó được mong đợi.';
$string['sha1'] = 'Hàm băm SHA-1';
$string['username'] = 'tên tài khoản';
$string['username_help'] = 'Xin lưu ý rằng một số plugin xác thực sẽ không cho phép bạn thay đổi tên người dùng.';
