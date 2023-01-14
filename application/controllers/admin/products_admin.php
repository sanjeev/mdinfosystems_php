<?php 
class products_admin extends MY_Controller{
	public function __construct(){
		parent::__construct();
		
		//Access Control
		if(!$this->session->userdata('logged_in')){
			redirect('index.php/admin/authenticate/login');
		}
               
	}

        public function index(){
		
			//Get Filtered Products
			 $data['products'] = $this->Product_model->get_filtered_products($this->input->post('keywords'),'id','DESC',10);
			//print_r($data['products']);exit;
			 //$data['products'] = $this->Product_model->get_products('id','DESC',10);
		//Get Categories
		$data['categories'] = $this->Product_model->get_categories('id','DESC',5);
		
		//Get Admins
		$data['admins'] = $this->Admins_model->get_admins('id','DESC',5);
		$data['userdata'] = $this->session->all_userdata();
                $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		//View
		$data['main_content'] = 'admin/Products_admin/index';
		$this->load->view('admin/products_admin/index',$data);
	}
	
	/*
	 * Add Article
	 */
	public function add(){
            $data['userdata'] = $this->session->all_userdata();
            $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
           // $this->imagename = "unknown";
            
		//Validation Rules
		//$this->form_validation->set_rules('product_name','Product_name','trim|required|min_length[4]|xss_clean|is_unique[products.product_name]');
		$this->form_validation->set_rules('product_description','Product_description','trim|required|xss_clean');
		$this->form_validation->set_rules('category','Category','required');
		
		$data['categories'] = $this->Product_model->get_categories();
		$data['main_categories'] = $this->Product_model->get_main_categories();
		$data['brand'] = $this->Product_model->get_brand();
		$data['model'] = $this->Product_model->get_model();
        $data['subcategories'] = $this->Subcategory_model->get_subcategories('id', 'DESC');
		$data['admins'] = $this->Admins_model->get_admins();
                 //image upload
                       $myimagename = $this->do_upload();
		$this->session->set_flashdata('product_name', $this->input->post('product_name'));
                $this->session->set_flashdata('product_image', $this->input->post($myimagename));
		$this->session->set_flashdata('product_price', $this->input->post('product_price'));
                $this->session->set_flashdata('brand', $this->input->post('brand'));
                $this->session->set_flashdata('model', $this->input->post('model'));
                $this->session->set_flashdata('product_description', $this->input->post('product_description'));
                $this->session->set_flashdata('category', $this->input->post('category'));
                //$this->session->set_flashdata('payment_mode', $this->input->post('payment_mode'));
                //$this->session->set_flashdata('admin', $this->input->post('admin'));
                
                if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/products_admin/add';
			$this->load->view('admin/products_admin/add', $data);
		} else {
                       if($myimagename[0]=='<')
                       {
                           $temp  = substr($myimagename, 3);
                       //Create Message
			$this->session->set_flashdata('image_error', $temp);
			
                        //Redirect to pages
			redirect('index.php/admin/products_admin/add');
                       }
                       else
                       {
            $data = array();
           // Count total files
			$countfiles = count($_FILES['files']['name']);
 			// Looping all files
			for($i=0;$i<$countfiles;$i++){
			   	
			   	if(!empty($_FILES['files']['name'][$i])){
					
					// Define new $_FILES array - $_FILES['file']
			   		$_FILES['file']['name'] = $_FILES['files']['name'][$i];
			   		$_FILES['file']['type'] = $_FILES['files']['type'][$i];
			   		$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
			   		$_FILES['file']['error'] = $_FILES['files']['error'][$i];
			   		$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					// Set preference
					$config['upload_path'] = './assets/images';	
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size']    = '5000';	// max_size in kb
					$config['file_name'] = $_FILES['files']['name'][$i];
						
					//Load upload library
					$this->load->library('upload',$config);			
					
					// File upload
					if($this->upload->do_upload('file')){
						// Get data about the file
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						// Initialize array
						$data['filenames'][] = $filename;
					}
					
				}
				
                array_push($data, $data['filenames']);  
			}    
				
					   $json = json_encode($data); 
  
				//print_r($json);exit;		   
						   
			$data = array(
					//'product_name' => $this->input->post('product_name'),
                      'product_price' => $this->input->post('product_price'),
                      'brand_id' => $this->input->post('brand'),
                      'model_id' => $this->input->post('model'),
                      'product_description' => $this->input->post('product_description'),
                      'category_id'   => $this->input->post('category'),
                      'subcategory_id'   => $this->input->post('subcategory'),
					  'main_categories'   =>$this->input->post('main_categories'),
                      'slug_url'         => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('product_name')))),
                      'product_image'   	=> $myimagename,
				      'product_gallery'                    => $json
                                    );
                    
                          
            $res = $this->Product_model->product_exit($this->input->post('main_categories'),$this->input->post('category'),$this->input->post('subcategory'),$this->input->post('model'),$this->input->post('brand'));
			//print_r($res);exit;	
			if(!empty($res)){
			$this->session->set_flashdata('product_exit', 'Your product already exits');
				redirect('index.php/admin/products_admin/add');
			}else{
			$this->Product_model->insert_product($data);
            
			$this->session->set_flashdata('product_saved', 'Your product has been saved');
			
			redirect('index.php/admin/products_admin/add');
			}   
			
		   }
		}
	}
	
        function do_upload()
	{
		$config['upload_path'] = './assets/images';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size']	= '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			//$error = array('error' => $this->upload->display_errors());
                        $error = array('error' => $this->upload->display_errors());
        // $this->session->set_flashdata('error',);
			//$this->load->view('admin/products_admin/add', $error);
                        return $error['error'];
		}
		else
		{
			$data = $this->upload->data();

			//$this->load->view('upload_success', $data);
                        return $data['raw_name'].$data['file_ext'];
		}
	}
        
        public function edit($id){
            $data['userdata'] = $this->session->all_userdata();
                $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		//Validation Rules
		//$this->form_validation->set_rules('product_name','Product_name','trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('product_description','Product_description','trim|required|xss_clean');
		$this->form_validation->set_rules('category','Category','required');
                $this->form_validation->set_rules('category','Category','required');
               // $this->form_validation->set_rules('userfile','Userfile','required');
           $data['product'] = $this->Product_model->get_products_byid($id); 
			//print_r($data['product']);exit;
		$data['categories'] = $this->Product_model->get_categories();
		$data['subcategories'] = $this->Product_model->get_subcategories($data['product']->category_id);
		$data['brand'] = $this->Product_model->get_brandedit($data['product']->model_id);
		$data['model'] = $this->Product_model->get_modeledit($data['product']->subcategory_id);	
		$data['admins'] = $this->Admins_model->get_admins();
		$data['main_categories'] = $this->Product_model->get_main_categories();
		
                
               
		if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/products_admin/edit';
			$this->load->view('admin/products_admin/edit', $data);
		} else {
                    
                        if($this->input->post('imagechoice')=="Use current image")
                        {
                            if($this->Product_model->subcategory_exists($this->input->post('category')))
                           {
			//Create Articles Data Array
			$data = array(
					//'product_name' => $this->input->post('product_name'),
                                        'product_price' => $this->input->post('product_price'),
                                        'brand_id' => $this->input->post('brand'),
                                        'model_id' => $this->input->post('model'),
                                        'product_description' => $this->input->post('product_description'),
                                        'category_id'   => $this->Subcategory_model->get_subcategory($this->input->post('category'))->category_id,
                                        'subcategory_id'   => $this->input->post('category')
                                       
                                    );
                           }
                           else
                           {
                               $data = array(
					//'product_name' => $this->input->post('product_name'),
                                        'product_price' => $this->input->post('product_price'),
                                        'brand_id' => $this->input->post('brand'),
                                        'model_id' => $this->input->post('model'),
                                        'product_description' => $this->input->post('product_description'),
                                        'category_id'   => $this->input->post('category'),
                                        'subcategory_id'   => 0
                                        
                                    );
                           }
                        }
                        else
                        {
                             //image upload
                       $myimagename = $this->do_upload();
                       if($myimagename[0]=='<')
                       {
                           $temp  = substr($myimagename, 3);
                       //Create Message
			$this->session->set_flashdata('image_error', $temp);
			
                        //Redirect to pages
			redirect('index.php/admin/products_admin');
                       }
                            else
                            {
                                if($this->Product_model->subcategory_exists($this->input->post('category')))
                           {
			//Create Articles Data Array
			$data = array(
					'product_name' => $this->input->post('product_name'),
                                        'product_price' => $this->input->post('product_price'),
                                         'brand_id' => $this->input->post('brand'),
                                        'model_id' => $this->input->post('model'),
                                        'product_description' => $this->input->post('product_description'),
                                        'category_id'   => $this->Subcategory_model->get_subcategory($this->input->post('category'))->category_id,
                                        'subcategory_id'   => $this->input->post('category'),
                                       'product_image'   	=> $myimagename
                                    );
                           }
                           else
                           {
                               $data = array(
					'product_name' => $this->input->post('product_name'),
                                        'product_price' => $this->input->post('product_price'),
                                        'brand_id' => $this->input->post('brand'),
                                        'model_id' => $this->input->post('model'),
                                        'product_description' => $this->input->post('product_description'),
                                        'category_id'   => $this->input->post('category'),
                                        'subcategory_id'   => 0,
                                        'product_image'   	=> $myimagename
                                    );
                           }

                            }
                        }
                       //Products Table Updates
			$this->Product_model->update_products($data, $id);
			
			//Create Message
			$this->session->set_flashdata('product_saved', 'Your product has been saved');
			
			//Redirect to pages
			redirect('index.php/admin/products_admin');
		}
                
	}
        
        public function delete($id){
            $data['userdata'] = $this->session->all_userdata();
                $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		$this->Product_model->delete_products($id);
		 
		//Create Message
		$this->session->set_flashdata('product_deleted', 'Your product has been deleted');
	
		//Redirect to articles
		redirect('index.php/admin/products_admin');
	}
        
        public function deletechecked(){
            $data['userdata'] = $this->session->all_userdata();
                $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
                
                $checked_messages = $this->input->post('businessType'); //selected messages
               $this->Product_model->delete_allchecked($checked_messages);

		//Create Message
		$this->session->set_flashdata('product_deleted', 'Your product has been deleted');
                //$this->session->set_flashdata('product_deleted',  var_dump($datachecked));
                //
		//Redirect to articles
		redirect('index.php/admin/products_admin');
	}
	
	
	
	
	//=============multiple===============//
	public function multipleadd(){
           if($this->input->post('upload') != NULL ){
			$data = array();

			// Count total files
			$countfiles = count($_FILES['files']['name']);
 			
			// Looping all files
			for($i=0;$i<$countfiles;$i++){
			   	
			   	if(!empty($_FILES['files']['name'][$i])){
					
					// Define new $_FILES array - $_FILES['file']
			   		$_FILES['file']['name'] = $_FILES['files']['name'][$i];
			   		$_FILES['file']['type'] = $_FILES['files']['type'][$i];
			   		$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
			   		$_FILES['file']['error'] = $_FILES['files']['error'][$i];
			   		$_FILES['file']['size'] = $_FILES['files']['size'][$i];

					// Set preference
					$config['upload_path'] = './assets/images';	
					$config['allowed_types'] = 'jpg|jpeg|png|gif';
					$config['max_size']    = '5000';	// max_size in kb
					$config['file_name'] = $_FILES['files']['name'][$i];
						
					//Load upload library
					$this->load->library('upload',$config);			
					
					// File upload
					if($this->upload->do_upload('file')){
						// Get data about the file
						$uploadData = $this->upload->data();
						$filename = $uploadData['file_name'];

						// Initialize array
						$data['filenames'][] = $filename;
					}
					$data = array('product_images'=>$filename);
				    //print_r($data);exit;
			        $this->db->insert('product_gallery',$data);
				}
				
			}
						
			 $data['userdata'] = $this->session->all_userdata();
			 $this->load->view('admin/products_admin/multipleadd',$data);
	        }else{
			 $data['userdata'] = $this->session->all_userdata();
             $this->load->view('admin/products_admin/multipleadd',$data);
		   }
		
	}
			        
	     
}