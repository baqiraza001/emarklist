<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Main_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('bussiness/package_model', 'package_model');
	}

	public function index()
	{
		// $data['title'] = trans('bussiness');
		// $data['packages'] = $this->package_model->get_all_pakages();
		// $data['meta_description'] = 'your meta description here';
		// $data['keywords'] = 'meta tags here';
		// $data['dont_display_banner'] = true;
		// $data["package_cards"] = $this->load->view('bussiness/packages/packages_list', $data, TRUE);

		// $data['layout'] = 'bussiness/home/index';
		// $this->load->view('layout', $data);
		$data['states'] = $this->common_model->get_states_by_country(160); // get countries for dropdown
		
		$data['testimonials'] = $this->package_model->get_testimonials();

		$data['cities_job'] = $this->package_model->get_cities_with_jobs(); //get those countries who have jobs
		
		$data['jobs'] = $this->package_model->get_jobs(4,0);

		$data['services'] = $this->package_model->get_services(4,0);

		$data['products'] = $this->package_model->get_products(4,0);

		$data['deals'] = $this->package_model->get_deals(4,0);

		$data['companies'] =  $this->package_model->get_companies_having_active_jobs(4);

		$data['posts'] = $this->package_model->get_latest_blog_post();

		$data['title'] = trans('label_home');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'bussiness/home/index.php';
		$this->load->view('layout', $data);
	}

	
}
