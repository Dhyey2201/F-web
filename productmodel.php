<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class productmodel extends CI_Model{
	public function __construct(){
		parent::__construct();
	}


	public function getpro(){
		return $this->db->get('products')->result_array();
	}

	public function get_id($id){
		return $this->db->get_where('products',['pro_id'=>$id])->row_array();

		
	}
	public function get_proid($pro_id){
		return $this->db->get_where('products',['pro_id'=>$pro_id])->result_array();
	}
	public function inpro($prodata){
		return $this->db->insert('products',$prodata);
	}


	public function uppro($id,$prodata1){
		return $this->db->where('pro_id',$id)->update('products',$prodata1);

	}

	public function num_pro(){
		return $this->db->count_all('products');
	}
    public function num_pro1(){
		$this->db->where('co-id');	
		return $this->db->count_all('products')->result_array;
	}

	public function sort_by($sortby){
		$this->db->select('*');
		$this->db->from('products');

		if($sortby=='low_to_high'){
			$this->db->order_by('pro_price','ASC');
		}elseif($sortby=='high_to_low'){
			$this->db->order_by('pro_price','DESC');
		}else{
			$this->db->order_by('pro_id','DESC');
		}

		return $this->db->get()->result_array();
	}


	public function search($data){
		$this->db->like('pro_name',$data);
		$this->db->limit(100);
		return $this->db->get('products')->result_array();
	}

}
?>
