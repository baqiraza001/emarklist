<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->per_page_record = 14;
		$this->load->model('Service_Model'); // load job model
	}

	//--------------------------------------------------------------
	// Main Index Function
	public function index()
	{
		$count = $this->Service_Model->count_all_jobs();
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$url= base_url("jobs/");

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 2;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->Service_Model->get_all_jobs($this->per_page_record, $offset, null); // Get all jobs
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['categories'] = $this->common_model->get_categories_list(); 

		$data['title'] = trans('label_jobs');

		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
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
				redirect(base_url('Services/search'));
				return;
			}

			// search by bussiness name
			if(!empty($this->input->post('bussiness_name'))){
				$company_slug=make_slug($this->input->post('bussiness_name'));
				$company_id=get_company_id($company_slug);
				if (!empty($company_id)) {
				$search['company_id']=$company_id;
				}
			}
			// if(!empty($this->input->post('bussiness_name'))){
			// 	$company_id=get_company_id(make_slug($this->input->post('bussiness_name')));
			// 	if (!empty($company_id)) {
			// 		$search['company_id']=$company_id;
			// 	}
			// }
				
				//echo get_company_id($this->input->post('bussiness_name'));
				//$search['title'] = make_slug($this->input->post('job_title'));
			// search by services
			if(!empty($this->input->post('Services')))
				$search['title'] = make_slug($this->input->post('Services'));

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


			$search['posting_type'] = '2';

			$query = $this->uri->assoc_to_uri($search);

			redirect(base_url('Services/search/'.$query),'refresh');

		}
		$search_array = $this->uri->uri_to_assoc(3);
		$search_query = $this->uri->assoc_to_uri($search_array);

		$pg_arr = pagination_assoc('p', 3); // helper function

		$count = $this->Service_Model->count_all_search_result($search_array);

		$offset = $pg_arr['offset'];

		$url= base_url("Services/search/".$pg_arr['uri']);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = $pg_arr['seg'];	

		$this->pagination->initialize($config);

		$data['search_value'] = $search_array;
		$data['company_name']= $this->input->post('bussiness_name');
		$data['jobs'] = $this->Service_Model->get_all_jobs($this->per_page_record, $offset, $search_array);
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['categories'] = $this->common_model->get_categories_list(); 

		$data['title'] = trans('search_results');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'services_list_page';
		$this->load->view('layout', $data);
	}
	
	//--------------------------------------------------------------
	// Jobs by category
	public function jobs_by_category()
	{
		$data['categories'] = $this->Service_Model->get_categories_with_jobs();

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
		$search['category'] = get_category_id($title); // get category id by title

		// pagination
		$count = $this->Service_Model->count_all_search_result($search);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/category/".$title);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->Service_Model->get_all_jobs($this->per_page_record, $offset, $search);

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
		$data['industries'] = $this->Service_Model->get_industries_with_jobs();

		$data['title'] = trans('label_jobs_by_industry');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/jobs_industry_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// search job by industry
	public function industry($title)
	{
		$search['industry'] = get_industry_id($title); // get industry id by title

		// pagination
		$count = $this->Service_Model->count_all_search_result($search);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/industry/".$title);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->Service_Model->get_all_jobs($this->per_page_record, $offset, $search);

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
		$data['cities'] = $this->Service_Model->get_cities_with_jobs();

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
		$count = $this->Service_Model->count_all_search_result($search);
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("jobs/location/".$title);

		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['jobs'] = $this->Service_Model->get_all_jobs($this->per_page_record, $offset, $search);

		$data['categories'] = $this->common_model->get_categories_list();
		$data['countries'] = $this->common_model->get_countries_list(); 

		$data['title'] = trans('label_jobs_by_loc');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';
		
		$data['layout'] = 'jobseeker/jobs/job_list_page';
		$this->load->view('layout', $data);
	}

	//--------------------------------------------------------------
	// complete job detail page
	public function job_detail()
	{	
		$job_id = $this->uri->segment(2);
		$user_id = $this->session->userdata('user_id');
		
		// checking for already applied application
		$data['already_applied'] = $this->Service_Model->check_applied_application($user_id, $job_id);	

		$data['user_detail'] = $this->Service_Model->get_user_by_id($user_id);
		$data['job_detail'] = $this->Service_Model->get_job_by_id($job_id);

		$data['job_actual_link'] = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // redirect to same job detail page after login 

		$data['cities_job'] = $this->Service_Model->get_cities_with_jobs(); //right sidebar

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

	//-------------------------------------------------------------------------------------------
	// when applicant will apply for the job
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

			//insert job applicant to the "xx_applied_job" table
			$result = $this->Service_Model->insert_job_application($user_id, $emp_id, $job_id, $cover_letter); 

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
	public function add_deal()
	{
		$deals_id=$this->input->post('deals_id');
		$date=date('Y-m-d : h:m:s');
		$data=array(
			'deal_id' =>$deals_id,
			'date'	=> $date 
		);
		$this->common_model->safe_insert('xx_book_deal',$data,false);
		$company_id=$this->common_model->company_id_by_deals($deals_id);
		$company_slug=$this->common_model->company_slug_by_deals($company_id['company_id']);
		$this->session->set_flashdata('add_deal', "Your Deal is reserved.");
		redirect('Company/detail1/'.$company_slug['company_slug'], ''); 

	}
	public function add_appointment()
	{
		$this->load->model('bussiness/staff_model');

		$service_id=$this->input->post('service_id');
		$staff=$this->input->post('staff');
		$appointment=$this->input->post('appointment_time');
		$data=array(
			'user_id'=>$this->session->userdata('user_id'),
			'staff_id' =>$staff,
			'slot'	=> $appointment,
		);
		//$check=$this->db->query("SELECT * FROM xx_book_service WHERE staff_id='".$staff."' AND slot='".$slot."' ")->result_array();
		$where_arr = array('staff_id' => $staff, 'slot' => $appointment);
		$slot_record = $this->staff_model->staff_booked_slots($where_arr);
		$this->load->model('company_model');

		if (!empty($slot_record)) {
			$this->session->set_flashdata('already_busy', "Sorry this staff member is already reserved at this slot.");
			$slug=$this->db->select('job_slug')->from('xx_job_post')->where('id',$service_id)->get()->row_array();
			redirect('jobs/'.$service_id.'/'.$slug['job_slug'] ,'');
			
		}
		else{
		$this->common_model->safe_insert('xx_book_service',$data,false);
		$company = $this->Service_Model->get_job_by_id($service_id)[0];
		$company_slug = $this->company_model->get_company_detail($company['company_id'][0]);
		$this->session->set_flashdata('add_service', "Your service is reserved.");
		redirect('Company/detail1/'.$company_slug['company_slug'], ''); 	
		}

// 
	}

}// endClass
