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
 * @subpackage numerical
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['acceptederror'] = 'Lỗi đã được chấp nhận';
$string['addmoreanswerblanks'] = 'Khoảng trống để có thêm {no} lựa chọn';
$string['addmoreunitblanks'] = 'Khoảng trống để có thêm {no} đơn vị';
$string['answercolon'] = 'Câu trả lời:';
$string['answererror'] = 'Lỗi';
$string['answermustbenumberorstar'] = 'Câu trả lời phải là một số, ví dụ -1.234 hoặc 3e8 hoặc \'*\'.';
$string['answerno'] = 'Trả lời {$a}';
$string['decfractionofquestiongrade'] = 'như một phần nhỏ (0-1) của điểm câu hỏi';
$string['decfractionofresponsegrade'] = 'như một phần nhỏ (0-1) của điểm phản hồi';
$string['decimalformat'] = 'số thập phân';
$string['editableunittext'] = 'yếu tố đầu vào văn bản';
$string['errornomultiplier'] = 'Bạn phải chỉ định một hệ số cho đơn vị này.';
$string['errorrepeatedunit'] = 'Bạn không thể có hai đơn vị có cùng tên.';
$string['geometric'] = 'Hình học';
$string['invalidnumber'] = 'Bạn phải nhập một số hợp lệ.';
$string['invalidnumbernounit'] = 'Bạn phải nhập một số hợp lệ. Không bao gồm một đơn vị trong phản hồi của bạn.';
$string['invalidnumericanswer'] = 'Một trong những câu trả lời bạn đã nhập không phải là một số hợp lệ.';
$string['invalidnumerictolerance'] = 'Một trong những dung sai bạn đã nhập không phải là số hợp lệ.';
$string['leftexample'] = 'ở bên trái, ví dụ: $1,00 hoặc £ 1,00';
$string['manynumerical'] = 'Các đơn vị là tùy chọn. Nếu một đơn vị được nhập, nó được sử dụng để chuyển đổi phản hồi sang Đơn vị 1 trước khi chấm điểm.';
$string['multiplier'] = 'Hệ số nhân';
$string['nominal'] = 'Trên danh nghĩa';
$string['noneditableunittext'] = 'KHÔNG CÓ văn bản có thể chỉnh sửa của Unit No1';
$string['nonvalidcharactersinnumber'] = 'KHÔNG có ký tự hợp lệ trong số';
$string['notenoughanswers'] = 'Bạn phải nhập ít nhất một câu trả lời.';
$string['nounitdisplay'] = 'Không chấm điểm đơn vị';
$string['numericalmultiplier'] = 'Hệ số nhân';
$string['numericalmultiplier_help'] = 'Hệ số nhân là hệ số mà phản hồi số đúng sẽ được nhân lên. Đơn vị đầu tiên (Đơn vị 1) có hệ số nhân mặc định là 1. Vì vậy, nếu phản hồi số đúng là 5500 và bạn đặt W làm đơn vị ở Đơn vị 1 có 1 làm hệ số mặc định, phản hồi đúng là 5500 W. Nếu bạn thêm đơn vị kW với hệ số 0,001, điều này sẽ thêm một phản ứng chính xác là 5,5 kW. Điều này có nghĩa là các câu trả lời 5500W hoặc 5,5kW sẽ được đánh dấu là đúng. Lưu ý rằng lỗi được chấp nhận cũng được nhân lên, vì vậy sai số cho phép là 100W sẽ trở thành sai số 0,1kW.';
$string['oneunitshown'] = 'Đơn vị 1 tự động hiển thị bên cạnh hộp trả lời.';
$string['onlynumerical'] = 'Các đơn vị hoàn toàn không được sử dụng. Chỉ giá trị số được điểm.';
$string['pleaseenterananswer'] = 'Vui lòng nhập câu trả lời.';
$string['pleaseenteranswerwithoutthousandssep'] = 'Vui lòng nhập câu trả lời của bạn mà không sử dụng dấu phân cách hàng nghìn ({$a}).';
$string['pluginname'] = 'Số';
$string['pluginname_help'] = 'Từ quan điểm của học viên, một câu hỏi số trông giống như một câu hỏi trả lời ngắn. Sự khác biệt là các câu trả lời số được phép có sai số được chấp nhận. Điều này cho phép một phạm vi câu trả lời cố định được đánh giá là một câu trả lời. Ví dụ: nếu câu trả lời là 10 với sai số được chấp nhận là 2, thì bất kỳ số nào từ 8 đến 12 sẽ được chấp nhận là đúng.';
$string['pluginnameadding'] = 'Thêm câu hỏi dạng số';
$string['pluginnameediting'] = 'Chỉnh sửa câu hỏi dạng số';
$string['pluginnamesummary'] = 'Cho phép phản hồi số, có thể với đơn vị, được phân loại bằng cách so sánh với các câu trả lời mô hình khác nhau, có thể với dung sai.';
$string['privacy:metadata'] = 'Plugin loại câu hỏi số không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['relative'] = 'Quan hệ';
$string['rightexample'] = 'ở bên phải, ví dụ: 1,00cm hoặc 1,00km';
$string['selectunit'] = 'Chọn một đơn vị';
$string['selectunits'] = 'Chọn đơn vị';
$string['studentunitanswer'] = 'Các đơn vị được nhập bằng cách sử dụng';
$string['tolerancetype'] = 'Loại dung sai';
$string['unit'] = 'Đơn vị';
$string['unitappliedpenalty'] = 'Những điểm này bao gồm hình phạt {$a} cho đơn vị xấu.';
$string['unitchoice'] = 'một lựa chọn nhiều lựa chọn';
$string['unitedit'] = 'Chỉnh sửa đơn vị';
$string['unitgraded'] = 'Đơn vị phải được đưa ra, và sẽ được tính điểm.';
$string['unithandling'] = 'Xử lý đơn vị';
$string['unitincorrect'] = 'Bạn đã không cung cấp đơn vị chính xác.';
$string['unitmandatory'] = 'Bắt buộc';
$string['unitmandatory_help'] = '* Câu trả lời sẽ được tính điểm bằng cách sử dụng đơn vị đã viết. * Hình phạt đơn vị sẽ được áp dụng nếu trường đơn vị trống';
$string['unitnotselected'] = 'Bạn phải chọn một đơn vị.';
$string['unitonerequired'] = 'Bạn phải nhập ít nhất một đơn vị';
$string['unitoptional'] = 'Đơn vị tùy chọn';
$string['unitoptional_help'] = '* Nếu trường đơn vị không trống, phản hồi sẽ được điểm bằng cách sử dụng đơn vị này. * Nếu đơn vị viết sai hoặc không rõ, phản hồi sẽ được coi là không hợp lệ.';
$string['unitpenalty'] = 'Hình phạt đơn vị';
$string['unitpenalty_help'] = 'Hình phạt được áp dụng nếu * nhập sai tên đơn vị vào đầu vào đơn vị hoặc * nhập đơn vị vào hộp nhập giá trị';
$string['unitposition'] = 'Đơn vị đi';
$string['units'] = 'Các đơn vị';
$string['unitselect'] = 'menu thả xuống';
$string['unitx'] = 'Đơn vị {no}';
$string['validnumberformats'] = 'Các định dạng số hợp lệ';
$string['validnumberformats_help'] = '* các số thông thường 13500,67, 13 500,67, 13500,67 hoặc 13 500,67 * nếu cài đặt gói ngôn ngữ của bạn (tệp langconfig.php) sử dụng dấu phẩy (,) làm dấu phân tách nghìn * luôn * đặt dấu thập phân (.) như trong 13.500,67 : 13.500. * đối với dạng số mũ, giả sử 1.350067 * 10 <sup> 4 </sup>, sử dụng 1.350067 E4: 1.350067 E04';
$string['validnumbers'] = '13500,67, 13 500,67, 13,500,67, 13500,67, 13 500,67, 1.350067 E4 hoặc 1.350067 E04';
$string['xmustbenumeric'] = '{$a} phải là một số.';
$string['xmustnotbenumeric'] = '{$a} không thể là một số.';
$string['youmustenteramultiplierhere'] = 'Bạn phải nhập một hệ số nhân ở đây.';
