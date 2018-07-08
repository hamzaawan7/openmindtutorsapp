<!DOCTYPE html>
<html lang="en">
<!--
Project Name: Open Mind Tutors
Project URI: 
Description: 
Author: Shahan AHmed
Author URI: 
Version: 1.0
Created: April 17, 2017
Last Modified: 
-->
	<head>
		<?php $this->load->view('backend/elements/login/head'); ?>
	</head>
	<body class="login">
		<?php echo (isset($body_content))?$body_content:''; ?>
		<?php $this->load->view('backend/elements/login/footer'); ?>
		<?php 
		//This line of code will enable js functions to call CI's XAJAX functions
		echo ( isset($this->xajax_js) )?$this->xajax_js:''; 
		?>
	</body>
</html>
