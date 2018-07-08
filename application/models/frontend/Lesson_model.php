<?php
class Lesson_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	/*------------ Function List <Start>-----------------
	0: getTakenLessonsByUserId
	0: getGivenLessonsByUserId
	0: getLessonDetailsById
	0: addLesson
	0: changeLessonStatus
	------------ Function List <End>-----------------*/
	/* -------- GET FUNCTIONS <START> -------- */
	// getTakenLessonsByUserId
	function getTakenLessonsByUserId($user_id){
        $qStr = "SELECT
					lessons.*, users.first_name, users.last_name, tutor_details.hourly_rate
				 FROM
					lessons
				 INNER JOIN
					users
						ON
					lessons.tutor_id = users.id
				 INNER JOIN
					tutor_details
						ON
					tutor_details.tutor_id = lessons.tutor_id
				 WHERE
					lessons.student_id = '".$user_id."' AND lessons.is_active != ".DELETED_STATUS_ID."
					ORDER BY lessons.created DESC";
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;		
	}
	// getGivenLessonsByUserId
	function getGivenLessonsByUserId($user_id){
        $qStr = "SELECT
					lessons.*, users.first_name, users.last_name, tutor_details.hourly_rate
				 FROM
					lessons
				 INNER JOIN
					users
						ON
					lessons.student_id = users.id
				 INNER JOIN
					tutor_details
						ON
					tutor_details.tutor_id = lessons.tutor_id
				 WHERE
					lessons.tutor_id = '".$user_id."' AND lessons.is_active != ".DELETED_STATUS_ID."
					GROUP BY lessons.tutor_availability_id, lessons.lesson_code, lessons.lesson_date
					ORDER BY lessons.created DESC";
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;		
	}
	// getLessonDetailsById
	// AND (lessons.student_id = ".$user_id." OR lessons.tutor_id = ".$user_id.") 
	function getLessonDetailsById($lesson_id,$user_id){
        $qStr = "SELECT
					lessons.*, users.first_name as student_first_name, users.last_name as student_last_name, users.image as student_image, tutor.first_name as tutor_first_name, tutor.last_name as tutor_last_name, tutor.image as tutor_image,
					tutor_details.hourly_rate, tutor_availability.day_available, tutor_availability.time_available, tutor_availability.seats
				 FROM
					lessons
				 INNER JOIN
					users
						ON
					lessons.student_id = users.id
				 INNER JOIN
					users tutor
						ON
					lessons.tutor_id = tutor.id
				 INNER JOIN
					tutor_details
						ON
					tutor_details.tutor_id = lessons.tutor_id
				 INNER JOIN
					tutor_availability
						ON
					tutor_availability.id = lessons.tutor_availability_id
				 WHERE
					lessons.id = '".$lesson_id."' AND (lessons.student_id = ".$user_id." OR lessons.tutor_id = ".$user_id.") AND lessons.is_active != ".DELETED_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;
	}
	function getLessonCode($tutor_id,$tutor_availability_id,$lesson_date){
        $qStr = "SELECT
					*
				 FROM
					lessons
				 WHERE
					tutor_id = '".$tutor_id."' AND lessons.tutor_availability_id = ".$tutor_availability_id." AND lessons.lesson_date = ".$lesson_date." ";
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;
	}
	// getLessonById
	function getLessonById($lesson_id){
		$qStr = "SELECT
					lessons.*, users.first_name, users.last_name, tutor_availability.day_available, tutor_availability.time_available, tutor_availability.seats,
					tutor_details.hourly_rate, tutor_details.level_id
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
	// getLessonStudents
	function getLessonStudents($tutor_id,$tutor_availability_id,$lesson_date){
		$qStr = "SELECT
					lessons.id,lessons.lesson_code,lessons.is_active, lessons.student_id, users.first_name, users.last_name, users.email, users.address
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

	/* -------- GET FUNCTIONS <END> -------- */
	
	/* -------- ADD FUNCTIONS <START> -------- */
	// addLesson
	function addLesson($tutor_id,$student_id,$tutor_availability_id,$lesson_code,$lesson_date,$status,$lesson_type,$subject,$is_active){
		$student = $this->getStudentLesson($tutor_id,$student_id,$tutor_availability_id,$lesson_code,$lesson_date);
		if(empty($student)){
		$qStr = "INSERT INTO
					lessons
				 SET 
					tutor_id = '".$tutor_id."',student_id = '".$student_id."',tutor_availability_id = '".$tutor_availability_id."',lesson_code = '".$lesson_code."',
					lesson_date = '".$lesson_date."',subject = '".$subject."',status = '".$status."',lesson_type = '".$lesson_type."',is_active = '".$is_active."', created = ".time();  
		$query = $this->db->query($qStr);
		return $this->db->insert_id();
		} else {
			if($student['is_active'] == DISABLED_STATUS_ID){
				return "rejected";
			} else {
				return "booked";				
			}
		}
	} 
	function getStudentLesson($tutor_id,$student_id,$tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "SELECT
					*
				 FROM
					lessons
				 WHERE
					 lessons.tutor_id = ".$tutor_id." AND lessons.student_id = ".$student_id." AND lessons.tutor_availability_id = ".$tutor_availability_id." AND lessons.lesson_code = '".$lesson_code."' AND lessons.lesson_date = ".$lesson_date."";
		$query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;		
	}
	/* -------- ADD FUNCTIONS <END> -------- */

	/* -------- UPDATE FUNCTIONS <START> -------- */
	// changeLessonStatus
	function changeLessonStatus($lesson_id,$status,$tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "UPDATE
					lessons
				 SET 
					status = '".$status."', modified = ".time()."
				 WHERE
					tutor_availability_id = '".$tutor_availability_id."' AND lesson_code = '".$lesson_code."' AND lesson_date = '".$lesson_date."' ";
		$query = $this->db->query($qStr);
		return $query;
	}	function changeStudentStatus($lesson_id,$status){
		$qStr = "UPDATE
					lessons
				 SET 
					is_active = '".$status."', modified = ".time()."
				 WHERE
					id = '".$lesson_id."' ";
		$query = $this->db->query($qStr);
		return $query;
	}
	// changeLessonPaymentStatus
	function changeLessonPaymentStatus($lesson_id,$status){
		$qStr = "UPDATE
					lessons
				 SET 
					payment_status = '".$status."', modified = ".time()."
				 WHERE
					id = ".$lesson_id;
		$query = $this->db->query($qStr);
		return $query;
	}
	/* -------- UPDATE FUNCTIONS <END> -------- */
}
/* End of file Lesson_model.php */
/* Location: ./application/models/frontend/lesson_model.php */
?>
