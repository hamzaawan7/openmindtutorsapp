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
			<?php if(!empty($taken_lesson_messages) && !empty($given_lesson_messages)){ ?>
			<div class="lessons-tab"> 
				<a href="javascript:void(0)" class="btn btn-sm btn-warning taken-lessons <?php echo ($common_data['user_data']['role'] == STUDENT)? "lesson-active":""; ?>" title="Detail">Lessons Taken <?php echo ($taken_lesson_messages_count != 0 )?  '('.$taken_lesson_messages_count.')':''; ?></a>
				<a href="javascript:void(0)" class="btn btn-sm btn-warning given-lessons <?php echo ($common_data['user_data']['role'] == TUTOR)? "lesson-active":""; ?>" title="Detail">Lessons Given <?php echo ($given_lesson_messages_count != 0 )?  '('.$given_lesson_messages_count.')':''; ?></a>
			</div>
			<?php } ?>
          <!-- Topic replies
======================================== -->
<?php // echo ($common_data['user_data']['role'] == TUTOR)? "style='display:none'":""; ?>
			<div class="lesson-tab-info" id="taken-lessons" <?php echo ($common_data['user_data']['role'] == TUTOR)? "style='display:none'":""; ?>>
		  <?php if(!empty($taken_lesson_messages)){
				foreach ($taken_lesson_messages as $key=>$message){?>
          <div class="topic-reply <?php echo ((count($taken_lesson_messages)-1) == $key)? "margin-0-60":""; ?> <?php echo ($message['receiver_id'] == $common_data['user_id'] && $message['status'] == UNSEEN)?"message_active":"" ?>">
            <div class="row">
            <a href="<?php echo ROUTE_MESSAGE_HISTORY.'/'.$message['lesson_id'] ?>">
              <div class="col-md-2">
                <div class="topic-author"><img alt="user profile" src="<?php echo ($message['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$message['image'] ?>">
                </div>
              </div>
              <div class="col-md-10">
                <div class="topic-message">
                  <h5><?php echo ucwords($message['first_name'].' '.$message['last_name']);?>
				  <span class="pull-right"><?php echo date('M d,Y',$message['lesson_date']) ?>, <?php echo $message['subject'] ?> </span>
				  </h5>
                  <p><?php echo (strlen($message['message']) > 251)? substr(str_replace(array('by', '-[first_name]-' ),"",$message['message']), 0, 251).'...':str_replace(array('by', '-[first_name]-' ),"",$message['message']); ?>
				  <div class="text-right"><?php echo dateDiff_ago($message['created']) ?></div></p>
                </div>
              </div>
              </a>
            </div>
          </div>
				<?php }
				} else { ?>
          <div class="topic-reply">
            <div class="row">
              <div class="col-md-12">
                <h6>No messages yet!</h6>
              </div>
            </div>
          </div>
		  <?php } ?>
          </div>
          <div class="lesson-tab-info" id="given-lessons" <?php echo ($common_data['user_data']['role'] == STUDENT)? "style='display:none'":""; ?>>
		  <?php if(!empty($given_lesson_messages)){
				foreach ($given_lesson_messages as $key=>$message){?>
          <div class="topic-reply <?php echo ((count($given_lesson_messages)-1) == $key)? "margin-0-60":""; ?> <?php echo ($message['receiver_id'] == $common_data['user_id'] && $message['status'] == UNSEEN)?"message_active":"" ?>">
            <div class="row">
            <a href="<?php echo ROUTE_MESSAGE_HISTORY.'/'.$message['lesson_id'] ?>">
              <div class="col-md-2">
                <div class="topic-author"><img alt="user profile" src="<?php echo ($message['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$message['image'] ?>">
                </div>
              </div>
              <div class="col-md-10">
                <div class="topic-message">
                  <h5><?php echo ucwords($message['first_name'].' '.$message['last_name']);?>
				  <span class="pull-right"><?php echo date('M d,Y',$message['lesson_date']) ?>, <?php echo $message['subject'] ?> </span>
				  </h5>
                  <p><?php echo (strlen($message['message']) > 251)? substr(str_replace(array('by', '-[first_name]-' ),"",$message['message']), 0, 251).'...':str_replace(array('by', '-[first_name]-' ),"",$message['message']); ?>
				  <div class="text-right"><?php echo dateDiff_ago($message['created']) ?></div></p>
                </div>
              </div>
              </a>
            </div>
          </div>
				<?php }
				} else { ?>
          <div class="topic-reply">
            <div class="row">
              <div class="col-md-12">
                <h6>No messages yet!</h6>
              </div>
            </div>
          </div>
		  <?php } ?>
          </div>
          <!-- topic replies end --> 
          
          <!-- Pagination
======================================== -->
          <!--<nav class="text-center">
            <ul class="pagination">
              <li> <a href="#" aria-label="Previous"> <span aria-hidden="true">«</span> </a> </li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li> <a href="#" aria-label="Next"> <span aria-hidden="true">»</span> </a> </li>
            </ul>
          </nav> -->
          <!-- pagination end --> 
          
        </div>
      </div>
    </div>
  </div>
</main>
<script>
	$(document).ready(function(){
		<?php if(!empty($given_lesson_messages) && empty($taken_lesson_messages)){ ?>
			$('#given-lessons').show();
			$('#taken-lessons').hide();
		<?php } ?>
		<?php if(!empty($taken_lesson_messages) && empty($given_lesson_messages)){ ?>
			$('#taken-lessons').show();
			$('#given-lessons').hide();
		<?php } ?>
	})
</script>
