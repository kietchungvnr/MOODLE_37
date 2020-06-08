<?php

require_once (__DIR__ . '/../../../config.php');

require_once (__DIR__ . '/../lib.php');

global $DB, $USER;


if(isset($_POST['post_comment']))
{

	$content = $_POST['content_comment'];

	$createdAt = time();

	$updatedAt = time();

	$discussionid = $_POST['discussionid'];

	$userid = $_POST['userid'];

	$fullname = $_POST['fullname'];

	//create object

	$data = new stdClass();

	$data->content = $content;
	$data->createdAt  = $createdAt;
	$data->updatedAt = $updatedAt;
	$data->discussionid = $discussionid;
	$data->userid = $userid;

	$id_comment =  $DB->insert_record('local_newsvnr_comments', $data);


	echo '
			<div class="row">
			 <div class="col chat-panel" id="comment_'. $id_comment .'">

                         <div class="chat-image">
                            <img class="rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6IMTq-efHer8sp1p23DxIw_NsFFUtc6ZI0vAexxMm0MPEsii-" />
                        </div>

                        <div class="chat-content">
                            <div class="chat-body">
                                <h3 class="name">'. $fullname .'</h3>
                                <label class="date-feedback">'. convertunixtime(' d-m-Y H:i A', $createdAt, 'Asia/Ho_Chi_Minh') .'</label>

                                
                            </div>   
                            <p>' . $content .'</p>

                            <div class="chat-footer">

                           
                                   <div class="chat-footer">
                                         <label class="like">Like</label>

                                             <label class="delete" onclick="DeleteComment('. $id_comment .')"  id="'. $id_comment .'" >Xóa</label>

                                         <input type="hidden" id="delete_comment'. $id_comment .'"  value="delete">

                                          <label class="feedback" onclick="FeedBack('. $id_comment .')" id="'. $id_comment .'">Phản hồi</label>

                      
                                     </div>


		                            <!-- ACTION SHOW AND HIDE REPLIES -->
		                                  <p class="chat-show-reply" id="show-reply'. $id_comment .'" 
                                    onclick="ShowReplies('. $id_comment .')" ><i class="fa fa-chevron-down"> Xem phản hồi</i></p>

                                    <p style="display: none;" class="chat-hidden-reply" id="hidden-reply'. $id_comment .'"
                                     onclick="HiddenReplies('. $id_comment .')"><i class="fa fa-chevron-up"> Ẩn phản hồi</i>
                                     </p>                 

		                            <!-- ACTION END SHOW AND HIDE REPLIES --> 

                                    <div class="new-detail-reply-body form-reply" style="width: 80%; display:none;" >

                                        <form >
                                            <label class="new-detail-reply-title">Bình luận</label>

                                            <textarea class="new-detail-reply-content" name="content_reply" id="content_reply" placeholder="Ý kiến của bạn"></textarea>

                                            <input type="hidden" id="commentid" name="" value="'. $id_comment .'"> 
                                            <input type="hidden" id="userid" name="userid" value="'. $userid .'"> 
                                            <input type="hidden" id="fullname" value="'. $fullname .'" name="">

                                            <div class="new-detail-reply-control" >
                                                <button type="button" class="btn btn-cancel" >Hủy</button>

                                                <button type="button" id="post_reply" name="post_reply" class="btn btn-submit ">Gửi bình luận</button>

                                            </div>
                                        </form>
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="list-reply'. $id_comment .'" id="list_reply'. $id_comment .'" style="display: none; overflow: hidden;">
                                        <!-- COMMENT IS HAVING REPLIES -->
                                        <!-- END COMMENT IS HAVING REPLIES -->
                                    </div>
                    		</div>                                      
                        </div>
                    </div>
         </div>  ';

}



if(isset($_GET['action']) && $_GET['action'] == "delete")
{

	$id_comment = $_GET['id_comment'];

	$DB->delete_records('local_newsvnr_comments', array('id' => $id_comment));
	$DB->delete_records('local_newsvnr_replies', array('commentid' => $id_comment));

	$discussionid = $_GET['discussionid'];
	
	$currentPage = optional_param('page', 0 ,PARAM_INT);

	$get_append_comment = append_comments_after_delete($discussionid, 2, 1);

    if(!empty($get_append_comment))
    {
        $append_comment = '<div class="row">
             <div class="col chat-panel" id="comment_'. $get_append_comment->id .'">

                         <div class="chat-image">
                            <img class="rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6IMTq-efHer8sp1p23DxIw_NsFFUtc6ZI0vAexxMm0MPEsii-" />
                        </div>

                        <div class="chat-content">
                            <div class="chat-body">
                                <h3 class="name">'. $get_append_comment->fullname .'</h3>
                                <label class="date-feedback">'. convertunixtime(' d-m-Y H:i A', $get_append_comment->createdat, 'Asia/Ho_Chi_Minh') .'</label>

                                
                            </div>   
                            <p>' . $get_append_comment->content .'</p>

                            <div class="chat-footer">

                           
                                   <div class="chat-footer">
                                         <label class="like">Like</label>
                                        <label class="delete" onclick="DeleteComment('. $get_append_comment->id .')"  id="'. $get_append_comment->id .'" >Xóa</label>
                                         <input type="hidden" id="delete_comment'. $get_append_comment->id .'"  value="delete">
                                        <label class="feedback"  id="'. $get_append_comment->id .'">Phản hồi</label>
     
                                     </div>


                                    <!-- ACTION SHOW AND HIDE REPLIES -->
                         

                                    <p style="display: none;" class="chat-hidden-reply" id="hidden-reply'. $get_append_comment->id .'"
                                     onclick="HiddenReplies('. $get_append_comment->id .')"><i class="fa fa-chevron-up"> Ẩn phản hồi</i></p>
                                    <p class="chat-show-reply" id="show-reply'. $get_append_comment->id .'" 
                                    onclick="ShowReplies('. $get_append_comment->id .')" ><i class="fa fa-chevron-down" style="display:block"> Xem phản hồi</i></p>
                                    <!-- ACTION END SHOW AND HIDE REPLIES --> 
                            </div>
                                        
                        </div>
                    </div>
         </div>  ';

            echo $append_comment;
    }
	

  
	
}
