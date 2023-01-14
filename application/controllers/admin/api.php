<?php 
class api extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('api_model');
		header('Content-Type: application/json');
		header('Access-Control-Allow-Methods: *');
		header('Access-Control-Allow-Origin: *');

		}
	
	
	
		public function get_products(){   
    	     $maincatid = $_GET['maincatid']; 
			 $catid = $_GET['catid']; 
			 $subcatid = $_GET['subcatid']; 
			 $modelid = $_GET['modelid']; 
			 $brandid = $_GET['brandid']; 
    	     $data['product'] = $this->api_model->get_products($maincatid,$catid,$subcatid,$modelid,$brandid);
		     echo json_encode($data);	
            
    	}
	
	public function addtocart(){   
    	    
    	$method = $_SERVER['REQUEST_METHOD'];
		$response = array();
		if($method != 'POST'){
			 $response = array('status' => 'Fail', 'message' => 'Bad request.');
		} else {
					 $params = json_decode(file_get_contents('php://input'), TRUE);
					 if(!empty($params))   
					 {
						 $product_id = $params['product_id'];
						 $count = $params['count'];
						 $user_id = $params['user_id'];
						 $cart_array =array('product_id'=>$product_id,'count'=>$count,'user_id'=>$user_id);
						 $user_valid= $this->db->get_where('users',array('id'=>$user_id))->row();
						 if(!empty($user_valid)){
							 $cartdata_valid= $this->db->get_where('cart',array('user_id'=>$user_id))->row();
							      if(empty($cartdata_valid)){
						          $cartdata = $this->db->insert('cart',$cart_array);
								  }else{
								   $updatecart_array =array('count'=>($cartdata_valid->count)+1); 
								   $cartdata = $this->db->update('cart',$updatecart_array); 
								  }	  
							 
						 }
						 
						 if(empty($cartdata))
						 {
							 $response = array('Status' => 'Fail', 'message' => 'User id Not Valid ');
						 }
						 else
						 {
							  $response = array('Status' => 'Success', 'message' => ' Data Insert Successfully','userdata' =>$cartdata);
						 }
					 }
					 else
					 {
						 $response = array('Status' => 'Fail', 'message' => 'User id Not Valid'); 
					 }
	          }
			  echo json_encode($response);	
            
    	}
	
	
	
	
	public function register_user(){   
    	    
    	$method = $_SERVER['REQUEST_METHOD'];
		$response = array();
		if($method != 'POST'){
			 $response = array('status' => 'Fail', 'message' => 'Bad request.');
		} else {
					 $params = json_decode(file_get_contents('php://input'), TRUE);
					 if(!empty($params))   
					 {
						 $username = $params['username'];
						 $password = $params['password'];
						 $cpassword = $params['cpassword'];
						 $email = $params['email'];
						 $mobile = $params['mobile'];
						 $data_user = array(
						 'username' =>$username,
						 'password' =>$password,
						 'email' =>$email,
						 'mobile' =>$mobile
                           );
						 $mail_valid= $this->db->get_where('users',array('email'=>$email))->row();
						 if(empty($mail_valid)){
						  $data_product = $this->api_model->insert_usersregister($data_user);
						 }
						 
						 if(empty($data_product))
						 {
							 $response = array('Status' => 'Fail', 'message' => 'User Email Allready Registered ');
						 }
						 else
						 {
							  $response = array('Status' => 'Success', 'message' => ' Registration Successful');
						 }
					 }
					 else
					 {
						 $response = array('Status' => 'Fail', 'message' => 'User Registration Failed'); 
					 }
	          }
			  echo json_encode($response);	
            
    	}
	
	
	public function login(){   
    	    
    	$method = $_SERVER['REQUEST_METHOD'];
		$response = array();
		if($method != 'POST'){
			 $response = array('status' => 'Fail', 'message' => 'Bad request.');
		} else {
					 $params = json_decode(file_get_contents('php://input'), TRUE);
					 if(!empty($params))   
					 {
						 $email = $params['email'];
						 $password = $params['password'];
						 
						 $login_data = $this->api_model->logincheck($email,$password);
						 $token = array('token' => sha1(uniqid($email,TRUE)));
						 $userdata = array_merge($login_data,$token);
						 $this->session->set_userdata('userdata',$userdata);
						 
						 if(empty($login_data))
						 {
							 $response = array('Status' => 'Fail', 'message' => 'User Login Failed ');
						 }
						 else
						 {
							  $response = array('Status' => 'Success', 'message' => ' Login Successful','userdata' =>$userdata);
						 }
					 }
					 else
					 {
						 $response = array('Status' => 'Fail', 'message' => 'User Login Failed'); 
					 }
	          }
			  echo json_encode($response);	
            
    	}
	
	
	public function mainCategoryList(){ 
		
		$data['mainCategoryList'] = $this->api_model->get_mainCategoryList();
		echo json_encode($data);	
    	}
	
	
	
	public function get_model(){
    	    
			 $data['products'] = $this->api_model->get_model();
			 echo json_encode($data);
			 
    	}
	public function get_categories(){
    	     $data['products'] = $this->api_model->get_categories();
			 echo json_encode($data);
			 
    	}
	public function get_subcategories(){
    	     $data['products'] = $this->api_model->get_subcategories();
			 echo json_encode($data);
			 
    	}
	public function get_brand(){
    	     $data['products'] = $this->api_model->get_brand();
			 echo json_encode($data);
			 
    	}
	public function get_categoryByMaincategoryId(){
		     if(!empty($this->uri->segment(4)) && empty($_GET['catid']) && empty($maincat_id)){
				$maincat_id = $this->uri->segment(4);
		        $data['categories'] = $this->api_model->get_categoryByMaincategoryId($maincat_id);
			 }if(!empty($_GET['catid']) && !empty($this->uri->segment(4)) && empty($_GET['subcatid'])){
				 $catid = $_GET['catid'];
				 $maincat_id = $this->uri->segment(4);
				 $data['subcat'] = $this->api_model->get_subcategoryBycategoryId($maincat_id,$catid);
				
			 }if(!empty($_GET['subcatid']) && !empty($_GET['catid']) && !empty($this->uri->segment(4)) && empty($_GET['modelid'])){
				 $maincat_id = $this->uri->segment(4);
				 $subcatid = $_GET['subcatid'];
				 $catid = $_GET['catid'];
				 $data['model'] = $this->api_model->get_modelBysubcategoryId($maincat_id,$catid,$subcatid);
				 
			 }if(!empty($_GET['modelid']) && !empty($_GET['catid']) && !empty($this->uri->segment(4)) && !empty($_GET['subcatid'])){
				 $maincat_id = $this->uri->segment(4);
				 $subcatid = $_GET['subcatid'];
				 $catid = $_GET['catid'];
				 $modelid = $_GET['modelid'];
				 $data['brand'] = $this->api_model->get_brandBymodelId($maincat_id,$catid,$subcatid,$modelid); 
			 }
			 echo json_encode($data);
		      
			
			 
    	}
	
}