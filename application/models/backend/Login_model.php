<?php
class Login_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	//FUNCTIONS LIST:
	//01: login
	//02: getUser
	//03: getEmailDetails
	//04: getUserByEmail
	//05: updatePassword
	//06: updateAccount

	//--- Get Functions ---
	//01: Login
	function login($email,$password) { 
		$qStr = "SELECT
				 	admin.id, admin.email, admin.created
				 FROM
				 	admin
				 WHERE 
					admin.email = '".$email."' AND admin.password = '".$password."' AND is_active = ".ACTIVE_STATUS_ID;
		
		$query = $this->db->query($qStr);  
		return $query->row_array();
	}
	
	//02: getUser
	function getUser($email) {
		$qStr = "SELECT 
					*
				 FROM
					admin
				 WHERE 
					email = '".$email."'";
		
		$query = $this->db->query($qStr);  
		return $query->row_array();
	}
	
	//04: getUserByEmail
	function getUserByEmail($email) {
		$qStr = "SELECT 
					*
				 FROM
					admin
				 WHERE 
					email = '".$email."'";
		
		$query = $this->db->query($qStr);  
		return $query->row_array();
	}
	//*** Get Functions ***
	
	//--- Update Functions ---
	//05: updatePassword
	function updatePassword($id, $password) {
		$qStr = "UPDATE 
					admin
				 SET
					password = '".$password."', modified = ".time()."
				 WHERE 
					id = '".$id."'";
					
		$query = $this->db->query($qStr);
	}
	function updatePasswordForgot($email, $password) {
		$qStr = "UPDATE 
					admin
				 SET
					password = '".$password."', modified = ".time()."
				 WHERE 
					email = '".$email."'";
					
		$query = $this->db->query($qStr);
	}
	//*** Update Functions ***	
}
?>
