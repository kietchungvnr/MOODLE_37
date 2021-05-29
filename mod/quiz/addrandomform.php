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
 * Defines the Moodle forum used to add random questions to the quiz.
 *
 * @package   mod_quiz
 * @copyright 2008 Olli Savolainen
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');


/**
 * The add random questions form.
 *
 * @copyright  1999 onwards Martin Dougiamas and others {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class quiz_add_random_form extends moodleform {

    protected function definition() {
        global $OUTPUT, $PAGE, $CFG;

        $mform = $this->_form;
        $mform->setDisableShortforms();

        $contexts = $this->_customdata['contexts'];
        $usablecontexts = $contexts->having_cap('moodle/question:useall');

        // Random from existing category section.
        $mform->addElement('header', 'existingcategoryheader',
                get_string('randomfromexistingcategory', 'quiz'));

        $mform->addElement('questioncategory', 'category', get_string('category'),
                array('contexts' => $usablecontexts, 'top' => true));
        $mform->setDefault('category', $this->_customdata['cat']);

        // $mform->addElement('checkbox', 'includesubcategories', '', get_string('recurse', 'quiz'));

        $tops = question_get_top_categories_for_contexts(array_column($contexts->all(), 'id'));
        $mform->hideIf('includesubcategories', 'category', 'in', $tops);

        if ($CFG->usetags) {
            $tagstrings = array();
            $tags = core_tag_tag::get_tags_by_area_in_contexts('core_question', 'question', $usablecontexts);
            foreach ($tags as $tag) {
                $tagstrings["{$tag->id},{$tag->name}"] = $tag->name;
            }
            $options = array(
                'multiple' => true,
                'noselectionstring' => get_string('anytags', 'quiz'),
            );
            $mform->addElement('autocomplete', 'fromtags', get_string('randomquestiontags', 'mod_quiz'), $tagstrings, $options);
            $mform->addHelpButton('fromtags', 'randomquestiontags', 'mod_quiz');
        }

        // TODO: in the past, the drop-down used to only show sensible choices for
        // number of questions to add. That is, if the currently selected filter
        // only matched 9 questions (not already in the quiz), then the drop-down would
        // only offer choices 1..9. This nice UI hint got lost when the UI became Ajax-y.
        // We should add it back.
         
        $categoryid = explode(',',$this->_customdata['cat'])[0];

        $loader_default = new \core_question\bank\random_question_loader(new qubaid_list([]));
        $loader_easy = new \core_question\bank\random_question_loader(new qubaid_list([]));
        $loader_normal = new \core_question\bank\random_question_loader(new qubaid_list([]));
        $loader_hard = new \core_question\bank\random_question_loader(new qubaid_list([]));
        $totalcount_default = $loader_default->count_questions($categoryid, false, [], 'default');
        $totalcount_easy = $loader_easy->count_questions($categoryid, false, [], 'easy');
        $totalcount_normal = $loader_normal->count_questions($categoryid, false, [], 'normal');
        $totalcount_hard = $loader_hard->count_questions($categoryid, false, [], 'hard');
        $totalcount = $totalcount_default + $totalcount_easy + $totalcount_normal + $totalcount_hard;
        
        $mform->addElement('select', 'typeofquestion', get_string('typeofquestion', 'local_newsvnr'), ['no' => get_string('no'), 'yes' => get_string('yes')]); 
        $mform->setDefault('typeofquestion', 'no');

        $mform->addElement('select', 'numbertoadd', get_string('randomnumber', 'local_newsvnr'), $this->get_number_of_questions_to_add_choices($totalcount_default));
        $mform->hideIf('numbertoadd', 'typeofquestion', 'eq', 'yes');
            
        $mform->addElement('select', 'typeofclass', get_string('typeofclass', 'local_newsvnr'), ['number' => get_string('typeofclass_number', 'local_newsvnr'), 'percent' => get_string('typeofclass_percent', 'local_newsvnr')]);
        $mform->hideIf('typeofclass', 'typeofquestion', 'eq', 'no');

        $mform->addElement('select', 'numbertoadd_percent', get_string('randomnumber', 'local_newsvnr'), $this->get_number_of_questions_to_add_choices($totalcount));
        $mform->setDefault('typeofquestion', $totalcount);
        $mform->hideIf('numbertoadd_percent', 'typeofquestion', 'eq', 'no');
        $mform->hideIf('numbertoadd_percent', 'typeofclass', 'eq', 'number');

        $mform->addElement('select', 'hardlevel_number', get_string('questionlevel_hard', 'local_newsvnr'), $this->get_number_of_questions_to_add_choices($totalcount_hard));
        $mform->hideIf('hardlevel_number', 'typeofquestion', 'eq', 'no');
        $mform->hideIf('hardlevel_number', 'typeofclass', 'eq', 'percent');

        $mform->addElement('select', 'normallevel_number', get_string('questionlevel_normal', 'local_newsvnr'), $this->get_number_of_questions_to_add_choices($totalcount_normal));
        $mform->hideIf('normallevel_number', 'typeofquestion', 'eq', 'no');
        $mform->hideIf('normallevel_number', 'typeofclass', 'eq', 'percent');

        $mform->addElement('select', 'easylevel_number', get_string('questionlevel_easy', 'local_newsvnr'), $this->get_number_of_questions_to_add_choices($totalcount_easy));
        $mform->hideIf('easylevel_number', 'typeofquestion', 'eq', 'no');
        $mform->hideIf('easylevel_number', 'typeofclass', 'eq', 'percent');

        $mform->addElement('select', 'hardlevel_percent', get_string('questionlevel_hard', 'local_newsvnr'), $this->get_percent_of_questions_to_add_choices());
        $mform->hideIf('hardlevel_percent', 'typeofclass', 'eq', 'number');
        $mform->hideIf('hardlevel_percent', 'typeofquestion', 'eq', 'no');

        $mform->addElement('select', 'normallevel_percent', get_string('questionlevel_normal', 'local_newsvnr'), $this->get_percent_of_questions_to_add_choices());
        $mform->hideIf('normallevel_percent', 'typeofclass', 'eq', 'number');
        $mform->hideIf('normallevel_percent', 'typeofquestion', 'eq', 'no');

        $mform->addElement('select', 'easylevel_percent', get_string('questionlevel_easy', 'local_newsvnr'), $this->get_percent_of_questions_to_add_choices());
        $mform->hideIf('easylevel_percent', 'typeofclass', 'eq', 'number');
        $mform->hideIf('easylevel_percent', 'typeofquestion', 'eq', 'no');

        $previewhtml = $OUTPUT->render_from_template('mod_quiz/random_question_form_preview', []);
        $mform->addElement('html', $previewhtml);

        $mform->addElement('submit', 'existingcategory', get_string('addrandomquestion', 'quiz'));

        // Random from a new category section.
        $mform->addElement('header', 'newcategoryheader',
                get_string('randomquestionusinganewcategory', 'quiz'));

        $mform->addElement('text', 'name', get_string('name'), 'maxlength="254" size="50"');
        $mform->setType('name', PARAM_TEXT);

        $mform->addElement('questioncategory', 'parent', get_string('parentcategory', 'question'),
                array('contexts' => $usablecontexts, 'top' => true));
        $mform->addHelpButton('parent', 'parentcategory', 'question');

        $mform->addElement('submit', 'newcategory',
                get_string('createcategoryandaddrandomquestion', 'quiz'));

        // Cancel button.
        $mform->addElement('cancel');
        $mform->closeHeaderBefore('cancel');

        $mform->addElement('hidden', 'addonpage', 0, 'id="rform_qpage"');
        $mform->setType('addonpage', PARAM_SEQUENCE);
        $mform->addElement('hidden', 'cmid', 0);
        $mform->setType('cmid', PARAM_INT);
        $mform->addElement('hidden', 'returnurl', 0);
        $mform->setType('returnurl', PARAM_LOCALURL);

        // Add the javascript required to enhance this mform.
        $PAGE->requires->js_call_amd('mod_quiz/add_random_form', 'init', [
            $mform->getAttribute('id'),
            $contexts->lowest()->id,
            $tops,
            $CFG->usetags
        ]);
    }

    public function validation($fromform, $files) {
        $errors = parent::validation($fromform, $files);

        if (!empty($fromform['newcategory']) && trim($fromform['name']) == '') {
            $errors['name'] = get_string('categorynamecantbeblank', 'question');
        }
        if(isset($fromform['typeofclass']) && $fromform['typeofclass'] == 'percent') {
            $totalpercent = $fromform['easylevel_percent'] + $fromform['normallevel_percent'] + $fromform['hardlevel_percent'];
            if($totalpercent > 100 || $totalpercent != 100) {
                $errors['easylevel_percent'] = get_string('questionlevel_erorr_sumpercent', 'local_newsvnr');
                $errors['normallevel_percent'] = get_string('questionlevel_erorr_sumpercent', 'local_newsvnr');
                $errors['hardlevel_percent'] = get_string('questionlevel_erorr_sumpercent', 'local_newsvnr');
            }
        }

        return $errors;
    }

    /**
     * Return an arbitrary array for the dropdown menu
     *
     * @param int $maxrand
     * @return array of integers [1, 2, ..., 100] (or to the smaller of $maxrand and 100.)
     */
    private function get_number_of_questions_to_add_choices($maxrand = 100) {
        $randomcount = array();
        for ($i = 1; $i <= min(100, $maxrand); $i++) {
            $randomcount[$i] = $i;
        }
        return $randomcount;
    }

    /**
     * Return an arbitrary array for the dropdown menu
     *
     * @param int $maxrand
     * @return array of integers [1, 2, ..., 100] (or to the smaller of $maxrand and 100.)
     */
    private function get_percent_of_questions_to_add_choices($maxrand = 100) {
        $counts = [];
        for ($i = 1; $i <= min(100, $maxrand); $i++) {
            $counts[$i] = $i . '%';
        }
        return $counts;
    }
}
