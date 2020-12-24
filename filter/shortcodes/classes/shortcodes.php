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
 * Shortcodes handler.
 *
 * @package    filter_shortcodes
 * @copyright  2018 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace filter_shortcodes;



use stdClass;

defined('MOODLE_INTERNAL') || die();

/**
 * Shortcodes handler.
 *
 * @package    filter_shortcodes
 * @copyright  2018 Frédéric Massart
 * @author     Frédéric Massart <fred@branchup.tech>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class shortcodes {

    /**
     * Handle shortcodes.
     *
     * @param string $shortcode The shortcode.
     * @param object $args The arguments of the code.
     * @param string|null $content The content, if the shortcode wraps content.
     * @param object $env The filter environment (contains context, noclean and originalformat).
     * @param Closure $next The function to pass the content through to process sub shortcodes.
     * @return string The new content.
     */
    public static function handle($shortcode, $args, $content, $env, $next) {
        global $USER, $DB, $EMAILUSER, $EMAILCOURSE, $CFG;
        require_once $CFG->dirroot . '/local/newsvnr/lib.php';
       
        if (isset($EMAILUSER)) {
            $get_user = (array)$DB->get_record('user', ['id' => $EMAILUSER->id]);
            foreach($get_user as $oldkey => $value) {
                $newkey = 'user' . $oldkey;
                $get_user[$newkey] = $get_user[$oldkey];
            }
            $user_org_jobtitle_position = $DB->get_record('orgstructure_position', ['id' => $get_user['userorgpositionid']]);
            $get_user['userfullname'] = $get_user['firstname'] . ' ' . $get_user['lastname'];
            $get_user['userorgposition'] = $user_org_jobtitle_position->name;
            $get_user['userorgjobtitle'] = $DB->get_field('orgstructure_jobtitle', 'name', ['id' => $user_org_jobtitle_position->jobtitleid]);
            $get_user['userorgstructure'] = $DB->get_field('orgstructure', 'name', ['id' => $get_user['userorgstructureid']]);
            if (isset($get_user[$shortcode])) {
                return $get_user[$shortcode];
            }
            $get_course = (array)$EMAILCOURSE;
            foreach((array)$get_course as $oldkey => $value) {
                if($oldkey == 'startdate' || $oldkey == 'enddate' || $oldkey == 'timecreated') {
                    $cvtdate = convertunixtime('d/m/Y', $value);
                    $get_course[$oldkey] = $cvtdate;
                }
                $newkey = 'course' . $oldkey;
                $get_course[$newkey] = $get_course[$oldkey];
            }
            $courseurl = $CFG->wwwroot . '/course/view.php?id=' . $get_course['courseid'];
            $get_course['courselink'] = '<a href=" '.$courseurl. '" target="_blank">Xem khóa học</a>';
            if (isset($get_course[$shortcode])) {
                return $get_course[$shortcode];
            }
        }
        if ($shortcode === 'off') {
            return $content;
        }
        return $next($content);
    }
}
