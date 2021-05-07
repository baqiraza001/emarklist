<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Staff extends Main_Controller {



	public function __construct()

	{

		parent::__construct();


		$this->load->model('bussiness/staff_model', 'staff_model');
		$this->load->model('bussiness/job_model', 'job_model');
		$this->load->model('bussiness/package_model', 'package_model');

	}

	public function add_staff()
	{
		$this->rbac->check_emp_authentiction();	// checking user login session (rbac is a library function)

		$pkg = $this->package_model->get_active_package();
		$pkg_id = $pkg['package_id'];

		if(empty($pkg['package_id'])){
			$this->session->set_flashdata('expire',trans('best_pricing_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// featured job post
		$total_featured_jobs = $this->job_model->count_posted_staff($pkg_id, 1, $pkg['payment_id']);
		if($total_featured_jobs >= $pkg['no_of_staff']){
			$this->session->set_flashdata('expire',trans('feature_job_expired_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}
		
		$emp_id = $this->session->userdata('employer_id');


		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('designation','Designation','required');
		$this->form_validation->set_rules('shift_start','Shift start','required');
		$this->form_validation->set_rules('shift_end','Shift end','required');
		$this->form_validation->set_rules('working_days[]','Working days','required');
		$this->form_validation->set_rules('service_id','Service','required');
		if(!$this->form_validation->run())
		{
			$data = array(
				'errors' => validation_errors(),
			);

			$this->session->set_flashdata('post_job_error',$data['errors']);

     	$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer
     	$data['title'] = trans('post_new_job');
     	$data['meta_description'] = 'your meta description here';
     	$data['keywords'] = 'meta tags here';
     	$data['bussiness_id'] =  get_company_id_by_employer($emp_id);
     	$data['layout'] = 'bussiness/staff/add_staff';

     	$this->load->view('layout', $data);

     }else{

     	$working_days = implode(',', $this->input->post('working_days'));

     	$data = array(
     		'designation' => $this->input->post('designation'),
     		'name' => $this->input->post('name'),
     		'gender' => $this->input->post('gender'),
     		'shift_start' => $this->input->post('shift_start'),
     		'shift_end' => $this->input->post('shift_end'),
     		'service_id'=>$this->input->post('service_id'),
     		'working_days' => $working_days
     	);

     	$staff_id = $this->staff_model->add_staff($data);
     	$featured_data = array(
					'employer_id' => $emp_id,
					'staff_id' => $staff_id,
					'package_id' => $pkg['package_id'],
					'payment_id' => $pkg['payment_id'],
					'is_featured' => 1
				);

				$result = $this->job_model->add_featured_job($featured_data);

     	if ($staff_id){
     		$this->session->set_flashdata('post_job_success',trans('job_posted_success'));
     		redirect(base_url('bussiness/job/listing'));
     	}
     	else{
     		echo "failed";
     	}
     }
   }


   function slot_booked_list()
   {
		$this->rbac->check_user_authentication();	// checking user login session (rbac is a library function)
		$staff_id = $this->input->post('staff_id');
		$where_arr = array('staff_id' => $staff_id);
		$data = $this->staff_model->staff_booked_slots($where_arr);
		echo json_encode(array('slots' => array_column($data, 'slot'), 'days_booked' => array_column($data, 'days_booked')));
	}

	public function appointment_list()
	{

		$pkg = $this->package_model->get_active_package();
		$pkg_id = $pkg['package_id'];

		if(empty($pkg['package_id'])){
			$this->session->set_flashdata('expire',trans('best_pricing_msg'));
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		// free job post 
		if($pkg['no_of_staff'] == 0){
			$this->session->set_flashdata('expire','This feature is not available for FREE plan.');
			redirect(base_url('bussiness/service/expire'));
			exit();
		}

		$emp_id = $this->session->userdata('employer_id');

		$data['appointments'] = $this->staff_model->get_appointments($emp_id);

		$data['emp_sidebar'] = 'bussiness/emp_sidebar'; // load sidebar for employer

		$data['title'] = trans('job_listing');
		$data['meta_description'] = 'your meta description here';
		$data['keywords'] = 'meta tags here';

		$data['layout'] = 'bussiness/staff/appointment_list';
		$this->load->view('layout', $data);
	}

	public function delete_appointment($appointment_id = 0)
	{
		$this->session->set_flashdata('update_success','Appointment deleted successfully');
		$this->staff_model->delete_appointment($appointment_id);
		redirect('bussiness/staff/appointment_list');
	}

}
