                                 .-..-.
   _____                         | || |
  /____/-.---_  .---.  .---.  .-.| || | .---.
  | |  _   _  |/  _  \/  _  \/  _  || |/  __ \
  * | | | | | || |_| || |_| || |_| || || |___/
    |_| |_| |_|\_____/\_____/\_____||_|\_____)

Moodle - the world's open source learning platform

Moodle <https://moodle.org> is a learning platform designed to provide
educators, administrators and learners with a single robust, secure and
integrated system to create personalised learning environments.

You can download Moodle <https://download.moodle.org> and run it on your own
web server, ask one of our Moodle Partners <https://moodle.com/partners/> to
assist you, or have a MoodleCloud site <https://moodle.com/cloud/> set up for
you.

Moodle is widely used around the world by universities, schools, companies and
all manner of organisations and individuals.

Moodle is provided freely as open source software, under the GNU General Public
License <https://docs.moodle.org/dev/License>.

Moodle is written in PHP and JavaScript and uses an SQL database for storing
the data.

See <https://docs.moodle.org> for details of Moodle's many features.


=== 3.7 ===
- [version] = version của source hiện tại
- Files sql script chứa ở thư mục: 'moodledata_dev/scripts/..
- Files ngôn ngữ chứa ở thư mục: 'moodledata_dev/languages/..

** Lưu ý **
[SQL SCRIPT]
- Trường hợp clone từ git khi cài đặt xong phải chạy script chứa ở thư mục: 'moodledata_dev/scripts/modifed_moodle_script_[version].sql' ở MSSQL
- Trường hợp upbuild kiểm tra version(trước khi upbuild) so với version(sau khi upbuild) của sql script. 
  + Nếu khác thì phải chạy PHẦN script theo version(sau khi upbuild) đã được đánh dấu trong script
  + Nếu trùng thì cần chạy mới script
[LANGUAGE]
- Trường hợp clone từ git khi cài đặt xong phải lấy file ngôn ngữ chứa ở thư mục: 'moodledata_dev/scripts/lang_[version].rar' giải nén và bỏ vào 'moodledata'
- Trường hợp upbuild kiểm tra version(trước khi upbuild) so với version(sau khi upbuild) của file ngôn ngữ. 
  + Nếu khác thì phải thêm file ngôn ngữ mới vào moodledata
  + Nếu trùng thì không cần

*** Version: 2019052002.12
-- Ngày 30/07
- Chức năng xem file pdf, xls, docs trực tiếp trên browser(chrome, ..) chỉ áp dụng trên multitopic format course
Cách dùng:
B1: Add module file vào khóa học sau đó phần giao diện chọn loại (view file on browsers)
B2: Sau khi add thành công nhân vào file sẽ hiện popup để xem. Có thể download nhấn vào button download trên popup
- Chức năng focus mode trong khóa học icon bên dưới cùng bên phải:
 + Thay đổi chức năng xem khóa học trên giao diện trang khóa học, chỉ xuất hiện những nội dung cho người dùng học
 + Có menu chuyển bài học nhanh, bài trước, bài sau,..etc..
