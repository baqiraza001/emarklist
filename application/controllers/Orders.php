<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Main_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('orders_model');
		$this->rbac->check_user_authentication();
		$this->per_page_record = 10;
	}
	//-------------------------------------------------------------------------------
	
	public function index()
	{
		$count = $this->orders_model->count_all_orders();
		$offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$url= base_url("orders/index/");
		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 3;		
		$this->pagination->initialize($config);

		$data['orders'] = $this->orders_model->get_orders($this->per_page_record, $offset); 
		$data['user_sidebar'] = 'jobseeker/user_sidebar'; // load sidebar for user

		$data['title'] = trans('orders');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'jobseeker/orders/orders_list';
		$this->load->view('layout', $data);
	}

}// endClass
