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
 * @subpackage install
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['admindirsettinghead'] = 'Cài đặt thư mục quản trị...';
$string['admindirsettingsub'] = 'Một số rất ít webiste sử dụng / admin làm URL đặc biệt để bạn truy cập bảng điều khiển hoặc thứ gì đó. Thật không may, điều này xung đột với vị trí tiêu chuẩn cho các trang quản trị Moodle. Bạn có thể sửa lỗi này bằng cách đổi tên thư mục quản trị trong cài đặt của mình và đặt tên mới đó ở đây. Ví dụ: <br /> <br /> <b> moodleadmin </b> <br /> <br /> Điều này sẽ sửa các liên kết quản trị trong Moodle.';
$string['chooselanguagehead'] = 'Chọn một ngôn ngữ';
$string['chooselanguagesub'] = 'Vui lòng chọn một ngôn ngữ để cài đặt. Ngôn ngữ này cũng sẽ được sử dụng làm ngôn ngữ mặc định cho trang web, mặc dù nó có thể được thay đổi sau đó.';
$string['cliadminemail'] = 'Địa chỉ email người dùng quản trị mới';
$string['cliadminpassword'] = 'Mật khẩu người dùng quản trị mới';
$string['cliadminusername'] = 'Tên người dùng tài khoản quản trị viên';
$string['clialreadyconfigured'] = 'Tệp cấu hình config.php đã tồn tại. Vui lòng sử dụng admin/cli/install_database.php để cài đặt Moodle cho trang web này.';
$string['clialreadyinstalled'] = 'Tệp cấu hình config.php đã tồn tại. Vui lòng sử dụng admin/cli/install_database.php để nâng cấp Moodle cho trang web này.';
$string['cliinstallfinished'] = 'Cài đặt hoàn tất thành công.';
$string['cliinstallheader'] = 'Chương trình cài đặt dòng lệnh Moodle {$a}';
$string['climustagreelicense'] = 'Ở chế độ không tương tác, bạn phải đồng ý cấp phép bằng cách chỉ định - tùy chọn cấp phép miễn phí';
$string['cliskipdatabase'] = 'Bỏ qua cài đặt cơ sở dữ liệu.';
$string['clitablesexist'] = 'Các bảng cơ sở dữ liệu đã được tạo; Cài đặt CLI không thể tiếp tục.';
$string['compatibilitysettingshead'] = 'Kiểm tra cài đặt PHP của bạn ...';
$string['compatibilitysettingssub'] = 'Máy chủ của bạn phải vượt qua tất cả các bài kiểm tra này để làm cho Moodle chạy bình thường';
$string['configurationcompletehead'] = 'Cấu hình đã hoàn thành';
$string['configurationcompletesub'] = 'Moodle đã cố gắng lưu cấu hình của bạn vào một tệp trong thư mục gốc của cài đặt Moodle của bạn.';
$string['databasehead'] = 'Cài đặt cơ sở dữ liệu';
$string['databasehost'] = 'Máy chủ cơ sở dữ liệu';
$string['databasename'] = 'Tên cơ sở dữ liệu';
$string['databasepass'] = 'Mật khẩu cơ sở dữ liệu';
$string['databaseport'] = 'Cổng cơ sở dữ liệu';
$string['databasesocket'] = 'Ổ cắm Unix';
$string['databasetypehead'] = 'Chọn trình điều khiển cơ sở dữ liệu';
$string['databasetypesub'] = 'Moodle hỗ trợ một số loại máy chủ cơ sở dữ liệu. Vui lòng liên hệ với quản trị viên máy chủ nếu bạn không biết sử dụng loại nào.';
$string['databaseuser'] = 'Người dùng cơ sở dữ liệu';
$string['datarootpermission'] = 'Quyền đối với thư mục dữ liệu';
$string['datarootpublicerror'] = '\'Thư mục dữ liệu\' bạn chỉ định có thể truy cập trực tiếp qua web, bạn phải sử dụng thư mục khác.';
$string['dbport'] = 'Cổng';
$string['dbtype'] = 'Kiểu';
$string['directorysettingshead'] = 'Vui lòng xác nhận các vị trí cài đặt Moodle này';
$string['directorysettingssub'] = '<b> Địa chỉ web: </b> Chỉ định địa chỉ web đầy đủ nơi Moodle sẽ được truy cập. Nếu trang web của bạn có thể truy cập được qua nhiều URL thì hãy chọn URL tự nhiên nhất mà học viên của bạn sẽ sử dụng. Không bao gồm một dấu gạch chéo. <br /> <br /> <b> Thư mục Moodle: </b> Chỉ định đường dẫn thư mục đầy đủ đến phần cài đặt này Đảm bảo rằng chữ hoa / thường là đúng. <br /> <br /> <b> Thư mục dữ liệu: </b> Bạn cần một nơi mà Moodle có thể lưu các tệp đã tải lên. Thư mục này phải được người dùng máy chủ web đọc được VÀ CÓ THỂ VIẾT được (thường là \'không ai cả\' hoặc \'apache\'), nhưng không được truy cập trực tiếp qua web. Trình cài đặt sẽ cố gắng tạo nó nếu không tồn tại.';
$string['downloadlanguagebutton'] = 'Tải xuống & quot; {$a} & quot; gói ngôn ngữ';
$string['downloadlanguagehead'] = 'Tải xuống gói ngôn ngữ';
$string['downloadlanguagenotneeded'] = 'Bạn có thể tiếp tục quá trình cài đặt bằng gói ngôn ngữ mặc định, "{$a}".';
$string['downloadlanguagesub'] = 'Bây giờ bạn có tùy chọn tải xuống gói ngôn ngữ và tiếp tục quá trình cài đặt bằng ngôn ngữ này. <br /> <br /> Nếu bạn không thể tải xuống gói ngôn ngữ, quá trình cài đặt sẽ tiếp tục bằng tiếng Anh. (Sau khi quá trình cài đặt hoàn tất, bạn sẽ có cơ hội tải xuống và cài đặt các gói ngôn ngữ bổ sung.)';
$string['doyouagree'] = 'Bạn có đồng ý không ? (có/không):';
$string['environmenthead'] = 'Kiểm tra môi trường của bạn ...';
$string['environmentsub'] = 'Chúng tôi đang kiểm tra xem các thành phần khác nhau trong hệ thống của bạn có đáp ứng các yêu cầu hệ thống hay không';
$string['environmentsub2'] = 'Mỗi bản phát hành Moodle có một số yêu cầu phiên bản PHP tối thiểu và một số phần mở rộng(extension) PHP bắt buộc. Kiểm tra toàn bộ môi trường được thực hiện trước mỗi lần cài đặt và nâng cấp. Vui lòng liên hệ với quản trị viên máy chủ nếu bạn không biết cách cài đặt phiên bản mới hoặc kích hoạt các phần mở rộng PHP.';
$string['errorsinenvironment'] = 'Kiểm tra môi trường không thành công!';
$string['inputdatadirectory'] = 'Thư mục dữ liệu:';
$string['inputwebadress'] = 'Địa chỉ web :';
$string['inputwebdirectory'] = 'Thư mục Moodle:';
$string['langdownloaderror'] = 'Rất tiếc, không thể tải xuống ngôn ngữ "{$a}". Quá trình cài đặt sẽ tiếp tục bằng tiếng Anh.';
$string['langdownloadok'] = 'Ngôn ngữ "{$a}" đã được cài đặt thành công. Quá trình cài đặt sẽ tiếp tục bằng ngôn ngữ này.';
$string['mysqliextensionisnotpresentinphp'] = 'PHP chưa được định cấu hình đúng với phần mở rộng MySQLi để nó giao tiếp với MySQL. Vui lòng kiểm tra tệp php.ini của bạn hoặc biên dịch lại PHP.';
$string['nativemariadbhelp'] = '<p> Cơ sở dữ liệu là nơi lưu trữ hầu hết các cài đặt và dữ liệu Moodle và phải được định cấu hình tại đây. </p> <p> Tên cơ sở dữ liệu, tên người dùng và mật khẩu là các trường bắt buộc; tiền tố bảng là tùy chọn. </p> <p> Tên cơ sở dữ liệu chỉ có thể chứa các ký tự chữ và số, đô la ($) và dấu gạch dưới (_). </p> <p> Nếu cơ sở dữ liệu hiện không tồn tại và người dùng bạn chỉ định có quyền, Moodle sẽ cố gắng tạo cơ sở dữ liệu mới với các quyền và cài đặt chính xác. </p> <p> Trình điều khiển này không tương thích với công cụ MyISAM cũ. </p>';
$string['nativemysqlihelp'] = '<p> Cơ sở dữ liệu là nơi lưu trữ hầu hết các cài đặt và dữ liệu Moodle và phải được định cấu hình tại đây. </p> <p> Tên cơ sở dữ liệu, tên người dùng và mật khẩu là các trường bắt buộc; tiền tố bảng là tùy chọn. </p> <p> Tên cơ sở dữ liệu chỉ có thể chứa các ký tự chữ và số, đô la ($) và dấu gạch dưới (_). </p> <p> Nếu cơ sở dữ liệu hiện không tồn tại và người dùng bạn chỉ định có quyền, Moodle sẽ cố gắng tạo cơ sở dữ liệu mới với các quyền và cài đặt chính xác. </p>';
$string['nativeocihelp'] = 'Bây giờ bạn cần cấu hình cơ sở dữ liệu nơi hầu hết dữ liệu Moodle sẽ được lưu trữ. Cơ sở dữ liệu này phải đã được tạo và một tên người dùng và mật khẩu được tạo để truy cập nó. Tiền tố bảng là bắt buộc.';
$string['nativepgsqlhelp'] = '<p> Cơ sở dữ liệu là nơi lưu trữ hầu hết các cài đặt và dữ liệu Moodle và phải được định cấu hình tại đây. </p> <p> Tên cơ sở dữ liệu, tên người dùng, mật khẩu và tiền tố bảng là các trường bắt buộc. </p> <p> Cơ sở dữ liệu phải tồn tại và người dùng phải có quyền truy cập để đọc và ghi vào nó. </p>';
$string['nativesqlsrvhelp'] = 'Bây giờ bạn cần cấu hình cơ sở dữ liệu nơi hầu hết dữ liệu Moodle sẽ được lưu trữ. Cơ sở dữ liệu này phải đã được tạo và một tên người dùng và mật khẩu được tạo để truy cập nó. Tiền tố bảng là bắt buộc.';
$string['nativesqlsrvnodriver'] = 'Trình điều khiển Microsoft cho SQL Server cho PHP không được cài đặt hoặc không được định cấu hình đúng cách.';
$string['ociextensionisnotpresentinphp'] = 'PHP chưa được định cấu hình đúng với phần mở rộng OCI8 để nó có thể giao tiếp với Oracle. Vui lòng kiểm tra tệp php.ini của bạn hoặc biên dịch lại PHP.';
$string['paths'] = 'Đường dẫn';
$string['pathserrcreatedataroot'] = 'Trình cài đặt không thể tạo thư mục dữ liệu ({$a->dataroot}).';
$string['pathshead'] = 'Xác nhận đường dẫn';
$string['pathsrodataroot'] = 'Thư mục dataroot không thể ghi được.';
$string['pathsroparentdataroot'] = 'Thư mục mẹ ({$a->parent}) không thể ghi được. Trình cài đặt không thể tạo thư mục dữ liệu ({$a->dataroot}).';
$string['pathssubadmindir'] = 'Một số rất ít webiste sử dụng / admin làm URL đặc biệt để bạn truy cập bảng điều khiển hoặc thứ gì đó. Thật không may, điều này xung đột với vị trí tiêu chuẩn cho các trang quản trị Moodle. Bạn có thể sửa lỗi này bằng cách đổi tên thư mục quản trị trong cài đặt của mình và đặt tên mới đó ở đây. Ví dụ: <em> moodleadmin </em>. Điều này sẽ sửa chữa các liên kết quản trị trong Moodle.';
$string['pathssubdataroot'] = '<p> Một thư mục nơi Moodle sẽ lưu trữ tất cả nội dung tệp do người dùng tải lên. </p> <p> Thư mục này phải được người dùng máy chủ web đọc và ghi được (thường là \'www-data\', \'nothing\' hoặc \' apache \'). </p> <p> Nó không được truy cập trực tiếp qua web. </p> <p> Nếu thư mục hiện không tồn tại, quá trình cài đặt sẽ cố gắng tạo nó. </p>';
$string['pathssubdirroot'] = '<p> Đường dẫn đầy đủ đến thư mục chứa mã Moodle. </p>';
$string['pathssubwwwroot'] = '<p> Địa chỉ đầy đủ nơi Moodle sẽ được truy cập tức là địa chỉ mà người dùng sẽ nhập vào thanh địa chỉ của trình duyệt để truy cập Moodle. </p> <p> Không thể truy cập Moodle bằng nhiều địa chỉ. Nếu trang web của bạn có thể truy cập qua nhiều địa chỉ thì hãy chọn địa chỉ dễ nhất và thiết lập chuyển hướng vĩnh viễn cho từng địa chỉ khác. </p> <p> Nếu trang web của bạn có thể truy cập được cả từ Internet và từ mạng nội bộ (đôi khi được gọi là Intranet), sau đó sử dụng địa chỉ công cộng tại đây. </p> <p> Nếu địa chỉ hiện tại không đúng, vui lòng thay đổi URL trong thanh địa chỉ của trình duyệt và khởi động lại quá trình cài đặt. </p>';
$string['pathsunsecuredataroot'] = 'Vị trí Dataroot không an toàn';
$string['pathswrongadmindir'] = 'Thư mục quản trị viên không tồn tại';
$string['pgsqlextensionisnotpresentinphp'] = 'PHP chưa được định cấu hình đúng với phần mở rộng PGSQL để nó có thể giao tiếp với PostgreSQL. Vui lòng kiểm tra tệp php.ini của bạn hoặc biên dịch lại PHP.';
$string['phpextension'] = '{$a} phần mở rộng PHP';
$string['releasenoteslink'] = 'Để biết thông tin về phiên bản Moodle này, vui lòng xem ghi chú phát hành tại {$a}';
$string['sqliteextensionisnotpresentinphp'] = 'PHP chưa được định cấu hình đúng với phần mở rộng SQLite. Vui lòng kiểm tra tệp php.ini của bạn hoặc biên dịch lại PHP.';
$string['upgradingqtypeplugin'] = 'Nâng cấp plugin câu hỏi/loại';
$string['welcomep10'] = '{$a->installername} ({$a->installerversion})';
$string['welcomep20'] = 'Bạn thấy trang này vì bạn đã cài đặt và khởi chạy thành công gói <strong> {$a->packname} {$a->packversion} </strong> trong máy tính của mình. Xin chúc mừng!';
$string['welcomep30'] = 'Bản phát hành <strong> {$a->installername} </strong> này bao gồm các ứng dụng để tạo môi trường trong đó <strong> Moodle </strong> sẽ hoạt động, cụ thể là:';
$string['welcomep40'] = 'Gói này cũng bao gồm <strong> Moodle {$a->moodlerelease} ({$a->moodleversion}) </strong>.';
$string['welcomep50'] = 'Việc sử dụng tất cả các ứng dụng trong gói này được điều chỉnh bởi giấy phép tương ứng của chúng. Gói <strong> {$a->installername} </strong> hoàn chỉnh là <a href="https://www.opensource.org/docs/definition_plain.html"> nguồn mở </a> và được phân phối theo giấy phép <a href="https://www.gnu.org/copyleft/gpl.html"> GPL </a>.';
$string['welcomep60'] = 'Các trang sau sẽ hướng dẫn bạn qua một số bước dễ thực hiện để định cấu hình và thiết lập <strong> Moodle </strong> trên máy tính của bạn. Bạn có thể chấp nhận các cài đặt mặc định hoặc, tùy chọn, sửa đổi chúng cho phù hợp với nhu cầu của riêng bạn.';
$string['welcomep70'] = 'Nhấp vào nút "Tiếp theo" bên dưới để tiếp tục thiết lập <strong> Moodle </strong>.';
