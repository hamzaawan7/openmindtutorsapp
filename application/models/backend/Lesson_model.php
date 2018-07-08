<?php
class Lesson_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	//FUNCTIONS LIST:
	//0: Get
	//0: getMessages
	//0: getLessonById
	//0: getLevelById
	//0: getLessonStudents
	//0: markAsPayed
	//0: addPayment
	
	//--- Get Functions ---
	// Get
	function get($lesson) {
		$and = ($lesson != 0)? 'AND lessons.status = '.$lesson :'';
		$qStr = "SELECT 
					lessons.*, users.first_name, users.last_name, tutor_availability.day_available, tutor_availability.time_available, tutor_availability.seats,
					tutor_details.hourly_rate, tutor_details.group_hourly_rate, tutor_details.level_id
				 FROM
					lessons
				 INNER JOIN 
					users
					ON
					users.id = lessons.tutor_id 
				 INNER JOIN 
					tutor_availability
					ON
					tutor_availability.id = lessons.tutor_availability_id 
				 INNER JOIN 
					tutor_details
					ON
					tutor_details.tutor_id = lessons.tutor_id 
				 WHERE
					lessons.is_active != ".DELETED_STATUS_ID." AND users.is_active !=".DELETED_STATUS_ID." ".$and."
					GROUP BY lessons.lesson_code, lessons.lesson_date, lessons.tutor_availability_id
					ORDER BY lessons.created DESC";
		$query = $this->db->query($qStr);  
		return $query->result_array();
	}
	// getMessages
	function getMessages($lesson_id){
		$qStr = "SELECT
					messages.*
				 FROM
					messages
				 WHERE
					messages.lesson_id = ".$lesson_id."
					ORDER BY messages.created DESC";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	// getGroupMessages
	function getGroupMessages($tutor_availability_id,$lesson_date,$lesson_code){
		$qStr = "SELECT
					messages.*
				 FROM
					messages
				 INNER JOIN
					lessons
						ON
					messages.lesson_id = lessons.id
				 WHERE
					messages.tutor_availability_id = ".$tutor_availability_id." AND messages.lesson_date = ".$lesson_date." 
					AND messages.lesson_code = '".$lesson_code."'
					GROUP BY messages.created, messages.message
					ORDER BY messages.created DESC";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	// getUserData
	function getUserData($sender_id){
		$qStr = "SELECT
					users.first_name as sender_first_name, users.last_name as sender_last_name, users.role, users.image
				 FROM
					users
				 WHERE
					users.id = ".$sender_id;
		$query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;		
	}
	// getLessonById
	function getLessonById($lesson_id){
		$qStr = "SELECT
					lessons.*, users.first_name, users.last_name, tutor_availability.day_available, tutor_availability.time_available, tutor_availability.seats,
					tutor_details.hourly_rate, tutor_details.group_hourly_rate, tutor_details.level_id
				 FROM
					lessons
				 INNER JOIN 
					users
					ON
					users.id = lessons.tutor_id 
				 INNER JOIN 
					tutor_details
					ON
					tutor_details.tutor_id = lessons.tutor_id 
				 INNER JOIN 
					tutor_availability
					ON
					tutor_availability.id = lessons.tutor_availability_id 
				 WHERE
					 lessons.id = ".$lesson_id." AND lessons.is_active != ".DELETED_STATUS_ID;
		$query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;
	}
	// getLevelById
	function getLevelById($level_id){
		$qStr = "SELECT
					*
				 FROM
					levels
				 WHERE
					 id = ".$level_id;
		$query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;
	}
	// getLessonStudents
	function getLessonStudents($tutor_id,$tutor_availability_id,$lesson_date){
		$qStr = "SELECT
					lessons.id,lessons.lesson_code,lessons.is_active, lessons.student_id, users.first_name, users.last_name, users.email
				 FROM
					lessons
				 INNER JOIN
					users
					ON
					users.id = lessons.student_id
				 WHERE
					 lessons.tutor_id = ".$tutor_id." AND lessons.tutor_availability_id = ".$tutor_availability_id." AND lessons.lesson_date = ".$lesson_date;
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	function getLessonActiveStudents($tutor_id,$tutor_availability_id,$lesson_date){
		$qStr = "SELECT
					lessons.id,lessons.lesson_code,lessons.is_active, lessons.student_id, users.first_name, users.last_name, users.email
				 FROM
					lessons
				 INNER JOIN
					users
					ON
					users.id = lessons.student_id
				 WHERE
					 lessons.tutor_id = ".$tutor_id." AND lessons.tutor_availability_id = ".$tutor_availability_id." AND lessons.lesson_date = ".$lesson_date."
					 AND lessons.is_active != ".DISABLED_STATUS_ID;
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	function getLessonIds($tutor_id,$tutor_availability_id,$lesson_date){
		$qStr = "SELECT
					lessons.id
				 FROM
					lessons
				 WHERE
					 lessons.tutor_id = ".$tutor_id." AND lessons.tutor_availability_id = ".$tutor_availability_id." AND lessons.lesson_date = ".$lesson_date;
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	//*** Get Functions ***
	
	//--- Update Functions ---
	// markAsPayed
	function markAsPayed($tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "UPDATE
					lessons
				 SET 
					payment_status = '".ACTIVE_STATUS_ID."', modified = ".time()."
				 WHERE
				 tutor_availability_id = ".$tutor_availability_id." AND lesson_code = '".$lesson_code."' AND lesson_date = ".$lesson_date." ";  
		$query = $this->db->query($qStr);
		return $query;
	}
	// changeReservationStatus
	function changeLessonStatus($tutor_availability_id,$lesson_code,$lesson_date,$status){
		$qStr = "UPDATE
					lessons
				 SET 
					status = '".$status."', modified = ".time()."
				 WHERE
					tutor_availability_id = ".$tutor_availability_id." AND lesson_date = ".$lesson_date." 
					AND lesson_code = '".$lesson_code."'";
		$query = $this->db->query($qStr);
		return $query;
	}
	//*** Update Functions ***	

	//--- Insert Functions ---
	// addMessage
	function addMessage($sender_id,$lesson_id,$message,$status,$tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "INSERT INTO
					messages
				 SET
					sender_id = 0, receiver_id = 0, lesson_id = '".$lesson_id."', message = '".addslashes($message)."',
					tutor_availability_id = '".$tutor_availability_id."', lesson_code = '".$lesson_code."', lesson_date = '".$lesson_date."',
					status = '".$status."', read_time = '".time()."', created = ".time();
		$query = $this->db->query($qStr);
		return $query;		
	}
	//*** Insert Functions ***	
	function getDisputedLessons(){
		$qStr = "SELECT 
					COUNT(*) as total_lessons
				 FROM
					lessons
				 INNER JOIN 
					users
					ON
					users.id = lessons.tutor_id 
				 WHERE 
					lessons.status = ".DISPUTED." AND lessons.is_active != ".DELETED_STATUS_ID." AND users.is_active !=".DELETED_STATUS_ID."";
		$query = $this->db->query($qStr);  
		return $query->row_array();		
	}
}
?>