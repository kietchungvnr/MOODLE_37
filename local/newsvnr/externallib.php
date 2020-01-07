<?php

require_once("$CFG->libdir/externallib.php");

class local_newsvnr_external extends external_api {

    public static function loadingorgposition_parameters() {
        return new external_function_parameters(
            array(
                'orgstructureid' => new external_value(PARAM_INT, 'The orgstructure id'),
                'orgjobtitleid' => new external_value(PARAM_TEXT, 'The orgjobtitle id'),
            )    
        );
    }

    
        
    public static function loadingorgposition($orgstructureid, $orgjobtitleid) {
        global $DB;
        //$params = self::validate_parameters(self::getExample_parameters(), array());
        $params = self::validate_parameters(self::loadingorgposition_parameters(), 
                array(
                        'orgstructureid' => $orgstructureid,
                        'orgjobtitleid'  => $orgjobtitleid
                    ));
        $list_orgjobtitleid =  (explode(",", $params['orgjobtitleid']));
        $str_orgstructureid = $params['orgstructureid'];
        $str_orgjobtitleid = implode(',', $list_orgjobtitleid);
        $sql = "SELECT * FROM {orgstructure_position} WHERE orgstructureid IN($str_orgstructureid) AND jobtitleid IN($str_orgjobtitleid)";
        $result = [];
        $data = $DB->get_records_sql($sql,[]);
        foreach ($data as $value) {
            $result[] = (object)['id' => $value->id, 'name' => $value->name];
        }
              
        return $result;
    }


    private static function loadingorgposition_returns() {
        return new external_single_structure(
            array(
                'id' => new external_value(PARAM_INT, 'The id of the orgposition'),
                'name' => new external_value(PARAM_RAW, 'The name of the orgposition'),
               
            )
        );
    }

    public static function loadsettings_allowed_from_ajax() {
        return true;
    }
    public static function loadsettings_parameters() {
        return new external_function_parameters(
            array(
                   ' id' => new external_value(PARAM_INT, 'The orgposition id'),
                    'name' => new external_value(PARAM_RAW, 'The name orgposition'),
                )   
        );
    }

    public static function loadsettings_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'settings content text'),
                    'firstname' => new external_value(PARAM_RAW, 'jaja text'),
                    'abab' => new external_value(PARAM_RAW, 'huhu text',VALUE_DEFAULT,'tessttttt'),
                )
            )
        );
    }
        
    public static function loadsettings($itemid) {
        global $DB;
        //$params = self::validate_parameters(self::getExample_parameters(), array());
        $params = self::validate_parameters(self::loadsettings_parameters(), 
                array('itemid'=>$itemid));

        $sql = 'SELECT * FROM {user} WHERE id = ?';
        $paramsDB = $params; 
        $db_result = $DB->get_records_sql($sql,$paramsDB);
        
        return $db_result;
    }


    //orgcate moda;
    /**
     * Describes the parameters for submit_create_group_form webservice.
     * @return external_function_parameters
     */
    public static function submit_create_orgcate_form_parameters() {
        return new external_function_parameters(
            array(
                'contextid' => new external_value(PARAM_INT, 'The context id for the course'),
                'jsonformdata' => new external_value(PARAM_RAW, 'The data from the create group form, encoded as a json array')
            )
        );
    }
 
    /**
     * Submit the create group form.
     *
     * @param int $contextid The context id for the course.
     * @param string $jsonformdata The data from the form, encoded as a json array.
     * @return int new group id.
     */
    public static function submit_create_orgcate_form($contextid, $jsonformdata) {
        global $CFG, $USER,$SITE,$DB;
 
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        require_once($CFG->dirroot . '/local/newsvnr/orgcate_form.php');
 
        // We always must pass webservice params through validate_parameters.
        $params = self::validate_parameters(self::submit_create_orgcate_form_parameters(),
                                            ['contextid' => $contextid, 'jsonformdata' => $jsonformdata]);
 
        $context = context::instance_by_id($params['contextid'], MUST_EXIST);
 
        // We always must call validate_context in a webservice.
        self::validate_context($context);
        // require_capability('moodle/course:managegroups', $context);
 
        list($ignored, $course) = get_context_info_array($context->id);
        $serialiseddata = json_decode($params['jsonformdata']);
 
        $data = array();
        parse_str($serialiseddata, $data);
 
        $warnings = array();
 
        
        $orgcate = new stdClass();

 
        // The last param is the ajax submitted data.
        $mform = new orgcate_form(null, array('orgcate' => $orgcate), 'post', '', null, true, $data);
 
        $validateddata = $mform->get_data();
        if ($validateddata) {
            // Do the action.
             $orgcate->name = $validateddata->catename;
             $orgcate->code = $validateddata->catecode;
             $orgcate->description = $validateddata->orgcate_description;

       
             $groupid = insert_orgcategory($orgcate);
        } else {
            // Generate a warning.
            throw new moodle_exception('erroreditgroup', 'group');
        }

        return $groupid;
    }
 
    /**
     * Returns description of method result value.
     *
     * @return external_description
     * @since Moodle 3.0
     */
    public static function submit_create_orgcate_form_returns() {
        return new external_value(PARAM_INT, 'group id');
    }
    //orgposition modal
    public static function submit_create_orgposition_form_parameters() {
        return new external_function_parameters(
            array(
                'contextid' => new external_value(PARAM_INT, 'The context id for the course'),
                'jsonformdata' => new external_value(PARAM_RAW, 'The data from the create group form, encoded as a json array')
            )
        );
    }
 
    /**
     * Submit the create group form.
     *
     * @param int $contextid The context id for the course.
     * @param string $jsonformdata The data from the form, encoded as a json array.
     * @return int new group id.
     */
    public static function submit_create_orgposition_form($contextid, $jsonformdata) {
        global $CFG, $USER,$SITE,$DB;
 
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        require_once($CFG->dirroot . '/local/newsvnr/orgposition_form.php');
 
        // We always must pass webservice params through validate_parameters.
        $params = self::validate_parameters(self::submit_create_orgposition_form_parameters(),
                                            ['contextid' => $contextid, 'jsonformdata' => $jsonformdata]);
 
        $context = context::instance_by_id($params['contextid'], MUST_EXIST);
 
        // We always must call validate_context in a webservice.
        self::validate_context($context);
        // require_capability('moodle/course:managegroups', $context);
 
        list($ignored, $course) = get_context_info_array($context->id);
        $serialiseddata = json_decode($params['jsonformdata']);
 
        $data = array();
        parse_str($serialiseddata, $data);
 
        $warnings = array();
 
        
        $orgposition = new stdClass();

 
        // The last param is the ajax submitted data.
        $mform = new orgposition_form(null, array('orgposition' => $orgposition), 'post', '', null, true, $data);
 
        $validateddata = $mform->get_data();
        if ($validateddata) {
            // Do the action.
            $getorgstructureid = $DB->get_field_sql('SELECT id FROM {orgstructure} WHERE name = ?',array($validateddata->orgstructureid)); 
            $orgposition->name = $validateddata->posname;
            $orgposition->code = $validateddata->poscode;
            $orgposition->namebylaw = $validateddata->position_namebylaw;
            $orgposition->jobtitleid = $validateddata->jobtitleid;
            $orgposition->orgstructureid = $getorgstructureid;
            $orgposition->description = $validateddata->orgposition_description;
            
            $groupid = insert_orgposition($orgposition);
        } else {
            // Generate a warning.
            throw new moodle_exception('erroreditgroup', 'group');
        }

        return $groupid;
    }
 
    /**
     * Returns description of method result value.
     *
     * @return external_description
     * @since Moodle 3.0
     */
    public static function submit_create_orgposition_form_returns() {
        return new external_value(PARAM_INT, 'group id');
    }

    //orgjobtitle modal
    /**
     * Describes the parameters for submit_create_group_form webservice.
     * @return external_function_parameters
     */
    public static function submit_create_orgjobtitle_form_parameters() {
        return new external_function_parameters(
            array(
                'contextid' => new external_value(PARAM_INT, 'The context id for the course'),
                'jsonformdata' => new external_value(PARAM_RAW, 'The data from the create group form, encoded as a json array')
            )
        );
    }
 
    /**
     * Submit the create group form.
     *
     * @param int $contextid The context id for the course.
     * @param string $jsonformdata The data from the form, encoded as a json array.
     * @return int new group id.
     */
    public static function submit_create_orgjobtitle_form($contextid, $jsonformdata) {
        global $CFG, $USER,$SITE,$DB;
 
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        require_once($CFG->dirroot . '/local/newsvnr/orgjobtitle_form.php');
 
        // We always must pass webservice params through validate_parameters.
        $params = self::validate_parameters(self::submit_create_orgjobtitle_form_parameters(),
                                            ['contextid' => $contextid, 'jsonformdata' => $jsonformdata]);
 
        $context = context::instance_by_id($params['contextid'], MUST_EXIST);
 
        // We always must call validate_context in a webservice.
        self::validate_context($context);
        // require_capability('moodle/course:managegroups', $context);
 
        list($ignored, $course) = get_context_info_array($context->id);
        $serialiseddata = json_decode($params['jsonformdata']);
 
        $data = array();
        parse_str($serialiseddata, $data);
 
        $warnings = array();
 
        
        $orgjobtitle = new stdClass();

 
        // The last param is the ajax submitted data.
        $mform = new orgjobtitle_form(null, array('orgjobtitle' => $orgjobtitle), 'post', '', null, true, $data);
 
        $validateddata = $mform->get_data();
        if ($validateddata) {
            // Do the action.
            $orgjobtitle->name = $validateddata->jobtitlename;
            $orgjobtitle->code = $validateddata->jobtitlecode;
            $orgjobtitle->namebylaw = $validateddata->jobtitle_namebylaw;
            $orgjobtitle->jobtitleid = $validateddata->orgjobtitle_description;
       
            $groupid = insert_orgjobtitle($orgjobtitle);
        } else {
            // Generate a warning.
            throw new moodle_exception('erroreditgroup', 'group');
        }

        return $groupid;
    }

    /**
     * Returns description of method result value.
     *
     * @return external_description
     * @since Moodle 3.0
     */
    public static function submit_create_orgjobtitle_form_returns() {
        return new external_value(PARAM_INT, 'group id');
    }

    //orgstructure modal
    /**
     * Describes the parameters for submit_create_group_form webservice.
     * @return external_function_parameters
     */
    public static function submit_create_orgstructure_form_parameters() {
        return new external_function_parameters(
            array(
                'contextid' => new external_value(PARAM_INT, 'The context id for the course'),
                'jsonformdata' => new external_value(PARAM_RAW, 'The data from the create group form, encoded as a json array')
            )
        );
    }
 
    /**
     * Submit the create group form.
     *
     * @param int $contextid The context id for the course.
     * @param string $jsonformdata The data from the form, encoded as a json array.
     * @return int new group id.
     */
    public static function submit_create_orgstructure_form($contextid, $jsonformdata) {
        global $CFG, $USER,$SITE,$DB;
 
        require_once($CFG->dirroot . '/local/newsvnr/lib.php');
        require_once($CFG->dirroot . '/local/newsvnr/orgstructure_form.php');
        
        // We always must pass webservice params through validate_parameters.
        $params = self::validate_parameters(self::submit_create_orgstructure_form_parameters(),
                                            ['contextid' => $contextid, 'jsonformdata' => $jsonformdata]);
 
        $context = context::instance_by_id($params['contextid'], MUST_EXIST);
 
        // We always must call validate_context in a webservice.
        self::validate_context($context);
        // require_capability('moodle/course:managegroups', $context);
 
        list($ignored, $course) = get_context_info_array($context->id);
        $serialiseddata = json_decode($params['jsonformdata']);
 
        $data = array();
        parse_str($serialiseddata, $data);
 
        $warnings = array();
        
        $orgstructure = new stdClass();

 
        // The last param is the ajax submitted data.
        $mform = new orgstructure_form(null, array('orgstructure' => $orgstructure), 'post', '', null, true, $data);
 
        $validateddata = $mform->get_data();
        if ($validateddata) {
            // Do the action.
            $getorgstructureid = $DB->get_field('orgstructure','id',array('name' => $validateddata->parentid));
            $orgstructure->name = $validateddata->orgname;
            $orgstructure->code = $validateddata->orgcode;
            $orgstructure->managerid = $validateddata->managerid;
            $orgstructure->orgstructuretypeid = $validateddata->orgstructuretypeid;
            $orgstructure->parentid = $getorgstructureid;
            $orgstructure->numbermargin = $validateddata->numbermargin;
            $orgstructure->numbercurrent = $validateddata->numbercurrent;
            $orgstructure->description = $validateddata->org_description;
            
            $groupid = insert_orgstructure($orgstructure);
        } else {
            // Generate a warning.
            throw new moodle_exception('erroreditgroup', 'group');
        }

        return $groupid;
    }

    /**
     * Returns description of method result value.
     *
     * @return external_description
     * @since Moodle 3.0
     */
    public static function submit_create_orgstructure_form_returns() {
        return new external_value(PARAM_INT, 'group id');
    }
    
}


