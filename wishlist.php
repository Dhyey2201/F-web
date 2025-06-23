<?php 
class wishlist extends CI_Controller{
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
	
	public function wish_in(){
		$id=$this->input->post('id');
	
		$data=array(
			'id'=>$id,
			'pro_id'=>$this->input->post('pro_id'),
			'pro_image'=>$this->input->post('pro_image'),
			'pro_name'=>$this->input->post('pro_name'),
			'pro_discription'=>$this->input->post('pro_dis'),
			'pro_price'=>$this->input->post('pro_price'),

		);
		



		if($id){
			$this->db->insert('whishlist',$data);
			echo json_encode(["success" => $data]);

		}
	}


	public function delete_wishlist(){
		$cart_id = $this->input->post('wish_id');
  
	
		if (!empty($cart_id)) {
			// Delete the selected items from the database
			$this->db->where_in('w_id', $cart_id);
			$this->db->delete('whishlist');
	
			echo json_encode(["status" => "success", "message" => "Selected items removed successfully!"]);
		}else{
			echo json_encode(["status" => "error", "message" => "No items selected!"]);
    		}
	}
}
?>
