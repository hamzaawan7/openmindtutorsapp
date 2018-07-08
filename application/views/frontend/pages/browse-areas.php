<main>
  <div class="container"> 
    <!-- Teachers profile
======================================== -->
    <section class="browse-subjects">
      <div class="row">
        <div class="col-md-12">
			<!--<p>Open Mind Tutors connects parents and students with a nationwide network of professional, expert tutors. Our booking process offers a simple way for you to manage and pay for lessons, avoiding the hassle of bringing cash along to lessons. Below you can find a list of the most popular subjects in which we offer tuition. We offer many subjects other than the ones listed below, so if you can't find what you are looking for, try searching for it instead.</p>
			<p>Oh, and did we mention that we offer a 100% satisfaction guarantee? If you're not entirely happy with your first lesson, we'll pay for your next lesson with a tutor, no questions asked.</p>-->
        </div>
	  </div>
		<?php if(!empty($main_areas)){
			$count = 1;
			foreach ($main_areas as $area){
				if($count%22 == 1){?>
				<div class="col-sm-3">
					<ul class="list-ui">
				<?php } ?>
						<li class="list-ui__item">
							<a href="<?php echo ROUTE_SEARCH."?location=".$area['name'] ?>"><?php echo $area['name'] ?></a>
						</li>
				<?php if($count%22 == 0){?>
					</ul>
			  </div>
				<?php } ?>
			<?php $count++;} ?>
		<?php } ?>
    </section>
    <!-- teacher profile end --> 
  </div>
</main>