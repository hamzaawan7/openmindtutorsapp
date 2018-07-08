				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE TITLE-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Reviews Detail
							<a class="btn green pull-right" href="<?php echo BACKEND_REVIEWS_URL ?>"><i class="fa fa-angle-left back-to-list-icon"></i> Back to Reviews List</a>
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
                                                        <img src="<?php echo ($reviewDetails['tutor_image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$reviewDetails['tutor_image'] ?>" class="img-responsive pic-bordered" alt="" />
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12 profile-info">
                                                        <h1 class="font-green sbold uppercase review-detail-title"><?php echo ucwords($reviewDetails['tutor_first_name'].' '.$reviewDetails['tutor_last_name']) ?> <span class="review-subjects">(English, French)</span> <span class="pull-right"><a href="<?php echo BACKEND_TUTOR_DEATILS_URL.'/'.$reviewDetails['tutor_id'] ?>" class="btn btn-sm btn-success">View Tutor Profile</a> <a href="<?php echo BACKEND_STUDENT_DEATILS_URL.'/'.$reviewDetails['student_id'] ?>" class="btn btn-sm btn-success">View Student Profile</a></span></h1>
                                                    </div>
													<div class="col-lg-12">
														<div class="portlet mt-element-ribbon light portlet-fit bordered">
															<div class="ribbon ribbon-right ribbon-clip ribbon-shadow ribbon-border-dash-hor ribbon-color-success uppercase">
																<div class="ribbon-sub ribbon-clip ribbon-right"></div> <input id="input-1" type="text" data-size="xs" value="<?php echo $reviewDetails['rating'] ?>"> </div>
															<div class="portlet-title">
																<div class="caption">
																	<span class="caption-subject font-green bold uppercase"><?php echo $reviewDetails['headline'] ?></span>
																</div>
															</div>
															<div class="portlet-body">
																<div class="review-title"><b>Student Name</b></div>
																<?php echo ucwords($reviewDetails['student_first_name'].' '.$reviewDetails['student_last_name']) ?><br /><br />
																<div class="review-title"><b>Review</b></div>
																<?php echo $reviewDetails['review'] ?><br /><br />
																<div class="review-title"><b>Outcome</b></div>
																<?php echo $reviewDetails['outcome'] ?><br /><br />
																<a href="javascript:void(0)" class="btn btn-success" onclick="changeReviewStatus('<?php echo ASSET_IMAGES_BACKEND_DIR.'tick-img.png'  ?>',<?php echo $reviewDetails['id']?>,<?php echo ACTIVE_STATUS_ID ?>,'Are you sure you want to approve this review?')">Approve</a>
																<a href="javascript:void(0)" class="btn btn-danger" onclick="changeReviewStatus('<?php echo ASSET_IMAGES_BACKEND_DIR.'cross-img.png'  ?>',<?php echo $reviewDetails['id']?>,<?php echo REJECTED_STATUS_ID ?>,'Are you sure you want to reject this review?')" style="margin-left: 5px;">Reject</a>
															</div>
														</div>
													</div>
												</div>
                                                <!--end row-->
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
