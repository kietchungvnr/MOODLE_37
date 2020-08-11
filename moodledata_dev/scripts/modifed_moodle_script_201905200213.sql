--- *** Script cho bản build version '2019052002.12' ***--
-- Bảng setup khoá học
CREATE TABLE mdl_course_setup
(
	[id] [bigint] NOT NULL IDENTITY(1, 1),
	[category] [bigint] NOT NULL DEFAULT ((0)),
	[fullname] [nvarchar] (255) NOT NULL DEFAULT(N''),
	[shortname] [nvarchar] (255) NOT NULL DEFAULT(N''),
	--[courseofposition] [bigint] NOT NULL DEFAULT NULL,
	--[courseoforgstructure] [bigint] NOT NULL DEFAULT NULL,
	--[courseofjobtitle] [bigint] NOT NULL DEFAULT NULL,
	--[pinned] [smallint] NOT NULL DEFAULT ((0)),
	[description] [nvarchar] (max) NULL,
	[usermodified] [bigint] NULL,
	[timecreated] [bigint] NULL,
	[timemodified] [bigint] NULL
)

-- Bảng năng lực của khoá học setup
CREATE TABLE mdl_competency_coursesetup
(
	[id] [bigint] NOT NULL IDENTITY(1, 1),
	[coursesetup] [bigint] NOT NULL DEFAULT ((0)),
	[competencyid] [bigint] NOT NULL DEFAULT ((0)),
	[usermodified] [bigint] NULL,
	[timecreated] [bigint] NULL,
	[timemodified] [bigint] NULL
)

-- Bảng 1 khoá học nhiều vị trí
CREATE TABLE mdl_course_position (
	[id] [bigint] NOT NULL IDENTITY(1, 1),
	[course] [bigint] NOT NULL DEFAULT ((0)),
	[courseofposition] [bigint] NOT NULL DEFAULT NULL,
	[courseoforgstructure] [bigint] NOT NULL DEFAULT NULL,
	[courseofjobtitle] [bigint] NOT NULL DEFAULT NULL,
	[usermodified] [bigint] NULL,
	[timecreated] [bigint] NULL,
	[timemodified] [bigint] NULL
)

-- Bảng tích hợp đào tạo và tuyển dụng
CREATE TABLE mdl_test
(
	[id] [bigint] NOT NULL IDENTITY(1, 1),
	[usercode] [varchar] (255) NULL,
	[grade] [float] NULL,
	[result] [nvarchar] (255) NULL,
	[orgstruct_position] [nvarchar] (255) NULL,
	[quiz] [nvarchar] (100) NULL,
	[type] [smallint] NULL,
	[timestart] [bigint] NULL
)

-- Bảng năng lực theo vị trí
CREATE TABLE [dbo].[mdl_competency_position]
(
	[id] [bigint] NOT NULL IDENTITY(1, 1),
	[competencyid] [bigint] NOT NULL,
	[positionid] [bigint] NOT NULL,
	[ordernumber] [nvarchar] (50) NULL,
	[usermodified] [bigint] NULL,
	[timecreated] [bigint] NULL,
	[timemodified] [bigint] NULL
)

-- Bảng lưu năng lực theo vị trí và khoá học của năng lực đó
CREATE TABLE mdl_competency_coursepositioncomp
(
	[id] [bigint] NOT NULL IDENTITY(1, 1),
	[competencyid] [bigint] NOT NULL DEFAULT ((0)),
	[orgpositionid] [bigint] NOT NULL DEFAULT ((0)),
	[courseid] [bigint] NOT NULL DEFAULT ((0)),
	[usermodified] [bigint] NULL,
	[timecreated] [bigint] NULL,
	[timemodified] [bigint] NULL
)

-- Bảng Quản lý API
CREATE TABLE [dbo].[mdl_local_newsvnr_api]
(
	[id] [int] NOT NULL IDENTITY(1, 1),
	[url] [nvarchar] (255) NOT NULL,
	[method] [nvarchar] (10) NOT NULL,
	[functionapi] [nvarchar] (50) NOT NULL,
	[contenttype] [nvarchar] (30) NULL,
	[description] [nvarchar] (255) NULL
)


CREATE TABLE [dbo].[mdl_local_newsvnr_api_detail]
(
	[id] [int] NOT NULL IDENTITY(1, 1),
	[client_params] [nvarchar] (50) NULL,
	[server_params] [nvarchar] (50) NULL,
	[default_value] [nvarchar] (255) NULL,
	[api_id] [int] NULL
)

CREATE TABLE [dbo].[mdl_local_newsvnr_api_header]
(
	[id] [int] NOT NULL IDENTITY(1, 1),
	[name] [nvarchar] (20) NULL,
	[value] [nvarchar] (255) NULL,
	[api_id] [int] NULL
)

-- Bảng lưu comment trong trang chi tiết tin tức chung
CREATE TABLE [dbo].[mdl_local_newsvnr_comments]
(
	[id] [int] NOT NULL IDENTITY(1, 1),
	[content] [nvarchar] (max)  NULL,
	[createdAt] [bigint] NULL DEFAULT ((0)),
	[updatedAt] [bigint] NULL DEFAULT ((0)),
	[status] [varchar] (10) DEFAULT ('active'),
	[discussionid] [bigint] NOT NULL,
	[userid] [bigint] NOT NULL
)

-- Bảng lưu reply trong trang chi tiết tin tức chung
CREATE TABLE [dbo].[mdl_local_newsvnr_replies]
(
	[id] [int] NOT NULL IDENTITY(1, 1),
	[content] [nvarchar] (max) NULL,
	[createdAt] [bigint] NULL DEFAULT ((0)),
	[updatedAt] [bigint] NULL DEFAULT ((0)),
	[status] [varchar] (10) DEFAULT ('active'),
	[commentid] [int] NOT NULL,
	[userid] [bigint] NOT NULL
)

-- Bảng PB - CD - CV
CREATE TABLE [mdl_orgstructure_position]
(
	[id] [int] NOT NULL IDENTITY(1, 1),
	[name] [nvarchar] (100) NOT NULL,
	[code] [nvarchar] (50) NOT NULL,
	[namebylaw] [nvarchar] (255) NULL,
	[jobtitleid] [nvarchar] (100) NULL,
	[orgstructureid] [nvarchar] (100) NULL,
	[description] [nvarchar] (255) NULL,
	[visible] [smallint] NOT NULL DEFAULT ((1))
)

CREATE TABLE [mdl_orgstructure_jobtitle]
(
	[id] [int] NOT NULL IDENTITY(1, 1),
	[name] [nvarchar] (100) NOT NULL,
	[code] [nvarchar] (50) NOT NULL,
	[namebylaw] [nvarchar] (255) NULL,
	[description] [nvarchar] (255) NULL,
	[visible] [smallint] NOT NULL DEFAULT ((1))
)

CREATE TABLE [mdl_orgstructure_category]
(
	[id] [int] NOT NULL IDENTITY(1, 1),
	[name] [nvarchar] (200) NOT NULL,
	[code] [nvarchar] (50) NOT NULL DEFAULT (N''),
	[description] [nvarchar] (255) NULL,
	[visible] [smallint] NOT NULL DEFAULT ((1))
)

CREATE TABLE [mdl_orgstructure]
(
	[id] [int] NOT NULL IDENTITY(1, 1),
	[name] [nvarchar] (200) NOT NULL,
	[code] [nvarchar] (50) NOT NULL,
	[managerid] [int] NULL,
	[orgstructuretypeid] [int] NOT NULL,
	[parentid] [int] NOT NULL,
	[numbermargin] [int] NULL,
	[numbercurrent] [int] NULL,
	[description] [nvarchar] (255) NULL,
	[visible] [smallint] NOT NULL DEFAULT ((1))
)
INSERT INTO mdl_orgstructure(name, code, orgstructuretypeid, parentid) VALUES ('orgstructure_parent', 'parent', 1, 0)

-- Phần update database khi đã cài đặt xong Moodle
ALTER TABLE mdl_course ADD [typeofcourse] SMALLINT NOT NULL DEFAULT 0
ALTER TABLE mdl_course ADD [coursesetup] BIGINT NOT NULL DEFAULT 0
ALTER TABLE mdl_course ADD pinned BIGINT NOT NULL DEFAULT 0
ALTER TABLE mdl_course ADD [typeclass] SMALLINT NOT NULL DEFAULT 0
ALTER TABLE mdl_course ADD [required] SMALLINT NOT NULL DEFAULT 0
-- Thêm field vào bảng course (01/03/2020) - Tích hớp HRM
ALTER TABLE mdl_course ADD code NVARCHAR(100) NOT NULL DEFAULT (N'')
-- Thêm filed vào bảng quiz (01/03/2020) - Tích hớp HRM
ALTER TABLE mdl_quiz ADD code NVARCHAR(100) NOT NULL DEFAULT(N'')
-- Thêm field vào bảng mod page (05/06/2020) - Tích hợp EBM
ALTER TABLE mdl_page ADD code NVARCHAR(100) NOT NULL DEFAULT(N'')
-- Thêm field vào bảng user (09/06/2020) - Tích hợp EBM
ALTER TABLE mdl_user ADD typeofuser SMALLINT NOT NULL DEFAULT 0
---------------- *********** --------------
--Thêm filed vào bảng User
ALTER TABLE mdl_user ADD usercode NVARCHAR(100) NOT NULL DEFAULT (N'')
ALTER TABLE mdl_user ADD orgpositionid BIGINT NOT NULL DEFAULT 0
---------------- *********** --------------
-- Thêm filed vào bảng disscustion
ALTER TABLE mdl_forum_discussions ADD countviews BIGINT NOT NULL DEFAULT 0
-- Thêm field vào bảng local_newsvnr_api (26/06/2020) - Thắng
ALTER TABLE mdl_local_newsvnr_api ADD visible SMALLINT NOT NULL DEFAULT 0
--- *** Kết thúc script cho bản build version '2019052002.12' ***--

--- *** Script cho bản build version '2019052002.13' *** ---
-- Bảng cấu hình thời tối thiểu để hoàn thành module
CREATE TABLE mdl_course_modules_completion_rule
(
	[id] BIGINT NOT NULL IDENTITY(1, 1),
	moduleid BIGINT NOT NULL DEFAULT 0,
	completiontimespent BIGINT NOT NULL DEFAULT 0,
	timemodified BIGINT NOT NULL DEFAULT 0,
)

-- Bảng lưu thông tin thời gian học viên đã xem được bao nhiêu thời gian trong module
CREATE TABLE mdl_course_modules_completion_timer
(
	[id] BIGINT NOT NULL IDENTITY(1, 1),
	completionruleid BIGINT NOT NULL DEFAULT 0,
	userid BIGINT NOT NULL DEFAULT 0,
	starttime BIGINT NOT NULL DEFAULT 0,
	lastseentime BIGINT NOT NULL DEFAULT 0,
	completed BIGINT  DEFAULT 0,
	timemodifiedoffline BIGINT DEFAULT 0,
)
--- *** Kết thúc script cho bản build version '2019052002.13' ***--



