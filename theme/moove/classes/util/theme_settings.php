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
 * Mustache helper to load a theme configuration.
 *
 * @package    theme_moove
 * @copyright  2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_moove\util;
require_once($CFG->libdir.'/filelib.php');
require_once($CFG->dirroot.'/mod/forum/lib.php');

use theme_config;
use stdClass;
use single_button;
use moodle_url;
use context_course;
use theme_moove\util\extras;
use coursecat_helper;
use core_course_category;
use core_course_list_element;
use DateTime;
use context_system;
use context_module;
use completion_info;
use core_competency\api as competency_api;
use block_dedication_manager;
use block_dedication_utils;

defined('MOODLE_INTERNAL') || die();

/**
 * Helper to load a theme configuration.
 *
 * @package    theme_moove
 * @copyright  2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_settings {

    /**
     * Get config theme news, forums, courses, my courses
     *
     * @return array
     */
    public function sectionenable() {
        global $OUTPUT;

        $theme = theme_config::load('moove');

        $templatecontext['displaynews'] = $theme->settings->displaynews;
        $templatecontext['displaycoursespopular'] = $theme->settings->displaycoursespopular;
        $templatecontext['displaymycourses'] = $theme->settings->displaymycourses;
        $templatecontext['displayforums'] = $theme->settings->displayforums;

        return $templatecontext;
    }

    /**
     * Get config theme footer itens
     *
     * @return array
     */
    public function footer_items() {
        $theme = theme_config::load('moove');

        $templatecontext = [];

        $footersettings = [
            'facebook', 'twitter', 'googleplus', 'linkedin', 'youtube', 'instagram', 'getintouchcontent',
            'website', 'mobile', 'mail', 'email', 'address', 'phone', 'slogan'
        ];

        foreach ($footersettings as $setting) {
            if (!empty($theme->settings->$setting)) {
                $templatecontext[$setting] = $theme->settings->$setting;
            }
        }

        $templatecontext['disablebottomfooter'] = false;
        if (!empty($theme->settings->disablebottomfooter)) {
            $templatecontext['disablebottomfooter'] = true;
        }

        return $templatecontext;
    }

    /**
     * Get config theme slideshow
     *
     * @return array
     */
    public function slideshow() {
        global $OUTPUT;

        $theme = theme_config::load('moove');

        $templatecontext['sliderenabled'] = $theme->settings->sliderenabled;

        if (empty($templatecontext['sliderenabled'])) {
            return $templatecontext;
        }

        $slidercount = $theme->settings->slidercount;

        for ($i = 1, $j = 0; $i <= $slidercount; $i++, $j++) {
            $sliderimage = "sliderimage{$i}";
            $slidertitle = "slidertitle{$i}";
            $slidercap = "slidercap{$i}";

            $templatecontext['slides'][$j]['key'] = $j;
            $templatecontext['slides'][$j]['active'] = false;

            $image = $theme->setting_file_url($sliderimage, $sliderimage);
            if (empty($image)) {
                $image = $OUTPUT->image_url('slide_default', 'theme');
            }
            $templatecontext['slides'][$j]['image'] = $image;
            $templatecontext['slides'][$j]['title'] = $theme->settings->$slidertitle;
            $templatecontext['slides'][$j]['caption'] = $theme->settings->$slidercap;

            if ($i === 1) {
                $templatecontext['slides'][$j]['active'] = true;
            }
        }

        return $templatecontext;
    }

    /**
     * Get config theme marketing itens
     *
     * @return array
     */
    public function marketing_items() {
        global $OUTPUT;

        $theme = theme_config::load('moove');

        $templatecontext = [];

        for ($i = 1; $i < 5; $i++) {
            $marketingicon = 'marketing' . $i . 'icon';
            $marketingheading = 'marketing' . $i . 'heading';
            $marketingsubheading = 'marketing' . $i . 'subheading';
            $marketingcontent = 'marketing' . $i . 'content';
            $marketingurl = 'marketing' . $i . 'url';

            $templatecontext[$marketingicon] = $OUTPUT->image_url('icon_default', 'theme');
            if (!empty($theme->settings->$marketingicon)) {
                $templatecontext[$marketingicon] = $theme->setting_file_url($marketingicon, $marketingicon);
            }

            $templatecontext[$marketingheading] = '';
            if (!empty($theme->settings->$marketingheading)) {
                $templatecontext[$marketingheading] = theme_moove_get_setting($marketingheading, true);
            }

            $templatecontext[$marketingsubheading] = '';
            if (!empty($theme->settings->$marketingsubheading)) {
                $templatecontext[$marketingsubheading] = theme_moove_get_setting($marketingsubheading, true);
            }

            $templatecontext[$marketingcontent] = '';
            if (!empty($theme->settings->$marketingcontent)) {
                $templatecontext[$marketingcontent] = theme_moove_get_setting($marketingcontent, true);
            }

            $templatecontext[$marketingurl] = '';
            if (!empty($theme->settings->$marketingurl)) {
                $templatecontext[$marketingurl] = $theme->settings->$marketingurl;
            }
        }

        return $templatecontext;
    }

    /**
     * Get the frontpage numbers
     *
     * @return array
     */
    public function numbers() {
        global $DB;

        $templatecontext['numberusers'] = $DB->count_records('user', array('deleted' => 0, 'suspended' => 0)) - 1;
        $templatecontext['numbercourses'] = $DB->count_records('course', array('visible' => 1)) - 1;
        $templatecontext['numberactivities'] = $DB->count_records('course_modules');



        return $templatecontext;
    }

    /**
     * Get config theme sponsors logos and urls
     *
     * @return array
     */
    public function sponsors() {
        $theme = theme_config::load('moove');

        $templatecontext['sponsorstitle'] = $theme->settings->sponsorstitle;
        $templatecontext['sponsorssubtitle'] = $theme->settings->sponsorssubtitle;

        $sponsorscount = $theme->settings->sponsorscount;

        for ($i = 1, $j = 0; $i <= $sponsorscount; $i++, $j++) {
            $sponsorsimage = "sponsorsimage{$i}";
            $sponsorsurl = "sponsorsurl{$i}";

            $image = $theme->setting_file_url($sponsorsimage, $sponsorsimage);
            if (empty($image)) {
                continue;
            }

            $templatecontext['sponsors'][$j]['image'] = $image;
            $templatecontext['sponsors'][$j]['url'] = $theme->settings->$sponsorsurl;

        }

        return $templatecontext;
    }

    /**
     * Get config theme clients logos and urls
     *
     * @return array
     */
    public function clients() {
        $theme = theme_config::load('moove');

        $templatecontext['clientstitle'] = $theme->settings->clientstitle;
        $templatecontext['clientssubtitle'] = $theme->settings->clientssubtitle;

        $clientscount = $theme->settings->clientscount;

        for ($i = 1, $j = 0; $i <= $clientscount; $i++, $j++) {
            $clientsimage = "clientsimage{$i}";
            $clientsurl = "clientsurl{$i}";

            $image = $theme->setting_file_url($clientsimage, $clientsimage);
            if (empty($image)) {
                continue;
            }

            $templatecontext['clients'][$j]['image'] = $image;
            $templatecontext['clients'][$j]['url'] = $theme->settings->$clientsurl;

        }

        return $templatecontext;
    }
    //custom

     public static function role_courses_teacher_slider($courseid)
    {
        global $DB,$CFG;
        $arrc = array();
        $imgurl = $CFG->wwwroot."/theme/moove/pix/f2.png";
        $imgdefault = \html_writer::empty_tag('img',array('data-src' => $imgurl,'class'=>'userpicture defaultuserpic owl-lazy','width' => '50px','height'=>'50px','alt' => 'Default picture','title'=>'Default picture'));
        $sql = "SELECT concat(u.firstname,' ',u.lastname) as fullnamet,(select COUNT(*) as sts
        FROM {user_enrolments} ue
        JOIN {enrol} e ON ue.enrolid = e.id
        JOIN {course} c ON e.courseid = c.id
        JOIN {role_assignments} ra ON ra.userid = ue.userid
        JOIN {context} as ct on ra.contextid= ct.id AND ct.instanceid = c.id
        where ra.roleid=5 and c.id=?) as studentnumber,u.id
        from {role_assignments} as ra
        join {user} as u on u.id= ra.userid
        join {user_enrolments} as ue on ue.userid=u.id
        join {enrol} as e on e.id=ue.enrolid
        join {course} as c on c.id=e.courseid
        join {context} as ct on ct.id=ra.contextid and ct.instanceid= c.id
        join {role} as r on r.id= ra.roleid
        where c.id=? and ra.roleid=3";
        $rolecourse = $DB->get_records_sql($sql,array($courseid,$courseid));
        
        if (!empty($rolecourse)) 
        {
             foreach ($rolecourse as $value) 
             {
                $infoteacher = new stdclass();
                $infoteacher = $value;
             } 
         }
          else
          {
                    $infoteacher = new stdClass();
                    $infoteacher->fullnamet = get_string('noteacher', 'theme_moove');
                    $infoteacher->studentnumber = 0;
                    $infoteacher->imgdefault = $imgdefault;
          }
           return $infoteacher;

        // var_dump($rolecourse);die();

    }
    public static function role_courses_teacher_slider_block_course_recent($courseid)
    {
        global $DB,$CFG;
        $arrc = array();
        $imgurl = $CFG->wwwroot."/theme/moove/pix/f2.png";
        $imgdefault = \html_writer::empty_tag('img',array('src' => $imgurl,'class'=>'userpicture defaultuserpic owl-lazy','width' => '50px','height'=>'50px','alt' => 'Default picture','title'=>'Default picture'));
        $sql = "SELECT concat(u.firstname,' ',u.lastname) as fullnamet,u.email,(select COUNT(*) as sts
        FROM {user_enrolments} ue
        JOIN {enrol} e ON ue.enrolid = e.id
        JOIN {course} c ON e.courseid = c.id
        JOIN {role_assignments} ra ON ra.userid = ue.userid
        JOIN {context} as ct on ra.contextid= ct.id AND ct.instanceid = c.id
        where ra.roleid=5 and c.id=?) as studentnumber,u.id
        from {role_assignments} as ra
        join {user} as u on u.id= ra.userid
        join {user_enrolments} as ue on ue.userid=u.id
        join {enrol} as e on e.id=ue.enrolid
        join {course} as c on c.id=e.courseid
        join {context} as ct on ct.id=ra.contextid and ct.instanceid= c.id
        join {role} as r on r.id= ra.roleid
        where c.id=? and ra.roleid=3";
        $rolecourse = $DB->get_records_sql($sql,array($courseid,$courseid));
        
        if (!empty($rolecourse)) 
        {
             foreach ($rolecourse as $value) 
             {
                $infoteacher = new stdclass();
                $infoteacher = $value;
             } 
         }
          else
          {
                    $infoteacher = new stdClass();
                    $infoteacher->fullnamet = get_string('noteacher', 'theme_moove');
                    $infoteacher->studentnumber = 0;
                    $infoteacher->imgdefault = $imgdefault;
          }
           return $infoteacher;

        // var_dump($rolecourse);die();

    }

    public static function role_courses_teacher($courseid)
    {
        global $DB,$CFG;
        $arrc = array();
        $imgurl = $CFG->wwwroot."/theme/moove/pix/f2.png";
        $imgdefault = \html_writer::empty_tag('img',array('src' => $imgurl,'class'=>'userpicture defaultuserpic','width' => '50px','height'=>'50px','alt' => 'Default picture','title'=>'Default picture'));
        $sql = "SELECT concat(u.firstname,' ',u.lastname) as fullnamet,(SELECT COUNT(*) as sts
                    FROM {user_enrolments} ue
                    JOIN {enrol} e ON ue.enrolid = e.id
                    JOIN {course} c ON e.courseid = c.id
                    JOIN {role_assignments} ra ON ra.userid = ue.userid
                    JOIN {context} as ct on ra.contextid= ct.id AND ct.instanceid = c.id
                    WHERE ra.roleid=5 and c.id=?) as studentnumber,u.id
                    FROM {role_assignments} as ra
                    JOIN {user} as u on u.id= ra.userid
                    JOIN {user_enrolments} as ue on ue.userid=u.id
                    JOIN {enrol} as e on e.id=ue.enrolid
                    JOIN {course} as c on c.id=e.courseid
                    JOIN {context} as ct on ct.id=ra.contextid and ct.instanceid= c.id
                    JOIN {role} as r on r.id= ra.roleid
                    where c.id=? and ra.roleid=3";
        $rolecourse = $DB->get_records_sql($sql,array($courseid,$courseid));
        
        if (!empty($rolecourse)) 
        {
             foreach ($rolecourse as $value) 
             {
                $infoteacher = new stdclass();
                $infoteacher = $value;
             } 
         }
          else
          {
                    $infoteacher = new stdClass();
                    $infoteacher->fullnamet = get_string('noteacher', 'theme_moove');
                    $infoteacher->studentnumber = 0;
                    $infoteacher->imgdefault = $imgdefault;
          }
           return $infoteacher;

    }


    //Lấy thông tin tát cả giáo viên trong khóa
    public static function role_courses_all_teacher($courseid)
    {
        global $DB,$CFG;
        $arrc = array();
        $imgurl = $CFG->wwwroot."/theme/moove/pix/f2.png";
        $imgdefault = \html_writer::empty_tag('img',array('src' => $imgurl,'class'=>'userpicture defaultuserpic','width' => '50px','height'=>'50px','alt' => 'Default picture','title'=>'Default picture'));
        $sql = "SELECT concat(u.firstname,' ',u.lastname) as fullnamet,u.email,u.phone1,u.phone2,(SELECT COUNT(*) as sts
                    FROM {user_enrolments} ue
                    JOIN {enrol} e ON ue.enrolid = e.id
                    JOIN {course} c ON e.courseid = c.id
                    JOIN {role_assignments} ra ON ra.userid = ue.userid
                    JOIN {context} as ct on ra.contextid= ct.id AND ct.instanceid = c.id
                    WHERE ra.roleid=5 and c.id=?) as studentnumber,u.id
                    FROM {role_assignments} as ra
                    JOIN {user} as u on u.id= ra.userid
                    JOIN {user_enrolments} as ue on ue.userid=u.id
                    JOIN {enrol} as e on e.id=ue.enrolid
                    JOIN {course} as c on c.id=e.courseid
                    JOIN {context} as ct on ct.id=ra.contextid and ct.instanceid= c.id
                    JOIN {role} as r on r.id= ra.roleid
                    where c.id=? and ra.roleid=3";
        $rolecourse = $DB->get_records_sql($sql,array($courseid,$courseid));
        
        if(empty($rolecourse)) {
          $infoteacher = new stdClass();
          $infoteacher->fullnamet = get_string('noteacher', 'theme_moove');
          $infoteacher->studentnumber = 0;
          $infoteacher->imgdefault = $imgdefault;
        } else {
          $infoteacher = array();
          $infoteacher = $rolecourse;
        }
        return $infoteacher;
    }


    /**
     * [user_courses_list description]
     * Lấy danh sách khoá học cho slider
     * pinned = 1, required = 1 : Khoá học bắt buộc chung
     * pinned = 1 : Khoá học đc ghim
     * pinned = 0 : Khoá học bắt buộc
     * suggest = 1 : Khoá học đề xuất theo vị trí
     * planid = 0 : ID kế hoạch cá nhân của user
     * userplancourse = 1 : Khoá học theo kế hoạch cá nhân
     * @param  integer $pinned         [description]
     * @param  integer $required       [description]
     * @param  integer $suggest        [description]
     * @param  integer $userplancourse [description]
     * @param  integer $planid [description]
     * @return [type]                  [description]
     */
    public static function user_courses_list($pinned = 1, $required = null, $suggest = null, $userplancourse = null, $planid = 0) {
        global $USER,$CFG,$DB,$OUTPUT;

        require_once($CFG->dirroot.'/course/renderer.php');
        require_once($CFG->dirroot.'/local/newsvnr/lib.php');

        $chelper = new \coursecat_helper();
        
        if($pinned == 1) {
            $courses = $DB->get_records_sql("SELECT TOP(8) * 
                FROM {course} 
                WHERE pinned = 1");
        } elseif($required == 1) {
            $courses = $DB->get_records_sql("SELECT DISTINCT c.* 
                FROM {course} c 
                JOIN {course_position} cp ON c.id = cp.course 
                WHERE c.required = 1 AND cp.courseofposition = ?",[$USER->orgpositionid]);
        } elseif($suggest == 1) {
            $courses = $DB->get_records_sql("SELECT * 
                FROM (
                    SELECT DISTINCT TOP(8) c.* 
                    FROM {course_position} cp 
                    JOIN {course} c ON cp.course = c.id
                    WHERE cp.courseofposition = ?
                    ) AS t
                ORDER BY NEWID()", [$USER->orgpositionid]);
        } elseif($userplancourse == 1) {
            $plans = array_values(competency_api::list_user_plans($USER->id));
            if (empty($plans)) {
                return [];
            }
                $pclist = competency_api::list_plan_competencies($planid);
                $ucproperty = 'competency';
                $listcomp = [];
                foreach ($pclist as $pc) {
                    $usercomp = $pc->$ucproperty;
                    if ($usercomp->get('id')) {
                        $listcomp[] = $usercomp->get('id');
                    }
                }
            $listuserplancourse = [];
            $courses = [];
            $listcourseid = [];
            foreach ($listcomp as $competency) {
                $listuserplancourse[] = competency_api::list_courses_using_competency($competency);
            }
            foreach ($listuserplancourse as $course) {
                foreach ($course as  $courseid) {
                    if (in_array($courseid->id, $listcourseid))
                        continue;
                    else
                        $courses[] = $DB->get_record("course", ['id' => $courseid->id], '*');
                    $listcourseid[] = $courseid->id;
                }
            }
        } elseif($pinned == 0) {
            //khoá học bắt buộc chung
            $courses = $DB->get_records_sql("SELECT c.* from {course} c where c.required = 1");

        }
    
        foreach ($courses as $course) {
            $course->fullname = strip_tags($chelper->get_course_formatted_name($course));
            $courseobj = new \core_course_list_element($course);
            $course->link = $CFG->wwwroot."/course/view.php?id=".$course->id;
            $course->summary = strip_tags($chelper->get_course_formatted_summary($courseobj,array('overflowdiv' => false, 'noclean' => false, 'para' => false)));
            $course->courseimage = self::get_course_images_slider($courseobj, $course->link);
            $courseid = $course->id;
            $arr = self::role_courses_teacher_slider($courseid);
            $course->fullnamet = $arr->fullnamet;
            $course->countstudent = $arr->studentnumber;
            // $course->enrolmethod = get_enrol_method($course->id);
            if (isset($arr->id)) {
              $stduser = new stdClass();
              $userid = $DB->get_records('user',array('id' => $arr->id));
              foreach ($userid as $userdata)
                 $stduser = (object)$userdata;

               $course->imageteacher = $OUTPUT->user_picture($stduser, array('size'=>72));
            }
            else
            {
              $course->imageteacher = $arr->imgdefault;
            }
        }
        // var_dump($courses);die;
        return array_values($courses);

    }
    /**
     * Returns the first course's summary issue
     *
     * @param $course
     * @param $courselink
     *
     * @return string
     */
    public static function get_course_images($course, $courselink) {
        global $CFG;

        $contentimage = '';
        foreach ($course->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $url = file_encode_url("$CFG->wwwroot/pluginfile.php",
                '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
            if ($isimage) {
                $contentimage = \html_writer::link($courselink, \html_writer::empty_tag('img', array(
                    'src' => $url,
                    'alt' => $course->fullname,
                    'class' => 'img-responsive',
                )));
                break;
            }
        }

        if (empty($contentimage)) {
            $url = $CFG->wwwroot . "/theme/moove/pix/default_course.jpg";

            $contentimage = \html_writer::link($courselink, \html_writer::empty_tag('img', array(
                'src' => $url,
                'alt' => $course->fullname,
                'class' => 'img-responsive',
            )));
        }

        return $contentimage;
    }

     /**
     * Returns the first course's summary issue
     *
     * @param $course
     * @param $courselink
     *
     * @return string
     */
    public static function get_course_images_nav($course, $courselink) {
        global $CFG;

        $contentimage = '';
        foreach ($course->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $url = file_encode_url("$CFG->wwwroot/pluginfile.php",
                '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
            if ($isimage) {
                $contentimage = \html_writer::link($courselink, \html_writer::empty_tag('img', array(
                    'src' => $url,
                    'alt' => $course->fullname,
                    'style' => 'height:100px; max-width: 100%; width: auto;'
                )));
                break;
            }
        }

        if (empty($contentimage)) {
            $url = $CFG->wwwroot . "/theme/moove/pix/default_course.jpg";

            $contentimage = \html_writer::link($courselink, \html_writer::empty_tag('img', array(
                'src' => $url,
                'alt' => $course->fullname,
                'style' => 'height:100px; max-width: 100%; width: auto;'
            )));
        }

        return $contentimage;
    }

    public static function get_course_images_slider($course, $courselink) {
        global $CFG;

        $contentimage = '';
        foreach ($course->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();
            $url = file_encode_url("$CFG->wwwroot/pluginfile.php",
                '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                $file->get_filearea(). $file->get_filepath(). $file->get_filename(), !$isimage);
            if ($isimage) {
                $contentimage = \html_writer::link($courselink, \html_writer::empty_tag('img', array(
                    'data-src' => $url,
                    'alt' => $course->fullname,
                    'class' => 'img-responsive owl-lazy',
                )));
                break;
            }
        }

        if (empty($contentimage)) {
            $url = $CFG->wwwroot . "/theme/moove/pix/default_course.jpg";

            $contentimage = \html_writer::link($courselink, \html_writer::empty_tag('img', array(
                'data-src' => $url,
                'alt' => $course->fullname,
                'class' => 'img-responsive owl-lazy',
            )));
        }

        return $contentimage;
    }

    public function get_btn_add_news()
    {
        global $OUTPUT,$USER, $DB;
        if(has_capability('moodle/site:configview', context_system::instance()))
        { 
            $forumid = $DB->get_field_sql("SELECT TOP 1 id FROM mdl_forum", []);
            $buttonadd = get_string('addanewdiscussion', 'forum');
            $button = new single_button(new moodle_url('/mod/forum/post.php', ['forum' => $forumid]), $buttonadd, 'get');
            $button->class = 'singlebutton forumaddnew';
            $button->formid = 'newdiscussionform';
            $renderbtn = $OUTPUT->render($button);
            $templatecontext['btnaddnews'] = $renderbtn;
             return $templatecontext;
        }
        else 
        {   $templatecontext['btnaddnews'] = '';
            return $templatecontext;   
        } 
           
    }
   /**
     * [user_courses_list description]
     * Lấy danh sách khoá học cho slide
     * pinned = 1, required = 1 : Khoá học bắt buộc chung
     * pinned = 1 : Khoá học đc ghim
     * pinned = 0 : Khoá học bắt buộc
     * suggest = 1 : Khoá học đề xuất theo vị trí
     * planid = 0 : ID kế hoạch cá nhân của user
     * userplancourse = 1 : Khoá học theo kế hoạch cá nhân
     * @param  integer $pinned         [description]
     * @param  integer $required       [description]
     * @param  integer $suggest        [description]
     * @param  integer $userplancourse [description]
     * @param  integer $planid [description]
     * @return [array]                  [description]
     */
    public function get_courses_data($pinned = 1, $required = null, $suggest = null, $userplancourse = null, $planid = 0)
    {
        global $DB, $USER;
        $arr = array();
        $courses = self::user_courses_list($pinned, $required, $suggest, $userplancourse, $planid);
        // $templatecontext['courseendable'] = "1";
        $templatecontext = [];
        $templatecontext['hascourse'] = 1;
        foreach ($courses as $key => $value) {        
            $arr[] = (array)$value;
        }

        for ($i = 1, $j = 0; $i <= count($courses); $i++, $j++) {
            $enrolmethod = get_enrol_method($courses[$j]->id);
            $progress = \core_completion\progress::get_course_progress_percentage($courses[$j],$USER->id);
            $templatecontext['newscourse'][$j]['key'] = $j;
            $templatecontext['newscourse'][$j]['fullname'] = $arr[$j]['fullname'];
            $templatecontext['newscourse'][$j]['summary'] = $arr[$j]['summary'];
            $templatecontext['newscourse'][$j]['link'] = $arr[$j]['link'];
            $templatecontext['newscourse'][$j]['courseimage'] = $arr[$j]['courseimage'];
            $templatecontext['newscourse'][$j]['countstudent'] = $arr[$j]['countstudent'];
            $templatecontext['newscourse'][$j]['imageteacher'] = $arr[$j]['imageteacher'];
            $templatecontext['newscourse'][$j]['fullnamet'] = $arr[$j]['fullnamet'];
            if(isset($progress)) {
                $templatecontext['newscourse'][$j]['progress'] = round($progress);
                if($templatecontext['newscourse'][$j]['progress'] == 0)
                    $templatecontext['newscourse'][$j]['progress'] = -1;
            } else {
                $templatecontext['newscourse'][$j]['enrolmethod'] = $enrolmethod;
            }
        }
        // var_dump($templatecontext);die;
        return $templatecontext;

    }
    public function get_module_data() {
        $moduleadmin = array((object) array('moduleicon'=>'mod_book','modulename'=>'Book','value'=>'book'),
                      (object) array('moduleicon'=>'mod_imscp','modulename'=>'SCORM package','value'=>'imscp'),
                      (object) array('moduleicon'=>'mod_lesson','modulename'=>'Lesson','value'=>'lesson'),
                      (object) array('moduleicon'=>'mod_page','modulename'=>'Page','value'=>'page'));
        $moduleuser = array((object) array('moduleicon'=>'mod_url','modulename'=>'Url','value'=>'url'),
                      (object) array('moduleicon'=>'mod_resource','modulename'=>'File','value'=>'resource'));
        if(is_siteadmin()) {
            $data = array_merge($moduleadmin,$moduleuser);
        } else {
            $data = $moduleuser;
        }
        $templatecontext = [];
        $arr = array();
        foreach ($data as $key => $value) {        
            $arr[] = (array)$value;
        }
        for ($i = 0 ;$i < count($data); $i++) {
          $templatecontext['module'][$i] = $arr[$i];
        }
        return $templatecontext;
    }

    public function get_news_data()
    {
        global $OUTPUT,$DB,$CFG,$USER;

        $arr = array();
        $sql = "SELECT p.subject, LEFT(p.message, 500) as message, d.name,d.id,d.forum,d.course,p.id as postid FROM {forum} as f
        LEFT JOIN  {forum_discussions} as d on f.id  = d.forum 
        INNER JOIN {forum_posts} as p on d.id = p.discussion
        where f.type = ? and d.pinned= ? 
        ";  
        $data = $DB->get_records_sql($sql,array('news',1));
        $templatecontext['sliderenabled'] = "1";
        foreach ($data as $key => $value) {        
            $arr[] = (array)$value;
        }
        for ($i = 1, $j = 0; $i <= count($data); $i++, $j++) {
            $templatecontext['newslides'][$j]['key'] = $j;
            $templatecontext['newslides'][$j]['active'] = false;
            $fs = get_file_storage();
            $imagereturn = '';

            $post = $DB->get_record('forum_posts',['id' => $arr[$j]['postid']]);
            $cm = get_coursemodule_from_instance('forum', $arr[$j]['forum'], $arr[$j]['course'], false, MUST_EXIST);
            $context = context_module::instance($cm->id);
            $files = $fs->get_area_files($context->id, 'mod_forum', 'attachment', $post->id, "filename", false);
           
            if ($files) {
                foreach ($files as $file) {
                    $filename = $file->get_filename();
                    $mimetype = $file->get_mimetype();
                    $iconimage = $OUTPUT->pix_icon(file_file_icon($file), get_mimetype_description($file), 'moodle', array('class' => 'icon'));
                    $path = file_encode_url($CFG->wwwroot.'/pluginfile.php', '/'.$context->id.'/mod_forum/attachment/'.$post->id.'/'.$filename);
                    $imagereturn .= "<img class='owl-lazy' data-src=\"$path\" alt=\"\" />";
                }
            }
            
            
            

            if(!$imagereturn) {
              $courseimage = $OUTPUT->get_generated_image_for_id($arr[$j]['postid']);
              $imagereturn = "<div style='background-image: url($courseimage); width: 100%;
    height: 85%;'></div>";
            }

            $templatecontext['newslides'][$j]['subject'] = $arr[$j]['subject'];
            $templatecontext['newslides'][$j]['message'] = strip_tags($arr[$j]['message']);
            $templatecontext['newslides'][$j]['name'] = $arr[$j]['name'];
            $templatecontext['newslides'][$j]['image'] = $imagereturn;
            $templatecontext['newslides'][$j]['newurl'] = $CFG->wwwroot."/local/newsvnr/news.php?id=".$arr[$j]['id'];
            if ($i === 1) {
                $templatecontext['newslides'][$j]['active'] = true;
            }
        }
        return $templatecontext;
    }



    public function get_discussions_data()
    {
        global $CFG,$DB;
        $arr = array();
        $sql = "SELECT fd.id,fd.name,c.fullname,c.id as courseid,u.id as userid,
        (select top 1 fp.message from mdl_forum_posts fp where fp.discussion = fd.id order by created desc) as postmessage,
        (select top 1 fp.created from mdl_forum_posts fp where fp.discussion = fd.id order by created desc) as lastpost, 
        CONCAT(u.firstname,' ',u.lastname) as ufullname
        from mdl_forum f 
        left join mdl_forum_discussions fd on f.id = fd.forum
        left join mdl_course c on fd.course = c.id
        left join (
        select fp1.* from mdl_forum_posts fp1
        left join mdl_forum_posts fp2 on fp1.discussion = fp2.discussion and fp1.created > fp2.created
        where fp2.id is null
        ) fp on fp.discussion = fd.id 
        left join mdl_user u on fp.userid = u.id
        where (f.type IN(?,?,?)) and fd.pinned = ?
        ";
        $data = $DB->get_records_sql($sql,array('news','general','blog',1));
          $templatecontext['hasforum'] = 0;
        
        if($data) {
          $templatecontext['hasforum'] = 1;
        }
        foreach ($data as $forum) {
            $date = new DateTime("@$forum->lastpost");
            $lastpost = $date->format('l, d m Y, H:i: A');
            $courselink = $CFG->wwwroot."/course/view.php?id=".$forum->courseid;
            $discusslink = $CFG->wwwroot."/mod/forum/discuss.php?d=".$forum->id;
            $userlink = $CFG->wwwroot."/user/view.php?id=".$forum->userid."&course=".$forum->courseid;
            $timelink = $CFG->wwwroot."/mod/forum/discuss.php?d=".$forum->id."&parent=".$forum->courseid;
            $forum->postmessage = strip_tags($forum->postmessage);
            $forum->discussurl = \html_writer::link($discusslink,$forum->name);
            $forum->courseurl = \html_writer::link($courselink,$forum->fullname);
            $forum->userurl = \html_writer::link($userlink,$forum->ufullname);
            $forum->timeurl = $lastpost;

        }
        $templatecontext['forumdata'] = array_values($data);
        return $templatecontext;

    }

    // Get dữ liệu cho dashboard
    public function get_fullinfo_user() {
        global $CFG, $USER, $OUTPUT, $DB, $COURSE;

        require_once $CFG->libdir . '/completionlib.php';
        require_once $CFG->dirroot . '/blocks/dedication/dedication_lib.php';

        $obj = new stdClass;
        $obj->fullname = fullname($USER);
        $obj->usercode = $USER->usercode;
        $obj->userimg = $OUTPUT->user_picture($USER, array('size'=>35));
        $obj->userimgbig = $OUTPUT->user_picture($USER, array('size'=>80));
        $obj->userlink = $CFG->wwwroot . '/user/profile.php?id='.$USER->id ;
        $obj->email = $USER->email;
        // Kỳ thi 
        $exam = $DB->get_records('exam_user',['userid' => $USER->id]);
        $obj->exam = count($exam);
        // Huy hiệu cá nhân 
        $badge = $DB->get_records('badge_issued',['userid' => $USER->id]);
        $obj->badge = count($badge);
        // lỘ trình học
        $competency_plan = $DB->get_records_sql('SELECT * FROM mdl_competency_plan WHERE userid =:userid',['userid' => $USER->id]);
        $obj->competency_plan = count($competency_plan);
        // lấy danh sách năng lực
        $competency = $DB->get_records_sql('SELECT * FROM {competency_usercomp} WHERE status=0 AND reviewerid IS NOT NULL AND proficiency=1 AND grade IS NOT NULL AND userid =:userid',['userid' => $USER->id]);
        $obj->competency = count($competency);
        // lấy số bài post diễn đàn
        $forumpost = $DB->get_records('forum_posts',['parent' => 0,'userid' => $USER->id]);
        $obj->forumpost = count($forumpost);
        $courses = enrol_get_all_users_courses($USER->id);
        $listcourse = get_list_course_by_student($USER->id);
        $count_course_comletion = 0;
        $timespenttotal = 0;
        array_merge($courses, (array)$COURSE);
        foreach($courses as $course) {
            $cinfo = new completion_info($course);
            $iscomplete = $cinfo->is_course_complete($USER->id);
            if($iscomplete == true) {
                $count_course_comletion++;
            }

            // Số giờ truy cập của user
            $dm = new block_dedication_manager($course, $course->startdate, time(), 3600);
            $rows = $dm->get_user_dedication($USER);
            foreach ($rows as $index => $row) {
                $timespenttotal += $row->dedicationtime;
            }
        }
        $obj->timespent = block_dedication_utils::format_dedication($timespenttotal);
        $obj->coursestotal = count($listcourse);
        $obj->completedcoures = $count_course_comletion;
        $obj->progresscoures = count($courses) - $count_course_comletion;
        $templatecontext['userinfo'] = $obj;
        return $templatecontext;
    }
    // get dữ liệu cho dashboard giáo viên: thông báo và khóa học không có content
    public function get_data_dashboard_teacher() {
      global $DB, $USER;
      $obj = new stdClass;

      // Khóa học chưa có content
      $courseemptytotalsql = "SELECT c.fullname, COUNT(cm.module) module
                                  FROM mdl_role_assignments AS ra
                                      JOIN mdl_user AS u ON u.id= ra.userid
                                      JOIN mdl_user_enrolments AS ue ON ue.userid=u.id
                                      JOIN mdl_enrol AS e ON e.id=ue.enrolid
                                      JOIN mdl_course AS c ON c.id=e.courseid
                                      JOIN mdl_context AS ct ON ct.id=ra.contextid AND ct.instanceid= c.id
                                      JOIN mdl_role AS r ON r.id= ra.roleid
                                      JOIN mdl_course_modules cm ON cm.course = c.id
                                  WHERE  ra.roleid = 3 AND u.id = :userid 
                                  GROUP BY c.fullname
                                  HAVING COUNT(cm.module) <= 1";
      $courseemptytotal = $DB->get_records_sql($courseemptytotalsql, ['userid' => $USER->id]);
      $obj->courseemptytotal = count($courseemptytotal);

      // Tổng học viên các khóa học của giáo viên
      $strcourseid = get_list_courseid_by_teacher($USER->id);
      $courses     = explode(',', $strcourseid);
      $obj->coursestotal = count($courses);
      $studenttotal = 0;
      foreach ($courses as $course) {
          $studenttotalsql = "
                  SELECT COUNT(u.id) as numberstudent
                  FROM mdl_role_assignments ra
                      JOIN mdl_user u ON ra.userid = u.id
                      JOIN mdl_user_enrolments ue ON u.id = ue.userid 
                      JOIN mdl_enrol enr ON ue.enrolid = enr.id
                      JOIN mdl_course c ON enr.courseid = c.id
                      JOIN mdl_context ct ON ct.id = ra.contextid AND ct.instanceid = c.id
                      JOIN mdl_role r ON ra.roleid = r.id
                  WHERE ra.roleid= 5 AND c.id = :courseid";
          $listuser = array_values($DB->get_records_sql($studenttotalsql, ['courseid' => $course]));
          $studenttotal = $studenttotal + $listuser[0]->numberstudent;
      }
      $obj->studenttotal = $studenttotal;

      // Các kỳ thi của giáo viên
      $examtotal = $DB->get_records('exam_user',['userid' => $USER->id, 'roleid' => 4]);
      $obj->examtotal = count($examtotal);

      // Tổng module giáo viên đã upload trên các khóa của giáo viên đó
      $moduletotal = $DB->get_record_sql("SELECT COUNT(id) moduletotal
                                          FROM mdl_logstore_standard_log
                                          WHERE userid = :userid AND action = 'created' AND target = 'course_module' AND courseid <> 1", ['userid' => $USER->id]);
      $obj->moduletotal = $moduletotal->moduletotal;

      $templatecontext['teacherinfo'] = $obj;
      return $templatecontext;
    }
    // chuyển đổi dashboard mới và cũ(3.7 và 3.9)
    public function get_vnr_dashboard_config() {
        $theme = theme_config::load('moove');
        $templatecontext['switch_dashboard'] = $theme->settings->switch_dashboard;
        return $templatecontext;
    }

}
