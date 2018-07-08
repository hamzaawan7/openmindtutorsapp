				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE TITLE-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Reviews
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user">
                                            <thead>
                                                <tr>
													<th style="display:none"></th>
                                                    <th>#</th>
                                                    <th> Tutor Name </th>
													<th> Subject </th>
													<th> Rating </th>
                                                    <th> Status </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
										<?php if(!empty($reviews)){$count =1;
												foreach ($reviews as $key=>$review){?>
                                                <tr class="odd gradeX">
													<td style="display:none"></td>
													<td><?php echo $count ?></td>
													<td><?php echo ucwords($review['first_name'].' '.$review['last_name']) ?></td>
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
                                                        <div class="btn-group view_detail_single_btn">
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
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
