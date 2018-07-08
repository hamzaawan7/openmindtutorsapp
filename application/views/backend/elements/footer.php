<!--************************* FOOTER <Start> ************************* -->
	</div>
</div>
<!-- END CONTAINER -->

<div class="page-footer">
	<div class="page-footer-inner"> 2017 &copy; <?php echo WEBSITE_NAME ?><!-- &nbsp; | &nbsp;

	<a target="_blank" class="footer-text-color" href="<?php echo BACKEND_TERMS_CONDITIONS_URL ?>">Terms & Conditions</a>-->
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>
</div>
<!-- Settings modal <START> -->
<div id="personal_info" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
		<img src="<?php echo ASSET_IMAGES_BACKEND_DIR ?>tick-img.png" class="img-responsive center-block" />
        <p id="up_text"></p>
		<div class="margin-top-10">
			<a href="<?php echo BACKEND_PROFILE_URL ?>" class="btn green modal-button"> OK </a>
		</div>
		</div>
    </div>

  </div>
</div>
<!-- Settings modal <END> -->


<!-- Script -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>jquery.min.js"></script> <!-- Jquery -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR ?>bootstrap.min.js"></script><!-- Bootstrap -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR ?>js.cookie.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>jquery.slimscroll.min.js"></script> <!-- jquery slim scroll -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>jquery.blockui.min.js"></script> <!-- jquery block ui -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>bootstrap-datepicker.min.js"></script><!-- bootstrap Date Range Picker -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR;?>datatable.js"></script><!-- datatable script  script-->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR;?>datatables/datatables.min.js"></script><!-- datatable   script-->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR;?>datatables/plugins/bootstrap/datatables.bootstrap.js"></script><!-- datatable bootstrap  script-->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR;?>bootstrap-fileinput.js"></script>
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR;?>jquery.sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>app.min.js"></script> <!-- app -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR ?>bootbox.js"></script><!-- Bootbox -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR;?>table-datatables-managed.js"></script><!-- datatable script  script-->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR ?>profile.min.js"></script><!-- profile.min.js -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR ?>ajaxfileupload.js"></script><!-- ajaxfileupload -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>layout.min.js"></script> <!-- layout -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR ?>demo.min.js"></script><!-- demo-->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>quick-sidebar.min.js"></script> <!-- quick-sidebar -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>quick-nav.min.js"></script> <!-- quick-nav -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>bootstrap-datepicker.min.js"></script><!-- bootstrap Date Range Picker -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>star-rating.min.js"></script><!-- Star Rating -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>nicEdit-latest.js"></script><!-- nicEdit-latest -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR ?>script.js"></script><!-- Script -->
<?php //if(strpos($_SERVER['REQUEST_URI'], 'admin_content')){?>

<script>
$(document).ready(function(){
$('.nicEdit-main').css('background' , '#ffffff');
//<![CDATA[
  bkLib.onDomLoaded(function() {
       // new nicEditor({maxHeight : 200}).panelInstance('page_content');
        new nicEditor({fullPanel : true,maxHeight : 500}).panelInstance('page_content');
  });
  //]]>
});
</script>
<script type="text/javascript">
	$(function() {
		$( "#datepicker" ).datepicker();
		$( "#datepicker-2" ).datepicker();
	});

<?php if(isset($page) && !empty($page)){ ?>
	$('.page-sidebar-menu li#<?php echo $page;?>').addClass('active open');
<?php } ?>
</script>
<script>
	$(".dropdown-menu.landing-page-dropdown-menu li a").click(function(){
	  var selText = $(this).text();
	  $(this).parents('.btn-group.landing-page-btn-group').find('.dropdown-toggle.landing-page-dropdown-toggle').html('Sort By: '+selText+' <span class="caret"></span>');
	});
	$(document).ready(function(){
		$('.dropdown-menu.landing-page-dropdown-menu li').click(function(){
			$(this).addClass('dropdown_active');
			$(this).siblings().removeClass('dropdown_active');

		});
		$('.slider_small_menu').click(function(){
			$(this).toggleClass('slider_small_menu_active');
		});
		//Switches
		//var elem = document.querySelector('.js-switch');
		//var init = new Switchery(elem, { size: 'small' });
	});
	
	$("#settings-live").bootstrapSwitch();
	$('#settings-live').on('switchChange.bootstrapSwitch', function (e, data) {
			$('#settings-live').bootstrapSwitch('state', !data, true);
			var status = 0;
			var msg = "Change site to offline mode?";
			if(data == true){
				status = 1
				msg = "Change site to live mode?";
			}
			bootbox.confirm({
				message: msg,
				backdrop: 'static',
				keyboard: false,
				callback: function(result) {
					if(result == true) {
						FUNCTION_NAME = 'changeSiteStatus';
						PARAM  = {status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
			});
	});
	function change_site_status(){
			var status = 0;
			var msg = "Change site to offline mode?";
		if($('#change_site_status').is(':checked')){
			status = 1
			msg = "Change site to live mode?";
		}
			bootbox.confirm({
				message: msg,
				backdrop: 'static',
				keyboard: false,
				callback: function(result) {
					if(result == true) {
						FUNCTION_NAME = 'changeSiteStatus';
						PARAM  = {status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
			});
	}
</script>

<!--************************* FOOTER <End> ************************* -->
<?php 
//This line of code will enable js functions to call CI's XAJAX functions
echo ( isset($this->xajax_js) )?$this->xajax_js:''; 
?>
<?php 
/* End of file footer.php */
/* Location: ./application/views/backend/elements/footer.php */
?>
