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
 * Block hiện thị lộ trình đào tạo dựa theo vị trí
 *
 * @package    block_user(student)
 * @copyright  2019 Le Thanh Vu
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_vnr_db_lptimeline\output;
defined('MOODLE_INTERNAL') || die();

require_once("$CFG->dirroot/local/newsvnr/lib.php");
use renderable;
use templatable;
use renderer_base;
use stdClass;
use context_course;
use core_competency\api;
use html_writer;

class lptimeline_page implements renderable, templatable {

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        global $DB,$USER,$CFG;
        $data = array();
        $j = 0;
        $strnocomp = get_string('nocomp','block_vnr_db_lptimeline');
     
        //Lấy danh sách năng lực theo vị trí
        $lpt_list_comp_name = get_name_competency_position($USER->orgpositionid);

        $get_positionname = get_positionname($USER->orgpositionid);
        if(!empty($lpt_list_comp_name)) {
            foreach ($lpt_list_comp_name as $compid) {
                $get_userevidencecompid = get_userevidencecompid($USER->id,$compid->competencyid);
                $get_userevidence = [];
                $list_userevidence = [];
                //Lấy evidence của năng lực nếu có
                if(!empty($get_userevidencecompid)) {
                    foreach ($get_userevidencecompid as $key => $uec) {
                       $get_userevidence[$key] = get_userevidence($uec,$compid->competencyid);
                       $get_userevidence[$key]->link = $CFG->wwwroot."/admin/tool/lp/user_competency.php?id=".$get_userevidence[$key]->ucid;
                    }
                    if(!empty($get_userevidence)) {
                        foreach ($get_userevidence as $ue) {
                        
                            $ue->link = html_writer::link($ue->link,$ue->name,['target' => '_blank','style' => 'color:white']);
                            if ($ue->status == 0 and $ue->proficiency == 0) {
                                $timecompleted = convertunixtime('l, d m Y',$ue->timemodified);
                                $ue->status_evi = ' Hoàn thành';
                            } 
                            else {
                                if ($ue->status == 1) {
                                    $ue->status_evi = ' Đang đợi review';
                                } elseif ($ue->status == 2) {
                                    $ue->status_evi = ' Đang trong qua trình review';
                                } elseif ($ue->status == 0 and $ue->proficiency == 1) {
                                    $ue->status_evi = ' Đã review chưa hoàn thành';
                                } else {
                                    $ue->status_evi = ' Chưa yêu cầu review';
                                }
                            }
                            if($ue->reviewerid) {
                                $get_reviewer = $DB->get_record('user',['id' => $ue->reviewerid]);
                                $ue->namereviewer = fullname($get_reviewer,true);
                            } else {
                                $ue->namereviewer = '';
                            }
                            $ue->timereview = convertunixtime('d/m/Y',$ue->timemodified);
                            $list_userevidence[] = $ue;
                        }
                    }
                }
                $list_comp_name = [];
                $list_comp_name_all = [];
                //Lấy khóa học đã được chòn từ manager cho năng lực tương ứng
                $get_comp_by_orgposition = $DB->get_record('competency_coursepositioncomp',['competencyid' => $compid->competencyid,'orgpositionid' => $USER->orgpositionid]);
                if($get_comp_by_orgposition) {
                    $list_courses = $DB->get_records_sql('SELECT * FROM {course} WHERE id = ?',[$get_comp_by_orgposition->courseid]);
                    foreach ($list_courses as $value) {
                        $teachername = get_teachername($value->id);
                        $check_enrolled = is_enrolled(context_course::instance($value->id),$USER->id);
                        if ($check_enrolled == true) {
                            $progress = \core_completion\progress::get_course_progress_percentage($value,$USER->id);
                            if($progress == 0) {
                                $progress = 1;
                            } 
                            $value->progress = floor($progress);
                            if($teachername) 
                                $value->teachername = $teachername;
                            else {
                                $value->teachername = "Chưa có giáo viên";
                                $data['list_comp'][$j]['color_teachername'] = "text-danger";
                            }
                            $value->link = html_writer::link($CFG->wwwroot."/course/view.php?id=".$value->id,$value->fullname,['target' => '_blank','style' => 'color:white']);
                            $value->startdate = convertunixtime('d/m/Y',$value->startdate);
                            $value->enddate = convertunixtime('d/m/Y',$value->enddate);
                            $list_comp_name[] = $value;
                        } else {
                            if($teachername) 
                                $value->teachername = $teachername;
                            else {
                                $value->teachername = "Chưa có giáo viên";
                                $data['list_comp'][$j]['color_teachername'] = "text-danger";
                            }
                            $value->link = html_writer::link($CFG->wwwroot."/course/view.php?id=".$value->id,$value->fullname,['target' => '_blank','style' => 'color:white']);
                            $value->enrollink = $CFG->wwwroot."/course/view.php?id=".$value->id;
                            $value->startdate = convertunixtime('d/m/Y',$value->startdate);
                            $value->enddate = convertunixtime('d/m/Y',$value->enddate);
                            $list_comp_name_all[] = $value;
                        }
                    }
                } else {
                    if(!$get_userevidencecompid) {
                        $data['list_comp'][$j]['rolemanager'] = "1";
                        if(is_siteadmin()) {
                        $data['list_comp'][$j]['nocourse'] = "Năng lực chưa có khóa học được chọn.";
                        $data['list_comp'][$j]['linknocourse'] = $CFG->wwwroot.'/local/newsvnr/orgcomp_position.php';  
                        } else {
                            $data['list_comp'][$j]['nocourse'] = "Năng lực chưa có khóa học được chọn.";
                        }    
                    }
                }

                $data['list_comp'][$j]['shortname'] = $compid->shortname;
                $data['list_comp'][$j]['color_sn'] = "gray-lp";
                $data['list_comp'][$j]['list_courses'] = $list_comp_name;
                $data['list_comp'][$j]['list_courses_all'] = $list_comp_name_all;
                $data['list_comp'][$j]['list_userevidence'] = $list_userevidence;
                if($data['list_comp'][$j]['list_courses']) {
                    if($data['list_comp'][$j]['list_courses'][0]->progress == 100)
                        $data['list_comp'][$j]['color_sn'] = "green-lp";
                    elseif($data['list_comp'][$j]['list_courses'][0]->progress <= 99)
                          $data['list_comp'][$j]['color_sn'] = "primary-lp";   
                } 
                if($data['list_comp'][$j]['list_courses_all']) {
                     $data['list_comp'][$j]['color_sn'] = "gray-lp";
                }
                if($data['list_comp'][$j]['list_userevidence']) {
                    if($data['list_comp'][$j]['list_userevidence'][0]->status_evi === ' Hoàn thành')
                        $data['list_comp'][$j]['color_sn'] = "green-lp";
                }
                $j++;
            }

            $data['haslpt'] = true;
            $data['positionname'] = $get_positionname;
        } else {
            $data['nocomp'] = $strnocomp;
        }


        return $data;
    }
}