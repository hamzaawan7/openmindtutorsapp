<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admins extends Backendcommon
{
    //initializing public data variable for class
    public $data = '';

    function __construct()
    {
        parent::__construct();
        //I.E Fix: Holds SESSION accross the DOMAIN
        header('P3P: CP="CAO PSA OUR"');
        $this->isLoggedIn();
        //------------ Model Functions <Start>-----------------//
        //------------ Model Functions <End>-----------------//

        //------------ Libraries <Start> -----------------//
        //------------ Libraries <End> -----------------//

        //------------ XAJAX <Start> -----------------//
        $this->xajax->configure('javascript URI', base_url() . 'xajax');
        $this->xajax->processRequest();
        $this->xajax_js = $this->xajax->getJavascript(base_url());
        //------------ XAJAX <End> -----------------//
        $this->output->enable_profiler(false);

        //------------ Common Function <Start> -----------------//
        $this->commonFunction();
        //------------ Common Function <End> -----------------//
        //------------ Class Common Values <Start> -----------------//
        $this->data['module'] = "02";
        $this->data['moduleName'] = "Admins";
        $this->data['page'] = 'admins';
        //------------ Class Common Values <Start> -----------------//
    }

    /*
	|--------------------------------------------------------------------------
	| AJAX FUNCTIONS <Start>
	|--------------------------------------------------------------------------
	*/
    /*--------------------------------------------------------------------------------------------------------------------------

   FUNCTIONS LIST:
   01: changeAdminStatusAjax
   --------------------------------------------------------------------------------------------------------------------------*/

    /**
     * 01: changeAdminStatusAjax
     *
     * This function changes admin status i.e. "Active / Inactive / Deleted"
     *
     */
    public function changeAdminStatusAjax($param = null)
    {
        $objResponse = new xajaxResponse();
        // Checking whether parametres are nullor not
        if ($param != null) {
            $admin_id = $param['admin_id'];
            $status = $param['status'];
            $admin_details = $this->admin_model->getAdminById($admin_id);

            // Changing admin status in DB
            $delete_response = $this->admin_model->changeStatus($admin_id, $status);
            if ($delete_response) {
                $admin_status = "";
                if ($status == ACTIVE_STATUS_ID) {
                    $admin_status = "Approved";
                } else if ($status == INACTIVE_STATUS_ID) {
                    $admin_status = "Suspended";
                } else {
                    $admin_status = "Deleted";
                }
                $to_email = $admin_details['email'];
                //Getting email details from DB
                $from_email = NO_REPLY;
                $email_subject = " Account " . $admin_status;
                $email_content = "Hello " . ucfirst($admin_details['first_name']) . "!<br /><br />Your account has been " . $admin_status . ". For more queries please contact us at <a href='" . ROUTE_CONTACT_US . "'>Open Mind Tutors</a> <br /><br />
									Sincerely,<br />
									<img alt='logo' style='width: 120px;' src='" . FRONTEND_ASSET_IMAGES_DIR . "omt-logo.png'/>";
                //Send Email (Function in common helper)
                $email = sendEmail($from_email, $to_email, $email_content, $email_subject);
                $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                $objResponse->script("window.location = '" . $url . "'");
            }
        }
        return $objResponse;
    }


    /*
    |--------------------------------------------------------------------------
    | AJAX FUNCTIONS <Ed>
    |--------------------------------------------------------------------------
    */

    /*--------------------------------------------------------------------------------------------------------------------------*/

    //FUNCTIONS LIST:
    //01: admins
    /*--------------------------------------------------------------------------------------------------------------------------*/
    /**
     * 01: admins
     *
     * This function is the entery point to this class.
     * It shows students list view to admin.
     *
     */

    public function admins()
    {
        $user = $this->session->all_userdata();
        if ($user['open-mind-tutors-backend-id'] == 1) {
            //assign public class values to function variable
            $data = $this->admin_model->getAdmins();
            $data['common_data'] = $this->common_data;
            $data['page'] = "admins";
            //Getting all admins
            $data['users'] = $this->admin_model->getAdmins();
            $template['body_content'] = $this->load->view('backend/admins/admins', $data, true);
            $this->load->view('backend/layouts/template', $template, false);
        } else {
            redirect('admin/lessons-requests');
        }
    }
    /*-------------------------------------------------------------------------------------------------------------------------*/

    /*-------------------------------------------------------------------------------------------------------------------------*/
    /**
     * 02: admin-create
     *
     * This function is the entery point to this class.
     * It creates admin.
     *
     */

    public function adminCreate()
    {
        $user = $this->session->all_userdata();
        if ($user['open-mind-tutors-backend-id'] == 1) {
            //assign public class values to function variable
            $data = $this->data;
            $data['common_data'] = $this->common_data;
            $data['page'] = "admins";
            $data['moduleName'] = "Admins";
            //Creating admin
            $template['body_content'] = $this->load->view('backend/admins/create-admin', $data, true);
            $this->load->view('backend/layouts/template', $template, false);
        } else {
            redirect('admin/lessons-requests');
        }
    }

    public function adminAddRequest($params = NULL)
    {
        $user = $this->session->all_userdata();
        if ($user['open-mind-tutors-backend-id'] == 1) {
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $password = encrypt_url($_POST["password"]);
            $status = 1;

            $qStr = "INSERT INTO
					admin
				SET
					first_name = '" . $first_name . "', 
					last_name = '" . $last_name . "', 
					password = '" . $password . "',
					is_active = " . $status . ", 
					email = '" . $email . "', 
					created = " . time() . ",
					modified = " . time();

            $this->db->query($qStr);

            $admin_id = $this->db->insert_id();

            redirect('admin/admins');

            return $admin_id;
        } else {
            redirect('admin/lessons-requests');
        }
    }

    /*-------------------------------------------------------------------------------------------------------------------------*/
}
/* End of file admins.php */
/* Location: ./application/controllers/backend/admins.php */
