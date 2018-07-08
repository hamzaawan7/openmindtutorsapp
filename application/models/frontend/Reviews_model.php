<?php
class Reviews_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	/*------------ Function List <Start>-----------------
	0: getAvgRatingByTutorId
	0: getReviewsByTutorId
	0: getLessonTotalReviews
	0: getStudentReviews
	0: addReviews
	------------ Function List <End>-----------------*/
	/* -------- GET FUNCTIONS <START> -------- */
	// getAvgRatingByTutorId
	function getAvgRatingByTutorId($tutor_id){
        $qStr = "SELECT
					AVG(reviews.rating) as avg_rating
				 FROM
					reviews
				 WHERE
					reviews.tutor_id = '".$tutor_id."' AND reviews.is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result['avg_rating'];
	}
	// getReviewsByTutorId
	function getReviewsByTutorId($tutor_id){
        $qStr = "SELECT
					reviews.id, reviews.student_id, reviews.review, reviews.rating, users.first_name, users.last_name
				 FROM
					reviews
				 INNER JOIN
					users
						ON
					users.id = reviews.student_id
				 WHERE
					reviews.tutor_id = '".$tutor_id."' AND reviews.is_active = ".ACTIVE_STATUS_ID."
					ORDER BY reviews.created DESC";
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	// getReviewsByLessonId
	function getReviewsByLessonId($lesson_id){
        $qStr = "SELECT
					reviews.*,users.first_name,users.last_name,users.image
				 FROM
					reviews
				 INNER JOIN
					users
						ON
					users.id = reviews.student_id
				 WHERE
					reviews.lesson_id = '".$lesson_id."' AND reviews.is_active != ".DELETED_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	// getLessonTotalReviews
	function getLessonTotalReviews($lesson_id){
        $qStr = "SELECT
					COUNT(*) as total_reviews
				 FROM
					reviews
				 WHERE
					lesson_id = '".$lesson_id."' AND is_active != ".DELETED_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result['total_reviews'];
	}
	// getReviewsByLessonStudentId
	function getReviewsByLessonStudentId($lesson_id,$student_id){
        $qStr = "SELECT
					reviews.*
				 FROM
					reviews
				 WHERE
					reviews.lesson_id = '".$lesson_id."' AND reviews.student_id = '".$student_id."' AND reviews.is_active != ".DELETED_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;		
	}
	// getStudentReviews
	function getStudentReviews($user_id){
        $qStr = "SELECT
					reviews.*,users.first_name,users.last_name,users.image
				 FROM
					reviews
				 INNER JOIN
					users
						ON
					users.id = reviews.tutor_id
				 WHERE
					reviews.student_id = '".$user_id."' AND reviews.is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	function getTutorReviewsByLessonId($tutor_availability_id,$lesson_code,$lesson_date){
        $qStr = "SELECT
					lessons.id, reviews.*, users.first_name, users.last_name, users.image
				 FROM
					lessons
				 INNER JOIN
					reviews
					ON
					reviews.lesson_id = lessons.id
				 INNER JOIN
					users
						ON
					users.id = reviews.student_id
				 WHERE
					lessons.tutor_availability_id = '".$tutor_availability_id."' AND lessons.lesson_code = '".$lesson_code."' AND lessons.lesson_date = '".$lesson_date."'
					AND lessons.is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	/* -------- GET FUNCTIONS <END> -------- */
	/* -------- ADD FUNCTIONS <START> -------- */
	// addReviews
	function addReviews($lesson_id,$tutor_id,$student_id,$rating,$review,$review_headline,$review_outcome){
		$result = $this->getReviewsByLessonStudentId($lesson_id,$student_id);
        if(empty($result)){
			$qStr = "INSERT INTO
						reviews
					 SET
						tutor_id = '".$tutor_id."',student_id = '".$student_id."',lesson_id = '".$lesson_id."', rating = '".$rating."',review = '".addslashes($review)."',
						headline = '".addslashes($review_headline)."',outcome = '".addslashes($review_outcome)."',
						is_active = ".INACTIVE_STATUS_ID.", created = '".time()."' ";
			$query = $this->db->query($qStr);
			return $query;
		} else {
			$qStr = "UPDATE
						reviews
					 SET
						tutor_id = '".$tutor_id."',student_id = '".$user_id."', rating = '".$rating."',review = '".addslashes($review)."',
						is_active = ".INACTIVE_STATUS_ID.", created = '".time()."' 
					 WHERE
						lesson_id = '".$lesson_id."'";
			$query = $this->db->query($qStr);
			return $query;
		}
	}
	/* -------- ADD FUNCTIONS <END> -------- */

	/* -------- UPDATE FUNCTIONS <START> -------- */
	/* -------- UPDATE FUNCTIONS <END> -------- */
}
/* End of file reviews_model.php */
/* Location: ./application/models/frontend/reviews_model.php */
?>
