<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Main_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('bussiness/orders_model');
		$this->rbac->check_emp_authentiction();
		$this->per_page_record = 10;
	}
	//-------------------------------------------------------------------------------
	
	public function index()
	{
		$count = $this->orders_model->count_all_orders();
		$offset = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$url= base_url("bussiness/orders/index/");
		$config = $this->functions->pagination_config($url,$count,$this->per_page_record);
		$config['uri_segment'] = 4;		
		$this->pagination->initialize($config);

		$data['orders'] = $this->orders_model->get_orders($this->per_page_record, $offset); 
		$data['user_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for user

		$data['title'] = trans('orders');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'bussiness/orders/orders_list';
		$this->load->view('layout', $data);
	}

	function order_details($order_id)
	{
		if(!$order_id || !is_numeric($order_id))
			show_404();

		$data['order_detail'] = $this->orders_model->order_details($order_id); 
		$data['user_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for user

		$data['title'] = trans('orders');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'bussiness/orders/order_detail';
		$this->load->view('layout', $data);

	}

	function update_status()
	{
		$order_id = $this->input->post('order_id');
		$old_status = $this->input->post('old_status');

		$status = $this->orders_model->update_status($order_id, $old_status); 
		echo $status;
	}

}// endClass
