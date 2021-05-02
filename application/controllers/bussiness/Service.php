<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_emp_authentiction();	// checking user login session (rbac is a library function)
		$this->load->library('upload');
		$this->load->model('bussiness/job_model', 'job_model');
		$this->load->model('bussiness/package_model', 'package_model');
	}

	//------------------------------------------------------------------------
	public function expire()
	{
		$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer

		$data['title'] = trans('limit_expire');
		$data['layout'] = 'bussiness/jobs/limit_expire';
		$this->load->view('layout', $data);
	}

	//---------------------------------------------------------------------------------------
	public function post()
	{
		$pkg = $this->package_model->get_active_package();
		$pkg_id = $pkg['package_id'];

		if(empty($pkg['package_id'])){
			$this->session->set_flashdata('expire',trans('best_pricing_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// free job post 
		$total_free_jobs = $this->job_model->count_posted_jobs($pkg_id, 0, $pkg['payment_id']);
		if($total_free_jobs >= $pkg['no_of_posts']){
			$this->session->set_flashdata('expire',trans('job_limit_expired_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// featured job post
		$total_featured_jobs = $this->job_model->count_posted_jobs($pkg_id, 1, $pkg['payment_id']);
		if($total_featured_jobs >= $pkg['no_of_posts']){
			$this->session->set_flashdata('expire',trans('feature_job_expired_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		$emp_id = $this->session->userdata('employer_id');

		if ($this->input->post('post_job')) {
			$this->form_validation->set_rules('job_title','job title','trim|required|min_length[3]');
			$this->form_validation->set_rules('service_type','Service type','trim|required');
			$this->form_validation->set_rules('description','description','trim|required|min_length[3]');
			$this->form_validation->set_rules('gender','gender','trim|required');
			$this->form_validation->set_rules('location','location','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('post_job_error',$data['errors']);
				redirect(base_url('bussiness/service/post'),'refresh');

			}else{
				if ($this->input->post('category')!='') {
					$data = array(
						'employer_id' => $emp_id,
						'posting_type' => '2',
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'title' => $this->input->post('job_title'),
					'job_type' => $this->input->post('service_type'),
					'category' => $this->input->post('category'),
					'industry' => $this->input->post('industry'),
					'experience' => $this->input->post('min_experience').'-'.$this->input->post('max_experience'),
					'duration' => $this->input->post('duration'),
					'cost' => $this->input->post('cost'),
					'currency_type' => $this->input->post('currency_type'),
					'salary_period' => $this->input->post('salary_period'),
					'description' => $this->input->post('description'),
					'skills' => $this->input->post('skills'),
					'total_positions' => $this->input->post('total_positions'),
					'gender' => $this->input->post('gender'),
					'education' => $this->input->post('education'),
					'employment_type' => $this->input->post('employment_type'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('location'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);
				}
				else{

					$slug = make_slug($this->input->post('add_category'));
					$category_data = array(
						'type_id'=>$this->input->post('service_type'),
						'name' => ucfirst($this->input->post('add_category')),
						'slug' => $slug
					);
					$category_data = $this->security->xss_clean($category_data);
					//$add_category_by_user = $this->db->insert('xx_service_category', $data);
					$add_category_by_user=$this->safe_insert('xx_service_category', $category_data, FALSE);
					$data = array(
						'employer_id' => $emp_id,
						'posting_type' => '2',
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'title' => $this->input->post('job_title'),
					'job_type' => $this->input->post('service_type'),
					'category' => $add_category_by_user,
					'industry' => $this->input->post('industry'),
					'experience' => $this->input->post('min_experience').'-'.$this->input->post('max_experience'),
					'duration' => $this->input->post('duration'),
					'cost' => $this->input->post('cost'),
					'currency_type' => $this->input->post('currency_type'),
					'salary_period' => $this->input->post('salary_period'),
					'description' => $this->input->post('description'),
					'skills' => $this->input->post('skills'),
					'total_positions' => $this->input->post('total_positions'),
					'gender' => $this->input->post('gender'),
					'education' => $this->input->post('education'),
					'employment_type' => $this->input->post('employment_type'),
					'country' => $this->input->post('country'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'location' => $this->input->post('location'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);
				}
				$data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'));

				$data = $this->security->xss_clean($data);

				$job_id = $this->job_model->add_job($data);

				$featured_data = array(
					'employer_id' => $emp_id,
					'job_id' => $job_id,
					'package_id' => $pkg['package_id'],
					'payment_id' => $pkg['payment_id'],
					'is_featured' => ($pkg['price'] == 0)? 0 : 1
				);

				$result = $this->job_model->add_featured_job($featured_data);

				
				// $config['upload_path']          = './uploads/service_images';
    //             $config['allowed_types']        = 'gif|jpg|png';
    //             $config['max_size']             = 100;
    //             $config['max_width']            = 1024;
    //             $config['max_height']           = 768;



				$dataInfo = array();

				$files = $_FILES;

				$cpt = count($_FILES['userfile']['name']);
				$path='./uploads/service_images';
				for($i=0; $i<$cpt; $i++)
				{           
					$_FILES['userfile']['name']= $files['userfile']['name'][$i];
					$_FILES['userfile']['type']= $files['userfile']['type'][$i];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
					$_FILES['userfile']['error']= $files['userfile']['error'][$i];
					$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

					$this->upload->initialize($this->set_upload_options($path));
					$this->upload->do_upload();
					$dataInfo[] = $this->upload->data();

					$add_data = array(
						'name' => $dataInfo[$i]['file_name'],
						'job/service_id' => $job_id,
						'created_time' => date('Y-m-d H:i:s')
					);

					$this->safe_insert('xx_service_media', $add_data, FALSE);

				}

				if ($result){
					$this->session->set_flashdata('post_job_success',trans('job_posted_success'));
					redirect(base_url('bussiness/job/listing'));
				}
				else{
					echo "failed";
				}
			}
		}
		else{
			$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer

			$data['title'] = trans('post_new_job');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'bussiness/services/post_services_page';
			$this->load->view('layout', $data);
		}
	}

	//---------------------------------------------------------------------------------------
	public function edit($service_id = 0)
	{
		$pkg = $this->package_model->get_active_package();
		$pkg_id = $pkg['package_id'];

		if(empty($pkg['package_id'])){
			$this->session->set_flashdata('expire',trans('best_pricing_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// free job post 
		$total_free_jobs = $this->job_model->count_posted_jobs($pkg_id, 0, $pkg['payment_id']);
		if($total_free_jobs >= $pkg['no_of_posts']){
			$this->session->set_flashdata('expire',trans('job_limit_expired_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// featured job post
		$total_featured_jobs = $this->job_model->count_posted_jobs($pkg_id, 1, $pkg['payment_id']);
		if($total_featured_jobs >= $pkg['no_of_posts']){
			$this->session->set_flashdata('expire',trans('feature_job_expired_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		$emp_id = $this->session->userdata('employer_id');

		$this->form_validation->set_rules('job_title','job title','trim|required|min_length[3]');
		$this->form_validation->set_rules('service_type','Service type','trim|required');
		$this->form_validation->set_rules('description','description','trim|required|min_length[3]');
		$this->form_validation->set_rules('gender','gender','trim|required');
		$this->form_validation->set_rules('location','location','trim|required');

		$service_record = $this->job_model->get_service($service_id,$emp_id);
		if(!$this->form_validation->run())
		{
			$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer
			$data['service_record'] =  $service_record;
			$data['title'] = trans('edit_service');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';
			$data['bussiness_id'] =  get_company_id_by_employer($emp_id);
			$data['layout'] = 'bussiness/services/edit_services_page';

			$this->load->view('layout', $data);
		}
		else {

			$service_category = '';
			if($this->input->post('category') == '')
			{
				$slug = make_slug($this->input->post('add_category'));

				$category_data = array(
					'type_id'=>$this->input->post('service_type'),
					'name' => ucfirst($this->input->post('add_category')),
					'slug' => $slug
				);
				$category_data = $this->security->xss_clean($category_data);
				$service_category = $this->common_model->safe_insert('xx_service_category', $category_data, FALSE);
			}
			else 
				$service_category = $this->input->post('category');

			$data = array(
				'employer_id' => $emp_id,
				'posting_type' => '2',
				'company_id' => get_company_id_by_employer($emp_id), // helper function
				'title' => $this->input->post('job_title'),
				'job_type' => $this->input->post('service_type'),
				'category' => $service_category,
				'duration' => $this->input->post('duration'),
				'cost' => $this->input->post('cost'),
				'currency_type' => $this->input->post('currency_type'),
				'description' => $this->input->post('description'),
				'location' => $this->input->post('location'),
				'gender' => $this->input->post('gender'),
				'updated_date' => date('Y-m-d : h:m:s')
			);
			$data['job_slug'] = $this->make_job_slug($this->input->post('job_title'), $this->input->post('city'));

			$data = $this->security->xss_clean($data);

			$job_id = $this->job_model->edit_job($data, $service_id, $emp_id);

			$dataInfo = array();

			$path='./uploads/service_images';

			/* delete old images */
			if($_FILES['userfile']['name'][0] !== '')
			{
				$old_media = $this->job_model->get_serivce_media($service_id);
				foreach ($old_media as $file) {
					if(file_exists($path.'/'.$file->name))
						unlink($path.'/'.$file->name);
				}
				$this->job_model->delete_media($service_id);
			}
			/* delete old images */

			$this->load->library('upload');
	    $files = $_FILES;
	    $cpt = count($_FILES['userfile']['name']);
	    if($_FILES['userfile']['name'][0] !== '')
	    {
		    for($i=0; $i<$cpt; $i++)
		    {           
		        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
		        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
		        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
		        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
		        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

		        $this->upload->initialize($this->set_upload_options($path));
		        $this->upload->do_upload();
		        $dataInfo[] = $this->upload->data();

		        $add_data = array(
			        'name' => $dataInfo[$i]['file_name'],
							'job/service_id' => $job_id,
			        'created_time' => date('Y-m-d H:i:s')
			     );

					$this->common_model->safe_insert('xx_service_media', $add_data, FALSE);
		    }
		  }

			$this->session->set_flashdata('update_success',trans('service_update_success'));
			redirect(base_url('bussiness/job/listing'));
		}
	}


	public function post_product()
	{
		$pkg = $this->package_model->get_active_package();
		$pkg_id = $pkg['package_id'];

		if(empty($pkg['package_id'])){
			$this->session->set_flashdata('expire',trans('best_pricing_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// free job post 
		$total_free_jobs = $this->job_model->count_posted_jobs($pkg_id, 0, $pkg['payment_id']);
		if($total_free_jobs >= $pkg['no_of_posts']){
			$this->session->set_flashdata('expire',trans('job_limit_expired_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// featured job post
		$total_featured_jobs = $this->job_model->count_posted_jobs($pkg_id, 1, $pkg['payment_id']);
		if($total_featured_jobs >= $pkg['no_of_posts']){
			$this->session->set_flashdata('expire',trans('feature_job_expired_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		$emp_id = $this->session->userdata('employer_id');
		$data['categories'] = $this->common_model->get_categories_list(); 
		$data['industries'] = $this->common_model->get_industries_list();
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['cities'] = $this->common_model->get_cities_list(); 
		$data['salaries'] = $this->common_model->get_salary_list();  
		$data['educations'] = $this->common_model->get_education_list();

		if ($this->input->post('post_job')) {
			$this->form_validation->set_rules('product_title','job title','trim|required|min_length[3]');
			$this->form_validation->set_rules('product_type','Service type','trim|required');
			$this->form_validation->set_rules('price','Price','trim|required');
			$this->form_validation->set_rules('product_description','description','trim|required|min_length[3]');
			// $this->form_validation->set_rules('shipping_fee','Shipping fee','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('post_job_error',$data['errors']);
				redirect(base_url('bussiness/service/post_product'),'refresh');

			}
			else{
				if ($this->input->post('product_category')!="") {
					$data = array(
						'employer_id' => $emp_id,
						'brand_name' => $this->input->post('brand_name'),
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'title' => $this->input->post('product_title'),
					'product_type' => $this->input->post('product_type'),
					'quantity' => $this->input->post('quantity'),
					'category' => $this->input->post('product_category'),
					'price' => $this->input->post('price'),
					'description' => $this->input->post('product_description'),
					// 'shipping_fee' => $this->input->post('shipping_fee'),
					'expiry_date' => $this->input->post('expiry_date'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);
				}
				else{
					$slug = make_slug($this->input->post('add_category'));
					$category_data = array(
						'type_id'=>$this->input->post('product_type'),
						'name' => ucfirst($this->input->post('add_category')),
						'slug' => $slug
					);
					$category_data = $this->security->xss_clean($category_data);
					//$add_category_by_user = $this->db->insert('xx_service_category', $data);
					$add_category_by_user=$this->safe_insert('xx_service_category', $category_data, FALSE);

					$data = array(
						'employer_id' => $emp_id,
						'brand_name' => $this->input->post('brand_name'),
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'title' => $this->input->post('product_title'),
					'product_type' => $this->input->post('product_type'),
					'quantity' => $this->input->post('quantity'),
					'category' => $add_category_by_user,
					'price' => $this->input->post('price'),
					'description' => $this->input->post('product_description'),
					// 'shipping_fee' => $this->input->post('shipping_fee'),
					'expiry_date' => $this->input->post('expiry_date'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);
				}
				$data['product_slug'] = $this->make_job_slug($this->input->post('product_title'), $this->input->post('city'));

				$data = $this->security->xss_clean($data);

				$job_id = $this->job_model->add_product($data);

				$dataInfo = array();

				$files = $_FILES;
				$path='./uploads/product_images';
				$cpt = count($_FILES['userfile']['name']);
				for($i=0; $i<$cpt; $i++)
				{           
					$_FILES['userfile']['name']= $files['userfile']['name'][$i];
					$_FILES['userfile']['type']= $files['userfile']['type'][$i];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
					$_FILES['userfile']['error']= $files['userfile']['error'][$i];
					$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

					$this->upload->initialize($this->set_upload_options($path));
					$this->upload->do_upload();
					$dataInfo[] = $this->upload->data();

					$add_data = array(
						'name' => $dataInfo[$i]['file_name'],
						'product_id' => $job_id,
						'created_time' => date('Y-m-d H:i:s')
					);

					$this->safe_insert('xx_product_media', $add_data, FALSE);

				}

				if ($job_id){
					$this->session->set_flashdata('post_job_success','Your product is post successfully!');
					redirect(base_url('bussiness/products'));
				}
				else{
					echo "failed";
				}
			}
		}
		else{
			$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer

			$data['title'] = trans('post_new_job');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'bussiness/services/post_product_page';
			$this->load->view('layout', $data);
		}
	}
	public function post_deal()
	{
		$pkg = $this->package_model->get_active_package();
		$pkg_id = $pkg['package_id'];

		if(empty($pkg['package_id'])){
			$this->session->set_flashdata('expire',trans('best_pricing_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// free job post 
		$total_free_jobs = $this->job_model->count_posted_jobs($pkg_id, 0, $pkg['payment_id']);
		if($total_free_jobs >= $pkg['no_of_posts']){
			$this->session->set_flashdata('expire',trans('job_limit_expired_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// featured job post
		$total_featured_jobs = $this->job_model->count_posted_jobs($pkg_id, 1, $pkg['payment_id']);
		if($total_featured_jobs >= $pkg['no_of_posts']){
			$this->session->set_flashdata('expire',trans('feature_job_expired_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		$emp_id = $this->session->userdata('employer_id');
		$data['categories'] = $this->common_model->get_categories_list(); 
		$data['industries'] = $this->common_model->get_industries_list();
		$data['countries'] = $this->common_model->get_countries_list(); 
		$data['cities'] = $this->common_model->get_cities_list(); 
		$data['salaries'] = $this->common_model->get_salary_list();  
		$data['educations'] = $this->common_model->get_education_list();

		if ($this->input->post('post_job')) {
			$this->form_validation->set_rules('deal_title','job title','trim|required|min_length[3]');
			$this->form_validation->set_rules('deal_type','Service type','trim|required');
			//$this->form_validation->set_rules('deal_category','category','trim|required');
			//$this->form_validation->set_rules('industry','industry','trim|required');
			$this->form_validation->set_rules('price','Price','trim|required');
			// $this->form_validation->set_rules('max_experience','max experience','trim|required');
			// $this->form_validation->set_rules('min_salary','min salary','trim|required');
			// $this->form_validation->set_rules('max_salary','max salary','trim|required');
			// $this->form_validation->set_rules('salary_period','salary period','trim|required');
			// $this->form_validation->set_rules('skills','skills','trim|required');
			$this->form_validation->set_rules('deal_description','description','trim|required|min_length[3]');
			//$this->form_validation->set_rules('total_positions','total positions','trim|required');
			//$this->form_validation->set_rules('gender','gender','trim|required');
			//$this->form_validation->set_rules('employment_type','employment type','trim|required');
			//$this->form_validation->set_rules('education','education','trim|required');
			//$this->form_validation->set_rules('country','country','trim|required');
			//$this->form_validation->set_rules('state','state','trim|required');
			//$this->form_validation->set_rules('city','city','trim|required');
			//$this->form_validation->set_rules('location','location','trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data = array(
					'errors' => validation_errors(),
				);

				$this->session->set_flashdata('post_job_error',$data['errors']);
				redirect(base_url('bussiness/service/post_deal'),'refresh');

			}else{
				if ($this->input->post('deal_category')!="") {
					$data = array(
						'employer_id' => $emp_id,
					//'brand_name' => $this->input->post('brand_name'),
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'title' => $this->input->post('deal_title'),
					'deal_type' => $this->input->post('deal_type'),
					'category' => $this->input->post('deal_category'),
					'price' => $this->input->post('price'),
					'description' => $this->input->post('deal_description'),
					'expiry_date' => date('y:m:d', strtotime("+30 days")),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);
				}
				else{
					$slug = make_slug($this->input->post('add_category'));
					$category_data = array(
						'type_id'=>$this->input->post('deal_type'),
						'name' => ucfirst($this->input->post('add_category')),
						'slug' => $slug
					);
					$category_data = $this->security->xss_clean($category_data);
				//$add_category_by_user = $this->db->insert('xx_service_category', $data);
					$add_category_by_user=$this->safe_insert('xx_service_category', $category_data, FALSE);

					$data = array(
					'employer_id' => $emp_id,
					'company_id' => get_company_id_by_employer($emp_id), // helper function
					'title' => $this->input->post('deal_title'),
					'deal_type' => $this->input->post('deal_type'),
					'category' => $add_category_by_user,
					'price' => $this->input->post('price'),
					'description' => $this->input->post('deal_description'),
					'expiry_date' => $this->input->post('expiry_date'),
					'created_date' => date('Y-m-d : h:m:s'),
					'updated_date' => date('Y-m-d : h:m:s')
				);
				}
				$data['deal_slug'] = $this->make_job_slug($this->input->post('deal_title'), $this->input->post('city'));

				$data = $this->security->xss_clean($data);

				$job_id = $this->job_model->add_deal($data);

				// $featured_data = array(
				// 	'employer_id' => $emp_id,
				// 	'job_id' => $job_id,
				// 	'package_id' => $pkg['package_id'],
				// 	'payment_id' => $pkg['payment_id'],
				// 	'is_featured' => ($pkg['price'] == 0)? 0 : 1
				// );

				// $result = $this->job_model->add_featured_job($featured_data);

				
				// $config['upload_path']          = './uploads/service_images';
    //             $config['allowed_types']        = 'gif|jpg|png';
    //             $config['max_size']             = 100;
    //             $config['max_width']            = 1024;
    //             $config['max_height']           = 768;



				$dataInfo = array();

				$files = $_FILES;
				$path='./uploads/deal_images';
				$cpt = count($_FILES['userfile']['name']);
				for($i=0; $i<$cpt; $i++)
				{           
					$_FILES['userfile']['name']= $files['userfile']['name'][$i];
					$_FILES['userfile']['type']= $files['userfile']['type'][$i];
					$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
					$_FILES['userfile']['error']= $files['userfile']['error'][$i];
					$_FILES['userfile']['size']= $files['userfile']['size'][$i];    

					$this->upload->initialize($this->set_upload_options($path));
					$this->upload->do_upload();
					$dataInfo[] = $this->upload->data();

					$add_data = array(
						'name' => $dataInfo[$i]['file_name'],
						'deal_id' => $job_id,
						'created_time' => date('Y-m-d H:i:s')
					);

					$this->safe_insert('xx_deal_media', $add_data, FALSE);

				}

				if ($job_id){
					$this->session->set_flashdata('post_job_success',trans('job_posted_success'));
					redirect(base_url('bussiness/deals'));
				}
				else{
					echo "failed";
				}
			}
		}
		else{
			$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer

			$data['title'] = trans('post_new_job');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';

			$data['layout'] = 'bussiness/services/post_deal_page';
			$this->load->view('layout', $data);
		}
	}
	private function set_upload_options($path)
	{   
    //upload an image options
		$config = array();
		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2024;
		$config['max_width']            = 1080;
		$config['max_height']           = 1080;


		return $config;
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

	public function listing()
	{
		$emp_id = $this->session->userdata('employer_id');

		$data['job_info'] = $this->job_model->get_all_jobs($emp_id);

		$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer

		$data['title'] = trans('job_listing');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'bussiness/services/services_listing_page';
		$this->load->view('layout', $data);
	}

	//-----------------------------------------------------------------------------------------
	public function delete($id=0)
	{
		$emp_id = $this->session->userdata('employer_id');
		
		$this->db->where('id',$id);
		$this->db->where('employer_id',$emp_id);
		$this->db->delete('xx_job_post');
		$this->session->set_flashdata('deleted',trans('job_deleted_success'));
		redirect(base_url('bussiness/job/listing'));

	}

	//-----------------------------------------------------------------------------------------
	// make job slugon
	private function make_job_slug($job_title, $city){
		$final_job_url ='';
		$job_title = trim($job_title);
		$city = get_city_name($city);
		$job_title_slug = make_slug($job_title). '-job-in-'.make_slug($city) ;  // make slug is a helper function
		$final_job_url = $job_title_slug;
		return $final_job_url;
	}



}// endclass
