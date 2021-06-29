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
 * @subpackage analytics
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accuracy'] = 'Xác thực';
$string['allpredictions'] = 'Tất cả các dự đoán';
$string['alltimesplittingmethods'] = 'Tất cả các phương pháp phân chia thời gian';
$string['analysingsitedata'] = 'Phân tích trang web';
$string['analyticmodels'] = 'Mô hình phân tích';
$string['bettercli'] = 'Đánh giá mô hình và dự đoán tạo ra có thể liên quan đến xử lý nặng. Đó là gợi ý để chạy những hành động này từ dòng lệnh.';
$string['cantguessenddate'] = 'Không thể đoán ngày kết thúc';
$string['cantguessstartdate'] = 'Không thể đoán ngày bắt đầu';
$string['classdoesnotexist'] = 'Lớp {$a} không tồn tại';
$string['clearmodelpredictions'] = 'Bạn có chắc muốn xóa tất cả "{$a}" dự đoán?';
$string['clearpredictions'] = 'Dự đoán rõ ràng';
$string['clienablemodel'] = 'Bạn có thể bật mô hình bằng cách chọn một phương pháp phân chia thời gian bằng ID của nó. Lưu ý rằng bạn cũng có thể kích hoạt nó sau này sử dụng giao diện web ( \'không\' để thoát).';
$string['clievaluationandpredictions'] = 'Một nhiệm vụ theo lịch trình lặp thông qua mô hình kích hoạt và được dự đoán. Mô hình đánh giá thông qua giao diện web bị vô hiệu hóa. Bạn có thể cho phép các quá trình này được thực hiện bằng tay thông qua giao diện web bằng cách tắt <a href="{$a}"> \'onlycli\' </a> phân tích thiết.';
$string['clievaluationandpredictionsnoadmin'] = 'Một nhiệm vụ theo lịch trình lặp thông qua mô hình kích hoạt và được dự đoán. Mô hình đánh giá thông qua giao diện web bị vô hiệu hóa. Nó có thể được kích hoạt bởi một quản trị trang web.';
$string['component'] = 'Thành phần';
$string['componentcore'] = 'Lõi';
$string['componentselect'] = 'Chọn tất cả các mô hình được cung cấp bởi các thành phần \'{$a}\'';
$string['componentselectnone'] = 'Bỏ chọn tất cả';
$string['createmodel'] = 'Tạo mô hình';
$string['currenttimesplitting'] = 'Phương pháp phân chia thời gian theo dòng';
$string['delete'] = 'Xóa bỏ';
$string['deletemodelconfirmation'] = 'Bạn có chắc chắn muốn xóa "{$a}"? Những thay đổi này không thể được chuyển.';
$string['disabled'] = 'Tắt';
$string['editmodel'] = 'Chỉnh sửa "{$a}" mô hình';
$string['edittrainedwarning'] = 'Mô hình này đã được đào tạo. Lưu ý rằng việc thay đổi chỉ số của nó hoặc phương pháp phân chia thời gian nó sẽ xóa những dự đoán trước đây của nó và bắt đầu tạo ra những dự đoán mới.';
$string['enabled'] = 'Bật';
$string['errorcantenablenotimesplitting'] = 'Bạn cần phải chọn một phương pháp phân chia thời gian trước khi kích hoạt mô hình';
$string['errornoenabledandtrainedmodels'] = 'Không có mô hình được kích hoạt và đào tạo để dự đoán.';
$string['errornoenabledmodels'] = 'Không có mô hình nào được kích hoạt để đào tạo.';
$string['errornoexport'] = 'Chỉ các mô hình được đào tạo mới có thể được xuất';
$string['errornostaticevaluated'] = 'Mô hình dựa trên các giả định không thể được đánh giá. Chúng luôn đúng 100% theo cách chúng được xác định.';
$string['errornostaticlog'] = 'Không thể đánh giá mô hình dựa trên giả định vì không có nhật ký hoạt động.';
$string['erroronlycli'] = 'Chỉ cho phép thực thi qua dòng lệnh';
$string['errortrainingdataexport'] = 'Không thể xuất dữ liệu đào tạo mô hình';
$string['evaluate'] = 'Đánh giá';
$string['evaluatemodel'] = 'Đánh giá mô hình';
$string['evaluationinbatches'] = 'Nội dung trang web được tính toán và lưu trữ theo lô. Quá trình đánh giá có thể bị dừng bất cứ lúc nào. Lần chạy tiếp theo, nó sẽ tiếp tục từ điểm đã dừng.';
$string['evaluationmode'] = 'Tiêu chuẩn đánh giá';
$string['evaluationmode_help'] = 'Có hai chế độ đánh giá: * Mô hình được đào tạo - Dữ liệu trang web được sử dụng làm dữ liệu thử nghiệm để đánh giá độ chính xác của mô hình được đào tạo. * Cấu hình - Dữ liệu trang web được chia thành dữ liệu đào tạo và kiểm tra, để vừa đào tạo vừa kiểm tra độ chính xác của cấu hình mô hình. Mô hình được đào tạo chỉ khả dụng nếu một mô hình được đào tạo đã được nhập vào trang web và chưa được đào tạo lại bằng cách sử dụng dữ liệu trang web.';
$string['evaluationmodecolconfiguration'] = 'Cấu hình';
$string['evaluationmodecoltrainedmodel'] = 'Người mẫu được đào tạo';
$string['evaluationmodeconfiguration'] = 'Đánh giá cấu hình mô hình';
$string['evaluationmodeinfo'] = 'Mô hình này đã được nhập vào trang web. Bạn có thể đánh giá hiệu suất của mô hình hoặc bạn có thể đánh giá hiệu suất của cấu hình mô hình bằng cách sử dụng dữ liệu trang web.';
$string['evaluationmodetrainedmodel'] = 'Đánh giá mô hình được đào tạo';
$string['export'] = 'Xuất khẩu';
$string['exportincludeweights'] = 'Bao gồm trọng lượng của mô hình được đào tạo';
$string['exportmodel'] = 'Xuất cấu hình';
$string['exporttrainingdata'] = 'Xuất dữ liệu đào tạo';
$string['extrainfo'] = 'Thông tin';
$string['generalerror'] = 'Đánh giá lỗi. Mã trạng thái {$a}';
$string['getpredictions'] = 'Nhận dự đoán';
$string['getpredictionsresults'] = 'Kết quả sử dụng phương pháp chia tách thời gian {$a->name}';
$string['getpredictionsresultscli'] = 'Kết quả sử dụng phương pháp phân chia thời gian {$a->name} (id: {$a->id})';
$string['goodmodel'] = 'Đây là một mô hình tốt để sử dụng để thu được các dự đoán. Kích hoạt nó để bắt đầu nhận các dự đoán.';
$string['ignoreversionmismatches'] = 'Bỏ qua phiên bản không khớp';
$string['ignoreversionmismatchescheckbox'] = 'Bỏ qua sự khác biệt giữa phiên bản trang web này và phiên bản trang web gốc.';
$string['importedsuccessfully'] = 'Mô hình đã được nhập thành công.';
$string['importmodel'] = 'Nhập mô hình';
$string['indicators'] = 'Các chỉ số';
$string['indicators_help'] = 'Các chỉ số là những gì bạn nghĩ sẽ dẫn đến dự đoán chính xác về mục tiêu.';
$string['indicatorsnum'] = 'Chỉ số: {$a}';
$string['info'] = 'Thông tin';
$string['insights'] = 'Thông tin chi tiết';
$string['invalidanalysables'] = 'Các phần tử trang web không hợp lệ';
$string['invalidanalysablesinfo'] = 'Trang này liệt kê các yếu tố có thể phân tích mà mô hình dự đoán này không thể sử dụng. Không thể sử dụng các phần tử được liệt kê để đào tạo mô hình dự đoán cũng như không thể sử dụng mô hình dự đoán để có được dự đoán cho chúng.';
$string['invalidanalysablestable'] = 'Bảng phần tử có thể phân tích trang web không hợp lệ';
$string['invalidindicatorsremoved'] = 'Một mô hình mới đã được thêm vào. Các chỉ báo không hoạt động với mục tiêu đã chọn sẽ tự động bị loại bỏ.';
$string['invalidprediction'] = 'Không hợp lệ để nhận dự đoán';
$string['invalidtraining'] = 'Không hợp lệ để đào tạo mô hình';
$string['loginfo'] = 'Ghi thông tin bổ sung';
$string['missingmoodleversion'] = 'Tệp đã nhập không xác định số phiên bản';
$string['modelid'] = 'ID mô hình';
$string['modelinvalidanalysables'] = 'Các phần tử có thể phân tích không hợp lệ cho mô hình "{$a}"';
$string['modelname'] = 'Tên mẫu';
$string['modelresults'] = '{$a} kết quả';
$string['modeltimesplitting'] = 'Chia tách thời gian';
$string['newmodel'] = 'Mô hình mới';
$string['nextpage'] = 'Trang tiếp theo';
$string['nodatatoevaluate'] = 'Không có dữ liệu để đánh giá mô hình';
$string['nodatatopredict'] = 'Không có yếu tố mới nào để nhận dự đoán';
$string['nodatatotrain'] = 'Không có dữ liệu mới nào có thể được sử dụng để đào tạo';
$string['noinvalidanalysables'] = 'Trang web này không chứa bất kỳ phần tử có thể phân tích không hợp lệ nào.';
$string['notdefined'] = 'Chưa được xác định';
$string['pluginname'] = 'Mô hình phân tích';
$string['predictionprocessfinished'] = 'Quá trình dự đoán đã kết thúc';
$string['predictionresults'] = 'Dự đoán kết quả';
$string['predictmodels'] = 'Dự đoán mô hình';
$string['predictorresultsin'] = 'Người dự đoán đã ghi thông tin vào thư mục {$a}';
$string['previouspage'] = 'Trang trước';
$string['privacy:metadata'] = 'Plugin mô hình phân tích không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['restoredefault'] = 'Khôi phục các mô hình mặc định';
$string['restoredefaultempty'] = 'Vui lòng chọn mô hình để được khôi phục.';
$string['restoredefaultinfo'] = 'Các mô hình mặc định này bị thiếu hoặc đã thay đổi kể từ khi được cài đặt. Bạn có thể khôi phục các mô hình mặc định đã chọn.';
$string['restoredefaultnone'] = 'Tất cả các mô hình mặc định được cung cấp bởi lõi và các plugin được cài đặt đã được tạo. Không có mô hình mới được tìm thấy; không có gì để khôi phục.';
$string['restoredefaultsome'] = 'Đã tạo lại thành công {$a->count} (các) mô hình mới.';
$string['restoredefaultsubmit'] = 'Khôi phục đã chọn';
$string['sameenddate'] = 'Ngày kết thúc hiện tại là tốt';
$string['samestartdate'] = 'Ngày bắt đầu hiện tại là tốt';
$string['selecttimesplittingforevaluation'] = 'Chọn phương pháp phân chia thời gian bạn muốn sử dụng để đánh giá cấu hình mô hình.';
$string['target'] = 'Mục tiêu';
$string['target_help'] = 'Mục tiêu là những gì mô hình sẽ dự đoán.';
$string['timesplittingnotdefined'] = 'Sự phân chia thời gian không được xác định.';
$string['timesplittingnotdefined_help'] = 'Bạn cần chọn phương pháp phân chia thời gian trước khi bật mô hình.';
$string['trainandpredictmodel'] = 'Mô hình đào tạo và tính dự đoán';
$string['trainingprocessfinished'] = 'Quá trình đào tạo đã kết thúc';
$string['trainingresults'] = 'Kết quả đào tạo';
$string['trainmodels'] = 'Mô hình đào tạo';
$string['versionnotsame'] = 'Tệp đã nhập là từ một phiên bản khác ({$a->importversion}) với phiên bản hiện tại ({$a->version})';
$string['viewlog'] = 'Nhật ký đánh giá';
$string['weeksenddateautomaticallyset'] = 'Ngày kết thúc tự động được đặt dựa trên ngày bắt đầu và số phần';
$string['weeksenddatedefault'] = 'Ngày kết thúc tự động tính từ ngày bắt đầu khóa học.';
