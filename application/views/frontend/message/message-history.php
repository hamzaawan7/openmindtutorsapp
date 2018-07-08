<main>
  <div class="container">
    <div class="forum">
      <div class="row">
		<div class="col-md-3"> 
          <!-- Sidebar
	======================================== -->
          <aside>
            <div class="menu-list margin-0-60">
              <ul>
                <li><a href="<?php echo ROUTE_LESSONS ?>">Lessons</a></li>
                <li class="active-menu"><h5><a href="<?php echo ROUTE_MESSAGES ?>" class="side-bar-active">Messages <?php echo (count($common_data['message_count']) != 0)? "(".count($common_data['message_count']).")":""; ?></a></h5></li>
			</ul>
			<ul>
                <li><a href="<?php echo ROUTE_PAYMENTS_HISTORY ?>">Payments</a></li>
				<li><a href="<?php echo ROUTE_TUTOR_LEVEL ?>">My Tutor Level</a></li>
              </ul>
            </div>
          </aside>
          <!-- sidebar end --> 
        </div>
        <div class="col-md-9"> 
          <!-- Topic replies
======================================== -->
          <div class="forum-topic-head forum-topic-head-change-lesson">Message Details
			<!--<div class="pull-right">
				<div class="form-group has-feedback margin-0 select-dropdown-webkit">
					<?php if($lesson_details['status'] != INACTIVE_STATUS_ID && $lesson_details['status'] != COMPLETED ){ ?>
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-history" aria-hidden="true"></i></span>
							<select class="form-control" onchange="changeLessonStatusMessage(<?php echo $lesson_details['id'].','.$lesson_details['tutor_id'].','.$lesson_details['student_id']?>)" id="lesson_booking_staus">
							<option value="">Change Lesson Status</option>
							<?php if($lesson_details['student_id'] != $common_data['user_id']){ ?>
							<option value="<?php echo PENDING ?>" <?php echo ($lesson_details['status'] == PENDING)? "selected":"";?>>Pending</option>
							<option value="<?php echo APPROVED ?>" <?php echo ($lesson_details['status'] == APPROVED)? "selected":"";?>>Approved</option>
							<option value="<?php echo PENDING_APPROVAL ?>" <?php echo ($lesson_details['status'] == PENDING_APPROVAL)? "selected":"";?>>Ask student to mark complete</option>
							<?php } else { ?>
							<option value="<?php echo COMPLETED ?>" <?php echo ($lesson_details['status'] == COMPLETED)? "selected":"";?>>Completed</option>
							<?php } ?>
							<option value="<?php echo CANCELED ?>" <?php echo ($lesson_details['status'] == CANCELED)? "selected":"";?>>Canceled</option>
							<option value="<?php echo DISPUTED ?>" <?php echo ($lesson_details['status'] == DISPUTED)? "selected":"";?>>Disputed</option>
						</select>
					</div>
					<?php } ?>
				</div>
			</div>-->
		  </div>
		  <div class="topic-reply topic-main-subject-header">
			<div class="row margin-0">
				<div class="col-sm-4">
					<p>Subject: <?php echo $lesson_details['subject'] ?></p>
				</div>
				<div class="col-sm-4 text-center">
					<p><!--Lesson Time: 2 hours--></p>
				</div>
				<div class="col-sm-4 text-right">
				<?php if((empty($lesson_details['payment_status']) || $lesson_details['payment_status']==INACTIVE_STATUS_ID) &&  $lesson_details['student_id']==$common_data['user_id']){ ?>
					</p><a href="<?php echo ROUTE_LESSON_DETAILS.'/'.$lesson_details['id'] ?>" style="text-decoration: underline;">Make Payment</a>
				<?php
				}else{
				?>
				<p>Lesson Details: <a href="<?php echo ROUTE_LESSON_DETAILS.'/'.$lesson_details['id'] ?>" style="text-decoration: underline;">view</a></p>
				<?php
				}
				?>
				</div>
			</div>
		</div>
		<div id="main-message">
		<?php if(!empty($messages)){ 
			foreach ($messages as $key=>$message){
				if ($message['sender_id'] == $common_data['user_id']){?>
          <div class="topic-reply chat-align-right">
            <div class="row">
              <div class="col-md-10">
                <div class="topic-message">
					<h5><?php echo ucwords($message['sender_first_name']) ?> <span class="pull-right"><?php echo dateDiff_ago($message['created']) ?></span></h5>
                  <p><?php echo str_replace('-[first_name]-',ucfirst($message['sender_first_name']),$message['message']) ?></p>
                </div>
              </div>
			  <div class="col-md-2">
                <div class="topic-author"> <img alt="forum topic author" src="<?php echo ($message['sender_image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$message['sender_image'] ?>"/></div>
              </div>
            </div>
		  </div>
				<?php } else {
				if($message['receiver_id'] != 0){?>
		  <div class="topic-reply abc">
            <div class="row <?php echo ($message['status'] == UNSEEN)? "new-message":"";?>">
              <div class="col-md-2">
                <div class="topic-author"> <img alt="forum topic author" src="<?php echo ($message['sender_image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$message['sender_image'] ?>"/></div>
              </div>
              <div class="col-md-10">
                <div class="topic-message">
					<h5><?php echo ucwords($message['sender_first_name']) ?> <span class="pull-right"><?php echo dateDiff_ago($message['created']) ?></span></h5>
                  <p><?php echo str_replace('-[first_name]-',ucfirst($message['sender_first_name']),replaceContactInfo($message['message'])) ?></p>
                </div>
              </div>
            </div>
          </div>
				<?php } else { ?>
		  <div class="topic-reply">
            <div class="row <?php echo ($message['status'] == UNSEEN)? "new-message":"";?>">
              <div class="col-md-2">
                <div class="topic-author"> <img alt="forum topic author" src="<?php echo ($message['sender_image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$message['sender_image'] ?>"/></div>
              </div>
              <div class="col-md-10">
                <div class="topic-message">
					<h5>Admin <span class="pull-right"><?php echo dateDiff_ago($message['created']) ?></span></h5>
                  <p><?php echo $message['message'] ?></p>
                </div>
              </div>
            </div>
          </div>				
				<?php } } ?>
			<?php }
			} ?>          
          </div>
          <!-- topic replies end --> 
		<?php if ($common_data['user_data']['is_active'] != DISABLED_STATUS_ID && $lesson_details['is_active'] != DISABLED_STATUS_ID){ ?>
          <div class="panel-footer">
			<form method="post" onsubmit="return false;">
				<div class="input-group">
					<input id="reply_message" type="text" class="form-control input-sm" placeholder="Type your message here...">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-sm chat-btn" id="btn-chat" onclick="sendReply(<?php echo $common_data['user_id'] ?>,<?php echo ($common_data['user_id'] == $lesson_details['tutor_id'])? $lesson_details['student_id'] : $lesson_details['tutor_id'] ?>,<?php echo $lesson_details['id'] ?>,'<?php echo ($common_data['user_data']['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$common_data['user_data']['image'] ?>','<?php echo ucwords($common_data['user_data']['first_name']) ?>')">
							Send</button>
					</span>
				</div>
			</form>
		  </div>
		<?php } ?>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
$(document).ready(function(){
	$('.new-message').css('background-color', '#f2f2f2');
	setTimeout(function(){
		$('.new-message').animate({backgroundColor: '#ffffff'}, 1000);
	}, 3000);
});
</script>
