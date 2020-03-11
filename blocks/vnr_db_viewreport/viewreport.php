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
$dashboardurl = new moodle_url('/my/index.php');
$strviewreport = get_string('detailreport', 'block_vnr_db_viewreport');
$PAGE->set_context($context);
$PAGE->set_url($baseurl);
$PAGE->set_pagelayout('standard');
$PAGE->set_title($strviewreport);
$PAGE->set_heading($strviewreport);
$PAGE->navbar->ignore_active();
$PAGE->navbar->add(get_string('dashboard', 'block_vnr_db_viewreport'),$dashboardurl);
$PAGE->navbar->add($strviewreport);
$output = $PAGE->get_renderer('block_vnr_db_viewreport');
$page = new \block_vnr_db_viewreport\output\viewreport_page();
echo $output->header();

echo $output->render($page);

echo $output->footer();