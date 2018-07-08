<?php
class Search_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	/*------------ Function List <Start>-----------------
	0: getTopRatedTutors 
	0: search 
	------------ Function List <End>-----------------*/
	/* -------- GET FUNCTIONS <START> -------- */
	// getTopRatedTutors
	function getTopRatedTutors(){
        $qStr = "SELECT
					users.id,users.first_name,users.last_name,users.image,tutor_details.personal_statement,tutor_details.hourly_rate,AVG(reviews.rating) as avg_rating
				 FROM
					users
				 INNER JOIN
					tutor_details
						ON
					users.id = tutor_details.tutor_id
				 LEFT JOIN
					(SELECT * FROM reviews WHERE is_active = ".ACTIVE_STATUS_ID.")
					reviews
						ON
					users.id = reviews.tutor_id
				 WHERE
					users.is_active = ".ACTIVE_STATUS_ID." AND users.is_featured= ".ACTIVE_STATUS_ID."
				 GROUP BY users.id ORDER BY avg_rating DESC
				 LIMIT ".HOMEPAGE_TUTORS;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	// search
	function search($subject,$level,$location,$rate,$main_subject,$rating,$distance,$start,$limit,$location_codes,$sort_price,$sort_rating,$sort_distance){
		$rate = (!empty($rate))? explode(",",$rate):explode(",","5,200");
		$and = '';
		$having = '';
		$join = '';
		$order_by = '';
		$and .= ($location !='')? 'AND (users.city LIKE "%'.$location.'%" OR users.postal_code LIKE "%'.$location.'%" OR users.postal_code LIKE "%'.substr($location, 0, 2).'%" OR users.postal_code IN ('.$location_codes.') OR users.address LIKE "%'.$location.'%" OR users.area LIKE "%'.$location.'%") ':'';
		$and .= ($level !='')? 'AND (tutor_teaching_level.name LIKE "%'.$level.'%" OR tutor_details.subject_level LIKE "%'.$level.'%") ':'';
		$and .= ($subject !='')? 'AND tutor_subjects.subject_name LIKE "%'.$subject.'%" ':'';
		$and .= ($main_subject != 0)? 'AND tutor_subjects.main_subject_id = '.$main_subject.' ':'';
		$and .= ($rate !='')? 'AND tutor_details.hourly_rate BETWEEN '.$rate[0].' AND '.$rate[1].' ':'';
		$having = ($rating !=0)? 'HAVING avg_rating >= '.$rating.' ':'';
		$having = ($distance !=0)? 'HAVING tutor_details.travel_distance <= '.$distance.' ':'';
		$having = ($distance !=0 && $rating !=0)? 'HAVING tutor_details.travel_distance <= '.$distance.' AND avg_rating >= '.$rating.' ':'';
		$join .= ($level !='')? 'INNER JOIN tutor_teaching_level ON users.id = tutor_teaching_level.tutor_id ':'';
		$join .= ($subject !='')? 'INNER JOIN tutor_subjects ON users.id = tutor_subjects.tutor_id ':'';
		$join .= ($main_subject != 0)? 'INNER JOIN tutor_subjects ON users.id = tutor_subjects.tutor_id ':'';
        $order_by .= ($sort_price == 'asc' || $sort_price == 'desc')? 'tutor_details.hourly_rate '.$sort_price.' ':'';
		$order_by .= (($sort_price == 'asc' || $sort_price == 'desc')&& ($sort_rating == 'asc' || $sort_rating == 'desc'))? ', ':'';
		$order_by .= ($sort_rating == 'asc' || $sort_rating == 'desc')? 'avg_rating '.$sort_rating.' ':'';
		$order_by .= ((($sort_price == 'asc' || $sort_price == 'desc') || ($sort_rating == 'asc' || $sort_rating == 'desc')) && ($sort_distance == 'asc' || $sort_distance == 'desc'))? ', ':'';
		$order_by .= ($sort_distance == 'asc' || $sort_distance == 'desc')? 'tutor_details.travel_distance '.$sort_distance.' ':'';
		$order_by .= ($order_by=='')? 'avg_rating DESC':'';
		$qStr = "SELECT
					users.id,users.first_name,users.last_name,users.image,tutor_details.personal_statement,tutor_details.hourly_rate,tutor_details.travel_distance,AVG(reviews.rating) as avg_rating
				 FROM 
					users
				 INNER JOIN
					tutor_details
						ON
					users.id = tutor_details.tutor_id
				 LEFT JOIN
					(SELECT * FROM reviews WHERE is_active = ".ACTIVE_STATUS_ID.")
					reviews
						ON
					users.id = reviews.tutor_id
				 ".$join."
				 WHERE
					users.is_active = ".ACTIVE_STATUS_ID."
					".$and."
				 GROUP BY users.id ".$having." ORDER BY ".$order_by." 
				 LIMIT ".$start.",".$limit;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	function searchFiltered($subject,$level,$location,$rate,$main_subject,$rating,$distance,$location_codes,$sort_price,$sort_rating,$sort_distance){
		$rate = (!empty($rate))? explode(",",$rate):explode(",","5,200");
		$and = '';
		$having = '';
		$join = '';
		$order_by = '';
		$and .= ($location !='')? 'AND (users.city LIKE "%'.$location.'%" OR users.postal_code LIKE "%'.$location.'%" OR users.postal_code LIKE "%'.substr($location, 0, 2).'%" OR users.postal_code IN ('.$location_codes.') OR users.address LIKE "%'.$location.'%" OR users.area LIKE "%'.$location.'%") ':'';
		$and .= ($level !='')? 'AND (tutor_teaching_level.name LIKE "%'.$level.'%" OR tutor_details.subject_level LIKE "%'.$level.'%") ':'';
		$and .= ($subject !='')? 'AND tutor_subjects.subject_name LIKE "%'.$subject.'%" ':'';
		$and .= ($main_subject != 0)? 'AND tutor_subjects.main_subject_id = '.$main_subject.' ':'';
		$and .= ($rate !='')? 'AND tutor_details.hourly_rate BETWEEN '.$rate[0].' AND '.$rate[1].' ':'';
		$having = ($rating !=0)? 'HAVING avg_rating >= '.$rating.' ':'';
		$having = ($distance !=0)? 'HAVING tutor_details.travel_distance <= '.$distance.' ':'';
		$having = ($distance !=0 && $rating !=0)? 'HAVING tutor_details.travel_distance <= '.$distance.' AND avg_rating >= '.$rating.' ':'';
		$join .= ($level !='')? 'INNER JOIN tutor_teaching_level ON users.id = tutor_teaching_level.tutor_id ':'';
		$join .= ($subject !='')? 'INNER JOIN tutor_subjects ON users.id = tutor_subjects.tutor_id ':'';
		$join .= ($main_subject != 0)? 'INNER JOIN tutor_subjects ON users.id = tutor_subjects.tutor_id ':'';
        $order_by .= ($sort_price == 'asc' || $sort_price == 'desc')? 'tutor_details.hourly_rate '.$sort_price.' ':'';
		$order_by .= (($sort_price == 'asc' || $sort_price == 'desc')&& ($sort_rating == 'asc' || $sort_rating == 'desc'))? ', ':'';
		$order_by .= ($sort_rating == 'asc' || $sort_rating == 'desc')? 'avg_rating '.$sort_rating.' ':'';
		$order_by .= ((($sort_price == 'asc' || $sort_price == 'desc')|| ($sort_rating == 'asc' || $sort_rating == 'desc')) && (($sort_distance == 'asc' || $sort_distance == 'desc')))? ', ':'';
		$order_by .= ($sort_distance == 'asc' || $sort_distance == 'desc')? 'tutor_details.travel_distance '.$sort_distance.' ':'';
		$order_by .= ($order_by=='')? 'avg_rating DESC':'';
		$qStr = "SELECT
					users.id,users.first_name,users.last_name,users.image,tutor_details.personal_statement,tutor_details.hourly_rate,tutor_details.travel_distance,AVG(reviews.rating) as avg_rating
				 FROM
					users
				 INNER JOIN
					tutor_details
						ON
					users.id = tutor_details.tutor_id
				 LEFT JOIN
					(SELECT * FROM reviews WHERE is_active = ".ACTIVE_STATUS_ID.")
					reviews
						ON
					users.id = reviews.tutor_id
				 ".$join."
				 WHERE
					users.is_active = ".ACTIVE_STATUS_ID."
					".$and."
				 GROUP BY users.id ".$having." ORDER BY ".$order_by."";
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	function getSubjectsByTutorId($tutor_id){
        $qStr = "SELECT
					*
				 FROM
					tutor_subjects
				 WHERE
					tutor_id = '".$tutor_id."' AND is_active = ".ACTIVE_STATUS_ID;
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
	function searchLevels($level){
		$qStr ="Select
					*
				FROM
					teaching_levels
				WHERE
					is_active=".ACTIVE_STATUS_ID." AND name LIKE '%".$level."%'
				ORDER BY name ASC";
        $query = $this->db->query($qStr);
        $result = $query->result_array();
        if(!empty($result)){ 
			foreach($result as $key=>$record) {
				$data[$key]['label'] = $record['name'];
				$data[$key]['value'] = $record['name'];
			}
		echo json_encode($data);
		}
	}
	function searchSubjects($subject){
		$qStr ="Select
					*
				FROM
					subjects
				WHERE
					is_active=".ACTIVE_STATUS_ID." AND name LIKE '%".$subject."%'
				ORDER BY name ASC";
        $query = $this->db->query($qStr);
        $result = $query->result_array();
        if(!empty($result)){ 
			foreach($result as $key=>$record) {
				$data[$key]['label'] = $record['name'];
				$data[$key]['value'] = $record['name'];
			}
		echo json_encode($data);
		}
	}
	function getAvailabilityTutorId($tutor_id){
		$qStr ="Select
					tutor_availability.*
				FROM
					tutor_availability
				WHERE
					tutor_availability.is_active=".ACTIVE_STATUS_ID." AND tutor_availability.tutor_id = ".$tutor_id."
				 GROUP BY tutor_availability.id
				 ORDER BY tutor_availability.day_available ASC";
        $query = $this->db->query($qStr);
        $result = $query->result_array();
		if(!empty($result)){
			foreach($result as $key=>$row){
				$result[$key]['total_lessons'] = $this->getBookedLessons($row['id']);
				$result[$key]['lesson_date'] = $this->getBookedLessonsDetails($row['id']);
			}
		}
		return $result;
	}
	function getBookedLessons($tutor_availability_id){
		$qStr ="Select
					COUNT(*) as total_lessons
				FROM
					lessons
				WHERE
					is_active != ".DISABLED_STATUS_ID." AND tutor_availability_id = ".$tutor_availability_id." ";
        $query = $this->db->query($qStr);
        $result = $query->row_array();
		return $result['total_lessons'];
	}
	function getBookedLessonsDetails($tutor_availability_id){
		$qStr ="Select
					lessons.lesson_date, COUNT(*) as total_lessons,lessons.student_id
				FROM
					lessons
				WHERE
					is_active != ".DISABLED_STATUS_ID." AND tutor_availability_id = ".$tutor_availability_id."
				GROUP BY lessons.lesson_date
				ORDER BY lessons.lesson_date DESC
				";
        $query = $this->db->query($qStr);
        $result = $query->result_array();
		return $result;
	}
/*
	function getPageData($page_id) { 
        $qStr = "SELECT 
					#PAGES
					id, page_id, page_name, field_name, content
				 FROM
					pages 
				 WHERE
					is_active = ".ACTIVE_STATUS_ID;

        $query = $this->db->query($qStr);
        $result= $query->result_array();
        $page_data = '';
        if(!empty($result)){ 
			foreach($result as $data){
				$page_data[$data['field_name']] = $data;
			}
		}
        return $page_data;
    }
*/
	function getMainSubjectById($main_subject){
		$qStr ="Select
					name
				FROM
					main_subjects
				WHERE
					id=".$main_subject;
        $query = $this->db->query($qStr);
        $result = $query->row_array();
		return $result;
	}
	/* -------- GET FUNCTIONS <END> -------- */
	function searchPostalCodes($postal,$country){
		$_url = sprintf('http://api.geonames.org/postalCodeSearchJSON?postalcode='.urlencode(strtoupper($postal)).'&placename='.urlencode($country).'&maxRows=30&username=openmindtutors');
		$_result = file_get_contents($_url);
		$postal_result = json_decode($_result);
			$location_codes = '';
		if(isset($postal_result->postalCodes)){
			foreach($postal_result->postalCodes as $key=>$postal){
				$location_codes[$key]['label'] = $postal->postalCode;
				$location_codes[$key]['value'] = $postal->postalCode;
			}
		}
		echo json_encode($location_codes);
	}
	
	/* -------- ADD FUNCTIONS <START> -------- */
	/* -------- ADD FUNCTIONS <END> -------- */

	/* -------- UPDATE FUNCTIONS <START> -------- */
	/* -------- UPDATE FUNCTIONS <END> -------- */
}
/* End of file Search_model.php */
/* Location: ./application/models/frontend/Search_model.php */
?>
