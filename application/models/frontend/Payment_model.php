<?php
class Payment_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	/*------------ Function List <Start>-----------------
	0: getPaymentByLessonId
	0: getPaymentDetailsById
	0: addPayments
	------------ Function List <End>-----------------*/
	/* -------- GET FUNCTIONS <START> -------- */
	// getPaymentByLessonId
	function getPaymentByLessonId($lesson_id){
		$qStr = "SELECT SUM(transaction_amount) as transaction_amount
				 FROM
					payment_history
				 WHERE
					lesson_id = ".$lesson_id." AND sender_type = ".GUEST_SENDER_TYPE." AND is_active !=".DELETED_STATUS_ID;
		$query = $this->db->query($qStr);
		return $query->row_array();
	}
	// getPaymentDetailsById
	function getPaymentDetailsById($user_id){
		$qStr = "SELECT *
				 FROM
					tutor_payment_details
				 WHERE
					user_id = ".$user_id." AND is_active !=".DELETED_STATUS_ID;
		$query = $this->db->query($qStr);
		return $query->row_array();		
	}
	// getTakenLessonsPayment
	function getTakenLessonsPayment($user_id){
        $qStr = "SELECT
					lessons.lesson_code,lessons.tutor_id,lessons.student_id,lessons.subject,lessons.status as lesson_status, users.first_name, users.last_name, tutor_details.hourly_rate, payment_history.*
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
				 INNER JOIN
					payment_history
						ON
					lessons.id = payment_history.lesson_id
				 WHERE
					lessons.student_id = '".$user_id."' AND lessons.is_active != ".DELETED_STATUS_ID."
					ORDER BY lessons.created DESC";
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	/* -------- GET FUNCTIONS <END> -------- */
	
	/* -------- ADD FUNCTIONS <START> -------- */
	// addReservation
	function addPayments($lesson_id,$tutor_availability_id,$lesson_code,$lesson_date,$transaction_id,$card_id,$amount,$status){
		$qStr = "INSERT INTO
					payment_history
				 SET 
					lesson_id = '".$lesson_id."',tutor_availability_id = '".$tutor_availability_id."',lesson_code = '".$lesson_code."',lesson_date = '".$lesson_date."',
					transaction_id = '".$transaction_id."',card_id = '".$card_id."', transaction_amount = '".$amount."',
					status = '".$status."',sender_type='".GUEST_SENDER_TYPE."', is_active = '".ACTIVE_STATUS_ID."', created = ".time();  
		$query = $this->db->query($qStr);
		return $this->db->insert_id();
	}
	/* -------- ADD FUNCTIONS <END> -------- */

	/* -------- UPDATE FUNCTIONS <START> -------- */
	function savePaymentDetails($user_id,$title,$bank_name,$address,$account_number,$swift_code,$phone_code,$phone){
		$payment_details = $this->getPaymentDetailsById($user_id);
		if(empty($payment_details)){
			$qStr = "INSERT INTO
						tutor_payment_details
					 SET 
						user_id = '".$user_id."',title = '".addslashes($title)."',bank_name = '".addslashes($bank_name)."',	address = '".addslashes($address)."',
						account_number = '".addslashes($account_number)."',swift_code='".addslashes($swift_code)."',phone_code = '".$phone_code."',phone='".addslashes($phone)."',
						is_active = '".ACTIVE_STATUS_ID."', created = ".time();  
			$query = $this->db->query($qStr);
			return $query;
		} else {
			$qStr = "UPDATE
						tutor_payment_details
					 SET 
						title = '".addslashes($title)."',bank_name = '".addslashes($bank_name)."', address = '".addslashes($address)."', account_number = '".addslashes($account_number)."',
						swift_code='".addslashes($swift_code)."',phone_code = '".$phone_code."',phone='".addslashes($phone)."', is_active = '".ACTIVE_STATUS_ID."', created = ".time()."
					 WHERE
					 user_id = ".$user_id;  
			$query = $this->db->query($qStr);
			return $query;
		}
	}
	/* -------- UPDATE FUNCTIONS <END> -------- */
}
/* End of file Payment_model.php */
/* Location: ./application/models/frontend/Payment_model.php */
?>