<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Backendcommon extends CI_Controller
{
    //------------ Global data <Start>-----------------//	
    public $common_data = array();

    //------------ Global data <Start>-----------------//	
    function __construct()
    {
        parent::__construct();
        //session_start();
        //I.E Fix: Holds SESSION accross the DOMAIN 
        header('P3P: CP="CAO PSA OUR"');
        //------------ Model Functions <Start>-----------------//
        $this->load->model('backend/login_model');
        $this->load->model('backend/user_model');
        $this->load->model('backend/admin_model');
        $this->load->model('backend/lesson_model');
        $this->load->model('backend/payment_model');
        $this->load->model('backend/review_model');
        $this->load->model('backend/page_model');
        //------------ Model Functions <End>-----------------//	

        //------------ XAJAX <Start> -----------------//
        $this->xajax->registerFunction(array('logoutAjax', $this, 'logoutAjax'));
        $this->xajax->registerFunction(array('MGRequestAjax', $this, 'MGRequestAjax'));
        $this->xajax->configure('javascript URI', base_url() . 'xajax');
        $this->xajax->processRequest();
        $this->xajax_js = $this->xajax->getJavascript(base_url());
        //------------ XAJAX <End> -----------------//

        $this->output->enable_profiler(false);
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX FUNCTIONS <Start>
    |--------------------------------------------------------------------------
    */

    /*--------------------------------------------------------------------------------------------------------------------------
    
    FUNCTIONS LIST:
    01:MGRequestAjax
    02:logoutAjax
    --------------------------------------------------------------------------------------------------------------------------*/
    /**
     * 01: MGRequestAjax
     *
     * This function is the calling point to every other ajax function
     *
     */
    public function MGRequestAjax($functionName, $param = null)
    {
        $objResponse = new xajaxResponse();
        $objResponse = $this->$functionName($param);
        return $objResponse;
    }
    /*--------------------------------------------------------------------------------------------------------------------------*/
    /**
     * 02: logoutAjax
     *
     * This function is to logout admin
     *
     */
    public function logoutAjax()
    {
        $objResponse = new xajaxResponse();
        //unsetting user session
        $cookie_name = WEBSITE_BACKEND_COOKIE;
        setcookie($cookie_name, "", time() - 3600);
        $this->session->unset_userdata(WEBSITE_BACKEND_SESSION);
        $objResponse->script("window.location = '" . BACKEND_SERVER_URL . "';");

        while (!$this->session->userdata(WEBSITE_BACKEND_SESSION)) {
            return $objResponse;
        }
    }
    /*--------------------------------------------------------------------------------------------------------------------------*/
    /*
    |--------------------------------------------------------------------------
    | AJAX FUNCTIONS <End>
    |--------------------------------------------------------------------------
    */
    /*--------------------------------------------------------------------------------------------------------------------------
   
   FUNCTIONS LIST:
   01: commonFunction
   02: isLoggedIn
   03: isUserLoggedIn
   04: errorPage
   05: movePage
   --------------------------------------------------------------------------------------------------------------------------*/
    /**
     * 01: commonFunction
     *
     * This function is used to save user common data which can be used globaly in this website
     *
     */
    public function commonFunction()
    {

        //Creating global variables
        if ($this->session->userdata(WEBSITE_BACKEND_SESSION)) {
            $user_data = $this->user_model->getAdminById($_SESSION[WEBSITE_BACKEND_SESSION]);
            $this->common_data['user_data'] = $user_data;
            $this->common_data['user_id'] = $user_data['id'];
            $this->common_data['users_count'] = $this->user_model->getPendingUsers();
            $this->common_data['reviews_count'] = $this->review_model->getPendingReviews();
            $this->common_data['site_status'] = $this->user_model->getSiteStatus();
            $this->common_data['site_settings'] = $this->user_model->getSiteSettings();
            $this->common_data['lessons_count'] = $this->lesson_model->getDisputedLessons();
            $this->common_data['pending_payments'] = $this->payment_model->getPendingPayment();
        } else {
            $this->common_data['user_data'] = '';
        }
    }

    /**
     * 02: isLoggedIn
     *
     * This function checks whether admin is logged in or not, if user is not logged n it will redirect to the login page
     */
    public function isLoggedIn()
    {
        if ($this->session->userdata(WEBSITE_BACKEND_SESSION)) {
            //Do Nothing
        } else {
            header("Location: " . BACKEND_SERVER_URL);
            die();
        }
    }

    /**
     * 03: isUserLoggedIn
     *This function is used to prevent redirection to the login page without logout
     */
    public function isUserLoggedIn()
    {

        if ($this->session->userdata(WEBSITE_BACKEND_SESSION)) {
            header("Location: " . BACKEND_LESSONS_REQUESTS_URL);
            die();
        } else {
            return false;
        }
    }

    /**
     * 04: errorPage
     *This function is used to redirect the user to the error page
     */
    public function errorPage()
    {
        header("Location: " . ROUTE_404_ERROR);
        die();
    }

    /**
     * 05: movePage
     *This function is used to redirect the user to any page
     */
    public function movePage($url)
    {
        header("Location: " . $url);
        die();
    }

    /**
     * 02: refundAjax
     *
     * This function refunds amount
     *
     */
    public function refundAjax($param = null)
    {
        $objResponse = new xajaxResponse();
        // Checking whether parametres are nullor not
        if ($param != null) {
            $lesson_id = $param['lesson_id'];
            $transaction_id = $param['transaction_id'];
            $tutor_availability_id = $param['tutor_availability_id'];
            $lesson_code = $param['lesson_code'];
            $lesson_date = $param['lesson_date'];
            $refunded_amount = $param['transaction_amount'];
            $student_id = $param['student_id'];
            $settings = $this->user_model->getSiteSettings();
            //		$refunded_amount = $refunded_amount*100; // Cents
            require_once("vendor/autoload.php");
            # Setup the Start object with your private API key
            \Stripe\Stripe::setApiKey($settings['stripe_secret']);
            # Process the charge
            try {
                $refund = \Stripe\Refund::create(array(
                    "charge" => $transaction_id,
                    //			  "amount"    => $refunded_amount,
                    "reason" => "requested_by_customer"
                ));

                $status = REFUNDED;
                $qResponse = $this->payment_model->addRefunds($transaction_id, $lesson_id, $refunded_amount, $status, $tutor_availability_id, $lesson_code, $lesson_date);
                if ($qResponse) {
                    // email
                    $student_data = $this->user_model->getUserById($student_id);
                    $student_email = $student_data['email'];
                    $subject = "Refund Alert";
                    $email_msg = "Hello " . ucfirst($student_data['first_name']) . "!<br><br>Open Mind Tutors has refunded your amount " . CURRENCY_SYMBOL . $refunded_amount / 100 . " for the lesson " . $lesson_code . ". Please click on the following link to view your lesson details:
									<a href='" . ROUTE_LOGIN . "'>Open Mind Tutors</a><br><br>
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='" . FRONTEND_ASSET_IMAGES_DIR . "omt-logo.png'/>";
                    $sender = NO_REPLY;
                    sendEmail($sender, $student_email, $email_msg, $subject);
                    // email
                    $msg = CURRENCY_SYMBOL . $refunded_amount / 100 . " GBP refunded successfully";
                    $url = BACKEND_LESSON_DETAILS_URL . "/" . $lesson_id;
                    $objResponse->script("successAlerts('" . $msg . "','" . $url . "')");
                }
            } catch (Exception $e) {
                $error_message = "Something went wrong!";
                /* depending on $error_code we can show different messages */
                $url = "";
                $objResponse->script("successAlerts('" . $error_message . "','" . $url . "')");
            }
        }
        return $objResponse;
    }

    /**
     * 01: markAsPayedAjax
     *
     * This function changes
     *
     */
    public function markAsPayedAjax($param = null)
    {
        $objResponse = new xajaxResponse();
        // Checking whether parametres are nullor not
        if ($param != null) {
            $lesson_id = $param['lesson_id'];
            $tutor_availability_id = $param['tutor_availability_id'];
            $lesson_code = $param['lesson_code'];
            $lesson_date = $param['lesson_date'];
            $payment_amount = $param['payment_amount'];
            $payment_amount = $payment_amount * 100;

            // Changing user status in DB
            $qResponse = $this->lesson_model->markAsPayed($tutor_availability_id, $lesson_code, $lesson_date);
            if ($qResponse) {

                // email
                $lesson_details = $this->lesson_model->getLessonById($lesson_id);
                $tutor_data = $this->user_model->getUserById($lesson_details['tutor_id']);
                $tutor_email = $tutor_data['email'];
                $subject = "Payment Alert";
                $email_msg = "Hello " . ucfirst($tutor_data['first_name']) . "!<br><br>Open Mind Tutors has paid amount " . $payment_amount / 100 . " for the lesson " . $lesson_details['lesson_code'] . ". Please click on the following link to view your lesson details:
									<a href='" . ROUTE_LOGIN . "'>Open Mind Tutors</a><br><br>
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='" . FRONTEND_ASSET_IMAGES_DIR . "omt-logo.png'/>";
                $sender = NO_REPLY;
                sendEmail($sender, $tutor_email, $email_msg, $subject);
                // email

                $status = TRANSFERRED_BY_ADMIN;
                $this->payment_model->addPayment($lesson_id, $payment_amount, $status, $tutor_availability_id, $lesson_code, $lesson_date);
                $objResponse->script("location.reload();");
            }
        }
        return $objResponse;
    }

    function changeSiteStatus($param = null)
    {
        $objResponse = new xajaxResponse();
        // Checking whether parametres are nullor not
        if ($param != null) {
            $status = $param['status'];
            // Changing user status in DB
            $qResponse = $this->user_model->changeSiteStatus($status);
            if ($qResponse) {
                $msg = "Site updated!";
                $url = "";
                $objResponse->script("successAlerts('" . $msg . "','" . $url . "')");
            }
        }
        return $objResponse;
    }
    /*--------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file Backendcommon.php */
/* Location: ./application/controllers/backend/Backendcommon.php */
