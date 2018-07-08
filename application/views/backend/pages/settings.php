				<!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> Settings
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN PROFILE CONTENT -->
                                <div class="profile-content">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light ">
                                                <div class="portlet-title tabbable-line">
                                                   
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#stripe-settings" data-toggle="tab">Email & Stripe</a>
                                                        </li>
														<li class="">
                                                            <a href="#tier-settings" data-toggle="tab">Tier Levels</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="tab-content">
                                                        <!-- PERSONAL INFO TAB -->
                                                        <div class="tab-pane active" id="stripe-settings">
                                                            <form method="post" id="editSettingsForm" name="editSettingsForm" onSubmit="editSettings(); return false;" >
                                                                <div class="form-group">
                                                                    <label class="control-label">Admin Email</label>
                                                                    <input type="text" placeholder="" class="form-control" name="contact_email" value="<?php echo $common_data['site_settings']['contact_email'] ?>" />
																</div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Stripe Publish Key</label>
                                                                    <input type="text" placeholder="" class="form-control" name="stripe_pub" value="<?php echo $common_data['site_settings']['stripe_pub'] ?>" />
																</div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Stripe Secret Key</label>
                                                                    <input type="text" placeholder="" class="form-control" name="stripe_secret" value="<?php echo $common_data['site_settings']['stripe_secret'] ?>" />
																</div>
																<div class="form-group errorMsg errorMsgSettings" style="color:red"></div>
                                                                <div class="margiv-top-10">
                                                                    <button type="submit" class="btn green"> Save Changes </button>
                                                                </div>
                                                            </form>
                                                        </div>
														<div class="tab-pane" id="tier-settings">
                                                            <form method="post" id="editTierSettings" name="editTierSettings" onSubmit="editTierConfig(); return false;" >
                                                                
																<div class="form-group">
																	<label class="control-label">DEFAULT TIER LEVEL ON SIGN UP</label>
																	<div class="col-md-12">
																		<div class="mt-radio-inline">
																		<?php foreach($tier_levels as $tier_level){ ?>
																			<label class="mt-radio">
																				<input name="default_tier" id="default_tier_<?php echo $tier_level['id']; ?>" value="<?php echo $tier_level['id']; ?>" <?php echo ($tier_level['is_default']==1 ? 'checked':''); ?> type="radio"> <?php echo $tier_level['title']; ?>
																				<span></span>
																			</label>
																		<?php } ?>
																		</div>
																	</div>
																</div>
																<div class="form-group">
                                                                    <label class="control-label">MAXIMUM RATES FOR TIER LEVELS (0 = Unlimited)</label>
                                                                   </div>
																<?php foreach($tier_levels as $tier_level){ ?>
                                                                <div class="form-group">
                                                                    <label class="control-label"><?php echo $tier_level['title']; ?> (in £)</label>
                                                                    <input type="text" placeholder="" class="form-control tier_rate" id="<?php echo $tier_level['id']; ?>" name="tier_rate_<?php echo $tier_level['id']; ?>" value="<?php echo $tier_level['max_charge']; ?>" />
																</div>
																<?php } ?>
																<div class="form-group errorMsg errorMsgTier" style="color:red"></div>
                                                                <div class="margiv-top-10">
                                                                    <button type="submit" class="btn green"> Save Changes </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <!-- END PERSONAL INFO TAB -->
                                                    </div>
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
