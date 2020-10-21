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
 * Version details
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package local_newsvnr
 * @copyright 2019 VnResource
 * @author   Le Thanh Vu
 **/

define('AJAX_SCRIPT', false);

require_once '../config.php';
require_once $CFG->dirroot . '/course/lib.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_once $CFG->dirroot . '/course/ajax/pagination_course.class.php';
use theme_moove\util\theme_settings;
use \core_course\core_course_list_element;

require_login();

global $CFG, $PAGE, $USER, $OUTPUT, $DB, $COURSE;
$id       = optional_param('id', 0, PARAM_INT);
$page     = optional_param('page', 0, PARAM_INT);
$keycourse  = optional_param('keyword', "", PARAM_TEXT);
$teacher  = optional_param('teacher', "", PARAM_TEXT);
$category = optional_param('category', "", PARAM_TEXT);
$filter   = optional_param('filter', "", PARAM_TEXT);
$PAGE->set_context(context_system::instance());
$theme_settings = new theme_settings();
$params = [];
$params['id'] = $id;
$params['page'] = $page;
$params['pagetake'] = $pagetake;
$params['keycourse'] = $keycourse;
$params['teacher'] = $teacher;
$params['category'] = $category;
$params['filter'] = $filter;
$params['id'] = $id;
///xử lý phân trang///
$perPage        = new PerPage();
$pagetake       = $perPage->perpageCourseNews;
$paginationlink = $CFG->wwwroot . '/course/load_course.php?page=';
$strcourse      = "N'" . '%' . $keycourse . '%' . "'";
$strteacher     = "N'" . '%' . $teacher . '%' . "'";
$strcategory    = "N'" . '%' . $category . '%' . "'";
$sql            = '';
$condition      = '';
$jointable      = '';
if ($page < 1) {
    $page = 1;
}
$start = ($page - 1) * $pagetake;
if ($start < $pagetake) {
    $start = 0;
}

if ($filter == "coursepopular") {
    // Hiện thị khóa học nổi bật, ghim
    $condition .= "AND c.pinned = 1 ";
} elseif ($filter == "mycourse" || $filter == "teachercourse") {
    // Hiện thị khóa học khi lọc khóa học của tôi và khóa giảng
    if ($filter == "mycourse") {
        $condition .= "AND r.id = 5 AND u.id = $USER->id ";
    } else {
        $condition .= "AND r.id = 3 AND u.id = $USER->id ";
    }
}

// Script lấy danh sách khóa học theo giảng viên, tên khóa và tên danh mục
$sql .= "SELECT c.id, cc.name category, c.fullname, c.timecreated, CONCAT(u.firstname, ' ', u.lastname) fullnamet, r.shortname
            FROM {role_assignments} ra
                JOIN {user} u ON ra.userid = u.id
                JOIN {user_enrolments} ue ON u.id = ue.userid 
                JOIN {enrol} enr ON ue.enrolid = enr.id
                JOIN {course} c ON enr.courseid = c.id
                JOIN {context} ct ON ct.id = ra.contextid AND ct.instanceid = c.id
                JOIN {role} r ON ra.roleid = r.id
                JOIN {course_categories} cc ON c.category = cc.id
            WHERE 
                c.visible = 1 AND 
                cc.visible = 1 AND
                cc.name LIKE $strcategory AND
                c.fullname LIKE $strcourse AND 
                CONCAT(u.firstname, ' ', u.lastname) LIKE $strteacher";

$notinarr = ['allcourse', 'coursepopular'];
if ($id < 1 && $keycourse == '' && $teacher == '' && $category == '' && ($filter == '' || $filter == 'allcourse' || $filter == 'coursepopular')) {
    // Hiện thị tất cả khóa học(mặc định lần đầu load page)
    $sql = "SELECT c.id,c.fullname,c.timecreated 
            FROM {course} c
                JOIN {course_categories} cc ON c.category = cc.id
            WHERE 
                c.visible = 1 AND 
                cc.visible = 1 AND
                c.id != 0 $condition" ;
} elseif ($teacher != '' && ($category != '' || $keycourse != '')) {
    // Hiện thị khóa học khi tìm kiếm cả 3 danh mục
    if(in_array($filter, $notinarr))
        $condition .= 'AND r.id = 3 
                        AND c.visible = 1 
                        AND cc.visible = 1';
    $sql .= " $condition";
} elseif($teacher != '') {
    // Hiện thị khóa học khi tìm theo tên giảng viên
    if(in_array($filter, $notinarr))
        $condition .= 'AND r.id = 3';
    $sql .= " $condition";

} elseif ($category !='' || $keycourse !='') {
    // Hiện thị khóa học khi tìm theo tên khóa học hoặc danh mục
    if(in_array($filter, $notinarr)) {
        $sql = "SELECT c.id,c.fullname,c.timecreated
            FROM {course} c
                JOIN {course_categories} cc ON c.category = cc.id
            WHERE
                c.visible = 1 AND 
                cc.visible = 1 AND
                cc.name LIKE $strcategory AND
                c.fullname LIKE $strcourse $condition";
    } else {
        // Hiện thị khóa học theo tên giảng viên (trường hợp k thể xảy ra :D)
        $sql .= " $condition";
    }
} else {
    if(!in_array($filter, $notinarr)) {
        $sql .= " $condition";
    } 
    if($id > 1) {
        // Load khóa học khi click vào từng danh mục trên cây danh mục khóa học
        $sql = "SELECT c.id,c.fullname,c.timecreated 
                FROM {course} c
                    JOIN {course_categories} cc ON c.category = cc.id
                WHERE 
                    c.visible = 1 AND 
                    cc.visible = 1 AND
                    c.category = $id $condition";
    }
}

$getcourse   = $DB->get_records_sql($sql . 'ORDER BY timecreated DESC OFFSET ' . $start . ' ROWS FETCH NEXT '. $pagetake.' ROWS only', []);
$countcourse = $DB->get_records_sql($sql);

if (empty($getcourse)) {
    echo '<div class="alert alert-warning">
        <strong>' . get_string('warning', 'local_newsvnr') . '!</strong>.' . get_string('nocourseload', 'local_newsvnr') . '</div>';
    die();
} else {
    echo '<div class="mt-3 result-course alert alert-success">' . get_string('resultsearch', 'local_newsvnr') . ' ' . count($countcourse) . '</div>';
}

$perpageresult = $perPage->getAllCourseNewsPageLinks(count($countcourse), $paginationlink);

echo '<div class="row">';
foreach ($getcourse as $value) {
    //Thêm các field còn thiếu trong khóa học
    $value->progress     = 0;
    $courseid            = $value->id;
    $courseobj           = new \core_course_list_element($value);
    $value->link         = $CFG->wwwroot . "/course/view.php?id=" . $value->id;
    $arr                 = $theme_settings::role_courses_teacher_slider_block_course_recent($courseid);
    $value->fullnamet    = $arr->fullnamet;
    $value->countstudent = $arr->studentnumber;
    $value->enrolmethod  = get_enrol_method($courseid);
    $value->courseimage  = $theme_settings::get_course_images($courseobj, $value->link);
    if (isset($arr->id)) {
        $stduser = new stdClass();
        $userid  = $DB->get_records('user', array('id' => $arr->id));
        foreach ($userid as $userdata) {
            $stduser = (object) $userdata;
        }

        $value->imageteacher = $OUTPUT->user_picture($stduser, array('size' => 72));
    } else {
        $value->imageteacher = $arr->imgdefault;
    }
    echo
    '<div class="col-6 col-xl-3 col-lg-3 col-md-4 col-sm-6 mt-3 col-15 course-ajax-load">
        <div class="post-slide6">
            <div class="post-img">
              ' . $value->courseimage . '
                <div class="post-info">
                    <ul class="category">
                        <li>' . get_string('countstudent', 'local_newsvnr') . ': <a href="#">' . $value->countstudent . '</a></li>
                        <li>' . get_string('teachername', 'local_newsvnr') . ': <a href="#">' . $value->fullnamet . '</a></li>
                    </ul>
                </div>
            </div>
            <div class="post-review">
                <span class="icons">
                <a>' . $value->imageteacher . '</a>
                </span>
                <h3 class="post-title"><a href="' . $value->link . '" title="' . $value->fullname . '">' . $value->fullname . '</a></h3>
                <p class="post-teachername">' . $value->fullnamet . '</p>
                <p class="post-enrolmethod">';
                if ($value->progress > 0) {
                    echo '<div class="progress">
                                 <div class="progress-bar" role="progressbar" aria-valuenow="' . $value->progress . '"
                                    aria-valuemin="0" aria-valuemax="100" style="width:' . $value->progress . '%">
                                    ' . $value->progress . '%
                                 </div>
                              </div>';
                } else {
                    echo $value->enrolmethod;
                }
                echo '</p>
            </div>
        </div>
    </div>';

}
echo '</div>';

if (!empty($perpageresult)) {
    echo '<div class="col-md-12"> <div id="pagination" teacher="' . $teacher . '" keyword="' . $keycourse . '" category="' . $id . '">' . $perpageresult . '</div> </div>';
}

die();
