<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model{

	//-------------------------------------------------------
	// Get Applied Jobs
	public function get_orders($limit, $offset)
	{
		$this->db->select('xx_order.id, xx_order.total_products, xx_order.product_quantity, xx_order.total_price, xx_order.total_shiping, xx_order.gross_total, 
			xx_order_business.status, xx_order_business.last_update');
		$this->db->from('xx_order');
    $this->db->join(' xx_order_business', 'xx_order.id= xx_order_business.order_id', 'left');

		$this->db->where('xx_order.user_id', $this->session->userdata('user_id'));
		$this->db->order_by('xx_order.id','desc');

    $this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_all_orders()
	{
    $this->db->join(' xx_order_business', 'xx_order.id= xx_order_business.order_id', 'left');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		return $this->db->count_all('xx_order');
	}

}

?>