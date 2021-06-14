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
 * @subpackage calculated
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['additem'] = 'Thêm mục';
$string['addmoreanswerblanks'] = 'Thêm một câu trả lời khác vào chỗ trống.';
$string['addsets'] = 'Thêm (các) bộ';
$string['answerdisplay'] = 'Hiển thị trả lời';
$string['answerformula'] = 'Công thức câu trả lời {$a}';
$string['answerhdr'] = 'Câu trả lời';
$string['answerstoleranceparam'] = 'Trả lời các thông số dung sai';
$string['answerwithtolerance'] = '{$a->answer} (± {$a->tolerance} {$a->tolerancetype})';
$string['anyvalue'] = 'Mọi giá trị';
$string['atleastoneanswer'] = 'Bạn cần cung cấp ít nhất một câu trả lời.';
$string['atleastonerealdataset'] = 'Phải có ít nhất một tập dữ liệu thực trong văn bản câu hỏi';
$string['atleastonewildcard'] = 'Phải có ít nhất một thẻ đại diện trong công thức trả lời hoặc văn bản câu hỏi';
$string['calcdistribution'] = 'Phân phối';
$string['calclength'] = 'Vị trí thập phân';
$string['calcmax'] = 'Tối đa';
$string['calcmin'] = 'Tối thiểu';
$string['choosedatasetproperties'] = 'Chọn thuộc tính tập dữ liệu ký tự đại diện';
$string['choosedatasetproperties_help'] = 'Tập dữ liệu là một tập hợp các giá trị được chèn vào vị trí của một ký tự đại diện. Bạn có thể tạo tập dữ liệu riêng cho một câu hỏi cụ thể hoặc tập dữ liệu dùng chung có thể được sử dụng cho các câu hỏi được tính toán khác trong danh mục.';
$string['correctanswerformula'] = 'Công thức câu trả lời đúng';
$string['correctanswershows'] = 'Hiển thị câu trả lời đúng';
$string['correctanswershowsformat'] = 'Định dạng';
$string['correctfeedback'] = 'Đối với bất kỳ câu trả lời chính xác';
$string['dataitemdefined'] = 'với {$a} các giá trị số đã được xác định sẵn có';
$string['datasetrole'] = 'Các thẻ đại diện <strong> {x ..} </strong> sẽ được thay thế bằng một giá trị số từ tập dữ liệu của chúng';
$string['decimals'] = 'với {$a}';
$string['deleteitem'] = 'Xóa mục';
$string['deletelastitem'] = 'Xóa mục cuối cùng';
$string['distributionoption'] = 'Chọn tùy chọn phân phối';
$string['editdatasets'] = 'Chỉnh sửa tập dữ liệu ký tự đại diện';
$string['editdatasets_help'] = 'Giá trị ký tự đại diện có thể được tạo bằng cách nhập một số vào mỗi trường ký tự đại diện, sau đó nhấp vào nút thêm. Để tự động tạo 10 giá trị trở lên, hãy chọn số lượng giá trị cần thiết trước khi nhấp vào nút thêm. Phân phối đồng đều có nghĩa là bất kỳ giá trị nào giữa các giới hạn đều có khả năng được tạo ra như nhau; phân phối loguniform có nghĩa là các giá trị hướng tới giới hạn thấp hơn có nhiều khả năng hơn.';
$string['existingcategory1'] = 'sẽ sử dụng tập dữ liệu được chia sẻ hiện có';
$string['existingcategory2'] = 'một tệp từ một nhóm tệp đã tồn tại cũng được các câu hỏi khác trong danh mục này sử dụng';
$string['existingcategory3'] = 'một liên kết từ một tập hợp các liên kết đã tồn tại cũng được các câu hỏi khác trong danh mục này sử dụng';
$string['forceregeneration'] = 'tái tạo lực';
$string['forceregenerationall'] = 'tạo lực lượng của tất cả các ký tự đại diện';
$string['forceregenerationshared'] = 'chỉ tạo ra các ký tự đại diện không được chia sẻ';
$string['functiontakesatleasttwo'] = 'Hàm {$a} phải có ít nhất hai đối số';
$string['functiontakesnoargs'] = 'Hàm {$a} không nhận bất kỳ đối số nào';
$string['functiontakesonearg'] = 'Hàm {$a} phải có chính xác một đối số';
$string['functiontakesoneortwoargs'] = 'Hàm {$a} phải có một hoặc hai đối số';
$string['functiontakestwoargs'] = 'Hàm {$a} phải có đúng hai đối số';
$string['generatevalue'] = 'Tạo một giá trị mới giữa';
$string['getnextnow'] = 'Nhận \'Mục cần thêm\' mới ngay bây giờ';
$string['hexanotallowed'] = 'Tập dữ liệu <strong> {$a->name} </strong> giá trị định dạng thập lục phân {$a->value} không được phép';
$string['illegalformulasyntax'] = 'Cú pháp công thức không hợp lệ bắt đầu bằng \'{$a}\'';
$string['incorrectfeedback'] = 'Đối với bất kỳ phản hồi không chính xác nào';
$string['itemno'] = 'Mục {$a}';
$string['itemscount'] = 'Số lượng mục <br />';
$string['itemtoadd'] = 'Mục cần thêm';
$string['keptcategory1'] = 'sẽ sử dụng cùng một tập dữ liệu được chia sẻ hiện có như trước đây';
$string['keptcategory2'] = 'một tệp từ cùng một danh mục tập hợp các tệp có thể tái sử dụng như trước đây';
$string['keptcategory3'] = 'một liên kết từ cùng một nhóm các liên kết có thể tái sử dụng như trước đây';
$string['keptlocal1'] = 'sẽ sử dụng cùng một tập dữ liệu riêng tư hiện có như trước đây';
$string['keptlocal2'] = 'một tệp từ cùng một bộ tệp riêng tư cho câu hỏi như trước đây';
$string['keptlocal3'] = 'một liên kết từ cùng một tập hợp các liên kết riêng tư như trước đây';
$string['lengthoption'] = 'Chọn tùy chọn độ dài';
$string['loguniform'] = 'Loguniform';
$string['loguniformbit'] = 'chữ số, từ một phân phối loguniform';
$string['makecopynextpage'] = 'Trang tiếp theo (câu hỏi mới)';
$string['mandatoryhdr'] = 'Các thẻ đại diện bắt buộc có trong câu trả lời';
$string['max'] = 'Max';
$string['min'] = 'Min';
$string['minmax'] = 'Phạm vi giá trị';
$string['missingformula'] = 'Thiếu công thức';
$string['missingname'] = 'Thiếu tên câu hỏi';
$string['missingquestiontext'] = 'Thiếu văn bản câu hỏi';
$string['mustenteraformulaorstar'] = 'Bạn phải nhập công thức hoặc \'*\'.';
$string['newcategory1'] = 'sẽ sử dụng một tập dữ liệu được chia sẻ mới';
$string['newcategory2'] = 'một tệp từ một nhóm tệp mới cũng có thể được sử dụng bởi các câu hỏi khác trong danh mục này';
$string['newcategory3'] = 'một liên kết từ một tập hợp các liên kết mới cũng có thể được sử dụng bởi các câu hỏi khác trong danh mục này';
$string['newlocal1'] = 'sẽ sử dụng một tập dữ liệu riêng tư mới';
$string['newlocal2'] = 'một tệp từ một nhóm tệp mới sẽ chỉ được sử dụng cho câu hỏi này';
$string['newlocal3'] = 'một liên kết từ một tập hợp các liên kết mới sẽ chỉ được sử dụng bởi câu hỏi này';
$string['newsetwildcardvalues'] = 'tập hợp mới của giá trị thẻ đại diện';
$string['nextitemtoadd'] = 'Tiếp theo \'Mục cần thêm\'';
$string['nextpage'] = 'Trang tiếp theo';
$string['nocoherencequestionsdatyasetcategory'] = 'Đối với id câu hỏi {$a->qid}, id danh mục {$a->qcat} không giống với thẻ đại diện được chia sẻ {$a->name} id danh mục {$a->sharedcat}. Chỉnh sửa câu hỏi.';
$string['nocommaallowed'] = 'Các, không thể được sử dụng, sử dụng. như trong 0,013 hoặc 1,3e-2';
$string['nosharedwildcard'] = 'Không có thẻ đại diện được chia sẻ trong danh mục này';
$string['notvalidnumber'] = 'Giá trị thẻ Wild không phải là một số hợp lệ';
$string['oneanswertrueansweroutsidelimits'] = 'Ít nhất một câu trả lời đúng nằm ngoài giới hạn giá trị thực. <br /> Sửa đổi cài đặt dung sai câu trả lời có sẵn dưới dạng Tham số nâng cao';
$string['param'] = 'Thông số {<strong> {$a} </strong>}';
$string['partiallycorrectfeedback'] = 'Đối với bất kỳ câu trả lời đúng một phần nào';
$string['pluginname'] = 'Tính toán';
$string['pluginname_help'] = 'Các câu hỏi được tính toán cho phép tạo các câu hỏi số riêng lẻ bằng cách sử dụng các ký tự đại diện trong dấu ngoặc nhọn được thay thế bằng các giá trị riêng lẻ khi câu hỏi được thực hiện. Ví dụ, câu hỏi "Diện tích hình chữ nhật có chiều dài {l} và chiều rộng {w} là bao nhiêu?" sẽ có công thức câu trả lời đúng "{l} * {w}" (trong đó * biểu thị phép nhân).';
$string['pluginnameadding'] = 'Thêm một câu hỏi tính toán';
$string['pluginnameediting'] = 'Chỉnh sửa câu hỏi tính toán';
$string['pluginnamesummary'] = 'Các câu hỏi tính toán giống như các câu hỏi số nhưng với các số được sử dụng được chọn ngẫu nhiên từ một tập hợp khi bài kiểm tra được thực hiện.';
$string['possiblehdr'] = 'Các thẻ đại diện có thể có chỉ xuất hiện trong văn bản câu hỏi';
$string['privacy:metadata'] = 'Plugin Loại câu hỏi được tính toán không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['questiondatasets'] = 'Bộ dữ liệu câu hỏi';
$string['questiondatasets_help'] = 'Tập dữ liệu câu hỏi gồm các thẻ đại diện sẽ được sử dụng trong từng câu hỏi riêng lẻ';
$string['questionstoredname'] = 'Tên được lưu trữ câu hỏi';
$string['replacewithrandom'] = 'Thay thế bằng một giá trị ngẫu nhiên';
$string['reuseifpossible'] = 'sử dụng lại giá trị trước đó nếu có';
$string['setno'] = 'Đặt {$a}';
$string['setwildcardvalues'] = 'tập hợp (các) giá trị thẻ đại diện';
$string['sharedwildcard'] = 'Thẻ đại diện được chia sẻ {<strong> {$a} </strong>}';
$string['sharedwildcardname'] = 'Thẻ đại diện được chia sẻ';
$string['sharedwildcards'] = 'Thẻ đại diện được chia sẻ';
$string['showitems'] = 'Trưng bày';
$string['significantfigures'] = 'với {$a}';
$string['significantfiguresformat'] = 'số liệu quan trọng';
$string['synchronize'] = 'Đồng bộ hóa dữ liệu từ các bộ dữ liệu được chia sẻ với các câu hỏi khác trong một bài kiểm tra';
$string['synchronizeno'] = 'Không đồng bộ hóa';
$string['synchronizeyes'] = 'Làm cho đồng bộ';
$string['synchronizeyesdisplay'] = 'Đồng bộ hóa và hiển thị tên tập dữ liệu được chia sẻ dưới dạng tiền tố của tên câu hỏi';
$string['tolerance'] = 'Phép toán ±';
$string['tolerancetype'] = 'Kiểu';
$string['trueanswerinsidelimits'] = 'Câu trả lời đúng: {$a->correct} bên trong giới hạn của giá trị true {$a->true}';
$string['trueansweroutsidelimits'] = '<span class = "error"> LỖI Câu trả lời đúng: {$a->correct} nằm ngoài giới hạn của giá trị true {$a->true} </span>';
$string['uniform'] = 'Đồng phục';
$string['uniformbit'] = 'số thập phân, từ một phân phối đồng đều';
$string['unsupportedformulafunction'] = 'Hàm {$a} không được hỗ trợ';
$string['updatecategory'] = 'Cập nhật danh mục';
$string['updatedatasetparam'] = 'Cập nhật thông số tập dữ liệu';
$string['updatetolerancesparam'] = 'Cập nhật thông số dung sai câu trả lời';
$string['updatewildcardvalues'] = 'Cập nhật (các) giá trị thẻ đại diện';
$string['useadvance'] = 'Sử dụng nút nâng cao để xem lỗi';
$string['usedinquestion'] = 'Được sử dụng trong câu hỏi';
$string['wildcard'] = 'Thẻ đại diện {<strong> {$a} </strong>}';
$string['wildcardparam'] = 'Các thông số thẻ đại diện được sử dụng để tạo giá trị';
$string['wildcardrole'] = 'Các thẻ đại diện <strong> {x ..} </strong> sẽ được thay thế bằng một giá trị số từ các giá trị đã tạo';
$string['wildcards'] = 'Các thẻ đại diện {a} ... {z}';
$string['wildcardvalues'] = 'Giá trị của (các) thẻ hoang dã';
$string['wildcardvaluesgenerated'] = 'Đã tạo (các) giá trị thẻ đại diện';
$string['youmustaddatleastoneitem'] = 'Bạn phải thêm ít nhất một mục tập dữ liệu trước khi có thể lưu câu hỏi này.';
$string['youmustaddatleastonevalue'] = 'Bạn phải thêm ít nhất một bộ giá trị (các) thẻ đại diện trước khi có thể lưu câu hỏi này.';
$string['zerosignificantfiguresnotallowed'] = 'Câu trả lời đúng không thể có số liệu quan trọng bằng không!';
