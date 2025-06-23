<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rating extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('productmodel');
		$this->load->library('session');
	}

	public function r_insert(){
		$rating=$this->input->post('rating');
		$pro_id=$this->input->post('pro_id');
		$user_id=$this->input->post('user_id');
		$comment  = $this->input->post('comment');
		

		$data=[
			'id'=>$user_id,
			'pro_id'=>$pro_id,
			'rating'=>$rating,
			'pro_comment'=>$comment,
		];
		

		$this->db->insert('ratings',$data);

		echo json_encode($data);


	}


	public function get_average_rating($pro_id) {
		$this->session->set_userdata('pro_id',$pro_id);
        $this->db->select_avg('rating');
        $this->db->where('pro_id', $pro_id);
        $query = $this->db->get('ratings')->row_array();
		echo json_encode($query);
        
    }


	public function avg_rating() {
		$pro_id=$this->input->post('pro_id');
        $this->db->select_avg('rating');
        $this->db->where('pro_id', $pro_id);
        $query = $this->db->get('ratings')->row_array();
		echo json_encode($query);
        
    }

	public function r_get(){
		$pro_id=$this->session->userdata('pro_id');
		$this->db->where('pro_id', $pro_id);

        $query1 = $this->db->get('ratings')->row_array();
		$p['review']=$query1;

		$this->load->view('ui2',$p);
	}

	public function r_get1(){
		$pro_id=$this->input->post('pro_id');
	
		$this->db->where('pro_id', $pro_id);

        $query1 = $this->db->get('ratings')->result_array();
		echo json_encode($query1);
;
	}

	public function r_ui1(){
		$this->load->view('r_ui');
	}

	public function rat_get(){
		$query1 = $this->db->get('ratings')->result_array();
		echo json_encode($query1);
	}

	public function update_table(){
		$id = $this->input->post('id');
		$column = $this->input->post('column');
		$value = $this->input->post('value');
	

		$update=$this->db->where('r_id',$id)->update('ratings',[$column=>$value]);
        echo $update;
		if ($update) {
			echo json_encode(['status' => 'success1']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No changes made']);
		}
	
	}



}



?>
