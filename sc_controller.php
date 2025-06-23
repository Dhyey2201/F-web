<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sc_controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('scmodel');
		$this->load->library('session');
	}

	public function scget($sc_id){

		$e['sc']= $this->db->get_where('products',['sc_id'=>$sc_id])->result_array();
		// $base_url = base_url('image/multi/');
		// foreach ($e['sc'] as &$key) {
		// 	if (!empty($key['sc_image'])) {
		// 		$key['sc_image'] = $base_url . $key['sc_image'];
		// 	} else {
		// 		$key['sc_image'] = null; // or a default image path if needed
		// 	}
		// }
	
	
		$this->load->view('scpro',$e);

	}
	public function scgetid(){
		$sc_id = $this->input->post('sc_id');
		$e= $this->db->get_where('products',['sc_id'=>$sc_id])->result_array();
		$base_url = base_url('image/multi/');
		foreach ($e as &$key) {
			if (!empty($key['pro_image'])) {
				$key['pro_image'] = $base_url . $key['pro_image'];
			} else {
				$key['pro_image'] = null; // or a default image path if needed
			}
		}
	
	
		echo json_encode($e);

	}

	public function scgetcat(){
		$co_id = $this->input->post('co-id');
		$e= $this->db->get_where('subcategory',['co-id'=>$co_id])->result_array();
	
		echo json_encode($e);

	}
	public function scget2()
{
    $t = $this->scmodel->getsc();
    $base_url = base_url('image/sccategory/');

    foreach ($t as &$key) {
        if (!empty($key['sc_image'])) {
            $key['sc_image'] = $base_url . $key['sc_image'];
        } else {
            $key['sc_image'] = null; // or a default image path if needed
        }
    }

    echo json_encode($t);
}

	
	
	

	public function scget1(){
		$r = $this->scmodel->getsc();
		
		
		$this->session->set_userdata('sc', $r);
		$t=$this->session->userdata('sc');
		die(json_encode($t));

		
	}
	public function scshow(){
		$this->load->view('subcat');
	}

	public function scin(){
		$config['upload_path'] = './image/sccategory/'; 
		$config['allowed_types'] = 'jpg|jpeg|png|gif'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload('sc_image')){
			// header('Content-Type : apllication/json');
			echo json_encode(['status'=>'fail to upload image','error'=>$this->upload->display_errors()]);
		}

		$upload_img=$this->upload->data();
		$image_path=$upload_img['file_name'];


		$scdata=array(
			'sc_name'=>$this->input->post('sc_name'),
			'co-id'=>$this->input->post('co-id'),
			'sc_image'=>$image_path		
		);
		


		$in_sc=$this->scmodel->insc($scdata);

		
		if($in_sc){
			header("Content-type:application/json");
			echo json_encode(['status'=>'user create successfully']);
		}else{
			header("content-type:application/json");
			echo json_encode(['status'=>'fail to create']);
			
		}


	}
	public function update_table(){
		$id = $this->input->post('id');
		$column = $this->input->post('column');
		$value = $this->input->post('value');
	

		$update=$this->db->where('sc_id',$id)->update('subcategory',[$column=>$value]);
        echo $update;
		if ($update) {
			echo json_encode(['status' => 'success']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'No changes made']);
		}
	
	}
	public function upsc($id){
		// die($id);
		#delete image
		$image_id1=$this->scmodel->get_id($id);
		// echo json_encode($image_id1);

		if(!$image_id1){
			header("content-type:application/json");
			echo json_encode(['status'=>'fail','message'=>'id nor in the record']);
		}

		$image_id=str_replace('http://192.168.1.170/api/','',$image_id1->sc_image );
		// die($image_id);
		if(file_exists($image_id)){
			unlink($image_id);
		}
		#update image
		$config['upload_path']='./image/sccategory/';
		$config['allowed_types']='jpg|jpeg|png|gif';
		$config['max_size']=2048;
		$config['encrypt_name']=true;

		$this->load->library('upload',$config);

		if(!$this->upload->do_upload('sc_image')){
			header('content-types:application/json');
			echo json_encode(['states'=>'fail','message'=>'fial to upload image']);
		}

		$image_data=$this->upload->data();

		$image_path="'http://192.168.1.170/api/".'image/sccategory/'.$image_data['file_name'];

		$scdata1=array(
			'sc_name'=>$this->input->post('sc_name'),
			'co-id'=>$this->input->post('co-id'),
			'sc_image'=>$image_path		
		);
		// die(json_encode($scdata1));

		if($this->scmodel->upsc($id,$scdata1)){
			header('content-type:application/json');
			echo json_encode(['status'=>'successfull','message'=>'update successfully']);
		}else{
			header('content-type:application/json');
			echo json_encode(['status'=>'failure','message'=>'update failure']);
		}


	}



	public function sc_del(){
		$id=$this->input->post('id');
		
		$this->db->where('sc_id',$id)->delete('subcategory');
	}
	public function num_sc(){
		echo json_encode($this->scmodel->num_sc());
	}

	public function man_sc(){
		echo json_encode($this->scmodel->man_sc());
	}
	public function woman_sc(){
		echo json_encode($this->scmodel->woman_sc());
	}
	public function teen_sc(){
		echo json_encode($this->scmodel->teen_sc());
	}
	public function kid_sc(){
		echo json_encode($this->scmodel->kid_sc());
	}
	public function baby_sc(){
		echo json_encode($this->scmodel->baby_sc());
	}
}

 ?>
