<main>
  <div class="container register-login-section">
    <div class="row">
      <div class="col-sm-6">
        <div class="half-content register-2-half text-on-img-main">
          <div class="text-on-img">
            <div class="text-on-img-logo">
              <img src="../assets/frontend/images/omt-logo-img.png" alt="omt">
            </div>
            <div class="text-on-img-cont">
              <h1>Sign Up</h1>
              <p>Become a part of our community</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6"> 
        <!-- Form Area
======================================== -->
        <div class="into-box register-2">
			<div class="content"> <a class="btn btn-facebook" href="javascript:void(0);" onClick="loginByFacebook();"><i class="fa fa-facebook" aria-hidden="true"></i>SIGN UP WITH FACEBOOK</a> <!--<a class="btn btn-twitter" href=""><i class="fa fa-twitter" aria-hidden="true"></i>SIGN IN WITH TWITTER</a>-->
            <div class="divider"><span>or</span></div>
		<form class="sec" method="post" name="registerForm" id="registerForm" onsubmit="registerByEmail(); return false;">

            <div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
				<input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name">
              </div>
            </div>

			<div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
              </div>
            </div>


            <div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="email" id="email" placeholder="Your Email">
              </div>
            </div>
              <div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone e.g (+44xxxxxxxxxx)">
              </div>
            </div>


            <div class="form-group has-feedback select-dropdown-webkit">
				<label style="
					font-family: 'Raleway', sans-serif;
					font-weight: 600;
					color: #959595;
				">Do you want to register to the website as a student or a tutor?</label>
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
              	<select class="form-control" name="role" id="role">
                	<option value="0">-- Select --</option>
                    <option value="<?php echo TUTOR ?>">Tutor</option>
                    <option value="<?php echo STUDENT ?>">Student</option>
                </select>
              </div>
            </div>
            <div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" name="password" id="password" class="form-control password_show" placeholder="Password">
                <span class="input-group-addon password-eye password_show_button"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
              </div>
            </div>
            <div class="form-group has-feedback" id="msg">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                <input type="password" name="password1" id="password1" class="form-control password_show" placeholder="Confirm Password">
                <span class="input-group-addon password-eye password_show_button"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
              </div>
            </div>
			<div class="form-group has-feedback checkbox-field">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="agree_terms" value="">
						<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
						I agree with the <a href="<?php echo ROUTE_TERMS_AND_CONDITIONS ?>">Terms & Conditions</a> & <a href="<?php echo ROUTE_PRIVACY_POLICY ?>">Privacy Policy</a>.
					</label>
				</div>
			</div>
			<div class="form-group errorMsg" style="color:red"><?php echo (isset($_GET['verify_url']) && !empty($_GET['verify_url']))? $_GET['verify_url']:''; ?>
			</div>
            <button type="submit" class="btn btn-blue"><i class="fa fa-unlock-alt" aria-hidden="true"></i>CREATE AN ACCOUNT</button>
          </form>
          <a class="link-style-02" href="<?php echo ROUTE_LOGIN ?>"><i class="fa fa-question-circle" aria-hidden="true"></i>ALREADY HAVE AN ACCOUNT?</a>
        </div>
        <!-- form area end --> 
      </div>
    </div>
  </div>
</main>
<?php if(isset($_GET['verify_url']) && !empty($_GET['verify_url'])){ ?>
	
	<!-- Google Code for Lead Conversion Page -->
	<script type="text/javascript">
	/* <![CDATA[ */
		var google_conversion_id = 845368476;
		var google_conversion_language = "en";
		var google_conversion_format = "3";
		var google_conversion_color = "ffffff";
		var google_conversion_label = "p4CrCL-G93UQnJmNkwM";
		var google_conversion_value = 15.00;
		var google_conversion_currency = "GBP";
		var google_remarketing_only = false;
	/* ]]> */
	</script>
	<script type="text/javascript" src="//https://l.facebook.com/l.php?u=http%3A%2F%2Fwww.googleadservices.com%2Fpagead%2Fconversion.js&h=ATPZp8czTJsc5i_7tczWUT8VXsbSHA9olMXJqjBSBFjaXBpc8DLlnKPYjgpkov9_yE1RTvPWfDxIfFYwF0HhEHcqbJPwMYIQwBCpjRHQdzKN8TVtYKNVtnE6agQOvncTggenRmILG43Xnaun">
	</script>
	<noscript>
		<div style="display:inline;">
			<img height="1" width="1" style="border-style:none;" alt="" src="//https://l.facebook.com/l.php?u=http%3A%2F%2Fwww.googleadservices.com%2Fpagead%2Fconversion%2F845368476%2F%3Fvalue%3D15.00%26amp%253Bcurrency_code%3DGBP%26amp%253Blabel%3Dp4CrCL-G93UQnJmNkwM%26amp%253Bguid%3DON%26amp%253Bscript%3D0%2522%252F&h=ATPZp8czTJsc5i_7tczWUT8VXsbSHA9olMXJqjBSBFjaXBpc8DLlnKPYjgpkov9_yE1RTvPWfDxIfFYwF0HhEHcqbJPwMYIQwBCpjRHQdzKN8TVtYKNVtnE6agQOvncTggenRmILG43Xnaun" >
		</div>
	</noscript>

<?php } ?>
