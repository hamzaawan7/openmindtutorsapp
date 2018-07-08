<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Backendcommon {
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
		$this->data['module'] = "06";	
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
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 01: editPageAjax
	*
	* This function changes lesson status 
	*
	*/
	public function editPageAjax($param = null){
	$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) {
			$page_id = $param['page_id'];
			$content = $param['content'];
			$qResponse = $this->page_model->updatePageContent($page_id,$content);
			$msg = "Page updated!";
			$url = BACKEND_PAGES_URL.'/'.$page_id;
			$objResponse->script( "successAlerts('".$msg."','".$url."')" );
		}
		return $objResponse ;
	}
	/**
	* 02: addPageHeadingAjax
	*
	* This function add Page Heading 
	*
	*/
	public function addPageHeadingAjax($param = null){
	$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) {
			$page_id = $param['page_id'];
			$page_heading = $param['page_heading'];
			$qResponse = $this->page_model->addPageHeading($page_id,$page_heading);
			$msg = "Page updated!";
			$url = BACKEND_FAQ_PAGES_URL.'/'.$page_id;
			$objResponse->script( "successAlerts('".$msg."','".$url."')" );
		}
		return $objResponse ;
	}
	/**
	* 03: changePageHeadingStatusAjax
	*
	* This function change Page Heading status
	*
	*/
	public function changePageHeadingStatusAjax($param = null){
	$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) {
			$id = $param['id'];
			$status = $param['status'];
			$page_id = $param['page_id'];
			$qResponse = $this->page_model->changePageHeadingStatus($id,$status);
			$objResponse->script( "location.reload();" );
		}
		return $objResponse ;
	}
	/**
	* 04: addFaqsAjax
	*
	* This function add Page Heading 
	*
	*/
	public function addFaqsAjax($param = null){
	$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) {
			$faq_heading_id = $param['faq_heading_id'];
			$page_question = $param['page_question'];
			$page_answer = $param['page_answer'];
			$qResponse = $this->page_model->addFaqs($faq_heading_id,$page_question,$page_answer);
			$objResponse->script( "location.reload();" );
		}
		return $objResponse ;
	}
	/**
	* 05: changeFaqStatusAjax
	*
	* This function change Page faq status
	*
	*/
	public function changeFaqStatusAjax($param = null){
	$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) {
			$id = $param['id'];
			$status = $param['status'];
			$qResponse = $this->page_model->changeFaqStatus($id,$status);
			$objResponse->script( "location.reload();" );
		}
		return $objResponse ;
	}
	/**
	* 05: editSettingsAjax
	*
	* This function change settings
	*
	*/
	public function editSettingsAjax($param = null){
	$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) {
			$contact_email = $param['contact_email'];
			$stripe_pub = $param['stripe_pub'];
			$stripe_secret = $param['stripe_secret'];
			$qResponse = $this->page_model->changeSettings($contact_email,$stripe_pub,$stripe_secret);
			$msg = "Settings Saved!";
			$url = BACKEND_SETTINGS_URL;
			$objResponse->script( "successAlerts('".$msg."','".$url."')" );
		}
		return $objResponse ;
	}
	
	/**
	* 05: editTierConfigAjax
	*
	* This function change tier settings
	*
	*/
	public function editTierConfigAjax($param = null){
	$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) {
			$default_tier = $param['default_tier'];
			$tier_rates = $param['tier_rates'];
			for($index = 0; $index<count($tier_rates); $index++){
				$tierRates[$tier_rates[$index]] = $tier_rates[++$index]; 
			}
			$qResponse = $this->page_model->changeTierSettings($default_tier,$tierRates);
			$msg = "Tier Settings Saved!";
			$url = BACKEND_SETTINGS_URL.'#tier-settings';
			$objResponse->script( "successAlerts('".$msg."','".$url."')" );
		}
		return $objResponse ;
	}


	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Ed>
	|--------------------------------------------------------------------------
	*/
	
	/*--------------------------------------------------------------------------------------------------------------------------*/
	
	//FUNCTIONS LIST:
	//01: termsAndConditions
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: index
	 *
	 * Static pages
	 *
	 */
	
    public function index($page_id) {
       $this->isLoggedIn();
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = $page_id;
		$page_type = INACTIVE_STATUS_ID;
		$data['page_data'] = $this->page_model->getPageData($page_id,$page_type);
		if(empty($data['page_data']['content'])){
			show_404();
			die();
		}

		$template['body_content'] = $this->load->view('backend/pages/index', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: faqPage
	 *
	 * Static faq pages
	 *
	 */
	
    public function faqPage($page_id) {
       $this->isLoggedIn();
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = $page_id;
		$page_type = ACTIVE_STATUS_ID;
		$data['page_data'] = $this->page_model->getPageData($page_id,$page_type);
		if(empty($data['page_data'])){
			show_404();
			die();
		}
		$data['page_headings'] = $this->page_model->getFaqPageHeading($page_id);
		$data['faq_content'] = $this->page_model->getFaqPageContent($page_id);

		$template['body_content'] = $this->load->view('backend/pages/faq-page', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);
	}
	
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: settings
	 *
	 * Static page settings
	 *
	 */
	
    public function settings() {
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = "settings";
		$data['moduleName'] = "Settings";
		$data['tier_levels'] = $this->user_model->getTierLevels();
		$template['body_content'] = $this->load->view('backend/pages/settings', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: termsAndConditions
	 *
	 * Static page terms and conditions
	 *
	 */
	
    public function termsAndConditions() {
		$data = $this->data;
		$data['common_data'] = $this->common_data;

		$template['body_content'] = $this->load->view('backend/pages/terms-and-conditions', $data, true);	
		$this->load->view('backend/layouts/templateSurveys', $template, false);		
	}
	
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file Pages.php */
/* Location: ./application/controllers/backend/Pages.php */
