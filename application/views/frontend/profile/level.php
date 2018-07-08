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
					<li><a href="<?php echo ROUTE_PAYMENTS_HISTORY ?>">Payments</a></li>
					<li class="active-menu"><h5><a href="<?php echo ROUTE_TUTOR_LEVEL ?>" class="side-bar-active">My Tutor Level</a></h5></li>
				</ul>
            </div>
          </aside>
          <!-- sidebar end --> 
        </div>


          <!-- My Tutor Level Start
======================================== -->
        <div class="col-md-9 tutor_level_management_section">
          <?php if(!empty($tutor_details)){ ?>
          <div class="activation-feeds margin-0-30 scroll-element-added">
      <div id="scroll-content">
            <h5>Tutor Level</h5>
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
				<li>Hourly rate: <?php echo CURRENCY_SYMBOL ?><?php echo $tutor_details['hourly_rate'] ?></li>
          </ul>
        </div>
      </div>
			<?php if($tutor_details['level_id'] <= 4){ ?>
      <h6>Open-Stars Recruitment Cycle (For Student Tutors)</h6>
          <ul class="forum-topic-list margin-0-60 tutor-level-table">
            <li class="head">
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Level</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Maximum number of students in group study</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Maximum allowable charge to students</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">OMT commission for tuition (per student per hour)</div>
                </div>
				<div class="col-md-4 col-xs-4">
                  <div class="topic-name">Requirement to unlock next level</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Level A")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Level A</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">3</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£5</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">35%</div>
                </div>
				<div class="col-md-4 col-xs-4">
                  <div class="topic-name">4 lessons + 3/5 star rating average</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Level B")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Level B</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">3</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£10</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">35%</div>
                </div>
				<div class="col-md-4 col-xs-4">
                  <div class="topic-name">8 lessons + 3/5 star rating average</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Level C")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Level C</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">3</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£15</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">35%</div>
                </div>
				<div class="col-md-4 col-xs-4">
                  <div class="topic-name">12 lessons + 3/5 star rating average</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Level D")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Level D</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">4</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£20</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">35%</div>
                </div>
				<div class="col-md-4 col-xs-4">
                  <div class="topic-name">20 lessons + 3/5 star rating average and three 4/5 star or above rating</div>
                </div>
              </div>
            </li>
          </ul>
        <h6>Tier System for tutors with a degree in a related subject</h6>
        <ul class="forum-topic-list margin-0-60 tutor-level-table">
            <li class="head">
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Tiers</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Maximum Number of students in group study</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Maximum tutor can charge (per student per hour)</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">OMT Commission for individual tuition(per student per hour)</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">OMT Commission for group tuition (per student per hour)</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Pro bono hours logged to unlock</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Bronze")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Bronze</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">5</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£30</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">30%</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">25%</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">0</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Silver")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Silver</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">10</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£40</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">25%</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">30%</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">20</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Gold")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Gold</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">15</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£60</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">20%</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">25%</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">40</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Platinum")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Platinum</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">unlimited</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">unlimited</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">15%</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">20%</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">60</div>
                </div>
              </div>
            </li>
          </ul>
			<?php } else { ?>
        <h6>Tier System for tutors with a degree in a related subject</h6>
        <ul class="forum-topic-list margin-0-60 tutor-level-table">
            <li class="head">
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Tiers</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Maximum Number of students in group study</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Maximum tutor can charge (per student per hour)</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">OMT Commission for individual tuition(per student per hour)</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">OMT Commission for group tuition (per student per hour)</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Pro bono hours logged to unlock</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Bronze")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Bronze</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">5</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£30</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">30%</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">35%</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">0</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Silver")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Silver</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">10</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£40</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">25%</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">30%</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">20</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Gold")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Gold</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">15</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">£60</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">20%</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">25%</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">40</div>
                </div>
              </div>
            </li>
            <li <?php echo ($tutor_level['title'] == "Platinum")? 'class="active_tr"':""; ?>>
              <div class="row">
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">Platinum</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">unlimited</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">unlimited</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">15%</div>
                </div>
				<div class="col-md-2 col-xs-4">
                  <div class="topic-name">20%</div>
                </div>
                <div class="col-md-2 col-xs-4">
                  <div class="topic-name">60</div>
                </div>
              </div>
            </li>
          </ul>
			<?php } ?>

       </div>
    </div>
		  <?php } else { ?>
		  <div class="row">
            <div class="col-sm-12">
              <ul class="long-arrow-list">
                <li>Please complete your <a href="<?php echo ROUTE_TUTOR_PUBLIC_PROFILE ?>">public tutor profile</a></li>
              </ul>
            </div>
          </div>
		  <?php } ?>
   </div>
<!-- My Tutor Level End-->

      </div>
    </div>
  </div>
</main>
