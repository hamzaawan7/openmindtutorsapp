<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends Backendcommon {
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
		$this->data['moduleName'] = "Lessons";	
		$this->data['page'] = 'lessons';
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: sendEmailAjax
	02: changeLessonStatusAjax
	01: markAsPayedAjax
	02: refundAjax
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 01: sendEmailAjax
	*
	* This function changes reservation status 
	*
	*/
	public function sendEmailAjax($param = null){
	$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) {
			$lesson_id = $param['lesson_id'];
			$tutor_availability_id = $param['tutor_availability_id'];
			$lesson_code = $param['lesson_code'];
			$lesson_date = $param['lesson_date'];
			$message = $param['admin_message'];
			$admin_data = $this->user_model->getAdminById($_SESSION[WEBSITE_BACKEND_SESSION]);
				$lesson_details = $this->lesson_model->getLessonById($lesson_id);
				$lesson_students = $this->lesson_model->getLessonStudents($lesson_details['tutor_id'],$tutor_availability_id,$lesson_date);
				$tutor_data = $this->user_model->getUserById($lesson_details['tutor_id']);

			$qResponse = $this->lesson_model->addMessage($admin_data['id'],$lesson_id,$message,UNSEEN,$tutor_availability_id,$lesson_code,$lesson_date);
			if($qResponse){
				
				$tutor_email = $tutor_data['email'];
				$subject = "Message Alert (Disputed Lesson)";
				$email_msg = "Hello ".ucfirst($tutor_data['first_name'])."!<br><br>Open Mind Tutors has replied to your disputed lesson ".$lesson_code.". Please click on the following link to view your lesson details: <a href='".ROUTE_LOGIN."'>Open Mind Tutors</a>.<br><br>
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				$sender = NO_REPLY;
				sendEmail($sender,$tutor_email,$email_msg,$subject);
				
				// sending alert to students
				foreach ($lesson_students as $students){
					$student_email = $students['email'];
				$email_msg = "Hello ".ucfirst($students['first_name'])."!<br><br>Open Mind Tutors has replied to your disputed lesson ".$lesson_code.". Please click on the following link to view your lesson details: <a href='".ROUTE_LOGIN."'>Open Mind Tutors</a>.<br><br>
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
					sendEmail($sender,$student_email,$email_msg,$subject);
				}
				$msg = "Message sent successfully";
				$url = BACKEND_LESSON_DETAILS_URL.'/'.$lesson_id;
				$objResponse->script( "successAlerts('".$msg."','".$url."')" );
			} else {
				$objResponse->script( "bootbox.alert('Something went wrong! Try again later')" );				
			}
		}
		return $objResponse ;
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 02: changeLessonStatusAjax
	*
	* This function changes lesson status 
	*
	*/
	public function changeLessonStatusAjax($param = null){
	$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) {
			$lesson_id = $param['lesson_id'];
			$tutor_availability_id = $param['tutor_availability_id'];
			$lesson_code = $param['lesson_code'];
			$lesson_date = $param['lesson_date'];
			$status = $param['status'];
			$qResponse = $this->lesson_model->changeLessonStatus($tutor_availability_id,$lesson_code,$lesson_date,$status);
			// add message
			$admin_data = $this->user_model->getAdminById($_SESSION[WEBSITE_BACKEND_SESSION]);
			$add_message = $this->lesson_model->addMessage($admin_data['id'],$lesson_id,"This lesson has been marked as compeleted",UNSEEN,$tutor_availability_id,$lesson_code,$lesson_date);

			//email
			$lesson_details = $this->lesson_model->getLessonById($lesson_id);
			$lesson_students = $this->lesson_model->getLessonStudents($lesson_details['tutor_id'],$tutor_availability_id,$lesson_date);
			$tutor_data = $this->user_model->getUserById($lesson_details['tutor_id']);
			
				$tutor_email = $tutor_data['email'];
				$subject = "Dispute Resolved";
				$email_msg = "Hello ".ucfirst($tutor_data['first_name'])."!<br><br>Open Mind Tutors has resolved your dispute and marked lesson ".$lesson_code." as completed. Please click on the following link to view your lesson details: <a href='".ROUTE_LOGIN."'>Open Mind Tutors</a>.<br><br>
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				$sender = NO_REPLY;
				sendEmail($sender,$tutor_email,$email_msg,$subject);
				
				// sending alert to students
				foreach ($lesson_students as $students){
					$student_email = $students['email'];
					$email_msg = "Hello ".ucfirst($students['first_name'])."!<br><br>Open Mind Tutors has resolved your dispute and marked lesson ".$lesson_code." as completed. Please click on the following link to view your lesson details: <a href='".ROUTE_LOGIN."'>Open Mind Tutors</a>.<br><br>
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
					sendEmail($sender,$student_email,$email_msg,$subject);
				}
			//email
			
			$msg = "Lesson marked as Compeleted";
			$url = BACKEND_LESSON_DETAILS_URL.'/'.$lesson_id;
			$objResponse->script( "successAlerts('".$msg."','".$url."')" );
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
	//02: lessonDetails
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: Index
	 *
	 * This function is the entery point to this class. 
	 * It shows lessons list view to admin.
	 *
	 */
	
    public function index() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = "lessons";

		$global_filters = array('lesson');
		$filters = $_GET;
		if(!empty($_GET)){
			$i=0;
			foreach($filters as $key=>$row){
				$abc[$i] = $key;
				$i++;
			}
			$containsSearch = $containsSearch = count(array_intersect($abc, $global_filters)) == count($abc);
			if(empty($containsSearch)){
				show_404();
				die();
			}
		}
		$lesson = isset($_GET['lesson'])? $_GET['lesson']:0;
		$data['lessons'] = $this->lesson_model->get($lesson);
		
		$template['body_content'] = $this->load->view('backend/lessons/index', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: lessonDetails
	 *
	 * This function is the entery point to this class. 
	 * It shows lesson details to admin.
	 *
	 */
	
    public function lessonDetails($lesson_id) {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = "lessons";

		$data['lesson_details'] = $this->lesson_model->getLessonById($lesson_id);
		if(empty($data['lesson_details'])){
			show_404();
			die();
		}
		$data['level_details'] = $this->lesson_model->getLevelById($data['lesson_details']['level_id']);
		$data['lesson_students'] = $this->lesson_model->getLessonStudents($data['lesson_details']['tutor_id'],$data['lesson_details']['tutor_availability_id'],$data['lesson_details']['lesson_date']);		$data['lesson_active_students'] = $this->lesson_model->getLessonActiveStudents($data['lesson_details']['tutor_id'],$data['lesson_details']['tutor_availability_id'],$data['lesson_details']['lesson_date']);
		if($data['lesson_details']['lesson_type'] == GROUP_AVAILABLE){
			$data['messages'] = $this->lesson_model->getGroupMessages($data['lesson_details']['tutor_availability_id'],$data['lesson_details']['lesson_date'],$data['lesson_details']['lesson_code']);
		} else {
			$data['messages'] = $this->lesson_model->getMessages($lesson_id);
		}
		if(!empty($data['messages'])){
			foreach ($data['messages'] as $key=>$message){
				$user_data = array();
				if ($message['receiver_id'] != 0){
					$user_data = $this->lesson_model->getUserData($message['sender_id']);
					$data['messages'][$key]['sender_first_name'] = $user_data['sender_first_name'];
					$data['messages'][$key]['sender_last_name'] = $user_data['sender_last_name'];
					$data['messages'][$key]['role'] = $user_data['role'];
					$data['messages'][$key]['image'] = $user_data['image'];
				}
			}
		}
		if(!empty($data['lesson_students'])){
			foreach ($data['lesson_students'] as $key=>$students){
				$data['lesson_students'][$key]['payments'] = $this->payment_model->getPaymentByLessonId($students['id']);
			}
		}
		
		$template['body_content'] = $this->load->view('backend/lessons/lesson-details', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file lessons.php */
/* Location: ./application/controllers/backend/lessons.php */
