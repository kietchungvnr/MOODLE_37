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
 * @package    mod
 * @subpackage zoom
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actions'] = 'Hành động';
$string['addtocalendar'] = 'Thêm vào lịch';
$string['allmeetings'] = 'Tất cả các cuộc họp';
$string['alternative_hosts'] = 'Máy chủ thay thế';
$string['alternative_hosts_help'] = 'Tùy chọn máy chủ lưu trữ thay thế cho phép bạn lên lịch các cuộc họp và chỉ định một người dùng Pro khác trên cùng một tài khoản để bắt đầu 
cuộc họp hoặc hội thảo trên web nếu bạn không thể. Người dùng này sẽ nhận được email thông báo rằng họ đã được thêm vào làm máy chủ lưu trữ thay thế, kèm theo liên kết để bắt đầu cuộc họp. Phân tách nhiều email bằng dấu phẩy (không có dấu cách).';
$string['apikey'] = 'Khóa API thu phóng';
$string['apisecret'] = 'Bí mật về API thu phóng';
$string['apiurl'] = 'Thu phóng url API';
$string['attentiveness_score'] = 'Điểm chú ý *';
$string['attentiveness_score_help'] = '* Điểm chú ý bị hạ xuống khi người tham gia không có tính năng Phóng to tiêu điểm trong hơn 30 giây khi ai đó đang chia sẻ màn hình.';
$string['audio_both'] = 'VoIP và Telephony';
$string['audio_telephony'] = 'Chỉ điện thoại';
$string['audio_voip'] = 'Chỉ VoIP';
$string['cachedef_sessions'] = 'Thông tin từ zoom nhận được yêu cầu báo cáo của người dùng';
$string['cachedef_zoomid'] = 'Id người dùng thu phóng của người dùng';
$string['calendardescriptionintro'] = 'Mô tả: {$a}';
$string['calendardescriptionURL'] = 'URL tham gia cuộc họp: {$a}.';
$string['calendariconalt'] = 'Biểu tượng lịch';
$string['clickjoin'] = 'Đã nhấp vào nút tham gia cuộc họp';
$string['connectionfailed'] = 'Kết nối thất bại:';
$string['connectionok'] = 'Kết nối hoạt động.';
$string['connectionstatus'] = 'Tình trạng kết nối';
$string['defaultsettings'] = 'Cài đặt thu phóng mặc định';
$string['defaultsettings_help'] = 'Các cài đặt này xác định các giá trị mặc định cho tất cả các cuộc họp Zoom và hội thảo trên web mới.';
$string['downloadical'] = 'Tải xuống iCal';
$string['duration'] = 'Thời lượng (phút)';
$string['endtime'] = 'Thời gian kết thúc';
$string['err_duration_nonpositive'] = 'Thời lượng phải là số dương.';
$string['err_duration_too_long'] = 'Thời lượng không được vượt quá 150 giờ.';
$string['err_long_timeframe'] = 'Khung thời gian được yêu cầu quá dài, hiển thị kết quả của tháng gần nhất trong phạm vi.';
$string['err_password'] = 'Mật khẩu chỉ được chứa các ký tự sau: [az AZ 0-9 @ - _ *]. Tối đa 10 ký tự.';
$string['err_start_time_past'] = 'Ngày bắt đầu không được trong quá khứ.';
$string['errorwebservice'] = 'Thu phóng lỗi dịch vụ web: {$a}.';
$string['export'] = 'Xuất';
$string['firstjoin'] = 'Lần đầu tiên có thể tham gia';
$string['firstjoin_desc'] = 'Người dùng sớm nhất có thể tham gia cuộc họp đã lên lịch (vài phút trước khi bắt đầu).';
$string['getmeetingreports'] = 'Nhận báo cáo cuộc họp từ Zoom';
$string['invalid_status'] = 'Trạng thái không hợp lệ, hãy kiểm tra cơ sở dữ liệu.';
$string['join'] = 'Tham gia';
$string['join_meeting'] = 'Tham gia cuộc họp';
$string['joinbeforehost'] = 'Tham gia cuộc họp trước người chủ trì';
$string['jointime'] = 'Tham gia thời gian';
$string['leavetime'] = 'Tới giờ rời đi';
$string['licensesnumber'] = 'Số lượng giấy phép';
$string['lowlicenses'] = 'Nếu số lượng giấy phép của bạn vượt quá yêu cầu, thì khi bạn tạo mỗi hoạt động mới bởi người dùng, nó sẽ được chỉ định một giấy phép PRO bằng cách hạ thấp trạng thái của người dùng khác. Tùy chọn có hiệu lực khi số lượng giấy phép PRO đang hoạt động nhiều hơn 5.';
$string['meeting_finished'] = 'Kết thúc';
$string['meeting_nonexistent_on_zoom'] = 'Không tồn tại khi thu phóng';
$string['meeting_not_started'] = 'Chưa bắt đầu';
$string['meeting_started'] = 'Trong tiến trình';
$string['meeting_time'] = 'Thời gian bắt đầu';
$string['meetingoptions'] = 'Tùy chọn cuộc họp';
$string['meetingoptions_help'] = '* Tham gia trước khi người dẫn chương trình * cho phép người dự tham gia cuộc họp trước khi người dẫn chương trình tham gia hoặc khi người chủ trì không thể tham gia cuộc họp.';
$string['modulename'] = 'Thu phóng cuộc họp';
$string['modulename_help'] = 'Zoom là một nền tảng hội nghị truyền hình và web cung cấp cho người dùng được ủy quyền khả năng tổ chức các cuộc họp trực tuyến.';
$string['modulenameplural'] = 'Thu phóng cuộc họp';
$string['newmeetings'] = 'Cuộc họp mới';
$string['nomeetinginstances'] = 'Không tìm thấy phiên nào cho cuộc họp này.';
$string['noparticipants'] = 'Không tìm thấy người tham gia cho phiên này vào lúc này.';
$string['nosessions'] = 'Không tìm thấy phiên nào cho phạm vi được chỉ định.';
$string['nozooms'] = 'Không có cuộc họp';
$string['off'] = 'Tắt';
$string['oldmeetings'] = 'Các cuộc họp kết thúc';
$string['on'] = 'Bật';
$string['option_audio'] = 'Tùy chọn âm thanh';
$string['option_host_video'] = 'Lưu trữ video';
$string['option_jbh'] = 'Bật tham gia trước máy chủ';
$string['option_participants_video'] = 'Video người tham gia';
$string['participants'] = 'Những người tham gia';
$string['password'] = 'Mật khẩu';
$string['passwordprotected'] = 'Mật khẩu bảo vệ';
$string['pluginadministration'] = 'Quản lý cuộc họp Thu phóng';
$string['pluginname'] = 'Thu phóng cuộc họp';
$string['privacy:metadata:zoom_meeting_details'] = 'Bảng cơ sở dữ liệu lưu trữ thông tin về từng trường hợp cuộc họp.';
$string['privacy:metadata:zoom_meeting_details:topic'] = 'Tên của cuộc họp mà người dùng đã tham dự.';
$string['privacy:metadata:zoom_meeting_participants'] = 'Bảng cơ sở dữ liệu lưu trữ thông tin về những người tham gia cuộc họp.';
$string['privacy:metadata:zoom_meeting_participants:attentiveness_score'] = 'Điểm chú ý của người tham gia';
$string['privacy:metadata:zoom_meeting_participants:duration'] = 'Người tham gia cuộc họp đã ở trong bao lâu';
$string['privacy:metadata:zoom_meeting_participants:join_time'] = 'Thời gian người tham gia cuộc họp';
$string['privacy:metadata:zoom_meeting_participants:leave_time'] = 'Thời gian người tham gia rời khỏi cuộc họp';
$string['privacy:metadata:zoom_meeting_participants:name'] = 'Tên của người tham gia';
$string['privacy:metadata:zoom_meeting_participants:user_email'] = 'Email của người tham gia';
$string['recurringmeeting'] = 'Định kỳ';
$string['recurringmeeting_help'] = 'Không có ngày kết thúc';
$string['recurringmeetinglong'] = 'Cuộc họp định kỳ (cuộc họp không có ngày kết thúc hoặc thời gian)';
$string['redefinelicenses'] = 'Xác định lại giấy phép';
$string['report'] = 'Báo cáo';
$string['reportapicalls'] = 'Báo cáo các lệnh gọi API đã hết';
$string['requirepassword'] = 'Yêu cầu mật khẩu cuộc họp';
$string['resetapicalls'] = 'Đặt lại số lượng lệnh gọi API có sẵn';
$string['search:activity'] = 'Thu phóng - thông tin hoạt động';
$string['sessions'] = 'Phiên họp';
$string['start'] = 'Khởi đầu';
$string['start_meeting'] = 'Bắt đầu cuộc họp';
$string['start_time'] = 'Khi nào';
$string['starthostjoins'] = 'Bắt đầu video khi người chủ trì tham gia';
$string['startpartjoins'] = 'Bắt đầu video khi các thành viên tham gia';
$string['starttime'] = 'Thời gian bắt đầu';
$string['status'] = 'Trạng thái';
$string['title'] = 'Tiêu đề';
$string['topic'] = 'Chủ đề';
$string['unavailable'] = 'Không thể tham gia vào lúc này';
$string['updatemeetings'] = 'Cập nhật cài đặt cuộc họp từ Thu phóng';
$string['usepersonalmeeting'] = 'Sử dụng ID cuộc họp cá nhân {$a}';
$string['webinar'] = 'Hội thảo trên web';
$string['webinar_already_false'] = '<p> <b> Mô-đun này đã được đặt làm cuộc họp, không phải hội thảo trên web. Bạn không thể chuyển đổi cài đặt này sau khi tạo cuộc họp. </b> </p>';
$string['webinar_already_true'] = '<p> <b> Mô-đun này đã được đặt làm hội thảo trên web, không phải cuộc họp. Bạn không thể chuyển đổi cài đặt này sau khi tạo hội thảo trên web. </b> </p>';
$string['webinar_help'] = 'Tùy chọn này chỉ có sẵn cho các tài khoản Zoom được ủy quyền trước.';
$string['zoom:addinstance'] = 'Thêm một cuộc họp Thu phóng mới';
$string['zoom:view'] = 'Xem các cuộc họp Thu phóng';
$string['zoomemail'] = 'Zoom Email';
$string['zoomerr'] = 'Đã xảy ra lỗi với Thu phóng.';
$string['zoomerr_apikey_missing'] = 'Không tìm thấy khóa API thu phóng';
$string['zoomerr_apisecret_missing'] = 'Không tìm thấy bí mật của Zoom API';
$string['zoomerr_id_missing'] = 'Bạn phải chỉ định ID course_module hoặc ID phiên bản';
$string['zoomerr_licensescount_missing'] = 'Đã tìm thấy cài đặt thu phóng tối đa nhưng không tìm thấy cài đặt số lượng giấy phép';
$string['zoomerr_meetingnotfound'] = 'Không thể tìm thấy cuộc họp này trên Zoom. Bạn có thể <a href="{$a->recreate} "> tạo lại nó tại đây </a> hoặc <a href="{$a->delete}"> xóa hoàn toàn </a>.';
$string['zoomerr_meetingnotfound_info'] = 'Không thể tìm thấy cuộc họp này trên Zoom. Vui lòng liên hệ với người tổ chức cuộc họp nếu bạn có thắc mắc.';
$string['zoomerr_usernotfound'] = 'Không thể tìm thấy tài khoản của bạn trên Zoom. Nếu bạn đang sử dụng Zoom lần đầu tiên, bạn phải thu phóng tài khoản bằng cách đăng nhập vào Zoom <a href="{$a}" target="_blank"> {$a} </a>. Khi bạn đã kích hoạt tài khoản Zoom của mình, hãy tải lại trang này và tiếp tục thiết lập cuộc họp của bạn. Nếu không, hãy đảm bảo email của bạn trên Zoom khớp với email của bạn trên hệ thống này.';
$string['zoomurl'] = 'Thu phóng URL trang chủ';
