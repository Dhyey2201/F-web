<?php
defined('BASEPATH') or exit('no direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		return $this->db->get('users')->result_array();
	}

	public function num_row(){
		return $this->db->count_all('users');
	}

	
	public function get_id($id){
		return $this->db->get_where('users', ['id' => $id])->row_array();
	}

	public function search($email)
	{
		return $this->db->get_where('users', ['email' => $email])->row_array();
	}


	public function insert_user($data)
	{
		// $t = $this->db->insert('users',$data);
		// die($this->db->last_query($t));
		return $this->db->insert('users', $data);
	}

	// public function update_user($id,$data){

	// 	if($data=$this->db->update('users',$data,['id'=>$id])){
	// 		return "Success";
	// 	}
	// 	else{
	// 		return "Failure";
	// 	}

	// } 

	public function get_user_by_email($email){
		$query=$this->db->get_where('users',['email'=>$email],1)->row();
		return $query;

	}

	public function update_user($id, $data)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('users');

		if ($query->num_rows() == 0) {
			return "Not Found";
		}
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);

		if ($update) {
			return "Success"; 
		} else {
			return "Failure";
		}
	}


	public function delete_use($id)
	{
		
		$this->db->where('id', $id);
		$query = $this->db->get('users');

		if ($query->num_rows() == 0) {
			
			return "Not Found";
		}

		
		$this->db->where('id', $id);
		$delete= $this->db->delete('users',['id'=>$id]);

		if ($delete) {
			return "Success"; 
		} else {
			return "Failure"; 
		}
	}


	public function check_and_insert($user_data) {
		echo json_encode($user_data);
		

        $query = $this->db->get_where('users', ['email' => $user_data['email']]);

        if ($query->num_rows() == 0) {
            $this->db->insert('users', $user_data);
			echo $this->db->last_query();
			die();	
        }
    }

	public function index() {
		$user_data = $this->session->userdata('user_data');
		if ($user_data) {
			echo "Welcome, " . $user_data['name'];
			echo "<br><a href='".base_url('googlesignin/logout')."'>Logout</a>";
		} else {
			echo "<a href='".base_url('googlesigin/login')."'>Login with Google</a>";
		}
	}

	
	

}
