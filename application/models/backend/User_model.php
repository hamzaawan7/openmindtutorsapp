<?php
class User_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	//FUNCTIONS LIST:
	//0: Get
	//0: getUserById
	//0: editProfile
	//0: editPic
	//0: changeStatus
	
	//--- Get Functions ---
	// Get
	function get() {
		$qStr = "SELECT 
					users.*
				 FROM
					users
				 WHERE 
					users.is_active != ".DELETED_STATUS_ID." 
					ORDER BY users.created DESC";
		$query = $this->db->query($qStr);  
		return $query->result_array();
	}
	function getTutors() {
		$qStr = "SELECT 
					users.*,tutor_details.certificate_file,tutor_details.info_file,tutor_details.hourly_rate,
					tutor_details.personal_statement, tutor_details.subject_level
				 FROM
					users
				 INNER JOIN
					tutor_details
					ON
					users.id = tutor_details.tutor_id
				 WHERE 
					users.is_active != ".DELETED_STATUS_ID."
					ORDER BY users.created DESC";
		$query = $this->db->query($qStr);  
		return $query->result_array();
	}
	function getStudents() {
		$qStr = "SELECT 
					 *
				 FROM
					users
				 WHERE 
					users.is_active != ".DELETED_STATUS_ID." AND users.role = 2
					-- users.role = 2
				-- ORDER BY users.created DESC";
		$query = $this->db->query($qStr);  
		return $query->result_array();
	}
	
	// getUserById
	function getUserById($user_id) {
		$qStr = "SELECT 
					users.*, countries.nicename as country
				 FROM
					users
				 LEFT JOIN 
					countries
					ON
					users.country_id = countries.id 
				 WHERE 
					users.id = ".$user_id;
		$query = $this->db->query($qStr);  
		return $query->row_array();
	}
	function getTutorDetails($user_id){
		$qStr = "SELECT 
					tutor_details.*,levels.title as level_name
				 FROM
					tutor_details
				 INNER JOIN
					levels
					ON
					levels.id = tutor_details.level_id
				 WHERE 
					tutor_details.tutor_id = ".$user_id;
		$query = $this->db->query($qStr);  
		return $query->row_array();		
	}
	function getLevels(){
		$qStr = "SELECT 
					*
				 FROM
					levels				 
				 WHERE 
					is_active != ".DELETED_STATUS_ID;
		$query = $this->db->query($qStr);  
		return $query->result_array();				
	}
	function getTierLevels(){
		$qStr = "SELECT 
					*
				 FROM
					levels				 
				 WHERE 
					level_type = ".TIER." AND is_active != ".DELETED_STATUS_ID;
		$query = $this->db->query($qStr);  
		return $query->result_array();				
	}
	function getAdminById($id){
		$qStr = "SELECT 
					*
				 FROM
					admin
				 WHERE 
					id = '".$id."' AND is_active != ".DELETED_STATUS_ID;
		
		$query = $this->db->query($qStr);
		return $query->row_array();		
	}
	function getPendingUsers(){
		$qStr = "SELECT 
					COUNT(*) as total_users
				 FROM
					users
				 WHERE 
					is_active = ".APPROVAL_STATUS_ID;
		$query = $this->db->query($qStr);  
		return $query->row_array();		
	}
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
	function getStudentsubjects($user_id){
		$qStr = "SELECT 
					student_subjects.main_subject_id, main_subjects.name
				 FROM
					student_subjects
				 INNER JOIN
					main_subjects
						ON
					student_subjects.main_subject_id = main_subjects.id
				 WHERE
				 student_subjects.student_id = ".$user_id." AND
				 student_subjects.is_active != ".DELETED_STATUS_ID."
				 GROUP BY student_subjects.main_subject_id";
		$query = $this->db->query($qStr);  
		$result = $query->result_array();
		if(!empty($result)){
			foreach($result as $key=>$row){
				$result[$key]['subjects'] = $this->getStuSubjects($user_id,$row['main_subject_id']);
			}
		}
		return $result;		
	}
	function getStuSubjects($user_id,$main_subject_id){
		$qStr = "SELECT 
					student_subjects.subject_name
				 FROM
					student_subjects
				 WHERE
				 student_subjects.student_id = ".$user_id." AND
				 student_subjects.main_subject_id = ".$main_subject_id."";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	
	function getTutorsubjectsForReports($user_id){
		$qStr = "SELECT 
					tutor_subjects.main_subject_id, main_subjects.name
				 FROM
					tutor_subjects
				 INNER JOIN
					main_subjects
						ON
					tutor_subjects.main_subject_id = main_subjects.id
				 WHERE
				 tutor_subjects.tutor_id = ".$user_id." AND
				 tutor_subjects.is_active != ".DELETED_STATUS_ID."
				 GROUP BY tutor_subjects.main_subject_id";
		$query = $this->db->query($qStr);  
		$result = $query->result_array();
		$subjects_list = '';
		if(!empty($result)){
			foreach($result as $key=>$row){
				$subjects_list = $this->getTutrSubjectsForReports($user_id,$row['main_subject_id']);
			}
		}
		return $subjects_list;
	}
	
	function getTutrSubjectsForReports($user_id,$main_subject_id){
		$qStr = "SELECT 
					tutor_subjects.subject_name
				 FROM
					tutor_subjects
				 WHERE
				 tutor_subjects.tutor_id = ".$user_id." AND
				 tutor_subjects.main_subject_id = ".$main_subject_id."";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		foreach($result as $subject){
			$r_subjects[] = $subject['subject_name'];
		}
		$subjects = implode(', ', $r_subjects);
		return $subjects;
	}

    //10: Login
    function login($email,$password) {
        $qStr = "SELECT
				 	*
				 FROM
				 	users
				 WHERE 
					users.email = '".$email."' AND users.password = '".$password."' AND (is_active = ".ACTIVE_STATUS_ID." OR is_active = ".APPROVAL_STATUS_ID." OR is_active = ".DISABLED_STATUS_ID.")";
        $query = $this->db->query($qStr);
        return $query->row_array();
    }

    function getTutorsubjects($user_id){
		$qStr = "SELECT 
					tutor_subjects.main_subject_id, main_subjects.name
				 FROM
					tutor_subjects
				 INNER JOIN
					main_subjects
						ON
					tutor_subjects.main_subject_id = main_subjects.id
				 WHERE
				 tutor_subjects.tutor_id = ".$user_id." AND
				 tutor_subjects.is_active != ".DELETED_STATUS_ID."
				 GROUP BY tutor_subjects.main_subject_id";
		$query = $this->db->query($qStr);  
		$result = $query->result_array();
		if(!empty($result)){
			foreach($result as $key=>$row){
				$result[$key]['subjects'] = $this->getTutrSubjects($user_id,$row['main_subject_id']);
			}
		}
		return $result;
	}
	function getTutrSubjects($user_id,$main_subject_id){
		$qStr = "SELECT 
					tutor_subjects.subject_name
				 FROM
					tutor_subjects
				 WHERE
				 tutor_subjects.tutor_id = ".$user_id." AND
				 tutor_subjects.main_subject_id = ".$main_subject_id."";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	

	//*** Get Functions ***
	
	//--- Update Functions ---
	// editAdminProfile
	function editAdminProfile($user_id,$first_name,$last_name,$email,$phone,$description){
		$qStr = "UPDATE 
					admin
				 SET
					first_name = '".$first_name."',last_name = '".$last_name."',email = '".$email."',phone = '".$phone."',description = '".$description."',
					modified = ".time()."
				 WHERE 
					id = '".$user_id."'";
		return $query = $this->db->query($qStr);		
	}
	// editPic
	function editPic($user_id,$file_name){
		$qStr = "UPDATE 
					admin
				 SET
					image = '".$file_name."', modified = ".time()."
				 WHERE 
					id = '".$user_id."'";
		return $query = $this->db->query($qStr);		
	}
	function getTutorPaymentDetails($tutor_id){
		$qStr = "SELECT 
					*
				 FROM
					tutor_payment_details
				 WHERE 
					user_id = '".$tutor_id."' AND is_active != ".DELETED_STATUS_ID;
		
		$query = $this->db->query($qStr);
		return $query->row_array();		
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
	// ChangeStatus
	function changeStatus($user_id,$status) {
		$qStr = "UPDATE 
					users
				 SET
					is_active = '".$status."', modified = ".time()."
				 WHERE 
					id = '".$user_id."'";
		return $query = $this->db->query($qStr);
	}
	
	function featureUser($user_id,$status) {
		$qStr = "UPDATE 
					users
				 SET
					is_featured = '".$status."', modified = ".time()."
				 WHERE 
					id = '".$user_id."'";
		return $query = $this->db->query($qStr);
	}
	// changeAccessStatus
	function changeAccessStatus($user_id,$status){
		$qStr = "UPDATE 
					users
				 SET
					access_type = '".$status."', modified = ".time()."
				 WHERE 
					id = '".$user_id."'";
		return $query = $this->db->query($qStr);
	}
	// changeTutorLevel
	function changeTutorLevel($user_id,$level_id){
		$qStr = "UPDATE 
					tutor_details
				 SET
					level_id = '".$level_id."', modified = ".time()."
				 WHERE 
					tutor_id = '".$user_id."'";
		return $query = $this->db->query($qStr);
	}
	// changeTutorBadge
	function changeTutorBadge($user_id,$tutor_badge){
		$qStr1 = "DELETE FROM tutor_badges WHERE tutor_id = ".$user_id;
		$query1 = $this->db->query($qStr1);
		if(!empty($tutor_badge)){
			for($i=0;$i<count($tutor_badge);$i++){
				$qStr = "INSERT INTO 
							tutor_badges
						 SET
							tutor_id = '".$user_id."' , badge_id = '".$tutor_badge[$i]."', created = ".time()."
							";
				$query = $this->db->query($qStr);
			}
			return true;
		}
	}
	function changeSiteStatus($status){
		$qStr = "UPDATE 
					settings
				 SET
					is_live = '".$status."', modified = ".time()."
				 WHERE 
					id = 1";
		return $query = $this->db->query($qStr);		
	}
	//*** Update Functions ***	

	//--- Insert Functions ---
	//*** Insert Functions ***	
}
?>
