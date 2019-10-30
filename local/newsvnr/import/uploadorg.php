<?php

require_once(__DIR__ . '/../../../config.php');

require (__DIR__  . '/../../../vendor/autoload.php');

require_once($CFG->libdir.'/csvlib.class.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/admin/tool/uploaduser/locallib.php');
require_once(__DIR__ . '/../lib.php');
require_once('import_form.php');
require_once('tracker.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$iid         = optional_param('iid', '', PARAM_INT);
$tablename   = optional_param('tablename', '', PARAM_TEXT);
$previewrows = optional_param('previewrows', 10, PARAM_INT);

core_php_time_limit::raise(60*60); // 1 hour should be enough
raise_memory_limit(MEMORY_HUGE);

admin_externalpage_setup('tooluploadorgstruture');
require_capability('moodle/site:uploadusers', context_system::instance());


$strorgstructurename = get_string('orgstructurename', 'local_newsvnr');
$strname = get_string('name', 'local_newsvnr');
$strcode = get_string('code', 'local_newsvnr');
$strdescription = get_string('description', 'local_newsvnr');
$strcatename = get_string('catename', 'local_newsvnr');
$strposname = get_string('posname', 'local_newsvnr');
$strjobtitlename = get_string('jobtitlename', 'local_newsvnr');
$strnamebylaw = get_string('namebylaw', 'local_newsvnr');
$strparentname = get_string('parentid', 'local_newsvnr');
$strnumbermargin = get_string('numbermargin', 'local_newsvnr');
$strnumbercurrent = get_string('numbercurrent', 'local_newsvnr');
$strmessage = get_string('errordataimport', 'local_newsvnr'); 

// array of all valid fields for validation
$STD_FIELDS = array('id', 'name', 'code','jobtitlename','orgstructurename','parentname','managername','numbercurrent','numbermargin','namebylaw','description','visible');

$PRF_FIELDS = array();

$url = new moodle_url('/local/newsvnr/import/uploadorg.php');
$urlvalidation = new moodle_url('/local/newsvnr/import/uploadorgvalidation.php');
$returnurl = new moodle_url('/local/newsvnr/import/uploadorg.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);

if ($proffields = $DB->get_records('user_info_field')) {
    foreach ($proffields as $key => $proffield) {
        $profilefieldname = 'profile_field_'.$proffield->shortname;
        $PRF_FIELDS[] = $profilefieldname;
        // Re-index $proffields with key as shortname. This will be
        // used while checking if profile data is key and needs to be converted (eg. menu profile field)
        $proffields[$profilefieldname] = $proffield;
        unset($proffields[$key]);
    }
}

if (empty($iid)) {
    $import_form = new import_form();

    if ($formdata = $import_form->get_data()) {
        $iid = csv_import_reader::get_new_iid('uploadorrg');
        $cir = new csv_import_reader($iid, 'uploadorrg');

        $content = $import_form->get_file_content('orgfile');

        $readcount = $cir->load_csv_content($content, $formdata->encoding, $formdata->delimiter_name);
        $csvloaderror = $cir->get_error();
        unset($content);

        $tablename = $formdata->tablename;

        if (!is_null($csvloaderror)) {
            print_error('csvloaderror', '', $returnurl, $csvloaderror);
        }
        // test if columns ok
        $filecolumns = uu_validate_user_upload_columns($cir, $STD_FIELDS, $PRF_FIELDS, $returnurl);
        // continue to form2

    } else {
        echo $OUTPUT->header();

        echo $OUTPUT->heading_with_help(get_string('orgimport', 'local_newsvnr'), 'orgimport', 'local_newsvnr');

        $import_form->display();
        echo $OUTPUT->footer();
        die;
    }
} else {
    $cir = new csv_import_reader($iid, 'uploadorrg');
    $filecolumns = uu_validate_user_upload_columns($cir, $STD_FIELDS, $PRF_FIELDS, $returnurl);

}

$mform2 = new confirm_import_form(null, array('columns'=>$filecolumns, 'data'=>array('iid'=>$iid, 'previewrows'=>$previewrows,'tablename' => $tablename)));
if($formdata = $mform2->is_cancelled()) {
    $cir->cleanup(true);
    redirect($returnurl);
} else if($formdata = $mform2->get_data()) {
    echo $OUTPUT->header();
    $cir->init();
    $linenum = 1; //column header is first line
    // var_dump($formdata);die;
    $validation = array();
    while ($line = $cir->next()) {
        $linenum++;
        $orgcate = new stdClass();
        foreach ($line as $keynum => $value) {
            if (!isset($filecolumns[$keynum])) {
                // this should not happen
                continue;
            }
            $key = $filecolumns[$keynum];
            if (strpos($key, 'profile_field_') === 0) {
                //NOTE: bloody mega hack alert!!
                if (isset($USER->$key) and is_array($USER->$key)) {
                    // this must be some hacky field that is abusing arrays to store content and format
                    $orgcate->$key = array();
                    $orgcate->{$key['text']}   = $value;
                    $orgcate->{$key['format']} = FORMAT_MOODLE;
                } else {
                    $orgcate->$key = trim($value);
                }
            } else {
                $orgcate->$key = trim($value);
            }
        }
    }
    if(isset($orgcate->orgstructurename)) {
        $orgstructureid = $DB->get_field_select('orgstructure','id','name = :name',['name' => $orgcate->orgstructurename]);
        if($orgstructureid) {
            $orgcate->orgstructureid = $orgstructureid;   
        }        
    }
    if(isset($orgcate->jobtitlename)) {
        $jobtitleid = $DB->get_field_select('orgstructure_jobtitle','id','name = :name',['name' => $orgcate->jobtitlename]);
        if($jobtitleid) {
            $orgcate->jobtitleid = $jobtitleid;   
        } 
    }
    $DB->insert_record($formdata->tablename,$orgcate);
    $cir->close();
    $cir->cleanup(true);
    $strsuccess = get_string('successimport', 'local_newsvnr');
    \core\notification::add($strsuccess,'NOTIFY_SUCCESS');
    echo $OUTPUT->continue_button($returnurl);
    echo $OUTPUT->footer();
    die;
}

echo $OUTPUT->header();
if($tablename) {
    $strheading = get_string($tablename.'_import','local_newsvnr');
    echo $OUTPUT->heading($strheading);    
}

// NOTE: this is JUST csv processing preview, we must not prevent import from here if there is something in the file!!
//       this was intended for validation of csv formatting and encoding, not filtering the data!!!!
//       we definitely must not process the whole file!

// preview table data
$data = array();
$cir->init();
$linenum = 1; //column header is first line
$noerror = true; // Keep status of any error.
while ($linenum <= $previewrows and $fields = $cir->next()) {
    $linenum++;
    $orgcate = array();
    $orgcate['line'] = $linenum;
    foreach($fields as $key => $field) {
        $orgcate[$filecolumns[$key]] = s(trim($field));
    }

    // insert_orgcategory($orgcate);
    $orgcate['status'] = array();
    if($tablename) {
        if (isset($orgcate['name'])) {
            if($DB->record_exists_select($tablename,'name = :name',['name' => $orgcate['name']])) {
            	$orgcate['status'][] = get_string('duplicatenameimport','local_newsvnr',format_string($orgcate['name']));	
            }
        } else {
            $orgcate['status'][] = get_string('missingname','local_newsvnr');
        }

        if (isset($orgcate['code'])) {
            if($DB->record_exists_select($tablename,'code = :code',['code' => $orgcate['code']])) {
            	$orgcate['status'][] = get_string('duplicatecodeimport','local_newsvnr',format_string($orgcate['code']));	
            }
        } else {
            $orgcate['status'][] = get_string('missingcode','local_newsvnr');
        }

        if(isset($orgcate['orgstructurename'])) {
        	$orgstructureid = $DB->get_field_select('orgstructure','id','name = :name',['name' => $orgcate['orgstructurename']]);
        	if(!$orgstructureid) {
        		$orgcate['status'][] = get_string('notfoundorgstructure', 'local_newsvnr',format_string($orgcate['orgstructurename']));
        	}
        }
        if(isset($orgcate['jobtitlename'])) {
        	$jobtitleid = $DB->get_field_select('orgstructure_jobtitle','id','name = :name',['name' => $orgcate['jobtitlename']]);
        	if(!$jobtitleid) {
        		$orgcate['status'][] = get_string('notfoundorgjobtitle', 'local_newsvnr',format_string($orgcate['jobtitlename']));
        	}
        }
    }
    $orgcate['status'] = implode(', <br />', $orgcate['status']);
    if($orgcate['status'] == NULL) {
    	$noerror = true;
    } else {
    	$noerror = false;
    }
    
    $data[] = $orgcate;
}
if ($fields = $cir->next()) {
    $data[] = array_fill(0, count($fields) + 2, '...');
}
$cir->close();
if($noerror == false) {
	\core\notification::add($strmessage, 'NOTIFY_WARNING');

}

//Xuất file ra những record bị lỗi
$rowserror = [];
foreach ($data as $value) {
    if($value['status'] != '') {
        unset($value['line']);
        $rowserror[] = $value;
    }
}

if($rowserror && $filecolumns) {
    array_push($filecolumns, 'status');
    file_put_contents('org_rowerror_data.json', json_encode($rowserror,JSON_UNESCAPED_UNICODE));
    file_put_contents('org_rowerror_header.json', json_encode($filecolumns,JSON_UNESCAPED_UNICODE));
}

$table = new html_table();
$table->id = "uupreview";
$table->attributes['class'] = 'generaltable';
$table->tablealign = 'center';
$table->summary = get_string('uploadorgpreview', 'local_newsvnr');
$table->head = array();
$table->data = $data;

$table->head[] = get_string('uucsvline', 'local_newsvnr');
foreach ($filecolumns as $column) {
    $table->head[] = $column;
}
// $table->head[] = get_string('status');

echo html_writer::tag('div', html_writer::table($table), array('class'=>'flexible-wrap'));
if($noerror) {
	$mform2->display();
} else {
    echo html_writer::start_tag('div',['class' => 'row d-flex justify-content-center']);
    $button2 = new single_button($urlvalidation, get_string('orgvalidation','local_newsvnr'), 'get', true);
    echo $OUTPUT->render($button2);
    $button1 = new single_button($url, get_string('reimport','local_newsvnr'), 'get', true);
    echo $OUTPUT->render($button1);
    echo html_writer::end_tag('div');
}

echo $OUTPUT->footer();
die;