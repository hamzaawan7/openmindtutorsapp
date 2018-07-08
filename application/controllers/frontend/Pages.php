<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Common {
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
        $this->commonFunction();
        //------------ Common Function <End> -----------------//
		//------------ Class Common Values <Start> -----------------//
		$this->data['mainSubjects'] = $this->mainSubjects();
		$this->data['module'] = "03";
		$this->data['moduleName'] = "Pages";
		$this->data['page'] = 'pages';
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: 
	--------------------------------------------------------------------------------------------------------------------------*/
	function sendEmailAjax($param=null){
		// Checking whether parametres are nullor not
		if ($param != null) {
			$contact_name = $param['contact_name'];
			$contact_email = $param['contact_email'];
			$contact_phone = $param['contact_phone'];
			$contact_subject = $param['contact_subject'];
			$contact_message = $param['contact_message'];

			$objResponse = new xajaxResponse();
			//check if user already exist in database
			$sender = "no-reply@".WEBSITE_URL;
			$receiver = $contact_email;
			$subject = "Contact Us - ".WEBSITE_NAME;
			$msg = "Dear ".ucfirst($contact_name).",<br /><br />
						This is an auto generated email from Open Mind Tutor's <a href='".ROUTE_CONTACT_US."'>Contact Us Bot</a>. You have just sent an email to <a href='".SERVER_URL."'>Open Mind Tutor</a>.<br>
						Your query details:<br /><br />
						<b>Name:</b> ".$contact_name."<br>
						<b>Email:</b> ".$contact_email."<br>
						<b>Phone:</b> ".$contact_phone."<br>
						<b>Message:</b> ".$contact_message."<br>
						Sincerely,<br />
						<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
			sendEmail($sender,$receiver,$msg,$subject);
			//Admin notification email
			$sender1 = $contact_email;
			$settings = $this->user_model->getSiteSettings();
			$receiver1 = $settings['contact_email'];
			$subject1 = $contact_subject;
			$msg1 = "Dear Admin,<br /><br />
						Someone recently contacted you from Open Mind Tutor's <a href='".ROUTE_CONTACT_US."'>Contact Us Bot</a>.<br>
						Query details:<br /><br />
						<b>Name:</b> ".$contact_name."<br>
						<b>Email:</b> ".$contact_email."<br>
						<b>Phone:</b> ".$contact_phone."<br>
						<b>Message:</b> ".$contact_message."<br>
						Sincerely,<br />
						<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
			sendEmail($sender1,$receiver1,$msg1,$subject1);
			$web_url = ROUTE_CONTACT_US;
			$web_msg = "Email Sent Successfully!";
			$objResponse->script('successAlerts("'.$web_msg.'","'.$web_url.'");');
		} 
		return $objResponse;
	}
	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Ed>
	|--------------------------------------------------------------------------
	*/
	
	/*--------------------------------------------------------------------------------------------------------------------------*/
	
	//FUNCTIONS LIST:
	//01: browseSubjects
	//02: contact
	//03: privacyPolicy
	//04: termAndConditions
	//05: howItWorks
	//06: becomeTutor
	//07: tutorFaqs
	//08: studentFaqs
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: browseSubjects
	 *
	 * This function is the entery point to this class. 
	 * It shows browse subjects view to user.
	 *
	 */
	
    public function browseSubjects() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$this->comingSoon();
		$data['page'] = 'browse_subjects';
		$data['moduleName'] = 'Browse Subjects';

		$template['body_content'] = $this->load->view('frontend/pages/browse-subjects', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: browseAreas
	 *
	 * This function is the entery point to this class. 
	 * It shows browse areas view to user.
	 *
	 */
	
    public function browseAreas() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$this->comingSoon();
		$data['page'] = 'browse_areas';
		$data['moduleName'] = 'Browse Areas';

		$data['main_areas'] = $this->profile_model->getMainAreas();

		$template['body_content'] = $this->load->view('frontend/pages/browse-areas', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 *02: contact
	 *
	 * This function is the entery point to this class. 
	 * It shows contact view to user.
	 *
	 */
	
    public function contact() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'contact_us';
		$data['moduleName'] = 'Contact Us';

		$template['body_content'] = $this->load->view('frontend/pages/contact-us', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 *03: privacyPolicy
	 *
	 * This function is the entery point to this class. 
	 * It shows privacy policy view to user.
	 *
	 */
	
    public function privacyPolicy() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'privacy_policy';
		$data['moduleName'] = 'Privacy Policy';
		$data['page_data'] = $this->page_model->getPageData(PRIVACY_POLICY_ID);

		$template['body_content'] = $this->load->view('frontend/pages/privacy-policy', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 *04: termAndConditions
	 *
	 * This function is the entery point to this class. 
	 * It shows terms and conditions view to user.
	 *
	 */
	
    public function termAndConditions() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'terms_and_conditions';
		$data['moduleName'] = 'Terms and Conditions';
		$data['page_data'] = $this->page_model->getPageData(TERMS_CONDITIONS_ID);

		$template['body_content'] = $this->load->view('frontend/pages/terms-and-conditions', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 *05: howItWorks
	 *
	 * This function is the entery point to this class. 
	 * It shows howItWorks view to user.
	 *
	 */
	
    public function howItWorks() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'how_it_works';
		$data['moduleName'] = 'How It Works';
		$data['page_data'] = $this->page_model->getPageData(HOW_WORKS_TUTOR_ID);

		$template['body_content'] = $this->load->view('frontend/pages/how-it-works', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 *06: becomeTutor
	 *
	 * This function is the entery point to this class. 
	 * It shows becomeTutor view to user.
	 *
	 */
	
    public function becomeTutor() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$this->comingSoon();
		$data['page'] = 'become_tutor';
		$data['moduleName'] = 'Become A Tutor';
		$data['page_data'] = $this->page_model->getPageData(BECOME_TUTOR_ID);
		$data['page_faqs'] = $this->page_model->getPageFaqs(BECOME_TUTOR_ID);

		$template['body_content'] = $this->load->view('frontend/pages/become-a-tutor', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 *07: TutorFaqs
	 *
	 * This function is the entery point to this class. 
	 * It shows TutorFaqs view to user.
	 *
	 */
	
    public function tutorFaqs() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$this->comingSoon();
		$data['page'] = 'tutor_faqs';
		$data['moduleName'] = 'Tutor FAQs';
		$data['page_data'] = $this->page_model->getPageData(TUTOR_FAQS_ID);
		$data['page_faqs'] = $this->page_model->getPageFaqs(TUTOR_FAQS_ID);

		$template['body_content'] = $this->load->view('frontend/pages/tutor-faqs', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 *08: studentFaqs
	 *
	 * This function is the entery point to this class. 
	 * It shows studentFaqs view to user.
	 *
	 */
	
    public function studentFaqs() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$this->comingSoon();
		$data['page'] = 'student_faqs';
		$data['moduleName'] = 'Student FAQs';
		$data['page_data'] = $this->page_model->getPageData(STUDENT_FAQS_ID);
		$data['page_faqs'] = $this->page_model->getPageFaqs(STUDENT_FAQS_ID);

		$template['body_content'] = $this->load->view('frontend/pages/student-faqs', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/

	/**
	 *09: ourteam
	 *
	 * This function is the entery point to this class. 
	 * It shows ourteam view to user.
	 *
	 */
	
    public function ourTeam() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$this->comingSoon();
		$data['page'] = 'our_team';
		$data['moduleName'] = 'Our Team';
		//$data['page_data'] = $this->page_model->getPageData(STUDENT_FAQS_ID);
		//$data['page_faqs'] = $this->page_model->getPageFaqs(STUDENT_FAQS_ID);

		//$this->data['mainSubjects'] = $this->mainSubjects();
		$template['body_content'] = $this->load->view('frontend/pages/our-team', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file pages.php */
/* Location: ./application/controllers/frontend/pages.php */
