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
 * @subpackage badges
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activatesuccess'] = 'Truy cập các huy hiệu đã được kích hoạt thành công.';
$string['addalignment'] = 'Thêm kỹ năng hoặc tiêu chuẩn bên ngoài';
$string['addbackpack'] = 'Thêm gói';
$string['addbadge'] = 'Thêm huy hiệu';
$string['addbadge_help'] = 'Chọn tất cả các huy hiệu sẽ được thêm vào yêu cầu huy hiệu này. Giữ phím CTRL để chọn nhiều mục.';
$string['addcohort'] = 'Thêm nhóm';
$string['addcohort_help'] = 'Chọn tất cả các nhóm sẽ được thêm vào yêu cầu huy hiệu này. Giữ phím CTRL để chọn nhiều mục.';
$string['addcompetency'] = 'Thêm năng lực';
$string['addcompetency_help'] = 'Chọn tất cả các năng lực cần được thêm vào yêu cầu huy hiệu này. Giữ phím CTRL để chọn nhiều mục.';
$string['addcriteriatext'] = 'Để bắt đầu thêm tiêu chuẩn, hãy chọn một trong các lựa chọn từ danh mục kéo thả.';
$string['addedtobackpack'] = 'Đã thêm huy hiệu vào gói';
$string['addrelated'] = 'Thêm huy hiệu liên quan';
$string['addtobackpack'] = 'Thêm vào gói';
$string['alignment'] = 'Căn chỉnh';
$string['allmethodbadges'] = 'Tất cả các huy hiệu đã chọn đã được kiếm';
$string['allmethodcohort'] = 'Tư cách thành viên trong tất cả các nhóm đã chọn';
$string['allmethodcompetencies'] = 'Tất cả các năng lực được chọn đã được hoàn thành';
$string['allowexternalbackpack'] = 'Kích hoạt kết nối đến gói bên ngoài';
$string['allowexternalbackpack_desc'] = 'Cho phép người dùng thiết lập các kết nối và hiển thị các huy hiệu từ các nhà cung cấp gói bên ngoài. Chú ý: Khuyến khích để cho lựa chọn này bị vô hiệu hóa nếu trang web không thể truy cập từ Internet (vd bởi vì tường lửa).';
$string['anymethodbadges'] = 'Bất kỳ huy hiệu đã chọn được nhận';
$string['anymethodcohort'] = 'Tư cách thành viên trong bất kỳ nhóm nào trong số các nhóm đã chọn';
$string['anymethodcompetencies'] = 'Bất kỳ năng lực nào được chọn đã được hoàn thành';
$string['apiversion'] = 'Phiên bản API được hỗ trợ';
$string['archivehelp'] = '<p>Lựa chọn này có nghĩa là huy hiệu sẽ được đánh dấu là "hết hiệu lực" và không còn xuất hiện trong danh sách các huy hiệu. Người dùng sẽ không thể đạt huy hiệu này, tuy nhiên những người nhận huy hiệu hiện hành sẽ vẫn thấy nó trên trang hồ sơ của mình và đem vào gói bên ngoài của họ.</p> <p>Nếu bạn muốn người dùng giữ truy cập đến các huy hiệu đã đạt được thì lựa chọn này rất quan trọng thay vì xóa hoàn toàn các huy hiệu.</p>';
$string['backpackapiurl'] = 'URL API gói';
$string['backpackavailability_help'] = 'Dành cho những người nhận huy hiệu để có thể chứng minh họ đạt huy hiệu từ bạn, một dịch vụ gói bên ngoài có thể truy cập trang của bạn và xác minh các huy hiệu được trao từ nó. Trang của bạn hiện không thể truy cập, có nghĩa rằng các huy hiệu của bạn đã được trao hoặc sẽ trao trong tương lai không thể xác minh được. **Tại sao tôi lại thấy tin này?** Có lẽ tường lửa của bạn ngăn truy cập từ những người dùng bên ngoài mạng của bạn, trang của bạn có mật khẩu bảo vệ, hoặc bạn đang vận gói trên một máy tính không hiện hữu trên Internet (giống như máy phát triển cục bộ). **Có vấn đề gì?** Bạn nên khắc phục lỗi này trên trang hoạt động nơi bạn dự định trao huy hiệu, ngược lại người nhận sẽ không thể chứng minh được họ nhận huy hiệu từ bạn. Nếu trang của bạn chưa tồn tại bạn có thể tạo và trao các huy hiệu thử nghiệm, miễn là trang có thể truy cập được trước khi vận hành trực tiếp. **Sẽ ra sao nếu tôi không thể làm cho toàn trang của mình truy cập công công được?** URL duy nhất yêu cầu cho việc xác minh là [your-site-url]/badges/assertion.php vì vậy nếu bạn có thể thay đổi tường lửa của mình cho phép truy cập bên ngoài đến tập tin đó, xác minh huy hiệu vẫn hoạt động được.';
$string['backpackbadges'] = 'Bạn có {$a->totalbadges} huy hiệu được hiển thị từ {$a->totalcollections} bộ sưu tập. <a href="mybackpack.php">Thay đổi thiết lập gói</a>.';
$string['backpackbadgessettings'] = 'Thay đổi cài đặt gói';
$string['backpackbadgessummary'] = 'Bạn có (các) huy hiệu {$a->totalbadges} được hiển thị từ (các) bộ sưu tập {$a->totalcollections}.';
$string['backpackcannotsendverification'] = 'Không thể gửi email xác minh';
$string['backpackconnection'] = 'Kết nối gói';
$string['backpackconnection_help'] = 'Trang này cho phép bạn thiết lập kết nối đến một nhà cung cấp gói bên ngoài. Kết nối gói giúp bạn hiển thị các huy hiệu bên ngoài bên trong trang này và đưa huy hiệu đạt được ở đây vào gói. Hiện tại, chỉ có <a href="http://backpack.openbadges.org">Gói Mozilla OpenBadges</a> được hỗ trợ. Bạn cần đăng kí một dịch vụ gói trước khi thử thiết lập kết nối gói trên trang này.';
$string['backpackconnectioncancelattempt'] = 'Kết nối bằng một địa chỉ email khác';
$string['backpackconnectionconnect'] = 'Kết nối với gói';
$string['backpackconnectionresendemail'] = 'Gửi lại email xác minh';
$string['backpackconnectionunexpectedmessage'] = 'Gói trả về lỗi: "{$a}".';
$string['backpackconnectionunexpectedresult'] = 'Đã xảy ra sự cố khi kết nối với gói của bạn. Vui lòng kiểm tra thông tin đăng nhập và thử lại.';
$string['backpackdetails'] = 'Các thiết lập gói';
$string['backpackemail_help'] = 'Địa chỉ email đi kèm với gói của bạn. Trong khi bạn kết nối, bất cứ huy hiệu đạt được trên trang này sẽ đi kèm với địa chỉ email đó.';
$string['backpackemailverificationpending'] = 'Đang chờ xác minh';
$string['backpackemailverifyemailbody'] = 'Xin chào, Một kết nối mới với gói huy hiệu của bạn đã được yêu cầu từ \'{$a->sitename}\' bằng địa chỉ email của bạn. Để xác nhận và kích hoạt kết nối với gói của bạn, vui lòng truy cập {$a->link} Trong hầu hết các chương trình thư, liên kết này sẽ xuất hiện dưới dạng liên kết màu xanh lam mà bạn có thể nhấp vào. Nếu cách đó không hiệu quả, hãy cắt và dán địa chỉ vào dòng địa chỉ ở đầu trình duyệt web của bạn. Nếu bạn cần trợ giúp, vui lòng liên hệ với quản trị viên trang web, {$a->admin}';
$string['backpackemailverifyemailsubject'] = '{$a}: Xác minh email gói huy hiệu';
$string['backpackemailverifypending'] = 'Email xác minh đã được gửi tới <strong> {$a} </strong>. Nhấp vào liên kết xác minh trong email để kích hoạt kết nối gói của bạn.';
$string['backpackemailverifysuccess'] = 'Cảm ơn đã xác minh địa chỉ email của bạn. Bây giờ bạn đã được kết nối với gói của mình.';
$string['backpackemailverifytokenmismatch'] = 'Mã thông báo trong liên kết bạn đã nhấp vào không khớp với mã thông báo được lưu trữ. Đảm bảo rằng bạn đã nhấp vào liên kết trong email gần đây nhất mà bạn nhận được.';
$string['backpackimport_help'] = 'Sau khi kết nối gói được thiết lập thành công, các huy hiệu từ gói của bạn có thể hiện thị trên trang "Huy hiệu của tôi" và trang hồ sơ. Trong vùng này, bạn có thể chọn các bộ sưu tập huy hiệu từ gói mà bạn muốn hiển thị trong hồ sơ của mình.';
$string['backpackneedsupdate'] = 'Gói được kết nối với hồ sơ này không khớp với gói cho trang web. Bạn cần ngắt kết nối và kết nối lại gói.';
$string['backpacksettings'] = 'Cài đặt gói';
$string['backpackweburl'] = 'URL gói';
$string['badgesalt_desc'] = 'Sử dụng hash cho phép các dịch vụ gói xác nhận người nhận huy hiệu mà không phải làm lộ địa chỉ email của họ. Thiết lập này chỉ nên sử dụng số và chữ. Chú ý: Đối với các mục đích xác minh người nhận, hãy tránh thay đổi thiết lập này khi bạn bắt đầu trao huy hiệu.';
$string['balignment'] = 'Căn chỉnh ({$a})';
$string['bendorsement'] = 'Chứng thực';
$string['brelated'] = 'Các huy hiệu liên quan ({$a})';
$string['claim'] = 'Yêu cầu';
$string['claimcomment'] = 'Bình luận chứng thực';
$string['claimid'] = 'Xác nhận URL';
$string['criteria_7'] = 'Huy hiệu được trao';
$string['criteria_7_help'] = 'Cho phép trao huy hiệu cho người dùng dựa trên các huy hiệu khác mà họ đã kiếm được.';
$string['criteria_8'] = 'Thành viên nhóm thuần tập';
$string['criteria_8_help'] = 'Cho phép trao huy hiệu cho người dùng dựa trên tư cách thành viên nhóm thuần tập.';
$string['criteria_9'] = 'Năng lực';
$string['criteria_9_help'] = 'Cho phép trao huy hiệu cho người dùng dựa trên năng lực họ đã hoàn thành.';
$string['criteria_descr_7'] = 'Bạn phải kiếm được <strong> {$a} </strong> trong số các huy hiệu sau:';
$string['criteria_descr_8'] = 'Tư cách thành viên trong <strong> {$a} </strong> trong số các nhóm sau đây là bắt buộc:';
$string['criteria_descr_9'] = '<strong> {$a} </strong> các năng lực sau phải được hoàn thành:';
$string['criteria_descr_short7'] = 'Hoàn thành <strong> {$a} </strong> trong tổng số:';
$string['criteria_descr_short8'] = 'Tư cách thành viên nhóm thuần tập trong <strong> {$a} </strong> trong số:';
$string['criteria_descr_short9'] = 'Hoàn thành <strong> {$a} </strong> trong tổng số:';
$string['criteria_descr_single_7'] = 'Bạn phải đạt được huy hiệu sau:';
$string['criteria_descr_single_8'] = 'Tư cách thành viên trong nhóm sau đây là bắt buộc:';
$string['criteria_descr_single_9'] = 'Các năng lực sau phải được hoàn thành:';
$string['criteria_descr_single_short7'] = 'Hoàn thành:';
$string['criteria_descr_single_short8'] = 'Tư cách thành viên trong:';
$string['criteria_descr_single_short9'] = 'Hoàn thành:';
$string['defaultissuerpassword'] = 'Mật khẩu của tổ chức phát hành huy hiệu';
$string['defaultissuerpassword_help'] = 'Cần có tài khoản trên trang gói với địa chỉ email như được chỉ định trong cài đặt địa chỉ email của nhà phát hành huy hiệu trong cài đặt 
Quản trị trang / Huy hiệu / Huy hiệu. Mật khẩu cho tài khoản phải được nhập ở đây.';
$string['deletehelp'] = '<p>Xóa hoàn toàn một huy hiệu nghĩa là tất cả thông tin của nó và bản ghi tiêu chuẩn sẽ vĩnh viễn bị xóa đi. Những người dùng đạt được huy hiệu này sẽ không còn truy cập và hiển thị nó trên trang hồ sơ của mình.</p> <p>Chú ý: Những người dùng đạt huy hiệu này và đã đưa nó vào gói ngoại, sẽ vẫn có huy hiệu đó trong gói của họ. Tuy nhiên, họ sẽ không thể truy cập tiêu chuẩn và các trang minh chứng có liên kết về trang web này.</p>';
$string['delexternalbackpackconfirm'] = 'Xóa gói trang web \'{$a}\'?';
$string['endorsement'] = 'Chứng thực';
$string['error:backpackdatainvalid'] = 'Dữ liệu trả về từ gói không hợp lệ.';
$string['error:backpackemailnotfound'] = 'Email \'{$a}\' không gắn liền với gói. Bạn cần <a href="http://backpack.openbadges.org">tạo gói</a> cho tài khoản đó hoặc đăng nhập với địa chỉ email khác.';
$string['error:backpackloginfailed'] = 'Bạn không thể kết nối với gói ngoại vì nguyên nhân sau: {$a}';
$string['error:backpacknotavailable'] = 'Trang của bạn không thể truy cập từ Internet, vì vậy bất kì huy hiệu được trao từ trang này không thể xác minh được bởi các dịch vụ gói ngoại.';
$string['error:backpackproblem'] = 'Có vấn đề kết nối đến nhà cung cấp dịch vụ hành trang của bạn. Hãy thử lại sau.';
$string['error:badgeawardnotfound'] = 'Không thể xác minh huy hiệu được trao tặng này. Huy hiệu này có thể đã bị thu hồi.';
$string['error:badgenotfound'] = 'Không tìm thấy huy hiệu';
$string['error:cannotdeletecriterion'] = 'Tiêu chí này không thể bị xóa.';
$string['error:cannotrevokebadge'] = 'Không thể thu hồi huy hiệu từ người dùng.';
$string['error:invalidparambadge'] = 'Huy hiệu không tồn tại.';
$string['error:invalidparamcohort'] = 'Nhóm thuần tập không tồn tại.';
$string['error:nobadges'] = 'Không có huy hiệu khóa học hoặc trang web nào có quyền truy cập được thêm vào làm tiêu chí.';
$string['error:nocohorts'] = 'Không có nhóm';
$string['error:nogroups'] = '<p>Không có bộ sưu tập công cộng các huy hiệu có trong gói của bạn. </p> <p>Chỉ có các bộ sưu tập công cộng được hiển thị, <a href="http://backpack.openbadges.org">xem gói của bạn</a> để tạo vài bộ sưu tập công cộng.</p>';
$string['error:nogroupslink'] = '<p> Chỉ các bộ sưu tập công khai được hiển thị. <a href="{$a}" target="_blank" rel="nofollow"> Ghé thăm gói của bạn </a> để tạo một số bộ sưu tập công khai. </p>';
$string['error:nogroupssummary'] = '<p> Không có bộ sưu tập huy hiệu công khai nào có sẵn trong gói của bạn. </p>';
$string['error:nosuchcohort'] = 'Cảnh báo: Nhóm thuần tập này không còn tồn tại.';
$string['error:nosuchuser'] = 'Người dùng với địa chỉ email này không có tài khoản với nhà cung cấp gói hiện tại.';
$string['error:personaneedsjs'] = 'Hiện tại, Javascript được yêu cầu để kết nối gói của bạn. Nếu có thể, hãy kích hoạt Javascript và tải lại trang.';
$string['error:relatedbadgedoesntexist'] = 'Không có huy hiệu công khai với mã nhận dạng này';
$string['eventbadgearchived'] = 'Đã lưu trữ huy hiệu';
$string['eventbadgeawarded'] = 'Huy hiệu được trao';
$string['eventbadgecreated'] = 'Huy hiệu đã được tạo';
$string['eventbadgecriteriacreated'] = 'Tiêu chí huy hiệu đã được tạo';
$string['eventbadgecriteriadeleted'] = 'Tiêu chí huy hiệu đã bị xóa';
$string['eventbadgecriteriaupdated'] = 'Đã cập nhật tiêu chí huy hiệu';
$string['eventbadgedeleted'] = 'Huy hiệu đã bị xóa';
$string['eventbadgedisabled'] = 'Huy hiệu bị vô hiệu hóa';
$string['eventbadgeduplicated'] = 'Huy hiệu được sao chép';
$string['eventbadgeenabled'] = 'Đã bật huy hiệu';
$string['eventbadgelistingviewed'] = 'Danh sách huy hiệu đã xem';
$string['eventbadgerevoked'] = 'Huy hiệu bị thu hồi';
$string['eventbadgeupdated'] = 'Đã cập nhật huy hiệu';
$string['eventbadgeviewed'] = 'Đã xem huy hiệu';
$string['existsinbackpack'] = 'Huy hiệu đã tồn tại trong gói';
$string['externalbadges_help'] = 'Vùng này hiển thị các huy hiệu từ gói ngoại của bạn.';
$string['externalconnectto'] = 'Để hiển thị các huy hiệu ngoại bạn cần <a href="{$a}">kết nối gói</a>.';
$string['hidden'] = 'Ẩn';
$string['imageauthoremail'] = 'Hình ảnh Email của tác giả';
$string['imageauthoremail_help'] = 'Nếu được chỉ định, hình ảnh huy hiệu của địa chỉ email của tác giả  sẽ được hiển thị trên trang huy hiệu.';
$string['imageauthorname'] = 'Hình ảnh tên tác giả';
$string['imageauthorname_help'] = 'Nếu được chỉ định, hình ảnh huy hiệu của tác giả  sẽ được hiển thị trên trang huy hiệu.';
$string['imageauthorurl'] = 'Hình ảnh URL của tác giả';
$string['imageauthorurl_help'] = 'Nếu được chỉ định, một liên kết đến trang web của tác giả  sẽ được hiển thị trên trang huy hiệu. URL phải có tiền tố http: // hoặc https: //.';
$string['imagecaption'] = 'Chú thích hình ảnh';
$string['imagecaption_help'] = 'Nếu được chỉ định, chú thích hình ảnh sẽ được hiển thị trên trang huy hiệu.';
$string['invalidurl'] = 'URL không hợp lệ';
$string['issueremail'] = 'Email';
$string['issueremail_help'] = 'Địa chỉ email liên hệ của tổ chức phát hành chứng thực.';
$string['issuername_endorsement'] = 'Tên người chứng thực';
$string['issuername_endorsement_help'] = 'Tên của người chứng thực.';
$string['issuerurl_help'] = 'Trang web của tổ chức phát hành chứng thực. URL phải có tiền tố http: // hoặc https: //.';
$string['language'] = 'Ngôn ngữ';
$string['language_help'] = 'Ngôn ngữ được sử dụng trên trang huy hiệu.';
$string['listbackpacks'] = 'Danh sách gói';
$string['localbadgesh_help'] = 'Tất cả huy hiệu đạt được trong trang web này bằng cách hoàn thành các khóa học, hoạt động khóa học, và các yêu cầu khác. Bạn có thể quản lí huy hiệu của mình ở đây bằng cách làm cho chúng công hoặc riêng tư trên trang hồ sơ của mình. Bạn có thể tải tất cả huy hiệu hoặc từng huy hiệu riêng rẽ và lưu chúng trên máy tính. Các huy hiệu được tải về có thể được thêm vào dịch vụ gói bên ngoài của bạn.';
$string['localconnectto'] = 'Để chia sẻ những huy hiệu ngoài trang web này bạn cần <a href="{$a}">kết nối gói</a>.';
$string['managebackpacks'] = 'Quản lý gói';
$string['mybackpack'] = 'Thiết lập gói của tôi';
$string['noalignment'] = 'Huy hiệu này không có bất kỳ kỹ năng hoặc tiêu chuẩn bên ngoài nào được chỉ định.';
$string['nobackpack'] = 'Không có dịch vụ gói được kết nối đến tài khoản này.<br/>';
$string['nobackpackbadgessummary'] = 'Không có huy hiệu nào trong các bộ sưu tập bạn đã chọn.';
$string['nobackpackcollectionssummary'] = 'Không có bộ sưu tập huy hiệu nào được chọn.';
$string['nobackpacks'] = 'Không có sẵn gói';
$string['nocompetencies'] = 'Không có năng lực nào được chọn.';
$string['noendorsement'] = 'Huy hiệu này không được chứng thực.';
$string['norelated'] = 'Huy hiệu này không có bất kỳ huy hiệu liên quan.';
$string['notealignment'] = 'Các kỹ năng hoặc tiêu chuẩn bên ngoài, phù hợp với huy hiệu, có thể được chỉ định. Mọi kỹ năng hoặc tiêu chuẩn bên ngoài đều được hiển 
thị trên trang huy hiệu.';
$string['noteendorsement'] = 'Sự xác nhận từ bên thứ ba có thể được sử dụng để tăng thêm giá trị cho huy hiệu. Ví dụ: huy hiệu do giáo viên cấp có thể được nhà trường xác nhận hoặc huy hiệu do cơ quan trao giải địa phương cấp có thể được cơ quan trao giải quốc gia xác nhận.';
$string['noterelated'] = 'Các huy hiệu có kết nối có thể được đánh dấu là có liên quan. Ví dụ: các huy hiệu có cùng tiêu chí được hiển thị bằng các ngôn ngữ khác 
nhau có thể được đánh dấu là có liên quan. Mọi huy hiệu liên quan đều được hiển thị trên trang huy hiệu.';
$string['openbadgesv1'] = 'Mở huy hiệu v1.0';
$string['openbadgesv2'] = 'Mở huy hiệu v2.0';
$string['personaconnection_help'] = 'Persona là hệ thống nhận diện bản thân trên web, sử dụng địa chỉ email mà bạn sỡ hữu. Gói Open Badges sử dụng Persona làm hệ thống đăng nhập, vì vậy để có thể kết nối gói bạn cần tài khoản Persona. Để biết thêm thông tin về Persona xem <a href="https://login.persona.org/about">https://login.persona.org/about</a>.';
$string['preferences'] = 'Tùy chọn huy hiệu';
$string['privacy:metadata:backpack'] = 'Kỷ lục về gói của người dùng';
$string['privacy:metadata:backpack:backpackuid'] = 'Mã nhận dạng duy nhất của gói';
$string['privacy:metadata:backpack:email'] = 'Email được liên kết với gói';
$string['privacy:metadata:backpack:externalbackpackid'] = 'ID của gói';
$string['privacy:metadata:backpack:userid'] = 'ID của người dùng có gói đó';
$string['privacy:metadata:badge'] = 'Một bộ sưu tập các huy hiệu';
$string['privacy:metadata:badge:timecreated'] = 'Thời điểm huy hiệu được tạo';
$string['privacy:metadata:badge:timemodified'] = 'Thời điểm huy hiệu được sửa đổi lần cuối';
$string['privacy:metadata:badge:usercreated'] = 'ID của người dùng đã tạo huy hiệu';
$string['privacy:metadata:badge:usermodified'] = 'ID của người dùng đã sửa đổi huy hiệu';
$string['privacy:metadata:criteriamet'] = 'Tập hợp các tiêu chí đã được đáp ứng';
$string['privacy:metadata:criteriamet:datemet'] = 'Ngày đáp ứng các tiêu chí';
$string['privacy:metadata:criteriamet:userid'] = 'ID của người dùng đã đáp ứng tiêu chí';
$string['privacy:metadata:external:backpacks'] = 'Thông tin được chia sẻ khi người dùng gửi huy hiệu của họ vào gói bên ngoài';
$string['privacy:metadata:external:backpacks:badge'] = 'Tên của huy hiệu';
$string['privacy:metadata:external:backpacks:description'] = 'Mô tả của huy hiệu';
$string['privacy:metadata:external:backpacks:image'] = 'Hình ảnh của huy hiệu';
$string['privacy:metadata:external:backpacks:issuer'] = 'Một số thông tin về công ty phát hành';
$string['privacy:metadata:external:backpacks:url'] = 'URL Moodle nơi có thể nhìn thấy thông tin huy hiệu đã cấp';
$string['privacy:metadata:issued'] = 'Kỷ lục về các huy hiệu được trao';
$string['privacy:metadata:issued:dateexpire'] = 'Ngày mà huy hiệu hết hạn';
$string['privacy:metadata:issued:dateissued'] = 'Ngày trao giải';
$string['privacy:metadata:issued:userid'] = 'ID của người dùng được tặng huy hiệu';
$string['privacy:metadata:manualaward'] = 'Kỷ lục về giải thưởng thủ công';
$string['privacy:metadata:manualaward:datemet'] = 'Ngày người dùng được trao huy hiệu';
$string['privacy:metadata:manualaward:issuerid'] = 'ID của người dùng được trao huy hiệu';
$string['privacy:metadata:manualaward:issuerrole'] = 'Vai trò của người dùng được trao huy hiệu';
$string['privacy:metadata:manualaward:recipientid'] = 'ID của người dùng được trao huy hiệu theo cách thủ công';
$string['relatedbages'] = 'Huy hiệu liên quan';
$string['requiredbadge'] = 'Ít nhất một huy hiệu phải được thêm vào tiêu chí huy hiệu.';
$string['requiredcohort'] = 'Ít nhất một nhóm thuần tập phải được thêm vào tiêu chí nhóm.';
$string['requiredcompetency'] = 'Cần thêm ít nhất một năng lực vào tiêu chí năng lực.';
$string['revoke'] = 'Thu hồi huy hiệu';
$string['selectgroup_end'] = 'Chỉ các bộ sưu tập công công được hiển thị, <a href="http://backpack.openbadges.org">xem gói của bạn</a> để tạo thêm các bộ sưu tập công cộng.';
$string['selectgroup_start'] = 'Chọn các bộ sưu tập từ gói của bạn để hiển thị trên trang này:';
$string['sitebackpack'] = 'Gói hoạt động bên ngoài';
$string['sitebackpack_help'] = 'Gói bên ngoài mà người dùng có thể kết nối từ trang web này. Lưu ý rằng việc thay đổi cài đặt này sau khi người dùng đã kết nối gói của 
họ sẽ yêu cầu mỗi người dùng truy cập trang cài đặt gói của họ và ngắt kết nối sau đó kết nối lại.';
$string['sitebackpackverify'] = 'Kết nối gói';
$string['sitebackpackwarning'] = 'Không thể kết nối với gói. <br/> <br/> Kiểm tra xem cài đặt quản trị "Địa chỉ email của tổ chức phát hành huy hiệu" có phải là email hợp lệ cho tài khoản trên trang web gói không. <br/> <br/> Kiểm tra xem "mật khẩu của tổ chức phát hành huy hiệu" trên <a href="{$a->url} "> trang cài đặt gói trang web </a> có phải là mật khẩu chính xác cho tài khoản trên trang web gói. <br/> <br/> Gói đã trả lại: "{$a->warning}"';
$string['targetcode'] = 'Mã';
$string['targetcode_help'] = 'Một mã định danh chuỗi duy nhất để tham chiếu kỹ năng hoặc tiêu chuẩn bên ngoài trong khuôn khổ của nó.';
$string['targetdescription'] = 'Mô tả';
$string['targetdescription_help'] = 'Mô tả ngắn gọn về kỹ năng hoặc tiêu chuẩn bên ngoài.';
$string['targetframework'] = 'Khuôn khổ';
$string['targetframework_help'] = 'Tên của kỹ năng bên ngoài hoặc khung tiêu chuẩn.';
$string['targetname'] = 'Tên';
$string['targetname_help'] = 'Kỹ năng hoặc tiêu chuẩn bên ngoài phù hợp với huy hiệu.';
$string['targeturl'] = 'URL';
$string['targeturl_help'] = 'Liên kết đến trang mô tả kỹ năng hoặc tiêu chuẩn bên ngoài. URL phải có tiền tố http: // hoặc https: //.';
$string['type'] = 'Kiểu';
$string['version'] = 'Phiên bản';
$string['version_help'] = 'Trường phiên bản có thể được sử dụng để theo dõi sự phát triển của huy hiệu. Nếu được chỉ định, phiên bản được hiển thị trên trang huy 
hiệu.';
