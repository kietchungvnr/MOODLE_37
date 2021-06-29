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
 * @subpackage question
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminreport'] = 'Báo cáo về các vấn đề có thể xảy ra trong cơ sở dữ liệu câu hỏi của bạn.';
$string['cannotcreate'] = 'Không thể tạo mục nhập mới trong bảng question_attempts';
$string['cannotdeletetopcat'] = 'Các danh mục hàng đầu không thể bị xóa.';
$string['cannotedittopcat'] = 'Danh mục hàng đầu không thể được chỉnh sửa.';
$string['cannothidequestion'] = 'Không thể ẩn câu hỏi';
$string['cannotinsertquestion'] = 'Không thể chèn câu hỏi mới!';
$string['cannotunhidequestion'] = 'Không thể hiện câu hỏi.';
$string['changepublishstatuscat'] = '<a href="{$a->caturl} "> Danh mục" {$a->name} "</a> trong khóa" {$a->coursename} "sẽ thay đổi trạng thái chia sẻ từ <strong> { $a->changefrom} thành {$a->changeto} </strong>.';
$string['cwrqpfs'] = 'Câu hỏi ngẫu nhiên chọn câu hỏi từ các danh mục phụ.';
$string['cwrqpfsinfo'] = '<p> Trong quá trình nâng cấp lên Moodle 1.9, chúng tôi sẽ tách các danh mục câu hỏi thành các ngữ cảnh khác nhau. Một số danh mục câu hỏi và câu hỏi trên trang web của bạn sẽ phải thay đổi trạng thái chia sẻ của chúng. Điều này là cần thiết trong trường hợp hiếm hoi mà một hoặc nhiều câu hỏi \'ngẫu nhiên\' trong bài kiểm tra được thiết lập để chọn từ hỗn hợp các danh mục được chia sẻ và không được chia sẻ (như trường hợp trên trang web này). Điều này xảy ra khi một câu hỏi \'ngẫu nhiên\' được đặt để chọn từ các danh mục phụ và một hoặc nhiều danh mục phụ có trạng thái chia sẻ khác với danh mục chính mà câu hỏi ngẫu nhiên được tạo. </p> <p> Các danh mục câu hỏi sau, từ đó các câu hỏi \'ngẫu nhiên\' trong danh mục mẹ chọn câu hỏi từ đó, trạng thái chia sẻ của chúng sẽ được thay đổi thành trạng thái chia sẻ giống như danh mục có câu hỏi \'ngẫu nhiên\' khi nâng cấp lên Moodle 1.9. Các danh mục sau sẽ bị thay đổi trạng thái chia sẻ. Các câu hỏi bị ảnh hưởng sẽ tiếp tục hoạt động trong tất cả các câu hỏi hiện có cho đến khi bạn xóa chúng khỏi các câu hỏi này. </p>';
$string['cwrqpfsnoprob'] = 'Không có danh mục câu hỏi nào trong trang web của bạn bị ảnh hưởng bởi vấn đề \'Câu hỏi ngẫu nhiên chọn câu hỏi từ danh mục phụ\'.';
$string['deletecoursecategorywithquestions'] = 'Có các câu hỏi trong ngân hàng câu hỏi được liên kết với danh mục khóa học này. Nếu bạn tiếp tục, chúng sẽ bị xóa. Bạn có thể muốn di chuyển chúng trước, sử dụng giao diện ngân hàng câu hỏi.';
$string['erroraccessingcontext'] = 'Không thể truy cập ngữ cảnh';
$string['errorduringpost'] = 'Đã xảy ra lỗi trong quá trình xử lý hậu kỳ!';
$string['errorduringpre'] = 'Đã xảy ra lỗi trong quá trình xử lý trước!';
$string['errorduringproc'] = 'Đã xảy ra lỗi trong quá trình xử lý!';
$string['erroritemappearsmorethanoncewithdifferentweight'] = 'Câu hỏi ({$a}) xuất hiện nhiều lần với các trọng số khác nhau ở các vị trí khác nhau của bài kiểm tra. Điều này hiện không được hỗ trợ bởi báo cáo thống kê và có thể làm cho số liệu thống kê cho câu hỏi này không đáng tin cậy.';
$string['errorsavingcomment'] = 'Lỗi khi lưu nhận xét cho câu hỏi {$a->name} trong cơ sở dữ liệu.';
$string['errorupdatingattempt'] = 'Lỗi khi cập nhật {$a->id} trong cơ sở dữ liệu.';
$string['eventquestioncategorydeleted'] = 'Danh mục câu hỏi đã bị xóa';
$string['eventquestioncategorymoved'] = 'Danh mục câu hỏi đã được di chuyển';
$string['eventquestioncategoryupdated'] = 'Đã cập nhật danh mục câu hỏi';
$string['eventquestioncategoryviewed'] = 'Loại câu hỏi đã xem';
$string['eventquestioncreated'] = 'Câu hỏi đã tạo';
$string['eventquestiondeleted'] = 'Câu hỏi đã xóa';
$string['eventquestionmoved'] = 'Câu hỏi đã di chuyển';
$string['eventquestionsexported'] = 'Các câu hỏi đã xuất';
$string['eventquestionsimported'] = 'Các câu hỏi đã nhập';
$string['eventquestionupdated'] = 'Câu hỏi đã cập nhật';
$string['eventquestionviewed'] = 'Câu hỏi đã xem';
$string['exportonequestion'] = 'Tải xuống câu hỏi này ở định dạng Moodle XML';
$string['filterbytags'] = 'Lọc theo thẻ ...';
$string['idnumber'] = 'Số ID';
$string['idnumber_help'] = 'Nếu được sử dụng, số ID phải là duy nhất trong mỗi loại câu hỏi. Nó cung cấp một cách khác để xác định một câu hỏi đôi khi hữu ích, nhưng thường có thể để trống.';
$string['linkedfiledoesntexist'] = 'Tệp được liên kết {$a} không tồn tại';
$string['manualgradeinvalidformat'] = 'Đó không phải là một số hợp lệ.';
$string['missingoption'] = 'Câu hỏi cloze {$a} thiếu các tùy chọn';
$string['moveqtoanothercontext'] = 'Chuyển câu hỏi sang ngữ cảnh khác.';
$string['needtochoosecat'] = 'Bạn cần chọn một danh mục để chuyển câu hỏi này đến hoặc nhấn \'hủy\'.';
$string['noprobs'] = 'Không tìm thấy vấn đề nào trong cơ sở dữ liệu câu hỏi của bạn.';
$string['notagfiltersapplied'] = 'Không áp dụng bộ lọc';
$string['notenoughdatatomovequestions'] = 'Bạn cần cung cấp id của câu hỏi mà bạn muốn chuyển.';
$string['novirtualquestiontype'] = 'Không có loại câu hỏi ảo cho loại câu hỏi {$a}';
$string['penaltyforeachincorrecttry'] = 'Điểm trừ cho mỗi lần trả lời sai';
$string['privacy:metadata:database:question'] = 'Các chi tiết về một câu hỏi cụ thể.
 ';
$string['privacy:metadata:database:question:createdby'] = 'Người đã tạo câu hỏi.
 ';
$string['privacy:metadata:database:question:generalfeedback'] = 'Phản hồi chung cho câu hỏi này.';
$string['privacy:metadata:database:question:modifiedby'] = 'Người cập nhật câu hỏi lần gần nhất.';
$string['privacy:metadata:database:question:name'] = 'Tên câu hỏi
 ';
$string['privacy:metadata:database:question:questiontext'] = 'Văn bản câu hỏi.';
$string['privacy:metadata:database:question:timecreated'] = 'Ngày và giờ khi câu hỏi này được tạo.';
$string['privacy:metadata:database:question:timemodified'] = 'Ngày và giờ khi câu hỏi này được cập nhật.';
$string['privacy:metadata:database:question_attempt_step_data'] = 'Các bước thử câu hỏi có thể có thêm dữ liệu cụ thể cho bước đó. Dữ liệu được lưu trữ trong bảng step_data.';
$string['privacy:metadata:database:question_attempt_step_data:name'] = 'Tên của mục dữ liệu.
 ';
$string['privacy:metadata:database:question_attempt_step_data:value'] = 'Giá trị của mục dữ liệu.
 ';
$string['privacy:metadata:database:question_attempt_steps'] = 'Mỗi câu hỏi cố gắng có một số bước để chỉ ra các giai đoạn khác nhau từ đầu đến hoàn thành cho đến khi đánh dấu. Bảng này lưu trữ thông tin cho từng bước này.
 ';
$string['privacy:metadata:database:question_attempt_steps:fraction'] = 'Điểm được trao cho lần thử câu hỏi này được chia tỷ lệ thành giá trị trên 1.';
$string['privacy:metadata:database:question_attempt_steps:state'] = 'Trạng thái của câu hỏi này đang bước vào cuối quá trình chuyển đổi';
$string['privacy:metadata:database:question_attempt_steps:timecreated'] = 'Ngày và giờ bắt đầu chuyển đổi từ bước này.';
$string['privacy:metadata:database:question_attempt_steps:userid'] = 'Người dùng đã thực hiện bước chuyển đổi .';
$string['privacy:metadata:database:question_attempts'] = 'Thông tin để trả lời một câu hỏi cụ thể.
 ';
$string['privacy:metadata:database:question_attempts:flagged'] = 'Một dấu hiệu cho thấy người dùng đã gắn cờ câu hỏi này trong lần kiểm tra.';
$string['privacy:metadata:database:question_attempts:responsesummary'] = 'Một bản tóm tắt câu trả lời của câu hỏi.
 ';
$string['privacy:metadata:database:question_attempts:timemodified'] = 'Thời gian trả lời câu hỏi đã được cập nhật.';
$string['privacy:metadata:link:qbehaviour'] = 'Hệ thống con Câu hỏi sử dụng trình cắm thêm Hành vi Câu hỏi.';
$string['privacy:metadata:link:qformat'] = 'Hệ thống con Câu hỏi sử dụng plugintype Định dạng Câu hỏi cho mục đích nhập và xuất câu hỏi ở các định dạng khác nhau.';
$string['privacy:metadata:link:qtype'] = 'Hệ thống con Câu hỏi tương tác với plugintype Loại Câu hỏi chứa các loại câu hỏi khác nhau.';
$string['questionaffected'] = '<a href="{$a->qurl} "> Câu hỏi" {$a->name} "({$a->qtype}) </a> nằm trong danh mục câu hỏi này nhưng cũng đang được sử dụng trong <a href = "{$a->qurl}"> quiz "{$a->quizname}" </a> trong một khóa học khác "{$a->coursename}".';
$string['questionformtagheader'] = 'thẻ {$a}';
$string['questionsaveerror'] = 'Lỗi xảy ra khi lưu câu hỏi - ({$a})';
$string['questiontags'] = 'Thẻ câu hỏi';
$string['questionuse'] = 'Sử dụng câu hỏi trong hoạt động này';
$string['restoremultipletopcats'] = 'Tệp sao lưu chứa nhiều danh mục câu hỏi cấp cao nhất cho ngữ cảnh {$a}.';
$string['steps'] = 'Các bước';
$string['tagarea_question'] = 'Các câu hỏi';
$string['technicalinforesponsesummary'] = 'Tóm tắt câu trả lời: {$a}';
$string['technicalinfovariant'] = 'Biến thể câu hỏi: {$a}
 ';
$string['topfor'] = 'Hàng đầu cho {$a}';
$string['upgradeproblemcategoryloop'] = 'Đã phát hiện sự cố khi nâng cấp danh mục câu hỏi. Có một vòng lặp trong cây danh mục. Id danh mục bị ảnh hưởng là {$a}.';
$string['upgradeproblemcouldnotupdatecategory'] = 'Không thể cập nhật danh mục câu hỏi {$a->name} ({$a->id}).';
$string['upgradeproblemunknowncategory'] = 'Đã phát hiện sự cố khi nâng cấp danh mục câu hỏi. Danh mục {$a->id} đề cập đến {$a->parent}, không tồn tại. Cha mẹ đã thay đổi để khắc phục sự cố.';
$string['wrongprefix'] = 'Định dạng sai tiền tố tên {$a}';
