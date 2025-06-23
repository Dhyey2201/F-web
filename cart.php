<?php
defined('BASEPATH')OR exit('dirct acsse not allowd');

class cart extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');
		
	}

	public function cart(){
    $id = $this->input->post('user_id');
    $pro_id = $this->input->post('pro_id');
    $quantity = 1;
    $pro_price = $this->input->post('price');
    
    $pro_name = $this->input->post('pro_name');
    $pro_dis = $this->input->post('pro_dis');
    $pro_image = $this->input->post('pro_image');
    
    $total_price = $quantity * $pro_price;

    $data = [
        'id' => $id,
        'pro_id' => $pro_id,
        'quantity' => $quantity,
        'total_price' => $total_price,
        'price' => $pro_price,
        'pro_dis' => $pro_dis,
        'pro_name' => $pro_name,
        'image' => $pro_image,
    ];

    if($this->db->insert('cart', $data)){
        echo json_encode(['status' => 'success', 'message' => 'Added to cart successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add to cart.']);
    }
}


	public function cart_get(){	
		$id=$this->input->post('user_id');

		// $product=[];
		

		$get_product=$this->db->get_where('cart',['id'=>$id])->result_array();
		// foreach($get_product as $data){
			
		// 	$product[]=$this->db->get_where("products",['pro_id'=>$data['pro_id']])->result_array();
		
		// }
		

		echo json_encode($get_product);
	
	}

	public function update_quantity() {
		$cart_id = $this->input->post('cart_id');
		$quantity = (int) $this->input->post('quantity1');
	
		if ($quantity < 1) {
			echo json_encode(['status' => 'error', 'message' => 'Quantity must be at least 1.']);
			return;
		}
	
		// Get product price from cart
		$cart_item = $this->db->get_where('cart', ['cart_id' => $cart_id])->row_array();
	
		if (!$cart_item) {
			echo json_encode(['status' => 'error', 'message' => 'Cart item not found.']);
			return;
		}
	
		$unit_price = (float) $cart_item['price'];
		$total_price = $unit_price * $quantity;
	
		// Update quantity in the database
		$this->db->where('cart_id', $cart_id);
		$this->db->update('cart', ['quantity' => $quantity, 'total_price' => $total_price]);



		// $this->session->set_userdata('cart_data',)
	
		echo json_encode([
			'status' => 'success',
			'message' => 'Quantity updated successfully!',
			'total_price' => number_format($total_price, 2)
		]);
	}
	

	public function delete_cart(){
		$cart_id = $this->input->post('cart_id');

	
		if (!empty($cart_id)) {
			// Delete the selected items from the database
			$this->db->where_in('cart_id', $cart_id);
			$this->db->delete('cart');
	
			echo json_encode(["status" => "success", "message" => "Selected items removed successfully!"]);
		}else{
			echo json_encode(["status" => "error", "message" => "No items selected!"]);
    		}
	}


	


	public function cart_web(){
		$user_id = $this->input->post('user_id');
        $pro_name = $this->input->post('pro_name');
        $pro_dis = $this->input->post('pro_dis');
        $pro_price = $this->input->post('pro_price');
        $pro_image = $this->input->post('pro_image');
		$pro_id=$this->input->post('pro_id');
		$pro_size=$this->input->post('pro_size');
		$pro_color=$this->input->post('pro_color');
	
		$quantity=1;
		$total_price=$quantity*(int)$pro_price;

		$data = [
            'id' => $user_id,
            'price' => $pro_price,
			'pro_id'=>$pro_id,
			'pro_dis'=> $pro_dis,
			'pro_name'=>$pro_name,
			'quantity'=>$quantity,
			'total_price'=>$total_price,
			'image'=>$pro_image,
			'pro_size'=>$pro_size,	
			'pro_color'=>$pro_color,
        ];
		if ($this->db->insert('cart', $data)) {
			
			$get_product = $this->db->get_where('cart', ['id' => $user_id])->result_array();
			
			
			// Store in session
			$this->session->set_userdata('cart_data', $get_product);
			
			echo json_encode(['status' => 'success', 'message' => 'Added to cart successfully!', 'cart_count' => count($get_product)]);
			
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Database error']);
		}
	}
	
}







?>
