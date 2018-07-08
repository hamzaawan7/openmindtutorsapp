/*
Project Name: Open Mind Tutors
Project URI: 
Description:
Author: Shahan Ahmed
Author URI: (+92)343-4093114
Version: 1.0
Created: March, 2017
Last Modified: 
*/
var host = '';
if(window.location.host == 'localhost'){
    host = 'http://'+window.location.host+'/omt/ha_web_open-mind-tutors/code/beta/';
}else{
    host = 'https://'+window.location.host+'/';
}
var ROUTE_ADD_PAYMENT = host+'addPaymentsAjax';
/******************************************** Global <START> ***************************************************/
var PHONE_NUMBER_LENGTH = 10;
var PASSWORD_LENGTH = 10;
//AJAX FUNCTION VARIABLES <START>
var PARAM = {};
var FUNCTION_NAME  = '';
//AJAX FUNCTION VARIABLES <END>

/*
|--------------------------------------------------------------------------
| AJAX FUNCTIONS <Start>
|--------------------------------------------------------------------------
*/

/*--------------------------------------------------------------------------------------------------------------------------

FUNCTIONS LIST:
01: logoutAjax
--------------------------------------------------------------------------------------------------------------------------*/

/**
 * 01: logoutAjax
 *
 * This function is to logout admin.
 *
 */
	function logout(){
		xajax_logoutAjax();
	}
/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <End>
	|--------------------------------------------------------------------------
*/
/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
	01: Email validation
	02: Password validation
	03: Simple Password validation
	04: Number validation
	05: Custom designed alert
	06: successAlerts
	07: redirect
	08: isUrlValid
	09: Checkbox click
	10: file reader for survey page
	12: map
------------ Function List <End>-----------------*/	

	//01: Email validation
	function validateEmail(email) {
        	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        	return re.test(email);
	}
	/*############################################################*/
	
	//02: Password validation
	function validatePassword(password) {
			// Password should be a combination of small alphabets, capital alphabets, digits and special characters 
			var re = /(?=.*\d)(?=.*[a-z])(?=.*[!@#$&*])(?=.*[A-Z]).{10,}/;
        	return re.test(password);
	}
	/*############################################################*/
	
	//03: Simple Password validation
	function validateSimplePassword(password) {
		//Password should be atleast `PASSWORD_LENGTH` characters long
        	return password.length>=PASSWORD_LENGTH;
	}
	/*############################################################*/
	
	//04: Number validation
	function validateNumber(number){
		var re = /^\d+$/;
		return re.test(number);
	}
	function validateFloat(number){
		var re = /^(0|[1-9]\d*)(\.\d+)?$/;
		return re.test(number);
	}
	/*############################################################*/
	
	//05: Custom designed alert
	function custom_alert(message) {
	    var $this = $('.bb-alert');
	    $this.find('span').html(message);
	    $this.delay(200).fadeIn().delay(3000).fadeOut(); 
	}
	
	//06: successAlerts
	function successAlerts(msg,url) {
			bootbox.dialog({
				 message: msg,
				 className: "upload_modal",
				 buttons: {
				    success: {
					    label: "OK",
					    className: "btn-success",
					    callback: function() {
						window.location = url;
					    }
				    }
				 }
				});
	}
	/*############################################################*/

	//07: redirect
	function redirect(url) {
		window.location =url;
	}
	/*############################################################*/
	
	//08:isUrlValid
	function isUrlValid(url) {
  	  return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
	}

	/*############################################################*/

	//09: Checkbox click
	$("#all_checkbox").change(function(){  //"select all" change 
		var status = this.checked; // "select all" checked status
		$('.checkbox').each(function(){ //iterate all listed checkbox items
			this.checked = status; //change ".checkbox" checked status
		});
	});

	$('.checkbox').change(function(){ //".checkbox" change 
		//uncheck "select all", if one of the listed checkbox item is unchecked
		if(this.checked == false){ //if this item is unchecked
			$("#all_checkbox")[0].checked = false; //change "select all" checked status to false
		}
		
		//check "select all" if all checkbox items are checked
		if ($('.checkbox:checked').length == $('.checkbox').length ){ 
			$("#all_checkbox")[0].checked = true; //change "select all" checked status to true
		}
	});
	/*############################################################*/
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();
/*------------ Defined Functions <End> ------------*/

/*------------ Onload Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
	00: Date picker
	01: Custom dropdown
	02: Disable/Underdevelopment Feature message
	03: Show/Hide Password
	04: Adding pagination / sorting in backend tables
`	05: Upload Image
	06: PREVENT PARENT FUNCTION CALL ON CHILD CLICK
	07: ALWAYS USE ON() FOR DYNAMICALLY CREATED HTML
	08: Remove already selected category
	09: Remove already uploaded media
	10: Set cover image while uploading media
------------ Function List <End>-----------------*/	

	$(document).ready(function(){
		$( "#tutor_subject" ).select2({
			placeholder: "Subjects you wish to teach"
		});
		$( "#subject_level" ).select2({
			placeholder: "Levels"
		});
		$( "#student_subject" ).select2({
			placeholder: ""
		});
		$( "#student_area" ).select2({
			placeholder: "Select Area"
		});
		$( ".times_avaiable" ).select2({
			placeholder: "Times Avaiable"
		});
		 $('body').on('DOMNodeInserted', '.times_avaiable', function () {
				$(this).select2({
			placeholder: "Times Avaiable"
		});
			});
		// tabs
			$("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
				e.preventDefault();
				$(this).siblings('a.active').removeClass("active");
				$(this).addClass("active");
				var index = $(this).index();
				$("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
				$("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
			});		
		// tabs
		$("#input-id").rating({showClear: true});
		$("#input-1").rating({displayOnly: true});
		$('.tutor_detail_rating').rating({displayOnly: true});
		$('#add-review').rating({showClear: false,step: 0.5});
		$('.input-2').rating({step: 0.5});
		//00: Date picker
		$('#datepicker').datepicker({
			changeMonth: true,
				changeYear: true,
				yearRange: "1:c+10",
			});			
		/*$('#datepicker1').datepicker({
			changeMonth: true,
				changeYear: true,
				yearRange: "1:c+10",
			});		*/
		/*$('ul.nav li.dropdown').hover(function() {
		  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
		}, function() {
		  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
		});*/
		//01: Custom dropdown
			$(".custom-select").each(function(){
				$(this).wrap("<span class='select-wrapper'></span>");
				$(this).after("<span class='holder'></span>");
			});
		/*############################################################*/
		
		//02: Disable/Underdevelopment Feature message
		$('.disable_feature').click(function(){
			custom_alert(' This feature is under development.');
		});
		/*############################################################*/	
		
		//03: Show/Hide Password
		$('.see_characters').change(function() {
			if (this.checked) {
				
			    $(this).closest('form').find("input[name=password]").get(0).type = 'text';
			} else {
			    $(this).closest('form').find("input[name=password]").get(0).type = 'password';
			}
		});
		/*############################################################*/	
		
		//04: Adding pagination / sorting in backend tables
//		$('#stream_table').DataTable();
		/*############################################################*/	
		
		//05: Upload Image
   		$('#imgInp1').change( function(e) {
        	var img = URL.createObjectURL(e.target.files[0]);
        	$('.image').attr('src', img);display: none;
    	});
   		$('#imgInp2').change( function(e) {
        	var img = URL.createObjectURL(e.target.files[0]);
			var files=e.target.files;

			var mimeType=files[0].type;
			if(mimeType == "image/jpeg" || mimeType == "image/png" || mimeType == "image/jpg" || mimeType == "image/gif"){
				$('#image-error').text('Click save button to upload the image');
				$('#profile_image').val(e.target.files[0].name);
				$('.image').attr('src', img);display: none;
			} else {
				$('#image-error').text('This image type is not allowed. Allowed types: jpg,png,jpeg');
			}
    	});
   		$('#infoInp').change( function(e) {
        	var img = URL.createObjectURL(e.target.files[0]);
			var files=e.target.files;

			var mimeType=files[0].type;
			var re_text = /\.zip/i;
			 if (e.target.files[0].name.search(re_text) == -1)
				{
					bootbox.alert("please uplaod a zip file only")
				} else {
				//	$(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
					$.ajaxFileUpload({
							url             :'./saveInfoFile/', 
							secureuri       :false,
							fileElementId   :'infoInp',
							dataType        : 'json',
							data        	: {},
							 success : function (obj)
							{
								if(obj.status==1){
									$('#info_file').val(obj.response);
								}
							}
						});
				}
/*			if(mimeType == "image/jpeg" || mimeType == "image/png" || mimeType == "image/jpg" || mimeType == "image/gif"){
				$('#image-error').text('Click save button to upload the image');
				$('#profile_image').val(e.target.files[0].name);
				$('.image').attr('src', img);display: none;
			} else {
				$('#image-error').text('This image type is not allowed. Allowed types: jpg,png,jpeg');
			}*/
    	});
		/*############################################################*/	
		
		//06: PREVENT PARENT FUNCTION CALL ON CHILD CLICK
		$('body').on('click', '#dropbox > *', function(e){
			e.stopPropagation();    
		});
		/*############################################################*/
		
		//07: ALWAYS USE ON() FOR DYNAMICALLY CREATED HTML
		$('body').on('click','#dropbox', function() { 
			$( "#imgInp" ).trigger( "click" );
		});
		/*############################################################*/
	});
	
/*------------ Onload Functions <End> ------------*/

/******************************************** Global <END> ***************************************************/

/******************************************** MODULE 01: LOGIN <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: Register Via Email
		02: Login Via Email
		03: Login Via Facebook
------------ Function List <End>-----------------*/
	//01: Register Via Email
	function registerByEmail(){
		alert("we here");
		//clear .errorMsg area
		$('.errorMsg').text('');
		
		//get form values
		var role = $('#registerForm #role option:selected').val();
		var first_name = $('#registerForm input[name=first_name]').val();
		var last_name = $('#registerForm input[name=last_name]').val();
		var email = $('#registerForm input[name=email]').val();
		var password = $('#registerForm input[name=password]').val();
		var password1 = $('#registerForm input[name=password1]').val();
		var phone_number = $('#registerForm input[name=phone_number]').val();
		var error_flag = false;
		
		/*---------------------FORM VALIDATIONS <START>---------------------*/
		//validate email address
		if (first_name === "") {
			$('.errorMsg').text('First name is required');
			error_flag = true;
		} else if (last_name === "") {
			$('.errorMsg').text('Last name is required');
			error_flag = true;
		} else if (email === "") {
			$('.errorMsg').text('Email address is required');
			error_flag = true;
		} else if( !validateEmail(email)){
			$('.errorMsg').text('Please enter a valid email address');
			error_flag = true;
		} else if (role == 0) {
			$('.errorMsg').text('Please select your role');
			error_flag = true;
		} else if (phone_number === "") {
			$('.errorMsg').text('Phone Number is required');
			error_flag = true;
		} else if (password === "") {
			$('.errorMsg').text('Password is required');
			error_flag = true;
		} else if (password.length < 5) {
			$('.errorMsg').text('Password must be at least 6 characters');
			error_flag = true;
		}else if (password1 === "") {
			$('.errorMsg').text('Please re-enter your password');
			error_flag = true;
		}else if (password1 != password) {
			$('.errorMsg').text('Password did not match');
			error_flag = true;
		}else if(!$('#agree_terms').is(':checked')){
			$('.errorMsg').text('Please agree to our terms & conditions');
			error_flag = true;
		}
		/*---------------------FORM VALIDATIONS <END>---------------------*/
		//submit form
		else if(error_flag == false) {
			FUNCTION_NAME = 'registerByEmailAjax';
			PARAM  = {role:role,first_name:first_name,last_name:last_name,email:email,phone_number:phone_number,password:password};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
	/*#############################################################################################################################################*/
	//02: Login Via Email
	function loginByEmail(){
		//clear .errorMsg area
		$('.errorMsg').text('');
		
		//get form values
		var email = $('#loginForm input[name=email]').val();
		var password = $('#loginForm input[name=password]').val();
		var remember_me = "";
		if($('#remember').is(':checked')){
			remember_me = $('#remember:checked').val();
		}
		var error_flag = false;
		
		/*---------------------FORM VALIDATIONS <START>---------------------*/
		//validate email address
		if (!email) {
			$('.errorMsg').text('Email address is required');
			error_flag = true;		
		} else if( !validateEmail(email)){
			$('.errorMsg').text('Please enter a valid email address');
			error_flag = true;
		}	
		// validate password	
		else if (!password) {
			$('.errorMsg').text('Password is required');
			error_flag = true;
		}
		/*---------------------FORM VALIDATIONS <END>---------------------*/
		
		//submit form
		else if(error_flag == false) {
			FUNCTION_NAME = 'loginAjax';
			PARAM  = {email:email,password:password,remember_me:remember_me};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
	$(document).delegate('#resend_confirm_url','click',function(){
		$('.errorMsg').text('');

		var email = $('#loginForm #email').val();
		var error_flag = false;

		if (!email) {
			$('.errorMsg').text('Email address is required');
			error_flag = true;		
		} else if( !validateEmail(email)){
			$('.errorMsg').text('Please enter a valid email address');
			error_flag = true;
		} else if(error_flag == false) {
			FUNCTION_NAME = 'resend_confirm_url';
			PARAM  = {email:email};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	})
	/*#############################################################################################################################################*/
	//03: Login Via Email
		function loginByFacebook() {
		FB.login(function(response) {
		if (response.session && response.scope) {
			FB.api('/me',
				function(response) {
					alert('User: ' + response.name);
					alert('Full details: ' + JSON.stringify(response));
				}
			);
		}
		}, {scope: 'email'});
			xajax_loginByFacebook();
	}
	/*#############################################################################################################################################*/
	//04: Reset Via Email
	function resetViaEmail() {
		//clear .errorMsg area
		$('#resetForm .errorMsg').text('');
			
		//get form values
		var error_flag = false;
		var email = $('#resetForm input[name=reset_email]').val();
		if(email === "") {
			$('#resetForm .errorMsg').text("Email address is required");
			error_flag = true;
		}else if( !/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email) ) {
			$('#resetForm .errorMsg').text("Please enter a valid email address");
			error_flag = true;
		}else if(error_flag == false) {
			FUNCTION_NAME = 'resetPasswordAjax';
			PARAM  = {email:email};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
/*#############################################################################################################################################*/

/*------------ Defined Functions <End> ------------*/
	
/******************************************** MODULE 01: LOGIN <END> ***************************************************/

/******************************************** MODULE 02: PROFILE <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/
/*------------ Function List <Start>-----------------
		01: roleConfirmation
		02: editProfile
		03: changePassword
		04: addTimeAvaiable
		05: saveTutorProfile
------------ Function List <End>-----------------*/
	//01: roleConfirmation
	function roleConfirmation(user_id){
		//clear .errorMsg area
		$('.errorMsg').text('');
		
		//get form values
		var role = $('#roleConfirmationForm #role option:selected').val();
		var error_flag = false;
		
		/*---------------------FORM VALIDATIONS <START>---------------------*/
		//validate email address
		if (role == 0) {
			$('.errorMsg').text('Please select your role');
			error_flag = true;
		}		/*---------------------FORM VALIDATIONS <END>---------------------*/
		
		//submit form
		else if(error_flag == false) {
			FUNCTION_NAME = 'roleConfirmationAjax';
			PARAM  = {user_id:user_id,role:role};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
/*#############################################################################################################################################*/

	// book lesson as well
	$('.tutor_student').click(function (){
		if($(this).is(':checked')){
			if($(this).val() == 1){
				$('#user-profile-settings').show('slow');
			} else {
				$('#user-profile-settings').hide('slow');		
			}
		}
	})

	//02: editProfile
	function editProfile(user_id,user_role){
		//clear .errorMsg area
		$('.errorMsg').text('');

		//Getting Values
		$("#form_changed").val('0');
		var first_name = $( "#editProfileForm input[name=first_name]" ).val();
		var last_name = $( "#editProfileForm input[name=last_name]" ).val();
		var email = $( "#editProfileForm input[name=email]" ).val();
		var title = $( "#editProfileForm #title option:selected" ).val();
		var gender = $( "#editProfileForm #gender option:selected" ).val();
		var phone_code = $( "#editProfileForm #phone_code option:selected" ).val();
		var phone = $( "#editProfileForm input[name=phone]" ).val();
//		var country_id = $( "#editProfileForm #country option:selected" ).val();
		var country_id = "225";
//		var country_name = $( "#editProfileForm #country option:selected" ).text();
		var country_name = "United Kingdom";
		var city = $( "#editProfileForm input[name=city]" ).val();
		var postal_code = $( "#editProfileForm input[name=postal_code]" ).val();
		var address = $( "#editProfileForm textarea[name=address]" ).val();
		var student_area = $("#editProfileForm #student_area").select2().val();
		var instruction = $( "#editProfileForm textarea[name=instruction]" ).val();
		if(instruction == undefined){
			instruction = "";
		}
		var subject_id = $("#editProfileForm #student_subject").select2().val();
		var subject_text = [];
		$('#editProfileForm #student_subject option:selected').each(function(){
			subject_text.push($(this).text());
		});
		var tutor_student_check = $('.tutor_student:checked').val();
		var profile_image = $('#profile_image').val();

		if(tutor_student_check == undefined){
			tutor_student_check = 1;
		}

		//Validation Check
		var error_flag = false;
		if(first_name === "") {
			$('.errorMsg').text("First name is required");
			error_flag = true;
		}else if(last_name === "") {
			$('.errorMsg').text("Last name is required");
			error_flag = true;
		}else if(email === "") {
			$('.errorMsg').text("Email address is required");
			error_flag = true;
		}else if(!validateEmail(email)) {
			$('.errorMsg').text("Please enter a valid email address");
			error_flag = true;
		}else if(title == 0) {
			$('.errorMsg').text("Title is required");
			error_flag = true;
		}else if(gender == 0) {
			$('.errorMsg').text("Gender is required");
			error_flag = true;
		}else if(phone_code == 0) {
			$('.errorMsg').text("Phone code is required");
			error_flag = true;
		}else if(phone === "") {
			$('.errorMsg').text("Phone number is required");
			error_flag = true;
		}else if(!validateNumber(phone)) {
			$('.errorMsg').text("Please enter valid phone number");
			error_flag = true;
		}else if(student_area == "0") {
			$('.errorMsg').text("Please select area");
			error_flag = true;
		}else if(postal_code === "") {
			$('.errorMsg').text("Postal Code is required");
			error_flag = true;
		} else if (!/\s/.test(postal_code) && country_name == "United Kingdom") {
			$('.errorMsg').text("Add space in postal code");
			error_flag = true;
		}
		/*else if(address === "") {
			$('.errorMsg').text("Address is required");
			error_flag = true;
		}
		else if(subject_id == null && tutor_student_check == 1){
			$('.errorMsg').text("Subjects are required");
			var error_flag = true;
		}
		else if(profile_image === "") {
			$('.errorMsg').text("Profile image is required");
			error_flag = true;
		} */
		else if(error_flag == false){
			$.ajaxFileUpload({
					url             :'./editProfileAjax/', 
					secureuri       :false,
					fileElementId   :'imgInp2',
					dataType        : 'json',
					data        	: {user_id:user_id,first_name:first_name,last_name:last_name,email:email,title:title,gender:gender,phone_code:phone_code,phone:phone,
									   country_id:country_id,city:city,postal_code:postal_code,address:address,instruction:instruction,subject_id:subject_id,subject_text:subject_text,country_name:country_name,student_area:student_area},
					 success : function (obj)
					{
						if(obj.status==0){
							bootbox.alert(obj.response);
						}else if(obj.status==1){
							successAlerts(obj.response,obj.url);
						}else if(obj.status==2){
							$('.errorMsg').text(obj.response);
						}else if(obj.status==3){
							$('.errorMsg').text(obj.response);
						}
					}
				});
		}
	}
/*#############################################################################################################################################*/
	//03: changePassword
	function changePassword(user_id) {
		//clear .errorMsg area
		$('.errorMsg').text('');	
		var error_flag = false;
		//get form values
		var current_password = $( "#password" ).val();
		var new_password1 = $( "#password1" ).val();
		var con_password = $( "#con_password" ).val();
		if(!current_password){
			$('.errorMsg').text("Current password is required");
			var error_flag = true;
		} else if(!new_password1){
			$('.errorMsg').text("New password is required");
			var error_flag = true;
		} else if(new_password1.length <= 5) {
			$('.errorMsg').text("New password must be at least 6 characters")
			var error_flag = true;
		} else if(!con_password){
			$('.errorMsg').text("Confirm password is required");
			var error_flag = true;
		} else if(new_password1 != con_password){
			$('.errorMsg').text("Password didn't match");
			var error_flag = true;
		} else if(error_flag == false) {
			FUNCTION_NAME = 'changePasswordAjax';
			PARAM  = {user_id:user_id,current_password:current_password,new_password1:new_password1};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}

/*#############################################################################################################################################*/
	//04: add single avaiable
	$("#addTimeAvaiable").on("click", function(){
		var select_time_html = $('#time_hidden .times_avaiable').html(); 
		var select_day_html = $('#time_hidden .days_avaiable').html();
		
		var combinationSection = $('.main_availability:last').html();
		var combinationCount = parseInt($('.main_availability:last').attr('id').split('availability_')[1]);
		combinationCount++;
		$('.main_availability:last').after('<div class="form-group has-feedback main_availability" id="availability_'+combinationCount+'"><div class="row available_days_timings_dropdown"><div class="col-sm-6"><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>'+
						'<select class="form-control days_avaiable" data-title="Days Available">'+select_day_html+'</select></div></div><div class="col-sm-6"><div class="input-group times_div"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>'+
						'</div></div></div><div class="action-delete-this"><a href="javascript:deleteMainAvailablity('+combinationCount+')" class="btn btn-circle btn-icon-only red">'+
                        '<i class="fa fa-times"></i>Remove this avaiability</a></div></div>');
		$('#availability_'+combinationCount+' .times_div').append('<select data-title="Time Available" class="form-control times_avaiable" multiple="multiple">'+select_time_html+'</select>');
	})
	function deleteMainAvailablity(sectionID) {
		$('#availability_'+sectionID).remove();
		var count = 1;
		$('.main_availability').each(function(){
			$(this).attr('id','availability_'+count);
			$(this).find('.action-delete-this>a.red').attr('href','javascript:deleteMainAvailablity('+count+')');
			count++;
			
		});
	}
	// group study
	$('.stu_study_group').click(function (){
		if($(this).is(':checked')){
			if($(this).val() == 1){
				$('#addTutorForm').show('slow');
			} else {
				$('#addTutorForm').hide('slow');		
			}
		}
	})
	// group study
	$('.study_group').click(function (){
		if($(this).is(':checked')){
			if($(this).val() == 1){
				$('.group_study').show('slow');
			} else {
				$('.group_study').hide('slow');		
			}
		}
	})
	// add single avaiable
	$("#addGroupAvaiable").on("click", function(){
		var select_time_html = $('#time_hidden .times_avaiable').html(); 
		var select_day_html = $('#time_hidden .days_avaiable').html();
		var tutor_subject_select = $('#tutor_subject_select').html();
		
		var combinationSection = $('.group_main_availability:last').html();
		var combinationCount = parseInt($('.group_main_availability:last').attr('id').split('group_availability_')[1]);
		combinationCount++;
		$('.group_main_availability:last').after('<br><div class="row available_days_timings_dropdown group_main_availability" id="group_availability_'+combinationCount+'"><div class="col-sm-12"><div class="form-group has-feedback"><div class="input-group form-group has-feedback"><span class="input-group-addon"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>'+
						'<input type="text" class="form-control no_of_students" placeholder="Maximum number of students in the group" data-title="Maximum number of students in the group"></div></div></div><div class="col-sm-8"><div class="form-group has-feedback"><div class="input-group"><span class="input-group-addon"><i class="fa fa-book" aria-hidden="true"></i></span><input type="text" class="form-control syllabus" placeholder="Syllabus to be taught in group lesson" data-title="Syllabus to be taught in group lesson"></div></div></div>'+
						'<div class="col-sm-6"><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span><select class="form-control days_avaiable" data-title="Group Days Available">'+select_day_html+'</select></div></div>'+
						'<div class="col-sm-6"><div class="input-group times_div form-group has-feedback"><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span></div></div>'+
						'<div class="action-delete-this"><a href="javascript:deleteGroupAvailablity('+combinationCount+')" class="btn btn-circle btn-icon-only red"><i class="fa fa-times"></i>Remove this group avaiability</a></div></div>');
		$('#group_availability_'+combinationCount+' .times_div').append('<select class="form-control times_avaiable" multiple="multiple" data-title="Group Time Available">'+select_time_html+'</select>');
	})
	function deleteGroupAvailablity(sectionID) {
		$('#group_availability_'+sectionID).remove();
		var count = 1;
		$('.group_main_availability').each(function(){
			$(this).attr('id','group_availability_'+count);
			$(this).find('.action-delete-this>a.red').attr('href','javascript:deleteGroupAvailablity('+count+')');
			count++;
			
		});
	}
/*#############################################################################################################################################*/
	// 05: saveTutorProfile
	
	var hour_time;
	$('#hourly_rate').keyup(function(){
		var value = $(this).val();
		var max_charge = $('#max_charge').val();
		var omt_commission = $('#omt_commission').val();
		clearTimeout(timer);
		hour_time = setTimeout(function() {
			if(value != ""){
				$('#hourlyrate_percent').val(value-((value*omt_commission)/100));
			}
		}, 1000);
	})
	$('#group_hourly_rate').keyup(function(){
		var value = $(this).val();
		var max_charge = $('#max_charge').val();
		var omt_commission = $('#omt_commission').val();
		clearTimeout(timer);
		hour_time = setTimeout(function() {
			if(value != ""){
				$('#grouphourlyrate_percent').val(value-((value*omt_commission)/100));
			}
		}, 1000);
	})

	function saveTutorProfile(tutor_id){
		$('.errorMsg').text('');	
		var error_flag = false;

		$("#form_changed").val('0');
		var level_id = $("#level_id").val();
		var max_charge = $("#max_charge").val();
		var certificate_file = $("#certificate_file").val();
		var subject_level = $("#subject_level").select2().val();
		var subject_id = $("#tutor_subject").select2().val();
		var subject_text = [];
		$('#tutor_subject option:selected').each(function(){
			subject_text.push($(this).text());
		});
		var travel_distance = $('#travel_distance option:selected').val();
		var headline = $('#headline').val();
		var info_file = $('#info_file').val();
		var personal_statement = $('#personal_statement').val();
		if(personal_statement){
			personal_statement = personal_statement.replace(/\n\r?/g, '<br />');
		}
		var hourly_rate = $('#hourly_rate').val();
		var group_hourly_rate = $('#group_hourly_rate').val();
		if($('.group_study').css("display") == "none"){
			group_hourly_rate = "";
		}
		var tutor_experience = $('#tutor_experience').val();
		/* var tutor_hours = $('#tutor_hours').val(); */
		var tutor_hours = 0;
		var tutor_subjects = $('#tutor_subjects').val();
		var group_avail = $('.study_group:checked').val();
		var teaching_level = [];
		var teaching_level_index = 0;
			$('.teaching_level').each(function(){
				teaching_level[teaching_level_index] = $(this).val();
				teaching_level_index++;
			})
		// get group avaiability
		var max_group_member = $('#max_group').val();
		var group_avaiability = [];
		if(group_avail == 1){
			$('.group_main_availability').each(function(){
				var days = $(this).find('.days_avaiable option:selected').val();
				var times = $(this).find('.times_avaiable').select2().val();
				var no_of_students = $(this).find('.no_of_students').val();
/*				var tutor_subject_select = $(this).find('.tutor_subject_select option:selected').val();*/
				var syllabus = $(this).find('.syllabus').val();
				/*if(no_of_students === ""){
					$('.errorMsg').text("No.of students is required in avaiability section");
					error_flag = true;
					return false;				
				} else*/
					if(max_group_member !=0 && parseInt(no_of_students) > max_group_member){
					$('.errorMsg').text("Allowed group students at this level is "+max_group_member);
					error_flag = true;
					return false;				
				} else if(no_of_students != "" && !validateNumber(no_of_students)){
					$('.errorMsg').text("No.of students should be numeric");
					error_flag = true;
					return false;				
				}/* else if(syllabus === ""){
					$('.errorMsg').text("Please set your group schedule.");
					error_flag = true;
					return false;				
				} else if(days===""){
					$('.errorMsg').text("Please set your group schedule.");
					error_flag = true;
					return false;
				} else if(times == null){
					$('.errorMsg').text("Please set your group schedule.");
					error_flag = true;
					return false;				
				}*/ 
				else if(error_flag == false) {
					if(days != "" && times != null && no_of_students != "" && syllabus != ""){
						group_avaiability.push(';'+syllabus+';'+days+';'+no_of_students+';'+times);
					}
				}
			});
		}
		// get avaiability
		var avaiability = [];
		var main_a_index =0;
		$('.main_availability').each(function(){
			var days = $(this).find('.days_avaiable option:selected').val();
			var times = $(this).find('.times_avaiable').select2().val();
				/*if(group_avail == 0){
					if(days===""){
						$('.errorMsg').text("Please set your schedule.");
						error_flag = true;
						return false;
					} else if(times == null){
						$('.errorMsg').text("Please set your schedule.");
						error_flag = true;
						return false;				
					} else if(error_flag == false) {
						avaiability.push(';'+days+';'+times);
						main_a_index++;
					}
				} else {
						avaiability.push(';'+days+';'+times);
						main_a_index++;					
				}*/
				if(days != "" && times != null){
					avaiability.push(';'+days+';'+times);
					main_a_index++;
				}
		});
		// get teaching experience
		var teaching = [];
		var main_t_index =0;
		$('.main-teaching').each(function(){
			var index = 0;
			var teaching_value = [];
			var v_count = 0;
			$(this).find('.teaching_fields').each(function(){
				var value = $(this).attr('data-value');
				var title = $(this).attr('data-title');
				teaching_value[v_count] = $(this).val().replace(",", ";");
					/*if($(this).val() != ""){
						var fill_teaching_id = $(this).closest('.main-teaching').attr('id');
						var total = $('#'+fill_teaching_id+' .teaching_fields').filter(function(){
								return !$(this).val();
							}).length;
							if(total != 0){
								$('.errorMsg').text("Please fill out teaching experience completely");
								error_flag = true;
								return false;
							}
					}*/
/*				if(main_t_index == 0){
					if(teaching_value[v_count]===""){
						$('.errorMsg').text(title+" is required in teaching experience section");
						error_flag = true;
						return false;
					}
				} else {
					if($(this).val() != ""){
						var fill_teaching_id = $(this).closest('.main-teaching').attr('id');
						var total = $('#'+fill_teaching_id+' .teaching_fields').filter(function(){
								return !$(this).val();
							}).length;
							if(total != 0){
								$('.errorMsg').text("Please fill out teaching completely");
								error_flag = true;
								return false;
							}
					}
				}*/
				teaching_value[v_count] = value+'+='+teaching_value[v_count];
				v_count++;
			});	
			teaching.push(teaching_value);
			index++;
			main_t_index++;
		});
		// get education and qualification
		var education = [];
		var main_edu_index =0;
		$('.main-education').each(function(){
			var index = 0;
			var education_value = [];
			var v_count = 0;
			$(this).find('.education_fields').each(function(){
				var value = $(this).attr('data-value');
				var title = $(this).attr('data-title');
				education_value[v_count] = $(this).val()
				/*if(main_edu_index == 0){
					if(education_value[v_count]===""){
						$('.errorMsg').text("Education "+title+" is required in education & qualification section");
						error_flag = true;
						return false;
					}
				} else {
					if($(this).val() != ""){
						var fill_education_id = $(this).closest('.main-education').attr('id');
						var total = $('#'+fill_education_id+' .education_fields').filter(function(){
								return !$(this).val();
							}).length;
							if(total != 0){
								$('.errorMsg').text("Please fill out education completely");
								error_flag = true;
								return false;
							}
					}
				}*/
				education_value[v_count] = value+'+='+education_value[v_count];
				v_count++;
			});	
			education.push(education_value);
			index++;
			main_edu_index++;
		});
		/*if(subject_id == null){
			$('.errorMsg').text("Subjects is required in tutor information section");
			var error_flag = true;
		} else if(!subject_level){
			$('.errorMsg').text("Levels");
			var error_flag = true;
		} else if(!headline){
			$('.errorMsg').text("Headline is required in tutor information section");
			var error_flag = true;
		} else if(!personal_statement){
			$('.errorMsg').text("Personal statement is required in tutor information section");
			var error_flag = true;
		} else if(!hourly_rate){
			$('.errorMsg').text("Hourly rate is required in tutor information section");
			var error_flag = true;
		} else*/
		if(hourly_rate == "0"){
			$('.errorMsg').text("Hourly rate should not be zero");
			var error_flag = true;
		} else if(hourly_rate != "" && !validateFloat(hourly_rate)){
			$('.errorMsg').text("Hourly rate must be numeric");
			var error_flag = true;
		} else if(max_charge != 0 && parseFloat(hourly_rate) > max_charge){
			$('.errorMsg').text("Hourly rate should not be greater than "+max_charge);
			var error_flag = true;
		} /*else if(certificate_file === ""){
			$('.errorMsg').text("Upload a zip file with certificates in education & qualification section");
			var error_flag = true;
		} */
		/*else if(!group_hourly_rate){
			$('.errorMsg').text("Hourly rate group lesson is required in tutor information section");
			var error_flag = true;
		} */
		else if(group_hourly_rate == "0"){
			$('.errorMsg').text("Hourly rate group lesson should not be zero");
			var error_flag = true;
		} else if(group_hourly_rate != "" && !validateFloat(group_hourly_rate)){
			$('.errorMsg').text("Hourly rate group lesson must be numeric");
			var error_flag = true;
		} else if(max_charge != 0 && parseFloat(group_hourly_rate) > max_charge){
			$('.errorMsg').text("Hourly rate group lesson should not be greater than "+max_charge);
			var error_flag = true;
		}
		/*else if(!tutor_experience){
			$('.errorMsg').text("Tutor experience is required in teaching experience section");
			var error_flag = true;
		}*/
/*		else if(!validateFloat(tutor_experience)){
			$('.errorMsg').text("Tutor experience must be numeric");
			var error_flag = true;
		}
		else if(!tutor_hours){
			$('.errorMsg').text("Tutor hours is required in teaching experience section");
			var error_flag = true;
		}*/
/*		else if(!tutor_subjects){
			$('.errorMsg').text("Tutor subjects is required in teaching experience section");
			var error_flag = true;
		} else if(group_avail == undefined){
			$('.errorMsg').text("Are you avaiable for group study?");
			var error_flag = true;
		}*/
		else if(error_flag == false) {
			$.ajaxFileUpload({
					url             :'./saveTutorProfileAjax/', 
					secureuri       :false,
					fileElementId   :'imgInp1',
					dataType        : 'json',
					data        	:  {tutor_id:tutor_id,level_id:level_id,subject_id:subject_id,travel_distance:travel_distance,headline:headline,personal_statement:personal_statement,
										hourly_rate:hourly_rate,education:education,teaching:teaching,tutor_experience:tutor_experience,tutor_hours:tutor_hours,
										tutor_subjects:tutor_subjects,avaiability:avaiability,group_avaiability:group_avaiability,teaching_level:teaching_level,subject_text:subject_text,subject_level:subject_level,info_file:info_file,group_hourly_rate:group_hourly_rate},
					 success : function (obj)
					{
						if(obj.status==0){
							bootbox.alert(obj.response);
						}else if(obj.status==1){
							successAlerts(obj.response,obj.url);
						}else if(obj.status==2){
							$('.errorMsg').text(obj.response);
						}
					}
				});
		}
	}
/*#############################################################################################################################################*/

/*------------ Defined Functions <End> ------------*/
$("#account-settings").bootstrapSwitch();
$('#account-settings').on('switchChange.bootstrapSwitch', function (e, data) {
			$('#account-settings').bootstrapSwitch('state', !data, true);
			var status = 4;
			var msg = "Are you sure you want to disable your account? You will no longer be able to book any lesson.";
			if(data == true){
				status = 1
				msg = "Are you sure you want to enable your account?";
			}
			bootbox.confirm({
				message: msg,
				backdrop: 'static',
				keyboard: false,
				callback: function(result) {
					if(result == true) {
						FUNCTION_NAME = 'changeUserStatusAjax';
						PARAM  = {status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
			});
	});
	function deleteAccount(status){
			bootbox.confirm({
				message: "Are you sure you want to delete your account? This can't be undone",
				backdrop: 'static',
				keyboard: false,
				callback: function(result) {
					if(result == true) {
						FUNCTION_NAME = 'changeUserStatusAjax';
						PARAM  = {status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
			});		
	}
/******************************************** MODULE 02: PROFILE <END> ***************************************************/

/******************************************** MODULE 03: SEARCH <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: search
------------ Function List <End>-----------------*/
	//01: search
	var timer;
	$('.search_fields').focusout(function(){
		var value = $(this).val();
		if(value != ""){
			search();
		}
	})
	$(".search_fields").keypress(function(e) {
		var value = $(this).val();
		if(e.which == 13) {
			if(value != ""){
				search();
			}
		}
	});
	$('#input-id').on('rating.change', function(event, value, caption) {
		search();
	})
	$('#input-id').on('rating.clear', function(event) {
		search();
	});
	var page = 0;
	$('#pagination li a').click(function(){
		page = $(this).attr('data-page');
		search();
/*		var query_address = window.location.href.split('?')[1];
		if(query_address == undefined){
			var url = root_address+'?page='+page;
			location.href = url;
		} else {
			search("?page"+page);			
		}*/
	})
	function search(){
		var root_address = window.location.href.split('?')[0];
		var subject = $('#search_subject').val();
		var level = $('#search_level').val();
		var location_s = $('#search_location').val();
		var rate = $('#ex2').val();
		var rating = $('#input-id').val();
		var distance = $('#distance_slider').val();
		var sort_price = ($('.sort_price .btn-group .btn.active').html()).toLowerCase();
		var sort_rating = ($('.sort_rating .btn-group .btn.active').html()).toLowerCase();
		var sort_distance = ($('.sort_distance .btn-group .btn.active').html()).toLowerCase();
		var url = root_address+'?subject='+subject+'&level='+level+'&location='+location_s+'&rate='+rate+'&rating='+rating+'&distance='+distance+'&page='+page+'&sort_price='+sort_price+'&sort_rating='+sort_rating+'&sort_distance='+sort_distance;
		location.href = url;
	}
/*#############################################################################################################################################*/
/*	$("#homeSearchForm input.form-control").focusout(function(){
		if($(this).val() != ""){
			$(this).closest('.form-group').find('.tick_okay_icon').show();
		}else{
			$(this).closest('.form-group').find('.tick_okay_icon').hide();			
		}
	})*/
	$("#location_tick").focusout(function(){
		if($(this).val() != ""){
			$(this).closest('.form-group').find('.tick_okay_icon').show();
		}else{
			$(this).closest('.form-group').find('.tick_okay_icon').hide();			
		}
	})
	//01: searchQuick
	function searchQuick(form_id){
		//clear .errorMsg area
		//Getting Values
		var subject = $('#'+form_id+' .subject_autocomplete').val();
		var level = $('#'+form_id+' .level_autocomplete').val();
		var location_s = $('#'+form_id+' .searchlocation').val();
		if(subject != '' || level != '' || location_s != ''){
			location.href = host+"search-list?subject="+subject+"&level="+level+"&location="+location_s;
		}
	}
/*#############################################################################################################################################*/
// search sliders
$(document).ready(function() {
		// With JQuery
		$("#distance_slider").slider({});
		$("#distance_slider").on("slide", function(slideEvt) {
			$("#distance_slider_value").text(slideEvt.value);
		});
		$("#distance_slider").on("slideStop", function(slideEvt) {
			search();
		});
		
		$("#ex2").slider({});
		$("#ex2").on("slide", function(slideEvt) {
			$("#ex2-sliderLowerSliderVal").text(slideEvt.value[0]);
			$("#ex2-sliderUpperSliderVal").text(slideEvt.value[1]);
		});
		$("#ex2").on("slideStop", function(slideEvt) {
			search();
		});
		$(".experience_switch .btn-group button.btn").on('click', function(e) {
			setTimeout(function() {
			search();
		}, 500);
		});
})
/*#############################################################################################################################################*/
	$("#book_lesson").on('click', function(e) {
	   e.preventDefault();
		$('html, body').animate({
			scrollTop: $("#headingOne").offset().top + -90
		}, 1000);
	});
/*#############################################################################################################################################*/
/*------------ Defined Functions <End> ------------*/
	
/******************************************** MODULE 03: SEARCH <END> ***************************************************/

/******************************************** MODULE 04: LESSON BOOKING <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/
$('.lessons-tab a').click(function(){
	$('.lessons-tab a').removeClass('lesson-active');
	$(this).addClass('lesson-active');
	$('.lesson-tab-info').hide();
	if($(this).hasClass('taken-lessons')){
		$('#taken-lessons').show();
	} else {
		$('#given-lessons').show();		
	}
})
/*------------ Function List <Start>-----------------
		01: bookLesson
		02: changeLessonStatus
------------ Function List <End>-----------------*/
	//01: reservationValidations
	function send_book_message(){
		$('#search_detail_calendar_form_modal').modal('show')
	}
	function bookLesson(tutor_id,student_id){
		//clear .errorMsg area
		$('.errorMsg').text('');

		//Getting Values
		var tutor_availability_id = $( "#tutor_availability_id" ).val();
		var booking_message = $( "#booking_message" ).val();
		var lesson_date = $( "#lesson_date" ).val();
		var lesson_type = $( "#lesson_type" ).val();
		var book_subject_val = $( "#book_subject option:selected" ).val();
		var book_subject = $( "#book_subject option:selected" ).val();
		if($('#book_subject_div:visible').length == 0)
			{
				book_subject_val = $('#syllabus_subject span').text();
				book_subject = $('#syllabus_subject span').text();
			}
		//Validation Check
		var error_flag = false;
		if(book_subject_val == 0 && lesson_type!='' && tutor_availability_id!='') {
			$('.errorMsg').text("Please Select Subject");
			error_flag = true;
		}else if(booking_message === "") {
			$('.errorMsg').text("Please type a message");
			error_flag = true;
		}else if(error_flag == false){
			$('#message_sent_button').prop('disabled', true);
			FUNCTION_NAME = 'bookLesson';
			PARAM  = {tutor_id:tutor_id,tutor_availability_id:tutor_availability_id,student_id:student_id,booking_message:booking_message,lesson_date:lesson_date,lesson_type:lesson_type,book_subject:book_subject};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
	function bookedLesson(msg,url){
		bootbox.dialog({
			 title: "Message Sent",
			 message: msg,
			 className: "upload_modal",
			 buttons: {
				success: {
					label: "OK",
					className: "btn-success",
					callback: function() {
						if(url==0){
							window.location.reload();
						} else{
							window.location = url;
						}
					}
				}/* ,
				cancel: {
					label: "Make Payment",
					className: "btn-success",
					callback: function() {
						$("#paymentForm .stripe-button-el").trigger("click");
					}
				} */
			 }
		});
	}
/*#############################################################################################################################################*/
	//02: change lesson status
	function changeLessonStatus(lesson_id,tutor_id,student_id){
		var status = $('#lesson_booking_staus option:selected').val();
		if(status !=""){
			bootbox.confirm({
				message: "Are you sure you want to change this lesson status.",
				buttons: {
					confirm: {
						label: 'Yes'
					},
					cancel: {
						label: 'No'
					}
				},
				callback: function (result) {
					if(result == true) {
						FUNCTION_NAME = 'changeLessonStatusAjax';
						PARAM  = {lesson_id:lesson_id,tutor_id:tutor_id,student_id:student_id,status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
			});
		}
	}
	function changeStudentStatus(lesson_id,tutor_id,student_id){
		var status = $('#student_status option:selected').val();
		if(status !=""){
			bootbox.confirm({
				message: "Are you sure you want to change this student status.",
				buttons: {
					confirm: {
						label: 'Yes'
					},
					cancel: {
						label: 'No'
					}
				},
				callback: function (result) {
					if(result == true) {
						FUNCTION_NAME = 'changeStudentStatus';
						PARAM  = {lesson_id:lesson_id,tutor_id:tutor_id,student_id:student_id,status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
			});
		}
	}

/*#############################################################################################################################################*/
/*------------ Defined Functions <End> ------------*/
	
/******************************************** MODULE 04: LESSON BOOKING <END> ***************************************************/

/******************************************** MODULE 05: MESSAGE <START> ***************************************************/
/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: changeMessageStatus
		02: sendReply
------------ Function List <End>-----------------*/
	//01: changeMessageStatus
	function changeMessageStatus(lesson_id,status){
		FUNCTION_NAME = 'changeMessageStatusAjax';
		PARAM  = {lesson_id:lesson_id,status:status};
		xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
	}
/*#############################################################################################################################################*/
	//02: sendReply
	function sendReply(sender_id,receiver_id,lesson_id,sender_image,sender_name){
		//clear .errorMsg area
		$('.errorMsg').text('');
		//Getting Values
		var message = $( "#reply_message" ).val();		
		//Validation Check
		var error_flag = false;
		if(message === "") {
//			$('.errorMsg').text("Message is required");
			error_flag = true;
		}else if(error_flag == false){
			var html = '<div class="topic-reply chat-align-right"><div class="row"><div class="col-md-10"><div class="topic-message">'+
						'<h5>'+sender_name+' <span class="pull-right"></span></h5><p>'+message+'</p></div></div><div class="col-md-2">'+
						'<div class="topic-author"> <img alt="forum topic author" src="'+sender_image+'"/></div></div></div></div>';
			$('#main-message').append(html);
			FUNCTION_NAME = 'addMessageAjax';
			PARAM  = {sender_id:sender_id,receiver_id:receiver_id,lesson_id:lesson_id,message:message};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
			$( "#reply_message" ).val('');
		}
	}
/*#############################################################################################################################################*/
	function changeLessonStatusMessage(lesson_id,tutor_id,student_id){
		var status = $('#lesson_booking_staus option:selected').val();
		if(status !=""){
			bootbox.confirm({
				message: "Are you sure you want to change this lesson status.",
				buttons: {
					confirm: {
						label: 'Yes'
					},
					cancel: {
						label: 'No'
					}
				},
				callback: function (result) {
					if(result == true) {
						FUNCTION_NAME = 'changeLessonStatusAjax';
						PARAM  = {lesson_id:lesson_id,tutor_id:tutor_id,student_id:student_id,status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
			});
		}
	}
/*#############################################################################################################################################*/

/*------------ Defined Functions <End> ------------*/
	
/******************************************** MODULE 05: MESSAGE <END> ***************************************************/
/******************************************** MODULE 06: PAYMENT <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: savePaymentDetails
------------ Function List <End>-----------------*/
/*#############################################################################################################################################*/
	//01: savePaymentDetails
	function savePaymentDetails(user_id){
		//clear .errorMsg area
		$('.errorMsg').text('');

		//Getting Values
		var title = $( "#savePaymentDetailsForm input[name=title]" ).val();
		var bank_name = $( "#savePaymentDetailsForm input[name=bank_name]" ).val();
		var address = $( "#savePaymentDetailsForm input[name=address]" ).val();
		var account_number = $( "#savePaymentDetailsForm input[name=account_number]" ).val();
		var swift_code = $( "#savePaymentDetailsForm input[name=swift_code]" ).val();
		var phone_code = $( "#savePaymentDetailsForm #phone_code option:selected" ).val();
		var phone = $( "#savePaymentDetailsForm input[name=phone]" ).val();
		
		//Validation Check
		var error_flag = false;
		if(title === "") {
			$('.errorMsg').text("Account title is required");
			error_flag = true;
		}else if(bank_name === "") {
			$('.errorMsg').text("Bank name is required");
			error_flag = true;
		}else if(address === "") {
			$('.errorMsg').text("Address is required");
			error_flag = true;
		}else if(account_number === "") {
			$('.errorMsg').text("Account number is required");
			error_flag = true;
		}else if(!validateNumber(account_number)) {
			$('.errorMsg').text("Account number is not valid");
			error_flag = true;
		}else if(swift_code === "") {
			$('.errorMsg').text("Swift / BIC is required");
			error_flag = true;
		}else if(phone_code == 0){
			$('.errorMsg').text("Phone Code is required");
			error_flag = true;
		}else if(phone === "") {
			$('.errorMsg').text("Phone is required");
			error_flag = true;
		}else if(!validateNumber(phone)) {
			$('.errorMsg').text("Phone number is not valid");
			error_flag = true;
		}else if(error_flag == false){
			FUNCTION_NAME = 'savePaymentDetails';
			PARAM  = {user_id:user_id,title:title,bank_name:bank_name,address:address,account_number:account_number,swift_code:swift_code,phone_code:phone_code,phone:phone};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
/*#############################################################################################################################################*/

/*------------ Defined Functions <End> ------------*/
	
/******************************************** MODULE 06: PAYMENT <END> ***************************************************/
/******************************************** MODULE 07: REVIEWS <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: addReview
------------ Function List <End>-----------------*/
/*#############################################################################################################################################*/
	//01: addReview
	function addReview(lesson_id,tutor_id,student_id){
		//clear .errorMsg area
		$('.errorMsg').text('');

		//Getting Values
		var rating = $( "#add-review" ).val();
		var review = $( "#review" ).val();
		var review_headline = $( "#review_headline" ).val();
		var review_outcome = $( "#review_outcome" ).val();

		//Validation Check
		var error_flag = false;
		if(review_headline === "") {
			$('.errorMsg').text("Please add headline");
			error_flag = true;
		}else if(rating == 0) {
			$('.errorMsg').text("Please add rating");
			error_flag = true;
		}else if(review === "") {
			$('.errorMsg').text("Please add review");
			error_flag = true;
		}else if(review_outcome === "") {
			$('.errorMsg').text("Please add outcome");
			error_flag = true;
		}else if(error_flag == false){
			FUNCTION_NAME = 'addReviewsAjax';
			PARAM  = {lesson_id:lesson_id,tutor_id:tutor_id,student_id:student_id,rating:rating,review:review,review_headline:review_headline,review_outcome:review_outcome};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
/******************************************** MODULE 07: REVIEWS <END> ***************************************************/

	function contactEmail(){
		//clear .errorMsg area
		$('#contactForm .errorMsg').text('');
		
		//get form values
		var contact_name = $('#contactForm input[name=contact_name]').val();
		var contact_email = $('#contactForm input[name=contact_email]').val();
		var contact_phone = $('#contactForm input[name=contact_phone]').val();
		var contact_subject = $('#contactForm input[name=contact_subject]').val();
		var contact_message = $('#contactForm textarea[name=contact_message]').val();
		var error_flag = false;
		
		/*---------------------FORM VALIDATIONS <START>---------------------*/
		//validate email address
		if (!contact_name) {
			$('#contactForm .errorMsg').text('Name is required');
			error_flag = true;		
		} else if (!contact_email) {
			$('#contactForm .errorMsg').text('Email is required');
			error_flag = true;		
		} else if( !validateEmail(contact_email)){
			$('#contactForm .errorMsg').text('Please enter a valid email address');
			error_flag = true;
		} else if (!contact_phone) {
			$('#contactForm .errorMsg').text('Phone is required');
			error_flag = true;
		} else if (!contact_subject) {
			$('#contactForm .errorMsg').text('Subject is required');
			error_flag = true;
		} else if (!contact_message) {
			$('#contactForm .errorMsg').text('Message is required');
			error_flag = true;
		}
		/*---------------------FORM VALIDATIONS <END>---------------------*/
		
		//submit form
		else if(error_flag == false) {
			FUNCTION_NAME = 'sendEmailAjax';
			PARAM  = {contact_name:contact_name,contact_email:contact_email,contact_phone:contact_phone,contact_subject:contact_subject,contact_message:contact_message};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}		
	}

/******************************************** MODULE 10: HOME <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: homeSearch
------------ Function List <End>-----------------*/
/*#############################################################################################################################################*/
	// home scroll
	$(".how-it-works-scroll").on('click', function(e) {
		var hashID = "#how-it-works";
		$('html, body').animate({
			scrollTop: $(hashID).offset().top + -90
		}, 1000);
	});
	$(document).ready(function(e) {
		var hashID = window.location.hash;
		if(hashID != ""){
			$('html, body').animate({
				scrollTop: $(hashID).offset().top + -90
			}, 1000);
		 }
	});
/*#############################################################################################################################################*/	
		//01: auto compelete for level
    function split( val ) {
     return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( ".level_autocomplete" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "./levels_ajax/", {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 1 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          this.value = ui.item.label;
		  if(ui.item && $(this).val() == ui.item.label){			  
			$(this).closest('.form-group').find('.tick_okay_icon').show();
		  } else {
			$(this).closest('.form-group').find('.tick_okay_icon').hide();			
		  }
          return false;
        },
		change: function(event,ui){
		  if(ui.item && $(this).val() == ui.item.label){			  
			$(this).closest('.form-group').find('.tick_okay_icon').show();
		  } else {
			$(this).closest('.form-group').find('.tick_okay_icon').hide();			
		  }
		}
      });
	 $( ".level_autocomplete1" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "./levels_ajax/", {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 1 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
	//02: auto compelete for subjects
    function split( val ) {
     return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( ".subject_autocomplete" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          $.getJSON( "./subjects_ajax/", {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length < 1 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          this.value = ui.item.label;
		  if(ui.item && $(this).val() == ui.item.label){			  
			$(this).closest('.form-group').find('.tick_okay_icon').show();
		  } else {
			$(this).closest('.form-group').find('.tick_okay_icon').hide();			
		  }
          return false;
        },
		change: function(event,ui){
		  if(ui.item && $(this).val() == ui.item.label){			  
			$(this).closest('.form-group').find('.tick_okay_icon').show();
		  } else {
			$(this).closest('.form-group').find('.tick_okay_icon').hide();			
		  }
		}
      });
	  //02: auto compelete for postal_code
    function split( val ) {
     return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#postal_auto" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        source: function( request, response ) {
          var country = $("#country option:selected").text();
          $.getJSON( "./postal_ajax/", {
            term: extractLast( request.term ),
			country:country
          }, response );
        },
        search: function() {
          // custom minLength
          var term = extractLast( this.value );
          if ( term.length >= 3 ) {
			$('#loading_dots').show();
          }
          if ( term.length < 3 ) {
            return false;
          }
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          this.value = ui.item.label;
          return false;
        },
        response: function( event, ui ) {
			$('#loading_dots').hide();
        }
	});
// autocomplete

/*#############################################################################################################################################*/

/*------------ Defined Functions <End> ------------*/
	
/******************************************** MODULE 10: HOME <END> ***************************************************/

/* End of file script.js */
/* Location: ./application/assets/frontend/js/script.js */