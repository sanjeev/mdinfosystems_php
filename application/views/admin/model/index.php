<?php $this->load->view('admin/header');

?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
                      <!--Display Messages-->
 <?php if($this->session->flashdata('model_saved')) : ?> 
 	<?php echo '<p class="alert alert-success">' .$this->session->flashdata('model_saved') . '</p>'; ?>
 <?php endif; ?>

 <?php if($this->session->flashdata('model_deleted')) : ?> 
 	<?php echo '<p class="alert alert-success">' .$this->session->flashdata('model_deleted') . '</p>'; ?>
 <?php endif; ?>
             
                         <!--Display form validation errors-->
<?php echo validation_errors('<p class="alert alert-dismissable alert-danger">'); ?>
 <?php if($this->session->flashdata('image_error')) : ?> 
 	<?php echo  '<p class="alert alert-danger alert-dismissable">'. 'error : '.$this->session->flashdata('image_error') . '</p>'; ?>
 <?php endif; ?>
          <h1>
            Model
            <small>Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>index.php/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li  class="active" >model</li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <a href="<?php echo base_url(); ?>index.php/admin/model/add"><button class="btn btn-block btn-primary btn-lg">Add Model</button></a>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Model Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Model Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                         <?php foreach($model as $models) : ?>
                      <tr>
                          <td><?php echo $models->name;?></td>
                        <td><?php echo $models->created;?></td>
                        <td><div class="btn-group">
                      <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo base_url(); ?>index.php/admin/model/edit/<?php echo $models->id; ?>">Edit</a></li>
                        <li><a onclick="return confirm('Are you sure?')" href="<?php echo base_url(); ?>index.php/admin/model/delete/<?php echo $models->id; ?>">Delete</a></li>
                      </ul>
                    </div></td>
                      </tr>
                <?php endforeach; ?>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>model Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
     <?php $this->load->view('admin/footer');?>