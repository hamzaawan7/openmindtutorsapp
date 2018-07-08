<!-- #header end -->
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
                <li class="active-menu"><h5><a href="<?php echo ROUTE_LESSONS ?>" class="side-bar-active">Lessons</a></h5></li>
                <li><a href="<?php echo ROUTE_MESSAGES ?>">Messages <?php echo (count($common_data['message_count']) != 0)? "(".count($common_data['message_count']).")":""; ?></a></li>
                <li><a href="<?php echo ROUTE_PAYMENTS_HISTORY ?>">Payments</a></li>
				<li><a href="<?php echo ROUTE_TUTOR_LEVEL ?>">My Tutor Level</a></li>
              </ul>
            </div>
          </aside>
          <!-- sidebar end --> 
        </div>
        <div class="col-md-9">
			<div class="row">
				<div class="col-md-4">
				  <div class="profile-image">
					<img alt="user profile" src="<?php echo ($lesson_details['tutor_image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$lesson_details['tutor_image'] ?>">
				  <!--<?php if($common_data['user_id'] == $lesson_details['student_id']){ ?>
					<img alt="user profile" src="<?php echo ($lesson_details['tutor_image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$lesson_details['tutor_image'] ?>">
				  <?php } else { ?>
					<img alt="user profile" src="<?php echo ($lesson_details['student_image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$lesson_details['student_image'] ?>">
				  <?php } ?>-->
				  </div>
				</div>
				<div class="col-md-8">
					<h5>Lesson Details 
					<?php if ($common_data['user_data']['is_active'] != DISABLED_STATUS_ID){ ?>
					<?php if($lesson_details['status'] != CANCELED && $lesson_details['status'] != COMPLETED ){ ?>
						<span class="pull-right">
							<select class="form-control" onchange="changeLessonStatus(<?php echo $lesson_details['id'].','.$lesson_details['tutor_id'].','.$lesson_details['student_id']?>)" id="lesson_booking_staus">
								<option value="">Lesson Status</option>
								<?php if($lesson_details['student_id'] != $common_data['user_id']){ ?>
								<option value="<?php echo PENDING ?>" <?php echo ($lesson_details['status'] == PENDING)? "selected":"";?>>Pending</option>
								<option value="<?php echo APPROVED ?>" <?php echo ($lesson_details['status'] == APPROVED)? "selected":"";?>>Approved</option>
								<option value="<?php echo PENDING_APPROVAL ?>" <?php echo ($lesson_details['status'] == PENDING_APPROVAL)? "selected":"";?>>Ask student to mark complete</option>
								<option value="<?php echo CANCELED ?>" <?php echo ($lesson_details['status'] == CANCELED)? "selected":"";?>>Canceled</option>
								<?php } else { if($lesson_details['status'] == PENDING_APPROVAL){ ?>
								<option value="<?php echo COMPLETED ?>" <?php echo ($lesson_details['status'] == COMPLETED)? "selected":"";?>>Completed</option>
								<option value="<?php echo DISPUTED ?>" <?php echo ($lesson_details['status'] == DISPUTED)? "selected":"";?>>Disputed</option>
								<?php } } ?>
							</select>
						</span>
					<?php }
					}	?>
					</h5>
					<div class="bs-example" data-example-id="condensed-table">
						<table class="table table-condensed">
							<tbody>
								<tr>
									<th scope="row">Lesson Status</th>
										<?php $status = "";
										if($lesson_details['status'] == PENDING){
											$status = "Pending";
										} else if($lesson_details['status'] == CANCELED){
											$status = "Canceled";
										} else if($lesson_details['status'] == APPROVED){
											$status = "Approved";
										} else if($lesson_details['status'] == DISPUTED){
											$status = "Disputed";
										} else if($lesson_details['status'] == COMPLETED){
											$status = "Completed";
										} else if($lesson_details['status'] == INACTIVE_STATUS_ID){
											$status = "Pending";
										} else if($lesson_details['status'] == PENDING_APPROVAL){
											$status = "Completion Approval required";
										}
										?>
									<td><?php echo $status ?></td>
								</tr>
								<tr>
									<th scope="row">Tutor Name</th>
									<td><?php echo $lesson_details['tutor_first_name'].' '.$lesson_details['tutor_last_name'] ?></td>
								</tr>
								<!--<tr>
									<th scope="row">Student Name</th>
									<td><?php echo $lesson_details['student_first_name'].' '.$lesson_details['student_last_name'] ?></td>
								</tr>-->
								<tr>
									<th scope="row">Subject</th>
									<td><?php echo $lesson_details['subject']?></td>
								</tr>
								<tr>
									<th scope="row">Date</th>
									<td><?php echo date('m/d/Y',$lesson_details['lesson_date'])?></td>
								</tr>
								<tr>
									<th scope="row">Time</th>
									<?php $lesson_time = "";
									 foreach(unserialize(TIMES) as $key=>$time){
										 if($key == $lesson_details['time_available']){
											$lesson_time = $time;
										 }
									 }?>
									<td><?php echo $lesson_time; ?></td>
								</tr>
								<tr>
									<th scope="row">Fee</th>
									<td><?php echo CURRENCY_SYMBOL ?><?php echo count($lesson_students)*$lesson_details['hourly_rate'] ?></td>
								</tr>
								<?php if($lesson_details['tutor_id'] == $common_data['user_id']) { ?>
								<tr>
									<th scope="row">OMT Fee</th>
									<?php $transaction_amount = ""; 
									if($lesson_details['lesson_type'] == GROUP_AVAILABLE){
									$transaction_amount = (((count($lesson_students)*$lesson_details['hourly_rate']))*$tutor_level['omt_group_commission'])/100;
									 } else {
									$transaction_amount = (((count($lesson_students)*$lesson_details['hourly_rate']))*$tutor_level['omt_commission'])/100;
									} ?>
									<td><?php echo CURRENCY_SYMBOL ?><?php echo $transaction_amount ?></td>
								</tr>
								<tr>
									<th scope="row">Status</th>
										<?php $payment_status = "";
										if($lesson_details['status'] == INACTIVE_STATUS_ID){
											$payment_status = "Pending";
										} else if($lesson_details['payment_status'] == INACTIVE_STATUS_ID) {
											$payment_status = "Payment pending from admin";
										} else {
											$payment_status = "Completed";
										}
										?>
									<td><?php echo $payment_status ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box green">
						<div class="portlet-title">
							<h5>Student(s) Detail 
							<span class="pull-right">
								<a href="<?php echo ROUTE_MESSAGE_HISTORY.'/'.$lesson_details['id'] ?>" class="form-control">View Messages</a>
							</span>
							</h5>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th> Student(s) Name </th>
											<th> Email </th>
											<th> Transaction Amount </th>
											<th> Tranfer Payment </th>
											<?php if($common_data['user_id'] == $lesson_details['tutor_id']){ ?>
											<th> Action </th>
											 <?php } ?>
											<th> Student Status </th>
										</tr>
									</thead>
									<tbody>
									
									<?php foreach($lesson_students as $student){
											if($student['is_active'] != DISABLED_STATUS_ID){?>
										<tr>
											<?php if($common_data['user_id'] == $lesson_details['tutor_id']){ ?>
											<td><?php echo ucwords($student['first_name'].' '.$student['last_name']) ?></td>
											<td><?php echo $student['email'] ?></td>
											<td><?php echo (!empty($student['payments']['transaction_amount']))? CURRENCY_SYMBOL.$student['payments']['transaction_amount']/100:"N/A"; ?></td>
											<td>
											<?php if(empty($student['payments']['transaction_amount'])){ ?>
												Payment Pending
											<?php } else { ?>
												paid
											<?php } ?>
											</td>
											<td><select class="form-control" onchange="changeStudentStatus(<?php echo $lesson_details['id'].','.$lesson_details['tutor_id'].','.$lesson_details['student_id']?>)" id="student_status">
													<option value="">Student Status</option>
													<option value="<?php echo DISABLED_STATUS_ID ?>" <?php echo ($student['is_active'] == DISABLED_STATUS_ID)? "selected":"";?>>Rejected</option>
													<option value="<?php echo ACTIVE_STATUS_ID ?>" <?php echo ($student['is_active'] == ACTIVE_STATUS_ID)? "selected":"";?>>Accepted</option>
												</select></td>
											<?php } else { ?>
												<?php if($common_data['user_id'] == $student['student_id'] || !empty($student['payments']['transaction_amount'])){ ?>
													<td><?php echo ucwords($student['first_name'].' '.$student['last_name']) ?></td>
													<td><?php echo $student['email'] ?></td>
													<td><?php echo (!empty($student['payments']['transaction_amount']))? CURRENCY_SYMBOL.$student['payments']['transaction_amount']/100:"N/A"; ?></td>
													<td>
													<?php if (empty($student['payments']['transaction_amount'])){ ?>
													Payment Pending<form style="display: inline;" action="<?php echo ROUTE_ADD_PAYMENTS.'/'.$lesson_details['id'] ?>" method="post" name="paymentForm" id="paymentForm">
														<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
															data-key=<?php echo $common_data['site_settings']['stripe_pub'] ?>
															data-amount="<?php echo $lesson_details['hourly_rate']*100 ?>"
															data-name="Open Mind Tutors"
															data-description="Widget"
															data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
															data-locale="auto"
															data-zip-code="true"
															data-currency="<?php echo CURRENCY ?>">
														</script>
														</form>
													<?php } else { ?>
														paid
													<?php } ?>
													</td>

												<?php } ?>

											<?php } ?>
											<?php 
												$student_status = "";
												if($student['is_active'] == INACTIVE_STATUS_ID){
													$student_status = "Pending Approval";
												}else if($student['is_active'] == ACTIVE_STATUS_ID){
													$student_status = "Approved";
												}else if($student['is_active'] == DISABLED_STATUS_ID){
													$student_status = "Rejected";
												}
											?>
											<td><?php echo $student_status ?></td>
											<!--<td><a href="<?php echo BACKEND_STUDENT_DEATILS_URL.'/'.$student['student_id'] ?>">view profile</a></td>-->
										</tr>
									<?php } } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="margin-30-0">
				<h5>Lesson Review</h5>
				<?php if($lesson_details['tutor_id'] == $common_data['user_id']){ ?>
					<?php if(!empty($tutor_reviews)){
						foreach ($tutor_reviews as $review){?>
					<div class="topic-reply">
						<div class="row">
							<div class="col-md-2">
								<div class="topic-author"> <img alt="forum topic author" src="<?php echo ($review['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$review['image'] ?>"/></div>
							</div>
							<div class="col-md-10">
								<div class="topic-message lesson-detail-topic-messages">
									<h5><?php echo $review['first_name'].' '.$review['last_name'] ?> <?php echo ($review['is_active'] == INACTIVE_STATUS_ID)?"<span class='review-pending-approve'>Pending Approval</span>":""; ?><span class="pull-right tutor_level_management_section"><span class="star_rating_popluar_tutor"><input type="text" class="tutor_detail_rating" data-size="xs" value="<?php echo $review['rating'] ?>"></span></span></h5>
									<!--<h6>Outcome</h6>-->
									<p><?php echo $review['review'] ?></p>
								</div>
							</div>
						</div>
					</div>
					<?php }
					} else { ?>
					<div class="topic-reply">
						<div class="row">
							<div class="col-md-12">
								<h6>No reviews yet!</h6>
							</div>
						</div>
					</div>
					<?php } ?>				
				<?php } else { ?>
					<?php if(!empty($all_reviews)){
						foreach ($all_reviews as $review){?>
					<div class="topic-reply">
						<div class="row">
							<div class="col-md-2">
								<div class="topic-author"> <img alt="forum topic author" src="<?php echo ($review['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$review['image'] ?>"/></div>
							</div>
							<div class="col-md-10">
								<div class="topic-message lesson-detail-topic-messages">
									<h5><?php echo $review['first_name'].' '.$review['last_name'] ?> <?php echo ($review['is_active'] == INACTIVE_STATUS_ID)?"<span class='review-pending-approve'>Pending Approval</span>":""; ?><span class="pull-right tutor_level_management_section"><span class="star_rating_popluar_tutor"><input type="text" class="tutor_detail_rating" data-size="xs" value="<?php echo $review['rating'] ?>"></span></span></h5>
									<!--<h6>Outcome</h6>-->
									<p><?php echo $review['review'] ?></p>
								</div>
							</div>
						</div>
					</div>
					<?php }
					} else { ?>
					<div class="topic-reply">
						<div class="row">
							<div class="col-md-12">
								<h6>No reviews yet!</h6>
							</div>
						</div>
					</div>
					<?php } ?>
				<?php } ?>
				<?php if($lesson_details['status'] == COMPLETED && empty($all_reviews) && $lesson_details['seats'] != $total_reviews && $lesson_details['tutor_id'] != $common_data['user_id']){ ?>
				<div class="margin-20-0 app-review-btn">
					<a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#app_review_modal">Write Review</a>
				</div>
				<?php } ?>
			</div>
        </div>
      </div>
    </div>
  </div>
</main>