<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model{

	//-------------------------------------------------------
	// Get Applied Jobs
	public function get_orders($limit, $offset)
	{
		$this->db->select('xx_order_business.*');
		$this->db->from('xx_order_business');
		$this->db->where('business_id', $this->session->userdata('employer_id'));
		$this->db->order_by('id','desc');

    $this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_all_orders()
	{
		$this->db->where('business_id', $this->session->userdata('employer_id'));
		return $this->db->count_all('xx_order_business');
	}

	public function order_details($order_id = 0)
	{
		$this->db->select('xx_order_products.*, xx_product_post.*, xx_user_order_address.*');
		$this->db->from('xx_order_products');
		$this->db->join('xx_product_post', 'xx_order_products.product_id= xx_product_post.id', 'left');
		$this->db->join('xx_user_order_address', 'xx_order_products.order_id= xx_user_order_address.order_id', 'left');
		$this->db->where('xx_order_products.order_id', $order_id);
		$this->db->where('xx_order_products.business_id', $this->session->userdata('employer_id'));
		// $this->db->group_by('xx_order_products.order_id');
		$this->db->order_by('xx_order_products.id','desc');

		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_status($order_id = 0, $old_status = '')
	{
		$new_status = '';
		if($old_status == 'Processing')
			$new_status = 'Completed';
		else
			$new_status = 'Processing';

		$this->db->set('status', $new_status);
		$this->db->where('order_id', $order_id);
		
		$this->db->where('business_id', $this->session->userdata('employer_id'));
		$this->db->update('xx_order_business');
		
		return $new_status;
	}

}

?>