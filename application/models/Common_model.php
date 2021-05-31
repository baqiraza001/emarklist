<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model 
{

	//-----------------------------------------------------
	//Get Education
    function get_education($user_id)
    {
   	   $this->db->from('education');
	   $this->db->where('user_id',$user_id);
	   $query = $this->db->get();
	   return $query->result_array();
    }	

	//-------------------------------------------------------------
	// Experience
    function get_experience($user_id)
    {
   	   $this->db->from('experience');
	   $this->db->where('user_id',$user_id);
	   $query = $this->db->get();
	   return $query->result_array();
    }

    //-----------------------------------------------------------
    // Get Compnay record by ID
	function get_company($id=0)
	{
		if($id==0)
		{
			return  $this->db->select('id,name')->from('company')->where('active',1)->get()->result_array();	
		}
		else
		{
			return  $this->db->select('id,name')->from('company')->where('active',1)->where('id',$id)->get()->row_array();	
		}
	}

	//-----------------------------------------------
	// Get industries
    function get_industries_list()
    {
   	   $this->db->from('xx_industries');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }

	//-----------------------------------------------
	// Get Categories
    function get_categories_list()
    {
   	   $this->db->from('xx_categories');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }	

    //-----------------------------------------------
	// Get Blog Categories
    function get_blog_categories_list()
    {
   	   $this->db->from('xx_blog_categories');
   	   $this->db->order_by('name');
	   $query = $this->db->get();
	   return $query->result_array();
    }	
	public function safe_insert($table,$data=array(),$debug=FALSE)
	{
		if($table!="" && is_array($data) && !empty($data) )
		{	 
			$qstr = $this->db->insert_string($table,$data);	
			$this->db->query($qstr);
			if ( $debug )
			{ 
				echo  $this->db->last_query(); 
				
			}
			return $this->db->insert_id();
		}
	} 
	//------------------------------------------------
	// Get Countries
	function get_countries_list($id=0)
	{
		if($id==0)
		{
			return  $this->db->get('xx_countries')->result_array();	
		}
		else
		{
			//return  $this->db->select('id,country')->from('xx_countries')->where('id',$id)->get()->row_array();	
			return $this->db->query("SELECT * FROM xx_countries WHERE id='".$id."' ")->result_array();
		}
	}	

	//------------------------------------------------
	// Get Cities
	function get_cities_list($id=0)
	{
		if($id==0){
			return  $this->db->get('xx_cities')->result_array();	
		}
		else{
			return  $this->db->select('id,city')->from('xx_cities')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------
	// Get States
	function get_states_list($id=0)
	{
		if($id==0){
			return  $this->db->get('xx_states')->result_array();	
		}
		else{
			return  $this->db->select('id,name')->from('xx_cities')->where('id',$id)->get()->row_array();	
		}
	}	

	function get_states_by_country($country_id=0)
	{
			return  $this->db->select('id,name')->from('xx_states')->where('country_id',$country_id)->get()->result_array();	
	}	

	//------------------------------------------------
	// Get Nationality
	function get_nationality_dd($id=0)
	{
		if($id==0){
			return  $this->db->get('xx_nationality')->result_array();	
		}
		else{
			return  $this->db->select('id,nationality')->from('xx_nationality')->where('id',$id)->get()->row_array();	
		}
	}	

	//------------------------------------------------	
	// Get the Education Status Dropdown
	public function get_education_list()
	{
		return $this->db->get('xx_education')->result_array();
	}

	//------------------------------------------------	
	// Get the Education Status Dropdown
	public function get_visa_status()
	{
		return $this->db->get('xx_visa_status')->result_array();
	}

	//------------------------------------------------	
	// Get the Salary Offered Dropdown
	public function get_salary_list()
	{
		return $this->db->get('xx_expected_salary')->result_array();
	}

	//Get company data
	public function get_companies_having_active_jobs($limit)
	{
		$this->db->select('
			xx_job_post.company_id, 
			xx_job_post.is_status, 
			xx_companies.company_slug, 
			xx_companies.company_logo,
		');
		$this->db->join('xx_job_post','xx_job_post.company_id = xx_companies.id');
		$this->db->where('xx_job_post.is_status','active');
		$this->db->limit($limit);
		$this->db->group_by('xx_companies.company_slug');
		$this->db->from('xx_companies');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_jobs($limit, $offset)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city, created_date, industry');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;

		return $query->result_array();
	}


	// gat image name
	public function image_title($pid){
		return $pid;
		//return $this->db->query("SELECT * FROM xx_product_media WHERE product_id=$pid")->result_array();
	}

} // endClass
?>