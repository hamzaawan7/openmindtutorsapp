<!--************************* FOOTER <Start> ************************* -->
<footer class="style-1"> 
  <div class="container"> 
    <!-- Footer middle
======================================== -->
    <div class="middle">
      <div class="row">
        <div class="col-sm-4 part">
          <h6>ABOUT US</h6>
          <p>We help to connect private tutors to students at no upfront costs</p>
          <ul>
            <!--<li><i class="fa fa-phone" aria-hidden="true"></i>123 124 42 42</li>-->
            <li>
            	<i class="fa fa-envelope-o" aria-hidden="true"></i>
            	<a href="mailto:info@openmindtutors.co.uk">info@openmindtutors.co.uk</a>
            </li>
            <li>
            	<a href="tel:+10503835">Registered Company Number : 10503835</a>
            </li>
            <!--<li><i class="fa fa-map-marker" aria-hidden="true"></i>893 Fifth Ave, New York NY 01741</li>-->
          </ul>
        </div>
        <div class="col-sm-8 part">
          <div class="row">
			<div class="col-xs-4">
            	<h6>USEFUL LINKS</h6>
              <ul class="border">
                <li><a href="<?php echo ROUTE_CONTACT_US ?>">Contact Us</a></li>
				<li><a href="<?php echo ROUTE_PRIVACY_POLICY ?>">Privacy Policy</a></li>
                <li><a href="<?php echo ROUTE_TERMS_AND_CONDITIONS ?>">Terms &amp; Conditions</a></li>
              </ul>
            </div>
            <div class="col-xs-4">
            	<h6>STUDENTS</h6>
              <ul class="border">
			<?php if(!isset($common_data['user_id'])){ ?>
                <li><a href="<?php echo ROUTE_REGISTER; ?>">Register</a></li>
			<?php } ?>
                <li><a href="<?php echo ROUTE_STUDENT_FAQS ?>">Student FAQs</a></li>
				<li><a href="<?php echo ROUTE_HOW_IT_WORKS ?>" >How It Works</a></li>
              </ul>
            </div>
            <div class="col-xs-4">
            	<h6>TUTORS</h6>
              <ul>
			<?php if(!isset($common_data['user_id'])){ ?>
                <li><a href="<?php echo ROUTE_REGISTER; ?>">Register</a></li>
			<?php } ?>
                <li><a href="<?php echo ROUTE_TUTOR_FAQS ?>">Tutor FAQs</a></li>
				<li><a href="<?php echo ROUTE_BECOME_TUTOR ?>">Become a Tutor</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- footer middle end --> 
    
    <!-- Footer bottom
======================================== -->
    <div class="bottom">
      <div class="row">
        <div class="col-sm-8 part developed-by-text">
        	<i class="fa fa-copyright" aria-hidden="true"></i> 
        	2017 OPEN MIND TUTORS - ALL RIGHTS RESERVED 
        	<!--| <span>DEVELOPED BY</span> <a href="http://appstersinc.com/" target="_blank">APPSTERS</a>--></div>
        <div class="col-sm-4">
          <!--<div class="social-media"> <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a><!-- <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a>--> 
		  <!--</div>-->
        </div>
        <!--<div class="col-sm-2 part">Developed by <a href="http://appstersinc.com/" target="_blank">Appsters</a></div>-->
      </div>
    </div>
    <!-- footer bottom end --> 
  </div>
  <a href="#" class="scrollup"><i class="fa fa-angle-up" aria-hidden="true"></i></a>
</footer>
<!-- #footer end --> 

<!-- App Review Modal -->
<div id="app_review_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">App Review</h4>
      </div>
      <div class="modal-body">
			<div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="text" class="form-control" id="review_headline" placeholder="Headline">
              </div>
            </div>
			<label class="text-center" style="width: 100%;">Rating</label>
			<div class="tutor_level_management_section text-center"><span class="star_rating_popluar_tutor"><input id="add-review" type="text" data-size="xs" value="0"></span></div>
			<div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <textarea class="form-control review-comment-area" id="review" placeholder="Review"></textarea>
              </div>
            </div>
			<div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="text" class="form-control" id="review_outcome" placeholder="Outcome">
              </div>
            </div>
		<div class="form-group errorMsg" style="color:red">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="addReview(<?php echo (isset($lesson_details))? $lesson_details['id'].','.$lesson_details['tutor_id'].','.$lesson_details['student_id']:''; ?>)">Save</button>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Search Detail Calendar Form Modal -->
<div id="search_detail_calendar_form_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Book a Lesson</h4>
      </div>
      <div class="modal-body">
		<div class="row">
		  <div class="col-sm-6" id="book_subject_div">
			<div class="form-group">
			  <div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
				<select class="form-control" id="book_subject">
					<option value="0">Select Subject</option>
					<?php if(isset($tutor_subjects) && !empty($tutor_subjects)){
						foreach ($tutor_subjects as $tutor_subject){
							foreach ($tutor_subject['subjects'] as $tutor_sub){?>
						<option value="<?php echo $tutor_sub['name'] ?>"><?php echo $tutor_sub['name'] ?></option>
						<?php } 
						}
					} ?>
				</select>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-12" id="syllabus_subject">
			<div class="form-group">
			  <b>Syllabus:</b> <span></span>
			</div>
		  </div>
		  <!--<div class="col-sm-6">
			<div class="form-group">
			  <div class="input-group"><span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
				<input type="text" class="form-control" placeholder="Location">
			  </div>
			</div>
		  </div>-->
		</div>
		<input type="hidden" class="form-control" id="tutor_availability_id">
		<input type="hidden" class="form-control" id="lesson_date">
		<input type="hidden" class="form-control" id="lesson_type">
		<div class="form-group">
		  <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
			<textarea class="form-control" rows="3" id="booking_message" placeholder="I'm looking for a tutor.."></textarea>
		  </div>
		</div>
		<div class="form-group errorMsg" style="color:red">
		</div>
		<!--<div class="form-group">
		  <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
			<input type="text" class="form-control" placeholder="Phone Number">
		  </div>
		</div>-->
      </div>
      <div class="modal-footer">
        <button type="button" id="message_sent_button" class="btn btn-default" onclick="bookLesson(<?php echo (isset($tutor_details) && !empty($tutor_details))? $tutor_details['tutor_id']:""; ?>,<?php echo (isset($common_data['user_id']))? $common_data['user_id']:""; ?>)">Send</button>
      </div>
    </div>
  </div>
</div>

<!--SCRIPT FILES <Start> -->
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4NRmYLQYSwDrkdinAcRqNdnMt8UQ1XNs&callback=initMap"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>google-maps.js"></script> 
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>bootstrap-slider.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>zepto.min.js"></script> 
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>calendar.min.js"></script> 
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>plugins.js"></script> 
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>star-rating.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>select2.min.js"></script>

<!-- Footer Scripts
======================================== --> 
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>functions.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>jquery.lazyload.min.js"></script> <!-- jquery.lazyload.min -->
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>bootbox.js"></script> <!-- Bootbox -->
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>jquery-ui.min.js"></script> <!-- jquery-ui.min -->
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>ajaxfileupload.js"></script> <!-- Ajax File Upload -->
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>jquery.dataTables.min.js"></script> <!-- dataTables -->
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>fb_sdk.js"></script> <!-- fb sdk -->
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>script.js"></script> <!-- Grub Connect Project Script -->
<!--SCRIPT FILES <End> -->

<script>
$(document).ready(function(){
<?php  if(isset($_SESSION['payment_done'])){
			if($_SESSION['payment_done'] == 1){?>
	bootbox.alert('Payment Done Successfully');
			<?php } else { ?>
	bootbox.alert('Please try again later');			
			<?php } ?>
<?php $this->session->unset_userdata('payment_done'); } ?>
})	
</script>
<!-- tahir -->
<script>
 /*$( "li.dropdown" ).hover(
  function() {
    $( this ).addClass("open");
    $( this ).find(".dropdown-toggle").attr("aria-expanded","true");
  }, function() {
    $( this ).removeClass("open");
    $( this ).find(".dropdown-toggle").attr("aria-expanded","false");
  }
);

		$(document).ready(function() {
			$('li.dropdown').click(function() {
				$('ul.dropdown-menu', this).stop(true, true).slideDown('fast');
					$(this).addClass('open');
				}, function() {
				$('ul.dropdown-menu', this).stop(true, true).slideUp('fast');
					$(this).removeClass('open');
			});
		});*/
		$(document).ready(function() {
			$('.dropdown').on('show.bs.dropdown', function(e){
			  $(this).find('.dropdown-menu').first().stop(true, true).slideDown(300);
			});
			$(document).on('click','.ui-menu-item', function(e) {
				e.stopPropagation();
			});			
			$('.dropdown').on('hide.bs.dropdown', function(e){
			  $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
			});
		});

      $(document).ready(function() {
		$('#datatable_user').DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		});
		$('#datatable_user1').DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		});

        $('.zoom-gallery').magnificPopup({
          delegate: 'a',
          type: 'image',
          closeOnContentClick: false,
          closeBtnInside: false,
          mainClass: 'mfp-with-zoom mfp-img-mobile',
          image: {
            verticalFit: true,
            titleSrc: function(item) {
              return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
            }
          },
          gallery: {
            enabled: true
          },
          zoom: {
            enabled: true,
            duration: 300, // don't foget to change the duration also in CSS
            opener: function(element) {
              return element.find('img');
            }
          }
        });
      });
</script>
<script>
	$(window).load(function() {
		if($('.topic-reply .row').hasClass('new-message')){
			$('html, body').animate({
				scrollTop: $(".new-message").offset().top + -90
			}, 1000);
			
		}
	})

	$(document).ready(function() {	
<?php if(isset($availablity) && !empty($availablity)){ ?>
		$('#calendar').fullCalendar({
			header: {
			 left   : 'prev,next',
			 center : 'title',
			 right  : 'agendaWeek',
			},
			defaultView: 'agendaWeek',
			scrollTime: <?php echo '"'.$default_time_final.'"' ?>,
			defaultDate: <?php echo '"'.$default_date.'"' ?>,
			firstDay: <?php echo $first_day ?>,
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			displayEventTime: true,
			events: <?php echo json_encode($availablity) ?>,
			eventRender: function(event, element) {
				var event_date = event.start._d.toISOString().split("T");
				for(var i =0; i <= event.lesson_date.length;i++){
					var ev_date = (event.lesson_date[i] != undefined ) ? event.lesson_date[i].split(","): "";
					if(ev_date != ""){
					if(ev_date[0] == event_date[0]){
						if(event.seats > 1){
							event.title = ev_date[1]+'/'+event.seats+' students';
						} else {
							event.title = event.seats+' student';
						}
						element.find('.fc-title').html(event.title);
						if(event.seats == ev_date[1]){
							element.css('background-color', '#E74C3C');
							element.css('border-color', '#E74C3C');
							event.status= "booked";
						} else if(event.seats > ev_date[1]){
							element.css('background-color', '#FF9B1D');
							element.css('border-color', '#FF9B1D');
							event.status = "reserve";
						} else {
							element.css('background-color', '#6AA4C1');
							element.css('border-color', '#6AA4C1');
							event.status = "available";							
						}
					}
				}
				}
				var d = event.start._d;
				var a = new Date();
				if (d < a){
					return false;
				}
			},
			eventClick: function(calEvent, jsEvent, view) {
					var event_date = calEvent.start._d.toISOString().split("T");
				for(var i =0; i <= calEvent.lesson_date.length;i++){
					var ev_date = (calEvent.lesson_date[i] != undefined ) ? calEvent.lesson_date[i].split(","): "";
					if(ev_date != ""){
						if(ev_date[0] == event_date[0]){
							calEvent['student_ids'] = ev_date[2]+',';
						}
					}
				}
				<?php if (isset($common_data['user_id']) && $common_data['user_data']['is_active'] == DISABLED_STATUS_ID){ ?>
						bootbox.confirm({
						message: 'Your account is disable. Please enable your acount first to book a lesson.',
						buttons: {
							confirm: {
								label: 'Account Settings'
							},
							cancel: {
								label: 'Cancel'
							}
						},
						callback: function(result) {
							if(result == true) {
								location.href = '<?php echo ROUTE_ACCOUNT_SETTINGS ?>';
							}
						}
						}); 
				<?php } else if(isset($common_data['user_id']) && $common_data['user_id'] != $tutor_details['tutor_id']){ ?>
					if (calEvent.status == "booked") {
						bootbox.alert("Sorry, this lesson is already booked");
					} else {
						if (calEvent.student_ids != undefined && calEvent.student_ids.indexOf(<?php echo $common_data['user_id'] ?>) >= 0){
							bootbox.alert("You have already booked this lesson");
						} else {
							if(calEvent.lesson_type == 1){
								$('#syllabus_subject').hide();
								$('#book_subject_div').show();
								$('#book_subject').val('0');
							} else {
								$('#syllabus_subject').show();
								$('#book_subject_div').hide();
	//							$('#book_subject').val(calEvent.syllabus_subject);
								$('#syllabus_subject span').text(calEvent.syllabus);
							}
								var lesson_date = calEvent.start._d.toISOString();
		//						var lesson_date = ((calEvent.start.date() < 10)? '0'+(calEvent.start.date()): (calEvent.start.date()))+'-'+((calEvent.start.month()+1 < 10)? '0'+(calEvent.start.month()+1): (calEvent.start.month()+1))+'-'+calEvent.start.year();
								$('#lesson_date').val(lesson_date);
								$('#lesson_type').val(calEvent.lesson_type);
								$('#tutor_availability_id').val(calEvent.id);
								$('#search_detail_calendar_form_modal').modal("show");
						}

					}
				<?php } else { 
					if(isset($common_data['user_id']) && $common_data['user_id'] == $tutor_details['tutor_id']){
					?>
						bootbox.alert("You can not book your own lesson");
					<?php } if(!isset($common_data['user_id'])) { ?>
						bootbox.confirm({
						message: 'Please login to book a lesson',
						buttons: {
							confirm: {
								label: 'Login'
							},
							cancel: {
								label: 'Cancel'
							}
						},
						callback: function(result) {
							if(result == true) {
								location.href = '<?php echo ROUTE_LOGIN ?>';
							}
						}
						}); 
					<?php } ?>
				<?php } ?>
			},
			//restricting available dates to 2 months in future
			viewRender: function(view,element) {
				var now = new Date();
				var end = new Date();
				end.setMonth(now.getMonth() + 2); //Adjust as needed

				if ( end < view.end) {
					$("#calendar .fc-next-button").hide();
					return false;
				}
				else {
					$("#calendar .fc-next-button").show();
				}

				if ( view.start < now) {
					$("#calendar .fc-prev-button").hide();
					return false;
				}
				else {
					$("#calendar .fc-prev-button").show();
				}
			}
		});
<?php } else { ?>
	$('#calendar_not_avaiable').html("<h6>Please contact tutor for availability.</h6>")
<?php } ?>
		
	});

</script>
<script>
	
	$(document).on('click', '.browse', function(){
	  var file = $(this).parent().parent().parent().find('.file_upload');
	  file.trigger('click');
	});
	$(document).on('click', '.browse', function(){
	  var file = $(this).parent().parent().parent().find('.file_info');
	  file.trigger('click');
	});
	$(document).on('change', '.file_upload', function(){
	  $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
	});
	
	$('.btn-toggle').click(function() {
		$(this).find('.btn').toggleClass('active');  
		
		if ($(this).find('.btn-primary').size()>0) {
			$(this).find('.btn').toggleClass('btn-primary');
		}
		if ($(this).find('.btn-danger').size()>0) {
			$(this).find('.btn').toggleClass('btn-danger');
		}
		if ($(this).find('.btn-success').size()>0) {
			$(this).find('.btn').toggleClass('btn-success');
		}
		if ($(this).find('.btn-info').size()>0) {
			$(this).find('.btn').toggleClass('btn-info');
		}
		
		$(this).find('.btn').toggleClass('btn-default');
		   
	});
	
</script>
<!--Google Analytics <Start> -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-97912999-1', 'auto');
  ga('send', 'pageview');

</script>
<!--Google Analytics <End> -->
<!-- tahir -->
<?php
//This line of code will enable js functions to call CI's XAJAX functions
echo ( isset($this->xajax_js) )?$this->xajax_js:''; 
?>
<!--************************* FOOTER <End> ************************* -->

<?php 
/* End of file footer.php */
/* Location: ./application/views/frontend/elements/footer.php */
?>