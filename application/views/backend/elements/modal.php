<!-- Sign Up Modal <Start> -->
<div class="modal fade sign-up-model" id="signup-modal">
	<div class="modal-dialog modal-dialog-center">
    	<img src="<?php echo FRONTEND_ASSET_IMAGES_DIR; ?>login-bg.png" alt="" class="login-arrow">
       		<div class="modal-content">
            	<div class="modal-header">
                    <h4 class="modal-title">SIGN UP</h4>
              	</div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>NAME</td>
                                <td><input type="text" name="title" id="title" /></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>EMAIL</td>
                                <td><input type="text" name="title" id="title" /></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>ORGANIZATION</td>
                                <td><input type="text" name="title" id="title" /></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>PASSWORD</td>
                                <td><input type="text" name="title" id="title" /></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
              	</div>
                <div class="modal-footer">
                	<a href="#" data-dismiss="modal" class="btn">JOIN US</a>
               	</div>
           	</div>
      	</div>
    </div>
</div>
<!-- Sign Up Modal <End> -->
<!-- Login Modal <Start> -->	
<div class="modal fade login-model" id="login-modal">
	<div class="modal-dialog modal-dialog-center">
    	<img src="<?php echo FRONTEND_ASSET_IMAGES_DIR; ?>login-bg.png" alt="" class="login-arrow">
        	<div class="modal-content">
            	<div class="modal-header">
                    <h4 class="modal-title">LOGIN</h4>
              	</div>
                <div class="modal-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>EMAIL</td>
                                <td><input type="text" name="title" id="title" /></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>PASSWORD</td>
                                <td><input type="text" name="title" id="title" /></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-right"><a href="#forgot-password-modal" data-toggle="modal" data-dismiss="modal"><i>Forgot Password</i></a></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
              	</div>
                <div class="modal-footer">
                	<a href="index.php" data-dismiss="modal" class="btn">LOGIN</a>
                    <p>New to PDX? <a href="#signup-modal" data-toggle="modal" data-dismiss="modal">Sign Up here</a></p>
               	</div>
           	</div>
      	</div>
    </div>
 </div>   
<!-- Login Modal <End> -->
<!-- Forgot Password Modal <Start> -->
<div class="modal fade login-model" id="forgot-password-modal">
	<div class="modal-dialog modal-dialog-center">
    	<img src="<?php echo FRONTEND_ASSET_IMAGES_DIR; ?>login-bg.png" alt="" class="login-arrow">
       		<div class="modal-content">
           		<div class="modal-header">
                    <h4 class="modal-title">FORGOT PASSWORD</h4>
              	</div>
                <div class="modal-body">
                	<table class="table">
                        <tbody>
                            <tr>
                                <td>EMAIL</td>
                                <td><input type="text" name="title" id="title" /></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-right"><a href="#login-modal" data-toggle="modal" data-dismiss="modal"><i>Back to login</i></a></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
              	</div>
                <div class="modal-footer">
                	<a href="#" data-dismiss="modal" class="btn">Submit</a>
                    <p>New to PDX? <a href="#signup-modal" data-toggle="modal" data-dismiss="modal">Sign Up here</a></p>
               	</div>
           	</div>
      	</div>
    </div>
</div>
<!-- Forgot Password Modal <End> -->
