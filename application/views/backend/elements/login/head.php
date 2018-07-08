<!--************************* HEAD <Start> ************************* -->
<meta charset="utf-8" />
<title><?php echo WEBSITE_NAME; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="Open Mind Tutors"
	name="description" />
<meta content="" name="author" />
<link rel="shortcut icon" href="<?php echo ASSET_IMAGES_BACKEND_DIR; ?>favicon.ico"/>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
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
	$select2 = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'select2.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($select2);
	$select2_bootstrap = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'select2-bootstrap.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($select2_bootstrap);
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
	$login_4 = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'login-5.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($login_4);
	$star_rating = array(
			  'href' => ASSET_CSS_BACKEND_DIR.'star-rating.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($star_rating);
?>
<!--************************* HEAD <End> ************************* -->
