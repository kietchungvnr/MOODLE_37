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

if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'false') == 'false');
    $draweropenright = (get_user_preferences('sidepre-open', 'false') == 'false');
} else {
    $navdraweropen = false;
    $draweropenright = false;
}

$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$check = theme_moove_layout_check();
$PAGE->requires->strings_for_js(array('selectcoursedata'), 'theme_moove');
// if(isset($_SERVER['HTTP_SEC_FETCH_DEST']) && $_SERVER['HTTP_SEC_FETCH_DEST'] == 'iframe') {
//     $check->hasiframe = true;
// } else {
//     $check->hasiframe = false;
// }
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}

if ($draweropenright && $hasblocks) {
    $extraclasses[] = 'drawer-open-left';
}

$coursepresentation = theme_moove_get_setting('coursepresentation');
if ($coursepresentation == 2) {
    $extraclasses[] = 'coursepresentation-cover';
}
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
    'hasportal' => $check->hasportal,
    'hasiframe' => $check->hasiframe,
    'hasgeneraliframe' => $check->hasgeneraliframe,
    'hasfocusmod' => $check->hasfocusmod,
    'show_hide_focusmod' => $check->show_hide_focusmod,
    'hasopenmenu' => $check->hasopenmenu
];

// var_dump($templatecontext['hasportal']);die;

// Improve boost navigation.
theme_moove_extend_flat_navigation($PAGE->flatnav, 'course');

$templatecontext['flatnavigation'] = $PAGE->flatnav;

$themesettings = new \theme_moove\util\theme_settings();

$templatecontext = array_merge($templatecontext, $themesettings->footer_items(), $themesettings->get_vnr_chatbot());
if (!$coursepresentation || $coursepresentation == 1) {
    if($check->hasgeneraliframe == "true") {
        echo $OUTPUT->render_from_template('theme_moove/general_iframe_coursepage', $templatecontext);
    } else {
        echo $OUTPUT->render_from_template('theme_moove/coursepage', $templatecontext);
    }
} else if ($coursepresentation == 2) {
    echo $OUTPUT->render_from_template('theme_moove/course_cover', $templatecontext);
}
