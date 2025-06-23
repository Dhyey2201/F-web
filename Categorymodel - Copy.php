<?php

class categorymodel extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_ca(){
		return $this->db->get('categories')->result_array();
	}

	public function num_cat(){
		return  $this->db->count_all('categories');
	}

	public function get_by_id($id) {
		return $this->db->get_where('categories',['co-id'=>$id])->row_array();
	}

	public function category_insert($data){
		
		return $this->db->insert('categories',$data);
	}
	
	public function category_update($id,$data){
		$this->db->where('co-id',$id);
		return $this->db->update('categories',$data);
	}

	public function category_delete($id){
		
	
		$data2 = $this->db->where('co-id', $id)->delete('categories');

		

		return $data2;

		

}
}
?>
