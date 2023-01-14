<?php 
class model extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('model_model');
		//Access Control
		if(!$this->session->userdata('logged_in')){
			redirect('index.php/admin/authenticate/login');
		}
	}
	
	/*
	 * Categories Main Index
	 */
	public function index(){
		
		//echo 'sss';exit;
		
		$data['model'] = $this->model_model->get_model('id', 'DESC');
		$data['userdata'] = $this->session->all_userdata();
                $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		//Views
        $data['main_content'] = 'admin/model/index';
        $this->load->view('admin/model/index', $data);
	}
        
        public function add(){
		  
           $data['userdata'] = $this->session->all_userdata();
           $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		  if(isset($_POST['submit'])){
			
			$data = array(
					'name'         => $this->input->post('name'),
				'category_id'         => $this->input->post('category'),
				'subcategory_id'         => $this->input->post('sub_category')
			);
				
			//Categories Table Insert
			$this->model_model->insert_model($data);
			 $this->session->set_flashdata('model_saved', 'Your model has been saved');
			//Redirect to pages
			redirect('index.php/admin/model');	
		  }
		   $data['main_content'] = 'admin/model/add';
		  $data['categories'] = $this->model_model->get_categories();
			//print_r( $data['categories']);exit;
		   $this->load->view('admin/model/add', $data);
            
        
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
			 $data['category'] = $this->model_model->get_categories();
			 $data['subcategory'] = $this->model_model->get_subcategories();
               
		$this->form_validation->set_rules('name','Name','trim|required|min_length[4]|xss_clean');
               

		if($this->form_validation->run() == FALSE){
			$data['model'] = $this->model_model->get_models($id);
			//print_r($data['model']);exit;
			//Views
			$data['main_content'] = 'admin/model/edit';
			$this->load->view('admin/model/edit', $data);
		} else {
                   
			//Create Data Array
			$data = array(
					'name'         => $this->input->post('name')
			);
	
			//Articles Table Insert
			$this->model_model->update_model($data, $id);
	
			//Create Message
			$this->session->set_flashdata('model_saved', 'Your model has been saved');
	
			//Redirect to pages
			redirect('index.php/admin/model');
                     
		}
	}
        public function delete($id){
		$this->model_model->delete_model($id);
        

		$this->session->set_flashdata('model_deleted', 'Your model has been deleted');
	
		//Redirect to articles
		redirect('index.php/admin/model');
	}
	 public function get_subcategories($id=''){
		$cat_id = $this->input->post('category_id');
		 // print_r($cat_id);exit;
		$data['sub_category'] = $this->model_model->get_sub_categories($cat_id);
		
		$this->load->view('admin/ajax_subcategory',$data);
		 
	 }
	
	
}