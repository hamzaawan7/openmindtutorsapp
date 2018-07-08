				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE TITLE-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title">
							Tutor Profile
							<a class="btn green pull-right" href="<?php echo BACKEND_TUTORS_URL ?>"><i class="fa fa-angle-left back-to-list-icon"></i> Back to Tutors List</a>
							<div class="pull-right" style="margin-right: 10px;">
								<div class="btn-group">
									<button class="btn green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
										<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="javascript:;" onclick="changeUserStatus('<?php echo ASSET_IMAGES_BACKEND_DIR.'/tick-img.png'  ?>',<?php echo $tutor['id']?>,<?php echo ACTIVE_STATUS_ID ?>,'Are you sure you want to approve the user?')">
												<i class="fa fa-check-circle" aria-hidden="true"></i> Approve </a>
										</li>
										<li>
											<a href="javascript:;" onclick="changeUserStatus('<?php echo ASSET_IMAGES_BACKEND_DIR.'/suspend-img.png'  ?>',<?php echo $tutor['id']?>,<?php echo INACTIVE_STATUS_ID ?>,'Are you sure you want to suspend the user?')">
												<i class="fa fa-power-off" aria-hidden="true"></i> Suspend </a>
										</li>
										<li>
											<?php if($tutor['is_featured']==ACTIVE_STATUS_ID && $tutor['is_active']==ACTIVE_STATUS_ID) { ?>
											<a href="javascript:;" onclick="featureUser('<?php echo ASSET_IMAGES_BACKEND_DIR.'/suspend-img.png'  ?>',<?php echo $tutor['id']?>,<?php echo INACTIVE_STATUS_ID ?>,'Are you sure you want to unfeature the user on Homepage?')">
												<i class="fa icon-star" aria-hidden="true"></i> Unfeature </a>
											<?php } else if($tutor['is_featured']==INACTIVE_STATUS_ID  && $tutor['is_active']==ACTIVE_STATUS_ID)  { ?>
											<a href="javascript:;" onclick="featureUser('<?php echo ASSET_IMAGES_BACKEND_DIR.'/tick-img.png'  ?>',<?php echo $tutor['id']?>,<?php echo ACTIVE_STATUS_ID ?>,'Are you sure you want to feature the user on Homepage?')">
												<i class="fa icon-star" aria-hidden="true"></i> Feature </a>
											<?php } ?>
										</li>
										<li>
											<a href="javascript:;" onclick="changeUserStatus('<?php echo ASSET_IMAGES_BACKEND_DIR.'/delete-img.png'  ?>',<?php echo $tutor['id']?>,<?php echo DELETED_STATUS_ID ?>,'Are you sure you want to delete the user?')">
												<i class="fa fa-trash-o"></i> Delete </a>
										</li>
									</ul>
								</div>
							</div>
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
                                                        <img src="<?php echo ($tutor['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$tutor['image'] ?>" class="img-responsive pic-bordered" alt="" />
                                                    </li>
													<li class="active">
                                                        <a href="#tab_1_11" data-toggle="tab"> Profile </a>
                                                    </li>
													<li>
                                                        <a href="#tab_1_13" data-toggle="tab"> Education & Experience</a>
                                                    </li>
													<li>
                                                        <a href="#tab_1_12" data-toggle="tab"> Payments History </a>
                                                    </li>
													<li>
                                                        <a href="#tab_1_14" data-toggle="tab"> Reviews</a>
                                                    </li>
													<li>
                                                        <a href="#tab_1_15" data-toggle="tab"> Payment Details</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12 profile-info">
                                                        <h1 class="font-green sbold uppercase">
														<?php echo ($tutor['first_name'].' '.$tutor['last_name']) ?>
                                                            <div class="pull-right">
																<select class="form-control" id="level_id" onchange="changeTutorLevel(<?php echo $tutor['id'] ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'tick-img.png' ?>')">
																	<option value="0">Change Level</option>
																	<?php if($tutor['role'] == STUDENT){?>
																<?php foreach ($levels as $level){
																		if($level['is_active'] == ACTIVE_STATUS_ID){?>
																	<option value="<?php echo $level['id']?>" <?php echo ($level['id'] == $tutor_details['level_id'])?"selected":"";?>><?php echo $level['title'] ?></option>
																<?php }
																} ?>
																	<?php } else { ?>
																<?php foreach ($levels as $level){
																		if($level['is_active'] == ACTIVE_STATUS_ID && $level['level_type'] == TIER){?>
																	<option value="<?php echo $level['id']?>" <?php echo ($level['id'] == $tutor_details['level_id'])?"selected":"";?>><?php echo $level['title'] ?></option>
																<?php }
																} ?>
																	<?php } ?>
																</select>
															</div>
															<!--<div class="pull-right">
																<select class="form-control" id="tutor_badge" onchange="changeTutorBadge(<?php echo $tutor['id'] ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'tick-img.png' ?>')">
																	<option value="0">Change Badge</option>
																<?php foreach ($badges as $badge){ ?>
																	<option value="<?php echo $badge['name']?>" <?php echo ($badge['name'] == $tutor_details['badge'])?"selected":"";?>><?php echo $badge['name'] ?></option>
																	<?php } ?>
																</select>
															</div>-->
														</h1>
                                                        <br/>
                                                        <form method="post" name="loginForm" id="loginForm" onsubmit="hardLoginByEmail(); return false;">
                                                            <input type="hidden" name="email" value="<?php echo $tutor['email']?>">
                                                            <input type="hidden" name="password" value="<?php echo $tutor['password']?>">
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
                                                                            <td><?php echo ($tutor['gender'] == MALE)? "Male":"Female" ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email</td>
                                                                            <td><?php echo $tutor['email'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Phone</td>
                                                                            <td><?php echo '(+'.$tutor['phone_code'].') '.$tutor['phone'] ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Address</td>
                                                                            <td><?php echo $tutor['address'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Postal Code</td>
                                                                            <td><?php echo $tutor['postal_code'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>City</td>
                                                                            <td><?php echo $tutor['city'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Country</td>
                                                                            <td><?php echo $tutor['country'] ?></td>
                                                                        </tr>
																		<?php if($tutor['instruction'] != ""){ ?>
																		<tr>
                                                                            <td>Instructions to find the house</td>
                                                                            <td><?php echo $tutor['instruction'] ?></td>
                                                                        </tr>
																		<?php } ?>
																		<tr>
                                                                            <td>Level Name</td>
                                                                            <td><?php echo $tutor_details['level_name'] ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Academic Levels</td>
                                                                            <td><?php echo rtrim($tutor_details['subject_level'],', ') ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
															<div class="portlet-body">
																<div class="margiv-top-10">
																	<h4 class="font-green sbold uppercase" style="display: inline-block;">Tutor Badges</h4>
                                                                    <button onclick="changeTutorBadge(<?php echo $tutor['id'] ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'tick-img.png' ?>')" type="submit" style="float:right;" class="btn green"> Save Changes </button>
                                                                </div>
                                                                <table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table">
                                                                    <tbody>
																		<tr>
                                                                            <th>Select</th>
                                                                            <th>Badge</th>
                                                                        </tr>
																	<?php foreach ($badges as $badge){ ?>
                                                                        <tr>
                                                                            <td><input type="checkbox" data-id="<?php echo $badge['id'] ?>" class="badge-checkbox" <?php echo (in_array($badge['id'], $tutor_badges))? "checked":""; ?>></td>
                                                                            <td><?php echo $badge['name'] ?></td>
                                                                        </tr>
																	<?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
															<div class="portlet-body">
																<div class="margiv-top-10">
																	<h4 class="font-green sbold uppercase" style="display: inline-block;">Subjects wants to teach</h4>
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
														<div class="tab-pane" id="tab_1_13">
															<div class="portlet box green">
																<div class="portlet-title">
																	<div class="caption">Education & Qualification</div>
																</div>
																<div class="portlet-body">
																<?php
																	$education = "";
																	if(!empty($tutor_details)){
																		$education = json_decode($tutor_details['education']);
																	}
																?>
																	<h4>University (1)</h4>
																	<table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
																		<tbody>
																			<tr>
																				<td>Institution</td>
																				<td><?php echo (!empty($education[UNIVERSITY]))? $education[UNIVERSITY]->institute_name :"";?></td>
																			</tr>
																			<tr>
																				<td>Degree</td>
																				<td><?php echo (!empty($education[UNIVERSITY]))? $education[UNIVERSITY]->degree :"";?></td>
																			</tr>
																			<tr>
																				<td>Grade / CGPA</td>
																				<td><?php echo (!empty($education[UNIVERSITY]))? $education[UNIVERSITY]->grade :"";?></td>
																			</tr>
																			<tr>
																				<td>Passing Year</td>
																				<td><?php echo (!empty($education[UNIVERSITY]))? $education[UNIVERSITY]->passing_year :"";?></td>
																			</tr>
																		</tbody>
																	</table>
																	<?php if(!empty($education[COLLEGE]->institute_name)){?>
																	<h4>University (2)</h4>
																	<table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
																		<tbody>
																			<tr>
																				<td>Institution</td>
																				<td><?php echo $education[COLLEGE]->institute_name?></td>
																			</tr>
																			<tr>
																				<td>Degree</td>
																				<td><?php echo $education[COLLEGE]->degree?></td>
																			</tr>
																			<tr>
																				<td>Grade / CGPA</td>
																				<td><?php echo $education[COLLEGE]->grade?></td>
																			</tr>
																			<tr>
																				<td>Passing Year</td>
																				<td><?php echo $education[COLLEGE]->passing_year?></td>
																			</tr>
																		</tbody>
																	</table>
																	<?php } ?>
																	<?php if(!empty($education[SCHOOL]->institute_name)){?>
																	<h4>College</h4>
																	<table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
																		<tbody>
																			<tr>
																				<td>Institution</td>
																				<td><?php echo $education[SCHOOL]->institute_name?></td>
																			</tr>
																			<tr>
																				<td>Degree</td>
																				<td><?php echo $education[SCHOOL]->degree?></td>
																			</tr>
																			<tr>
																				<td>Grade / CGPA</td>
																				<td><?php echo $education[SCHOOL]->grade?></td>
																			</tr>
																			<tr>
																				<td>Passing Year</td>
																				<td><?php echo $education[SCHOOL]->passing_year?></td>
																			</tr>
																		</tbody>
																	</table>
																	<?php } ?>
																</div>
															</div>
															<div class="portlet box green">
																<div class="portlet-title">
																	<div class="caption">Teaching Experience</div>
																</div>
																<div class="portlet-body">
																<?php
																	$teaching = "";
																	if(!empty($tutor_details)){
																		$teaching = json_decode($tutor_details['teaching']);
																	}
																?>
																	<table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
																		<tbody>
																			<tr>
																				<td>Institution</td>
																				<td><?php echo (!empty($teaching[0]))? $teaching[0]->institute_name :""; ?></td>
																			</tr>
																			<tr>
																				<td>Period (year)</td>
																				<td><?php echo (!empty($teaching[0]))? $teaching[0]->period :""; ?></td>
																			</tr>
																			<tr>
																				<td>Academic level (ages of students taught)</td>
																				<td><?php echo (!empty($teaching[0]))? $teaching[0]->ages_of_students :""; ?></td>
																			</tr>
																			<tr>
																				<td>Subject(s) Taught</td>
																				<td><?php echo (!empty($teaching[0]))? $teaching[0]->subjects_taught :""; ?></td>
																			</tr>
																		</tbody>
																	</table>
																	<?php if(!empty($teaching[1]->institute_name)){?>
																	<br>
																	<table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
																		<tbody>
																			<tr>
																				<td>Institution</td>
																				<td><?php echo $teaching[1]->institute_name ?></td>
																			</tr>
																			<tr>
																				<td>Period (year)</td>
																				<td><?php echo $teaching[1]->period ?></td>
																			</tr>
																			<tr>
																				<td>Academic level (ages of students taught)</td>
																				<td><?php echo $teaching[1]->ages_of_students ?></td>
																			</tr>
																			<tr>
																				<td>Subject(s) Taught</td>
																				<td><?php echo str_replace(";",", ",$teaching[1]->subjects_taught) ?></td>
																			</tr>
																		</tbody>
																	</table>
																	<?php } ?>
																	<?php if(!empty($teaching[2]->institute_name)){?>
																	<br>
																	<table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
																		<tbody>
																			<tr>
																				<td>Institution</td>
																				<td><?php echo $teaching[2]->institute_name ?></td>
																			</tr>
																			<tr>
																				<td>Period (year)</td>
																				<td><?php echo $teaching[2]->period ?></td>
																			</tr>
																			<tr>
																				<td>Academic level (ages of students taught)</td>
																				<td><?php echo $teaching[2]->ages_of_students ?></td>
																			</tr>
																			<tr>
																				<td>Subject(s) Taught</td>
																				<td><?php echo str_replace(";",", ",$teaching[2]->subjects_taught) ?></td>
																			</tr>
																		</tbody>
																	</table>
																	<?php } ?>
																</div>
															</div>
															<div class="portlet box green">
																<div class="portlet-title">
																	<div class="caption">Tutoring Experience</div>
																</div>
																<div class="portlet-body">
																	<table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
																		<tbody>
																			<tr>
																				<td>Tutoring since</td>
																				<td><?php echo $tutor_details['tutor_experience'] ?></td>
																			</tr>
																			<!--<tr>
																				<td>Total hours tutored</td>
																				<td><?php echo $tutor_details['tutor_hours'] ?></td>
																			</tr>-->
																			<tr>
																				<td>Subject(s) tutored</td>
																				<td><?php echo str_replace(",",", ",$tutor_details['tutor_subjects']) ?></td>
																			</tr>
																		</tbody>
																	</table>
																</div>
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
																				<th> Student Name </th>
																				<th> Transaction<br />Amount </th>
																				<th> OMT Fee </th>
																				<th> Status </th>
																				<th> Action </th>
																			</tr>
																		</thead>
																		<tbody>
																		<?php if(!empty($payments)){$count=1;
																	foreach ($payments as $payment){?>
																	<tr class="odd gradeX">
																		<td style="display:none"></td>
																		<td><?php echo $count ?></td>
																		<td class=""><?php echo $payment['lesson_code'] ?></td>
																		<td><?php echo ucwords($payment['first_name'].' '.$payment['last_name']) ?></td>

																		<?php if($payment['lesson_type'] == GROUP_AVAILABLE){														$percentage = ($payment['omt_percentage']['omt_group_commission'] == 0 )? $payment['omt_percentage']['omt_commission'] : $payment['omt_percentage']['omt_group_commission'];																			?>
																		<td><?php echo CURRENCY_SYMBOL.(($payment['payment']['transaction_amount']/100)- (($payment['group_hourly_rate']*count($payment['lesson_students']))*$percentage)/100)?></td>
																		<?php } else { ?>
																		<td><?php echo CURRENCY_SYMBOL.(($payment['payment']['transaction_amount']/100)- (($payment['hourly_rate']*count($payment['lesson_students']))*$payment['omt_percentage']['omt_commission'])/100)?></td>
																		<?php } ?>

																		<?php if($payment['lesson_type'] == GROUP_AVAILABLE){														$percentage = ($payment['omt_percentage']['omt_group_commission'] == 0 )? $payment['omt_percentage']['omt_commission'] : $payment['omt_percentage']['omt_group_commission'];
																			$omt_comission = (($payment['group_hourly_rate']*count($payment['lesson_students']))*$percentage)/100;
																		} else {
																			$omt_comission = (($payment['hourly_rate']*count($payment['lesson_students']))*$payment['omt_percentage']['omt_commission'])/100;
																		} ?>
																		<td><?php echo CURRENCY_SYMBOL.$omt_comission ?></td>
																		
																		<td><span class="label label-sm label-<?php echo ($payment['payment_status'] == ACTIVE_STATUS_ID )?"success":"warning" ?>"> <?php echo ($payment['payment_status'] == ACTIVE_STATUS_ID )?"Transferred":"Pending" ?> </span></td>
																		<td>
																			<?php if($payment['payment_status'] == INACTIVE_STATUS_ID  || $payment['payment_status'] == ""){ ?>
																			<div class="btn-group">
																				<?php $transaction_amount = ""; 
																				if($payment['lesson_type'] == GROUP_AVAILABLE){														$percentage = ($payment['omt_percentage']['omt_group_commission'] == 0 )? $payment['omt_percentage']['omt_commission'] : $payment['omt_percentage']['omt_group_commission'];
																				$transaction_amount = (($payment['payment']['transaction_amount']/100)- (($payment['group_hourly_rate']*count($payment['lesson_students']))*$percentage)/100);
																				 } else {
																				$transaction_amount = (($payment['payment']['transaction_amount']/100)- (($payment['hourly_rate']*count($payment['lesson_students']))*$payment['omt_percentage']['omt_commission'])/100);
																				} ?>
																				<button class="btn btn-xs green green-color-btn" type="button" onclick="markAsPayed(<?php echo $payment['id'] ?>,<?php echo $payment['tutor_availability_id'] ?>,'<?php echo $payment['lesson_code'] ?>',<?php echo $payment['lesson_date'] ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'money-bag.png' ?>','<?php echo $transaction_amount ?>')"><i class="fa fa-money" aria-hidden="true"></i> Transfer Amount</button>
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
															</div>
														</div>
                                                        <!--tab-pane-->
														<div class="tab-pane" id="tab_1_14">
															<div class="portlet light bordered admin-payment-page">
																<div class="portlet-body">
																	<table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user1">
																		<thead>
																			<tr>
																				<th>#</th>
																				<th> Student Name </th>
																				<th> Subject </th>
																				<th> Rating </th>
																				<th> Status </th>
																				<th> Action </th>
																			</tr>
																		</thead>
																		<tbody>
																		<?php if(!empty($reviews)){$count =1;
																				foreach ($reviews as $key=>$review){?>
																			<tr class="odd gradeX">
																				<td><?php echo $count ?></td>
																				<td><a href="<?php echo BACKEND_STUDENT_DEATILS_URL.'/'.$review['student_id'] ?>"><?php echo ucwords($review['first_name'].' '.$review['last_name']) ?></a></td>
																				<td><?php echo $review['subject'] ?></td>
																				<td><?php echo $review['rating'] ?></td>
																				<td>
																				<?php $status = "";
																					if ($review['is_active'] == ACTIVE_STATUS_ID) {$status = '<span class="label label-sm label-success"> Approved </span>';}
																					if ($review['is_active'] == INACTIVE_STATUS_ID){$status = '<span class="label label-sm label-warning"> Pending </span>';}
																					if ($review['is_active'] == REJECTED_STATUS_ID){$status = '<span class="label label-sm label-danger"> Rejected </span>';}
																					?>
																				<?php echo $status ?>
																				</td>
																				<td>
																					<div class="btn-group">
																						<a href="<?php echo BACKEND_REVIEW_DETAILS_URL.'/'.$review['id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Detail </a>
																					</div>
																				</td>
																			</tr>
																			<?php $count++;} 
																		}?>
																		</tbody>
																	</table>
																</div>
															</div>
														</div>
                                                        <!--tab-pane-->
														<div class="tab-pane" id="tab_1_15">
                                                            <div class="portlet-body">
                                                                <table class="table table-striped table-bordered table-advance green-tab-student lesson-detail-table table-hover">
                                                                    <tbody>
																		<tr>
                                                                            <td>Account Title</td>
                                                                            <td><?php echo (!empty($tutor_payment_details))?$tutor_payment_details['title']:"N/A" ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Bank Name</td>
                                                                            <td><?php echo (!empty($tutor_payment_details))?$tutor_payment_details['bank_name']:"N/A" ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Address</td>
                                                                            <td><?php echo (!empty($tutor_payment_details))?$tutor_payment_details['address']:"N/A" ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Account Number</td>
                                                                            <td><?php echo (!empty($tutor_payment_details))?$tutor_payment_details['account_number']:"N/A" ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Swift Code / BIC</td>
                                                                            <td><?php echo (!empty($tutor_payment_details))?$tutor_payment_details['swift_code']:"N/A" ?></td>
                                                                        </tr>
																		<tr>
                                                                            <td>Phone</td>
                                                                            <td><?php echo (!empty($tutor_payment_details))? '+'.$tutor_payment_details['phone_code'].$tutor_payment_details['phone'] : "N/A" ?></td>
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
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
