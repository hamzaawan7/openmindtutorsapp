        <div class="container">
        	<div id='content' class="tab-content">
            	<div class="tab-pane active" id="dashboard">
                	<div class="row margin-zero dashboard-sample-header">
                    	<div class="col-sm-12">
                        	<h1>Messages</h1><br>
                        </div>
                    </div>
                </div>
				<div id="main_profile_view">
					<div class="row margin-zero profile-detail">
						<!--<h3>Personal Data</h3>-->
						<div class="form-horizontal">
							<div class="row margin-zero">
								<?php if($reservation_details['status'] != COMPLETED){ ?>
									<a href="javascript:void(0)" onclick="changeReservationStatus(<?php echo $reservation_details['id']?>,<?php echo CANCELED ?>,'Are you sure you want to cancle this reservation')" style="background: green; color:white; font-size:14px;text-align: center;border-radius: 2px; padding: 5px;">Cancle Reservation</a>
								<?php } ?>
						<?php if(empty($payment['transaction_amount']) || $payment['transaction_amount'] < $reservation_details['bill'] && $common_data['user_data']['role'] != TUTOR){ ?>
						<br>
						<form action="<?php echo ROUTE_ADD_PAYMENTS.'/'.$reservation_details['id'] ?>" method="post" name="paymentForm" id="paymentForm">
							<script src="https://beautiful.start.payfort.com/checkout.js"
								data-key="<?php echo PAYFORT_START_OPEN_KEY_TEST ?>"
								data-currency="<?php echo CURRENCY ?>"
								data-amount="<?php echo $reservation_details['bill'] ?>"
								data-email="<?php echo $common_data['user_data']['email'] ?>">
							</script>
						</form>
						<?php } ?>
						<?php if($common_data['user_data']['role'] == TUTOR){ ?>
						<?php if($reservation_details['status'] != COMPLETED){ ?>
						<div class="row">
							<div class="col-sm-12">
								<label>Change Reservation Status</label>
								<select class="form-control" id="reservation_status" onchange="changeReservationStatusHost(<?php echo $reservation_details['id'] ?>)">
									<option value="0">--Select--</option>
									<option value="<?php echo PENDING ?>" <?php echo ($reservation_details['status'] == PENDING)? 'selected':''; ?>>Pending</option>
									<option value="<?php echo APPROVED ?>" <?php echo ($reservation_details['status'] == APPROVED)? 'selected':''; ?>>Approve</option>
									<option value="<?php echo CANCELED ?>" <?php echo ($reservation_details['status'] == CANCELED)? 'selected':''; ?>>Canceled</option>
									<option value="<?php echo PENDING_APPROVAL ?>" <?php echo ($reservation_details['status'] == PENDING_APPROVAL)? 'selected':''; ?>>Ask Guest to mark this reservation complete</option>
								</select>
							</div>
						</div>
						<?php }} else { 
							if($reservation_details['status'] == PENDING_APPROVAL){?>
						<div class="row">
							<div class="col-sm-12">
								<label>Change Reservation Status</label>
								<select class="form-control" id="reservation_status" onchange="changeReservationStatusHost(<?php echo $reservation_details['id'] ?>)">
									<option value="0">--Select--</option>
									<option value="<?php echo DISPUTED ?>" <?php echo ($reservation_details['status'] == DISPUTED)? 'selected':''; ?>>Disputed</option>
									<option value="<?php echo COMPLETED ?>" <?php echo ($reservation_details['status'] == COMPLETED)? 'selected':''; ?>>Completed</option>
								</select>
							</div>
						</div>
						<?php }} ?>
							</div>
							<br>
							<div class="row margin-zero">
								<div class="col-sm-12">
									<?php if ($common_data['user_data']['role'] == GUEST){ ?>
									<img src="<?php echo ($reservation_details['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'users/'.$reservation_details['image'] ?>" alt="Profile Picture" class="image" />
									<label><?php echo ucfirst($reservation_details['first_name']).' '.ucfirst($reservation_details['last_name']) ?></label><br>
									<span><?php echo $reservation_details['kitchen_name'] ?></span><br>
									<?php } else { ?>
									<img src="<?php echo ($guest_details['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'users/'.$guest_details['image'] ?>" alt="Profile Picture" class="image" />
									<label><?php echo ucfirst($guest_details['first_name']).' '.ucfirst($guest_details['last_name']) ?></label><br>
									<?php } ?>
								</div>
							</div>
							<br>
							<div class="row margin-zero">
								<div class="col-sm-12">
									<img src="<?php echo ($common_data['user_data']['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'users/'.$common_data['user_data']['image'] ?>" alt="Profile Picture" class="image" />
									<textarea id="reply_message" class="form-control" placeholder="Your reply message"></textarea>
									<div class="errorMsg" style="color:red"></div>
									<button type="button" onclick="sendReply(<?php echo $common_data['user_id'] ?>,<?php echo ($common_data['user_id'] == $reservation_details['tutor_id'])? $reservation_details['student_id'] : $reservation_details['tutor_id'] ?>,<?php echo $reservation_details['id'] ?>)" class="btn">Reply</button>
								</div>
							</div>
							<div id="main-message">
							<?php if(!empty($messages)) {
								foreach ($messages as $message){?>
								<div class="row margin-zero <?php echo ($message['receiver_id'] == $common_data['user_id'] && $message['status'] == UNSEEN)? 'new-message':''; ?>">
									<div class="<?php echo ($message['sender_id'] != $common_data['user_id'])? '':'inverted' ?>">
										<div class="col-sm-12" style="<?php echo ($message['receiver_id'] == 0)? 'text-align:center':''; ?>">
											<span><?php echo $message['message'] ?></span><br>
											<?php if($message['receiver_id'] != $common_data['user_id']){ ?>
											<span><?php echo ($message['receiver_id'] == 0)? 'Sent By Admin About':'Sent about'; ?> <b><?php echo dateDiff_ago($message['created']) ?></b> <?php echo ($message['status'] == SEEN)? '<i class="fa fa-check" aria-hidden="true"></i>SEEN':''; ?><span>
											<?php } else { ?>
											<span>Received about <b><?php echo dateDiff_ago($message['created']) ?></b><span>
											<?php } ?>
										</div>
									</div>
								</div>
								<hr>
							<?php } 
							}?>
								<div class="row margin-zero">
									<div style="border: 1px solid;">
										<div class="row">
											<div class="col-sm-12">
												<label>Hooray! you have requested to join grub connect event</label><br>
												<span>Please be patient and wait for the chef to approve it</span><hr>
												<label>Booking for:</label><span> <?php echo $reservation_details['kitchen_name'] ?></span>
												<span style="float:right">Menu Name: <?php echo $reservation_details['menu_name'] ?></span><br>
												<span><?php echo date('F d, Y',$reservation_details['reservation_date']).' '.$reservation_details['time'] ?> <b><?php echo $reservation_details['seats'] ?> Guests</b></span>
												<span style="float:right">Total Price: <?php echo CURRENCY_SYMBOL ?><?php echo $reservation_details['seats']*$reservation_details['price'] ?> <?php echo CURRENCY ?></span>
												<?php if($reservation_details['status'] != CANCELED){ ?>
												<br><a style="background: green; color:white; font-size:14px;text-align: center;border-radius: 2px; padding: 5px;" href="<?php echo ROUTE_EDIT_RESERVATION.'/'.$reservation_details['id'] ?>" title="Edit">Change Reservation</a>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
          	</div>
      	</div>
		<script>
		$(document).ready(function(){
			$('.new-message').css('background-color', '#f2f2f2');
			setTimeout(function(){
				$('.new-message').css('background-color', '#ffffff');}, 3000);
		});
		</script>
