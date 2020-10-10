                                 .-..-.
   _____                         | || |
  /____/-.---_  .---.  .---.  .-.| || | .---.
  | |  _   _  |/  _  \/  _  \/  _  || |/  __ \
  * | | | | | || |_| || |_| || |_| || || |___/
    |_| |_| |_|\_____/\_____/\_____||_|\_____)


=== 3.7 ===
- [build] = bản build của source hiện tại
- Files sql script chứa ở thư mục: 'moodledata_dev/scripts/..
- Files ngôn ngữ chứa ở thư mục: 'moodledata_dev/languages/..

** Lưu ý **
[SQL SCRIPT]
- Trường hợp clone từ git khi cài đặt xong phải chạy script chứa ở thư mục: 'moodledata_dev/scripts/modifed_moodle_script_[bản build].sql' ở MSSQL
- Trường hợp upbuild kiểm tra bản build(trước khi upbuild) so với bản build(sau khi upbuild) của sql script. 
  + Nếu khác thì phải chạy PHẦN script theo bản build(sau khi upbuild) đã được đánh dấu trong script
  + Nếu trùng thì cần chạy mới script
[LANGUAGE]
- Trường hợp clone từ git khi cài đặt xong phải lấy file ngôn ngữ chứa ở thư mục: 'moodledata_dev/scripts/lang_[bản build].rar' giải nén và bỏ vào 'moodledata'
- Trường hợp upbuild kiểm tra bản build(trước khi upbuild) so với bản build(sau khi upbuild) của file ngôn ngữ. 
  + Nếu khác thì phải thêm file ngôn ngữ mới vào moodledata
  + Nếu trùng thì không cần

*** Bản build: 09112020 ***

- Cải thiện UI/UX

- Cải thiện ngôn ngữ của hệ thống với: Tiếng Việt, Tiếng Anh

- Cải thiện màn hình tìm khóa học
 + Hiện thị cây danh mục bên trái màn hình
 + Tìm kiếm theo tên giáo viên, cây danh mục và tên khóa học.

- Thêm mới chức năng ẩn các tab ở phần quản trị hệ thống

- Thêm mới chức năng xem file pdf, xls, docs trực tiếp trên browser(chrome, ..)
 + Lưu ý: Chỉ áp dụng với DOMIAN có SSL và phải cập nhật script mới và chạy trên Database
Cách dùng:
B1: Add module file vào khóa học sau đó phần giao diện chọn loại (view file on browsers)
B2: Sau khi add thành công nhân vào file sẽ hiện popup để xem. Có thể download nhấn vào button download trên popup

- Thêm mới chức năng ràng buộc thời gian để hoàn thành Modules với:
  + Module Resource(Book, File)

- Thêm mới chức năng focus mode trong khóa học icon bên dưới cùng bên phải:
 + Thay đổi chức năng xem khóa học trên giao diện trang khóa học, chỉ xuất hiện những nội dung cho người dùng học
 + Có menu chuyển bài học nhanh, bài trước, bài sau,..etc..

- Tích hợp HRM phân hệ đào tạo, cây phòng ban

- Tích hợp EBM phân hệ đào tạo

- Fix Bugs..