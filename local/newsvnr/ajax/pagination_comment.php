<?php


require_once (__DIR__ . '/../../../config.php');

require_once (__DIR__ . '/../lib.php');

global $DB;


$discussionid = $_GET['discussionid'];
	
$currentPage = optional_param('page', 0 ,PARAM_INT);

$itemInPage = 3;


if($currentPage == 1)
{
	$from = 3;
}
else{
	$from  = $currentPage * $itemInPage;
}

$get_comment = pagination_comment($discussionid, $from ,$itemInPage);


$xhtml = "";
if(!empty($get_comment))
{


	foreach ($get_comment as $key => $comment) {

		$get_reply = get_replies_from_comment($comment->id);

			$html_reply = "";
			foreach ($get_reply as $key => $reply) {

				if($comment->id == $reply->commentid)
				{

					$html_reply .= '           

	                            <div class="chat-reply" id="reply_'. $reply->id .'">
	                                <!-- Comment 1 -->
	                                <div class="col chat-panel">
	                                    <div class="chat-image">
	                                        <img class="rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6IMTq-efHer8sp1p23DxIw_NsFFUtc6ZI0vAexxMm0MPEsii-" />
	                                    </div>
	                                    <div class="chat-content">
	                                        <div class="chat-body">
	                                            <h3 class="name">'. $reply->fullname .'</h3>

	                                            <p>'. $reply->content .'</p>
	                                        </div>

	                                        <div class="chat-footer">
	                                            <label class="like">Like</label>
	                                            <label class="delete_reply" 
	                                                            onclick="DeleteReply('. $reply->id .')" id="'. $reply->id .'">Xóa</label>  
	                                             <input type="hidden" id="delete_reply'. $reply->id .'" name="" value="delete" />
	                                            <label class="date-feedback">'. convertunixtime(' d-m-Y H:i A', $reply->createdat, 'Asia/Ho_Chi_Minh') .'</label>
	                                        </div>
	                                    </div>
	                                </div>

	                            </div>';
				}
				else{
					break;
				}
					
			}


			$xhtml .=  '<div class="row">

			                <div class="col chat-panel" id="comment_'. $comment->id .'">
			                    <div class="chat-image">
			                        <img class="rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6IMTq-efHer8sp1p23DxIw_NsFFUtc6ZI0vAexxMm0MPEsii-" />
			                    </div>

			                    <div class="chat-content">
			                        <div class="chat-body">
			                            <h3 class="name">'. $comment->fullname .'</h3>

			                            <p>'. $comment->content .'</p>
			                        </div>

			                          <div class="chat-footer">
			                             <div class="chat-footer">
			                                <label class="like" id="'. $comment->id .'">Like</label>

			                                <label class="delete delete_comment"  onclick="DeleteComment('. $comment->id .')" id="{{{id}}}">Xóa</label>
			                                <input type="hidden" id="delete_comment'. $comment->id .'"  value="delete">

			                                <label class="feedback" id="'. $comment->id .'" onclick="FeedBack('. $comment->id .')">Phản hồi</label>
			                                <label class="date-feedback">'. convertunixtime(' d-m-Y H:i A', $comment->createdat, 'Asia/Ho_Chi_Minh') .'</label>
			                            </div>

			                            <!-- ACTION SHOW AND HIDE REPLIES -->
			                                           <p class="chat-show-reply" id="show-reply'. $comment->id .'" 
	                                    onclick="ShowReplies('. $comment->id  .')" ><i class="fa fa-chevron-down"> Xem phản hồi</i></p>

	                                    <p style="display: none;" class="chat-hidden-reply" id="hidden-reply'. $comment->id  .'"
	                                     onclick="HiddenReplies('. $comment->id  .')"><i class="fa fa-chevron-up"> Ẩn phản hồi</i></p>

			                            <!-- ACTION END SHOW AND HIDE REPLIES --> 
			                            <div class="new-detail-reply-body form-reply" style="width: 80%; display: none;">
			                            	<form>
				                                <label class="new-detail-reply-title">Bình luận</label>

				                                <textarea class="new-detail-reply-content" name="content_reply" id="content_reply" placeholder="Ý kiến của bạn"></textarea>
				       
					                                <input type="hidden" id="commentid" name="" value="'. $comment->id .'"> 
					                                <input type="hidden" id="userid" name="userid" value="'. $comment->userid .'" /> 
					                                <input type="hidden" id="fullname" value="'. $comment->fullname .'" name="" />
				                 
				                                <div class="new-detail-reply-control">
				                                    <button type="button" class="btn btn-cancel">Hủy</button>

				                                    <button type="button" id="post_reply" name="post_reply" class="btn btn-submit ">Gửi bình luận</button>

				                                </div>
				                             </form>
			                            </div>

			                            <div class="clearfix"></div>

			                            <div class="list-reply'. $comment->id .'" id="list_reply'. $comment->id .'" style="display: none; overflow: hidden;" >
			                             	'. $html_reply .'
			                            </div>
			                        </div>

			                    </div>
			                </div>

			            </div>
					';		
	}
	

	echo $xhtml;				
}
else{
	echo "";
}




