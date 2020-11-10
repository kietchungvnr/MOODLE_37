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
 * Overriden theme boost core renderer.
 *
 * @package    theme_moove
 * @copyright  2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_moove\output;

use html_writer;
use custom_menu;
use action_menu_filler;
use action_menu_link_secondary;
use stdClass;
use moodle_url;
use action_menu;
use pix_icon;
use theme_config;
use core_text;
use help_icon;
use context_system;
use core_course_list_element;
use context_module;
use moodle_page;
use single_button;
use theme_moove\output\core\course_renderer;
use theme_moove\util\theme_settings;
defined('MOODLE_INTERNAL') || die;

define('RESOURCE_DISPLAY_GOOGLE_DOCS_POPUP', 7);

/**
 * Renderers to align Moodle's HTML with that expected by Bootstrap
 *
 * @package    theme_moove
 * @copyright  2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class core_renderer extends \theme_boost\output\core_renderer {
    /**
     * Renders the custom menu
     *
     * @param custom_menu $menu
     * @return mixed
     */
    protected function render_custom_menu(custom_menu $menu) {
        if (!$menu->has_children()) {
            return '';
        }

        $content = '';
        foreach ($menu->get_children() as $item) {
            $context = $item->export_for_template($this);
            $content .= $this->render_from_template('core/custom_menu_item', $context);
        }

        return $content;
    }
    public function full_header() {
        global $PAGE;
        $header = new stdClass();
        if($PAGE->pagelayout == 'frontpage') {
            $header->active = false;
        } else {
            $header->active = true;
        }
        $header->settingsmenu = $this->context_header_settings_menu();
        if($PAGE->pagelayout == "course"){
            $header->contextheader = $this->header_course();
        }
        else {
            $header->contextheader = $this->context_header(null,2);
        }
        $header->hasnavbar = empty($PAGE->layout_options['nonavbar']);
        $header->navbar = $this->navbar();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();
        return $this->render_from_template('theme_moove/fp_header', $header);
    }
    public function menu_focus(){
        global $COURSE, $CFG, $OUTPUT, $DB;
        $allmodinfo = get_fast_modinfo($COURSE)->get_section_info_all();
        $process = round(\core_completion\progress::get_course_progress_percentage($COURSE));
        $linkcourse = $CFG->wwwroot.'/course/view.php?id='.$COURSE->id;
        $output = '';
        $output .= '<nav class="fixed-top navbar moodle-has-zindex focusmod">';
        $output .= '<div class="d-flex menu-left">';
        $output .= '<div class="home-focus border-right"><a href="'.$CFG->wwwroot.'/my"><i class="fa fa-3x fa-home" aria-hidden="true"></i></a></div>';
        $output .= '<div class="course-info-focus"><div class="page-header-headings"><a href="'.$linkcourse.'">'.$COURSE->fullname.'</a></div>';
        $output .= '<div class="d-flex"><div class="progress course">';
        $output .= '<div class="progress-bar" role="progressbar" aria-valuenow="'.$process.'"
                    aria-valuemin="0" aria-valuemax="100" style="width:'.$process.'%"></div></div><div>'.$process.'%</div>';
        $output .= '</div></div>';
        // $output .= '<div id="focus-mod" class="open-focusmod border-left border-right" data-placement="left"><i class="fa fa-external-link"></i><span class="ml-1 mr-1">'.get_string('zoomout','local_newsvnr').'</span></div>';
        $output .= '</div>';

        $output .= '<div class="menu-right"><ul class="d-flex">';
        $output .= '<li class="nav-item border-left"><a class="nav-link focusmod prev"><i class="fa fa-angle-left mr-2"></i>'.get_string('prevmodule','theme_moove').'</a></li>
                    <li class="nav-item border-left mid"><a class="nav-link focusmod">'.get_string('coursedata','theme_moove').'<i class="fa fa-angle-down rotate-icon ml-2"></i></a></li>
                    <li class="nav-item border-left"><a class="nav-link focusmod next">'.get_string('nextmodule','theme_moove').'<i class="fa fa-angle-right ml-2"></i></a></li>';
        $output .= '<div id="focus-mod" class="open-focusmod border-left border-right" data-placement="left"><i class="fa fa-external-link"></i><span class="ml-1 mr-1">'.get_string('zoomout','local_newsvnr').'</span></div>';
        $output .= '<div class="dropdown-content">';
        foreach ($allmodinfo as $modinfo) {
            $sectioninfo = $DB->get_record_sql('SELECT * FROM {course_sections} WHERE id = :section', ['section' => $modinfo->id]);
                if($sectioninfo->sequence == '') {
                    continue;
                }
                $output .= '<div class="card-header level1" id="'.$modinfo->id.'">';
                if($modinfo->name == '' && $modinfo->section != 0) {
                    $output .= '<a>'.get_string('topic', 'theme_moove').' '.$modinfo->section.'';
                } else {
                    $output .= '<a>'.$modinfo->name.'';
                }
                $output .= '<i class="fa fa-angle-up rotate-icon float-right"></i>';
                $output .= '</a>';
                $output .= '</div>';
                $output .= '<div class="dropdown-content-2 '.$modinfo->id.'">';
                foreach($modinfo->modinfo->cms as $cms) {
                    if($cms->section == $modinfo->id && $cms->visible == 1) {
                        $getmodules = $DB->get_records_sql('SELECT cm.id, cm.deletioninprogress FROM {course_modules} cm JOIN {course_sections} cs ON cm.section = cs.id WHERE cm.instance = :section AND cm.course = :courseid',['section' => $cms->instance,'courseid' => $COURSE->id]);
                        foreach($getmodules as $getmodule) {
                            if($getmodule->deletioninprogress != 0) {
                                continue;
                            }    
                        }
                        
                        $url = $CFG->wwwroot . '/mod/' . $cms->modname . '/view.php?id=' . $cms->id;
                        $modname = $cms->name;
                        $output .= '<div class="card-header level2">';
                        if($cms->modname == 'resource') {
                            $img = $OUTPUT->image_url($cms->icon);
                            $displayresource = $DB->get_field('resource', 'display', ['id' => $cms->instance]);
                            if($displayresource == RESOURCE_DISPLAY_GOOGLE_DOCS_POPUP) {
                                $cm = $DB->get_field('course_modules', 'id', ['instance' => $cms->instance]);
                                $output .= '<img  src="'.$img.'"><a onclick="showmodal('.$cm.', '.$cms->instance.')" href="javascript:;">'.$modname.'</a>';
                            } else {
                                $output .= '<img  src="'.$img.'"><a href="'.$url.'">'.$modname.'</a>';
                            }
                        } else {
                            $img = $OUTPUT->image_url('icon', $cms->modname);
                            $output .= '<img  src="'.$img.'"><a href="'.$url.'">'.$modname.'</a>';
                        }
                        $output .= '</div>';    
                    }
                }
                $output .='</div>';
        }
        $output .= '</div>';
        $output .= '</ul></div>';
        $output .= '</nav>';
        return $output;
    }
    public function header_course() {
        global $COURSE, $CFG, $OUTPUT, $PAGE;
        $process = round(\core_completion\progress::get_course_progress_percentage($COURSE));
        $output = '';
        $output .= '<div class="header-progress d-flex justify-content-between align-items-center"><div class="page-header-headings"><h2>'.$COURSE->fullname.'</h2></div>';
        $output .= '<div class="d-flex float-right align-items-center">';
        $output .= '<div class="progress course">';
        $output .= '<div class="progress-bar" role="progressbar" aria-valuenow="'.$process.'"
                    aria-valuemin="0" aria-valuemax="100" style="width:'.$process.'%"></div></div><div class="pr-2">'.$process.'%</div>';
        $output .= '<div id="focus-mod" class="open-focusmod mr-2" data-placement="left"><i class="fa fa-desktop"></i><span class="ml-2 mr-2">'.get_string('zoomin','local_newsvnr').'</span></div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }

    public function menucoursecategory($menus, $id_parent = 0, &$output = '', $stt = 0) {
        global $DB, $CFG;
        $courselink = $CFG->wwwroot . '/course/view.php?id=';
        $theme_settings = new theme_settings();
        $menu_tmp = array();
        foreach ($menus as $key => $item) {
            if ((int) $item->parent == (int) $id_parent) {
                $menu_tmp[] = $item;
                unset($menus[$key]);
            }
        }
        if ($menu_tmp) {   
            if($stt == 0)
                $output .= '<ul class="dropdown-menu" role="menu" id="drop-course-category">';
            else {
                if($id_parent == 0)
                    $output .= '<ul class="dropdown-menu">';
            }
            foreach ($menu_tmp as $item) {
                $output .= '<li class="dropdown-submenu">';
                $output .= '<a  class="dropdown-item" href="javascript:;">' . $item->name . ' </a>';
                $courses = $DB->get_records('course',['category' => $item->id, 'visible' => 1]); 
                $output .= '<ul class="dropdown-menu">';
                foreach($courses as $course) {
                    $output .= '<li><a class="dropdown-item" href="'.$courselink . $course->id.'">' . $course->fullname . '</a></li>';
                }
                foreach($menus as $childkey => $childitem) {
                    // Kiểm tra phần tử có con hay không?
                    if($childitem->parent == $item->id) {
                        $output .= '<li class="dropdown-submenu">';
                        $output .= '<a  class="dropdown-item" href="javascript:;">' . $childitem->name . ' </a>';
                        $childcourses = $DB->get_records('course',['category' => $childitem->id, 'visible' => 1]);
                        $output .= '<ul class="dropdown-menu">';

                        foreach($childcourses as $childcourse) {
                            $output .= '<li><a class="dropdown-item" href="'.$courselink . $childcourse->id.'">' . $childcourse->fullname . '</a></li>';
                        }
                        unset($menus[$childkey]);
                        $this->menucoursecategory($menus, $childitem->id, $output, ++$stt);
                        $output .= '</li>';
                        $output .= '</ul>';
                        $output .= '</li>';
                    } 
                }
                $output .= '</ul>';
                $output .= '</li>';
            }
            if($stt == 0)
                $output .= '</ul>';
            else {
                if($id_parent == 0)
                    $output .= '</ul>';
            }
        }
        return $output;

    }
   
    public function nav_course_categories() {
        global $DB;
        $categories = $DB->get_records_sql('SELECT DISTINCT cc.name,cc.id, cc.parent FROM mdl_course_categories cc JOIN mdl_course c ON cc.id = c.category 
        WHERE cc.visible = 1');
        // $categories = $DB->get_records_sql('SELECT * FROM mdl_course_categories');
        return $this->menucoursecategory($categories);
        
    }


    public function nav_coursebystudent() {
        global $USER, $CFG;
        $output = '';
        $courselink = $CFG->wwwroot . '/course/view.php?id=';
        $listcourse = get_list_course_by_student($USER->id);
        if ($listcourse) 
        {
            foreach ($listcourse as $item) 
            {   
                $output .= '<li class="dropdown-item">';
                $output .= '<a href="'.$courselink . $item->id.'">' . $item->fullname . ' </a>';
                $output .= '</li>';
            }

        }
        return $output;
    }
    
    public function nav_coursebyteacher() {
        global $USER, $CFG;
        $output = '';
        $courselink = $CFG->wwwroot . '/course/view.php?id=';
        $listcourse = get_list_course_by_teacher($USER->id);
        if ($listcourse) 
        {

            foreach ($listcourse as $item) 
            {   
                $output .= '<li class="dropdown-item">';

                $output .= '<a href="'.$courselink . $item->id.'">' . $item->fullname . ' </a>';
                
                $output .= '</li>';
            }

        }
        return $output;
    }

    public function nav_course() {
        global $DB, $CFG, $USER;
        $header = new stdClass();
        $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
        $draweropenright = (get_user_preferences('sidepre-open', 'true') == 'true');
        if(isloggedin()) {
            $roleid = $DB->get_field('role', 'id', ['shortname' => 'editingteacher']);
            $isteacheranywhere = $DB->record_exists('role_assignments', ['userid' => $USER->id, 'roleid' => $roleid]);
            $header->active = true;
            $header->nav_course_categories = $this->nav_course_categories();
            if($isteacheranywhere) {
                $header->nav_coursebyteacher = $this->nav_coursebyteacher();
            }
            $header->nav_coursebystudent = $this->nav_coursebystudent();
            $header->course_search_form_fp = $this->course_search_form_fp();
            $header->hasdrawertoggle = true;
            $header->navdraweropen = $navdraweropen;
            $header->draweropenright = $draweropenright;

        } else {
            $header->active = false;
        }
        return $this->render_from_template('theme_moove/fp_flatnavigation', $header);
    }

    public function nav_header() {
        global $CFG;
        $theme = theme_config::load('moove');
        $output = '';
        $home = $CFG->wwwroot;
        $dashboard = $CFG->wwwroot . '/my/';
        $library = $CFG->wwwroot . '/library.php';
        $filelibrary = $CFG->wwwroot . '/local/newsvnr/generallibrary.php';
        $course = $CFG->wwwroot . '/course/index.php';
        $news = $CFG->wwwroot . '/local/newsvnr/index.php';
        $forum = $CFG->wwwroot . '/local/newsvnr/forum.php';
        $calendar = $CFG->wwwroot . '/calendar/view.php?view=month';
        $files = $CFG->wwwroot . '/user/files.php';
        if(isset($theme->settings->displayhome) && $theme->settings->displayhome == 1){
            $output .= '<a class="nav-active" href="'.$home .'"><li>'. get_string('home', 'theme_moove') .'</li></a>';
        }
        $output .='
            <a class="nav-active" href="'.$dashboard .'"><li>'. get_string('dashboard', 'theme_moove') .'</li></a>
            <a class="nav-active" href="'.$library .'"><li>'. get_string('library', 'theme_moove') .'</li></a>
            <a class="nav-active" href="'.$filelibrary .'"><li>'. get_string('filelibrary', 'theme_moove') .'</li></a>
            <a class="nav-active" href="'.$course .'"><li>'. get_string('course', 'theme_moove') .'</li></a>
            <a class="nav-active" href="'.$news .'"><li>'. get_string('news', 'theme_moove') .'</li></a>
            <a class="nav-active" href="'.$forum .'"><li>'. get_string('forum', 'theme_moove') .'</li></a>
            <a class="nav-active" href="'.$calendar .'"><li>'. get_string('calendar', 'theme_moove') .'</li></a>
            <a class="nav-active" href="'.$files .'"><li>'. get_string('privatedata', 'theme_moove') .'</li></a>
            ';
        return $output;
    }

    /**
     * Renders the lang menu
     *
     * @return mixed
     */
    public function render_lang_menu() {
        $langs = get_string_manager()->get_list_of_translations();
        $haslangmenu = $this->lang_menu() != '';
        $menu = new custom_menu;
        if(!isguestuser()){
            if ($haslangmenu) {
                $strlang = get_string('language');
                $currentlang = current_language();
                if (isset($langs[$currentlang])) {
                    $currentlang = $langs[$currentlang];
                } else {
                    $currentlang = $strlang;
                }
                $this->language = $menu->add($currentlang, new moodle_url('#'), $strlang, 10000);
                foreach ($langs as $langtype => $langname) {
                    $this->language->add($langname, new moodle_url($this->page->url, array('lang' => $langtype)), $langname);
                }
                foreach ($menu->get_children() as $item) {
                    $context = $item->export_for_template($this);
                }
                if (isset($context)) {
                    return $this->render_from_template('theme_moove/lang_menu', $context);
                }
            }
        }
    }

    /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header.
     */
    public function mydashboard_admin_header() {
        global $PAGE;

        $html = html_writer::start_div('row');
        $html .= html_writer::start_div('col-xs-12 mt-3');

        $pageheadingbutton = $this->page_heading_button();
        if (empty($PAGE->layout_options['nonavbar'])) {
            $html .= html_writer::start_div('clearfix w-100 pull-xs-left', array('id' => 'page-navbar'));
            $html .= html_writer::tag('div', $this->navbar(), array('class' => 'breadcrumb-nav'));
            $html .= html_writer::div($pageheadingbutton, 'breadcrumb-button');
            $html .= html_writer::end_div();
        } else if ($pageheadingbutton) {
            $html .= html_writer::div($pageheadingbutton, 'breadcrumb-button nonavbar pull-xs-right m-r-1');
        }

        $html .= html_writer::end_div(); // End .row.
        $html .= html_writer::end_div(); // End .col-xs-12.

        return $html;
    }
    /**
     * Wrapper for header elements.
     *
     * @return string HTML to display the main header.
     */
    public function mydashboard_user_header() {
        global $PAGE,$DB,$USER;
        // var_dump($USER->editing);die;
        $html = html_writer::start_div('row');
        $html .= html_writer::start_div('col-xs-12 mt-2 mb-2');
        $teacherdbbutton = '';
        $studentdbbutton = '';
        $addblockbutton = '';
        $pageheadingbutton = $this->page_heading_button();
        if ($PAGE->user_is_editing() && $PAGE->user_can_edit_blocks() && ($PAGE->blocks->get_addable_blocks())) {
            $url = new moodle_url($PAGE->url, ['bui_addblock' => '', 'sesskey' => sesskey()]);
            $addblockbutton = '<a href="'.$url.'" class="metismenu text-icon-dashboard" data-key="addblock"><i class="fa fa-empire text-icon-dashboard" aria-hidden="true"></i>'. get_string('addblock') .'</a> | ';
        }
        $roles = $DB->get_records_sql('SELECT DISTINCT roleid FROM {role_assignments} WHERE userid = ?',[$USER->id]);
        foreach($roles as $role) {
            if($role->roleid == 3) {
                $url = new moodle_url('/local/newsvnr/dashboard.php?view=teacher');
                $teacherdbbutton = '<a href="'.$url.'" class="text-icon-dashboard"><i class="fa fa-eye text-icon-dashboard" aria-hidden="true"></i>'. get_string('teacherdashboard', 'local_newsvnr') .'</a> | ';
            } else if($role->roleid == 5) {
                $url = new moodle_url('/local/newsvnr/dashboard.php?view=student');
                $studentdbbutton = '<a href="'.$url.'" class="text-icon-dashboard"><i class="fa fa-eye text-icon-dashboard" aria-hidden="true"></i>'. get_string('studentdashboard', 'local_newsvnr') .'</a>';
            }
        }
        
        if (empty($PAGE->layout_options['nonavbar'])) {
            $html .= html_writer::start_div('clearfix w-100 pull-xs-left', array('id' => 'page-navbar'));
            $html .= html_writer::tag('div', $this->navbar(), array('class' => 'breadcrumb-nav'));
            $html .= html_writer::div($pageheadingbutton, 'breadcrumb-button');
            $html .= html_writer::end_div();
        } else if ($pageheadingbutton) {
            $html .= html_writer::div($addblockbutton . $pageheadingbutton, 'breadcrumb-button nonavbar pull-right m-r-1');
            // $html .= html_writer::div($addblockbutton . $pageheadingbutton .' | '. $teacherdbbutton . $studentdbbutton, 'breadcrumb-button nonavbar pull-right m-r-1');
        }

        $html .= html_writer::end_div(); // End .row.
        $html .= html_writer::end_div(); // End .col-xs-12.

        return $html;
    }

    /**
     * Renders the login form.
     *
     * @param \core_auth\output\login $form The renderable.
     * @return string
     */
    public function render_login(\core_auth\output\login $form) {
        global $SITE;

        $context = $form->export_for_template($this);

        // Override because rendering is not supported in template yet.
        $context->cookieshelpiconformatted = $this->help_icon('cookiesenabled');
        $context->errorformatted = $this->error_text($context->error);

        $context->logourl = $this->get_logo();
        $context->sitename = format_string($SITE->fullname, true, array('context' => \context_course::instance(SITEID)));

        return $this->render_from_template('core/login', $context);
    }

    /**
     * Gets the logo to be rendered.
     *
     * The priority of get log is: 1st try to get the theme logo, 2st try to get the theme logo
     * If no logo was found return false
     *
     * @return mixed
     */
    public function get_logo() {
        if ($this->should_display_theme_logo()) {
            return $this->get_theme_logo_url();
        }

        $url = $this->get_logo_url();
        if ($url) {
            return $url->out(false);
        }

        return false;
    }

    public function get_navcourse_color() {
        $theme = theme_config::load('moove');
        return $theme->setting_file_url('logo', 'logo');
    }

    /**
     * Outputs the pix url base
     *
     * @return string an URL.
     */
    public function get_pix_image_url_base() {
        global $CFG;

        return $CFG->wwwroot . "/theme/moove/pix";
    }

    /**
     * Whether we should display the main theme logo in the navbar.
     *
     * @return bool
     */
    public function should_display_theme_logo() {
        $logo = $this->get_theme_logo_url();

        return !empty($logo);
    }

    /**
     * Outputs the favicon urlbase.
     *
     * @return string an url
     */
    public function favicon() {
        $theme = theme_config::load('moove');

        $favicon = $theme->setting_file_url('favicon', 'favicon');

        if (!empty(($favicon))) {
            return $favicon;
        }

        return parent::favicon();
    }

    /**
     * Get the main logo URL.
     *
     * @return string
     */
    public function get_theme_logo_url() {
        $theme = theme_config::load('moove');

        return $theme->setting_file_url('logo', 'logo');
    }

    /**
     * Return the site identity providers
     *
     * @return mixed
     */
    public function get_identity_providers() {
        global $CFG;

        $authsequence = get_enabled_auth_plugins(true);

        require_once($CFG->libdir . '/authlib.php');

        $identityproviders = \auth_plugin_base::get_identity_providers($authsequence);

        return $identityproviders;
    }

    /**
     * Verify whether the site has identity providers
     *
     * @return mixed
     */
    public function has_identity_providers() {
        global $CFG;

        $authsequence = get_enabled_auth_plugins(true);

        require_once($CFG->libdir . '/authlib.php');

        $identityproviders = \auth_plugin_base::get_identity_providers($authsequence);

        return !empty($identityproviders);
    }

    /**
     * Construct a user menu, returning HTML that can be echoed out by a
     * layout file.
     *
     * @param stdClass $user A user object, usually $USER.
     * @param bool $withlinks true if a dropdown should be built.
     * @return string HTML fragment.
     */
    public function user_menu($user = null, $withlinks = null) {
        global $USER, $CFG;
        require_once($CFG->dirroot . '/user/lib.php');

        if (is_null($user)) {
            $user = $USER;
        }

        // Note: this behaviour is intended to match that of core_renderer::login_info,
        // but should not be considered to be good practice; layout options are
        // intended to be theme-specific. Please don't copy this snippet anywhere else.
        if (is_null($withlinks)) {
            $withlinks = empty($this->page->layout_options['nologinlinks']);
        }

        // Add a class for when $withlinks is false.
        $usermenuclasses = 'usermenu';
        if (!$withlinks) {
            $usermenuclasses .= ' withoutlinks';
        }

        $returnstr = "";

        // If during initial install, return the empty return string.
        if (during_initial_install()) {
            return $returnstr;
        }

        $loginpage = $this->is_login_page();
        $loginurl = get_login_url();
        // If not logged in, show the typical not-logged-in string.
        if (!isloggedin()) {
            $returnstr = '';
            if (!$loginpage) {
                $returnstr .= "<a class='btn btn-login-top' href=\"$loginurl\">" . get_string('login') . '</a>';
            }

            $theme = theme_config::load('moove');

            if (!$theme->settings->disablefrontpageloginbox) {
                return html_writer::tag(
                    'li',
                    html_writer::span(
                        $returnstr,
                        'login'
                    ),
                    array('class' => $usermenuclasses)
                );
            }

            $context = [
                'loginurl' => $loginurl,
                'logintoken' => \core\session\manager::get_login_token(),
                'canloginasguest' => $CFG->guestloginbutton and !isguestuser(),
                'canloginbyemail' => !empty($CFG->authloginviaemail),
                'cansignup' => $CFG->registerauth == 'email' || !empty($CFG->registerauth)

            ];

            return $this->render_from_template('theme_moove/frontpage_guest_loginbtn', $context);
        }

        // If logged in as a guest user, show a string to that effect.
        if (isguestuser()) {
            $returnstr = get_string('loggedinasguest');
            if (!$loginpage && $withlinks) {
                $returnstr .= " (<a href=\"$loginurl\">".get_string('login').'</a>)';
            }

            return html_writer::tag(
                'li',
                html_writer::span(
                    $returnstr,
                    'login'
                ),
                array('class' => $usermenuclasses)
            );
        }

        // Get some navigation opts.
        $opts = user_get_user_navigation_info($user, $this->page);

        $avatarclasses = "avatars";
        $avatarcontents = html_writer::span($opts->metadata['useravatar'], 'avatar current');
        $usertextcontents = '';

        // Other user.
        if (!empty($opts->metadata['asotheruser'])) {
            $avatarcontents .= html_writer::span(
                $opts->metadata['realuseravatar'],
                'avatar realuser'
            );
            $usertextcontents = $opts->metadata['realuserfullname'];
            $usertextcontents .= html_writer::tag(
                'span',
                get_string(
                    'loggedinas',
                    'moodle',
                    html_writer::span(
                        $opts->metadata['userfullname'],
                        'value'
                    )
                ),
                array('class' => 'meta viewingas')
            );
        }

        // Role.
        if (!empty($opts->metadata['asotherrole'])) {
            $role = core_text::strtolower(preg_replace('#[ ]+#', '-', trim($opts->metadata['rolename'])));
            $usertextcontents .= html_writer::span(
                $opts->metadata['rolename'],
                'meta role role-' . $role
            );
        }

        // User login failures.
        if (!empty($opts->metadata['userloginfail'])) {
            $usertextcontents .= html_writer::span(
                $opts->metadata['userloginfail'],
                'meta loginfailures'
            );
        }

        // MNet.
        if (!empty($opts->metadata['asmnetuser'])) {
            $mnet = strtolower(preg_replace('#[ ]+#', '-', trim($opts->metadata['mnetidprovidername'])));
            $usertextcontents .= html_writer::span(
                $opts->metadata['mnetidprovidername'],
                'meta mnet mnet-' . $mnet
            );
        }

        $returnstr .= html_writer::span(
            html_writer::span($USER->firstname .' '. $USER->lastname, 'usertext') .
            html_writer::span($avatarcontents, $avatarclasses),
            'userbutton'
        );

        // Create a divider (well, a filler).
        $divider = new action_menu_filler();
        $divider->primary = false;

        $actionmenu = new action_menu();
        $actionmenu->set_menu_trigger(
            $returnstr
        );
        $actionmenu->set_alignment(action_menu::TR, action_menu::BR);
        $actionmenu->set_nowrap_on_items();
        if ($withlinks) {
            $navitemcount = count($opts->navitems);
            $idx = 0;

            // Adds username to the first item of usermanu.
            $userinfo = new stdClass();
            $userinfo->itemtype = 'text';
            $userinfo->title = $user->firstname . ' ' . $user->lastname;
            $userinfo->url = new moodle_url('/user/profile.php', array('id' => $user->id));
            $userinfo->pix = 'i/user';

            array_unshift($opts->navitems, $userinfo);

            foreach ($opts->navitems as $value) {

                switch ($value->itemtype) {
                    case 'divider':
                        // If the nav item is a divider, add one and skip link processing.
                    $actionmenu->add($divider);
                    break;

                    case 'invalid':
                        // Silently skip invalid entries (should we post a notification?).
                    break;

                    case 'text':
                    $amls = new action_menu_link_secondary(
                        $value->url,
                        $pix = new pix_icon($value->pix, $value->title, null, array('class' => 'iconsmall')),
                        $value->title,
                        array('class' => 'text-username')
                    );

                    $actionmenu->add($amls);
                    break;

                    case 'link':
                        // Process this as a link item.
                    $pix = null;
                    if (isset($value->pix) && !empty($value->pix)) {
                        $pix = new pix_icon($value->pix, $value->title, null, array('class' => 'iconsmall'));
                    } else if (isset($value->imgsrc) && !empty($value->imgsrc)) {
                        $value->title = html_writer::img(
                            $value->imgsrc,
                            $value->title,
                            array('class' => 'iconsmall')
                        ) . $value->title;
                    }

                    $amls = new action_menu_link_secondary(
                        $value->url,
                        $pix,
                        $value->title,
                        array('class' => 'icon')
                    );
                    if (!empty($value->titleidentifier)) {
                        $amls->attributes['data-title'] = $value->titleidentifier;
                    }
                    $actionmenu->add($amls);
                    break;
                }

                $idx++;

                // Add dividers after the first item and before the last item.
                if ($idx == 1 || $idx == $navitemcount) {
                    $actionmenu->add($divider);
                }
            }
        }

        return html_writer::tag(
            'li',
            $this->render($actionmenu),
            array('class' => $usermenuclasses)
        );
    }

    /**
     * Secure login info.
     *
     * @return string
     */
    public function secure_login_info() {
        return $this->login_info(false);
    }

    /**
     * Implementation of user image rendering.
     *
     * @param help_icon $helpicon A help icon instance
     * @return string HTML fragment
     */
    public function render_help_icon(help_icon $helpicon) {
        $context = $helpicon->export_for_template($this);
        // Solving the issue - "Your progress" help tooltip in course home page displays in outside the screen display.
        // Check issue https://github.com/willianmano/moodle-theme_moove/issues/5.
        if ($helpicon->identifier === 'completionicons' && $helpicon->component === 'completion') {
            $context->ltr = right_to_left();
        }

        return $this->render_from_template('core/help_icon', $context);
    }

    /**
     * Returns a search box.
     *
     * @param  string $identifier The search box wrapper div id, defaults to an autogenerated one.
     * @return string HTML with the search form hidden by default.
     */
    public function search_box($identifier = false) {
        global $CFG;

        // Accessing $CFG directly as using \core_search::is_global_search_enabled would
        // result in an extra included file for each site, even the ones where global search
        // is disabled.
        if (empty($CFG->enableglobalsearch) || !has_capability('moodle/search:query', context_system::instance())) {
            return '';
        }

        if ($identifier == false) {
            $identifier = uniqid();
        } else {
            // Needs to be cleaned, we use it for the input id.
            $identifier = clean_param($identifier, PARAM_ALPHANUMEXT);
        }

        // JS to animate the form.
        $this->page->requires->js_call_amd('core/search-input', 'init', array($identifier));

        $iconattrs = array(
            'class' => 'slicon-magnifier',
            'title' => get_string('search', 'search'),
            'aria-label' => get_string('search', 'search'),
            'aria-hidden' => 'true');
        $searchicon = html_writer::tag('i', '', $iconattrs);

        $formattrs = array('class' => 'search-input-form', 'action' => $CFG->wwwroot . '/search/index.php');
        $inputattrs = array('type' => 'text', 'name' => 'q', 'placeholder' => get_string('search', 'search'),
            'size' => 13, 'tabindex' => -1, 'id' => 'id_q_' . $identifier, 'class' => 'form-control');

        $contents = html_writer::tag('label', get_string('enteryoursearchquery', 'search'),
            array('for' => 'id_q_' . $identifier, 'class' => 'accesshide')) . html_writer::tag('input', '', $inputattrs);

        $btnclose = '<a class="close-search"><i class="fa fa-times"></i></a>';

        $searchinput = html_writer::tag('form', $contents . $btnclose, $formattrs);

        return html_writer::tag('div',
            $searchicon . $searchinput,
            array('class' => 'moove-search-input nav-link', 'id' => $identifier));
    }

    /**
     * The standard tags (meta tags, links to stylesheets and JavaScript, etc.)
     * that should be included in the <head> tag. Designed to be called in theme
     * layout.php files.
     *
     * @return string HTML fragment.
     */
    public function standard_head_html() {
        $output = parent::standard_head_html();

        // Add google analytics code.
        $googleanalyticscode = "<script>
        window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};
        ga.l=+new Date;ga('create', 'GOOGLE-ANALYTICS-CODE', 'auto');
        ga('send', 'pageview');
        </script>
        <script async src='https://www.google-analytics.com/analytics.js'></script>";

        $theme = theme_config::load('moove');

        if (!empty($theme->settings->googleanalytics)) {
            $output .= str_replace("GOOGLE-ANALYTICS-CODE", trim($theme->settings->googleanalytics), $googleanalyticscode);
        }   

        return $output;
    }

    /**
     * Try to return the first image on course summary files, otherwise returns a default image.
     *
     * @return string HTML fragment.
     */
    public function courseheaderimage() {
        global $CFG, $COURSE, $DB;

        $course = $DB->get_record('course', ['id' => $COURSE->id]);

        $course = new core_course_list_element($course);

        $courseimage = '';
        $imageindex = 1;
        foreach ($course->get_course_overviewfiles() as $file) {
            $isimage = $file->is_valid_image();

            $url = new moodle_url("$CFG->wwwroot/pluginfile.php" . '/'. $file->get_contextid(). '/'. $file->get_component(). '/'.
                $file->get_filearea(). $file->get_filepath(). $file->get_filename(), ['forcedownload' => !$isimage]);

            if ($isimage) {
                $courseimage = $url;
            }

            if ($imageindex == 2) {
                break;
            }

            $imageindex++;
        }

        if (empty($courseimage)) {
            $courseimage = $this->get_pix_image_url_base() . "/default_coursesummary.jpg";
        }

        // Create html for header.
        $html = html_writer::start_div('headerbkg');

        $html .= html_writer::start_div('withimage', array(
            'style' => 'background-image: url("' . $courseimage . '"); background-size: cover; background-position:center;
            width: 100%; height: 100%;'
        ));
        $html .= html_writer::end_div(); // End withimage inline style div.

        $html .= html_writer::end_div();

        return $html;
    }

    /**
     * The standard tags (typically performance information and validation links,
     * if we are in developer debug mode) that should be output in the footer area
     * of the page. Designed to be called in theme layout.php files.
     *
     * @return string HTML fragment.
     */
    public function standard_footer_html() {
        global $CFG, $SCRIPT;

        $output = '<div class="plugins_standard_footer_html">';
        if (during_initial_install()) {
            return $output;
        }

        // $pluginswithfunction = get_plugins_with_function('standard_footer_html', 'lib.php');
        // foreach ($pluginswithfunction as $plugins) {
        //     foreach ($plugins as $function) {
        //         if ($function === 'tool_mobile_standard_footer_html') {
        //             $output .= $this->get_mobileappurl();

        //             continue;
        //         }

        //         $output .= $function();
        //     }
        // }

        $output .= $this->unique_performance_info_token;
        if ($this->page->devicetypeinuse == 'legacy') {
            // The legacy theme is in use print the notification.
            $output .= html_writer::tag('div', get_string('legacythemeinuse'), array('class' => 'legacythemeinuse'));
        }

        // Get links to switch device types (only shown for users not on a default device).
        $output .= $this->theme_switch_links();

        if (!empty($CFG->debugpageinfo)) {
            $output .= '<div class="performanceinfo pageinfo">This page is: ' . $this->page->debug_summary() . '</div>';
        }

        if (debugging(null, DEBUG_DEVELOPER) and has_capability('moodle/site:config', context_system::instance())) {
            // Add link to profiling report if necessary.
            if (function_exists('profiling_is_running') && profiling_is_running()) {
                $txt = get_string('profiledscript', 'admin');
                $title = get_string('profiledscriptview', 'admin');
                $url = $CFG->wwwroot . '/admin/tool/profiling/index.php?script=' . urlencode($SCRIPT);
                $link = '<a title="' . $title . '" href="' . $url . '">' . $txt . '</a>';
                $output .= '<div class="profilingfooter">' . $link . '</div>';
            }
            $purgeurl = new moodle_url('/admin/purgecaches.php', array('confirm' => 1,
                'sesskey' => sesskey(), 'returnurl' => $this->page->url->out_as_local_url(false)));
            $output .= '<div class="purgecaches">' .
            html_writer::link($purgeurl, get_string('purgecaches', 'admin')) . '</div>';
        }

        $output .= '</div>';

        return $output;
    }

    /**
     * Returns the mobile app url
     *
     * @return string
     *
     * @throws \coding_exception
     */
    private function get_mobileappurl() {
        global $CFG;
        $output = '';
        if (!empty($CFG->enablemobilewebservice) && $url = tool_mobile_create_app_download_url()) {
            $url = html_writer::link($url,
                "<i class='slicon-screen-smartphone'></i> ".get_string('getmoodleonyourmobile', 'tool_mobile'),
                ['class' => 'btn btn-primary']);

            $output .= html_writer::div($url, 'mobilefooter mb-2');
        }

        return $output;
    }

    /**
     * Wrapper for breadcrumb elements.
     *
     * @return string HTML to display the main header.
     */
    public function breadcrumb_header() 
    {
        global $PAGE;

        $header = new stdClass();
        $header->hasnavbar = empty($PAGE->layout_options['nonavbar']);
        $header->navbar = $this->navbar();

        $header->contextheader = $this->context_header();
        if ($PAGE->pagelayout == 'mypublic') {
            $header->contextheader = "<h2>". get_string('userprofile', 'theme_moove') ."</h2>";
        }
        $header->settingsmenu = $this->context_header_settings_menu();
        $header->pageheadingbutton = $this->page_heading_button();
        $header->courseheader = $this->course_header();
        return $this->render_from_template('theme_moove/breadcrumb', $header);
    }
    //my custom

    public function course_search_form_fp($value = '', $format = 'plain') {
        static $count = 0;
        $formid = 'coursesearch';
        if ((++$count) > 1) {
            $formid .= $count;
        }

        switch ($format) {
            case 'navbar' :
            $formid = 'coursesearchnavbar';
            $inputid = 'navsearchbox';
            $inputsize = 20;
            break;
            case 'short' :
            $inputid = 'shortsearchbox';
            $inputsize = 50;
            break;
            default :
            $inputid = 'coursesearchbox';
            $inputsize = 20;
        }


        $searchurl = new moodle_url('/course/search.php');

        $output = html_writer::start_tag('form', array('id' => $formid, 'action' => $searchurl, 'method' => 'get','class' => 'form-inline'));
        $output .= html_writer::start_tag('fieldset', array('class' => 'coursesearchbox invisiblefieldset automargin', 'style' => 'border-right: unset;'));

        $output .= html_writer::empty_tag('input', array('type' => 'text', 'id' => $inputid, 'placeholder' => get_string('wanttosearchyourcourse', 'theme_moove'),
            'size' => $inputsize, 'name' => 'search', 'value' => s($value),'class' => 'form-control' ,'style' => 'border: 0px;padding: .4rem .75rem;'));
        $output .= html_writer::start_tag('button', array('type' => 'submit',
          'class' => 'btn', 'style' => 'background-color: #fff; border-left: unset !important;border: 0px;padding: .4rem .75rem;'));
        $output .= '<i class="fa fa-search" aria-hidden="true"></i>';
        $output .= html_writer::end_tag('button');
        $output .= html_writer::end_tag('fieldset');


        $output .= html_writer::end_tag('form');

        return $output;
    }
    public function menu_mobile_bottom() 
    {
        global $CFG;
        $output = '';
        $output .= '<div class="toolbar">';
        $output .= '<ul>';
        $output .= '<li><a href="'.$CFG->wwwroot.'/my"><i class="fa fa-home" aria-hidden="true"></i></a></li>';
        $output .= '<li><a href="'.$CFG->wwwroot.'/calendar/view.php?view=month"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>';
        $output .= '<li><a href="'.$CFG->wwwroot.'/course/index.php"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a></li>';
        $output .= '<li><a href="'.$CFG->wwwroot.'/user/files.php"><i class="fa fa-user" aria-hidden="true"></i></a></li>';
        $output .= '</ul>';
        $output  .= '</div>';
        return $output;
    }
    public function get_js_moove()
    {
        global $PAGE;
        $output = '';
        $output .= $PAGE->requires->js('/theme/moove/js/jquery-3.2.1.min.js', true);
        $output .= $PAGE->requires->js('/theme/moove/js/owl.carousel.js', true);
        $output .= $PAGE->requires->js('/theme/moove/js/style.js', true);
       
        return $output;
    }
    public function get_css_moove()
    {
        global $PAGE;
        $output = '';
        // $output .= $PAGE->requires->css('/theme/moove/css/gird.css');
        $output .= $PAGE->requires->css('/theme/moove/css/carousel.css');
        // $output .= $PAGE->requires->css('/theme/moove/css/lightbox.css');
        // $output .= $PAGE->requires->css('/theme/moove/css/themes/light.css');

        return $output;
    }
    public function get_autologin() {
        global $DB;
        
        $output = '';
        return $output .= \core\session\manager::get_login_token();
    }
    function recursive_module_folder($folderid,&$count = 0) {
        global $DB, $OUTPUT;
        $countmodule = $DB->get_record_sql("SELECT count(cm.id) as count FROM {library_folder} lf 
                                                JOIN {library_module} lm on lf.id = lm.folderid
                                                JOIN {course_modules} cm on lm.coursemoduleid = cm.id
                                            WHERE lf.id = $folderid");
        $folderidchild = $DB->get_records("library_folder",['parent' => $folderid],'','id');
        $count = $countmodule->count + $count;
        if(!empty(($folderidchild))) {
            foreach ($folderidchild as $value) {
                $OUTPUT->recursive_module_folder($value->id,$count);
            }
        }
        return $count;
    }
    public function folder_tree($menus, $id_parent = 0, &$output = '', $stt = 0) {
        global $DB, $CFG, $OUTPUT;
        $menu_tmp = array();
        foreach ($menus as $key => $item) {
            if ((int) $item->parent == (int) $id_parent) {
                $menu_tmp[] = $item;
                unset($menus[$key]);
            }
        }
        if ($menu_tmp) {   
            if($stt == 0)
                $output .= '<ul class="tree-folder" role="menu">';
            else {
                if($id_parent == 0)
                    $output .= '<ul class=" 0">';
            }
            foreach ($menu_tmp as $item) {
                if($item->visible == 1 || ($item->visible == 0 && is_siteadmin())) {
                    if($item->visible == 0) {
                        $visible = 'hide';
                        $iconhide = $OUTPUT->pix_icon('t/show', get_string('show'));
                    }
                    else {
                        $visible = 'show';
                        $iconhide = '';
                    }
                    $output .= '<li onclick="getParentValue('.$item->id.',\''.$item->name.'\')" class="click-expand pl-3 folder '.$item->id.' '.$visible.'" id="'.$item->id.'" allmodule="'.$OUTPUT->recursive_module_folder($item->id).'">';
                    $output .= '<i class="fa fa-folder" aria-hidden="true"></i><a tabindex="-1" href="javascript:void(0)" id="'.$item->id.'"">' . $item->name . ' '.$iconhide.'</a>';
                    $getcategory = $DB->get_records_sql('SELECT * FROM {library_folder} WHERE parent = :id',[ 'id' => $item->id] );
                    if(empty($getcategory)){
                        $output .= '</li>';
                    } else { $output .= '<i class="fa fa-angle-right rotate-icon float-right mr-2"></i></li>';}
                    $output .= '<ul class="content-expand '.$item->id.' pl-3 '.$visible.'" >';
                    foreach($menus as $childkey => $childitem) {
                        // Kiểm tra phần tử có con hay không?
                        if($childitem->parent == $item->id) {
                            $output .= '<li onclick="getParentValue('.$childitem->id.',\''.$childitem->name.'\')" class="click-expand pl-3 folder '.$childitem->id.'" id="'.$childitem->id.'" allmodule="'.$OUTPUT->recursive_module_folder($item->id).'">';
                            $output .= '<i class="fa fa-folder" aria-hidden="true"></i><a tabindex="-1" href="javascript:void(0)" id="'.$childitem->id.'">' . $childitem->name . ' '.$iconhide.' </a>';
                            $getcategory_child = $DB->get_records_sql('SELECT * FROM {library_folder} WHERE parent = :id',[ 'id' => $childitem->id] );
                            if(empty($getcategory_child)){
                                $output .= '</li>';
                            } else { $output .= '<i data="'.$item->id.'" class="fa fa-angle-right rotate-icon float-right mr-2"></i></li>';}
                            $output .= '<ul class="content-expand '.$childitem->id.' pl-3">';

                            unset($menus[$childkey]);
                            $this->folder_tree($menus, $childitem->id, $output,++$stt);
                            $output .= '</ul>';
                        } 
                    }
                    $output .= '</ul>';
                }
            }
            if($stt == 0)
                $output .= '</ul>';
            else {
                if($id_parent == 0)
                    $output .= '</ul>';
            }
        }
        return $output;
    }
    function count_module_by_folder($modulebyfolder,$folderid) {
        global $DB,$OUTPUT;
        $arr = [];
        $output = '';
        foreach ($modulebyfolder as $value) {
            if($value->visible == 1) {
                $countmodule = new stdClass();
                $countmodule->moduletype = $value->moduletype;
                if($value->minetype != '') {
                    $countmodule->minetype = mime2ext($value->minetype);
                }
                $arr[] = $countmodule;
            }
        }
        $moduletypes = array_count_values(array_column($arr, 'moduletype'));
        $resources   = array_count_values(array_column($arr, 'minetype'));
        $output .= '<div class="d-flex" id="header-library">';
        $sum = 0;
        foreach ($moduletypes as $value) {
            $sum = $sum + $value;
        }
        $goback = '';
        $output .= '<div class="module-count pl-3" onclick="filterModule(\''.$goback.'\','.$folderid.')"><i class="fa fa-file pr-2" style="font-size:20px"></i>('.$sum.')</div>';
        if(!empty($moduletypes)) {
            $output .= '<div class="module-count"><i class="fa fa-minus mt-2" aria-hidden="true"></i></div>';
        }
        foreach ($moduletypes as $keymodule => $moduletype) {
            if($keymodule != 'resource') {
                $moduleimg = html_writer::img($OUTPUT->image_url('icon', $keymodule), $keymodule, ['class' => 'pr-2']);
                $output .= '<div class="module-count" onclick="filterModule(\''.$keymodule.'\','.$folderid.')">' . $moduleimg . '(' . $moduletype . ')</div>';
            } else {
                foreach ($resources as $keyresource => $resource) {
                    $count = $resource;
                    if($keyresource == 'pdf') {
                        $moduleimg = html_writer::img($OUTPUT->image_url('f/pdf-24'), 'Pdf', ['class' => 'pr-2']);
                        $keyfilter = 'pdf';
                    }
                    if($keyresource == 'xlsx' || $keyresource == 'xls') {
                        if(isset($resources['xlsx']) && isset($resources['xls'])) {
                            $count = $resources['xlsx'] + $resources['xls'];
                        }
                        $moduleimg = html_writer::img($OUTPUT->image_url('f/spreadsheet-24'), 'exel', ['class' => 'pr-2']);
                        $keyfilter = 'excel';
                    }
                    if($keyresource == 'ppt') {
                        $moduleimg = html_writer::img($OUTPUT->image_url('f/powerpoint-24'), 'Ppt', ['class' => 'pr-2']);
                        $keyfilter = 'powerpoint';
                    }
                    if($keyresource == 'docx' || $keyresource == 'doc') {
                        if(isset($resources['doc']) && isset($resources['docx'])) {
                            $count = $resources['doc'] + $resources['docx'];
                        }
                        $moduleimg = html_writer::img($OUTPUT->image_url('f/document-24'), 'Word', ['class' => 'pr-2']);
                        $keyfilter = 'word';
                    }
                    if (($keyresource == 'doc' && isset($resources['docx'])) || ($keyresource == 'xls' && isset($resources['xlsx']))) {
                        continue;
                    }
                    $output .= '<div class="module-count" onclick="filterModule(\''.$keyfilter.'\','.$folderid.')">' . $moduleimg . '(' . $count . ')</div>';
                }
            }
        }
        $output .= '</div>';
        return $output;
    }
    public function library_folder() {
        global $DB;
        $library = $DB->get_records_sql("SELECT * FROM {library_folder}");        
        $output = $this->folder_tree($library);
        return $output;
    }

    public function exam_subject_tree() {
        global $DB;
        $list_exam = $DB->get_records('exam',[]);
        $output = '';
        $output .= '<ul id="exam-tree">';
        $output .= '<li class="list-category title exam" id="0"><a>'.get_string('listexamonline','local_newsvnr').'</a></li>';
        $output .= '<ul>';
        foreach ($list_exam as $exam) {
            $output .= '<li class="list-category click-expand exam" id="'.$exam->id.'"><a>'.$exam->name.'</a><i data="33" class="fa fa-angle-right rotate-icon float-right"></i></li>';
            $output .= '<ul class="dropdown-menu-tree content-expand '.$exam->id.'">';
            $list_subject = $DB->get_records_sql("SELECT DISTINCT es.id,es.name FROM mdl_exam_subject es 
                                                    JOIN mdl_exam_subject_exam ese ON ese.subjectid = es.id
                                                    JOIN mdl_exam e ON ese.examid = e.id
                                                WHERE e.id = :examid",['examid' => $exam->id]);
            foreach ($list_subject as $subject) {
                $output .= '<li class="list-subcategory subject-exam" id="'.$subject->id.'"><a>'.$subject->name.'</a></li>';
            }
            $output .= '</ul>';
        }
        $output .= '</ul>';
        $output .= '</ul>';
        return $output;
    }

}
