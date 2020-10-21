<?php 

namespace local_newsvnr\api\controllers\ebm;

use stdClass;
use local_newsvnr\api\controllers\BaseController as BaseController;

defined('MOODLE_INTERNAL') || die;

class CourseController extends BaseController {

	private $table = 'course';

	public $data;
	public $resp;

	public function __construct($container) {
		global $CFG, $USER;

		parent::__construct($container);
		// \core\session\manager::kill_all_sessions();
		if(isloggedin()) {
            $CFG->sessiontimeout += 7200;
        } else {
            $adminuser = get_complete_user_data('id', 2);
            complete_user_login($adminuser);
        }
   		$this->data = new stdClass;
   		$this->resp = new stdClass;
   		
   	}

   	public function validate() {
        //Khai báo  rules cho validation
        $this->validate = $this->validator->validate($this->request, [
            'fullname' => $this->v::notEmpty()->notBlank(),
            'shortname' => $this->v::notEmpty()->notBlank(),
            // 'startdate' => $this->v::notEmpty()->notBlank(),
            // 'enddate' => $this->v::notEmpty()->notBlank(),
            'categoryname' => $this->v::notEmpty()->notBlank(),
            'categorycode' => $this->v::notEmpty()->notBlank(),
            // 'sectionname' => $this->v::notEmpty()->notBlank(),
            // 'teachercode' => $this->v::notEmpty()->notBlank(),
            // 'pagename' => $this->v::notEmpty()->notBlank(),
            // 'pagecode' => $this->v::notEmpty()->notBlank(),
            // 'pageintro' => $this->v::notEmpty()->notBlank(),
            // 'usercode' => $this->v::notEmpty()->notBlank(),
        ]);
    }

	public function create_and_update($request, $response, $args) {
		global $DB, $CFG;
		require_once("$CFG->dirroot/local/newsvnr/lib.php");
		require_once("$CFG->dirroot/course/lib.php");
		require_once("$CFG->dirroot/mod/page/lib.php");
		require_once("$CFG->dirroot/mod/page/locallib.php");
		$this->validate();
      	if ($this->validate->isValid()) {
	    	$this->data->fullname = $request->getParam('fullname');
		    $this->data->shortname = $request->getParam('shortname');
		    // $this->data->coursesetup = $request->getParam('setupcode');
		    $this->data->categoryname = $request->getParam('categoryname');
		    $this->data->categorycode = $request->getParam('categorycode');
		    $this->data->startdate = $request->getParam('startdate');
		    $this->data->enddate = $request->getParam('enddate');

		    if($request->getParam('startdate') == '') 
		    	$this->data->startdate = time();
		    else
		    	$this->data->startdate = strtotime($request->getParam('startdate'));
		    if($request->getParam('enddate'))
		    	$this->data->enddate = strtotime($request->getParam('enddate'));
		    else 
		    	$this->data->enddate = 0;
		    $this->data->teachercode = $request->getParam('teachercode');
		    $this->data->pagename = $request->getParam('pagename');
		    $this->data->pagecode = $request->getParam('pagecode');
		    $this->data->pageintro = $request->getParam('pageintro');
		    $this->data->sectionname = $request->getParam('sectionname');
		    $this->data->usercode = $request->getParam('usercode');
		    $this->data->idnumber = '';
			$this->data->format = 'topics';
			$this->data->showgrades = 1;
			$this->data->numsections = 0;
			$this->data->newsitems = 10;
			$this->data->visible = 1;
			$this->data->showreports = 1;
			$this->data->summary = '';
			$this->data->summaryformat = FORMAT_HTML;
			$this->data->lang = 'vi';
			$this->data->typeofcourse = 3;
			$this->data->enablecompletion = 1;

	    } else {
        	$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
	    }
		$modarr = [];
		$arrtempb = []; // Lồng array để trả về kiểu dữ liệu là 1 arrya - object 1 : 1
		$courseid = $DB->get_field('course', 'id', ['fullname' => $this->data->fullname, 'shortname' => $this->data->shortname]);
	
		if($courseid) {
			$this->data->id = $courseid;
			$course = $DB->get_record($this->table, ['id' => $courseid]);
			if (!empty($this->data->shortname) && $course->shortname !== $this->data->shortname ) {
	            $this->check_code = $DB->get_record($this->table,['shortname' => $this->data->shortname], 'shortname');
				if($this->check_code) {
					$check_code = $this->check_code->shortname;
					$this->resp->data['code'] = "Mã khoá học'$check_code' đã tồn tại";
				}
	        }
	        if($this->data->categoryname and $this->data->categorycode) {
				$existing = $DB->get_field('course_categories','id',['name' => $this->data->categoryname, 'idnumber' => $this->data->categorycode]);
				if($existing) {
					$this->data->category = $existing;
				} else {
					$categoryname = $this->data->categoryname;
					$this->resp->data['categoryname'] = "Không tìm thấy tên '$categoryname' trong danh mục khoá học ";
				}
			} else {
				$this->resp->data['category'] = "Thiếu 'categoryname' hoặc 'categorycode";
			}
			if(empty($this->resp->data)) {
				
				try {
					update_course($this->data);
					if($course && $this->data->sectionname) {
						$sectionnamearr = explode(',', $this->data->sectionname);
						$pagenamearr = explode(',', $this->data->pagename);
						$pagecodearr = explode(',', $this->data->pagecode);
						$pageintroarr = explode(',', $this->data->pageintro);
						foreach ($sectionnamearr as $key => $sectionname) {
							$sectionname = trim($sectionname);
							$arrtempa = [];
							$modinfo = new stdClass;
							$allmodinfo = get_fast_modinfo($course)->get_section_info_all();
							$allsectionname = [];
							foreach ($allmodinfo as $value) {
								$allsectionname[] = $value->name; 
							}
							if(!in_array($sectionname, $allsectionname)) {
								$section = count($allmodinfo);
							} else {
								$section = array_search($sectionname, $allsectionname);
							}
							course_create_sections_if_missing($course, $section, $sectionname);
							if(trim($pagenamearr[$key]) != 'null') {
								$modinfo->name = trim($pagenamearr[$key]);
							    $modinfo->code = trim($pagecodearr[$key]);
							    $modinfo->modulename = 'page';
							    $modinfo->course = $courseid;
							    $modinfo->section = $section;
							    $modinfo->visible = 1;
							    $modinfo->display = 5;
							    $modinfo->completion = 2;
			        			$modinfo->completionview = 1;
							    $modinfo->printheading = '1';
							    $modinfo->printintro = '0';
							    $modinfo->sectionname = $sectionname;
							    $modinfo->printlastmodified = '1';
							    $modinfo->introeditor = ['text' => '', 'format' => '1', 'itemid' => rand(1, 999999999)];
								$pageid = $DB->get_field('page', 'id', ['course' => $courseid, 'name' => trim($pagenamearr[$key]), 'code' => trim($pagecodearr[$key])]);
								if($pageid) {
									$cm = get_coursemodule_from_instance('page', $pageid);
									$modinfo->id = $pageid;
									$modinfo->revision = 0;
									$modinfo->page = ['text' => $pageintroarr[$key],'format' => '1', 'itemid' => 0];
									$modinfo->coursemodule = $cm->id;
									$modulepage = update_module($modinfo);
								} else {
									// $modinfo->page = ['text' => $this->data->pageintro,'format' => '1', 'itemid' => 0];
									$modinfo->content = $pageintroarr[$key];
									$modinfo->intoformat = 1;
									$modulepage = create_module($modinfo);
								}
								
								$modarr['trackclassid'] = $modulepage->coursemodule;
								$modarr['id'] = trim($pagecodearr[$key]);
							} else {
								$modarr['trackclassid'] = 'null';
								$modarr['id'] = trim($pagecodearr[$key]);
							}
							array_push($arrtempb, $modarr);
							// array_push($arrtempb, $arrtempa);
						}
					}
					
			    	if($this->data->usercode && $this->data->teachercode) {
		    			$studentarr = explode(',', $this->data->usercode);
		    			$teacherarr = explode(',', $this->data->teachercode);
		    			foreach ($studentarr as $student) {
		    				$userid = find_usercode_by_code($student);
							$enrol_user = check_user_in_course($courseid,$userid);
							if(!$enrol_user) {
								enrol_user($userid, $courseid, 'student');
							}
		    			}
		    			foreach ($teacherarr as $teacher) {
							$teacherid = find_usercode_by_code($teacher);
							$enrol_user = check_user_in_course($courseid,$teacherid);
							if(!$enrol_user) {
								enrol_user($teacherid, $courseid, 'editingteacher');
							}
		    			}
		    		}
					$this->resp->error = false;
					$this->resp->message['info'] = "Chỉnh sửa thành công";
					$this->resp->classid = $courseid;
					$this->resp->data[] = $arrtempb;
				} catch (Exception $e) {
					$this->resp->error = true;
					$this->resp->data->message['info'] = "Chỉnh sửa thất bại với lỗi: $e->getMessage()";
				}		
			} else {
				$this->resp->error = true;
			}
		} else {

			if($this->data->categoryname and $this->data->categorycode) {
				$existing = $DB->get_field('course_categories','id',['name' => $this->data->categoryname, 'idnumber' => $this->data->categorycode]);
				if($existing) {
					$this->data->category = $existing;
				} else {
					$categoryname = $this->data->categoryname;
					$this->resp->data['categoryname'] = "Không tìm thấy tên '$categoryname' trong danh mục khoá học ";
				}
			} else {
				$this->resp->data['category'] = "Thiếu 'categoryname' hoặc 'categorycode";
			}

			if (!empty($this->data->shortname)) {
	            $this->check_code = $DB->get_record($this->table,['shortname' => $this->data->shortname], 'shortname');
				if($this->check_code) {
					$check_code = $this->check_code->shortname;
					$this->resp->data['code'] = "Mã khoá học '$check_code' đã tồn tại!";
				}
	        }
	   
			if(empty($this->resp->data)) {
				
				try {
					$course = create_course($this->data);
					if($course && $this->data->sectionname) {
						$sectionnamearr = explode(',', $this->data->sectionname);
						$pagenamearr = explode(',', $this->data->pagename);
						$pagecodearr = explode(',', $this->data->pagecode);
						$pageintroarr = explode(',', $this->data->pageintro);
						foreach ($sectionnamearr as $key => $sectionname) {
							$sectionname = trim($sectionname);
							$arrtempa = [];
							$modinfo = new stdClass;
							$allmodinfo = get_fast_modinfo($course)->get_section_info_all();
							$allsectionname = [];
							foreach ($allmodinfo as $value) {
								$allsectionname[] = $value->name; 
							}
							if(!in_array($sectionname, $allsectionname)) {
								$section = count($allmodinfo);
							} else {
								$section = array_search($sectionname, $allsectionname);
							}
							course_create_sections_if_missing($course, $section, $sectionname);
							if(trim($pagenamearr[$key]) != 'null') {
								$modinfo->name = trim($pagenamearr[$key]);
							    $modinfo->code = trim($pagecodearr[$key]);
							    $modinfo->content = trim($pageintroarr[$key]);
								$modinfo->sectionname = $sectionname;
							    $modinfo->course = $course->id;
							    $modinfo->section = $section;
							    $modinfo->modulename = 'page';
							    $modinfo->visible = 1;
							    $modinfo->display = 5;
							    $modinfo->completion = 2;
		        				$modinfo->completionview = 1;
							    $modinfo->printheading = '1';
								$modinfo->printintro = '0';
							    $modinfo->printlastmodified = '1';
							    $modinfo->introeditor = ['text' => '', 'format' => '1', 'itemid' => 0];
							    $modinfo->contentformat = 1;
								$modinfo->intoformat = 1;

							    $modulepage = create_module($modinfo);
							    
								$modarr['trackclassid'] = $modulepage->coursemodule;
								$modarr['id'] = trim($pagecodearr[$key]);
							} else {
								$modarr['trackclassid'] = 'null';
								$modarr['id'] = trim($pagecodearr[$key]);
							}
							array_push($arrtempb, $modarr);
							// array_push($arrtempb, $arrtempa);
						}
						
					}

			    	if($this->data->usercode && $this->data->teachercode) {
		    			$studentarr = explode(',', $this->data->usercode);
		    			$teacherarr = explode(',', $this->data->teachercode);
		    			foreach ($studentarr as $student) {
		    				$userid = find_usercode_by_code($student);
							$enrol_user = check_user_in_course($course->id,$userid);
							if(!$enrol_user) {
								enrol_user($userid, $course->id, 'student');
							}
		    			}
		    			foreach ($teacherarr as $teacher) {
							$teacherid = find_usercode_by_code($teacher);
							$enrol_user = check_user_in_course($course->id,$teacherid);
							if(!$enrol_user) {
								enrol_user($teacherid, $course->id, 'editingteacher');
							}
		    			}
		    		}
					$this->resp->error = false;
					$this->resp->message['info'] = "Tạo mới thành công";
					$this->resp->classid = $course->id;
					$this->resp->data[] = $arrtempb;
				} catch (Exception $e) {
					$this->resp->error = true;
					$this->resp->data->message['info'] = "Tạo mới thất bại với lỗi: $e->getMessage()";
				}		
			} else {
				$this->resp->error = true;
			}
		}
		
		return $this->response->withStatus(200)->withJson($this->resp);
	}

	/**
	 * API rút tên học viên khỏi khoá học EBM
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $args     [description]
	 * @return [type]           [description]
	 */
	public function unenrol_user($request, $response, $args) {
		global $DB,$CFG;
		require_once($CFG->dirroot . '/enrol/locallib.php');
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'coursecode' => $this->v::notEmpty()->notBlank(),
            // 'orgjobtitlecode' => $this->v::notEmpty()->notBlank(),
            // 'orgstructurecode' => $this->v::notEmpty()->notBlank(),
        ]);

		if($this->validate->isValid()) {
			$this->data->usercode = $request->getParam('usercode');
			$this->data->shortname = $request->getParam('coursecode');
		} else {
			$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
		}
		
		$courseid = $DB->get_field('course', 'id', ['shortname' => $this->data->shortname]);
		if(!$courseid) {
			$this->resp->error = true;
			$this->resp->data['shortname'] = "shortname(Mã khoá học) không tồn tại khoá học";
		}
		
		if(!$DB->record_exists('user',['usercode' => $this->data->usercode])) {
			$this->resp->error = true;
			$this->resp->data['usercode'] = "usercode(Mã học viên) không tồn tại";
		}

		if(empty($this->resp->data)) {
			$usercode = $this->data->usercode;
			$course = $DB->get_record('course', ['shortname' => $this->data->shortname]);
			if(!$course) {
				$this->resp->message['info'] = "Ứng viên với mã '$usercode' chưa tham gia khóa học";
			} else {
				$get_userid = find_usercode_by_code($usercode);
				if($get_userid) {
					$instance = $DB->get_record('enrol', array('courseid'=> $course->id, 'enrol'=>'manual'), '*', MUST_EXIST);
					$get_ueid = find_ueid_by_enrolid($instance->id,$get_userid);
					$plugin = enrol_get_plugin($instance->enrol);
					$plugin->unenrol_user($instance, $get_ueid->userid);
					$this->resp->error = false;
					$this->resp->message['info'] = "Rút ứng viên với mã '$usercode' từ khóa '$course->fullname' thành công";
				}
			}
				
		}
		return $response->withStatus(200)->withJson($this->resp);
	}

	/**
	 * API thêm học viên và giáo viên vào lớp học EBM
	 * @param  [type] $request  [description]
	 * @param  [type] $response [description]
	 * @param  [type] $args     [description]
	 * @return [type]           [description]
	 */
	public function enrol_users($request, $response, $args) {
		global $DB,$CFG;
		require_once($CFG->dirroot . '/enrol/locallib.php');
		$this->validate = $this->validator->validate($this->request, [
            'usercode' => $this->v::notEmpty()->notBlank()->noWhitespace(),
            'coursecode' => $this->v::notEmpty()->notBlank(),
            'typeofuser' => $this->v::notEmpty()->notBlank()
        ]);

		if($this->validate->isValid()) {
			$this->data->usercode = $request->getParam('usercode');
			$this->data->shortname = $request->getParam('coursecode');
			$this->data->typeofuser = $request->getParam('typeofuser');
		} else {
			$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
		}
		$courseid = $DB->get_field('course', 'id', ['shortname' => $this->data->shortname]);
		$usercodearr = explode(',', $this->data->usercode);
		foreach($usercodearr as $key => $usercode) {
			$usercode = trim($usercode);
			if(!$courseid) {
				$this->resp->error = true;
				$this->resp->data['shortname'] = "shortname(Mã khoá học) không tồn tại khoá học";
			}
			
			if(!$DB->record_exists('user',['usercode' => $usercode])) {
				$this->resp->error = true;
				$this->resp->data['usercode'] = "usercode(Mã học viên) không tồn tại";
			}
			if(empty($this->resp->data)) {
				$userid = $DB->get_field('user', 'id', ['usercode' => $usercode]);
				if(!$courseid) {
					$this->resp->message['info'] = "Ứng viên với mã '$usercode' chưa tham gia khóa học";
				} else {
					if($this->data->typeofuser == 'student') {
						$enrol_user = check_user_in_course($courseid, $userid);
						if(!$enrol_user) {
					    	enrol_user($userid, $courseid, 'student');
					    	$this->resp->error = false;
							$this->resp->message['info'] = "Thêm thành công thêm user vào khóa học";
					    } else {
					    	$this->resp->error = false;
					    	$this->resp->message['info'] = "Học viên đã tham gia vào khóa";
					    }
					}
					if($this->data->typeofuser == 'teacher') {
						$enrol_teahcer = check_teacher_in_course($courseid, $teacherid);
						if(!$enrol_teahcer) {
					    	enrol_user($userid, $courseid, 'editingteacher');
					    	$this->resp->error = false;
							$this->resp->message['info'] = "Thêm thành công thêm user vào khóa học";
					    } else {
					    	$this->resp->error = false;
					    	$this->resp->message['info'] = "Giáo viên đã tham gia vào khóa";
					    }
					}
				}
			}
		}
		
		return $response->withStatus(200)->withJson($this->resp);
	}

	public function delete($request, $response, $args) {
		global $DB, $CFG;
		require_once($CFG->dirroot . '/course/lib.php');
		$this->validate = $this->validator->validate($this->request, [
            'coursecode' => $this->v::notEmpty()->notBlank(),
        ]);

		if($this->validate->isValid()) {
			$this->data->shortname = $request->getParam('coursecode');
		} else {
			$errors = $this->validate->getErrors();
        	$this->resp->error = true;
        	$this->resp->data[] = $errors;
	        return $response->withStatus(422)->withJson($this->resp);
		}
		$courses = $DB->get_record('course', ['shortname' => $this->data->shortname], 'id');
		if(!$courses) {
			$this->resp->error = true;
        	$this->resp->data['coursecode'] = 'Mã lớp học không tồn tại';
		}
		if(empty($this->resp->data)) {
			$warnings = array();
	        foreach ($courses as $courseid) {
	            $course = $DB->get_record('course', array('id' => $courseid));

	            if ($course === false) {
	                $warnings[] = array(
	                                'item' => 'course',
	                                'itemid' => $courseid,
	                                'warningcode' => 'unknowncourseidnumber',
	                                'message' => 'Unknown course ID ' . $courseid
	                            );
	                continue;
	            }

	            // Check if the context is valid.
	            // $coursecontext = context_course::instance($course->id);
	            // self::validate_context($coursecontext);

	            // Check if the current user has permission.
	            if (!can_delete_course($courseid)) {
	                $warnings[] = array(
	                                'item' => 'course',
	                                'itemid' => $courseid,
	                                'warningcode' => 'cannotdeletecourse',
	                                'message' => 'You do not have the permission to delete this course' . $courseid
	                            );
	                continue;
	            }

	            if (delete_course($course, false) === false) {
	                $warnings[] = array(
	                                'item' => 'course',
	                                'itemid' => $courseid,
	                                'warningcode' => 'cannotdeletecategorycourse',
	                                'message' => 'Course ' . $courseid . ' failed to be deleted'
	                            );
	                continue;
	            }
	        }

	        fix_course_sortorder();
	        if(empty($warnings)) {
	        	$this->resp->error = false;
	        	$this->resp->message['info'] = "Xóa lớp học thành công";
	        }
		}
        
        return $response->withStatus(200)->withJson($this->resp);
	}
	
}