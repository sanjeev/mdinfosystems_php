<?php $this->load->view('admin/header');?>



      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Dashboard

            <small>Control panel</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Dashboard</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

            

          <!-- Small boxes (Stat box) -->

          <div class="row">

            <div class="col-lg-3 col-xs-6">

              <!-- small box -->

              <div class="small-box bg-aqua">

                <div class="inner">

                  <h3><?php echo sizeof($orders);?></h3>

                  <p>Orders</p>

                </div>

                <div class="icon">

                  <i class="fa fa-shopping-cart"></i>

                </div>

                <a href="<?php echo base_url(); ?>" class="small-box-footer">

                  More info <i class="fa fa-arrow-circle-right"></i>

                </a>

              </div>

            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">

              <!-- small box -->

              <div class="small-box bg-green">

                <div class="inner">

                  <h3><?php echo sizeof($products);?></h3>

                  <p>Products</p>

                </div>

                <div class="icon">

                  <i class="ion ion-stats-bars"></i>

                </div>

                <a href="<?php echo base_url(); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

              </div>

            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">

              <!-- small box -->

              <div class="small-box bg-yellow">

                <div class="inner">

                  <h3><?php echo sizeof($users);?></h3>

                  <p>Users</p>

                </div>

                <div class="icon">

                  <i class="ion ion-person-add"></i>

                </div>

                <a href="<?php echo base_url(); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

              </div>

            </div><!-- ./col -->

            <div class="col-lg-3 col-xs-6">

              <!-- small box -->

              <div class="small-box bg-red">

                <div class="inner">

                  <h3><?php echo sizeof($searches);?></h3>

                  <p>Searches</p>

                </div>

                <div class="icon">

                  <i class="ion ion-pie-graph"></i>

                </div>

                <a href="<?php echo base_url(); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>

              </div>

            </div><!-- ./col -->

          </div><!-- /.row -->

          <!-- Main row -->

          <div class="box box-primary">

                <div class="box-header with-border">

                  <h3 class="box-title">Recently Added Products</h3>

                  <div class="box-tools pull-right">

                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                  </div>

                </div><!-- /.box-header -->

                

                            

                <div class="box-body">

                  <ul class="products-list product-list-in-box">
                  <div class="table-responsive">

                    <table class="table no-margin">
						 <?php foreach($products as $product) { ?>
						<tr>
							<td><?php echo $product->product_name; ?> </td>
							<td> <img src="<?php echo base_url();?>assets/images/<?php echo $product->product_image; ?>" style="width:60px" thumbnail="product" > </td>
							<td><?php echo $product->product_price; ?></td>
							<td><?php echo $product->product_description; ?></td>
						</tr>
						<?php } ?>
					  </table>
					  </div>

                  </ul>

                </div><!-- /.box-body -->

                <div class="box-footer text-center">

                  <a href="<?php echo base_url(); ?>" class="uppercase">View All Products</a>

                </div><!-- /.box-footer -->

              </div><!-- /.box -->

              

              <div class="box box-info">

                <div class="box-header with-border">

                  <h3 class="box-title">Latest Orders</h3>

                  <div class="box-tools pull-right">

                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                  </div>

                </div><!-- /.box-header -->

                <div class="box-body">

                  <div class="table-responsive">

                    <table class="table no-margin">

                      <thead>

                        

                        <tr>

                          <th>Order ID</th>

                          <th>Item</th>

                          <th>Customer</th>

                          <th>Price</th>

                        </tr>

                         

                      </thead>

                      <tbody>

                            <?php $flag = 0; ?>

                  <?php foreach($orders as $order) :?>

                 <?php if($flag>3) break; ?>

                        <tr>

                          <td><?php echo $order->id; ?></td>

                          <td><?php echo $orders_details[$order->id]->product_name; ?></td>

                          <td><?php echo $order->customer_name;?></td>

                         <td> 

                         <?php if($flag == 0){?>

                            <span class="label label-warning pull-right"><?php echo $orders_details[$order->id]->price; ?> $</span></a>

                            <?php } else if($flag == 1){?>

                            <span class="label label-info pull-right"><?php echo $orders_details[$order->id]->price; ?> $</span></a>

                        <?php } else if($flag == 2){?>

                      <span class="label label-danger pull-right"><?php echo $orders_details[$order->id]->price; ?> $</span></a>

                        <?php } else {?>

                      <span class="label label-success pull-right"><?php echo $orders_details[$order->id]->price; ?> $</span></a>

                        <?php } ?>

                         </td>

                        </tr>

                        

                        <?php $flag  ; ?>

                     <?php endforeach; ?>

                      </tbody>

                    </table>

                  </div><!-- /.table-responsive -->

                </div><!-- /.box-body -->

                <div class="box-footer clearfix">

                  <a href="<?php echo base_url(); ?>" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>

                </div><!-- /.box-footer -->

              </div><!-- /.box -->

          <div class="row">

            <!-- Left col -->

            <section class="col-lg-7 connectedSortable">

               <div class="col-md-6">

                 <!-- USERS LIST -->

                  <div class="box box-danger">

                    <div class="box-header with-border">

                      <h3 class="box-title">Latest Admins</h3>

                      <div class="box-tools pull-right">

                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

                      </div>

                    </div><!-- /.box-header -->

                    <div class="box-body no-padding">

                      <ul class="users-list clearfix">

                          <?php $flag = 0; ?>

                  <?php foreach($admins as $admin) :?>

                 <?php if($flag>5) break; ?>

                        <li>

                          <a class="users-list-name" href="#"><?php echo $admin->first_name;?></a>

                          <span class="users-list-date"><?php echo $admin->created;?></span>

                        </li>

                         <?php $flag  ; ?>

                     <?php endforeach; ?>

                      </ul><!-- /.users-list -->

                    </div><!-- /.box-body -->

                    <div class="box-footer text-center">

                      <a href="javascript::" class="uppercase">View All Admins</a>

                    </div><!-- /.box-footer -->

                  </div><!--/.box -->

                </div><!-- /.col -->

                

                 <div class="col-md-6">

                  

                </div><!-- /.col -->

            </section><!-- /.Left col -->

            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <section class="col-lg-5 connectedSortable">





            </section><!-- right col -->

          </div><!-- /.row (main row) -->



        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->
<?php $this->load->view('admin/footer');?>

