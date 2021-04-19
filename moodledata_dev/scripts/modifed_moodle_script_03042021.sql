-- Bảng setup khoá học
CREATE TABLE mdl_course_setup
(
	id bigint NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	category bigint NOT NULL DEFAULT ((0)),
	fullname nvarchar (255) NOT NULL DEFAULT(N''),
	shortname nvarchar (255) NOT NULL DEFAULT(N''),
	--courseofposition bigint NOT NULL DEFAULT NULL,
	--courseoforgstructure bigint NOT NULL DEFAULT NULL,
	--courseofjobtitle bigint NOT NULL DEFAULT NULL,
	--pinned smallint NOT NULL DEFAULT ((0)),
	description nvarchar (max) NULL,
	usermodified bigint NULL,
	timecreated bigint NULL,
	timemodified bigint NULL
)

-- Bảng năng lực của khoá học setup
CREATE TABLE mdl_competency_coursesetup
(
	id bigint NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	coursesetup bigint NOT NULL DEFAULT ((0)),
	competencyid bigint NOT NULL DEFAULT ((0)),
	usermodified bigint NULL,
	timecreated bigint NULL,
	timemodified bigint NULL
)

-- Bảng 1 khoá học nhiều vị trí x
CREATE TABLE mdl_course_position (
	id bigint NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	course bigint NOT NULL DEFAULT ((0)),
	courseofposition bigint NOT NULL DEFAULT NULL,
	courseoforgstructure bigint NOT NULL DEFAULT NULL,
	courseofjobtitle bigint NOT NULL DEFAULT NULL,
	usermodified bigint NULL,
	timecreated bigint NULL,
	timemodified bigint NULL
)

-- Bảng tích hợp đào tạo và tuyển dụng x
CREATE TABLE mdl_test
(
	id bigint NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	usercode varchar (255) NULL,
	grade float NULL,
	result nvarchar (255) NULL,
	orgstruct_position nvarchar (255) NULL,
	quiz nvarchar (100) NULL,
	type smallint NULL,
	timestart bigint NULL
)

-- Bảng năng lực theo vị trí x
CREATE TABLE mdl_competency_position
(
	id bigint NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	competencyid bigint NOT NULL,
	positionid bigint NOT NULL,
	ordernumber nvarchar (50) NULL,
	usermodified bigint NULL,
	timecreated bigint NULL,
	timemodified bigint NULL
)

-- Bảng lưu năng lực theo vị trí và khoá học của năng lực đó x
CREATE TABLE mdl_competency_coursepositioncomp
(
	id bigint NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	competencyid bigint NOT NULL DEFAULT ((0)),
	orgpositionid bigint NOT NULL DEFAULT ((0)),
	courseid bigint NOT NULL DEFAULT ((0)),
	usermodified bigint NULL,
	timecreated bigint NULL,
	timemodified bigint NULL
)

-- Bảng Quản lý API x
CREATE TABLE mdl_local_newsvnr_api
(
	id int NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	url nvarchar (255) NOT NULL,
	method nvarchar (10) NOT NULL,
	functionapi nvarchar (50) NOT NULL,
	contenttype nvarchar (30) NULL,
	description nvarchar (255) NULL,
	visible SMALLINT NOT NULL DEFAULT 0 
)


CREATE TABLE mdl_local_newsvnr_api_detail
(
	id int NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	client_params nvarchar (50) NULL,
	server_params nvarchar (50) NULL,
	default_value nvarchar (255) NULL,
	api_id int NULL
)

CREATE TABLE mdl_local_newsvnr_api_header
(
	id int NOT NULL IDENTITY(1, 1),
	name nvarchar (20) NULL,
	value nvarchar (255) NULL,
	api_id int NULL
)

-- Bảng lưu comment trong trang chi tiết tin tức chung x
CREATE TABLE mdl_local_newsvnr_comments
(
	id int NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	content nvarchar (max)  NULL,
	createdAt bigint NULL DEFAULT ((0)),
	updatedAt bigint NULL DEFAULT ((0)),
	status varchar (10) DEFAULT ('active'),
	discussionid bigint NOT NULL,
	userid bigint NOT NULL
)

-- Bảng lưu reply trong trang chi tiết tin tức chung x
CREATE TABLE mdl_local_newsvnr_replies
(
	id int NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	content nvarchar (max) NULL,
	createdAt bigint NULL DEFAULT ((0)),
	updatedAt bigint NULL DEFAULT ((0)),
	status varchar (10) DEFAULT ('active'),
	commentid int NOT NULL,
	userid bigint NOT NULL
)

-- Bảng PB - CD - CV x
CREATE TABLE mdl_orgstructure_position
(
	id int NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	name nvarchar (100) NOT NULL,
	code nvarchar (50) NOT NULL,
	namebylaw nvarchar (255) NULL,
	jobtitleid nvarchar (100) NULL,
	orgstructureid nvarchar (100) NULL,
	description nvarchar (255) NULL,
	visible smallint NOT NULL DEFAULT ((1))
)

CREATE TABLE mdl_orgstructure_jobtitle
(
	id int NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	name nvarchar (100) NOT NULL,
	code nvarchar (50) NOT NULL,
	namebylaw nvarchar (255) NULL,
	description nvarchar (255) NULL,
	visible smallint NOT NULL DEFAULT ((1))
)

CREATE TABLE mdl_orgstructure_category
(
	id int NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	name nvarchar (200) NOT NULL,
	code nvarchar (50) NOT NULL DEFAULT (N''),
	description nvarchar (255) NULL,
	visible smallint NOT NULL DEFAULT ((1))
)

CREATE TABLE mdl_orgstructure
(
	id int NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	name nvarchar (200) NOT NULL,
	code nvarchar (50) NOT NULL,
	managerid int NULL,
	orgstructuretypeid int NOT NULL,
	parentid int NOT NULL,
	numbermargin int NULL,
	numbercurrent int NULL,
	description nvarchar (255) NULL,
	visible smallint NOT NULL DEFAULT ((1))
)
INSERT INTO mdl_orgstructure(name, code, orgstructuretypeid, parentid) VALUES ('orgstructure_parent', 'parent', 1, 0)

-- Phần update database khi đã cài đặt xong Moodle x
ALTER TABLE mdl_course ADD typeofcourse SMALLINT NOT NULL DEFAULT 0
ALTER TABLE mdl_course ADD coursesetup BIGINT NOT NULL DEFAULT 0
ALTER TABLE mdl_course ADD pinned BIGINT NOT NULL DEFAULT 0
ALTER TABLE mdl_course ADD typeclass SMALLINT NOT NULL DEFAULT 0
ALTER TABLE mdl_course ADD required SMALLINT NOT NULL DEFAULT 0
-- Thêm field vào bảng course (01/03/2020) - Tích hớp HRM x
ALTER TABLE mdl_course ADD code NVARCHAR(100) NOT NULL DEFAULT (N'')
-- Thêm filed vào bảng quiz (01/03/2020) - Tích hớp HRM/EBM x
ALTER TABLE mdl_quiz ADD code NVARCHAR(100) NOT NULL DEFAULT(N'')
-- Thêm field vào bảng mod page (05/06/2020) - Tích hợp EBM x
ALTER TABLE mdl_page ADD code NVARCHAR(100) NOT NULL DEFAULT(N'')
-- Thêm field vào bảng user (09/06/2020) - Tích hợp EBM x
ALTER TABLE mdl_user ADD typeofuser SMALLINT NOT NULL DEFAULT 0
---------------- *********** --------------
--Thêm filed vào bảng User x
ALTER TABLE mdl_user ADD usercode NVARCHAR(100) NOT NULL DEFAULT (N'')
ALTER TABLE mdl_user ADD orgpositionid BIGINT NOT NULL DEFAULT 0
-- Vinasoy: Thêm field vào bảng user (15/08/2020), dùng cho source tách - Vũ x
ALTER TABLE mdl_user ADD orgstructureid BIGINT DEFAULT 0
---------------- *********** --------------
-- Thêm filed vào bảng disscustion x
ALTER TABLE mdl_forum_discussions ADD countviews BIGINT NOT NULL DEFAULT 0

--- *** Script cho bản build version '11092020' *** ---
-- Bảng cấu hình thời tối thiểu để hoàn thành module x
CREATE TABLE mdl_course_modules_completion_rule
(
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	moduleid BIGINT NOT NULL DEFAULT 0,
	completiontimespent BIGINT NOT NULL DEFAULT 0,
	timemodified BIGINT NOT NULL DEFAULT 0,
)

-- Bảng lưu thông tin thời gian học viên đã xem được bao nhiêu thời gian trong module x
CREATE TABLE mdl_course_modules_completion_timer
(
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	completionruleid BIGINT NOT NULL DEFAULT 0,
	userid BIGINT NOT NULL DEFAULT 0,
	starttime BIGINT NOT NULL DEFAULT 0,
	lastseentime BIGINT NOT NULL DEFAULT 0,
	completed BIGINT  DEFAULT 0,
	timemodifiedoffline BIGINT DEFAULT 0,
)
--- *** Kết thúc script cho bản build version '11092020' ***--

--- *** Script cho bản build version '17102020' *** ---
-- Add table cho thư viện hệ thống x
CREATE TABLE mdl_library_folder
(
	id bigint IDENTITY(1,1) NOT NULL PRIMARY KEY,
	name nvarchar(255) NOT NULL,
	parent bigint NOT NULL DEFAULT ((0)),
	description nvarchar(255) NOT NULL,
	Contextid bigint NOT NULL DEFAULT ((0)),
	visible bigint NOT NULL DEFAULT ((1))
)
CREATE TABLE mdl_library_module
(
	id bigint IDENTITY(1,1) NOT NULL PRIMARY KEY,
	folderid bigint NOT NULL DEFAULT ((0)),
	coursemoduleid bigint NOT NULL DEFAULT ((0)),
	userid bigint NOT NULL DEFAULT ((0)),
	timecreated bigint NOT NULL DEFAULT ((0)),
	moduletype varchar(255) NULL,
	minetype varchar(255) NULL,
	filesize bigint NULL,
)
-- Bảng yêu cầu duyệt file thư viện x
CREATE TABLE mdl_files_request 
(
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	fileid BIGINT NOT NULL DEFAULT ((0)),
	status SMALLINT NOT NULL DEFAULT ((0)),
	requester BIGINT NOT NULL,
	reviewer BIGINT NULL,
	timecreated BIGINT NULL,
	timemodified BIGINT NULL,
)
--- *** Kết thúc script cho bản build version '17102020' ***--

--- *** Script cho bản build version '07112020' *** ---
-- Thêm cột phê duyệt module của trang thư viện trực tuyến x
ALTER TABLE mdl_library_module
ADD approval INT NOT NULL DEFAULT 1
--- *** Kết thúc script cho bản build version '07112020' ***--

--- *** Script cho bản build version '28112020' *** ---
-- Kỳ thi ngoài khóa x
CREATE TABLE mdl_exam
(
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	name NVARCHAR(200) NOT NULL,
	code NVARCHAR(50) NOT NULL,
	type SMALLINT NOT NULL,
	datestart BIGINT NULL,
	dateend BIGINT NULL,
	timecreated BIGINT NULL,
	timemodified BIGINT NULL,
	usercreate BIGINT NOT NULL,
	usermodified BIGINT NOT NULL,
	visible SMALLINT NOT NULL DEFAULT ((1)),
	description NVARCHAR(200) NULL
)

CREATE TABLE mdl_exam_subject
(
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	name NVARCHAR(200) NOT NULL,
	code NVARCHAR(50) NOT NULL,
	shortname NVARCHAR(100) NOT NULL,
	timecreated BIGINT NULL,
	timemodified BIGINT NULL,
	usercreate BIGINT NOT NULL,
	usermodified BIGINT NOT NULL,
	visible SMALLINT NOT NULL DEFAULT ((1)),
	description NVARCHAR(200) NULL
)
CREATE TABLE mdl_exam_subject_exam
(
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	examid BIGINT NOT NULL,
	subjectid BIGINT NOT NULL,
	timecreated BIGINT NULL,
	timemodified BIGINT NULL,
	usercreate BIGINT NOT NULL,
	usermodified BIGINT NOT NULL,
)

CREATE TABLE mdl_exam_user
(
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	examid BIGINT NOT NULL,
	userid BIGINT NOT NULL,
	enrolmethod NVARCHAR(50) NOT NULL,
	roleid BIGINT NOT NULL,
	timecreated BIGINT NULL,
	timemodified BIGINT NULL,
	usercreate BIGINT NOT NULL,
	usermodified BIGINT NOT NULL,
)
CREATE TABLE mdl_exam_quiz
(
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
	coursemoduleid BIGINT NOT NULL,
	subjectexamid BIGINT NOT NULL,
	timecreated BIGINT NULL,
	timemodified BIGINT NULL,
	usercreate BIGINT NOT NULL,
	usermodified BIGINT NOT NULL,
)
--- *** Kết thúc script cho bản build version '28112020' ***--

--- *** Script cho bản build version '06032021' *** ---
-- Phân quyền thư viện x
create table mdl_library_folder_permissions (
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
    permission varchar(255) NOT NULL,
    folderlibraryid BIGINT NOT NULL,
	timecreated BIGINT NOT NULL
)
create table mdl_library_user_permissions (
	id BIGINT NOT NULL IDENTITY(1, 1) PRIMARY KEY,
    permissionid BIGINT NOT NULL,
    positionid BIGINT NULL,
	userscope BIGINT NOT NULL,
	timecreated BIGINT NOT NULL
)
--- *** Kết thúc script cho bản build version '06032021' ***--

--- *** Script cho bản build version '03042021' *** ---
-- Thêm field level cho câu hỏi
ALTER TABLE mdl_question ADD level NVARCHAR(50) DEFAULT(N'default')
--- *** Kết thúc script cho bản build version '03042021' ***--

--- *** Script cho bản build version '12042021' *** ---
-- Thêm field size hình ảnh cho câu hỏi
ALTER TABLE mdl_question ADD imgwidth NVARCHAR(50) DEFAULT(N'default')
ALTER TABLE mdl_question ADD imgheight NVARCHAR(50) DEFAULT(N'default')
--- *** Kết thúc script cho bản build version '12042021' ***--