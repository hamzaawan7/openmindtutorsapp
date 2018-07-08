<!DOCTYPE html>
<html lang="en">
<!--
Project Name: Open Mind Tutor
Project URI: 
Description: 
Author: Shahan Ahmed
Author URI: (+92)343-4093114
Version: 1.0
Created: 
Last Modified: 
-->
	<head>
		<?php $this->load->view('frontend/elements/head'); ?>
	</head>
	<body class="<?php echo (isset($page))? $page:""; ?>">
  <?php $this->load->view('frontend/elements/header'); ?>
		<?php echo (isset($body_content))?$body_content:''; ?>
		 <?php echo (isset($modal))?$modal:''; ?>
        <?php $this->load->view('frontend/elements/footer'); ?>
        <!-- Start of HubSpot Embed Code -->
        <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/4403447.js"></script>
        <!-- End of HubSpot Embed Code -->
	</body>
</html>
