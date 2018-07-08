<main>
  <div class="container"> 
    <!-- Filter area
======================================== -->
    <div class="filter-area">
	<?php if (!empty($main_subject_name)){ ?>
	  <label>Main Subject: <?php echo $main_subject_name['name'] ?></label>
	<?php } ?>
      <div class="row">
        <div class="col-sm-4 last-column">
          <div class="part location-search-list">
			<label>Select Subject</label>
			  <input type="text" class="form-control search_fields subject_autocomplete" id="search_subject" value="<?php echo (isset($_GET['subject']))? $_GET['subject']:""; ?>" placeholder="Type Subject">
          </div>
        </div>
		<div class="col-sm-4 last-column">
          <div class="part location-search-list">
			<label>Select Level</label>
			  <input type="text" class="form-control search_fields level_autocomplete" id="search_level" value="<?php echo (isset($_GET['level']))? $_GET['level']:""; ?>" placeholder="Type Level">
          </div>
        </div>
        <div class="col-sm-4 last-column">
          <div class="part location-search-list">
			<label>Select Location</label>
            <input type="text" class="form-control search_fields" id="search_location" value="<?php echo (isset($_GET['location']))? $_GET['location']:""; ?>" placeholder="Location" />
          </div>
        </div>
      </div>
    </div>
    <!-- filter area end -->
    <!-- Posts
======================================== -->
    <section class="thumb-list">
		<div class="col-sm-3 search-list-side-filter margin-30-0">
			<div class="col-md-12 margin-bottom-10">
			  <div class="part hourly-rate-filter">
				<?php $hourly_rate = "";
						$hourly_rate = (isset($_GET['rate']) && !empty($_GET['rate']))? explode(',',$_GET['rate']):"";  ?>
				<h6>Hourly Rate: <?php echo CURRENCY_SYMBOL ?><span id="ex2-sliderLowerSliderVal"><?php echo (!empty($hourly_rate))? $hourly_rate[0]:"5"; ?></span> - <?php echo CURRENCY_SYMBOL ?><span id="ex2-sliderUpperSliderVal"><?php echo (!empty($hourly_rate))? $hourly_rate[1]:"200"; ?></span></h6>
				<?php $hourly_rate = "";
						$hourly_rate = (isset($_GET['rate']) && !empty($_GET['rate']))? explode(',',$_GET['rate']):"";  ?>
				<div class="slider slider-horizontal"><input id="ex2" type="text" class="span2" value="<?php echo (isset($_GET['rate']) && !empty($_GET['rate']))? $_GET['rate']:"5,200"; ?>" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="[<?php echo (isset($_GET['rate']) && !empty($_GET['rate']))? $_GET['rate']:"5,200"; ?>]"/></div>
			  </div>
			</div>
			<div class="col-md-12 margin-bottom-10">
			  <h6>Rating</h6>
				<div class="rating-section-search-detail">
					<input id="input-id" type="text" value="<?php echo (isset($_GET['rating']))? $_GET['rating']:""; ?>" data-size="xs" >
				</div>
			</div>
			<div class="col-md-12 margin-bottom-10">
			  <div class="part hourly-rate-filter">
				<h6>Distance: <span id="distance_slider_value"><?php echo (isset($_GET['distance']) && !empty($_GET['distance']))? $_GET['distance']:"10"; ?></span> miles</h6>
				<div class="slider slider-horizontal"><input id="distance_slider" type="text" class="span2" value="<?php echo (isset($_GET['distance']) && !empty($_GET['distance']))? $_GET['distance']:"10"; ?>" data-slider-min="1" data-slider-max="<?php echo MAX_DISTANCE ?>" data-slider-step="1" data-slider-value="[<?php echo (isset($_GET['distance']) && !empty($_GET['distance']))? $_GET['distance']:"10"; ?>]"/></div>
			  </div>
			</div>
			<div class="col-md-12 margin-bottom-10">
			  <h6>Sort By Price</h6>
				<div class="experience_switch sort_price">
					<div class="btn-group btn-toggle">
						<button class="btn btn-lg <?php echo (!isset($_GET['sort_price']) || strtolower($_GET['sort_price'])!='desc')? "btn-primary active":"btn-default"; ?>">ASC</button>
						<button class="btn btn-lg <?php echo (isset($_GET['sort_price']) && !empty($_GET['sort_price']) && strtolower($_GET['sort_price'])=='desc')? "btn-primary active":"btn-default"; ?>">DESC</button>
					</div>
				</div>
			</div>
			<div class="col-md-12 margin-bottom-10">
			  <h6>Sort By Rating</h6>
				<div class="experience_switch sort_rating">
					<div class="btn-group btn-toggle">
						<button class="btn btn-lg <?php echo (!isset($_GET['sort_rating']) || strtolower($_GET['sort_rating'])!='desc')? "btn-primary active":"btn-default"; ?>">ASC</button>
						<button class="btn btn-lg <?php echo (isset($_GET['sort_rating']) && !empty($_GET['sort_rating']) && strtolower($_GET['sort_rating'])=='desc')? "btn-primary active":"btn-default"; ?>">DESC</button>
					</div>
				</div>
			</div>
			<div class="col-md-12">
			  <h6>Sort By Distance</h6>
				<div class="experience_switch sort_distance">
					<div class="btn-group btn-toggle">
						<button class="btn btn-lg <?php echo (!isset($_GET['sort_distance']) || strtolower($_GET['sort_distance'])!='desc')? "btn-primary active":"btn-default"; ?>">ASC</button>
						<button class="btn btn-lg <?php echo (isset($_GET['sort_distance']) && !empty($_GET['sort_distance']) && strtolower($_GET['sort_distance'])=='desc')? "btn-primary active":"btn-default"; ?>">DESC</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-9 search-list-right-section margin-30-0">
			<?php if(!empty($search_details)){$count = 1;
				foreach ($search_details as $tutors){
					if ($count%3 == 1)
						{  
							 echo "<div class='row'>";
						}?>
			<div class="col-md-4">
			  <div class="item big margin-0-60">
				<div class="top"> <a href="<?php echo ROUTE_SEARCH_DETAIL.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $tutors['first_name'])))).'/'.$tutors['id'] ?>">
				<div class="slider-bg-image hidden-xs" style="background:url('<?php echo ($tutors['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$tutors['image'] ?>')"></div>
				<img alt="course list image" class="hidden-lg hidden-md hidden-sm" src="<?php echo ($tutors['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$tutors['image'] ?>"/>
				</a> 
			  <a class="icon" href="<?php echo ROUTE_SEARCH_DETAIL.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $tutors['first_name'])))).'/'.$tutors['id'] ?>"><i class="fa fa-link"></i></a>
				</div>
				<div class="meta">
				  <div class="list-icon"><?php echo (!empty($tutors['avg_rating']))? round($tutors['avg_rating'],1).' <br> Rating':'No <br> Rating'; ?></div>
				  <div class="details">
					<div class="row">
					  <div class="col-xs-12"><a href="<?php echo ROUTE_SEARCH_DETAIL.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $tutors['first_name'])))).'/'.$tutors['id'] ?>" class="tutor_amount"><?php echo CURRENCY_SYMBOL ?><?php echo $tutors['hourly_rate'] ?> per hour</a></div>
					</div>
				  </div>
				</div>
				<h6><a href="<?php echo ROUTE_SEARCH_DETAIL.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $tutors['first_name'])))).'/'.$tutors['id'] ?>"><?php echo ucwords($tutors['first_name']) ?></a></h6>
				<!-- end list-meta -->
				<p><?php echo (strlen($tutors['personal_statement']) > 90)? strip_tags(substr($tutors['personal_statement'], 0, 90)).'...':$tutors['personal_statement']; ?></p>
				<div class="links"> <a href="<?php echo ROUTE_SEARCH_DETAIL.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $tutors['first_name'])))).'/'.$tutors['id'] ?>" class="btn btn-blue">VIEW PROFILE</a> </div>
			  </div>
			</div>
			<?php if ($count%3 == 0)
				{
					echo "</div>";
				}
				$count++; ?>
			<?php } 
			if ($count%3 != 1) echo "</div>"; } else { ?>
			<div class="col-md-12">
				<h6>No Tutor found. Please change your search criteria.</h6>
			</div>
			<?php } ?>
	  </div>
    </section>
    <!-- posts end --> 
    <!-- Pagination
======================================== -->
    <nav class="text-center">
        <?php if($last_page > 1) { ?>
      <ul class="pagination" id="pagination">
		<?php if($current_page != $first_page) { ?>
        <li> <a href="javascript:void(0);" data-page="<?php echo $current_page - 2; ?>" aria-label="Previous"> <span aria-hidden="true">«</span> </a> </li>
		<?php } ?>
		<?php if( ($current_page - 2) >= $first_page) { ?>
			<li><a href="javascript:void(0);" data-page="<?php echo $current_page - 3; ?>" class="active"><?php echo $current_page - 2; ?></a></li>
		<?php } ?>
		<?php if( ($current_page - 1) >= $first_page) { ?>
			<li><a href="javascript:void(0);" data-page="<?php echo $current_page - 2; ?>"><?php echo $current_page - 1; ?></a></li>
		<?php } ?>
		<li class="active"><a href="javascript:void(0);"><?php echo $current_page; ?></a></li>
		<?php if( ($current_page + 1) <= $last_page) { ?>
			<li><a href="javascript:void(0);" data-page="<?php echo $current_page; ?>"><?php echo $current_page + 1; ?></a></li>
		<?php } ?>
		<?php if( ($current_page + 2) <= $last_page) { ?>
			<li><a href="javascript:void(0);" data-page="<?php echo $current_page + 1; ?>"><?php echo $current_page + 2; ?></a></li>
		<?php } ?>
		<?php if($current_page != $last_page) { ?>
        <li> <a href="javascript:void(0);" data-page="<?php echo $current_page; ?>" aria-label="Next"> <span aria-hidden="true">»</span> </a> </li>
		<?php } ?>
      </ul>
        <?php } ?>
    </nav>
    <!-- pagination end --> 
  </div>
</main>
