<?php


namespace local_newsvnr\output;

require_once("$CFG->dirroot/webservice/externallib.php");

// require_once('lib.php');

use renderable;
use templatable;
use renderer_base;
use stdClass;
use context_module;
use DateTime;
use DateTimeZone;
use theme_moove\util\theme_settings;

class api_managerment implements renderable, templatable 
{

  public function export_for_template(renderer_base $output) 
  {
    global $DB,$USER,$PAGE,$CFG;

   
  }


  // convert time 
  static function convertunixtime($format="r", $timestamp=false, $timezone=false){
      $userTimezone = new DateTimeZone(!empty($timezone) ? $timezone : 'GMT');
      $gmtTimezone = new DateTimeZone('GMT');
      $myDateTime = new DateTime(($timestamp!=false?date("r",(int)$timestamp):date("r")), $gmtTimezone);
      $offset = $userTimezone->getOffset($myDateTime);
      return date($format, ($timestamp!=false?(int)$timestamp:$myDateTime->format('U')) + $offset);
  }

}




