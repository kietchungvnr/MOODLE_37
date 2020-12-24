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
 * minimalistic edit form
 *
 * @package   core_user
 * @category  files
 * @copyright 2010 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

/**
 * Class user_files_form
 * @copyright 2010 Petr Skoda (http://skodak.org)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class sendemail_form extends moodleform {

    /**
     * Add elements to this form.
     */
    public function definition() {
        $mform = $this->_form;

        $email_template = $this->_customdata['email_template'];
        
        $mform->addElement('text', 'subject', get_string('emailsubject', 'local_newsvnr'));
        $mform->setType('subject', PARAM_RAW);
        $mform->addElement('editor', 'content_editor', get_string('emailcontent', 'local_newsvnr'));
        $mform->setType('content_editor', PARAM_RAW);
        $mform->addElement('hidden', 'id');
        $mform->setType('hidden', PARAM_INT);
        $this->add_action_buttons(true, get_string('savechanges'));

        $this->set_data($email_template);
    }

}
