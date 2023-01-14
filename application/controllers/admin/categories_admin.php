<?php 
class categories_admin extends MY_Controller{
	public function __construct(){
		parent::__construct();
		
		//Access Control
		if(!$this->session->userdata('logged_in')){
			redirect('index.php/admin/authenticate/login');
		}
	}
	
	/*
	 * Categories Main Index
	 */
	public function index(){
		
		$data['categories'] = $this->Category_model->get_categories('id', 'DESC');
		$data['userdata'] = $this->session->all_userdata();
        $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		//Views
        $data['main_content'] = 'admin/categories_admin/index';
        $this->load->view('admin/categories_admin/index', $data);
	}
        
        public function add(){
            $data['userdata'] = $this->session->all_userdata();
                $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		//Validation Rules
		$this->form_validation->set_rules('name','Name','trim|required|min_length[4]|xss_clean|is_unique[categories.name]');
		
                if($this->form_validation->run() == FALSE){
			//Views
			$data['main_content'] = 'admin/categories_admin/add';
			$this->load->view('admin/categories_admin/add', $data);
		} else {
                   
			//Create Data Array
			$data = array(
					'name'         => $this->input->post('name'),
				    'slug_url'         => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('name'))))
			);
				
			//Categories Table Insert
			$this->Category_model->insert_category($data);
				
			//Create Message
			$this->session->set_flashdata('category_saved', 'Your category has been saved');
				
			//Redirect to pages
			redirect('index.php/admin/categories_admin');
                       
		}
	}
        function do_upload()
	{
		$config['upload_path'] = '../assets/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000';
		$config['max_width']  = '2000';
		$config['max_height']  = '2000';

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
           
		$this->form_validation->set_rules('name','Name','trim|required|min_length[4]|xss_clean');
          
		if($this->form_validation->run() == FALSE){
			$data['category'] = $this->Category_model->get_category($id);
			
			//Views
			$data['main_content'] = 'admin/categories_admin/edit';
			$this->load->view('admin/categories_admin/edit', $data);
		} else {
                  
			//Create Data Array
			$data = array(
					'name'         => $this->input->post('name'),
				    'slug_url'         => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('name'))))
			);
			$this->Category_model->update_category($data, $id);
	
			//Create Message
			$this->session->set_flashdata('category_saved', 'Your category has been saved');
	
			//Redirect to pages
			redirect('index.php/admin/categories_admin');
            }
	
	}
        public function delete($id){
		$this->Category_model->delete_category($id);
                $this->Subcategory_model->delete_subcategorywithcategory($id);
               $this->Product_model->delete_productsCategoryID($id);

		$this->session->set_flashdata('category_deleted', 'Your category has been deleted');
	
		//Redirect to articles
		redirect('index.php/admin/categories_admin');
	}
	
	
	public function main_category(){
		
		$data['main_categories'] = $this->Category_model->main_category('id', 'DESC');
		//print_r($data['main_categories']);exit;
		$data['userdata'] = $this->session->all_userdata();
        $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		//Views
        $data['main_content'] = 'admin/categories_admin/main_category';
        $this->load->view('admin/categories_admin/main_category', $data);
	}
        
        public function main_cat_add(){
            $data['userdata'] = $this->session->all_userdata();
            $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		    $this->form_validation->set_rules('name','Name','trim|required|min_length[4]|xss_clean|is_unique[main_categories.name]');
		    if($this->form_validation->run() == FALSE){
			
			$data['main_content'] = 'admin/categories_admin/main_cat_add';
			$this->load->view('admin/categories_admin/main_cat_add', $data);
		} else {
                   
			//Create Data Array
			$data = array(
					'name'         => $this->input->post('name'),
				    'slug_url'         => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('name'))))
			);
			
			$this->Category_model->main_insert_category($data);
			$this->session->set_flashdata('category_saved', 'Your category has been saved');
			redirect('index.php/admin/categories_admin/main_category');
                       
		}
	}
	  public function main_cat_delete($id){
		$this->Category_model->main_cat_delete($id);
        
        $this->session->set_flashdata('category_deleted', 'Your category has been deleted');
	
		redirect('index.php/admin/categories_admin/main_category');
	}
	           

	 public function main_cat_edit($id){
			
            $data['userdata'] = $this->session->all_userdata();
          
		$this->form_validation->set_rules('name','Name','trim|required|min_length[4]|xss_clean');
         
		if($this->form_validation->run() == FALSE){
			$data['category'] = $this->Category_model->main_category_edit($id);
			//print_r($data['category']);exit;
			
			$data['main_content'] = 'admin/categories_admin/main_cat_edit';
			$this->load->view('admin/categories_admin/main_cat_edit', $data);
		} else {
               
			//Create Data Array
			$data = array(
					'name'         => $this->input->post('name'),
				    'slug_url'         => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->input->post('name'))))
			);
	        //print_r($data);exit;
			$this->Category_model->update_main_category($data, $id);
	
			//Create Message
			$this->session->set_flashdata('category_saved', 'Your category has been saved');
	
			//Redirect to pages
			redirect('index.php/admin/categories_admin/main_category');
            }
	
	}
	
}