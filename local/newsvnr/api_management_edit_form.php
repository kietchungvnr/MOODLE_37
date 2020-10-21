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

class api_management_edit_form extends moodleform {

    /**
     * Form definition
     */
    function definition () {
        global $USER, $CFG;

        $mform = $this->_form;
        $orgcate = $this->_customdata['orgcate']; 
        $apiheader = $this->_customdata['apiheader']; 
        $apititle = $this->_customdata['apititle'];
        $mform->addElement('header', 'general', get_string('request', 'local_newsvnr')); 
        $mform->addElement('text','functionapi', get_string('functionapi', 'local_newsvnr'),'maxlength="200" size="50"');
        $mform->addRule('functionapi', get_string('required'), 'required', null, 'server');
        $mform->setType('functionapi', PARAM_TEXT);
        $mform->addElement('text','url', get_string('url', 'local_newsvnr'),'maxlength="200" size="50"');
        $mform->addRule('url', get_string('required'), 'required', null, 'server');
        $mform->setType('url', PARAM_TEXT);
        $mform->addElement('text', 'method', get_string('method', 'local_newsvnr'), 'maxlength="50" size="50"');
        $mform->addRule('method', get_string('required'), 'required', null, 'client');
        $mform->setType('method',PARAM_TEXT);
        $mform->addElement('textarea', 'description', get_string('description', 'local_newsvnr'),'wrap="virtual" rows="10" cols="52"');
        $mform->addRule('description', get_string('required'), 'required', null, 'client');
        $mform->setType('description', PARAM_TEXT);
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        //header//
        $mform->addElement('header', 'general', get_string('header', 'local_newsvnr')); 
        $mform->addElement('text', 'contenttype', get_string('content_type', 'local_newsvnr'), 'maxlength="50" size="50"');
        $mform->setType('contenttype', PARAM_TEXT);
        foreach ($apiheader as $key => $value) {
            $mform->addElement('text', 'name_'.$key, get_string('headername', 'local_newsvnr'), 'maxlength="50" size="50"');
            $mform->setType('name_'.$key, PARAM_TEXT);
            $mform->addElement('text', 'value_'.$key, get_string('headervalue', 'local_newsvnr'), 'maxlength="50" size="50"');
            $mform->setType('value_'.$key, PARAM_TEXT);
            $mform->addElement('hidden', 'id_header_'.$key);
            $mform->setType('id_header_'.$key, PARAM_INT);
        }
        //body//
        $mform->addElement('header', 'general', get_string('body', 'local_newsvnr')); 
        foreach ($apititle as $key => $value) {
            $mform->addElement('text', 'client_params_'.$key, get_string('client_params', 'local_newsvnr'), 'maxlength="50" size="50"');
            $mform->setType('client_params_'.$key, PARAM_TEXT);
            $mform->addElement('text', 'server_params_'.$key, get_string('server_params', 'local_newsvnr'), 'maxlength="50" size="50"');
            $mform->setType('server_params_'.$key, PARAM_TEXT);
            $mform->addElement('text', 'default_value_'.$key, get_string('default_values', 'local_newsvnr'), 'maxlength="50" size="50"');
            $mform->setType('default_value_'.$key, PARAM_TEXT);
            $mform->addElement('hidden', 'id_detail_'.$key);
            $mform->setType('id_detail_'.$key, PARAM_INT);
        }
        $objapiheader = new stdClass;
        $apiheader = array_values($apiheader);
        foreach ($apiheader as $key => $v) {
            $name = 'name_'.$key;
            $value = 'value_'.$key;
            $id = 'id_header_'.$key;
            $objapiheader->$name = $v->$name;
            $objapiheader->$value = $v->$value;
            $objapiheader->$id = $v->$id;
        }
        $objapititle = new stdClass;
        $apititle = array_values($apititle);
        foreach ($apititle as $key => $v) {
            $client_params = 'client_params_'.$key;
            $server_params = 'server_params_'.$key;
            $default_value = 'default_value_'.$key;
            $id = 'id_detail_'.$key;
            $objapititle->$client_params = $v->$client_params;
            $objapititle->$server_params = $v->$server_params;
            $objapititle->$default_value = $v->$default_value;
            $objapititle->$id = $v->$id;
        }
        $this->add_action_buttons();
        $this->set_data($orgcate);
        $this->set_data($objapiheader);
        $this->set_data($objapititle);

    }

    // function validation($data, $files) {
    //     global $DB;
    //     $errors = parent::validation($data, $files);

    //     $catename = trim($data['catename']);
    //     $catecode = trim($data['catecode']);
    //     if ($data['id']) {
    //         $current = $DB->get_record('local_newsvnr_api', array('id'=>$data['id']), '*', MUST_EXIST);
    //         if ($current->name !== $catename) {
    //             if ($DB->record_exists('local_newsvnr_api', array('name'=>$catename))) {
    //                 $errors['catename'] = get_string('duplicatename', 'local_newsvnr');
    //             } 
    //         }
    //         if ($current->code !== $catecode) {
    //             if ($DB->record_exists('local_newsvnr_api', array('code'=>$catecode))) {
    //                 $errors['catecode'] = get_string('duplicatecode', 'local_newsvnr');
    //             } 
    //         }

    //     } else {
    //         if ($DB->record_exists('local_newsvnr_api', array('name'=>$catename))) {
    //             $errors['catename'] = get_string('duplicatename', 'local_newsvnr');
    //         }
    //         if ($DB->record_exists('local_newsvnr_api', array('code'=>$catecode))) {
    //             $errors['catecode'] = get_string('duplicatecode', 'local_newsvnr');
    //         }
    //     }

    //     return $errors;
    // }

}

