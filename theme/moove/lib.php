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
 * Theme functions.
 *
 * @package    theme_moove
 * @copyright 2017 Willian Mano - http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_moove_get_extra_scss($theme) {
    $scss = $theme->settings->scss;

    $scss .= theme_moove_set_headerimg($theme);

    $scss .= theme_moove_set_topfooterimg($theme);

    $scss .= theme_moove_set_loginbgimg($theme);

    return $scss;
}

/**
 * Adds the cover to CSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_moove_set_headerimg($theme) {
    global $OUTPUT;

    $headerimg = $theme->setting_file_url('headerimg', 'headerimg');

    if (is_null($headerimg)) {
        $headerimg = $OUTPUT->image_url('headerimg', 'theme');
    }

    $headercss = "#page-site-index.notloggedin #page-header {background-image: url('$headerimg');}";

    return $headercss;
}

/**
 * Adds the footer image to CSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_moove_set_topfooterimg($theme) {
    global $OUTPUT;

    $topfooterimg = $theme->setting_file_url('topfooterimg', 'topfooterimg');

    if (is_null($topfooterimg)) {
        $topfooterimg = $OUTPUT->image_url('footer-bg', 'theme');
    }

    $headercss = "#top-footer {background-image: url('$topfooterimg');}";

    return $headercss;
}

/**
 * Adds the login page background image to CSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_moove_set_loginbgimg($theme) {
    global $OUTPUT;

    $loginbgimg = $theme->setting_file_url('loginbgimg', 'loginbgimg');

    if (is_null($loginbgimg)) {
        $loginbgimg = $OUTPUT->image_url('login_bg', 'theme');
    }

    $headercss = "#page-login-index.moove-login #page-wrapper #page {background-image: url('$loginbgimg');}";

    return $headercss;
}

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_moove_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    if ($filename == 'default.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    } else if ($filename == 'plain.scss') {
        // We still load the default preset files directly from the boost theme. No sense in duplicating them.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/plain.scss');
    } else if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_moove', 'preset', 0, '/', $filename))) {
        // This preset file was fetched from the file area for theme_moove and not theme_boost (see the line above).
        $scss .= $presetfile->get_content();
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    }

    // Moove scss.
    $moovevariables = file_get_contents($CFG->dirroot . '/theme/moove/scss/moove/_variables.scss');
    $moove = file_get_contents($CFG->dirroot . '/theme/moove/scss/moove.scss');

    // Combine them together.
    return $moovevariables . "\n" . $scss . "\n" . $moove;
}

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_moove_get_pre_scss($theme) {
    $scss = '';
    $configurable = [
        // Config key => [variableName, ...].
        'brandcolor' => ['brand-primary'],
        'navbarheadercolor' => 'navbar-header-color',
        'navbarbg' => 'navbar-bg',
        'navbarbghover' => 'navbar-bg-hover',
        'navbar' => 'navbar-background'
    ];

    // Prepend variables first.
    foreach ($configurable as $configkey => $targets) {
        $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;
        if (empty($value)) {
            continue;
        }
        array_map(function($target) use (&$scss, $value) {
            $scss .= '$' . $target . ': ' . $value . ";\n";
        }, (array) $targets);
    }

    // Prepend pre-scss.
    if (!empty($theme->settings->scsspre)) {
        $scss .= $theme->settings->scsspre;
    }

    return $scss;
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return mixed
 */
function theme_moove_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    $theme = theme_config::load('moove');

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'logo') {
        return $theme->setting_file_serve('logo', $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'headerimg') {
        return $theme->setting_file_serve('headerimg', $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'marketing1icon') {
        return $theme->setting_file_serve('marketing1icon', $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'marketing2icon') {
        return $theme->setting_file_serve('marketing2icon', $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'marketing3icon') {
        return $theme->setting_file_serve('marketing3icon', $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'marketing4icon') {
        return $theme->setting_file_serve('marketing4icon', $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'topfooterimg') {
        return $theme->setting_file_serve('topfooterimg', $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'loginbgimg') {
        return $theme->setting_file_serve('loginbgimg', $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and $filearea === 'favicon') {
        return $theme->setting_file_serve('favicon', $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and preg_match("/^sliderimage[1-9][0-9]?$/", $filearea) !== false) {
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and preg_match("/^sponsorsimage[1-9][0-9]?$/", $filearea) !== false) {
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    }

    if ($context->contextlevel == CONTEXT_SYSTEM and preg_match("/^clientsimage[1-9][0-9]?$/", $filearea) !== false) {
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    }

    send_file_not_found();
}

/**
 * Get theme setting
 *
 * @param string $setting
 * @param bool $format
 * @return string
 */
function theme_moove_get_setting($setting, $format = false) {
    $theme = theme_config::load('moove');

    if (empty($theme->settings->$setting)) {
        return false;
    }

    if (!$format) {
        return $theme->settings->$setting;
    }

    if ($format === 'format_text') {
        return format_text($theme->settings->$setting, FORMAT_PLAIN);
    }

    if ($format === 'format_html') {
        return format_text($theme->settings->$setting, FORMAT_HTML, array('trusted' => true, 'noclean' => true));
    }

    return format_string($theme->settings->$setting);
}


/**
 * Extend the Moove navigation
 *
 * @param flat_navigation $flatnav
 */
function theme_moove_extend_flat_navigation(\flat_navigation $flatnav, $layout = '') {
    theme_moove_rebuildcoursesections($flatnav);
    // theme_moove_buildnavnewsvnr_by_incourse($flatnav);

    theme_moove_buildnavnewsvnr_by_student($flatnav);
    theme_moove_buildnavnewsvnr_by_teacher($flatnav);
    $listlayout = [
        'course',
        'incourse',
        'default',
        'report'
    ];
    if(in_array($layout, $listlayout)) {
        theme_moove_delete_menuitems_incourse($flatnav);
    } else {
        theme_moove_delete_menuitems($flatnav);
    }
    
   
    // theme_moove_buildnavnewsvnr_allpage($flatnav);
    if(is_siteadmin()) {
        theme_moove_buildnavnewsvnr($flatnav);    
    }
    // theme_moove_buildnavnewsvnr_sitewide($flatnav);
}

/**
 * Remove items from navigation
 *
 * @param flat_navigation $flatnav
 */
function theme_moove_delete_menuitems(\flat_navigation $flatnav) {
    // var_dump($flatnav);die;
    $itemstodelete = [
        'coursehome',
        'mycourses'
    ];

    foreach ($flatnav as $item) {
        if (in_array($item->key, $itemstodelete)) {
            $flatnav->remove($item->key);

            continue;
        }

        if (isset($item->parent->key) && $item->parent->key == 'mycourses' &&
            isset($item->type) && $item->type == \navigation_node::TYPE_COURSE) {

            $flatnav->remove($item->key);

            continue;
        }
        if($item->type == \navigation_node::TYPE_COURSE) {
            $flatnav->remove($item->key);
            continue;
        }
    }
}

function theme_moove_delete_menuitems_incourse(\flat_navigation $flatnav) {
    // var_dump($flatnav);die;
    $itemstodelete = [
        'home',
        'myhome',
        'coursepage',
        'mycourses',
        'newspage',
        'forumpage',
        'calendar',
        'privatefiles',
        'mycourses_by_student_vnr',
        'mycourses_by_teacher_vnr',
        'grabnode',
        'newsvnr-sections',
        'courseindexpage'
        // 'sitesettings'

        // 'coursehome',
        // 'mycourses'
    ];

    foreach ($flatnav as $item) {
        if (in_array($item->key, $itemstodelete)) {
            $flatnav->remove($item->key);

            continue;
        }

        if (isset($item->parent->key) && $item->parent->key == 'mycourses' &&
            isset($item->type) && $item->type == \navigation_node::TYPE_COURSE) {

            $flatnav->remove($item->key);

            continue;
        }
        if($item->type == \navigation_node::TYPE_COURSE) {
            $flatnav->remove($item->key);
            continue;
        }
    }
}

/**
 * Improve flat navigation menu
 *
 * @param flat_navigation $flatnav
 */
function theme_moove_rebuildcoursesections(\flat_navigation $flatnav) {
    global $PAGE;

    $participantsitem = $flatnav->find('participants', \navigation_node::TYPE_CONTAINER);

    if (!$participantsitem) {
        return;
    }

    if ($PAGE->course->format != 'singleactivity') {
        $coursesectionsoptions = [
            'text' => get_string('coursesections', 'theme_moove'),
            'shorttext' => get_string('coursesections', 'theme_moove'),
            'icon' => new pix_icon('t/viewdetails', ''),
            'type' => \navigation_node::COURSE_CURRENT,
            'key' => 'course-sections',
            'parent' => $participantsitem->parent
        ];

        $coursesections = new \flat_navigation_node($coursesectionsoptions, 0);

        foreach ($flatnav as $item) {
            if ($item->type == \navigation_node::TYPE_SECTION) {
                $coursesections->add_node(new \navigation_node([
                    'text' => $item->text,
                    'shorttext' => $item->shorttext,
                    'icon' => $item->icon,
                    'type' => $item->type,
                    'key' => $item->key,
                    'parent' => $coursesections,
                    'action' => $item->action
                ]));
            }
        }

        $flatnav->add($coursesections, $participantsitem->key);
    }

    $mycourses = $flatnav->find('mycourses', \navigation_node::NODETYPE_LEAF);

    if ($mycourses) {
        $flatnav->remove($mycourses->key);

        $flatnav->add($mycourses, 'privatefiles');
    }
}
function theme_moove_buildnavnewsvnr_by_student(\flat_navigation $flatnav) {
    global $PAGE,$USER,$CFG;
    require_once($CFG->dirroot.'/course/renderer.php');
    $courses = get_list_course_by_student($USER->id);

    if($courses) {
        $parentnode = $flatnav->find('grabnode',\navigation_node::TYPE_CUSTOM);

        if (!$parentnode) {
            return;
        }

        $coursesectionsoptions = [
            'text' => get_string('mycourses','local_newsvnr'),
            'shorttext' => 'mycoursesvnr',
            'icon' => new pix_icon('i/mycourses', ''),
            'type' => \navigation_node::TYPE_SYSTEM,
            'key' => 'mycourses_by_student_vnr',
            'parent' => $parentnode
        ];
       
        $chelper = new \coursecat_helper();
        $coursesections = new \flat_navigation_node($coursesectionsoptions, 0);
        foreach ($courses as $course) {
            $course->fullname = strip_tags($chelper->get_course_formatted_name($course));
            $course->link = $CFG->wwwroot."/course/view.php?id=".$course->id;
            $coursesections->add_node(new \navigation_node([
                        'text' => $course->fullname,
                        'shorttext' => $course->shortname,
                        'icon' => '',
                        'type' => \navigation_node::TYPE_COURSE,
                        'key' => $course->id,
                        'parent' => $coursesections,
                        'action' => $course->link
                    ]));
        }      
        $flatnav->add($coursesections,$parentnode->key);
    }
}

function theme_moove_buildnavnewsvnr_by_teacher(\flat_navigation $flatnav) {
    global $PAGE,$USER,$CFG;
    require_once($CFG->dirroot . '/local/newsvnr/lib.php');
    $listcourse = get_list_course_by_teacher($USER->id);

    if($listcourse) {
        
        $parentnode = $flatnav->find('grabnode',\navigation_node::TYPE_CUSTOM);

        if (!$parentnode) {
            return;
        }
        $coursesectionsoptions = [
            'text' => get_string('mycourses_by_teacher','local_newsvnr'),
            'shorttext' => 'mycourses_by_teacher',
            'icon' => new pix_icon('i/mycourses', ''),
            'type' => \navigation_node::TYPE_SYSTEM,
            'key' => 'mycourses_by_teacher_vnr',
            'parent' => $parentnode
        ];
        $chelper = new \coursecat_helper();
        $coursesections = new \flat_navigation_node($coursesectionsoptions, 0);
        foreach ($listcourse as $course) {
            $course->fullname = strip_tags($chelper->get_course_formatted_name($course));
            $course->link = $CFG->wwwroot."/course/view.php?id=".$course->id;
            $coursesections->add_node(new \navigation_node([
                        'text' => $course->fullname,
                        'shorttext' => $course->shortname,
                        'icon' => '',
                        'type' => \navigation_node::TYPE_COURSE,
                        'key' => $course->id,
                        'parent' => $coursesections,
                        'action' => $course->link
                    ]));
        }      
        
        $flatnav->add($coursesections,$parentnode->key);
    }
}
function theme_moove_buildnavnewsvnr_by_incourse(\flat_navigation $flatnav) {
    global $PAGE, $USER, $CFG, $DB;
    require_once($CFG->dirroot . '/local/newsvnr/lib.php');
    require_once($CFG->dirroot . '/course/lib.php');
    require_once($CFG->libdir . '/completionlib.php');

    // $course = $DB->get_record('course',['id' => 1102]);
    // $modinfo = get_fast_modinfo($course);
    // $modnames = get_module_types_names();
    // $modnamesplural = get_module_types_names(true);
    // $modnamesused = $modinfo->get_used_module_names();
    // $mods = $modinfo->get_cms();
    // $sections = $modinfo->get_section_info_all();

    // $coursesections = $DB->get_records_sql('SELECT * FROM mdl_course_sections WHERE course = ?', [1102]);
    
    // if($coursesections) {
    //     // $sitesettings = $flatnav->find('course-sections',\navigation_node::COURSE_CURRENT);
    //     $sitesettings = $flatnav->find('participants', \navigation_node::TYPE_CONTAINER);

    //     if (!$sitesettings) {
    //         return;
    //     }
    //     // $chelper = new \coursecat_helper();
    //     foreach ($coursesections as $section) {
    //         $module_sections = $DB->get_records_sql('SELECT cm.id AS coursemoduleid, cs.id AS sectionid, cs.name AS sectionname, m.name AS modulename,cm.instance AS viewid 
    //                 FROM mdl_course_modules cm  
    //                     LEFT JOIN mdl_modules m ON cm.module = m.id 
    //                     JOIN mdl_course_sections cs ON cm.section = cs.id 
    //                 WHERE cm.course = ?', [1102]);
    //         if($section->section == 0) {
    //             $coursesectionsoptions2 = [
    //                 'text' => 'TOPIC 0',
    //                 'shorttext' => 'TOPIC 0',
    //                 'icon' => '',
    //                 'type' => \navigation_node::TYPE_SECTION,
    //                 'key' => $section->section,
    //                 'parent' => $sitesettings
    //             ];
    //             $coursesections2 = new \flat_navigation_node($coursesectionsoptions2, 0);
            
    //             foreach ($module_sections as $value) {
    //                 if($section->id === $value->sectionid) {
    //                     $module = new stdClass;
    //                     $modname = $DB->get_record_sql('SELECT * FROM {'.$value->modulename.'} WHERE id = ?', [$value->viewid]);
    //                     $module->link = $CFG->wwwroot."/mod/$value->modulename/view.php?id=".$value->viewid;
    //                     $coursesections2->add_node(new \navigation_node([
    //                                 'text' => 'congacon0',
    //                                 'shorttext' => 'congacon0',
    //                                 'icon' => '',
    //                                 'type' => \navigation_node::TYPE_SECTION,
    //                                 'key' => 49292,
    //                                 'parent' => $coursesections2,
    //                                 'action' => $module->link
    //                             ]));
    //                             $flatnav->add($coursesections2,$sitesettings->key);
                                
    //                 } else {
    //                     continue;
    //                 }
    //             }    
               
                
    //         } 
            
    //     //     else {
                
    //     //         $coursesectionsoptions2 = [
    //     //             'text' => $section->name,
    //     //             'shorttext' => $section->name,
    //     //             'icon' => '',
    //     //             'type' => \navigation_node::TYPE_SECTION,
    //     //             'key' => $section->section,
    //     //             'parent' => $sitesettings
    //     //         ];
    //     //         $coursesections2 = new \flat_navigation_node($coursesectionsoptions2, 0);
    //     //         foreach ($module_sections as $value) {
    //     //             if($section->id === $value->sectionid) {
    //     //                 $module = new stdClass;
    //     //                 $modname = $DB->get_record_sql('SELECT * FROM {'.$value->modulename.'} WHERE id = ?', [$value->viewid]);
    //     //                 $module->link = $CFG->wwwroot."/mod/$value->modulename/view.php?id=".$value->viewid;
    //     //                 $coursesections->add_node(new \navigation_node([
    //     //                             'text' => $modname->name,
    //     //                             'shorttext' => $modname->name,
    //     //                             'icon' => '',
    //     //                             'type' => \navigation_node::TYPE_COURSE,
    //     //                             'key' => $modname->id,
    //     //                             'parent' => $coursesections,
    //     //                             'action' => $module->link
    //     //                         ]));
                                
    //     //             } else {
    //     //                 continue;
    //     //             }
    //     //         }  
    //     //         $flatnav->add($coursesections2,$sitesettings->key); 
    //     //         break;    
    //     //     }
    //     }
    // }
        require_once($CFG->dirroot.'/course/renderer.php');
    $courses = get_list_course_by_student($USER->id);

    if($courses) {
        $sitesettings = $flatnav->find('sitesettings',\navigation_node::TYPE_SITE_ADMIN);

        if (!$sitesettings) {
            return;
        }

        $coursesectionsoptions = [
            'text' => get_string('mycourses','local_newsvnr'),
            'shorttext' => 'mycoursesvnr',
            'icon' => new pix_icon('i/mycourses', ''),
            'type' => \navigation_node::TYPE_SYSTEM,
            'key' => 'mycourses_by_student_vnr2',
            'parent' => $sitesettings
        ];
       
        $chelper = new \coursecat_helper();
        $coursesections = new \flat_navigation_node($coursesectionsoptions, 0);
        foreach ($courses as $course) {
            $course->fullname = strip_tags($chelper->get_course_formatted_name($course));
            $course->link = $CFG->wwwroot."/course/view.php?id=".$course->id;
            $coursesections->add_node(new \navigation_node([
                        'text' => $course->fullname,
                        'shorttext' => $course->shortname,
                        'icon' => '',
                        'type' => \navigation_node::TYPE_COURSE,
                        'key' => $course->id,
                        'parent' => $coursesections,
                        'action' => $course->link
                    ]));
        }      
       
        $flatnav->add($coursesections,$sitesettings->key);
    }
}

function theme_moove_buildnavnewsvnr(\flat_navigation $flatnav) {
    global $PAGE;

    $calendar = $flatnav->find('calendar',\navigation_node::TYPE_CUSTOM);

    if (!$calendar) {
        return;
    }


    $coursesectionsoptions = [
        'text' => get_string('learningplan','local_newsvnr'),
        'shorttext' => 'NewsVnR',
        'icon' => new pix_icon('t/viewdetails', ''),
        'type' => \navigation_node::TYPE_SYSTEM,
        'key' => 'newsvnr-sections',
        'parent' => $calendar
    ];
    $newsurl = new moodle_url('/local/newsvnr/index.php');
    $courseurl = new moodle_url('/local/newsvnr/course.php');
    $forumurl = new moodle_url('/local/newsvnr/forum.php');
    $orgcomp_positionurl = new moodle_url('/local/newsvnr/orgcomp_position.php');
    // $questionbank_url = new moodle_url('/question/edit.php?courseid=1');
    $orgmanagerurl = new moodle_url('/local/newsvnr/orgmanager.php');
    $orgmainurl = new moodle_url('/local/newsvnr/orgmain.php');
    $coursesections = new \flat_navigation_node($coursesectionsoptions, 0);

   
    $coursesections->add_node(new \navigation_node([
                'text' => get_string('orgmanagertitle', 'local_newsvnr'),
                'shorttext' => 'orgmanager',
                'icon' => '',
                'type' => \navigation_node::TYPE_CUSTOM,
                'key' => 'orgmanagervnr',
                'parent' => $coursesections,
                'action' => $orgmanagerurl
            ]));
    
    // $coursesections->add_node(new \navigation_node([
    //             'text' => get_string('questionbank_title', 'local_newsvnr'),
    //             'shorttext' => 'questionbank',
    //             'icon' => '',
    //             'type' => \navigation_node::TYPE_CUSTOM,
    //             'key' => 'questionbankvnr',
    //             'parent' => $coursesections,
    //             'action' => $questionbank_url
    //         ]));
    $coursesections->add_node(new \navigation_node([
                'text' => get_string('orgcomp_position', 'local_newsvnr'),
                'shorttext' => 'orgcomp',
                'icon' => '',
                'type' => \navigation_node::TYPE_CUSTOM,
                'key' => 'orgcompvnr',
                'parent' => $coursesections,
                'action' => $orgcomp_positionurl
            ]));
    
    $coursesections->add_node(new \navigation_node([
                'text' => get_string('orgmaintitle', 'local_newsvnr'),
                'shorttext' => 'orgmain',
                'icon' => '',
                'type' => \navigation_node::TYPE_CUSTOM,
                'key' => 'orgmainvnr',
                'parent' => $coursesections,
                'action' => $orgmainurl
            ]));

   
    $flatnav->add($coursesections);
}

function theme_moove_buildnavnewsvnr_sitewide(\flat_navigation $flatnav) {
    global $PAGE;

    

    $admin = $PAGE->settingsnav->find('siteadministration', navigation_node::TYPE_SITE_ADMIN);
    if (!$admin) {
        // Try again - crazy nav tree!
        $admin = $PAGE->settingsnav->find('root', navigation_node::TYPE_SITE_ADMIN);
    }
    if ($admin) {
        $flat = new flat_navigation_node($admin, 0);
        $flat->set_showdivider(true);
        $flat->key = 'sitesettings';
        $flat->icon = new pix_icon('t/preferences', '');
        $flatnav->add($flat);
    }

    // Add-a-block in editing mode.
    if (isset($flatnav->page->theme->addblockposition) &&
            $flatnav->page->theme->addblockposition == BLOCK_ADDBLOCK_POSITION_FLATNAV &&
            $PAGE->user_is_editing() && $PAGE->user_can_edit_blocks() &&
            ($addable = $PAGE->blocks->get_addable_blocks())) {
        $url = new moodle_url($PAGE->url, ['bui_addblock' => '', 'sesskey' => sesskey()]);
        $addablock = navigation_node::create(get_string('addblock'), $url);
        $flat = new flat_navigation_node($addablock, 0);
        $flat->set_showdivider(true);
        $flat->key = 'addblock';
        $flat->icon = new pix_icon('i/addblock', '');
        $flatnav->add($flat);
        $blocks = [];
        foreach ($addable as $block) {
            $blocks[] = $block->name;
        }
        $params = array('blocks' => $blocks, 'url' => '?' . $url->get_query_string(false));
        $PAGE->requires->js_call_amd('core/addblockmodal', 'init', array($params));
    }
}
function theme_moove_layout_check() {
    global $COURSE,$DB,$USER,$CFG;
    require_once $CFG->dirroot . '/local/newsvnr/lib.php';
    $object = new stdClass();
    // var_dump($_SERVER);die;
    $referer = $_SERVER['HTTP_REFERER'];
    $referer_split = explode('/', $referer);
    if(isset($referer) && ($referer_split[2] == $_SERVER['HTTP_HOST'])) {
        $object->hasportal = false;
    } elseif(isset($referer) && ($referer_split[2] != $_SERVER['HTTP_HOST'])) {
        $object->hasportal = true;
    } else {
        $object->hasportal = false;
    }
    $object->show_hide_focusmod = true;
    if(isset($referer) && ($referer_split[2] == $_SERVER['HTTP_HOST'])) {
        if($_COOKIE['cookie'] == 'focusmod') {
            if (strpos($referer, '/mod/') == true || strpos($_SERVER['QUERY_STRING'], 'course=') == true || strpos($referer, 'course=') == true) {
                // if(strpos($referer, 'course=') == true) {
                //     $object->hasiframe = false;
                // } else {
                //     $object->hasiframe = true;
                //     $object->show_hide_focusmod = false;
                // }
                $object->hasiframe = true;
                $object->show_hide_focusmod = false;
            } else {
                $object->hasiframe = false;
            }
        } else {
            $object->hasiframe = false;
        }
        // if($_SERVER['SCRIPT_NAME'] == '/course/view.php' && $_COOKIE['cookie'] == 'focusmod') {
        //     $object->hasiframe = true;
        // } else {
        //     if($_SERVER['SCRIPT_NAME'] == '/course/view.php')
        //     if (isset($_COOKIE['cookie']) == 'focusmod') {
        //         unset($_COOKIE['cookie']); 
        //         setcookie('cookie', null, -1, '/'); 
        //         $object->hasiframe = false;
        //     } else {
        //         $object->hasiframe = true;
        //     }
        // }
    } else {
        $object->hasiframe = false;
    }
    $object->hasfocusmod = (isset($_COOKIE['cookie']) == 'focusmod') ? true : false;
    $object->hasopenmenu = (isset($_COOKIE['menu']) == 'openmenu') ? true : false;
    $object->hascourse = ($COURSE->id > 1) ? true : false;
    $object->settingexam = ($COURSE->id == 1) ? true : false;
    $check_is_teacher = check_teacherrole($USER->id);
    $check_is_student = check_studentrole($USER->id);
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url_components = parse_url($url);
    if(isset($url_components['query'])) {
        parse_str($url_components['query'], $params); 
        if (isset($params['teacher'])) {
            $object->is_teacher = ($check_is_teacher != 0 && $params['teacher'] == 1) ? true : false;
            $object->isadmin = false;
            $object->is_student = false;
        }
        elseif (isset($params['student'])) { 
            $object->is_student = ($check_is_student != 0 && $params['student'] == 1) ? true : false;
            $object->isadmin = false;
            $object->is_teacher = false;
        }
        else {
            $object->isadmin = (is_siteadmin()) ? true : false;
            $object->is_teacher = ($check_is_teacher != 0 && $object->isadmin != true) ? true : false; 
            $object->is_student = ($check_is_student != 0 && $object->isadmin != true && $object->is_teacher != true) ? true : false;
        }
    } else {
        $object->isadmin = (is_siteadmin()) ? true : false;
        $object->is_teacher = ($check_is_teacher != 0 && $object->isadmin != true) ? true : false; 
        $object->is_student = ($check_is_student != 0 && $object->isadmin != true && $object->is_teacher != true) ? true : false;
    }
    return $object;
}