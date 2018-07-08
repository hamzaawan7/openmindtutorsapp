<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use \Stripe\Stripe;
use \Stripe\Charge;
use \Stripe\Customer;

class Payment extends Common {
	//initializing public data variable for class
	public $data = '';
    function __construct() {
        parent::__construct();	
        //I.E Fix: Holds SESSION accross the DOMAIN
        header('P3P: CP="CAO PSA OUR"');
		//$this->comingSoon();
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
		$this->data['mainSubjects'] = $this->mainSubjects();
		$this->data['module'] = "06";
		$this->data['moduleURL'] = ROUTE_PAYMENTS_HISTORY;
		$this->data['moduleName'] = "Payments";
		$this->data['page'] = 'payment';
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: add_Payments
	02: savePaymentDetails
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 01: add_Payments
	*
	* This function upload gallery images
	*
	*/
	public function add_Payments($lesson_id) {

		//get reservation details
		$user_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
		$user_details = $this->user_model->getUserById($user_id);
		$lesson_details = $this->lesson_model->getLessonDetailsById($lesson_id,$user_id);
		//get payment details
		$payment = $this->payment_model->getPaymentByLessonId($lesson_id);
		$settings = $this->user_model->getSiteSettings();
		$amount = (empty($payment['transaction_amount']))? $lesson_details['hourly_rate']*100 : $lesson_details['hourly_rate']-$payment['transaction_amount'];
		
		require_once("vendor/autoload.php");
		# Read the fields that were automatically submitted by stripe.js
		$token = $_POST['stripeToken'];
		# Setup the Start object with your private API key
		Stripe::setApiKey($settings['stripe_secret']);
		# Process the charge
		try {
			$charge = Charge::Create(
				array(
					"amount" => $amount,
					"currency" => CURRENCY,
					"description" => "Example charge",
					"source" => $token,
				)
			);
			$array = json_decode(json_encode($charge),TRUE);
			$transaction_id = $array['id'];
			$card_id = $array['source']['id'];
			//change lesson status, add payment
			$this->lesson_model->changeLessonStatus($lesson_id,PENDING,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);
//			$this->lesson_model->changeLessonPaymentStatus($lesson_id,TRANSFERRED_BY_GUEST);
			$message_id = $this->message_model->addMessage($lesson_details['student_id'],$lesson_details['tutor_id'],$lesson_id,"Lesson dues paid by -[first_name]-");
			$this->message_model->updateMessage($message_id,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);
			$this->payment_model->addPayments($lesson_id,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date'],$transaction_id,$card_id,$amount,TRANSFERRED_BY_GUEST);
			$this->session->set_userdata('payment_done' , 1);
			header("Location: ".ROUTE_MESSAGE_HISTORY."/".$lesson_id);
		} catch (Exception $e) {
			$this->session->set_userdata('payment_done' , 0);
			header("Location: ".ROUTE_LESSON_DETAILS."/".$lesson_id);
		}
    }
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 02: savePaymentDetails
	*
	* This function helps user to save bank account details
	*
	*/
	function savePaymentDetails($param=null){
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$objResponse = new xajaxResponse();
			$user_id = $param['user_id'];
			$title = $param['title'];
			$bank_name = $param['bank_name'];
			$address = $param['address'];
			$account_number = $param['account_number'];
			$swift_code = $param['swift_code'];
			$phone_code = $param['phone_code'];
			$phone = $param['phone'];
			
			$qResponse = $this->payment_model->savePaymentDetails($user_id,$title,$bank_name,$address,$account_number,$swift_code,$phone_code,$phone);
			if($qResponse){
				$url = ROUTE_LESSONS;
				$msg = "Payment details saved successfully";
				$objResponse->script('successAlerts("'.$msg.'","'.$url.'");');
			}
		}
		return $objResponse;
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
	//02: paymentDeatils
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: Index
	 *
	 * This function is the entery point to this class.
	 * It shows payment history view to user.
	 *
	 */
	
    public function index() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($data['common_data']['user_id']);
		
		//Getting all payment history
		$data['taken_lessons'] = $this->payment_model->getTakenLessonsPayment($data['common_data']['user_id']);
		$data['given_lessons'] = $this->lesson_model->getGivenLessonsByUserId($data['common_data']['user_id']);
		if(!empty($data['given_lessons'])){
			foreach ($data['given_lessons'] as $key=>$given_lesson){
				$data['given_lessons'][$key]['students'] = $this->lesson_model->getLessonStudents($given_lesson['tutor_id'],$given_lesson['tutor_availability_id'],$given_lesson['lesson_date']);
			}
		}
		$template['body_content'] = $this->load->view('frontend/payment/payment-history', $data, true);
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: paymentDetails
	 *
	 * This function is the entery point to this class.
	 * It shows payment details view to user.
	 *
	 */
    public function paymentDetails() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['countries'] = $this->user_model->getCountries();
		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($data['common_data']['user_id']);
		
		//Getting all payment details
		$data['payment_details'] = $this->payment_model->getPaymentDetailsById($data['common_data']['user_id']);

		$template['body_content'] = $this->load->view('frontend/payment/payment-details', $data, true);
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file Payment.php */
/* Location: ./application/controllers/frontend/Payment.php */
