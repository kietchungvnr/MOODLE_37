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
* Adds or updates modules in a course using new formslib
*
* @package    moodlecore
* @copyright  1999 onwards Martin Dougiamas (http://dougiamas.com)
* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
*/

require_once("../config.php");
require_once("lib.php");
require_once($CFG->libdir.'/filelib.php');
require_once($CFG->libdir.'/gradelib.php');
require_once($CFG->libdir.'/completionlib.php');
require_once($CFG->libdir.'/plagiarismlib.php');
require_once($CFG->dirroot . '/course/modlib.php');
require_once($CFG->dirroot . '/local/newsvnr/lib.php');
require_once($CFG->dirroot . '/calendar/lib.php');

$add    = optional_param('add', '', PARAM_ALPHANUM);     // Module name.
$update = optional_param('update', 0, PARAM_INT);
$return = optional_param('return', 0, PARAM_BOOL);    //return to course/view.php if false or mod/modname/view.php if true
$type   = optional_param('type', '', PARAM_ALPHANUM); //TODO: hopefully will be removed in 2.0
$sectionreturn = optional_param('sr', null, PARAM_INT);
$folderid = optional_param('folderid', 0, PARAM_INT);
$examsubjectexamid = optional_param('examsubjectexamid', 0, PARAM_INT);
$url = new moodle_url('/course/modedit.php');
$url->param('sr', $sectionreturn);
    if (!empty($return)) {
    $url->param('return', $return);
}
if (!empty($add)) {
    $section = required_param('section', PARAM_INT);
    $course  = required_param('course', PARAM_INT);
    //tạo module theo thư mục , chỉ dùng cho course = 1


    $url->param('add', $add);
    $url->param('folderid', $folderid);
    $url->param('examsubjectexamid', $examsubjectexamid);
    $url->param('section', $section);
    $url->param('course', $course);
    $PAGE->set_url($url);

    $course = $DB->get_record('course', array('id'=>$course), '*', MUST_EXIST);
    require_login($course);

    // There is no page for this in the navigation. The closest we'll have is the course section.
    // If the course section isn't displayed on the navigation this will fall back to the course which
    // will be the closest match we have.
    navigation_node::override_active_url(course_get_url($course, $section));

    list($module, $context, $cw, $cm, $data) = prepare_new_moduleinfo_data($course, $add, $section);
    $data->return = 0;
    $data->sr = $sectionreturn;
    $data->add = $add;
    $data->folderid = $folderid;
    $data->examsubjectexamid = $examsubjectexamid;
    if (!empty($type)) { //TODO: hopefully will be removed in 2.0
        $data->type = $type;
    }

    $sectionname = get_section_name($course, $cw);
    $fullmodulename = get_string('modulename', $module->name);

    if ($data->section && $course->format != 'site') {
        $heading = new stdClass();
        $heading->what = $fullmodulename;
        $heading->to   = $sectionname;
        $pageheading = get_string('addinganewto', 'moodle', $heading);
    } else {
        $pageheading = get_string('addinganew', 'moodle', $fullmodulename);
    }
    $navbaraddition = $pageheading;

} else if (!empty($update)) {

    $url->param('update', $update);
    $PAGE->set_url($url);

    // Select the "Edit settings" from navigation.
    navigation_node::override_active_url(new moodle_url('/course/modedit.php', array('update'=>$update, 'return'=>1)));

    // Check the course module exists.
    $cm = get_coursemodule_from_id('', $update, 0, false, MUST_EXIST);

    // Check the course exists.
    $course = $DB->get_record('course', array('id'=>$cm->course), '*', MUST_EXIST);

    // require_login
    require_login($course, false, $cm); // needed to setup proper $COURSE

    list($cm, $context, $module, $data, $cw) = get_moduleinfo_data($cm, $course);
    $data->return = $return;
    $data->sr = $sectionreturn;
    $data->update = $update;

    $sectionname = get_section_name($course, $cw);
    $fullmodulename = get_string('modulename', $module->name);

    if ($data->section && $course->format != 'site') {
        $heading = new stdClass();
        $heading->what = $fullmodulename;
        $heading->in   = $sectionname;
        $pageheading = get_string('updatingain', 'moodle', $heading);
    } else {
        $pageheading = get_string('updatinga', 'moodle', $fullmodulename);
    }
    $navbaraddition = null;

} else {
    require_login();
    print_error('invalidaction');
}

$pagepath = 'mod-' . $module->name . '-';
if (!empty($type)) { //TODO: hopefully will be removed in 2.0
    $pagepath .= $type;
} else {
    $pagepath .= 'mod';
}
$PAGE->set_pagetype($pagepath);
$PAGE->set_pagelayout('admin');

$modmoodleform = "$CFG->dirroot/mod/$module->name/mod_form.php";
if (file_exists($modmoodleform)) {
    require_once($modmoodleform);
} else {
    print_error('noformdesc');
}
// Custom by Vũ: completion rule thời gian yêu cầu hoàn thành modole (resource)
if($data->modulename == 'resource' || $data->modulename == 'book') {
    $completiontimespent = $DB->get_field('course_modules_completion_rule', 'completiontimespent', ['moduleid' => $data->coursemodule]);
    if($completiontimespent) {
        $data->completiontimespent = (string)$completiontimespent;
        $data->completiontimespentenabled = 'checked';
        // $data->completiontimespent['timeunit'] = '1';
        // $data->completiontimespent['number'] = '1';
    }
}
$mformclassname = 'mod_'.$module->name.'_mod_form';
$mform = new $mformclassname($data, $cw->section, $cm, $course, $folderid, $examsubjectexamid);
$mform->set_data($data);

if ($mform->is_cancelled()) {
    if ($return && !empty($cm->id)) {
        $urlparams = [
            'id' => $cm->id, // We always need the activity id.
            'forceview' => 1, // Stop file downloads in resources.
        ];
        $activityurl = new moodle_url("/mod/$module->name/view.php", $urlparams);
        redirect($activityurl);
    } else {
        //Custom by Thang : Thêm điều kiện redirect khi course = 1
        if($course->id == SITEID) {
            redirect($CFG->wwwroot . $_SESSION['url']);
        } else {
            redirect(course_get_url($course, $cw->section, array('sr' => $sectionreturn)));
        }
    }
} else if ($fromform = $mform->get_data()) {
    // Custom by Vũ: Đẩy danh sách quiz qua hrm via api
    if($data->modulename == 'quiz') {
        $quiz_api = $DB->get_record('local_newsvnr_api',['functionapi' => 'CreateOrUpdateRecTest']);
        $params_el = [
                'TestName' => $fromform->name,
                'TestCode' =>  $fromform->code,
                'CourseCode' => $course->code
        ];
        if($quiz_api) {
            $getparams_hrm = $DB->get_records('local_newsvnr_api_detail', ['api_id' => $quiz_api->id]);
            $params_hrm = [];
            foreach ($getparams_hrm as $key => $value) {
                if(array_key_exists($value->client_params, $params_el)) {
                    $params_hrm[$value->client_params] = $params_el[$value->client_params];
                } else {
                    $params_hrm[$value->client_params] = $value->default_value;
                }
            }
            $url_hrm = $quiz_api->url;
        }
    }
    if (!empty($fromform->update)) {
        if($data->modulename == 'quiz' && isset($params_hrm)) {
            $params_hrm['Status'] = "E_UPDATE";
            HTTPPost($url_hrm, $params_hrm);
        }
        list($cm, $fromform) = update_moduleinfo($cm, $fromform, $course, $mform);
    } else if (!empty($fromform->add)) {
        if($data->modulename == 'quiz' && isset($params_hrm)) {
            $params_hrm['Status'] = "E_CREATE";
            HTTPPost($url_hrm, $params_hrm);
        }
        $fromform = add_moduleinfo($fromform, $course, $mform);
        //Dữ liệu insert vào table library_module khi course = 1 (thư viện trực tuyến)
        if($course->id == SITEID) {
            if($add != 'quiz') {
                $record = new stdClass();
                $record->folderid = $folderid;
                $record->timecreated = time();
                $record->userid = $USER->id;
                $record->coursemoduleid = $fromform->coursemodule;
                $record->moduletype = $fromform->modulename;
                if(!is_siteadmin()) {
                    $record->approval = 0;
                }
                if($fromform->modulename == 'resource') {
                    $getfile = $DB->get_record_sql("SELECT TOP 1 * 
                                                    FROM {files} 
                                                    where component = 'user' 
                                                        AND filearea = 'draft' 
                                                        AND itemid = :itemid 
                                                        AND filesize IS NOT NULL",array('itemid' => $fromform->files));
                    $record->minetype = $getfile->mimetype;
                    $record->filesize = $getfile->filesize;
                }
                
                $DB->insert_record('library_module',$record);
            }
            // Custom by Vũ: Dữ liệu insert vào table exam_quiz khi course = 1 và auto tạo sự kiện kỳ thi vào lịch theo (kì thi ngoài khóa)
            if($add == 'quiz') {
                $examrecord = new stdClass();
                $examrecord->coursemoduleid = $fromform->coursemodule;
                $examrecord->subjectexamid = $examsubjectexamid;
                $examrecord->timecreated = time();
                $examrecord->timemodified = time();
                $examrecord->usercreate = $USER->id;
                $examrecord->usermodified = $USER->id;
                $get_quizid = $DB->get_field('course_modules', 'instance', ['id' => $fromform->coursemodule]);
                $quizinfo = $DB->get_field('quiz', 'id', ['id' => $get_quizid]);
                // $get_subjectid = $DB->get_field('exam_subject_exam', 'subjectid', ['id' => $examsubjectexamid]);
                // $subjectname = $DB->get_field('exam_subject', 'name', ['id' => $get_subjectid]);
                $DB->insert_record('exam_quiz',$examrecord);
                $sql = "SELECT eu.userid, e.name
                        FROM {exam_subject_exam} esx
                            LEFT JOIN {exam_user} eu ON esx.examid = eu.examid
                            LEFT JOIN {exam} e ON e.id = esx.examid
                        WHERE esx.id = :subjectexamid";
                $listexamuser = $DB->get_records_sql($sql, ['subjectexamid' => $examsubjectexamid]);
                $calendarevents = [];
                foreach ($listexamuser as $examuser) {
                    $event = new stdClass();
                    $event->eventtype = 'open';
                    $event->type = CALENDAR_IMPORT_FROM_URL;
                    $event->name = $DB->get_field('quiz', 'name', ['id' => $get_quizid]);
                    $event->description = '';
                    $event->format = FORMAT_HTML;
                    $event->courseid = SITEID;
                    $event->groupid = 0;
                    $event->userid = $examuser->userid;
                    $event->modulename = 'quiz';
                    $event->instance = $quizinfo;
                    $event->timestart = time();
                    $event->timesort = time();
                    $event->timemodified = time();
                    calendar_event::create($event, false);
                }
            }
            // Custom by Vũ: Gửi email và thông báo lên chuông khi có yêu cầu duyệt file trong thư viện
            send_email_requestfile($fromform);
        }
    } else {
        print_error('invaliddata');
    }

    if (isset($fromform->submitbutton)) {
        $url = new moodle_url("/mod/$module->name/view.php", array('id' => $fromform->coursemodule, 'forceview' => 1));
        if (empty($fromform->showgradingmanagement)) {
            redirect($url);
        } else {
            redirect($fromform->gradingman->get_management_url($url));
        }
    } else {
        //Custom by Thang : Thêm điều kiện redirect khi course = 1
        if($course->id == SITEID) {
            redirect($CFG->wwwroot . $_SESSION['url']);
        } else {
            redirect(course_get_url($course, $cw->section, array('sr' => $sectionreturn)));
        }
    }
    exit;

} else {

    $streditinga = get_string('editinga', 'moodle', $fullmodulename);
    $strmodulenameplural = get_string('modulenameplural', $module->name);

    if (!empty($cm->id)) {
        $context = context_module::instance($cm->id);
    } else {
        $context = context_course::instance($course->id);
    }

    $PAGE->set_heading($course->fullname);
    $PAGE->set_title($streditinga);
    $PAGE->set_cacheable(false);

    if (isset($navbaraddition)) {
        $PAGE->navbar->add($navbaraddition);
    }

    echo $OUTPUT->header();

    if (get_string_manager()->string_exists('modulename_help', $module->name)) {
        echo $OUTPUT->heading_with_help($pageheading, 'modulename', $module->name, 'icon');
    } else {
        echo $OUTPUT->heading_with_help($pageheading, '', $module->name, 'icon');
    }

    $mform->display();

    echo $OUTPUT->footer();
}
