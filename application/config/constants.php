<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/*
|--------------------------------------------------------------------------
| DIRECTORY STRUCTURE <Start>
|--------------------------------------------------------------------------
*/
$PROJECT_URL = str_replace("index.php","",$_SERVER['PHP_SELF']);
if($_SERVER['HTTP_HOST']=="localhost") {
    define('SERVER_NAME',	'https://'.$_SERVER['SERVER_NAME'].$PROJECT_URL);
    define('ASSET_FRONTEND_UPLOADS_PATH', $_SERVER['DOCUMENT_ROOT'].$PROJECT_URL.'assets/frontend/uploads/');
    define('ASSET_BACKEND_UPLOADS_PATH', $_SERVER['DOCUMENT_ROOT'].$PROJECT_URL.'assets/backend/uploads/');
}else {
    define('SERVER_NAME',	'https://'.$_SERVER['SERVER_NAME'].'/');
    define('ASSET_FRONTEND_UPLOADS_PATH', $_SERVER['DOCUMENT_ROOT'].'/assets/frontend/uploads/');
    define('ASSET_BACKEND_UPLOADS_PATH', $_SERVER['DOCUMENT_ROOT'].'/assets/backend/uploads/');
}

//Frontend
define('ASSET_FRONTEND_DIR',				SERVER_NAME. 'assets/frontend/');
define('ASSET_CSS_FRONTEND_DIR',			ASSET_FRONTEND_DIR.'css/');
define('FRONTEND_ASSET_IMAGES_DIR',			ASSET_FRONTEND_DIR.'images/');
define('ASSET_JS_FRONTEND_DIR',		    	ASSET_FRONTEND_DIR.'js/');
define('ASSET_UPLOADS_FRONTEND_DIR',		ASSET_FRONTEND_DIR.'uploads/');

//Backend
define('ASSET_BACKEND_DIR',				SERVER_NAME. 'assets/backend/');
define('ASSET_CSS_BACKEND_DIR',			ASSET_BACKEND_DIR.'css/');
define('ASSET_IMAGES_BACKEND_DIR',			ASSET_BACKEND_DIR.'images/');
define('ASSET_JS_BACKEND_DIR',		    	ASSET_BACKEND_DIR.'js/');
define('ASSET_UPLOADS_BACKEND_DIR',		ASSET_BACKEND_DIR.'uploads/');
define('ASSET_USERS_UPLOADS_BACKEND_DIR',		ASSET_BACKEND_DIR.'uploads/users/');
define('ASSET_GENERIC_UPLOADS_BACKEND_DIR',		ASSET_BACKEND_DIR.'uploads/generic/');

/*
|--------------------------------------------------------------------------
| DIRECTORY STRUCTURE <End>
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| FACEBOOK <Start>
|--------------------------------------------------------------------------
*/


if($_SERVER['HTTP_HOST']=="localhost") {
    define('FB_APP_ID',	'235254706946670');
    define('FB_SECRET_KEY', '33b587dfc0dbe46dffb1525de06cae1d');
}else {
    define('FB_APP_ID',	'235254706946670');
    define('FB_SECRET_KEY', '33b587dfc0dbe46dffb1525de06cae1d');

}
define('FB_COOKIE', true);
define('SERVER_PATH', '');
define('FB__PAGE_URL', '');
define('FB_APP_PATH', FB__PAGE_URL."?sk=app_".FB_APP_ID);
define('FB_APP_TERMS_AND_CONDITIONS_URL', '');
//Re-Direct URLs
define('REGISTRATION_URL', SERVER_NAME.'login');
define('LOGOUT_URL', SERVER_NAME);

define('FB_APP_CANCEL_URL', 'https://www.facebook.com/');
define('FB_APP_REQUEST_PERMISSIONS', '');
define('FB_BASE_URL', "https://www.facebook.com/");

/*
|--------------------------------------------------------------------------
| FACEBOOK <End>
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| STRIPE PAYMENTS <Start>
|--------------------------------------------------------------------------
*/

define('STRIPE_SECRET_KEY_TEST', 'sk_test_Mt9jafYRxsj7MyxtwOVvh94c');
define('STRIPE_PUBLISH_KEY_TEST',	'pk_test_vLKLSKKOPWnLTKrmWn723mrq');
define('STRIPE_SECRET_KEY_LIVE', 'sk_live_OzI963EByDthIy44nHKVFlbW');
define('STRIPE_PUBLISH_KEY_LIVE',	'pk_live_mUy6SNAAje8k4oN9TVMieoQz');
define('STRIPE_MODE', 'test');
define('STRIPE_CURRENCY', 'gbp');

/*
|--------------------------------------------------------------------------
| STRIPE PAYMENTS <End>
|--------------------------------------------------------------------------
*/

//*************** CONSTANTS FOR TWILIO ***********************//

define('TWILIO_SID','AC8b8d93ff5d4c25a96829afd068830449');
define('TWILIO_TOKEN','64f82b0d4660f6575b8b0fc3dc627f8c');
define('TWILIO_PHONE_NUMBER','+12566641572');
define('RECEIVER_PHONE_NUMBER','+923239941345');
define('TWILIO_DEFAULT_CODE', 'CPuy');

//*************** CONSTANTS FOR TWILIO END ***********************//



/*
|--------------------------------------------------------------------------
| MAILGUN <Start>
|--------------------------------------------------------------------------
*/
define('MAILGUN_API_KEY', 'key-e3375ef5b386b9c24e5349f6de243c85');
/*
|--------------------------------------------------------------------------
| MAILGUN <End>
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| PAGINATION <Start>
|--------------------------------------------------------------------------
*/

define('ROWS_PER_PAGE', 12);
define('DASHBOARD_ROWS_PER_PAGE', 20);

/*
|--------------------------------------------------------------------------
| PAGINATION <End>
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| GENERIC <Start>
|--------------------------------------------------------------------------
*/

// Website Mode
if($_SERVER['HTTP_HOST']=="localhost") {
    define('WEBSITE_MODE',	'dev');
}else {
    define('WEBSITE_MODE',	'live');
}
//Website
define('WEBSITE_NAME', 'Open Mind Tutors');
define('WEBSITE_URL', 'openmindtutors.co.uk');
define('WEBSITE_COOKIE', 'open-mind-tutors-auth');
define('WEBSITE_BACKEND_COOKIE', 'open-mind-tutors-bacnkend-auth');
define('WEBSITE_FRONTEND_SESSION', 'open-mind-tutors-frontend-id');
define('WEBSITE_FRONTEND_ACCESS_TYPE', 'open-mind-tutors-frontend-access-type');
define('WEBSITE_BACKEND_SESSION', 'open-mind-tutors-backend-id');
define('WEBSITE_LOGO', FRONTEND_ASSET_IMAGES_DIR.'website-logo.png');

// Encryption Key
define('ENCRYPTION_KEY', 'OMT_9345');
//User Types
define('TUTOR', '1');
define('STUDENT', '2');

//Currency
define('CURRENCY', 'gbp');
define('CURRENCY_SYMBOL', '£');

//MAX_DISTANCE
define('MAX_DISTANCE', '25');

//Messsage Status Types
define('SEEN', '1');
define('UNSEEN', '0');

//PAGE IDS
define('TERMS_CONDITIONS_ID', '1');
define('PRIVACY_POLICY_ID','2');
define('TUTOR_FAQS_ID', '3');
define('STUDENT_FAQS_ID','4');
define('BECOME_TUTOR_ID', '5');
define('HOW_WORKS_TUTOR_ID','6');
define('HOW_WORKS_STUDENT_ID','7');
define('OUR_TEAM_ID','8');

//Transaction Sender Types
define('GUEST_SENDER_TYPE', '1');
define('ADMIN_SENDER_TYPE','2');

//EDUCATION INDEX TYPE
define('UNIVERSITY', '0');
define('COLLEGE','1');
define('SCHOOL','2');

//Total REVIEWS
define('TOTAL_RATINGS', '6');
define('RATING_WITHOUT_HOST', '5');

//Transaction Types
define('TRANSFERRED_BY_GUEST', '1');
define('REFUNDED', '2');
define('ONHOLD', '3');
define('TRANSFERRED_BY_ADMIN', '4');

//WEEK
define('WEEK', '518400');

//SETTING STYOE
define('LIVE_STATUS', '1');
define('LIVE_EMAIL', '2');
define('LIVE_STRIPE', '3');

//ACCOUNT TYPE
define('EMAIL_ACCOUNT_TYPE', '1');
define('FACEBOOK_ACCOUNT_TYPE', '2');

//BOOK LESSON STATUS
define('PENDING', '1');
define('CANCELED', '2');
define('APPROVED', '3');
define('PENDING_APPROVAL', '4');
define('DISPUTED', '5');
define('COMPLETED', '6');

// TESTING LOGIN EMAIL
define('ADMIN_EMAIL', 'shahan.ahmed@appstersinc.com');
define('NO_REPLY', 'no-reply@openmindtutors.co.uk');
define('CONTACT_EMAIL', 'info@openmindtutors.co.uk');

//Admin Roles
define('SUPER_ADMIN', '1');
define('ADMIN', '2');

define('HOMEPAGE_TUTORS', '8');

//Level
define('TEACHER_FIRST_LEVEL', '30');
define('TEACHER_FIRST_GROUP_LEVEL', '35');
define('STUDENT_FIRST_LEVEL', '35');
define('OPEN_STAR', '1');
define('TIER', '2');
define('STUDENT_LEVEL_FIRST', 'Level A');
define('STUDENT_LEVEL_SECOND', 'Level B');
define('STUDENT_LEVEL_THIRD', 'Level C');
define('STUDENT_LEVEL_FORTH', 'Level D');
define('STUDENT_LEVEL_FIFTH', 'Bronze');
define('STUDENT_LEVEL_FIFTH_ID', '5');

//Available type
define('SINGLE_AVAILABLE', '1');
define('GROUP_AVAILABLE', '2');

//Status Ids
define('APPROVAL_STATUS_ID', '3');
define('DELETED_STATUS_ID', '2');
define('ACTIVE_STATUS_ID', '1');
define('INACTIVE_STATUS_ID', '0');
define('DISABLED_STATUS_ID', '4');
// reviews
define('REJECTED_STATUS_ID', '3');
//TITLES
define('TITLES',serialize (array (1=>"Mr",2=>"Mrs",3=>"Miss",4=>"Ms",5=>"Dr")));
//Days
define('DAYS',serialize (array (0=>"Sunday",1=>"Monday",2=>"Tuesday",3=>"Wednesday",4=>"Thursday",5=>"Friday",6=>"Saturday")));
/*TIMES
define('TIMES',serialize (array ('1:00-2:00'=>"1:00 am - 2:00 am",'2:00-3:00'=>"2:00 am - 3:00 am",'3:00-4:00'=>"3:00 am - 4:00 am",'4:00-5:00'=>"4:00 am - 5:00 am",
	'5:00-6:00'=>"5:00 am - 6:00 am",'6:00-7:00'=>"6:00 am - 7:00 am",'7:00-8:00'=>"7:00 am - 8:00 am",'8:00-9:00'=>"8:00 am - 9:00 am",'9:00-10:00'=>"9:00 am - 10:00 am",
	'10:00-11:00'=>"10:00 am - 11:00 am",'11:00-12:00'=>"11:00 am - 12:00 pm",'12:00-13:00'=>"12:00 pm - 1:00 pm",'13:00-14:00'=>"1:00 pm - 2:00 pm",'14:00-15:00'=>"2:00 pm - 3:00 pm",
	'15:00-16:00'=>"3:00 pm - 4:00 pm",'16:00-17:00'=>"4:00 pm - 5:00 pm",'17:00-18:00'=>"5:00 pm - 6:00 pm",'18:00-19:00'=>"6:00 pm - 7:00 pm",'19:00-20:00'=>"7:00 pm - 8:00 pm",
	'20:00-21:00'=>"8:00 pm - 9:00 pm",'21:00-22:00'=>"9:00 pm - 10:00 pm",'22:00-23:00'=>"10:00 pm - 11:00 pm",)));
*/
//TIMES
define('TIMES',serialize (array ('5:00-6:00'=>"5:00 am - 6:00 am",'6:00-7:00'=>"6:00 am - 7:00 am",'7:00-8:00'=>"7:00 am - 8:00 am",'8:00-9:00'=>"8:00 am - 9:00 am",'9:00-10:00'=>"9:00 am - 10:00 am",
    '10:00-11:00'=>"10:00 am - 11:00 am",'11:00-12:00'=>"11:00 am - 12:00 pm",'12:00-13:00'=>"12:00 pm - 1:00 pm",'13:00-14:00'=>"1:00 pm - 2:00 pm",'14:00-15:00'=>"2:00 pm - 3:00 pm",
    '15:00-16:00'=>"3:00 pm - 4:00 pm",'16:00-17:00'=>"4:00 pm - 5:00 pm",'17:00-18:00'=>"5:00 pm - 6:00 pm",'18:00-19:00'=>"6:00 pm - 7:00 pm",'19:00-20:00'=>"7:00 pm - 8:00 pm",
    '20:00-21:00'=>"8:00 pm - 9:00 pm",'21:00-22:00'=>"9:00 pm - 10:00 pm",'22:00-23:00'=>"10:00 pm - 11:00 pm",'23:00-24:00'=>"11:00 pm - 12:00 am",'24:00-1:00'=>"12:00 am - 1:00 am",'1:00-2:00'=>"1:00 am - 2:00 am",'2:00-3:00'=>"2:00 am - 3:00 am",'3:00-4:00'=>"3:00 am - 4:00 am",'4:00-5:00'=>"4:00 am - 5:00 am",)));
//Distance
define('DISTANCE',serialize (array (1=>"1 Mile",2=>"2 Miles",3=>"3 Miles",4=>"3 Miles",5=>"5 Miles",6=>"6 Miles",7=>"7 Miles",8=>"8 Miles",9=>"9 Miles",
    10=>"10 Miles",11=>"11 Miles",12=>"12 Miles",13=>"13 Miles",14=>"14 Miles",15=>"15 Miles",16=>"16 Miles",17=>"17 Miles",18=>"18 Miles",19=>"19 Miles",20=>"20 Miles",
    21=>"21 Miles",22=>"22 Miles",23=>"23 Miles",24=>"24 Miles",25=>"25 Miles")));
// Time
/*
define('TIMES',serialize (array (1=>"00:00",2=>"00:30",3=>"01:00",4=>"01:30",5=>"02:00",6=>"02:30",7=>"03:00",8=>"03:30",9=>"04:00",10=>"04:30",11=>"05:00",12=>"05:30",
			13=>"06:00",14=>"05:30",15=>"06:00",16=>"06:30",17=>"07:00",18=>"07:30",19=>"08:00",20=>"08:30",21=>"09:00",22=>"09:30",23=>"10:00",24=>"10:30",25=>"11:00",26=>"11:30",
			27=>"12:00",28=>"12:30",29=>"13:00",30=>"13:30",31=>"14:00",32=>"14:30",33=>"15:00",34=>"15:30",35=>"16:00",36=>"16:30",37=>"17:00",38=>"17:30",39=>"18:00",40=>"18:30",
			41=>"19:00",42=>"19:30",43=>"20:00",44=>"20:30",45=>"21:00",46=>"21:30",47=>"22:00",48=>"22:30",49=>"23:00")));
*/
//Gender
define('MALE', '1');
define('FEMALE', '2');

define('ACCESS_TYPE_LIMITED', '0');
define('ACCESS_TYPE_FULL', '1');
define ('DEFAULT_ACCESS_TYPE',ACCESS_TYPE_LIMITED);

define('FEATURED_STATUS_ID', '1');

define('CONFRIMATION_CODE', '1');
define('RESET_CODE', '2');

define('CODE_EXPIRY_TIME', '86400'); //1 day in seconds
define('PACKAGE_EXPIRY', '2592000'); //1 day in seconds

define('RANDOM_CODE_LENGTH',6);
define('MIN_PASSWORD_LENGTH', 6);

define('INTERVAL',serialize (array (1=>"WEEK",2=>"MONTH",3=>"YEAR")));

//TimThumb
define('TIMTHUMB',		SERVER_NAME.'application/views/timthumb.php');

//Email Types
/*
|--------------------------------------------------------------------------
| GENERIC <End>
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| ROUTES <Start> FRONT-END
|--------------------------------------------------------------------------
*/


/*HOMEPAGE MODULE ROUTES START*/
define('SERVER_URL', SERVER_NAME);
/*HOMEPAGE MODULE ROUTES END*/

/*LOGIN ROUTES START */
define('ROUTE_LOGIN', SERVER_URL.'sign-in');
define('ROUTE_REGISTER', SERVER_URL.'sign-up');
define('ROUTE_FORGOT_PASSWORD', SERVER_URL.'forgot-password');
define('ROUTE_FIRST_LOGIN', SERVER_URL.'verification');
/*LOGIN ROUTES <END>

/*PROFILE ROUTES START */
define('ROUTE_PROFILE', SERVER_URL.'edit-profile');
define('ROUTE_TUTOR_PUBLIC_PROFILE', SERVER_URL.'tutor-public-profile');
define('ROUTE_CHANGE_PASSWORD', SERVER_URL.'change-password');
define('ROUTE_TUTOR_LEVEL', SERVER_URL.'tutor-level');
define('ROUTE_STUDENT_PROFILE_VIEW', SERVER_URL.'student');
define('ROUTE_ACCOUNT_SETTINGS', SERVER_URL.'account-settings');
/*PROFILE ROUTES <END>

/*SEARCH MODULE START*/
define('ROUTE_SEARCH', SERVER_URL.'search-list');
define('ROUTE_SEARCH_DETAIL', SERVER_URL.'tutor');
define('ROUTE_TUTOR_PROFILE', SERVER_URL.'tutor-profile');
/*SEARCH MODULE END*/

/*LESSONS MODULE START*/
define('ROUTE_LESSONS', SERVER_URL.'lessons');
define('ROUTE_LESSON_DETAILS', SERVER_URL.'lesson-detail');
/*LESSONS MODULE END*/

/*MESSAGES MODULE START*/
define('ROUTE_MESSAGES', SERVER_URL.'messages');
define('ROUTE_MESSAGE_HISTORY', SERVER_URL.'message-history');
/*MESSAGES MODULE END*/

/*PAYMENTS MODULE START*/
define('ROUTE_PAYMENTS_HISTORY', SERVER_URL.'payments-history');
define('ROUTE_PAYMENTS_DETAILS', SERVER_URL.'payments-details');
define('ROUTE_ADD_PAYMENTS', SERVER_URL.'add_Payments');
/*PAYMENTS MODULE END*/

/*PAGES MODULE START*/
define('ROUTE_BROWSE_SUBJECTS', SERVER_URL.'browse-subjects');
define('ROUTE_BROWSE_AREAS', SERVER_URL.'browse-areas');
define('ROUTE_CONTACT_US', SERVER_URL.'contact-us');
define('ROUTE_PRIVACY_POLICY', SERVER_URL.'privacy-policy');
define('ROUTE_TERMS_AND_CONDITIONS', SERVER_URL.'terms-and-conditions');
define('ROUTE_HOW_IT_WORKS', SERVER_URL.'how-it-works');
define('ROUTE_BECOME_TUTOR', SERVER_URL.'become-tutor');
define('ROUTE_TUTOR_FAQS', SERVER_URL.'tutor-faqs');
define('ROUTE_STUDENT_FAQS', SERVER_URL.'student-faqs');
define('ROUTE_OUR_TEAM', SERVER_URL.'our-team');

/*PAGES MODULE END*/

/*ERROR MODULE START*/
define('ROUTE_ERROR_PAGE', SERVER_URL.'error');
/*ERROR MODULE END*/

/*
|--------------------------------------------------------------------------
| ROUTES <End> FRONT-END
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| ROUTES <Start> BACK-END
|--------------------------------------------------------------------------
*/

/*LOGIN MODULE ROUTES START*/
define('BACKEND_SERVER_URL', SERVER_URL.'admin/');
/*LOGIN MODULE ROUTES END*/

/*USER MODULE ROUTES START*/
define('BACKEND_STUDENTS_URL', BACKEND_SERVER_URL.'students');
define('BACKEND_STUDENT_DEATILS_URL', BACKEND_SERVER_URL.'student-details');
define('BACKEND_TUTOR_DEATILS_URL', BACKEND_SERVER_URL.'tutor-details');
define('BACKEND_TUTORS_URL', BACKEND_SERVER_URL.'tutors');
define('BACKEND_ADMINS_URL', BACKEND_SERVER_URL.'admins');
define('BACKEND_ADMIN_CREATE', BACKEND_SERVER_URL.'admin-create');
define('BACKEND_ADMIN_ADD_REQUEST', BACKEND_SERVER_URL.'admin-add-request');
/*USER MODULE ROUTES END*/

/*LESSONS MODULE ROUTES START*/
define('BACKEND_LESSONS_REQUESTS_URL', BACKEND_SERVER_URL.'lessons-requests');
define('BACKEND_LESSON_DETAILS_URL', BACKEND_SERVER_URL.'lesson-details');
/*LESSONS MODULE ROUTES END*/

/*PAYMENTS MODULE ROUTES START*/
define('BACKEND_STUDENTS_PAYMENTS_URL', BACKEND_SERVER_URL.'student-payments');
define('BACKEND_ADMIN_PAYMENTS_URL', BACKEND_SERVER_URL.'admin-payments');
define('BACKEND_STUDENT_PAYMENT_HISTORY_URL', BACKEND_SERVER_URL.'student-payment-history');
define('BACKEND_TUTOR_PAYMENT_HISTORY_URL', BACKEND_SERVER_URL.'tutor-payment-history');
/*PAYMENTS MODULE ROUTES END*/

/*REVIEWS MODULE ROUTES START*/
define('BACKEND_REVIEWS_URL', BACKEND_SERVER_URL.'reviews');
define('BACKEND_REVIEW_DETAILS_URL', BACKEND_SERVER_URL.'review-details');
/*REVIEWS MODULE ROUTES END*/

/*PROFILE MODULE ROUTES START*/
define('BACKEND_PROFILE_URL', BACKEND_SERVER_URL.'profile');
/*PROFILE MODULE ROUTES END*/

/*PAGES MODULE START*/
define('BACKEND_PAGES_URL', BACKEND_SERVER_URL.'static-page');
define('BACKEND_FAQ_PAGES_URL', BACKEND_SERVER_URL.'faq-page');
define('BACKEND_SETTINGS_URL', BACKEND_SERVER_URL.'settings');
/*PAGES MODULE END*/

/*TUTOR REPORT START*/
define('BACKEND_TUTORS_REPORT', BACKEND_SERVER_URL.'tutors-report');
define('BACKEND_STUDENTS_REPORT', BACKEND_SERVER_URL.'students-report');



/*TUTOR REPORT END*/

/*
|--------------------------------------------------------------------------
| ROUTES <End> BACK-END
|--------------------------------------------------------------------------
*/

/* End of file constants.php */
/* Location: ./application/config/constants.php */
