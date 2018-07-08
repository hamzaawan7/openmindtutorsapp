
<main>
  <div class="container"> 
		<div class="container strip-line-cont">
		<?php if($common_data['user_data']['is_active'] == APPROVAL_STATUS_ID) { ?>
			<div class="strip-approval">
				<h4>Admin approval required to activate your account for teaching</h4>
			</div>
		<?php }	?>
		<?php if($common_data['user_data']['role'] == TUTOR){ ?>
		<?php if($common_data['user_data']['role'] == TUTOR && empty($tutor_details) || empty($payment_details)) { ?>
			<div class="strip-approval">
			<h4>
				Please complete your <?php echo (empty($common_data['user_data']['phone']))? "<a href='".ROUTE_PROFILE."'>profile</a> & ":""; ?>
				<?php echo (empty($tutor_details))? "<a href='".ROUTE_TUTOR_PUBLIC_PROFILE."'>public tutor profile</a> &":""; ?>
				<?php echo (empty($payment_details))? "<a href='".ROUTE_PAYMENTS_DETAILS."'> payment details</a>":""; ?>
			</h4>
			</div>
		<?php }
		}	?>
		</div>
    <!-- Users profile
======================================== -->
    <section class="profile">
      <div class="row">
        <div class="col-md-4">
          <div class="profile-image"><img alt="user profile" src="<?php echo ($common_data['user_data']['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$common_data['user_data']['image'] ?>"/></div>
          <div class="menu-list margin-60-0">
            <ul>
              <li><a href="<?php echo ROUTE_PROFILE ?>">Personal information</a></li>
			  </ul> 
            <ul>
              <li><a href="<?php echo ROUTE_TUTOR_PUBLIC_PROFILE?>">Public Tutor Profile</a></li>
              <li class="active-menu"><h5><a href="<?php echo ROUTE_ACCOUNT_SETTINGS?>" class="side-bar-active">Account Settings</a></h5></li>
            </ul>
          </div>
        </div>
        <div class="col-md-8">
          <div class="profile-head">
            <h5><?php echo ucwords($common_data['user_data']['first_name'].' '.$common_data['user_data']['last_name']) ?></h5>
			<?php if(!empty($tutor_badges)) {?>
			<label>Tutor Badge:</label>
				<span>
				<?php foreach ($badges as $badge){
					echo (in_array($badge['id'], $tutor_badges))? $badge['name'].', ':"";
				}?>
				</span>
			<?php } ?>
          </div>
		  <?php if(!empty($tutor_details)){ ?>
          <div class="row">
            <div class="col-sm-12">
              <ul class="long-arrow-list">
                <li><?php echo $tutor_details['headline'] ?></li>
              </ul>
			  <p><?php echo $tutor_details['personal_statement'] ?></p>
            </div>
          </div>
		  <?php } ?>
          <div class="border-box activation-feeds margin-0-30" style="height:auto;">
            <h6>Change Password</h6>
            <form class="sec" method="post" name="changePasswordForm" id="changePasswordForm"  onsubmit="changePassword(<?php echo $common_data['user_id'] ?>); return false;">
            <div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" id="password" class="form-control password_show" placeholder="Current Password">
                <span class="input-group-addon password-eye password_show_button"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
              </div>
            </div>
            <div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" id="password1" class="form-control password_show" placeholder="New Password">
                <span class="input-group-addon password-eye password_show_button"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
              </div>
            </div>
			<div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" id="con_password" class="form-control password_show" placeholder="Confirm Password">
                <span class="input-group-addon password-eye password_show_button"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
              </div>
            </div>
			<div class="form-group errorMsg" style="color:red"></div>
            <button type="submit" class="btn btn-blue"><i class="fa fa-unlock-alt" aria-hidden="true"></i>CHANGE PASSWORD</button>
          </form>
          </div>
		  <div class="border-box activation-feeds margin-0-30" style="height:auto;">
            <h6>Account Settings</h6>
			<?php if($common_data['user_data']['is_active'] !== APPROVAL_STATUS_ID) { ?>
			<div class="row"><input style="display:block" type="checkbox" id="account-settings" <?php echo ($common_data['user_data']['is_active'] == ACTIVE_STATUS_ID)? "checked":""; ?> data-off-color="danger" data-on-text="&nbsp;Enable&nbsp;" data-off-text="&nbsp;Disable&nbsp;" data-backdrop="static" data-keyboard="false">
				<p class="help-text-switch">Your account is now <?php echo ($common_data['user_data']['is_active'] == ACTIVE_STATUS_ID)? "enabled":"disabled"; ?></p>
			</div>
			<hr>
			<?php } ?>
			<div class="row">
			<a href="javascript:void(0);" onclick="deleteAccount(<?php echo DELETED_STATUS_ID ?>)" class="btn btn-sm btn-danger" title="Detail">Delete your account?</a>
				<p class="help-text-switch">Delete your account?</p>
			</div>
          </div>
        </div>
      </div>
    </section>
    <!-- users profile and --> 
  </div>
</main>