				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE TITLE-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Student Profile
							<a class="btn green pull-right" href="tutors.php"><i class="fa fa-angle-left back-to-list-icon"></i> Back to Students List</a>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="profile">
                            <div class="tabbable-line tabbable-full-width">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1_1">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <ul class="list-unstyled profile-nav">
                                                    <li>
                                                        <img src="<?php echo ($student_details['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$student_details['image'] ?>" class="img-responsive pic-bordered" alt="" />
                                                    </li>
													<li class="active">
                                                        <a href="#tab_1_11" data-toggle="tab"> Profile </a>
                                                    </li>
													<li>
                                                        <a href="#tab_1_12" data-toggle="tab"> Payments History </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12 profile-info">
                                                        <h1 class="font-green sbold uppercase">
                                                            <?php echo ($student_details['first_name'].' '.$student_details['last_name']) ?>
                                                        </h1>
                                                        <br/>
                                                        <form method="post" name="loginForm" id="loginForm" onsubmit="hardLoginByEmail(); return false;">
                                                            <input type="hidden" name="email" value="<?php echo $student_details['email']?>">
                                                            <input type="hidden" name="password" value="<?php echo $student_details['password']?>">
                                                            <button type="submit" class="btn btn-blue">
                                                                <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                                                                Preview Profile
                                                            </button>
                                                        </form>
                                                        <br/>
                                                    </div>
                                                </div>
                                                <!--end row-->
                                                <div class="tabbable-line tabbable-custom-profile">
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="tab_1_11">
                                                            <div class="portlet-body">
                                                                <table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
                                                                    <tbody>
																		<tr>
                                                                            <td>Gender</td>
                                                                            <td><?php echo ($student_details['gender'] == MALE)? "Male":"Female" ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email</td>
                                                                            <td><?php echo $student_details['email'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Phone</td>
                                                                            <td><?php echo '(+'.$student_details['phone_code'].') '.$student_details['phone'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Address</td>
                                                                            <td><?php echo $student_details['address'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Postal Code</td>
                                                                            <td><?php echo $student_details['postal_code'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>City</td>
                                                                            <td><?php echo $student_details['city'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Country</td>
                                                                            <td><?php echo $student_details['country'] ?></td>
                                                                        </tr>
																		<?php if($student_details['instruction'] != ""){ ?>
																		<tr>
                                                                            <td>Instructions to find the house</td>
                                                                            <td><?php echo $student_details['instruction'] ?></td>
                                                                        </tr>
																		<?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
															<div class="portlet-body">
																<div class="margiv-top-10">
																	<h4 class="font-green sbold uppercase" style="display: inline-block;">Subjects wants to learn</h4>
                                                                </div>
                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table">
                                                                    <tbody>
																		<tr>
                                                                            <th>Main Subject</th>
                                                                            <th>Subject</th>
                                                                        </tr>
																	<?php	if(!empty($subjects)){
																		foreach ($subjects as $subject){ ?>
                                                                        <tr>
                                                                            <td><?php echo $subject['name'] ?></td>
                                                                            <td>
																				<?php foreach($subject['subjects'] as $key=>$inner_subject){
																					if(count($subject['subjects'])-1 == $key){
																						echo $inner_subject['subject_name'];
																					} else {
																						echo $inner_subject['subject_name'].', ';
																					}
																				} ?>
																			</td>
                                                                        </tr>
																	<?php }
																	} ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!--tab-pane-->
														<div class="tab-pane" id="tab_1_12">
															<div class="portlet light bordered admin-payment-page">
																<div class="portlet-body">
																	<table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user">
																		<thead>
																			<tr>
																				<th style="display:none"></th>
																				<th>#</th>
																				<th> Lesson Code </th>
																				<th> Transaction<br />Amount </th>
																				<th> Status </th>
																				<th> Action </th>
																			</tr>
																		</thead>
																		<tbody>
																		<?php if(!empty($payments)){ $count =1;
																			foreach($payments as $payment){?>
																			<tr class="odd gradeX">
																				<td style="display:none"></td>
																				<td><?php echo $count ?></td>
																				<td class=""><?php echo $payment['lesson_code'] ?></td>
																				<td><i class="fa fa-gbp" aria-hidden="true"></i><?php echo $payment['transaction_amount']/100 ?></td>
																				<?php
																					$status = '';
																					if($payment['payment_history_status'] == TRANSFERRED_BY_GUEST){ $status = '<span class="label label-sm label-success"> Transferred </span>'; }
																					if($payment['payment_history_status'] == REFUNDED){ $status = '<span class="label label-sm label-info"> refunded </span>'; }
																					if($payment['payment_history_status'] == ONHOLD){ $status = '<span class="label label-sm label-danger"> Disputed </span>'; }
																					if($payment['payment_history_status'] == TRANSFERRED_BY_ADMIN){ $status = '<span class="label label-sm label-success"> Transferred </span>'; }
																				?>
																				<td> <?php echo $status ?> </td>
																				<td>
																				<?php if($payment['payment_history_status'] != REFUNDED){ ?>
																					<div class="btn-group">
																						<button class="btn btn-xs green green-color-btn" type="button" onclick="refund(<?php echo $payment['id'] ?>,'<?php echo $payment['transaction_id'] ?>',<?php echo $payment['tutor_availability_id'] ?>,'<?php echo $payment['lesson_code'] ?>',<?php echo $payment['lesson_date'] ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'tick-img.png'  ?>','Are you sure you want to refund the amount? This can not be undone',<?php echo $payment['transaction_amount'] ?>,<?php echo $student_details['id'] ?>);"><i class="fa fa-undo" aria-hidden="true"></i> Refund Amount</button>
																					</div>
																				<?php } ?>
																					<div class="btn-group">
																						<a href="<?php echo BACKEND_LESSON_DETAILS_URL.'/'.$payment['id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Lesson Detail </a>
																					</div>
																				</td>
																			</tr>
																		<?php $count++; }
																		}?>
																		</tbody>
																	</table>
																</div>
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
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
