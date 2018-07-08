<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends Common {
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
		$this->data['module'] = "05";	
		$this->data['moduleURL'] = ROUTE_MESSAGES;
		$this->data['moduleName'] = "Messages";	
		$this->data['page'] = 'messages';
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: changeMessageStatusAjax
	02: addMessageAjax
	03: changeReservationStatusAjax
	--------------------------------------------------------------------------------------------------------------------------*/
	
	/**
	* 01: changeMessageStatusAjax
	*
	* This function helps user to chaneg message status (seen/unseen)
	*
	*/
/*	function changeMessageStatusAjax($param=null){
		// Checking whether parametres are null or not
		if ($param != null) {
			$reservation_id = $param['reservation_id'];
			$status = $param['status'];
			$objResponse = new xajaxResponse();
			$receiver_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
//			if($status != SEEN){
				$qResponse = $this->message_model->changeMessageStatus($receiver_id,$reservation_id);
//			}
			$url = ROUTE_MESSAGE_DETAILS.'/'.$reservation_id;
			$objResponse->script('window.location = "'.$url.'";');
		}
		return $objResponse;
	}*/
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 02: addMessageAjax
	*
	* This function helps user to send message in reply
	*
	*/
	function addMessageAjax($param=null){
		// Checking whether parametres are null or not
		if ($param != null) {
			$sender_id = $param['sender_id'];
			$receiver_id = $param['receiver_id'];
			$lesson_id = $param['lesson_id'];
			$message = $param['message'];
			$objResponse = new xajaxResponse();
			$lesson_details = $this->lesson_model->getLessonById($lesson_id);
			$getAllReceiver = $this->message_model->getAllReceiver($lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);
			$message_id = $this->message_model->addMessage($sender_id,$receiver_id,$lesson_id,$message);
			$this->message_model->updateMessage($message_id,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);
			foreach ($getAllReceiver as $data){
				if($lesson_id != $data['id']){
					$receiver_id = $data['student_id'];
					$message_id = $this->message_model->addMessage($sender_id,$receiver_id,$data['id'],$message);
					$this->message_model->updateMessage($message_id,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);
				} 
			}
		}
		return $objResponse;
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 03: changeLessonStatusAjax
	*
	* This function helps user to change lesson status
	*
	*/
	function changeLessonStatusAjax($param=null){
		// Checking whether parametres are null or not
		if ($param != null) {
			$lesson_id = $param['lesson_id'];
			$tutor_id = $param['tutor_id'];
			$student_id = $param['student_id'];
			$status = $param['status'];
			$objResponse = new xajaxResponse();

			// user details for user role
			$user_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
			$user_data = $this->user_model->getUserById($user_id);
			if($user_id == $tutor_id){
				$sender_id = $tutor_id;
				$receiver_id = $student_id;
			} else {
				$sender_id = $student_id;
				$receiver_id = $tutor_id;				
			}
			//
			$message = "";
			if($status == PENDING){
				$message = ucfirst($user_data['first_name'])." has changed the lesson status to pending.";
			} else if($status == CANCELED){
				$message = "Lesson has been canceled by ".ucfirst($user_data['first_name'])."";
			} else if($status == APPROVED){
				$message = "Lesson has been approved by ".ucfirst($user_data['first_name'])."";
			} else if($status == COMPLETED){
				$message = "Lesson has been completed by ".ucfirst($user_data['first_name'])."";
			} else if($status == DISPUTED){
				$message = ucfirst($user_data['first_name'])." marked this Lesson as disputed";
			} else if($status == PENDING_APPROVAL){
				$message = "Completion approval required";
			}
			$lesson_details = $this->lesson_model->getLessonById($lesson_id);
			$message_id = $this->message_model->addMessage($sender_id,$receiver_id,$lesson_id,$message);
			$this->message_model->updateMessage($message_id,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);
			$qResponse = $this->lesson_model->changeLessonStatus($lesson_id,$status,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);
			
			$url = ROUTE_MESSAGE_HISTORY.'/'.$lesson_id;
			$objResponse->script('window.location = "'.$url.'";');
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
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: Index
	 *
	 * This function is the entery point to this class. 
	 * It shows profile view to user.
	 *
	 */
	
    public function index() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		if($data['common_data']['user_data']['role'] == INACTIVE_STATUS_ID){
			header("Location: ".ROUTE_PROFILE);
			die();
		}

		$receiver_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
		// getting all new messages by receiver_id
		$data['taken_lesson_messages'] = $this->message_model->getLessonTakenMsgsByReceiverId($receiver_id);
		$data['given_lesson_messages'] = $this->message_model->getLessonGivenMsgsByReceiverId($receiver_id);
		$given_lesson_count = 0;
		if(!empty($data['given_lesson_messages'])){
			foreach($data['given_lesson_messages'] as $row){
				if($row['tutor_id'] == $row['receiver_id'] && $row['status'] == 0)
				$given_lesson_count++;
			}
			
		}
		$taken_lesson_count = 0;
		if(!empty($data['taken_lesson_messages'])){
			foreach($data['taken_lesson_messages'] as $row){
				if($row['student_id'] == $row['receiver_id'] && $row['status'] == 0)
				$taken_lesson_count++;
			}
			
		}
		$data['given_lesson_messages_count'] = $given_lesson_count;
		$data['taken_lesson_messages_count'] = $taken_lesson_count;

		$template['body_content'] = $this->load->view('frontend/message/index', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: messageHistory
	 *
	 * This function is the entery point to this class. 
	 * It shows profile message to user.
	 *
	 */
	
    public function messageHistory($lesson_id) {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['pageName'] = "Message Details";
		
		//Getting all lesson details
		$data['lesson_details'] = $this->lesson_model->getLessonDetailsById($lesson_id,$data['common_data']['user_id']);
		//get payment details
//		$data['payment'] = $this->payment_model->getPaymentByReservationId($reservation_id);
		
//		$data['guest_details'] = $this->user_model->getUserById($data['reservation_details']['student_id']);

		// getting all messages by lesson_id
		$data['messages'] = $this->message_model->getMsgsByLessonId($lesson_id,$data['lesson_details']['tutor_availability_id'],$data['lesson_details']['lesson_code'],$data['lesson_details']['lesson_date']);
		$user_id = $this->session->userdata(WEBSITE_FRONTEND_SESSION);
		$changeMessageStatus = $this->message_model->changeMessageStatus($user_id,$lesson_id,$data['lesson_details']['tutor_availability_id'],$data['lesson_details']['lesson_code'],$data['lesson_details']['lesson_date']);
		$changeAdminMessageStatus = $this->message_model->changeAdminMessageStatus($data['lesson_details']['tutor_availability_id'],$data['lesson_details']['lesson_code'],$data['lesson_details']['lesson_date']);
		$data['common_data']['message_count'] = $this->message_model->getUnreadMsgsByReceiverId($user_id);

		if($data['lesson_details']['tutor_id'] !=$user_id && $data['lesson_details']['student_id'] !=$user_id ){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}
			$template['body_content'] = $this->load->view('frontend/message/message-history', $data, true);	
			$this->load->view('frontend/layouts/template', $template, false);
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file message.php */
/* Location: ./application/controllers/frontend/message.php */
