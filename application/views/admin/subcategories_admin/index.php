<?php $this->load->view('admin/header');?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
                      <!--Display Messages-->
 <?php if($this->session->flashdata('category_saved')) : ?> 
 	<?php echo '<p class="alert alert-success">' .$this->session->flashdata('category_saved') . '</p>'; ?>
 <?php endif; ?>

 <?php if($this->session->flashdata('category_deleted')) : ?> 
 	<?php echo '<p class="alert alert-success">' .$this->session->flashdata('category_deleted') . '</p>'; ?>
 <?php endif; ?>
             
                         <!--Display form validation errors-->
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger">'); ?>
 <?php if($this->session->flashdata('image_error')) : ?> 
 	<?php echo  '<p class="alert alert-danger alert-dismissable">'. 'error : '.$this->session->flashdata('image_error') . '</p>'; ?>
 <?php endif; ?>
          <h1>
            Categories
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active" >Site Data</li>
            <li  class="active" >Sub-Categories</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!--changed-->
            <a href="<?php echo base_url(); ?>index.php/admin/subcategories_admin/add"><button class="btn btn-block btn-primary btn-lg">Add Sub-Category</button></a>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <!--changed-->
                  <h3 class="box-title">Sub-Categories Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form action="<?php echo base_url(); ?>index.php/admin/subcategories_admin/deletechecked" method="post"> 
                            <!--<input class="btn btn-danger btn-primary btn-lg" type="submit" name="submit" Value="Delete Selected Sub-Categories"/>-->
                    <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Categories Name</th>
                        <th>Sub-categories</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php foreach($subcategories as $category) : ?>
                      <tr>
                          <td><?php echo $this->Category_model->get_category($category->category_id)->name;?></td>
                          <td><?php echo $category->name;?></td>
                        
                        <td><div class="btn-group">
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url(); ?>index.php/admin/subcategories_admin/edit/<?php echo $category->id; ?>">Edit</a></li>
                        <li><a onclick="return confirm('Are you sure?')" href="<?php echo base_url(); ?>index.php/admin/subcategories_admin/delete/<?php echo $category->id; ?>">Delete</a></li>
                      </ul>
                         
                    </div></td>
                      </tr>
                <?php endforeach; ?>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Categories Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                    </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     <?php $this->load->view('admin/footer');?>
