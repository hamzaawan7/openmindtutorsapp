<main>
  <div class="container"> 
    <!-- Teachers profile
======================================== -->
    <section class="profile">
      <div class="row">
        <div class="col-md-4">
          <div class="profile-image"><img alt="user profile" src="<?php echo ($user_details['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$user_details['image'] ?>"/></div>
          <!--<h5 class="margin-30-0">Course Schedule</h5>-->
          <table class="table table-hover margin-30-0">
            <tr>
              <td>Hourly Rate Single Lesson</td>
              <td class="text-right"><?php echo (!empty($tutor_details['hourly_rate']))? CURRENCY_SYMBOL.$tutor_details['hourly_rate'].'/hour':"";?></td>
            </tr>
            <tr>
              <td>Hourly Rate Group Lesson</td>
              <td class="text-right"><?php echo (!empty($tutor_details['group_hourly_rate']))? CURRENCY_SYMBOL.$tutor_details['group_hourly_rate'].'/hour':"";?></td>
            </tr>
            <!--<tr>
              <td>Response Time</td>
              <td class="text-right">4 hours</td>
            </tr>-->
            <tr title="<?php echo ($avg_rating != 0)? round($avg_rating,2):""; ?>">
              <td>Rating</td>
              <td class="text-right rating-section-search-detail"><input id="input-1" type="text" data-size="xs" value="<?php echo $avg_rating ?>"><!--<span id="stars-existing-one" class="starrr" data-rating='4'></span>--></td>
            </tr>
            <!--<tr>
              <td>Level</td>
              <td class="text-right"><?php echo $tutor_level['title']; ?></td>
            </tr>-->
            <tr>
              <td>Travel Distance</td>
              <td class="text-right"><?php echo (!empty($tutor_details['travel_distance']))? $tutor_details['travel_distance'].' miles':""; ?></td>
            </tr>
            <tr>
              <td>Postal Code</td>
			  <?php $postal_code = (!empty($user_details['postal_code']))? explode(" ",$user_details['postal_code']):""; ?>
              <td class="text-right"><?php echo (!empty($user_details['postal_code']))? $postal_code[0]:""; ?></td>
            </tr>
			<?php if(!empty($tutor_badges)) {?>
            <tr>
              <td>Tutor Badge</td>
              <td class="text-right">
				<?php foreach ($badges as $badge){
					echo (in_array($badge['id'], $tutor_badges))? $badge['name'].'<br>':"";
				}?>
			  </td>
            </tr>
			<?php } ?>
          </table>
        </div>
        <div class="col-md-8">
          <div class="head-style-3 margin-0-30" style="padding-top:1px;">
			<?php /*if(!empty($user_details['address'])){ ?>
				<div class="subhead"><i class="fa fa-map-marker"></i> <?php echo $user_details['address'] ?></div>
			<?php }*/ ?>
            <h2 class="style-2"><?php echo ucwords($user_details['first_name']) ?> 

			<?php if (isset($common_data['user_id']) && $common_data['user_data']['is_active'] == DISABLED_STATUS_ID)  { ?>
				<div class="pull-right"><a href="<?php echo ROUTE_ACCOUNT_SETTINGS ?>" class="btn btn-default book-a-lesson-btn" >Book a Lesson</a></div></h2>
			<?php } else { ?>
			<?php if(isset($common_data['user_id']) && $user_details['id'] != $common_data['user_id'] && !empty($tutor_details) && isset($availablity) && !empty($availablity)){ ?>
				<div class="pull-right"><a href="javascript:void(0);" id="book_lesson" class="btn btn-default book-a-lesson-btn">Book a Lesson</a></div></h2>
			<?php } else if(!isset($availablity) || empty($availablity)){?>
			<div class="pull-right"><a href="javascript:send_book_message();" class="btn btn-default book-a-lesson-btn">Book a Lesson</a></div></h2>
			<?php } else if (!isset($common_data['user_id']))  { ?>
				<div class="pull-right"><a href="<?php echo ROUTE_LOGIN ?>" class="btn btn-default book-a-lesson-btn" >Book a Lesson</a></div></h2>
			<?php }
			} ?>
            
			<div class="h5"><?php echo $tutor_details['headline'] ?></div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <p><?php echo $tutor_details['personal_statement'] ?></p>
            </div>
          </div>


           
          <?php if(!empty($tutor_details['education']) && $tutor_details['education'] != "") { ?>

                             <div class="panel-group margin-30" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                          <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Education &amp; Qualification</a> </h4>
                          </div>
                          <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" aria-expanded="false">
                            <div class="panel-body">
                      
                        <?php $education = json_decode($tutor_details['education']);?>
                      <?php if (!empty($education[UNIVERSITY]->institute_name)){ ?>
                              <!--<h6>University Education<?php echo (!empty($education[UNIVERSITY]->passing_year))? '('.$education[UNIVERSITY]->passing_year.')':""; ?></h6>
                                --><div class="table-responsive">
                                  <table class="table">
                                      <tr>
                                          <th>Institution</th>
                                            <th>Degree</th>
                                            <th>Grade/CGPA</th>
                                        </tr>
                                        <tr>
                                          <td><?php echo $education[UNIVERSITY]->institute_name ?></td>
                                            <td><?php echo $education[UNIVERSITY]->degree ?></td>
                                            <td><?php echo $education[UNIVERSITY]->grade ?></td>
                                        </tr>
                                    </table>
                                </div>
                      <?php } ?>
                      <?php if (!empty($education[COLLEGE]->institute_name)){ ?>
                                <!--<h6>University Education</h6>-->
                                <div class="table-responsive">
                                  <table class="table">
                                      <tr>
                                          <th>Institution</th>
                                            <th>Degree</th>
                                            <th>Grade/CGPA</th>
                                        </tr>
                                        <tr>
                                          <td><?php echo $education[COLLEGE]->institute_name ?></td>
                                            <td><?php echo $education[COLLEGE]->degree ?></td>
                                            <td><?php echo $education[COLLEGE]->grade ?></td>
                                        </tr>
                                    </table>
                                </div>
                      <?php } ?>
                      <?php if (!empty($education[SCHOOL]->institute_name)){ ?>
                                <!--<h6>College Education</h6>-->
                                <div class="table-responsive">
                                  <table class="table">
                                      <tr>
                                          <th>Institution</th>
                                            <th>Degree</th>
                                            <th>Grade/CGPA</th>
                                        </tr>
                                        <tr>
                                          <td><?php echo $education[SCHOOL]->institute_name ?></td>
                                            <td><?php echo $education[SCHOOL]->degree ?></td>
                                            <td><?php echo $education[SCHOOL]->grade ?></td>
                                        </tr>
                                    </table>
                                </div>
                      <?php } ?>
                            </div>
                          </div>
                        </div>

    <?php } ?>
       <?php  $teach = json_decode($tutor_details['teaching']);?> 
      <?php if((!empty($teach[0]->institute_name) || !empty($teach[1]->institute_name) || !empty($teach[2]->institute_name)))  { ?>           
   
        		          <div class="panel panel-default">
                      <div class="panel-heading" role="tab" id="headingTeaching">
                        <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTeaching" aria-expanded="false" aria-controls="collapseTeaching">Teaching &amp; Experience</a> </h4>
                      </div>
                      <div id="collapseTeaching" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTeaching" aria-expanded="false">
                        <div class="panel-body">
                 
                  <?php  $teaching = json_decode($tutor_details['teaching']);?>
                  <?php if (!empty($teaching[0]->institute_name)){ ?>
                          <h6>Teaching Experience 1 </h6>
                            <div class="table-responsive">
                              <table class="table">
                                  <tr>
                                      <th>Institution</th>
                                        <th>Period</th>
                                        <th>Academic Level</th>
                                        <th>Subjects Taught</th>
                                    </tr>
                                    <tr>
                                      <td><?php echo $teaching[0]->institute_name ?></td>
                                        <td><?php echo $teaching[0]->period ?></td>
                                        <td><?php echo $teaching[0]->ages_of_students ?></td>
                                        <td><?php echo str_replace(";",",",$teaching[0]->subjects_taught) ?></td>
                                    </tr>
                                </table>
                            </div>
                        <?php } ?>    
                  <?php if (!empty($teaching[1]->institute_name)){ ?>
                            <h6>Teaching Experience 2</h6>
                            <div class="table-responsive">
                              <table class="table">
                                  <tr>
                                      <th>Institution</th>
                                        <th>Period</th>
                                        <th>Academic Level</th>
                                        <th>Subjects Taught</th>
                                    </tr>
                                    <tr>
                                      <td><?php echo $teaching[1]->institute_name ?></td>
                                        <td><?php echo $teaching[1]->period ?></td>
                                        <td><?php echo $teaching[1]->ages_of_students ?></td>
                                        <td><?php echo str_replace(";",",",$teaching[1]->subjects_taught) ?></td>
                                    </tr>
                                </table>
                            </div>
                  <?php } ?>
                  <?php if (!empty($teaching[2]->institute_name)){ ?>
                            <h6>Teaching Experience 3</h6>
                            <div class="table-responsive">
                              <table class="table">
                                  <tr>
                                      <th>Institution</th>
                                        <th>Period</th>
                                        <th>Academic Level</th>
                                        <th>Subjects Taught</th>
                                    </tr>
                                    <tr>
                                      <td><?php echo $teaching[2]->institute_name ?></td>
                                        <td><?php echo $teaching[2]->period ?></td>
                                        <td><?php echo $teaching[2]->ages_of_students ?></td>
                                        <td><?php echo str_replace(";",",",$teaching[2]->subjects_taught) ?></td>
                                    </tr>
                                </table>
                            </div>
                  <?php } ?>
                 
                        </div>
                      </div>
                    </div>

      <?php   } ?>


    
      <?php   if(!empty($tutor_reviews)) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Ratings & Reviews</a> </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                      <div class="panel-body">


                <?php foreach($tutor_reviews as $review){?>
                        <div class="jumbotron">
                            <h4>Written by <a href="<?php echo ROUTE_STUDENT_PROFILE_VIEW.'/'.strtolower($review['first_name']).'/'.$review['student_id'] ?>"><?php echo ucwords($review['first_name'].' '.$review['last_name']) ?></a> <div class="rating-section-search-detail"><input type="text" class="tutor_detail_rating" data-size="xs" value="<?php echo $review['rating'] ?>"></div></h4>
                              <p><?php echo $review['review'] ?></p>
                          </div>
                <?php } ?>
              
                      </div>
                    </div>
                  </div>
     <?php   } ?>          
      <!-- ?>       -->

      

            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFive">
                <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Subjects & Academic Level</a> </h4>
              </div>
              <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
                <div class="panel-body">
					<?php if(!empty($tutor_subjects)){ ?>
					<!-- <h6>Subjects</h6>
                	<p>Subjects taught by <i><?php echo ucwords($tutor_details['first_name'].' ') ?> </i> are listed below.</p> -->
                	<div class="table-responsive">
                    	<table class="table">
                        	<tr>
                            	<th>Category</th>
                                <th>Subjects</th>
                            </tr>
							<?php foreach($tutor_subjects as $tutor_subject){?>
                            <tr>
                            	<td><?php echo $tutor_subject['main_subjects'] ?></td>
								<td>
								<?php 
								$tutor_sub = "";
								foreach ($tutor_subject['subjects'] as $sub_subject){
									$tutor_sub .= $sub_subject['name'].', ';
								}
									echo rtrim($tutor_sub,',')?>
								</td>
                            </tr>
							<?php } ?>
                        </table>
                   	</div>
					<?php } else { ?>
					<h6>No Information Yet</h6>
					<?php } ?>
					<h6>Level taught</h6>
					
					<?php if(($tutor_details['subject_level']) == "null" OR is_null($tutor_details['subject_level'])){ ?>
					<p> Not specified by the tutor. </p>
				    <?php } else { ?>
                	<p> <i><?php echo str_replace(",",", ", $tutor_details['subject_level'])  ?></i></p>
                	<?php } ?>
                </div>
              </div>
            </div>
			<div class="panel panel-default active">
              <div class="panel-heading active" role="tab" id="headingOne">
                <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="">Availability</a> </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="true">
                <div class="panel-body">
					<div class="availability-key" id="calendar_not_avaiable">
						<ul>
							<li><span class="available"></span> Available</li>
							<li><span class="booked"></span> Booked</li>
							<li><span class="reserved"></span> Reserved</li>
						</ul>
					</div>
					<div id="calendar"></div>
				  </div>
                </div>
              </div>
          </div>
		<form action="" method="post" name="paymentForm" id="paymentForm" style="display:none">
			<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
				data-key=<?php echo $common_data['site_settings']['stripe_pub'] ?>
				data-amount="<?php echo $tutor_details['hourly_rate']*100 ?>"
				data-name="Open Mind Tutors"
				data-description="Widget"
				data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
				data-locale="auto"
				data-zip-code="true"
				data-currency="gbp">
			</script>
		</form>
        </div>
      </div>
    </section>
    <!-- teacher profile end --> 
  </div>
</main>