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
 * @package local_newsvnr
 * @copyright 2019 VnResource
 * @author   Le Thanh Vu
 **/

defined('MOODLE_INTERNAL') || die;

require_once($CFG->dirroot.'/lib/formslib.php');

class orgposition_edit_form extends moodleform {

    /**
     * Form definition
     */
    function definition () {
        global $USER, $CFG,$DB;

        $mform =$this->_form;
        $orgposition = $this->_customdata['orgposition'];   
        //Lấy danh sách dữ liệu phòng ban
        $orgstructurelist = $DB->get_records('orgstructure',['visible' => 1]);
        $orgstructurenames = array();
        foreach ($orgstructurelist as $key => $value) {
            $orgstructurenames[$key] = $value->name;
        }
        //Lấy danh sách chức danh
        $orgjobtitlelist = $DB->get_records('orgstructure_jobtitle',['visible' => 1]);
        $orgjobtitlenames = array();
        foreach ($orgjobtitlelist as $key => $value) {
            $orgjobtitlenames[$key] = $value->name;
        }
        $options = array(
            'placeholder' => get_string('search', 'local_newsvnr'),
        ); 


        $mform->addElement('header', 'general', get_string('posheader', 'local_newsvnr'));

        $mform->addElement('text','posname', get_string('posname', 'local_newsvnr'),'maxlength="100" size="50"');
        $mform->addRule('posname', get_string('required'), 'required', null, 'client');
        $mform->setType('posname', PARAM_TEXT);
        $mform->addElement('text', 'poscode', get_string('poscode', 'local_newsvnr'), 'maxlength="50" size="50"');
        $mform->addRule('poscode', get_string('required'), 'required', null, 'client');
        $mform->setType('poscode', PARAM_TEXT);
        $mform->addElement('text', 'position_namebylaw', get_string('namebylaw', 'local_newsvnr'), 'maxlength="255" size="50"');
        // $mform->addRule('position_namebylaw', get_string('required'), 'required', null, 'client');
        $mform->setType('position_namebylaw', PARAM_TEXT);

        $mform->addElement('autocomplete', 'jobtitleid', get_string('jobtitleid', 'local_newsvnr'), $orgjobtitlenames, $options);
        $mform->addRule('jobtitleid', get_string('required'), 'required', null, 'client');
        $mform->setType('jobtitleid', PARAM_INT);
        
         //lấy danh sách cây phòng ban và user
        $orgcatelist = $DB->get_records('orgstructure_category',['visible' => 1]);
        $userlist = $DB->get_records('user');                                                 
        $orgcatenames = array();
        $usernames = array();

        foreach ($orgcatelist as $key => $value) {    
            $orgcatenames[$key] = $value->name;                     
        }
        foreach ($userlist as $key => $value) {
            $usernames[$key] = $value->firstname.' '.$value->lastname;
        }
        $mform->addElement('text', 'orgstructureid', get_string('orgstructurename', 'local_newsvnr'), 'maxlength="200" size="50" class="mb-0"');
        // $mform->addRule('orgstructureid', get_string('required'), 'required', null, 'client');
        $mform->setType('orgstructureid', PARAM_TEXT);
        $mform->addElement('html', '<div class="form-group row fitem"><div class="col-md-2"></div><div class="col-md-9 pr-0 ml-3 form-inline felement" id="treeview-orgposition" style="background-color: #e9ecef"></div></div>');

        // $mform->addElement('autocomplete', 'orgstructureid', get_string('orgstructureid', 'local_newsvnr'), $orgstructurenames, $options);
        // $mform->addRule('orgstructureid', get_string('required'), 'required', null, 'client');
        // $mform->setType('orgstructureid', PARAM_INT);

        $mform->addElement('textarea', 'orgposition_description', get_string('description', 'local_newsvnr'),'wrap="virtual" rows="10" cols="52"');
        // $mform->addRule('orgposition_description',get_string('required'),'required',null,'client');
        $mform->setType('orgposition_description', PARAM_RAW);
        
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        
        $this->add_action_buttons();
        $this->set_data($orgposition);
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

        $posname = trim($data['posname']);
        $poscode = trim($data['poscode']);
        if ($data['id']) {
            $current = $DB->get_record('orgstructure_position', array('id'=>$data['id']), '*', MUST_EXIST);
            if ($current->name !== $posname) {
                if ($DB->record_exists('orgstructure_position', array('name'=>$posname))) {
                    $errors['posname'] = get_string('duplicatename', 'local_newsvnr');
                }
            }

            if ($current->code !== $poscode) {
                if ($DB->record_exists('orgstructure_position', array('code'=>$poscode))) {
                    $errors['poscode'] = get_string('duplicatecode', 'local_newsvnr');
                }
            }

        } else {
            if ($DB->record_exists('orgstructure_position', array('name'=>$posname))) {
                $errors['posname'] = get_string('duplicatename', 'local_newsvnr');
            }
            if ($DB->record_exists('orgstructure_position', array('code'=>$poscode))) {
                $errors['poscode'] = get_string('duplicatecode', 'local_newsvnr');
            }
        }

        return $errors;
    }

}

