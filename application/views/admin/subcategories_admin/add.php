<?php $this->load->view('admin/header');?>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sub-Categories
            <small>Add Sub-Category</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active" ><a href="<?php echo base_url(); ?>index.php/admin/subcategories_admin">Sub-Categories</a></li>
            <li  class="active" >Add Category</li>
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
           <form method="post" action="" enctype="multipart/form-data">
				  <div class="row">
				  <div class="col-md-6">
				  </div>
					<div class="col-md-6">
						<div class="btn-group pull-right">
							<input type="submit" name="submit" class="btn btn-default" value="Save" />
							<a href="<?php echo base_url(); ?>index.php/admin/subcategories_admin" class="btn btn-default">Close</a>
					</div>
				  </div>
				</div><!-- /.row -->
                                    
                                <div class="form-group">
							<label>Category</label>
                                                        
							<select name="category"  class="form-control" required = "required">
								 <option value="" required>Select Category</option>
								 <?php foreach($categories as $category) : ?>
								 	<option value="<?php echo $category->id; ?>" required = "required"><?php echo $category->name; ?></option>
								 <?php endforeach; ?>       
							</select>
						</div>
                                
                                
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Sub-Category Name</label>
								<input class="form-control" type="text" name="name" placeholder="Enter Sub-Category Name" />
							</div>				

							</div>
					</div><!-- /.row -->
                                      
                                        
			</form>
        </section><!-- /.content -->
</div>
      </div><!-- /.content-wrapper -->

    <?php $this->load->view('admin/footer');?>
