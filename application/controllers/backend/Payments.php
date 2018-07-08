<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payments extends Backendcommon {
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
		$this->data['moduleName'] = "Payments";	
		$this->data['page'] = 'payments';
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: changeUserStatusAjax
	--------------------------------------------------------------------------------------------------------------------------*/
	
	/*--------------------------------------------------------------------------------------------------------------------------*/

	/*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Ed>
	|--------------------------------------------------------------------------
	*/
	
	/*--------------------------------------------------------------------------------------------------------------------------*/
	
	//FUNCTIONS LIST:
	//01: students
	//02: tutors
	//03: studentPaymentHistory
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: students
	 *
	 * This function is the entery point to this class. 
	 * It shows students payment list view to admin.
	 *
	 */
	
    public function students() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'student-payments';
		
		$data['payments'] = $this->payment_model->getStudentPayments();
		
		$template['body_content'] = $this->load->view('backend/payments/student-payments', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: adminPayments
	 *
	 * This function is the entery point to this class. 
	 * It shows admin payment list view to admin.
	 *
	 */
	
    public function adminPayments() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'admin-payments';
		
		$data['payments'] = $this->lesson_model->get(0);
		if(!empty($data['payments'])){
			foreach($data['payments'] as $key=>$row){
				$data['payments'][$key]['omt_percentage'] = $this->lesson_model->getLevelById($row['level_id']);
				$data['payments'][$key]['lesson_students'] = $this->lesson_model->getLessonActiveStudents($row['tutor_id'],$row['tutor_availability_id'],$row['lesson_date']);
				$data['payments'][$key]['payment'] = $this->payment_model->getTutorPayments($row['tutor_availability_id'],$row['lesson_code'],$row['lesson_date']);
			}
		}
//		$data['payments'] = $this->payment_model->get();
		
		$template['body_content'] = $this->load->view('backend/payments/admin-payments', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 03: studentPaymentHistory
	 *
	 * This function is the entery point to this class. 
	 * It shows student payment history list view to admin.
	 *
	 */
	
    public function studentPaymentHistory($student_id) {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'student-payments';
		$data['lesson_id'] = (isset($_GET['lesson_id']))? $_GET['lesson_id']:"";

		$data['payments'] = $this->payment_model->getStudentLessonPayments($student_id);
		if(empty($data['payments'])){
			show_404();
			die();
		}
		
		$template['body_content'] = $this->load->view('backend/payments/student-payment-history', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 04: tutorPaymentHistory
	 *
	 * This function is the entery point to this class. 
	 * It shows tutor payment history list view to admin.
	 *
	 */
	
    public function tutorPaymentHistory($tutor_id) {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'admin-payments';
		$data['lesson_id'] = (isset($_GET['lesson_id']))? $_GET['lesson_id']:"";

		$data['payments'] = $this->payment_model->getTutorLessonPayments($tutor_id);
		if(empty($data['payments'])){
			show_404();
			die();
		}
		if(!empty($data['payments'])){
			foreach($data['payments'] as $key=>$row){
				$data['payments'][$key]['omt_percentage'] = $this->lesson_model->getLevelById($row['level_id']);
				$data['payments'][$key]['lesson_students'] = $this->lesson_model->getLessonActiveStudents($row['tutor_id'],$row['tutor_availability_id'],$row['lesson_date']); 
				$data['payments'][$key]['payment'] = $this->payment_model->getTutorPayments($row['tutor_availability_id'],$row['lesson_code'],$row['lesson_date']);
			}
		}
		
		$template['body_content'] = $this->load->view('backend/payments/tutor-payment-history', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file payments.php */
/* Location: ./application/controllers/backend/payments.php */
