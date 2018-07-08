<?php
class Page_model extends CI_Model {

    function __construct() {
    	parent::__construct();
    }
	
	/*------------ Function List <Start>-----------------
	0: getPageData 
	------------ Function List <End>-----------------*/
	/* -------- GET FUNCTIONS <START> -------- */

	function getPageData($page_id) { 
        $qStr = "SELECT 
					#PAGES
					id, page_id, page_name, field_name, content
				 FROM
					pages 
				 WHERE
					page_id = ".$page_id." AND
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
	function getPageFaqs($page_id) { 
        $qStr = "SELECT 
					*
				 FROM
					faq_headings 
				 WHERE
					page_id = ".$page_id." AND
					is_active = ".ACTIVE_STATUS_ID;

        $query = $this->db->query($qStr);
        $result= $query->result_array();
        if(!empty($result)){ 
			foreach($result as $key=>$data){
				$result[$key]['faqs'] = $this->getFaq($data['id']);
			}
		}
        return $result;
    }
	function getFaq($faq_heading_id){
        $qStr = "SELECT 
					id as faq_id, question, answer
				 FROM
					faqs 
				 WHERE
					faq_heading_id = ".$faq_heading_id." AND
					is_active = ".ACTIVE_STATUS_ID;

        $query = $this->db->query($qStr);
        $result= $query->result_array();
		return $result;
	}
	/* -------- GET FUNCTIONS <END> -------- */
	
	/* -------- ADD FUNCTIONS <START> -------- */
	/* -------- ADD FUNCTIONS <END> -------- */

	/* -------- UPDATE FUNCTIONS <START> -------- */
	/* -------- UPDATE FUNCTIONS <END> -------- */
}
/* End of file Page_model.php */
/* Location: ./application/models/frontend/Page_model.php */
?>
