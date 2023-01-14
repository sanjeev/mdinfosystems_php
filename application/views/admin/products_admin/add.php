<?php $this->load->view('admin/header');?>
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Products
            <small>Add Product</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active" ><a href="<?php echo base_url(); ?>index.php/admin/products_admin">Products</a></li>
            <li  class="active" >Add Product</li>
          </ol>
        </section>
<div class="box box-primary">
        <!-- Main content -->
        <section class="content">
                                   <!--Display form validation errors-->
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger">'); ?>
 <?php if($this->session->flashdata('image_error')) : ?> 
 	<?php echo  '<p class="alert alert-danger alert-dismissable">'. 'error : '.$this->session->flashdata('image_error') . '</p>'; ?>
 <?php endif; ?>
			 <?php if($this->session->flashdata('product_saved')) : ?> 
 	<?php echo  '<p class="alert alert-success alert-dismissable">'. 'success : '.$this->session->flashdata('product_saved') . '</p>'; ?>
 <?php endif; ?>
			<?php if($this->session->flashdata('product_exit')) : ?> 
 	<?php echo  '<p class="alert alert-danger alert-dismissable">'. 'error : '.$this->session->flashdata('product_exit') . '</p>'; ?>
 <?php endif; ?>
            <form method="post" action="<?php echo base_url(); ?>index.php/admin/products_admin/add" enctype="multipart/form-data">
			  <div class="row">
			  <div class="col-lg-6">
			  </div>
				<div class="col-lg-6">
					<div class="btn-group pull-right">
						<input type="submit" name="submit" class="btn btn-default" value="Save" />
						<a href="<?php echo base_url(); ?>index.php/admin/products_admin" class="btn btn-default">Close</a>
				</div>
			  </div>
			</div><!-- /.row -->
			
				<div class="row">
					<div class="col-md-12">
					 <label>Main Category</label>
						<select name="main_categories" class="form-control" required = "required">
							<option value="">Select Main Category</option>
							<?php foreach($main_categories as $category){ ?>
							 <option value="<?php echo $category['id'];?>" ><?php echo $category['name'];?></option>
						 <?php }?>
						</select>
						</div>
					<!--<div class="col-lg-12">
						<div class="form-group">
							<label>Product Name</label>
                             <input class="form-control" type="text" name="product_name" value="" placeholder="Enter Product Title" >
						</div>
                            </div> -->                   
                                                <div  class="col-md-12">
                                                    <label  class="block fg-label">Product Price</label>
                                                    <input  type="number" step="0.01" min="0" class="form-control" placeholder="Enter Product Price" name="product_price" value="" >
                                                    <p id ="product_price" class="fg-help red"></p>
                                                </div>
                                               
                   <div  class="col-md-12">                          
                                            <div id="selectImage">
		<label>Product Images</label><br>
		<?php echo form_open_multipart('index.php/admin/products_admin/add');?> 
		<?php echo "<input type='file'  name='userfile' size='20' id='file' required = 'required'/>"; ?>
	</div></div>
					
					<div class="col-md-12">                          
                 <div id="selectImage">
					<label>Product Gallery</label><br>
					
					<?php echo "<input type='file'  name='files[]' multiple='multiple' size='20' id='file' >"; ?>
				</div>
            </div>
        
                                          
						<div class="col-md-6">
							<label>Category</label>
                                                        
							<select name="category" class="form-control" id="category_id" required = "required">
							<option value="" required>Select Category</option>
							<?php foreach($categories as $value){  ?>
							  <option value="<?php echo $value->id;?>" required><?php echo $value->name;?></option>
								<?php } ?>
							</select>
						</div>
					<div class="col-md-6">
							<label>Sub Category</label>
                                                        
							<select name="subcategory" class="form-control" id="sub_category_id" required = "required">
								 <option value="" required>Select Sub Category</option>
								   
							</select>
						</div>
					
					 <div class="col-md-6">
					 <label>Model</label>
						<select name="model" class="form-control" id="modelid" required = "required">
							<option value="">Select Model</option>
							
						</select>
						</div>
					<div class="col-md-6">
					 <label>Brand</label>
						<select name="brand" class="form-control" id="brandid" required = "required">
							<option value="">Select Brand</option>
							
						</select>
						</div>
                                           
                                            
                <div  class="col-md-12">
                <div class="box-header">
                  <h3 class="box-title">Product Description</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body pad">
                  <form>
                    <textarea id="editor1" name="product_description"  required = "required" rows="10" cols="80">
                                     <?php echo $this->session->flashdata('product_description');?>
                    </textarea>
                  </form>
                </div>
                  </div>
               	
				</div><!-- /.row -->
            </form>
        </section><!-- /.content -->
</div>
      </div><!-- /.content-wrapper -->




<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
     
     $("#category_id").change(function(){
		var category_id=this.value;   
		//alert(category_id);
       
        
        $.ajax({
            url:"<?php echo base_url();?>index.php/admin/brand/get_subcategories",
            data:{category_id:category_id},
            type: 'post',
            success:function(result){
				
                 $("#sub_category_id").html(result);
        }});
    }); 
	  $("#sub_category_id").change(function(){
		var sub_category_id=this.value; 
		  //alert($("#category_id").find('option:selected').val());
		 $.ajax({
            url:"<?php echo base_url();?>index.php/admin/brand/get_model",
            data:{sub_category_id:sub_category_id},
            type: 'post',
            success:function(result){
				
                 $("#modelid").html(result);
        }});
    }); 
	
	 $("#modelid").change(function(){
		var modelid=this.value;   
		 $.ajax({
            url:"<?php echo base_url();?>index.php/admin/brand/get_brand",
            data:{modelid:modelid},
            type: 'post',
            success:function(result){
				
                 $("#brandid").html(result);
        }});
    }); 
 </script>


      <footer class="main-footer">
        <div class="pull-right hidden-xs">
           
        </div>
        <strong>Copyright &copy; 2022-2023 <a href="www.localhost/adminpanel">Admin</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>

          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <script src="https://code.jquery.com/jquery-2.1.4.js"></script>
<script src="<?php echo base_url(); ?>assets/css/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/css/dist/js/app.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/css/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/css/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/css/plugins/fastclick/fastclick.js"></script>
<script>
      $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="https://datatables.net/examples/resources/demo.js"></script>

<!-- CK Editor -->
    <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url(); ?>assets/css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>
  </body>
</html>
