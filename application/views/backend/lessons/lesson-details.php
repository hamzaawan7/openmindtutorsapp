				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Lesson Details
							<a class="btn green pull-right" href="<?php echo BACKEND_LESSONS_REQUESTS_URL ?>"><i class="fa fa-angle-left back-to-list-icon"></i> Back to Lessons Requests List</a>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="profile">
                            <div class="tabbable-line tabbable-full-width">
                                <div class="tab-content" style="padding-top:0; padding-bottom: 10px;">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="row">
                                            <div class="col-md-12">
												<h4>Overview</h4>
                                                <div class="tabbable-line tabbable-custom-profile">
                                                    <!--<div class="tab-content">-->
													<div>
                                                        <div class="tab-pane active" id="tab_1_11">
                                                            <div class="portlet-body">
                                                                <table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Tutor's Name</td>
                                                                            <td><?php echo ucwords($lesson_details['first_name'].' '.$lesson_details['last_name']) ?> <a target="_blank" href="<?php echo BACKEND_TUTOR_DEATILS_URL.'/'.$lesson_details['tutor_id'] ?>">(view profile)</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Session Type</td>
                                                                            <td><?php echo ($lesson_details['lesson_type'] == GROUP_AVAILABLE)? "Group":"Individual"; ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Lesson Code</td>
                                                                            <td><?php echo $lesson_details['lesson_code'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Lesson Date / Time</td>
																			<?php $times_available = unserialize(TIMES) ?>
                                                                            <td><?php echo date("m/d/Y",$lesson_details['lesson_date']) ?> (<?php echo $times_available[$lesson_details['time_available']] ?>)</td>
                                                                        </tr>
																		<tr>
                                                                            <td>Lesson Status</td>
																			<?php
																				$status = '';
																				if($lesson_details['status'] == PENDING){ $status = '<span class="label label-sm label-warning">Pending</span>'; }
																				if($lesson_details['status'] == CANCELED){ $status = '<span class="label label-sm label-info">Canceled</span>'; }
																				if($lesson_details['status'] == APPROVED){ $status = '<span class="label label-sm label-success">Approved</span>'; }
																				if($lesson_details['status'] == PENDING_APPROVAL){ $status = '<span class="label label-sm label-primary">Pending Approval</span>'; }
																				if($lesson_details['status'] == DISPUTED){ $status = '<span class="label label-sm label-danger">Disputed</span>'; }
																				if($lesson_details['status'] == COMPLETED){ $status = '<span class="label label-sm label-success">Completed</span>'; }
																				if($lesson_details['status'] == INACTIVE_STATUS_ID){ $status = '<span class="label label-sm label-warning">Pending</span>'; }
																			?>
                                                                            <td><?php echo $status ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Hourly Fee</td>
                                                                            <td><?php echo ($lesson_details['lesson_type'] == GROUP_AVAILABLE)? CURRENCY_SYMBOL.$lesson_details['group_hourly_rate'] : CURRENCY_SYMBOL.$lesson_details['hourly_rate']; ?> per hour</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Fee</td>
                                                                            <td><?php echo CURRENCY_SYMBOL?><?php echo ($lesson_details['lesson_type'] == GROUP_AVAILABLE)? ($lesson_details['group_hourly_rate']*count($lesson_active_students)): ($lesson_details['hourly_rate']*count($lesson_active_students)) ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>OMT Percentage (<?php echo ($lesson_details['lesson_type'] == GROUP_AVAILABLE)? $level_details['omt_group_commission']:$level_details['omt_commission']; ?>%)</td>
																			<?php if($lesson_details['lesson_type'] == GROUP_AVAILABLE){
																				$omt_comission = (($lesson_details['group_hourly_rate']*count($lesson_active_students))*$level_details['omt_group_commission'])/100;
																			} else {
																				$omt_comission = (($lesson_details['hourly_rate']*count($lesson_active_students))*$level_details['omt_commission'])/100;
																			} ?>
                                                                            <td><?php echo CURRENCY_SYMBOL.$omt_comission ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Admin Payment Status</td>
																			<?php
																				$payment_status = '<span class="label label-sm label-warning">Pending</span>';
																				if($lesson_details['payment_status'] == INACTIVE_STATUS_ID){ $payment_status = '<span class="label label-sm label-warning">Pending</span>'; }
																				if($lesson_details['payment_status'] == ACTIVE_STATUS_ID){ $payment_status = '<span class="label label-sm label-success">Completed</span>'; }
																			?>
                                                                            <td> <?php echo $payment_status ?> </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!--tab-pane-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-12">
									<div class="portlet box green">
										<div class="portlet-title">
											<div class="caption"><i class="fa fa-users"></i>Student(s) Detail </div>
										</div>
										<div class="portlet-body">
											<div class="table-scrollable">
												<table class="table table-striped table-hover">
													<thead>
														<tr>
															<th> # </th>
															<th> Student(s) Name </th>
															<th> Student Status </th>
															<th> Email </th>
															<th> Go to Profile </th>
														</tr>
													</thead>
													<tbody>
													<?php $count=1; foreach($lesson_students as $student){ ?>
														<tr>
															<td> <?php echo $count ?> </td>
															<td><?php echo ucwords($student['first_name'].' '.$student['last_name']) ?></td>
															<?php $student_status = '';
																if($student['is_active'] == ACTIVE_STATUS_ID){
																	$student_status = "Active";
																}
																if($student['is_active'] == DISABLED_STATUS_ID){
																	$student_status = "REJECTED";
																}
																if($student['is_active'] == INACTIVE_STATUS_ID){
																	$student_status = "Pending";
																}?>
															<td><?php echo $student_status ?></td>
															<td><?php echo $student['email'] ?></td>
															<td><a target="_blank" href="<?php echo BACKEND_STUDENT_DEATILS_URL.'/'.$student['student_id'] ?>">view profile</a></td>
														</tr>
													<?php $count++; }?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<h4>Message History 
								<div class="pull-right">
									<?php if($lesson_details['status'] == DISPUTED){ ?>
										<span class="label label-sm label-danger"> This lesson is disputed. </span>
									<?php } ?>
								</div>
							</h4>
							<div class="row">
								<div class="col-sm-12">
									<!-- BEGIN PORTLET-->
									<div class="portlet light bordered">
										<div class="portlet-body" id="chats">
											<?php if($lesson_details['status'] == DISPUTED){ ?>
											<div class="body" style="color:#ed6b75; margin-top: 5px;">Please resolve this disputed lesson. <span class="pull-right close-dispute-section">
											<a onclick="changeLessonStatus(<?php echo $lesson_details['id'] ?>,<?php echo $lesson_details['tutor_availability_id'] ?>,'<?php echo $lesson_details['lesson_code'] ?>',<?php echo $lesson_details['lesson_date'] ?>,<?php echo COMPLETED ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'/tick-img.png'  ?>','Complete this lesson?')" class="btn btn-primary green btn-sm green-color-btn close-dispute-btn" href="javascript:void(0)">Close Dispute</a></span></div>
											<div class="chat-form">
												<form method="post" id="sendEmailForm" name="sendEmailForm" onSubmit="sendEmail(<?php echo $lesson_details['id'] ?>,<?php echo $lesson_details['tutor_availability_id'] ?>,'<?php echo $lesson_details['lesson_code'] ?>',<?php echo $lesson_details['lesson_date'] ?>); return false;" >
													<div class="input-cont">
														<input class="form-control" id="admin_message" type="text" placeholder="Type a message here..." /> </div>
													<div class="btn-cont">
														<span class="arrow"> </span>
														<button type="submit" class="btn blue icn-only">
															<i class="fa fa-check icon-white"></i>
														</button>
													</div>
												</form>
											</div>
											<br>
											<?php } ?>
											<div class="scroller" data-always-visible="1" data-rail-visible1="1">
												<ul class="chats">
											<?php if(!empty($messages)){ 
												foreach ($messages as $key=>$message){
														if($message['receiver_id'] != 0){?>
													<li class="<?php echo ($message['sender_id'] == $lesson_details['tutor_id'])?"out":"in" ?>">
														<img class="avatar" alt="" src="<?php echo ($message['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$message['image'] ?>" />
														<div class="message">
															<span class="arrow"> </span>
															<a href="javascript:;" class="name"> <?php echo ucwords($message['sender_first_name'].' '.$message['sender_last_name']) ?> </a>
															<span class="datetime"> <?php echo dateDiff_ago($message['created']) ?> </span>
															<span class="body"> <?php echo str_replace('-[first_name]-',ucwords($message['sender_first_name']),$message['message']) ?> </span>
														</div>
													</li>
														<?php } else { ?>
													<li class="admin_msg">
														<div class="message">
															<span class="arrow"> </span>
															<a href="javascript:;" class="name">Admin</a>
															<span class="datetime"> <?php echo dateDiff_ago($message['created']) ?> </span>
															<span class="body"> <?php echo str_replace('-[first_name]-',ucwords($message['sender_first_name']),$message['message']) ?> </span>
														</div>
													</li>
														<?php } ?>
											<?php }
											} ?>
													<!--<li class="admin_msg">
														<div class="message">
															<span class="arrow"> </span>
															<a href="javascript:;" class="name">Admin</a>
															<span class="datetime"> at 20:33 </span>
															<span class="body"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
														</div>
													</li>-->
												</ul>
											</div>
										</div>
									</div>
									<!-- END PORTLET-->
								</div>
							</div>
							<h4>Payment History</h4>
							<div class="row">
								<div class="col-md-12">
									<!-- BEGIN EXAMPLE TABLE PORTLET-->
									<div class="portlet light bordered students-payment-page">
										<div class="portlet-body">
											<table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user">
												<thead>
													<tr>
														<th width="1%" style="display:none"></th>
														<th> Lesson Code </th>
														<th> Student Name </th>
														<th> Student Status </th>
														<th> Transaction Amount </th>
														<th> Status </th>
														<th> Action </th>
													</tr>
												</thead>
												<tbody>
												<?php if(!empty($lesson_students)){
													$count=1; 
												foreach($lesson_students as $student){
													if(empty($student['payments'])){ ?>
													<tr class="odd gradeX">
														<td style="display:none"></td>
														<td><?php echo $student['lesson_code'] ?></td>
														<td><?php echo ucwords($student['first_name'].' '.$student['last_name']) ?></td>
														<?php $student_status = '';
															if($student['is_active'] == ACTIVE_STATUS_ID){
																$student_status = "Active";
															}
															if($student['is_active'] == DISABLED_STATUS_ID){
																$student_status = "REJECTED";
															}
															if($student['is_active'] == INACTIVE_STATUS_ID){
																$student_status = "Pending";
															}?>
														<td><?php echo $student_status ?></td>
														<td>N/A</td>
														<td><span class="label label-sm label-warning"> Pending </span></td>
														<td>
															<div class="btn-group view_detail_lesson_request">
																<a href="<?php echo BACKEND_STUDENT_PAYMENT_HISTORY_URL.'/'.$student['student_id'].'?lesson_id='.$student['id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Detail </a>
															</div>
														</td>
													</tr>
														
													<?php } else {
													foreach ($student['payments'] as $payments){
														if($payments['status'] != TRANSFERRED_BY_ADMIN){?>
													<tr class="odd gradeX">
														<td style="display:none"></td>
														<td><?php echo $student['lesson_code'] ?></td>
														<td><?php echo ucwords($student['first_name'].' '.$student['last_name']) ?></td>
														<?php $student_status = '';
															if($student['is_active'] == ACTIVE_STATUS_ID){
																$student_status = "Active";
															}
															if($student['is_active'] == DISABLED_STATUS_ID){
																$student_status = "REJECTED";
															}
															if($student['is_active'] == INACTIVE_STATUS_ID){
																$student_status = "Pending";
															}?>
														<td><?php echo $student_status ?></td>
														<td><?php echo CURRENCY_SYMBOL.$payments['transaction_amount']/100 ?></td>
														<?php
															$status = '';
															if($payments['status'] == TRANSFERRED_BY_GUEST){ $status = '<span class="label label-sm label-success"> Transferred by guest </span>'; }
															if($payments['status'] == REFUNDED){ $status = '<span class="label label-sm label-info"> refunded </span>'; }
															if($payments['status'] == ONHOLD){ $status = '<span class="label label-sm label-danger"> Disputed </span>'; }
															if($payments['status'] == TRANSFERRED_BY_ADMIN){ $status = '<span class="label label-sm label-success"> Transferred by admin </span>'; }
														?>
														<td> <?php echo $status ?> </td>
														<td>
														<?php if($payments['status'] != REFUNDED && $lesson_details['payment_status'] != ACTIVE_STATUS_ID){ ?>
															<div class="btn-group">
																<button class="btn btn-xs green green-color-btn" type="button" onclick="refund(<?php echo $student['id'] ?>,'<?php echo $payments['transaction_id'] ?>',<?php echo $payments['tutor_availability_id'] ?>,'<?php echo $payments['lesson_code'] ?>',<?php echo $payments['lesson_date'] ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'tick-img.png'  ?>','Are you sure you want to refund the amount? This can not be undone',<?php echo $payments['transaction_amount'] ?>,<?php echo $student['student_id'] ?>);" ><i class="fa fa-undo" aria-hidden="true"></i> Refund Amount</button>
															</div>
														<?php } ?>
															<div class="btn-group view_detail_lesson_request">
																<a href="<?php echo BACKEND_STUDENT_PAYMENT_HISTORY_URL.'/'.$student['student_id'].'?lesson_id='.$student['id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Detail </a>
															</div>
														</td>
													</tr>
														<?php } ?>
													<?php 	} 
														}
													} 
												} ?>
												</tbody>
											</table>
										</div>
									</div>
									<!-- END EXAMPLE TABLE PORTLET-->
								</div>
							</div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
