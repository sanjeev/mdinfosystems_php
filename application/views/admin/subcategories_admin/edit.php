<?php $this->load->view('admin/header');?>
      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sub-Categories
            <small>Add Sub-Categories</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active" ><a href="<?php echo base_url(); ?>index.php/admin/subcategories_admin">Sub-Categories</a></li>
            <li  class="active" >Add Sub-Category</li>
          </ol>
        </section>
<div class="box box-primary">
        <!-- Main content -->
        <section class="content">

           <form method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/admin/subcategories_admin/edit/<?php echo $subcategory->id; ?>">
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
							<select name="category" class="form-control">
								 <option value="0">Select Category</option>
								 <?php foreach($categories as $category) { ?>
								 	
								 	<option value="<?php echo $category->id; ?>" <?php if($category->id == $subcategory->category_id) { echo 'selected="selected"';} ?>><?php echo $category->name; ?></option>
								 <?php }; ?>       
							</select>
						</div>
                                <div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label>Sub-Category Name</label>
								<input class="form-control" type="text" name="name" value="<?php echo $subcategory->name; ?>" />
							</div>				
						</div>
					</div>
</form>
        </section><!-- /.content -->
</div>
      </div><!-- /.content-wrapper -->

   <?php $this->load->view('admin/footer');?>
