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
 * lấy dữ liệu cho chart trong dashboard student 
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package local_newsvnr
 * @copyright 2020 VnResource
 * @author   Le Thanh Vu
 **/

define('AJAX_SCRIPT', false);

require_once __DIR__ . '/../../../../config.php';
require_once $CFG->dirroot . '/local/newsvnr/lib.php';
require_login();
$PAGE->set_context(context_system::instance());
$action = optional_param('action', null, PARAM_RAW);
$response     = new stdClass;


switch ($action) {
	case 'quiz_chart':
		$sql = "SELECT ROW_NUMBER() OVER (ORDER BY q.id) AS RowNum, q.id quizid, q.course, c.fullname coursename, q.name quizname, CONVERT(DECIMAL(10,2),qg.grade) grade
				FROM mdl_quiz q 
					LEFT JOIN mdl_quiz_grades qg ON q.id = qg.quiz 
					LEFT JOIN mdl_course c ON q.course = c.id
				WHERE qg.userid = :userid";
		$data = $DB->get_records_sql($sql, ['userid' => 276]);
		$coursenames = [];
		$grades = [];
		$attemptarr = [];
		$lowestgrades = [];
		$temp_coursename = -1;

		foreach ($data as $key => $value) {
			$grademin = -1;
			if($temp_coursename == -1) {
				$coursenames[] = trim($value->coursename);
				$temp_coursename = 0;
			}
			if($coursenames) {
				foreach($coursenames as $keycoursename => $coursename) {
					if($coursename === trim($value->coursename)) {
						continue;
					}
					
				}
			}
			
			$gradeobj = new stdClass;
			$gradeobj->name = $value->quizname;
			$gradeobj->y = (int)$value->grade;
			// $gradeobj->drilldown = $value->coursename;
			$grades[] = $gradeobj;
			$gradeattempts = new stdClass;
			$gradeattempts->name = $value->quizname;
			$gradeattempts->id = $value->quizname;
			$attempts = $DB->get_records('quiz_attempts', ['quiz' => $value->quizid, 'state' => 'finished', 'userid' => 276]);
			foreach($attempts as $attempt) {
				$temp_attemptarr = [];
				if($grademin == -1) {
					$grademin = round($attempt->sumgrades, 2);
				}
				if(round($attempt->sumgrades, 2) < $grademin) {
					$grademin = round($attempt->sumgrades, 2);
				}
				$temp_attemptarr[] = $attempt->attempt; 
				$temp_attemptarr[] = round($attempt->sumgrades, 2);
				$attemptarr[] = $temp_attemptarr;
			}
			$lowestgrades[] = $grademin;
		}
		$response->coursenames = $coursenames;
		$response->grades = $grades;
		$response->attemptarr = $attemptarr;
		$response->lowestgrades = $lowestgrades;
		break;
	
	default:
		# code...
		break;
}
echo json_encode($response,JSON_UNESCAPED_UNICODE);
die;