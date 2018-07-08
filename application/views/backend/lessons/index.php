				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Lessons
							<div class="pull-right">
								<select class="form-control" id="lesson_filter" onchange="lessonFilter()">
									<option value="0">Select Status</option>
									<option value="<?php echo DISPUTED ?>" <?php echo (isset($_GET['lesson']) && $_GET['lesson'] == DISPUTED)? "selected":""; ?>>Disputed</option>
									<option value="<?php echo COMPLETED ?>" <?php echo (isset($_GET['lesson']) && $_GET['lesson'] == COMPLETED)? "selected":""; ?>>Completed</option>
									<option value="<?php echo PENDING ?>" <?php echo (isset($_GET['lesson']) && $_GET['lesson'] == PENDING)? "selected":""; ?>>Pending</option>
								</select>
							</div>
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
													<th width="1%" style="display:none"></th>
                                                    <th>#</th>
													<th> Lesson Code </th>
                                                    <th> Tutor's Name </th>
                                                    <th> Session Type </th>
													<th> Lesson Date / Time </th>
                                                    <th> Status </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
										<?php if(!empty($lessons)){
											$count = 1;
												foreach($lessons as $lesson){?>
                                                <tr class="odd gradeX">
													<td style="display:none"></td>
                                                    <td> <?php echo $count ?> </td>
													<td> <?php echo $lesson['lesson_code'] ?> </td>
                                                    <td> <?php echo ucwords($lesson['first_name'].' '.$lesson['last_name']) ?> </td>
                                                    <td>
                                                        <span class="label label-sm label-<?php echo ($lesson['lesson_type'] == GROUP_AVAILABLE)? "info":"primary"; ?>"> <?php echo ($lesson['lesson_type'] == GROUP_AVAILABLE)? "Group":"Individual"; ?> </span>
                                                    </td>
													<?php $times_available = unserialize(TIMES) ?>
													<td class="center"> <?php echo date("m/d/Y",$lesson['lesson_date']) ?> (<?php echo $times_available[$lesson['time_available']] ?>)</td>
													<?php
														$status = '';
														if($lesson['status'] == PENDING){ $status = '<span class="label label-sm label-warning">Pending</span>'; }
														if($lesson['status'] == CANCELED){ $status = '<span class="label label-sm label-info">Canceled</span>'; }
														if($lesson['status'] == APPROVED){ $status = '<span class="label label-sm label-success">Approved</span>'; }
														if($lesson['status'] == PENDING_APPROVAL){ $status = '<span class="label label-sm label-primary">Pending Approval</span>'; }
														if($lesson['status'] == DISPUTED){ $status = '<span class="label label-sm label-danger">Disputed</span>'; }
														if($lesson['status'] == COMPLETED){ $status = '<span class="label label-sm label-success">Completed</span>'; }
														if($lesson['status'] == INACTIVE_STATUS_ID){ $status = '<span class="label label-sm label-warning">Pending</span>'; }
													?>
                                                    <td> <?php echo $status ?> </td>
                                                    <td>
														<div class="btn-group view_detail_lesson_request">
                                                            <a href="<?php echo BACKEND_LESSON_DETAILS_URL.'/'.$lesson['id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Detail </a>
														</div>
                                                    </td>
                                                </tr>
										<?php $count++; }
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
