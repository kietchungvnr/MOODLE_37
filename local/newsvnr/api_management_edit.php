<?php
// This file is part of Moodle - http://moodle.org/
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
 * Version details
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package local_newsvnr
 * @copyright 2019 VnResource
 * @author   Le Thanh Vu
 **/

require_once(__DIR__ . '/../../config.php');
require_once('lib.php');
require_once('api_management_edit_form.php');
require_login();
$id = optional_param('id',0,PARAM_INT);
$orgmanagertitle = get_string('api_management_title','local_newsvnr');
$strupdate = get_string('api_management_update', 'local_newsvnr');
$title = get_string('api_management_edit','local_newsvnr');
$params = [];
if($id){
  $params['id'] = $id;
}


$url = new moodle_url('/local/newsvnr/api_management_edit.php',$params);
$orgmanagerurl = new moodle_url('/local/newsvnr/api_managerment.php');


    $heading = get_string('api_management_edit','local_newsvnr');

    $api_db = $DB->get_records('local_newsvnr_api',array('id'=>$id));
    $apidetail_db = $DB->get_records('local_newsvnr_api_detail',array('api_id'=>$id));
    $apiheader_db = $DB->get_records('local_newsvnr_api_header',array('api_id'=>$id));
    // echo '<pre>';
    // print_r($api_db);
    // print_r($apiheader_db);
    // print_r($apidetail_db);
    // die();
    $arr_apiheader = [];
    $arr_apidetail = [];
    $api = new stdClass();
    foreach($api_db as $value){
        
        $api->id = $value->id;
        $api->url = $value->url;
        $api->method = $value->method;
        $api->functionapi = $value->functionapi;
        $api->contenttype = $value->contenttype;
        $api->description = $value->description;
        
    }
    foreach(array_values($apidetail_db) as $key => $value){
        $apidetail = new stdClass();
        $client_params = 'client_params_'.$key;
        $server_params = 'server_params_'.$key;
        $default_value = 'default_value_'.$key;
        $id = 'id_detail_'.$key;
        $apidetail->$client_params = $value->client_params;
        $apidetail->$server_params = $value->server_params;
        $apidetail->$default_value = $value->default_value;
        $apidetail->$id = $value->id;
        $arr_apidetail[] = $apidetail;
    }
    foreach(array_values($apiheader_db) as $key => $value){
        $apiheader = new stdClass();
        $name1 = 'name_'.$key;
        $value1 = 'value_'.$key;
        $id = 'id_header_'.$key;
        $apiheader->$name1 = $value->name;
        $apiheader->$value1 = $value->value;
        $apiheader->$id = $value->id;
        $arr_apiheader[] = $apiheader;
    }
    

$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_heading($heading);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add($orgmanagertitle,$orgmanagerurl);
$PAGE->navbar->add($title);
$mform_edit = new api_management_edit_form(null,array('orgcate' => $api , 'apiheader' => $arr_apiheader , 'apititle' =>
  $arr_apidetail));


if ($mform_edit->is_cancelled()){ 
      redirect($orgmanagerurl);
} else if ($data = $mform_edit->get_data()) {

      $orgcateupdate = (object)array('id' => $data->id, 'url' => $data->url, 'method' => $data->method, 'functionapi' =>$data->functionapi,'contenttype' =>$data->contenttype, 'description' => $data->description );

      foreach ($arr_apiheader as $key => $value) {
        $name = 'name_'.$key;
        $value = 'value_'.$key;
        $id = 'id_header_'.$key;
        $apiheaderupdate = (object)array('id' =>$data-> $id , 'name' => $data->$name, 'value' => $data->$value );
        $DB->update_record('local_newsvnr_api_header',$apiheaderupdate);
      }

      foreach ($arr_apidetail as $key => $value) {
        $client_params = 'client_params_'.$key;
        $server_params = 'server_params_'.$key;
        $default_value = 'default_value_'.$key;
        $id = 'id_detail_'.$key;
        $apititleupdate = (object)array('id' => $data->$id , 'client_params' => $data->$client_params, 'server_params' => $data->$server_params,'default_value' => $data->$default_value );
        $DB->update_record('local_newsvnr_api_detail',$apititleupdate);
      }
      if (isset($data->submitbutton) ) {
          $message = $strupdate;
      }
      if (isset($message)) {
          $DB->update_record('local_newsvnr_api',$orgcateupdate);
          redirect($url, $message);
      }

}
// echo('<pre>');
// print_r($arr_apidetail);die();
echo $OUTPUT->header();



echo $mform_edit->display();


echo $OUTPUT->footer();

