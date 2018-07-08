<?php

class Admin_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    //FUNCTIONS LIST:
    //0: Get
    //0: getAdminById

    //--- Get Functions ---
    // Get
    function get()
    {
        $qStr = "SELECT 
					admin.*
				 FROM
					admin
				 WHERE 
					admin.is_active != " . DELETED_STATUS_ID . " 
					ORDER BY admin.created DESC";
        $query = $this->db->query($qStr);
        return $query->result_array();
    }

    function getAdmins()
    {
        $qStr = "SELECT 
					admin.*,tutor_details.certificate_file,tutor_details.info_file,tutor_details.hourly_rate,
					tutor_details.personal_statement, tutor_details.subject_level
				 FROM
					admin
				 INNER JOIN
					tutor_details
					ON
					admin.id = tutor_details.tutor_id
				 WHERE 
					admin.is_active != " . DELETED_STATUS_ID . "
					ORDER BY admin.created DESC";
        $query = $this->db->query($qStr);
        return $query->result_array();
    }

    function getAdminById($id)
    {
        $qStr = "SELECT 
					*
				 FROM
					admin
				 WHERE 
					id = '" . $id . "' AND is_active != " . DELETED_STATUS_ID;

        $query = $this->db->query($qStr);
        return $query->row_array();
    }
    //*** Update Functions ***

    // ChangeStatus
    function changeStatus($admin_id,$status) {
        $qStr = "UPDATE 
					admin
				 SET
					is_active = '".$status."', modified = ".time()."
				 WHERE 
					id = '".$admin_id."'";
        return $query = $this->db->query($qStr);
    }
    //--- Insert Functions ---

    //*** Insert Functions ***
}

?>
