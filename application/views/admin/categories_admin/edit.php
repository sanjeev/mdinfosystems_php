<?php $this->load->view('admin/header');?>
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Categories
            <small>Add Category</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active" ><a href="<?php echo base_url(); ?>index.php/admin/categories_admin">Categories</a></li>
            <li  class="active" >Add Category</li>
          </ol>
        </section>
<div class="box box-primary">
        <!-- Main content -->
        <section class="content">

           <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/admin/categories_admin/edit/<?php echo $category->id; ?>">
				  <div class="row">
				  <div class="col-md-6">
				  </div>
					<div class="col-md-6">
						<div class="btn-group pull-right">
							<input type="submit" name="submit" class="btn btn-default" value="Save" />
							<a href="<?php echo base_url(); ?>index.php/admin/categories_admin" class="btn btn-default">Close</a>
					</div>
				  </div>
				</div><!-- /.row -->
				
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Category Name</label>
								<input class="form-control" type="text" name="name" value="<?php echo $category->name; ?>" />
							</div>				
						</div>
					</div><!-- /.row -->
                                        
                                     <!--   <div class="form-group">
							<label>Category Description</label>
							<textarea class="form-control" name="category_description" rows="10" required = "required"><?php echo $category->category_description; ?></textarea>
						</div>
                                        
                                        <div id="selectImage">
		<label>Category Image</label><br>
		<?php echo form_open_multipart('index.php/admin/categories_admin/edit');?> 
		<?php echo "<input type='file'  name='userfile' size='20' id='file' required = 'required'/>"; ?>
	</div>-->
</form>
        </section><!-- /.content -->
</div>
      </div><!-- /.content-wrapper -->

    <?php $this->load->view('admin/footer');?>
