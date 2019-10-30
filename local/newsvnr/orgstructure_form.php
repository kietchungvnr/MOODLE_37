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

class orgstructure_form extends moodleform {

    /**
     * Form definition
     */
    function definition () {
        global $USER, $CFG, $DB;;

        $mform =$this->_form;
        $orgstructure = $this->_customdata['orgstructure'];   

        $mform->addElement('header', 'general', get_string('orgheader', 'local_newsvnr'));

        $mform->addElement('text','orgname', get_string('orgname', 'local_newsvnr'),'maxlength="200" size="50"');
        $mform->addRule('orgname', get_string('required'), 'required', null, 'client');
        $mform->setType('orgname', PARAM_TEXT);
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

        // \core_collator::asort($usernames);

        $options = array(
            'placeholder' => get_string('search', 'local_newsvnr'),
        );      
        $mform->addElement('text', 'orgcode', get_string('orgcode', 'local_newsvnr'), 'maxlength="200" size="50"');
        $mform->addRule('orgcode', get_string('required'), 'required', null, 'client');
        $mform->setType('orgcode', PARAM_TEXT);
        $mform->addElement('autocomplete', 'managerid', get_string('managerid', 'local_newsvnr'), $usernames, $options);
        // $mform->addRule('managerid', get_string('required'), 'required', null, 'client');
        $mform->setType('managerid', PARAM_INT);
        $mform->addElement('autocomplete', 'orgstructuretypeid', get_string('orgstructuretypeid', 'local_newsvnr'), $orgcatenames, $options);
        $mform->addRule('orgstructuretypeid', get_string('required'), 'required', null, 'client');
        $mform->setType('orgstructuretypeid', PARAM_INT);
        // $mform->addElement('button', 'intro', get_string('addorgcate','local_newsvnr'),'data-target="#intro" data-toggle="modal"');
        $mform->addElement('text', 'parentid', get_string('parentid', 'local_newsvnr'), 'maxlength="200" size="50" class="mb-0" onclick="org_treeview()"');
        $mform->addRule('parentid', get_string('required'), 'required', null, 'client');
        $mform->setType('parentid', PARAM_TEXT);
        $mform->addElement('html', '<div class="form-group row fitem"><div class="col-md-3"></div><div class="col-md-3 pr-0 ml-3 form-inline felement" id="treeview-orgstructure" style="background-color: #e9ecef"></div></div>');
        $mform->addElement('text', 'numbermargin', get_string('numbermargin', 'local_newsvnr'), 'maxlength="200" size="50"');
        // $mform->addRule('numbermargin', get_string('required'), 'required', null, 'client');
        $mform->setType('numbermargin', PARAM_INT);
        $mform->addElement('text', 'numbercurrent', get_string('numbercurrent', 'local_newsvnr'), 'maxlength="200" size="50"');
        // $mform->addRule('numbercurrent', get_string('required'), 'required', null, 'client');
        $mform->setType('numbercurrent', PARAM_INT);

        $mform->addElement('textarea', 'org_description', get_string('description', 'local_newsvnr'),'wrap="virtual" rows="10" cols="52"');
        // $mform->addRule('org_description',get_string('required'),'required',null,'client');
        $mform->setType('org_description', PARAM_RAW);
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $this->add_action_buttons();
        $this->set_data($orgstructure);
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

        $orgname = trim($data['orgname']);
        $orgcode = trim($data['orgcode']);
        if ($data['id']) {
            $current = $DB->get_record('orgstructure', array('id'=>$data['id']), '*', MUST_EXIST);
            if ($current->name !== $orgname and $current->code !== $orgcode ) {
                if ($DB->record_exists('orgstructure', array('name'=>$orgname))) {
                    $errors['orgname'] = get_string('duplicatename', 'local_newsvnr');
                } elseif ($DB->record_exists('orgstructure', array('code'=>$orgcode))) {
                    $errors['orgcode'] = get_string('duplicatecode', 'local_newsvnr');
                }
            }

        } else {
            if ($DB->record_exists('orgstructure', array('name'=>$orgname))) {
                $errors['orgname'] = get_string('duplicatename', 'local_newsvnr');
            } elseif ($DB->record_exists('orgstructure', array('code'=>$orgcode))) {
                $errors['orgcode'] = get_string('duplicatecode', 'local_newsvnr');
            }
        }

        return $errors;
    }

}
