<?php
// This file is part of Ranking block for Moodle - http://moodle.org/
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
 * Theme Moove block settings file
 *
 * @package    theme_moove
 * @copyright  2017 Willian Mano http://conecti.me
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

// This is used for performance, we don't need to know about these settings on every page in Moodle, only when
// we are looking at the admin settings pages.
if ($ADMIN->fulltree) {

    // Boost provides a nice setting page which splits settings onto separate tabs. We want to use it here.
    $settings = new theme_boost_admin_settingspage_tabs('themesettingmoove', get_string('configtitle', 'theme_moove'));

    /*
    * ----------------------
    * General settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_moove_general', get_string('generalsettings', 'theme_moove'));

    // Logo file setting.
    $name = 'theme_moove/logo';
    $title = get_string('logo', 'theme_moove');
    $description = get_string('logodesc', 'theme_moove');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Favicon setting.
    $name = 'theme_moove/favicon';
    $title = get_string('favicon', 'theme_moove');
    $description = get_string('favicondesc', 'theme_moove');
    $opts = array('accepted_types' => array('.ico'), 'maxfiles' => 1);
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'favicon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset.
    $name = 'theme_moove/preset';
    $title = get_string('preset', 'theme_moove');
    $description = get_string('preset_desc', 'theme_moove');
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_moove', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }
    // These are the built in presets.
    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Preset files setting.
    $name = 'theme_moove/presetfiles';
    $title = get_string('presetfiles', 'theme_moove');
    $description = get_string('presetfiles_desc', 'theme_moove');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    // Login page background image.
    $name = 'theme_moove/loginbgimg';
    $title = get_string('loginbgimg', 'theme_moove');
    $description = get_string('loginbgimg_desc', 'theme_moove');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'loginbgimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $brand-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_moove/brandcolor';
    $title = get_string('brandcolor', 'theme_moove');
    $description = get_string('brandcolor_desc', 'theme_moove');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-header-color.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_moove/navbarheadercolor';
    $title = get_string('navbarheadercolor', 'theme_moove');
    $description = get_string('navbarheadercolor_desc', 'theme_moove');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-bg.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_moove/navbarbg';
    $title = get_string('navbarbg', 'theme_moove');
    $description = get_string('navbarbg_desc', 'theme_moove');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-bg-hover.
    // We use an empty default value because the default colour should come from the preset.
    $name = 'theme_moove/navbarbghover';
    $title = get_string('navbarbghover', 'theme_moove');
    $description = get_string('navbarbghover_desc', 'theme_moove');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Variable $navbar-background 
    $name = 'theme_moove/navbar';
    $title = get_string('navbar', 'theme_moove');
    $description = get_string('navbar_desc', 'theme_moove');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Course format option.
    $name = 'theme_moove/coursepresentation';
    $title = get_string('coursepresentation', 'theme_moove');
    $description = get_string('coursepresentationdesc', 'theme_moove');
    $options = [];
    $options[1] = get_string('coursedefault', 'theme_moove');
    $options[2] = get_string('coursecover', 'theme_moove');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_moove/courselistview';
    $title = get_string('courselistview', 'theme_moove');
    $description = get_string('courselistviewdesc', 'theme_moove');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Must add the page after definiting all the settings!
    $settings->add($page);

    /*
    * ----------------------
    * Advanced settings tab
    * ----------------------
    */
    $page = new admin_settingpage('theme_moove_advanced', get_string('advancedsettings', 'theme_moove'));

    // Choice sitetype for Domain
    $name = 'theme_moove/sitetype';
    $title = get_string('settings_sitetype', 'theme_moove');
    $description = get_string('settings_sitetypedesc', 'theme_moove');
    $options = [];
    $options['business'] = get_string('settings_business', 'theme_moove');
    $options['education'] = get_string('settings_education', 'theme_moove');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Show/Hidden tab in site administration
    $listtab = [
            'users' => get_string('users', 'admin'),
            'courses' => get_string('courses','admin'),
            'grades' => get_string('grades'),
            'analytics' => get_string('analytics', 'analytics'),
            'competencies' => get_string('competencies', 'core_competency'),
            'badges' => get_string('badges'),
            'location' => get_string('location', 'admin'),
            'language' => get_string('language'),
            'messaging' => get_string('messagingcategory', 'admin'),
            'modules' => get_string('plugins', 'admin'),
            'security' => get_string('security', 'admin'),
            'appearance' => get_string('appearance', 'admin'),
            'frontpage' => get_string('frontpage', 'admin'),
            'server' => get_string('server', 'admin'),
            'mnet' => get_string('net','mnet'),
            'reports' => get_string('reports'),
            'development' => get_string('development', 'admin'),
            'newsvnr' => get_string('sitetabadmin', 'local_newsvnr'),
            'mobileapp' => get_string('mobileapp', 'tool_mobile'),
            'adminnotifications' => get_string('notifications', 'moodle'),
            'registrationmoodleorg' => get_string('registration', 'admin'),
            'upgradesettings' => get_string('upgradesettings', 'admin'),
            'moodleservices' => get_string('moodleservices', 'admin'),
            'optionalsubsystems' => get_string('advancedfeatures', 'admin'),
            'adminnotifications' => 'adminnotifications',
            'competencies' => 'competencies',
            'competencysettings' => 'competencysettings',
            'toollpmigrateframeworks' => 'toollpmigrateframeworks',
            'toollpimportcsv' => 'toollpimportcsv',
            'toollpcompetencies' => 'toollpcompetencies',
            'toollplearningplans' => 'toollplearningplans',
            'badges' => 'badges',
            'badgesettings' => 'badgesettings',
            'managebadges' => 'managebadges',
            'newbadge' => 'newbadge',
            'h5p' => 'h5p',
            'h5poverview' => 'h5poverview',
            'h5pmanagelibraries' => 'h5pmanagelibraries',
            'h5psettings' => 'h5psettings',
            'language' => 'language',
            'langsettings' => 'langsettings',
            'toolcustomlang' => 'toolcustomlang',
            'toollangimport' => 'toollangimport',
            'security' => 'security',
            'sitepolicies' => 'sitepolicies',
            'httpsecurity' => 'httpsecurity',
            'notifications' => 'notifications',
            'frontpage' => 'frontpage',
            'frontpagesettings' => 'frontpagesettings',
            'users' => 'users',
            'accounts' => 'accounts',
            'editusers' => 'editusers',
            'addnewuser' => 'addnewuser',
            'cohorts' => 'cohorts',
            'tooluploaduser' => 'tooluploaduser',
            'roles' => 'roles',
            'admins' => 'admins',
            'defineroles' => 'defineroles',
            'assignroles' => 'assignroles',
            'checkpermissions' => 'checkpermissions',
            'toolcohortroles' => 'toolcohortroles',
            'courses' => 'courses',
            'coursemgmt' => 'coursemgmt',
            'addcategory' => 'addcategory',
            'addnewcourse' => 'addnewcourse',
            'restorecourse' => 'restorecourse',
            'coursesettings' => 'coursesettings',
            'courserequest' => 'courserequest',
            'coursespending' => 'coursespending',
            'questionbankvnr' => 'questionbankvnr',
            'grades' => 'grades',
            'gradessettings' => 'gradessettings',
            'gradecategorysettings' => 'gradecategorysettings',
            'gradeitemsettings' => 'gradeitemsettings',
            'scales' => 'scales',
            'outcomes' => 'outcomes', 
            'letters' => 'letters',
            'gradereports' => 'gradereports',
            'gradereportgrader' => 'gradereportgrader',
            'gradereporthistory' => 'gradereporthistory',
            'gradereportoverview' => 'gradereportoverview',
            'gradereportuser' => 'gradereportuser',
            'analytics' => 'analytics',
            'competencies' => 'competencies',
            'competencysettings' => 'competencysettings',
            'toollpmigrateframeworks' => 'toollpmigrateframeworks',
            'toollpimportcsv' => 'toollpimportcsv',
            'toollpcompetencies' => 'toollpcompetencies',
            'toollplearningplans' => 'toollplearningplans',
            'badges' => 'badges',
            'badgesettings' => 'badgesettings',
            'managebadges' => 'managebadges',
            'newbadge' => 'newbadge',
            'h5p' => 'h5p',
            'h5poverview' => 'h5poverview',
            'h5pmanagelibraries' => 'h5pmanagelibraries',
            'h5psettings' => 'h5psettings',
            'license' => 'license',
            'location' => 'location',
            'language' => 'language',
            'langsettings' => 'langsettings',
            'toolcustomlang' => 'toolcustomlang',
            'toollangimport' => 'toollangimport',
            'messaging' => 'messaging',
            'modules' => 'modules',
            'security' => 'security',
            'sitepolicies' => 'sitepolicies',
            'httpsecurity' => 'httpsecurity',
            'notifications' => 'notifications',
            'appearance' => 'appearance',
            'logos' => 'logos',
            'navigation' => 'navigation',
            'mypage' => 'mypage',
            'managetags' => 'managetags',
            'themes' => 'themes',
            'themeselector' => 'themeselector',
            'themesettingboost' => 'themesettingboost',
            'themesettingclassic' => 'themesettingclassic',
            'themesettingmoove' => 'themesettingmoove',
            'frontpage' => 'frontpage',
            'frontpagesettings' => 'frontpagesettings',
            'server' => 'server',
            'mnet' => 'mnet',
            'reports' => 'reports',
            'mobileapp' => 'mobileapp',
            'development' => 'development',
            'debugging' => 'debugging',
            'purgecaches' => 'purgecaches',
            'managermentapivnr' => 'managermentapivnr',
            'newsvnr' => 'newsvnr',
            'tooluploadorgstruture' => 'tooluploadorgstruture',
            'learningplanvnr' => 'learningplanvnr',
            'orgmanager' => 'orgmanager',
            'orgcomp_position' => 'orgcomp_position',
            'orgmain' => 'orgmain',
            'examvnr' => 'examvnr',
            'manageexamreports' => 'manageexamreports',
            'exam' => 'exam',
            'createsubjectexam' => 'createsubjectexam',
            'createexam' => 'createexam',
            'listexam' => 'listexam',
            'listsubjectexam' => 'listsubjectexam',
            'unsupported' => 'unsupported',
            'moodlenet' => 'moodlenet'
    ];
    $setting = new admin_setting_configmultiselect('theme_moove/administrationtab', get_string('administrationtab', 'theme_moove'),
        get_string('administrationtabdesc', 'theme_moove'), [], $listtab);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    // Show/Hidden item menu 
    $listmenuitem = [
            'exam' => get_string('exam', 'local_newsvnr'),
            'course' => get_string('course','local_newsvnr'),
            'library' => get_string('library','local_newsvnr'),
            'systemresource' => get_string('systemresource', 'local_newsvnr'),
            'news' => get_string('news','local_newsvnr'),
            'forum' => get_string('forum','local_newsvnr'),
    ];
    $setting = new admin_setting_configmultiselect('theme_moove/menuitem', get_string('listmenuitem', 'local_newsvnr'),
    get_string('listmenuitemdesc', 'local_newsvnr'), [], $listmenuitem);
    $page->add($setting);

    // Change portal to full funcs
    $name = 'theme_moove/fullsite';
    $title = get_string('fullsite', 'theme_moove');
    $description = get_string('fullsitedesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Change dashboad new and old (3.7 and 3.9)
    $name = 'theme_moove/switch_dashboard';
    $title = get_string('switch_dashboard', 'theme_moove');
    $description = get_string('switch_dashboarddesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Raw SCSS to include before the content.
    $setting = new admin_setting_scsscode('theme_moove/scsspre',
        get_string('rawscsspre', 'theme_moove'), get_string('rawscsspre_desc', 'theme_moove'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Raw SCSS to include after the content.
    $setting = new admin_setting_scsscode('theme_moove/scss', get_string('rawscss', 'theme_moove'),
        get_string('rawscss_desc', 'theme_moove'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Google analytics block.
    $name = 'theme_moove/googleanalytics';
    $title = get_string('googleanalytics', 'theme_moove');
    $description = get_string('googleanalyticsdesc', 'theme_moove');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    /*
    * -----------------------
    * Frontpage settings tab
    * -----------------------
    */
    $page = new admin_settingpage('theme_moove_frontpage', get_string('frontpagesettings', 'theme_moove'));
    // Hiện thị or ẩn nút home menu
    $name = 'theme_moove/displayhome';
    $title = get_string('displayhome', 'theme_moove');
    $description = get_string('displayhomedesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Hiện thị or ẩn chatbot
    $name = 'theme_moove/chatbotelearning';
    $title = get_string('chatbotelearning', 'theme_moove');
    $description = get_string('chatbotelearningdesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Hiện thị or ẩn section tin tức
    $name = 'theme_moove/displaynews';
    $title = get_string('displaynews', 'theme_moove');
    $description = get_string('displaynewsdesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Hiện thị or ẩn section khóa học phổ biến
    $name = 'theme_moove/displaycoursespopular';
    $title = get_string('displaycoursespopular', 'theme_moove');
    $description = get_string('displaycoursespopulardesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Hiện thị or ẩn section khóa học của tôi
    $name = 'theme_moove/displaymycourses';
    $title = get_string('displaymycourses', 'theme_moove');
    $description = get_string('displaymycoursesdesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Hiện thị or ẩn section diễn đàn
    $name = 'theme_moove/displayforums';
    $title = get_string('displayforums', 'theme_moove');
    $description = get_string('displayforumsdesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Disable bottom footer.
    $name = 'theme_moove/disablefrontpageloginbox';
    $title = get_string('disablefrontpageloginbox', 'theme_moove');
    $description = get_string('disablefrontpageloginboxdesc', 'theme_moove');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);
    $setting->set_updatedcallback('theme_reset_all_caches');

    $page->add($setting);

    // Disable bottom footer.
    $name = 'theme_moove/disablefrontpageloginbox';
    $title = get_string('disablefrontpageloginbox', 'theme_moove');
    $description = get_string('disablefrontpageloginboxdesc', 'theme_moove');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Disable teachers from cards.
    $name = 'theme_moove/disableteacherspic';
    $title = get_string('disableteacherspic', 'theme_moove');
    $description = get_string('disableteacherspicdesc', 'theme_moove');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Headerimg file setting.
    $name = 'theme_moove/headerimg';
    $title = get_string('headerimg', 'theme_moove');
    $description = get_string('headerimgdesc', 'theme_moove');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'headerimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannerheading.
    $name = 'theme_moove/bannerheading';
    $title = get_string('bannerheading', 'theme_moove');
    $description = get_string('bannerheadingdesc', 'theme_moove');
    $default = 'Perfect Learning System';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Bannercontent.
    $name = 'theme_moove/bannercontent';
    $title = get_string('bannercontent', 'theme_moove');
    $description = get_string('bannercontentdesc', 'theme_moove');
    $default = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_moove/displaymarketingbox';
    $title = get_string('displaymarketingbox', 'theme_moove');
    $description = get_string('displaymarketingboxdesc', 'theme_moove');
    $default = 1;
    $choices = array(0 => 'No', 1 => 'Yes');
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $page->add($setting);

    // Marketing1icon.
    $name = 'theme_moove/marketing1icon';
    $title = get_string('marketing1icon', 'theme_moove');
    $description = get_string('marketing1icondesc', 'theme_moove');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing1icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1heading.
    $name = 'theme_moove/marketing1heading';
    $title = get_string('marketing1heading', 'theme_moove');
    $description = get_string('marketing1headingdesc', 'theme_moove');
    $default = 'We host';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1subheading.
    $name = 'theme_moove/marketing1subheading';
    $title = get_string('marketing1subheading', 'theme_moove');
    $description = get_string('marketing1subheadingdesc', 'theme_moove');
    $default = 'your MOODLE';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1content.
    $name = 'theme_moove/marketing1content';
    $title = get_string('marketing1content', 'theme_moove');
    $description = get_string('marketing1contentdesc', 'theme_moove');
    $default = 'Moodle hosting in a powerful cloud infrastructure';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing1url.
    $name = 'theme_moove/marketing1url';
    $title = get_string('marketing1url', 'theme_moove');
    $description = get_string('marketing1urldesc', 'theme_moove');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2icon.
    $name = 'theme_moove/marketing2icon';
    $title = get_string('marketing2icon', 'theme_moove');
    $description = get_string('marketing2icondesc', 'theme_moove');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing2icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2heading.
    $name = 'theme_moove/marketing2heading';
    $title = get_string('marketing2heading', 'theme_moove');
    $description = get_string('marketing2headingdesc', 'theme_moove');
    $default = 'Consulting';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2subheading.
    $name = 'theme_moove/marketing2subheading';
    $title = get_string('marketing2subheading', 'theme_moove');
    $description = get_string('marketing2subheadingdesc', 'theme_moove');
    $default = 'for your company';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2content.
    $name = 'theme_moove/marketing2content';
    $title = get_string('marketing2content', 'theme_moove');
    $description = get_string('marketing2contentdesc', 'theme_moove');
    $default = 'Moodle consulting and training for you';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing2url.
    $name = 'theme_moove/marketing2url';
    $title = get_string('marketing2url', 'theme_moove');
    $description = get_string('marketing2urldesc', 'theme_moove');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3icon.
    $name = 'theme_moove/marketing3icon';
    $title = get_string('marketing3icon', 'theme_moove');
    $description = get_string('marketing3icondesc', 'theme_moove');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing3icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3heading.
    $name = 'theme_moove/marketing3heading';
    $title = get_string('marketing3heading', 'theme_moove');
    $description = get_string('marketing3headingdesc', 'theme_moove');
    $default = 'Development';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3subheading.
    $name = 'theme_moove/marketing3subheading';
    $title = get_string('marketing3subheading', 'theme_moove');
    $description = get_string('marketing3subheadingdesc', 'theme_moove');
    $default = 'themes and plugins';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3content.
    $name = 'theme_moove/marketing3content';
    $title = get_string('marketing3content', 'theme_moove');
    $description = get_string('marketing3contentdesc', 'theme_moove');
    $default = 'We develop themes and plugins as your desires';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing3url.
    $name = 'theme_moove/marketing3url';
    $title = get_string('marketing3url', 'theme_moove');
    $description = get_string('marketing3urldesc', 'theme_moove');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4icon.
    $name = 'theme_moove/marketing4icon';
    $title = get_string('marketing4icon', 'theme_moove');
    $description = get_string('marketing4icondesc', 'theme_moove');
    $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'marketing4icon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4heading.
    $name = 'theme_moove/marketing4heading';
    $title = get_string('marketing4heading', 'theme_moove');
    $description = get_string('marketing4headingdesc', 'theme_moove');
    $default = 'Support';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4subheading.
    $name = 'theme_moove/marketing4subheading';
    $title = get_string('marketing4subheading', 'theme_moove');
    $description = get_string('marketing4subheadingdesc', 'theme_moove');
    $default = 'we give you answers';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4content.
    $name = 'theme_moove/marketing4content';
    $title = get_string('marketing4content', 'theme_moove');
    $description = get_string('marketing4contentdesc', 'theme_moove');
    $default = 'MOODLE specialized support';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Marketing4url.
    $name = 'theme_moove/marketing4url';
    $title = get_string('marketing4url', 'theme_moove');
    $description = get_string('marketing4urldesc', 'theme_moove');
    $setting = new admin_setting_configtext($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Enable or disable Slideshow settings.
    $name = 'theme_moove/sliderenabled';
    $title = get_string('sliderenabled', 'theme_moove');
    $description = get_string('sliderenableddesc', 'theme_moove');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);

    // Enable slideshow on frontpage guest page.
    $name = 'theme_moove/sliderfrontpage';
    $title = get_string('sliderfrontpage', 'theme_moove');
    $description = get_string('sliderfrontpagedesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_moove/slidercount';
    $title = get_string('slidercount', 'theme_moove');
    $description = get_string('slidercountdesc', 'theme_moove');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 13; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $slidercount = get_config('theme_moove', 'slidercount');

    if (!$slidercount) {
        $slidercount = 1;
    }

    for ($sliderindex = 1; $sliderindex <= $slidercount; $sliderindex++) {
        $fileid = 'sliderimage' . $sliderindex;
        $name = 'theme_moove/sliderimage' . $sliderindex;
        $title = get_string('sliderimage', 'theme_moove');
        $description = get_string('sliderimagedesc', 'theme_moove');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_moove/slidertitle' . $sliderindex;
        $title = get_string('slidertitle', 'theme_moove');
        $description = get_string('slidertitledesc', 'theme_moove');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);

        $name = 'theme_moove/slidercap' . $sliderindex;
        $title = get_string('slidercaption', 'theme_moove');
        $description = get_string('slidercaptiondesc', 'theme_moove');
        $default = '';
        $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
        $page->add($setting);
    }

    // Enable or disable Slideshow settings.
    $name = 'theme_moove/numbersfrontpage';
    $title = get_string('numbersfrontpage', 'theme_moove');
    $description = get_string('numbersfrontpagedesc', 'theme_moove');
    $default = 1;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    // Enable sponsors on frontpage guest page.
    $name = 'theme_moove/sponsorsfrontpage';
    $title = get_string('sponsorsfrontpage', 'theme_moove');
    $description = get_string('sponsorsfrontpagedesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_moove/sponsorstitle';
    $title = get_string('sponsorstitle', 'theme_moove');
    $description = get_string('sponsorstitledesc', 'theme_moove');
    $default = get_string('sponsorstitledefault', 'theme_moove');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_moove/sponsorssubtitle';
    $title = get_string('sponsorssubtitle', 'theme_moove');
    $description = get_string('sponsorssubtitledesc', 'theme_moove');
    $default = get_string('sponsorssubtitledefault', 'theme_moove');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_moove/sponsorscount';
    $title = get_string('sponsorscount', 'theme_moove');
    $description = get_string('sponsorscountdesc', 'theme_moove');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 5; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $sponsorscount = get_config('theme_moove', 'sponsorscount');

    if (!$sponsorscount) {
        $sponsorscount = 1;
    }

    for ($sponsorsindex = 1; $sponsorsindex <= $sponsorscount; $sponsorsindex++) {
        $fileid = 'sponsorsimage' . $sponsorsindex;
        $name = 'theme_moove/sponsorsimage' . $sponsorsindex;
        $title = get_string('sponsorsimage', 'theme_moove');
        $description = get_string('sponsorsimagedesc', 'theme_moove');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_moove/sponsorsurl' . $sponsorsindex;
        $title = get_string('sponsorsurl', 'theme_moove');
        $description = get_string('sponsorsurldesc', 'theme_moove');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);
    }

    // Enable clients on frontpage guest page.
    $name = 'theme_moove/clientsfrontpage';
    $title = get_string('clientsfrontpage', 'theme_moove');
    $description = get_string('clientsfrontpagedesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $page->add($setting);

    $name = 'theme_moove/clientstitle';
    $title = get_string('clientstitle', 'theme_moove');
    $description = get_string('clientstitledesc', 'theme_moove');
    $default = get_string('clientstitledefault', 'theme_moove');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_moove/clientssubtitle';
    $title = get_string('clientssubtitle', 'theme_moove');
    $description = get_string('clientssubtitledesc', 'theme_moove');
    $default = get_string('clientssubtitledefault', 'theme_moove');
    $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
    $page->add($setting);

    $name = 'theme_moove/clientscount';
    $title = get_string('clientscount', 'theme_moove');
    $description = get_string('clientscountdesc', 'theme_moove');
    $default = 1;
    $options = array();
    for ($i = 0; $i < 5; $i++) {
        $options[$i] = $i;
    }
    $setting = new admin_setting_configselect($name, $title, $description, $default, $options);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // If we don't have an slide yet, default to the preset.
    $clientscount = get_config('theme_moove', 'clientscount');

    if (!$clientscount) {
        $clientscount = 1;
    }

    for ($clientsindex = 1; $clientsindex <= $clientscount; $clientsindex++) {
        $fileid = 'clientsimage' . $clientsindex;
        $name = 'theme_moove/clientsimage' . $clientsindex;
        $title = get_string('clientsimage', 'theme_moove');
        $description = get_string('clientsimagedesc', 'theme_moove');
        $opts = array('accepted_types' => array('.png', '.jpg', '.gif', '.webp', '.tiff', '.svg'), 'maxfiles' => 1);
        $setting = new admin_setting_configstoredfile($name, $title, $description, $fileid, 0, $opts);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $page->add($setting);

        $name = 'theme_moove/clientsurl' . $clientsindex;
        $title = get_string('clientsurl', 'theme_moove');
        $description = get_string('clientsurldesc', 'theme_moove');
        $setting = new admin_setting_configtext($name, $title, $description, '', PARAM_TEXT);
        $page->add($setting);
    }

    $settings->add($page);

    /*
    * --------------------
    * Footer settings tab
    * --------------------
    */
    $page = new admin_settingpage('theme_moove_footer', get_string('footersettings', 'theme_moove'));

    $name = 'theme_moove/getintouchcontent';
    $title = get_string('getintouchcontent', 'theme_moove');
    $description = get_string('getintouchcontentdesc', 'theme_moove');
    $default = 'Conecti.me';
    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Website.
    $name = 'theme_moove/website';
    $title = get_string('website', 'theme_moove');
    $description = get_string('websitedesc', 'theme_moove');
    $default = 'http://VnResource.vn';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Address setting
    $name = 'theme_moove/address';
    $title = get_string('address', 'theme_moove');
    $description = get_string('addressdesc', 'theme_moove');
    $default = 'Toà nhà VnResource 41/7 Phạm Ngũ Lão, Phường 3, Quận Gò Vấp, Tp. Hồ Chí Minh';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Slogan setting
    $name = 'theme_moove/slogan';
    $title = get_string('slogan', 'theme_moove');
    $description = get_string('slogandesc', 'theme_moove');
    $default = 'YOUR TRUST, OUR SUCCESS';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mobile.
    $name = 'theme_moove/mobile';
    $title = get_string('mobile', 'theme_moove');
    $description = get_string('mobiledesc', 'theme_moove');
    $default = 'Mobile : +84 (28) 730 000 448';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Mail.
    $name = 'theme_moove/mail';
    $title = get_string('mail', 'theme_moove');
    $description = get_string('maildesc', 'theme_moove');
    $default = 'Contact@VnResource.vn';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Facebook icon
    $name = 'theme_moove/facebookicon';
    $title = get_string('facebookicon', 'local_newsvnr');
    $description = get_string('facebookicondesc', 'local_newsvnr');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'facebookicon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Facebook url setting.
    $name = 'theme_moove/facebook';
    $title = get_string('facebook', 'theme_moove');
    $description = get_string('facebookdesc', 'theme_moove');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Twitter url setting.
    $name = 'theme_moove/twitter';
    $title = get_string('twitter', 'theme_moove');
    $description = get_string('twitterdesc', 'theme_moove');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Googleplus url setting.
    $name = 'theme_moove/googleplus';
    $title = get_string('googleplus', 'theme_moove');
    $description = get_string('googleplusdesc', 'theme_moove');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Linkdin icon
    $name = 'theme_moove/linkinicon';
    $title = get_string('linkinicon', 'local_newsvnr');
    $description = get_string('linkinicondesc', 'local_newsvnr');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'linkinicon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Linkdin url setting.
    $name = 'theme_moove/linkedin';
    $title = get_string('linkedin', 'theme_moove');
    $description = get_string('linkedindesc', 'theme_moove');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Youtube icon
    $name = 'theme_moove/youtubeicon';
    $title = get_string('youtubeicon', 'local_newsvnr');
    $description = get_string('youtubeicondesc', 'local_newsvnr');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'youtubeicon', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Youtube url setting.
    $name = 'theme_moove/youtube';
    $title = get_string('youtube', 'theme_moove');
    $description = get_string('youtubedesc', 'theme_moove');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Instagram url setting.
    $name = 'theme_moove/instagram';
    $title = get_string('instagram', 'theme_moove');
    $description = get_string('instagramdesc', 'theme_moove');
    $default = '';
    $setting = new admin_setting_configtext($name, $title, $description, $default);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Top footer background image.
    $name = 'theme_moove/topfooterimg';
    $title = get_string('topfooterimg', 'theme_moove');
    $description = get_string('topfooterimgdesc', 'theme_moove');
    $opts = array('accepted_types' => array('.png', '.jpg', '.svg'));
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'topfooterimg', 0, $opts);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Disable bottom footer.
    $name = 'theme_moove/disablebottomfooter';
    $title = get_string('disablebottomfooter', 'theme_moove');
    $description = get_string('disablebottomfooterdesc', 'theme_moove');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $page->add($setting);
    $setting->set_updatedcallback('theme_reset_all_caches');

    $settings->add($page);

    // Forum page.
    $settingpage = new admin_settingpage('theme_moove_forum', get_string('forumsettings', 'theme_moove'));

    $settingpage->add(new admin_setting_heading('theme_moove_forumheading', null,
            format_text(get_string('forumsettingsdesc', 'theme_moove'), FORMAT_MARKDOWN)));

    // Enable custom template.
    $name = 'theme_moove/forumcustomtemplate';
    $title = get_string('forumcustomtemplate', 'theme_moove');
    $description = get_string('forumcustomtemplatedesc', 'theme_moove');
    $default = 0;
    $setting = new admin_setting_configcheckbox($name, $title, $description, $default);
    $settingpage->add($setting);

    // Header setting.
    $name = 'theme_moove/forumhtmlemailheader';
    $title = get_string('forumhtmlemailheader', 'theme_moove');
    $description = get_string('forumhtmlemailheaderdesc', 'theme_moove');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settingpage->add($setting);

    // Footer setting.
    $name = 'theme_moove/forumhtmlemailfooter';
    $title = get_string('forumhtmlemailfooter', 'theme_moove');
    $description = get_string('forumhtmlemailfooterdesc', 'theme_moove');
    $default = '';
    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
    $settingpage->add($setting);

    $settings->add($settingpage);
}
