<!DOCTYPE html>

<html>

  <head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php //echo $this->global_data['site_title']; ?> | Dashboard</title>

    <!-- Tell the browser to be responsive to screen width -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Ionicons -->

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  </head>

  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper">



         <header class="main-header">

        <!-- Logo -->

        <a href="<?php echo base_url(); ?>index.php/admin/dashboard" class="logo">

          <!-- mini logo for sidebar mini 50x50 pixels -->

          <span class="logo-mini"><b style="color:green"></b></span>

          <!-- logo for regular state and mobile devices -->

          <span class="logo-lg" style="color:#e7e7e7">mdinfosystem</span>

        </a>

        <!-- Header Navbar: style can be found in header.less -->

        <nav class="navbar navbar-static-top" role="navigation">

          <!-- Sidebar toggle button-->

          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

            <span class="sr-only">Toggle navigation</span>

          </a>

          <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

             

              <!-- User Account: style can be found in dropdown.less -->

              <li class="dropdown user user-menu">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <span class="hidden-xs"><?php echo $userdata["username"]; ?></span>

                </a>

              </li>

              <li class="dropdown user user-menu">

                <a href="<?php echo base_url(); ?>" class="dropdown-toggle" data-toggle="dropdown">

                  <span class="hidden-xs">View Site</span>

                </a>

              </li>

              <li class="dropdown user user-menu">

                <a href="<?php echo base_url(); ?>index.php/admin/authenticate/logout" class="dropdown-toggle" data-toggle="dropdown">

                  <span class="hidden-xs">Logout</span>

                </a>

              </li>

            </ul>

          </div>

        </nav>

      </header>

      <!-- Left side column. contains the logo and sidebar -->

      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

          <!-- Sidebar user panel -->

          <!-- search form -->

         

          <!-- /.search form -->

          <!-- sidebar menu: : style can be found in sidebar.less -->

          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
           <li>

              <a href="<?php echo base_url(); ?>index.php/admin/dashboard">

                <i class="fa fa-th"></i> <span>Dashboard</span> <small class="label pull-right bg-green"></small>

              </a>

            </li>

            <li>
				<a href="<?php echo base_url(); ?>index.php/admin/products_admin"> <i class="fa fa-files-o"></i> <span> Products </span> </a>
</li>
<li>
<a href="<?php echo base_url(); ?>index.php/admin/categories_admin/main_category"> <i class="fa fa-files-o"></i> <span> Main Categoery </span></a>
</li>			  
<li>
<a href="<?php echo base_url(); ?>index.php/admin/categories_admin"> <i class="fa fa-files-o"></i> <span> Categoery </span></a>
</li>
 <li>
<a href="<?php echo base_url(); ?>index.php/admin/subcategories_admin"> <i class="fa fa-files-o"></i> <span> Sub-Categories </span> </a>
</li>
<li>
<a href="<?php echo base_url(); ?>index.php/admin/model"> <i class="fa fa-files-o"></i> <span> Model </span> </a>
</li> 			  
 <li>
<a href="<?php echo base_url(); ?>index.php/admin/brand"> <i class="fa fa-files-o"></i> <span> Brand </span> </a>
</li>    

    
           <!-- <li class="treeview">

              <a href="#">

                <i class="fa fa-laptop"></i>

                <span>Admins & Users</span>

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-circle-o"></i> Admins</a></li>

                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-circle-o"></i> Users</a></li>

              </ul>

            </li>

            

            <li class="treeview">

              <a href="#">

                <i class="fa fa-table"></i> <span>Orders</span>

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-circle-o"></i> Orders Sheet</a></li>

                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-circle-o"></i> Customers details</a></li>

              </ul>

            </li>

            <li class="treeview">

              <a href="#">

                <i class="fa fa-pie-chart"></i>

                <span>Trends</span>

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-circle-o"></i> Searched Stuff</a></li>

                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-circle-o"></i> Wishlists</a></li>

              </ul>

            </li>

            <li>

              <a href="<?php echo base_url(); ?>">

                <i class="fa fa-envelope"></i> <span>Subscriptions</span>

                <small class="label pull-right bg-yellow"><?php echo sizeof($subscriptions);?></small>

              </a>

            </li>-->

          </ul>

        </section>

        <!-- /.sidebar -->

      </aside>