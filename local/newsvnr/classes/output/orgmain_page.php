<?php 
namespace local_newsvnr\output;
defined('MOODLE_INTERNAL') || die();

require_once("$CFG->dirroot/webservice/externallib.php");

require_once('lib.php');
require_once("$CFG->libdir/enrollib.php");
require_once('orgstructure_form.php');
require_once($CFG->libdir . '/completionlib.php');
require_once($CFG->libdir . '/enrollib.php');
require_once($CFG->dirroot . '/mod/forum/lib.php');
use renderable;
use templatable;
use renderer_base;
use stdClass;
use context_module;
use context_course;
use context_system;
use core_competency\api;
class orgmain_page implements renderable, templatable {

	public function export_for_template(renderer_base $output) {
    global $DB,$USER,$PAGE;
    $data = array();
    // $courses = $DB->get_records_sql("SELECT * from {course} where required = 1");
    // var_dump($courses);die;

    // $courses = api::list_courses_using_competency(29);
    // foreach ($courses as $key => $value) {
    //    var_dump($value->id);die;  
    // }

   

//      $context =  context_course::instance(150);
// $roles = get_user_roles($context, $USER->id, true);
// $role = key($roles);
// $roleid = $roles[$role]->roleid;
// var_dump($roles);die;
    // $course = enrol_get_my_courses();
    // $course2 = enrol_get_users_courses(268);
    // $context = \context_course::instance(150);
    // $a = count_enrolled_users($context);


    // $srt_courseid = get_listcourse_by_teacher(268);
    // $sql = "SELECT q.id,q.course, AVG(qg.grade) AS gradesorce,q.name FROM mdl_quiz q JOIN mdl_quiz_grades qg ON q.id = qg.quiz 
    //           WHERE q.course IN($srt_courseid) 
    //           GROUP BY q.course,q.name,q.id";
    // $record = $DB->get_records_sql($sql,[]);
    // $list_coursename = array();
    //     $list_quizname = array();
    //     $list_quizscore = array();
    // foreach ($record as $value) {
    //         $list_quizname[] = $value->name;
    //         $list_quizscore[] = (float)$value->gradesorce;
    // }
    // $response = new stdClass();
    // // $response->list_coursename = $list_coursename;
    // $response->list_quizname = $list_quizname;
    // $response->list_quizscore = $list_quizscore;


    // var_dump($a);die;
		// $completion = new \completion_info($DB->get_record('course',['id' => 150]));
		// if ($completion->is_course_complete(268)) {
		//            $a = 1;
  //       }
  //       var_dump($completion->is_course_complete(303));die;
  //       
 		


    // 	$sql = '
				// SELECT c.id, c.fullname
			 //        from mdl_role_assignments as ra
			 //        join mdl_user as u on u.id = ra.userid
			 //        join mdl_user_enrolments as ue on ue.userid = u.id
			 //        join mdl_enrol as e on e.id = ue.enrolid
			 //        join mdl_course as c on c.id = e.courseid
			 //        join mdl_context as ct on ct.id = ra.contextid and ct.instanceid = c.id
			 //        join mdl_role as r on r.id = ra.roleid
    //    			WHERE  ra.roleid=3 and u.id = ?';
    //    	$sql_compcourse = '
    //    			SELECT COUNT(*) AS completed_courses
				// FROM mdl_course_completions
				// WHERE course = ? and timecompleted IS NOT NULL';
    //    	$record = $DB->get_records_sql($sql,[268]);
    //    	$list_coursename = array();
    //    	$list_enroll = array();
    //    	$list_completion_course = array();
    //    	foreach ($record as $value) {
    //    		$coursecontext = context_course::instance($value->id, IGNORE_MISSING);
    //    		$list_coursename[] = $value->fullname;
    //    		$list_enroll[] = count_enrolled_users($coursecontext);
    //    		$list_cc_data = $DB->get_record_sql($sql_compcourse,[$value->id]);
    //    		$list_completion_course[] = $list_cc_data->completed_courses;
    //    	}

    //    	$data = new stdClass();
    //    	$data->list_coursename = (object)$list_coursename;
    //    	$data->list_enroll = (object)$list_enroll;
    //    	$data->list_completion_course = (object)$list_completion_course;
        
    
    //     var_dump(json_encode($data,JSON_UNESCAPED_UNICODE));die;

    return $data;
  }


}