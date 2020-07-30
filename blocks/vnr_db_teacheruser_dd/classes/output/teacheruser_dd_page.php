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
 * Block xu hướng tham gia hoạt động
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_teacheruser_dd\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;
use user_picture;
use html_writer;

class teacheruser_dd_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $DB,$USER,$CFG;
        $data = array();
        $str_courseid = get_list_courseid_by_teacher($USER->id);
        $list_forum_sql = "SELECT TOP 3 cm.id as viewid, fd.id as fdid,f.id as fid, COUNT(fd.id) as tbv ,f.name as fname,fd.name as fdname from mdl_forum f 
                                left join mdl_forum_discussions fd on f.id = fd.forum 
                                left join mdl_forum_posts fp on fd.id = fp.discussion
                                left join mdl_course_modules cm on fd.forum = cm.instance
                            where f.course IN ($str_courseid) and fd.id is not null
                            group by cm.id, fd.id, f.id, f.name,fd.name
                            order by COUNT(fd.id) DESC";
        $top_activity_forum_arr =  array();
        $list_forum_ex = $DB->get_records_sql($list_forum_sql,[]);
        foreach ($list_forum_ex as $value) {
            $top_activity_forum_std = new stdClass();
            $discusslink = $CFG->wwwroot."/mod/forum/discuss.php?d=".$value->fdid;
            $viewlink = $CFG->wwwroot."/mod/forum/view.php?id=".$value->viewid;
            $top_activity_forum_std->forumname = \html_writer::link($viewlink,$value->fname);
            $top_activity_forum_std->discussname = \html_writer::link($discusslink,$value->fdname);
            $top_activity_forum_std->totalpost = $value->tbv;
            $top_activity_forum_arr[] = $top_activity_forum_std;
        }

        $toppost_sql = "SELECT TOP 3 d.userid, COUNT(d.id) AS  totaldisc, SUM(tm.totalPost) AS totalpost FROM mdl_forum_discussions d LEFT JOIN (
                        SELECT userid, COUNT(ID) totalPost, MAX(discussion) AS discussion_ID  FROM mdl_forum_posts GROUP BY userid,discussion) AS tm ON d.Id= tm.discussion_ID AND tm.userid = d.userid
                        GROUP BY d.userid
                        ORDER BY totaldisc DESC";
        $toppost_ex = $DB->get_records_sql($toppost_sql,[]);
        $toppost_arr = array();
        foreach ($toppost_ex as $value) {
            $toppost_std = new stdClass();
            $fullnamelink = $CFG->wwwroot."/user/profile.php?id=".$value->userid;
            $userobj = $DB->get_record('user',['id' => $value->userid]);
            $fullname = fullname($userobj,true);
            $toppost_std->fullname = \html_writer::link($fullnamelink,$fullname);
            $toppost_std->totalpost = $value->totalpost;
            $toppost_std->totaldisscus = $value->totaldisc;
            $toppost_arr[] = $toppost_std;
        }

        $data['top_activity'] = $top_activity_forum_arr;
        $data['top_activity_by_user'] = $toppost_arr;
        return $data;
    }
}