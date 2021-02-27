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
 * A two column layout for the moove theme.
 *
 * @package   theme_moove
 * @copyright 2017 Willian Mano - http://conecti.me
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
user_preference_allow_ajax_update('sidepre-open', PARAM_ALPHA);

require_once($CFG->libdir . '/behat/lib.php');
global $DB;
if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
    $draweropenright = (get_user_preferences('sidepre-open', 'true') == 'true');
} else {
    $navdraweropen = false;
    $draweropenright = false;
}

$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;

$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}

if ($draweropenright && $hasblocks) {
    $extraclasses[] = 'drawer-open-right';
}
$check = theme_moove_layout_check();
$PAGE->requires->strings_for_js(array('emptydata','action','viewcourse', 'code', 'email', 'datecreated', 'choosecourse', 'startlearning'), 'local_newsvnr');
$PAGE->requires->strings_for_js(array('coursestartdate','courseenddate','studenttotal', 'studentcode', 'coursename', 'coursemodules', 'status', 'coursecompletion', 'listuser', 'owncourses', 'viewdetail', 'studentname', 'lastaccess', 'phone', 'notyetselectcourse', 'listmodule', 'course', 'number', 'moduleallocation', 'coursegradeavg', 'access', 'coursecompleted', 'enrollcourse', 'modulename', 'exam', 'moduletype', 'score', 'modulerate', 'spenttimemodule', 'showalldata'), 'theme_moove');
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'hasdrawertoggle' => true,
    'navdraweropen' => $navdraweropen,
    'draweropenright' => $draweropenright,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'is_siteadmin' => $check->isadmin,
    'is_teacher' => $check->is_teacher,
    'is_student' => $check->is_student,
    'hasportal' => $check->hasportal,
    'hasiframe' => $check->hasiframe,
    'hasgeneraliframe' => $check->hasgeneraliframe,
    'canviewadmininfos' => false,
    'hasopenmenu' => $check->hasopenmenu
];

$themesettings = new \theme_moove\util\theme_settings();

$templatecontext = array_merge($templatecontext, $themesettings->footer_items(), $themesettings->get_fullinfo_user(), $themesettings->get_data_dashboard_teacher(), $themesettings->get_vnr_dashboard_config());
if (is_siteadmin()) {
    global $DB;

    // Get site total users.
    $totalactiveusers = $DB->count_records('user', array('deleted' => 0, 'suspended' => 0)) - 1;
    $totaldeletedusers = $DB->count_records('user', array('deleted' => 1));
    $totalactivecourse = $DB->count_records('course_modules', array('visible' => 1));
    $totalsuspendedusers = $DB->count_records('user', array('deleted' => 0, 'suspended' => 1));
    $totalmodules = $DB->count_records('course_modules',['deletioninprogress' => 0]);
    $totalcategories = $DB->count_records('course_categories',[]);

    // Get site total courses.
    $totalcourses = $DB->count_records('course') - 1;

    // Get the last online users in the past 5 minutes.
    $onlineusers = new \block_online_users\fetcher(null, time(), 300, null, CONTEXT_SYSTEM, null);
    $onlineusers = $onlineusers->count_users();

    // Get the disk usage.
    $cache = cache::make('theme_moove', 'admininfos');
    $totalusagereadable = $cache->get('totalusagereadable');

    if (!$totalusagereadable) {
        $totalusage = get_directory_size($CFG->dataroot);
        $totalusagereadable = number_format(ceil($totalusage / 1048576));

        $cache->set('totalusagereadable', $totalusagereadable);
    }

    $usageunit = ' MB';
    if ($totalusagereadable > 1024) {
        $usageunit = ' GB';
    }

    $totalusagereadabletext = $totalusagereadable . $usageunit;

    $templatecontext['totalusage'] = $totalusagereadabletext;
    $templatecontext['totalactivecourse'] = $totalactivecourse;
    $templatecontext['totalactiveusers'] = $totalactiveusers;
    $templatecontext['totalsuspendedusers'] = $totalsuspendedusers;
    $templatecontext['totalcourses'] = $totalcourses;
    $templatecontext['totalmodules'] = $totalmodules;
    $templatecontext['onlineusers'] = $onlineusers;
    $templatecontext['totalcategories'] = $totalcategories;
}
// Improve boost navigation.
theme_moove_extend_flat_navigation($PAGE->flatnav);

$templatecontext['flatnavigation'] = $PAGE->flatnav;

if($check->hasgeneraliframe == "true") {
    echo $OUTPUT->render_from_template('theme_moove/general_iframe_mydashboard', $templatecontext);
} else {
    echo $OUTPUT->render_from_template('theme_moove/mydashboard', $templatecontext);
}