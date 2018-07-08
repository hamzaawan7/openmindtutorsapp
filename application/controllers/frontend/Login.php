<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends Common {
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
		$this->data['module'] = "01";
		$this->data['moduleName'] = "Sign In";
		$this->data['page'] = 'login';
		//------------ Class Common Values <Start> -----------------//
    }
    
	
	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	
	/*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: registerByEmailAjax
	02: loginAjax
	03: loginByFacebook
	04: resetPasswordAjax
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: registerByEmailAjax
	 *
	 * This function is for register with email address.
	 *
	 */
	public function registerByEmailAjax($param=null) {
		// Checking whether parametres are nullor not
		if ($param != null) {
			
			$role = $param['role'];
			$first_name = $param['first_name'];
			$last_name = $param['last_name'];
			$email = $param['email'];
			$password = $param['password'];
			$phone_number = $param['phone_number'];

			$objResponse = new xajaxResponse();
			//check if user already exist in database
			$isUserExist = $this->user_model->isUserEmailExist($email);
			if(empty($isUserExist)){
				//generate confirmation code
				$confirmation_code = generate_code();
				
				//encrypt password
				$password = encrypt_url($password);
				$status = ($role == TUTOR)? APPROVAL_STATUS_ID:ACTIVE_STATUS_ID;
				
				//Save user record in database
				$new_user = $this->user_model->registerByEmail($role,$first_name,$last_name,$phone_number,$email,$password,$status,$confirmation_code);
				//Send confirmation email to user
				$confirmation_url = ROUTE_FIRST_LOGIN.'/'.encrypt_url($new_user.'-'.$confirmation_code);
				// Confirmation Email Send Email
				if($new_user){
					if (WEBSITE_MODE == "dev"){
						$msg = "Your Verification url is ".$confirmation_url;
						$url = "";
						//Success Message
						$objResponse->script('successAlerts("'.$msg.'","'.$url.'");');
						$objResponse->script('$("#registerForm")[0].reset();');
					} else {
						$sender = NO_REPLY;
						$receiver = $email;
						$subject = "Account Confirmation";
						$msg = "Hello ".ucfirst($first_name)."!<br /><br />
									You have been successfully registered with Open Mind Tutors. Please confirm your account by clicking the following link: <a href=".$confirmation_url.">".$confirmation_url."</a>.<br /><br />
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
						sendEmail($sender,$receiver,$msg,$subject);
						//Admin notification email
						$sender1 = NO_REPLY;
						$settings = $this->user_model->getSiteSettings();
						$receiver1 = $settings['contact_email'];
						$subject1 = "New Account";
						$msg_role = ($role == STUDENT)? 'Student':'Tutor';
						$msg1 = "Hello Administrator!<br /><br />
									A new ".$msg_role." has just registered on Open Mind Tutors.<br /><br />
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
						sendEmail($sender1,$receiver1,$msg1,$subject1);
						//$objResponse->script('$("#registerForm .errorMsg").html("An email has been sent to <b>'.$email.'</b> for email verification. Please verify your email address.");');
						$verify_url = ROUTE_REGISTER."?verify_url=An email has been sent to <b>".$email."</b> for email verification. Please verify your email address.#msg";
						$objResponse->script( "window.location = '".$verify_url."';" );
						//$objResponse->script('$("#registerForm")[0].reset();');
					}
				}
			}
			else {
				$objResponse->script('$(".errorMsg").text("Email address has already been registered");');
			}	
		} 
		return $objResponse;
	}
    /*--------------------------------------------------------------------------------------------------------------------------*/	
    /**
	 * 02: loginAjax
	 *
	 * This function is to validate and grand access to admin via Email login.
	 *
	 */
    public function loginAjax($param=null) {
		// Checking whether parametres are nullor not
		if ($param != null) {
			$email = $param['email'];
			$password = encrypt_url($param['password']);
			$remember_me = $param['remember_me'];
			$objResponse = new xajaxResponse();
			// Encoding password
			$password = $password;
			//Validating email and password 
			$user_data = $this->user_model->login($email,$password);
			if(!empty($user_data)) {
				if($user_data['first_login'] == 1)
				{
					$objResponse->script('$("#loginForm .errorMsg").html("Please confirm your email first or <a href='."javascript:void(0)".' id='."resend_confirm_url".'>Resend Confirmation Link</a>");');
				} else {
					if($remember_me == 1)
					{
						$cookie_time = (3600 * 24 * 30); // 30 days
						$hash = md5($user_data['created']); // will result in a 32 characters hash
						setcookie (WEBSITE_COOKIE, 'usr='.$user_data['email'].'&hash='.$hash, time() + $cookie_time);
						
					}
					//Redirecting to admin panel
					$this->session->set_userdata(WEBSITE_FRONTEND_SESSION , $user_data['id']);
					$this->session->set_userdata(WEBSITE_FRONTEND_ACCESS_TYPE , $user_data['access_type']);
					$objResponse->script( "window.location = '".ROUTE_LESSONS."';" );
				}
			}else {
				//Failure Message
				$objResponse->script('$(".errorMsg").text("Invalid Credentials");'); 
			}
		}
		return $objResponse;
    }
	function resend_confirm_url($param=null) {
		if ($param != null) {
			$email = $param['email'];

			$objResponse = new xajaxResponse();
			$user_data = $this->user_model->isUserEmailExist($email);
			if(!empty($user_data)) {
				$confirmation_url = ROUTE_FIRST_LOGIN.'/'.encrypt_url($user_data['id'].'-'.$user_data['confirmation_code']);
				$sender = NO_REPLY;
				$receiver = $email;
				$subject = "Account Confirmation";
				$msg = "Hello ".ucfirst($user_data['first_name'])."!<br /><br />
							You have been successfully registered with Open Mind Tutors. Please confirm your account by clicking the following link: <a href=".$confirmation_url.">".$confirmation_url."</a>.<br /><br />
							Sincerely,<br />
							<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				sendEmail($sender,$receiver,$msg,$subject);
				
				$objResponse->script('$("#loginForm .errorMsg").html("Confirmation link sent successfully");');
			}else {
				$objResponse->script('$(".errorMsg").text("Email does not exist");'); 
			}
		}
		return $objResponse;		
	}
    /*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 04: resetPasswordAjax
	 *
	 * This function is to reset admin password via Email.
	 *
	 */
    public function resetPasswordAjax($param=null) {
		// Checking whether parametres are null or not
		if ($param != null) { 
		    $email = $param['email'];
			$objResponse = new xajaxResponse();
			//Verifying email existance
			$user_data = $this->user_model->isUserEmailExist($email);
			if(!empty($user_data)) {
				//Generate and Update new password
				$new_password = generate_password();
				$new_password_encrypted = encrypt_url($new_password);
				$this->user_model->updatePassword($email,$new_password_encrypted);
				
				if (WEBSITE_MODE == "dev"){
					$msg = "Your Password is ".$new_password;
					$url = ROUTE_LOGIN;
					//Success Message
					$objResponse->script('successAlerts("'.$msg.'","'.$url.'");');
				} else {
					//Email details available in this function already
					if($user_data['account_type'] != 2){
						$to_email = $email;
						$password = $new_password;
						
						//Getting email details from DB
						$from_email = NO_REPLY;
						$email_subject = "Forgot Password?";
						$email_content = "Hello ".ucfirst($user_data['first_name'])."!<br /><br />Did you forget your password again? Don't worry we have updated it for you.<br>New Password: <b>".$password."</b><br><br>
						Sincerely,<br>
						<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
						
						//Send Email (Function in common helper)
						$email = sendEmail($from_email,$to_email,$email_content,$email_subject);
						
						//Success Message
						$objResponse->script('$("#resetForm .errorMsg").text("An email has been sent with an updated password. If you do not receive it within 10 minutes, check your spam folder.");');
					} else {
						//Success Message
						$objResponse->script('$("#resetForm .errorMsg").text("This email is registered as facebook account. You can not reset its password.");');						
					}
				}
			}else {
				//Failure Message
				$objResponse->script('$("#resetForm .errorMsg").text("Invalid email address");');
			}
		}
		return $objResponse;
    }
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <End>
	|--------------------------------------------------------------------------
	*/
	
	
	/*--------------------------------------------------------------------------------------------------------------------------*/
	
	//FUNCTIONS LIST:
	//01: login
	//02: register
	
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: login
	 *
	 * This function is the entery point to this class. 
	 * It shows login page to user.
	 *
	 */
    public function login() {
		//assign public class values to function variable
		$data = $this->data;
		//Getting User Information
		$data['common_data'] = $this->common_data;
		
		// Check if the cookie exists
		if(isset($_COOKIE[WEBSITE_COOKIE]))
		{ 
			parse_str($_COOKIE[WEBSITE_COOKIE]);
			// Make a verification
			$user_data = $this->user_model->getUserByEmail($usr);
			
			if(($usr == $user_data['email']) && ($hash == md5($user_data['created'])))
			{ 
				$user_data = $this->user_model->login($user_data['email'],$user_data['password']);
				// Register the session
				$this->session->set_userdata(WEBSITE_FRONTEND_SESSION , $user_data['id']);
				$this->session->set_userdata(WEBSITE_FRONTEND_ACCESS_TYPE , $user_data['access_type']);
				header("Location: ".SERVER_URL);
				die();
			}
		}

		//redirect to profile if user already logged in
		$this->isUserLoggedIn();
		
		$template['body_content'] = $this->load->view('frontend/login/sign-in', $data, true);
		$this->load->view('frontend/layouts/template', $template, false);
		
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: register as TUTOR
	 *
	 * This function is the entery point to this class. 
	 * It shows register page to user.
	 *
	 */
    public function register() {
		//assign public class values to function variable
		$data = $this->data;

		$global_filters = array('verify_url');
		$filters = $_GET;
		if(!empty($_GET)){
			$i=0;
			foreach($filters as $key=>$row){
				$abc[$i] = $key;
				$i++;
			}
			$containsSearch = $containsSearch = count(array_intersect($abc, $global_filters)) == count($abc);
			if(empty($containsSearch)){
				header("Location: ".ROUTE_ERROR_PAGE);
				die();
			}
		}

		//Getting User Information
		$data['common_data'] = $this->common_data;
		$data['moduleName'] = "Register";
		//redirect to profile if user already logged in
		$this->isUserLoggedIn();
		$template['body_content'] = $this->load->view('frontend/login/register', $data, true);
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 03: forgotPassword
	 *
	 * This function is the entery point to this class. 
	 * It shows forgotPassword page to user.
	 *
	 */
    public function forgotPassword() {
		//assign public class values to function variable
		$data = $this->data;
		//Getting User Information
		$data['common_data'] = $this->common_data;
		$data['moduleName'] = "Forgot Password";
		
		$template['body_content'] = $this->load->view('frontend/login/forgot-password', $data, true);
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 03: show_404
	 *
	 * This function is the entery point to this class. 
	 * It shows forgotPassword page to user.
	 *
	 */
    public function show_404() {
		//assign public class values to function variable
		$data = $this->data;
		//Getting User Information
		$data['common_data'] = $this->common_data;
		
		$template['body_content'] = $this->load->view('frontend/error/404', $data, true);
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
    public function verification($user) {
		$user = decrypt_url($user);
		$user_id = explode('-',$user);
		
		$login_user = $this->user_model->getUserById($user_id[0]);
		if($login_user['confirmation_code'] != $user_id[1]){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		} else if ($login_user['first_login'] == INACTIVE_STATUS_ID){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		} else {
			if ( $login_user) {
				$this->session->set_userdata(WEBSITE_FRONTEND_SESSION,$login_user['id']);
				$this->session->set_userdata(WEBSITE_FRONTEND_ACCESS_TYPE , $login_user['access_type']);
				$this->user_model->deactivateUserFirstLogin($login_user['id'],"1");
				header("Location: ".ROUTE_PROFILE);
				
			} else {
				header("Location: ".ROUTE_LOGIN);
			}
		}
	}
}
/* End of file Login.php */
/* Location: ./application/controllers/frontend/Login.php */
