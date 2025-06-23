<?php
defined('BASEPATH') or exit('dirct acsse not allowd');

class order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('order_model');
		$this->load->model('orderitm_model');
		$this->load->model('productmodel');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->database();
	}

	public function get_order_item(){
		 die(json_encode($this->db->get('order_items')->result_array()));

	}

	public function num_o(){
		echo  $this->db->count_all('users');
	}
	public function update_items(){
		$id = $this->input->post('id');
		$column = $this->input->post('column');
		$value = $this->input->post('value');
	

		$update=$this->db->where('order_itme_id ',$id)->update('order_items',[$column=>$value]);
        echo $update;
		if ($update) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No changes made']);
		}
	
	}


	public function history()
	{
		$data = $this->session->userdata('userdata');
		$id = $data->id;
		$order = $this->db->get_where('orders', ['id' => $id])->result_array();
		$orderItem = [];
		foreach ($order as $r) {
			$orderItem[] = $this->db->get_where('order_items', ['order_itme_id' => $r['order_itme_id']])->result_array();
		}
		$his['orderitem'] = $orderItem;


		$his['history'] = $this->orderitm_model->get_items_id($id);
		$data1 = $this->orderitm_model->get_items_id($id);
		$or = [];
		$product_id = [];

		foreach ($data1 as $data) {
			$product_id[] = $data['pro_id'];

			$e = $this->db->where('order_itme_id', $data['order_itme_id'])->get('orders')->result_array();


			foreach ($e as $data) {
				$or[] = $data;
			}
		};
		$his['or'] = $or;





		$allIds = [];

		foreach ($product_id as $jsonIds) {

			$decodedArray = json_decode($jsonIds, true);


			if (is_array($decodedArray)) {

				$allIds = array_merge($allIds, array_map('intval', $decodedArray));
			}
		}

		// Print final result
		json_encode($allIds);

		$pro_id = [];

		foreach ($allIds as $p_id) {

			$pro_id[] = $this->productmodel->get_proid($p_id);
		}

	
		
		$his['pro_data'] = $pro_id;
		
		$his['user']=$this->session->userdata('userdata');


		$this->session->set_userdata("pro", $his['pro_data']);
		$this->session->set_userdata("oid", $his['or']);


		$this->load->view('ui6order', $his);
	}




	public function history1()
	{
		$id = $this->input->post('user_id');

		
		$orders = $this->db->get_where('orders', ['id' => $id])->result_array();
		$base_url = base_url('image/multi/');
		$orderItem = [];
		
		foreach ($orders as $order) {
			$order['o_id'];
		
		
			$orderItems = $this->db->get_where('order_items', ['order_itme_id' => $order['order_itme_id']])->result_array();
		
			$product_id = [];
		
			foreach ($orderItems as $item) {
		
				$decodedArray = json_decode($item['pro_id'], true);
		
				if (is_array($decodedArray)) {
					$product_id = array_merge($product_id, array_map('intval', $decodedArray));
				}
			}
		
			$pro_data = [];
			$pro_data = [];

			foreach ($product_id as $p_id) {
				$product = $this->db->get_where('products', ['pro_id' => $p_id])->row_array();

				if ($product) {
					// Fix the image path
					$product['pro_image'] = isset($product['pro_image']) ? $base_url . $product['pro_image'] : '';
					$pro_data[] = $product;
				}
			}

			
			$orderItem[$order['o_id']] = $pro_data;

		}
		
		echo json_encode($orderItem);
		


	}


	//***order_details page data send on ui pro come to order/history*/
	public function order_details($pro_id)
	{

		$r = $this->db->get_where('order_items', ['order_itme_id' => $pro_id])->result_array();
		$p_id = [];
		foreach ($r as $d) {
			$p_id[] = $d['pro_id'];
		}
		$allIds = [];
		foreach ($p_id as $jsonIds) {

			$decodedArray = json_decode($jsonIds, true);


			if (is_array($decodedArray)) {

				$allIds = array_merge($allIds, array_map('intval', $decodedArray));
			}
		}


		$pr_id = [];

		foreach ($allIds as $p_id) {

			$pr_id[] = $this->db->where('pro_id', $p_id)->get('products')->result_array();
		}

		



		$pro['pro_data'] = $pr_id;


		$this->session->set_userdata('prodata', $pr_id);
		$n = $this->db->get_where('orders', ['order_itme_id' => $pro_id])->result_array();


		$b = [];

		foreach ($n as $f) {
			$b[] = $f['status'];
		}
		$get_status = $b;





		$pro['status_info'] = $get_status;

		$pro['userget'] = $this->session->userdata('userdata');
		$pro['order'] = $this->db->get_where('orders', ['order_itme_id' => $pro_id])->result_array();
		$this->session->set_userdata('orderdata', $pro['order']);





		$this->load->view('order_details', $pro);
	}

	//update order status and send to status data on other funcations  
	public function update()
	{
		$order_id = $this->input->post('order_id');
		$statuses = $this->input->post('order_status');

		if (!empty($order_id) && !empty($statuses)) {
			$status = implode(',', $statuses);
			$update_status = $this->order_model->updateor($order_id, $status);
			$get_data = $this->db->get_where('orders', ['o_id' => $order_id])->row_array();


			$get_status = json_encode($get_data['status']);

			$this->session->set_userdata('status_data', $get_status);



			echo json_encode(['success' => $update_status]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Invalid data']);
		}
	}


	public function shipping()
	{
		$order_id = $this->input->post('order_id');
		echo json_encode($this->db->get_where('orders', ['o_id' => $order_id])->row_array());
	}


	// for order insert in order item table and order table send data on other function payment/create
	public function try()
	{


		$orderdata = $this->input->post('data');
		$id = $this->session->userdata('userdata');


		$cart_data = $this->db->get_where('cart', ['id' => $id->id])->result_array();

		$pro_id = [];
		$quantity = [];
		$amount = [];
		$size=[];
		$color=[];

		foreach ($cart_data as $cart) {
			$pro_id[] = $cart['pro_id'];
			$quantity[] = $cart['quantity'];
			$amount[] = $cart['price'];
			$size[]=$cart['pro_size'];
			$color[]=$cart['pro_color'];
		}


		if (!is_array($orderdata)) {
			echo json_encode(["status" => "error", "message" => "Invalid JSON format"]);
			return;
		}


		$order_i = array(
			'pro_id' => json_encode($pro_id),
			'id' => $id->id,
			'pro_size'=>json_encode($size),
			'quantity' => json_encode($quantity),
			'amount' => json_encode($amount),
			'color'=>json_encode($color),

		);



		if (!empty($order_i)) {

			$this->orderitm_model->add_item($order_i);
			$last_id = $this->db->insert_id();

			$pro_ids = [];

			$items = $this->db->get_where('order_items', ['id' => $order_i['id']])->result_array();
			// die(json_encode($items));

			foreach ($items as $item) {
				$pro_ids[] = $item['order_itme_id'];
			}
			
			$store = [
				'email' => $id->email,
				'total_price' => $orderdata["total_price"],
				'order_itme_id' =>  $last_id,
				'id' => $order_i['id'],
				'pro_size'=>$order_i['pro_size'],
				'color'=>$order_i['color'],
				"shipping_address" => $id->address,
				'delivery_time' => date('Y-m-d H:i:s', strtotime('+6 days'))
			];


			$this->order_model->create_order($store);
			$o_id1 = $this->db->insert_id();
			$this->session->set_userdata('o_id1', $o_id1);
			$this->session->set_userdata("store", $store);

			echo json_encode(['success' => 'Order created successfully']);
		} else {
			echo json_encode(['error' => 'Failed to create order']);
		}
	}

	public function invoice()
	{
		$data["user_data"] = $this->session->userdata('userdata');
		   $data["pro_data"] = $this->session->userdata('prodata'); 
	
		$data["order_data"] = $this->session->userdata('orderdata');
		
		
		$this->load->view('invoice_view', $data);
	}
	//for mobile developer
	public function cart()
	{
		$order_i = array(
			'pro_id' => $this->input->post('pro_id'),
			'id' => $this->input->post('id'),
			'quantity' => $this->input->post('quantity'),
			'amount' => $this->input->post('amount'),

		);

		

		if ($order_i) {
			$this->db->insert('order_items', $order_i);
			// echo $this->db->last_query();
			
			$R=$this->db->insert_id(); // Check the INSERT query
			// See if this returns ID
	


			

			$store = [
				'email' => $this->input->post('email'),
				'total_price' => $this->input->post('total_price'),
				'order_itme_id' =>  $R,
				'id' => $order_i['id'],
				'delivery_time' => date('Y-m-d H:i:s', strtotime('+6 days'))
			];
			
		
			$oi1=$store['order_itme_id'];

		
			
			
		
           $this->db->insert('orders',$store);
		//    echo $this->db->last_query();
		   
		   $t=$this->db->insert_id();
		//    echo $t;
		echo json_encode(['success' => $t]);


		
		   $this->session->set_userdata('orid',$t);


		// echo    $this->session->userdata('orid');
			
		} else {
			echo "fail to create cart";
		}
	}

	//send data on ui4

	public function US3()
	{
		$data['user'] = $this->session->userdata('userdata');
		$data['stored'] = $this->session->userdata('store');
		$data['order']=$this->db->get_where('orders',['order_itme_id'=>$data['stored']['order_itme_id']])->row_array();

		$r = $this->db->get_where('order_items', ['order_itme_id' =>$data['stored']['order_itme_id'] ])->result_array();

		$p_id = [];
		foreach ($r as $d) {
			$p_id[] = $d['pro_id'];
		}
		$allIds = [];
		foreach ($p_id as $jsonIds) {

			$decodedArray = json_decode($jsonIds, true);


			if (is_array($decodedArray)) {

				$allIds = array_merge($allIds, array_map('intval', $decodedArray));
			}
		}


		$pr_id = [];

		foreach ($allIds as $p_id) {

			$pr_id[] = $this->db->where('pro_id', $p_id)->get('products')->row_array();
		}

		

		$base_url = base_url('image/multi/');

		$data['pro_data'] = $pr_id;

		foreach ($data['pro_data'] as &$key) {
			if (isset($key['pro_image'])) {
				$key['pro_image'] = $base_url . $key['pro_image'];
			} else {
				$key['pro_image'] = []; // If 'multi_img' does not exist, set it to an empty array
			}


			if (isset($key['multi_img'])) {
				$key['multi_img'] = explode(",", $key['multi_img']);
				foreach ($key['multi_img'] as &$multi_image) {
					$multi_image = $base_url . $multi_image;
				}
			} else {
				$key['multi_img'] = []; // If 'multi_img' does not exist, set it to an empty array
			}

			if (!empty($key['color_img']) && is_array($key['color_img'])) {
				$key['color_img'] = json_decode($key['color_img'], true);
				foreach ($key['color_img'] as &$multi_image) {
					$multi_image = $base_url . $multi_image;
				}
			} else {
				$key['color_img'] = [];
			}
		}



		
		$this->load->view('ui4', $data);
	}




	public function orget()
	{
		echo json_encode($this->order_model->get());
	}

	public function num_or()
	{
		echo json_encode($this->order_model->num_or());
	}
	public function update_table()
	{
		$id = $this->input->post('id');
		die($id);
		$column = $this->input->post('column');
		$value = $this->input->post('value');


		$update = $this->db->where('o_id', $id)->update('orders', [$column => $value]);
		$r = $this->db->where('o_id', $id)->get('orders')->result_array();
		echo "<pre>";
		die($id);
		echo "</pre>";
		exit; // Stops further execution

		if ($update) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No changes made']);
		}
	}

	public function updateadd()
	{
		$address = $this->input->post('address');


		//echo $address;
		$email = $this->input->post('email');



		$update_status = $this->order_model->update_address($email, $address);

		// $this->db->where('email',$email);
		// $data['shipping_address'] = 'test';//htmlspecialchars($address);
		// echo $address;


		if ($update_status) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No changes made']);
		}
	}

	public function cash(){
		$data=['shipping_address'=>$this->input->post('s_address'),
		'current_1time'=>$this->input->post('c_time'),
		'delivery_time'=>$this->input->post('d_time'),
		'email'=>$this->input->post('email'),
	];
		$this->db->insert('cash_on_dilivery',$data);
	}

	public function order_del(){
		$id=$this->input->post('id');
		$id2=$this->input->post('oiid');
		$this->db->delete('orders',['o_id'=>$id]);
		$this->db->delete('order_items',['order_itme_id'=>$id2]);
		if ($this->db->affected_rows() > 0) {
			echo "Deletion successful";
		} else {
			echo "No row deleted (possibly invalid ID)";		}
	}

	public function order_del2(){
		
		$id2=$this->input->post('id');
		
		$this->db->delete('order_items',['order_itme_id'=>$id2]);

		if ($this->db->affected_rows() > 0) {
			echo "Deletion successful";
		} else {
			echo "No row deleted (possibly invalid ID)";	}
	}
	
}
