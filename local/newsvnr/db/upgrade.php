<?php
defined('MOODLE_INTERNAL') || die;

function xmldb_local_newsvnr_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager(); // Loads ddl manager and xmldb classes.

    if ($oldversion < 2019032724 ) {
        $table = new xmldb_table('course_setup');
        // Conditionally launch add field completionscorerequired.
        if (!$dbman->field_exists($table, 'visible')) {
            $dbman->add_field(
                $table,
                new xmldb_field('visible', XMLDB_TYPE_INTEGER, '4', null, XMLDB_NOTNULL, null, 1, 'shortname')
            );
        }
        // Main savepoint reached.
        upgrade_plugin_savepoint(true, 2019032724, 'local', 'newsvnr');
    }

    return true;
}