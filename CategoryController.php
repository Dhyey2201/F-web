<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryController extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('categorymodel');
	}
	public function get_category(){
		$get_all=$this->categorymodel->get_ca();
		header('Content-Type: application/json');
		echo json_encode($get_all);
	}

public function insert_category() {
		$config['upload_path'] = './image/'; 
		$config['allowed_types'] = 'jpg|jpeg|png|gif'; 
		$config['max_size'] = 2048; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('co-image')) {
			header('Content-Type: application/json');
			echo json_encode(['status' => 'failed', 'error' => $this->upload->display_errors()]);
			return;
		}
		$upload_data = $this->upload->data();
		$image_path =  'http://192.168.1.170/api/'.'image/'.$upload_data['file_name']; 

		echo $image_path;

        $data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'co-image' => $image_path,
        );

        $in_data = $this->categorymodel->category_insert($data);
		

       
        if ($in_data) {
            echo json_encode(['status' => 'category created']);
        } else {
            echo json_encode(['status' => 'failed to create category']);
        }
    }
     
	public function cat_in(){
		$this->load->view('cat_ui');
	}

 public function table_update(){
	$id = $this->input->post('id');
    $column = $this->input->post('column');
    $value = $this->input->post('value');

	// die($id);
	// die($column);
	// die($value);
     

	if (!$id || !$column || $value === null) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        return;
    }
	$update = $this->db->where('co-id', $id)->update('categories', [$column => $value]);

	// die($this->db->affected_rows() );

    if ($update) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No changes made']);
    }

 }

 public function update_category($id) {
	echo $id;

		$delete_imge = $this->categorymodel->get_by_id($id);

    if (!$delete_imge) {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Category not found']);
        return;
    }

    
    $image_path = str_replace('http://192.168.1.170/api/', '', $delete_imge['co-image']);
	echo $image_path;

    if (file_exists($image_path)) {
        unlink($image_path);
    } else {
        error_log("File not found: " . $image_path); // Logs error if file is missing
    }



	$config['upload_path'] = './image/'; 
		$config['allowed_types'] = 'jpg|jpeg|png|gif'; 
		$config['max_size'] = 2048; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('co-image')) {
			header('Content-Type: application/json');
			echo json_encode(['status' => 'failed', 'error' => $this->upload->display_errors()]);
			return;
		}
		$upload_data = $this->upload->data();
		$image_path =  'http://192.168.1.170/api/'.'image/'.$upload_data['file_name']; 

		echo $image_path;

		$data = array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'co-image' => $image_path,
        );

        $up_data = $this->categorymodel->category_update($id,$data);
        header('Content-Type: application/json');
        if ($up_data) {
            echo json_encode(['status' => 'update successful']);
        } else {
            echo json_encode(['status' => 'failed to update']);
        }
    }

	public function delete_category(){
		 $id=$this->input->post('id');
		
		
			if($id){
				$this->categorymodel->category_delete($id);
				echo "Success";
			}else{
				echo "Failure";
			}
	
	

	}

	public function get_ca(){
		echo json_encode($this->categorymodel->get_ca());
	}


	public function num_cat(){
		echo json_encode($this->categorymodel->num_cat());
	}
	}
	











?>
