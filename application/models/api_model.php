<?php
class Api_model extends CI_Model{
	
	public function get_products($maincatid,$catid,$subcatid,$modelid,$brandid){
		
		$this->db->select('products.product_name,products.product_price,products.product_description,products.product_gallery,products.product_image,categories.name as categoery_name,sub_categories.name as sub_categories_name,main_categories.name as main_categories_name,brand.name as brand_name,model.name as model_name');
		
			$this->db->from('products');
			$this->db->join('main_categories', 'main_categories.id=products.main_categories', 'left');
			$this->db->join('categories', 'categories.id=products.category_id', 'left');
			$this->db->join('sub_categories', 'sub_categories.id=products.subcategory_id', 'left');
			$this->db->join('model', 'model.id=products.model_id', 'left');
			$this->db->join('brand', 'brand.id=products.brand_id', 'left');
		
		if(!empty($maincatid) && !empty($catid) && empty($subcatid) && empty($modelid) && empty($brandid)){
			
			$this->db->where('products.main_categories',$maincatid);
			$this->db->where('products.category_id',$catid);
		
		}if(!empty($maincatid) && !empty($catid) && !empty($subcatid) && empty($modelid) && empty($brandid)){
			
			$this->db->where('products.main_categories',$maincatid);
			$this->db->where('products.category_id',$catid);
			$this->db->where('products.subcategory_id',$subcatid);
			
		
		}if(!empty($maincatid) && !empty($catid) && !empty($subcatid) && !empty($modelid) && empty($brandid)){
			
		    $this->db->where('products.main_categories',$maincatid);
			$this->db->where('products.category_id',$catid);
			$this->db->where('products.subcategory_id',$subcatid);
			$this->db->where('products.model_id',$modelid);
		
		}if(!empty($maincatid) && !empty($catid) && !empty($subcatid) && !empty($modelid) && !empty($brandid)){
			
			$this->db->where('products.main_categories',$maincatid);
			$this->db->where('products.category_id',$catid);
			$this->db->where('products.subcategory_id',$subcatid);
			$this->db->where('products.model_id',$modelid);
			$this->db->where('products.brand_id',$brandid);
		}
			
		$query = $this->db->get();
		return $query->result();
	}
	
	
	
	public function get_main_categories($id){
		
		$this->db->select('categories.name as categoery_name');
		$this->db->from('products');
		$this->db->join('categories', 'categories.id=products.category_id', 'left');
        
		$this->db->group_by('products.category_id'); 
		$this->db->where('products.main_categories',$id);
		//$this->db->group_by('products.category_id');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_mainsub_categories($id){
		
		$this->db->select('sub_categories.name as sub_categoery_name');
		$this->db->from('products');
		$this->db->join('sub_categories', 'sub_categories.id=products.subcategory_id', 'left');
        
		$this->db->group_by('sub_categories.name'); 
		$this->db->where('products.main_categories',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_mainbrand_categories($id){
		
		$this->db->select('brand.name as brand_name');
		$this->db->from('products');
		$this->db->join('brand', 'brand.id=products.brand_id', 'left');
		$this->db->group_by('brand.name'); 
		$this->db->where('products.main_categories',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_mainmodel_categories($id){
		
		$this->db->select('model.name as model_name');
		$this->db->from('products');
		$this->db->join('model', 'model.id=products.model_id', 'left');
		$this->db->group_by('model.name'); 
		$this->db->where('products.main_categories',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_mainCategoryList(){
		
		$this->db->select('id,name');
		$this->db->from('main_categories');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	 public function get_filtered_products($id=''){
		 
		$this->db->select('a.*, b.name as category_name, c.first_name, c.last_name, d.name as sub_category_name, e.name as main_category_name');
		$this->db->from('products as a');
		$this->db->join('categories AS b', 'b.id = a.category_id','left');
		
			$this->db->join('sub_categories AS d', 'd.id = a.subcategory_id','left');
			$this->db->join('main_categories AS e', 'e.id = a.main_categories','left');
			//$this->db->join('users AS c', 'c.id = a.user_id','left');
		    //$this->db->like('product_name', $keywords);
               // $this->db->where('e.id', $id);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_categories(){
		$this->db->select('id,name,created');
		$this->db->from('categories');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_subcategories(){
		$this->db->select('*');
		$this->db->from('sub_categories');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_model(){
		$this->db->select('id,name,created');
		$this->db->from('model');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_brand(){
		$this->db->select('id,name,created');
		$this->db->from('brand');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_categoryByMaincategoryId($id){
		$this->db->select('categories.id,categories.name as category_name');
        $this->db->from('products');
		$this->db->join('categories', 'categories.id=products.category_id', 'left');
		$this->db->where('products.main_categories',$id);
		$this->db->group_by('products.category_id');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_subcategoryBycategoryId($maincat_id,$catid){
		
		$this->db->select('sub_categories.id,sub_categories.name as subcategory_name');
        $this->db->from('sub_categories');
		//$this->db->join('categories', 'categories.id=products.category_id', 'left');
		$this->db->join('sub_categories', 'sub_categories.id=products.subcategory_id','left');
		$this->db->where('products.category_id',$catid);
		//$this->db->where('products.main_categories',$maincat_id);
		$this->db->group_by('products.category_id');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_modelBysubcategoryId($maincat_id,$catid,$subcatid){
		
		$this->db->select('model.id,model.name as model_name');
        $this->db->from('products');
		$this->db->join('model', 'model.id=products.model_id');
		//$this->db->where('products.main_categories',$maincat_id);
		//$this->db->where('products.category_id',$catid);
		$this->db->where('products.subcategory_id',$subcatid);
		$this->db->group_by('products.model_id');
		$query = $this->db->get();
		return $query->result();
	}
	public function get_brandBymodelId($maincat_id,$catid,$subcatid,$modelid){
		
		$this->db->select('brand.id,brand.name as brand_name');
        $this->db->from('products');
		$this->db->join('brand', 'brand.id=products.brand_id');
		//$this->db->where('products.main_categories',$maincat_id);
		//$this->db->where('products.category_id',$catid);
		//$this->db->where('products.subcategory_id',$subcatid);
		$this->db->where('products.model_id',$modelid);
		$query = $this->db->get();
		return $query->result();
	}
	public function insert_usersregister($data){
		return $this->db->insert('users',$data);
	}
	
	public function logincheck($email,$password){
		
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$query = $this->db->get('users');
		return $query->row_array(); 
		
	}
	
}