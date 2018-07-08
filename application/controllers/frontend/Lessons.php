<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends Common {
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
		$this->data['mainSubjects'] = $this->mainSubjects();
		$this->data['module'] = "04";
		$this->data['moduleURL'] = ROUTE_LESSONS;
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
	01: addReviewsAjax
	02: changeLessonStatusAjax
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 01: addReviewsAjax
	*
	* This function helps user to add reviews about lesson
	*
	*/
	function addReviewsAjax($param=null){
		// Checking whether parametres are null or not
		if ($param != null) {
			$lesson_id = $param['lesson_id'];
			$tutor_id = $param['tutor_id'];
			$student_id = $param['student_id'];
			$rating = $param['rating'];
			$review = $param['review'];
			$review_headline = $param['review_headline'];
			$review_outcome = $param['review_outcome'];
			$objResponse = new xajaxResponse();

			// user details for user role
			$user_data = $this->user_model->getUserById($student_id);
			$tutor_data = $this->user_model->getUserById($tutor_id);
			$sender_id = $student_id;
			$receiver_id = $tutor_id;
			$message = "-[first_name]- added review";
			
			$lesson_details = $this->lesson_model->getLessonById($lesson_id);
			$message_id = $this->message_model->addMessage($sender_id,$receiver_id,$lesson_id,$message);
			$this->message_model->updateMessage($message_id,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);
			$qResponse = $this->reviews_model->addReviews($lesson_id,$tutor_id,$student_id,$rating,$review,$review_headline,$review_outcome);
			if($qResponse){
				
				// email
				$tutor_email = $tutor_data['email'];
				$subject = "Add Review - Open Mind Tutors";
				$email_msg = "Hello ".ucfirst($tutor_data['first_name'])."!<br><br>".ucfirst($user_data['first_name'])." just wrote a review to your lesson ".$lesson_details['lesson_code'].".
							<br>Please click on the following link to view your lesson details: <a href='".ROUTE_LOGIN."'>Open Mind Tutors</a>.<br><br>
							Sincerely,
							<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				$sender = NO_REPLY;
				sendEmail($sender,$tutor_email,$email_msg,$subject);
				// email

				$url = ROUTE_LESSON_DETAILS.'/'.$lesson_id;
				$msg = "Review added successfully";
				$objResponse->script('successAlerts("'.$msg.'","'.$url.'");');
			}
		}
		return $objResponse;
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 02: changeLessonStatusAjax
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
			$email_status = "";
			if($status == PENDING){
				$message = "Lesson status has been changed to pending by -[first_name]-.";
				$email_status = "Pending";
			} else if($status == CANCELED){
				$message = "Lesson has been canceled by -[first_name]-";
				$email_status = "Canceled";
			} else if($status == APPROVED){
				$message = "Lesson has been approved by -[first_name]-";
				$email_status = "Approved";
			} else if($status == COMPLETED){
				$message = "Lesson has been completed by -[first_name]-";
				$email_status = "Completed";
			} else if($status == DISPUTED){
				$message = "Lesson has been marked as disputed by -[first_name]-";
				$email_status = "Disputed";
			} else if($status == PENDING_APPROVAL){
				$message = "Compeletion approval required";
				$email_status = "Compeletion approval required";
			}
			$lesson_details = $this->lesson_model->getLessonById($lesson_id);
			$getAllReceiver = $this->message_model->getAllReceiver($lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);			$message_id = $this->message_model->addMessage($sender_id,$receiver_id,$lesson_id,$message);			$this->message_model->updateMessage($message_id,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);			foreach ($getAllReceiver as $data){				if($lesson_id != $data['id']){					$receiver_id = $data['student_id'];					$message_id = $this->message_model->addMessage($sender_id,$receiver_id,$data['id'],$message);					$this->message_model->updateMessage($message_id,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);				} 			}
			$qResponse = $this->lesson_model->changeLessonStatus($lesson_id,$status,$lesson_details['tutor_availability_id'],$lesson_details['lesson_code'],$lesson_details['lesson_date']);

				// email
				$tutor_data = $this->user_model->getUserById($tutor_id);
				$lesson_students = $this->lesson_model->getLessonStudents($lesson_details['tutor_id'],$lesson_details['tutor_availability_id'],$lesson_details['lesson_date']);
				
				$tutor_email = $tutor_data['email'];
				$subject = "Lesson Status - Open Mind Tutors";
				$email_msg = "Hello ".ucfirst($tutor_data['first_name'])."!<br><br>".ucfirst($user_data['first_name'])." has just updated lesson ".$lesson_details['lesson_code']." to ".$email_status.".<br>Please click on the following link to view your lesson details: <a href='".ROUTE_LOGIN."'>Open Mind Tutors</a><br><br>
				Sincerely,<br>
				<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				$sender = NO_REPLY;
				sendEmail($sender,$tutor_email,$email_msg,$subject);
				// sending alert to students
				
				foreach ($lesson_students as $students){
					$student_email = $students['email'];
					$email_msg = "Hello ".ucfirst($students['first_name'])."!<br><br>".ucfirst($user_data['first_name'])." has just updated lesson ".$lesson_details['lesson_code']." to ".$email_status.".<br>Please click on the following link to view your lesson details: <a href='".ROUTE_LOGIN."'>Open Mind Tutors</a><br><br>
					Sincerely,<br>
					<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
					sendEmail($sender,$student_email,$email_msg,$subject);
				}
				/* admin email if lesson canceled */
				if($status == CANCELED){
					$settings = $this->user_model->getSiteSettings();
					$receiver1 = $settings['contact_email'];
					$subject = "Lesson Status - Open Mind Tutors";
					$email_msg = "Hello Admin!<br><br>".ucfirst($user_data['first_name'])." has just updated lesson ".$lesson_details['lesson_code']." to ".$email_status.".<br>Please click on the following link to view lesson details: <a href='".BACKEND_SERVER_URL."'>Open Mind Tutors</a><br><br>
					Sincerely,<br>
					<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
					$sender = NO_REPLY;
					sendEmail($sender,$receiver1,$email_msg,$subject);
				}
				// email
			
			$url = ROUTE_MESSAGE_HISTORY.'/'.$lesson_id;
			$objResponse->script('window.location = "'.$url.'";');
		}
		return $objResponse;
	}
	function changeStudentStatus($param=null){
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
			$student_data = $this->user_model->getUserById($student_id);
			if($user_id == $tutor_id){
				$sender_id = $tutor_id;
				$receiver_id = $student_id;
			} else {
				$sender_id = $student_id;
				$receiver_id = $tutor_id;				
			}
			//
			$message = "";
			$email_status = "";
			if($status == DISABLED_STATUS_ID){
				$message = $student_data['first_name']." status has been changed to Rejected by -[first_name]-.";
			} else if($status == ACTIVE_STATUS_ID){
				$message = $student_data['first_name']." status has been changed to Accepted by -[first_name]-.";
			}
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
			$qResponse = $this->lesson_model->changeStudentStatus($lesson_id,$status);
			
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
	//02: lessonDetails
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: Index
	 *
	 * This function is the entery point to this class.
	 * It shows lessons view to user.
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
		//Getting all lessons
		$data['taken_lessons'] = $this->lesson_model->getTakenLessonsByUserId($data['common_data']['user_id']);
		$data['given_lessons'] = $this->lesson_model->getGivenLessonsByUserId($data['common_data']['user_id']);
		$student_exist = 0;
		if(!empty($data['given_lessons'])){
			foreach ($data['given_lessons'] as $key=>$given_lesson){
				$data['given_lessons'][$key]['students'] = $this->lesson_model->getLessonStudents($given_lesson['tutor_id'],$given_lesson['tutor_availability_id'],$given_lesson['lesson_date']);				
				$students = $this->lesson_model->getLessonStudents($given_lesson['tutor_id'],$given_lesson['tutor_availability_id'],$given_lesson['lesson_date']);
				foreach($students as $row_student){
					if($row_student['is_active'] != DISABLED_STATUS_ID){
						$student_exist++;
					}
				}
			}
		}
		$data['student_exist_given_lessons'] = $student_exist;
		$template['body_content'] = $this->load->view('frontend/lessons/lessons', $data, true);
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: lessonDetails
	 *
	 * This function is the entery point to this class.
	 * It shows lesson details view to user.
	 *
	 */
	
    public function lessonDetails($lesson_id) {
		//$this->comingSoon();
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['pageName'] = "Lesson Details";
		//Getting all lesson details
		$data['lesson_details'] = $this->lesson_model->getLessonDetailsById($lesson_id,$data['common_data']['user_id']);
		if(empty($data['lesson_details'])){
			show_404();
			die();
		}
		$data['lesson_students'] = $this->lesson_model->getLessonStudents($data['lesson_details']['tutor_id'],$data['lesson_details']['tutor_availability_id'],$data['lesson_details']['lesson_date']);
		if(!empty($data['lesson_students'])){
			foreach ($data['lesson_students'] as $key=>$students){
				$data['lesson_students'][$key]['payments'] = $this->payment_model->getPaymentByLessonId($students['id']);
			}
		}
		$data['total_reviews'] = $this->reviews_model->getLessonTotalReviews($lesson_id);
		$data['all_reviews'] = $this->reviews_model->getReviewsByLessonId($lesson_id);
		$data['tutor_reviews'] = $this->reviews_model->getTutorReviewsByLessonId($data['lesson_details']['tutor_availability_id'],$data['lesson_details']['lesson_code'],$data['lesson_details']['lesson_date']);
		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($data['lesson_details']['tutor_id']);
		$data['tutor_level'] = $this->profile_model->getLevelById($data['tutor_details']['level_id']);

		$template['body_content'] = $this->load->view('frontend/lessons/lesson-detail', $data, true);
		$this->load->view('frontend/layouts/template', $template, false);
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file Lessons.php */
/* Location: ./application/controllers/frontend/lessons.php */
