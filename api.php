<?php
class api extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->helper(['url', 'form']);
		$this->load->library('session');
		$this->load->database();
	}
	public function fweb(){
		$this->load->view('beforlogin');
	}
    
	public function main(){
		$this->load->view('main');
	}
	
	public function ui1(){
		$this->load->view('ui1');
	}

	public function ui5(){
		$this->load->view('ui5');
	}
    
	public function signinweb(){
		redirect('pro_get');
	}
	public function signin(){
		$this->load->view('signin');
	}

	

	public function admin(){
		$this->load->view('admin');
	}

	public function adminlogin(){
		$this->load->view('adminlogin');
	}
	public function user_search()

	{
		$email=$this->input->post('email'); 
		$users = $this->User_model->search($email);
		if ($users) {
			header('content-Type:application/json');
			echo json_encode($users);
		} else {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['status' => 'Failed to create user']));
		}
	}

    public function loginweb(){
		$email=$this->input->post('email');
		$password=$this->input->post('password');


	

		if (empty($email) || empty($password)) {
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'Email and password are required']);
			
		}

		$this->load->model('User_model');
		$user=$this->User_model->get_user_by_email($email);


		
       
	   
		
		if($user){
			if(password_verify($password,$user->password)){
				$this->session->set_userdata('userdata', $user);
				header('content-Type:application/json');
				echo json_encode([
					'status' => 'success',
					'message' => 'Login successful',
					'user'=>$user,
					
					]);
            redirect('api/signinweb');
					
			}
			

		}else {
			// User not found
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'User not found']);
		}
		$this->session->set_userdata('user_id',$user->id);

	}



	public function user_login1(){
		$email=$this->input->post('email');
		$password=$this->input->post('password');


	

		if (empty($email) || empty($password)) {
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'Email and password are required']);
			
		}

		$this->load->model('User_model');
		$user=$this->User_model->get_user_by_email($email);


		
       
		$this->session->set_userdata('userdata', $user);
		
		if($user){
			if(password_verify($password,$user->password)){

				header('content-Type:application/json');
				echo json_encode([
					'status' => 'success',
					'message' => 'Login successful',
					'user'=>$user,
					
					]);
           
					
			}
		

		}else {
			// User not found
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'User not found']);
		}

	}
	
	
   
    public function user_login(){
		$email=$this->input->post('email');
		$password=$this->input->post('password');


	

		if (empty($email) || empty($password)) {
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'Email and password are required']);
			
		}

		$this->load->model('User_model');
		$user=$this->User_model->get_user_by_email($email);
		
       
	    $this->session->set_userdata('userdata', $user);
		
		if($user){
			if(password_verify($password,$user->password)){
				header('content-Type:application/json');
				echo json_encode([
					'status' => 'success',
					'message' => 'Login successful',
					'user'=>$user,
					
					]);
            redirect('api/admin');
					
			}
		

		}else {
			// User not found
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'User not found']);
		}
		$this->session->set_userdata('user_id',$user->id);

		
	}
	


	public function users()
	{
		
		echo json_encode($this->User_model->get());
	}

	public function num_rows(){
		echo ($this->User_model->num_row());
		
	}
    
	public function update_table(){
		$id = $this->input->post('id');
		$column = $this->input->post('column');
		$value = $this->input->post('value');
	

		$update=$this->db->where('id',$id)->update('users',[$column=>$value]);
        echo $update;
		if ($update) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No changes made']);
		}
	
	}

	public function user_post()
	{
		$data = array(
			'username'=>$this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'),PASSWORD_BCRYPT),
			'contect_number'=>$this->input->post('contect_number'),
			'address'=>$this->input->post('address'),
			
		);
		


		// die(json_encode($data));
		$data1 = $this->db->insert('users',$data);
		$r=$this->db->last_query();

		echo($r);
	
		
		

		if ($data1) {
			header('content-Type:application/json');
			echo json_encode(['states' => 'User created']);
		} else {
			header('content-Type:application/json');
			echo json_encode(['states' => 'fail to create user']);
		}
	}
	public function user_post1()
	{
		$data = array(
			'username'=>$this->input->post('username'),
			'email' => $this->input->post('email'),
			'password' => password_hash($this->input->post('password'),PASSWORD_BCRYPT),
			'contect_number'=>$this->input->post('contect_number'),
			'address'=>$this->input->post('address'),
			
		);
		


		// die(json_encode($data));
		$data1 = $this->User_model->insert_user($data);
		

		if ($data1) {
			header('content-Type:application/json');
			echo json_encode(['states' => 'User created']);
			redirect('api/signin');
		} else {
			header('content-Type:application/json');
			echo json_encode(['states' => 'fail to create user']);
		}
	}


	public function user_put()
	{
		$id=$this->input->post('user_id');
		// Gather input data
		$data = array(
			'email' => $this->input->post('email'),
			
			'username'=> $this->input->post('username'),
			'contect_number'=> $this->input->post('contect_number'),
			'address'=> $this->input->post('address'),
		);
	

		// Check if the update was successful
	
		


		
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);
		echo $this->db->last_query();

		if ($update) {
			return "Success"; 
		} else {
			return "Failure";
		}

		// Respond based on the result
		header('Content-Type: application/json');
		if ($update_status === "Success") {
			echo json_encode(['status' => 'success', 'message' => 'Data updated successfully']);
		} elseif ($update_status === "Not Found") {
			echo json_encode(['status' => 'failure', 'message' => 'User not found']);
		} else {
			echo json_encode(['status' => 'failure', 'message' => 'Failed to update data']);
		}
	}



	
	// public function users_delete($id)
	// {
	// 	if ($this->input->server('REQUEST_METHOD') === 'DELETE') {
	// 		if ($this->User_model->delete_user($id)) {
	// 			$this->output
	// 				->set_content_type('application/json')
	// 				->set_output(json_encode(['status' => 'User deleted']));
	// 		} else {
	// 			$this->output
	// 				->set_content_type('application/json')
	// 				->set_output(json_encode(['status' => 'Failed to delete user']));
	// 		}
	// 	}
	// }

	public function user_delete(){
		$id=$this->input->post('id');
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
		);

		$delete_status=$this->User_model->delete_use($id,$data);

		header('Content-Type: application/json');
		if ($delete_status === "Success") {
			echo json_encode(['status' => 'success', 'message' => 'Data updated successfully']);
		} elseif ($delete_status === "Not Found") {
			echo json_encode(['status' => 'failure', 'message' => 'User not found']);
		} else {
			echo json_encode(['status' => 'failure', 'message' => 'Failed to update data']);
		}
	}
    


	public function userget(){
		$v=$this->session->userdata('userdata');
		$u=$this->User_model->get_user_by_email($v->email);
		$this->session->set_userdata('use',$u);
		
		
		$user['udata']=$u;
		$user['status_info'] = $this->session->userdata('status_data');
		
		$this->load->view('ui5',$user);
		
	}

	public function update_user(){
		$id = $this->input->post('id');

		$username=$this->input->post('username');
		$email=$this->input->post('email');
		$con=$this->input->post('contect_number');
		$add=$this->input->post('address');
		
		$data = array(
			
			'username' =>$username ,
			'email' =>$email ,
			'contect_number' => $con,
			'address' => $add,
		);
		
	
		
		$update=$this->db->where('id',$id)->update('users',$data);
		$data=$this->User_model->get();
		$this->session->set_userdata('data',$data);

		if ($update) {
			echo json_encode([
				"success" => true,
				"message" => "Profile update"
			]);
		  $user['udata']=$this->User_model->get();
		  
		$this->load->view('ui5', $user);

		


		} else {
			echo json_encode([
				"success" => false,
				"message" => "Profile update failed"
			]);
		}
		
	
		
		
	}

	

}
