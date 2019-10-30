<?php 
namespace local_newsvnr\output;

require_once("$CFG->dirroot/webservice/externallib.php");
require_once('lib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;
use context_module;
use DateTime;
use DateTimeZone;
class newsdetail_page implements renderable, templatable {

	   public function export_for_template(renderer_base $output) {
        global $DB,$USER,$PAGE;

        $data = \core_webservice_external::get_site_info();
        $discussionid = optional_param('id',0,PARAM_INT);


        $forumdatacoursenews = get_froums_coursenews_data_id($discussionid);



       	$data['coursedata'] = $forumdatacoursenews;

      
        $discussionid = optional_param('id',0,PARAM_INT);

        $course = get_course_id($discussionid);

        if($course)
        {
          $forumdatalqnews = get_forums_lq_data($course->course_id, $discussionid);
        }
        else{
          $forumdatalqnews = '';
        }

        $data['courselqdata'] = $forumdatalqnews;


        $discus_comment_data = get_comment_from_disccusion($discussionid);

        $data['commentdata'] = $discus_comment_data;
  
        $data['user'] = $USER;

        return $data;
    }
}