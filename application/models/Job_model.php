<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Model extends CI_Model{

	//---------------------------------------------------
	// Count total jobs
	public function count_all_jobs()
	{
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		return $this->db->count_all_results('xx_job_post');
	}
	public function count_all_deals()
	{
		$this->db->where('is_status', 'active');
		return $this->db->count_all('xx_deal_post');
	}

	//---------------------------------------------------
	// Count total users
	public function count_all_search_result($search=null)
	{
		// search URI parameters
		unset($search['p']); //unset pagination parameter form search
		if(!empty($search))
			$this->db->where($search);

		if(!empty($search['title'])){
			$search_text = explode('-', $search['title']);
			foreach($search_text as $search){
				$this->db->group_start();
				$this->db->or_like('title', $search);
				$this->db->or_like('skills', $search);
				$this->db->group_end();
			}
		}

		if(!empty($search['posting_type']))
			$this->db->where('posting_type', $search['posting_type'] );

		$this->db->where('curdate() <  expiry_date');
		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');

		$this->db->from('xx_job_post');
		return $this->db->count_all_results();
	}
	public function count_all_search_result_cat()
	{
		// search URI parameters
//		unset($search['p']); //unset pagination parameter form search
		// if(!empty($search))
		// 	$this->db->where($search);

		// if(!empty($search['title'])){
		// 	$search_text = explode('-', $search['title']);
		// 	foreach($search_text as $search){
		// 		$this->db->group_start();
		// 		$this->db->or_like('title', $search);
		// 		$this->db->or_like('skills', $search);
		// 		$this->db->group_end();
		// 	}
		// }
		$this->db->select('*');
		$this->db->where('is_status', 'active');
		$this->db->where('posting_type', '2');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');

		$this->db->from('xx_job_post');
		return $this->db->count_all_results();
	}


	//---------------------------------------------------------------------------	
		// Get All Jobs for home
	public function get_all_jobs_for_home($limit, $offset, $search)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city, expiry_date, created_date, industry');
		$this->db->from('xx_job_post');
		
		// search URI parameters
		unset($search['p']); //unset pagination parameter form search
		
		if(!empty($search['company_id']))
			$this->db->where('company_id',$search['company_id'] );

		// if(!empty($search['country']))
		// 	$this->db->where('country',$search['country'] );

		// if(!empty($search['city']))
		// 	$this->db->where('city',$search['city'] );

		// if(!empty($search['category']))
		// 	$this->db->where('category',$search['category'] );

		// if(!empty($search['experience']))
		// 	$this->db->where('experience',$search['experience'] );

		// if(!empty($search['job_type']))
		// 	$this->db->where('job_type',$search['job_type'] );

		// if(!empty($search['employment_type']))
		// 	$this->db->where('employment_type',$search['employment_type'] );

		if(!empty($search['posting_type']))
			$this->db->where('posting_type',$search['posting_type'] );

		if(!empty($search['title'])){
			$search_text = explode('-', $search['title']);
			foreach($search_text as $search){
				$this->db->group_start();
				$this->db->or_like('title', $search);
				$this->db->or_like('skills', $search);
				$this->db->group_end();
			}
		}
		

		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_all_jobs_by_categories($limit, $offset, $search)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city, expiry_date, created_date, industry');
		$this->db->from('xx_job_post');
		
		// search URI parameters
		unset($search['p']); //unset pagination parameter form search

		if(!empty($search['country']))
			$this->db->where('country',$search['country'] );

		if(!empty($search['city']))
			$this->db->where('city',$search['city'] );

		if(!empty($search['category']))
			$this->db->where('category',$search['category'] );

		if(!empty($search['experience']))
			$this->db->where('experience',$search['experience'] );

		if(!empty($search['job_type']))
			$this->db->where('job_type',$search['job_type'] );

		if(!empty($search['employment_type']))
			$this->db->where('employment_type',$search['employment_type'] );

		if(!empty($search['title'])){
			$search_text = explode('-', $search['title']);
			foreach($search_text as $search){
				$this->db->group_start();
				$this->db->or_like('title', $search);
				$this->db->or_like('skills', $search);
				$this->db->group_end();
			}
		}
		

		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	// Get All Jobs
	public function get_all_jobs($limit, $offset, $search)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city, expiry_date, created_date, industry');
		$this->db->from('xx_job_post');
		
		// search URI parameters
		unset($search['p']); //unset pagination parameter form search

		if(!empty($search['country']))
			$this->db->where('country',$search['country'] );

		if(!empty($search['city']))
			$this->db->where('city',$search['city'] );

		if(!empty($search['category']))
			$this->db->where('category',$search['category'] );

		if(!empty($search['industry']))
			$this->db->where('industry',$search['industry'] );

		if(!empty($search['experience']))
			$this->db->where('experience',$search['experience'] );

		if(!empty($search['job_type']))
			$this->db->where('job_type',$search['job_type'] );

		if(!empty($search['employment_type']))
			$this->db->where('employment_type',$search['employment_type'] );

		if(!empty($search['posting_type']))
			$this->db->where('posting_type', $search['posting_type'] );

		if(!empty($search['title'])){
			$search_text = explode('-', $search['title']);
			foreach($search_text as $search){
				$this->db->group_start();
				$this->db->or_like('title', $search);
				$this->db->or_like('skills', $search);
				$this->db->group_end();
			}
		}

		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_all_jobs_bussiness($limit, $offset)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city, expiry_date, created_date, industry');
		$this->db->from('xx_job_post');
		
		// search URI parameters
//		unset($search['p']); //unset pagination parameter form search

		// if(!empty($search['country']))
		// 	$this->db->where('country',$search['country'] );

		// if(!empty($search['city']))
		// 	$this->db->where('city',$search['city'] );

		// if(!empty($search['category']))
		// 	$this->db->where('category',$search['category'] );

		// if(!empty($search['experience']))
		// 	$this->db->where('experience',$search['experience'] );

		// if(!empty($search['job_type']))
		// 	$this->db->where('job_type',$search['job_type'] );

		// if(!empty($search['employment_type']))
		// 	$this->db->where('employment_type',$search['employment_type'] );

		// if(!empty($search['posting_type']) || empty($search['posting_type']))
		// 	$this->db->where('posting_type','1' );

		// if(!empty($search['title'])){
		// 	$search_text = explode('-', $search['title']);
		// 	foreach($search_text as $search){
		// 		$this->db->group_start();
		// 		$this->db->or_like('title', $search);
		// 		$this->db->or_like('skills', $search);
		// 		$this->db->group_end();
		// 	}
		// }
		

		$this->db->where('is_status', 'active');
		$this->db->where('posting_type', '2');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_all_daily_deals()
	{
		$this->db->select('id, title, company_id, deal_slug, deal_type, description,expiry_date, created_date, industry');
		$this->db->from('xx_deal_post');
		
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$query = $this->db->get();
		return $query->result_array();
	}

	//---------------------------------------------------------------------------	
	// Get Job detail by ID
	public function get_job_by_id($id)
	{
		$query = $this->db->get_where('xx_job_post', array('id' => $id));
		return $result = $query->row_array();
	}
	// Get deals detail by ID
	public function get_deals_by_id($id)
	{
		$query = $this->db->get_where('xx_deal_post', array('id' => $id));
		return $result = $query->result_array();
	}
	// Get products detail by ID
	public function get_products_by_id($id)
	{
		$query = $this->db->get_where('xx_product_post', array('id' => $id));
		return $result = $query->row_array();
	} 
	//---------------------------------------------------------------------------	
	// Get User Detail by ID
	public function get_user_by_id($id)
	{
		$query = $this->db->get_where('xx_users', array('id' => $id));
		return $result = $query->row_array();
	}

	//------------------------------------------------------------------
	// Check the already applied job application
	public function check_applied_application($seeker_id, $job_id)
	{
		$data = array(
			'seeker_id'=> $seeker_id,
			'job_id'=> $job_id
		);
		$query = $this->db->get_where('xx_seeker_applied_job', $data);
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	//------------------------------------------------------------------
	// insert job application
	public function insert_job_application($user_id, $emp_id, $job_id, $cover_letter,$resume_name,$resume_path)
	{
		$data = array(
			'seeker_id'=> $user_id,
			'job_id'=> $job_id,
			'employer_id'=> $emp_id,
			'cover_letter'=> $cover_letter,
			'resume_name'=> $resume_name,
			'resume_path' => $resume_path,
			'applied_date' => date('Y-m-d : h:m:s')
		);
		$this->db->insert('xx_seeker_applied_job', $data);
		return true;
	}

	//----------------------------------------------------
	// Get those citites who have jobs
	public function get_cities_with_jobs()
	{
		$this->db->select('city as city_id, COUNT(city) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->group_by('city');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get those categories who have jobs
	public function get_categories_with_jobs()
	{
		$this->db->select('category as category_id, COUNT(category) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->group_by('category');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get those industries who have jobs
	public function get_industries_with_jobs()
	{
		$this->db->select('industry as industry_id, COUNT(industry) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->group_by('industry');
		$query = $this->db->get();
		return $query->result_array();
	}

	function deal_booked_slots($where_arr)
	{
		$this->db->select('slot')->from('xx_book_deal');
		$this->db->where($where_arr);
		return  $this->db->get()->result_array();
	}


} // endClass

?>