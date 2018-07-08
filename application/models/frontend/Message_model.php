<?php
class Message_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	/*------------ Function List <Start>-----------------
	0: getUnreadMsgsByReceiverId
	0: getMsgsByReceiverId
	0: getMsgsBylessonId
	0: addMessage
	0: changeMessageStatus
	------------ Function List <End>-----------------*/
	/* -------- GET FUNCTIONS <START> -------- */
	// getUnreadMsgsByReceiverId
	function getUnreadMsgsByReceiverId($receiver_id){
		/*$qStr = "SELECT 
					messages.*,lessons.tutor_availability_id
				 FROM
					messages
				 INNER JOIN
					lessons
						ON
					messages.lesson_id = lessons.id
				 INNER JOIN
					tutor_availability
						ON
					tutor_availability.id = lessons.tutor_availability_id
				 WHERE
					messages.receiver_id  = ".$receiver_id." AND messages.status = ".UNSEEN." #AND lessons.status != ".INACTIVE_STATUS_ID."
				 GROUP BY messages.lesson_id";*/

		 $qStr = "SELECT 
					messages.*
				 FROM
					messages
				 INNER JOIN
					lessons
						ON
					messages.lesson_id = lessons.id
				 WHERE
					messages.receiver_id  = ".$receiver_id." AND messages.status = ".UNSEEN."
				 GROUP BY messages.lesson_id";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
		
	}
	// getMsgsByReceiverId
/*	function getMsgsByReceiverId($receiver_id){
//		$and = ($role ==  TUTOR)? 'AND lessons.status != '.INACTIVE_STATUS_ID.'' : '';
		$qStr = "SELECT t1.*, users.first_name as tutor_first_name, users.last_name as tutor_last_name, users.image  as tutor_image,
				u1.first_name as student_first_name, u1.last_name as student_last_name, u1.image  as student_image,
				lessons.tutor_id, lessons.student_id, lessons.lesson_date, lessons.subject, tutor_availability.seats
				 FROM 
					messages t1
				 INNER JOIN
					lessons
						ON
					t1.lesson_id = lessons.id
				 INNER JOIN
					users
						ON
					lessons.tutor_id = users.id
				 INNER JOIN
					users u1
						ON
					lessons.student_id = u1.id
				 INNER JOIN
					tutor_availability
						ON
					tutor_availability.id = lessons.tutor_availability_id
				 WHERE 
				 t1.created = (SELECT MAX(t2.created) FROM messages t2 WHERE t2.lesson_id = t1.lesson_id ) AND (lessons.student_id  = ".$receiver_id." OR lessons.tutor_id  = ".$receiver_id.") #(AND receiver_id  = ".$receiver_id." OR sender_id  = ".$receiver_id.")
				 GROUP BY t1.lesson_id
				 ORDER BY t1.created DESC,t1.status DESC";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;		
	}*/
	function getLessonTakenMsgsByReceiverId($receiver_id){
		$qStr = "SELECT t1.*, users.first_name, users.last_name, users.image,
				lessons.tutor_id, lessons.student_id, lessons.lesson_date, lessons.subject, tutor_availability.seats
				 FROM 
					messages t1
				 INNER JOIN
					lessons
						ON
					t1.lesson_id = lessons.id
				 INNER JOIN
					users
						ON
					lessons.tutor_id = users.id
				 INNER JOIN
					tutor_availability
						ON
					tutor_availability.id = lessons.tutor_availability_id
				 WHERE 
				 t1.created = (SELECT MAX(t2.created) FROM messages t2 WHERE t2.lesson_id = t1.lesson_id ) AND (lessons.student_id  = ".$receiver_id." OR lessons.tutor_id  = ".$receiver_id.") #(AND receiver_id  = ".$receiver_id." OR sender_id  = ".$receiver_id.")
				 AND lessons.student_id = '".$receiver_id."'
				 GROUP BY t1.lesson_id
				 ORDER BY t1.created DESC,t1.status DESC";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;		
	}
	function getLessonGivenMsgsByReceiverId($receiver_id){
		$qStr = "SELECT t1.*, users.first_name, users.last_name, users.image,
				lessons.tutor_id, lessons.student_id, lessons.lesson_date, lessons.subject, tutor_availability.seats
				 FROM 
					messages t1
				 INNER JOIN
					lessons
						ON
					t1.lesson_id = lessons.id
				 INNER JOIN
					users
						ON
					lessons.student_id = users.id
				 INNER JOIN
					tutor_availability
						ON
					tutor_availability.id = lessons.tutor_availability_id
				 WHERE 
				 t1.created = (SELECT MAX(t2.created) FROM messages t2 WHERE t2.lesson_id = t1.lesson_id ) AND (lessons.student_id  = ".$receiver_id." OR lessons.tutor_id  = ".$receiver_id.") #(AND receiver_id  = ".$receiver_id." OR sender_id  = ".$receiver_id.")
				 AND lessons.tutor_id = '".$receiver_id."'
				 GROUP BY t1.lesson_id
				 ORDER BY t1.created DESC,t1.status DESC";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;		
	}
	
	function getNoLessonMsgsByReceiverId($receiver_id){
		$qStr = "SELECT users.email, users.first_name 
				 FROM 
					messages
				 INNER JOIN
					users
						ON
					messages.sender_id = users.id
				 WHERE 
				 messages.receiver_id=".$receiver_id." AND messages.lesson_id =".INACTIVE_STATUS_ID." AND messages.status =".INACTIVE_STATUS_ID;
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;		
	}
	// getMsgsBylessonId
	function getMsgsBylessonId($lesson_id,$tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "SELECT messages.*, sender.first_name as sender_first_name, sender.last_name as sender_last_name, sender.image as sender_image, receiver.first_name as receiver_first_name,
						receiver.last_name as receiver_last_name
				 FROM 
					messages
				 LEFT JOIN
					users sender
						ON
					messages.sender_id = sender.id
				 LEFT JOIN
					users receiver
						ON
					messages.receiver_id = receiver.id
				 WHERE 
					 messages.tutor_availability_id = '".$tutor_availability_id."' AND messages.lesson_code = '".$lesson_code."' AND messages.lesson_date = '".$lesson_date."'
					GROUP BY messages.created, messages.message
					ORDER BY messages.created ASC";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	/* -------- GET FUNCTIONS <END> -------- */
	
	/* -------- ADD FUNCTIONS <START> -------- */
	// addMessage
	function addMessage($sender_id,$receiver_id,$lesson_id,$message){
		$qStr = "INSERT INTO 
					messages
				 SET 
					sender_id = '".$sender_id."',receiver_id = '".$receiver_id."',lesson_id = '".$lesson_id."',message = '".addslashes($message)."',
					status = '".UNSEEN."', created = ".time();  
		$query = $this->db->query($qStr);
		return $this->db->insert_id();
	}
	/* -------- ADD FUNCTIONS <END> -------- */

	/* -------- UPDATE FUNCTIONS <START> -------- */
	// changeMessageStatus
	function changeMessageStatus($receiver_id,$lesson_id,$tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "UPDATE
					messages
				 SET 
					status = '".SEEN."', modified = ".time().", read_time = ".time()."
				 WHERE
					receiver_id = ".$receiver_id." AND tutor_availability_id = '".$tutor_availability_id."' AND lesson_code = '".$lesson_code."' AND lesson_date = '".$lesson_date."'";
		$query = $this->db->query($qStr);				
		return $query;		
	}
	
	function changeNoMessageStatus($receiver_id){
		$qStr = "UPDATE
					messages
				 SET 
					status = '".SEEN."', modified = ".time().", read_time = ".time()."
				 WHERE
					receiver_id = ".$receiver_id." AND lesson_id=".INACTIVE_STATUS_ID;
		$query = $this->db->query($qStr);				
		return $query;		
	}
	
	function changeAdminMessageStatus($tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "UPDATE
					messages
				 SET 
					status = '".SEEN."', modified = ".time().", read_time = ".time()."
				 WHERE
					receiver_id = 0 AND tutor_availability_id = '".$tutor_availability_id."' AND lesson_code = '".$lesson_code."' AND lesson_date = '".$lesson_date."'";
		$query = $this->db->query($qStr);
		return $query;		
	}
	function updateMessage($message_id,$tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "UPDATE
					messages
				 SET 
					tutor_availability_id = '".$tutor_availability_id."', lesson_code = '".$lesson_code."',lesson_date = '".$lesson_date."', modified = ".time()."
				 WHERE
					id = ".$message_id;
		$query = $this->db->query($qStr);				
		return $query;		
	}
	/* -------- UPDATE FUNCTIONS <END> -------- */
	function getAllReceiver($tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "SELECT id, tutor_id, student_id
				 FROM
					lessons
				 WHERE
					tutor_availability_id = '".$tutor_availability_id."' AND lesson_code = '".$lesson_code."' AND lesson_date = '".$lesson_date."' AND
					is_active != ".DISABLED_STATUS_ID;
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;		
	}
}
/* End of file Message_model.php */
/* Location: ./application/models/frontend/Message_model.php */
?>
