<?php

class Staff_model extends CI_Model{

	/* add staff */
	public function add_staff($data)
	{
		$this->db->insert('xx_staff',$data);
		return  $this->db->insert_id();
	}

	/* get business staff */
	public function get_business_staff($business_id, $service_id)
	{
    $this->db->select('xx_staff.id, xx_staff.name, xx_staff.gender, xx_staff.designation, xx_staff.service_id, xx_staff.working_days, xx_staff.shift_start, xx_staff.shift_end,
    	xx_job_post.duration, xx_job_post.job_type, 
    	xx_service_type.id as service_type_id, xx_service_type.name as service_name,
    	xx_service_category.name as category_name');
    $this->db->from('xx_staff');
    $this->db->join(' xx_job_post', 'xx_staff.service_id= xx_job_post.id', 'left');
    $this->db->join(' xx_service_type', 'xx_job_post.job_type= xx_service_type.id', 'left');
    $this->db->join(' xx_service_category', 'xx_job_post.category= xx_service_category.id', 'left');
    // $this->db->join(' xx_book_service', 'xx_staff.id= xx_book_service.staff_id', 'left');
		$this->db->where('xx_job_post.company_id', $business_id);
		$this->db->where('xx_staff.service_id', $service_id);
		return  $this->db->get()->result();
	}	

	public function staff_booked_slots($where_arr)
	{
		$this->db->select('slot, days_booked')->from('xx_book_service');
		$this->db->where($where_arr);
		return  $this->db->get()->result_array();
	}

}

?>