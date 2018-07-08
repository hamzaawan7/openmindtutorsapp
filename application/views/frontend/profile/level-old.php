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
                <li><a href="<?php echo ROUTE_LESSONS ?>">Lessons</a></li>
                <li><a href="<?php echo ROUTE_MESSAGES ?>">Messages <?php echo (count($common_data['message_count']) != 0)? "(".count($common_data['message_count']).")":""; ?></a></li>
                <li><a href="<?php echo ROUTE_PAYMENTS_HISTORY ?>">Payments</a></li>
            </ul>
            <h5>My Tutor Level</h5>
          </div>
        </div>
        <div class="col-md-8 tutor_level_management_section">
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
          <div class="border-box activation-feeds margin-0-30 scroll-element-added">
			<div id="scroll-content">
            <h6>Tutor Level</h6>
			<div class="row">
				<div class="col-sm-6">
				  <ul class="long-arrow-list">
					<li>Level: <?php echo $tutor_level['title'] ?></li>
					<li>Rating: <span class="star_rating_popluar_tutor"><input id="input-1" type="text" data-size="xs" value="<?php echo $avg_rating ?>"></span></li>
				  </ul>
				</div>
				<div class="col-sm-6">
				  <ul class="long-arrow-list">
					<li>Lessons taught: <?php echo $common_data['total_lessons'] ?></li>
					<li>Hourly rate: <?php echo CURRENCY_SYMBOL ?><?php echo $tutor_level['max_charge'] ?></li>
				  </ul>
				</div>
			</div>
			<?php if($common_data['user_data']['role'] == STUDENT){ ?>
			<h6>Open-Stars Recruitment Cycle (For Student Tutors)</h6>
			<div class="row">
				<div class="col-xs-12">
				  <div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
						<tr>
						  <th>Level</th>
						  <th>Maximum number of students in group study</th>
						  <th>Maximum allowable charge to students</th>
						  <th>OMT commission for tuition (per student per hour)</th>
						  <th>Requirement to unlock next level</th>
						</tr>
					  </thead>
					  <tbody>
						<tr <?php echo ($tutor_level['title'] == "Level A")? 'class="active_tr"':""; ?>>
						  <td>Level A</td>
						  <td>3</td>
						  <td>£5</td>
						  <td>35%</td>
						  <td>4 lessons + 3/5 star rating average</td>
						</tr>
						<tr <?php echo ($tutor_level['title'] == "Level B")? 'class="active_tr"':""; ?>>
						  <td>Level B</td>
						  <td>3</td>
						  <td>£10</td>
						  <td>35%</td>
						  <td>8 lessons + 3/5 star rating average</td>
						</tr>
						<tr <?php echo ($tutor_level['title'] == "Level C")? 'class="active_tr"':""; ?>>
						  <td>Level C</td>
						  <td>3</td>
						  <td>£15</td>
						  <td>35%</td>
						  <td>12 lessons + 3/5 star rating average</td>
						</tr>
						<tr <?php echo ($tutor_level['title'] == "Level D")? 'class="active_tr"':""; ?>>
						  <td>Level D</td>
						  <td>4</td>
						  <td>£20</td>
						  <td>35%</td>
						  <td>20 lessons + 3/5 star rating average and three 4/5 star or above rating</td>
						</tr>
					  </tbody>
					</table>
				  </div><!--end of .table-responsive-->
				</div>
			</div>
			<?php } else { ?>
			<h6>Tier System for tutors with a degree in a related subject</h6>
			<div class="row">
				<div class="col-xs-12">
				  <div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
						<tr>
						  <th>Tiers</th>
						  <th>Maximum Number of students in group study</th>
						  <th>Maximum tutor can charge (per student per hour)</th>
						  <th>OMT Commission for individual tuition(per student per hour)</th>
						  <th>OMT Commission for group tuition (per student per hour)</th>
						  <th>Pro bono hours logged to unlock</th>
						</tr>
					  </thead>
					  <tbody>
						<tr <?php echo ($tutor_level['title'] == "Tier 1")? 'class="active_tr"':""; ?>>
						  <td>Tier 1</td>
						  <td>5</td>
						  <td>£30</td>
						  <td>30%</td>
						  <td>25%</td>
						  <td>0</td>
						</tr>
						<tr <?php echo ($tutor_level['title'] == "Tier 2")? 'class="active_tr"':""; ?>>
						  <td>Tier 2</td>
						  <td>10</td>
						  <td>£40</td>
						  <td>25%</td>
						  <td>30%</td>
						  <td>20</td>
						</tr>
						<tr <?php echo ($tutor_level['title'] == "Tier 3")? 'class="active_tr"':""; ?>>
						  <td>Tier 3</td>
						  <td>15</td>
						  <td>£60</td>
						  <td>20%</td>
						  <td>25%</td>
						  <td>40</td>
						</tr>
						<tr <?php echo ($tutor_level['title'] == "Tier 2")? 'class="active_tr"':""; ?>>
						  <td>Tier 4</td>
						  <td>unlimited</td>
						  <td>unlimited</td>
						  <td>15%</td>
						  <td>20%</td>
						  <td>60</td>
						</tr>
					  </tbody>
					</table>
				  </div><!--end of .table-responsive-->
				</div>
			  </div>
			<?php } ?>
			 </div>
          </div>
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
    </section>
    <!-- users profile and --> 
  </div>
</main>