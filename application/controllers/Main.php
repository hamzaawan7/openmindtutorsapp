<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends Common {
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
		
        $this->output->enable_profiler(false);
        
        //------------ Common Function <Start> -----------------//
        $this->commonFunction();
        //------------ Common Function <End> -----------------//
		//------------ Class Common Values <Start> -----------------//
		$this->data['mainSubjects'] = $this->mainSubjects();
		$this->data['module'] = "01";	
		$this->data['moduleName'] = "Homepage";	
		$this->data['page'] = 'homepage';
		//------------ Class Common Values <Start> -----------------//
    }
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: homeSearchAjax
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 01: homeSearchAjax
	*
	* This function helps user to search for hosts
	*
	*/
	function homeSearchAjax($param=null){
		// Checking whether parametres are nullor not
		if ($param != null) {
			$city_host = $param['city_host'];
			$city_host = ($city_host == "")? 'no':$city_host;
			$date = $param['date'];
			if($date != ""){
				if($date == "this-week"){
					$date = 8;
				} else if($date == "this-weekend"){
					$date = 9;
				} else if($date == "next-week"){
					$date = 10;
				} else {
					$date = date('w',strtotime($date));
				}
			} else {
				$date = 7;
			}
			$objResponse = new xajaxResponse();
			$url = ROUTE_SEARCH."?query=".$city_host."&date=".$date;
			$objResponse->script( "window.location = '".$url."';" );
		}
		return $objResponse;
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Ed>
	|--------------------------------------------------------------------------
	*/
    
    public function index() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['top_tutors'] = $this->search_model->getTopRatedTutors();
		$site_status = $this->user_model->getSiteStatus();
		//echo $this->isUserLoggedIn(); die();
		if($site_status == INACTIVE_STATUS_ID && $this->session->userdata(WEBSITE_FRONTEND_SESSION) && $data['common_data']['access_type'] == ACCESS_TYPE_LIMITED){
			
			header("Location: ".ROUTE_PROFILE);
			die();
		}
		if($site_status == INACTIVE_STATUS_ID && !$this->session->userdata(WEBSITE_FRONTEND_SESSION)){
			$this->load->view('frontend/pages/coming-soon', $data, false);
		} else {
			$template['body_content'] = $this->load->view('frontend/pages/homepage', $data, true);
			$this->load->view('frontend/layouts/template', $template, false);
		}
	}
}
/* End of file main.php */
/* Location: ./application/controllers/main.php */
