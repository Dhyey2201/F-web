<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function create_order() {
       
		$key = 'rzp_test_v1TzrAaOfZ8DOD';
		$secret = 'Xczrwv1xFbVY0twpsCPDVsVT';




		$amount=$this->input->post('amount');
		if (!$amount || $amount <= 0) {
			echo json_encode(['status' => 'error', 'message' => 'Invalid amount']);
			
		}
		$subtotal=$this->input->post('subtotal');
		$quantity=$this->input->post('ququantity');

		$order_item=[
					'pro_id'=>$this->session->userdata('pro_id'),
					'quantity' => $quantity,
					'amount' => $amount,
					'subtotal' => $subtotal
	    ];
        

		if($order_item){
			$total_price=0;
			foreach($order_item as $items){
				$subtotal1= $items['quantity']*$items['price'];
				$total_price +=$subtotal;  

				$this->orderitm_model->add_item([
					'pro_name'=>$items['pro_name'],
					'quantity' => $item['quantity'],
					'amount' => $item['amount'],
					'subtotal' => $subtotal1
				]);
			}
		
			$this->order_model->create_order([
				'total_price' => $total_price,
                'order_item_id' => json_encode($order_items), // If multiple items
                'amount' => $amount
			]);
			echo json_encode(['message' => 'Order created successfully', 'order_id' => $order_item]);

		}else {
        echo json_encode(['error' => 'Failed to create order']);
    }


		
		// die($amount);
		
		
		$order_data1= [
			'amount'   => $amount,
			'email'    =>$this->input->post('email'),
			'total_price'=>$this->input->post('total_price'),
			'status'   => 'pending',
			'shipping_address'=>$this->input->post('shipping_address'),
		];
		// die(json_encode($order_data1));

		$this->order_model->create_order($order_data1);
	
		$o_id=$this->db->get_where('orders',['email'=>$this->input->post('email')])->row_array();
		   
	    //  die(json_encode($o_id));
		
		
		if(!$o_id){
			echo json_encode(['status' => 'error', 'message' => 'Failed to create local order']);
			
		}

	

		$body = array(
			"amount" => $amount*100,
			"currency" => 'INR',
			"receipt" => $o_id['o_id'],
			"payment_capture" => 1
		);



		$order = curl_init('https://api.razorpay.com/v1/orders');
		curl_setopt($order, CURLOPT_POST, true);
		curl_setopt($order, CURLOPT_POSTFIELDS, json_encode($body));
		curl_setopt($order, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($order, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($order, CURLOPT_USERPWD, $key . ':' . $secret);

		$response = curl_exec($order);
		
		
		if (curl_errno($order)) {
			echo 'Curl error: ' . curl_error($order);
		}

		curl_close($order);
		

		$order_data = json_decode($response, true);

		// $this->session->set_userdata('or',$order_data);


		// echo json_encode($order_data);


		// $order=$this->session->userdata('or');
		// die(json_encode($order));
	

		if(isset($order_data['id'])) { // Check if the order exists
			// die(json_encode($order['id']));
			// Update the record in the 'orders' table
			$this->db->where('o_id', $order_data['receipt'])->update('orders', ['order_id' => $order_data['id']]);
			// Fetch the updated order
			$o_id = $this->db->get_where('orders', ['o_id' => $order_data['receipt']])->row_array();


			// die(json_encode($o_id));

			$data = [
                'order_id' => $order_data['id'],
				'o_id' => $o_id['o_id'],
                'amount'   => $order_data['amount'] / 100, 
                'currency' => $order_data['currency'],
                'status'   => 'pending'
            ];
			// die($data['order_id']);

			$ooo=$this->Payment_model->insert_payment($data);
		

            if ($ooo) {
                echo json_encode($order_data);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to insert order']);
            }
		
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create order']);
        }
}


}
