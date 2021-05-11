<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model{

	// Get Employers Transactions
	public function get_all_payments()
	{
		$this->db->select('xx_payments.*, 
			xx_packages_bought.is_active,
			xx_packages_bought.id as package_bought_id'
		);

		$this->db->from('xx_payments');

		$this->db->join('xx_packages_bought','xx_payments.id = xx_packages_bought.payment_id','left');

		return  $this->db->get()->result_array();

	}
	
	public function activate_package($bought_id='')
	{
		$this->db->set('is_active', 1);
		$this->db->where('id', $bought_id);
		$this->db->update('xx_packages_bought');
	}

}

?>