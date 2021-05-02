<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Staff extends Main_Controller {



	public function __construct()

	{

		parent::__construct();


		$this->load->model('bussiness/staff_model', 'staff_model');

	}

	public function add_staff()
	{
		$this->rbac->check_emp_authentiction();	// checking user login session (rbac is a library function)

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




}
