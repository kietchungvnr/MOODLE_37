<?php

require_once(__DIR__ . '/../../config.php');
// $section  = required_param('section',PARAM_RAW);
$id = required_param('id',PARAM_RAW);

require_login();

$context = context_system::instance();
$params = [];
if($id){
  $params['id'] = $id;
}
// $CFG->jsrev = -1;
$baseurl = new moodle_url('/blocks/vnr_db_viewreport/viewreport.php',$params);
$strviewreport = "Trang quản lý báo cáo";
$PAGE->set_context($context);
$PAGE->set_url($baseurl);
$PAGE->set_pagelayout('standard');
$PAGE->set_title($strviewreport);
$PAGE->set_heading($strviewreport);

$output = $PAGE->get_renderer('block_vnr_db_viewreport');
$page = new \block_vnr_db_viewreport\output\viewreport_page();
echo $output->header();

echo $output->render($page);

echo $output->footer();