/*
Project Name: open mind tutors
Project URI: 
Description: 
Author: Shahan Ahmed
Author URI: 03434093114
Version: 1.0
Created: Marh 17, 2016
Last Modified: 
*/

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
	00: Url validation
	01: Email validation
	02: Password validation
	03: Simple Password validation
	04: Number validation
	05: Custom designed alert
	06: successAlerts
	07: redirect
	08: isUrlValid
	09: addFields
	10: addAnswer
	14: Checkbox click
	15: file reader for survey page
------------ Function List <End>-----------------*/
	//00: Url validation
	function validateUrl(url) {
			var re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/;
        	return re.test(url);
	}
	/*############################################################*/
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
		$("#input-1").rating({displayOnly: true,size:'xs'});		
		//00: Date picker
		$('#datepicker').datepicker({
			changeMonth: true,
				changeYear: true,
				yearRange: "1:c+10",
			});
		$('#datepicker1').datepicker({
			changeMonth: true,
				changeYear: true,
				yearRange: "1:c+10",
			});		

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
		/*############################################################*/	
	});
	
/*------------ Onload Functions <End> ------------*/

/******************************************** Global <END> ***************************************************/

/******************************************** MODULE 01: LOGIN <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: Login Via Email
		02: Reset Via Email
------------ Function List <End>-----------------*/	
	//01: Login Via Email
	function loginByEmail(){
		//clear .errorMsg area
		$('#loginForm .errorMsg span').text('');
		
		//get form values
		var email = $('#loginForm input[name=username]').val();
		var user_password = $('#loginForm input[name=password]').val();
		var remember_me = "";
		if($('#remember').is(':checked')){
			remember_me = $('#remember:checked').val();
		}
		var error_flag = false;
		
		/*---------------------FORM VALIDATIONS <START>---------------------*/
		//validate email address
		if (!email) {
			$('#loginForm .errorMsg').show();
			$('#loginForm .errorMsg span').text('Please enter your email address');
			error_flag = true;		
		} else if( !validateEmail(email)){
			$('#loginForm .errorMsg').show();
			$('#loginForm .errorMsg span').text('Please enter a valid email address');
			error_flag = true;
		}	
		// validate password	
		else if (!user_password) {
			$('#loginForm .errorMsg').show();
			$('#loginForm .errorMsg span').text('Please enter your password');
			error_flag = true;
		}
		/*---------------------FORM VALIDATIONS <END>---------------------*/
		
		//submit form
		else if(error_flag == false) {
			$("#loginForm .errorMsg").hide(); 
			FUNCTION_NAME = 'loginAjax';
			PARAM  = {email:email,user_password:user_password,remember_me:remember_me};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}

	//02: Login Via Email
	function hardLoginByEmail(){
		//get form values
		var email = $('#loginForm input[name=email]').val();
		var password = $('#loginForm input[name=password]').val();
		var remember_me = 0;
        FUNCTION_NAME = 'hardLoginAjax';
		PARAM  = {email:email,password:password,remember_me:remember_me};
		xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
	}
	/*#############################################################################################################################################*/

	//02: Reset Via Email
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

/******************************************** MODULE 02: USERS <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: changeUserStatus
		02: changePassword
		03: editProfile
------------ Function List <End>-----------------*/	

//01: changeUserStatus
function changeUserStatus(img,user_id,status,msg) {
    bootbox.confirm({
			message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>'+msg+'</p></div>',
			callback: function(result) {
				if(result == true) {
					FUNCTION_NAME = 'changeUserStatusAjax';
					PARAM  = {user_id:user_id,status:status};
					xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
				}
			}
    }); 
}

//02: changeAdminStatus
function changeAdminStatus(img,admin_id,status,msg) {
    bootbox.confirm({
        message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>'+msg+'</p></div>',
        callback: function(result) {
            if(result == true) {
                FUNCTION_NAME = 'changeAdminStatusAjax';
                PARAM  = {admin_id:admin_id,status:status};
                xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
            }
        }
    });
}

function featureUser(img,user_id,status,msg) {
    bootbox.confirm({
			message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>'+msg+'</p></div>',
			callback: function(result) {
				if(result == true) {
					FUNCTION_NAME = 'featureUserAjax';
					PARAM  = {user_id:user_id,status:status};
					xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
				}
			}
    }); 
}
/*#############################################################################################################################################*/

//02: changePassword
function changePassword() {
	//clear .errorMsg area
	$('#changePasswordForm .errorMsg').text('');	
	var error_flag = false;
	//get form values
    var current_password = $( "#changePasswordForm input[name=password]" ).val();
	var new_password1 = $( "#changePasswordForm input[name=newPassword]" ).val();
	var new_password = $( "#changePasswordForm input[name=newPassword1]" ).val();
	if(!current_password){
		$('#changePasswordForm .errorMsg').text("Current password is required");
		var error_flag = true;
	} else if(!new_password1){
		$('#changePasswordForm .errorMsg').text("New password is required");
		var error_flag = true;
	} else if(new_password1.length <= 5) {
		$('#changePasswordForm .errorMsg').text("New password must be at least 6 characters")
		var error_flag = true;
	} else if(!new_password){
		$('#changePasswordForm .errorMsg').text("Re-type your new password");
		var error_flag = true;
	} else if(new_password != new_password1){
		$('#changePasswordForm .errorMsg').text("Password did not match");
		var error_flag = true;
	} else if(error_flag == false) {
		FUNCTION_NAME = 'changePasswordAjax';
		PARAM  = {current_password:current_password,new_password1:new_password1};
		xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
	}
}
/*#############################################################################################################################################*/
	//03: editProfile
	function editProfile() {
		//clear .errorMsg area
		$('#editProfileForm .errorMsg').text('');	
		var error_flag = false;
		//get form values
		var first_name = $( "#editProfileForm input[name=first_name]" ).val();
		var last_name = $( "#editProfileForm input[name=last_name]" ).val();
		var email = $( "#editProfileForm input[name=email]" ).val();
		var phone = $( "#editProfileForm input[name=phone]" ).val();
		var description = $( "#editProfileForm textarea[name=description]" ).val();
		if(!first_name){
			$('#editProfileForm .errorMsg').text("First name is required");
			error_flag = true;
		} else if(!last_name){
			$('#editProfileForm .errorMsg').text("Last name is required");
			error_flag = true;
		} else if(!email) {
			$('#editProfileForm .errorMsg').text("Email is required")
			error_flag = true;
		} else if( !validateEmail(email)){
			$('#editProfileForm .errorMsg').text("Email is required")
			error_flag = true;
		} else if(!phone){
			$('#editProfileForm .errorMsg').text("Phone is required");
			error_flag = true;
		} else if(!description){
			$('#editProfileForm .errorMsg').text("About is required");
			error_flag = true;
		} else if(error_flag == false) {
			FUNCTION_NAME = 'editProfileAjax';
			PARAM  = {first_name:first_name,last_name:last_name,email:email,phone:phone,description:description};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
/*#############################################################################################################################################*/
//04: editPic
function editPic(user_id) {
	//clear .errorMsg area
	$('#editPicForm .errorMsg').text('');	
	var error_flag = false;
	//get form values
    var user_image = $( "#editPicForm input[name=imgInp1]" ).val();
	if(!user_image){
		$('#editPicForm .errorMsg').text("Select an image");
		error_flag = true;
	} else if(error_flag == false) {
			$.ajaxFileUpload({
					url             :'./editPicAjax/', 
					secureuri       :false,
					fileElementId   :'imgInp1',
					dataType        : 'json',
					data        	: {user_id:user_id},
					 success : function (obj)
					{
						if(obj.status==0){
							bootbox.alert(obj.response);
						}else if(obj.status==1){
							$("#personal_info #up_text").text(obj.response);
							$("#personal_info").modal("show");
						}else if(obj.status==2){
							$('.errorMsg').text(obj.response);
						}
					}
				});
	}
}
/*#############################################################################################################################################*/
	//changeTutorLevel
	function changeTutorLevel(user_id,img){
		var level_id = $('#level_id option:selected').val();
		if(level_id != 0){
			bootbox.confirm({
					message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>Are you sure?</p></div>',
					callback: function(result) {
						if(result == true) {
							FUNCTION_NAME = 'changeTutorLevelAjax';
							PARAM  = {user_id:user_id,level_id:level_id};
							xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
						}
					}
			});
		}
	}
	//changeTutorBadge
	function changeTutorBadge(user_id,img){
		var tutor_badge = [];
		$('.badge-checkbox:checked').each(function(){
			tutor_badge.push($(this).attr('data-id'));
		})
		if(tutor_badge.length != 0){
			bootbox.confirm({
					message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>Change tutor badges?</p></div>',
					callback: function(result) {
						if(result == true) {
							FUNCTION_NAME = 'changeTutorBadgeAjax';
							PARAM  = {user_id:user_id,tutor_badge:tutor_badge};
							xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
						}
					}
			});
		}
	}
/*#############################################################################################################################################*/
//01: changeUserAccessLevel
function changeUserAccessLevel(img,user_id,status,msg) {
    bootbox.confirm({
			message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>'+msg+'</p></div>',
			callback: function(result) {
				if(result == true) {
					FUNCTION_NAME = 'changeUserAccessLevelAjax';
					PARAM  = {user_id:user_id,status:status};
					xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
				}
			}
    }); 
}
/*#############################################################################################################################################*/
	$('.user-details-image').click(function(){
		var src = $(this).attr('src');
		bootbox.alert({
			title: "User Image",
			message: "<img src="+src+" />",
			className: 'bb-alternate-modal'
		});
	})

/*------------ Defined Functions <End> ------------*/
	
/******************************************** MODULE 02: USERS <END> ***************************************************/

/******************************************** MODULE 03: LESSONS <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: sendEmail
		02: changeLessonStatus
		03: refund
		04: markAsPayed
------------ Function List <End>-----------------*/	
	//01: sendEmail
	function sendEmail(lesson_id,tutor_availability_id,lesson_code,lesson_date){
		$('.errorMsg').text('');
		var admin_message = $('#admin_message').val();
		var message_html = '<li class="admin_msg"><div class="message"><span class="arrow"> </span><a href="javascript:;" class="name">Admin</a><span class="body"> '+admin_message+' </span></div></li>';
		if(admin_message != ""){
			$('#chats ul.chats').append(message_html);
			$('#admin_message').val("");
			FUNCTION_NAME = 'sendEmailAjax';
			PARAM  = {lesson_id:lesson_id,tutor_availability_id:tutor_availability_id,lesson_code:lesson_code,lesson_date:lesson_date,admin_message:admin_message};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
/*#############################################################################################################################################*/
	//02: changeLessonStatus
	function changeLessonStatus(lesson_id,tutor_availability_id,lesson_code,lesson_date,status,img,msg) {
		bootbox.confirm({
				message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>'+msg+'</p></div>',
				callback: function(result) {
					if(result == true) {
						FUNCTION_NAME = 'changeLessonStatusAjax';
						PARAM  = {lesson_id:lesson_id,tutor_availability_id:tutor_availability_id,lesson_code:lesson_code,lesson_date:lesson_date,status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
		}); 
	}
/*#############################################################################################################################################*/
	//03: refund
	function refund(lesson_id,transaction_id,tutor_availability_id,lesson_code,lesson_date,img,msg,transaction_amount,student_id) {
		bootbox.confirm({
				message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>'+msg+'</p></div>',
				callback: function(result) {
					if(result == true) {
						FUNCTION_NAME = 'refundAjax';
						PARAM  = {lesson_id:lesson_id,transaction_id:transaction_id,tutor_availability_id:tutor_availability_id,lesson_code:lesson_code,lesson_date:lesson_date,transaction_amount:transaction_amount,student_id:student_id};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
		}); 
/*		bootbox.confirm({
			title: "This can't be undone!",
			message: '<div class="row">'+
						'<div class="col-sm-12"><label>Refund Amount *</label><input type="text" class="form-control profile_fields" id="refunded_amount" /></div>'+
					 '</div><div class="errorMsg" style="color:red"></div>',
			callback: function(result) {
				var refunded_amount = $('#refunded_amount').val();
				if(result == true) {
					if(refunded_amount === ""){
						$('.errorMsg').text("Refund amount is required");
						return false;
					}
					if(!validateNumber(refunded_amount)){
						$('.errorMsg').text("Refund amount is not valid");
						return false;
					}
					FUNCTION_NAME = 'refundAjax';
					PARAM  = {transaction_id:transaction_id,reservation_id:reservation_id,refunded_amount:refunded_amount};
					xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
				}
			}
		})*/
	}
/*#############################################################################################################################################*/
	//01: markAsPayed
	function markAsPayed(lesson_id,tutor_availability_id,lesson_code,lesson_date,img,transaction_amount) {
		bootbox.confirm({
			title: "Mark as Paid",
			message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block img-circle"><div class="col-sm-6" style="float: none; margin: 0 auto;"><div class="form-group form-md-line-input form-md-floating-label">'+
				'<input type="text" class="form-control text-center edited" id="payment_amount"><label for="payment_amount">Input Transfer Amount (£)</label>'+
				'<span class="help-block text-center" style="width: 100%;">Amount cannot exceed £'+transaction_amount+'</span></div></div><div class="form-group errorMsg" style="color:red"></div><p>Are you sure you want to transfer this amount?</p></div>',
			callback: function(result) {
				var payment_amount = $('#payment_amount').val();
				if(result == true) {
					if(payment_amount === ""){
						$('.errorMsg').text("Amount is required field");
						return false;
					} else if(!validateFloat(payment_amount)){
						$('.errorMsg').text("Amount should be numeric");
						return false;
					} else if(payment_amount > parseFloat(transaction_amount)){
						$('.errorMsg').text("Amount exceeded from limit");
						return false;
					}
					FUNCTION_NAME = 'markAsPayedAjax';
					PARAM  = {lesson_id:lesson_id,tutor_availability_id:tutor_availability_id,lesson_code:lesson_code,lesson_date:lesson_date,payment_amount:payment_amount};
					xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
				}
			}
		})
	}
/*#############################################################################################################################################*/
	function lessonFilter(){
		var lesson_filter = $('#lesson_filter option:selected').val();
		var root_address = window.location.href.split('?')[0];
		var url = root_address+'?lesson='+lesson_filter;
		location.href = url;
	}
/*#############################################################################################################################################*/

/*------------ Defined Functions <End> ------------*/
	
/******************************************** MODULE 03: LESSONS <END> ***************************************************/

/******************************************** MODULE 04: REVIEWS <START> ***************************************************/

/*------------ Defined Functions <Start> ------------*/

/*------------ Function List <Start>-----------------
		01: changeReviewStatus
		02: Review in modal
		03: sendEmail
------------ Function List <End>-----------------*/	

	//01: changeReviewStatus
	function changeReviewStatus(img,review_id,status,msg) {
		bootbox.confirm({
				message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>'+msg+'</p></div>',
				callback: function(result) {
					if(result == true) {
						FUNCTION_NAME = 'changeReviewStatusAjax';
						PARAM  = {review_id:review_id,status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
		}); 
	}
	//02: Review in modal
	$('.review-text').click(function(){
		var msg = $(this).attr('data-review');
		bootbox.alert({
			title: "Text",
			message: msg,
		});
	})
/*#############################################################################################################################################*/

/*------------ Defined Functions <End> ------------*/

/******************************************** MODULE 04: REVIEWS <END> ***************************************************/
/******************************************** MODULE 05: PAGES <START> ***************************************************/
	function editPage(page_id){
		//clear .errorMsg area
		$('.errorMsg').text('');	
		var error_flag = false;
		//get form values
			var content = new nicEditors.findEditor('page_content').getContent();
		if(!content){
			$('.errorMsg').text("Type page content");
			error_flag = true;
		} else if(error_flag == false) {
			FUNCTION_NAME = 'editPageAjax';
			PARAM  = {page_id:page_id,content:content};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	}
	function addPageHeading(page_id){
		bootbox.confirm({
			title: "Add Page Heading",
			message: '<div class="row">'+
						'<div class="col-sm-12"><label>Heading *</label><input class="form-control" id="page_heading"></div>'+
					 '</div><div class="errorMsg" style="color:red"></div>',
			callback: function(result) {
				var page_heading = $('#page_heading').val();
				if(result == true) {
					if(page_heading === ""){
						$('.errorMsg').text("Page heading is required field");
						return false;
					}
					FUNCTION_NAME = 'addPageHeadingAjax';
					PARAM  = {page_id:page_id,page_heading:page_heading};
					xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
				}
			}
		})
	}
	function deleteHeadings(img,id,status,msg,page_id){
		bootbox.confirm({
				message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>'+msg+'</p></div>',
				callback: function(result) {
					if(result == true) {
						FUNCTION_NAME = 'changePageHeadingStatusAjax';
						PARAM  = {id:id,status:status,page_id:page_id};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
		}); 
	}
	function addFaqs(){
		bootbox.confirm({
			title: "Add FAQs",
			message: '<div class="row">'+
						'<div class="col-sm-12"><label>Page Heading *</label><select class="form-control" id="page_heading_select2">'+$("#page_heading_select").html()+'</select></div>'+
						'<div class="col-sm-12"><label>Question *</label><input class="form-control" id="page_question"></div>'+
						'<div class="col-sm-12"><label>Answer *</label><input class="form-control" id="page_answer"></div>'+
					 '</div><div class="errorMsg" style="color:red"></div>',
			callback: function(result) {
				var faq_heading_id = $('#page_heading_select2 option:selected').val();
				var page_question = $('#page_question').val();
				var page_answer = $('#page_answer').val();
				if(result == true) {
					if(faq_heading_id == 0){
						$('.errorMsg').text("Page heading is required field");
						return false;
					} else if(page_question === ""){
						$('.errorMsg').text("Question is required field");
						return false;
					} else if (page_answer === ""){
						$('.errorMsg').text("Answer is required field");
						return false;						
					}
					FUNCTION_NAME = 'addFaqsAjax';
					PARAM  = {faq_heading_id:faq_heading_id,page_question:page_question,page_answer:page_answer};
					xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
				}
			}
		})
	}
	function deleteFaq(img,id,status,msg,page_id){
		bootbox.confirm({
				message: '<div class="modal-body text-center"><img src="'+img+'" class="img-responsive center-block"><p>'+msg+'</p></div>',
				callback: function(result) {
					if(result == true) {
						FUNCTION_NAME = 'changeFaqStatusAjax';
						PARAM  = {id:id,status:status};
						xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
					}
				}
		}); 
	}
	function editSettings(){
		//clear .errorMsgSettings area
		$('.errorMsgSettings').text('');
		
		//get form values
		var contact_email = $('#editSettingsForm input[name=contact_email]').val();
		var stripe_pub = $('#editSettingsForm input[name=stripe_pub]').val();
		var stripe_secret = $('#editSettingsForm input[name=stripe_secret]').val();
		var error_flag = false;
		
		if (!contact_email) {
			$('.errorMsgSettings').text('Please enter your email address');
			error_flag = true;		
		} else if( !validateEmail(contact_email)){
			$('.errorMsgSettings').text('Please enter a valid email address');
			error_flag = true;
		} else if (!stripe_pub) {
			$('.errorMsgSettings').text('Please enter stripe publish key');
			error_flag = true;
		} else if (!stripe_secret) {
			$('.errorMsgSettings').text('Please enter stripe secret key');
			error_flag = true;
		} else if(error_flag == false) {
			FUNCTION_NAME = 'editSettingsAjax';
			PARAM  = {contact_email:contact_email,stripe_pub:stripe_pub,stripe_secret:stripe_secret};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	
	}
	
	function editTierConfig(){
		//clear .errorMsgTier area
		$('.errorMsgTier').text('');
		
		//get form values
		var default_tier = $('input[name=default_tier]:checked', '#editTierSettings').val();
		var tier_rates = new Array();
		var error_flag = false;
		$('.tier_rate').each(function (i) {
			var rate = $(this).val();
			var tier_id = $(this).attr('id');
			if (!rate) {
				$('.errorMsgTier').text('Please enter required field');
				error_flag = true;	
				return false;				
			} else if(!validateFloat(rate)){
				$('.errorMsgTier').text("Charge rate value should be numeric");
				error_flag = true;		
				return false;
			} else {
                tier_rates.push(tier_id);
				tier_rates.push(rate);
			}
        });
		console.log(default_tier);
		console.log(tier_rates);
		 if(error_flag == false) {
			FUNCTION_NAME = 'editTierConfigAjax';
			PARAM  = {default_tier:default_tier,tier_rates:tier_rates};
			xajax_MGRequestAjax(FUNCTION_NAME,PARAM);
		}
	
	}

	
/******************************************** MODULE 05: PAGES <END> ***************************************************/

/* End of file script.js */
/* Location: ./application/assets/frontend/js/script.js */