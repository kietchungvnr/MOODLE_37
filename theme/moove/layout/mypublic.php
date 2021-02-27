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

global $DB,$CFG;

// Get the profile userid.
$userid = optional_param('id', $USER->id, PARAM_INT);
$user = $DB->get_record('user', ['id' => $userid], '*', MUST_EXIST);

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
user_preference_allow_ajax_update('sidepre-open', PARAM_ALPHA);

require_once($CFG->libdir . '/behat/lib.php');

$hasdrawertoggle = false;
$navdraweropen = false;
$draweropenright = false;

if (isloggedin()) {
    $hasdrawertoggle = true;
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
    $draweropenright = (get_user_preferences('sidepre-open', 'true') == 'true');
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
$isuser = ($USER->id == $user->id) ? true : false;
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$context = context_course::instance(SITEID);
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => $context, "escape" => false]),
    'output' => $OUTPUT,
    'sidepreblocks' => $blockshtml,
    'hasblocks' => $hasblocks,
    'bodyattributes' => $bodyattributes,
    'hasdrawertoggle' => $hasdrawertoggle,
    'navdraweropen' => $navdraweropen,
    'draweropenright' => $draweropenright,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    'hasportal' => $check->hasportal,
    'hasiframe' => $check->hasiframe,
    'hasgeneraliframe' => $check->hasgeneraliframe,
    'isadmin' => is_siteadmin(),
    'isuser' => $isuser,
    'hasopenmenu' => $check->hasopenmenu
];

// Improve boost navigation.
theme_moove_extend_flat_navigation($PAGE->flatnav);

$templatecontext['flatnavigation'] = $PAGE->flatnav;

$themesettings = new \theme_moove\util\theme_settings();

$templatecontext = array_merge($templatecontext, $themesettings->footer_items());

$usercourses = \theme_moove\util\extras::user_courses_with_progress($user);
$PAGE->requires->strings_for_js(array(
                'addcomment',
                'comments',
                'commentscount',
                'commentsrequirelogin',
                'deletecommentbyon'
            ),
            'moodle'
        );
$badges = get_user_badge($user->id);
$arr = ['user' => $user->id];
$bloglisting = new blog_listing($arr);
$templatecontext['bloglist'] = $bloglisting->print_entries_blog($arr);

//more info
$templatecontext['totalcourse']= count($usercourses);
$templatecontext['totalbadge']= count($badges);
$templatecontext['totalblog'] = $DB->count_records('post',['module' => 'blog','userid' => $user->id]);
$templatecontext['totalforumpost']= $DB->count_records('forum_posts',['parent' => 0,'userid' => $user->id]);
$templatecontext['firstaccess'] = convertunixtime('d/m/Y', $user->firstaccess, 'Asia/Ho_Chi_Minh') . " (" . format_time(time() - $user->firstaccess) . ")";
$templatecontext['lastaccess'] = convertunixtime('d/m/Y', $user->lastaccess, 'Asia/Ho_Chi_Minh') . " (" . format_time(time() - $user->lastaccess) . ")";
$templatecontext['email'] = $user->email;
$templatecontext['country'] = $user->country;
$templatecontext['hascourses'] = (count($usercourses)) ? true : false;
$templatecontext['hasblog'] = ($DB->count_records('post',['module' => 'blog','userid' => $user->id]) > 0) ? true : false;
$templatecontext['editprofile'] = $CFG->wwwroot . '/user/editadvanced.php?id='.$user->id.'&course=1';
foreach ($usercourses as $value) {
    $templatecontext['courses'][] = get_coursecard_info($value->id);
}  
$templatecontext['hasbadge'] = (count($badges)) ? true : false;
$templatecontext['badges'] = array_values($badges);

$templatecontext['user'] = $user;
$templatecontext['user']->profilepicture = \theme_moove\util\extras::get_user_picture($user, 100);
$competencyplans = \theme_moove\util\extras::get_user_competency_plans($user);
$templatecontext['hascompetencyplans'] = (count($competencyplans)) ? true : false;
$templatecontext['linkcompetencyplan'] = $CFG->wwwroot . '/admin/tool/lp/plans.php?userid=' . $user->id;
$templatecontext['linkaddblog'] = $CFG->wwwroot . '/blog/edit.php?action=add&userid=' . $user->id;
for($i = 0;$i < count($competencyplans);$i++) {
    $duedate = $DB->get_field('competency_plan', 'duedate', ['id' => $competencyplans[$i]['id']]);
    $competencyplans[$i]['duedate'] = ($duedate > 0) ? convertunixtime('l, d m Y, H:i A', $duedate, 'Asia/Ho_Chi_Minh') : get_string('nodatatable','local_newsvnr');
}
$templatecontext['competencyplans'] = $competencyplans;



$templatecontext['headerbuttons'] = \theme_moove\util\extras::get_mypublic_headerbuttons($context, $user);

echo $OUTPUT->render_from_template('theme_moove/mypublic', $templatecontext);