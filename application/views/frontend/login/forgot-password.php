<main>
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="half-content log-in-2-half forgot-password-half">
          <div class="text">
            <h4 class="style-2">CONTINUE YOUR<br/>
              TRAINING BY REGISTERING</h4>
            Our pioneer education system has been designed<br>
            for your training to be successful. </div>
        </div>
      </div>
      <div class="col-sm-6"> 
        <!-- Form Area
======================================== -->
        <div class="into-box log-in-2">
          <div class="content">
            <form method="post" id="resetForm" name="resetForm" onsubmit="resetViaEmail(); return false;">
              <div class="form-group has-feedback">
              <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="reset_email" id="reset_email" placeholder="Your email">
              </div>
            </div>
			<div class="form-group errorMsg" style="color:red">
			</div>
              <button type="submit" class="btn btn-blue"><i class="fa fa-unlock-alt" aria-hidden="true"></i>RESET PASSWORD</button>
            </form>
            <a class="link-style-02" href="<?php echo ROUTE_LOGIN ?>"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i>BACK TO SIGN IN</a>
        </div>
        <!-- form area end --> 
      </div>
    </div>
  </div>
</main>
