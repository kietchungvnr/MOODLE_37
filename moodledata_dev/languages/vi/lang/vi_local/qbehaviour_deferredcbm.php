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
 * @package    qbehaviour
 * @subpackage deferredcbm
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accuracy'] = 'Sự chính xác';
$string['accuracyandbonus'] = 'Độ chính xác + Tiền thưởng';
$string['assumingcertainty'] = 'Bạn đã không chọn một điều chắc chắn. Giả sử: {$a}.';
$string['averagecbmmark'] = 'Điểm CBM trung bình';
$string['basemark'] = 'Đánh dấu cơ sở {$a}';
$string['breakdownbycertainty'] = 'Phá vỡ một cách chắc chắn';
$string['cbmbonus'] = 'Tiền thưởng CBM';
$string['cbmgradeexplanation'] = 'Đối với CBM, điểm ở trên được hiển thị so với mức tối đa cho tất cả đúng tại C = 1.';
$string['cbmgrades'] = 'Điểm CBM';
$string['cbmgrades_help'] = 'Với Đánh dấu dựa trên độ chắc chắn (CBM), mọi câu hỏi đúng với C = 1 (độ chắc chắn thấp) sẽ cho điểm 100%. Điểm có thể cao tới 300% nếu mọi câu hỏi đúng với C = 3 (độ chắc chắn cao). Nhận thức sai (câu trả lời sai chắc chắn) sẽ cho điểm thấp hơn nhiều so với câu trả lời sai được thừa nhận là không chắc chắn. Điều này thậm chí có thể dẫn đến điểm tổng thể tiêu cực. ** Độ chính xác ** là% chính xác bỏ qua độ chắc chắn nhưng có trọng số cho điểm tối đa của mỗi câu hỏi. Việc phân biệt thành công các câu trả lời nhiều hơn và kém tin cậy hơn sẽ cho điểm cao hơn so với việc chọn cùng một độ chắc chắn cho mỗi câu hỏi. Điều này được phản ánh trong ** Tiền thưởng CBM **. ** Độ chính xác ** + ** Phần thưởng CBM ** là thước đo kiến ​​thức tốt hơn ** Độ chính xác **. Những quan niệm sai lầm có thể dẫn đến một khoản tiền thưởng tiêu cực, một lời cảnh báo để xem xét cẩn thận những gì được và chưa biết.';
$string['cbmmark'] = 'CBM dấu {$a}';
$string['certainty'] = 'Chắc chắn';
$string['certainty_help'] = 'Việc đánh dấu dựa trên độ chắc chắn yêu cầu bạn cho biết mức độ đáng tin cậy của bạn. Các mức khả dụng là: Mức độ chắc chắn | C = 1 (Không chắc) | C = 2 (Giữa) | C = 3 (Khá chắc chắn) ------------------- | ------------ | --------- | ---------------- Đánh dấu nếu đúng | 1 | 2 | 3 Đánh dấu nếu sai | 0 | -2 | -6 Xác suất đúng | <67% | 67-80% | > 80% Điểm tốt nhất đạt được bằng cách thừa nhận sự không chắc chắn. Ví dụ, nếu bạn nghĩ rằng có nhiều hơn 1 trong 3 cơ hội sai, bạn nên nhập C = 1 và tránh rủi ro bị đánh dấu âm.';
$string['certainty1'] = 'C=1 (Không chắc: <67%)';
$string['certainty-1'] = 'Không ý kiến';
$string['certainty2'] = 'C=2 (Giữa:> 67%)';
$string['certainty3'] = 'C=3 (Khá chắc chắn:> 80%)';
$string['certaintyshort1'] = 'C=1';
$string['certaintyshort-1'] = 'Không ý kiến';
$string['certaintyshort2'] = 'C=2';
$string['certaintyshort3'] = 'C=3';
$string['dontknow'] = 'Không ý kiến';
$string['foransweredquestions'] = 'Kết quả chỉ cho {$a} câu hỏi đã trả lời';
$string['forentirequiz'] = 'Kết quả cho toàn bộ bài kiểm tra ({$a} câu hỏi)';
$string['howcertainareyou'] = 'Độ chắc chắn {$a->help}: {$a->choices}';
$string['judgementok'] = 'Đồng ý';
$string['judgementsummary'] = 'Câu trả lời: {$a->responses}. Độ chính xác: {$a->fraction}. (Phạm vi tối ưu {$a->idealrangelow} đến {$a->idealrangehigh}). Bạn đã {$a->judgement} sử dụng mức độ chắc chắn này.';
$string['noquestions'] = 'Không phản hồi';
$string['overconfident'] = 'quá tự tin';
$string['pluginname'] = 'Phản hồi hoãn lại với CBM';
$string['privacy:metadata'] = 'Phản hồi được hoãn với plugin hành vi câu hỏi CBM không lưu trữ bất kỳ dữ liệu cá nhân nào.';
$string['slightlyoverconfident'] = 'hơi quá tự tin';
$string['slightlyunderconfident'] = 'hơi thiếu tự tin';
$string['underconfident'] = 'thiếu tự tin';
$string['weightx'] = 'Trọng số {$a}';
