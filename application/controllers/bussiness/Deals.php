<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deals extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->rbac->check_emp_authentiction();	// checking user login session (rbac is a library function)
		$this->load->model('bussiness/deals_model');
		$this->load->model('bussiness/package_model');
		$this->load->model('bussiness/job_model');
		$this->load->model('common_model');
		$this->per_page_record = 10;


	}

	public function index()
	{
		$count = $this->deals_model->count_all_deals();
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("bussiness/deals/index/");
		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['deals'] = $this->deals_model->get_deals($this->per_page_record, $offset); 
		$data['user_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for user

		$data['title'] = trans('deals');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'bussiness/deals/deals_list';
		$this->load->view('layout', $data);	
	}

	//-----------------------------------------------------------------------------------------
	public function edit($deal_id = 0)
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
		
		$this->form_validation->set_rules('deal_title','job title','trim|required|min_length[3]');
		$this->form_validation->set_rules('deal_type','Service type','trim|required');
		$this->form_validation->set_rules('price','Price','trim|required');
		$this->form_validation->set_rules('duration','Duration','trim|required');
		$this->form_validation->set_rules('shift_start','Shift start','trim|required');
		$this->form_validation->set_rules('shift_end','Shift end','trim|required');
		$this->form_validation->set_rules('deal_description','description','trim|required|min_length[3]');

		$deal_record = $this->deals_model->get_record($deal_id);
		if(!$this->form_validation->run())
    {
     	$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer
			$data['deal_record'] =  $deal_record;
			$data['title'] = trans('edit_deal');
			$data['meta_description'] = 'your meta description here';
			$data['keywords'] = 'meta tags here';
			$data['bussiness_id'] =  get_company_id_by_employer($emp_id);
			$data['layout'] = 'bussiness/deals/edit_deal';

			$this->load->view('layout', $data);

		}
		else
		{
			$deal_category = '';
			if($this->input->post('deal_category') == '')
			{
				$slug = make_slug($this->input->post('add_category'));
				
				$category_data = array(
				'type_id'=>$this->input->post('deal_type'),
				'name' => ucfirst($this->input->post('add_category')),
				'slug' => $slug
					);
				$category_data = $this->security->xss_clean($category_data);
				$deal_category = $this->common_model->safe_insert('xx_service_category', $category_data, FALSE);
			}
			else 
				$deal_category = $this->input->post('deal_category');

			$data = array(
				'employer_id' => $emp_id,
				'company_id' => get_company_id_by_employer($emp_id), // helper function
				'title' => $this->input->post('deal_title'),
				'deal_type' => $this->input->post('deal_type'),
				'category' => $deal_category,
				'duration' => $this->input->post('duration'),
				'shift_start' => $this->input->post('shift_start'),
				'shift_end' => $this->input->post('shift_end'),
				'price' => $this->input->post('price'),
				'description' => $this->input->post('deal_description'),
				'expiry_date' => date('Y-m-d', strtotime($this->input->post('expiry_date'))),
				'updated_date' => date('Y-m-d : h:m:s')
			);
			$data['deal_slug'] = $this->make_job_slug($this->input->post('deal_title'), $this->input->post('city'));

			$data = $this->security->xss_clean($data);

			$this->deals_model->edit($data, $deal_id);

    $dataInfo = array();
    
	    $path='./uploads/deal_images';

	    /* delete old images */
	    if($_FILES['userfile']['name'][0] !== '')
	    {
		    $old_media = $this->deals_model->get_deal_media($deal_id);
		    foreach ($old_media as $file) {
		    	if(file_exists($path.'/'.$file->name))
		    	unlink($path.'/'.$file->name);
		    }
		    $this->deals_model->delete_media($deal_id);
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
			        'deal_id' => $deal_id,
			        'created_time' => date('Y-m-d H:i:s')
			     );

					$this->common_model->safe_insert('xx_deal_media', $add_data, FALSE);
		    }
		  }
    	
    		$this->session->set_flashdata('post_deal_success',trans('deal_edited_success'));
        redirect('bussiness/deals');
    }

	}

	//-----------------------------------------------------------------------------------------
	public function delete($deal_id = 0)
	{
		$path = './uploads/deal_images/';
		$old_media = $this->deals_model->get_deal_media($deal_id);
    foreach ($old_media as $file) {
    	if(file_exists($path.$file->name))
    	unlink($path.$file->name);
    }
    $this->deals_model->delete_media($deal_id);

		$emp_id = $this->session->userdata('employer_id');
		$company_id = get_company_id_by_employer($emp_id);
		$this->db->where('id',$deal_id);
		$this->db->where('company_id',$company_id);
		$this->db->delete('xx_deal_post');
		$this->session->set_flashdata('deleted',trans('deal_deleted_success'));
		redirect('bussiness/deals');

	}

		// make job slugon
	private function make_job_slug($job_title, $city){
		$final_job_url ='';
		$job_title = trim($job_title);
		$city = get_city_name($city);
		$job_title_slug = make_slug($job_title). '-job-in-'.make_slug($city) ;  // make slug is a helper function
		$final_job_url = $job_title_slug;
		return $final_job_url;
	}

	private function set_upload_options($path)
	{   
    //upload an image options
    $config = array();
		$config['upload_path']          = $path;
    $config['allowed_types']        = 'gif|jpg|png';
    $config['max_size']             = 3024;
    // $config['max_width']            = 1080;
    // $config['max_height']           = 1080;


    return $config;
	}
}// endclass
