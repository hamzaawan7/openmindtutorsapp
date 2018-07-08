<!--************************* FOOTER <Start> ************************* -->
<!-- BEGIN COPYRIGHT -->
			<div class="login-footer">
				<div class="row bs-reset">
					<div class="col-xs-5 bs-reset">
					</div>
					<div class="col-xs-7 bs-reset">
						<div class="login-copyright text-right">
							<p>Copyright &copy; <?php echo WEBSITE_NAME ?> 2017</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END COPYRIGHT -->   
<!--SCRIPT FILES -->

<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>jquery.min.js"></script> <!-- Jquery -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>bootstrap.min.js"></script> <!-- Bootstrap -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR ?>bootbox.js"></script><!-- Bootbox -->
<script type="text/javascript"  src="<?php echo ASSET_JS_BACKEND_DIR ?>js.cookie.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>jquery.slimscroll.min.js"></script> <!-- jquery slim scroll -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>jquery.blockui.min.js"></script> <!-- jquery block ui -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>jquery.validate.min.js"></script> <!-- jquery validate -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>additional-methods.min.js"></script> <!-- additional methods -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>select2.full.min.js"></script> <!-- select2 -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>jquery.backstretch.min.js"></script> <!-- jquery backstretch -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>app.min.js"></script> <!-- app -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>login/login-5.js"></script> <!-- login-5 -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>star-rating.min.js"></script><!-- Star Rating -->
<script type="text/javascript" src="<?php echo ASSET_JS_BACKEND_DIR;?>script.js"></script> <!-- theme Script -->
<?php 

//This line of code will enable js functions to call CI's XAJAX functions
echo ( isset($this->xajax_js) )?$this->xajax_js:''; 
?>
<!--************************* FOOTER <End> ************************* -->
<?php 
/* End of file footer.php */
/* Location: ./application/views/backend/elements/footer.php */
?>