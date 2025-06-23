<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once APPPATH . "third_party/stripe-php/init.php";  // Load Stripe SDK


defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Insert new payment record
    public function insert_payment($data) {
        return $this->db->insert('payments', $data);
    }

    // Get payment by Order ID
    public function get_payment_by_order_id($order_id) {
        return $this->db->get_where('payments', ['order_id' => $order_id])->row_array();
    }

    // Update payment status
    public function update_payment_status($order_id, $status) {
        $this->db->where('order_id', $order_id);
        return $this->db->update('payments', ['status' => $status]);
    }

	
}
?>
