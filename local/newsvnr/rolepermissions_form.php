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
 * A moodle form to manage folder files
 *
 * @package   local_newsvnr
 * @copyright 2020 Le Thanh Vu
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

class local_newsvnr_rolepremissions_form extends moodleform {
    function definition() {
        global $DB;
        $mform = $this->_form;

        //lấy danh sách chức vụ
        $userlist = $DB->get_records('user', ['deleted' => 0]);
        $userfullname = array();
        
        foreach ($userlist as $key => $user) {    
            $userfullname[$key] = $user->firstname . ' ' . $user->lastname;            
        }

        $options = array(
            'placeholder' => get_string('search', 'local_newsvnr'),
        );

        $mform->addElement('autocomplete', 'userid', get_string('user',
        'local_newsvnr'), $userfullname, $options); $mform->setType('userid',
        PARAM_INT);    
       
    }
}
