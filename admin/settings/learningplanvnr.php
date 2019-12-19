<?php 
$ADMIN->add('newsvnr', new admin_category('learningplanvnr', new lang_string('learningplan', 'local_newsvnr')));

if ($hassiteconfig
 or has_capability('local/newsvnr:edit', $systemcontext)) {
	
	$ADMIN->add('learningplanvnr', new admin_externalpage('orgmanager', new lang_string('orgmanagertitle','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/orgcomp_position.php", array('local/newsvnr:edit')));
	$ADMIN->add('learningplanvnr', new admin_externalpage('orgcomp_position', new lang_string('orgcomp_position','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/orgcomp_position.php", array('local/newsvnr:edit')));
	$ADMIN->add('learningplanvnr', new admin_externalpage('orgmain', new lang_string('orgmaintitle','local_newsvnr'), "$CFG->wwwroot/local/newsvnr/orgmain.php", array('local/newsvnr:edit')));
	
}