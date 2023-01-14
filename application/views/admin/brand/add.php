<?php $this->load->view('admin/header');?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Brand
            <small>Add Brand</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active" ><a href="<?php echo base_url(); ?>index.php/admin/brand">Brand</a></li>
            <li  class="active" >Add Brand</li>
          </ol>
        </section>
<div class="box box-primary">
        <!-- Main content -->
        <section class="content">
  
           <form method="post" action="<?php echo base_url(); ?>index.php/admin/brand/add" enctype="multipart/form-data">
				  <div class="row">
				  <div class="col-md-6">
				  </div>
					<div class="col-md-6">
						<div class="btn-group pull-right">
							<input type="submit" name="submit" class="btn btn-default" value="Save" />
							<a href="<?php echo base_url(); ?>index.php/admin/brand" class="btn btn-default">Close</a>
					</div>
				  </div>
				</div><!-- /.row -->
				
					<div class="row">
						
						<div class="col-lg-12">
							<div class="form-group">
								<label> Category Name</label>
								<select name="category" id="category_id" class="form-control" required="required">
								 <option value="">Select Category</option>
									<?php foreach($category	as $val){ ?>	
									 <option value="<?php echo $val->id;?> "><?php echo $val->name;?> </option>
									<?php } ?>
							</select>
							</div>				

							</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>Sub Category Name</label>
								<select name="sub_category" id="sub_category_id" class="form-control" required="required">
								 <option value="">Select Category</option>
															 
							</select>
							</div>				

							</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>Model Name</label>
								<select name="model" id="model_id" class="form-control" required="required">
								 <option value="">Select Model</option>
															 
							</select>
							</div>				
                        </div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>Brand Name</label>
								<input class="form-control" type="text" name="name" placeholder="Enter Brand Name" />
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
		//alert(sub_category_id);
       
        
        $.ajax({
            url:"<?php echo base_url();?>index.php/admin/brand/get_model",
            data:{sub_category_id:sub_category_id},
            type: 'post',
            success:function(result){
				
                 $("#model_id").html(result);
        }});
    }); 
 </script>

     <?php $this->load->view('admin/footer');?>
