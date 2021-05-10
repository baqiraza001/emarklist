<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('search_model');
		$this->load->model('job_model');
		$this->per_page_record = 1;
	}

	//-------------------------------------------------------------------------------
	public function index()
	{	
		
		$data['title'] = 'Search Bussiness, Services, Products or Daily Deals';
		$data['meta_description'] = 'Search Bussiness, Services, Products or Daily Deals';
		$data['keywords'] = 'Search Bussiness, Services, Products, Daily Deals';
		
		$data['layout'] = 'search_page';
		$this->load->view('layout', $data);

	}

	public function results()
	{
		$search = array();

		if($this->input->post('search'))
		{
			$this->form_validation->set_rules('search_q', 'Search query', 'trim');

			if ($this->form_validation->run() === FALSE) {
				redirect(base_url('search/index'));
				return;
			}
			$search_option = $this->input->post('search_option');

			if(!empty($this->input->post('search_q')))
				$search['title'] = make_slug($this->input->post('search_q'));

			if(!empty($search_option))
				$search['search_option'] = $search_option;

			// search catagory
			if(!empty($this->input->post('category')))
				$search['category'] = $this->input->post('category');

			$query = $this->uri->assoc_to_uri($search);

			redirect(base_url('search/results/'.$query),'refresh');

		}

		/*redirect to search results page code starts below*/

		$search_for = '';
		$model_name = '';
		$count_method_name = '';
		$get_method_name = '';
		$result_data_key =  '';
		$search_params =  array();

		$search_array = $this->uri->uri_to_assoc(3);
		if(empty($search_array['search_option']))
			$search_for = 1;
		else
			$search_for = $search_array['search_option'];
		
		$pg_arr = pagination_assoc('p', 3); // helper function
		
		
		if($search_for == 1) /* search for bussiness*/
		{
			$search_params['company_name'] = !empty($search_array['title']) ? $search_array['title'] : '';
			$model_name = 'search_model';
			$count_method_name = 'count_companies';
			$get_method_name = 'get_all_companies';
			$result_data_key =  'companies';

		}
		else if($search_for == 2) /* search for services*/
		{
			$search_params['title'] = !empty($search_array['title']) ? $search_array['title'] : '';
			$search_params['category'] = !empty($search_array['category']) ? $search_array['category'] : '';
			$search_params['posting_type'] = 2;
			$model_name = 'job_model';
			$count_method_name = 'count_all_search_result';
			$get_method_name = 'get_all_jobs';
			$result_data_key =  'services';

		}
		else if($search_for == 3) /* search for products*/
		{
			$search_params['title'] = !empty($search_array['title']) ? str_replace('-', ' ', $search_array['title']) : '';
			$search_params['category'] = !empty($search_array['category']) ? $search_array['category'] : '';
			$model_name = 'search_model';
			$count_method_name = 'count_products';
			$get_method_name = 'get_all_products';
			$result_data_key =  'products';

		}
		else if($search_for == 4) /* search for deals*/
		{
			$search_params['title'] = !empty($search_array['title']) ? str_replace('-', ' ', $search_array['title']) : '';
			$search_params['category'] = !empty($search_array['category']) ? $search_array['category'] : '';
			$model_name = 'search_model';
			$count_method_name = 'count_deals';
			$get_method_name = 'get_all_deals';
			$result_data_key =  'deals';

		}
		else /* search for deafult*/ 
		{
			$search_params['company_name'] = !empty($search_array['title']) ? $search_array['title'] : '';
			$model_name = 'search_model';
			$count_method_name = 'count_companies';
			$get_method_name = 'get_all_companies';
			$result_data_key =  'companies';
		}

		$url= base_url("search/results/".$pg_arr['uri']);
		$count = $this->$model_name->$count_method_name($search_params);
		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = $pg_arr['seg'];	
		$this->pagination->initialize($config);

		$data['search_value'] = $search_array;
		$offset = $pg_arr['offset'];
		$data[$result_data_key] = $this->$model_name->$get_method_name($this->per_page_record, $offset, $search_params);

		$data['title'] = trans('search_results');
		$data['meta_description'] = 'Search Results';
		$data['keywords'] = 'search, results';
		$data['categories'] = $this->common_model->get_categories_list(); 
		
		$data['layout'] = 'search_page';
		$this->load->view('layout', $data);
	}

}// endClass
