<!--************************* HEAD <Start> ************************* -->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Raera" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title><?php echo WEBSITE_NAME; ?></title>
<link rel="shortcut icon" href="<?php echo FRONTEND_ASSET_IMAGES_DIR; ?>omt-favicon.png"/>
<link rel="icon" type="image/png" href="<?php echo FRONTEND_ASSET_IMAGES_DIR; ?>omt-favicon.png" />
<?php
	//CSS FILES
	$bootstrap = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'bootstrap.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($bootstrap);
	$bootstrap_theme = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'bootstrap-theme.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($bootstrap_theme);
	$bootstrap_switch = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'bootstrap-switch.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($bootstrap_switch);
	$bootstrap_datepicker = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'bootstrap-datepicker.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($bootstrap_datepicker);
	$select2 = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'select2.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($select2);
	$font_awesome = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'font-awesome.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($font_awesome);
	$animate = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'animate.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($animate);
	$slider = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'slider.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($slider);
	$fullcalendar = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'fullcalendar.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($fullcalendar);
/*	$fullcalendar_print = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'fullcalendar.print.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($fullcalendar_print);*/
	$jquery_ui = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'jquery-ui.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($jquery_ui);
	$datatables = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'jquery.dataTables.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($datatables);
	$star_rating = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'star-rating.min.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($star_rating);
	$style = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'style.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($style);
	$magnific_popup = array(
			  'href' => ASSET_CSS_FRONTEND_DIR.'magnific-popup.css',
			  'rel' => 'stylesheet',
			  'type' => 'text/css'
	);
	echo link_tag($magnific_popup);
?>
<!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">--><!-- Facebook Pixel Code --><script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init', '128898101040871'); /* Insert your pixel ID here.*/fbq('track', 'PageView');</script><noscript><img height="1" width="1" style="display:none"src="https://www.facebook.com/tr?id=128898101040871&ev=PageView&noscript=1"/></noscript><!-- DO NOT MODIFY --><!-- End Facebook Pixel Code -->

<!--************************* HEAD <End> ************************* -->
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>moment.min.js"></script> <!-- moment.min -->
<script type="text/javascript" src="<?php echo ASSET_JS_FRONTEND_DIR;?>jquery-2.1.4.min.js"></script> <!-- jquery -->

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '164072350903917');
  fbq('track', 'PageView');
  fbq('track', 'Search');
  fbq('track', 'ViewContent');


</script>
<script type="text/javascript" src="//platform.linkedin.com/in.js">
    api_key: 86oy561zel9mau
    authorize: true
    onLoad: onLinkedInLoad 
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=164072350903917&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
