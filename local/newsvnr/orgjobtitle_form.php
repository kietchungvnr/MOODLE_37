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

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/lib/formslib.php');

class orgjobtitle_form extends moodleform {

    /**
     * Form definition
     */
    function definition () {
        global $USER, $CFG;

        $mform =$this->_form;
        $orgjobtitle = $this->_customdata['orgjobtitle'];   

        $mform->addElement('header', 'general', get_string('jobtitheader', 'local_newsvnr'));

        $mform->addElement('text','jobtitlename', get_string('jobtitlename', 'local_newsvnr'),'maxlength="100" size="50"');
        $mform->addRule('jobtitlename', get_string('required'), 'required', null, 'client');
        $mform->setType('jobtitlename', PARAM_TEXT);
        $mform->addElement('text', 'jobtitlecode', get_string('jobtitlecode', 'local_newsvnr'), 'maxlength="50" size="50"');
        $mform->addRule('jobtitlecode', get_string('required'), 'required', null, 'client');
        $mform->setType('jobtitlecode', PARAM_TEXT);

        $mform->addElement('text', 'jobtitle_namebylaw', get_string('namebylaw', 'local_newsvnr'), 'maxlength="255" size="50"');
        // $mform->addRule('jobtitle_namebylaw', get_string('required'), 'required', null, 'client');
        $mform->setType('jobtitle_namebylaw', PARAM_TEXT);


        $mform->addElement('textarea', 'orgjobtitle_description', get_string('description', 'local_newsvnr'),'wrap="virtual" rows="10" cols="52"');
        // $mform->addRule('orgjobtitle_description',get_string('required'),'required',null,'client');
        $mform->setType('orgjobtitle_description', PARAM_RAW);
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        
        $this->add_action_buttons();
        $this->set_data($orgjobtitle);
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

        $jobtitlename = trim($data['jobtitlename']);
        $jobtitlecode = trim($data['jobtitlecode']);
        if ($data['id']) {
            $current = $DB->get_record('orgstructure_jobtitle', array('id'=>$data['id']), '*', MUST_EXIST);
            if ($current->name !== $jobtitlename and $current->code !== $jobtitlecode ) {
                if ($DB->record_exists('orgstructure_jobtitle', array('name'=>$jobtitlename))) {
                    $errors['jobtitlename'] = get_string('duplicatename', 'local_newsvnr');
                } elseif ($DB->record_exists('orgstructure_jobtitle', array('code'=>$jobtitlecode))) {
                    $errors['jobtitlecode'] = get_string('duplicatecode', 'local_newsvnr');
                }
            }

        } else {
            if ($DB->record_exists('orgstructure_jobtitle', array('name'=>$jobtitlename))) {
                $errors['jobtitlename'] = get_string('duplicatename', 'local_newsvnr');
            }elseif ($DB->record_exists('orgstructure_jobtitle', array('code'=>$jobtitlecode))) {
                $errors['jobtitlecode'] = get_string('duplicatecode', 'local_newsvnr');
            }
        }

        return $errors;
    }

}

