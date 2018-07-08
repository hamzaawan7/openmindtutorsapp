<main>
  <div class="container"> 
    <!-- Teachers profile
======================================== -->
    <section class="profile">
      <div class="row">
        <div class="col-md-4">
          <div class="profile-image"><img alt="user profile" src="<?php echo ($user_details['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$user_details['image'] ?>"/></div>
        </div>
        <div class="col-md-8">
          <div class="head-style-3 margin-0-30">
            <div class="subhead"><i class="fa fa-map-marker"></i> <?php echo $user_details['address'] ?></div>
            <h2 class="style-2"><?php echo ucwords($user_details['first_name'].' '.$user_details['last_name']) ?></h2>
            <!--<div class="h5">Web Development Teacher</div>-->
          </div>
          <div class="row">
            <div class="col-sm-12">
				<h6>Instruction to find the house</h6>
              <p><?php echo $user_details['instruction'] ?></p>
            </div>
          </div>
          <div class="panel-group margin-30" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFive">
                <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">Subjects interested in</a> </h4>
              </div>
              <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" aria-expanded="false">
                <div class="panel-body">
					<?php if(!empty($student_subjects)){ ?>
                	<!--<p>Subjects taught by <i>Thomas WRIGHT</i> are listed below.</p>-->
                	<div class="table-responsive">
                    	<table class="table">
                        	<tr>
                            	<th>Main Subject</th>
                                <th>Subjects</th>
                            </tr>
							<?php foreach($student_subjects as $student_subject){?>
                            <tr>
                            	<td><?php echo $student_subject['main_subjects'] ?></td>
								<td>
								<?php 
								$student_sub = "";
								foreach ($student_subject['subjects'] as $sub_subject){
									$student_sub .= $sub_subject['name'].', ';
								}
									echo rtrim($student_sub,', ')?>
								</td>
                            </tr>
							<?php } ?>
                        </table>
                   	</div>
					<?php } else { ?>
					<h6>No Information Yet</h6>
					<?php } ?>
                </div>
              </div>
            </div>
			<div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Ratings & Reviews</a> </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                <div class="panel-body">
					<?php if(!empty($student_reviews)){
							foreach ($student_reviews as $review){?>
                	<div class="jumbotron">
                    	<h4>Written for <a href="<?php echo ROUTE_SEARCH_DETAIL.'/'.$review['tutor_id'] ?>"><?php echo ucwords($review['first_name'].' '.$review['last_name']) ?></a> <div class="rating-section-search-detail"><input type="text" class="tutor_detail_rating" data-size="xs" value="<?php echo $review['rating'] ?>"></div></h4>
                        <p><?php echo $review['review'] ?></p>
                  	</div>
						<?php }
						} else { ?>
					<h6>No Reviews Yet</h6>
					<?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- teacher profile end --> 
  </div>
  <!-- Similar teachers -->
  <?php if(!empty($related_students)){ ?>
  <section class="teacher-search">
    <div class="head-style-1 margin-0-30">
      <div class="subhead">You can find a best student</div>
      <h2 class="style-2">RELATED STUDENTS</h2>
    </div>
    <div class="container">
      <div class="carousel zerocarousel four-column slide simple-box margin-30-0 related-student-section" id="carousel-columns">
        <div class="carousel-inner">
		<?php foreach ($related_students as $key=>$related_student){ ?>
          <div class="item <?php echo ($key == 0)? "active":""; ?>">
            <div class="col-xs-12 col-sm-6 col-md-3">
              <div class="list-item style-1">
                <div class="top"> <a href="<?php echo ROUTE_STUDENT_PROFILE_VIEW.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace($related_student['first_name'])))).'/'.$related_student['id'] ?>"><img alt="teacher" src="<?php echo ($related_student['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$related_student['image'] ?>" /></a> <a class="icon" href="<?php echo ROUTE_STUDENT_PROFILE_VIEW.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace($related_student['first_name'])))).'/'.$related_student['id'] ?>"><i class="fa fa-link"></i></a> </div>
                <div class="list-icon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
                <div class="text"> <!--<small><a href="#">Chemistry Teacher</a></small>-->
                  <h5><a href="<?php echo ROUTE_STUDENT_PROFILE_VIEW.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace($related_student['first_name'])))).'/'.$related_student['id'] ?>"><?php echo ucwords($related_student['first_name'].' '.$related_student['last_name']) ?></a></h5>
                </div>
              </div>
            </div>
          </div>
        </div>
		<?php } ?>
        <div class="controls"> <a class="left carousel-control" href="#carousel-columns" data-slide="prev"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a> <a class="right carousel-control" href="#carousel-columns" data-slide="next"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> </div>
      </div>
    </div>
  </section>
  <?php } ?>
</main>
