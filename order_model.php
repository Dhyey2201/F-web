<?php 
// defined('BASEPATH') OR exit('No direct script access allowed');

class order_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();

	}

	public function create_order($data){

		// die($this->db->last_query($this->db->insert('orders',$data)));
	 return  $this->db->insert('orders',$data);
	
	}
	public function get_order_details($id) {
        $this->db->where('o_id', $id);
        return $this->db->get('orders')->row_array();
    }

	public function get_orders_by_user($user_id) {
        $this->db->where('id', $user_id);
        return $this->db->get('orders')->result_array();

    }

	public function get(){
		return $this->db->get('orders')->result_array();
	}

	public function updateor($order_id, $status) {
		$this->db->where('o_id', $order_id);
		return $this->db->update('orders', ['status' => $status]);
	}

	public function update_order($id,$data){
		$this->db->where('o_id',$id);
		return $this->db->update('orders',$data);
	}

	public function get_orders_with_delivery_time() {
		$this->db->select('*');
		$this->db->from('orders');
		$query = $this->db->get();
		return $query->result();
	}

	public function num_or(){
		return $this->db->count_all('orders');
	}
	public function update_address($email, $address) {
        $this->db->where('email', $email);
        return $this->db->last_query($this->db->update('orders', ['	shipping_address' => $address])); // Change 'users' to your actual table name
    }



	
}
?>
