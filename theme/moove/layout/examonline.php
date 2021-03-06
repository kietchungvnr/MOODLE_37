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
 * Frontpage layout for the moove theme.
 *
 * @package   theme_moove
 * @copyright 2017 Willian Mano - http://conecti.me
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/
defined('MOODLE_INTERNAL') || die();


user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
user_preference_allow_ajax_update('sidepre-open', PARAM_ALPHA);

require_once($CFG->libdir . '/behat/lib.php');

$extraclasses = [];

$themesettings = new \theme_moove\util\theme_settings();

$permit = new stdCLass();

$check = theme_moove_layout_check();
if(is_siteadmin()) {
    $permit->canedit = true;
} else {
    $permit->canedit = false;
}
if (isloggedin()) {
    global $DB;

    // Get the profile userid.
    $userid = optional_param('id', $USER->id, PARAM_INT);
    $user = $DB->get_record('user', ['id' => $userid], '*', MUST_EXIST);

    $blockshtml = $OUTPUT->blocks('side-pre');
    $hasblocks = strpos($blockshtml, 'data-block=') !== false;

    
    $bodyattributes = $OUTPUT->body_attributes($extraclasses);
    $regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
    // $PAGE->requires->jquery();
    // $PAGE->requires->jquery_plugin('jquery');
    $context = context_course::instance(SITEID);
    $templatecontext = [
        'sitename' => format_string($SITE->shortname, true, ['context' => $context, "escape" => false]),
        'output' => $OUTPUT,
        'sidepreblocks' => $blockshtml,
        'hasblocks' => $hasblocks,
        'bodyattributes' => $bodyattributes,
        'hasdrawertoggle' => true,
        'regionmainsettingsmenu' => $regionmainsettingsmenu,
        'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
        'hasportal' => $check->hasportal,
        'canedit' => $permit->canedit,
        'hasopenmenu' => $check->hasopenmenu
    ];

    // Improve boost navigation.
    // theme_moove_extend_flat_navigation($PAGE->flatnav,'frontpage');
   
    $templatecontext['flatnavigation'] = $PAGE->flatnav;

    $templatecontext = array_merge($templatecontext, $themesettings->footer_items(),$themesettings->get_module_data(), $themesettings->get_vnr_chatbot());

    //mycourse 
    $usercourses = \theme_moove\util\extras::user_courses_with_progress($user);
    $templatecontext['hascourses'] = (count($usercourses)) ? true : false;
    $templatecontext['courses'] = array_values($usercourses);
    $templatecontext['user'] = $user;
    $templatecontext['user']->profilepicture = \theme_moove\util\extras::get_user_picture($user, 100);

    $competencyplans = \theme_moove\util\extras::get_user_competency_plans($user);
    $templatecontext['hascompetencyplans'] = (count($competencyplans)) ? true : false;
    $templatecontext['competencyplans'] = $competencyplans;

    $templatecontext['headerbuttons'] = \theme_moove\util\extras::get_mypublic_headerbuttons($context, $user);
    echo $OUTPUT->render_from_template('theme_moove/fp_examonline', $templatecontext);
} else {

    $regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();

    $templatecontext = [
        'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
        'output' => $OUTPUT,
        'hasdrawertoggle' => false,
        'cansignup' => $CFG->registerauth == 'email' || !empty($CFG->registerauth),
        'logintoken' => \core\session\manager::get_login_token(),
        'hasportal' => $check->hasportal
    ];

    $templatecontext = array_merge($templatecontext, $themesettings->footer_items());




    echo $OUTPUT->render_from_template('theme_moove/fp_examonline', $templatecontext);
}
