<?php
class Review_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	//FUNCTIONS LIST:
	//0: Get
	//0: getTutorReviews
	//0: getReviewById
	//0: changeStatus
	//--- Get Functions ---
	// Get
	function get() {
		$qStr = "SELECT 
					reviews.*, users.first_name as first_name, users.last_name as last_name, lessons.subject
				 FROM
					reviews
				 INNER JOIN 
					users
					ON
					users.id = reviews.tutor_id 
				 INNER JOIN 
					lessons
					ON
					lessons.id = reviews.lesson_id 
				 WHERE
					reviews.is_active != ".DELETED_STATUS_ID."
					ORDER BY reviews.created DESC";
		$query = $this->db->query($qStr);  
		return $query->result_array();
	}
	// getTutorReviews
	function getTutorReviews($user_id){
		$qStr = "SELECT 
					reviews.*, users.first_name , users.last_name, lessons.subject
				 FROM
					reviews
				 INNER JOIN 
					users
					ON
					users.id = reviews.student_id 
				 INNER JOIN 
					lessons
					ON
					lessons.id = reviews.lesson_id 
				 WHERE
					reviews.tutor_id = ".$user_id." AND reviews.is_active != ".DELETED_STATUS_ID."
					ORDER BY reviews.created DESC";
		$query = $this->db->query($qStr);  
		return $query->result_array();
	}
	// getReviewById
	function getReviewById($review_id){
		$qStr = "SELECT 
					reviews.*, users.first_name as tutor_first_name, users.last_name as tutor_last_name, users.image as tutor_image, 
					student.first_name as student_first_name, student.last_name as student_last_name
				 FROM
					reviews
				 INNER JOIN 
					users
					ON
					users.id = reviews.tutor_id 
				 INNER JOIN 
					users student
					ON
					student.id = reviews.student_id 
				 WHERE
					reviews.id = ".$review_id."
					ORDER BY reviews.created DESC";
		$query = $this->db->query($qStr);  
		return $query->row_array();		
	}
	function getPendingReviews(){
		$qStr = "SELECT 
					COUNT(*) as total_reviews
				 FROM
					reviews
				 WHERE
					is_active = ".INACTIVE_STATUS_ID;
		$query = $this->db->query($qStr);  
		return $query->row_array();		
	}
	//*** Get Functions ***
	
	//--- Update Functions ---
	//changeStatus
	function changeStatus($review_id,$status){
		$qStr = "UPDATE 
					reviews
				 SET
					is_active = '".$status."', modified = ".time()."
				 WHERE 
					id = '".$review_id."'";
		return $query = $this->db->query($qStr);
	}
	//*** Update Functions ***	

	//--- Insert Functions ---
	//*** Insert Functions ***	
}
?>