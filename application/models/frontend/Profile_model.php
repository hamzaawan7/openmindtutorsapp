<?php
class Profile_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	/*------------ Function List <Start>-----------------
	0: isEmailExist
	0: getTutorDetailsById
	0: getMainSubjects 
	0: getSubjectsByMainId 
	0: getLevelById 
	0: getTutorFirstLevel 
	0: getSubjectsByTutorId 
	0: getTutorLevelById 
	0: getSubjectsByStudentId 
	0: relatedStudents 
	0: update 
	0: updatePassword 
	0: saveTutorProfile 
	0: saveTutorSubjects 
	0: saveTutorAvailability 
	0: saveTutorGroupAvailability 
	0: saveTutorLevel 
	------------ Function List <End>-----------------*/
	/* -------- GET FUNCTIONS <START> -------- */
	// isEmailExist
	function isEmailExist($email,$user_id){
        $qStr = "SELECT
					*
				 FROM
					users
				 WHERE
					email = '".$email."' AND id != '".$user_id."' AND is_active != ".DELETED_STATUS_ID;

        $query = $this->db->query($qStr);
		$result = $query->row_array();
		if(!empty($result)){
			return $result['id'];
		}else{
			return 0;
		}
	}
	// getTutorDetailsById
	function getTutorDetailsById($tutor_id){
        $qStr = "SELECT
					tutor_details.*, users.first_name, users.last_name, users.address, users.image
				 FROM
					tutor_details
				 INNER JOIN 
					users
					ON
					users.id = tutor_details.tutor_id
				 WHERE
					tutor_details.tutor_id = '".$tutor_id."' AND users.is_active != ".DELETED_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;
	}
	// getMainSubjects
	function getMainSubjects(){
        $qStr = "SELECT
					id,name
				 FROM
					main_subjects
				 WHERE
					is_active != ".DELETED_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	function getMainAreas(){
        $qStr = "SELECT
					*
				 FROM
					areas
				 WHERE
					is_active != ".DELETED_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	// getSubjectsByMainId
	function getSubjectsByMainId($main_subject_id){
        $qStr = "SELECT
					id as subject_id,name as subject_name
				 FROM
					subjects
				 WHERE
					main_subject_id = '".$main_subject_id."' AND is_active != ".DELETED_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();		
		return $result;
	}
	// getLevelById 
	function getLevelById($level_id){
        $qStr = "SELECT
					levels.*
				 FROM
					levels
				 WHERE
					levels.id = '".$level_id."' AND levels.is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->row_array();		
		return $result;
	}
	// getTutorFirstLevel
	function getTutorFirstLevel($level_type){
        $qStr = "SELECT
					*
				 FROM
					levels
				 WHERE
					level_type = '".$level_type."' AND is_active = ".ACTIVE_STATUS_ID." AND is_default = ".ACTIVE_STATUS_ID." 
					ORDER BY level_order ASC LIMIT 1";
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;		
	}
	// getSubjectsByTutorId
	function getSubjectsByTutorId($tutor_id){
        $qStr = "SELECT
					subject_id 
				 FROM
					tutor_subjects
				 WHERE
					tutor_id = '".$tutor_id."' AND is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		$subjects = array();
		if(!empty($result)){
			foreach($result as $key=>$row){
				$subjects[$key] = $row['subject_id'];
			}
		}
		return $subjects;
	}
	// getAvailabilityByTutorId
	function getAvailabilityByTutorId($tutor_id){
		$qStr ="SELECT * FROM
					tutor_availability
				WHERE
					tutor_id = ".$tutor_id." AND availability_type =".SINGLE_AVAILABLE." AND is_active !=".DELETED_STATUS_ID;
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	// getGroupAvailabilityByTutorId
	function getGroupAvailabilityByTutorId($tutor_id){
		$qStr ="SELECT * FROM
					tutor_availability
				WHERE
					tutor_id = ".$tutor_id." AND availability_type =".GROUP_AVAILABLE." AND is_active !=".DELETED_STATUS_ID;
		$query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	// getTutorLevelById
	function getTutorLevelById($tutor_id,$level_id){
        $qStr = "SELECT
					*
				 FROM
					tutor_level
				 WHERE
					tutor_id = '".$tutor_id."' AND level_id = '".$level_id."' AND is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->row_array();		
		return $result;		
	}
	// getSubjectsByStudentId
	function getSubjectsByStudentId($student_id){
        $qStr = "SELECT
					subject_id 
				 FROM
					student_subjects
				 WHERE
					student_id = '".$student_id."' AND is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		$subjects = array();
		if(!empty($result)){
			foreach($result as $key=>$row){
				$subjects[$key] = $row['subject_id'];
			}
		}
		return $subjects;
	}
	function relatedStudents($subject_id,$user_id){
        $qStr1 = "SELECT
					student_id 
				 FROM
					student_subjects
				 WHERE
					subject_id IN (".$subject_id.") AND student_id != '".$user_id."' AND is_active = ".ACTIVE_STATUS_ID."
				 GROUP BY student_id";
        $query1 = $this->db->query($qStr1);
		$result1 = $query1->result_array();
		$related_students = array();
		$index = 0;
		if(!empty($result1)){
			foreach($result1 as $row){
				$related_students[$index] = $this->user_model->getUserById($row['student_id']);
				$index++;
			}
		}
		return $related_students;
	}
	/* -------- GET FUNCTIONS <END> -------- */
	/* -------- UPDATE FUNCTIONS <START> -------- */
	// Update
	function update($user_id,$first_name,$last_name,$email,$title,$gender,$phone_code,$phone,$country_id,$city,$postal_code,$address,$instruction,$file_name,$subject_id,$subject_text,$student_area){
		$postal_code = strtoupper($postal_code);
		if(!empty($subject_id)){
			$this->saveStudentSubecjts($user_id,$subject_id,$subject_text);
		}
		$qStr = "UPDATE 
					users
					SET
				`first_name` = '".addslashes($first_name)."', `last_name` = '".addslashes($last_name)."', `email` = '".$email."', `title` = '".$title."', `gender` = '".$gender."',
				`phone_code` = '".$phone_code."', `phone` = '".addslashes($phone)."', `country_id` = '".$country_id."', `city` = '".addslashes($city)."',`postal_code` = '".addslashes($postal_code)."',
				`address` = '".addslashes($address)."',`area` = '".addslashes($student_area)."', `instruction` = '".addslashes($instruction)."',`image` = '".$file_name."',
				`modified` = '".time()."'
				 WHERE 
					id = '".$user_id."'";
		return $query = $this->db->query($qStr);
	}
	function saveStudentSubecjts($user_id,$subject_id,$subject_text){
		$qStr1 ="DELETE FROM
					student_subjects
				WHERE
					student_id = ".$user_id;
		$query1 = $this->db->query($qStr1);		
		foreach($subject_id as $key=>$row){
			$row = explode(';',$row);
			$qStr ="INSERT INTO
						student_subjects
					SET
						student_id = '".$user_id."', main_subject_id = '".$row[0]."', subject_id = '".$row[1]."', subject_name = '".$subject_text[$key]."',
						is_active = ".ACTIVE_STATUS_ID.", created = ".time();
			$query = $this->db->query($qStr);
		}
	}

	// updatePassword
	function updatePassword($user_id,$new_password){
		$qStr = "UPDATE 
					users
					SET
				`password` = '".$new_password."', `modified` = '".time()."'
				 WHERE 
					id = '".$user_id."'";
		return $query = $this->db->query($qStr);
	}
	/* -------- UPDATE FUNCTIONS <END> -------- */
	/* -------- INSERT FUNCTIONS <START> -------- */
	// saveTutorProfile
	function saveTutorProfile($tutor_id,$level_id,$subject_id,$travel_distance,$headline,$personal_statement,$hourly_rate,$education,$teaching,$tutor_experience,
							$tutor_hours,$tutor_subjects,$available,$group_available,$certificate_file,$teaching_levels,$subject_text,$subject_level,$info_file,$group_hourly_rate){
		/*$this->saveLevel($subject_level);*/
		if(!empty($teaching_levels)){
			$teaching_levels = explode(',',$teaching_levels);
			$qStr2 ="DELETE FROM
						tutor_teaching_level
					WHERE
						tutor_id = ".$tutor_id;
			$query2 = $this->db->query($qStr2);
			foreach($teaching_levels as $teaching_level){
				if(!empty($teaching_level)){
					$this->saveTeachingLevel($tutor_id,$teaching_level);
				}
			}
		}
		/* saving tutor subjects, avaiability, level*/
		if(!empty($subject_id)){
			$this->saveTutorSubjects($tutor_id,$subject_id,$subject_text);
		}
		if(!empty($available)){
			$this->saveTutorAvailability($tutor_id,$available);
		} else {
			$qStr3 ="UPDATE
					tutor_availability
				 SET 
					is_active = ".DELETED_STATUS_ID.", modified = ".time()."
				 WHERE
					tutor_id = ".$tutor_id." AND availability_type =".SINGLE_AVAILABLE;
			$query3 = $this->db->query($qStr3);
		}
		if(!empty($group_available)){
			$this->saveTutorGroupAvailability($tutor_id,$group_available);
		} else {
			$qStr1 ="UPDATE
						tutor_availability
					 SET 
						is_active = ".DELETED_STATUS_ID.", modified = ".time()."
					 WHERE
						tutor_id = ".$tutor_id." AND availability_type =".GROUP_AVAILABLE;
			$query1 = $this->db->query($qStr1);
		}
		$this->saveTutorLevel($tutor_id,$level_id);
		// tutor details
		$tutor_details = $this->getTutorDetailsById($tutor_id);
		if(empty($tutor_details)){
			//echo "empty details";
			$qStr ="INSERT INTO
						tutor_details
					SET
						tutor_id = '".$tutor_id."', level_id = '".$level_id."', subject_level = '".addslashes($subject_level)."', info_file = '".addslashes($info_file)."', travel_distance = '".$travel_distance."' , headline = '".addslashes($headline)."',
						personal_statement = '".addslashes($personal_statement)."', hourly_rate = '".addslashes($hourly_rate)."', group_hourly_rate = '".addslashes($group_hourly_rate)."', education = '".$education."' , certificate_file = '".$certificate_file."',
						teaching = '".$teaching."', tutor_experience = '".addslashes($tutor_experience)."', tutor_hours = '".addslashes($tutor_hours)."' , tutor_subjects = '".addslashes($tutor_subjects)."',
						is_active = ".ACTIVE_STATUS_ID.", created = ".time();
			//echo $qStr;
			$query = $this->db->query($qStr);
			$user_id = $this->db->insert_id();
			//die();
			return true;
		} else {
			//echo "not empty details";
			$qStr ="UPDATE
						tutor_details
					SET
						level_id = '".$level_id."', subject_level = '".addslashes($subject_level)."', info_file = '".addslashes($info_file)."', travel_distance = '".$travel_distance."' , headline = '".addslashes($headline)."',
						personal_statement = '".addslashes($personal_statement)."', hourly_rate = '".addslashes($hourly_rate)."', group_hourly_rate = '".addslashes($group_hourly_rate)."', education = '".$education."' , certificate_file = '".$certificate_file."',
						teaching = '".$teaching."', tutor_experience = '".addslashes($tutor_experience)."', tutor_hours = '".addslashes($tutor_hours)."' , tutor_subjects = '".addslashes($tutor_subjects)."',
						is_active = ".ACTIVE_STATUS_ID.", modified = ".time()."
					WHERE 
						tutor_id = ".$tutor_id;
			$query = $this->db->query($qStr);
			//die();
			return true;
		}
	}
	// saveTutorSubjects
	function saveTutorSubjects($tutor_id,$subject_id,$subject_text){
		$qStr1 ="DELETE FROM
					tutor_subjects
				WHERE
					tutor_id = ".$tutor_id;
		$query1 = $this->db->query($qStr1);		
		foreach($subject_id as $key=>$row){
			$row = explode(';',$row);
			$qStr ="INSERT INTO
						tutor_subjects
					SET
						tutor_id = '".$tutor_id."', main_subject_id = '".$row[0]."', subject_id = '".$row[1]."', subject_name = '".$subject_text[$key]."',
						is_active = ".ACTIVE_STATUS_ID.", created = ".time();
			$query = $this->db->query($qStr);
		}
	}
	// saveTutorAvailability
	function saveTutorAvailability($tutor_id,$available){
		$qStr1 ="UPDATE
					tutor_availability
				 SET 
					is_active = ".DELETED_STATUS_ID.", modified = ".time()."
				 WHERE
					tutor_id = ".$tutor_id." AND availability_type =".SINGLE_AVAILABLE;
		$query1 = $this->db->query($qStr1);
		foreach($available as $key=>$row){
			foreach ($row['times'] as $time_available){
				if(!empty($time_available)){
					$time_avail = explode("/",$time_available);
					if($time_avail[1] == 0){
						$qStr ="INSERT INTO
									tutor_availability
								SET
									tutor_id = '".$tutor_id."', day_available = '".$key."', time_available = '".$time_avail[0]."', availability_type = '".SINGLE_AVAILABLE."',
									seats = 1, is_active = ".ACTIVE_STATUS_ID.", created = ".time();
						$query = $this->db->query($qStr);
					} else {
						$qStr2 ="UPDATE
									tutor_availability
								SET
									tutor_id = '".$tutor_id."', day_available = '".$key."', time_available = '".$time_avail[0]."', availability_type = '".SINGLE_AVAILABLE."',
									seats = 1, is_active = ".ACTIVE_STATUS_ID.", modified = ".time()."
								 WHERE
									id = '".$time_avail[1]."' AND availability_type =".SINGLE_AVAILABLE;
						$query2 = $this->db->query($qStr2);						
					}
				}
			}
		}
	}
	// saveTutorGroupAvailability
	function saveTutorGroupAvailability($tutor_id,$group_available){
		$qStr1 ="UPDATE
					tutor_availability
				 SET 
					is_active = ".DELETED_STATUS_ID.", modified = ".time()."
				 WHERE
					tutor_id = ".$tutor_id." AND availability_type =".GROUP_AVAILABLE;
		$query1 = $this->db->query($qStr1);
		foreach($group_available as $key=>$row){
			foreach ($row['times'] as $time_available){
				if(!empty($time_available)){
					$time_avail = explode("/",$time_available);
					if($time_avail[1] == 0){
						$qStr ="INSERT INTO
									tutor_availability
								SET
									tutor_id = '".$tutor_id."', day_available = '".$key."', time_available = '".$time_avail[0]."', syllabus = '".addslashes($row['syllabus'])."', availability_type = '".GROUP_AVAILABLE."',
									seats = '".$row['no_of_students']."', is_active = ".ACTIVE_STATUS_ID.", created = ".time();
						$query = $this->db->query($qStr);
					} else {
						$qStr2 ="UPDATE
									tutor_availability
								SET
									tutor_id = '".$tutor_id."', day_available = '".$key."', time_available = '".$time_avail[0]."', syllabus = '".addslashes($row['syllabus'])."', availability_type = '".GROUP_AVAILABLE."',
									seats = '".$row['no_of_students']."', is_active = ".ACTIVE_STATUS_ID.", modified = ".time()."
								 WHERE
									id = '".$time_avail[1]."' AND availability_type =".GROUP_AVAILABLE;
						$query2 = $this->db->query($qStr2);						
					}
				}
			}
		}
	}
	// saveTutorLevel
	function saveTutorLevel($tutor_id,$level_id){
		$tutor_level = $this->getTutorLevelById($tutor_id,$level_id);
		if(empty($tutor_level)){
			$qStr ="INSERT INTO
						tutor_level
					SET
						tutor_id = '".$tutor_id."', level_id = '".$level_id."', is_active = ".ACTIVE_STATUS_ID.", created = ".time();
			$query = $this->db->query($qStr);
		}
	}
	
	function saveTutorLevelinDetail($tutor_id,$level_id){
		
			$qStr ="INSERT INTO
						tutor_details
					SET
						tutor_id = ".$tutor_id.", level_id = ".$level_id.", is_active = ".ACTIVE_STATUS_ID.", created = ".time();
			$query = $this->db->query($qStr);
	}
	// 
	function saveTeachingLevel($tutor_id,$teaching_level){
		$qStr2 ="INSERT INTO
					tutor_teaching_level
				SET
					tutor_id = '".$tutor_id."', name = '".$teaching_level."', created = ".time();
		$query2 = $this->db->query($qStr2);
		/*$teaching_l = $this->getTeachingLevel($teaching_level);
		if(empty($teaching_l) && !empty($teaching_level)){
			$qStr = "INSERT INTO
						teaching_levels
					 SET
						name = '".$teaching_level."', is_active = ".ACTIVE_STATUS_ID.", created = ".time()."";
			$query = $this->db->query($qStr);
		}*/
	}
	function saveLevel($level){
		$level = explode(',',$level);
		foreach($level as $row){
			$teaching_l = $this->getTeachingLevel($row);
			if(empty($teaching_l) && !empty($row)){
				$qStr = "INSERT INTO
							teaching_levels
						 SET
							name = '".$row."', is_active = ".ACTIVE_STATUS_ID.", created = ".time()."";
				$query = $this->db->query($qStr);
			}
		}
	}
	function getTeachingLevel($teaching_level){
        $qStr = "SELECT
					*
				 FROM
					teaching_levels
				 WHERE
					name LIKE '%".$teaching_level."%' AND is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result;
	}
	function getTeachingLevels(){
        $qStr = "SELECT
					*
				 FROM
					teaching_levels
				 WHERE
					is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
		$result = $query->result_array();
		return $result;
	}
	/* -------- INSERT FUNCTIONS <END> -------- */
	function getTutorTotalLessons($tutor_id){
        $qStr = "SELECT
					COUNT(*) as total_lessons
				 FROM
					lessons
				 WHERE
					tutor_id = '".$tutor_id."' AND is_active = ".ACTIVE_STATUS_ID." AND status = ".COMPLETED;
        $query = $this->db->query($qStr);
		$result = $query->row_array();
		return $result['total_lessons'];
	}
	function changeUserStatus($user_id,$status){
		$qStr ="UPDATE
						users
					SET
						is_active = ".$status.", modified = ".time()."
					WHERE
						id=".$user_id;
        return $query = $this->db->query($qStr);		
	}

}
/* End of file User_model.php */
/* Location: ./application/models/frontend/User_model.php */
?>
