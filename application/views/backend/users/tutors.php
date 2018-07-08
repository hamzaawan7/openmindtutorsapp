				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Tutors
						<a class="btn green pull-right" href="<?php echo BACKEND_TUTORS_REPORT; ?>">Export Tutors List</a>
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
                                                    <th> Username </th>
                                                    <th> Email </th>
                                                    <th> Password </th>
													<th> Registered Since </th>
                                                    <th> Verified </th>
													<th> Personal Information </th>
													<th> Certificates </th>
                                                    <th> Status </th>
                                                    <th> Access </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
										<?php if(!empty($users)){
											$count = 1;
												foreach($users as $tutor){
													if($tutor['role'] == TUTOR || $tutor['role'] == STUDENT && $tutor['hourly_rate'] != ""){?>
												<tr class="odd gradeX">
													<td style="display:none"></td>
                                                    <td><?php echo $count ?></td>
                                                    <td> <?php echo ucwords($tutor['first_name'].' '.$tutor['last_name']) ?><br />
													<a href="<?php echo (($tutor['access_type']!=ACCESS_TYPE_FULL)?ROUTE_TUTOR_PROFILE:ROUTE_SEARCH_DETAIL).'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $tutor['first_name'])))).'/'.$tutor['id'] ?>" target="_blank">Preview Profile</a>
													</td>
                                                    <td>
                                                        <a href="mailto:<?php echo $tutor['email'] ?>"> <?php echo $tutor['email'] ?> </a>
                                                    </td>

                                                    <td>
    
                                                         <?php 
                                                              $new_password_encrypted=decrypt_url($tutor['password']);  
                                                         ?>
                                                          <a> <?php echo $new_password_encrypted  ?> </a>
                                                    </td>
													<td class="center"> <?php echo date('m/d/Y',$tutor['created']) ?> </td>
													<td><?php echo ($tutor['first_login'] == ACTIVE_STATUS_ID)? '<span class="label label-sm label-warning">Not Verified</span>':'<span class="label label-sm label-success">Verified</span>' ?> </td>
                                                    <td>
                                                        <a href="<?php echo ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$tutor['info_file'] ?>" download id="download"> <?php echo $tutor['info_file'] ?> </a>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$tutor['certificate_file'] ?>" download id="download"> <?php echo $tutor['certificate_file'] ?> </a>
                                                    </td>
                                                    <td>
													<?php $status="";
													if($tutor['is_active'] == APPROVAL_STATUS_ID){$status='<span class="label label-sm label-warning">Pending</span>';}
													if($tutor['is_active'] == INACTIVE_STATUS_ID){$status='<span class="label label-sm label-danger">Suspended</span>';}
													if($tutor['is_active'] == ACTIVE_STATUS_ID){$status='<span class="label label-sm label-success">Approved</span>';}
													if($tutor['is_active'] == DISABLED_STATUS_ID){$status='<span class="label label-sm label-danger">Disabled</span>';}
													?>
                                                        <?php echo $status ?>
                                                    </td>
													<td>
													<?php $access_type="";

													if($tutor['access_type'] == ACCESS_TYPE_LIMITED){$access_type='<span class="label label-sm label-warning">Limited</span>';}

													if($tutor['access_type'] == ACCESS_TYPE_FULL){$access_type='<span class="label label-sm label-success">Complete</span>';}

													?>

                                                        <?php echo $access_type ?>

                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
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
														<div class="btn-group">
                                                            <a href="<?php echo BACKEND_TUTOR_DEATILS_URL.'/'.$tutor['id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Detail </a>
														</div>
														<div class="btn-group">

                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Access Type

                                                                <i class="fa fa-angle-down"></i>

                                                            </button>

                                                            <ul class="dropdown-menu" role="menu">

                                                                <li>

                                                                    <a href="javascript:;" onclick="changeUserAccessLevel('<?php echo ASSET_IMAGES_BACKEND_DIR.'/suspend-img.png'  ?>',<?php echo $tutor['id']?>,<?php echo ACCESS_TYPE_LIMITED ?>,'Are you sure you want to limit the access of this user?')">

                                                                        <i class="fa fa-adjust" aria-hidden="true"></i> Limited </a>

                                                                </li>

                                                                <li>

                                                                    <a href="javascript:;" onclick="changeUserAccessLevel('<?php echo ASSET_IMAGES_BACKEND_DIR.'/tick-img.png'  ?>',<?php echo $tutor['id']?>,<?php echo ACCESS_TYPE_FULL ?>,'Are you sure you want to give complete access to this user?')">

                                                                        <i class="fa fa-check-circle" aria-hidden="true"></i> Complete </a>

                                                                </li>

                                                            </ul>

                                                        </div>
                                                    </td>
                                                </tr> 
												<?php $count++;} }
											} ?>
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
