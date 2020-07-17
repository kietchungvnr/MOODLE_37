<?php
require_once (__DIR__ . '/../../../config.php');

require_once (__DIR__ . '/../lib.php');
global $DB;

if(isset($_POST['post_reply']))
{

	$content_reply = $_POST['content_reply'];

	$userid = $_POST['userid'];

	$fullname = $_POST['fullname'];

	$commentid = $_POST['commentid'];

	$createdAt = time();

	$updatedAt = time();

	
	$reply_obj = new stdClass();
	$reply_obj->content = $content_reply;
	$reply_obj->createdAt = $createdAt;
	$reply_obj->updatedAt = $updatedAt;
	$reply_obj->commentid = $commentid;
	$reply_obj->userid = $userid;

	$id_reply =  $DB->insert_record('local_newsvnr_replies', $reply_obj);


	echo ' <div class="chat-reply" id="reply_'. $id_reply .'">
            <!-- Comment 1 -->
            <div class="col chat-panel">
                <div class="chat-image">
                    <img class="rounded-circle" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6IMTq-efHer8sp1p23DxIw_NsFFUtc6ZI0vAexxMm0MPEsii-" />
                </div>
                <div class="chat-content">
                    <div class="chat-body">
                        <h3 class="name">'. $fullname .'</h3>
                        <label class="date-feedback">'. convertunixtime(' d-m-Y H:i A', $createdAt, 'Asia/Ho_Chi_Minh') .'</label>

                        
                    </div>
                    <p>'. $content_reply .'</p>
                    <div class="chat-footer">
                        <label class="like">'. get_string('like', 'local_newsvnr') .'</label>
                        <label class="delete_reply" 
                        onclick="DeleteReply('. $id_reply .')" id="'. $id_reply .'">'. get_string('delete') .'</label>    
                        <input type="hidden" id="delete_reply'. $id_reply .'" name="" value="delete" />
                        
                    </div>
                </div>
            </div>

        </div>';

}



if(isset($_GET['action']) && $_GET['action'] == "delete")
{
	$id_reply = $_GET['id_reply'];

	$DB->delete_records('local_newsvnr_replies', array('id' => $id_reply));
}
