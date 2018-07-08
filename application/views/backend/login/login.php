        <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset mt-login-5-bsfix">
                    <div class="login-bg" style="background-image:url(<?php echo ASSET_IMAGES_BACKEND_DIR ?>login/bg1.jpg)">
                        <img class="login-logo" src="<?php echo ASSET_IMAGES_BACKEND_DIR ?>login/omt-logo.png" />
                  	</div>
                </div>
                <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
                    <div class="login-content">
                        <h1>OMT Admin Login</h1>
                        <p>Welcome to the admin panel of Open Mind Tutors. This admin panel gives you complete control over your website with individual focus on students, tutors, lessons, payments, and reviews.</p>
						<form class="login-form" method="post" id="loginForm" name="loginForm" onsubmit="loginByEmail(); return false;">
							<div class="alert alert-danger display-hide errorMsg">
								<button class="close" data-close="alert"></button>
								<span class=""></span>
							</div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="username" required/> </div>
                                <div class="col-xs-6">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="password" required/> </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="rem-password">
                                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" id="remember" name="remember" value="1"  /> Remember me
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-8 text-right">
                                    <div class="forgot-password">
                                        <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                                    </div>
                                    <button type="submit" class="btn green">Sign In</a>
                                </div>
                            </div>
                        </form>
                        <!-- BEGIN FORGOT PASSWORD FORM -->
						<form class="forget-form" method="post" id="resetForm" name="resetForm" onSubmit="resetViaEmail(); return false;">
                            <h3 class="font-green">Forgot Password ?</h3>
                            <p> Enter your e-mail address below to reset your password. </p>
                            <div class="form-group">
                                <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="reset_email" /> </div>
							<div class="form-group errorMsg" style="color:red"></div>
                            <div class="form-actions">
                                <button type="button" id="back-btn" class="btn green btn-outline">Back</button>
                                <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                            </div>
                        </form>
                        <!-- END FORGOT PASSWORD FORM -->
                    </div>
        <!-- END : LOGIN PAGE 5-1 -->
