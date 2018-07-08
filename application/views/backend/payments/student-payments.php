				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Students <i class="fa fa-arrow-right" aria-hidden="true"></i> OMT Payments
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered students-payment-page">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user">
                                            <thead>
                                                <tr>
													<th style="display:none"></th>
                                                    <th>#</th>
                                                    <th> Lesson Code </th>
                                                    <th> Student Name </th>
													<th> Transaction Amount </th>
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
                                                    <td><?php echo $payment['lesson_code'] ?></td>
                                                    <td><?php echo ucwords($payment['first_name'].' '.$payment['last_name']) ?></td>
													<td><?php echo CURRENCY_SYMBOL.$payment['transaction_amount']/100 ?></td>
													<?php
														$status = '';
														if($payment['status'] == TRANSFERRED_BY_GUEST){ $status = '<span class="label label-sm label-success"> Transferred </span>'; }
														if($payment['status'] == REFUNDED){ $status = '<span class="label label-sm label-info"> refunded </span>'; }
														if($payment['status'] == ONHOLD){ $status = '<span class="label label-sm label-danger"> Disputed </span>'; }
														if($payment['status'] == TRANSFERRED_BY_ADMIN){ $status = '<span class="label label-sm label-success"> Transferred </span>'; }
													?>
													<td> <?php echo $status ?> </td>
													<td>
													<?php if($payment['payment_status'] != ACTIVE_STATUS_ID && empty($payment['payment_refund_status'])){ ?>
                                                        <div class="btn-group">
															<button class="btn btn-xs green green-color-btn" type="button" onclick="refund(<?php echo $payment['lesson_id'] ?>,'<?php echo $payment['transaction_id'] ?>',<?php echo $payment['tutor_availability_id'] ?>,'<?php echo $payment['lesson_code'] ?>',<?php echo $payment['lesson_date'] ?>,'<?php echo ASSET_IMAGES_BACKEND_DIR.'tick-img.png'  ?>','Are you sure you want to refund the amount? This can not be undone',<?php echo $payment['transaction_amount'] ?>,<?php echo $payment['student_id'] ?>);"><i class="fa fa-undo" aria-hidden="true"></i> Refund Amount</button>
                                                        </div>
													<?php } ?>
														<div class="btn-group">
                                                            <a href="<?php echo BACKEND_STUDENT_PAYMENT_HISTORY_URL.'/'.$payment['student_id'].'?lesson_id='.$payment['lesson_id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Detail </a>
														</div>
                                                    </td>
                                                </tr>
											<?php $count++;}
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
