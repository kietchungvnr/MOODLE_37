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
 * Starred courses block external API
 *
 * @package    block_starredcourses
 * @category   external
 * @copyright  2018 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/externallib.php');

require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/course/externallib.php');
require_once($CFG->dirroot . '/local/newsvnr/lib.php');
use \theme_moove\util\theme_settings;
use \core_course\external\course_summary_exporter;
use \core_course\coursecat_helper;
use \core_course_category;
use \core_course_list_element;
use \stdClass;


/**
 * Starred courses block external functions.
 *
 * @copyright  2018 Simey Lameze <simey@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_starredcourses_external extends core_course_external {

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     * @since Moodle 3.6
     */
    public static function get_starred_courses_parameters() {
        return new external_function_parameters([
            'limit' => new external_value(PARAM_INT, 'Limit', VALUE_DEFAULT, 0),
            'offset' => new external_value(PARAM_INT, 'Offset', VALUE_DEFAULT, 0)
        ]);
    }

    /**
     * Get users starred courses.
     *
     * @param int $limit Limit
     * @param int $offset Offset
     *
     * @return  array list of courses and warnings
     */
    public static function get_starred_courses($limit, $offset) {
        global $USER, $PAGE, $OUTPUT,$DB;

        $params = self::validate_parameters(self::get_starred_courses_parameters(), [
            'limit' => $limit,
            'offset' => $offset
        ]);

        $limit = $params['limit'];
        $offset = $params['offset'];

        $usercontext = context_user::instance($USER->id);

        self::validate_context($usercontext);
        $PAGE->set_context($usercontext);
        $renderer = $PAGE->get_renderer('core');

        // Get the user favourites service, scoped to a single user (their favourites only).
        $userservice = \core_favourites\service_factory::get_service_for_user_context($usercontext);

        // Get the favourites, by type, for the user.
        $favourites = $userservice->find_favourites_by_type('core_course', 'courses', $offset, $limit);

        // Sort the favourites getting last added first.
        usort($favourites, function($a, $b) {
            if ($a->timemodified == $b->timemodified) return 0;
            return ($a->timemodified > $b->timemodified) ? -1 : 1;
        });

        $formattedcourses = array();
        foreach ($favourites as $favourite) {
            $course = get_course($favourite->itemid);
            $context = \context_course::instance($favourite->itemid);
            $canviewhiddencourses = has_capability('moodle/course:viewhiddencourses', $context);

            if ($course->visible || $canviewhiddencourses) {
                $exporter = new course_summary_exporter($course, ['context' => $context, 'isfavourite' => true]);
                $formattedcourse = $exporter->export($renderer);
                $formattedcourses[] = $formattedcourse;
            }
        }
        // Custom by Thang
        $theme_settings = new theme_settings();
        foreach ($formattedcourses as $key => $value) {
            $courseid = $value->id;
            $arr = $theme_settings::role_courses_teacher_slider_block_course_recent($courseid);
            $value->fullnamet = $arr->fullnamet;
            $value->countstudent = $arr->studentnumber;
            $value->enrolmethod = get_enrol_method($courseid);
            if($value->progress > 0 ){
              $value->hasprogress = true;
            }
            else {
              $value->hasprogress = false;
            }
            if (isset($arr->id)) {
              $stduser = new stdClass();
              $userid = $DB->get_records('user',array('id' => $arr->id));
              foreach ($userid as $userdata)
                 $stduser = (object)$userdata;

               $value->imageteacher = $OUTPUT->user_picture($stduser, array('size'=>72));
            }
            else
            {
              $value->imageteacher = $arr->imgdefault;
            }
        } 
        // print_r($formattedcourses);die();
        return $formattedcourses;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     * @since Moodle 3.6
     */
    public static function get_starred_courses_returns() {
        // return new external_multiple_structure(course_summary_exporter::get_read_structure());
      // Custom by Thang
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'id'),
                    'fullname' => new external_value(PARAM_RAW, 'fullname course'),
                    'shortname' => new external_value(PARAM_RAW, 'shortname course'),
                    'idnumber' => new external_value(PARAM_RAW, 'course id nubmer'),
                    'summary' => new external_value(PARAM_RAW, 'summary'),
                    'summaryformat' => new external_value(PARAM_INT, 'summaryformat'),
                    'startdate' => new external_value(PARAM_INT, 'startdate course'),
                    'enddate' => new external_value(PARAM_INT, 'enddate course'),
                    'visible' => new external_value(PARAM_BOOL, 'course visible'),
                    'fullnamedisplay' => new external_value(PARAM_RAW, 'course fullname'),
                    'viewurl' => new external_value(PARAM_URL, 'courses url'),
                    'courseimage' => new external_value(PARAM_RAW, 'course image'),
                    'progress' => new external_value(PARAM_INT, 'course progress'),
                    'hasprogress' => new external_value(PARAM_BOOL, 'course has progress or not'),
                    'isfavourite' => new external_value(PARAM_BOOL, 'favourite course'),
                    'hidden' => new external_value(PARAM_BOOL, 'hidden'),
                    'showshortname' => new external_value(PARAM_BOOL, 'shortname course'),
                    'coursecategory' => new external_value(PARAM_RAW, 'courses category'),
                    'fullnamet' => new external_value(PARAM_RAW, 'teacher name'),
                    'imageteacher' => new external_value(PARAM_RAW, 'teacher image'),
                    'countstudent' => new external_value(PARAM_INT, 'count number of student'),
                    'enrolmethod' => new external_value(PARAM_RAW, 'method enrol')
                )
            )
        );
    }
}
