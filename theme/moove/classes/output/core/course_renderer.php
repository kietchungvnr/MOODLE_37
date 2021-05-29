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
 * Course renderer.
 *
 * @package    theme_moove
 * @copyright  2017 Willian Mano - conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace theme_moove\output\core;

defined('MOODLE_INTERNAL') || die();

use moodle_url;
use html_writer;
use core_course_category;
use coursecat_helper;
use stdClass;
use core_course_list_element;
use single_select;
use lang_string;
use theme_moove\util\extras;
use theme_moove\util\theme_settings;

/**
 * Renderers to align Moove's course elements to what is expect
 *
 * @package    theme_moove
 * @copyright  2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class course_renderer extends \core_course_renderer {

    /**
     * Renders the list of courses
     *
     * This is internal function, please use {@link core_course_renderer::courses_list()} or another public
     * method from outside of the class
     *
     * If list of courses is specified in $courses; the argument $chelper is only used
     * to retrieve display options and attributes, only methods get_show_courses(),
     * get_courses_display_option() and get_and_erase_attributes() are called.
     *
     * @param coursecat_helper $chelper various display options
     * @param array $courses the list of courses to display
     * @param int|null $totalcount total number of courses (affects display mode if it is AUTO or pagination if applicable),
     *     defaulted to count($courses)
     * @return string
     */
    protected function coursecat_courses(coursecat_helper $chelper, $courses, $totalcount = null) {
        global $CFG;

        $theme = \theme_config::load('moove');

        if (!empty($theme->settings->courselistview)) {
            return parent::coursecat_courses($chelper, $courses, $totalcount);
        }

        if ($totalcount === null) {
            $totalcount = count($courses);
        }

        if (!$totalcount) {
            // Courses count is cached during courses retrieval.
            return '';
        }

        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_AUTO) {
            // In 'auto' course display mode we analyse if number of courses is more or less than $CFG->courseswithsummarieslimit.
            if ($totalcount <= $CFG->courseswithsummarieslimit) {
                $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_EXPANDED);
            } else {
                $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_COLLAPSED);
            }
        }

        // Prepare content of paging bar if it is needed.
        $paginationurl = $chelper->get_courses_display_option('paginationurl');
        $paginationallowall = $chelper->get_courses_display_option('paginationallowall');
        if ($totalcount > count($courses)) {
            // There are more results that can fit on one page.
            if ($paginationurl) {
                // The option paginationurl was specified, display pagingbar.
                $perpage = $chelper->get_courses_display_option('limit', $CFG->coursesperpage);
                $page = $chelper->get_courses_display_option('offset') / $perpage;
                $pagingbar = $this->paging_bar($totalcount, $page, $perpage,
                        $paginationurl->out(false, array('perpage' => $perpage)));
                if ($paginationallowall) {
                    $pagingbar .= html_writer::tag('div', html_writer::link($paginationurl->out(false, array('perpage' => 'all')),
                            get_string('showall', '', $totalcount)), array('class' => 'paging paging-showall'));
                }
            } else if ($viewmoreurl = $chelper->get_courses_display_option('viewmoreurl')) {
                // The option for 'View more' link was specified, display more link.
                $viewmoretext = $chelper->get_courses_display_option('viewmoretext', new \lang_string('viewmore'));
                $morelink = html_writer::tag('div', html_writer::link($viewmoreurl, $viewmoretext),
                        array('class' => 'paging paging-morelink'));
            }
        } else if (($totalcount > $CFG->coursesperpage) && $paginationurl && $paginationallowall) {
            // There are more than one page of results and we are in 'view all' mode, suggest to go back to paginated view mode.
            $pagingbar = html_writer::tag(
                'div',
                html_writer::link(
                    $paginationurl->out(
                        false,
                        array('perpage' => $CFG->coursesperpage)
                    ),
                    get_string('showperpage', '', $CFG->coursesperpage)
                ),
                array('class' => 'paging paging-showperpage')
            );
        }

        // Display list of courses.
        $attributes = $chelper->get_and_erase_attributes('courses');
        $content = html_writer::start_tag('div', $attributes);

        if (!empty($pagingbar)) {
            $content .= $pagingbar;
        }

        $coursecount = 1;
        $content .= html_writer::start_tag('div', array('class' => 'row mt-3'));
   
        // $content .= html_writer::start_tag('div', array('class' => 'card-deck mt-3'));
        foreach ($courses as $course) {
            $content .= $this->coursecat_coursebox($chelper, $course);
            // if ($coursecount % 5 == 0) {
              
                //$content .= html_writer::start_tag('div', array('class' => 'row mt-3'));
                // $content .= html_writer::start_tag('div', array('class' => 'card-deck mt-3'));
            //}

            //$coursecount ++;
        }
            $content .= html_writer::end_tag('div');


        // $content .= html_writer::end_tag('div');
        $content .= html_writer::end_tag('div');
       

        if (!empty($pagingbar)) {
            $content .= $pagingbar;
        }

        if (!empty($morelink)) {
            $content .= $morelink;
        }

        $content .= html_writer::end_tag('div'); // End courses.
        return $content;
    }

    /**
     * Displays one course in the list of courses.
     *
     * This is an internal function, to display an information about just one course
     * please use {@link core_course_renderer::course_info_box()}
     *
     * @param coursecat_helper $chelper various display options
     * @param core_course_list_element|stdClass $course
     * @param string $additionalclasses additional classes to add to the main <div> tag (usually
     *    depend on the course position in list - first/last/even/odd)
     * @return string
     *
     * @throws \coding_exception
     */
    protected function coursecat_coursebox(coursecat_helper $chelper, $course, $additionalclasses = '') {
        $theme = \theme_config::load('moove');

        if (!empty($theme->settings->courselistview)) {
            return parent::coursecat_coursebox($chelper, $course, $additionalclasses);
        }

        if (!isset($this->strings->summary)) {
            $this->strings->summary = get_string('summary');
        }
        if ($chelper->get_show_courses() <= self::COURSECAT_SHOW_COURSES_COUNT) {
            return '';
        }
        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }

        $classes = trim('card');
        if ($chelper->get_show_courses() >= self::COURSECAT_SHOW_COURSES_EXPANDED) {
            $nametag = 'h3';
        } else {
            $classes .= ' collapsed';
            $nametag = 'div';
        }

        // End coursebox.
        //Custom : Thang
        $content = html_writer::start_tag('div', array(
            'class' => 'col-xl-3 col-md-4 col-12'
           
        ));
        $content .= html_writer::start_tag('div', array(
            'class' => $classes,
            'data-courseid' => $course->id,
            'data-type' => self::COURSECAT_TYPE_COURSE,
        ));

        $content .= $this->coursecat_coursebox_content($chelper, $course);

        $content .= html_writer::end_tag('div');
        $content .= html_writer::end_tag('div'); // End coursebox.
   
        return $content;
    }

    /**
     * Returns HTML to display a course category as a part of a tree
     *
     * This is an internal function, to display a particular category and all its contents
     * use {@link core_course_renderer::course_category()}
     *
     * @param coursecat_helper $chelper various display options
     * @param core_course_category $coursecat
     * @param int $depth depth of this category in the current tree
     * @return string
     */
    protected function coursecat_category(coursecat_helper $chelper, $coursecat, $depth) {
        // open category tag
        $classes = array('category');
        if (empty($coursecat->visible)) {
            $classes[] = 'dimmed_category';
        }
        if ($chelper->get_subcat_depth() > 0 && $depth >= $chelper->get_subcat_depth()) {
            // do not load content
            $categorycontent = '';
            $classes[] = 'notloaded';
            if ($coursecat->get_children_count() ||
                    ($chelper->get_show_courses() >= self::COURSECAT_SHOW_COURSES_COLLAPSED && $coursecat->get_courses_count())) {
                $classes[] = 'with_children';
                $classes[] = 'collapsed';
            }
        } else {
            // load category content
            $categorycontent = $this->coursecat_category_content($chelper, $coursecat, $depth);
            $classes[] = 'loaded';
            if (!empty($categorycontent)) {
                $classes[] = 'with_children';
                // Category content loaded with children.
                $this->categoryexpandedonload = true;
            }
        }

        // Make sure JS file to expand category content is included.
        $this->coursecat_include_js();

        $content = html_writer::start_tag('div', array(
            'class' => join(' ', $classes),
            'data-categoryid' => $coursecat->id,
            'data-depth' => $depth,
            'data-showcourses' => $chelper->get_show_courses(),
            'data-type' => self::COURSECAT_TYPE_CATEGORY,
        ));

        // category name
        $categoryname = $coursecat->get_formatted_name();
        $categoryname = html_writer::link(new moodle_url('/course/index.php',
                array('categoryid' => $coursecat->id)),
                $categoryname);
        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_COUNT
                && ($coursescount = $coursecat->get_courses_count())) {
            $categoryname .= html_writer::tag('span', ' ('. $coursescount.')',
                    array('title' => get_string('numberofcourses'), 'class' => 'numberofcourse'));
        }
        $content .= html_writer::start_tag('div', array('class' => 'info'));
        $content .= html_writer::tag(($depth > 1) ? 'h5' : 'h5', $categoryname, array('class' => 'categoryname'));
        $content .= html_writer::end_tag('div'); // .info

        // add category content to the output
        $content .= html_writer::tag('div', $categorycontent, array('class' => 'content'));

        $content .= html_writer::end_tag('div'); // .category

        // Return the course category tree HTML
        return $content;
    }

    /**
     * Renders HTML to display particular course category - list of it's subcategories and courses
     *
     * Invoked from /course/index.php
     *
     * @param int|stdClass|core_course_category $category
     */
    public function course_category($category) {
        global $CFG,$DB;
        $usertop = core_course_category::user_top();
        if (empty($category)) {
            $coursecat = $usertop;
        } else if (is_object($category) && $category instanceof core_course_category) {
            $coursecat = $category;
        } else {
            $coursecat = core_course_category::get(is_object($category) ? $category->id : $category);
        }
        $site = get_site();
        $output = '';

        // if ($coursecat->can_create_course() || $coursecat->has_manage_capability()) {
        //     // Add 'Manage' button if user has permissions to edit this category.
        //     $managebutton = $this->single_button(new moodle_url('/course/management.php',
        //         array('categoryid' => $coursecat->id)), get_string('managecourses'), 'get');
        //     $this->page->set_button($managebutton);
        // }

        // if (core_course_category::is_simple_site()) {
        //     // There is only one category in the system, do not display link to it.
        //     $strfulllistofcourses = get_string('fulllistofcourses');
        //     $this->page->set_title("$site->shortname: $strfulllistofcourses");
        // } else if (!$coursecat->id || !$coursecat->is_uservisible()) {
        //     $strcategories = get_string('categories');
        //     $this->page->set_title("$site->shortname: $strcategories");
        // } else {
        //     $strfulllistofcourses = get_string('fulllistofcourses');
        //     $this->page->set_title("$site->shortname: $strfulllistofcourses");

        //     // Print the category selector
        //     $categorieslist = core_course_category::make_categories_list();
        //     if (count($categorieslist) > 1) {
        //         //Custom :Thang//
        //         $output .= '<div class="row">';
        //         $output .= html_writer::start_tag('div', array('class' => 'categorypicker col-xl-6 col-md-12'));
        //         $select = new single_select(new moodle_url('/course/index.php'), 'categoryid',
        //                 core_course_category::make_categories_list(), $coursecat->id, null, 'switchcategory');
        //         $select->set_label(get_string('categories').':');
        //         $output .= $this->render($select);
        //         $output .= html_writer::end_tag('div'); // .categorypicker
        //         $output .= '<div class="col-xl-6 col-md-12">';
        //         $output .= $this->course_search_form();
        //         $output .= '</div>';
        //         $output .='</div>';
        //     }
        // }

        // Print current category description
        $chelper = new coursecat_helper();
        if ($description = $chelper->get_category_formatted_description($coursecat)) {
            $output .= $this->box($description, array('class' => 'generalbox info'));
        }

        // Prepare parameters for courses and categories lists in the tree
        $chelper->set_show_courses(self::COURSECAT_SHOW_COURSES_AUTO)
                ->set_attributes(array('class' => 'category-browse category-browse-'.$coursecat->id));

        $coursedisplayoptions = array();
        $catdisplayoptions = array();
        $browse = optional_param('browse', null, PARAM_ALPHA);
        $perpage = optional_param('perpage', $CFG->coursesperpage, PARAM_INT);
        $page = optional_param('page', 0, PARAM_INT);
        $baseurl = new moodle_url('/course/index.php');
        if ($coursecat->id) {
            $baseurl->param('categoryid', $coursecat->id);
        }
        if ($perpage != $CFG->coursesperpage) {
            $baseurl->param('perpage', $perpage);
        }
        $coursedisplayoptions['limit'] = $perpage;
        $catdisplayoptions['limit'] = $perpage;
        if ($browse === 'courses' || !$coursecat->get_children_count()) {
            $coursedisplayoptions['offset'] = $page * $perpage;
            $coursedisplayoptions['paginationurl'] = new moodle_url($baseurl, array('browse' => 'courses'));
            $catdisplayoptions['nodisplay'] = true;
            $catdisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'categories'));
            $catdisplayoptions['viewmoretext'] = new lang_string('viewallsubcategories');
        } else if ($browse === 'categories' || !$coursecat->get_courses_count()) {
            $coursedisplayoptions['nodisplay'] = true;
            $catdisplayoptions['offset'] = $page * $perpage;
            $catdisplayoptions['paginationurl'] = new moodle_url($baseurl, array('browse' => 'categories'));
            $coursedisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'courses'));
            $coursedisplayoptions['viewmoretext'] = new lang_string('viewallcourses');
        } else {
            // we have a category that has both subcategories and courses, display pagination separately
            $coursedisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'courses', 'page' => 1));
            $catdisplayoptions['viewmoreurl'] = new moodle_url($baseurl, array('browse' => 'categories', 'page' => 1));
        }
        $chelper->set_courses_display_options($coursedisplayoptions)->set_categories_display_options($catdisplayoptions);

         // Add action buttons
        //Custom by Vũ: Thêm xem danh sách yêu cầu mở  khoá học
        $courserqurl = new moodle_url('/course/listcourserq.php', array());
        // $output .= $this->container_start('buttons');
        $output .= '<div class="row"><div class="col-xl-3 col-lg-4 col-md-4 menu-tree-course"><div>';
        if ($coursecat->is_uservisible()) {
            $context = get_category_or_system_context($coursecat->id);
            if (has_capability('moodle/course:create', $context)) {
                // Print link to create a new course, for the 1st available category.
                if ($coursecat->id) {
                    $url = new moodle_url('/course/edit.php', array('category' => $coursecat->id, 'returnto' => 'category'));
                } else {
                    $url = new moodle_url('/course/edit.php',
                        array('category' => $CFG->defaultrequestcategory, 'returnto' => 'topcat'));
                }
                $output .= $this->single_button($url, get_string('addnewcourse'), 'get');

            }
            if(!is_siteadmin()) {
                     $output .= $this->single_button($courserqurl, get_string('listcourserqtitle', 'local_newsvnr'), 'get');
            }
            ob_start();
            print_course_request_buttons($context);
            $output .= ob_get_contents();
            ob_end_clean();
        }
        // $output .= $this->container_end();

        // // Add course search form.
        // $output .= $this->course_search_form();
        // // Display course category tree.
        // $output .= $this->coursecat_tree($chelper, $coursecat);
       
        $categories = $DB->get_records_sql('SELECT DISTINCT cc.name,cc.id, cc.parent FROM mdl_course_categories cc LEFT JOIN mdl_course c ON cc.id = c.category OR cc.parent = c.category WHERE cc.visible = 1');
        $output .= $this->menucoursecategory($categories);
        $output .= '</div></div>';
        $output .= '<div class="col-xl-9 col-lg-8 col-md-8 position-relative">';
        $output .= '<div class="loading-page"></div>';
        $output .= $this->course_teacher_search_form();
        $output .= $this->course_filter();
        $output .= ($category) ? '<div id="load-course" category="'.$category.'">' : '<div id="load-course">' ;
        $output .= '</div></div></div>';
        return $output;
    }
    public function course_teacher_search_form() {
        $output = '';
        $output .= '<div id="courses_search_form" class="">';
        $output .= '<div class="row">';
        $output .= '<div class="col-xl-3 col-6 pl-1 tree-search">';
        $output .= '<input name="category" type="text" class="courses_search_input" id="category"  placeholder="'.get_string('coursecatogories','local_newsvnr').'" value="">';
        $output .= '</div>';
        $output .= '<div class="col-xl-3 col-6 pl-1 tree-search">';
        $output .= '<input name="keyword" type="text" class="courses_search_input" id="keyword" placeholder="'.get_string('coursename','local_newsvnr').'" value="">';
        $output .= '</div>';
        $output .= '<div class="col-xl-3 col-6 pl-1 tree-search">';
        $output .= '<input name="teacher" type="text" class="courses_search_input" id="teacher" placeholder="'.get_string('teachernames','local_newsvnr').'" value="">';
        $output .= '</div>';
        $output .= '<div class="col-xl-3 col-6 pl-1">';
        $output .= '<button id="courses_search_button" class="search-button ml-auto w-100"><i class="fa fa-search mr-1"></i>'.get_string('search','local_newsvnr').'</button>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        return $output;
    }
    public function course_filter() {
        global $DB,$USER;
        $role = $DB->get_records_sql('SELECT ra.roleid FROM {role_assignments} ra JOIN {user} u ON u.id = ra.userid WHERE u.id =:userid GROUP BY ra.roleid',['userid' => $USER->id]);
        $output  = '';
        $output .= '<select class="form-control" id="course-filter">';
        $output .= '<option value="allcourse">'.get_string('filtercourseall','local_newsvnr').'</option>';
        $output .= '<option value="coursepopular">'.get_string('filtercoursepopular','local_newsvnr').'</option>';
        foreach ($role as $value) {
            if($value->roleid == 5 || is_siteadmin()) {
                $output .= '<option value="mycourse" >'.get_string('mycourses','theme_moove').'</option>';
            }
            if($value->roleid == 3 || is_siteadmin()) {
                $output .= '<option value="teachercourse" >'.get_string('owncourses','theme_moove').'</option>';
            }
        }
        $output .= '</select>';
        return $output;
    }
    public function menucoursecategory($menus, $id_parent = 0, &$output = '', $stt = 0) {
        global $DB, $CFG;
        $menu_tmp = array();
        foreach ($menus as $key => $item) {
            if ((int) $item->parent == (int) $id_parent) {
                $menu_tmp[] = $item;
                unset($menus[$key]);
            }
        }
        if ($menu_tmp) {   
            if($stt == 0)
                $output .= '<li class="list-category title"><a class="ajax-load" href="javascript:void(0)">'.get_string('coursecatogories','local_newsvnr').'</a></li>
                            <ul class="" role="menu" id="drop-course-category">';
            else {
                if($id_parent == 0)
                    $output .= '<ul class=" 0">';
            }
            foreach ($menu_tmp as $item) {
                $output .= '<li class="list-category" data="'.$item->id.'">';
                $output .= '<a  class="ajax-load" tabindex="-1" href="javascript:void(0)" id="'.$item->id.'"">' . $item->name . '</a>';
                $getcategory = $DB->get_records_sql('SELECT * FROM {course_categories} WHERE parent = :id',[ 'id' => $item->id] );
                if(empty($getcategory)){
                    $output .= '</li>';
                    continue;
                }
                $output .= '<i class="fa fa-angle-right rotate-icon float-right"></i>';
                $output .= '</li>';
                $output .= '<ul class="dropdown-menu-tree '.$item->id.'" >';
                foreach($menus as $childkey => $childitem) {
                    // Kiểm tra phần tử có con hay không?
                    if($childitem->parent == $item->id) {
                        $output .= '<li class="list-subcategory" id="'.$childitem->id.'"">';
                        $output .= '<a  class="ajax-load" tabindex="-1" href="javascript:void(0)" id="'.$childitem->id.'">' . $childitem->name . ' </a>';
                        $getcategory_child = $DB->get_records_sql('SELECT * FROM {course_categories} WHERE parent = :id',[ 'id' => $childitem->id] );
                        if(empty($getcategory_child)){
                            $output .= '</li>';
                            continue;
                        }
                        $output .= '<i data="'.$item->id.'" class="fa fa-angle-right rotate-icon float-right"></i>';
                        $output .= '</li>';
                        $output .= '<ul class="dropdown-menu-tree '.$childitem->id.'">';

                        unset($menus[$childkey]);
                        $this->menucoursecategory($menus, $childitem->id, $output,++$stt);

                        $output .= '</ul>';
                    } 
                }
                $output .= '</ul>';
    
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

    /**
     * Returns HTML to display course content (summary, course contacts and optionally category name)
     *
     * This method is called from coursecat_coursebox() and may be re-used in AJAX
     *
     * @param coursecat_helper $chelper various display options
     * @param stdClass|core_course_list_element $course
     *
     * @return string
     *
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    protected function coursecat_coursebox_content(coursecat_helper $chelper, $course) {
        global $CFG, $DB,$USER;
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        if ($course instanceof stdClass) {
            $course = new core_course_list_element($course);
        }

        // Course name.
        $coursename = $chelper->get_course_formatted_name($course);
        $courselink = new moodle_url('/course/view.php', array('id' => $course->id));
        $coursenamelink = html_writer::link($courselink, $coursename, array('class' => $course->visible ? '' : 'dimmed', 'title' => $coursename));

        $courseinfo = theme_settings::role_courses_teacher($course->id);

        $courseimage = extras::get_course_summary_image($course, $courselink);
        //Course progress
        $enrolnamemethod = get_enrol_method($course->id);
        $progress = \core_completion\progress::get_course_progress_percentage($course,$USER->id);
        $content = '';
        $description = '';
        $teacherimage = '';
        if(isset($progress)) {
            $progress = round($progress);
            if($progress == 0)
                $progress =0;
            $enrolmethod = "   <div class='pv-progress'><p>$progress% </p>
                                    <div class='progress'>

                                            <div class='progress-bar' role='progressbar' aria-valuenow='$progress'
                                          aria-valuemin='0' aria-valuemax='100' style='width:$progress%'>
                                       
                                            </div>
                                </div></div>";
        } else {
            $hiddencourse = $course->visible ? '' : 'dimmed';
            $enrolmethod = "<p class='post-enrolmethod $hiddencourse'>$enrolnamemethod</p>";
        }

        // Course instructors.
        if ($course->has_course_contacts()) {
        //     $content .= html_writer::start_tag('div', array('class' => 'course-contacts'));

            $instructors = $course->get_course_contacts();
            foreach ($instructors as $key => $instructor) {
                $name = $instructor['username'];
                $url = $CFG->wwwroot.'/user/profile.php?id='.$key;
                $picture = extras::get_user_picture($DB->get_record('user', array('id' => $key)));
                $teacherimage = '';
                $teacherimage .= "<a href='{$url}' class='contact' data-toggle='tooltip' title='{$name}'>";
                $teacherimage .= "<img src='{$picture}' class='rounded-circle' alt='{$name}'/>";
                $teacherimage .= "</a>";
            }

        //     $content .= html_writer::end_tag('div'); // Ends course-contacts.
        }
        if(!$teacherimage) {
            $imgurl = $CFG->wwwroot."/theme/moove/pix/f2.png";
            $teacherimage = \html_writer::empty_tag('img',array('src' => $imgurl,'class'=>'userpicture defaultuserpic','width' => '50px','height'=>'50px','alt' => 'Default picture','title'=>'Default picture'));
        }
        if ($course->has_summary()) {

            $summary = $DB->get_record('course', ['id' => $course->id], 'summary');
            $description = strip_tags($summary->summary);
        }
        $strstudent = get_string('numberstudent', 'theme_moove');
        $strteacher = get_string('teachername', 'theme_moove');
        $content .= "
                    <div class='post-slide6 m-0'>
                        <div class='post-img'>
                            $courseimage
                            <div class='post-info'>
                                <ul class='category'>
                                    <li>$strstudent <a href='#'>$courseinfo->studentnumber</a></li>
                                    <li>$strteacher <a href='#'>$courseinfo->fullnamet</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class='post-review'>
                            <span class='icons'>$teacherimage</span><h3 class='post-title'>$coursenamelink</h3>
                                <p class='post-teachername'>$courseinfo->fullnamet</p>
                                <p class='post-description'>$description</p>
                                $enrolmethod
                        </div>
                    </div>";
        // $content .= html_writer::start_tag('div', array('class' => 'card-body'));
        // $content .= "<h6 class='card-title'>". $coursenamelink."</h6>";

        // // Display course summary.
        
        // $content .= html_writer::end_tag('div');
          // <p class='post-enrolmethod'>
          //                           {{#enrolmethod}}{{{enrolmethod}}}{{/enrolmethod}}
          //                       </p>


        // $content .= html_writer::start_tag('div', array('class' => 'card-footer'));
        // Print enrolmenticons.
        // if ($icons = enrol_get_course_info_icons($course)) {
        //     foreach ($icons as $pixicon) {


        //         $content .= $this->render($pixicon);
        //     }
        // }


        // $content .= html_writer::start_tag('div', array('class' => 'pull-right'));
        // $content .= html_writer::link(new moodle_url('/course/view.php', array('id' => $course->id)),
        //     get_string('access', 'theme_moove'), array('class' => 'card-link btn btn-primary ', 'style' => 'border-radius:10px;'));
        // $content .= html_writer::end_tag('div'); // End pull-right.

        // $content .= html_writer::end_tag('div'); // End card-block.

        // Display course category if necessary (for example in search results).
        if ($chelper->get_show_courses() == self::COURSECAT_SHOW_COURSES_EXPANDED_WITH_CAT) {
            require_once($CFG->libdir. '/coursecatlib.php');
            if ($cat = core_course_category::get($course->category, IGNORE_MISSING)) {
                $content .= html_writer::start_tag('div', array('class' => 'coursecat'));
                $content .= get_string('category').': '.
                    html_writer::link(new moodle_url('/course/index.php', array('categoryid' => $cat->id)),
                        $cat->get_formatted_name(), array('class' => $cat->visible ? '' : 'dimmed'));
                $content .= html_writer::end_tag('div'); // End coursecat.
            }
        }
     
        return $content;
        
    }

     function course_search_form($value = '', $format = 'plain') {
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

        $strsearchcourses= get_string("searchcourses");
        $searchurl = new moodle_url('/course/search.php');

        $output = html_writer::start_tag('form', array('id' => $formid, 'action' => $searchurl, 'method' => 'get','class' => 'form-inline'));
        $output .= html_writer::start_tag('fieldset', array('class' => 'coursesearchbox invisiblefieldset automargin'));
        $output .= html_writer::tag('label', $strsearchcourses.': ', array('for' => $inputid));
        $output .= html_writer::empty_tag('input', array('type' => 'text', 'id' => $inputid,
            'size' => $inputsize, 'name' => 'search', 'value' => s($value),'class' => 'form-control'));
        $output .= html_writer::start_tag('button', array('type' => 'submit',
          'class' => 'btn btn-secondary'));
        $output .= get_string('search');
        $output .= html_writer::end_tag('button');
        $output .= html_writer::end_tag('fieldset');
       
       
        $output .= html_writer::end_tag('form');

        return $output;
    }
    //Đếm số lượng module 
    function count_module($course,$currentsection) {
        global $DB,$OUTPUT;
        $modinfo = get_fast_modinfo($course);
        $output = array(
            //lấy thông tin module
            "activityinfo" => array(),
            //Đếm số lượng module
            "total" => array(),
        );
        $sectionmods = [];
        $total = 0;
        foreach ($modinfo->sections[$currentsection->section] as $cmid) {
            $thismod = $modinfo->cms[$cmid];
            $getmodules = $DB->get_records_sql('SELECT cm.id, cm.deletioninprogress FROM {course_modules} cm JOIN {course_sections} cs ON cm.section = cs.id WHERE cm.instance = :section AND cm.course = :courseid',['section' => $thismod->instance,'courseid' => $course->id]);
            //Check điều kiện là là label hoặc module đã xóa
            if ($thismod->modname == 'label' || $thismod->visible == 0) {
                continue;
            }
            foreach($getmodules as $getmodule) {
                if($getmodule->deletioninprogress != 0) {
                    continue 2;
                }    
            }
            if (isset($sectionmods[$thismod->modname])) {
                $sectionmods[$thismod->modname]['name'] = $thismod->modplural;
                $sectionmods[$thismod->modname]['count']++;
            } else {
                $sectionmods[$thismod->modname]['name'] = $thismod->modfullname;
                $sectionmods[$thismod->modname]['count'] = 1;
                $sectionmods[$thismod->modname]['image'] = $OUTPUT->image_url('icon', $thismod->modname);
            }
            $total++;
        }
        foreach($sectionmods as $mod) {
            $output['activityinfo'][] = '<img class="mr-3" src="'.$mod['image'].'">'.$mod['count'].' '.$mod['name'];
        }
        $output['total'] = $total;
        return $output;
    }
    ///Thâm phần mô tả,thông tin khóa học , ở ngoài khóa học
    function course_description($course) {
        global $DB,$OUTPUT;
        $theme_settings = new theme_settings();
        $teachers = $theme_settings::role_courses_all_teacher($course->id);
        $modinfo = get_fast_modinfo($course);
        $startfrom = 1;
        $end = count($modinfo->sections);
        $output = '';
        $output .= html_writer::start_div('all-tab-content col-xl-9 col-md-8 col-12');
        $output .= html_writer::start_tag('ul',['class' => 'nav nav-tabs tab-click multi-tab','tab' => 'enrolcourse']);
        $output .= html_writer::tag('li',html_writer::tag('a',get_string('introcourse','local_newsvnr'),['class' => 'nav-link active' ,'data-key' => 'courseintro']),['class' => 'nav-item']);
        $output .= html_writer::tag('li',html_writer::tag('a',get_string('descriptioncourse','local_newsvnr'),['class' => 'nav-link' ,'data-key' => 'descriptioncourse']),['class' => 'nav-item']);
        $output .= html_writer::tag('li',html_writer::tag('a',get_string('lesson','local_newsvnr'),['class' => 'nav-link' ,'data-key' => 'lesson']),['class' => 'nav-item']);
        $output .= html_writer::tag('li',html_writer::tag('a',get_string('teachername','local_newsvnr'),['class' => 'nav-link' ,'data-key' => 'teachername']),['class' => 'nav-item']);
        $output .= html_writer::end_tag('ul');
        $output .= html_writer::start_div('tab-content',['tab' => 'enrolcourse']);
        // Giới thiệu khóa học
        $output .= html_writer::start_div('tab-pane in active',['data' => 'courseintro']);
        $output .= html_writer::start_div('count-module');
        $output .= html_writer::div('<span class="grey">'.get_string('startdate','local_newsvnr').'</span> : <b>'. convertunixtime('l, d-m-Y,',$course->startdate,'Asia/Ho_Chi_Minh').'</b>','mb-3');
        if($course->enddate > 0) {
            $output .= html_writer::div('<span class="grey">'.get_string('enddate','local_newsvnr').'</span> : <b>'. convertunixtime('l, d-m-Y,',$course->enddate,'Asia/Ho_Chi_Minh').'</b>','mb-3');
        } else {
            $output .= '-';
        }
        $studentdata = $theme_settings::role_courses_teacher_slider($course->id);
        $output .= html_writer::div('<span class="grey">'.get_string('totalstudent','local_newsvnr').'</span> : <b>'.$studentdata->studentnumber.'</b>');
        $output .= html_writer::end_div();
        $output .= html_writer::end_div();
        // Mô tả khóa học
        $output .= html_writer::start_div('tab-pane',['data' => 'descriptioncourse']);
        $output .= html_writer::div('<p>'.$course->summary.'</p>','count-module');
        $output .= html_writer::end_div();
        $output .= html_writer::start_div('tab-pane',['data' => 'lesson']);
        for ($section = $startfrom; $section <= $end; $section++) {
            $currentsection = $modinfo->get_section_info($section);
            if($currentsection == null || $currentsection->visible != 1) {
                continue;
            }
            $output .= html_writer::start_div('curriculum-chapter click-expand mt-2',['id' => $currentsection->id]);
            if($currentsection->name == '' && $currentsection->section != 0) {
                $output .= html_writer::div(get_string('topic', 'theme_moove').' '.$currentsection->section);
            } else {
                $output .= html_writer::div($currentsection->name);
            }
            if (empty($modinfo->sections[$currentsection->section])) {
                $output .= html_writer::end_div();
                continue;
            }
            $sectionmods = $this->count_module($course,$currentsection);
            if($sectionmods['total'] > 0) {
                $output .= html_writer::tag('a',$sectionmods['total'] .' '.get_string('countmodule','local_newsvnr').'  <i class="fa fa-angle-up rotate-icon"></i>');
            }
            $output .= html_writer::end_div();
            $output .= html_writer::start_div('content-expand '.$currentsection->id.' display-none');
            foreach ($sectionmods['activityinfo'] as $value) {
                $output .= html_writer::div($value,'count-module');
            }
            $output .= html_writer::end_div();
        }
        $output .= html_writer::end_div();
        $output .= html_writer::start_div('tab-pane',['data' => 'teachername']);
        //Láy thông tin giáo viên
        if(is_array($teachers)) {
            foreach ($teachers as $teacher) {
                $userid  = $DB->get_record('user', array('id' => $teacher->id));
                $output .= '<div class="count-module d-flex">';
                $output .= $OUTPUT->user_picture($userid, array('size' => 50));
                $output .= '<div class"teacher-overview">';
                $output .= '<p> '.get_string('teachernames','local_newsvnr').': '.$teacher->fullnamet.'</p>';
                $output .= '<p> '.get_string('email','local_newsvnr').': '.$teacher->email.'<p>';
                if($teacher->phone1 != '') {
                    $output .= '<div> Phone:'.$teacher->phone1.'';
                }
                if($teacher->phone1 != '') {
                    $output .= 'Phone:'.$teacher->phone2.'</div>';
                }
                $output .= '</div></div>';
            }
        } else {
            $output .= '<div class="alert alert-warning" role="alert">
                            '.get_string('noteacher','local_newsvnr').' !
                        </div>';
        }
        $output .= html_writer::end_div(); //end div tab3
        $output .= html_writer::end_div(); //end div tab-content
        $output .= html_writer::end_div(); //end div all-tab-content
        return $output;
        }
    }




 