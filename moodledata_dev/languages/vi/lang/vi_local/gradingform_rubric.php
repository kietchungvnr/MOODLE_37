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
 * @package    gradingform
 * @subpackage rubric
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcriterion'] = 'Thêm tiêu chí';
$string['alwaysshowdefinition'] = 'Cho phép người dùng xem trước phiếu chấm điểm (nếu không nó sẽ chỉ được hiển thị sau khi chấm điểm)';
$string['backtoediting'] = 'Quay lại chỉnh sửa';
$string['confirmdeletecriterion'] = 'Bạn có chắc chắn muốn xóa tiêu chí này không?';
$string['confirmdeletelevel'] = 'Bạn có chắc chắn muốn xóa cấp độ này không?';
$string['criterion'] = 'Tiêu chí {$a}';
$string['criterionaddlevel'] = 'Thêm cấp độ';
$string['criteriondelete'] = 'Xóa tiêu chí';
$string['criterionduplicate'] = 'Tiêu chí trùng lặp';
$string['criterionempty'] = 'Nhấp để chỉnh sửa tiêu chí';
$string['criterionmovedown'] = 'Đi xuống';
$string['criterionmoveup'] = 'Đi lên';
$string['criterionremark'] = 'Ghi chú cho tiêu chí {$a->description}: {$a->comment}';
$string['definerubric'] = 'Xác định phiếu đánh giá';
$string['description'] = 'Mô tả';
$string['enableremarks'] = 'Cho phép người chấm điểm thêm nhận xét văn bản cho từng tiêu chí';
$string['err_mintwolevels'] = 'Mỗi tiêu chí phải có ít nhất hai mức';
$string['err_nocriteria'] = 'Phiếu tự đánh giá phải chứa ít nhất một tiêu chí';
$string['err_nodefinition'] = 'Định nghĩa mức không được để trống';
$string['err_nodescription'] = 'Mô tả tiêu chí không được để trống';
$string['err_novariations'] = 'Tất cả các cấp độ tiêu chí không thể có cùng số điểm';
$string['err_scoreformat'] = 'Số điểm cho mỗi cấp độ phải là một số hợp lệ';
$string['err_totalscore'] = 'Số điểm tối đa có thể có khi được chấm điểm bằng phiếu tự đánh giá phải lớn hơn 0';
$string['gradingof'] = 'Chấm điểm {$a}';
$string['level'] = 'Cấp {$a->definition}, {$a->score} điểm.';
$string['leveldefinition'] = 'Định nghĩa cấp độ {$a}';
$string['leveldelete'] = 'Xóa cấp độ {$a}';
$string['levelempty'] = 'Nhấp để chỉnh sửa cấp độ';
$string['levelsgroup'] = 'Nhóm cấp độ';
$string['lockzeropoints'] = 'Tính điểm dựa trên phiếu tự đánh giá có điểm tối thiểu là 0';
$string['lockzeropoints_help'] = 'Cài đặt này chỉ áp dụng nếu tổng số điểm tối thiểu cho mỗi tiêu chí lớn hơn 0. Nếu được chọn, điểm tối thiểu có thể đạt được cho phiếu tự đánh giá sẽ lớn hơn 0. Nếu không được chọn, điểm tối thiểu có thể có cho phiếu đánh giá sẽ được ánh xạ đến mức tối thiểu có sẵn cho hoạt động (là 0 trừ khi sử dụng thang điểm).';
$string['name'] = 'Tên';
$string['needregrademessage'] = 'Định nghĩa phiếu đánh giá đã được thay đổi sau khi học sinh này được xếp loại. Học sinh không thể xem phiếu đánh giá này cho đến khi bạn kiểm tra phiếu tự đánh giá và cập nhật điểm.';
$string['pluginname'] = 'Chấm điểm theo chuẩn Phiếu tự đánh giá';
$string['previewrubric'] = 'Xem trước phiếu đánh giá';
$string['privacy:metadata:criterionid'] = 'Định danh cho một tiêu chí cụ thể đang được xếp loại.';
$string['privacy:metadata:fillingssummary'] = 'Lưu trữ thông tin về điểm của người dùng được tạo bởi phiếu đánh giá.';
$string['privacy:metadata:instanceid'] = 'Một số nhận dạng liên quan đến điểm trong một hoạt động.';
$string['privacy:metadata:levelid'] = 'Mức thu được trong phiếu tự đánh giá.';
$string['privacy:metadata:remark'] = 'Các nhận xét liên quan đến tiêu chí chấm điểm được đánh giá.';
$string['regrademessage1'] = 'Bạn sắp lưu các thay đổi vào phiếu đánh giá đã được sử dụng để chấm điểm. Vui lòng cho biết nếu các điểm hiện có cần được xem xét lại. Nếu bạn đặt điều này thì điểm đánh giá sẽ bị ẩn khỏi sinh viên cho đến khi mục của họ được xếp hạng lại.';
$string['regrademessage5'] = 'Bạn sắp lưu các thay đổi quan trọng đối với phiếu đánh giá đã được sử dụng để chấm điểm. Giá trị sổ điểm sẽ không thay đổi, nhưng điểm đánh giá sẽ bị ẩn với học sinh cho đến khi mục của họ được xếp hạng lại.';
$string['regradeoption0'] = 'Không đánh dấu để xếp hạng';
$string['regradeoption1'] = 'Đánh dấu để xếp hạng';
$string['restoredfromdraft'] = 'LƯU Ý: Lần thử cuối cùng để chấm điểm cho người này không được lưu đúng cách nên điểm nháp đã được khôi phục. Nếu bạn muốn hủy những thay đổi này, hãy sử dụng nút "Hủy" bên dưới.';
$string['rubric'] = 'Phiếu tự đánh giá';
$string['rubricmapping'] = 'Cho điểm để phân loại các quy tắc lập bản đồ';
$string['rubricmappingexplained'] = 'Điểm tối thiểu có thể có cho phiếu đánh giá này là <b> {$a->minscore} điểm </b>. Nó sẽ được chuyển đổi thành điểm tối thiểu có sẵn cho hoạt động (là 0 trừ khi sử dụng thang điểm). Điểm tối đa của <b> {$a->maxscore} điểm </b> sẽ được chuyển đổi thành điểm tối đa. Điểm trung cấp sẽ được chuyển đổi tương ứng. Nếu thang điểm được sử dụng để chấm điểm, điểm số sẽ được làm tròn và chuyển đổi thành các yếu tố của thang điểm như thể chúng là các số nguyên liên tiếp. Có thể thay đổi cách tính điểm này bằng cách chỉnh sửa biểu mẫu và đánh dấu vào ô \'Tính điểm dựa trên phiếu tự đánh giá có điểm tối thiểu là 0\'.';
$string['rubricnotcompleted'] = 'Vui lòng chọn một cái gì đó cho mỗi tiêu chí';
$string['rubricoptions'] = 'Tùy chọn phiếu đánh giá';
$string['rubricstatus'] = 'Trạng thái chấm điểm hiện tại';
$string['save'] = 'Lưu';
$string['saverubric'] = 'Lưu phiếu đánh giá và chuẩn bị sẵn sàng';
$string['saverubricdraft'] = 'Lưu dưới dạng bản nháp';
$string['scoreinputforlevel'] = 'Điểm đầu vào cho cấp độ {$a}';
$string['scorepostfix'] = '{$a} điểm';
$string['showdescriptionstudent'] = 'Hiển thị mô tả phiếu đánh giá cho những người được xếp loại';
$string['showdescriptionteacher'] = 'Hiển thị mô tả phiếu đánh giá trong quá trình đánh giá';
$string['showremarksstudent'] = 'Hiển thị nhận xét cho những người được xếp loại';
$string['showscorestudent'] = 'Hiển thị điểm cho từng cấp độ cho những người được xếp loại';
$string['showscoreteacher'] = 'Hiển thị điểm cho mỗi cấp độ trong quá trình đánh giá';
$string['sortlevelsasc'] = 'Sắp xếp thứ tự cho các cấp:';
$string['sortlevelsasc0'] = 'Giảm dần theo số điểm';
$string['sortlevelsasc1'] = 'Tăng dần theo số điểm';
$string['zerolevelsabsent'] = 'Cảnh báo: Điểm tối thiểu có thể có cho phiếu đánh giá này không phải là 0; điều này có thể dẫn đến điểm không mong đợi cho hoạt động. Để tránh điều này, mỗi tiêu chí phải có một mức bằng 0 điểm. <br> Cảnh báo này có thể bị bỏ qua nếu thang điểm được sử dụng để chấm điểm và các mức tối thiểu trong phiếu tự đánh giá tương ứng với giá trị tối thiểu của thang điểm.';
