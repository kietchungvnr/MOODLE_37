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

define('AJAX_SCRIPT', false);

require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/../lib.php');
use core_competency\course_competency;
use core_competency\api;
use core_competency\user_competency;
use core_competency\external\competency_exporter;
use core_competency\external\user_competency_exporter;
use core_user\external\user_summary_exporter;
require_login();
$section  = required_param('section',PARAM_ALPHANUMEXT);
$modalsection = optional_param('modalsection','',PARAM_RAW);
$orgstructureid = optional_param('orgstructureid',0,PARAM_INT);
$usercode = optional_param('usercode','',PARAM_RAW);

$params = [];
if($section){
	$params['section'] = $section;
}
if($modalsection){
	$params['modalsection'] = $modalsection;
}
if($orgstructureid) {
	$params['orgstructureid'] = $orgstructureid;
}

$url = new moodle_url('/local/newsvnr/ajax/orgdata.php',$params);
$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());

$objdata = new stdclass();
$strdata = '';


switch ($section) {
	case 'orgcate_list':
	$get_list = $DB->get_records('orgstructure_category');
	foreach ($get_list as $value) {
		$buttons = array();
		if($value->visible == 1) {
			$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/hide', get_string('hide')),
			array('title' => get_string('hide'),'id' => $value->id, 'class' => 'hide-item','data-active' => 'orgcate_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',0)'));	
		} else {
			$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/show', get_string('show')),
			array('title' => get_string('show'),'id' => $value->id, 'class' => 'show-item','data-active' => 'orgcate_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',1)'));	
		}
		$buttons[] = html_writer::link(new moodle_url('/local/newsvnr/orgcate.php',array('id' => $value->id)),
			$OUTPUT->pix_icon('t/edit', get_string('edit')),
			array('title' => get_string('edit')));
		$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/delete', get_string('delete')),
			array('title' => get_string('delete'),'id' => $value->id, 'class' => 'delete-item','data-section' => 'orgcate','id' => $value->id,'onclick' => 'org_delete('.$value->id.')'));
		$showbuttons = implode(' ', $buttons);
		$strdata .='<tr>';
		$strdata .='<td>'.$value->name.'</td><td>'.$value->code.'</td><td>'.$value->description.'</td><td>'.$showbuttons.'</td>';
		$strdata .='</tr>';
	}
	$objdata->header = '<table class="display hover order-column table table-bordered table-striped nowrap" cellspacing="0" width="100%" id="org_datatable"><thead><tr><th>Tên loại phòng ban</th><th>Mã loại phòng ban</th><th>Mô tả</th><th>Chức năng</th></tr></thead><tbody>'.$strdata.'</tbody></table>';
	break;
	case 'orgjobtitle_list':
	$get_list = $DB->get_records('orgstructure_jobtitle');
	foreach ($get_list as $value) {
		$buttons = array();
		if($value->visible == 1) {
			$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/hide', get_string('hide')),
			array('title' => get_string('hide'),'id' => $value->id, 'class' => 'hide-item','data-active' => 'orgjobtitle_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',0)'));	
		} else {
			$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/show', get_string('show')),
			array('title' => get_string('show'),'id' => $value->id, 'class' => 'show-item','data-active' => 'orgjobtitle_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',1)'));	
		}
		$buttons[] = html_writer::link(new moodle_url('/local/newsvnr/orgjobtitle.php',array('id' => $value->id)),
			$OUTPUT->pix_icon('t/edit', get_string('edit')),
			array('title' => get_string('edit')));
		$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/delete', get_string('delete')),
			array('title' => get_string('delete'),'id' => $value->id, 'class' => 'delete-item','data-section' => 'orgjobtitle','id' => $value->id,'onclick' => 'org_delete('.$value->id.')'));
		$showbuttons = implode(' ', $buttons);
		$strdata .='<tr>';
		$strdata .='<td>'.$value->name.'</td><td>'.$value->code.'</td><td>'.$value->namebylaw.'</td><td>'.$value->description.'</td><td>'.$showbuttons.'</td>';
		$strdata .='</tr>';
	}
	$objdata->header = '<table class="display hover order-column table table-bordered table-striped nowrap" cellspacing="0" width="100%" id="org_datatable"><thead><tr><th>Tên chức danh</th><th>Mã chức danh</th><th>Tên theo pháp luật</th><th>Mô tả</th><th>Chức năng</th></tr></thead><tbody>'.$strdata.'</tbody></table>';
	break;
	case 'orgposition_list':
	$get_list = $DB->get_records('orgstructure_position');
	foreach ($get_list as $value) {
		$buttons = array();
		if($value->visible == 1) {
			$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/hide', get_string('hide')),
			array('title' => get_string('hide'),'id' => $value->id, 'class' => 'hide-item','data-active' => 'orgposition_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',0)'));	
		} else {
			$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/show', get_string('show')),
			array('title' => get_string('show'),'id' => $value->id, 'class' => 'show-item','data-active' => 'orgposition_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',1)'));	
		}
		$buttons[] = html_writer::link(new moodle_url('/local/newsvnr/orgposition.php',array('id' => $value->id)),
			$OUTPUT->pix_icon('t/edit', get_string('edit')),
			array('title' => get_string('edit')));
		$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/delete', get_string('delete')),
			array('title' => get_string('delete'),'id' => $value->id, 'class' => 'delete-item','data-section' => 'orgposition','id' => $value->id,'onclick' => 'org_delete('.$value->id.')'));
		$showbuttons = implode(' ', $buttons);
		if($value->jobtitleid) {
			$orgjobtitlename = get_name_orgjobtitleid($value->jobtitleid);
		} else {
			$orgjobtitlename = "";
		}
		if($value->orgstructureid) {
			$orgstructurename = get_name_orgstructureid($value->orgstructureid);
		} else {
			$orgstructurename = "";
		}
		$strdata .='<tr>';
		$strdata .='<td>'.$value->name.'</td><td>'.$value->code.'</td><td>'.$value->namebylaw.'</td><td>'.$orgjobtitlename.'</td><td>'.$orgstructurename.'</td><td>'.$value->description.'</td><td>'.$showbuttons.'</td>';
		$strdata .='</tr>';
	}
	$objdata->header = '<table class="display hover order-column table table-bordered table-striped nowrap" cellspacing="0" width="100%" id="org_datatable"><thead><tr><th>Tên chức vụ</th><th>Mã chức vụ</th><th>Tên theo pháp luật</th><th>Tên chức danh</th><th>Tên phòng ban</th><th>Mô tả</th><th>Chức năng</th></tr></thead><tbody>'.$strdata.'</tbody></table>';
	break;
	case 'orgstructure_list':
	$get_list = $DB->get_records('orgstructure');
	foreach ($get_list as $value) {
		$buttons = array();
		if($value->visible == 1) {
			$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/hide', get_string('hide')),
			array('title' => get_string('hide'),'id' => $value->id, 'class' => 'hide-item','data-active' => 'orgstructure_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',0)'));	
		} else {
			$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/show', get_string('show')),
			array('title' => get_string('show'),'id' => $value->id, 'class' => 'show-item','data-active' => 'orgstructure_list','id' => $value->id,'onclick' => 'org_active('.$value->id.',1)'));	
		}
		$buttons[] = html_writer::link(new moodle_url('/local/newsvnr/orgstructure.php',array('id' => $value->id)),
			$OUTPUT->pix_icon('t/edit', get_string('edit')),
			array('title' => get_string('edit')));
		$buttons[] = html_writer::link('javascript:void(0)',
			$OUTPUT->pix_icon('t/delete', get_string('delete')),
			array('title' => get_string('delete'),'id' => $value->id, 'class' => 'delete-item','data-section' => 'orgstructure','id' => $value->id,'onclick' => 'org_delete('.$value->id.')'));
		$showbuttons = implode(' ', $buttons);
		$orgcatename = get_name_orgcateid($value->orgstructuretypeid);
		if($value->parentid > 0){
			$parentname = get_name_parentid($value->parentid);
		} else {
			$parentname = 'Công ty mẹ';
		}
		if($value->managerid == 0 ) {
			$username = "";
		} else {
			$username = get_name_userid($value->managerid);	
		}
		$strdata .='<tr>';
		$strdata .='<td>'.$value->name.'</td><td>'.$value->code.'</td><td>'.$orgcatename.'</td><td>'.$username.'</td><td>'.$parentname.'</td><td>'.$value->numbermargin.'</td><td>'.$value->numbercurrent.'</td><td>'.$value->description.'</td><td>'.$showbuttons.'</td>';
		$strdata .='</tr>';
	}
	$objdata->header = '<table class="display hover order-column table table-bordered table-striped nowrap" cellspacing="0" width="100%" id="org_datatable"><thead><tr><th>Tên phòng ban</th><th>Mã phòng ban</th><th>Loại phòng ban</th><th>Tên trưởng phòng ban</th><th>Phòng ban cha</th><th>Số lượng định biên</th><th>Số lượng hiện tại</th><th>Mô tả</th><th>Chức năng</th></tr></thead><tbody>'.$strdata.'</tbody></table>';
	break;
	case 'orgmain_list';
	require_once("$CFG->libdir/completionlib.php"); 
	switch ($modalsection) {
		case 'modalinfo':
			$userarr = get_user_with_usercode($usercode);

			//lấy thông tin user theo PB-CD-CV để hiện thị chi tiết user
			$userstd = new stdclass();
			foreach ($userarr as $userinfo) {
				$userstd->userid = $userinfo->userid;
				$userstd->orgpositionid = $userinfo->positionid;
				$userstd->usercode = $userinfo->usercode;
				$userstd->username = $userinfo->uname;
				$userstd->oname = $userinfo->oname;
				$userstd->opname = $userinfo->opname;
			}
		
			$strmodal = '';
			$strmodal .= '<div class="modal  fade" id="userdetail" role="dialog">
								<div class="modal-dialog modal-lg mw-100 w-75">
									<div class="modal-content fs-14">
										<div class="modal-header">
											<h5 class="modal-title">Chi tiết học viên</h5>
										</div>
									<div class="modal-body">
										<div data-region="userdetail-iframe" class="">';
			$strmodal .= ' <div class="container">
						    <div class="row mb-3">
						      <div class="col-md-2"><span class="userdt-span">Tên nhân viên</span></div>
						      <div class="col-md-4"><input type="text" class="form-control w-100 fs-14" placeholder="" id="username_inp" name="username_inp" value="'.$userstd->username.'" disabled></div>
						      <div class="col-md-2"><span class="userdt-span">Mã nhân viên</span></div>
						      <div class="col-md-4"><input type="text" class="form-control w-100 fs-14" placeholder="" id="usercode_inp" name="usercode_inp" value="'.$userstd->usercode.'" disabled></div>
						    </div>  
						     <div class="row mb-3">
						      <div class="col-md-2"><span class="userdt-span">Phòng ban trực thuộc</span></div>
						      <div class="col-md-4"><input type="text" class="form-control fs-14" placeholder="" id="orgstructure_inp" name="orgstructure_inp" value="'.$userstd->oname.'" disabled></div>
						      <div class="col-md-2"><span class="userdt-span">Chức danh</span></div>
						      <div class="col-md-4"><input type="text" class="form-control fs-14" placeholder="" id="orgposition_inp" name="orgposition_inp" value="'.$userstd->opname.'" disabled></div>
						    </div>  
  						   </div>';
			$strmodal .='</div><div data-region=userdetailtable-iframe>
								<div id="userdetailtable123" class="mt-2">
									<table class="display hover order-column table table-bordered table-striped nowrap" cellspacing="0" width="100%" id="userdetailtable">
										<thead>
											<tr>
												<th>Tiêu chuẩn năng lực</th>
												<th>Khóa học liên kết</th>
												<th>Bằng cấp bên ngoài</th>
												<th>Ngày hoàn thành</th>
												<th>Trạng thái</th>
											</tr>
										</thead>
										<tbody>';
			//lấy danh sách tất cả năng lực theo vị trí
			$get_name_competency = get_name_competency_position($userstd->orgpositionid);
			
			foreach ($get_name_competency as $value) {
				$completecourse_evid = false;
				$completecourse_prog = false;
				$tcnlht = 0;
				$timecompleted = '';
				//lấy chứng chỉ bên ngoài cho năng lực nếu có
				$get_userevidencecompid = get_userevidencecompid($userstd->userid,$value->competencyid);
				$get_userevidence = [];
				$strevidence = 'Không có';
				if(!empty($get_userevidencecompid)) {
					$strevidence = '';
				    foreach ($get_userevidencecompid as $key => $uec) {
				       $get_userevidence[$key] = get_userevidence($uec,$value->competencyid);
				       $get_userevidence[$key]->link = $CFG->wwwroot."/admin/tool/lp/user_competency.php?id=".$get_userevidence[$key]->ucid;
				    }
			
				    if(!empty($get_userevidence)) {
					    foreach ($get_userevidence as $ue) {
					    
					    	$strevidence .= html_writer::link($ue->link,$ue->name,['target' => '_blank','style' => 'color:black']);
					    	if ($ue->status == 0 and $ue->proficiency == 0) {
					    		$completecourse_evid = true;
					    		$timecompleted = convertunixtime('l, d m Y',$ue->timemodified);
					    		$tcnlht += 1;
					    		$strevidence .= ' (Đã review)';
					    	} 
					    	else {
					    		$completecourse_evid = false;
					    		if ($ue->status == 1) {
						    		$strevidence .= ' (Đang đợi review)';
						    	} elseif ($ue->status == 2) {
						    		$strevidence .= ' (Đang trong qua trình review)';
						    	} elseif ($ue->status == 0 and $ue->proficiency == 1) {
						    		$strevidence .= ' (Đã review)';
						    	} else {
						    		$strevidence .= ' (Chưa yêu cầu review)';
						    	}
					    	}
					    	
					    	$strevidence .= '</br>';
					    }
					}
			    }

				$strmodal .= '<tr><td>'.$value->shortname.'</td>';

				//lấy danh danh sách khóa học theo năng lực
				if($value->competencyid) {
					$list_comp = $DB->get_record('competency_coursepositioncomp',['competencyid' => $value->competencyid]);
				}

				$list_comp_name = [];
				$progress = '';
				if(!empty($list_comp)){
					$list_courses = $DB->get_records_sql('SELECT * FROM {course} WHERE id = ?',[$list_comp->courseid]);
					foreach ($list_courses as $value) {
						//kiểm tra user đã tham gia khóa học chưa từ danh khóa học theo năng lực
						$check_enrolled = is_enrolled(context_course::instance($value->id),$userstd->userid);
						if ($check_enrolled == true) {
							$progress = \core_completion\progress::get_course_progress_percentage($value,$userstd->userid);
							$value->progress = floor($progress);
							$value->link = $CFG->wwwroot."/course/view.php?id=".$value->id;
							$list_comp_name[] = $value;
						}else {
							$value->progress = -1;
							$value->link = $CFG->wwwroot."/course/view.php?id=".$value->id;
							$list_comp_name[] = $value;
						}
							
					}
				}
			
				$strhtml = '';
		
				foreach ($list_comp_name as $value) {
					$prog = $value->progress;
					switch (true) {
						case $prog == 100:	
							$completecourse_prog = true;
							if($completecourse_evid == false) {
								$tcnlht += 1;
							}
							$timecompleted = convertunixtime('l, d m Y',$value->startdate);
							$strhtml = '<div class="row align-items-center">
			                  <div class="col-auto pr-0">
			                    	 <div class="progress-circle progress-sm" data-progress="'.$prog.'"></div>
			                  </div>
			                  <div class="col">
			                    <a href="'.$value->link.'" class="d-block mb-0" target="_blank">'.$value->fullname.'</a>
			                   
			                  </div>
			                </div>';		
								break;
							case $prog >= 0 and $prog < 100:	
								$strhtml = '<div class="row align-items-center">
			                  <div class="col-auto pr-0	">
			                    	 <div class="progress-circle progress-sm" data-progress="'.$prog.'"></div>
			                  </div>
			                  <div class="col">
			                    <a href="'.$value->link.'" class="d-block mb-0" target="_blank">'.$value->fullname.'</a>
			                   
			                  </div>
			                </div>';
								break;
							case $prog < 0:	
								$strhtml .= '<div class="row align-items-center">
			                  <div class="col-auto pr-5">
			                    	
			                  </div>
			                  <div class="col">
			                    <a href="'.$value->link.'" class="d-block mb-0" target="_blank">'.$value->fullname.'</a>
			                   
			                  </div>
			                </div>';
								break;
							
							default:
								
							break;
					}

				
				}
				if(empty($list_comp)){
					$strmodal .= '<td><div class="row align-items-center">
		                  <div class="col-auto pr-5">
		                    	
		                  </div>
		                  <div class="col">
		                    Không có khóa học phù hợp
		                   
		                  </div>
		                </div></td><td><span class="badge badge-pill badge-cornflowerblue text-black">'.$strevidence.'</span></td>';
				} else {
					$strmodal .= '<td><div data-region="progress-circle">'.$strhtml.'</div></td><td><span class="badge badge-pill badge-cornflowerblue text-black">'.$strevidence.'</span></td>';
				}
				if(!empty($timecompleted))
					$strmodal .='<td>'.$timecompleted.'</td>';
				else
					$strmodal .='<td><span class="badge badge-pill badge-secondary text-black">Chưa hoàn thành</span></td>';
				if($completecourse_prog == true || $completecourse_evid == true )
					$strmodal .='<td><span class="badge badge-pill badge-success">Hoàn thành</span></td></tr>';
				else
					$strmodal .='<td><span class="badge badge-pill badge-secondary text-black">Chưa hoàn thành</span></td></tr>';
			}
			$strmodal .='</tbody>
												</table>
											</div>
										</div>	
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
									</div>
								</div>
							</div>
						</div>';
		
			$objdata->modal = $strmodal;		
	
			break;
		
		default:
			// code...
			break;
	}

	$get_list = get_listusers_orgstructure($orgstructureid);
	//đếm tiêu chuẩn năng lực
	foreach ($get_list as $value) {
		$get_tcnl_position = get_tcnl($value->positionid)[0]->tcnlcd;
		$get_list_competency = get_competency_position($value->positionid);
		
		$get_name_competency = get_name_competency_position($value->positionid);
		$tcnlht = 0;

		foreach ($get_name_competency as $np) {
			$completecourse_evid = false;
			$completecourse_prog = false;
			$get_userevidencecompid = get_userevidencecompid($value->userid,$np->competencyid);
			$get_userevidence = [];
			$strevidence = '';
			if(!empty($get_userevidencecompid)) {
				
			    foreach ($get_userevidencecompid as $key => $uec) {
			       $get_userevidence[$key] = get_userevidence($uec,$np->competencyid);
			    }

			    if(!empty($get_userevidence)) {
				    foreach ($get_userevidence as $ue) {
				
				    	if ($ue->status == 0 and $ue->proficiency == 0) {
				    		$completecourse_evid = true;
				    		$tcnlht++;
				    			
				    	}
				    	else {
				    		$completecourse_evid = false;
				    	}
				    }

				}
		    }

		
			if($np->competencyid) {
				$list_comp = $DB->get_record('competency_coursepositioncomp',['competencyid' => $np->competencyid]);
			}
		
			$list_comp_name = [];
			$progress = '';
			if(!empty($list_comp)){
				$list_courses = $DB->get_records_sql('SELECT * FROM {course} WHERE id = ?',[$list_comp->courseid]);
				foreach ($list_courses as $lc) {
					$check_enrolled = is_enrolled(context_course::instance($lc->id),$value->userid);
					if ($check_enrolled == true) {
						$progress = \core_completion\progress::get_course_progress_percentage($lc,$value->userid);
						$lc->progress = floor($progress);
						
						$list_comp_name[] = $lc;
					}else {
						$lc->progress = -1;

						$list_comp_name[] = $lc;
					}
						
				}
			}
		
			foreach ($list_comp_name as $cn) {
				$prog = $cn->progress;
				switch (true) {
					case $prog == 100:
						$completecourse_prog = true;	
						if($completecourse_evid == false) {
							$tcnlht++;
						}

					
						break;
					
					default:
						
						break;
				}
			}

		}

		$tcnlcht = $get_tcnl_position - $tcnlht;

		$strdata .='<tr>';
		$strdata .='<td class="hyperlink" data-toggle="tooltip-usercode" title="Nhấn DoubleClick xem chi tiết nhân viên">'.$value->usercode.'</td><td class="hyperlink" data-toggle="tooltip-username" title="Nhấn DoubleClick xem chi tiết nhân viên">'.$value->uname.'</td><td>'.$value->oname.'</td><td>'.$value->opname.'</td><td>'.$get_tcnl_position.'</td><td>'.$tcnlcht.'</td>';
		$strdata .='</tr>';
	}	
	//chi tiết phòng ban
	$orgdetail = get_detail_orgstructure($orgstructureid);
	$orgcatename_detail = get_name_orgcateid($orgdetail->orgstructuretypeid);
	if ($orgdetail->managerid) {
		$username = get_name_userid($orgdetail->managerid);
	} else {
		$username = "";
	}
	if($orgdetail->parentid > 0){
		$parentname_detail = get_name_parentid($orgdetail->parentid);
	} else {
		$parentname_detail = 'Head Office';
	}
	$objdata->header = '<table class="display hover order-column table table-bordered table-striped nowrap" cellspacing="0" width="100%" id="orgmain_datatable"><thead><tr><th>Mã nhân viên</th><th>Tên nhân viên</th><th>Phòng ban trực thuộc</th><th>Chức vụ</th><th>Tiểu chuẩn năng lực</th><th>Năng lực còn thiếu</th></tr></thead><tbody>'.$strdata.'</tbody></table>';
	$objdata->form = '<div class="container mt-3">
		<div class="form-group row">
	    <label for="orgname" class="col-sm-2 col-form-label">Tên phòng ban</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="orgname" value="'.$orgdetail->name.'">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="orgcode" class="col-sm-2 col-form-label">Mã phòng ban</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="orgcode" value="'.$orgdetail->code.'">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="managerid" class="col-sm-2 col-form-label">Trường phòng ban</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="managerid" value="'.$username.'">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="orgstructuretypeid" class="col-sm-2 col-form-label">Loại phòng ban</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="orgstructuretypeid" value="'.$orgcatename_detail.'">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="parentid" class="col-sm-2 col-form-label">Phòng ban cha</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="parentid" value="'.$parentname_detail.'">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="numbermargin" class="col-sm-2 col-form-label">Số lượng định biên</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="numbermargin" value="'.$orgdetail->numbermargin.'">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="numbercurrent" class="col-sm-2 col-form-label">Số lượng hiện tại</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="numbercurrent" value="'.$orgdetail->numbercurrent.'">
	    </div>
	  </div>
	  <div class="form-group row">
	    <label for="org_description" class="col-sm-2 col-form-label">Mô tả</label>
	    <div class="col-sm-10">
	      <textarea class="form-control" rows="5" id="org_description">'.$orgdetail->description.'</textarea>
	    </div>
	  </div>
  </div>';
			

	
	break;
	
}   

echo json_encode($objdata,JSON_UNESCAPED_UNICODE);

die();

