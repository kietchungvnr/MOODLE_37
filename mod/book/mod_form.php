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
 * Instance add/edit form
 *
 * @package    mod_book
 * @copyright  2004-2011 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once(__DIR__.'/locallib.php');
require_once($CFG->dirroot.'/course/moodleform_mod.php');

class mod_book_mod_form extends moodleform_mod {

    function definition() {
        global $CFG;

        $mform = $this->_form;

        $config = get_config('book');

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('name'), array('size'=>'64'));
        if (!empty($CFG->formatstringstriptags)) {
            $mform->setType('name', PARAM_TEXT);
        } else {
            $mform->setType('name', PARAM_CLEANHTML);
        }
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');
        // Custom by Thắng : Thêm field chứa folder id khi tạo module trên trang thư viện trực tuyến
        $mform->addElement('hidden', 'folderid', null);
        $mform->setType('folderid', PARAM_INT);
        
        $this->standard_intro_elements(get_string('moduleintro'));

        // Appearance.
        $mform->addElement('header', 'appearancehdr', get_string('appearance'));

        $alloptions = book_get_numbering_types();
        $allowed = explode(',', $config->numberingoptions);
        $options = array();
        foreach ($allowed as $type) {
            if (isset($alloptions[$type])) {
                $options[$type] = $alloptions[$type];
            }
        }
        if ($this->current->instance) {
            if (!isset($options[$this->current->numbering])) {
                if (isset($alloptions[$this->current->numbering])) {
                    $options[$this->current->numbering] = $alloptions[$this->current->numbering];
                }
            }
        }
        $mform->addElement('select', 'numbering', get_string('numbering', 'book'), $options);
        $mform->addHelpButton('numbering', 'numbering', 'mod_book');
        $mform->setDefault('numbering', $config->numbering);

        $alloptions = book_get_nav_types();
        $allowed = explode(',', $config->navoptions);
        $options = array();
        foreach ($allowed as $type) {
            if (isset($alloptions[$type])) {
                $options[$type] = $alloptions[$type];
            }
        }
        if ($this->current->instance) {
            if (!isset($options[$this->current->navstyle])) {
                if (isset($alloptions[$this->current->navstyle])) {
                    $options[$this->current->navstyle] = $alloptions[$this->current->navstyle];
                }
            }
        }
        $mform->addElement('select', 'navstyle', get_string('navstyle', 'book'), $options);
        $mform->addHelpButton('navstyle', 'navstyle', 'mod_book');
        $mform->setDefault('navstyle', $config->navstyle);

        $mform->addElement('checkbox', 'customtitles', get_string('customtitles', 'book'));
        $mform->addHelpButton('customtitles', 'customtitles', 'mod_book');
        $mform->setDefault('customtitles', 0);

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }

    // Custom by Vũ: Thêm điều kiện hoàn thành module với ràng buộc thời gian tối thiểu
    
    /**
     * Display module-specific activity completion rules.
     * Part of the API defined by moodleform_mod
     * @return array Array of string IDs of added items, empty array if none
     */
    public function add_completion_rules() {
        $mform = $this->_form;

        $group = array();
        $group[] =& $mform->createElement('checkbox', 'completiontimespentenabled', '',
                get_string('completiontimespent', 'lesson'));
        $group[] =& $mform->createElement('duration', 'completiontimespent', '', array('optional' => false));
        $mform->addGroup($group, 'completiontimespentgroup', get_string('completiontimespentgroup', 'core_langvnr'), array(' '), false);
        $mform->disabledIf('completiontimespent[number]', 'completiontimespentenabled', 'notchecked');
        $mform->disabledIf('completiontimespent[timeunit]', 'completiontimespentenabled', 'notchecked');

        return array('completiontimespentgroup');
    }

    /**
     * Called during validation. Indicates whether a module-specific completion rule is selected.
     *
     * @param array $data Input data (not yet validated)
     * @return bool True if one or more rules is enabled, false if none are.
     */
    public function completion_rule_enabled($data) {
        return $data['completiontimespent'] > 0;
    }

}
