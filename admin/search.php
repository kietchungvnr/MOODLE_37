<?php

// searches for admin settings

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');

redirect_if_major_upgrade_required();

$query = trim(optional_param('query', '', PARAM_NOTAGS));  // Search string
$adminedit = optional_param('adminedit','',PARAM_INT);
$showall = optional_param('showall', 0, PARAM_BOOL);
$context = context_system::instance();
$PAGE->set_context($context);

$hassiteconfig = has_capability('moodle/site:config', $context);

if ($hassiteconfig && moodle_needs_upgrading()) {
    redirect(new moodle_url('/admin/index.php'));
}

// If site registration needs updating, redirect.
\core\hub\registration::registration_reminder('/admin/search.php');

admin_externalpage_setup('search', '', array('query' => $query)); // now hidden page

// Custom by Vũ: Chức năng ẩn tab trong site administration
$adminroot = admin_get_root_siteadmin(); // need all settings here
$adminroot->search = $query; // So we can reference it in search boxes later in this invocation
$statusmsg = '';
$errormsg  = '';
$focus = '';

// now we'll deal with the case that the admin has submitted the form with changed settings
if ($data = data_submitted() and confirm_sesskey() and isset($data->action) and $data->action == 'save-settings') {
    require_capability('moodle/site:config', $context);
    $count = admin_write_settings($data);
    if (!empty($adminroot->errors)) {
        $errormsg = get_string('errorwithsettings', 'admin');
        $firsterror = reset($adminroot->errors);
        $focus = $firsterror->id;
    } else {
        // No errors. Did we change any setting? If so, then redirect with success.
        if ($count) {
            redirect($PAGE->url, get_string('changessaved'), null, \core\output\notification::NOTIFY_SUCCESS);
        }
        redirect($PAGE->url);
    }
}

// and finally, if we get here, then there are matching settings and we have to print a form
// to modify them
echo $OUTPUT->header($focus);

// Display a warning if site is not registered.
// if (empty($query)) {
//     $adminrenderer = $PAGE->get_renderer('core', 'admin');
//     echo $adminrenderer->warn_if_not_registered();
// }

// echo $OUTPUT->heading(get_string('administrationsite'));

if ($errormsg !== '') {
    echo $OUTPUT->notification($errormsg);

} else if ($statusmsg !== '') {
    echo $OUTPUT->notification($statusmsg, 'notifysuccess');
}

$showsettingslinks = true;

// if ($hassiteconfig) {
//     require_once("admin_settings_search_form.php");
//     $form = new admin_settings_search_form();
//     $form->display();
//     echo '<hr>';
//     if ($query) {
//         echo admin_search_settings_html($query);
//         $showsettingslinks = false;
//     }
// }


$PAGE->requires->js_call_amd('theme_moove/admin_config','init');
if ($showsettingslinks) {
    $node = $PAGE->settingsnav->find('root', navigation_node::TYPE_SITE_ADMIN);
    $stritem = $DB->get_field('config_plugins','value',['name' => 'administrationtab']);
    $listitem = explode(",",$stritem);
    if($adminedit == 1) {
        $node->isedit = true;
        if($stritem != '') {
            foreach ($listitem as $item) {
                $node->find($item, navigation_node::TYPE_SETTING)->show();
            }
        }
    } else {
        $node->isedit = false;
        if($stritem != '') {
            foreach ($listitem as $item) {
                $node->find($item, navigation_node::TYPE_SETTING)->hide();
            }
        }
    }
    // Custom by Vũ: Loại bỏ 1 số chức năng trong quản trị hệ thống
    $theme = theme_config::load('moove');
    if($theme->settings->fullsite == false && $showall != 1) {
        $ignore_node = [
            "registrationmoodleorg", 
            "upgradesettings", 
            "moodleservices", 
            "userfeedback", 
            "optionalsubsystems",
            "usermanagement", 
            "userbulk", 
            "userdefaultpreferences", 
            "profilefields", 
            "tooluploaduserpictures", 
            "userpolicies", 
            "toolunsuproles", 
            "toolcapability", 
            "course_customfield", 
            "tooluploadcourse",
            "coursecolors",
            "calendar",
            "blog",
            "htmlsettings",
            "resetemoticons",
            "documentation",
            "profilepage",
            "coursecontact",
            "ajax",
            "additionalhtml",
            "templates",
            "tool_usertours/tours",
            "systempaths",
            "supportcontact",
            "sessionhandling",
            "stats",
            "http",
            "maintenancemode",
            "cleanup",
            "environment",
            "phpinfo",
            "performance",
            "oauth2",
            "tool_filetypes",
            "server",
            "reports",
            "experimental",
            "profiling",
            "testclient",
            "mnettestclient",
            "thirdpartylibs",
            "toolphpunit",
            "toolbehat",
            "tooltemplatelibrary",
            "toolxmld",
            "toolgeneratorcourse",
            "toolgeneratortestplan",
            "managebackpacks",
            "backpacksettings",
            "themesettings",
            "toollpexportcsv"
        ];
        $ignore_tabnode = [
            "analytics", 
            "license", 
            "location", 
            "ipblocker", 
            "mobileapp", 
            "moodlenet", 
            "privacy", 
            "backups", 
            "activitychooser", 
            "modules", 
            "mnet", 
            "unsupported", 
            "messaging"
        ];
        foreach ($ignore_tabnode as $tabnodename) {
            $node->find($tabnodename, navigation_node::TYPE_SETTING)->hide();
        }
        foreach ($ignore_node as $nodename) {
            $node->find($nodename, navigation_node::TYPE_SETTING)->hide();
        }

    }
    if ($node) {
        echo $OUTPUT->render_from_template('theme_moove/custom_settings_link_page', ['node' => $node]);
    }
}

echo $OUTPUT->footer();
