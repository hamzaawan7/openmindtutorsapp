				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Students
                            <a class="btn green pull-right" href="<?php echo BACKEND_STUDENTS_REPORT; ?>">Export student List</a>
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet light bordered students-page">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column students_list_table" id="datatable_user">
                                            <thead>
                                                <tr>
													<th style="display:none"></th>
                                                    <th>#</th>
                                                    <th> Username </th>
                                                    <th> Email </th>
                                                    <th> Password </th>
													<th> Registered Since </th>
                                                    <th> Verified </th>
                                                    <th> Status </th>													                                                    <th> Access </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </thead>
                                            <tbody>
										<?php if(!empty($users)){
											$count = 1;
												foreach($users as $student){
													if($student['role'] == STUDENT){?>
												<tr class="odd gradeX">
													<td style="display:none"></td>
                                                    <td><?php echo $count ?></td>
                                                    <td> <?php echo ucwords($student['first_name'].' '.$student['last_name']) ?> </td>
                                                    <td>
                                                        <a href="mailto:<?php echo $student['email'] ?>"> <?php echo $student['email'] ?> </a>
                                                    </td>

                                                    <td>      
                                                        
                                                         <?php 
                                                              $new_password_encrypted=decrypt_url($student['password']);  
                                                         ?>
                                                        <a> <?php echo $new_password_encrypted ?> </a>
                                                    </td>




													<td class="center"> <?php echo date('m/d/Y',$student['created']) ?> </td>
													<td><?php echo ($student['first_login'] == ACTIVE_STATUS_ID)? '<span class="label label-sm label-warning">Not Verified</span>':'<span class="label label-sm label-success">Verified</span>' ?> </td>
                                                    <td>
													<?php $status="";
													if($student['is_active'] == APPROVAL_STATUS_ID){$status='<span class="label label-sm label-warning">Pending</span>';}
													if($student['is_active'] == INACTIVE_STATUS_ID){$status='<span class="label label-sm label-danger">Suspended</span>';}
													if($student['is_active'] == ACTIVE_STATUS_ID){$status='<span class="label label-sm label-success">Approved</span>';}
													if($student['is_active'] == DISABLED_STATUS_ID){$status='<span class="label label-sm label-danger">Disabled</span>';}
													?>
                                                        <?php echo $status ?>
                                                    </td>													<td>													<?php $access_type="";													if($student['access_type'] == ACCESS_TYPE_LIMITED){$access_type='<span class="label label-sm label-warning">Limited</span>';}													if($student['access_type'] == ACCESS_TYPE_FULL){$access_type='<span class="label label-sm label-success">Complete</span>';}													?>                                                        <?php echo $access_type ?>                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                <i class="fa fa-angle-down"></i>
                                                            </button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li>
                                                                    <a href="javascript:;" onclick="changeUserStatus('<?php echo ASSET_IMAGES_BACKEND_DIR.'/tick-img.png'  ?>',<?php echo $student['id']?>,<?php echo ACTIVE_STATUS_ID ?>,'Are you sure you want to approve the user?')">
                                                                        <i class="fa fa-check-circle" aria-hidden="true"></i> Approve </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;" onclick="changeUserStatus('<?php echo ASSET_IMAGES_BACKEND_DIR.'/suspend-img.png'  ?>',<?php echo $student['id']?>,<?php echo INACTIVE_STATUS_ID ?>,'Are you sure you want to suspend the user?')">
                                                                        <i class="fa fa-power-off" aria-hidden="true"></i> Suspend </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:;" onclick="changeUserStatus('<?php echo ASSET_IMAGES_BACKEND_DIR.'/delete-img.png'  ?>',<?php echo $student['id']?>,<?php echo DELETED_STATUS_ID ?>,'Are you sure you want to delete the user?')">
                                                                        <i class="fa fa-trash-o"></i> Delete </a>
                                                                </li>
                                                            </ul>
                                                        </div>
														<div class="btn-group">
                                                            <a href="<?php echo BACKEND_STUDENT_DEATILS_URL.'/'.$student['id'] ?>" class="btn btn-xs green view_detail_btn"><i class="fa fa-search" aria-hidden="true"></i> View Detail </a>
														</div>														<div class="btn-group">                                                            <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Access Type                                                                <i class="fa fa-angle-down"></i>                                                            </button>                                                            <ul class="dropdown-menu" role="menu">                                                                <li>                                                                    <a href="javascript:;" onclick="changeUserAccessLevel('<?php echo ASSET_IMAGES_BACKEND_DIR.'/suspend-img.png'  ?>',<?php echo $student['id']?>,<?php echo ACCESS_TYPE_LIMITED ?>,'Are you sure you want to limit the access of this user?')">                                                                        <i class="fa fa-adjust" aria-hidden="true"></i> Limited </a>                                                                </li>                                                                <li>                                                                    <a href="javascript:;" onclick="changeUserAccessLevel('<?php echo ASSET_IMAGES_BACKEND_DIR.'/tick-img.png'  ?>',<?php echo $student['id']?>,<?php echo ACCESS_TYPE_FULL ?>,'Are you sure you want to give complete access to this user?')">                                                                        <i class="fa fa-check-circle" aria-hidden="true"></i> Complete </a>                                                                </li>                                                            </ul>                                                        </div>
                                                    </td>
                                                </tr> 
												<?php $count++;} 
												}
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
