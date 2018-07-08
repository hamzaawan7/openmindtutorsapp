<main>
  <div class="container"> 
		<div class="container strip-line-cont">
		<?php if($common_data['user_data']['is_active'] == APPROVAL_STATUS_ID) { ?>
			<div class="strip-approval">
				<h4>Admin approval required to activate your account for teaching</h4>
			</div>
		<?php }	?>
		<?php if($common_data['user_data']['role'] == TUTOR && empty($tutor_details) || empty($payment_details)) { ?>
			<div class="strip-approval">
			<h4>
				Please complete your <?php echo (empty($common_data['user_data']['phone']))? "<a href='".ROUTE_PROFILE."'>profile</a> & ":""; ?>
				<?php echo (empty($tutor_details))? "<a href='".ROUTE_TUTOR_PUBLIC_PROFILE."'>public tutor profile</a> &":""; ?>
				<?php echo (empty($payment_details))? "<a href='".ROUTE_PAYMENTS_DETAILS."'> payment details</a>":""; ?>
			</h4>
			</div>
		<?php }	?>
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
				<li class="active-menu"><h5><a href="<?php echo ROUTE_TUTOR_PUBLIC_PROFILE ?>" class="side-bar-active">Public Tutor Profile</a></h5></li>
				<li><a href="<?php echo ROUTE_ACCOUNT_SETTINGS?>">Account Settings</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-8">
          <div class="profile-head">
            <h5><?php echo ucwords($common_data['user_data']['first_name'].' '.$common_data['user_data']['last_name']) ?>
			<?php if($common_data['user_data']['role'] == STUDENT && !empty($tutor_details) || $common_data['user_data']['role'] == TUTOR){ ?>
			<span class="pull-right"><a href="<?php echo ROUTE_SEARCH_DETAIL.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $common_data['user_data']['first_name'])))).'/'.$common_data['user_id'] ?>" class="btn btn-default go-to-profile-btn">Preview Profile</a></span>
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
		  <?php /*if(!empty($tutor_details)){ ?>
          <div class="row">
            <div class="col-sm-12">
              <ul class="long-arrow-list">
                <li><?php echo $tutor_details['headline'] ?></li>
              </ul>
			  <p><?php echo $tutor_details['personal_statement'] ?></p>
            </div>
          </div>
		  <?php }*/ ?>
				<?php if($common_data['user_data']['role'] == STUDENT && empty($tutor_details)){ ?>
                <h6>Status</h6>
                <div class="form-group has-feedback">
                	<p>Are you available for teaching?</p>
					<div class="radio">
						<input id="group_stu_one" class="stu_study_group" type="radio" name="stu_study_group" value="1">
						<label for="group_stu_one">Yes</label>
						<input id="group_stu_two" class="stu_study_group" type="radio" name="stu_study_group" checked value="0">
						<label for="group_stu_two">No</label>
					</div>
                </div>
				<?php } ?>
          <div class="row">
             <div class="col-sm-12">
				<form method="post" name="addTutorForm" id="addTutorForm" onsubmit="return false;" <?php echo ($common_data['user_data']['role'] == STUDENT && empty($tutor_details))? "style='display:none'":""; ?>>
				<!--<div style="margin-top:20px"><b>Note: Before you begin, please have your identity documents (Valid Passport/UK Driving License, DRB), and qualification documents ready</b>
				</div>-->
				<div class="panel-group margin-30 tutor-profile-tabs" id="accordion" role="tablist" aria-multiselectable="true">
                 <div class="panel panel-default active">
                    <div class="panel-heading" role="tab" id="headingOne">
                       <h4 class="panel-title"> <a class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Tutor Information</a> </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
                       <div class="panel-body">
					
							<div class="form-group has-feedback available_days_timings_dropdown">
							  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
								<select class="form-control"  id="tutor_subject" multiple="multiple">
									<?php if (!empty($main_subjects)){
											foreach($main_subjects as $main_subject){?>
												<optgroup label="<?php echo $main_subject['name'] ?>">
													<?php foreach($main_subject['subjects'] as $subjects){ ?>
													<option value="<?php echo $main_subject['id'] ?>;<?php echo $subjects['subject_id'] ?>" <?php echo (!empty($tutor_details) && in_array($subjects['subject_id'], $tutor_details['subjects']))? "selected":""; ?>><?php echo $subjects['subject_name'] ?></option>
													<?php } ?>
												</optgroup>
									<?php 	}
										} ?>
								</select>
							  </div>
							</div>
							<div class="form-group has-feedback available_days_timings_dropdown">
							  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
								<select class="form-control"  id="subject_level" multiple="multiple">
									<?php if (!empty($teaching_levels)){
											foreach($teaching_levels as $teaching_level){?>
												<option value="<?php echo $teaching_level['name'] ?>" <?php echo (!empty($tutor_details) && in_array($teaching_level['name'], explode(",",$tutor_details['subject_level'])))? "selected":""; ?>><?php echo $teaching_level['name'] ?></option>
											<?php } ?>
									<?php } ?>
								</select>
							  </div>
							</div>
							<!--<div class="form-group has-feedback">
							  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
								<input type="text" id="subject_level" value="<?php echo (!empty($tutor_details))? $tutor_details['subject_level']:""; ?>" class="form-control level_autocomplete1" placeholder="At what academic level would you like to teach these subject?">
							  </div>
							</div>-->
							<div class="form-group has-feedback select-dropdown-webkit">
							  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
								<select class="form-control" id="travel_distance">
									<option value="0">Distance you can travel around your postcode?</option>
									<?php foreach(unserialize(DISTANCE) as $key=>$row){?>
										<option value="<?php echo $key ?>" <?php echo (!empty($tutor_details) && $key==$tutor_details['travel_distance'])? "selected":""; ?> ><?php echo $row ?></option>
									<?php } ?>						
								</select>
							  </div>
							</div>
							<div class="form-group has-feedback">
							  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
								<input type="text" id="headline" value="<?php echo (!empty($tutor_details))? $tutor_details['headline']:""; ?>" class="form-control" placeholder="Headline">
							  </div>
							</div>
							<div class="form-group has-feedback">
							  <div class="input-group"><span class="input-group-addon"><i class="fa fa-edit" aria-hidden="true"></i></span>
								<textarea id="personal_statement" rows="6" class="form-control" placeholder="Personal Statement"><?php echo (!empty($tutor_details))? $tutor_details['personal_statement']:""; ?></textarea>
							  </div>
							</div>
							<div class="row">
							<input type="hidden" id="form_changed">
							<h6>How much do you want to charge per hour?</h6>
								<div class="col-sm-6">
									<div class="form-group has-feedback">
									  <div class="input-group"><span class="input-group-addon"><i class="fa fa-gbp" aria-hidden="true"></i></span>
										<input type="text" class="form-control" placeholder="Your clients will pay for single lesson" onkeyup="handleChange(this);" value="<?php echo (!empty($tutor_details))? $tutor_details['hourly_rate']:""; ?>" id="hourly_rate" title="Hourly rate should not be greater than <?php echo $tutor_level['max_charge'] ?>" />
										<?php if ($tutor_level['max_charge']==0) { ?>
										<span class="input-group-addon" onclick="successAlertRate('There is no Max hourly rate limit in <?php echo $tutor_level["title"]; ?>.','<?php echo ROUTE_CONTACT_US ?>');" style="cursor:pointer; background-color: #ffffff;"><i style="color:#333333;" class="fa fa-question-circle" aria-hidden="true"></i></span>
										<?php } else { ?>
										<span class="input-group-addon" onclick="successAlertRate('Max hourly rate limit in <?php echo $tutor_level["title"]?> is <?php echo CURRENCY_SYMBOL ?><?php echo $tutor_level["max_charge"] ?>.','<?php echo ROUTE_CONTACT_US ?>');" style="cursor:pointer; background-color: #ffffff;"><i style="color:#333333;" class="fa fa-question-circle" aria-hidden="true"></i></span>
										<?php } ?>
									  </div>
									</div>
								</div>
								<input type="hidden" id="level_id" value="<?php echo $tutor_level['id'] ?>">
								<input type="hidden" id="max_charge" value="<?php echo $tutor_level['max_charge'] ?>">
								<input type="hidden" id="omt_commission" value="<?php echo $tutor_level['omt_commission'] ?>">
								<input type="hidden" id="max_group" value="<?php echo $tutor_level['max_group_students'] ?>">
								<div class="col-sm-6">
									<div class="form-group has-feedback">
									  <div class="input-group"><span class="input-group-addon"><i class="fa fa-gbp" aria-hidden="true"></i></span>
										<input type="text" class="form-control" id="hourlyrate_percent" value="<?php echo (!empty($tutor_details))? $tutor_details['hourly_rate']-(($tutor_details['hourly_rate']*$tutor_level['omt_commission'])/100):""; ?>" placeholder="You will earn" disabled>
									  </div>
									</div>
								</div>
							<h6 style="display: inline-block;">Do you also wish to teach group lessons?</h6> <span onclick="successAlerts('We group students by marketing the syllabus that you set for each lesson. Any student who wishes to study the material may then join the lesson pending your approval','javascript:void(0);');" style="cursor:pointer;"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
							<?php if(!empty($tutor_details) && !empty($tutor_details['group_hourly_rate'])){?>
						<div class="radio">
							<input id="group_one" class="study_group" type="radio" name="study_group" value="1" <?php echo (!empty($tutor_details) && !empty($tutor_details['group_hourly_rate']))? "checked":""; ?>>
							<label for="group_one">Yes</label>
							<input id="group_two" class="study_group" type="radio" name="study_group" value="0" <?php echo (!empty($tutor_details) && empty($tutor_details['group_hourly_rate']))? "checked":""; ?>>
							<label for="group_two">No</label>
						</div>
							<?php } else { ?>
						<div class="radio">
							<input id="group_one" class="study_group" type="radio" name="study_group" value="1" >
							<label for="group_one">Yes</label>
							<input id="group_two" class="study_group" type="radio" name="study_group" value="0" checked >
							<label for="group_two">No</label>
						</div>
							<?php } ?>
								<div class="group_study" <?php echo (!empty($tutor_details) && !empty($tutor_details['group_hourly_rate']))? "":"style='display:none'"; ?>>
								<h6>How much do you want to charge for group lessons?</h6>
									<div class="col-sm-6">
										<div class="form-group has-feedback">
										  <div class="input-group"><span class="input-group-addon"><i class="fa fa-gbp" aria-hidden="true"></i></span>
											<input type="text" class="form-control" placeholder="Your clients will pay for group lesson" onkeyup="handleChange(this);" value="<?php echo (!empty($tutor_details))? $tutor_details['group_hourly_rate']:""; ?>" id="group_hourly_rate" title="Hourly rate should not be greater than <?php echo $tutor_level['max_charge'] ?>" />
											<?php if ($tutor_level['max_charge']==0) { ?>
											<span class="input-group-addon" onclick="successAlertRate('There is no Max hourly rate limit in <?php echo $tutor_level["title"]; ?>.','<?php echo ROUTE_CONTACT_US ?>');" style="cursor:pointer; background-color: #ffffff"><i style="color:#333333;" class="fa fa-question-circle" aria-hidden="true"></i></span>
											<?php } else { ?>
											<span class="input-group-addon" onclick="successAlertRate('Max hourly rate limit in <?php echo $tutor_level["title"]?> is <?php echo CURRENCY_SYMBOL ?><?php echo $tutor_level["max_charge"] ?>.','<?php echo ROUTE_CONTACT_US ?>');" style="cursor:pointer; background-color:#ffffff"><i style="color:#333333;" class="fa fa-question-circle" aria-hidden="true"></i></span>
											<?php } ?>
										  </div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group has-feedback">
										  <div class="input-group"><span class="input-group-addon"><i class="fa fa-gbp" aria-hidden="true"></i></span>
											<input type="text" class="form-control" id="grouphourlyrate_percent" value="<?php echo (!empty($tutor_details) && !empty($tutor_details['group_hourly_rate']))? $tutor_details['group_hourly_rate']-(($tutor_details['group_hourly_rate']*$tutor_level['omt_commission'])/100):""; ?>" placeholder="You will earn" disabled>
										  </div>
										</div>
									</div>
								</div>
							</div>
							<p>Please make a zip file of all your relevant documents and attach below   <span onclick="successAlerts('Please attach a copy of an ID document. This will be used to verify your identity. Acceptable forms of id include Passport, Driving License or other government issued Photo ID. Copy of DRB check should also be enclosed if you have it. Please compress files into .zip format before uploading otherwise it will not be accepted.','javascript:void(0);');" style="cursor:pointer;"><i class="fa fa-question-circle" aria-hidden="true"></i></span></p>
							<div class="form-group">
								<input type="file" id="infoInp" name="infoInp" class="file_info" style="display:none">
								<div class="input-group col-xs-12">
									<span class="input-group-addon"><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>
									<input type="text" value="<?php echo (!empty($tutor_details))? $tutor_details['info_file']:""; ?>" id="info_file" class="form-control input-lg" disabled placeholder="Upload File">
									<span class="input-group-btn">
										<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i></button>
									<?php if(!empty($tutor_details['info_file'])){ ?>
									<a class="download-button-file btn btn-primary input-lg download-certificate" href="<?php echo ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$tutor_details['info_file'] ?>" download id="download"> <i class="fa fa-download" aria-hidden="true"></i> </a>
									<?php }?>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
                 <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                       <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">Education &amp; Qualification (Optional)</a> </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                       <div class="panel-body">
					<h5>Education & Qualification</h5>
					<h6>University Education (1)</h6>
					<?php
						$education = "";
						if(!empty($tutor_details)){
							$education = json_decode($tutor_details['education']);
						}
					?>
					<div class="main-education" id="main_education_1">
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input type="text" data-value="institute_name" data-title="Education institute name" placeholder="Institute" class="form-control education_fields" value="<?php echo (!empty($education))? $education[0]->institute_name:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							<input type="text" data-value="degree" data-title="Degree" placeholder="Degree" class="form-control education_fields" value="<?php echo (!empty($education))? $education[0]->degree:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							<input type="text" data-value="grade" data-title="Grade" placeholder="Degree classification" class="form-control education_fields" value="<?php echo (!empty($education))? $education[0]->grade:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback select-dropdown-webkit">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
							<select class="form-control select_dropdown education_fields" data-value="passing_year" data-title="Passing Year">
								<option value="">Passing Year</option>
								<?php foreach(range(date("Y"), 1970) as $key=>$row){?>
									<option value="<?php echo $row ?>" <?php echo (!empty($education) && $row == $education[0]->passing_year)? "selected":""; ?>><?php echo $row ?></option>
								<?php } ?>
							</select>
						  </div>
						</div>
					</div>
					<h6>University Education (2)</h6>
					<div class="main-education" id="main_education_2">
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input type="text" data-value="institute_name" placeholder="Institute" data-title="Education institute name" class="form-control education_fields" value="<?php echo (!empty($education))? $education[1]->institute_name:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							<input type="text" data-value="degree" placeholder="Degree" data-title="Degree" class="form-control education_fields" value="<?php echo (!empty($education))? $education[1]->degree:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							<input type="text" data-value="grade" placeholder="Degree classification" data-title="Grade" class="form-control education_fields" value="<?php echo (!empty($education))? $education[1]->grade:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback select-dropdown-webkit">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
							<select class="form-control education_fields" data-value="passing_year" data-title="Passing Year">
								<option value="">Passing Year</option>
								<?php foreach(range(date("Y"), 1970) as $key=>$row){?>
									<option value="<?php echo $row ?>" <?php echo (!empty($education) && $row == $education[1]->passing_year)? "selected":""; ?>><?php echo $row ?></option>
								<?php } ?>
							</select>
						  </div>
						</div>
					</div>
					<h6>College Education</h6>
					<div class="main-education" id="main_education_3">
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input type="text" data-value="institute_name" placeholder="Institute" data-title="Education institute name" class="form-control education_fields" value="<?php echo (!empty($education))? $education[2]->institute_name:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							<input type="text" data-value="degree" placeholder="Degree" data-title="Degree" class="form-control education_fields" value="<?php echo (!empty($education))? $education[2]->degree:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							<input type="text" data-value="grade" data-title="Grade" placeholder="Degree classification" class="form-control education_fields" value="<?php echo (!empty($education))? $education[2]->grade:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback select-dropdown-webkit">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
							<select class="form-control education_fields" data-value="passing_year" data-title="Passing Year">
								<option value="">Passing Year</option>
								<?php foreach(range(date("Y"), 1970) as $key=>$row){?>
									<option value="<?php echo $row ?>" <?php echo (!empty($education) && $row == $education[2]->passing_year)? "selected":""; ?>><?php echo $row ?></option>
								<?php } ?>
							</select>
						  </div>
						</div>
					</div>
					<p>Please make a zip file of all your relevant documents and attach below   <span onclick="successAlerts('Please attach copies of any qualification that you wish to add to your profile. This will help to verify your profile and add increased credibility to your profile. Please compress files into .zip format before uploading otherwise it will not be accepted.','javascript:void(0);');" style="cursor:pointer;"><i class="fa fa-question-circle" aria-hidden="true"></i></span></p>
					<div class="form-group">
						<input type="file" id="imgInp1" name="imgInp1" class="file_upload">
						<div class="input-group col-xs-12">
							<span class="input-group-addon"><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>
							<input type="text" value="<?php echo (!empty($tutor_details))? $tutor_details['certificate_file']:""; ?>" id="certificate_file" class="form-control input-lg" disabled placeholder="Upload File">
							<span class="input-group-btn">
								<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i></button>
							<?php if(!empty($tutor_details) && !empty($tutor_details['certificate_file'])){ ?>
							<a class="download-button-file btn btn-primary input-lg download-certificate" href="<?php echo ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$tutor_details['certificate_file'] ?>" download id="download"> <i class="fa fa-download" aria-hidden="true"></i> </a>
							<?php }?>
							</span>
						</div>
					</div>
						</div>
					</div>
				</div>
                 <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                       <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">Teaching Experience (Optional)</a> </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" aria-expanded="false">
                       <div class="panel-body">
					<h6>Tutoring Experience</h6>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
						<input type="text" value="<?php echo ((!empty($tutor_details) && $tutor_details['tutor_experience']!=0))? $tutor_details['tutor_experience']:""; ?>" id="tutor_experience" class="form-control" placeholder="How long you have been tutoring (years)">
					  </div>
					</div>
					<!--<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
						<input type="text" value="<?php echo (!empty($tutor_details))? $tutor_details['tutor_hours']:""; ?>" id="tutor_hours" class="form-control" placeholder="Total hours tutored">
					  </div>
					</div>-->
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
						<input type="text" value="<?php echo (!empty($tutor_details))? $tutor_details['tutor_subjects']:""; ?>" id="tutor_subjects" class="form-control" placeholder="Subject(s) tutored (Comma Seperated)">
					  </div>
					</div>
					<?php
						$teaching = "";
						if(!empty($tutor_details)){
							$teaching = json_decode($tutor_details['teaching']);
						}
					?>
					<h6>Teaching Experience (1)</h6>
					<div class="main-teaching" id="main_teaching_1">
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
							<input type="text" data-value="institute_name" placeholder="Institute" data-title="Teaching institute" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? $teaching[0]->institute_name:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							<input type="text" data-value="period" placeholder="Period (Year)" data-title="Teaching Period" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? $teaching[0]->period:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input type="text" data-value="ages_of_students" placeholder="Academic levels of students taught" data-title="Academic Level" class="form-control level_autocomplete1 teaching_level teaching_fields" value="<?php echo (!empty($teaching))? $teaching[0]->ages_of_students:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input type="text" data-value="subjects_taught" placeholder="Subject(s) taught (Comma Seperated)" data-title="Subjects Taught" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? str_replace(";",",",$teaching[0]->subjects_taught):''; ?>" />
						  </div>
						</div>
					</div>
					<h6>Teaching Experience (2)</h6>
					<div class="main-teaching" id="main_teaching_2">
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
							<input type="text" data-value="institute_name" placeholder="Institute" data-title="Teaching institute" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? $teaching[1]->institute_name:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							<input type="text" data-value="period" placeholder="Period (Year)" data-title="Teaching Period" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? $teaching[1]->period:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input type="text" data-value="ages_of_students" placeholder="Academic levels of students taught" data-title="Academic Level" class="form-control level_autocomplete1 teaching_level teaching_fields" value="<?php echo (!empty($teaching))? $teaching[1]->ages_of_students:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input type="text" data-value="subjects_taught" placeholder="Subject(s) taught (Comma Seperated)" data-title="Subjects Taught" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? str_replace(";",",",$teaching[1]->subjects_taught):''; ?>" />
						  </div>
						</div>
					</div>
					<h6>Teaching Experience (3)</h6>
					<div class="main-teaching" id="main_teaching_3">
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
							<input type="text" data-value="institute_name" placeholder="Institute" data-title="Education institute" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? $teaching[2]->institute_name:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
							<input type="text" data-value="period" placeholder="Period (Year)" data-title="Teaching Period" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? $teaching[2]->period:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input type="text" data-value="ages_of_students" placeholder="Academic levels of students taught" data-title="Academic Level" class="form-control level_autocomplete1 teaching_level teaching_fields" value="<?php echo (!empty($teaching))? $teaching[2]->ages_of_students:''; ?>" />
						  </div>
						</div>
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
							<input type="text" data-value="subjects_taught" placeholder="Subject(s) taught (Comma Seperated)" data-title="Subjects Taught" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? str_replace(";",",",$teaching[2]->subjects_taught):''; ?>" />
						  </div>
						</div>
					</div>
					  </div>
					</div>
				</div>
                 <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingFour">
                       <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Availability</a> </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false">
                       <div class="panel-body">
					<h6>Availability</h6>
					<?php if(!empty($tutor_details) && isset($tutor_details['availability'])){
						$avail_key = 1;
						foreach ($tutor_details['availability'] as $key1=>$availability) {
							$avaiability_id = "";
							foreach($availability['times'] as $avail_time_key=>$avail_time){
								$avaiability_id .= $avail_time_key.",";
							}?>
					<div class="form-group has-feedback main_availability" data-avail-id="<?php echo $avaiability_id ?>" id="availability_<?php echo $avail_key; ?>">
						<div class="row available_days_timings_dropdown">
							<div class="col-sm-6">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									<select class="form-control days_avaiable" data-title="Days Available">
										<option value="">Days</option>
										<?php foreach(unserialize(DAYS) as $key=>$day){?>
										<option value="<?php echo $key ?>" <?php echo ($key1== $key)? "selected":""; ?> ><?php echo $day ?></option>
										<?php } ?>
									</select>
								  </div>
							</div>
							<div class="col-sm-6">
								<div class="input-group times_div">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									<select class="form-control times_avaiable" multiple="multiple" data-title="Time Available">
										<?php foreach(unserialize(TIMES) as $key=>$time){ ?>
										<option value="<?php echo $key ?>/<?php echo (in_array($key, $availability['times']))? array_search($key, $availability['times']):0; ?>" <?php echo (in_array($key, $availability['times']))? "selected":""; ?> ><?php echo $time ?></option>
										<?php 
										} ?>
									</select>
								  </div>
							</div>
						</div>
						<?php if($avail_key != 1){ ?>
						<div class="action-delete-this">
							<a href="javascript:deleteMainAvailablity(<?php echo $avail_key ?>)" class="btn btn-circle btn-icon-only red"><i class="fa fa-times"></i>Remove this avaiability</a>
						</div>
						<?php } ?>
					</div>
						<?php $avail_key++; } ?>
					<?php } else { ?>
					<div class="form-group has-feedback main_availability" id="availability_1">
						<div class="row available_days_timings_dropdown">
							<div class="col-sm-6">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									<select class="form-control days_avaiable" data-title="Days Available">
										<option value="">Days</option>
										<?php foreach(unserialize(DAYS) as $key=>$day){?>
										<option value="<?php echo $key ?>"><?php echo $day ?></option>
										<?php } ?>
									</select>
								  </div>
							</div>
							<div class="col-sm-6">
								<div class="input-group times_div">
									<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
									<select class="form-control times_avaiable" multiple="multiple" data-title="Time Available">
										<?php foreach(unserialize(TIMES) as $key=>$time){?>
										<option value="<?php echo $key ?>/0"><?php echo $time ?></option>
										<?php } ?>
									</select>
								  </div>
							</div>
						</div>
					</div>
					<?php } ?>
					<button type="submit" class="btn btn-grey-border" id="addTimeAvaiable"><i class="fa fa-plus" aria-hidden="true"></i> ADD MORE AVAILABILITY</button>
					<div class="form-group has-feedback">
						<!--	<?php if(!empty($tutor_details) && isset($tutor_details['group_availability'])){?>
						<div class="radio">
							<input id="group_one" class="study_group" type="radio" name="study_group" value="1" <?php echo (!empty($tutor_details) && isset($tutor_details['group_availability']))? "checked":""; ?>>
							<label for="group_one">Yes</label>
							<input id="group_two" class="study_group" type="radio" name="study_group" value="0" <?php echo (!empty($tutor_details) && !isset($tutor_details['group_availability']))? "checked":""; ?>>
							<label for="group_two">No</label>
						</div>
							<?php } else { ?>
						<div class="radio">
							<input id="group_one" class="study_group" type="radio" name="study_group" value="1" >
							<label for="group_one">Yes</label>
							<input id="group_two" class="study_group" type="radio" name="study_group" value="0" checked >
							<label for="group_two">No</label>
						</div>
							<?php } ?>-->
						<div class="group_study" <?php echo (!empty($tutor_details) && !empty($tutor_details['group_hourly_rate']))? "":"style='display:none'"; ?>>
					<h6>Group Availability</h6>
							<?php if(!empty($tutor_details) && isset($tutor_details['group_availability'])){
								$g_avail_key = 1;
								foreach ($tutor_details['group_availability'] as $g_key1=>$g_availability) {?>
							<div class="row available_days_timings_dropdown group_main_availability" id="group_availability_<?php echo $g_avail_key ?>">
								<div class="col-sm-12">
									<div class="form-group has-feedback">
									  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
										<input type="text" class="form-control no_of_students" placeholder="Number of Students" value="<?php echo $g_availability['no_of_students'] ?>" data-title="Number of Students">
									  </div>
									</div>
								</div>
								<?php $syllabus = "";
								$syllabus = (!empty($g_availability['syllabus']))? explode(";",$g_availability['syllabus']):""; ?>
								<!--<div class="col-sm-4">
									<div class="form-group has-feedback">
									  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
										<select class="form-control tutor_subject_select">
											<option value="0">Subject</option>
											<?php if (!empty($main_subjects)){
													foreach($main_subjects as $main_subject){?>
														<optgroup label="<?php echo $main_subject['name'] ?>">
															<?php foreach($main_subject['subjects'] as $subjects){ ?>
															<option value="<?php echo $subjects['subject_name'] ?>" <?php echo ($subjects['subject_name'] == $syllabus[0])? "selected":""; ?>><?php echo $subjects['subject_name'] ?></option>
															<?php } ?>
														</optgroup>
											<?php 	}
												} ?>
										</select>
									  </div>
									</div>
								</div>-->
								<div class="col-sm-8">
									<div class="form-group has-feedback">
									  <div class="input-group"><span class="input-group-addon"><i class="fa fa-book" aria-hidden="true"></i></span>
										<input type="text" class="form-control syllabus" placeholder="Syllabus" data-title="Syllabus" value="<?php echo (!empty($g_availability['syllabus']))?$g_availability['syllabus']:""; ?>">
									  </div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-group form-group has-feedback">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
										<select class="form-control days_avaiable" data-title="Group Days Available">
											<option value="">Days</option>
											<?php foreach(unserialize(DAYS) as $key=>$day){?>
											<option value="<?php echo $key ?>" <?php echo ($g_key1 == $key)? "selected":""; ?>><?php echo $day ?></option>
											<?php } ?>
										</select>
									  </div>
								</div>
								<div class="col-sm-6">
									<div class="input-group times_div form-group has-feedback">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
											<select class="form-control times_avaiable" multiple="multiple" data-title="Group Time Available">
												<?php foreach(unserialize(TIMES) as $key=>$time){?>
												<option value="<?php echo $key ?>/<?php echo (in_array($key, $g_availability['times']))? array_search($key, $g_availability['times']):0; ?>" <?php echo (in_array($key, $g_availability['times']))? "selected":""; ?> ><?php echo $time ?></option>
												<?php } ?>
											</select>
									  </div>
								</div>
								<?php if ($g_avail_key !=1){ ?>
								<div class="action-delete-this">
									<a href="javascript:deleteGroupAvailablity(<?php echo $g_avail_key ?>)" class="btn btn-circle btn-icon-only red"><i class="fa fa-times"></i>Remove this group avaiability</a>
								</div>
								<?php } ?>
							</div>
							<?php $g_avail_key++; } ?>
							<?php } else { ?>
							<div class="row available_days_timings_dropdown group_main_availability" id="group_availability_1">
								<div class="col-sm-12">
									<div class="form-group has-feedback">
									  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
										<input type="text" class="form-control no_of_students" placeholder="Maximum number of students in the group" data-title="Maximum number of students in the group">
									  </div>
									</div>
								</div>
								<!--<div class="col-sm-4">
									<div class="form-group has-feedback">
									  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
										<select class="form-control tutor_subject_select" >
											<option value="0">Subject</option>
											<?php if (!empty($main_subjects)){
													foreach($main_subjects as $main_subject){?>
														<optgroup label="<?php echo $main_subject['name'] ?>">
															<?php foreach($main_subject['subjects'] as $subjects){ ?>
															<option value="<?php echo $subjects['subject_name'] ?>"><?php echo $subjects['subject_name'] ?></option>
															<?php } ?>
														</optgroup>
											<?php 	}
												} ?>
										</select>
									  </div>
									</div>
								</div>-->
								<div class="col-sm-8">
									<div class="form-group has-feedback">
									  <div class="input-group"><span class="input-group-addon"><i class="fa fa-book" aria-hidden="true"></i></span>
										<input type="text" class="form-control syllabus" placeholder="Syllabus to be taught in group lesson" data-title="Syllabus to be taught in group lesson">
									  </div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-group has-feedback">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
										<select class="form-control days_avaiable" data-title="Group Days Available">
											<option value="">Days</option>
											<?php foreach(unserialize(DAYS) as $key=>$day){?>
											<option value="<?php echo $key ?>"><?php echo $day ?></option>
											<?php } ?>
										</select>
									  </div>
								</div>
								<div class="col-sm-6">
									<div class="input-group times_div has-feedback">
										<span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
										<select class="form-control times_avaiable" multiple="multiple" data-title="Group Time Available">
											<?php foreach(unserialize(TIMES) as $key=>$time){?>
											<option value="<?php echo $key ?>/0" ><?php echo $time ?></option>
											<?php } ?>
										</select>
									  </div>
								</div>
							</div>
							<?php }?>
							<br>
							<button type="submit" class="btn btn-grey-border" id="addGroupAvaiable"><i class="fa fa-plus" aria-hidden="true"></i> ADD MORE GROUP AVAILABILITY</button>
						</div>
					</div>
						</div>
					</div>
				</div>
					<div class="form-group errorMsg" style="color:red">
					</div>
					<button type="submit" onclick="saveTutorProfile(<?php echo $common_data['user_id'] ?>)" class="btn btn-blue">SAVE</button>
				</div>
              </form>
          </div>
          </div>
        </div>
      </div>
    </section>
    <!-- users profile and --> 
  </div>
</main>
		<div id="time_hidden" style="display:none">
		<select class="form-control days_avaiable">
			<option value="">Days</option>
			<?php foreach(unserialize(DAYS) as $key=>$day){?>
			<option value="<?php echo $key ?>"><?php echo $day ?></option>
			<?php } ?>
		</select>
		<select class="form-control times_avaiable" multiple="multiple">
			<?php foreach(unserialize(TIMES) as $key=>$time){?>
			<option value="<?php echo $key ?>/0"><?php echo $time ?></option>
			<?php } ?>
		</select>
		</div>
		<div class="col-sm-4" id="tutor_subject_select" style="display:none">
			<div class="form-group has-feedback">
			  <div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
				<select class="form-control tutor_subject_select">
					<option value="0">Subject</option>
					<?php if (!empty($main_subjects)){
							foreach($main_subjects as $main_subject){?>
								<optgroup label="<?php echo $main_subject['name'] ?>">
									<?php foreach($main_subject['subjects'] as $subjects){ ?>
									<option value="<?php echo $subjects['subject_name'] ?>"><?php echo $subjects['subject_name'] ?></option>
									<?php } ?>
								</optgroup>
					<?php 	}
						} ?>
				</select>
			  </div>
			</div>
		</div>		
<script>
	function handleChange(input) {
//		if(<?php echo $tutor_level['max_charge'] ?> != 0){
//			if (input.value > <?php echo $tutor_level['max_charge'] ?>) input.value = <?php echo $tutor_level['max_charge'] ?>;
//		}
	}
	function successAlertRate(msg,url){ 
		bootbox.dialog({
		message: msg+' Please <a target="_blank" style="color:#354790" href="'+url+'">Contact us</a> to see if you are eligible for an upgrade',
		className: "upload_modal",
		buttons: {
			success: {
				label: "OK",
				className: "btn-success",
				callback: function() {
				window.location = "javascript:void(0);";
				}
			}
		}
		});
	}
	$('.level_autocomplete1').focusout(function(){
		$(this).val($(this).val().replace(/, +$/,''));
	})
	$(document).ready(function(){
		$('#addTutorForm').change(function(){
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