<?php 
class brand extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Brand_model');
		//Access Control
		if(!$this->session->userdata('logged_in')){
			redirect('index.php/admin/authenticate/login');
		}
	}
	
	/*
	 * Categories Main Index
	 */
	public function index(){
		//Get Categories
		//echo 'sss';exit;
		$data['brand'] = $this->Brand_model->get_brand('id', 'DESC');
		$data['userdata'] = $this->session->all_userdata();
                $data['subscriptions'] = $this->Subscription_model->get_all_subscriptions();
		//Views
        $data['main_content'] = 'admin/brand/index';
        $this->load->view('admin/brand/index', $data);
	}
        
        public function add(){
            $data['category'] = $this->Brand_model->get_categories();
			$data['userdata'] = $this->session->all_userdata();
           
			
			if(isset($_POST['submit'])){
			$data = array(
					'name'         => $this->input->post('name'),
				'category_id'         => $this->input->post('category'),
				'subcategory_id'         => $this->input->post('sub_category'),
				'model_id'         => $this->input->post('model')
			);
			//print_r($data);exit;	
			//Categories Table Insert
			$this->Brand_model->insert_brand($data);
			$this->session->set_flashdata('brand_saved', 'Your Brand has been saved');
			redirect('index.php/admin/brand');
			}	
			
			$data['main_content'] = 'admin/brand/add';
			$this->load->view('admin/brand/add', $data);
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
            $data['category'] = $this->Brand_model->get_categories();
			$data['subcategory'] = $this->Brand_model->get_subcategory();
			$data['model'] = $this->Brand_model->get_modelby();
		   $this->form_validation->set_rules('name','Name','trim|required|min_length[4]|xss_clean');
               

		if($this->form_validation->run() == FALSE){
			$data['brand'] = $this->Brand_model->get_brands($id);
			
			//Views
			$data['main_content'] = 'admin/brand/edit';
			$this->load->view('admin/brand/edit', $data);
		} else {
                    
			$data = array(
					'name'         => $this->input->post('name'),
				'category_id'         => $this->input->post('category'),
				'subcategory_id'         => $this->input->post('sub_category'),
				'model_id'         => $this->input->post('model')
                                       
			);
	        
			//Articles Table Insert
			$this->Brand_model->update_brand($data, $id);
	
			//Create Message
			$this->session->set_flashdata('brand_saved', 'Your Brand has been saved');
	
			//Redirect to pages
			redirect('index.php/admin/brand');
              }
		
	}
        public function delete($id){
		$this->session->set_flashdata('brand_deleted', 'Your Brand has been deleted');
	     redirect('index.php/admin/brand');
	   }
	 public function get_subcategories($id=''){
		$cat_id = $this->input->post('category_id');
		$data['sub_category'] = $this->Brand_model->get_sub_categories($cat_id);
		$this->load->view('admin/ajax_subcategory',$data);
	 }
	public function get_model($id=''){
		$sub_cat_id = $this->input->post('sub_category_id');
		$data['model'] = $this->Brand_model->get_model($sub_cat_id);
		$this->load->view('admin/ajax_model',$data);
	 }
	public function get_brand($id=''){
		$modelid = $this->input->post('modelid');
		$data['brand'] = $this->Brand_model->get_modelbrandbyid($modelid);
		$this->load->view('admin/ajax_brand',$data);
	 }	

	
}