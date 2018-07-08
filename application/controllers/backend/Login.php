<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Backendcommon {
	//initializing public data variable for class
	public $data = '';
    function __construct() {
        parent::__construct();	
        //I.E Fix: Holds SESSION accross the DOMAIN
        header('P3P: CP="CAO PSA OUR"');
        
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
       // $this->commonFunction();
        //------------ Common Function <End> -----------------//
		
		//------------ Class Common Values <Start> -----------------//
		$this->data['module'] = "01";	
		$this->data['moduleName'] = "Login";	
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	
    /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: loginAjax
	02: resetPasswordAjax

	--------------------------------------------------------------------------------------------------------------------------*/
   /**
	 * 01: loginAjax
	 *
	 * This function is to validate and grand access to admin via Email login.
	 *
	 */
    public function loginAjax($param=null) {
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$email = $param['email'];
			$password = encrypt_url($param['user_password']);
			$remember_me = $param['remember_me'];
			$objResponse = new xajaxResponse();
			//Validating email and password 
			$user_data = $this->login_model->login($email,$password);
			if(!empty($user_data)) {
				if($remember_me == 1)
				{
					$cookie_name = WEBSITE_BACKEND_COOKIE;
					$cookie_time = (3600 * 24 * 30); // 30 days
					$hash = md5($user_data['created']); // will result in a 32 characters hash
					setcookie ($cookie_name, 'usr='.$user_data['email'].'&hash='.$hash, time() + $cookie_time);
					
				}
			//Redirecting to admin panel
				$this->session->set_userdata(WEBSITE_BACKEND_SESSION , $user_data['id']);
				$objResponse->script( "window.location = '".BACKEND_LESSONS_REQUESTS_URL."';" );	
			}else {
				//Failure Message
				$objResponse->script('$("#loginForm .errorMsg").show();'); 
				$objResponse->script('$("#loginForm .errorMsg span").text("Invalid Credentials");'); 
			}
		}
		return $objResponse;
    }

	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: resetPasswordAjax
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
			$user_data = $this->login_model->getUser($email);
			if(!empty($user_data)) {
				//Generate and Update new password
				$new_password = generate_password();
				$new_password_encrypted = encrypt_url($new_password);
				$this->login_model->updatePasswordForgot($email,$new_password_encrypted);
				
				if (WEBSITE_MODE == "dev"){
					$msg = "Your Password is ".$new_password;
					$url = BACKEND_SERVER_URL;
					//Success Message
					$objResponse->script('successAlerts("'.$msg.'","'.$url.'");');
				} else {
					//Email details available in this function already
					$to_email = $email;
					$password = $new_password;
					
					//Getting email details from DB
					$from_email = NO_REPLY;
					$email_subject = "Forgot Password?";
					$email_content = "Hello Admin!<br /><br />Did you forget your password again? Don't worry we have updated it for you. New Password: <b>".$password." </b><br><br>
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
					
					//Send Email (Function in common helper)
					$email = sendEmail($from_email,$to_email,$email_content,$email_subject);
					
					//Success Message
					$objResponse->script('$("#resetForm .errorMsg").text("An email has been sent with an updated password. If you do not receive it within 10 minutes, check your spam folder.");');
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
	//01: index
	
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: Index
	 *
	 * This function is the entery point to this class. 
	 * It shows login menu to admin.
	 *
	 */
    public function index() {
		//assign public class values to function variable
		$data = $this->data;
		
		$cookie_name = WEBSITE_BACKEND_COOKIE;	

			// Check if the cookie exists
			/*if(isset($_COOKIE[$cookie_name]))
			{ 
				parse_str($_COOKIE[$cookie_name]);
				// Make a verification
				$user_data = $this->login_model->getUserByEmail($usr);
				
				if(($usr == $user_data['email']) && ($hash == md5($user_data['created'])))
				{ 
					$user_data = $this->login_model->login($user_data['email'],$user_data['password']);
					// Register the session
					$this->session->set_userdata(WEBSITE_BACKEND_SESSION , $user_data['id']);
					header("Location: ".BACKEND_REVENUE_URL);
					die();
				}
			}*/
		//redirect to profile if user already logged in
		$this->isUserLoggedIn();
		$template['body_classes'] = 'admin_login';
		$template['body_content'] = $this->load->view('backend/login/login', $data, true);
		$this->load->view('backend/layouts/templateLogin', $template, false);
		
    }
    /*--------------------------------------------------------------------------------------------------------------------------*/	
}
/* End of file login.php */
/* Location: ./application/controllers/backend/login.php */
