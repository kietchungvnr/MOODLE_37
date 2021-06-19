<?php

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir.'/formslib.php');
require_once($CFG->libdir.'/completionlib.php');

/**
 * The form for handling editing a course.
 */
class course_edit_form extends moodleform {
    protected $course;
    protected $context;

    /**
     * Form definition.
     */
    function definition() {
        global $CFG, $PAGE, $DB;

        $mform    = $this->_form;
        $PAGE->requires->yui_module('moodle-course-formatchooser', 'M.course.init_formatchooser',
                array(array('formid' => $mform->getAttribute('id'))));

        $course        = $this->_customdata['course']; // this contains the data of this form
        $category      = $this->_customdata['category'];
        $coursesetup   = $this->_customdata['coursesetup'];
        $editoroptions = $this->_customdata['editoroptions'];
        $returnto = $this->_customdata['returnto'];
        $returnurl = $this->_customdata['returnurl'];

        $systemcontext   = context_system::instance();
        $categorycontext = context_coursecat::instance($category->id);

        if (!empty($course->id)) {
            $coursecontext = context_course::instance($course->id);
            $context = $coursecontext;
        } else {
            $coursecontext = null;
            $context = $categorycontext;
        }

        $courseconfig = get_config('moodlecourse');

        $this->course  = $course;
        $this->context = $context;

        // Form definition with new course defaults.
        $mform->addElement('header','general', get_string('general', 'form'));

        $mform->addElement('hidden', 'returnto', null);
        $mform->setType('returnto', PARAM_ALPHANUM);
        $mform->setConstant('returnto', $returnto);

        $mform->addElement('hidden', 'returnurl', null);
        $mform->setType('returnurl', PARAM_LOCALURL);
        $mform->setConstant('returnurl', $returnurl);

        $mform->addElement('text','fullname', get_string('fullnamecourse'),'maxlength="254" size="50"');
        $mform->addHelpButton('fullname', 'fullnamecourse');
        $mform->addRule('fullname', get_string('missingfullname'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_TEXT);
        if (!empty($course->id) and !has_capability('moodle/course:changefullname', $coursecontext)) {
            $mform->hardFreeze('fullname');
            $mform->setConstant('fullname', $course->fullname);
        }

        $mform->addElement('text', 'shortname', get_string('shortnamecourse'), 'maxlength="100" size="20"');
        $mform->addHelpButton('shortname', 'shortnamecourse');
        $mform->addRule('shortname', get_string('missingshortname'), 'required', null, 'client');
        $mform->setType('shortname', PARAM_TEXT);
        if (!empty($course->id) and !has_capability('moodle/course:changeshortname', $coursecontext)) {
            $mform->hardFreeze('shortname');
            $mform->setConstant('shortname', $course->shortname);
        }

        // Custom by Vũ: Thêm field mã khóa (code)
        $mform->addElement('text', 'code', get_string('codecourse', 'local_newsvnr'), 'maxlength="100" size="50"');
        $mform->addRule('code', get_string('missingcode', 'local_newsvnr'), 'required', null, 'client');
        $mform->setType('code', PARAM_TEXT);

        // Verify permissions to change course category or keep current.
        if (empty($course->id)) {
            if (has_capability('moodle/course:create', $categorycontext)) {
                $displaylist = core_course_category::make_categories_list('moodle/course:create');
                $mform->addElement('select', 'category', get_string('coursecategory'), $displaylist);
                $mform->addHelpButton('category', 'coursecategory');
                $mform->setDefault('category', $category->id);
            } else {
                $mform->addElement('hidden', 'category', null);
                $mform->setType('category', PARAM_INT);
                $mform->setConstant('category', $category->id);
            }
        } else {
            if (has_capability('moodle/course:changecategory', $coursecontext)) {
                $displaylist = core_course_category::make_categories_list('moodle/course:changecategory');
                if (!isset($displaylist[$course->category])) {
                    //always keep current
                    $displaylist[$course->category] = core_course_category::get($course->category, MUST_EXIST, true)
                        ->get_formatted_name();
                }
                $mform->addElement('select', 'category', get_string('coursecategory'), $displaylist);
                $mform->addHelpButton('category', 'coursecategory');
            } else {
                //keep current
                $mform->addElement('hidden', 'category', null);
                $mform->setType('category', PARAM_INT);
                $mform->setConstant('category', $course->category);
            }
        }
        $typescourse = [];
        $typescourse[0] = '[LMS] Mặc định';
        if($CFG->sitetype == MOODLE_BUSINESS) {
            $typescourse[1] =  '[HRM] Tuyển dụng';
            $typescourse[2] =  '[HRM] Đào tạo';
        } else if($CFG->sitetype == MOODLE_EDUCATION) {
            $typescourse[3] = '[EBM] Đào tạo';
        }

        $mform->addElement('select', 'typeofcourse', get_string('typeofcourse','local_newsvnr'), $typescourse);
        $mform->setType('typeofcourse', PARAM_INT);

        //Lấy danh sách chi nhánh
        if($CFG->sitetype == MOODLE_EDUCATION) {
            $division_options = array(
                'ajax' => 'local_newsvnr/form-search-division',
                'placeholder' => get_string('search', 'local_newsvnr'),
                'multiple' => false,                                                  
                'noselectionstring' => get_string('novalue', 'local_newsvnr'),
            );
            $coursesetuplist = $DB->get_records('division');
            $coursesetupnames = array();
            foreach ($coursesetuplist as $key => $value) {
                $coursesetupnames[$key] = $value->divisionname;
            }
            $mform->addElement('autocomplete', 'divisionid', get_string('division','local_newsvnr'), $coursesetupnames, $division_options);
            $mform->setType('divisionid', PARAM_TEXT);
        }

        if($CFG->sitetype == MOODLE_BUSINESS) {
            $orgjobtitle_options = array(
                'placeholder' => get_string('search', 'local_newsvnr'),
                'multiple' => true,                                                  
                'noselectionstring' => get_string('novalue', 'local_newsvnr'),
            );      
            $courseofposition_options = array(
                'ajax' => 'local_newsvnr/form-search-orgjobtitle',
                'placeholder' => get_string('search', 'local_newsvnr'),
                'multiple' => true,                                                  
                'noselectionstring' => get_string('novalue', 'local_newsvnr'),
            );
            $coursesetup_options = array(
                'ajax' => 'local_newsvnr/form-search-coursesetup',
                'placeholder' => get_string('search', 'local_newsvnr'),
                'multiple' => false,                                                  
                'noselectionstring' => get_string('novalue', 'local_newsvnr'),
            );
            //Lấy danh sách khoá học setup
            $coursesetuplist = $DB->get_records('course_setup');
            $coursesetupnames = array();
            foreach ($coursesetuplist as $key => $value) {
                $coursesetupnames[$key] = $value->fullname;
            }
            //Lấy danh sách chức vụ
            $orgpositionlist = $DB->get_records('orgstructure_position');
            $orgpositionnames = array();
            if($orgpositionlist) {
                foreach ($orgpositionlist as $key => $value) {
                    $orgpositionnames[$key] = $value->name;
                }
            }
            //Lấy danh sách chức danh
            $orgjobtitlelist = $DB->get_records('orgstructure_jobtitle');
            $orgjobtitlenames = array();
            if($orgjobtitlelist) {
                foreach ($orgjobtitlelist as $key => $value) {
                    $orgjobtitlenames[$key] = $value->name;
                }
            }
            //Lấy danh sách phòng ban
            $orgstructurelist = $DB->get_records('orgstructure');
            $orgstructurenames = array();
            foreach ($orgstructurelist as $key => $value) {
                $orgstructurenames[$key] = $value->name;
            }
            //Custom by Vũ - add cousesetup
            $mform->addElement('autocomplete', 'coursesetup', get_string('coursesetup','local_newsvnr'), $coursesetupnames, $coursesetup_options);
            $mform->setType('coursesetup', PARAM_TEXT);
            $mform->hideIf('coursesetup', 'typeofcourse', 'eq', 0);
            $mform->hideIf('coursesetup', 'typeofcourse', 'eq', 3);

            $mform->addElement('text', 'courseoforgstructure', get_string('courseoforgstructure', 'local_newsvnr'), 'maxlength="200" size="50" class="mb-0"');
            // $mform->addRule('courseoforgstructure', get_string('required'), 'required', null, 'client');
            $mform->setType('courseoforgstructure', PARAM_TEXT);
            $mform->addElement('html', '<div class="form-group row fitem"><div class="col-md-2"></div><div class="col-md-3 pr-0 ml-3 form-inline felement" id="treeview-orgstructure-course" style="background-color: #e9ecef"></div></div>');
            $mform->hideIf('courseoforgstructure', 'typeofcourse', 'eq', 0);
            $mform->hideIf('courseoforgstructure', 'typeofcourse', 'eq', 3);

            $mform->addElement('autocomplete', 'courseofjobtitle', get_string('courseofjobtitle','local_newsvnr'), $orgjobtitlenames, $orgjobtitle_options);
            $mform->setType('courseofjobtitle', PARAM_TEXT);
            $mform->hideIf('courseofjobtitle', 'courseoforgstructure', 'eq', '');

            $mform->addElement('autocomplete', 'courseofposition', get_string('courseofposition','local_newsvnr'), $orgpositionnames, $courseofposition_options);
            $mform->setType('courseofposition', PARAM_TEXT);
            $mform->hideIf('courseofposition', 'courseoforgstructure', 'eq', '');

            $mform->addElement('advcheckbox', 'pinned', '', get_string('pinned', 'local_newsvnr'), array('group' => 1), array(0, 1));
            $mform->hideIf('pinned', 'typeofcourse', 'eq', 0);
            $mform->hideIf('pinned', 'typeofcourse', 'eq', 3);
            $mform->addElement('advcheckbox', 'required', '', get_string('required', 'local_newsvnr'), array('group' => 1), array(0, 1));
            $mform->hideIf('required', 'typeofcourse', 'eq', 0);
            $mform->hideIf('required', 'typeofcourse', 'eq', 3);
       
            // $mform->addElement('select', 'coursesetup', get_string('coursesetup','local_newsvnr'), $coursesetupnames);
            // $mform->addRule('courseofposition', get_string('missingcourseofpostion','local_newsvnr'), 'required', null, 'client');
            // $mform->setType('coursesetup', PARAM_INT);
        }

        // --- Kết thúc custom --- ///

        $choices = array();
        $choices['0'] = get_string('hide');
        $choices['1'] = get_string('show');
        $mform->addElement('select', 'visible', get_string('coursevisibility'), $choices);
        $mform->addHelpButton('visible', 'coursevisibility');
        $mform->setDefault('visible', $courseconfig->visible);
        if (!empty($course->id)) {
            if (!has_capability('moodle/course:visibility', $coursecontext)) {
                $mform->hardFreeze('visible');
                $mform->setConstant('visible', $course->visible);
            }
        } else {
            if (!guess_if_creator_will_have_course_capability('moodle/course:visibility', $categorycontext)) {
                $mform->hardFreeze('visible');
                $mform->setConstant('visible', $courseconfig->visible);
            }
        }
        $mform->addElement('date_time_selector', 'startdate', get_string('startdate'));
        $mform->addHelpButton('startdate', 'startdate');
        $date = (new DateTime())->setTimestamp(usergetmidnight(time()));
        $date->modify('+1 day');
        $mform->setDefault('startdate', $date->getTimestamp());

        $mform->addElement('date_time_selector', 'enddate', get_string('enddate'), array('optional' => true));
        $mform->addHelpButton('enddate', 'enddate');

        if (!empty($CFG->enablecourserelativedates)) {
            $attributes = [
                'aria-describedby' => 'relativedatesmode_warning'
            ];
            if (!empty($course->id)) {
                $attributes['disabled'] = true;
            }
            $relativeoptions = [
                0 => get_string('no'),
                1 => get_string('yes'),
            ];
            $relativedatesmodegroup = [];
            $relativedatesmodegroup[] = $mform->createElement('select', 'relativedatesmode', get_string('relativedatesmode'),
                $relativeoptions, $attributes);
            $relativedatesmodegroup[] = $mform->createElement('html', html_writer::span(get_string('relativedatesmode_warning'),
                '', ['id' => 'relativedatesmode_warning']));
            $mform->addGroup($relativedatesmodegroup, 'relativedatesmodegroup', get_string('relativedatesmode'), null, false);
            $mform->addHelpButton('relativedatesmodegroup', 'relativedatesmode');
        }

        $mform->addElement('text','idnumber', get_string('idnumbercourse'),'maxlength="100"  size="10"');
        $mform->addHelpButton('idnumber', 'idnumbercourse');
        $mform->setType('idnumber', PARAM_RAW);
        if (!empty($course->id) and !has_capability('moodle/course:changeidnumber', $coursecontext)) {
            $mform->hardFreeze('idnumber');
            $mform->setConstants('idnumber', $course->idnumber);
        }

        // Description.
        $mform->addElement('header', 'descriptionhdr', get_string('description'));
        $mform->setExpanded('descriptionhdr', false);

        $mform->addElement('editor','summary_editor', get_string('coursesummary'), null, $editoroptions);
        $mform->addHelpButton('summary_editor', 'coursesummary');
        $mform->setType('summary_editor', PARAM_RAW);
        $summaryfields = 'summary_editor';

        if ($overviewfilesoptions = course_overviewfiles_options($course)) {
            $mform->addElement('filemanager', 'overviewfiles_filemanager', get_string('courseoverviewfiles'), null, $overviewfilesoptions);
            $mform->addHelpButton('overviewfiles_filemanager', 'courseoverviewfiles');
            $summaryfields .= ',overviewfiles_filemanager';
        }

        if (!empty($course->id) and !has_capability('moodle/course:changesummary', $coursecontext)) {
            // Remove the description header it does not contain anything any more.
            $mform->removeElement('descriptionhdr');
            $mform->hardFreeze($summaryfields);
        }

        // Course format.
        $mform->addElement('header', 'courseformathdr', get_string('type_format', 'plugin'));

        $courseformats = get_sorted_course_formats(true);
        $formcourseformats = array();
        // Custom by Vũ: Loại bỏ 1 số format trong khóa học
        $ignoreformats = ['multitopic', 'onetopic', 'tiles', 'weeks', 'social', 'singleactivity'];
        foreach ($courseformats as $courseformat) {
            if(in_array($courseformat, $ignoreformats))
                continue;
            $formcourseformats[$courseformat] = get_string('pluginname', "format_$courseformat");
        }
        if (isset($course->format)) {
            $course->format = course_get_format($course)->get_format(); // replace with default if not found
            if (!in_array($course->format, $courseformats)) {
                // this format is disabled. Still display it in the dropdown
                $formcourseformats[$course->format] = get_string('withdisablednote', 'moodle',
                        get_string('pluginname', 'format_'.$course->format));
            }
        }

        $mform->addElement('select', 'format', get_string('format'), $formcourseformats);
        $mform->addHelpButton('format', 'format');
        $mform->setDefault('format', 'topcoll');

        // Button to update format-specific options on format change (will be hidden by JavaScript).
        $mform->registerNoSubmitButton('updatecourseformat');
        $mform->addElement('submit', 'updatecourseformat', get_string('courseformatudpate'));

        // Just a placeholder for the course format options.
        $mform->addElement('hidden', 'addcourseformatoptionshere');
        $mform->setType('addcourseformatoptionshere', PARAM_BOOL);

        // Appearance.
        $mform->addElement('header', 'appearancehdr', get_string('appearance'));

        if (!empty($CFG->allowcoursethemes)) {
            $themeobjects = get_list_of_themes();
            $themes=array();
            $themes[''] = get_string('forceno');
            foreach ($themeobjects as $key=>$theme) {
                if (empty($theme->hidefromselector)) {
                    $themes[$key] = get_string('pluginname', 'theme_'.$theme->name);
                }
            }
            $mform->addElement('select', 'theme', get_string('forcetheme'), $themes);
        }

        $languages=array();
        $languages[''] = get_string('forceno');
        $languages += get_string_manager()->get_list_of_translations();
        if ((empty($course->id) && guess_if_creator_will_have_course_capability('moodle/course:setforcedlanguage', $categorycontext))
                || (!empty($course->id) && has_capability('moodle/course:setforcedlanguage', $coursecontext))) {
            $mform->addElement('select', 'lang', get_string('forcelanguage'), $languages);
            $mform->setDefault('lang', $courseconfig->lang);
        }

        // Multi-Calendar Support - see MDL-18375.
        $calendartypes = \core_calendar\type_factory::get_list_of_calendar_types();
        // We do not want to show this option unless there is more than one calendar type to display.
        if (count($calendartypes) > 1) {
            $calendars = array();
            $calendars[''] = get_string('forceno');
            $calendars += $calendartypes;
            $mform->addElement('select', 'calendartype', get_string('forcecalendartype', 'calendar'), $calendars);
        }

        $options = range(0, 10);
        $mform->addElement('select', 'newsitems', get_string('newsitemsnumber'), $options);
        $courseconfig = get_config('moodlecourse');
        $mform->setDefault('newsitems', $courseconfig->newsitems);
        $mform->addHelpButton('newsitems', 'newsitemsnumber');

        $mform->addElement('selectyesno', 'showgrades', get_string('showgrades'));
        $mform->addHelpButton('showgrades', 'showgrades');
        $mform->setDefault('showgrades', $courseconfig->showgrades);

        $mform->addElement('selectyesno', 'showreports', get_string('showreports'));
        $mform->addHelpButton('showreports', 'showreports');
        $mform->setDefault('showreports', $courseconfig->showreports);

        // Files and uploads.
        $mform->addElement('header', 'filehdr', get_string('filesanduploads'));

        if (!empty($course->legacyfiles) or !empty($CFG->legacyfilesinnewcourses)) {
            if (empty($course->legacyfiles)) {
                //0 or missing means no legacy files ever used in this course - new course or nobody turned on legacy files yet
                $choices = array('0'=>get_string('no'), '2'=>get_string('yes'));
            } else {
                $choices = array('1'=>get_string('no'), '2'=>get_string('yes'));
            }
            $mform->addElement('select', 'legacyfiles', get_string('courselegacyfiles'), $choices);
            $mform->addHelpButton('legacyfiles', 'courselegacyfiles');
            if (!isset($courseconfig->legacyfiles)) {
                // in case this was not initialised properly due to switching of $CFG->legacyfilesinnewcourses
                $courseconfig->legacyfiles = 0;
            }
            $mform->setDefault('legacyfiles', $courseconfig->legacyfiles);
        }

        // Handle non-existing $course->maxbytes on course creation.
        $coursemaxbytes = !isset($course->maxbytes) ? null : $course->maxbytes;

        // Let's prepare the maxbytes popup.
        $choices = get_max_upload_sizes($CFG->maxbytes, 0, 0, $coursemaxbytes);
        $mform->addElement('select', 'maxbytes', get_string('maximumupload'), $choices);
        $mform->addHelpButton('maxbytes', 'maximumupload');
        $mform->setDefault('maxbytes', $courseconfig->maxbytes);

        // Completion tracking.
        if (completion_info::is_enabled_for_site()) {
            $mform->addElement('header', 'completionhdr', get_string('completion', 'completion'));
            $mform->addElement('selectyesno', 'enablecompletion', get_string('enablecompletion', 'completion'));
            $mform->setDefault('enablecompletion', $courseconfig->enablecompletion);
            $mform->addHelpButton('enablecompletion', 'enablecompletion', 'completion');
        } else {
            $mform->addElement('hidden', 'enablecompletion');
            $mform->setType('enablecompletion', PARAM_INT);
            $mform->setDefault('enablecompletion', 0);
        }

        enrol_course_edit_form($mform, $course, $context);

        $mform->addElement('header','groups', get_string('groupsettingsheader', 'group'));

        $choices = array();
        $choices[NOGROUPS] = get_string('groupsnone', 'group');
        $choices[SEPARATEGROUPS] = get_string('groupsseparate', 'group');
        $choices[VISIBLEGROUPS] = get_string('groupsvisible', 'group');
        $mform->addElement('select', 'groupmode', get_string('groupmode', 'group'), $choices);
        $mform->addHelpButton('groupmode', 'groupmode', 'group');
        $mform->setDefault('groupmode', $courseconfig->groupmode);

        $mform->addElement('selectyesno', 'groupmodeforce', get_string('groupmodeforce', 'group'));
        $mform->addHelpButton('groupmodeforce', 'groupmodeforce', 'group');
        $mform->setDefault('groupmodeforce', $courseconfig->groupmodeforce);

        //default groupings selector
        $options = array();
        $options[0] = get_string('none');
        $mform->addElement('select', 'defaultgroupingid', get_string('defaultgrouping', 'group'), $options);

        if ((empty($course->id) && guess_if_creator_will_have_course_capability('moodle/course:renameroles', $categorycontext))
                || (!empty($course->id) && has_capability('moodle/course:renameroles', $coursecontext))) {
            // Customizable role names in this course.
            $mform->addElement('header', 'rolerenaming', get_string('rolerenaming'));
            $mform->addHelpButton('rolerenaming', 'rolerenaming');

            if ($roles = get_all_roles()) {
                $roles = role_fix_names($roles, null, ROLENAME_ORIGINAL);
                $assignableroles = get_roles_for_contextlevels(CONTEXT_COURSE);
                foreach ($roles as $role) {
                    $mform->addElement('text', 'role_' . $role->id, get_string('yourwordforx', '', $role->localname));
                    $mform->setType('role_' . $role->id, PARAM_TEXT);
                }
            }
        }
        if (core_tag_tag::is_enabled('core', 'course') &&
                ((empty($course->id) && guess_if_creator_will_have_course_capability('moodle/course:tag', $categorycontext))
                || (!empty($course->id) && has_capability('moodle/course:tag', $coursecontext)))) {
            $mform->addElement('header', 'tagshdr', get_string('tags', 'tag'));
            $mform->addElement('tags', 'tags', get_string('tags'),
                    array('itemtype' => 'course', 'component' => 'core'));
        }

        // Add custom fields to the form.
        $handler = core_course\customfield\course_handler::create();
        $handler->set_parent_context($categorycontext); // For course handler only.
        $handler->instance_form_definition($mform, empty($course->id) ? 0 : $course->id);

        // When two elements we need a group.
        $buttonarray = array();
        $classarray = array('class' => 'form-submit');
        if ($returnto !== 0) {
            $buttonarray[] = &$mform->createElement('submit', 'saveandreturn', get_string('savechangesandreturn'), $classarray);
        }
        $buttonarray[] = &$mform->createElement('submit', 'saveanddisplay', get_string('savechangesanddisplay'), $classarray);
        $buttonarray[] = &$mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
        $mform->closeHeaderBefore('buttonar');

        $mform->addElement('hidden', 'id', null);
        $mform->setType('id', PARAM_INT);

        // Prepare custom fields data.
        $handler->instance_form_before_set_data($course);
        // Finally set the current form data
        $this->set_data($course);
    }

    /**
     * Fill in the current page data for this course.
     */
    function definition_after_data() {
        global $DB;

        $mform = $this->_form;

        // add available groupings
        $courseid = $mform->getElementValue('id');
        if ($courseid and $mform->elementExists('defaultgroupingid')) {
            $options = array();
            if ($groupings = $DB->get_records('groupings', array('courseid'=>$courseid))) {
                foreach ($groupings as $grouping) {
                    $options[$grouping->id] = format_string($grouping->name);
                }
            }
            core_collator::asort($options);
            $gr_el =& $mform->getElement('defaultgroupingid');
            $gr_el->load($options);
        }

        // add course format options
        $formatvalue = $mform->getElementValue('format');
        if (is_array($formatvalue) && !empty($formatvalue)) {

            $params = array('format' => $formatvalue[0]);
            // Load the course as well if it is available, course formats may need it to work out
            // they preferred course end date.
            if ($courseid) {
                $params['id'] = $courseid;
            }
            $courseformat = course_get_format((object)$params);

            $elements = $courseformat->create_edit_form_elements($mform);
            for ($i = 0; $i < count($elements); $i++) {
                $mform->insertElementBefore($mform->removeElement($elements[$i]->getName(), false),
                        'addcourseformatoptionshere');
            }

            // Remove newsitems element if format does not support news.
            if (!$courseformat->supports_news()) {
                $mform->removeElement('newsitems');
            }
        }

        // Tweak the form with values provided by custom fields in use.
        $handler  = core_course\customfield\course_handler::create();
        $handler->instance_form_definition_after_data($mform, empty($courseid) ? 0 : $courseid);
    }

    /**
     * Validation.
     *
     * @param array $data
     * @param array $files
     * @return array the errors that were found
     */
    function validation($data, $files) {
        global $DB;

        $errors = parent::validation($data, $files);

        // Add field validation check for duplicate shortname.
        if ($course = $DB->get_record('course', array('shortname' => $data['shortname']), '*', IGNORE_MULTIPLE)) {
            if (empty($data['id']) || $course->id != $data['id']) {
                $errors['shortname'] = get_string('shortnametaken', '', $course->fullname);
            }
        }

        // Add field validation check for duplicate idnumber.
        if (!empty($data['idnumber']) && (empty($data['id']) || $this->course->idnumber != $data['idnumber'])) {
            if ($course = $DB->get_record('course', array('idnumber' => $data['idnumber']), '*', IGNORE_MULTIPLE)) {
                if (empty($data['id']) || $course->id != $data['id']) {
                    $errors['idnumber'] = get_string('courseidnumbertaken', 'error', $course->fullname);
                }
            }
        }

        if ($errorcode = course_validate_dates($data)) {
            $errors['enddate'] = get_string($errorcode, 'error');
        }

        $errors = array_merge($errors, enrol_course_edit_validation($data, $this->context));

        $courseformat = course_get_format((object)array('format' => $data['format']));
        $formaterrors = $courseformat->edit_form_validation($data, $files, $errors);
        if (!empty($formaterrors) && is_array($formaterrors)) {
            $errors = array_merge($errors, $formaterrors);
        }

        // Add the custom fields validation.
        $handler = core_course\customfield\course_handler::create();
        $errors  = array_merge($errors, $handler->instance_form_validation($data, $files));

        return $errors;
    }
}
