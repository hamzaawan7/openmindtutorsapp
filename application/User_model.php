<?php
class User_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	/*------------ Function List <Start>-----------------
	01: isUserExist
	02: isUserEmailExist
	03: getUserById
	04: registerByEmail
	------------ Function List <End>-----------------*/
	/* -------- GET FUNCTIONS <START> -------- */
    //01: isUserExist
	function isUserExist($email) {
        $qStr = "SELECT
					id,email
				 FROM
					users
				 WHERE
					email = '".$email."' AND is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
        return $query->row_array();
    }
    
	//02: isUserEmailExist
    function isUserEmailExist($email) {
        $qStr = "SELECT
					*
				 FROM
					users
				 WHERE
					email = '".$email."' AND is_active != ".DELETED_STATUS_ID;

        $query = $this->db->query($qStr);
        $user_id = $query->row_array();
        return $user_id;
    }
    //03: getUserById
	function getUserById($id) {
        $qStr = "SELECT
					users.*,countries.nicename
				 FROM
					users
				 LEFT JOIN
					countries
						ON
					countries.id = users.country_id
				 WHERE
					users.id = '".$id."'";

        $query = $this->db->query($qStr);
        return $query->row_array();        
    }
	//10: Login
	function login($email,$password) {
		$qStr = "SELECT
				 	*
				 FROM
				 	users
				 WHERE 
					users.email = '".$email."' AND users.password = '".$password."' AND (is_active = ".ACTIVE_STATUS_ID." OR is_active = ".APPROVAL_STATUS_ID." OR is_active = ".DISABLED_STATUS_ID.") AND account_type != ".FACEBOOK_ACCOUNT_TYPE."";
		$query = $this->db->query($qStr);
		return $query->row_array();
	}
	//01: loginByFacebook
    function loginByFacebook($fb_id,$first_name,$last_name,$email,$image_url) {
		//Check if User Entry Exists
		$qStr = "SELECT
					id,email,is_active
				 FROM
					users
				 WHERE
					email = '".$email."' AND is_active != ".DELETED_STATUS_ID;	
		$query = $this->db->query($qStr);
		$user_id ='';
		$result = $query->row_array();
           
		if(empty($result)) {	//Case: New User
			$qStr1 = "INSERT INTO 
				 	 	users
				 	 SET 
						first_name = '".$first_name."',last_name = '".$last_name."', password = "omt123456", email = '".$email."', image = '".$image_url."', first_login = ".INACTIVE_STATUS_ID.",
						fb_id = '".$fb_id."', is_active = ".APPROVAL_STATUS_ID.", access_type = ".DEFAULT_ACCESS_TYPE.", account_type = ".FACEBOOK_ACCOUNT_TYPE." , created = ".time();  
				$query1= $this->db->query($qStr1);
				$user_id = $this->db->insert_id();
		} else {
			$qStr1 = "UPDATE 
				 	 	users
				 	 SET 
						modified = ".time().", email = '".$email."', fb_id = '".$fb_id."'
					 WHERE
					  id = ".$result['id'];
				$query1= $this->db->query($qStr1);
			$user_id = $result['id'];
		}
                return $user_id;
		
	}
	function getTutorBadges($tutor_id){
		$qStr = "SELECT 
					*
				 FROM
					tutor_badges
				 WHERE 
					tutor_id = '".$tutor_id."' AND is_active != ".DELETED_STATUS_ID;
		
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		$badge = array();
		if(!empty($result)){
			foreach($result as $key=>$row){
				$badge[$key] = $row['badge_id'];
			}
		}
		return $badge;
	}
	function getBadges(){
		$qStr = "SELECT 
					*
				 FROM
					badges
				 WHERE
				 is_active != ".DELETED_STATUS_ID."
				 ORDER BY name ASC";
		$query = $this->db->query($qStr);  
		$result = $query->result_array();
		return $result;
	}
	/* -------- GET FUNCTIONS <END> -------- */
	/* -------- INSERT FUNCTIONS <START> -------- */
	//04: registerByEmail
	public function registerByEmail($role,$first_name,$last_name,$phone_number,$email,$password,$status,$confirmation_code) {
		$qStr ="INSERT INTO
					users
				SET
					first_name = '".$first_name."', last_name = '".$last_name."', phone='".$phone_number."', password = '".$password."' , confirmation_code = '".$confirmation_code."' ,
					is_active = ".$status.", access_type = ".DEFAULT_ACCESS_TYPE.", email = '".$email."', first_login = ".ACTIVE_STATUS_ID.", role = ".$role.", 
					account_type = ".EMAIL_ACCOUNT_TYPE.", created = ".time();
		$query = $this->db->query($qStr);
		$user_id = $this->db->insert_id();
        return $user_id;
	}
	/* -------- INSERT FUNCTIONS <END> -------- */
	/* -------- UPDATE FUNCTIONS <START> -------- */
	//4: Deactivate user first_login
    function deactivateUserFirstLogin($user_id,$code_type) {
		$qStr ="UPDATE
						users
					SET
						first_login = ".INACTIVE_STATUS_ID."
					WHERE
						id=".$user_id;
        $query = $this->db->query($qStr);
	}
	/* -------- UPDATE FUNCTIONS <END> -------- */

	//11: Get User
	function getUser($email) {
		$qStr = "SELECT 
					*
				 FROM
					users
				 WHERE 
					email = '".$email."'
					AND is_active != ".DELETED_STATUS_ID;
		
		$query = $this->db->query($qStr);  
		return $query->row_array();
	}

	//12: Get User By Email
	function getUserByEmail($email) {
		$qStr = "SELECT 
					email,password,created,access_type
				 FROM
					users
				 WHERE 
					email = '".$email."'";
		
		$query = $this->db->query($qStr);  
		return $query->row_array();
	}

	//13: Update Password
	function updatePassword($email, $password) {
		$qStr = "UPDATE 
					users
				 SET
					password = '".$password."', modified = ".time()."
				 WHERE 
					email = '".$email."'";
					
		$query = $this->db->query($qStr);
	}

	//15: getAdminEmail
	public function getAdminEmail(){
		$qStr = "SELECT 
					email
				 FROM
					admin
				 WHERE 
					is_active = ".ACTIVE_STATUS_ID;
		
		$query = $this->db->query($qStr);  
		$admin = $query->row_array();
		return (!empty($admin) ? $admin['email']:'');
	}
	function getCountries(){
		$qStr = "SELECT 
					*
				 FROM
					countries
				 ORDER BY name ASC";
		
		$query = $this->db->query($qStr);  
		return $query->result_array();
	}
	function getLanguages(){
		$qStr = "SELECT 
					*
				 FROM
					languages";
		
		$query = $this->db->query($qStr);  
		return $query->result_array();		
	}
	/* -------- UPDATE FUNCTIONS <START> -------- */
	
	function changeUserRole($user_id,$role,$status){
		$qStr ="UPDATE
						users
					SET
						role = ".$role.", is_active = ".$status."
					WHERE
						id=".$user_id;
        return $query = $this->db->query($qStr);
	}
	function getTotalLessons($user_id){
		$qStr = "SELECT 
					COUNT(*) as total_lessons
				 FROM
					lessons
				 WHERE
					tutor_id = ".$user_id." AND status = ".COMPLETED;
		$query = $this->db->query($qStr);  
		$result = $query->row_array();
		return $result['total_lessons'];
	}
	function getAvgRating($user_id){
		$qStr = "SELECT 
					AVG(rating) as avg_rating
				 FROM
					reviews
				 WHERE
					tutor_id = ".$user_id." AND is_active = ".ACTIVE_STATUS_ID;
		$query = $this->db->query($qStr);  
		$result = $query->row_array();
		return $result['avg_rating'];
	}
	function updateLevel($level_name,$user_id,$tutor_level_id){
		$qStr1 = "SELECT 
					*
				 FROM
					levels
				 WHERE
					title = '".$level_name."'";
		$query1 = $this->db->query($qStr1);
		$result1 = $query1->row_array();
		$level_id = $result1['id'];
		if($level_id != $tutor_level_id){
			$qStr ="UPDATE
							tutor_details
						SET
							level_id = ".$level_id.", modified = ".time()."
						WHERE
							tutor_id=".$user_id;
			$query = $this->db->query($qStr);
			
			$qStr2 ="INSERT INTO
							tutor_level
						SET
							level_id = ".$level_id.", tutor_id=".$user_id.", created = ".time()." ";
			$query2 = $this->db->query($qStr2);
		}
	}
	function tutorLevelUpdate($user_id,$tutor_level_id){
		$user_data = $this->getUserById($user_id);
		if($user_data['role'] == STUDENT){
			$total_lessons = $this->getTotalLessons($user_id);
			$avg_rating = $this->getAvgRating($user_id);
			if($total_lessons >= 4 && $avg_rating >= 3){
				$this->updateLevel(STUDENT_LEVEL_SECOND,$user_id,$tutor_level_id);
			}
			if($total_lessons >= 8 && $avg_rating >= 3){
				$this->updateLevel(STUDENT_LEVEL_THIRD,$user_id,$tutor_level_id);
			}
			if($total_lessons >= 12 && $avg_rating >= 3){
				$this->updateLevel(STUDENT_LEVEL_FORTH,$user_id,$tutor_level_id);
			}
			if($total_lessons >= 20 && $avg_rating >= 3){
				$this->updateLevel(STUDENT_LEVEL_FIFTH,$user_id,$tutor_level_id);
			}
		}
	}
	function getSubjectsByStudentId($student_id){
        $qStr = "SELECT
					*
				 FROM
					student_subjects
				 WHERE
					student_id = '".$student_id."' AND is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		$subjects = array();
		$index = 0;
		if(!empty($result)){
			foreach ($result as $key=>$row){
				$result[$key]['main_subject'] = $this->getMainSubjectName($row['main_subject_id']);
			}
			foreach ($result as $row){
				$subjects[$row['main_subject_id']]['main_subjects'] = $row['main_subject'];
				$subjects[$row['main_subject_id']]['subjects'][$index]['id'] = $row['subject_id'];
				$subjects[$row['main_subject_id']]['subjects'][$index]['name'] = $row['subject_name'];
				$index++;
			}
		}
		return $subjects;
	}
	function getMainSubjectName($main_subject_id){
        $qStr = "SELECT
					name
				 FROM
					main_subjects
				 WHERE
					id = '".$main_subject_id."' AND is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result['name'];
	}

	/* -------- UPDATE FUNCTIONS <END> -------- */
	function getSiteStatus(){
		$qStr = "SELECT 
					*
				 FROM
					settings";
		$query = $this->db->query($qStr);  
		$result = $query->row_array();
		return $result['is_live'];
	}
	function getSiteSettings(){
		$qStr = "SELECT 
					*
				 FROM
					settings";
		$query = $this->db->query($qStr);  
		$result = $query->row_array();
		return $result;
	}

}
/* End of file User_model.php */
/* Location: ./application/models/frontend/User_model.php */
?>
