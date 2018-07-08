<main>
  <div class="container">
    <div class="forum">
      <div class="row">
        <div class="col-md-3"> 
          <!-- Sidebar
	======================================== -->
          <aside>
            <div class="menu-list margin-0-60">
              <ul>
                <li><a href="<?php echo ROUTE_LESSONS ?>">Lessons</a></li>
                <li><a href="<?php echo ROUTE_MESSAGES ?>">Messages <?php echo (count($common_data['message_count']) != 0)? "(".count($common_data['message_count']).")":""; ?></a></li>
              </ul>
              <ul>
                <li class="active-menu"><h5><a href="<?php echo ROUTE_PAYMENTS_HISTORY ?>" class="side-bar-active">Payments</a></h5></li>
				<li><a href="<?php echo ROUTE_TUTOR_LEVEL ?>">My Tutor Level</a></li>
              </ul>
            </div>
          </aside>
          <!-- sidebar end --> 
        </div>
        <div class="col-md-9">
          <?php if(!empty($tutor_details)){ ?>
			<h5>Payment Details</h5>
			<form class="sec" method="post" name="savePaymentDetailsForm" id="savePaymentDetailsForm" onsubmit="savePaymentDetails(<?php echo $common_data['user_id']?>); return false;">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						<input type="text"  value="<?php echo $payment_details['title'] ?>" class="form-control" name="title" placeholder="Account Title"/>
					  </div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
						<input type="text"  value="<?php echo $payment_details['bank_name'] ?>" class="form-control" name="bank_name" placeholder="Bank Name"/>
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
						<input type="text"  value="<?php echo $payment_details['address'] ?>" class="form-control" name="address" placeholder="Address" />
					  </div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
						<input type="text"  value="<?php echo $payment_details['account_number'] ?>" class="form-control" name="account_number" placeholder="Account Number" />
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
						<input type="text"  value="<?php echo $payment_details['swift_code'] ?>" class="form-control" name="swift_code" placeholder="Swift / BIC" />
					  </div>
					</div>
				</div>
				<div class="col-sm-6 beneficiary_phone_number_section">
					<div class="col-xs-12 col-sm-6 col-lg-6">
						<div class="form-group has-feedback select-dropdown-webkit">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
							<select class="form-control" id="phone_code">
								<option value="0">Code</option>
								<?php foreach($countries as $country){ ?>
								<option value="<?php echo $country['phonecode'] ?>" <?php echo ($country['phonecode'] == $payment_details['phone_code'])? 'selected':''; ?>><?php echo $country['nicename'] ?> +<?php echo $country['phonecode'] ?></option>
								<?php } ?>
							</select>
						  </div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-lg-6">
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
							<input type="text" value="<?php echo $payment_details['phone'] ?>" class="form-control" name="phone" placeholder="Beneficiary Phone Number" />
						  </div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group errorMsg" style="color:red">
			</div>
			<div class="row payment-detail-save-btn">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-sm" href="#">Save</button>
				</div>
			</div>
			</form>
		  <?php } else { ?>
		  <div class="row">
            <div class="col-sm-12">
              <ul class="long-arrow-list">
                <li>Please complete your <a href="<?php echo ROUTE_TUTOR_PUBLIC_PROFILE ?>">tutor public profile</a></li>
              </ul>
            </div>
          </div>
		  <?php } ?>
        </div>
      </div>
    </div>
  </div>
</main>
