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

class import_form extends moodleform {

    /**
     * Form definition
     */
    function definition () {
        global $USER, $CFG;

        $mform = $this->_form;
     
        $mform->addElement('header', 'settingsheader', get_string('upload'));

        $mform->addElement('filepicker', 'orgfile', get_string('file'));
        $mform->addRule('orgfile', null, 'required');
        $orglist = [
            'orgstructure_category' => 'Loại phòng ban','orgstructure' => 'Phòng ban','orgstructure_jobtitle' => 'Chức danh','orgstructure_position' => 'Chức vụ'
        ];

        $mform->addElement('select', 'tablename', get_string('tablename', 'local_newsvnr'), $orglist);
        $mform->addRule('tablename', null, 'required');

        $choices = csv_import_reader::get_delimiter_list();
        $mform->addElement('select', 'delimiter_name', get_string('csvdelimiter', 'local_newsvnr'), $choices);
        // if (array_key_exists('cfg', $choices)) {
        //     $mform->setDefault('delimiter_name', 'cfg');
        // } else if (get_string('listsep', 'langconfig') == ';') {
        //     $mform->setDefault('delimiter_name', 'semicolon');
        // } else {
        //     $mform->setDefault('delimiter_name', 'comma');
        // }

        $choices = core_text::get_encodings();
        $mform->addElement('select', 'encoding', get_string('encoding', 'local_newsvnr'), $choices);
        $mform->setDefault('encoding', 'UTF-8');

        $choices = array('10'=>10, '20'=>20, '100'=>100, '1000'=>1000, '100000'=>100000);
        $mform->addElement('select', 'previewrows', get_string('rowpreviewnum', 'local_newsvnr'), $choices);
        $mform->setType('previewrows', PARAM_INT);
        
        $this->add_action_buttons(false, get_string('uploadorg', 'local_newsvnr'));
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

        // $catename = trim($data['catename']);
        // if ($data['id']) {
        //     $current = $DB->get_record('orgstructure_category', array('id'=>$data['id']), '*', MUST_EXIST);
        //     if ($current->name !== $catename) {
        //         if ($DB->record_exists('orgstructure_category', array('name'=>$catename))) {
        //             $errors['catename'] = get_string('duplicatename', 'local_newsvnr');
        //         }
        //     }

        // } else {
        //     if ($DB->record_exists('orgstructure_category', array('name'=>$catename))) {
        //         $errors['catename'] = get_string('duplicatename', 'local_newsvnr');
        //     }
        // }

        return $errors;
    }

}

class confirm_import_form extends moodleform {

    /**
     * Form definition
     */
    function definition () {
        global $USER, $CFG;

        $mform = $this->_form;
        $columns = $this->_customdata['columns'];
        $data    = $this->_customdata['data'];
        
        $mform->addElement('hidden', 'iid');
        $mform->setType('iid', PARAM_INT);

        $mform->addElement('hidden', 'previewrows');
        $mform->setType('previewrows', PARAM_INT);

        $mform->addElement('hidden', 'tablename');
        $mform->setType('tablename', PARAM_TEXT);

        
        $this->add_action_buttons(true, get_string('continue'));
        $this->set_data($data);
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


        return $errors;
    }

}

