<?php 
$ADMIN->add('examvnr', new admin_category('exam', new lang_string('exam', 'local_newsvnr')));
if ($hassiteconfig
 or has_capability('local/newsvnr:edit', $systemcontext)) {
	
	$ADMIN->add('exam', new admin_externalpage('createexam', new lang_string('createexam','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/orgmanager.php", array('local/newsvnr:edit')));
	$ADMIN->add('exam', new admin_externalpage('createsubjectexam', new lang_string('createsubjectexam','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/orgmain.php", array('local/newsvnr:edit')));
	$ADMIN->add('exam', new admin_externalpage('listexam', new lang_string('listexam','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/orgcomp_position.php", array('local/newsvnr:edit')));

	$ADMIN->add('exam', new admin_externalpage('listsubjectexam', new lang_string('listsubjectexam','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/orgmain.php", array('local/newsvnr:edit')));	
	$ADMIN->add('examvnr', new admin_externalpage('manageexamreports', new lang_string('manageexamreports','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/orgmain.php", array('local/newsvnr:edit')));
	
}