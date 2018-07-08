<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'frontend/surveys/error_page';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['404_override'] = 'common/show_error';
/*
|--------------------------------------------------------------------------
| ROUTES <Start> FRONT-END
|--------------------------------------------------------------------------
*/

/*HOMEPAGE MODULE START*/
$route['default_controller'] =   "main";
$route['levels_ajax'] =   "common/levels_ajax";
$route['subjects_ajax'] =   "common/subjects_ajax";
$route['postal_ajax'] =   "common/postal_ajax";
/*HOMEPAGE MODULE END*/

/*LOGIN MODULE START*/
$route['sign-in'] =   "frontend/login/login";
$route['sign-up'] =   "frontend/login/register";
$route['forgot-password'] =   "frontend/login/forgotPassword";
$route['verification/(:any)'] =   "frontend/login/verification/$1";
/*LOGIN MODULE END*/

/*PROFILE MODULE START*/
$route['edit-profile'] =   "frontend/profile/index";
$route['change-password'] =   "frontend/profile/changePassword";
$route['tutor-level'] =   "frontend/profile/level";
$route['tutor-public-profile'] =   "frontend/profile/tutorPublicProfile";
$route['editProfileAjax'] =   "frontend/profile/editProfileAjax";
$route['saveTutorProfileAjax'] =   "frontend/profile/saveTutorProfileAjax";
$route['student/(:any)/(:num)'] =   "frontend/profile/studentProfile/$1/$2";
$route['account-settings'] =   "frontend/profile/accountSettings";
$route['saveInfoFile'] =   "frontend/profile/saveInfoFile";
/*PROFILE MODULE END*/

/*SEARCH MODULE START*/
$route['search-list'] =   "frontend/search/index";
$route['tutor/(:any)/(:num)'] =   "frontend/search/searchDetail/$1/$2";
$route['tutor-profile/(:any)/(:num)'] =   "frontend/profile/tutorProfile/$1/$2";
/*SEARCH MODULE END*/

/*LESSONS MODULE START*/
$route['lessons'] =   "frontend/lessons/index";
$route['lesson-detail/(:num)'] =   "frontend/lessons/lessonDetails/$1";
/*LESSONS MODULE END*/

/*MESSAGES MODULE START*/
$route['messages'] =   "frontend/message/index";
$route['message-history/(:num)'] =   "frontend/message/messageHistory/$1";
/*MESSAGES MODULE END*/

/*PAYMENTS MODULE START*/
$route['payments-history'] =   "frontend/payment/index";
$route['add_Payments/(:num)'] =   "frontend/payment/add_Payments/$1";
$route['payments-details'] =   "frontend/payment/paymentDetails";
/*PAYMENTS MODULE END*/

/*PAGES MODULE START*/
$route['browse-subjects'] =   "frontend/pages/browseSubjects";
$route['browse-areas'] =   "frontend/pages/browseAreas";
$route['contact-us'] =   "frontend/pages/contact";
$route['privacy-policy'] =   "frontend/pages/privacyPolicy";
$route['terms-and-conditions'] =   "frontend/pages/termAndConditions";
$route['how-it-works'] =   "frontend/pages/howItWorks";
$route['become-tutor'] =   "frontend/pages/becomeTutor";
$route['tutor-faqs'] =   "frontend/pages/tutorFaqs";
$route['student-faqs'] =   "frontend/pages/studentFaqs";
$route['our-team'] =   "frontend/pages/ourTeam";

/*PAGES MODULE END*/

/*ERROR MODULE START*/
$route['error'] =   "frontend/login/show_404";
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

/*LOGIN MODULE START*/
$route['admin'] =   "backend/login";
/*LOGIN MODULE END*/

/*USERS MODULE START*/
$route['admin/students']    	=   "backend/users/students";
$route['admin/student-details/(:num)']    	=   "backend/users/studentDetails/$1";
$route['admin/tutors']    	=   "backend/users/tutors";
$route['admin/admins']    	=   "backend/admins/admins";
$route['admin/admin-create']    	=   "backend/admins/adminCreate";
$route['admin/admin-add-request']    	=   "backend/admins/adminAddRequest";
$route['admin/tutor-details/(:num)']    	=   "backend/users/tutorDetails/$1";
/*USERS MODULE END*/

/*LESSONS MODULE START*/
$route['admin/lessons-requests']    	=   "backend/lessons";
$route['admin/lesson-details/(:num)']    	=   "backend/lessons/lessonDetails/$1";
/*LESSONS MODULE END*/

/*PAYMENTS MODULE START*/
$route['admin/student-payments']    	=   "backend/payments/students";
$route['admin/admin-payments']    	=   "backend/payments/adminPayments";
$route['admin/student-payment-history/(:num)']    	=   "backend/payments/studentPaymentHistory/$1";
$route['admin/tutor-payment-history/(:num)']    	=   "backend/payments/tutorPaymentHistory/$1";
/*PAYMENTS MODULE END*/

/*REVIEWS MODULE START*/
$route['admin/reviews']    	=   "backend/reviews";
$route['admin/review-details/(:num)']    	=   "backend/reviews/reviewDetails/$1";
/*REVIEWS MODULE END*/

/*PROFILE MODULE START*/
$route['admin/profile'] =   "backend/profile/profile";
$route['admin/editPicAjax'] =   "backend/profile/editPicAjax";
/*PROFILE MODULE END*/

/*PAGES MODULE START*/
$route['admin/static-page/(:num)']    	=   "backend/pages/index/$1";
$route['admin/faq-page/(:num)']    	=   "backend/pages/faqPage/$1";
$route['admin/settings']    	=   "backend/pages/settings";
/*PAGES MODULE END*/

/*TUTOR REPORT START*/
$route['admin/tutors-report']    	=   "backend/users/export_tutors_csv";
$route['admin/students-report']    	=   "backend/users/export_students_csv";
/*TUTOR REPORT END*/

/*
|--------------------------------------------------------------------------
| ROUTES <End> BACK-END
|--------------------------------------------------------------------------
*/


/* End of file routes.php */
/* Location: ./application/config/routes.php */
