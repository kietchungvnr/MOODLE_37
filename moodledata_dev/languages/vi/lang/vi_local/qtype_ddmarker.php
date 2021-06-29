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
 * @package    qtype
 * @subpackage ddmarker
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addmoreitems'] = 'Khoảng trống để có thêm {no} điểm đánh dấu';
$string['alttext'] = 'Văn bản thay thế';
$string['answer'] = 'Câu trả lời';
$string['bgimage'] = 'Hình nền';
$string['clearwrongparts'] = 'Di chuyển các điểm đánh dấu được đặt không chính xác trở lại vị trí bắt đầu mặc định bên dưới hình ảnh';
$string['coords'] = 'Tọa độ';
$string['correctansweris'] = 'Câu trả lời đúng là: {$a}';
$string['draggableimage'] = 'Hình ảnh có thể kéo';
$string['draggableitem'] = 'Mục có thể kéo';
$string['draggableitemheader'] = 'Mục có thể kéo {$a}';
$string['draggableitemtype'] = 'Kiểu';
$string['draggableword'] = 'Văn bản có thể kéo';
$string['dropbackground'] = 'Hình nền để kéo điểm đánh dấu vào';
$string['dropzone'] = 'Khu vực thả {$a}';
$string['dropzoneheader'] = 'Khu vực thả';
$string['dropzones'] = 'Khu vực thả';
$string['dropzones_help'] = 'Các vùng thả có thể được xác định theo tọa độ hoặc kéo vào vị trí trong bản xem trước ở trên. Đầu tiên, việc chọn một hình dạng (hình tròn, hình chữ nhật hoặc đa giác) sẽ thêm hình dạng vùng thả mới vào phía trên bên trái của bản xem trước. Có thể hữu ích khi thu nhỏ phần Đánh dấu để bạn có thể xem bản xem trước trong khi chỉnh sửa Vùng thả. Chỉnh sửa hình dạng bắt đầu bằng cách nhấp vào hình dạng trong bản xem trước để hiển thị các chốt chỉnh sửa. Bạn có thể di chuyển hình dạng bằng tay cầm ở giữa hoặc điều chỉnh kích thước của hình dạng bằng tay cầm đỉnh. Chỉ đối với đa giác, giữ nút điều khiển (nút lệnh trên máy Mac) trong khi nhấp vào chốt điều khiển đỉnh sẽ thêm một đỉnh mới vào đa giác. Vui lòng giữ một hình đa giác càng đơn giản càng tốt, không có đường cắt ngang. Để biết thông tin, ba hình dạng sử dụng tọa độ theo cách này: * Hình tròn: centre_x, centre_y; bán kính <br /> ví dụ: <code> 80,100; 50 </code> * Hình chữ nhật: top_left_x, top_left_y; width, height <br /> ví dụ: <code> 20,60; 80,40 </code> * Polygon: x1, y1; x2, y2; ...; xn, yn <br /> ví dụ: <code> 20,60; 100,60; 20,100 </code> Chọn văn bản Marker sẽ thêm văn bản đó vào hình dạng trong bản xem trước.';
$string['followingarewrong'] = 'Các điểm đánh dấu sau đã được đặt sai vùng: {$a}.';
$string['followingarewrongandhighlighted'] = 'Các điểm đánh dấu sau được đặt không chính xác: {$a}. (Các) điểm đánh dấu hiện được hiển thị với (các) vị trí chính xác. <br /> Nhấp vào điểm đánh dấu để đánh dấu khu vực được phép.';
$string['formerror_nobgimage'] = 'Bạn cần chọn một hình ảnh để sử dụng làm nền cho vùng kéo và thả.';
$string['formerror_noitemselected'] = 'Bạn đã chỉ định một vùng thả nhưng không chọn một điểm đánh dấu phải được kéo đến vùng.';
$string['formerror_nosemicolons'] = 'Không có dấu chấm phẩy trong chuỗi tọa độ của bạn. Tọa độ của bạn cho {$a->shape} phải được biểu thị bằng - {$a->coordsstring}.';
$string['formerror_onlysometagsallowed'] = 'Chỉ cho phép các thẻ "{$a}" trong nhãn đối với một điểm đánh dấu.';
$string['formerror_onlyusewholepositivenumbers'] = 'Vui lòng chỉ sử dụng các số nguyên dương để chỉ định tọa độ x, y và / hoặc chiều rộng và chiều cao của hình dạng. Tọa độ của bạn cho {$a->shape} phải được biểu thị bằng - {$a->coordsstring}.';
$string['formerror_polygonmusthaveatleastthreepoints'] = 'Đối với một hình đa giác, bạn cần xác định ít nhất 3 điểm. Tọa độ của bạn cho {$a->shape} phải được biểu thị bằng - {$a->coordsstring}.';
$string['formerror_repeatedpoint'] = 'Bạn đã nhập cùng một tọa độ hai lần. Mỗi điểm phải là duy nhất. Tọa độ của bạn cho {$a->shape} phải được biểu thị bằng - {$a->coordsstring}.';
$string['formerror_shapeoutsideboundsofbgimage'] = 'Hình dạng bạn đã xác định nằm ngoài giới hạn của hình nền.';
$string['formerror_toomanysemicolons'] = 'Có quá nhiều phần được phân tách bằng dấu chấm phẩy đối với tọa độ bạn đã chỉ định. Tọa độ của bạn cho {$a->shape} phải được biểu thị bằng - {$a->coordsstring}.';
$string['formerror_unrecognisedwidthheightpart'] = 'Chiều rộng và chiều cao mà bạn đã chỉ định không thể nhận dạng được. Tọa độ của bạn cho {$a->shape} phải được biểu thị bằng - {$a->coordsstring}.';
$string['formerror_unrecognisedxypart'] = 'Các tọa độ x, y mà bạn đã chỉ định không thể nhận dạng được. Tọa độ của bạn cho {$a->shape} phải được biểu thị bằng - {$a->coordsstring}.';
$string['infinite'] = 'Vô hạn';
$string['marker'] = 'Đánh dấu';
$string['marker_n'] = 'Đánh dấu {no}';
$string['markers'] = 'Điểm đánh dấu';
$string['nolabel'] = 'Không có văn bản nhãn';
$string['noofdrags'] = 'Con số';
$string['pleasedragatleastonemarker'] = 'Câu trả lời của bạn không hoàn chỉnh; bạn phải đặt ít nhất một điểm đánh dấu trên hình ảnh.';
$string['pluginname'] = 'Kéo và thả điểm đánh dấu';
$string['pluginname_help'] = 'Các điểm đánh dấu kéo và thả yêu cầu người trả lời kéo các nhãn văn bản và thả chúng vào các vùng thả xác định trên hình nền.';
$string['pluginnameadding'] = 'Thêm điểm đánh dấu kéo và thả';
$string['pluginnameediting'] = 'Chỉnh sửa các điểm đánh dấu kéo và thả';
$string['pluginnamesummary'] = 'Các điểm đánh dấu được kéo và thả vào hình nền.';
$string['previewareaheader'] = 'Xem trước';
$string['previewareamessage'] = 'Chọn tệp hình nền, nhập nhãn văn bản cho các điểm đánh dấu và xác định các vùng thả trên hình nền mà chúng phải được kéo đến.';
$string['privacy:metadata'] = 'Plugin loại câu hỏi Kéo và thả điểm đánh dấu không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['refresh'] = 'Làm mới bản xem trước';
$string['shape'] = 'Hình dạng';
$string['shape_circle'] = 'Vòng tròn';
$string['shape_circle_coords'] = 'x, y; r (trong đó x, y là tọa độ của tâm đường tròn và r là bán kính)';
$string['shape_circle_lowercase'] = 'Vòng tròn';
$string['shape_polygon'] = 'Đa giác';
$string['shape_polygon_coords'] = 'x1, y1; x2, y2; x3, y3; x4, y4 ... (trong đó x1, y1 là tọa độ của đỉnh thứ nhất, x2, y2 là tọa độ của đỉnh thứ hai, v.v. Không cần lặp lại tọa độ cho đỉnh đầu tiên để đóng đa giác.)';
$string['shape_polygon_lowercase'] = 'Đa giác';
$string['shape_rectangle'] = 'Hình chữ nhật';
$string['shape_rectangle_coords'] = 'x, y; w, h (trong đó x, y là tọa độ của góc trên cùng bên trái của hình chữ nhật và w và h là chiều rộng và chiều cao của hình chữ nhật)';
$string['shape_rectangle_lowercase'] = 'Hình chữ nhật';
$string['showmisplaced'] = 'Đánh dấu các khu vực thả không có điểm đánh dấu chính xác được đánh dấu trên chúng';
$string['shuffleimages'] = 'Xáo trộn các mục kéo mỗi khi thử câu hỏi';
$string['stateincorrectlyplaced'] = 'Nêu rõ điểm đánh dấu nào được đặt không chính xác';
$string['summariseplace'] = '{$a->no}. {$a->text}';
$string['summariseplaceno'] = 'Khu vực thả {$a}';
$string['ytop'] = 'Hàng đầu';
