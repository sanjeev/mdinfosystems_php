<?php

class Category_model extends CI_Model {

    public function insert_category($data){
		$this->db->insert('categories', $data);
		return true;
	}
    
    public function get_categories($order_by = null, $sort = 'DESC', $limit = null, $offset = 0){
		$this->db->select('*');
		$this->db->from('categories');	
		
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
        
        
        
        public function get_category($id){
		$this->db->where('id',$id);
		$query = $this->db->get('categories');
		return $query->row();
	}

    
        
        public function update_category($data, $id){
		$this->db->where('id', $id);
		$this->db->update('categories', $data);
		return true;
	}
        
        
        
        public function delete_category($id){
		$this->db->where('id', $id);
		$this->db->delete('categories');
		return true;
	}
	
	
	
	public function main_insert_category($data){
		$this->db->insert('main_categories', $data);
		return true;
	}
	
	   public function main_category($id){
		//$this->db->where('id',$id);
		$query = $this->db->get('main_categories');
		return $query->result();
	}
	public function main_category_edit($id){
		$this->db->where('id',$id);
		$query = $this->db->get('main_categories');
		return $query->row();
	}

    
        
        public function update_main_category($data, $id){
		$this->db->where('id', $id);
		$this->db->update('main_categories', $data);
		return true;
	}
        
        
        
        public function main_cat_delete($id){
		$this->db->where('id', $id);
		$this->db->delete('main_categories');
		return true;
	}
    
}