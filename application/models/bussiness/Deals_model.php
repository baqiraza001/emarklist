<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Deals_Model extends CI_Model{

	public function get_deals($limit, $offset)
	{
		$company_id = get_company_id_by_employer($this->session->userdata('employer_id'));
		$this->db->select('xx_deal_post.*, xx_service_type.name as service_name,
			xx_service_category.name as category_name');
		$this->db->from('xx_deal_post');
		$this->db->join(' xx_service_type', 'xx_deal_post.deal_type= xx_service_type.id', 'left');
		$this->db->join(' xx_service_category', 'xx_deal_post.category= xx_service_category.id', 'left');
		$this->db->where('company_id', $company_id);
		$this->db->order_by('id','desc');

		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_all_deals()
	{
		$company_id = get_company_id_by_employer($this->session->userdata('employer_id'));
		$this->db->where('company_id', $company_id);
		return $this->db->count_all('xx_deal_post');
	}

	public function get_record($deal_id = 0)
	{
		$company_id = get_company_id_by_employer($this->session->userdata('employer_id'));
		$this->db->select('xx_deal_post.*, xx_service_type.name as service_name,
			xx_service_category.name as category_name');
		$this->db->from('xx_deal_post');
		$this->db->join(' xx_service_type', 'xx_deal_post.deal_type= xx_service_type.id', 'left');
		$this->db->join(' xx_service_category', 'xx_deal_post.category= xx_service_category.id', 'left');
		$this->db->where('company_id', $company_id);
		$this->db->where('xx_deal_post.id', $deal_id);

		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_deal_media($deal_id = 0)
	{
		return $this->db->select('name')
		->where('deal_id',$deal_id)
		->get('xx_deal_media')
		->result();
	}

	public function delete_media($deal_id = 0)
	{
		$this->db->where('deal_id',$deal_id);
		$this->db->delete('xx_deal_media');
	}
	
	public function edit($data, $deal_id = 0)
	{
		$this->db->where('id', $deal_id);
		$this->db->update('xx_deal_post',$data);
	}

	//----------------------------------------------------------------------
	// Total Job Posted
	public function count_posted_jobs($pkg_id, $is_featured, $payment_id)
	{
		$this->db->where('package_id', $pkg_id);
		$this->db->where('payment_id', $payment_id);
		$this->db->where('is_featured', $is_featured);
		return $this->db->count_all_results('xx_job_post_featured');
	}

	//----------------------------------------------------------------------
	// Get Jobs
	public function get_all_jobs($emp_id){
		$this->db->select('xx_job_post.*, 
			Count(xx_seeker_applied_job.seeker_id) as cand_applied, 
			SUM(CASE WHEN xx_seeker_applied_job.is_shortlisted > 0 THEN 1 ELSE 0 END) as total_shortlisted,
			SUM(CASE WHEN xx_seeker_applied_job.is_interviewed > 0 THEN 1 ELSE 0 END) as total_interviewed');
		$this->db->from('xx_job_post');
		$this->db->join('xx_seeker_applied_job','xx_seeker_applied_job.job_id = xx_job_post.id','left');
		$this->db->where('xx_job_post.employer_id', $emp_id); 
		$this->db->group_by('xx_job_post.id');
		$this->db->order_by("xx_job_post.created_date", "DESC");
		$query = $this->db->get();
		$module = array();
		if ($query->num_rows() > 0) 
		{
			$module = $query->result_array();
		}
		return $module;
	}

	//----------------------------------------------------------------------
	// Get job by ID
	public function get_job_by_id($job_id,$emp_id){
		$query = $this->db->get_where('xx_job_post', array('id' => $job_id , 'employer_id' => $emp_id ));
		return $result = $query->row_array();
	}

	//----------------------------------------------------------------------
	// Edit Job
	public function edit_job($data,$job_id,$emp_id){
		$this->db->where('id',$job_id);
		$this->db->where('employer_id',$emp_id);
		$this->db->update('xx_job_post',$data);
		return true;
	}

}//end class

?>