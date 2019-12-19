<?php

defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    'local/newsvnr:edit' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
            // 'supervisor' => CAP_ALLOW
        )
    ),

);

