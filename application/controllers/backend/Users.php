<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Backendcommon {
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
		$this->data['module'] = "02";	
		$this->data['moduleName'] = "Users";	
		$this->data['page'] = 'users';
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
	
	/**
	* 01: changeUserStatusAjax
	*
	* This function changes user status i.e. "Active / Inactive / Deleted"
	*
	*/
	public function changeUserStatusAjax($param = null){
		$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$user_id = $param['user_id'];
			$status = $param['status'];
			$user_details = $this->user_model->getUserById($user_id);
			
			// Changing user status in DB
			$delete_response = $this->user_model->changeStatus($user_id,$status);
			if($delete_response){
				$user_status = "";
				if($status == ACTIVE_STATUS_ID){
					$user_status = "Approved";
				} else if($status == INACTIVE_STATUS_ID){
					$user_status = "Suspended";
				} else {
					$user_status = "Deleted";
				}
				$to_email = $user_details['email'];				
				//Getting email details from DB
				$from_email = NO_REPLY;
				$email_subject = " Account ".$user_status;
				$email_content = "Hello ".ucfirst($user_details['first_name'])."!<br /><br />Your account has been ".$user_status.". For more queries please contact us at <a href='".ROUTE_CONTACT_US."'>Open Mind Tutors</a> <br /><br />
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='".FRONTEND_ASSET_IMAGES_DIR."omt-logo.png'/>";
				//Send Email (Function in common helper)
				$email = sendEmail($from_email,$to_email,$email_content,$email_subject);
				$url = (isset($_SERVER['HTTPS']) ? "https" : "http") .'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				$objResponse->script( "window.location = '".$url."'" );
			}
		}
		return $objResponse ;
	}
	
	public function featureUserAjax($param = null){
		$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$user_id = $param['user_id'];
			$status = $param['status'];
			$user_details = $this->user_model->getUserById($user_id);
			
			// Changing user status in DB
			$response = $this->user_model->featureUser($user_id,$status);
			if($response){
				$url = (isset($_SERVER['HTTPS']) ? "https" : "http") .'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				$objResponse->script( "window.location = '".$url."'" );
			}
		}
		return $objResponse ;
	}
	
	/**
	* 02: changeUserAccessLevelAjax
	*
	* This function changes user access status i.e. "Limited / Complete "
	*/
	public function changeUserAccessLevelAjax($param = null){
		$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$user_id = $param['user_id'];
			$status = $param['status'];
			$user_details = $this->user_model->getUserById($user_id);
			
			// Changing user status in DB
			$delete_response = $this->user_model->changeAccessStatus($user_id,$status);
			if($delete_response){
				$url = (isset($_SERVER['HTTPS']) ? "https" : "http") .'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				$objResponse->script( "window.location = '".$url."'" );
			}
		}
		return $objResponse ;
	}
	/**
	* 02: changeTutorLevelAjax
	*
	* This function changes user level
	*
	*/
	public function changeTutorLevelAjax($param = null){
		$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$user_id = $param['user_id'];
			$level_id = $param['level_id'];
			// Changing user status in DB
			$delete_response = $this->user_model->changeTutorLevel($user_id,$level_id);
			if($delete_response){
				$objResponse->script( "location.reload();" );
			}
		}
		return $objResponse ;
	}
	/**
	* 03: changeTutorBadgeAjax
	*
	* This function changes user badge
	*
	*/
	public function changeTutorBadgeAjax($param = null){
		$objResponse = new xajaxResponse();
		// Checking whether parametres are nullor not
		if ($param != null) { 
			$user_id = $param['user_id'];
			$tutor_badge = $param['tutor_badge'];
			// Changing user status in DB
			$delete_response = $this->user_model->changeTutorBadge($user_id,$tutor_badge);
			if($delete_response){
				$objResponse->script( "location.reload();" );
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
	//01: students
	//02: studentDetails
	//03: tutors
	/*--------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 01: students
	 *
	 * This function is the entery point to this class. 
	 * It shows students list view to admin.
	 *
	 */
	
    public function students() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = "students";
		//Getting all users
		$data['users'] = $this->user_model->get();
		$template['body_content'] = $this->load->view('backend/users/students', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: studentDetails
	 *
	 * This function is the entery point to this class. 
	 * It shows users details view to admin.
	 *
	 */
	
    public function studentDetails($user_id) {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = "students";
		//Getting all users
		$data['student_details'] = $this->user_model->getUserById($user_id);
		if(empty($data['student_details'])){
			show_404();
			die();
		}
		$data['payments'] = $this->payment_model->getStudentLessonPayments($user_id);
		$data['subjects'] = $this->user_model->getStudentsubjects($user_id);

		$template['body_content'] = $this->load->view('backend/users/student-details', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 03: tutors
	 *
	 * This function is the entery point to this class. 
	 * It shows tutors list view to admin.
	 *
	 */
	
    public function tutors() {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = "tutors";
		//Getting all users
		$data['users'] = $this->user_model->getTutors();
		$template['body_content'] = $this->load->view('backend/users/tutors', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}
	/*-------------------------------------------------------------------------------------------------------------------------*/
	/**
	 * 02: tutorDetails
	 *
	 * This function is the entery point to this class. 
	 * It shows users details view to admin.
	 *
	 */
	
    public function tutorDetails($user_id) {
		//assign public class values to function variable
		$data = $this->data;
		$data['common_data'] = $this->common_data;
		$data['page'] = "tutors";
		//Getting all users
		$data['tutor'] = $this->user_model->getUserById($user_id);
		if(empty($data['tutor'])){
			show_404();
			die();
		}
		$data['tutor_details'] = $this->user_model->getTutorDetails($user_id);
		$data['levels'] = $this->user_model->getLevels();
		$data['payments'] = $this->payment_model->getTutorLessonPayments($user_id);
/*		if(empty($data['payments'])){
			show_404();			die();		}*/
			if(!empty($data['payments'])){			foreach($data['payments'] as $key=>$row){				$data['payments'][$key]['omt_percentage'] = $this->lesson_model->getLevelById($row['level_id']);				$data['payments'][$key]['lesson_students'] = $this->lesson_model->getLessonActiveStudents($row['tutor_id'],$row['tutor_availability_id'],$row['lesson_date']);				$data['payments'][$key]['payment'] = $this->payment_model->getTutorPayments($row['tutor_availability_id'],$row['lesson_code'],$row['lesson_date']);			}		}
		$data['reviews'] = $this->review_model->getTutorReviews($user_id);
		$data['tutor_payment_details'] = $this->user_model->getTutorPaymentDetails($user_id);
		$data['tutor_badges'] = $this->user_model->getTutorBadges($user_id);
		$data['badges'] = $this->user_model->getBadges();
		$data['subjects'] = $this->user_model->getTutorsubjects($user_id);

		$template['body_content'] = $this->load->view('backend/users/tutor-details', $data, true);	
		$this->load->view('backend/layouts/template', $template, false);		
	}

    /**
     * 02: loginAjax
     *
     * This function is to validate and grand access to admin via Email login.
     *
     */
    public function hardLoginAjax($param=null) {
        // Checking whether parametres are nullor not
        if ($param != null) {
            $email = $param['email'];
            $password = $param['password'];
            $remember_me = $param['remember_me'];
            $objResponse = new xajaxResponse();
            // Encoding password
            $password = $password;
            //Validating email and password
            $user_data = $this->user_model->login($email,$password);
            if(!empty($user_data)) {
                if($user_data['first_login'] == 1)
                {
                    $objResponse->script('$("#loginForm .errorMsg").html("Please confirm your email first or <a href='."javascript:void(0)".' id='."resend_confirm_url".'>Resend Confirmation Link</a>");');
                } else {
                    if($remember_me == 1)
                    {
                        $cookie_time = (3600 * 24 * 30); // 30 days
                        $hash = md5($user_data['created']); // will result in a 32 characters hash
                        setcookie (WEBSITE_COOKIE, 'usr='.$user_data['email'].'&hash='.$hash, time() + $cookie_time);

                    }
                    //Redirecting to admin panel
                    $this->session->set_userdata(WEBSITE_FRONTEND_SESSION , $user_data['id']);
                    $this->session->set_userdata(WEBSITE_FRONTEND_ACCESS_TYPE , $user_data['access_type']);
                    $objResponse->script( "window.location = '".ROUTE_LESSONS."';" );
                }
            }else {
                //Failure Message
                $objResponse->script('$(".errorMsg").text("Invalid Credentials");');
            }
        }
        return $objResponse;
    }

	public function export_tutors_csv() {
		
		$filer_name = 'tutors_report ('.date("m-d-Y",time()).').csv';
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$filer_name);

		$output = fopen('php://output', 'w');
		
		fputcsv($output, array( 'Sr #', 'First Name', 'Last Name', 'Email', 'Phone #', 'Post Code', 'Subjects', 'Levels', 'Personal Statement'));
		$users = $this->user_model->getTutors();
			
			if(!empty($users)){
					$index = 1;
					foreach($users as $user)
					{
						$subjects = $this->user_model->getTutorsubjectsForReports($user['id']);
						
						$data['index'] = $index++;	
						$data['first_name'] = $user['first_name'];						
						$data['last_name'] = $user['last_name'];
						$data['email'] = $user['email'];
						$data['phone'] = $user['phone_code'].' '.$user['phone'];
						$data['postal_code'] = $user['postal_code'];
						$data['subjects'] = $subjects;
						$data['subject_level'] = ($user['subject_level']=='null' ? '':$user['subject_level']);
						$data['personal_statement'] = strip_tags($user['personal_statement']);
						fputcsv($output, $data);
					}
					// loop over the rows, outputting them		
			}
	}
	//For exporting students report to csv 
	public function export_students_csv() {
		// print_r("here");
  //       die();
		$filer_name = 'students_report ('.date("m-d-Y",time()).').csv';
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$filer_name);

		$output = fopen('php://output', 'w');
		
		fputcsv($output, array( 'Sr #', 'First Name', 'Last Name', 'Email', 'Phone #'));
		$users = $this->user_model->getStudents();
			
			if(!empty($users)){
					$index = 1;
					foreach($users as $user)
					{
						// $subjects = $this->user_model->getTutorsubjectsForReports($user['id']);
						
						$data['index'] = $index++;	
						$data['first_name'] = $user['first_name'];						
						$data['last_name'] = $user['last_name'];
						$data['email'] = $user['email'];
						//$data['phone'] = $user['phone_code'].' '.$user['phone'];
						$data['phone'] = $user['phone'];
						// $data['postal_code'] = $user['postal_code'];
						// $data['subjects'] = $subjects;
						// $data['subject_level'] = ($user['subject_level']=='null' ? '':$user['subject_level']);
						// $data['personal_statement'] = strip_tags($user['personal_statement']);
						fputcsv($output, $data);
					}
					// loop over the rows, outputting them		
			}
	}	
	/*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file users.php */
/* Location: ./application/controllers/backend/users.php */
