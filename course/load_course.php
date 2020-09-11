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
$keyword  = optional_param('keyword', "", PARAM_TEXT);
$teacher  = optional_param('teacher', "", PARAM_TEXT);
$category = optional_param('category', "", PARAM_TEXT);
$PAGE->set_context(context_system::instance());
$theme_settings = new theme_settings();

///xử lý phân trang///
$perPage        = new PerPage();
$paginationlink = $CFG->wwwroot . '/course/load_course.php?page=';
$strsearch      = "N'" . '%' . $keyword . '%' . "'";
$strteacher     = "N'" . '%' . $teacher . '%' . "'";
$strcategory    = "N'" . '%' . $category . '%' . "'";
if ($page < 1) {
    $page = 1;
}
$start = ($page - 1) * $perPage->perpageCourseNews;
if ($start < 12) {
    $start = 0;
}
if ($id < 1 && $keyword == '' && $teacher == '' && $category == '') {
    $getcourse   = $DB->get_records_sql('SELECT * FROM {course} ORDER BY id DESC OFFSET ' . $start . ' ROWS FETCH NEXT 12 ROWS only');
    $countcourse = $DB->get_records_sql('SELECT * FROM {course}');
} else if ($keyword != '' || $teacher != '' || $category != '') {
    $sql = '';
    if (($keyword != '' || $category != '') && $teacher == '') {
        $sql .= 'SELECT c.id,c.fullname FROM {course_categories} cc
        join {course} c on c.category = cc.id
        WHERE c.fullname LIKE ' . $strsearch . ' AND cc.name LIKE ' . $strcategory . '';
    } else if ($teacher != '' && ($keyword == '' || $category != '')) {
        $sql .= "SELECT DISTINCT c.id,c.fullname
	    from {role_assignments} ra
	    join {user} u on u.id= ra.userid
	    join {user_enrolments} ue on ue.userid=u.id
	    join {enrol} e on e.id=ue.enrolid
	    join {course} c on c.id=e.courseid
	    join {context} ct on ct.id=ra.contextid and ct.instanceid= c.id
	    join {role} r on r.id= ra.roleid
	    JOIN {course_categories} cc ON cc.id = c.category
	    where ra.roleid=3 AND CONCAT(u.firstname,' ', u.lastname) LIKE $strteacher AND cc.name LIKE $strcategory";
    } else {
        $sql .= "SELECT DISTINCT c.id,c.fullname
	    from {role_assignments} ra
	    join {user} u on u.id= ra.userid
	    join {user_enrolments} ue on ue.userid=u.id
	    join {enrol} e on e.id=ue.enrolid
	    join {course} c on c.id=e.courseid
	    join {context} ct on ct.id=ra.contextid and ct.instanceid= c.id
	    join {role} r on r.id= ra.roleid
	    JOIN {course_categories} cc ON cc.id = c.category
	    where ra.roleid=3 AND fullname LIKE $strsearch AND CONCAT(u.firstname,' ', u.lastname) LIKE $strteacher AND cc.name LIKE $strcategory";
    }
    $getcourse   = $DB->get_records_sql($sql . 'ORDER BY id DESC OFFSET ' . $start . ' ROWS FETCH NEXT 12 ROWS only', []);
    $countcourse = $DB->get_records_sql($sql, []);
    echo '<div class="mt-3 result-course">'.string('resultsearch','local_newsvnr').' : '. count($countcourse).'</div>';
} else {
    $getcourse   = $DB->get_records_sql('SELECT * FROM {course} WHERE category = :id ORDER BY id DESC OFFSET ' . $start . ' ROWS FETCH NEXT 12 ROWS only ', ['id' => $id]);
    $countcourse = $DB->get_records_sql('SELECT * FROM {course} WHERE category = :id', ['id' => $id]);
}
$perpageresult = $perPage->getAllCourseNewsPageLinks(count($countcourse), $paginationlink);
if (empty($getcourse)) {
    echo '<div class="alert alert-warning">
    		<strong>' . get_string('warning', 'local_newsvnr') . '!</strong>.' . get_string('nocourseload', 'local_newsvnr') . '</div>';
    die();
}
echo '<div class="row">';
foreach ($getcourse as $value) {
    //Thêm các field còn thiếu trong khóa học
    $value->progress     = round(\core_completion\progress::get_course_progress_percentage($value, $USER->id));
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
    echo '<div class="col-md-12"> <div id="pagination" teacher="' . $teacher . '" keyword="' . $keyword . '" category="' . $id . '">' . $perpageresult . '</div> </div>';
}
