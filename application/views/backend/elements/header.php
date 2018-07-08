<div class="page-wrapper">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="#">
                    <img src="<?php echo ASSET_IMAGES_BACKEND_DIR ?>omt-logo.png" alt="logo" class="logo-default"/> </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            <img alt="" class="img-circle"
                                 src="<?php echo ($common_data['user_data']['image'] == '') ? ASSET_IMAGES_BACKEND_DIR . 'profile-pic.jpg' : ASSET_UPLOADS_BACKEND_DIR . 'profile/' . $common_data['user_data']['image'] ?>"/>
                            <span class="username username-hide-on-mobile"> <?php echo ucwords($common_data['user_data']['first_name'] . ' ' . $common_data['user_data']['last_name']) ?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?php echo BACKEND_PROFILE_URL ?>">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" onclick="logout();">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
                    data-slide-speed="200" style="padding-top: 20px">
                    <li class="nav-item <?php echo (isset($page) && $page == "lessons") ? "sidebar-active-menu" : ""; ?>">
                        <a href="<?php echo BACKEND_LESSONS_REQUESTS_URL ?>" class="nav-link">
                            <i class="fa fa-book" aria-hidden="true"></i>
                            <span class="title">Lessons</span>
                            <?php if (isset($common_data['lessons_count']['total_lessons']) && $common_data['lessons_count']['total_lessons'] != 0) { ?>
                                <span class="badge badge-danger badge-main-bar"><?php echo $common_data['lessons_count']['total_lessons'] ?></span>
                            <?php } ?>
                        </a>
                    </li>
                    <li class="nav-item <?php echo (isset($moduleName) && $moduleName == "Users") ? "open" : ""; ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-user"></i>
                            <span class="title">Users</span>
                            <?php if (isset($common_data['users_count']['total_users']) && $common_data['users_count']['total_users'] != 0) { ?>
                                <span class="badge badge-danger badge-main-bar"><?php echo $common_data['users_count']['total_users'] ?></span>
                            <?php } ?>
                            <span class="arrow <?php echo (isset($moduleName) && $moduleName == "Users") ? "open" : ""; ?>"></span>
                        </a>
                        <ul class="sub-menu" <?php echo (isset($moduleName) && $moduleName == "Users") ? "style='display:block'" : ""; ?>>
                            <li class="nav-item <?php echo (isset($page) && $page == "students") ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_STUDENTS_URL ?>" class="nav-link ">
                                    <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                                    <span class="title">Students</span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo (isset($page) && $page == "tutors") ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_TUTORS_URL ?>" class="nav-link ">
                                    <i class="fa fa-university" aria-hidden="true"></i>
                                    <span class="title">Tutors</span>
                                    <?php if (isset($common_data['users_count']['total_users']) && $common_data['users_count']['total_users'] != 0) { ?>
                                        <span class="badge badge-danger badge-main-bar"><?php echo $common_data['users_count']['total_users'] ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                            <?php
                            $user = $this->session->all_userdata();
                            if ($user['open-mind-tutors-backend-id'] == 1) {
                                ?>
                                <li class="nav-item <?php echo (isset($page) && $page == "admins") ? "sidebar-active-menu" : ""; ?>">
                                    <a href="<?php echo BACKEND_ADMINS_URL ?>" class="nav-link ">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        <span class="title">Admins</span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="nav-item <?php echo (isset($moduleName) && $moduleName == "Payments") ? "open" : ""; ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-credit-card"></i>
                            <span class="title">Payments</span>
                            <?php if (isset($common_data['pending_payments']) && count($common_data['pending_payments']) != 0) { ?>
                                <span class="badge badge-danger badge-main-bar"><?php echo count($common_data['pending_payments']) ?></span>
                            <?php } ?>
                            <span class="arrow <?php echo (isset($moduleName) && $moduleName == "Payments") ? "open" : ""; ?>"></span>
                        </a>
                        <ul class="sub-menu" <?php echo (isset($moduleName) && $moduleName == "Payments") ? "style='display:block'" : ""; ?>>
                            <li class="nav-item <?php echo (isset($page) && $page == "student-payments") ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_STUDENTS_PAYMENTS_URL ?>" class="nav-link ">
                                    <i class="icon-credit-card"></i>
                                    <span class="title">Students <i class="fa fa-arrow-right" aria-hidden="true"></i> OMT</span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo (isset($page) && $page == "admin-payments") ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_ADMIN_PAYMENTS_URL ?>" class="nav-link ">
                                    <i class="icon-credit-card"></i>
                                    <span class="title">OMT <i class="fa fa-arrow-right" aria-hidden="true"></i> Tutors</span>
                                    <?php if (isset($common_data['pending_payments']) && count($common_data['pending_payments']) != 0) { ?>
                                        <span class="badge badge-danger badge-main-bar"><?php echo count($common_data['pending_payments']) ?></span>
                                    <?php } ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?php echo (isset($page) && $page == "reviews") ? "sidebar-active-menu" : ""; ?>">
                        <a href="<?php echo BACKEND_REVIEWS_URL ?>" class="nav-link">
                            <i class="icon-star"></i>
                            <span class="title">Reviews</span>
                            <?php if (isset($common_data['reviews_count']['total_reviews']) && $common_data['reviews_count']['total_reviews'] != 0) { ?>
                                <span class="badge badge-danger badge-main-bar"><?php echo $common_data['reviews_count']['total_reviews'] ?></span>
                            <?php } ?>
                        </a>
                    </li>
                    <li class="nav-item <?php echo (isset($moduleName) && $moduleName == "Pages") ? "open" : ""; ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-layers"></i>
                            <span class="title">Pages</span>
                            <span class="arrow <?php echo (isset($moduleName) && $moduleName == "Pages") ? "open" : ""; ?>"></span>
                        </a>
                        <ul class="sub-menu" <?php echo (isset($moduleName) && $moduleName == "Pages") ? "style='display:block'" : ""; ?>>
                            <li class="nav-item <?php echo (isset($page) && $page == TERMS_CONDITIONS_ID) ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_PAGES_URL . '/' . TERMS_CONDITIONS_ID ?>" class="nav-link ">
                                    <i class="icon-layers"></i>
                                    <span class="title">Terms & Conditions</span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo (isset($page) && $page == PRIVACY_POLICY_ID) ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_PAGES_URL . '/' . PRIVACY_POLICY_ID ?>" class="nav-link ">
                                    <i class="icon-layers"></i>
                                    <span class="title">Privacy Policy</span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo (isset($page) && $page == HOW_WORKS_TUTOR_ID) ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_PAGES_URL . '/' . HOW_WORKS_TUTOR_ID ?>" class="nav-link ">
                                    <i class="icon-layers"></i>
                                    <span class="title">How It Works</span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo (isset($page) && $page == TUTOR_FAQS_ID) ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_FAQ_PAGES_URL . '/' . TUTOR_FAQS_ID ?>" class="nav-link ">
                                    <i class="icon-layers"></i>
                                    <span class="title">Tutor FAQs</span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo (isset($page) && $page == STUDENT_FAQS_ID) ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_FAQ_PAGES_URL . '/' . STUDENT_FAQS_ID ?>" class="nav-link ">
                                    <i class="icon-layers"></i>
                                    <span class="title">Student FAQs</span>
                                </a>
                            </li>
                            <li class="nav-item <?php echo (isset($page) && $page == BECOME_TUTOR_ID) ? "sidebar-active-menu" : ""; ?>">
                                <a href="<?php echo BACKEND_FAQ_PAGES_URL . '/' . BECOME_TUTOR_ID ?>" class="nav-link ">
                                    <i class="icon-layers"></i>
                                    <span class="title">Become A Tutor</span>
                                </a>
                            </li>
                            <!--<li class="nav-item <?php echo (isset($page) && $page == HOW_WORKS_STUDENT_ID) ? "sidebar-active-menu" : ""; ?>">
                                        <a href="<?php echo BACKEND_FAQ_PAGES_URL . '/' . HOW_WORKS_STUDENT_ID ?>" class="nav-link ">
											<i class="icon-layers"></i>
                                            <span class="title">How It Works (Student)</span>
                                        </a>
                                    </li>-->
                        </ul>
                    </li>
                    <li class="nav-item <?php echo (isset($page) && $page == "settings") ? "sidebar-active-menu" : ""; ?>">
                        <a href="<?php echo BACKEND_SETTINGS_URL ?>" class="nav-link">
                            <i class="icon-settings"></i>
                            <span class="title">Settings</span>
                        </a>
                    </li>
                    <li class="switcher-li"><input type="checkbox"
                                                   id="settings-live" <?php echo (isset($common_data['site_status']) && $common_data['site_status'] == ACTIVE_STATUS_ID) ? "checked" : ""; ?>
                                                   data-off-color="danger" data-on-text="&nbsp;Online&nbsp;"
                                                   data-off-text="&nbsp;Offilne&nbsp;" data-backdrop="static"
                                                   data-keyboard="false">
                        <p class="help-text-switch">Website
                            is <?php echo (isset($common_data['site_status']) && $common_data['site_status'] == ACTIVE_STATUS_ID) ? "online" : "offline"; ?>
                            now</p>
                    </li>

                    <li class="switcher-li switcher-li-small">
                        <label class="switch_small_menu">
                            <input type="checkbox"
                                   id="change_site_status" <?php echo (isset($common_data['site_status']) && $common_data['site_status'] == ACTIVE_STATUS_ID) ? "checked" : ""; ?>
                                   onchange="change_site_status()">
                            <div class="slider_small_menu <?php echo (isset($common_data['site_status']) && $common_data['site_status'] == ACTIVE_STATUS_ID) ? "" : "slider_small_menu_active"; ?>"></div>
                        </label>
                    </li>
                </ul>
                <!-- END SIDEBAR MENU -->
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
