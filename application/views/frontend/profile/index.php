	<?php if($common_data['user_data']['role'] == INACTIVE_STATUS_ID) { ?>
		<div id="content" class="container">
        	<!-- /// CONTENT START /// -->
            <div id="page-header">
                <div class="row">
                	<div class="col-md-6 role-confirm">
                        <h2>Role Confirmation</h2>
                        <div class="signup">
		                    <form class="sec" method="post" name="roleConfirmationForm" id="roleConfirmationForm" onsubmit="roleConfirmation(<?php echo $common_data['user_id']; ?>); return false;">
								<label for="exampleInputEmail1">REGISTER AS</label>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
										<select class="form-control" name="role" id="role">
											<option value="0">--Select--</option>
											<option value="<?php echo TUTOR ?>">Tutor</option>
											<option value="<?php echo STUDENT ?>">Student</option>
										</select>
									</div>
								</div>
								<div class="form-group errorMsg" style="color:red">
								</div>
	                            <input class="btn btn-default" type="submit" value="Join">
	                      	</form>
                  		</div>
                	</div>
                </div>
            </div>

            <!-- /// CONTENT END /// -->
		</div><!-- end #content -->
		
			<!-- Google Code for Lead Conversion Page -->
			<script type="text/javascript">
			/* <![CDATA[ */
				var google_conversion_id = 845368476;
				var google_conversion_language = "en";
				var google_conversion_format = "3";
				var google_conversion_color = "ffffff";
				var google_conversion_label = "p4CrCL-G93UQnJmNkwM";
				var google_conversion_value = 15.00;
				var google_conversion_currency = "GBP";
				var google_remarketing_only = false;
			/* ]]> */
			</script>
			<script type="text/javascript" src="//https://l.facebook.com/l.php?u=http%3A%2F%2Fwww.googleadservices.com%2Fpagead%2Fconversion.js&h=ATPZp8czTJsc5i_7tczWUT8VXsbSHA9olMXJqjBSBFjaXBpc8DLlnKPYjgpkov9_yE1RTvPWfDxIfFYwF0HhEHcqbJPwMYIQwBCpjRHQdzKN8TVtYKNVtnE6agQOvncTggenRmILG43Xnaun">
			</script>
			<noscript>
				<div style="display:inline;">
					<img height="1" width="1" style="border-style:none;" alt="" src="//https://l.facebook.com/l.php?u=http%3A%2F%2Fwww.googleadservices.com%2Fpagead%2Fconversion%2F845368476%2F%3Fvalue%3D15.00%26amp%253Bcurrency_code%3DGBP%26amp%253Blabel%3Dp4CrCL-G93UQnJmNkwM%26amp%253Bguid%3DON%26amp%253Bscript%3D0%2522%252F&h=ATPZp8czTJsc5i_7tczWUT8VXsbSHA9olMXJqjBSBFjaXBpc8DLlnKPYjgpkov9_yE1RTvPWfDxIfFYwF0HhEHcqbJPwMYIQwBCpjRHQdzKN8TVtYKNVtnE6agQOvncTggenRmILG43Xnaun" >
				</div>
			</noscript>
		
		
	<?php } else { ?>
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
          <div class="profile-image"><img alt="user profile" class="image" src="<?php echo ($common_data['user_data']['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$common_data['user_data']['image'] ?>"/></div>
		  <div class="share edit_share">
            <div class="big-icon">
				<a id="txt" href="javascript:void(0)" onclick ="javascript:document.getElementById('imgInp2').click();">
					<i class="fa fa-pencil" aria-hidden="true"></i>
				</a>
				<input id="imgInp2" accept='image/*' type="file" style='visibility: hidden; opacity: 0; position: absolute; left: 0; right: 0; width: 100%;' name="imgInp2" onchange="ChangeText(this, 'txt');"/>
			</div>
          </div>
		  <input type="hidden" id="profile_image" value="<?php echo $common_data['user_data']['image'] ?>">
		  <p id="image-error" style="text-align: center;"></p>
          <div class="menu-list margin-60-0">
            <ul>
				<li class="active-menu"><h5><a href="<?php echo ROUTE_PROFILE ?>" class="side-bar-active">Personal information</a></h5></li>
              <li><a href="<?php echo ROUTE_TUTOR_PUBLIC_PROFILE?>">Public Tutor Profile</a></li>
              <li><a href="<?php echo ROUTE_ACCOUNT_SETTINGS?>">Account Settings</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-8">
          <div class="profile-head">
            <h5><?php echo ucwords($common_data['user_data']['first_name'].' '.$common_data['user_data']['last_name']) ?> 
		  <?php if($common_data['user_data']['role'] != STUDENT){ ?>
			<span class="pull-right"><a href="<?php echo (($access_type!=ACCESS_TYPE_FULL)?ROUTE_TUTOR_PROFILE:ROUTE_SEARCH_DETAIL).'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $common_data['user_data']['first_name'])))).'/'.$common_data['user_id'] ?>" class="btn btn-default go-to-profile-btn">Preview Profile</a></span>
		  <?php } else { ?>
			<span class="pull-right"><a href="<?php echo ROUTE_STUDENT_PROFILE_VIEW.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $common_data['user_data']['first_name'])))).'/'.$common_data['user_id'] ?>" style="margin-right: 5px;" class="btn btn-default go-to-profile-btn">Preview Profile</a></span>
		  <?php } ?>
			</h5>
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
          <!--<div class="border-box activation-feeds margin-0-30 scroll-element-added">
			<div id="scroll-content">-->
        	<div class="border-box margin-30">
            <div>
				<h6>Personal information</h6>
				<form class="sec" method="post" name="editProfileForm" id="editProfileForm" onsubmit="editProfile(<?php echo $common_data['user_id']?>); return false;">
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						<input type="text" value="<?php echo ucfirst($common_data['user_data']['first_name']) ?>" name="first_name" class="form-control" placeholder="First Name">
					  </div>
					</div>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						<input type="text" value="<?php echo ucfirst($common_data['user_data']['last_name']) ?>" name="last_name" class="form-control" placeholder="Last Name">
					  </div>
					</div>
					<div class="form-group has-feedback select-dropdown-webkit">
						<div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						  <select class="form-control" id="title">
							<option value="0">Title</option>
							<?php $title = unserialize(TITLES)?>
							<?php foreach($title as $key=>$row){ ?>
							<option value="<?php echo $key ?>" <?php echo ($key == $common_data['user_data']['title'])? 'selected':''; ?>><?php echo $row ?></option>
							<?php } ?>
						  </select>
						</div>
					  </div>
					<div class="form-group has-feedback select-dropdown-webkit">
						<div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
						  <select class="form-control" id="gender">
							<option value="0">Gender</option>
							<option value="<?php echo MALE ?>" <?php echo (MALE == $common_data['user_data']['gender'])? 'selected':''; ?>>Male</option>
							<option value="<?php echo FEMALE ?>" <?php echo (FEMALE == $common_data['user_data']['gender'])? 'selected':''; ?>>Female</option>
						  </select>
						</div>
					  </div>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
						<input type="text" value="<?php echo $common_data['user_data']['email'] ?>" name="email" class="form-control" placeholder="Email">
					  </div>
					</div>
							<input type="hidden" id="form_changed">
					<input type="hidden" id="hidden-phonecode" value="<?php echo $common_data['user_data']['phone_code'] ?>">
					<div class="form-group has-feedback select-dropdown-webkit">
						<div class="input-group"><span class="input-group-addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
						  <select class="form-control" id="phone_code">
								<option value="0">Country Code</option>
								<?php foreach($countries as $country){ ?>
								<option value="<?php echo $country['phonecode'] ?>" <?php echo ($country['phonecode'] == $common_data['user_data']['phone_code'])? 'selected':''; ?>><?php echo $country['nicename'] ?> +<?php echo $country['phonecode'] ?></option>
								<?php } ?>
							</select>
						</div>
					  </div>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
						<input type="text" value="<?php echo $common_data['user_data']['phone'] ?>" class="form-control" name="phone" placeholder="Phone">
					  </div>
					</div>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
						<input type="text"  value="<?php echo $common_data['user_data']['city'] ?>" class="form-control" name="city" id="city_auto" placeholder="City">
					  </div>
					</div>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
						<textarea class="form-control" name="address" placeholder="Address"><?php echo $common_data['user_data']['address'] ?></textarea>
					  </div>
					</div>
					<div class="form-group has-feedback available_days_timings_dropdown">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
						<select class="form-control" id="student_area">
							<option value="0">Select Area</option>
							<?php if (!empty($main_areas)){
									foreach($main_areas as $area){?>
										<option value="<?php echo $area['name'] ?>" <?php echo ($common_data["user_data"]["area"] == $area['name'])? 'selected':''; ?>><?php echo $area['name'] ?></option>
							<?php 	}
								} ?>
						</select>
					  </div>
					</div>
					<input type="hidden" id="hidden-country" value="<?php echo $common_data['user_data']['country_id'] ?>">
					<div class="form-group has-feedback select-dropdown-webkit" style="display:none">
						<div class="input-group"><span class="input-group-addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
						  <select class="form-control" id="country">
								<option value="0">Country</option>
								<?php foreach($countries as $country){ ?>
								<option value="<?php echo $country['id'] ?>" <?php echo ($country['id'] == "225")? 'selected':''; ?>><?php echo $country['nicename'] ?></option>
								<?php } ?>
							</select>
						</div>
					  </div>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-flag" aria-hidden="true"></i></span>
						<input type="text"  value="<?php echo $common_data['user_data']['postal_code'] ?>" class="form-control" id="postal_auto" name="postal_code" placeholder="Postal Code">
					  </div>
					</div>
					<div class="form-group has-feedback">
					  <div class="input-group">
						<img id="loading_dots" src="<?php echo FRONTEND_ASSET_IMAGES_DIR ?>loading_dots.gif" style="width: 40px; display:none;">
					  </div>
					</div>
					<?php if($common_data['user_data']['role'] == TUTOR && empty($common_data['user_data']['instruction'])){ ?>
					<div class="form-group has-feedback">
						<p>Do you also wish to use the website as a student?</p>
						<div class="radio">
							<input id="tutor_student_one" class="tutor_student" type="radio" name="tutor_student" value="1">
							<label for="tutor_student_one">Yes</label>
							<input id="tutor_student_two" class="tutor_student" type="radio" name="tutor_student" checked value="0">
							<label for="tutor_student_two">No</label>
						</div>
					</div>
					<?php } ?>
					<div id="user-profile-settings" style="<?php echo ($common_data['user_data']['role'] == TUTOR && empty($common_data['user_data']['instruction']))? "display:none":""; ?>">
					<div class="form-group has-feedback" style="display:none">
						<label>Instructions to find the house</label>
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
						<textarea class="form-control" name="instruction" placeholder="Instructions to find the house"><?php echo $common_data['user_data']['instruction'] ?></textarea>
					  </div>
					</div>
					<div class="form-group has-feedback available_days_timings_dropdown">
					  <label>Subjects you are interested in</label>
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
						<select class="form-control"  id="student_subject" multiple="multiple">
							<?php if (!empty($main_subjects)){
									foreach($main_subjects as $main_subject){?>
										<optgroup label="<?php echo $main_subject['name'] ?>">
											<?php foreach($main_subject['subjects'] as $subjects){ ?>
											<option value="<?php echo $main_subject['id'] ?>;<?php echo $subjects['subject_id'] ?>" <?php echo (in_array($subjects['subject_id'], $student_subjects))? "selected":""; ?>><?php echo $subjects['subject_name'] ?></option>
											<?php } ?>
										</optgroup>
							<?php 	}
								} ?>
						</select>
					  </div>
					</div>
					</div>
					<div class="form-group errorMsg" style="color:red">
					</div>
					<button type="submit" class="btn btn-blue">SAVE</button>
			  </form>
		  </div>
          </div>
        </div>
      </div>
    </section>
    <!-- users profile and --> 
  </div>
</main>
	<?php } ?>
	<script>
	$(document).ready(function(){ 
		if($('#hidden-phonecode').val() === ""){
			$('#phone_code').val('44');
		}
/*		if($('#hidden-country').val() === "" || $('#hidden-country').val() == "0"){
			$('#country').val('225');
		}*/
		$('#editProfileForm').change(function(){
			$('#form_changed').val('1');
		})
		$(window).bind('beforeunload', function(e) {
			if($('#form_changed').val() == 1){return "";
/*				bootbox.dialog({
				message: "Do you want to leave this site? Changes you made may not be saved.",
				className: "upload_modal",
				buttons: {
					success: {
						label: "OK",
						className: "btn-success",
						callback: function() {
						window.location = "<?php echo ROUTE_TUTOR_PUBLIC_PROFILE ?>";
						}
					},
					cancel: {
					label: "Cancel",
					className: "btn-success",
						callback: function() {
						window.location = "javascript:void(0)";
						}
					}
				}
				});*/
			}
		})
	})
	</script>