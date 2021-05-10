<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search_Model extends CI_Model{

	public function count_products($search=null)
	{
		if(!empty($search['title'])){
			$this->db->or_like('title', $search['title']);
		}

		if(!empty($search['category']))
			$this->db->where('category',$search['category'] );

		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$this->db->from('xx_product_post');
		return $this->db->count_all_results();
	}

	public function get_all_products($limit = 10, $offset = 1, $search = '')
	{
		$this->db->select('id, title, company_id, product_slug, description, created_date, industry');
		$this->db->from('xx_product_post');
		
		if(!empty($search['title'])){
			$this->db->or_like('title', $search['title']);
		}

		if(!empty($search['category'])){
			$this->db->where('category',$search['category'] );
		}

		$this->db->where('is_status', 'active');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function count_deals($search=null)
	{
		if(!empty($search['title'])){
			$this->db->like('title', $search['title']);
		}

		if(!empty($search['category']))
			$this->db->where('category',$search['category'] );

		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$this->db->from('xx_deal_post');
		return $this->db->count_all_results();
	}

	public function get_all_deals($limit = 10, $offset = 1, $search = '')
	{
		$this->db->select('id, title, company_id, deal_slug, description, created_date, industry');
		$this->db->from('xx_deal_post');
		
		if(!empty($search['title'])){
			$this->db->like('title', $search['title']);
		}

		if(!empty($search['category']))
			$this->db->where('category',$search['category'] );

		$this->db->where('is_status', 'active');
		$this->db->where('curdate() <  expiry_date');
		$this->db->order_by('created_date','desc');
		$this->db->group_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}


	public function count_companies($search=null)
	{
		if(!empty($search['company_name'])){
			$this->db->like('company_name', $search['company_name']);
		}

		$this->db->where('is_active', 1);
		$this->db->order_by('id','desc');
		$this->db->group_by('id');
		$this->db->from('xx_companies');
		return $this->db->count_all_results();
	}

	public function get_all_companies($limit = 10, $offset = 1, $search = '')
	{
		$this->db->select('id, company_name, company_slug, address');
		$this->db->from('xx_companies');
		
		if(!empty($search['company_name'])){
			$this->db->like('company_name', $search['company_name']);
		}

		$this->db->where('is_active', 1);
		$this->db->order_by('id','desc');
		$this->db->group_by('id');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}


}

?>