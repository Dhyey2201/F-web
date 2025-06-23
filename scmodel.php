<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class scmodel extends CI_Model{
	public function __construct(){
		parent::__construct();
	}


	public function getsc(){
		return $this->db->get('subcategory')->result_array();
	}

	public function get_id($id){
		return $this->db->get_where('subcategory',['sc_id'=>$id])->row();
	}
	public function insc($scdata){
		return $this->db->insert('subcategory',$scdata);
	}


	public function upsc($id,$scdata1){
		return $this->db->where('sc_id',$id)->update('subcategory',$scdata1);

	}
    
	
	public function num_sc(){
		return  $this->db->count_all('subcategory');
	}

	public function man_sc(){
		$this->db->where('co-id',21);
		return  $this->db->count_all_results('subcategory');
	}

	public function woman_sc(){
		$this->db->where('co-id',22);
		return  $this->db->count_all_results('subcategory');
	}
	public function teen_sc(){
		$this->db->where('co-id',23);
		return  $this->db->count_all_results('subcategory');
	}
	public function kid_sc(){
		$this->db->where('co-id',24);
		return  $this->db->count_all_results('subcategory');
	}
	public function baby_sc(){
		$this->db->where('co-id',25);
		return  $this->db->count_all_results('subcategory');
	}




}
?>
