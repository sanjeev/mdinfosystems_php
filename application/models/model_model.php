<?php

class model_model extends CI_Model {

    public function insert_model($data){
		$this->db->insert('model', $data);
		return true;
	}
    
    public function get_model($order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('*');
		$this->db->from('model');	
		
                //conflict with admin panel Jquery
                /*if($limit != null){
			$this->db->limit($limit, $offset);
		}*/
		if($order_by != null){
			$this->db->order_by($order_by, $sort);
		}
		$query = $this->db->get();
		return $query->result();
	}
        
      public function get_models($id){
		$this->db->where('id',$id);
		$query = $this->db->get('model');
		return $query->row();
	}  
	
	public function update_model($data, $id){
		$this->db->where('id', $id);
		$this->db->update('model', $data);
		return true;
	}
       public function delete_model($id){
		$this->db->where('id', $id);
		$this->db->delete('model');
		return true;
	}
	 public function get_categories(){
		$this->db->select('*');
		$this->db->from('categories');
		$result = $this->db->get();
		return $result->result_array() ;
	}
	
	  public function get_sub_categories($id){
		$this->db->where('category_id',$id);
		$query = $this->db->get('sub_categories');
		return $query->result();
	  }
    
	 public function get_subcategories(){
		$this->db->select('*');
		$this->db->from('sub_categories');
		$result = $this->db->get();
		return $result->result_array() ;
	}
}