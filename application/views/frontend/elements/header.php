<!--************************* HEADER <Start> ************************* -->
<!-- Top Navigation <Start> -->
<header class="style-1"> 
  <!-- Header top
======================================== -->
  <div class="top">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 hidden-xs">
          <ul>
            <!--<li><i class="fa fa-phone"></i>001 112 23 344</li>-->
            <li><i class="fa fa-envelope-o"></i><a href="mailto:info@openmindtutors.co.uk">info@openmindtutors.co.uk</a></li>
          </ul>
        </div>		<div class="col-sm-4 social-media-main">          <div class="social-media"> 			  <a href="https://facebook.com/openmindtutors" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a> 			  <a href="https://twitter.com/openmindtutors" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>			  <a href="https://www.instagram.com/openmindtutors/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a> 		  </div>        </div>
        <div class="col-sm-5 profile-menu">
		<?php if(!isset($common_data['user_id'])){ ?>
          <ul class="text-right">
            <li><a href="<?php echo ROUTE_REGISTER; ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> Sign Up</a></li>
            <li><a href="<?php echo ROUTE_LOGIN; ?>"><i class="fa fa-sign-in" aria-hidden="true"></i> Sign In</a></li>
          </ul>
		<?php } else { ?>
          <ul class="text-right" data-hover="dropdown" data-animations="fadeInUp">
            <li class="dropdown top-dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo ($common_data['user_data']['image'] == '')?FRONTEND_ASSET_IMAGES_DIR.'profile-pic.jpg':ASSET_UPLOADS_FRONTEND_DIR.'profile/'.$common_data['user_data']['image'] ?>" class="img-circle" /> <?php echo ucwords($common_data['user_data']['first_name'].' '.$common_data['user_data']['last_name']) ?> <?php echo (isset($common_data['message_count']) && count($common_data['message_count']) != 0)? '<span class="badge badge-danger badge-main-bar">'.count($common_data['message_count']).'</span>':""; ?> <span class="caret"></span></a>
				<ul class="dropdown-menu boxed">
                  <li><a href="<?php echo ROUTE_LESSONS ?>">Dashboard <?php echo (isset($common_data['message_count']) && count($common_data['message_count']) != 0)? '<span class="badge badge-danger badge-main-bar">'.count($common_data['message_count']).'</span>':""; ?></a></li>
                  <li><a href="<?php echo ROUTE_PROFILE ?>">Profile</a></li>
                  <li><a href="javascript:void(0)" onclick="logout();">Logout</a></li>
                </ul>
			</li>
          </ul>
		<?php } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- header top end --> 
  <!-- Header middle ( logo and menu )
======================================== -->
  <div class="middle">
    <div class="container">
      <div> 
        <!-- Extra components navbar -->
        <nav class="navbar navbar-default megamenu"> 
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand" href="<?php echo SERVER_URL ?>"><img alt="logo" src="<?php echo FRONTEND_ASSET_IMAGES_DIR ?>omt-logo.png"/></a> </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right" data-hover="dropdown" data-animations="fadeInUp">
				<li class="dropdown"><a href="<?php echo ROUTE_SEARCH ?>" class="dropdown-toggle" >BOOK A LESSON</a></li>
				<li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">QUICK SEARCH <span class="caret"></span></a>
				<ul class="dropdown-menu boxed location-dropdown">
                  <li>
                    <div class="form-group dropdown-form-group">
					  <form class="form-inline" method="post" name="quickSearchForm" id="quickSearchForm" onsubmit="searchQuick('quickSearchForm'); return false;">
                        <li><input type="text" class="form-control subject_autocomplete" placeholder="Type Subject"></li>
						<li><input type="text" class="form-control level_autocomplete" placeholder="Type Level"></li>
						<li><input type="text" class="form-control searchlocation" placeholder="Type Location"></li>
                        <li class="text-right"><button type="submit" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</button></li>
                      </form>
                    </div>
                  </li>
                </ul>
			  </li>
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BROWSE SUBJECTS <span class="caret"></span></a>
              	<!--<ul class="dropdown-menu fullmenu">
                  <li>
                    <div class="megamenu-content item-group">
                      <div class="row">
					  <?php /* $count = 1; foreach($mainSubjects as $subjects){
							if($count < 6){?>
                        <div class="col-sm-4">
                          <div class="item">
                            <ul>
                              <li><a href="<?php echo ROUTE_SEARCH."?main_subject=".$subjects['id'] ?>"><?php echo $subjects['name'] ?></a></li>
                              <li class="divider"></li>
                            </ul>
                          </div>
                        </div>
					  <?php } $count++;}  ?>
                        <div class="col-sm-4">
                          <div class="item">
                            <ul>
                              <li><a href="<?php echo ROUTE_BROWSE_SUBJECTS */ ?>">View More</a></li>
                              <li class="divider"></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>-->
				<ul class="dropdown-menu browse-subjects-dropdown">
                	<?php 
                  if(!empty($mainSubjects)){
                  foreach($mainSubjects as $subjects){ ?>
                    <li>
                        <a href="<?php echo ROUTE_SEARCH."?main_subject=".$subjects['id'] ?>"><?php echo $subjects['name'] ?></a>
                  	</li>
                    <?php } 
                  } ?>
                    <li><a href="<?php echo ROUTE_BROWSE_SUBJECTS ?>">View More</a></li>
              	</ul>
			  </li>
              <li class="dropdown"><a href="<?php echo ROUTE_BROWSE_AREAS ?>" class="dropdown-toggle" >BROWSE AREAS </a></li>
              <li class="dropdown"><a href="<?php echo ROUTE_HOW_IT_WORKS ?>" class="dropdown-toggle" >HOW IT WORKS</a></li>
              <li class="dropdown"><a href="<?php echo ROUTE_OUR_TEAM ?>" class="dropdown-toggle" >ABOUT US</a></li> 

            </ul>
          </div>
          <!-- /.navbar-collapse --> 
        </nav>
      </div>
    </div>
  </div>
<?php if(isset($page) && $page !="homepage"){ ?>
	<div class="page-header top-page-header-bar">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1><?php echo (isset($pageName))? $pageName:$moduleName; ?></h1>
				</div>
				<div class="col-sm-12">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo SERVER_URL ?>">HOME</a></li>
						<?php if (isset($pageName)){ ?>
						<li class="breadcrumb-item"><a href="<?php echo (isset($moduleURL))? $moduleURL:"javascript:void(0)"; ?>"><?php echo (isset($moduleName))? strtoupper($moduleName):""; ?></a></li>
						<li class="breadcrumb-item active"><?php echo (isset($pageName))? strtoupper($pageName):""; ?></li>
						<?php } else { ?>
						<li class="breadcrumb-item active"><?php echo (isset($moduleName))? strtoupper($moduleName):""; ?></li>
						<?php } ?>
					</ol>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
  </header>
  <!-- header middle end -->
<!--************************* HEADER <End> ************************* -->
<?php 
/* End of file header.php */
/* Location: ./application/views/frontend/elements/header.php */
?>