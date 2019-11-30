<?php 
defined('MOODLE_INTERNAL') || die;

$ADMIN->add('accounts', new admin_externalpage('tooluploadorgstruture', get_string('orgimport', 'local_newsvnr'), "$CFG->wwwroot/local/newsvnr/import/uploadorg.php", 'moodle/site:uploadusers'));

if ($hassiteconfig) {
    $ADMIN->add('courses', new admin_externalpage('questionbankvnr', get_string('questionbank_title','local_newsvnr'), "$CFG->wwwroot/question/edit.php?courseid=1"));
    $ADMIN->add('courses', new admin_externalpage('coursesetupvnr', get_string('coursesetup','local_newsvnr'), "$CFG->wwwroot/course/coursesetup.php"));
}