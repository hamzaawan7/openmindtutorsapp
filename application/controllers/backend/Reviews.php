<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends Backendcommon {
	//initializing public data variable for class
	public $data = '';
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
		$this->data['module'] = "03";	
		$this->data['moduleName'] = "Reviews";	
		$this->data['page'] = 'reviews';
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: changeReviewStatusAjax
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 01: changeReviewStatusAjax
	*
	* This function changes review status i.e. "Active / Inactive / Deleted"
	*
	*/
	public function changeReviewStatusAjax($param = null){
	$objResponse = new xajaxResponse();
	// Checking whether parametres are nullor not
	if ($param != null) { 
		$review_id = $param['review_id'];
		$status = $param['status'];
		// Changing review status in DB
		$delete_response = $this->review_model->changeStatus($review_id,$status);
		if($delete_response){	
			$objResponse->script( "window.location = '".BACKEND_REVIEWS_URL."'" );
		}
	}
	return $objResponse ;
	}
	
	/*--------------------------------------------------------------------------------------------------------------------------*/

	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Ed>
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
	 * It shows review list view to admin.
	 *
	 */
	
    public function index() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		
		$data['reviews'] = $this->review_model->get();

		$template['body_content'] = $this->load->view('backend/reviews/index', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: reviewDetails
	 *
	 * This function is the entery point to this class. 
	 * It shows review details view to admin.
	 *
	 */
	
    public function reviewDetails($review_id) {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		
		$data['reviewDetails'] = $this->review_model->getReviewById($review_id);
		if(empty($data['reviewDetails'])){
			show_404();
			die();
		}
		$template['body_content'] = $this->load->view('backend/reviews/review-details', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file reviews.php */
/* Location: ./application/controllers/backend/reviews.php */
