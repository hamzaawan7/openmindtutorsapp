<?php
class Page_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	/*------------ Function List <Start>-----------------
	0: getPageData 
	------------ Function List <End>-----------------*/
	/* -------- GET FUNCTIONS <START> -------- */

	function getPageData($page_id,$page_type) { 
        $qStr = "SELECT 
					#PAGES
					id, page_name, content
				 FROM
					pages 
				 WHERE
					page_id = ".$page_id." AND page_type = ".$page_type." AND
					is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
        $result= $query->row_array();
        return $result;
    }
	function getFaqPageHeading($page_id) { 
        $qStr = "SELECT 
					*
				 FROM
					faq_headings 
				 WHERE
					page_id = ".$page_id." AND
					is_active = ".ACTIVE_STATUS_ID;
        $query = $this->db->query($qStr);
        $result= $query->result_array();
        return $result;
    }
	function getFaqPageContent($page_id) { 
        $qStr = "SELECT
					faqs.*,faq_headings.heading,faq_headings.page_id
				 FROM
					faqs
				 INNER JOIN
					faq_headings
					ON
					faq_headings.id = faqs.faq_heading_id
				 WHERE
					faq_headings.page_id = ".$page_id." AND				 
					faqs.is_active != ".DELETED_STATUS_ID;
        $query = $this->db->query($qStr);
        $result= $query->result_array();
        return $result;
    }
	/* -------- GET FUNCTIONS <END> -------- */
	
	/* -------- ADD FUNCTIONS <START> -------- */
	function addPageHeading($page_id,$page_heading) {
        $qStr = "INSERT INTO faq_headings 
					SET
				 page_id = ".$page_id.",is_active = ".ACTIVE_STATUS_ID.", heading = '".addslashes($page_heading)."', created = ".time()."";
        $query = $this->db->query($qStr);
        return $query;				
	}
	function addFaqs($faq_heading_id,$page_question,$page_answer) {
        $qStr = "INSERT INTO faqs 
					SET
				 faq_heading_id = ".$faq_heading_id.", question = '".addslashes($page_question)."', answer = '".addslashes($page_answer)."',is_active = ".ACTIVE_STATUS_ID.",
				 created = ".time()."";
        $query = $this->db->query($qStr);
        return $query;				
	}
	/* -------- ADD FUNCTIONS <END> -------- */

	/* -------- UPDATE FUNCTIONS <START> -------- */
	function updatePageContent($page_id,$content){
        $qStr = "UPDATE pages 
					SET
				 content = '".addslashes($content)."', modified = ".time()."
				WHERE
					page_id = ".$page_id;
        $query = $this->db->query($qStr);
        return $query;
	}
	function changePageHeadingStatus($id,$status){
        $qStr = "UPDATE faq_headings 
					SET
				 is_active = '".$status."', modified = ".time()."
				WHERE
					id = ".$id;
        $query = $this->db->query($qStr);
        return $query;
	}
	function changeFaqStatus($id,$status){
        $qStr = "UPDATE faqs 
					SET
				 is_active = '".$status."', modified = ".time()."
				WHERE
					id = ".$id;
        $query = $this->db->query($qStr);
        return $query;
	}
	function changeSettings($contact_email,$stripe_pub,$stripe_secret){
        $qStr = "UPDATE settings 
					SET
				 contact_email = '".$contact_email."', stripe_pub = '".addslashes($stripe_pub)."', stripe_secret = '".addslashes($stripe_secret)."', modified = ".time()."
				WHERE
					id = 1";
        $query = $this->db->query($qStr);
        return $query;		
	}
	
	function changeTierSettings($default_tier,$tierRates){
        $qStr1 = "UPDATE levels 
					SET
				 is_default = ".INACTIVE_STATUS_ID.", modified = ".time()."
				WHERE
					id != ".$default_tier;
        $this->db->query($qStr1);
		$qStr2 = "UPDATE levels 
					SET
				 is_default = ".ACTIVE_STATUS_ID.", modified = ".time()."
				WHERE
					id = ".$default_tier;
        $this->db->query($qStr2);
		foreach($tierRates as $index=>$tierRate){
			$qStr3 = "UPDATE levels 
					SET
				 max_charge = ".$tierRate.", modified = ".time()."
				WHERE
					id = ".$index;
			$query = $this->db->query($qStr3);
		}
        return $query;		
	}
	/* -------- UPDATE FUNCTIONS <END> -------- */
}
/* End of file Page_model.php */
/* Location: ./application/models/frontend/Page_model.php */
?>
