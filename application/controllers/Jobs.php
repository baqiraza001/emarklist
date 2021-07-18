<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
		$this->per_page_record = 10;
		$this->load->model('job_model'); // load job model
		$this->load->model('bussiness/staff_model', 'staff_model'); // load job model
	}

	//--------------------------------------------------------------
	// Main Index Function
	public function index()
	{
		$count = $this->job_model->count_all_jobs();
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$url= base_url("jobs/");

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 2;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset); // Get all jobs
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['categories'] = $this->common_model->get_categories_list(); 

		$data['title'] = trans('label_jobs');

		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	public function daily_deals()
	{
		$count = $this->job_model->count_all_deals();
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$url= base_url("jobs/daily_deals");

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 2;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_daily_deals(); // Get all jobs
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['categories'] = $this->common_model->get_categories_list(); 

		$data['title'] = trans('label_jobs');

		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/daily_deals_list.php';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	public function search_home()
	{
		$search = array();
		if($this->input->post('search'))
		{
			$this->form_validation->set_rules('job_title', 'Job Title', 'trim');
			$this->form_validation->set_rules('posting_type', 'posting type', 'trim');
			$this->form_validation->set_rules('bussiness_name', 'bussiness name', 'trim');
			// $this->form_validation->set_rules('experience', 'Location', 'trim');
			// $this->form_validation->set_rules('job_type', 'Location', 'trim');
			// $this->form_validation->set_rules('employment_type', 'Location', 'trim');

			if ($this->form_validation->run() === FALSE) {
				redirect(base_url('jobs/search_home'));
				return;
			}
			if(!empty($this->input->post('bussiness_name'))){
				$company_slug=make_slug($this->input->post('bussiness_name'));
				$company_id=get_company_id($company_slug);
				if (!empty($company_id)) {
					$search['company_id']=$company_id;
				}
			}
			// search job title
			if(!empty($this->input->post('job_title')))
				$search['title'] = make_slug($this->input->post('job_title'));

			// search job post type
			if(!empty($this->input->post('posting_type')))
				$search['posting_type'] = $this->input->post('posting_type');
			
			$query = $this->uri->assoc_to_uri($search);
			redirect(base_url('Jobs/search_home/'.$query),'refresh');
		}
		
		$search_array = $this->uri->uri_to_assoc(3);
		$search_query = $this->uri->assoc_to_uri($search_array);


		$pg_arr = pagination_assoc('p', 3); // helper function

		$count = $this->job_model->count_all_search_result($search_array);

		$offset = $pg_arr['offset'];

		$url= base_url("jobs/search_home/".$pg_arr['uri']);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = $pg_arr['seg'];	

		$this->pagination->initialize($config);

		$data['search_value'] = $search_array;
		$data['jobs'] = $this->job_model->get_all_jobs_for_home($this->per_page_record, $offset, $search_array);
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['categories'] = $this->common_model->get_categories_list(); 

		$data['title'] = trans('search_results');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);

	}
	// Advance Search functionality 
	public function search()
	{
		$search = array();
		if($this->input->post('search'))
		{
			$this->form_validation->set_rules('job_title', 'Job Title', 'trim');
			$this->form_validation->set_rules('country', 'Location', 'trim');
			$this->form_validation->set_rules('category', 'Location', 'trim');
			$this->form_validation->set_rules('experience', 'Location', 'trim');
			$this->form_validation->set_rules('job_type', 'Location', 'trim');
			$this->form_validation->set_rules('employment_type', 'Location', 'trim');

			if ($this->form_validation->run() === FALSE) {
				redirect(base_url('jobs/search'));
				return;
			}

			// search job title
			if(!empty($this->input->post('job_title')))
				$search['title'] = make_slug($this->input->post('job_title'));

			// search job country
			if(!empty($this->input->post('country')))
				$search['country'] = $this->input->post('country');

			// search catagory
			if(!empty($this->input->post('category')))
				$search['category'] = $this->input->post('category');

			// search experience
			if(!empty($this->input->post('experience')))
				$search['experience'] = $this->input->post('experience');

			// search job type
			if(!empty($this->input->post('job_type')))
				$search['job_type'] = $this->input->post('job_type');

			// search employment type
			if(!empty($this->input->post('employment_type')))
				$search['employment_type'] = $this->input->post('employment_type');


			$search['posting_type'] = '1';

			$query = $this->uri->assoc_to_uri($search);

			redirect(base_url('jobs/search/'.$query),'refresh');

		}
		$search_array = $this->uri->uri_to_assoc(3);
		$search_query = $this->uri->assoc_to_uri($search_array);


		$pg_arr = pagination_assoc('p', 3); // helper function

		$count = $this->job_model->count_all_search_result($search_array);

		$offset = $pg_arr['offset'];

		$url= base_url("jobs/search/".$pg_arr['uri']);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = $pg_arr['seg'];	

		$this->pagination->initialize($config);

		$data['search_value'] = $search_array;
		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search_array);
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['categories'] = $this->common_model->get_categories_list(); 

		$data['title'] = trans('search_results');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}
	
	//--------------------------------------------------------------
	// Jobs by category
	public function jobs_by_category()
	{
		$data['categories'] = $this->job_model->get_categories_with_jobs();

		$data['title'] = trans('label_jobs_by_cat');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/jobs_category_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// search job by category
	public function category($title)
	{
		//$search['category'] = get_category_id($title); // get category id by title
		$search['category']=get_category_id($title);
		// pagination
		$count = $this->job_model->count_all_search_result($search);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/category/".$title);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_jobs_by_categories($this->per_page_record, $offset, $search);

		$data['categories'] = $this->common_model->get_categories_list();
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('category');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}
	public function All_category()
	{
		//$search['category'] = get_category_id($title); // get category id by title
		//$search['category']=$title;
		// pagination
		$count = $this->job_model->count_all_search_result_cat();
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/category/");

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_jobs_bussiness($this->per_page_record, $offset);

		$data['categories'] = $this->common_model->get_categories_list();
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('category');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// Jobs by Industry
	public function jobs_by_industry()
	{
		$data['industries'] = $this->job_model->get_industries_with_jobs();

		$data['title'] = trans('label_jobs_by_industry');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/jobs_industry_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// search job by industry
	public function industry($title = '')
	{
		$search['industry'] = get_industry_id($title); // get industry id by title

		// pagination
		$count = $this->job_model->count_all_search_result($search);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/industry/".$title);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search);

		$data['categories'] = $this->common_model->get_categories_list();
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('label_jobs_by_industry');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// Jobs by loccation
	public function jobs_by_location()
	{
		$data['cities'] = $this->job_model->get_cities_with_jobs();

		$data['title'] = trans('label_jobs_by_loc');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/jobs_location_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// search job by city
	public function location($title)
	{
		$search['city'] = get_city_id($title); // get city id by title
		// pagination
		$count = $this->job_model->count_all_search_result($search);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/location/".$title);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->job_model->get_all_jobs($this->per_page_record, $offset, $search);

		$data['categories'] = $this->common_model->get_categories_list();
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('label_jobs_by_loc');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// complete company detail page
	public function company_detail()
	{	
		$job_id = $this->uri->segment(2);
		$user_id = $this->session->userdata('user_id');
		
		// checking for already applied application
		$data['already_applied'] = $this->job_model->check_applied_application($user_id, $job_id);	

		$data['user_detail'] = $this->job_model->get_user_by_id($user_id);
		$data['job_detail'] = $this->job_model->get_job_by_id($job_id);

		$data['job_actual_link'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // redirect to same job detail page after login 

		$data['cities_job'] = $this->job_model->get_cities_with_jobs(); //right sidebar

		// social media sharing 	
		$data['show_og_tags'] = true;
		$data['og_title'] = $data['job_detail']['title'];
		$description_text = trim(html_escape(strip_tags($data['job_detail']['description'])));
		$data['og_description'] = text_limit($description_text, 200);
		$data['og_type'] = "Job";
		$data['og_url'] = base_url('jobs/'.$data['job_detail']['id'].'/'.$data['job_detail']['job_slug']);
		$data['og_image'] = $this->general_settings['logo'];	

		$data['title'] = $data['job_detail']['title'];
		$data['meta_description'] = text_limit($description_text, 150);
		$data['keywords'] = $data['job_detail']['title'];
		$data['layout'] = 'jobseeker/jobs/job_detail_page';
		$this->load->view('layout', $data);
	}
	// complete job detail page
	public function job_detail()
	{	
		$job_id = $this->uri->segment(2);
		$user_id = $this->session->userdata('user_id');
		
		// checking for already applied application
		$data['already_applied'] = $this->job_model->check_applied_application($user_id, $job_id);	

		$data['user_detail'] = $this->job_model->get_user_by_id($user_id);
		$data['job_detail'] = $this->job_model->get_job_by_id($job_id);
		$data['staff_data'] = $this->staff_model->get_business_staff($data['job_detail']['company_id'], $job_id);

		$data['job_actual_link'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // redirect to same job detail page after login 

		$data['cities_job'] = $this->job_model->get_cities_with_jobs(); //right sidebar

		// social media sharing 	
		$data['show_og_tags'] = true;
		$data['og_title'] = $data['job_detail']['title'];
		$description_text = trim(html_escape(strip_tags($data['job_detail']['description'])));
		$data['og_description'] = text_limit($description_text, 200);
		$data['og_type'] = "Job";
		$data['og_url'] = base_url('jobs/'.$data['job_detail']['id'].'/'.$data['job_detail']['job_slug']);
		$data['og_image'] = $this->general_settings['logo'];	

		$data['title'] = $data['job_detail']['title'];
		$data['meta_description'] = text_limit($description_text, 150);
		$data['keywords'] = $data['job_detail']['title'];
		$data['layout'] = 'jobseeker/jobs/job_detail_page';
		$this->load->view('layout', $data);
	}
	public function product_detail()
	{	
		$job_id = $this->uri->segment(3);
		$user_id = $this->session->userdata('user_id');
		
		// // checking for already applied application
		// $data['already_applied'] = $this->job_model->check_applied_application($user_id, $job_id);	

		$data['user_detail'] = $this->job_model->get_user_by_id($user_id);
		$data['job_detail'] = $this->job_model->get_products_by_id($job_id);

		 $data['job_actual_link'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // redirect to same job detail page after login 

		// $data['cities_job'] = $this->job_model->get_cities_with_jobs(); //right sidebar

		// // social media sharing 	
		// $data['show_og_tags'] = true;
  //       $data['og_title'] = $data['job_detail']['title'];
  //       $description_text = trim(html_escape(strip_tags($data['job_detail']['description'])));
  //       $data['og_description'] = text_limit($description_text, 200);
  //       $data['og_type'] = "Job";
  //       $data['og_url'] = base_url('jobs/'.$data['job_detail']['id'].'/'.$data['job_detail']['job_slug']);
  //       $data['og_image'] = $this->general_settings['logo'];	

		// $data['title'] = $data['job_detail']['title'];
		// $data['meta_description'] = text_limit($description_text, 150);
		// $data['keywords'] = $data['job_detail']['title'];
		 $data['layout'] = 'jobseeker/jobs/product_detail_page';
		 $this->load->view('layout', $data);
		}
		public function deals_detail()
		{	
			$job_id = $this->uri->segment(3);
			$user_id = $this->session->userdata('user_id');

		// // checking for already applied application
		// $data['already_applied'] = $this->job_model->check_applied_application($user_id, $job_id);	

		// $data['user_detail'] = $this->job_model->get_user_by_id($user_id);
			$data['job_detail'] = $this->job_model->get_deals_by_id($job_id);
			$slots = $this->job_model->deal_booked_slots(array('deal_id' => $job_id));
			$data['booked_slots'] = array_column($slots, 'slot');

		// $data['job_actual_link'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // redirect to same job detail page after login 

		// $data['cities_job'] = $this->job_model->get_cities_with_jobs(); //right sidebar

		// // social media sharing 	
		// $data['show_og_tags'] = true;
  //       $data['og_title'] = $data['job_detail']['title'];
  //       $description_text = trim(html_escape(strip_tags($data['job_detail']['description'])));
  //       $data['og_description'] = text_limit($description_text, 200);
  //       $data['og_type'] = "Job";
  //       $data['og_url'] = base_url('jobs/'.$data['job_detail']['id'].'/'.$data['job_detail']['job_slug']);
  //       $data['og_image'] = $this->general_settings['logo'];	

		 //$data['title'] = $data['job_detail']['title'];
		 //$data['meta_description'] = text_limit($description_text, 150);
		 //$data['keywords'] = $data['job_detail']['title'];
			$data['layout'] = 'jobseeker/jobs/deals_detail_page';
			$this->load->view('layout', $data);
		}

	//-------------------------------------------------------------------------------------------
	// when applicant will apply for the job
	// public function apply_job()
	// {
	// 	if($this->input->post('submit'))
	// 	{
	// 		$this->form_validation->set_rules('cover_letter', 'cover_letter', 'trim|required');
	// 		$this->form_validation->set_rules('job_id', 'job_id', 'trim|required');
	// 		$this->form_validation->set_rules('username', 'username', 'trim|required');
	// 		$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
	// 		$this->form_validation->set_rules('job_title', 'job_title', 'trim|required');
	// 		$this->form_validation->set_rules('job_actual_link', 'job_actual_link', 'trim|required');

	// 		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
 //                          <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>', '</div>');
	// 		if ($this->form_validation->run() === FALSE) {
	// 			$data = array(
	// 				'errors' => validation_errors()
	// 			);

	// 			$this->session->set_flashdata('validation_errors', $data['errors']);
	// 			redirect($this->input->post('job_actual_link'),'refresh');
	// 		}

	// 		$user_id = $this->session->userdata('user_id');
	// 		$job_id = $this->input->post('job_id');
	// 		$emp_id = $this->input->post('emp_id');
	// 		$username = $this->input->post('username');
	// 		$email = $this->input->post('email');
	// 	    $job_title = $this->input->post('job_title');
	// 	    $cover_letter = $this->input->post('cover_letter');
	// 	    $job_actual_link = $this->input->post('job_actual_link');

	// 		//insert job applicant to the "xx_applied_job" table
	// 		$result = $this->job_model->insert_job_application($user_id, $emp_id, $job_id, $cover_letter); 

	// 		if($result){
	// 		    $emp = get_emp_by_id($emp_id);
	// 		    $job = get_job_detail($job_id);

	// 		    $emp_to = $emp['email'];

	// 		    $user_to = get_user_email($user_id);

	// 		    // send email to employer
	// 		    $mail_data = array(
	// 		    'job_title' => $job['title']
	// 		    );

	// 		    // Job Seeker
	// 		    $this->mailer->mail_template($user_to,'job-applied',$mail_data);

	// 		    //Employer Alert
	// 		    $this->mailer->mail_template($emp_to,'applicant-applied',$mail_data);

	// 			$this->session->set_flashdata('applied_success', trans('job_application_sent_msg'));
	// 			redirect($job_actual_link);
	// 		}
	// 	}
	// }

		public function apply_job()
		{
			if($this->input->post('submit'))
			{
				$this->form_validation->set_rules('cover_letter', 'cover_letter', 'trim|required');
				$this->form_validation->set_rules('job_id', 'job_id', 'trim|required');
				$this->form_validation->set_rules('username', 'username', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|required');
				$this->form_validation->set_rules('job_title', 'job_title', 'trim|required');
				$this->form_validation->set_rules('job_actual_link', 'job_actual_link', 'trim|required');

				$this->form_validation->set_error_delimiters('<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>', '</div>');
				if ($this->form_validation->run() === FALSE) {
					$data = array(
						'errors' => validation_errors()
					);

					$this->session->set_flashdata('validation_errors', $data['errors']);
					redirect($this->input->post('job_actual_link'),'refresh');
				}

				$user_id = $this->session->userdata('user_id');
				$job_id = $this->input->post('job_id');
				$emp_id = $this->input->post('emp_id');
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$job_title = $this->input->post('job_title');
				$cover_letter = $this->input->post('cover_letter');
				$job_actual_link = $this->input->post('job_actual_link');


		    //upload resume while applying
			//$dataInfo = array();

				$files = $_FILES;
				$resume_name="";
				$path = "./uploads/resume";
				if($_FILES['userfile']['name'] != ""){
				         
					$_FILES['userfile']['name']= $files['userfile']['name'];
					$_FILES['userfile']['type']= $files['userfile']['type'];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'];
					$_FILES['userfile']['error']= $files['userfile']['error'];
					$_FILES['userfile']['size']= $files['userfile']['size'];    

					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload();
					$dataInfo[] = $this->upload->data();

					$resume_name = $dataInfo[0]['file_name'];
					$resume_path = $path.$resume_name;

				}

				$result = $this->job_model->insert_job_application($user_id, $emp_id, $job_id, $cover_letter,$resume_name,$resume_path); 
				if($result){
					$emp = get_emp_by_id($emp_id);
					$job = get_job_detail($job_id);

					$emp_to = $emp['email'];

					$user_to = get_user_email($user_id);

			    // send email to employer
					$mail_data = array(
						'job_title' => $job['title']
					);

			    // Job Seeker
					$this->mailer->mail_template($user_to,'job-applied',$mail_data);

			    //Employer Alert
					$this->mailer->mail_template($emp_to,'applicant-applied',$mail_data);

					$this->session->set_flashdata('applied_success', trans('job_application_sent_msg'));
					redirect($job_actual_link);
				}
			}
		}

		private function set_upload_options()
		{   
    //upload an image options
			$config = array();
			$config['upload_path']          = './uploads/resume';
			$config['allowed_types']        = 'pdf|csv|doc|png|jpg|jpeg';
   // $config['max_size']             = 2024;
			return $config;
		}

		public function addtocart(){
			if(!empty($this->session->userdata('user_id'))){
				$user_id = $this->session->userdata('user_id');
				$quantity = $this->input->post('quantity', TRUE); 
				$totalprice = $this->input->post('price_check1', TRUE);
	        //$total = ($quantity * $totalprice);
				$product_id = $this->input->post('job_id');


				$data = array(
					'user_id' => $user_id,
					'product_id' => $product_id,
					'quantity' => $quantity,
					'total_price' => $totalprice,
	        		//'total_price' => $total,
				);  
				$check=$this->db->query("SELECT * FROM xx_product_cart WHERE `product_id` = $product_id AND `user_id`= $user_id")->result_array();
				if(!empty($check)){
					$add_category_by_user=$this->db->query("UPDATE xx_product_cart set `quantity` = `quantity`+$quantity, `total_price`= $totalprice  where `product_id` = $product_id AND `user_id`= $user_id");
				} else{
					$add_category_by_user=$this->common_model->safe_insert('xx_product_cart', $data, FALSE);
				}
	        // update xx_product_cart set `quantity` = `quantity`+10, `total_price`= `total_price`+100 where `product_id` = 6 AND `user_id`= 47;	        

				$this->session->set_flashdata('success', 'Product is add successfully in your cart');
				redirect($this->input->post('job_actual_link'),'refresh');

			} else{

				echo "<script> alert('please login');</script>";

				redirect('Auth/login');
			// $data['layout'] = 'auth/login_page';
			// $this->load->view('layout', $data);

			} 



		}

	// cart details page 
		public function cartDetails()
		{
			$user_id = $this->uri->segment(3); 
			$product_cart=$this->db->query("SELECT * FROM xx_product_cart LEFT JOIN xx_product_post ON xx_product_cart.`product_id` = xx_product_post.`id` JOIN xx_product_media ON xx_product_media.product_id = xx_product_cart.`product_id` WHERE user_id=$user_id GROUP BY xx_product_post.id")->result_array();
			$data['pro_cart'] = $product_cart;
			$data['layout'] = 'addToCart/addToCart';
			$this->load->view('layout', $data);
		}
	// cart details page 
		public function cartDelete()
		{
			$user_id = $this->uri->segment(3);
			$pro_id = $this->uri->segment(4); 


			if(!empty($user_id AND $pro_id)){  
				$product_cart=$this->db->query("DELETE FROM `xx_product_cart` WHERE user_id=$user_id AND `product_id`= $pro_id ");
				$product_cart=$this->db->query("SELECT * FROM xx_product_cart JOIN xx_product_post ON xx_product_cart.`product_id` = xx_product_post.`id` JOIN xx_product_media ON xx_product_media.product_id = xx_product_cart.`product_id` WHERE user_id=$user_id")->result_array();
				$data['pro_cart'] = $product_cart;
				$data['layout'] = 'addToCart/addToCart';
				$this->load->view('layout', $data);
			}  else{
				echo "<script> alert('this product no remove');</script>";
				$product_cart=$this->db->query("SELECT * FROM xx_product_cart JOIN xx_product_post ON xx_product_cart.`product_id` = xx_product_post.`id` JOIN xx_product_media ON xx_product_media.product_id = xx_product_cart.`product_id` WHERE user_id=$user_id")->result_array();
				$data['pro_cart'] = $product_cart;
				$data['layout'] = 'addToCart/addToCart';
				$this->load->view('layout', $data);
			}

		}
		public function goToCheckOut() {  
			$email = $this->input->post('email', TRUE);
			$phone = $this->input->post('phone', TRUE);
			$address = $this->input->post('address', TRUE);
			$state = $this->input->post('state', TRUE);
			$city = $this->input->post('city', TRUE);

			$user_id = $this->input->post('user_id', TRUE); 
			$shiping_fee = $this->input->post('shiping_fee', TRUE);
			$product_id = $this->input->post('product_id', TRUE);
			$pro_price = $this->input->post('pro_price', TRUE);
			$quantity = $this->input->post('quantity', TRUE);
			$company_id = $this->input->post('company_id', TRUE);

			$tproduct_value = $this->input->post('tp_value', TRUE);
			$t_price_value = $this->input->post('t_price_value', TRUE);
			$ship_value = $this->input->post('ship_value', TRUE); 
			$cart_total_value = $this->input->post('cart_total_value', TRUE); 

			$comp_id_arr = array_unique($company_id);
			$comp_count = count($comp_id_arr); 

			$count_userid = count($user_id);
			$count_ship = count($shiping_fee);
			$count_price = count($pro_price);
			$count_qty = count($quantity);  

			$orderData = array(
				'user_id' => $user_id[0], 
				'total_products' => $count_qty,
				'product_quantity' => $tproduct_value,
				'total_price' => $t_price_value,
				'total_shiping' => $ship_value,
				'gross_total' => $cart_total_value,
				'created_by' => $user_id[0],
			); 
    	// this array insert data in xx_order table
			$this->common_model->safe_insert('xx_order', $orderData, FALSE);
    	// get last inserted id in xx_order table.
			$xx_order_id = $this->db->insert_id();

			$orderBusinessArr  = array();
			for($i=0; $i<$count_userid; $i++) {
				array_push($orderBusinessArr, array(
					'user_id' => $user_id[$i], 
					'order_id' => $xx_order_id,
					'business_id' => $company_id[$i],
					'total_products' => $quantity[$i],
					'product_quantity' => $quantity[$i],
					'total_price' => $pro_price[$i],
					'total_shiping' => $shiping_fee[$i],
					'gross_total' => "",
					'created_by' => $user_id[0])
			); 
			}

			$arr = array();  
			foreach ($orderBusinessArr as $key => $item) {
				$arr[$item['business_id']][$key] = $item; 
			} 
			foreach ($arr as $key => $item) {
				$t_product = 0;
				$t_price = 0;
				$t_shiping = 0;
				$p_quantity = 0;
				foreach ($item as $key => $value) { 
					$u_id = $value['user_id'];
					$o_id = $value['order_id'];
					$o_b_id = $value['business_id'];
					$t_product += $value['total_products'];
					$p_quantity += $value['product_quantity']; 
					$t_price += ($value['total_price']*$value['total_products']);
					$t_shiping += $value['total_shiping'];
					$g_total = ($t_price+$t_shiping);
					$c_by = $value['created_by'];
				}
				$orderBusiness = array(
					'user_id' => $u_id, 
					'order_id' => $o_id , 
					'business_id' => $o_b_id, 
					'total_products' => $t_product,  
					'product_quantity' => $p_quantity,
					'total_price' => $t_price, 
					'total_shiping' => $t_shiping  , 
					'gross_total' => $g_total , 
					'created_by' => $c_by , 
				);
			// echo"<pre>";
		 //    print_r($orderBusiness);
		 //    echo"</pre>";  
	    	// this array insert data into xx_order_business table in database 
				$this->common_model->safe_insert('xx_order_business', $orderBusiness, FALSE);
			}   
			if(!empty($count_userid > 0) && !empty($count_ship > 0) && !empty($count_price > 0) && !empty($count_qty > 0)) {  
				for($i=0; $i<$count_userid; $i++)  
				{  

					$insert_id=$this->db->query("SELECT `id` FROM `xx_order_business` WHERE `business_id`= $company_id[$i] AND `order_id`= $xx_order_id" )->result_array();
					foreach ($insert_id as $value) {
						$order_business_id = $value['id'];
					} 

					$orderProducts = array(
						'order_business_id' => $order_business_id,
						'user_id' => $user_id[$i], 
						'order_id' => $xx_order_id,
						'business_id' => $company_id[$i],
						'product_id' => $product_id[$i],
						'product_price' => $pro_price[$i], 
						'shiping_fee' => $shiping_fee[$i],
						'product_quantity' =>$quantity[$i],
						'total_price' => ($quantity[$i]*$pro_price[$i]),
						'created_by' =>$user_id[$i],

					);

	        	// this query insert data in xx_order_products table into database.
					$this->common_model->safe_insert('xx_order_products', $orderProducts, FALSE);
					$deleteCartDetail=$this->db->query("DELETE FROM `xx_product_cart` WHERE `product_id`=$product_id[$i] AND `user_id`=$user_id[$i] ");
				}  
	        // this array store user order address detail 
				$u_id = $this->session->userdata('user_id');
				$userOrderAddress = array( 
					'user_id' => $u_id, 
					'order_id' => $xx_order_id,
					'user_email' => $email,
					'user_cell_number' => $phone,
					'state_id' => $state,
					'city_id' => $city,
					'user_order_address' => $address,  
					'created_by' => $u_id,
				); 
		    // this query insert data in database table xx_user_order_address
				$this->common_model->safe_insert('xx_user_order_address', $userOrderAddress, FALSE);

		    // $place_xx_Order=$this->db->query("SELECT * FROM `xx_order` WHERE `user_id`= $u_id AND `order_id`= $xx_order_id" )->result_array();
				$data['place_xx_order']=$this->db->query("SELECT * FROM `xx_order` WHERE `user_id`= $u_id AND `id`= $xx_order_id" )->result_array();

				$data['place_xx_order_products']=$this->db->query("SELECT * FROM `xx_order_products` WHERE `user_id`= $u_id AND `order_id`= $xx_order_id" )->result_array();

				$data['place_xx_user_order_address']=$this->db->query("SELECT * FROM `xx_user_order_address` WHERE `user_id`= $u_id AND `order_id`= $xx_order_id" )->result_array();
				$data['alert'] = '<strong>Success!</strong> Thank you very much! Your order has been placed successfully!';

				$data['layout'] = 'addToCart/addToCartDetailPage';
				$this->load->view('layout', $data);
			}    
		} 

		public function cityname(){
			$stateid = $this->input->get('stateid');
			$cityName = get_state_cities($stateid); 
			foreach ($cityName as $value) {
				echo '
				<select class="form-select" aria-label="Default select example" id="cityname"> 
				<option value="">Select City...</option>
				<option value="'.$value["id"].'">'.$value["name"].'</option>
				</select>';
			}

		}

		function book_deal()
		{
			$this->load->model('bussiness/staff_model');

			$deal_id=$this->input->post('deal_id');
			$slot=$this->input->post('deal_time');
			$data=array(
				'user_id'=>$this->session->userdata('user_id'),
				'deal_id' =>$deal_id,
				'slot'	=> $slot,
				'date' => date('Y-m-d H:i:s')
			);
			$where_arr = array('deal_id' => $deal_id, 'slot' => $slot);
			$slot_record = $this->job_model->deal_booked_slots($where_arr);
			$this->load->model('company_model');

			if (!empty($slot_record)) {
				$this->session->set_flashdata('already_busy', "Sorry this deal slot is already booked. Try another.");
				$slug=$this->db->select('deal_slug')->from('xx_deal_post')->where('id',$deal_id)->get()->row_array();
				redirect('jobs/deals_detail/'.$deal_id.'/'.$slug['deal_slug'] ,'');

			}
			else{
		// $this->common_model->safe_insert('xx_book_deal',$data,false);
				$company = $this->job_model->get_deals_by_id($deal_id)[0];
				$company_slug = $this->company_model->get_company_detail($company['company_id']);
				$this->session->set_flashdata('add_deal', "Your deal is booked now.");
				redirect('Company/detail1/'.$company_slug['company_slug'], ''); 	
			}
		}


}// endClass
