<?php

global $DB, $CFG;	

require_once (__DIR__ . '/../../../config.php');

require_once (__DIR__ . '/../lib.php');

require_once (__DIR__ . '/../../../lib/filelib.php');

require_once("pagination.class.php");
	

$perPage = new PerPage();

$courseid =  optional_param('courseid', "" ,PARAM_INT);

if($courseid)
{
	$sql = "SELECT p.id as postid, d.countviews, d.id as discussionid, f.course, p.message,p.subject,
			p.modified,fn.contextid,fn.component,fn.filearea,fn.filepath,fn.itemid,fn.filename 
            from mdl_forum f join mdl_forum_discussions d on f.id=d.forum and f.course=d.course 
			join mdl_forum_posts p on d.id = p.discussion join mdl_files fn on d.firstpost = fn.itemid 
            where f.type='news' and fn.filesize>0
            and fn.filearea = 'attachment'
			and f.course = ?
            order by p.id desc";
}
else{
	$sql = "SELECT p.id as postid, d.countviews, d.id as discussionid, f.course, p.message,p.subject,p.modified,fn.contextid,fn.component,fn.filearea,fn.filepath,fn.itemid,fn.filename 
            from mdl_forum f join mdl_forum_discussions d on f.id=d.forum and f.course=d.course join mdl_forum_posts p on d.id = p.discussion join mdl_files fn on d.firstpost = fn.itemid 
            where f.type='news' and fn.filesize>0
            and fn.filearea = 'attachment'
            order by p.id desc";
}



				
$page = 1;

if(!empty($_GET["page"])) {
	$page = $_GET["page"];
}

$start = ($page-1)*$perPage->perpageCourseNews;

if($start < 0) 
	$start = 0;

$query =  $sql . " OFFSET " . $start . " ROWS FETCH next " . $perPage->perpageCourseNews . " ROWS only"; 

$paginationlink = $CFG->wwwroot . '/local/newsvnr/ajax/pagination_coursenews.php?page=';	

if($courseid)
{
	$faq = $DB->get_records_sql($query, array($courseid));
	$numrow = $DB->get_records_sql($sql, array($courseid));
	
}
else{
	$faq = $DB->get_records_sql($query);
	$numrow = $DB->get_records_sql($sql);

}


if(empty($_GET["rowcount"])) {

 $_GET["rowcount"] = count($numrow);

}


$perpageresult = $perPage->getAllCourseNewsPageLinks($_GET["rowcount"], $paginationlink);	


$output = '';

	foreach($faq as $value) {
			
			$count_comment = get_count_comment_by_discussionid($value->discussionid);

			$get_count_comment = !empty($count_comment) ? $count_comment->countcomments : 0;
			
            $isimage = true;

            $imageurl = file_encode_url("$CFG->wwwroot/pluginfile.php",
                '/'. $value->contextid. '/'. $value->component. '/'.
                $value->filearea. $value->filepath.$value->itemid.'/'. $value->filename, !$isimage);

            $time = convertunixtime('l, d m Y, H:i A',$value->modified,'Asia/Ho_Chi_Minh');

            $link = $CFG->wwwroot."/local/newsvnr/news.php?id=".$value->discussionid;

            $pattern = "/<[^>]*><\\/[^>]*>/"; 

            $message = strip_tags($value->message); 

				$output .= '
						<div class="col-lg-3 mb-3 ">
							<div class="new-latest-box">
								<a href="'. $link .'"><img class="new-latest-image" src="'. $imageurl .'"></a>
								<label class="new-latest-title mt-1"><a href="'. $link .'" title="'. $value->subject .'">'. $value->subject .'</a></label>
								<br />
								<small class="new-latest-time text-date">'. $time .'</small>
								<br />
								<div class="row">
									<div class="col-lg-12">
										<span class="new-latest-content" id="new-latest-content">'. $message .'</span>
									</div>
									<div class="col-lg-12">
										<div class="new-latest-comment-info">
											<i class="fa fa-eye" aria-hidden="true"> '. $value->countviews .'&nbsp&nbsp</i>
											<i class="fa fa-comment-o" aria-hidden="true"> '. $get_count_comment .' &nbsp&nbsp</i>
										</div>
									</div>
								</div>					
							</div>
					
					</div>';
	}

	
if(!empty($perpageresult)) {

$output .= '<div class="col-md-12"> <div id="pagination">' . $perpageresult . '</div> </div>';
}

print $output;