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
								<i class="fa fa-bank font-green"></i>
								<span class="caption-subject font-green sbold uppercase"> Host Payment Details </span>
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
												<th width="6%"> Kitchen Name </th>
												<th width="6%"> Account Title </th>
												<th width="6%"> Bank Name </th>
												<th width="6%"> Address </th>
												<th width="4%"> Account Number </th>
												<th width="4%"> Swift Code </th>
												<th width="6%"> Phone </th>
											</tr>
										</thead>
										<tbody>
										<?php if(!empty($payment_details)){
											$count = 1;
												foreach($payment_details as $payment_detail){?>
											<tr>
												<td style="display:none"></td>
												<td> <?php echo $count ?> </td>
												<td> <?php echo ucwords($payment_detail['first_name'].' '.$payment_detail['last_name']) ?> </td>
												<td> <?php echo $payment_detail['email'] ?> </td>
												<td> <?php echo ($payment_detail['role'] == TUTOR)? 'Host':'Guest'; ?> </td>
												<td> <?php echo $payment_detail['kitchen_name'] ?> </td>
												<td> <?php echo $payment_detail['title'] ?> </td>
												<td> <?php echo $payment_detail['bank_name'] ?> </td>
												<td> <?php echo $payment_detail['address'] ?> </td>
												<td> <?php echo $payment_detail['account_number'] ?> </td>
												<td> <?php echo $payment_detail['swift_code'] ?> </td>
												<td> <?php echo $payment_detail['phone_code'].$payment_detail['phone'] ?> </td>
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
