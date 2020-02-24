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

class orgcate_form extends moodleform {

    /**
     * Form definition
     */
    function definition () {
        global $USER, $CFG;

        $mform = $this->_form;
        $orgcate = $this->_customdata['orgcate'];   

        $mform->addElement('header', 'general', get_string('cateheader', 'local_newsvnr'));

        $mform->addElement('text','catename', get_string('catename', 'local_newsvnr'),'maxlength="200" size="50"');
        $mform->addRule('catename', get_string('required'), 'required', null, 'server');
        $mform->setType('catename', PARAM_TEXT);
        $mform->addElement('text', 'catecode', get_string('catecode', 'local_newsvnr'), 'maxlength="50" size="50"');
        $mform->addRule('catecode', get_string('required'), 'required', null, 'client');
        $mform->setType('catecode', PARAM_TEXT);
        $mform->addElement('textarea', 'orgcate_description', get_string('description', 'local_newsvnr'),'wrap="virtual" rows="10" cols="52"');
        // $mform->addRule('orgcate_description',get_string('required'),'required',null,'client');
        $mform->setType('orgcate_description', PARAM_RAW);
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $this->add_action_buttons();
        $this->set_data($orgcate);
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

        $catename = trim($data['catename']);
        $catecode = trim($data['catecode']);
        if ($data['id']) {
            $current = $DB->get_record('orgstructure_category', array('id'=>$data['id']), '*', MUST_EXIST);
            if ($current->name !== $catename) {
                if ($DB->record_exists('orgstructure_category', array('name'=>$catename))) {
                    $errors['catename'] = get_string('duplicatename', 'local_newsvnr');
                } 
            }
            if ($current->code !== $catecode) {
                if ($DB->record_exists('orgstructure_category', array('code'=>$catecode))) {
                    $errors['catecode'] = get_string('duplicatecode', 'local_newsvnr');
                } 
            }

        } else {
            if ($DB->record_exists('orgstructure_category', array('name'=>$catename))) {
                $errors['catename'] = get_string('duplicatename', 'local_newsvnr');
            }
            if ($DB->record_exists('orgstructure_category', array('code'=>$catecode))) {
                $errors['catecode'] = get_string('duplicatecode', 'local_newsvnr');
            }
        }

        return $errors;
    }

}

