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
 * @subpackage xmldb
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actual'] = 'Thực tế';
$string['addpersistent'] = 'Thêm các trường liên tục bắt buộc';
$string['aftertable'] = 'Sau bảng:';
$string['back'] = 'Trở lại';
$string['backtomainview'] = 'Quay lại màn hình chính';
$string['cannotuseidfield'] = 'Không thể chèn trường "id". Nó là một cột tự động';
$string['change'] = 'Thay đổi';
$string['charincorrectlength'] = 'Độ dài không chính xác cho trường ký tự';
$string['check_bigints'] = 'Tìm kiếm các số nguyên DB không chính xác';
$string['check_defaults'] = 'Tìm kiếm các giá trị mặc định không nhất quán';
$string['check_foreign_keys'] = 'Tìm kiếm các vi phạm khóa ngoại';
$string['check_indexes'] = 'Tìm kiếm các chỉ mục DB bị thiếu';
$string['check_oracle_semantics'] = 'Tìm kiếm ngữ nghĩa độ dài không chính xác';
$string['checkbigints'] = 'Kiểm tra số nguyên';
$string['checkdefaults'] = 'Kiểm tra giá trị mặc định';
$string['checkforeignkeys'] = 'Kiểm tra khóa ngoại';
$string['checkindexes'] = 'Kiểm tra chỉ mục';
$string['checkoraclesemantics'] = 'Kiểm tra ngữ nghĩa';
$string['completelogbelow'] = '(xem toàn bộ nhật ký tìm kiếm bên dưới)';
$string['confirmcheckbigints'] = 'Chức năng này sẽ tìm kiếm <a href="https://tracker.moodle.org/browse/MDL-11038"> các trường số nguyên có khả năng sai </a> trong máy chủ Moodle của bạn, tự động tạo (nhưng không thực thi!) Khi cần Các câu lệnh SQL để có tất cả các số nguyên trong DB của bạn được định nghĩa đúng. Sau khi được tạo, bạn có thể sao chép các câu lệnh như vậy và thực thi chúng một cách an toàn với giao diện SQL yêu thích của bạn (đừng quên sao lưu dữ liệu của bạn trước khi thực hiện điều đó). Bạn rất nên chạy (+ phiên bản) mới nhất có sẵn của bản phát hành Moodle của mình trước khi thực hiện tìm kiếm các số nguyên sai. Chức năng này không thực hiện bất kỳ hành động nào đối với DB (chỉ đọc từ nó), vì vậy có thể được thực thi một cách an toàn bất cứ lúc nào.';
$string['confirmcheckdefaults'] = 'Chức năng này sẽ tìm kiếm các giá trị mặc định không nhất quán trong máy chủ Moodle của bạn, tạo (nhưng không thực thi!) Các câu lệnh SQL cần thiết để xác định đúng tất cả các giá trị mặc định. Sau khi được tạo, bạn có thể sao chép các câu lệnh như vậy và thực thi chúng một cách an toàn với giao diện SQL yêu thích của bạn (đừng quên sao lưu dữ liệu của bạn trước khi thực hiện điều đó). Bạn nên chạy (+ phiên bản) mới nhất có sẵn của bản phát hành Moodle của mình trước khi thực hiện tìm kiếm các giá trị mặc định không nhất quán. Chức năng này không thực hiện bất kỳ hành động nào đối với DB (chỉ đọc từ nó), vì vậy có thể được thực thi một cách an toàn bất cứ lúc nào.';
$string['confirmcheckforeignkeys'] = 'Chức năng này sẽ tìm kiếm các vi phạm tiềm ẩn đối với các khóa ngoại được xác định trong các định nghĩa install.xml. (Moodle hiện không tạo ra các ràng buộc khóa ngoài thực tế trong cơ sở dữ liệu, đó là lý do tại sao dữ liệu không hợp lệ có thể xuất hiện.) Bạn nên chạy (+ phiên bản) mới nhất có sẵn của bản phát hành Moodle trước khi thực hiện tìm kiếm các vi phạm tiềm ẩn của khóa ngoại. Chức năng này không thực hiện bất kỳ hành động nào đối với DB (chỉ đọc từ nó), vì vậy có thể được thực thi một cách an toàn bất cứ lúc nào.';
$string['confirmcheckindexes'] = 'Chức năng này sẽ tìm kiếm các chỉ mục tiềm ẩn bị thiếu trong máy chủ Moodle của bạn, tạo (nhưng không thực thi!) Tự động các câu lệnh SQL cần thiết để cập nhật mọi thứ. Sau khi được tạo, bạn có thể sao chép các câu lệnh như vậy và thực thi chúng một cách an toàn với giao diện SQL yêu thích của bạn (đừng quên sao lưu dữ liệu của bạn trước khi thực hiện điều đó). Bạn rất nên chạy (+ phiên bản) mới nhất có sẵn của bản phát hành Moodle của mình trước khi thực hiện tìm kiếm các chỉ mục bị thiếu. Chức năng này không thực hiện bất kỳ hành động nào đối với DB (chỉ đọc từ nó), vì vậy có thể được thực thi một cách an toàn bất cứ lúc nào.';
$string['confirmcheckoraclesemantics'] = 'Chức năng này sẽ tìm kiếm <a href="https://tracker.moodle.org/browse/MDL-29322"> các cột Oracle varchar2 sử dụng ngữ nghĩa BYTE </a> trong máy chủ Moodle của bạn, tự động tạo (nhưng không thực thi!) các câu lệnh SQL cần thiết để chuyển đổi tất cả các cột sang sử dụng ngữ nghĩa CHAR (tốt hơn cho khả năng tương thích chéo db và tăng chiều dài tối đa của nội dung). Sau khi được tạo, bạn có thể sao chép các câu lệnh đó và thực thi chúng một cách an toàn với giao diện SQL yêu thích của bạn (đừng quên sao lưu dữ liệu của bạn trước khi thực hiện điều đó). Bạn nên chạy phiên bản (+) mới nhất có sẵn của bản phát hành Moodle của mình trước khi thực hiện tìm kiếm ngữ nghĩa BYTE. Chức năng này không thực hiện bất kỳ hành động nào đối với DB (chỉ đọc từ nó), vì vậy có thể được thực thi một cách an toàn bất cứ lúc nào.';
$string['confirmdeletefield'] = 'Bạn có chắc chắn rằng bạn muốn xóa trường:';
$string['confirmdeleteindex'] = 'Bạn có chắc chắn rằng bạn muốn xóa chỉ mục không:';
$string['confirmdeletekey'] = 'Bạn có chắc chắn rằng bạn muốn xóa khóa không:';
$string['confirmdeletetable'] = 'Bạn có chắc chắn rằng bạn muốn xóa bảng:';
$string['confirmdeletexmlfile'] = 'Bạn có chắc chắn rằng bạn muốn xóa tệp không:';
$string['confirmrevertchanges'] = 'Bạn có hoàn toàn chắc chắn rằng bạn muốn hoàn nguyên các thay đổi được thực hiện qua:';
$string['create'] = 'Tạo nên';
$string['createtable'] = 'Tạo bảng:';
$string['defaultincorrect'] = 'Mặc định không chính xác';
$string['delete'] = 'Xóa bỏ';
$string['delete_field'] = 'Xóa trường';
$string['delete_index'] = 'Xóa chỉ mục';
$string['delete_key'] = 'Phím xoá';
$string['delete_table'] = 'Xóa bảng';
$string['delete_xml_file'] = 'Xóa tệp XML';
$string['doc'] = 'Doc';
$string['docindex'] = 'Chỉ mục tài liệu:';
$string['documentationintro'] = 'Tài liệu này được tạo tự động từ định nghĩa cơ sở dữ liệu XMLDB. Nó chỉ có sẵn bằng tiếng Anh.';
$string['down'] = 'Xuống';
$string['duplicate'] = 'Bản sao';
$string['duplicatefieldname'] = 'Trường khác có tên đó tồn tại';
$string['duplicatefieldsused'] = 'Các trường trùng lặp được sử dụng';
$string['duplicateindexname'] = 'Tên chỉ mục trùng lặp';
$string['duplicatekeyname'] = 'Một khóa khác có tên đó tồn tại';
$string['duplicatetablename'] = 'Một bảng khác có tên đó tồn tại';
$string['edit'] = 'Biên tập';
$string['edit_field'] = 'Chỉnh sửa trường';
$string['edit_field_save'] = 'Lưu trường';
$string['edit_index'] = 'Chỉnh sửa chỉ mục';
$string['edit_index_save'] = 'Lưu chỉ mục';
$string['edit_key'] = 'Chỉnh sửa khóa';
$string['edit_key_save'] = 'Lưu khóa';
$string['edit_table'] = 'Chỉnh sửa bảng';
$string['edit_table_save'] = 'Lưu bảng';
$string['edit_xml_file'] = 'Chỉnh sửa tệp XML';
$string['enumvaluesincorrect'] = 'Các giá trị không chính xác cho trường enum';
$string['expected'] = 'Hy vọng';
$string['extensionrequired'] = 'Xin lỗi - phần mở rộng PHP \'{$a}\' là bắt buộc cho hành động này. Vui lòng cài đặt tiện ích mở rộng nếu bạn muốn sử dụng tính năng này.';
$string['field'] = 'Trường';
$string['fieldnameempty'] = 'Trường tên trống';
$string['fields'] = 'Các trường';
$string['fieldsnotintable'] = 'Trường không tồn tại trong bảng';
$string['fieldsusedinindex'] = 'Trường này được sử dụng làm chỉ mục';
$string['fieldsusedinkey'] = 'Trường này được sử dụng làm khóa.';
$string['filemodifiedoutfromeditor'] = 'Cảnh báo: Tệp được sửa đổi cục bộ trong khi sử dụng Trình soạn thảo XMLDB. Lưu sẽ ghi đè các thay đổi cục bộ.';
$string['filenotwriteable'] = 'Tệp không thể ghi';
$string['fkunknownfield'] = 'Khóa ngoại {$a->keyname} trên bảng {$a->tablename} trỏ đến trường không tồn tại {$a->reffield} trong bảng được tham chiếu {$a->reftable}.';
$string['fkunknowntable'] = 'Khóa ngoại {$a- keyname} trên bảng {$a->tablename} trỏ đến một bảng không tồn tại {$a->reftable}.';
$string['fkviolationdetails'] = 'Khóa ngoại {$a->keyname} trên bảng {$a->tablename} bị vi phạm bởi {$a->numviolations} trong số các hàng {$a->numrows}.';
$string['float2numbernote'] = 'Lưu ý: Mặc dù các trường "float" được XMLDB hỗ trợ 100%, nhưng thay vào đó, bạn nên chuyển sang các trường "number".';
$string['floatincorrectdecimals'] = 'Số lượng thập phân không chính xác cho trường float';
$string['floatincorrectlength'] = 'Độ dài không chính xác cho trường float';
$string['generate_all_documentation'] = 'Tất cả các tài liệu';
$string['generate_documentation'] = 'Tài liệu';
$string['gotolastused'] = 'Chuyển đến tệp được sử dụng gần đây nhất';
$string['incorrectfieldname'] = 'Tên không chính xác';
$string['incorrectindexname'] = 'Tên chỉ mục không chính xác';
$string['incorrectkeyname'] = 'Tên khóa không chính xác';
$string['incorrecttablename'] = 'Tên bảng không chính xác';
$string['index'] = 'Mục lục';
$string['indexes'] = 'Chỉ mục';
$string['indexnameempty'] = 'Tên chỉ mục trống';
$string['integerincorrectlength'] = 'Độ dài không chính xác cho trường số nguyên';
$string['key'] = 'Chìa khóa';
$string['keynameempty'] = 'Tên khóa không được để trống';
$string['keys'] = 'Chìa khóa';
$string['listreservedwords'] = 'Danh sách các từ dành riêng <br /> (được sử dụng để cập nhật <a href="https://docs.moodle.org/vi/XMLDB_reserved_words" target="_blank"> các từ dành riêng cho XMLDB </a>)';
$string['load'] = 'Tải';
$string['main_view'] = 'Màn hình chính';
$string['masterprimaryuniqueordernomatch'] = 'Các trường trong khóa ngoại của bạn phải được liệt kê theo thứ tự giống như chúng được liệt kê trong KHÓA DUY NHẤT trên bảng tham chiếu.';
$string['missing'] = 'Còn thiếu';
$string['missingindexes'] = 'Tìm thấy chỉ mục bị thiếu';
$string['mustselectonefield'] = 'Bạn phải chọn một trường để xem các hành động liên quan đến trường!';
$string['mustselectoneindex'] = 'Bạn phải chọn một chỉ mục để xem các hành động liên quan đến chỉ mục!';
$string['mustselectonekey'] = 'Bạn phải chọn một phím để xem các hành động liên quan chính!';
$string['new_table_from_mysql'] = 'Bảng mới từ MySQL';
$string['newfield'] = 'Trường mới';
$string['newindex'] = 'Chỉ mục mới';
$string['newkey'] = 'Chìa khoá mới';
$string['newtable'] = 'Bảng mới';
$string['newtablefrommysql'] = 'Bảng mới từ MySQL';
$string['nofieldsspecified'] = 'Không có trường nào được chỉ định';
$string['nomasterprimaryuniquefound'] = '(Các) cột mà tham chiếu khóa ngoại của bạn phải được đưa vào KEY chính hoặc duy nhất trong bảng được tham chiếu. Lưu ý rằng cột nằm trong CHỈ SỐ DUY NHẤT là không đủ tốt.';
$string['nomissingindexesfound'] = 'Không tìm thấy chỉ mục nào bị thiếu, DB của bạn không cần thực hiện thêm hành động nào.';
$string['noreffieldsspecified'] = 'Không có trường tham chiếu nào được chỉ định';
$string['noreftablespecified'] = 'Không tìm thấy bảng tham chiếu đã chỉ định';
$string['noviolatedforeignkeysfound'] = 'Không tìm thấy khóa ngoại vi phạm';
$string['nowrongdefaultsfound'] = 'Không tìm thấy giá trị mặc định không nhất quán nào, DB của bạn không cần thêm hành động nào.';
$string['nowrongintsfound'] = 'Không tìm thấy số nguyên sai nào, DB của bạn không cần thêm hành động nào.';
$string['nowrongoraclesemanticsfound'] = 'Không tìm thấy cột Oracle nào sử dụng ngữ nghĩa BYTE, DB của bạn không cần thêm hành động nào.';
$string['numberincorrectdecimals'] = 'Số số thập phân không chính xác cho trường số';
$string['numberincorrectlength'] = 'Độ dài không chính xác cho trường số';
$string['numberincorrectwholepart'] = 'Phần số nguyên quá lớn cho trường số';
$string['pendingchanges'] = 'Lưu ý: Bạn đã thực hiện các thay đổi đối với tệp này. Chúng có thể được lưu bất cứ lúc nào.';
$string['pendingchangescannotbesaved'] = 'Có những thay đổi trong tệp này nhưng chúng không thể lưu được! Vui lòng xác minh rằng cả thư mục và "install.xml" bên trong nó đều có quyền ghi cho máy chủ web.';
$string['pendingchangescannotbesavedreload'] = 'Có những thay đổi trong tệp này nhưng chúng không thể lưu được! Vui lòng xác minh rằng cả thư mục và "install.xml" bên trong nó đều có quyền ghi cho máy chủ web. Sau đó tải lại trang này và bạn có thể lưu những thay đổi đó.';
$string['persistentfieldscomplete'] = 'Các trường sau đã được thêm vào:';
$string['persistentfieldsconfirm'] = 'Bạn có muốn thêm các trường sau:';
$string['persistentfieldsexist'] = 'Các trường sau đã tồn tại:';
$string['primarykeyonlyallownotnullfields'] = 'Các khóa chính không được để trống';
$string['privacy:metadata'] = 'Plugin trình soạn thảo XMLDB không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['reserved'] = 'Kín đáo';
$string['reservedwords'] = 'Từ dành riêng';
$string['revert'] = 'Hoàn tác';
$string['revert_changes'] = 'Thay đổi hoàn tác';
$string['save'] = 'Lưu';
$string['searchresults'] = 'Kết quả tìm kiếm';
$string['selectaction'] = 'Chọn hành động:';
$string['selectdb'] = 'Chọn cơ sở dữ liệu:';
$string['selectfieldkeyindex'] = 'Chọn trường / khóa / chỉ mục:';
$string['selectonecommand'] = 'Vui lòng chọn một hành động từ danh sách để xem mã PHP';
$string['selectonefieldkeyindex'] = 'Vui lòng chọn một trường / khóa / chỉ mục từ danh sách để xem mã PHP';
$string['selecttable'] = 'Chọn bảng:';
$string['table'] = 'Bảng';
$string['tablenameempty'] = 'Tên bảng không được để trống';
$string['tables'] = 'Các bảng';
$string['unknownfield'] = 'Đề cập đến một trường không xác định';
$string['unknowntable'] = 'Đề cập đến một bảng không xác định';
$string['unload'] = 'Không tải';
$string['up'] = 'Lên';
$string['view'] = 'Lượt xem';
$string['view_reserved_words'] = 'Xem các từ dành riêng';
$string['view_structure_php'] = 'Xem cấu trúc PHP';
$string['view_structure_sql'] = 'Xem cấu trúc SQL';
$string['view_table_php'] = 'Xem bảng PHP';
$string['view_table_sql'] = 'Xem bảng SQL';
$string['viewedited'] = 'Xem đã chỉnh sửa';
$string['vieworiginal'] = 'Xem bản gốc';
$string['viewphpcode'] = 'Xem mã PHP';
$string['viewsqlcode'] = 'Xem mã SQL';
$string['viewxml'] = 'XML';
$string['violatedforeignkeys'] = 'Khoá ngoại vi phạm';
$string['violatedforeignkeysfound'] = 'Đã tìm thấy khóa ngoại vi phạm';
$string['violations'] = 'Vi phạm';
$string['wrong'] = 'Sai lầm';
$string['wrongdefaults'] = 'Đã tìm thấy các mặc định sai';
$string['wrongints'] = 'Đã tìm thấy số nguyên sai';
$string['wronglengthforenum'] = 'Độ dài không chính xác cho trường enum';
$string['wrongnumberofreffields'] = 'Số lượng trường tham chiếu sai';
$string['wrongoraclesemantics'] = 'Đã tìm thấy ngữ nghĩa Oracle BYTE sai';
$string['wrongreservedwords'] = 'Các từ dành riêng hiện được sử dụng <br /> (lưu ý rằng tên bảng không quan trọng nếu sử dụng tiền tố $ CFG->prefix)';
$string['yesmissingindexesfound'] = '<p> Một số chỉ mục bị thiếu đã được tìm thấy trong DB của bạn. Dưới đây là chi tiết của chúng và các câu lệnh SQL cần thiết được thực thi với giao diện SQL yêu thích của bạn để tạo tất cả chúng. Trước tiên, hãy nhớ sao lưu dữ liệu của bạn! </p> <p> Sau khi thực hiện điều đó, bạn nên thực thi lại tiện ích này để kiểm tra xem không tìm thấy chỉ mục nào bị thiếu nữa. </p>';
$string['yeswrongdefaultsfound'] = '<p>Một số giá trị mặc định không nhất quán đã được tìm thấy trong DB của bạn. Dưới đây là chi tiết của chúng và các câu lệnh SQL cần thiết được thực thi với giao diện SQL yêu thích của bạn để khắc phục tất cả. Trước tiên, hãy nhớ sao lưu dữ liệu của bạn! </p> <p> Sau khi thực hiện điều đó, bạn nên thực thi lại tiện ích này để kiểm tra xem không tìm thấy các giá trị mặc định không nhất quán nào nữa.</p>';
$string['yeswrongintsfound'] = '<p>Một số số nguyên sai đã được tìm thấy trong DB của bạn. Dưới đây là chi tiết của chúng và các câu lệnh SQL cần thiết được thực thi với giao diện SQL yêu thích của bạn để khắc phục chúng. Trước tiên, hãy nhớ sao lưu dữ liệu của bạn! </p> <p> Sau khi sửa chúng, bạn nên chạy lại tiện ích này để kiểm tra xem không tìm thấy số nguyên sai nào nữa.</p>';
$string['yeswrongoraclesemanticsfound'] = '<p>Một số cột Oracle sử dụng ngữ nghĩa BYTE đã được tìm thấy trong DB của bạn. Dưới đây là chi tiết của chúng và các câu lệnh SQL cần thiết được thực thi với giao diện SQL yêu thích của bạn để chuyển đổi tất cả. Trước tiên, hãy nhớ sao lưu dữ liệu của bạn! </p> <p> Sau khi thực hiện điều đó, bạn nên thực thi lại tiện ích này để kiểm tra rằng không còn phát hiện thấy ngữ nghĩa sai nào nữa.</p>';
