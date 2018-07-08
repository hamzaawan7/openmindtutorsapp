				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> My Profile
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN PROFILE SIDEBAR -->
                                <div class="profile-sidebar">
                                    <!-- PORTLET MAIN -->
                                    <div class="portlet light profile-sidebar-portlet ">
                                        <!-- SIDEBAR USERPIC -->
                                        <div class="profile-userpic">
                                            <img src="<?php echo ($common_data['user_data']['image'] == '')?ASSET_IMAGES_BACKEND_DIR.'profile-pic.jpg':ASSET_UPLOADS_BACKEND_DIR.'profile/'.$common_data['user_data']['image'] ?>" class="img-responsive" alt=""> </div>
                                        <!-- END SIDEBAR USERPIC -->
                                        <!-- SIDEBAR USER TITLE -->
                                        <div class="profile-usertitle">
                                            <div class="profile-usertitle-name"> <?php echo ucwords($common_data['user_data']['first_name'].' '.$common_data['user_data']['last_name']) ?> </div>
                                            <!--<div class="profile-usertitle-job"> CEO </div>-->
                                        </div>
                                        <!-- END SIDEBAR USER TITLE -->
                                    </div>
                                    <!-- END PORTLET MAIN -->
                                </div>
                                <!-- END BEGIN PROFILE SIDEBAR -->
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-title tabbable-line">
                                                    <div class="caption caption-md">
                                                        <i class="icon-globe theme-font hide"></i>
                                                        <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                    </div>
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active" id="tab_1_1">
                                                            <form method="post" id="editProfileForm" name="editProfileForm" onSubmit="editProfile(); return false;" >
                                                                <div class="form-group">
                                                                    <label class="control-label">First Name</label>
                                                                    <input type="text" placeholder="Fatteh" class="form-control" name="first_name" value="<?php echo $common_data['user_data']['first_name'] ?>" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Last Name</label>
                                                                    <input type="text" placeholder="Haider" class="form-control" name="last_name" value="<?php echo $common_data['user_data']['last_name'] ?>" /> </div>
																<div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="text" placeholder="info@openmindtutors.com" name="email" class="form-control" value="<?php echo $common_data['user_data']['email'] ?>" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Mobile Number</label>
                                                                    <input type="text" placeholder="+44 *** *** ***" name="phone" class="form-control" value="<?php echo $common_data['user_data']['phone'] ?>" /> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">About</label>
                                                                    <textarea class="form-control" rows="3" placeholder="We are Open Mind Tutors" name="description"><?php echo $common_data['user_data']['description'] ?></textarea>
                                                                </div>
																<div class="form-group errorMsg" style="color:red"></div>
                                                                <div class="margiv-top-10">
                                                                    <button type="submit" class="btn green"> Save Changes </button>
                                                                    <a href="<?php echo BACKEND_LESSONS_REQUESTS_URL ?>" class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PERSONAL INFO TAB -->
                                                        <!-- CHANGE AVATAR TAB -->
                                                        <div class="tab-pane" id="tab_1_2">
                                                            <form method="post" id="editPicForm" name="editPicForm" onSubmit="editPic(<?php echo $common_data['user_id'] ?>); return false;" >
                                                                <div class="form-group">
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                            <img src="<?php echo ASSET_IMAGES_BACKEND_DIR ?>profile-pic.png" alt="" class="image" /> </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                        <div>
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> Select image </span>
                                                                                <span class="fileinput-exists"> Change </span>
                                                                                <input type="file" name="imgInp1" id="imgInp1"> </span>
                                                                            <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="clearfix margin-top-10">
                                                                        <span class="label label-danger" style="margin-right: 10px;">NOTE! </span>
                                                                        <span>Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                                                    </div>
                                                                </div>
																<div class="form-group errorMsg" style="color:red"></div>
                                                                <div class="margin-top-10">
                                                                    <button type="submit" class="btn green"> Save Changes </button>
                                                                    <a href="<?php echo BACKEND_LESSONS_REQUESTS_URL ?>" class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE AVATAR TAB -->
                                                        <!-- CHANGE PASSWORD TAB -->
                                                        <div class="tab-pane" id="tab_1_3">
                                                            <form method="post" id="changePasswordForm" name="chnagePasswordForm" onSubmit="changePassword(); return false;" >
                                                                <div class="form-group">
                                                                    <label class="control-label">Current Password</label>
                                                                    <input type="password" class="form-control" name="password" id=""/> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">New Password</label>
                                                                    <input type="password" class="form-control" name="newPassword" id=""/> </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Re-type New Password</label>
                                                                    <input type="password" class="form-control" name="newPassword1" id=""/> </div>
																<div class="form-group errorMsg" style="color:red"></div>
                                                                <div class="margin-top-10">
                                                                    <button type="submit" class="btn green"> Change Password </button>
                                                                    <a href="<?php echo BACKEND_LESSONS_REQUESTS_URL ?>" class="btn default"> Cancel </a>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END CHANGE PASSWORD TAB -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END PROFILE CONTENT -->
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
