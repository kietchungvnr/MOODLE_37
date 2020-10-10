<?php 
defined('MOODLE_INTERNAL') || die;

$ADMIN->add('accounts', new admin_externalpage('tooluploadorgstruture', get_string('orgimport', 'local_newsvnr'), "$CFG->wwwroot/local/newsvnr/import/uploadorg.php", 'moodle/site:uploadusers'));
// $ADMIN->add('appearance', new admin_externalpage('studentdashboard', get_string('studentdb', 'local_newsvnr'), "$CFG->wwwroot/local/newsvnr/student_indexsys.php", 'moodle/site:uploadusers'));
// $ADMIN->add('appearance', new admin_externalpage('teacherdashboard', get_string('teacherdb', 'local_newsvnr'), "$CFG->wwwroot/local/newsvnr/teacher_indexsys.php", 'moodle/site:uploadusers'));
$systemcontext = context_system::instance();
if ($hassiteconfig or has_capability('moodle/course:view', $systemcontext)) {
    $ADMIN->add('courses', new admin_externalpage('questionbankvnr', get_string('questionbank_title','local_newsvnr'), "$CFG->wwwroot/question/edit.php?courseid=1", 'moodle/course:view'));
    $ADMIN->add('courses', new admin_externalpage('coursesetupvnr', get_string('coursesetup','local_newsvnr'), "$CFG->wwwroot/course/coursesetup_management.php"));
    $ADMIN->add('development', new admin_externalpage('managermentapivnr', get_string('managermentapi','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/api_managerment.php"));
    $ADMIN->add('development', new admin_externalpage('managermentapivnrlist', get_string('managermentapi_list','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/api_managermentlist.php"));
}