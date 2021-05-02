<?php

class Package_Model extends CI_Model{



	//---------------------------------------------------

	// Get All Packages

	public function get_all_pakages()

	{

		$this->db->where('package_for',1); // '1' is for employer

		$this->db->where('is_active', 1);

		$this->db->order_by('sort_order','desc'); 

		$query = $this->db->get('xx_packages');

		return  $result = $query->result_array();

	}



	//---------------------------------------------------

	// Get Package by ID

	public function get_package_by_id($id)

	{

		$query = $this->db->get_where('xx_packages', array('id' => $id));

		return $result = $query->row_array();

	}



	//----------------------------------------------------------------------

	// Active Job package

	public function get_active_package()

	{

		$this->db->select('xx_packages_bought.*, 

			xx_packages.title,

			xx_packages.no_of_posts,

			xx_packages.no_of_days,

			xx_packages.price,

			');

		$this->db->from('xx_packages_bought');

		$this->db->join('xx_packages','xx_packages.id = xx_packages_bought.package_id','left');

		$this->db->where('xx_packages_bought.employer_id', emp_id()); 

		$this->db->where('package_for', 1);

		$this->db->order_by("xx_packages_bought.buy_date", "DESC");

		$query = $this->db->get();

		$module = array();

		if ($query->num_rows() > 0) 

		{

			$module = $query->row_array();

		}

		return $module;

	}



	//---------------------------------------------------

	// Employer Boutght Package
		public function get_all_packages()

	{

		$this->db->select('*');

		$this->db->from('xx_packages');

		// $this->db->join('xx_packages','xx_packages.id = xx_packages_bought.package_id','left');

		// $this->db->where('xx_packages_bought.employer_id', $emp_id); 

		// $this->db->where('package_for', 1);

		// $this->db->order_by("xx_packages_bought.buy_date", "DESC");

		$query = $this->db->get();

		$module = array();

		if ($query->num_rows() > 0) 

		{

			$module = $query->result_array();

		}

		return $module;

	}


	public function get_employer_packages($emp_id)

	{

		$this->db->select('xx_packages_bought.*, 

			xx_packages.title,

			xx_packages.no_of_posts,

			xx_packages.no_of_days,

			xx_packages.detail,

			xx_packages.price,

			');

		$this->db->from('xx_packages_bought');

		$this->db->join('xx_packages','xx_packages.id = xx_packages_bought.package_id','left');

		$this->db->where('xx_packages_bought.employer_id', $emp_id); 

		$this->db->where('package_for', 1);

		$this->db->order_by("xx_packages_bought.buy_date", "DESC");

		$query = $this->db->get();

		$module = array();

		if ($query->num_rows() > 0) 

		{

			$module = $query->result_array();

		}

		return $module;

	}





	//------------------------------------------------	

	// Get Active Package

	public function get_active_package_id()

	{

		$query = $this->db->get_where('xx_packages_bought', array('employer_id' => emp_id(), 'is_active' => 1));

		return $result = $query->row_array()['id'];

	}

	//---------------------------------------------

	// Get Free Package

	public function get_free_package()

	{

		$query = $this->db->get_where('xx_packages', array('price' => '0'));

		return $result = $query->row_array();
		
	}

		public function contact($data)
	{
		$this->db->insert('xx_contact_us',$data);
		return true;
	}

	//-------------------------------------------------------------------
	// Get jobs for home page
	public function get_jobs($limit, $offset)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city, created_date, industry');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->where('posting_type', '1');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;

		return $query->result_array();
	}

		// Get jobs for home page
	public function get_services($limit, $offset)
	{
		$this->db->select('id, title, company_id, job_slug, job_type, description, country, city, created_date, industry');
		$this->db->from('xx_job_post');
		$this->db->where('is_status', 'active');
		$this->db->where('posting_type', '2');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;

		return $query->result_array();
	}
		// Get jobs for home page
	public function get_products($limit, $offset)
	{
		$this->db->select('*');
		$this->db->from('xx_product_post');
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		//echo $this->db->last_query();exit;

		return $query->result_array();
	}
		// Get jobs for home page
	public function get_deals($limit, $offset)
	{
		$this->db->select('id, title, company_id, deal_slug, deal_type, description,expiry_date, created_date, industry');
		$this->db->from('xx_deal_post');
		
		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();

	}

	//----------------------------------------------------
	// Get those citites who have jobs
	public function get_cities_with_jobs()
	{
		$this->db->select('city as name, COUNT(city) as total_jobs');
		$this->db->from('xx_job_post');
		$this->db->group_by('city');
		$query = $this->db->get();
		return $query->result_array();
	}

	//----------------------------------------------------
	// Get companies logos having active job for home page
	public function get_companies_having_active_jobs($limit)
	{
		$this->db->select('
			*
		');
		$this->db->join('xx_job_post','xx_job_post.company_id = xx_companies.id');
		$this->db->where('xx_job_post.is_status','active');
		$this->db->limit($limit);
		$this->db->group_by('xx_companies.company_slug');
		$this->db->from('xx_companies');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_latest_blog_post()
	{
		$this->db->select('xx_blog_posts.*');
		$this->db->from('xx_blog_posts');
		$this->db->order_by('created_at','desc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array();
	}

	//get page
    public function get_page($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->where('is_active', 1);
        $query = $this->db->get('xx_pages');
        return $query->row_array();
    }

    //-------------------------------------------------------------------
	// Get testimonials
	public function get_testimonials()
	{
		$this->db->select('*');
		$this->db->from('xx_testimonials');
		$this->db->order_by('is_default','desc');
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->result_array();

	}

	public function add_subscriber($data)
	{
		$this->db->where('email',$data['email']);
		$query = $this->db->get('xx_subscribers');

		if($query->num_rows() > 0)
		{
			return true;
		}
		else
		{
			$this->db->insert('xx_subscribers',$data);
			return true;
		}
	}


	

} //endClass

?>