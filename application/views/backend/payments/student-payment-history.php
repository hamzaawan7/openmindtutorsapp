				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Payment Details <a class="btn green pull-right" href="<?php echo BACKEND_STUDENTS_PAYMENTS_URL ?>"><i class="fa fa-angle-left back-to-list-icon"></i> Back to Payment Details</a>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN PROFILE SIDEBAR -->
                                <div class="profile-sidebar">
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light profile-sidebar-portlet ">
                                        <!-- SIDEBAR USERPIC -->
                                        <div class="profile-userpic">
                                            <img src="<?php echo (empty($payments))?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$payments[0]['image'] ?>" class="img-responsive" alt=""> </div>
                                        <!-- END SIDEBAR USERPIC -->
                                        <!-- SIDEBAR USER TITLE -->
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"> <?php echo ucwords($payments[0]['first_name'].' '.$payments[0]['last_name']) ?> </div>
                                            <div class="profile-usertitle-job"> Registered Since: <?php echo date('m/d/Y',$payments[0]['user_created']) ?> </div>
											<p style="margin: 0;"> <a href="<?php echo BACKEND_STUDENT_DEATILS_URL.'/'.$payments[0]['student_id'] ?>">View Profile</a> </p>
                                        </div>
                                        <!-- END SIDEBAR USER TITLE -->
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                </div>
                                <!-- END BEGIN PROFILE SIDEBAR -->
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                            <table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user">
																<thead>
																	<tr>
																		<th style="display:none"></th>
																		<th>#</th>
																		<th> Lesson Code </th>
																		<th> Student Name </th>
																		<th> Transaction<br />Amount </th>
																		<th> Status </th>
																		<th> Action </th>
																	</tr>
																</thead>
																<tbody>
															<?php if(!empty($payments)){$count=1;
																	foreach ($payments as $payment){?>
																	<tr class="odd gradeX <?php echo (($_GET['lesson_id']) && $_GET['lesson_id'] == $payment['id'])? "success":"" ?>">
																		<td style="display:none"></td>
																		<td><?php echo $count ?></td>
																		<td class="<?php echo (($_GET['lesson_id']) && $_GET['lesson_id'] == $payment['id'])? "success":"" ?>"><?php echo $payment['lesson_code'] ?></td>
																		<td><?php echo ucwords($payment['first_name'].' '.$payment['last_name']) ?></td>
																		<td><i class="fa fa-gbp" aria-hidden="true"></i><?php echo $payment['transaction_amount']/100 ?></td>
																		<td>
																				<?php
																					$status = '';
																					if($payment['payment_history_status'] == TRANSFERRED_BY_GUEST){ $status = '<span class="label label-sm label-success"> Transferred </span>'; }
																					if($payment['payment_history_status'] == REFUNDED){ $status = '<span class="label label-sm label-info"> refunded </span>'; }
																					if($payment['payment_history_status'] == ONHOLD){ $status = '<span class="label label-sm label-danger"> Disputed </span>'; }
																					if($payment['payment_history_status'] == TRANSFERRED_BY_ADMIN){ $status = '<span class="label label-sm label-success"> Transferred </span>'; }
																				?>
																				<?php echo $status; ?>
																		</td>
																		<td>
																			<?php if($payment['payment_status'] != ACTIVE_STATUS_ID && empty($payment['payment_refund_status'])){ ?>
																				<div class="btn-group">
																					<button class="btn btn-xs green green-color-btn" type="button" onclick="refund(<?php echo $payment['id'] ?>,'<?php echo $payment['transaction_id'] ?>',<?php echo $payment['tutor_availability_id'] ?>,'<?php echo $payment['lesson_code'] ?>',<?php echo $payment['lesson_date'] ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'tick-img.png'  ?>','Are you sure you want to refund the amount? This can not be undone',<?php echo $payment['transaction_amount'] ?>,<?php echo $payment['student_id'] ?>);"><i class="fa fa-undo" aria-hidden="true"></i> Refund Amount</button>
																				</div>
																			<?php } ?>
																			<div class="btn-group view_lessons_details_btn">
																				<a href="<?php echo BACKEND_LESSON_DETAILS_URL.'/'.$payment['id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Lesson Detail </a>
																			</div>
																		</td>
																	</tr>
															<?php $count++;}
															} ?>
																</tbody>
															</table>
                                                        </div>
                                                        <!-- END PERSONAL INFO TAB -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE CONTENT -->
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
