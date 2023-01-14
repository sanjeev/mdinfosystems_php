<?php $this->load->view('admin/header');?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Products
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active" >Site Data</li>
            <li  class="active" >Products</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
             <!--Display Messages-->
 <?php if($this->session->flashdata('product_saved')) : ?> 
 	<?php echo '<p class="alert alert-success">' .$this->session->flashdata('product_saved') . '</p>'; ?>
 <?php endif; ?>

 <?php if($this->session->flashdata('product_deleted')) : ?> 
 	<?php echo '<p class="alert alert-success">' .$this->session->flashdata('product_deleted') . '</p>'; ?>
 <?php endif; ?>
             
                         <!--Display form validation errors-->
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger">'); ?>
 <?php if($this->session->flashdata('image_error')) : ?> 
 	<?php echo  '<p class="alert alert-danger alert-dismissable">'. 'error : '.$this->session->flashdata('image_error') . '</p>'; ?>
 <?php endif; ?>
            <a href="<?php echo base_url(); ?>index.php/admin/products_admin/add"><button  class="btn btn-block btn-primary btn-lg">Add Product</button></a>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Searches Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                 
                         
                    <table id="example1" class="table table-bordered table-striped">
                     <thead>
                   
                      <tr>
						 <th>Images </th>
						 <th>Main Category </th>
                       
                        <th>Category</th>
                       <th>Sub Category</th>
                        <th>Price</th>
                      
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                       
                         <?php foreach($products as $product) { ?>
                      <tr>
						   <td><img src="<?php echo base_url();?>assets/images/<?php echo $product->product_image; ?>" style="width:60px" thumbnail="product" ></td>
						   <td><?php echo $product->main_category_name; ?></td>
                         
                        <td><?php echo $product->category_name; ?></td>
                       <td><?php echo $product->sub_category_name; ?></td>
                        <td>₹ <?php echo $product->product_price;?></td>
                        
                         
                        <td>
                          
                            <div class="btn-group">
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url(); ?>index.php/admin/products_admin/edit/<?php echo $product->id; ?>">Edit</a></li>
                        <li><a onclick="return confirm('Are you sure?')" href="<?php echo base_url(); ?>index.php/admin/products_admin/delete/<?php echo $product->id; ?>">Delete</a></li>
                      </ul>
                         
                     
                    </div>
                          
                        </td>
                     
                      </tr>
                <?php }; ?>
                      
                    </tbody>
                    
                 
                  </table>
                          
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     <?php $this->load->view('admin/footer');?>
