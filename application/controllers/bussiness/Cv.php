<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cv extends Main_Controller{

	public function __construct(){
		parent::__construct();
		$this->per_page_record = 10;
		$this->rbac->check_emp_authentiction();	// checking user login session
		$this->load->model('bussiness/cv_model','cv_model');
	}

	//--------------------------------------------------------------------------------------
	public function search(){

		$search = array();

		$data['countries'] = $this->common_model->get_countries_list();
		$data['categories'] = $this->common_model->get_categories_list();
		$data['salaries'] = $this->common_model->get_salary_list();


		if($this->input->post('search'))
		{
			// search job title, keyword
			if(!empty($this->input->post('job_title')))
				$search['job_title'] = make_slug($this->input->post('job_title'));

			// search job city
			if(!empty($this->input->post('country')))
				$search['country'] = $this->input->post('country');

			// search job Category
			if(!empty($this->input->post('category')))
				$search['category'] = $this->input->post('category');

			if(!empty($this->input->post('expected_salary')))
				$search['expected_salary'] = $this->input->post('expected_salary');

			if(!empty($this->input->post('education_level')))
				$search['education_level'] = $this->input->post('education_level');

			if(!empty($this->input->post('experience')))
				$search['experience'] = $this->input->post('experience');

			$query = $this->uri->assoc_to_uri($search);

			redirect(base_url('bussiness/cv/search/'.$query),'refresh');

		}
		$search_array = $this->uri->uri_to_assoc(4);
		$search_query = $this->uri->assoc_to_uri($search_array);

		// pagination
		$pg_arr = pagination_assoc('p', 4); // helper function

		$count = $this->cv_model->count_user_profiles($search_array);

		$offset = $pg_arr['offset'];

		$url= base_url("bussiness/cv/search/".$pg_arr['uri']);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = $pg_arr['seg'];	

		$this->pagination->initialize($config);

		$data['search_value'] = $search_array;
		$data['profiles'] = $this->cv_model->get_user_profiles($search_array, $this->per_page_record, $offset);

		$data['title'] = 'CV Search Result';
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'bussiness/cv_search/cv_search_page';
		$this->load->view('layout', $data);
	}
	public function search_candidate(){
		$this->rbac->check_emp_authentiction();

		$search = array();

		$data['countries'] = $this->common_model->get_countries_list();
		$data['categories'] = $this->common_model->get_categories_list();
		$data['salaries'] = $this->common_model->get_salary_list();
		$data['companies'] =  $this->common_model->get_companies_having_active_jobs(100);
		$data['jobs'] = $this->common_model->get_jobs(100,0);

		if($this->input->post('search'))
		{
			// search job title, keyword
			if(!empty($this->input->post('job_title')))
				$search['job_title'] = make_slug($this->input->post('job_title'));

			// search job city
			if(!empty($this->input->post('country')))
				$search['country'] = $this->input->post('country');

			// search job Category
			if(!empty($this->input->post('category')))
				$search['category'] = $this->input->post('category');

			if(!empty($this->input->post('expected_salary')))
				$search['expected_salary'] = $this->input->post('expected_salary');

			if(!empty($this->input->post('education_level')))
				$search['education_level'] = $this->input->post('education_level');

			if(!empty($this->input->post('experience')))
				$search['experience'] = $this->input->post('experience');

			$query = $this->uri->assoc_to_uri($search);

			redirect(base_url('employers/cv/search/'.$query),'refresh');

		}
		$search_array = $this->uri->uri_to_assoc(4);
		$search_query = $this->uri->assoc_to_uri($search_array);

		// pagination
		$pg_arr = pagination_assoc('p', 4); // helper function

		$count = $this->cv_model->count_user_profiles($search_array);

		$offset = $pg_arr['offset'];

		$url= base_url("employers/cv/search/".$pg_arr['uri']);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = $pg_arr['seg'];	

		$this->pagination->initialize($config);

		$data['search_value'] = $search_array;
		$data['profiles'] = $this->cv_model->get_user_profiles($search_array, $this->per_page_record, $offset);

		$data['title'] = 'CV Search Result';
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'bussiness/cv_search/cv_search_page_candidate';
		$this->load->view('layout', $data);
	}
	//--------------------------------------------------------
	// Shortlist Resume
	public function make_shortlist($user_id)
	{
		$emp_id = $this->session->userdata('employer_id');

		$result = $this->cv_model->do_shortlist($emp_id, $user_id); 
		//test
		$user_email=$this->db->query("SELECT * FROM xx_users WHERE id='".$user_id."' ")->result_array();
        foreach ($user_email as $row) {
            $user_email=$row['email'];
        }

		$job_id = $this->uri->segment(5);
		
		$job = get_job_detail($job_id);

		// sending shortlisted email 
		$mail_data = array(
		   'job_title' => $job['title']
		);
		$this->mailer->mail_template_for_shortlist($user_email,'candidate-shortlisted',$mail_data);

		//test end

		if($result){
			redirect(base_url('bussiness/cv/shortlisted'), 'refresh');
		}
	}

	//-----------------------------------------------------------------------------------------
	// Shortlisted Applicant
	public function shortlisted(){

		$data['applicants'] = $this->cv_model->get_shortlisted_applicants(); 

		$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer

		$data['title'] = trans('shortlisted_resume');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'bussiness/applicants/shortlisted_applicants_page';
		$this->load->view('layout',$data);
	}

}

?> 