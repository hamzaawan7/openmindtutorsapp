<main>
  <div class="container"> 
    <!-- Users profile
======================================== -->
    <section class="profile">
      <div class="row">
        <div class="col-md-4">
          <div class="profile-image"><img alt="user profile" src="<?php echo ($common_data['user_data']['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$common_data['user_data']['image'] ?>"/></div>
          <div class="menu-list margin-60-0">
            <ul>
              <li><a href="<?php echo ROUTE_PROFILE ?>">Edit Profile</a></li>
			  <?php if($common_data['user_data']['account_type'] == EMAIL_ACCOUNT_TYPE){ ?>
              <li><a href="<?php echo ROUTE_CHANGE_PASSWORD ?>">Change Password</a></li>
			  <?php } ?>
            </ul>
            <h5><a href="<?php echo ROUTE_TUTOR_PUBLIC_PROFILE ?>" class="side-bar-active">My Tutor Profile (Public)</a></h5>
          </div>
        </div>
        <div class="col-md-8">
          <div class="profile-head">
            <h5><?php echo ucwords($common_data['user_data']['first_name'].' '.$common_data['user_data']['last_name']) ?></h5>
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
          <div class="border-box activation-feeds margin-0-30 scroll-element-added">
            <div id="scroll-content">
				<?php if($common_data['user_data']['role'] == STUDENT && empty($tutor_details)){ ?>
                <h6>Status</h6>
                <div class="form-group has-feedback">
                	<p>Are you available for teaching?</p>
					<div class="radio">
						<input id="group_stu_one" class="stu_study_group" type="radio" name="stu_study_group" value="1">
						<label for="group_stu_one">Yes</label>
						<input id="group_stu_two" class="stu_study_group" type="radio" name="stu_study_group" value="0">
						<label for="group_stu_two">No</label>
					</div>
                </div>
				<?php } ?>
				<form class="sec" method="post" name="addTutorForm" id="addTutorForm" onsubmit="return false;" <?php echo ($common_data['user_data']['role'] == STUDENT && empty($tutor_details))? "style='display:none'":""; ?>>
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
                    <textarea id="personal_statement" class="form-control" placeholder="Personal Statement"><?php echo (!empty($tutor_details))? $tutor_details['personal_statement']:""; ?></textarea>
                  </div>
                </div>
				<h6>Hourly Rate</h6>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group has-feedback">
						  <div class="input-group"><span class="input-group-addon"><i class="fa fa-gbp" aria-hidden="true"></i></span>
							<input type="text" class="form-control" placeholder="Your clients will pay" value="<?php echo (!empty($tutor_details))? $tutor_details['hourly_rate']:""; ?>" id="hourly_rate" title="Hourly rate should not be greater than <?php echo $tutor_level['max_charge'] ?>" />
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
				</div>
				<!--<p>Earn more of your hourly rate. After tutoring 20 hours with Open Mind Tutors, the commission rate reduces and you will earn <b><?php echo CURRENCY_SYMBOL ?>51.82</b></p>-->
            	<h5>Education & Qualification</h5>
            	<h6>University Education</h6>
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
						<input type="text" data-value="grade" data-title="Grade" placeholder="Grade/CGPA" class="form-control education_fields" value="<?php echo (!empty($education))? $education[0]->grade:''; ?>" />
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
				<h6>College Education</h6>
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
						<input type="text" data-value="grade" placeholder="Grade/CGPA" data-title="Grade" class="form-control education_fields" value="<?php echo (!empty($education))? $education[1]->grade:''; ?>" />
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
				<h6>School Education</h6>
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
						<input type="text" data-value="grade" data-title="Grade" placeholder="Grade/CGPA" class="form-control education_fields" value="<?php echo (!empty($education))? $education[2]->grade:''; ?>" />
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
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam imperdiet justo nulla, in feugiat ante laoreet sit amet. Integer mattis vestibulum mauris non gravida. Ut libero sapien, fermentum sed velit vitae, placerat sodales dui.  Integer varius lacinia tellus vitae posuere. Nullam et viverra eros.</p>
				<div class="form-group">
					<input type="file" id="imgInp1" name="imgInp1" class="file_upload">
					<div class="input-group col-xs-12">
						<span class="input-group-addon"><i class="fa fa-file-archive-o" aria-hidden="true"></i></span>
						<input type="text" value="<?php echo (!empty($tutor_details))? $tutor_details['certificate_file']:""; ?>" class="form-control input-lg" disabled placeholder="Upload File">
						<span class="input-group-btn">
							<button class="browse btn btn-primary input-lg" type="button"><i class="glyphicon glyphicon-search"></i> Browse</button>
						</span>
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
						<input type="text" data-value="institute_name" placeholder="institute" data-title="Teaching institute" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? $teaching[0]->institute_name:''; ?>" />
					  </div>
					</div>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
						<input type="text" data-value="period" placeholder="Period (Year)" data-title="Teaching Period" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? $teaching[0]->period:''; ?>" />
					  </div>
					</div>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
						<input type="text" data-value="ages_of_students" placeholder="Academic level (Ages of students taught)" data-title="Academic Level" class="form-control teaching_level teaching_fields" value="<?php echo (!empty($teaching))? $teaching[0]->ages_of_students:''; ?>" />
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
						<input type="text" data-value="ages_of_students" placeholder="Academic level (Ages of students taught)" data-title="Academic Level" class="form-control teaching_level teaching_fields" value="<?php echo (!empty($teaching))? $teaching[1]->ages_of_students:''; ?>" />
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
						<input type="text" data-value="ages_of_students" placeholder="Academic level (Ages of students taught)" data-title="Academic Level" class="form-control teaching_level teaching_fields" value="<?php echo (!empty($teaching))? $teaching[2]->ages_of_students:''; ?>" />
					  </div>
					</div>
					<div class="form-group has-feedback">
					  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
						<input type="text" data-value="subjects_taught" placeholder="Subject(s) taught (Comma Seperated)" data-title="Subjects Taught" class="form-control teaching_fields" value="<?php echo (!empty($teaching))? str_replace(";",",",$teaching[2]->subjects_taught):''; ?>" />
					  </div>
					</div>
				</div>
				<h6>Tutoring Experience</h6>
                <div class="form-group has-feedback">
                  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <input type="text" value="<?php echo (!empty($tutor_details))? $tutor_details['tutor_experience']:""; ?>" id="tutor_experience" class="form-control" placeholder="How long you have been tutoring (years)">
                  </div>
                </div>
				<div class="form-group has-feedback">
                  <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                    <input type="text" value="<?php echo (!empty($tutor_details))? $tutor_details['tutor_hours']:""; ?>" id="tutor_hours" class="form-control" placeholder="Total hours tutored">
                  </div>
                </div>
				<div class="form-group has-feedback">
                  <div class="input-group"><span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                    <input type="text" value="<?php echo (!empty($tutor_details))? $tutor_details['tutor_subjects']:""; ?>" id="tutor_subjects" class="form-control" placeholder="Subject(s) tutored (Comma Seperated)">
                  </div>
                </div>
                <h6>Availability</h6>
				<?php if(!empty($tutor_details)){
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
                <h6>Availability for group study (optional)</h6>
                <div class="form-group has-feedback">
                	<p>Are you available for group study?</p>
					<div class="radio">
						<input id="group_one" class="study_group" type="radio" name="study_group" value="1" <?php echo (!empty($tutor_details) && isset($tutor_details['group_availability']))? "checked":""; ?>>
						<label for="group_one">Yes</label>
						<input id="group_two" class="study_group" type="radio" name="study_group" value="0" <?php echo (!empty($tutor_details) && !isset($tutor_details['group_availability']))? "checked":""; ?>>
						<label for="group_two">No</label>
					</div>
					<div id="group_study" <?php echo (!empty($tutor_details) && isset($tutor_details['group_availability']))? "":"style='display:none'"; ?>>
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
							<div class="col-sm-6">
								<div class="input-group">
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
								<div class="input-group times_div">
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
									<input type="text" class="form-control no_of_students" placeholder="Number of Students" data-title="Number of Students">
								  </div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">
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
								<div class="input-group times_div">
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
				<div class="form-group errorMsg" style="color:red">
				</div>
                <button type="submit" onclick="saveTutorProfile(<?php echo $common_data['user_id'] ?>)" class="btn btn-blue">SAVE</button>
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
