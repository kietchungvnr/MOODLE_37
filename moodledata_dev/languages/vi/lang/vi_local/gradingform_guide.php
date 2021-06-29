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
 * @subpackage guide
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcomment'] = 'Thêm bình luận thường dùng';
$string['addcriterion'] = 'Thêm tiêu chí';
$string['alwaysshowdefinition'] = 'Hiển thị định nghĩa hướng dẫn cho học viên';
$string['backtoediting'] = 'Quay lại chỉnh sửa';
$string['clicktocopy'] = 'Nhấp để sao chép văn bản này vào phản hồi tiêu chí';
$string['clicktoedit'] = 'Bấm vào để chỉnh sửa';
$string['clicktoeditname'] = 'Nhấp để chỉnh sửa tên tiêu chí';
$string['comment'] = 'Bình luận';
$string['comments'] = 'Nhận xét thường dùng';
$string['commentsdelete'] = 'Xóa nhận xét';
$string['commentsempty'] = 'Bấm để chỉnh sửa bình luận';
$string['commentsmovedown'] = 'Đi xuống';
$string['commentsmoveup'] = 'Đi lên';
$string['confirmdeletecriterion'] = 'Bạn có chắc bạn muốn xóa mục này?';
$string['confirmdeletelevel'] = 'Bạn có chắc chắn muốn xóa cấp độ này không?';
$string['criterion'] = 'Tên tiêu chí';
$string['criteriondelete'] = 'Xóa tiêu chí';
$string['criterionempty'] = 'Nhấp để chỉnh sửa tiêu chí';
$string['criterionmovedown'] = 'Đi xuống';
$string['criterionmoveup'] = 'Đi lên';
$string['criterionname'] = 'Tên tiêu chí';
$string['criterionremark'] = 'Nhận xét về tiêu chí {$a}';
$string['definemarkingguide'] = 'Xác định hướng dẫn đánh dấu';
$string['description'] = 'Mô tả';
$string['descriptionmarkers'] = 'Mô tả cho Điểm đánh dấu';
$string['descriptionstudents'] = 'Mô tả cho học viên';
$string['err_maxscoreisnegative'] = 'Điểm tối đa không hợp lệ, giá trị âm không được phép';
$string['err_maxscorenotnumeric'] = 'Điểm tối đa của tiêu chí phải là số';
$string['err_nocomment'] = 'Nhận xét không được để trống';
$string['err_nodescription'] = 'Không được để trống mô tả học viên';
$string['err_nodescriptionmarkers'] = 'Mô tả điểm đánh dấu không được để trống';
$string['err_nomaxscore'] = 'Điểm tối đa của tiêu chí không được để trống';
$string['err_noshortname'] = 'Tên tiêu chí không được để trống';
$string['err_scoreinvalid'] = 'Điểm cho \'{$a->criterianame}\' không hợp lệ, điểm tối đa là: {$a->maxscore}';
$string['err_scoreisnegative'] = 'Điểm cho \'{$a->criterianame}\' không hợp lệ, không cho phép các giá trị âm';
$string['err_shortnametoolong'] = 'Tên tiêu chí phải ít hơn 256 ký tự';
$string['gradingof'] = 'Chấm điểm {$a}';
$string['guide'] = 'Hướng dẫn chấm điểm';
$string['guidemappingexplained'] = 'CẢNH BÁO: Hướng dẫn chấm điểm của bạn có điểm tối đa là <b> {$a->maxscore} điểm </b> nhưng điểm tối đa được đặt trong hoạt động của bạn là {$a->modulegrade} Điểm số tối đa được đặt trong hướng dẫn chấm điểm của bạn sẽ được chia tỷ lệ thành điểm tối đa trong học phần. <br /> Điểm trung cấp sẽ được chuyển đổi tương ứng và làm tròn thành điểm khả dụng gần nhất.';
$string['guidenotcompleted'] = 'Vui lòng cung cấp điểm hợp lệ cho mỗi tiêu chí';
$string['guideoptions'] = 'Đánh dấu các tùy chọn hướng dẫn';
$string['guidestatus'] = 'Trạng thái hướng dẫn đánh dấu hiện tại';
$string['hidemarkerdesc'] = 'Ẩn mô tả tiêu chí điểm đánh dấu';
$string['hidestudentdesc'] = 'Ẩn mô tả tiêu chí của học viên';
$string['insertcomment'] = 'Chèn bình luận thường dùng';
$string['maxscore'] = 'Điểm tối đa';
$string['name'] = 'Tên';
$string['needregrademessage'] = 'Định nghĩa hướng dẫn chấm điểm đã được thay đổi sau khi học viên này được xếp loại. Học viên không thể xem hướng dẫn chấm điểm này cho đến khi bạn kiểm tra hướng dẫn chấm điểm và cập nhật điểm.';
$string['pluginname'] = 'Chấm điểm dựa trên các yêu cầu';
$string['previewmarkingguide'] = 'Xem trước hướng dẫn đánh dấu';
$string['privacy:metadata:criterionid'] = 'Một định danh cho một tiêu chí để đánh dấu nâng cao.';
$string['privacy:metadata:fillingssummary'] = 'Lưu trữ thông tin về điểm của người dùng và phản hồi cho hướng dẫn chấm điểm.';
$string['privacy:metadata:instanceid'] = 'Một mã định danh cho điểm được sử dụng bởi một hoạt động.';
$string['privacy:metadata:preference:showmarkerdesc'] = 'Có hiển thị mô tả tiêu chí điểm đánh dấu hay không';
$string['privacy:metadata:preference:showstudentdesc'] = 'Có hiển thị mô tả tiêu chí của học viên hay không';
$string['privacy:metadata:remark'] = 'Các nhận xét liên quan đến tiêu chí hạng này.';
$string['privacy:metadata:score'] = 'Điểm cho tiêu chí loại này.';
$string['regrademessage1'] = 'Bạn sắp lưu các thay đổi đối với hướng dẫn chấm điểm đã được sử dụng để chấm điểm. Vui lòng cho biết nếu các điểm hiện có cần được xem xét lại. Nếu bạn đặt điều này thì hướng dẫn đánh dấu sẽ bị ẩn với học viên cho đến khi mục của họ được xếp hạng lại.';
$string['regrademessage5'] = 'Bạn sắp lưu các thay đổi quan trọng đối với hướng dẫn chấm điểm đã được sử dụng để chấm điểm. Giá trị của sổ điểm sẽ không thay đổi, nhưng hướng dẫn chấm điểm sẽ bị ẩn với học viên cho đến khi mục của họ được xếp hạng lại.';
$string['regradeoption0'] = 'Không đánh dấu để xếp hạng';
$string['regradeoption1'] = 'Đánh dấu để xếp hạng';
$string['restoredfromdraft'] = 'LƯU Ý: Lần thử cuối cùng để chấm điểm cho người này không được lưu đúng cách nên điểm nháp đã được khôi phục. Nếu bạn muốn hủy những thay đổi này, hãy sử dụng nút "Hủy" bên dưới.';
$string['save'] = 'Lưu';
$string['saveguide'] = 'Lưu hướng dẫn đánh dấu và chuẩn bị sẵn sàng';
$string['saveguidedraft'] = 'Lưu dưới dạng bản nháp';
$string['score'] = 'Điểm';
$string['showmarkerdesc'] = 'Hiển thị mô tả tiêu chí điểm đánh dấu';
$string['showmarkspercriterionstudents'] = 'Hiển thị điểm theo tiêu chí cho học viên';
$string['showstudentdesc'] = 'Hiển thị mô tả tiêu chí của học viên';
