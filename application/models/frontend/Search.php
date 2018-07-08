<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Common {
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
        $this->comingSoon();
         //------------ Common Function <Start> -----------------//
        $this->commonFunction();
        //------------ Common Function <End> -----------------//
		//------------ Class Common Values <Start> -----------------//
		$this->data['mainSubjects'] = $this->mainSubjects();
		$this->data['module'] = "03";
		$this->data['moduleURL'] = ROUTE_SEARCH;
		$this->data['moduleName'] = "Tutors";
		$this->data['page'] = 'search';
		//------------ Class Common Values <Start> -----------------//
    }
    
    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
	 /*--------------------------------------------------------------------------------------------------------------------------
	
	FUNCTIONS LIST:
	01: bookLesson
	--------------------------------------------------------------------------------------------------------------------------*/
	/**
	* 01: bookLesson
	*
	* This function helps user to search for hosts
	*
	*/
	function bookLesson($param=null){
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$tutor_id = $param['tutor_id'];
			$tutor_availability_id = $param['tutor_availability_id'];
			$student_id = $param['student_id'];
			$message = $param['booking_message'];
			$lesson_date = $param['lesson_date'];
			$lesson_type = $param['lesson_type'];
			$subject = $param['book_subject'];
			if(!empty($lesson_date)){
			$lesson_date = explode('T',$lesson_date);
			$lesson_date = strtotime($lesson_date[0]);
			}
			if(empty($lesson_date) && empty($tutor_availability_id) && empty($lesson_type)){
				/* add message */
				$lesson_id = 0;
				$message_id = $this->message_model->addMessage($student_id,$tutor_id,$lesson_id,$message);
				/* email */
				$tutor_data = $this->user_model->getUserById($tutor_id);
				$student_data = $this->user_model->getUserById($student_id);
				$tutor_email = $tutor_data['email'];
				$subject = "New Message Request";
				$email_msg = "Hello ".ucfirst($tutor_data['first_name']).",<br><br>A student just sent you a message:<br><br>'<i>".$message."</i>'<br><br>To reply to the message, you will have to update your availability schedule: 
				<a href='".ROUTE_LOGIN."'>Open Mind Tutors</a><br><br>
				Sincerely,<br>
				<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				$sender = NO_REPLY;
				sendEmail($sender,$tutor_email,$email_msg,$subject);
				
				// Admin Email
				$settings = $this->user_model->getSiteSettings();
				$receiver = $settings['contact_email'];
				$subject = "New Lesson Request";
				$email_msg = "Hello Administrator,<br><br>A student named ".ucfirst($student_data['first_name'])." just booked a lesson from tutor named ".ucfirst($tutor_data['first_name'])." with following message:<br><br>
				<i>".$message."</i><br><br>
				Sincerely,<br>
				<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				$sender = NO_REPLY;
				sendEmail($sender,$receiver,$email_msg,$subject);
				
				$msg = "Message sent successfully!";
				$url = 0;
				$objResponse = new xajaxResponse();
				$objResponse->script('$("#search_detail_calendar_form_modal").modal("hide");');
				$objResponse->script('$("#book_subject").val("0");');
				$objResponse->script('$("#booking_message").val("");');
				$objResponse->script('$("#message_sent_button").prop("disabled", false)');
				$objResponse->script('bookedLesson("'.$msg.'","'.$url.'")');
				return $objResponse;
			}
			// get group lesson code
			$lesson = $this->lesson_model->getLessonCode($tutor_id,$tutor_availability_id,$lesson_date);
			if(!empty($lesson)){
				$lesson_code = $lesson['lesson_code'];
			} else {
				$lesson_code = "OMT-".generate_code();
			}
			$objResponse = new xajaxResponse();
			
			// getting tutor details
			$tutor_deials = $this->profile_model->getTutorDetailsById($tutor_id);
			$amount = $tutor_deials['hourly_rate']*100;
			$status = INACTIVE_STATUS_ID;			if($lesson_type == GROUP_AVAILABLE){				$is_active = INACTIVE_STATUS_ID;			} else {				$is_active = ACTIVE_STATUS_ID;							}
			// add reservation
			$lesson_id = $this->lesson_model->addLesson($tutor_id,$student_id,$tutor_availability_id,$lesson_code,$lesson_date,$status,$lesson_type,$subject,$is_active);

			if($lesson_id != "rejected" && $lesson_id != "booked"){
				/* add message */
				$message_id = $this->message_model->addMessage($student_id,$tutor_id,$lesson_id,$message);
				$this->message_model->updateMessage($message_id,$tutor_availability_id,$lesson_code,$lesson_date);

				/* email */
				$tutor_data = $this->user_model->getUserById($tutor_id);
				$student_data = $this->user_model->getUserById($student_id);
				$tutor_email = $tutor_data['email'];
				$subject = "New Lesson Request";
				$email_msg = "Hello ".ucfirst($tutor_data['first_name']).",<br><br>A student ".ucfirst($student_data['first_name'])."  just booked a lesson ".$lesson_code." from you. Please click on the following link to view your lesson details:<br><br>
				<a href='".ROUTE_LOGIN."'>Open Mind Tutors</a><br><br>
				Sincerely,<br>
				<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				$sender = NO_REPLY;
				sendEmail($sender,$tutor_email,$email_msg,$subject);

				$student_msg = "Hello ".ucfirst($student_data['first_name'])."!<br><br>Thank you for booking a lesson ".$lesson_code." on Open Mind Tutors. Please click on the following link to view your lesson details:
				<a href='".ROUTE_LOGIN."'>Open Mind Tutors</a><br><br>
				Sincerely,<br>
				<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				$subject1 = "Lesson Booking";
				sendEmail($sender,$student_data['email'],$student_msg,$subject1);
				// Admin Email
				$settings = $this->user_model->getSiteSettings();
				$receiver = $settings['contact_email'];
				$subject = "New Lesson Request";
				$email_msg = "Hello Administrator,<br><br>A student named ".ucfirst($student_data['first_name'])." just booked a lesson ".$lesson_code." from tutor named ".ucfirst($tutor_data['first_name'])." with following message:<br><br>
				<i>".$message."</i><br><br>
				Sincerely,<br>
				<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				$sender = NO_REPLY;
				sendEmail($sender,$receiver,$email_msg,$subject);
				/* email */

				$msg = "Message sent successfully!";
				$url = ROUTE_MESSAGE_HISTORY.'/'.$lesson_id;
				$action = ROUTE_ADD_PAYMENTS.'/'.$lesson_id;
				$objResponse->script('$("#search_detail_calendar_form_modal").modal("hide");');
				$objResponse->script('$("#book_subject").val("0");');
				$objResponse->script('$("#booking_message").val("");');
				$objResponse->script('$("#paymentForm").attr("action","'.$action.'");');
				$objResponse->script('$("#paymentForm script").attr("data-amount","'.$amount.'");');
				$objResponse->script('$("#message_sent_button").prop("disabled", false)');
				$objResponse->script('bookedLesson("'.$msg.'","'.$url.'")');
			} else {
				if($lesson_id == "rejected"){
					$objResponse->script('bootbox.alert("You have already been rejected for this lesson")');					
					$objResponse->script('$("#message_sent_button").prop("disabled", false)');
				} else {
					$objResponse->script('bootbox.alert("You have already booked this lesson")');
					$objResponse->script('$("#message_sent_button").prop("disabled", false)');
				}
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
	//02: searchDetail
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: Index
	 *
	 * This function is the entery point to this class. 
	 * It shows Search view to user.
	 *
	 */
	
    public function index() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		
		$global_filters = array('subject','level','location','rate','rating','distance','page','main_subject','sort_price','sort_rating','sort_distance');
		$filters = $_GET;
		if(!empty($_GET)){
			$i=0;
			foreach($filters as $key=>$row){
				$abc[$i] = $key;
				$i++;
			}
			$containsSearch = $containsSearch = count(array_intersect($abc, $global_filters)) == count($abc);
			if(empty($containsSearch)){
				header("Location: ".ROUTE_ERROR_PAGE);
				die();
			}
		}

				$subject = (isset($_GET['subject']))? addslashes($_GET['subject']):"";		
				$level = (isset($_GET['level']))? addslashes($_GET['level']):"";		
				$location = (isset($_GET['location']))? addslashes($_GET['location']):"";	
				$rate = (isset($_GET['rate']))? $_GET['rate']:"5,200";		
				$rating = (isset($_GET['rating']))? addslashes($_GET['rating']):0;		
				$main_subject = (isset($_GET['main_subject']))? addslashes($_GET['main_subject']):0;		
				$distance = (isset($_GET['distance']))? addslashes($_GET['distance']):10;
				$sort_price = (isset($_GET['sort_price']))? addslashes($_GET['sort_price']):"";	
				$sort_rating = (isset($_GET['sort_rating']))? addslashes($_GET['sort_rating']):"";	
				$sort_distance = (isset($_GET['sort_distance']))? addslashes($_GET['sort_distance']):"";			
				$offset = (isset($_GET['page']) && !empty($_GET['page']))? addslashes($_GET['page']):0;		
				$start = ROWS_PER_PAGE*$offset;		
				$limit = ROWS_PER_PAGE;		 
				$_url = sprintf('http://api.geonames.org/findNearbyPostalCodesJSON?postalcode='.str_replace(' ','',strtoupper($location)).'&radius=20&username=openmindtutors');		
				$_result = file_get_contents($_url);		
				$postal_result = json_decode($_result);			
				$location_codes = '';		
				if(isset($postal_result->postalCodes)){			
				foreach($postal_result->postalCodes as $key=>$postal){				
				$location_codes .= '"'.$postal->postalCode.'",';			
				}		
				}			
				if(!empty($location_codes)){				
				$location_codes = rtrim($location_codes,',');			
				} else {				
				$location_codes = '"'.strtoupper($location).'"';			
				}		
				$data['search_details'] = $this->search_model->search($subject,$level,$location,$rate,$main_subject,$rating,$distance,$start,$limit,$location_codes,$sort_price,$sort_rating,$sort_distance);
		$all_Projects = $this->search_model->searchFiltered($subject,$level,$location,$rate,$main_subject,$rating,$distance,$location_codes,$sort_price,$sort_rating,$sort_distance);
		$data['main_subject_name'] = $this->search_model->getMainSubjectById($main_subject);
		/************************* PAGINATION <Start> *************************/
		$data['first_page'] = 1;
		$data['current_page'] = $offset + 1;
		$data['last_page'] = ceil(count($all_Projects)/ROWS_PER_PAGE);
		$data['start_index'] = (ROWS_PER_PAGE * $offset) + 1;
		/************************* PAGINATION <END> *************************/

		//Searching hosts
		$template['body_content'] = $this->load->view('frontend/search/index', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: searchDetail
	 *
	 * This function is the entery point to this class. 
	 * It shows search detail view to user.
	 *
	 */
	
    public function searchDetail($tutor_name,$tutor_id) {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = 'search_details';
		$data['pageName'] = 'Tutor Profile';
		// tutor details
		$data['tutor_details'] = $this->profile_model->getTutorDetailsById($tutor_id);
		$data['user_details'] = $this->user_model->getUserById($tutor_id);
		if(preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(strtolower(str_replace(' ', '', $data['user_details']['first_name'])))) != preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(strtolower(str_replace(' ', '', $tutor_name))))){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}
		$data['avg_rating'] = $this->reviews_model->getAvgRatingByTutorId($tutor_id);
		// get level
		if(empty($data['tutor_details'])){
			$level_type = ($data['user_details']['role'] == STUDENT)? OPEN_STAR:TIER;
			$data['tutor_level'] = $this->profile_model->getTutorFirstLevel($level_type);
		} else {
			$data['tutor_level'] = $this->profile_model->getLevelById($data['tutor_details']['level_id']);
		}
		$data['tutor_reviews'] = $this->reviews_model->getReviewsByTutorId($tutor_id);
		$data['tutor_subjects'] = $this->search_model->getSubjectsByTutorId($tutor_id);
		$tutor_availablity = $this->search_model->getAvailabilityTutorId($tutor_id);
		$data['availablity'] = array();
		$dow = "";
		if(!empty($tutor_availablity)){
			$data['default_time'] = "";
			foreach($tutor_availablity as $key=>$row){
				$startend = explode("-",$row['time_available']);
				$data['availablity'][$key]['id'] = $row['id'];
				$data['availablity'][$key]['title'] = ($row['seats'] > 1)? '0/'.$row['seats'].' students':$row['seats'].' student';
				$data['availablity'][$key]['start'] = $startend[0];
				$data['availablity'][$key]['end'] = $startend[1];
				$data['availablity'][$key]['seats'] = $row['seats'];
				$data['availablity'][$key]['total_lessons'] = $row['total_lessons'];
				$lesson_date = array();
				if(!empty($row['lesson_date'])){
					foreach ($row['lesson_date'] as $key1=>$date){
						$data['availablity'][$key]['lesson_date'][$key1] = date('Y-m-d',$date['lesson_date']).','.$date['total_lessons'].','.$date['student_id'];
					}
				}else {
					$data['availablity'][$key]['lesson_date'] = array();
				}
				/*if($row['seats'] == $row['total_lessons']){
					$data['availablity'][$key]['color'] = "#E74C3C";
					$data['availablity'][$key]['status'] = "booked";
				} else if($row['total_lessons'] == 0){
					$data['availablity'][$key]['color'] = "#6AA4C1";
					$data['availablity'][$key]['status'] = "available";
				} else if($row['seats'] > $row['total_lessons']){
					$data['availablity'][$key]['color'] = "#FF9B1D";
					$data['availablity'][$key]['status'] = "reserve";
				}*/
					$data['availablity'][$key]['status'] = 0;
					$data['availablity'][$key]['dow'] = '['.$row['day_available'].']';
					$data['availablity'][$key]['lesson_type'] = $row['availability_type'];
//					$syllabus = "";
//					$syllabus = (!empty($row['syllabus']))? explode(";",$row['syllabus']):"";
//					$data['availablity'][$key]['syllabus_subject'] = (!empty($syllabus))? $syllabus[0]:"";
					$data['availablity'][$key]['syllabus'] = (!empty($row['syllabus']))? $row['syllabus']:"";
					if(empty($data['availablity'][$key]['lesson_date'])){
						$data['default_time']['available'][$key] = substr($data['availablity'][$key]['start'], 0, strpos($data['availablity'][$key]['start'], ":"));
					}else {
						$data['default_time']['not_available'][$key] = substr($data['availablity'][$key]['start'], 0, strpos($data['availablity'][$key]['start'], ":"));
					} 
			}
		}
		if(!empty($data['default_time'])){
			if(!empty($data['default_time']['available'])){
				$data['default_time_final'] = min($data['default_time']['available']).":00";
			}elseif(!empty($data['default_time']['not_available'])){
				$data['default_time_final'] = min($data['default_time']['not_available']).":00";
			}else{
				$data['default_time_final'] = "9:00";
			}		
		}
		$data['default_date'] = date('Y-m-d',time());
		$data['first_day'] = date('w');
		// error page
		if(empty($data['user_details'])){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}
		if(!isset($data['common_data']['user_id']) && empty($data['tutor_details'])){
			header("Location: ".ROUTE_ERROR_PAGE);
			die();
		}
		$data['tutor_badges'] = $this->user_model->getTutorBadges($data['tutor_details']['id']);
		$data['badges'] = $this->user_model->getBadges();
		
		$template['body_content'] = $this->load->view('frontend/search/search-detail', $data, true);	
		$this->load->view('frontend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file search.php */
/* Location: ./application/controllers/frontend/search.php */
