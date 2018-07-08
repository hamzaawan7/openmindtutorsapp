<main>
    
    <div class="container register-login-section">
        <div class="row">
            <div class="col-sm-6">
                <div class="half-content log-in-2-half">
                    <div class="text">
                        <h4 class="style-2">SIGN IN TO<br/>
                            ACCESS YOUR PROFILE</h4>
                        Effortlessly manage your lessons through the portal.
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!-- Form Area

        ======================================== -->

                <div class="into-box log-in-2">
                    <div class="content"><a class="btn btn-facebook" href="javascript:void(0);"
                                            onClick="loginByFacebook();"><i class="fa fa-facebook" aria-hidden="true"></i>SIGN IN WITH FACEBOOK</a>

<!--                        <div class="divider"><span>or</span></div>-->
<!--                        <div class="content">-->
<!--                            <a class="btn btn-facebook" href="javascript:void(0);" onClick="onLinkedInLoad();">-->
<!--                                <script type="in/Login"></script>-->
<!--                            </a>-->

                       <!--  <div class="divider"><span>or</span></div>
                        <div class="content"><a class="btn btn-facebook" style="border: 5px"><script type="in/Login"></script></a> -->
                      

                           <!--  <div class="content"><a class="btn btn-facebook" href="javascript:void(0);"
                                            onClick="lonLinkedInLoad();"><i class="fa fa-linkedin"
                                                                            aria-hidden="true"></i>SIGN IN WITH LinkedIn</a> -->
                            <div class="divider"><span>or</span></div>
                            <form method="post" name="loginForm" id="loginForm"
                                  onsubmit="loginByEmail(); return false;">
                                <div class="form-group has-feedback">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"
                                                                                                aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" name="email" id="email"
                                               placeholder="Your Email">
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"
                                                                                                aria-hidden="true"></i></span>
                                        <input type="password" name="password" id="password"
                                               class="form-control password_show" placeholder="Password">
                                        <span class="input-group-addon password-eye password_show_button"><i
                                                    class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <input type="checkbox" id="remember" name="remember" value="1" style="display:none">
                                <div class="form-group errorMsg" style="color:red">
                                </div>
                                <button type="submit" class="btn btn-blue"><i class="fa fa-unlock-alt"
                                                                              aria-hidden="true"></i>SIGN IN
                                </button>
                                <a href="<?php echo ROUTE_REGISTER ?>" class="btn btn-grey-border"><i
                                            class="fa fa-user-plus" aria-hidden="true"></i>CREATE AN ACCOUNT</a>
                            </form>
                            <a class="link-style-02" href="<?php echo ROUTE_FORGOT_PASSWORD ?>">FORGOT PASSWORD?</a>
                        </div>
                    </div>
                    <!-- form area end -->
                </div>
            </div>
        </div>
</main>
