<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Mdinfosystems Admin Login</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
 <link href="<?php echo base_url(); ?>assets/css/admin_login.css" rel="stylesheet">
  <style type="text/css">
   
  </style>
  </head>

  <body>



    <div class="container">
        <div class="card card-container">
           
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
              <?php echo form_open('index.php/admin/authenticate/login'); ?>
              <h4 class="text-center">Admin | Login</h4>
              <?php echo validation_errors('<p class="alert alert-dismissable alert-danger">'); ?>
              <?php if($this->session->flashdata('fail_login')) : ?>
                <?php echo '<p class="alert alert-dismissable alert-danger">' .$this->session->flashdata('fail_login') . '</p>'; ?>
              <?php endif; ?>
              <?php if($this->session->flashdata('access_denied')) : ?>
                <?php echo '<p class="alert alert-dismissable alert-danger">' .$this->session->flashdata('access_denied') . '</p>'; //Access denied ?>
              <?php endif; ?>
              <?php if($this->session->flashdata('logged_out')) : ?>
                <?php echo '<p class="alert alert-dismissable alert-success">' .$this->session->flashdata('logged_out') . '</p>'; ?>
              <?php endif; ?>
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus>
                <br>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <br>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
           <?php echo form_close(); ?>
           
        </div><!-- /card-container -->
    </div><!-- /container -->
    


 <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

   
  </body>
</html>