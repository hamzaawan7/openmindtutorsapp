<?php
class Payment_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	//FUNCTIONS LIST:
	//0: Get
	//0: getPaymentDetails
	//0: getPaymentByLessonId
	//0: addPayment
	
	//--- Get Functions ---
	// Get
	function getStudentPayments() {
		$qStr = "SELECT 
					payment_history.*, users.first_name, users.last_name, lessons.subject, lessons.student_id, lessons.payment_status
				 FROM
					payment_history
				 INNER JOIN 
					lessons
					ON
					lessons.id = payment_history.lesson_id
				 INNER JOIN 
					users
					ON
					users.id = lessons.student_id 
				 WHERE
					payment_history.is_active != ".DELETED_STATUS_ID."
					ORDER BY payment_history.created DESC";
		$query = $this->db->query($qStr);  
		$result = $query->result_array();
		if(!empty($result)){
			foreach ($result as $key=>$row){
				$result[$key]['payment_refund_status'] = $this->getPaymentStatusByLessonId($row['lesson_id']);
			}
		}
		return $result;
	}
	function getPaymentStatusByLessonId($lesson_id){
		$qStr = "SELECT 
					payment_history.status as payment_history_status
				 FROM
					payment_history
				 WHERE
					payment_history.is_active != ".DELETED_STATUS_ID." AND payment_history.lesson_id = ".$lesson_id."
					AND payment_history.status = ".REFUNDED."";
		$query = $this->db->query($qStr);  
		$result = $query->result_array();
		return $result;
	}
	// getPaymentDetails
	function getPaymentDetails() {
		$qStr = "SELECT 
					payment_details.*, users.first_name, users.last_name, users.email, users.role, kitchen_details.title as kitchen_name
				 FROM
					payment_details
				 INNER JOIN 
					users
				 ON
					users.id = payment_details.user_id 
				 INNER JOIN 
					kitchen_details
				 ON
					users.id = kitchen_details.user_id 
				 WHERE 
					users.is_active != ".DELETED_STATUS_ID."
					ORDER BY payment_details.created DESC";
		$query = $this->db->query($qStr);  
		return $query->result_array();
	}
	// getPaymentByLessonId
	function getPaymentByLessonId($lesson_id){
		$qStr = "SELECT 
					payment_history.*
				 FROM
					payment_history
				 WHERE
					payment_history.lesson_id = ".$lesson_id." AND payment_history.is_active != ".DELETED_STATUS_ID;
		$query = $this->db->query($qStr);  
		$result = $query->result_array();
		if(!empty($result)){
			foreach ($result as $key=>$row){
				$result[$key]['payment_refund_status'] = $this->getPaymentStatusByLessonId($row['id']);
			}
		}
		return $result;
	}
	// getStudentLessonPayments
	function getStudentLessonPayments($student_id){		
		$qStr = "SELECT
					lessons.*,payment_history.transaction_amount,payment_history.transaction_id,payment_history.status as payment_history_status, users.first_name, users.last_name,
					users.image, users.created as user_created
				 FROM
					lessons
				 INNER JOIN
					users
					ON
					users.id = lessons.student_id
				 INNER JOIN
					payment_history
					ON
					payment_history.lesson_id = lessons.id
				 WHERE
					 lessons.student_id = ".$student_id."					ORDER BY payment_history.created DESC";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		if(!empty($result)){
			foreach ($result as $key=>$row){
				$result[$key]['payment_refund_status'] = $this->getPaymentStatusByLessonId($row['id']);
			}
		}
		return $result;
	}
	// getTutorLessonPayments
	function getTutorLessonPayments($tutor_id){
		$qStr = "SELECT
					lessons.*, users.first_name, users.last_name, users.image, users.created as user_created,
					tutor_details.hourly_rate, tutor_details.group_hourly_rate, tutor_details.level_id
				 FROM
					lessons
				 INNER JOIN
					users
					ON
					users.id = lessons.student_id
				 INNER JOIN 
					tutor_details
					ON
					tutor_details.tutor_id = lessons.tutor_id 
				 WHERE
					 lessons.tutor_id = ".$tutor_id." AND lessons.status = ".COMPLETED." AND lessons.is_active != ".DELETED_STATUS_ID."
				 GROUP BY lessons.lesson_code, lessons.lesson_date, lessons.tutor_availability_id
				 ORDER BY lessons.created DESC";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		if(!empty($result)){
			foreach ($result as $key=>$row){
				$result[$key]['payments'] = $this->getTutorPayments($row['tutor_availability_id'],$row['lesson_code'],$row['lesson_date']);
			}
		}
		return $result;
	}
	function getTutorPayments($tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "SELECT 
					SUM(transaction_amount) as transaction_amount
				 FROM
					payment_history
				 WHERE
					tutor_availability_id = ".$tutor_availability_id." AND lesson_date = ".$lesson_date." 
					AND lesson_code = '".$lesson_code."' AND sender_type = '".GUEST_SENDER_TYPE."' AND is_active != ".DELETED_STATUS_ID;
		$query = $this->db->query($qStr);  
		return $query->row_array();		
	}
	function getPendingPayment(){
		$qStr = "SELECT
					lessons.*
				 FROM
					lessons
				 INNER JOIN 
					users
					ON
					users.id = lessons.tutor_id 
				 WHERE
					 lessons.status = ".COMPLETED." AND lessons.is_active != ".DELETED_STATUS_ID." AND users.is_active !=".DELETED_STATUS_ID."
				 GROUP BY lessons.lesson_code, lessons.lesson_date, lessons.tutor_availability_id";
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		if(!empty($result)){
			foreach($result as $key=>$row){
				$result[$key]['tranfered'] = $this->getUnPaidLessons($row['tutor_availability_id'],$row['lesson_code'],$row['lesson_date']);
			}
		}
		$unpaid = array();
		if(!empty($result)){
			foreach($result as $key=>$row){
				if($row['tranfered'] == 0){
					$unpaid[$key] = $row;
				}
			}
		}
		return $unpaid;
	}
	function getUnPaidLessons($tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "SELECT 
					*
				 FROM
					payment_history
				 WHERE
					tutor_availability_id = ".$tutor_availability_id." AND lesson_date = ".$lesson_date." 
					AND lesson_code = '".$lesson_code."' AND sender_type = '".ADMIN_SENDER_TYPE."' AND status = '".TRANSFERRED_BY_ADMIN."' ";
		$query = $this->db->query($qStr);  
		$result = $query->row_array();		
		if(!empty($result)){
			return 1;
		} else {
			return 0;
		}
	}
	//*** Get Functions ***
	
	//--- Update Functions ---
	//*** Update Functions ***	

	//--- Insert Functions ---
	// addPayment
	function addPayment($lesson_id,$payment_amount,$status,$tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "INSERT INTO
					payment_history
				 SET 
					lesson_id = '".$lesson_id."',transaction_amount = '".$payment_amount."',sender_type = '".ADMIN_SENDER_TYPE."',tutor_availability_id = '".$tutor_availability_id."',
					lesson_code = '".$lesson_code."',lesson_date = '".$lesson_date."',
					status = '".$status."', is_active = '".ACTIVE_STATUS_ID."', created = ".time();  
		$query = $this->db->query($qStr);
		return $query;
	}
	// addRefunds
	function addRefunds($transaction_id,$lesson_id,$refunded_amount,$status,$tutor_availability_id,$lesson_code,$lesson_date){
		$qStr = "INSERT INTO
					payment_history
				 SET 
					transaction_id = '".$transaction_id."',lesson_id = '".$lesson_id."',transaction_amount = '".$refunded_amount."',sender_type = '".ADMIN_SENDER_TYPE."',
					tutor_availability_id = ".$tutor_availability_id.", lesson_date = ".$lesson_date.", lesson_code = '".$lesson_code."',
					status = '".$status."', is_active = '".ACTIVE_STATUS_ID."', created = ".time();  
		$query = $this->db->query($qStr);
		return $query;
	}
	//*** Insert Functions ***	
}
?>