<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Common {
	//initializing public data variable for class
	public $data = '';
    function __construct() {
        parent::__construct();	
        //I.E Fix: Holds SESSION accross the DOMAIN
        header('P3P: CP="CAO PSA OUR"');
		
		//$this->comingSoon();
        //------------ Model Functions <Start>-----------------//	
        //------------ Model Functions <End>-----------------//	
        	
        //------------ Libraries <Start> -----------------//
		//------------ Libraries <End> -----------------//
		
		//------------ XAJAX <Start> -----------------//
		$this->xajax->configure('javascript URI',base_url().'xajax' );
		$this->xajax->processRequest();
		$this->xajax_js = $this->xajax->getJavascript( base_url() ); 	
		//------------ XAJAX <End> -----------------//
        $this->output->enable_profiler(false);
        
         //------------ Common Function <Start> -----------------//
        $this->commonFunction();
        //------------ Common Function <End> -----------------//
		//------------ Class Common Values <Start> -----------------//
		$this->data['mainSubjects'] = $this->mainSubjects();
		$this->data['module'] = "02";
		$this->data['moduleName'] = "Profile";
		$this->data['moduleURL'] = ROUTE_PROFILE;
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: editProfileAjax
	02: roleConfirmationAjax
	03: changePasswordAjax
	04: saveTutorProfileAjax
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 01: editProfileAjax
	*
	* This function edit user profile
	*
	*/
	public function editProfileAjax() {
		//Getting Variables	
		$user_id = $_POST['user_id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$title = $_POST['title'];
		$gender = $_POST['gender'];
		$phone_code = $_POST['phone_code'];
		$phone = $_POST['phone'];
		$country_id = $_POST['country_id'];
		$city = $_POST['city'];
		$postal_code = $_POST['postal_code'];
		$address = $_POST['address'];
		$instruction = $_POST['instruction'];
		$subject_id = $_POST['subject_id'];
		if($subject_id != "null"){
			$subject_id = explode(',',$subject_id);
		} else {
			$subject_id = "";
		}
		$subject_text = $_POST['subject_text'];
		$subject_text = explode(',',$subject_text);
		$country_name = $_POST['country_name'];
		$student_area = $_POST['student_area'];

		//Getting Current Profile Image
		$user_image = $this->user_model->getUserById($user_id);
		//Uploading Image
		$file_element_name = 'imgInp2';  
		$config['upload_path'] = ASSET_FRONTEND_UPLOADS_PATH."profile";
		$config['allowed_types'] = 'jpg|png|jpeg|gif';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload($file_element_name)) {
			$msg = $this->upload->display_errors('', ''); 
			$status = 0;
				$response['status'] = $status;
				$response['response'] = $msg;
				//echo json_encode($response);
				//echo $msg;
				//die();
		}  else {
				$data = array('upload_data' => $this->upload->data());
		}
			//upload file <end>
			//validate image
			$file_name = (isset($data['upload_data']) ? $data['upload_data']['file_name']:$user_image['image']);
			//Check If user With Phone Number Exist
			$emailResponse = $this->profile_model->isEmailExist($email,$user_id);
				if($emailResponse != 0) {
					$msg = 'User with this email already exists';
					$status = 2;
					$url = "";
				}else {
						$_url = sprintf('http://api.geonames.org/postalCodeSearchJSON?postalcode='.urlencode(strtoupper($postal_code)).'&placename='.urlencode($country_name).'&maxRows=30&username=openmindtutors');
						$_result = file_get_contents($_url);
						$postal_result = json_decode($_result);
							$location_codes = '';
						if(isset($postal_result->postalCodes)){
							foreach($postal_result->postalCodes as $key=>$postal){
								$location_codes[$key]['label'] = $postal->postalCode;
								$location_codes[$key]['value'] = $postal->postalCode;
							}
						}

					if(empty($location_codes)){
						$msg = 'Postal code is invalid';
						$status = 3;
						$url = "";						
					} else {
						$qResponse = $this->profile_model->update($user_id,$first_name,$last_name,$email,$title,$gender,$phone_code,$phone,$country_id,$city,$postal_code,$address,$instruction,$file_name,$subject_id,$subject_text,$student_area);

						if($qResponse){
							//Redirect to User profile page
							$msg = 'Profile updated successfully';
							$status = 1;
							$url = ROUTE_PROFILE;
						}else {
							$msg = 'Profile not updated successfully'; 
							$status = 0;
						}
						
					}
				}
		$response['status'] = $status;
		$response['response'] = $msg;
		$response['url'] = $url;
		echo json_encode($response);
		die();
    }
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 02: roleConfirmationAjax
	*
	* This function helps user to select role (host/guest) after login with facebook
	*
	*/
	function roleConfirmationAjax($param=null){
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$role = $param['role'];
			$user_id = $param['user_id'];
			$objResponse = new xajaxResponse();
			$status = ($role ==  TUTOR)? APPROVAL_STATUS_ID:ACTIVE_STATUS_ID;
			$changeRole = $this->user_model->changeUserRole($user_id,$role,$status);
			if($changeRole){
				$objResponse->script( "window.location = '".ROUTE_PROFILE."';" );
			}
		}
		return $objResponse;
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 03: changePasswordAjax
	*
	* This function helps user to change his password
	*
	*/
    public function changePasswordAjax($param=null) {
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$objResponse = new xajaxResponse();
			$user_id = $param['user_id'];
			$current_password = $param['current_password'];
			$new_password = $param['new_password1'];

			//verify user password using user id
			$db_user = $this->user_model->getUserById($user_id);
			if(!empty($db_user)){
				//does db password match with current password?
				if(encrypt_url($current_password) == $db_user['password']) {
					//encrypt password
					$new_password = encrypt_url($new_password);
					//Update new password
					$this->profile_model->updatePassword($user_id,$new_password);
					$msg = "Password has been changed successfully";
					$url = ROUTE_ACCOUNT_SETTINGS;
					$objResponse->script('successAlerts("'.$msg.'","'.$url.'");');
				} else {
						$objResponse->script('$(".errorMsg").text("Invalid current password");'); 
				}
			}
		}
		return $objResponse;
    }
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 04: saveTutorProfileAjax
	*
	* This function save tutor public profile
	*
	*/
	public function saveTutorProfileAjax() {
		//Getting Variables	
		$tutor_id = $_POST['tutor_id'];
		$level_id = $_POST['level_id'];
		$subject_id = $_POST['subject_id'];
		if($subject_id != "null"){
			$subject_id = explode(',',$subject_id);
		} else {
			$subject_id = "";
		}
		$travel_distance = $_POST['travel_distance'];
		$headline = $_POST['headline'];
		$personal_statement = $_POST['personal_statement'];
		$hourly_rate = $_POST['hourly_rate'];
		// education
		$t_education = $_POST['education'];
		$t_education = explode(',institute_name',$t_education);
		foreach($t_education as $index=>$s_rows){
				$t_rows = explode(",",$s_rows);
				foreach($t_rows as $t_attribute){
					$attribute = explode("+=",$t_attribute);
					$education[$index][(empty($attribute[0]) ? 'institute_name':$attribute[0])] = $attribute[1];
					
				}
		}
		$education = json_encode($education);
		// teaching
		$t_teaching = $_POST['teaching'];
		$t_teaching = explode(',institute_name',$t_teaching);
		foreach($t_teaching as $index=>$s_rows){
				$t_rows = explode(",",$s_rows);
				foreach($t_rows as $t_attribute){
					$attribute = explode("+=",$t_attribute);
					$teaching[$index][(empty($attribute[0]) ? 'institute_name':$attribute[0])] = $attribute[1];
					
				}
		}
		$teaching = json_encode($teaching);
		$tutor_experience = $_POST['tutor_experience'];
		if(empty($tutor_experience)){
			$tutor_experience = 0;
		}
		$tutor_hours = $_POST['tutor_hours'];
		$tutor_subjects = $_POST['tutor_subjects'];
		/* avaiability */
		$avaiability = $_POST['avaiability'];
		$t_avaiable = array();
		$t_avaiable_index = 0;
		$available = array();
		if(!empty($avaiability)){
			$avaiability = explode(';',$avaiability);
			foreach($avaiability as $index=>$a_rows){
				if($a_rows != ""){
					$t_avaiable[$t_avaiable_index] = $a_rows;
					$t_avaiable_index++;
				}
			}
			for($i=0;$i<count($t_avaiable);$i++){
				$days = $t_avaiable[$i++];
				$times = explode(',',$t_avaiable[$i]);
				$available[$days]['times'] = $times;
			}
		}
		/* group avaiability */
		$group_avaiability = $_POST['group_avaiability'];
		$group_available = array();
		if(!empty($group_avaiability)){
			$group_avaiability = explode(';',$group_avaiability);
			$g_t_avaiable = array();
			$g_t_avaiable_index = 0;
			foreach($group_avaiability as $index=>$a_rows){
				if($a_rows != ""){
					$g_t_avaiable[$g_t_avaiable_index] = $a_rows;
					$g_t_avaiable_index++;
				}
			}
			for($i=0;$i<count($g_t_avaiable);$i++){
				$syllabus = $g_t_avaiable[$i++];
				$days = $g_t_avaiable[$i++];
				$no_of_students = $g_t_avaiable[$i++];
				$times = explode(',',$g_t_avaiable[$i]);
				$group_available[$days]['no_of_students'] = $no_of_students;
				$group_available[$days]['times'] = $times;
				$group_available[$days]['syllabus'] = $syllabus;
			}
		}
		$teaching_level = $_POST['teaching_level'];
		$subject_text = $_POST['subject_text'];
		if(!empty($subject_text)){
			$subject_text = explode(',',$subject_text);			
		}
		$subject_level = $_POST['subject_level'];
		$info_file = $_POST['info_file'];
		$group_hourly_rate = $_POST['group_hourly_rate'];
		//Getting Current Profile Image
		$user_data = $this->user_model->getUserById($tutor_id);
		
		$user_file = $this->profile_model->getTutorDetailsById($tutor_id);

		$user_status = ($user_data['role'] == STUDENT && empty($user_file))? APPROVAL_STATUS_ID: $user_data['is_active'];

		//Uploading Image
		$file_element_name = 'imgInp1';  
		$config['upload_path'] = ASSET_FRONTEND_UPLOADS_PATH."profile";
		$config['allowed_types'] = 'zip';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload($file_element_name)) {
			$msg = $this->upload->display_errors('', ''); 
			$status = 2;
				$response['status'] = $status;
				$response['response'] = $msg;
				$response['url'] = "";
				//if($msg != "You did not select a file to upload."){
				//	echo json_encode($response);
				//	echo $msg;
				//	die();
				//}
		}  else {
				$data = array('upload_data' => $this->upload->data());
		}
			//upload file <end>
			//validate image
			$certificate_file = (isset($data['upload_data']) ? $data['upload_data']['file_name']:$user_file['certificate_file']);
				$this->profile_model->changeUserStatus($tutor_id,$user_status);
				
				$qResponse = $this->profile_model->saveTutorProfile($tutor_id,$level_id,$subject_id,$travel_distance,$headline,$personal_statement,$hourly_rate,
									$education,$teaching,$tutor_experience,$tutor_hours,$tutor_subjects,$available,$group_available,$certificate_file,$teaching_level,$subject_text,$subject_level,$info_file,$group_hourly_rate);
				if($qResponse == true){
					//Redirect to User profile page
					$msg = 'Tutor profile saved successfully';
					$status = 1;
					$url = ROUTE_LESSONS;
					if(!empty($group_available) || !empty($available)){
						$requested_students = $this->message_model->getNoLessonMsgsByReceiverId($tutor_id);
						if(!empty($requested_students)){
							foreach($requested_students as $student){
								$email = $student['email'];
								$subject = "New Message";
								$profile_link = ROUTE_SEARCH_DETAIL.'/'.preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities( strtolower(str_replace(' ', '', $user_data['first_name'])))).'/'.$tutor_id;
								$email_msg = "Hello ".ucfirst($student['first_name']).",<br><br> You contacted a tutor through Open Mind Tutors. The tutor has now updated their availability schedule. Please select a time slot to continue your conversation. To view the tutor's profile, click 
								<a href='".$profile_link."'>here</a><br><br>
								Sincerely,<br>
								<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
								$sender = NO_REPLY;
								sendEmail($sender,$email,$email_msg,$subject);
							}
							$this->message_model->changeNoMessageStatus($tutor_id);
						}
					}
				}else {
					$msg = 'Tutor profile not saved successfully';
					$url = "";
					$status = 0;
				}
		$response['status'] = $status;
		$response['response'] = $msg;
		$response['url'] = $url;
		echo json_encode($response);
		die();
    }
	/*--------------------------------------------------------------------------------------------------------------------------*/
	function changeUserStatusAjax($param=null) {
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$objResponse = new xajaxResponse();
			$user_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
			$status = $param['status'];

			$this->profile_model->changeUserStatus($user_id,$status);
			if($status != DELETED_STATUS_ID){
				$objResponse->script('location.reload()');
			} else {
				$objResponse->script('logout()');
			}

		}
		return $objResponse;
    }
	/*--------------------------------------------------------------------------------------------------------------------------*/
	function saveInfoFile(){
		
		$tutor_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
		$user_file = $this->profile_model->getTutorDetailsById($tutor_id);

		//Uploading Image
		$file_element_name = 'infoInp';  
		$config['upload_path'] = ASSET_FRONTEND_UPLOADS_PATH."profile";
		$config['allowed_types'] = 'zip';
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload($file_element_name)) {
			$msg = $this->upload->display_errors('', ''); 
			$status = 2;
				$response['status'] = $status;
				$response['response'] = $msg;
				$response['url'] = "";
				//if($msg != "You did not select a file to upload."){
				//	echo json_encode($response);
				//	echo $msg;
				//	die();
				//}
		}  else {
				$data = array('upload_data' => $this->upload->data());
		}
			//upload file <end>
			//validate image
			$info_file = (isset($data['upload_data']) ? $data['upload_data']['file_name']:$user_file['info_file']);
			$msg = $info_file;
			$status = 1;
			$url = "";
		$response['status'] = $status;
		$response['response'] = $msg;
		$response['url'] = $url;
		echo json_encode($response);
		die();
	}
	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Ed>
	|--------------------------------------------------------------------------
	*/
	
	/*--------------------------------------------------------------------------------------------------------------------------*/
	
	//FUNCTIONS LIST:
	//01: index
	//02: tutorPublicProfile
	//03: changePassword
	//04: level
	//05: studentProfile
	//06: accountSettings
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: Index
	 *
	 * This function is the entery point to this class. 
	 * It shows profile view to user.
	 *
	 */
	
    public function index() {
		$this->isLoggedIn();
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'edit_profile';
		$data['pageName'] = 'Edit Profile';
		$data['access_type'] = $data['common_data']['access_type'];
		// get main subjects and sub subjects
		$data['main_subjects'] = $this->profile_model->getMainSubjects();
		if(!empty($data['main_subjects'])){
			foreach($data['main_subjects'] as $key=>$row){
				$data['main_subjects'][$key]['subjects'] = $this->profile_model->getSubjectsByMainId($row['id']);
			}
		}
		// get subjects
		$data['student_subjects'] = $this->profile_model->getSubjectsByStudentId($data['common_data']['user_id']);
		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($data['common_data']['user_id']);
		if(empty($data['tutor_details'])){
			$level_type = ($data['common_data']['user_data']['role'] == STUDENT)? OPEN_STAR:TIER;
			// get level
			$data['tutor_level'] = $this->profile_model->getTutorFirstLevel($level_type);
			if(!empty($data['tutor_level'])){
				$this->profile_model->saveTutorLevel($data['common_data']['user_id'],$data['tutor_level']['id']);
				$this->profile_model->saveTutorLevelinDetail($data['common_data']['user_id'],$data['tutor_level']['id']);
			}
		} else {
			// get level
			$data['tutor_level'] = $this->profile_model->getLevelById($data['tutor_details']['level_id']);
		}
		$data['countries'] = $this->user_model->getCountries();
		//Getting all payment details
		$data['payment_details'] = $this->payment_model->getPaymentDetailsById($data['common_data']['user_id']);
		$data['tutor_badges'] = $this->user_model->getTutorBadges($data['common_data']['user_id']);
		$data['badges'] = $this->user_model->getBadges();
		$data['main_areas'] = $this->profile_model->getMainAreas();

		$template['body_content'] = $this->load->view('frontend/profile/index', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: tutorPublicProfile
	 *
	 * This function is the entery point to this class. 
	 * It shows tutor public profile view to user.
	 *
	 */
	
    public function tutorPublicProfile() {
		$this->isLoggedIn();
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'tutor_public_profile';
		$data['pageName'] = 'My Tutor Profile (Public)';
		$tutor_id = $data['common_data']['user_id'];
/*		if($tutor_id != $data['common_data']['user_id']){
			show_404();
			die();
		}*/
		// get tutor details
		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($tutor_id);
		if($data['common_data']['user_data']['role'] == INACTIVE_STATUS_ID){
			header("Location: ".ROUTE_PROFILE);
			die();
		}
		// get main subjects and sub subjects
		$data['main_subjects'] = $this->profile_model->getMainSubjects();
		if(!empty($data['main_subjects'])){
			foreach($data['main_subjects'] as $key=>$row){
				$data['main_subjects'][$key]['subjects'] = $this->profile_model->getSubjectsByMainId($row['id']);
			}
		}
		if(empty($data['tutor_details'])){
			$level_type = ($data['common_data']['user_data']['role'] == STUDENT)? OPEN_STAR:TIER;
			// get level
			$data['tutor_level'] = $this->profile_model->getTutorFirstLevel($level_type);
			if(!empty($data['tutor_level'])){
				$this->profile_model->saveTutorLevel($data['common_data']['user_id'],$data['tutor_level']['id']);
				$this->profile_model->saveTutorLevelinDetail($data['common_data']['user_id'],$data['tutor_level']['id']);
			}
		} else {
			// get level
			$data['tutor_level'] = $this->profile_model->getLevelById($data['tutor_details']['level_id']);
			// get subjects
			$data['tutor_details']['subjects'] = $this->profile_model->getSubjectsByTutorId($tutor_id);
			// get avaiability
			$availability = $this->profile_model->getAvailabilityByTutorId($tutor_id);
			$index = 0;
			foreach ($availability as $row){
//				$data['tutor_details']['availability'][$row['day_available']]['times'][$index] = $row['time_available'];
				$data['tutor_details']['availability'][$row['day_available']]['times'][$row['id']] = $row['time_available'];
				$index++;
			}
			// get avaiability
			$group_availability = $this->profile_model->getGroupAvailabilityByTutorId($tutor_id);
			$g_index = 0;
			foreach ($group_availability as $row){
//				$data['tutor_details']['group_availability'][$row['day_available']]['times'][$g_index] = $row['time_available'];
				$data['tutor_details']['group_availability'][$row['day_available']]['times'][$row['id']] = $row['time_available'];
				$data['tutor_details']['group_availability'][$row['day_available']]['no_of_students'] = $row['seats'];
				$data['tutor_details']['group_availability'][$row['day_available']]['syllabus'] = $row['syllabus'];
				$g_index++;
			}
		}
		//Getting all payment details
		$data['payment_details'] = $this->payment_model->getPaymentDetailsById($data['common_data']['user_id']);
		$data['teaching_levels'] = $this->profile_model->getTeachingLevels();
		$data['tutor_badges'] = $this->user_model->getTutorBadges($data['common_data']['user_id']);
		$data['badges'] = $this->user_model->getBadges();

		$data['page'] = 'tutor-public-profile';
		$data['countries'] = $this->user_model->getCountries();
		$template['body_content'] = $this->load->view('frontend/profile/tutor-public-profile', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 03: changePassword
	 *
	 * This function is allow the user to change his password.
	 *
	 */
	
    public function changePassword() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'change_password';
		$data['pageName'] = 'Change Password';
		if($data['common_data']['user_data']['role'] == INACTIVE_STATUS_ID){
			header("Location: ".ROUTE_PROFILE);
			die();
		}
		if($data['common_data']['user_data']['account_type'] == FACEBOOK_ACCOUNT_TYPE){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}

		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($data['common_data']['user_id']);
		//Getting all payment details
		$data['payment_details'] = $this->payment_model->getPaymentDetailsById($data['common_data']['user_id']);
		$data['tutor_badges'] = $this->user_model->getTutorBadges($data['common_data']['user_id']);
		$data['badges'] = $this->user_model->getBadges();

		$template['body_content'] = $this->load->view('frontend/profile/change-password', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 04: level
	 *
	 * This function is allow the user to check his level
	 *
	 */
	
    public function level() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'tutor_level';
		$data['pageName'] = 'My Tutor Level';
		if($data['common_data']['user_data']['role'] == INACTIVE_STATUS_ID){
			header("Location: ".ROUTE_PROFILE);
			die();
		}
		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($data['common_data']['user_id']);
		$data['avg_rating'] = $this->reviews_model->getAvgRatingByTutorId($data['common_data']['user_id']);
		if(empty($data['tutor_details'])){
			$level_type = ($data['common_data']['user_data']['role'] == STUDENT)? OPEN_STAR:TIER;
			// get level
			$data['tutor_level'] = $this->profile_model->getTutorFirstLevel($level_type);
		} else {
			// get level
			$data['tutor_level'] = $this->profile_model->getLevelById($data['tutor_details']['level_id']);
		}
		$template['body_content'] = $this->load->view('frontend/profile/level', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 05: studentProfile
	 *
	 * This function is allow the user to see his profile.
	 *
	 */
	
    public function studentProfile($student_name,$user_id) {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'my_profile';
		$data['pageName'] = 'My Profile';
		if(isset($data['common_data']['user_data']['role']) && $data['common_data']['user_data']['role'] == INACTIVE_STATUS_ID){
			header("Location: ".ROUTE_PROFILE);
			die();
		}
		$data['user_details'] = $this->user_model->getUserById($user_id);
		if(preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(strtolower(str_replace(' ', '', $data['user_details']['first_name'])))) != preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(strtolower(str_replace(' ', '', $tutor_name))))){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}
		$data['student_subjects'] = $this->user_model->getSubjectsByStudentId($user_id);
		$student_subjects_id = $this->profile_model->getSubjectsByStudentId($user_id);
		$subject_id = "";
		if(!empty($student_subjects_id)){
			foreach ($student_subjects_id as $sub_id){
				$subject_id .= $sub_id.",";
			}
		}
		$data['related_students'] = "";
		if(!empty($subject_id)){
			$subject_id = rtrim($subject_id,',');
			$data['related_students'] = $this->profile_model->relatedStudents($subject_id,$user_id);
		}
		$data['student_reviews'] = $this->reviews_model->getStudentReviews($user_id);
		if(empty($data['user_details']) || $data['user_details']['role'] != STUDENT){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}
		$template['body_content'] = $this->load->view('frontend/profile/student-profile', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 06: accountSettings
	 *
	 * This function is allow the user to change his account settings.
	 *
	 */
	
    public function accountSettings() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'change_password';
		$data['pageName'] = 'Change Password';
		if($data['common_data']['user_data']['role'] == INACTIVE_STATUS_ID){
			header("Location: ".ROUTE_PROFILE);
			die();
		}
		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($data['common_data']['user_id']);
		//Getting all payment details
		$data['payment_details'] = $this->payment_model->getPaymentDetailsById($data['common_data']['user_id']);
		$data['tutor_badges'] = $this->user_model->getTutorBadges($data['common_data']['user_id']);
		$data['badges'] = $this->user_model->getBadges();

		$template['body_content'] = $this->load->view('frontend/profile/account-settings', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	
	/**
	 * 02: tutorProfile
	 *
	 * This function is the entery point to this class. 
	 * It shows search detail view to user.
	 *
	 */
	
    public function tutorProfile($tutor_name,$tutor_id) { 
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		if (isset($data['common_data']['user_id']) && $data['common_data']['user_id'] != $tutor_id){
			 $this->comingSoon();
		}
		
		$data['page'] = 'search_details';
		$data['pageName'] = 'Tutor Profile';
		// tutor details
		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($tutor_id);
		$data['user_details'] = $this->user_model->getUserById($tutor_id);
		if(preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(strtolower(str_replace(' ', '', $data['user_details']['first_name'])))) != preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(strtolower(str_replace(' ', '', $tutor_name))))){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}
		$data['avg_rating'] = $this->reviews_model->getAvgRatingByTutorId($tutor_id);
		// get level
		if(empty($data['tutor_details'])){
			$level_type = ($data['user_details']['role'] == STUDENT)? OPEN_STAR:TIER;
			$data['tutor_level'] = $this->profile_model->getTutorFirstLevel($level_type);
		} else {
			$data['tutor_level'] = $this->profile_model->getLevelById($data['tutor_details']['level_id']);
		}
		
		$data['tutor_reviews'] = $this->reviews_model->getReviewsByTutorId($tutor_id);
		$data['tutor_subjects'] = $this->search_model->getSubjectsByTutorId($tutor_id);
		$tutor_availablity = $this->search_model->getAvailabilityTutorId($tutor_id);
		$data['availablity'] = array();
		$dow = "";
		if(!empty($tutor_availablity)){
			$data['default_time'] = "";
			foreach($tutor_availablity as $key=>$row){
				$startend = explode("-",$row['time_available']);
				$data['availablity'][$key]['id'] = $row['id'];
				$data['availablity'][$key]['title'] = ($row['seats'] > 1)? '0/'.$row['seats'].' students':$row['seats'].' student';
				$data['availablity'][$key]['start'] = $startend[0];
				$data['availablity'][$key]['end'] = $startend[1];
				$data['availablity'][$key]['seats'] = $row['seats'];
				$data['availablity'][$key]['total_lessons'] = $row['total_lessons'];
				$lesson_date = array();
				if(!empty($row['lesson_date'])){
					foreach ($row['lesson_date'] as $key1=>$date){
						$data['availablity'][$key]['lesson_date'][$key1] = date('Y-m-d',$date['lesson_date']).','.$date['total_lessons'].','.$date['student_id'];
					}
				}else {
					$data['availablity'][$key]['lesson_date'] = array();
				}
				/*if($row['seats'] == $row['total_lessons']){
					$data['availablity'][$key]['color'] = "#E74C3C";
					$data['availablity'][$key]['status'] = "booked";
				} else if($row['total_lessons'] == 0){
					$data['availablity'][$key]['color'] = "#6AA4C1";
					$data['availablity'][$key]['status'] = "available";
				} else if($row['seats'] > $row['total_lessons']){
					$data['availablity'][$key]['color'] = "#FF9B1D";
					$data['availablity'][$key]['status'] = "reserve";
				}*/
					$data['availablity'][$key]['status'] = 0;
					$data['availablity'][$key]['dow'] = '['.$row['day_available'].']';
					$data['availablity'][$key]['lesson_type'] = $row['availability_type'];
//					$syllabus = "";
//					$syllabus = (!empty($row['syllabus']))? explode(";",$row['syllabus']):"";
//					$data['availablity'][$key]['syllabus_subject'] = (!empty($syllabus))? $syllabus[0]:"";
					$data['availablity'][$key]['syllabus'] = (!empty($row['syllabus']))? $row['syllabus']:"";
					if(empty($data['availablity'][$key]['lesson_date'])){
						$data['default_time']['available'][$key] = substr($data['availablity'][$key]['start'], 0, strpos($data['availablity'][$key]['start'], ":"));
					}else {
						$data['default_time']['not_available'][$key] = substr($data['availablity'][$key]['start'], 0, strpos($data['availablity'][$key]['start'], ":"));
					} 
			}
		}
		if(!empty($data['default_time'])){
			if(!empty($data['default_time']['available'])){
				$data['default_time_final'] = min($data['default_time']['available']).":00";
			}elseif(!empty($data['default_time']['not_available'])){
				$data['default_time_final'] = min($data['default_time']['not_available']).":00";
			}else{
				$data['default_time_final'] = "9:00";
			}		
		}
		$data['default_date'] = date('Y-m-d',time());
		$data['first_day'] = date('w');
		// error page
		if(empty($data['user_details'])){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}
		if(!isset($data['common_data']['user_id']) && empty($data['tutor_details'])){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}
		$data['tutor_badges'] = $this->user_model->getTutorBadges($data['tutor_details']['id']);
		$data['badges'] = $this->user_model->getBadges();
		
		$template['body_content'] = $this->load->view('frontend/search/search-detail', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file profile.php */
/* Location: ./application/controllers/frontend/profile.php */
