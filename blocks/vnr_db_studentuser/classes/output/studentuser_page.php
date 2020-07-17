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
 * Block top học viên đạt huy hiệu và huy hiệu mới nhất
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_studentuser\output;
defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/local/newsvnr/lib.php');
require_once($CFG->libdir . '/badgeslib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;
use badge;
use user_picture;
class studentuser_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $DB,$USER,$CFG,$OUTPUT;
        $data = array();
        //lấy học viên huy hiệu mới nhất
        $lbquery = "SELECT TOP 5 bi.dateissued, b.name, bi.badgeid, bi.userid,CONCAT(u.firstname,' ',u.lastname) as fullname FROM mdl_badge_issued bi 
                        LEFT JOIN mdl_badge b ON bi.badgeid = b.id
                        LEFT JOIN mdl_user u ON u.id = bi.userid
                        ORDER BY bi.dateissued DESC";
        $list_badges = $DB->get_records_sql($lbquery);
        $badgestd = new stdClass();
        $badarr = array();
        $stt = 1;
        $clbstt = 1;
        foreach ($list_badges as $value) {
            $badge = new badge($value->badgeid);
            $context = $badge->get_context();
            $badgestd = $value;
            $badgestd->stt = $stt;
            $badgestd->imageuser = $OUTPUT->user_picture($DB->get_record('user',['id' => $value->userid]), array('size'=>35));
            $badgestd->timecomplete = convertunixtime('d/m/Y',$value->dateissued);
            $badgestd->imagebadges = print_badge_image($badge,$context,'large');
            $badarr[] = $badgestd;
            $stt++;
        }
        //lấy top học viên nhiều huy hiệu nhất
        $clbquery = "SELECT TOP 5 CONCAT(u.firstname,' ',u.lastname) AS fullname, COUNT(bi.userid ) AS badgenumber,bi.userid
                    FROM mdl_badge_issued bi 
                        LEFT JOIN mdl_badge b ON bi.badgeid=b.id
                        LEFT JOIN mdl_user u ON u.id = bi.userid
                        GROUP BY bi.userid, u.firstname,u.lastname
                        ORDER BY COUNT(bi.userid ) DESC";
        $namebadge_query = "SELECT b.name
                        FROM mdl_badge_issued bi 
                            LEFT JOIN mdl_badge b ON bi.badgeid=b.id
                        WHERE bi.userid = ?";
        $count_list_badges = $DB->get_records_sql($clbquery);
        $clbadgestd = new stdClass();
        $clbadge = array();
        $namebadge = array();
        foreach ($count_list_badges as $countlb) {
            $namebadge[] = $DB->get_records_sql($namebadge_query,[$countlb->userid]);
            $clbadgestd = $countlb;
            $clbadgestd->imageuser = $OUTPUT->user_picture($DB->get_record('user',['id' => $countlb->userid]), array('size'=>35));
            $clbadgestd->stt = $clbstt;
            $clbadgestd->namebadge = $namebadge;
            $clbadge[] = $clbadgestd;
            $clbstt++;
        }
        $data['list_badges'] = $badarr;
        $data['count_list_badges'] = $clbadge; 

        return $data;
    }
}