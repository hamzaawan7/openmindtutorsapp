<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
            Create Admin
            <a class="btn green pull-right" href="<?php echo BACKEND_ADMINS_URL; ?>">Admins</a>
        </h1>

        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-body">
                        <form class="sec" action="<?= BACKEND_ADMIN_ADD_REQUEST; ?>" method="post" name="addAdmin" id="addAdminForm">
                            <div class="form-group has-feedback">
                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" required>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                    <input type="password" name="password" id="password" class="form-control password_show" placeholder="Password" required>
                                    <span class="input-group-addon password-eye password_show_button"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-blue"><i class="fa fa-unlock-alt" aria-hidden="true"></i>CREATE ADMIN</button>
                        </form>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
