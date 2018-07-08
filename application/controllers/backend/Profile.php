<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Backendcommon {
    function __construct() {
        parent::__construct();	
        //I.E Fix: Holds SESSION accross the DOMAIN
        header('P3P: CP="CAO PSA OUR"');
        $this->isLoggedIn();	
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
		$this->data['module'] = "02";	
		$this->data['moduleName'] = "Profile";	
		$this->data['page'] = 'profile';
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
    /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: changePasswordAjax
	02: editProfileAjax
	03: editPicAjax
	--------------------------------------------------------------------------------------------------------------------------*/
    
	//01: changePasswordAjax
    public function changePasswordAjax($param=null) {
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$objResponse = new xajaxResponse();
			$current_password = $param['current_password'];
			$new_password = $param['new_password1'];
			//redirect to login if user not logged in
			$user_id = $this->session->userdata(WEBSITE_BACKEND_SESSION);
			
			//verify user password using user id
			$db_user = $this->user_model->getAdminById($user_id);
			if(!empty($db_user)){
				//does db password match with current password?
				if(encrypt_url($current_password) == $db_user['password']) {
					//encrypt password
					$new_password = encrypt_url($new_password);
					//Update new password
					$this->login_model->updatePassword($user_id,$new_password);
					$objResponse->script('$("#personal_info #up_text").text("Your Password has been changed.");');
					$objResponse->script('$("#personal_info").modal("show");');
				} else {
						$objResponse->script('$("#changePasswordForm .errorMsg").text("Invalid current password");'); 
				}
			}
		}
		return $objResponse;
    }
	/* ------------------------------------------------------------------------------------*/
	//02: editProfileAjax
    public function editProfileAjax($param=null) {
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$objResponse = new xajaxResponse();
			$first_name = $param['first_name'];
			$last_name = $param['last_name'];
			$email = $param['email'];
			$phone = $param['phone'];
			$description = $param['description'];
			//redirect to login if user not logged in
			$user_id = $this->session->userdata(WEBSITE_BACKEND_SESSION);
			
			//verify user password using user id
			$db_user = $this->login_model->getUserByEmail($email);
			if(empty($db_user) || $db_user['id'] == $user_id){
				//Update User
				$this->user_model->editAdminProfile($user_id,$first_name,$last_name,$email,$phone,$description);
				$objResponse->script('$("#personal_info #up_text").text("Your profile changes have been saved.");');
				$objResponse->script('$("#personal_info").modal("show");');
			} else {
				$objResponse->script('$("#editProfileForm .errorMsg").text("Email already exists");'); 
			}
		}
		return $objResponse;
    }
	/* ------------------------------------------------------------------------------------*/
	/**
	* 03: editPicAjax
	*
	* This function edit user profile pic
	*
	*/
	public function editPicAjax() {
		//Getting Variables	
		$user_id = $_POST['user_id'];

		//Getting Current Profile Image
		$user_image = $this->user_model->getAdminById($user_id);
		//Uploading Image
		$file_element_name = 'imgInp1';  
		$config['upload_path'] = ASSET_BACKEND_UPLOADS_PATH."profile";
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
			$qResponse = $this->user_model->editPic($user_id,$file_name);

			if($qResponse){
				//Redirect to User profile page
				$msg = 'Your profile picture has been updated.';
				$status = 1;
				$url = "";
			} else {
				$msg = 'Something went wrong'; 
				$status = 0;
				$url = "";
			}
		$response['status'] = $status;
		$response['response'] = $msg;
		$response['url'] = $url;
		echo json_encode($response);
		die();
    }
	/* ------------------------------------------------------------------------------------*/
	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <End>
	|--------------------------------------------------------------------------
	*/
    /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: profile
	--------------------------------------------------------------------------------------------------------------------------*/
	public function profile() { 
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;		
		
		$template['body_content'] = $this->load->view('backend/profile/profile', $data, true);
		$this->load->view('backend/layouts/template', $template, false);
		
    }
}
/* End of file profile.php */
/* Location: ./application/controllers/backend/profile.php */
