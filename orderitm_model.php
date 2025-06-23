<?php
class orderitm_model extends CI_Model{
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	

	public function get_items_by_order_id($order_id) {
		$this->db->where('order_itme_id', $order_id);
		$query = $this->db->get('order_items'); // Change 'order_items' to your actual table name
	
	
		if (!$query) {
			// Log or print the last query and error message
			log_message('error', 'Database error: ' . $this->db->error()['message']);
			return false;
		}
	
		return $query->row_array();
	}
	
	public function get_items_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('order_items'); // Change 'order_items' to your actual table name
	
	
		if (!$query) {
			// Log or print the last query and error message
			log_message('error', 'Database error: ' . $this->db->error()['message']);
			return false;
		}
	
		return $query->result_array();
	}

	public function add_item($data) {
        $this->db->insert('order_items', $data);
		return $this->db->insert_id();
		// die($this->db->last_query($this->db->insert('order_items', $data)));

    }

	public function delete_items_by_order_id($order_id) {
        return $this->db->delete('order_items', ['order_id' => $order_id]);
    }

}
 ?>
