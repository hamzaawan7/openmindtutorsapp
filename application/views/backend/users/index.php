	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<!-- BEGIN CONTENT BODY -->
		<div class="page-content">
			<div class="row">
				<div class="col-md-12">
					<!-- Begin: life time stats -->
					<div class="portlet light portlet-fit portlet-datatable ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-users font-green"></i>
								<span class="caption-subject font-green sbold uppercase"> Users </span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
								<table class="table table-striped table-bordered table-hover table-checkable dataTables_wrapper no-footer contacts-table-style" id="datatable_user">
										<thead>
											<tr role="row" class="heading">
												<th width="1%" style="display:none"></th>
												<th width="1%"> # </th>
												<th width="2%"> Name </th>
												<th width="6%"> Email </th>
												<th width="4%"> Role </th>
												<th width="4%"> Image </th>
												<th width="6%"> Kitchen Name </th>
												<th width="10%"> Phone </th>
												<th width="6%"> Status </th>
												<th width="10%"> Action </th>
											</tr>
										</thead>
										<tbody>
										<?php if(!empty($users)){
											$count = 1;
												foreach($users as $user){?>
											<tr>
												<td style="display:none"></td>
												<td> <?php echo $count ?> </td>
												<td> <?php echo ucwords($user['first_name'].' '.$user['last_name']) ?> </td>
												<td> <?php echo $user['email'] ?> </td>
												<td> <?php echo ($user['role'] == TUTOR)? 'Host':'Guest'; ?> </td>
												<td> <img class="user-details-image" src="<?php echo ($user['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'users/'.$user['image'] ?>" ></td>
												<td> <?php echo ($user['kitchen_name'] == "")? 'N/A':$user['kitchen_name']; ?> </td>
												<td> <?php echo ($user['phone_code'] == "")? 'N/A':$user['phone_code'].$user['phone']; ?> </td>
												<td> <?php echo ($user['is_active'] == APPROVAL_STATUS_ID)? '<span class="label label-sm label-danger">Inactive</span>':'<span class="label label-sm label-success">Active</span>'; ?></td>
												<td>
													<a href="javascript:void(0)" title="<?php echo ($user['is_active'] == APPROVAL_STATUS_ID)? 'Activate':'Suspend' ?>" onclick="changeUserStatus(<?php echo $user['id'] ?>,<?php echo ($user['is_active'] == APPROVAL_STATUS_ID)? ACTIVE_STATUS_ID:APPROVAL_STATUS_ID; ?>,'Warning: Are you sure you want to <?php echo ($user['is_active'] == APPROVAL_STATUS_ID)? 'active':'in-active' ?> this user?')" class="btn btn-sm btn-circle btn-default btn-editable">
													<i class="fa fa-<?php echo ($user['is_active'] == APPROVAL_STATUS_ID)? 'check':'times'; ?>"></i></a>
													<a href="javascript:void(0)" title="Delete" onclick="changeUserStatus(<?php echo $user['id'] ?>,<?php echo DELETED_STATUS_ID ?>,'Warning: Are you sure you want to delete this user?<br />Note: There is no undo function')" class="btn btn-sm btn-circle btn-default btn-editable">
													<i class="fa fa-trash"></i></a>
													<a href="<?php echo BACKEND_USER_DEATILS_URL.'/'.$user['id'] ?>" title="View Details" class="btn btn-sm btn-circle btn-default btn-editable">
													<i class="fa fa-bars"></i></a>
											   </td>
											</tr>
										<?php $count++; }
										} ?>
										</tbody>
									</table>
							</div>
						</div>
					</div>
					<!-- End: life time stats -->
				</div>
			</div>
		</div>
		<!-- END CONTENT BODY -->
	</div>
	<!-- END CONTENT -->
