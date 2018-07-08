				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> OMT <i class="fa fa-arrow-right" aria-hidden="true"></i> Tutors Payments
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered admin-payment-page">
                                    <div class="portlet-body">
										<table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user">
                                            <thead>
                                                <tr>
													<th style="display:none"></th>
                                                    <th>#</th>
                                                    <th> Lesson Code </th>
                                                    <th> Tutor Name </th>
													<th> Transaction Amount </th>
													<th> OMT Fee </th>
                                                    <th> Status </th>
													<th> Action </th>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php if(!empty($payments)){ $count = 1;
													foreach ($payments as $payment){
														if($payment['status'] == COMPLETED && !empty($payment['payment']['transaction_amount'])){?>
												<tr class="odd gradeX">
													<td style="display:none"></td>
                                                    <td><?php echo $count ?></td>
                                                    <td><?php echo $payment['lesson_code'] ?></td>
                                                    <td><?php echo ucwords($payment['first_name'].' '.$payment['last_name']) ?></td>
													
													<?php if($payment['lesson_type'] == GROUP_AVAILABLE){
														$percentage = ($payment['omt_percentage']['omt_group_commission'] == 0 )? $payment['omt_percentage']['omt_commission'] : $payment['omt_percentage']['omt_group_commission'];?>
													<td><?php echo CURRENCY_SYMBOL.(($payment['payment']['transaction_amount']/100)- (($payment['group_hourly_rate']*count($payment['lesson_students']))*$percentage)/100)?></td>
													<?php } else { ?>
													<td><?php echo CURRENCY_SYMBOL.(($payment['payment']['transaction_amount']/100)- (($payment['hourly_rate']*count($payment['lesson_students']))*$payment['omt_percentage']['omt_commission'])/100)?></td>
													<?php } ?>
													
													<?php if($payment['lesson_type'] == GROUP_AVAILABLE){
														$percentage = ($payment['omt_percentage']['omt_group_commission'] == 0 )? $payment['omt_percentage']['omt_commission'] : $payment['omt_percentage']['omt_group_commission'];
														$omt_comission = (($payment['group_hourly_rate']*count($payment['lesson_students']))*$percentage)/100;
													} else {
														$omt_comission = (($payment['hourly_rate']*count($payment['lesson_students']))*$payment['omt_percentage']['omt_commission'])/100;
													} ?>
													<td><?php echo CURRENCY_SYMBOL.$omt_comission ?></td>
													<td><span class="label label-sm label-<?php echo ($payment['payment_status'] == ACTIVE_STATUS_ID )?"success":"warning" ?>"> <?php echo ($payment['payment_status'] == ACTIVE_STATUS_ID )?"Transferred":"Pending" ?> </span></td>
													<td>
														<?php if($payment['payment_status'] == INACTIVE_STATUS_ID || $payment['payment_status'] == ""){ ?>
                                                        <div class="btn-group">
															<?php $transaction_amount = ""; 
															if($payment['lesson_type'] == GROUP_AVAILABLE){
														$percentage = ($payment['omt_percentage']['omt_group_commission'] == 0 )? $payment['omt_percentage']['omt_commission'] : $payment['omt_percentage']['omt_group_commission'];
															$transaction_amount = (($payment['payment']['transaction_amount']/100)- (($payment['group_hourly_rate']*count($payment['lesson_students']))*$percentage)/100);
															 } else {
															$transaction_amount = (($payment['payment']['transaction_amount']/100)- (($payment['hourly_rate']*count($payment['lesson_students']))*$payment['omt_percentage']['omt_commission'])/100);
															} ?>
															<button class="btn btn-xs green green-color-btn" type="button" onclick="markAsPayed(<?php echo $payment['id'] ?>,<?php echo $payment['tutor_availability_id'] ?>,'<?php echo $payment['lesson_code'] ?>',<?php echo $payment['lesson_date'] ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'money-bag.png' ?>','<?php echo $transaction_amount ?>')"><i class="fa fa-money" aria-hidden="true"></i> Transfer Amount</button>
                                                        </div>
														<?php } ?>
														<div class="btn-group">
															<a href="<?php echo BACKEND_TUTOR_PAYMENT_HISTORY_URL.'/'.$payment['tutor_id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Detail </a>
														</div>
                                                    </td>
                                                </tr>
											<?php $count++;}
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
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
