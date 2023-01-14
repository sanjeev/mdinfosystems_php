<?php

class Brand_model extends CI_Model {

    public function insert_brand($data){
		$this->db->insert('brand', $data);
		return true;
	}
    
    public function get_brand($order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('*');
		$this->db->from('brand');	
		
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();
		return $query->result();
	}
	 public function get_brands($id){
		$this->db->where('id',$id);
		$query = $this->db->get('brand');
		return $query->row();
	}
        
      public function update_brand($data, $id){
		$this->db->where('id', $id);
		$this->db->update('brand', $data);
		return true;
	}
       public function delete_brand($id){
		$this->db->where('id', $id);
		$this->db->delete('brand');
		return true;
	}
	 public function get_categories(){
		$this->db->select('*');
		$this->db->from('categories');
		$result = $this->db->get();
		return $result->result() ;
	}
	
	  public function get_sub_categories($id){
		$this->db->where('category_id',$id);
		$query = $this->db->get('sub_categories');
		return $query->result();
	  }
	 public function get_model($id){
		$this->db->where('subcategory_id',$id);
		$query = $this->db->get('model');
		return $query->result();
	  }
	 public function get_subcategory(){
		$this->db->select('*');
		$this->db->from('sub_categories');
		$result = $this->db->get();
		return $result->result() ;
	}
	
	public function get_modelby(){
		$this->db->select('*');
		$this->db->from('model');
		$result = $this->db->get();
		return $result->result() ;
	}
	public function get_modelbrandbyid($id) {
        $this->db->where('model_id',$id);
		$query = $this->db->get('brand');
		return $query->result();
		
    }
}