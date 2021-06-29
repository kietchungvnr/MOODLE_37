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
 * @subpackage quiz
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addaquestion'] = 'Thêm mới một câu hỏi';
$string['addarandomquestion'] = 'Thêm một câu hỏi ngẫu nhiên';
$string['addmoreoverallfeedbacks'] = 'Thêm {no} trường phản hồi';
$string['addrandomfromcategory'] = 'Thêm câu hỏi ngẫu nhiên từ danh mục:';
$string['answertoolong'] = 'Trả lời quá dài sau dòng {$a} (tối đa 255 ký tự)';
$string['anytags'] = 'Bất kỳ thẻ nào';
$string['attempterrorcontentchange'] = 'Bản xem trước bài kiểm tra này không còn tồn tại. (Khi một bài kiểm tra được chỉnh sửa, mọi bản xem trước đang thực hiện sẽ tự động bị xóa.)';
$string['attemptnumber'] = 'Lần thi';
$string['attemptsnum'] = 'Số lượng bài làm: {$a}';
$string['attemptstate'] = 'Trạng thái';
$string['attempttitle'] = '{$a}';
$string['backtocourse'] = 'Quay về khóa học';
$string['canredoquestions'] = 'Cho phép làm lại bài trong một lần thử';
$string['canredoquestionsyes'] = 'Học viên có thể làm lại bất kỳ câu hỏi nào đã hoàn thành';
$string['changeallmark'] = 'Thay đổi';
$string['code'] = 'Mã số';
$string['codeexists'] = 'Mã câu hỏi \'{$a}\' hiện có';
$string['completionattemptsexhausted'] = 'Hoàn thành tất cả lần làm bài';
$string['completionpass'] = 'Yêu cầu điểm để hoàn thành';
$string['decimalplaces'] = 'Vị trí thập phân trong điểm số';
$string['decimalplacesquestion'] = 'Vị trí thập phân trong điểm số câu hỏi';
$string['delay1st2nd_help'] = 'Nếu được bật, học sinh phải đợi thời gian quy định trôi qua trước khi có thể làm bài trắc nghiệm lần thứ hai.';
$string['editingquizx'] = 'Chỉnh sửa đề thi: {$a}';
$string['editoverride'] = 'Chỉnh sửa ghi đè';
$string['editquestion'] = 'Chỉnh sửa câu hỏi';
$string['emailconfirmbody'] = 'Xin chào {$a->username}, Cảm ơn bạn đã gửi câu trả lời cho \'{$a->quizname}\' trong khóa học \'{$a->coursename}\' tại {$a->submissiontime}. Thông báo này xác nhận rằng câu trả lời của bạn đã được lưu. Bạn có thể truy cập bài kiểm tra này tại {$a->quizurl}.';
$string['emailconfirmsmall'] = 'Cảm ơn bạn đã gửi câu trả lời cho \'{$a->quizname}\'';
$string['emailconfirmsubject'] = 'Xác nhận gửi: {$a->quizname}';
$string['emailnotifybody'] = 'Xin chào {$a->username}, {$a->studentname} đã hoàn thành khóa học \'{$a->quizname}\' ({$a->quizurl}) trong khóa học \'{$a->coursename}\'. Bạn có thể xem lại lần 
thử này tại {$a->quizreviewurl}.';
$string['emailnotifysmall'] = '{$a->studentname} đã hoàn thành {$a->quizname}. Xem {$a->quizreviewurl}';
$string['emailnotifysubject'] = '{$a->studentname} đã hoàn thành {$a->quizname}';
$string['emailoverduebody'] = 'Xin chào {$a->studentname}, Bạn đã bắt đầu thử \'{$a->quizname}\' trong khóa học \'{$a->coursename}\', nhưng bạn chưa bao giờ gửi. Nó đáng lẽ phải được gửi trước {$a-
>tryduedate}. Nếu bạn vẫn muốn gửi lần thử này, vui lòng truy cập {$a->tryummaryurl} và nhấp vào nút gửi. Bạn phải thực hiện việc này trước {$a->trygraceend} nếu không nỗ lực của bạn sẽ không được tính.';
$string['emailoverduesmall'] = 'Bạn đã không gửi nỗ lực của mình tại {$a->quizname}. Vui lòng truy cập {$a->tryummaryurl} trước {$a->trygraceend} nếu bạn vẫn muốn gửi.';
$string['emailoverduesubject'] = 'kiểm tra đã quá hạn: {$a->quizname}';
$string['empty'] = 'Trống';
$string['enabled'] = 'Bật';
$string['endtest'] = 'Kết thúc bài thi';
$string['errorinquestion'] = 'Lỗi trong câu hỏi';
$string['errorunexpectedevent'] = 'Đã tìm thấy mã sự kiện không mong muốn {$a->event} cho câu hỏi {$a->questiononid} trong bài kiểm tra {$a->trytid}.';
$string['eventattemptdeleted'] = 'Đã xóa lần làm bài';
$string['eventattemptpreviewstarted'] = 'Đã bắt đầu xem trước thử câu hỏi';
$string['eventattemptreviewed'] = 'Đã đánh giá thử câu hỏi';
$string['eventattemptsummaryviewed'] = 'Đã xem tóm tắt thử câu hỏi';
$string['eventattemptviewed'] = 'Đã xem thử câu hỏi';
$string['eventeditpageviewed'] = 'Đã xem trang chỉnh sửa câu hỏi';
$string['eventoverridecreated'] = 'Đã tạo ghi đè câu hỏi';
$string['eventoverridedeleted'] = 'Đã xóa ghi đè câu hỏi';
$string['eventoverrideupdated'] = 'Đã cập nhật ghi đè câu hỏi';
$string['eventquestionmanuallygraded'] = 'Câu hỏi được chấm điểm theo cách thủ công';
$string['eventquizattemptabandoned'] = 'Thử câu hỏi bị bỏ qua';
$string['eventquizattemptstarted'] = 'Thử câu hỏi đã bắt đầu';
$string['eventquizattemptsubmitted'] = 'Đã gửi thử câu hỏi';
$string['eventquizattempttimelimitexceeded'] = 'Đã vượt quá giới hạn thời gian thử câu hỏi';
$string['eventreportviewed'] = 'Đã xem báo cáo câu hỏi';
$string['everynquestions'] = 'Mỗi {$a} câu hỏi';
$string['everyquestion'] = 'Mỗi câu hỏi';
$string['everythingon'] = 'Mọi thứ trên';
$string['existingcategory'] = 'Danh mục hiện có';
$string['exportcategory'] = 'danh mục xuất khẩu';
$string['extraattemptrestrictions'] = 'Hạn chế truy cập';
$string['file'] = 'Tệp';
$string['finishattemptdots'] = 'Hoàn thành kiểm tra...';
$string['finishreview'] = 'Kết thúc đánh giá';
$string['formulaerror'] = 'Lỗi công thức!';
$string['functiondisabledbysecuremode'] = 'Chức năng đó hiện đã bị vô hiệu hóa';
$string['generalfeedback_help'] = 'Phản hồi chung là văn bản được hiển thị sau khi một câu hỏi đã được thử. Không giống như phản hồi cho một câu hỏi cụ thể phụ thuộc vào câu trả lời được đưa ra, cùng một 
phản hồi chung luôn được hiển thị.';
$string['graceperiod'] = 'Gia hạn thời gian gửi';
$string['graceperiod_desc'] = 'Nếu việc cần làm khi hết thời gian được đặt thành \'Cho phép gửi thời gian gia hạn, nhưng không thay đổi bất kỳ câu trả lời nào\', thì đây là lượng thời gian bổ sung mặc 
định được phép.';
$string['graceperiod_help'] = 'Nếu việc cần làm khi thời gian hết hạn được đặt thành \'Cho phép gửi thời gian gia hạn, nhưng không thay đổi bất kỳ câu trả lời nào\', thì đây là lượng thời gian bổ sung được 
phép.';
$string['graceperiodmin'] = 'Gia hạn thời gian gửi cuối';
$string['graceperiodmin_desc'] = 'Có một vấn đề tiềm ẩn ngay ở cuối bài kiểm tra. Một mặt, chúng tôi muốn để học sinh tiếp tục làm việc cho đến giây cuối cùng - với sự trợ giúp của bộ đếm thời gian tự động 
gửi bài kiểm tra khi hết thời gian. Mặt khác, máy chủ sau đó có thể bị quá tải và mất một khoảng thời gian để xử lý phản hồi. Do đó, chúng tôi sẽ chấp nhận các phản hồi cho đến thời điểm này sau khi thời gian hết hạn, vì vậy chúng không bị phạt do máy chủ chạy chậm. Tuy nhiên, học sinh có thể gian lận và mất nhiều giây này để trả lời câu hỏi. Bạn phải đánh đổi dựa trên mức độ bạn tin tưởng vào hiệu suất của máy chủ của mình trong các cuộc kiểm tra.';
$string['graceperiodtoosmall'] = 'Thời gian gia hạn phải nhiều hơn {$a}.';
$string['grademethod_help'] = 'Khi cho phép nhiều lần kiểm tra, các phương pháp sau có sẵn để tính điểm bài kiểm tra cuối cùng: * Điểm cao nhất của tất cả các lần thử * Điểm trung bình (trung bình) của tất cả 
các lần kiểm * Lần kiểm tra đầu tiên (tất cả các lần thử khác đều bị bỏ qua) * Lần kiểm tra cuối cùng (tất cả các lần thử khác bị bỏ qua)';
$string['gradesdeleted'] = 'Đã xóa điểm câu hỏi';
$string['gradesofar'] = '{$a->method}: {$a->mygrade} / {$a->quizgrade}.';
$string['gradetopassnotset'] = 'Bài kiểm tra này chưa có điểm để vượt qua. Nó có thể được đặt trong phần Điểm của cài đặt bài kiểm tra.';
$string['gradingdetailspenalty'] = 'Nội dung gửi này đã bị phạt {$a}.';
$string['gradingmethod'] = 'Phương thức tính điểm: {$a}';
$string['groupoverrides'] = 'Thi lại theo nhóm';
$string['groupoverridesdeleted'] = 'Ghi đè nhóm đã bị xóa';
$string['groupsnone'] = 'Không có nhóm nào bạn có thể truy cập.';
$string['hidebreaks'] = 'Ẩn ngắt trang';
$string['hidereordertool'] = 'Ẩn công cụ sắp xếp lại thứ tự';
$string['howquestionsbehave_desc'] = 'Cài đặt mặc định cho cách các câu hỏi hoạt động trong một bài kiểm tra.';
$string['import_help'] = 'Chức năng này cho phép bạn nhập câu hỏi từ các tệp văn bản bên ngoài. Nếu tệp của bạn chứa các ký tự không phải ascii thì tệp đó phải sử dụng mã hóa UTF-8. Đặc biệt 
thận trọng với các tệp được tạo bởi các ứng dụng Microsoft Office, vì những tệp này thường sử dụng mã hóa đặc biệt sẽ không được xử lý chính xác. Định dạng Nhập và Xuất là một tài nguyên có thể cắm được. Các định dạng tùy chọn khác có thể có sẵn trong cơ sở dữ liệu Mô-đun và Trình cắm.';
$string['inactiveoverridehelp'] = '* Học viên không có nhóm hoặc vai trò chính xác để thực hiện bài kiểm tra';
$string['indicator:cognitivedepth'] = 'Đố về hiểu biết';
$string['indicator:cognitivedepth_help'] = 'Chỉ số này dựa trên độ sâu nhận thức mà học sinh đạt được trong hoạt động Trắc nghiệm.';
$string['indicator:socialbreadth'] = 'Đố xã hội';
$string['indicator:socialbreadth_help'] = 'Chỉ số này dựa trên phạm vi xã hội mà học sinh đạt được trong hoạt động Trắc nghiệm.';
$string['infoshort'] = 'Tôi';
$string['initialnumfeedbacks'] = 'Số lượng trường phản hồi tổng thể ban đầu';
$string['initialnumfeedbacks_desc'] = 'Khi tạo một bài kiểm tra mới, hãy cung cấp nhiều hộp phản hồi tổng thể trống này. Khi bài kiểm tra đã được tạo, biểu mẫu hiển thị số trường cần thiết cho số lượng phản hồi trong bài kiểm tra. Cài đặt ít nhất phải là 1.';
$string['inprogress'] = 'Trong tiến trình';
$string['invalidattemptid'] = 'Không tồn tại ID lần kiểm tra này';
$string['invalidoverrideid'] = 'Id ghi đè không hợp lệ';
$string['invalidquestionid'] = 'Id câu hỏi không hợp lệ';
$string['invalidquizid'] = 'ID bài kiểm tra không hợp lệ';
$string['invalidstateid'] = 'Id trạng thái không hợp lệ';
$string['layout'] = 'Cách bố trí bài thi';
$string['layoutasshown'] = 'Bố cục trang như hình.';
$string['layoutasshownwithpages'] = 'Bố cục trang như hình. <small> (Trang mới tự động sau mỗi {$a} câu hỏi.) </small>';
$string['layoutshuffledandpaged'] = 'Các câu hỏi được xáo trộn ngẫu nhiên với {$a} câu hỏi trên mỗi trang.';
$string['layoutshuffledsinglepage'] = 'Các câu hỏi được xáo trộn ngẫu nhiên, tất cả trên một trang.';
$string['legacyquizaccessrulescron'] = 'Quy tắc truy cập cron quiz kế thừa';
$string['legacyquizreportscron'] = 'Báo cáo bài kiểm tra cron kế thừa';
$string['loadingquestionsfailed'] = 'Tải câu hỏi không thành công: {$a}';
$string['manualgradequestion'] = 'Cho điểm thủ công câu hỏi {$a->question} trong {$a->quiz} bởi {$a->user}';
$string['marks'] = 'Số câu trả lời';
$string['marks_help'] = 'Điểm số cho mỗi câu hỏi và điểm tổng thể.';
$string['maxmark'] = 'Điểm tối đa';
$string['messageprovider:attempt_overdue'] = 'Cảnh báo khi làm bài kiểm tra của bạn quá hạn';
$string['messageprovider:confirmation'] = 'Xác nhận việc nộp bài kiểm tra của bạn';
$string['messageprovider:submission'] = 'Thông báo về việc nộp bài kiểm tra';
$string['modulename_help'] = 'Hoạt động đề thi cho phép giáo viên tạo ra các bài thi bao gồm các câu hỏi thuộc nhiều loại khác nhau, bao gồm câu hỏi nhiều lựa chọn, câu hỏi nối, câu hỏi tự luận ngắn và câu hỏi tính toán.

Giáo viên có thể cho phép làm bài kiểm tra nhiều lần, với các câu hỏi được xáo trộn hoặc được chọn ngẫu nhiên từ ngân hàng câu hỏi. Một giới hạn thời gian có thể được thiết lập.

Mỗi câu trả lời đều được chấm điểm tự động, ngoại trừ các câu hỏi tiểu luận và điểm được ghi vào sổ điểm.

Giáo viên có thể chọn khi nào và nếu các gợi ý, phản hồi và câu trả lời đúng có được hiển thị cho học viên hay không.

Đề thi có thể được sử dụng

Như bài kiểm tra khóa học
Như bài thi thực hành sử dụng câu hỏi từ các kỳ thi trước
Để cung cấp phản hồi ngay lập tức về hiệu suất
Để tự đánh giá';
$string['moveselectedonpage'] = 'Chuyển các câu hỏi đã chọn sang trang: {$a}';
$string['mustbesubmittedby'] = 'Bài thi này phải được nộp vào {$a}.';
$string['navigatenext'] = 'Trang tiếp theo';
$string['navigateprevious'] = 'Trang trước';
$string['navmethod'] = 'Phương pháp điều hướng';
$string['navmethod_free'] = 'Tự do';
$string['navmethod_help'] = 'Khi điều hướng tuần tự được bật, học sinh phải tiến bộ qua bài kiểm tra theo thứ tự và không được quay lại các trang trước cũng như không bỏ qua.';
$string['navmethod_seq'] = 'Liền nhau';
$string['navnojswarning'] = 'Cảnh báo: các liên kết này sẽ không lưu câu trả lời của bạn. Sử dụng nút tiếp theo ở cuối trang.';
$string['neverallononepage'] = 'Không, tất cả các câu hỏi trên một trang';
$string['newcategory'] = 'Danh mục mới';
$string['newpage'] = 'Trang mới';
$string['newpage_help'] = 'Đối với các câu đố dài hơn, bạn nên kéo dài câu hỏi trên nhiều trang bằng cách giới hạn số lượng câu hỏi trên mỗi trang. Khi thêm câu hỏi vào bài kiểm tra, ngắt trang sẽ tự 
động được chèn theo cài đặt này. Tuy nhiên, các ngắt trang sau đó có thể được di chuyển theo cách thủ công trên trang chỉnh sửa.';
$string['newpageevery'] = 'Tự động bắt đầu một trang mới';
$string['newsectionheading'] = 'Tiêu đề mới';
$string['noattemptsfound'] = 'Không tìm thấy lần kiểm tra nào.';
$string['noclose'] = 'Không có ngày đóng';
$string['nodatasubmitted'] = 'Không có dữ liệu được gửi.';
$string['nogradewarning'] = 'Bài kiểm tra này không được tính điểm, vì vậy bạn không thể đặt phản hồi tổng thể khác nhau theo cấp độ.';
$string['noopen'] = 'Không có ngày mở';
$string['nooverridedata'] = 'Bạn phải ghi đè ít nhất một trong các cài đặt bài kiểm tra.';
$string['noquestionintext'] = 'Văn bản câu hỏi không chứa bất kỳ câu hỏi nhúng nào';
$string['noquestionsinquiz'] = 'Không có câu hỏi nào trong bài kiểm tra này.';
$string['noquestionsonpage'] = 'Trang trống';
$string['noreviewattempt'] = 'Bạn không được phép xem lại nỗ lực này.';
$string['noreviewshort'] = 'Không được phép';
$string['noreviewuntilshort'] = 'Có sẵn {$a}';
$string['notenoughrandomquestions'] = 'Không có đủ câu hỏi trong danh mục {$a->category} để tạo câu hỏi {$a->name} ({$a->id}).';
$string['notyetgraded'] = 'Chưa chấm điểm';
$string['notyetviewed'] = 'Chưa được xem';
$string['notyourattempt'] = 'Đây không phải là nỗ lực của bạn!';
$string['noview'] = 'Người dùng đã đăng nhập không được phép xem bài kiểm tra này';
$string['numattemptsmade'] = '{$a} lần thử thực hiện bài kiểm tra này';
$string['numquestionsx'] = 'Số lượng câu hỏi: {$a}';
$string['oneminute'] = '1 phút';
$string['onthispage'] = 'Trang này';
$string['open'] = 'Không có câu trả lời';
$string['openafterclose'] = 'Không thể cập nhật bài kiểm tra. Bạn đã chỉ định một ngày mở sau ngày đóng cửa.';
$string['openclosedatesupdated'] = 'Đã cập nhật ngày mở và đóng câu đố';
$string['orderandpaging'] = 'Đặt và phân trang';
$string['orderingquiz'] = 'Đặt và phân trang';
$string['orderingquizx'] = 'Đặt và phân trang: {$a}';
$string['outcomesadvanced'] = 'Kết quả là cài đặt nâng cao';
$string['outofpercent'] = '{$a->grade} trong số {$a->maxgrade} ({$a->percent}%)';
$string['outofshort'] = '{$a->grade} / {$a->maxgrade}';
$string['overallfeedback_help'] = 'Phản hồi tổng thể là văn bản được hiển thị sau khi thử một bài kiểm tra. Bằng cách chỉ định ranh giới lớp bổ sung (dưới dạng phần trăm hoặc dưới dạng số), văn bản được 
hiển thị có thể phụ thuộc vào lớp đạt được.';
$string['overduehandling'] = 'Khi hết thời gian';
$string['overduehandling_desc'] = 'Điều gì sẽ xảy ra theo mặc định nếu học sinh không nộp bài kiểm tra trước khi hết thời gian.';
$string['overduehandling_help'] = 'Cài đặt này kiểm soát những gì sẽ xảy ra nếu học sinh không nộp bài kiểm tra trước khi hết thời gian. Nếu học sinh đang tích cực làm bài kiểm tra tại thời điểm đó, thì đồng hồ 
đếm ngược sẽ luôn tự động gửi bài thi cho họ, nhưng nếu họ đã đăng xuất, thì cài đặt này sẽ kiểm soát những gì xảy ra.';
$string['overduehandlingautoabandon'] = 'Bài thi bắt buộc phải nộp trước khi thời gian hết hạn, nếu không sẽ không được chấp nhận';
$string['overduehandlingautosubmit'] = 'Tự động nộp bài';
$string['overduehandlinggraceperiod'] = 'Có thời gian ân hạn trước khi nộp bài, nhưng không được trả lời thêm bất kỳ câu hỏi nào';
$string['overduemustbesubmittedby'] = 'Nỗ lực này hiện đã quá hạn. Nó đáng lẽ đã được gửi. Nếu bạn muốn bài kiểm tra này được chấm điểm, bạn phải gửi nó trước {$a}. Nếu bạn không nộp nó vào thời điểm đó, sẽ không có điểm nào từ lần thử này được tính.';
$string['override'] = 'Ghi đè';
$string['overridegroup'] = 'Ghi đè nhóm';
$string['overridegroupeventname'] = '{$a->quiz} - {$a->group}';
$string['overrides'] = 'Ghi đè';
$string['overrideuser'] = 'Ghi đè người dùng';
$string['overrideusereventname'] = '{$a->quiz} - Ghi đè';
$string['page-mod-quiz-attempt'] = 'Trang làm kiểm tra';
$string['page-mod-quiz-edit'] = 'Chỉnh sửa trang bài kiểm tra';
$string['page-mod-quiz-report'] = 'Mọi trang báo cáo kiểm tra';
$string['page-mod-quiz-review'] = 'Xem lại trang làm kiểm tra';
$string['page-mod-quiz-summary'] = 'Trang tổng quan làm kiểm tra';
$string['page-mod-quiz-view'] = 'Trang thông bài kiểm tra';
$string['page-mod-quiz-x'] = 'Bất kỳ trang mô-đun bài kiểm tra nào';
$string['pageshort'] = 'P';
$string['pagesize'] = 'Kích thước trang';
$string['parentcategory'] = 'Danh mục cha';
$string['parsingquestions'] = 'Phân tích cú pháp câu hỏi từ tệp nhập.';
$string['penaltyscheme_help'] = 'Nếu được kích hoạt, một hình phạt sẽ được trừ vào điểm cuối cùng cho một câu hỏi trả lời sai. Số tiền phạt được chỉ định trong cài đặt câu hỏi. Cài đặt này chỉ áp dụng nếu chế độ thích ứng được bật.';
$string['pluginadministration'] = 'Quản trị câu hỏi';
$string['preprocesserror'] = 'Đã xảy ra lỗi trong quá trình xử lý trước!';
$string['previewquiznow'] = 'Xem trước bài kiểm tra ngay bây giờ';
$string['privacy:metadata:core_question'] = 'Hoạt động câu hỏi lưu trữ thông tin sử dụng câu hỏi trong hệ thống con core_question.';
$string['privacy:metadata:quiz'] = 'Hoạt động câu hỏi sử dụng các báo cáo của câu hỏi.';
$string['privacy:metadata:quiz_attempts'] = 'Chi tiết về mỗi lần  làm một bài kiểm tra.';
$string['privacy:metadata:quiz_attempts:attempt'] = 'Số lần kiểm tra.';
$string['privacy:metadata:quiz_attempts:currentpage'] = 'Trang hiện tại mà người dùng đang truy cập.';
$string['privacy:metadata:quiz_attempts:preview'] = 'Cho dù đây là bản xem trước của bài kiểm tra.';
$string['privacy:metadata:quiz_attempts:state'] = 'Tình trạng hiện tại của kiểm tra.';
$string['privacy:metadata:quiz_attempts:sumgrades'] = 'Tổng điểm trong bài kiểm tra.';
$string['privacy:metadata:quiz_attempts:timecheckstate'] = 'Thời gian mà trạng thái đã được kiểm tra.';
$string['privacy:metadata:quiz_attempts:timefinish'] = 'Thời gian bài kiểm tra đã được hoàn thành.';
$string['privacy:metadata:quiz_attempts:timemodified'] = 'Thời gian bài kiểm tra đã được cập nhật.';
$string['privacy:metadata:quiz_attempts:timemodifiedoffline'] = 'Thời gian bài kiểm tra đã được cập nhật thông qua một bản cập nhật ngoại tuyến.';
$string['privacy:metadata:quiz_attempts:timestart'] = 'Thời gian bài kiểm tra được bắt đầu.';
$string['privacy:metadata:quiz_grades'] = 'Thông tin chi tiết về điểm tổng thể cho bài kiểm tra này.';
$string['privacy:metadata:quiz_grades:grade'] = 'Điểm tổng thể cho bài kiểm tra này.';
$string['privacy:metadata:quiz_grades:quiz'] = 'Bài kiểm tra đã được chấm điểm.';
$string['privacy:metadata:quiz_grades:timemodified'] = 'Thời gian mà điểm đã được sửa đổi.';
$string['privacy:metadata:quiz_grades:userid'] = 'Người dùng đã được xếp loại.';
$string['privacy:metadata:quiz_overrides'] = 'Thông tin chi tiết về ghi đè cho bài kiểm tra này';
$string['privacy:metadata:quiz_overrides:quiz'] = 'Bài kiểm tra với thông tin ghi đè';
$string['privacy:metadata:quiz_overrides:timeclose'] = 'Thời gian kết thúc mới cho bài kiểm tra.';
$string['privacy:metadata:quiz_overrides:timelimit'] = 'Thời hạn mới cho bài kiểm tra.';
$string['privacy:metadata:quiz_overrides:timeopen'] = 'Thời gian mở mới cho bài kiểm tra.';
$string['privacy:metadata:quiz_overrides:userid'] = 'Người dùng bị ghi đè';
$string['privacy:metadata:quizaccess'] = 'Hoạt động đố vui sử dụng các quy tắc truy cập bài kiểm tra.';
$string['qbrief'] = 'Q. {$a}';
$string['qname'] = 'Tên';
$string['qtypename'] = 'Loại , tên';
$string['questionbank'] = 'Thêm từ ngân hàng câu hỏi';
$string['questionbankmanagement'] = 'Quản lý ngân hàng câu hỏi';
$string['questionbehaviour'] = 'Hành vi câu hỏi';
$string['questiondependencyadd'] = 'Không hạn chế khi có thể thử câu hỏi {$a->thisq} • Nhấp để thay đổi';
$string['questiondependencyfree'] = 'Không hạn chế câu hỏi này';
$string['questiondependencyremove'] = 'Không thể thử câu hỏi {$a->thisq} cho đến khi hoàn thành câu hỏi trước {$a->beforeq} • Nhấp để thay đổi';
$string['questiondependsonprevious'] = 'Câu hỏi này không thể được thử cho đến khi câu hỏi trước đã được hoàn thành.';
$string['questionmissing'] = 'Câu hỏi cho phiên này bị thiếu';
$string['questionnonav'] = '<span class = "accesshide"> Câu hỏi </span> {$a->number} <span class = "accesshide"> {$a->attributes} </span>';
$string['questionnonavinfo'] = '<span class = "accesshide"> Thông tin </span> {$a->number} <span class = "accesshide"> {$a->attributes} </span>';
$string['questionnotloaded'] = 'Câu hỏi {$a} chưa được tải từ cơ sở dữ liệu';
$string['questionorder'] = 'Đặt câu hỏi';
$string['questionposition'] = 'Vị trí mới cho câu hỏi {$a}';
$string['questionsetpreview'] = 'Xem trước bộ câu hỏi';
$string['questionsinthisquiz'] = 'Câu hỏi trong bài kiểm tra này';
$string['questionsmatchingfilter'] = 'Các câu hỏi phù hợp với bộ lọc này: {$a}';
$string['questionsperpageselected'] = 'Các câu hỏi trên mỗi trang đã được đặt nên việc phân trang hiện đã được cố định. Do đó, các điều khiển phân trang đã bị vô hiệu hóa. Bạn có thể thay đổi điều này trong {$a}.';
$string['questionsperpagex'] = 'Câu hỏi trên mỗi trang: {$a}';
$string['questiontextisempty'] = '[Văn bản câu hỏi trống]';
$string['quiz:emailconfirmsubmission'] = 'Nhận thông báo xác nhận khi gửi';
$string['quiz:emailnotifysubmission'] = 'Nhận tin nhắn thông báo khi bài kiểm tra được gửi';
$string['quiz:emailwarnoverdue'] = 'Nhận tin nhắn thông báo khi quá hạn và cần được gửi.';
$string['quiz:ignoretimelimits'] = 'Bỏ qua giới hạn thời gian của câu hỏi';
$string['quiz:manageoverrides'] = 'Quản lý ghi đè bài kiểm tra';
$string['quiz:regrade'] = 'Nâng cấp số lần thử nghiệm';
$string['quiz:reviewmyattempts'] = 'Xem lại những nỗ lực của chính bạn';
$string['quizcloseson'] = 'Bài thi sẽ kết thúc vào {$a}.';
$string['quizeventcloses'] = '{$a} đóng cửa';
$string['quizeventopens'] = '{$a} mở ra';
$string['quizisclosed'] = 'Bài kiểm tra này đã đóng';
$string['quizisclosedwillopen'] = 'Bài kiểm tra đã đóng (mở {$a})';
$string['quizisopen'] = 'Bài kiểm tra này đang mở';
$string['quizisopenwillclose'] = 'Câu đố đang mở (đóng {$a})';
$string['quiznavigation'] = 'Điều hướng bài kiểm tra';
$string['quizopenclose'] = 'Ngày mở và đóng cửa';
$string['quizopenclose_help'] = 'Học sinh chỉ có thể bắt đầu (các) nỗ lực của mình sau thời gian mở và họ phải hoàn thành các nỗ lực của mình trước thời gian đóng.';
$string['quizopened'] = 'Bài kiểm tra này đang mở.';
$string['quizopenedon'] = 'Bài thi được mở vào {$a}';
$string['quizopenwillclose'] = 'Bài kiểm tra này đang mở, sẽ kết thúc vào {$a} lúc';
$string['quizordernotrandom'] = 'Thứ tự của câu đố không bị xáo trộn';
$string['quizorderrandom'] = '* Thứ tự câu đố bị xáo trộn';
$string['quizwillopen'] = 'Bài kiểm tra này sẽ mở {$a}';
$string['randomfromunavailabletag'] = '{$a} (không khả dụng)';
$string['randomnosubcat'] = 'Câu hỏi chỉ từ danh mục này, không phải danh mục phụ của nó.';
$string['randomquestiontags'] = 'Thẻ';
$string['randomquestiontags_help'] = 'Bạn có thể hạn chế thêm tiêu chí lựa chọn bằng cách chỉ định một số thẻ câu hỏi tại đây. Các câu hỏi "ngẫu nhiên" sẽ được chọn từ các câu hỏi có tất cả các thẻ này.';
$string['randomwithsubcat'] = 'Các câu hỏi từ danh mục này và các danh mục phụ của nó.';
$string['redoesofthisquestion'] = 'Các câu hỏi khác đã được thử ở đây: {$a}';
$string['redoquestion'] = 'Hãy thử một câu hỏi khác như câu này';
$string['regradenotallowed'] = 'Bạn không có quyền đánh giá lại bài kiểm tra này';
$string['removeallgroupoverrides'] = 'Xóa tất cả ghi đè nhóm';
$string['removeallquizattempts'] = 'Xóa tất cả các lần làm bài kiểm tra';
$string['removealluseroverrides'] = 'Xóa tất cả ghi đè của người dùng';
$string['repaginatecommand'] = 'Đánh lại số trang';
$string['repaginatenow'] = 'Đánh lại số trang ngay bây giờ';
$string['reportattemptsfrom'] = 'Báo cáo lần thi từ';
$string['reportattemptsthatare'] = 'Báo cáo những lần thi';
$string['reportdisplayoptions'] = 'Lựa chọn hiển thị';
$string['reportmustselectstate'] = 'Bạn phải chọn ít nhất một trạng thái.';
$string['reportnotfound'] = 'Báo cáo không xác định ({$a})';
$string['reportshowonly'] = 'Chỉ hiện thị';
$string['reportshowonlyfinished'] = 'Hiển thị tối đa một lần kết thúc làm bài cho mỗi người dùng ({$a})';
$string['reportusersall'] = 'Tất cả người dùng đã làm bài kiểm tra';
$string['reportuserswith'] = 'Học viên đã làm bài kiểm tra';
$string['reportuserswithorwithout'] = 'Học viên đã làm hoặc chưa làm bài kiểm tra';
$string['reportuserswithout'] = 'Học viên chưa làm bài kiểm tra';
$string['reportwhattoinclude'] = 'Báo cáo bao gồm';
$string['requirepassword_help'] = 'Nếu mật khẩu được chỉ định, học sinh phải nhập mật khẩu đó để làm bài kiểm tra.';
$string['requiresubnet_help'] = 'Truy cập bài kiểm tra có thể bị hạn chế đối với các mạng con cụ thể trên mạng LAN hoặc Internet bằng cách chỉ định danh sách các số địa chỉ IP một phần hoặc toàn bộ được phân tách bằng dấu phẩy. Điều này có thể hữu ích đối với một bài kiểm tra (có giám sát) đầy sinh lực, để đảm bảo rằng chỉ những người ở một địa điểm nhất định mới có thể truy cập vào bài kiểm tra.';
$string['returnattempt'] = 'Quay trở lại';
$string['reuseifpossible'] = 'Sử dụng lại thứ trước đó đã bị xóa.';
$string['reverttodefaults'] = 'Hoàn nguyên về mặc định cho bài kiểm tra';
$string['reviewattempt'] = 'Đánh giá bài kiểm tra';
$string['reviewduring'] = 'Trong lúc làm bài thi';
$string['reviewofpreview'] = 'Đánh giá bản xem trước';
$string['reviewofquestion'] = 'Bài đánh giá về câu hỏi {$a->question} trong {$a->quiz} của {$a->user}';
$string['reviewoptionsheading'] = 'Xem lại tùy chọn';
$string['reviewoptionsheading_help'] = 'Các tùy chọn này kiểm soát thông tin mà học sinh có thể nhìn thấy khi họ xem lại bài kiểm tra hoặc xem báo cáo bài kiểm tra. ** Trong quá trình thử ** cài đặt chỉ phù hợp với một số hành vi, chẳng hạn như \'tương tác với nhiều lần thử\', có thể hiển thị phản hồi trong quá trình thử. ** Ngay sau khi thử ** cài đặt áp dụng trong hai phút đầu tiên sau khi nhấp vào \'Gửi tất cả và hoàn tất\'. ** Sau đó, trong khi bài kiểm tra vẫn đang mở ** các cài đặt áp dụng sau thời điểm này và trước ngày kết thúc bài kiểm tra. ** Sau khi bài kiểm tra kết thúc ** cài đặt áp dụng sau khi ngày đóng bài kiểm tra đã qua. Nếu bài kiểm tra không có ngày kết thúc, trạng thái này không bao giờ đạt được.';
$string['reviewoverallfeedback'] = 'Phản hồi chung';
$string['reviewoverallfeedback_help'] = 'Phản hồi được đưa ra vào cuối lần thử, tùy thuộc vào tổng điểm của học sinh.';
$string['reviewresponsetoq'] = 'Xem lại câu trả lời (câu hỏi {$a})';
$string['reviewthisattempt'] = 'Xem lại phản hồi của bạn cho nỗ lực này';
$string['sameasoverall'] = 'Tương tự như điểm số chung';
$string['saveattemptfailed'] = 'Không lưu được bài kiểm tra hiện tại.';
$string['saveoverrideandstay'] = 'Lưu và nhập ghi đè khác';
$string['saving'] = 'Tiết kiệm';
$string['savingnewgradeforquestion'] = 'Đang lưu điểm mới cho id câu hỏi {$a}.';
$string['savingnewmaximumgrade'] = 'Tiết kiệm điểm tối đa mới.';
$string['score'] = 'Số liệu';
$string['search:activity'] = 'Câu đố - thông tin hoạt động';
$string['sectionheadingedit'] = 'Chỉnh sửa tiêu đề \'{$a}\'';
$string['seequestions'] = '(Xem câu hỏi)';
$string['selectallquestion'] = 'Chọn tất cả';
$string['selectcategory'] = 'Chọn danh mục';
$string['selectmultipleitems'] = 'Lựa chọn nhiều mục';
$string['selectmultipletoolbar'] = 'Chọn nhiều thanh công cụ';
$string['selectquestiontype'] = '- Chọn loại câu hỏi -';
$string['settingsoverrides'] = 'Ghi đè cài đặt';
$string['showblocks'] = 'Hiển thị các khối trong khi làm bài kiểm tra';
$string['showblocks_help'] = 'Nếu được đặt thành có thì các khối bình thường sẽ được hiển thị trong các lần thử đố';
$string['showcategorycontents'] = 'Hiển thị nội dung danh mục {$a->arrow}';
$string['showeachpage'] = 'Hiển thị từng trang một';
$string['showinsecurepopup'] = 'Sử dụng cửa sổ bật lên \'an toàn\' để thử';
$string['showlargeimage'] = 'Hình ảnh lớn';
$string['shownoimage'] = 'Không hiển thị';
$string['showreport'] = 'Hiển thị báo cáo';
$string['showsmallimage'] = 'Hình ảnh nhỏ';
$string['showuserpicture'] = 'Hiển thị ảnh người dùng';
$string['showuserpicture_help'] = 'Nếu được bật, tên và ảnh của học sinh sẽ được hiển thị trên màn hình trong quá trình làm bài và trên màn hình đánh giá, giúp dễ dàng kiểm tra xem học sinh đó đã đăng nhập với tư cách là chính họ trong một kỳ thi (được giám sát) sẵn sàng hay chưa.';
$string['shuffledrandomly'] = 'Đã trộn ngẫu nhiên';
$string['shufflequestions_help'] = 'Nếu được bật, mỗi khi thử câu đố, thứ tự của các câu hỏi trong phần này sẽ được xáo trộn thành một thứ tự ngẫu nhiên khác. Điều này có thể khiến học sinh khó chia sẻ câu trả lời hơn nhưng cũng khiến học sinh khó thảo luận về một câu hỏi cụ thể với giáo viên hơn.';
$string['shufflewithin_help'] = 'Nếu được bật, các phần tạo nên mỗi câu hỏi sẽ được xáo trộn ngẫu nhiên mỗi khi học sinh làm bài kiểm tra, miễn là tùy chọn này cũng được bật trong cài đặt câu hỏi. Cài đặt này chỉ áp dụng cho các câu hỏi có nhiều phần, chẳng hạn như câu hỏi trắc nghiệm hoặc kết hợp.';
$string['sortquestionsbyx'] = 'Sắp xếp câu hỏi theo: {$a}';
$string['specificapathnotonquestion'] = 'Đường dẫn tệp được chỉ định không có trên câu hỏi được chỉ định';
$string['specificquestionnotonquiz'] = 'Câu hỏi đã chỉ định không có trong bài kiểm tra đã chỉ định';
$string['startattempt'] = 'Bắt đầu làm bài';
$string['startnewpreview'] = 'Bắt đầu bản xem trước mới';
$string['stateabandoned'] = 'Chưa bao giờ nộp';
$string['statefinished'] = 'Kết thúc';
$string['statefinisheddetails'] = 'Đã nộp {$a}';
$string['stateinprogress'] = 'Trong quá trính';
$string['statenotloaded'] = 'Trạng thái cho câu hỏi {$a} chưa được tải từ cơ sở dữ liệu';
$string['stateoverdue'] = 'Quá hạn';
$string['stateoverduedetails'] = 'Phải được gửi trước {$a}';
$string['status'] = 'Trạng thái';
$string['stoponerror'] = 'Dừng lại khi có lỗi';
$string['subplugintype_quiz'] = 'Báo cáo';
$string['subplugintype_quiz_plural'] = 'Báo cáo';
$string['subplugintype_quizaccess'] = 'Quy tắc truy cập';
$string['subplugintype_quizaccess_plural'] = 'Quy tắc truy cập';
$string['summaryofattempt'] = 'Tóm tắt những lần thử';
$string['summaryofattempts'] = 'Tóm tắt những lần thi trước của học viên';
$string['theattempt'] = 'Lần thử';
$string['theattempt_help'] = 'Liệu học sinh có thể xem lại lần thử.';
$string['timelimit_help'] = 'Nếu được bật, giới hạn thời gian được nêu trên trang câu đố ban đầu và đồng hồ đếm ngược được hiển thị trong khối điều hướng câu hỏi.';
$string['timestr'] = '% H:% M:% S trên% d /% m /% y';
$string['timing'] = 'Thời gian';
$string['tofile'] = 'Nộp';
$string['totalmarksx'] = 'Tổng điểm: {$a}';
$string['totalquestionsinrandomqcategory'] = 'Tổng số {$a} câu hỏi trong danh mục.';
$string['updateoverdueattemptstask'] = 'Cập nhật số lần thử nghiệm quá hạn';
$string['updatequizslotswithrandomxofy'] = 'Đang cập nhật các vị trí câu hỏi với dữ liệu câu hỏi "ngẫu nhiên" ({$a->done} / {$a->total})';
$string['updatingatttemptgrades'] = 'Đang cập nhật điểm cố gắng.';
$string['updatingfinalgrades'] = 'Đang cập nhật điểm cuối kỳ.';
$string['updatingthegradebook'] = 'Đang cập nhật sổ điểm.';
$string['upgradesure'] = '<div> Đặc biệt, mô-đun bài kiểm tra sẽ thực hiện một sự thay đổi lớn đối với các bảng bài kiểm tra và bản nâng cấp này vẫn chưa được kiểm tra đầy đủ. Bạn rất được khuyến khích sao lưu các bảng cơ sở dữ liệu của mình trước khi tiếp tục. </div>';
$string['upgradingquizattempts'] = 'Nâng cấp các lần thử bài kiểm tra: bài kiểm tra {$a->done} / {$a->outof} (Id bài kiểm tra {$a->info})';
$string['upgradingveryoldquizattempts'] = 'Nâng cấp các lần thử câu hỏi rất cũ: {$a->done} / {$a->outof}';
$string['useroverrides'] = 'Thi lại theo người dùng';
$string['useroverridesdeleted'] = 'Người dùng ghi đè đã bị xóa';
$string['usersnone'] = 'Không sinh viên nào có quyền truy cập vào bài kiểm tra này';
$string['viewed'] = 'Đã xem';
$string['wildcard'] = 'Thẻ mặc định';
$string['windowclosing'] = 'Cửa sổ này sẽ sớm đóng lại.';
