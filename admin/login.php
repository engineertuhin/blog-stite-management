<?php 
  session_start();

  include('../config.php');


  if(isset($_POST['sign_in'])){
    $email = $_POST['email'];
    $password =$_POST['password'];
    if($email == "" || $password == ""){
      if($email == ""){
        $emailError = "Email filed is requried";
      }
      if($password == ""){
        $passwordError = "Password filed is requried";
      }
    }else{
      $admin =  $con->query("
        SELECT id, email, password FROM admins WHERE email = '$email';
      ");
      $data = $admin->fetch_assoc();
      if($data){
        $verify = password_verify($password, $data['password']);
        if($verify){
          $_SESSION['admin_id'] = $data['id'];
          header('location: /project1/admin');
        }else{
          $passwordError = "password did not match";
        }
      }
    }

    
  }



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <?php include('common/css.php') ?>
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="common/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
 
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
   
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
        
          <input type="email" class="form-control <?php echo isset($emailError)? 'is-invalid' : '' ?>" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div></br>
         
        </div>
        <div style="color: red;"><?php echo isset($emailError)? $emailError : '' ?></div>
        
        
        <div class="input-group mb-3">
          <input type="password" class="form-control  <?php echo isset($passwordError)? 'is-invalid' : '' ?>" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div style="color: red;"><?php echo isset($passwordError)? $passwordError : '' ?></div>
        <div class="row">
          
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="sign_in">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php include('common/js.php') ?>
</body>
</html>