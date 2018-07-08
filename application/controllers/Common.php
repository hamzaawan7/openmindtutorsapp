<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common extends CI_Controller {
	//------------ Global data <Start>-----------------//	
	public $common_data = array();
	//------------ Global data <Start>-----------------//	
	function __construct() {
		parent::__construct();	    
		//session_start();
		//I.E Fix: Holds SESSION accross the DOMAIN 
		header('P3P: CP="CAO PSA OUR"'); 	
		//------------ Model Functions <Start>-----------------//
		$this->load->model('frontend/user_model');
		$this->load->model('frontend/profile_model');
		$this->load->model('frontend/search_model');
		$this->load->model('frontend/reviews_model');
		$this->load->model('frontend/lesson_model');
		$this->load->model('frontend/payment_model');
		$this->load->model('frontend/message_model');
		$this->load->model('frontend/page_model');

		//------------ Model Functions <End>-----------------//	
				
		//------------ XAJAX <Start> -----------------//
		$this->xajax->registerFunction(array('logoutAjax', $this, 'logoutAjax'));
		$this->xajax->registerFunction(array('loginByFacebook', $this, 'loginByFacebook'));
		$this->xajax->registerFunction(array('MGRequestAjax', $this, 'MGRequestAjax'));
		//$this->xajax->registerFunction(array('LinkedinRequest', $this, 'LinkedinRequest'));
		$this->xajax->configure('javascript URI',base_url().'xajax' );
		$this->xajax->processRequest();
		$this->xajax_js = $this->xajax->getJavascript( base_url() ); 	
		//------------ XAJAX <End> -----------------//
		
		$this->output->enable_profiler(false);	                    
	}
	
	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	
	/*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01:MGRequestAjax
	02:logoutAjax
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 03: loginByFacebook
	 *
	 * This function is for Register/Login with facebook.
	 *
	 */
    public function loginByFacebook() {
		// Checking whether parametres are nullor not
			$objResponse = new xajaxResponse();
			//get user data from facebook
			$user_fb_data = fbh_initialize_fb_php();
			if(!empty($user_fb_data)) {
				$name = explode(' ',$user_fb_data['name']);
				$first_name = $name[0];
				$last_name = $name[1];
				$email = $user_fb_data['email'];
				$profile_image =  "http://graph.facebook.com/".$user_fb_data['id']."/picture?type=large";
				$fb_id = $user_fb_data['id'];
				$file_name = $fb_id.'.jpg';
				copy($profile_image,ASSET_FRONTEND_UPLOADS_PATH.'profile/'.$fb_id.'.jpg');
				//$role = $_SESSION['fb_role'];
				//login user 
				$userExist = $this->user_model->isUserEmailExist($email);
				
				$user_id = $this->user_model->loginByFacebook($fb_id,$first_name,$last_name,$email,$file_name);
				if($user_id) {
					$this->session->set_userdata(WEBSITE_FRONTEND_SESSION , $user_id);
					if(empty($userExist)) {
						$sender = NO_REPLY;
						$receiver = $email;
						$subject = "Account Confirmation";
						$msg = "Hello ".ucfirst($first_name)."!<br /><br />
									You have been successfully logged in to Open Mind Tutors. Please complete your profile by managing your profile and payment details.<br /><br />
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
						sendEmail($sender,$receiver,$msg,$subject);
						//Admin notification email
						//Admin notification email
						$sender1 = NO_REPLY;
						$settings = $this->user_model->getSiteSettings();
						$receiver1 = $settings['contact_email'];
						$subject1 = "New Account Pending Approval";
						$msg1 = "Hello Administrator!<br /><br />
									A new user has just registered on Open Mind Tutors through facebook.<br /><br />
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
						sendEmail($sender1,$receiver1,$msg1,$subject1);
						$objResponse->script('location.href="'.ROUTE_LESSONS.'"');
					} else {
						$objResponse->script('location.href="'.ROUTE_PROFILE.'"');
					}
					$this->session->unset_userdata('fb_role');
				}
			}
        return $objResponse;
    }

   /* --------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 03: loginByLinked
	 *
	 * This function is for Register/Login with LinkedIn.
	 *
	 */

     // public function LinkedinRequest(user){

     //     $objResponse = new xajaxResponse();
        
     // }












    /*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: MGRequestAjax
	 *
	 * This function is the calling point to every other ajax function 
	 *
	 */
	public function MGRequestAjax($functionName,$param=null) {
		$objResponse = new xajaxResponse();
		$objResponse = $this->$functionName($param);
        return $objResponse;   
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/	
	 /**
	* 02: logoutAjax
	*
	* This function is to logout admin
	*
	*/
	public function logoutAjax() { 
		$objResponse = new xajaxResponse();
		//unsetting user session
		setcookie(WEBSITE_COOKIE, "", time()-3600);
		$this->session->unset_userdata(WEBSITE_FRONTEND_SESSION);
		$this->session->unset_userdata(WEBSITE_FRONTEND_ACCESS_TYPE);
		$objResponse->script( "window.location = '".SERVER_URL."';" );
		
		while(!$this->session->userdata(WEBSITE_FRONTEND_SESSION)) {
			return $objResponse;
		}
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <End>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: commonFunction
	02: isLoggedIn
	03: isUserLoggedIn
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: commonFunction
	 *
	 * This function is used to save user common data which can be used globaly in this website
	 *
	 */
	public function commonFunction(){
		//$sql = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/ha_web_open-mind-tutors/database/Query (20-03-17).sql');
		//pr($sql); die();
		 if($this->session->userdata(WEBSITE_FRONTEND_SESSION)) {
				$user_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
				$this->common_data['user_data'] = $this->user_model->getUserById($user_id);
				$this->common_data['total_lessons'] = $this->profile_model->getTutorTotalLessons($user_id);
				$this->common_data['user_id'] = $user_id;
				$this->common_data['access_type'] = $this->common_data['user_data']['access_type']; 
				$this->common_data['message_count'] = $this->message_model->getUnreadMsgsByReceiverId($user_id);
				$this->common_data['site_settings'] = $this->user_model->getSiteSettings();
				$tutor_details = $this->profile_model->getTutorDetailsById($user_id);
				if(!empty($tutor_details)){
					$level_update = $this->user_model->tutorLevelUpdate($user_id,$tutor_details['level_id']);
				}
		 }
		 else{
				$this->common_data['user_data'] = '';
				$this->common_data['site_settings'] = $this->user_model->getSiteSettings();
		 }	 
	}
	/**
	 * 02: isLoggedIn
	 *
	 * This function checks whether admin is logged in or not, if user is not logged n it will redirect to the login page
	 */	
	public function isLoggedIn() {
		if($this->session->userdata(WEBSITE_FRONTEND_SESSION)) {
			return $this->session->userdata(WEBSITE_FRONTEND_SESSION);
		}else {    
			header("Location: ".SERVER_URL);
   			die();
        }			
	}
	/**
	 * 03: isUserLoggedIn
	 *This function is used to prevent redirection to the login page without logout
	 */
	public function isUserLoggedIn() {
		if($this->session->userdata(WEBSITE_FRONTEND_SESSION)) {
			$user_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
			$user_detail = $this->user_model->getUserById($user_id);
			//echo $user_data['access_type']; die();
			if ($user_detail['access_type']  == ACCESS_TYPE_LIMITED){
				header("Location: ".ROUTE_PROFILE);
			}else{
				header("Location: ".ROUTE_LESSONS);
			} 
   			die();
		}else {    
			return false;
        }
	}
	/**
	 * 04: subejcts
	 */
	public function mainSubjects() {
		$main_subjects = $this->profile_model->getMainSubjects();
			if(!empty($main_subjects)){
				foreach($main_subjects as $key=>$row){
					$main_subjects[$key]['subjects'] = $this->profile_model->getSubjectsByMainId($row['id']);
				}
			}
		return $main_subjects;
	}
	public function mainAreas() {
		$main_areas = $this->profile_model->getMainAreas();
		return $main_areas;
	}
	/**
	 * 04: levels_ajax subjects_ajax
	 */
	public function levels_ajax() {
		if(isset($_GET['term'])){
			$level = $_GET['term'];
			$levels = $this->search_model->searchLevels($level);
		}
	}
	public function subjects_ajax() {
		if(isset($_GET['term'])){
			$subject = $_GET['term'];
			$subjects = $this->search_model->searchSubjects($subject);
		}
	}
	public function postal_ajax() {
		if(isset($_GET['term'])){
			$postal = $_GET['term'];
			$country = $_GET['country'];
			$subjects = $this->search_model->searchPostalCodes($postal,$country);
		}
	}
    public function show_error() {
		//assign public class values to function variable
		$data = "";
		$data['common_data'] = "";
		$data['mainSubjects'] = $this->mainSubjects();
		//Getting User Information
		 if($this->session->userdata(WEBSITE_FRONTEND_SESSION)) {
				$user_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
				$data['common_data']['user_data'] = $this->user_model->getUserById($user_id);
				$data['common_data']['user_id'] = $user_id;
		 }
		
		$template['body_content'] = $this->load->view('frontend/error/404', $data, true);
		$this->load->view('frontend/layouts/template', $template, false);
	}
	function comingSoon(){
		$site_status = $this->user_model->getSiteStatus();
		if($this->session->userdata(WEBSITE_FRONTEND_SESSION)) {
			$user_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
			$user_detail = $this->user_model->getUserById($user_id);
			if($site_status == INACTIVE_STATUS_ID && $user_detail['access_type'] == ACCESS_TYPE_LIMITED){
				header("Location: ".ROUTE_PROFILE);
				die();
			}
		}
		if($site_status == INACTIVE_STATUS_ID && !$this->session->userdata(WEBSITE_FRONTEND_SESSION)){
			header("Location: ".SERVER_URL);
   			die();
		}
	}
}
/* End of file common.php */
/* Location: ./application/controllers/frontend/common.php */
