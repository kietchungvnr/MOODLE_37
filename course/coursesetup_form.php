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
 * Version details
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package core_course
 * @copyright 2019 VnResource
 * @author   Le Thanh Vu
 **/

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/lib/formslib.php');

class coursesetup_form extends moodleform {

    /**
     * Form definition
     */
    function definition () {
        global $USER, $CFG, $DB;;

        $mform =$this->_form;
        $coursesetup = $this->_customdata['coursesetup'];
        // $competencylist = $this->_customdata['competencylist'];

        $mform->addElement('header', 'general', get_string('coursesetup', 'local_newsvnr'));

        $mform->addElement('text','category_cs', get_string('category_cs', 'local_newsvnr'),'maxlength="200" size="50"');
        $mform->addRule('category_cs', get_string('required'), 'required', null, 'client');
        $mform->setType('category_cs', PARAM_TEXT);

        $mform->addElement('html', '<div class="form-group row fitem"><div class="col-md-3"></div><div class="col-md-3 pr-0 ml-3 form-inline felement" id="treeview-category-course" style="background-color: #e9ecef"></div></div>');

        $mform->addElement('text','competency_cs', get_string('competency_cs', 'local_newsvnr'),'maxlength="200" size="50"');
        $mform->addRule('competency_cs', get_string('required'), 'required', null, 'client');
        $mform->setType('competency_cs', PARAM_TEXT);

        // $mform->addElement('hidden', 'competencylist', $competencylist);
        //     $mform->setType('competencylist', PARAM_RAW);

        $mform->addElement('html', '<div class="form-group row fitem"><div class="col-md-3"></div><div class="col-md-3 pr-0 ml-3 form-inline felement" id="treeview-category-competency" style="background-color: #e9ecef"></div></div>');

        $mform->addElement('text','fullname_cs', get_string('fullname_cs', 'local_newsvnr'),'maxlength="200" size="50"');
        $mform->addRule('fullname_cs', get_string('required'), 'required', null, 'client');
        $mform->setType('fullname_cs', PARAM_TEXT);

        $mform->addElement('text','shortname_cs', get_string('shortname_cs', 'local_newsvnr'),'maxlength="200" size="50"');
        $mform->addRule('shortname_cs', get_string('required'), 'required', null, 'client');
        $mform->setType('shortname_cs', PARAM_TEXT);

        $toclist = array(
            '1' => 'Tuyển dụng',
            '2' => 'Đào tạo',
        );

        //Lấy danh sách chức vụ
        $orgpositionlist = $DB->get_records('orgstructure_position');
        $orgpositionnames = array();
        foreach ($orgpositionlist as $key => $value) {
            $orgpositionnames[$key] = $value->name;
        }
        //Lấy danh sách chức danh
        $orgjobtitlelist = $DB->get_records('orgstructure_jobtitle');
        $orgjobtitlenames = array();
        foreach ($orgjobtitlelist as $key => $value) {
            $orgjobtitlenames[$key] = $value->name;
        }
        //Lấy danh sách phòng ban
        $orgstructurelist = $DB->get_records('orgstructure');
        $orgstructurenames = array();
        foreach ($orgstructurelist as $key => $value) {
            $orgstructurenames[$key] = $value->name;
        }

        $mform->addElement('select', 'typeofcourse', get_string('typeofcourse','local_newsvnr'), $toclist);
        $mform->addRule('typeofcourse', get_string('missingtypeofcourse','local_newsvnr'), 'required', null, 'client');
        $mform->setType('typeofcourse', PARAM_INT);
        
        $mform->addElement('text', 'courseoforgstructure', get_string('courseoforgstructure','local_newsvnr'), 'maxlength="254" size="30"');
        $mform->setType('courseoforgstructure', PARAM_TEXT);

        $mform->addElement('html', '<div class="form-group row fitem"><div class="col-md-3"></div><div class="col-md-3 pr-0 ml-3 form-inline felement" id="treeview-orgstructure-course" style="background-color: #e9ecef"></div></div>');

        $mform->addElement('select', 'courseofjobtitle', get_string('courseofjobtitle','local_newsvnr'), $orgjobtitlenames);
        $mform->setType('courseofjobtitle', PARAM_INT);

        $mform->addElement('select', 'courseofposition', get_string('courseofposition','local_newsvnr'), $orgpositionnames);
        $mform->setType('courseofposition', PARAM_INT);
        $mform->addElement('advcheckbox', 'pinned', get_string('pinned', 'local_newsvnr'), ' ', array('group' => 1), array(0, 1));

        $mform->addElement('textarea', 'description', get_string('description', 'local_newsvnr'),'wrap="virtual" rows="10" cols="52"');
        // $mform->addRule('description',get_string('required'),'required',null,'client');
        $mform->setType('description', PARAM_RAW);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $this->add_action_buttons();
        $this->set_data($coursesetup);
    }

    /**
     * Form validation
     *
     * @param array $data
     * @param array $files
     * @return array $errors An array of validataion errors for the form.
     */
    function validation($data, $files) {
        global $DB;
        $errors = parent::validation($data, $files);

        $fullname_cs = trim($data['fullname_cs']);
        $shortname_cs = trim($data['shortname_cs']);
        
        if ($data['id']) {
            // $current = $DB->get_record('orgstructure', array('id'=>$data['id']), '*', MUST_EXIST);
            // if ($current->name !== $orgname || $current->code !== $orgcode ) {
            //     if ($DB->record_exists('orgstructure', array('name'=>$orgname))) {
            //         $errors['orgname'] = get_string('duplicatename', 'local_newsvnr');
            //     } elseif ($DB->record_exists('orgstructure', array('code'=>$orgcode))) {
            //         $errors['orgcode'] = get_string('duplicatecode', 'local_newsvnr');
            //     }
            // }

        } else {
            // var_dump($data);die;
            if(!$DB->record_exists('course_categories', ['name' => $data['category_cs']])) {
                $errors['category_cs'] = get_string('invalid_category_cs','local_newsvnr',format_string($data['category_cs'])); 
            } else if(!$DB->record_exists('orgstructure', ['name' => $data['courseoforgstructure']])) {
                $errors['courseoforgstructure'] = get_string('invalid_courseoforgstructure','local_newsvnr',format_string($data['courseoforgstructure']));    
            }
            if($DB->record_exists('course_categories', ['name' => $data['shortname_cs']])) {
                $errors['shortname_cs'] = get_string('duplicate_shortname_cs','local_newsvnr',format_string($data['shortname_cs']));    
            }

                
        } 
        
        return $errors;
    }
    

}
