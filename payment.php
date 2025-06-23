<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Payment extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Payment_model');
		$this->load->model('order_model');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
	}

	public function get_pay()
	{
		$get = $this->order_model->get();
		echo json_encode($get);
	}



	public function index()
	{
		$this->load->view('payment_view');
	}

	public function create_order()
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Authorization");


		// $key = 'rzp_test_8kPyaqujWnmF4k';
		// $secret = 'hahfe15UEYncD39DSlmikzx6';
		$key = 'rzp_test_rWifXA4lUO2oXa';
		$secret = 'YvFaX3ksO6yVQO4rbsV92p6I';
		$come = $this->session->userdata('store');
		$o_id1 = $this->session->userdata('o_id1');




		// if (empty($come)) {
		// 	echo json_encode(['status' => 'error', 'message' => 'No order data found in session']);
		// 	return;
		// }

		$email = $this->input->post('email');
		$total_price = strval(json_decode($this->input->post('amount')));

		$shipping_address = $this->input->post('shipping_address');




		$o_id = $this->db->get_where('orders', ['o_id' => $o_id1])->row_array();



		if (!$o_id1) {
			echo json_encode(['status' => 'error', 'message' => 'Failed to create local order']);
		}


		$body = [
			"amount" => $total_price * 100,
			"currency" => 'INR',
			"receipt" => $o_id['o_id'],
			"payment_capture" => 1
		];






		$order = curl_init('https://api.razorpay.com/v1/orders');
		curl_setopt($order, CURLOPT_POST, true);
		curl_setopt($order, CURLOPT_POSTFIELDS, json_encode($body));
		curl_setopt($order, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($order, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		curl_setopt($order, CURLOPT_USERPWD, $key . ':' . $secret);

		$response = curl_exec($order);





		if (curl_errno($order)) {
			echo 'Curl error: ' . curl_error($order);
		}

		curl_close($order);

		$order_data = json_decode($response, true);





		// echo json_encode($order_data);
		if (isset($order_data['id'])) { // Check if the order exists

			$update_data = [
				'order_id' => $order_data['id'],
				'total_price' => json_decode($come['total_price']),
				'order_itme_id' => $come['order_itme_id'],
				'id' => $come['id'],
				'delivery_time' => date('Y-m-d H:i:s', strtotime('+6 days')),
				'status'   => 'Order_Confirmed',
				'shipping_address' => $shipping_address,
				'email'    => $email
			];

			$this->db->where('o_id', $o_id['o_id'])->update('orders', $update_data);

			$data = [
				'order_id' => $order_data['id'],
				'o_id' => $o_id['o_id'],
				'amount'   => $total_price,
				'currency' => $order_data['currency'],
				'status'   => 'Order_Confirmed'
			];

			$ooo = $this->Payment_model->insert_payment($data);

			if ($ooo) {
				echo json_encode($order_data);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to insert order']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to create order']);
		}
		// redirect('payment/show_pay');
	}

	// public function show_pay(){
	// 	$order=$this->session->userdata('or');
	// 	// die(json_encode($order));


	// 	if(isset($order['id'])) { // Check if the order exists
	// 		// die(json_encode($order['id']));
	// 		// Update the record in the 'orders' table
	// 		$this->db->where('o_id', $order['receipt'])->update('orders', ['order_id' => $order['id']]);
	// 		// Fetch the updated order
	// 		$o_id = $this->db->get_where('orders', ['o_id' => $order['receipt']])->row_array();


	// 		// die(json_encode($o_id));

	// 		$data = [
	//             'order_id' => $order['id'],
	// 			'o_id' => $o_id['o_id'],
	//             'amount'   => $order['amount'] / 100, 
	//             'currency' => $order['currency'],
	//             'status'   => 'pending'
	//         ];
	// 		// die($data['order_id']);

	// 		$ooo=$this->Payment_model->insert_payment($data);


	//         if ($ooo) {
	//             echo json_encode(['status' => 'success', 'message' => 'Order created successfully','data'=>$order]);
	//         } else {
	//             echo json_encode(['status' => 'error', 'message' => 'Failed to insert order']);
	//         }

	//     } else {
	//         echo json_encode(['status' => 'error', 'message' => 'Failed to create order']);
	//     }

	// }


	public function pay()
	{
		$key = 'rzp_test_rWifXA4lUO2oXa';
		$secret = 'YvFaX3ksO6yVQO4rbsV92p6I';



		$email = $this->input->post('email');
		$total_price = $this->input->post('amount');
		$id = $this->input->post('id');
		$shipping_address = $this->input->post('shipping_address');
		$order_id=$this->input->post('order_id');



		$oi = $this->session->userdata('orid');





		$o_id = $this->db->get_where('orders', ['o_id' => $oi])->row_array();


		




		$body = [
			"amount" => $total_price * 100,
			"currency" => 'INR',
			"receipt" => $order_id,
			"payment_capture" => 1
		];

		





		$order = curl_init('https://api.razorpay.com/v1/orders');
		curl_setopt($order, CURLOPT_POST, true);
		curl_setopt($order, CURLOPT_POSTFIELDS, json_encode($body));
		curl_setopt($order, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($order, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		curl_setopt($order, CURLOPT_USERPWD, $key . ':' . $secret);

		$response = curl_exec($order);






		if (curl_errno($order)) {
			echo 'Curl error: ' . curl_error($order);
		}

		curl_close($order);



		$order_data = json_decode($response, true);

		if (isset($order_data['id'])) { // Check if the order exists

			$update_data = [
				'order_id' => $order_data['id'],
				'shipping_address' => $shipping_address,
				'total_price' => $total_price,
				'email' => $email,
				'delivery_time' => date('Y-m-d H:i:s', strtotime('+6 days')),
				'id' => $id,
				'status'   => 'Order_Confirmed',
			];

			$this->db->where('o_id', $order_id)->update('orders', $update_data);

			$data = [
				'order_id' => $order_data['id'],
				'o_id' => $order_id,
				'amount'   => $total_price,
				'currency' => $order_data['currency'],
				'status'   => 'Order_Confirmed'
			];

			$ooo = $this->Payment_model->insert_payment($data);



			if ($ooo) {
				echo json_encode($order_data);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Failed to insert order']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to create order']);
		}
	}







	public function payment_success()
	{
		$payment_id = $this->input->post('razorpay_payment_id');
		$order_id = $this->input->post('razorpay_order_id');

		$signature = $this->input->post('razorpay_signature');




		$generated_signature = hash_hmac('sha256', $order_id . "|" . $payment_id, "YvFaX3ksO6yVQO4rbsV92p6I");



		if ($generated_signature === $signature) {




			$this->Payment_model->update_payment_status($order_id, 'successful');


			$payment_data = [
				'payment_id' => $payment_id,
				'signature'  => $signature
			];
			$this->db->where('order_id', $order_id);
			$this->db->update('payments', $payment_data);


			echo "success";
		} else {
			$this->Payment_model->update_payment_status($order_id, 'failed');
			echo "Payment verification failed!";
		}
	}

	public function get_pays()
	{
		die(json_encode($this->db->get('payments')->result_array()));
	}

	public function pay_del(){
		
		$id2=$this->input->post('id');
		
		$this->db->delete('payments',['pay_id'=>$id2]);

		if ($this->db->affected_rows() > 0) {
			echo "Deletion successful";
		} else {
			echo "No row deleted (possibly invalid ID)";	}
	}

	// public function update_table(){
	// 	$id = $this->input->post('id');
	// 	$column = $this->input->post('column');
	// 	$value = $this->input->post('value');
	

	// 	$update=$this->db->where('pay_id',$id)->update('payments',[$column=>$value]);
    //     echo $update;
	// 	if ($update) {
	// 		echo json_encode(['status' => 'success2']);
	// 	} else {
	// 		echo json_encode(['status' => 'error', 'message' => 'No changes made']);
	// 	}
	
	// }

}
