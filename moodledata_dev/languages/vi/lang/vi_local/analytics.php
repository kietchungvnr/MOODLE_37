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
 * @subpackage analytics
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['analysablenotused'] = 'Có thể phân tích {$a->analysableid} không được sử dụng: {$a->errors}';
$string['analysablenotvalidfortarget'] = 'Có thể phân tích {$a->analysableid} không hợp lệ cho mục tiêu này: {$a->result}';
$string['analysisinprogress'] = 'Vẫn đang được phân tích bởi một lần thực hiện trước đó';
$string['analytics'] = 'Phân tích';
$string['analyticslogstore'] = 'Lưu trữ nhật ký được sử dụng để phân tích';
$string['analyticslogstore_help'] = 'Kho lưu trữ nhật ký sẽ được API phân tích sử dụng để đọc hoạt động của người dùng.';
$string['analyticssettings'] = 'Cài đặt phân tích';
$string['analyticssiteinfo'] = 'Thông tin trang web';
$string['defaultpredictionsprocessor'] = 'Bộ xử lý dự đoán mặc định';
$string['defaultpredictoroption'] = 'Bộ xử lý mặc định ({$a})';
$string['defaulttimesplittingmethods'] = 'Các phương pháp phân chia thời gian mặc định để đánh giá mô hình';
$string['defaulttimesplittingmethods_help'] = 'Phương pháp chia nhỏ thời gian chia thời lượng khóa học thành các phần; công cụ dự đoán sẽ chạy ở cuối các phần này. Quá trình đánh giá mô hình sẽ lặp lại thông qua các phương pháp phân chia thời gian này trừ khi một phương pháp phân chia thời gian cụ thể được chỉ định. (Khả năng chỉ định phương pháp phân chia thời gian chỉ khả dụng khi đánh giá các mô hình bằng cách sử dụng tập lệnh dòng lệnh.)';
$string['disabledmodel'] = 'Mô hình bị vô hiệu hóa';
$string['erroralreadypredict'] = 'Tệp {$a} đã được sử dụng để tạo dự đoán.';
$string['errorcannotreaddataset'] = 'Không thể đọc tệp tập dữ liệu {$a}.';
$string['errorcannotwritedataset'] = 'Không thể ghi tệp tập dữ liệu {$a}.';
$string['errorexportmodelresult'] = 'Không thể xuất mô hình học máy.';
$string['errorimport'] = 'Lỗi khi nhập tệp JSON được cung cấp.';
$string['errorimportmissingclasses'] = 'Các thành phần phân tích sau không có sẵn trên trang web này: {$a->missingclasses}.';
$string['errorimportmissingcomponents'] = 'Mô hình được cung cấp yêu cầu cài đặt các plugin sau: {$a}. Lưu ý rằng các phiên bản không nhất thiết phải khớp với các phiên bản được cài đặt trên trang web của bạn. Cài đặt cùng một phiên bản plugin hoặc phiên bản mới hơn sẽ ổn trong hầu hết các trường hợp.';
$string['errorimportversionmismatches'] = 'Phiên bản của các thành phần sau khác với phiên bản được cài đặt trên trang web này: {$a}. Bạn có thể sử dụng tùy chọn \'Bỏ qua phiên bản không khớp\' để bỏ qua những khác biệt này.';
$string['errorinvalidindicator'] = 'Chỉ báo {$a} không hợp lệ';
$string['errorinvalidtarget'] = 'Mục tiêu {$a} không hợp lệ';
$string['errorinvalidtimesplitting'] = 'Phân chia thời gian không hợp lệ; hãy đảm bảo rằng bạn thêm tên lớp đủ điều kiện.';
$string['errornoexportconfig'] = 'Đã xảy ra sự cố khi xuất cấu hình mô hình.';
$string['errornoexportconfigrequirements'] = 'Chỉ có thể xuất các mô hình không tĩnh có phương pháp chia tách thời gian.';
$string['errornoindicators'] = 'Mô hình này không có bất kỳ chỉ số nào.';
$string['errornopredictresults'] = 'Không có kết quả trả về từ bộ xử lý dự đoán. Kiểm tra nội dung thư mục đầu ra để biết thêm thông tin.';
$string['errornoroles'] = 'Vai trò của học sinh hoặc giáo viên chưa được xác định. Xác định chúng trong trang cài đặt phân tích.';
$string['errornotarget'] = 'Mô hình này không có bất kỳ mục tiêu nào.';
$string['errornotimesplittings'] = 'Mô hình này không có bất kỳ phương pháp chia tách thời gian nào.';
$string['errorpredictioncontextnotavailable'] = 'Ngữ cảnh dự đoán này không còn nữa.';
$string['errorpredictionformat'] = 'Định dạng tính toán dự đoán sai';
$string['errorpredictionnotfound'] = 'Dự đoán không được tìm thấy';
$string['errorpredictionsprocessor'] = 'Lỗi bộ xử lý dự đoán: {$a}';
$string['errorpredictwrongformat'] = 'Không thể giải mã trả về của bộ xử lý dự đoán: "{$a}"';
$string['errorprocessornotready'] = 'Bộ xử lý dự đoán đã chọn chưa sẵn sàng: {$a}';
$string['errorsamplenotavailable'] = 'Mẫu dự đoán không còn nữa.';
$string['errorunexistingmodel'] = 'Mô hình không tồn tại {$a}';
$string['errorunexistingtimesplitting'] = 'Phương pháp phân chia thời gian đã chọn không khả dụng.';
$string['errorunknownaction'] = 'Hành động không xác định';
$string['eventinsightsviewed'] = 'Đã xem thông tin chi tiết';
$string['eventpredictionactionstarted'] = 'Quá trình dự đoán bắt đầu';
$string['fixedack'] = 'Được công nhận';
$string['insightinfomessage'] = 'Hệ thống đã tạo thông tin chi tiết cho bạn: {$a}';
$string['insightinfomessageaction'] = '{$a->text}: {$a->url}';
$string['insightinfomessagehtml'] = 'Hệ thống đã tạo ra một cái nhìn sâu sắc cho bạn';
$string['insightmessagesubject'] = 'Thông tin chi tiết mới cho "{$a}"';
$string['invalidanalysablefortimesplitting'] = 'Không thể phân tích nó bằng phương pháp chia tách thời gian {$a}.';
$string['invalidtimesplitting'] = 'Mô hình có ID {$a} cần một phương pháp phân tách thời gian trước khi có thể được sử dụng để đào tạo.';
$string['levelinstitution'] = 'Cấp độ giáo dục';
$string['levelinstitutionisced0'] = 'Giáo dục mầm non (‘dưới tiểu học’ cho trình độ học vấn)';
$string['levelinstitutionisced1'] = 'Giáo dục tiểu học';
$string['levelinstitutionisced2'] = 'Giáo dục trung học cơ sở';
$string['levelinstitutionisced3'] = 'Giáo dục phổ thông';
$string['levelinstitutionisced4'] = 'Giáo dục sau trung học không đại học (có thể bao gồm đào tạo công ty hoặc cộng đồng / tổ chức phi chính phủ)';
$string['levelinstitutionisced5'] = 'Giáo dục đại học chu kỳ ngắn hạn (có thể bao gồm đào tạo công ty hoặc cộng đồng / tổ chức phi chính phủ)';
$string['levelinstitutionisced6'] = 'Trình độ cử nhân hoặc tương đương';
$string['levelinstitutionisced7'] = 'Thạc sĩ hoặc trình độ tương đương';
$string['levelinstitutionisced8'] = 'Tiến sĩ hoặc tương đương';
$string['modeinstruction'] = 'Các phương thức hướng dẫn';
$string['modeinstructionblendedhybrid'] = 'Trộn lẫn hoặc hỗn hợp';
$string['modeinstructionfacetoface'] = 'Mặt đối mặt';
$string['modeinstructionfullyonline'] = 'Hoàn toàn trực tuyến';
$string['modeloutputdir'] = 'Thư mục đầu ra của mô hình';
$string['modeloutputdirinfo'] = 'Thư mục nơi bộ xử lý dự đoán lưu trữ tất cả thông tin đánh giá. Hữu ích cho việc gỡ lỗi và nghiên cứu.';
$string['modeltimelimit'] = 'Giới hạn thời gian phân tích cho mỗi mô hình';
$string['modeltimelimitinfo'] = 'Cài đặt này giới hạn thời gian mỗi mô hình dành để phân tích nội dung trang web.';
$string['nocourses'] = 'Không có khóa học để phân tích';
$string['nodata'] = 'Không có dữ liệu để phân tích';
$string['noevaluationbasedassumptions'] = 'Mô hình dựa trên các giả định không thể được đánh giá.';
$string['noinsights'] = 'Không có thông tin chi tiết nào được báo cáo';
$string['noinsightsmodel'] = 'Mô hình này không tạo ra thông tin chi tiết';
$string['nonewdata'] = 'Không có dữ liệu mới';
$string['nonewranges'] = 'Chưa có dự đoán mới';
$string['nonewtimeranges'] = 'Không có phạm vi thời gian mới; không có gì để dự đoán.';
$string['nopredictionsyet'] = 'Chưa có dự đoán nào';
$string['noranges'] = 'Chưa có dự đoán nào';
$string['notrainingbasedassumptions'] = 'Mô hình dựa trên các giả định không cần đào tạo';
$string['notuseful'] = 'Không hữu ích';
$string['novaliddata'] = 'Không có sẵn dữ liệu hợp lệ';
$string['novalidsamples'] = 'Không có sẵn mẫu hợp lệ';
$string['onlycli'] = 'Phân tích chỉ xử lý việc thực thi thông qua dòng lệnh';
$string['onlycliinfo'] = 'Các quy trình phân tích như đánh giá mô hình, đào tạo thuật toán máy học hoặc nhận dự đoán có thể mất một khoảng thời gian. Chúng chạy dưới dạng tác vụ cron hoặc có thể bị buộc thông qua dòng lệnh. Nếu bị vô hiệu hóa, các quy trình phân tích có thể được chạy theo cách thủ công thông qua giao diện web.';
$string['percentonline'] = 'Phần trăm trực tuyến';
$string['percentonline_help'] = 'Nếu tổ chức của bạn cung cấp các khóa học kết hợp hoặc khóa học kết hợp, thì tỷ lệ phần trăm bài tập của sinh viên được thực hiện trực tuyến trong Moodle? Nhập một số từ 0 đến 100.';
$string['predictionsprocessor'] = 'Bộ xử lý dự đoán';
$string['predictionsprocessor_help'] = 'Bộ xử lý dự đoán là chương trình phụ trợ học máy xử lý các tập dữ liệu được tạo bằng cách tính toán các chỉ số và mục tiêu của mô hình. Mỗi kiểu máy có thể sử dụng một bộ xử lý khác nhau. Giá trị được chỉ định ở đây sẽ là mặc định.';
$string['privacy:metadata:analytics:indicatorcalc'] = 'Tính toán chỉ số';
$string['privacy:metadata:analytics:indicatorcalc:contextid'] = 'Bối cảnh';
$string['privacy:metadata:analytics:indicatorcalc:endtime'] = 'Thời gian kết thúc tính toán';
$string['privacy:metadata:analytics:indicatorcalc:indicator'] = 'Lớp tính chỉ số';
$string['privacy:metadata:analytics:indicatorcalc:sampleid'] = 'ID mẫu';
$string['privacy:metadata:analytics:indicatorcalc:sampleorigin'] = 'Bảng nguồn gốc của mẫu';
$string['privacy:metadata:analytics:indicatorcalc:starttime'] = 'Thời gian bắt đầu tính toán';
$string['privacy:metadata:analytics:indicatorcalc:timecreated'] = 'Khi dự đoán được đưa ra';
$string['privacy:metadata:analytics:indicatorcalc:value'] = 'Giá trị tính toán';
$string['privacy:metadata:analytics:predictionactions'] = 'Hành động dự đoán';
$string['privacy:metadata:analytics:predictionactions:actionname'] = 'Tên hành động';
$string['privacy:metadata:analytics:predictionactions:predictionid'] = 'ID dự đoán';
$string['privacy:metadata:analytics:predictionactions:timecreated'] = 'Khi hành động dự đoán được thực hiện';
$string['privacy:metadata:analytics:predictionactions:userid'] = 'Người dùng đã làm cho hành động';
$string['privacy:metadata:analytics:predictions'] = 'Phỏng đoán';
$string['privacy:metadata:analytics:predictions:calculations'] = 'Tính chỉ số';
$string['privacy:metadata:analytics:predictions:contextid'] = 'Bối cảnh';
$string['privacy:metadata:analytics:predictions:modelid'] = 'Mô hình ID';
$string['privacy:metadata:analytics:predictions:prediction'] = 'Dự đoán';
$string['privacy:metadata:analytics:predictions:predictionscore'] = 'Điểm số dự đoán';
$string['privacy:metadata:analytics:predictions:rangeindex'] = 'Chỉ số của phương pháp phân chia thời gian';
$string['privacy:metadata:analytics:predictions:sampleid'] = 'ID mẫu';
$string['privacy:metadata:analytics:predictions:timecreated'] = 'Khi dự đoán được đưa ra';
$string['privacy:metadata:analytics:predictions:timeend'] = 'Tính kết thúc thời gian';
$string['privacy:metadata:analytics:predictions:timestart'] = 'Tính thời gian bắt đầu';
$string['processingsitecontents'] = 'Xử lý nội dung trang web';
$string['successfullyanalysed'] = 'Phân tích thành công';
$string['timesplittingmethod'] = 'Phương thức phân chia thời gian';
$string['timesplittingmethod_help'] = 'Phương pháp phân chia thời gian xác định khi hệ thống sẽ tính dự đoán và một phần của bản ghi hoạt động đó sẽ được xem xét đối với những dự đoán. Ví dụ, thời gian khóa học có thể được chia thành nhiều phần, với một dự đoán được tạo ra ở phần cuối của mỗi phần.';
$string['typeinstitution'] = 'Loại hình tổ chức';
$string['typeinstitutionacademic'] = 'Thuộc về lý thuyết';
$string['typeinstitutionngo'] = 'Tổ chức phi chính phủ (NGO)';
$string['typeinstitutiontraining'] = 'Đào tạo của công ty';
$string['viewdetails'] = 'Xem chi tiết';
$string['viewinsight'] = 'Xem thông tin chi tiết';
$string['viewinsightdetails'] = 'Xem thông tin chi tiết';
$string['viewprediction'] = 'Xem chi tiết dự đoán';
