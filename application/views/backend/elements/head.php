<!--************************* HEAD <Start> ************************* -->
<meta charset="utf-8" />
<title><?php echo WEBSITE_NAME; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="#1 selling multi-purpose bootstrap admin theme sold in themeforest marketplace packed with angularjs, material design, rtl support with over thausands of templates and ui elements and plugins to power any type of web applications including saas and admin dashboards. Preview page of Theme #2 for Portfolio 1 - Basic Grid"
	name="description" />
<meta content="" name="author" />
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<link rel="shortcut icon" href="<?php echo ASSET_IMAGES_BACKEND_DIR; ?>omt-favicon.png"/>
<link type="text/css" rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css">

<?php
	//CSS FILES
	
	$font_awesome = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'plugin/font-awesome/css/font-awesome.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($font_awesome);
	$simple_line_icon = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'plugin/simple-line-icons/simple-line-icons.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($simple_line_icon);
	$bootstrap = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'bootstrap.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($bootstrap);
	$bootstrap_switch = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'bootstrap-switch.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($bootstrap_switch);
	$datatable = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'plugin/datatables/datatables.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($datatable);
	$datatable_bootstrap = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'plugin/datatables/plugins/bootstrap/datatables.bootstrap.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($datatable_bootstrap);
	$bootstrap_fileinput = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'bootstrap-fileinput.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($bootstrap_fileinput);
	$bootstrap_datepicker = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'bootstrap-datepicker3.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($bootstrap_datepicker);
	$component = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'components.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css',
			  'id' => 'style_components'
	);
	echo link_tag($component);
	$plugins = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'plugins.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($plugins);
	$profile = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'profile.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($profile);
	$profile_2 = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'profile-2.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($profile_2);
	$layout = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'layout.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($layout);
	$darkblue = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'darkblue.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($darkblue);
	$star_rating = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'star-rating.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($star_rating);
	$custom = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'custom.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($custom);
?>

<!--************************* HEAD <End> ************************* -->
