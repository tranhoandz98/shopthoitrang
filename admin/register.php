<?php
include '../config_db/connect.php';
session_start();
$err=[];
if (isset($_POST['name'])){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $r_password=$_POST['r_password'];
 if (empty($name)) {
  $err['name'] = 'Bạn chưa nhập tên';
 }
 if (empty($email)) {
  $err['email'] = 'Bạn chưa nhập email';
 }
 if (empty($password)) {
  $err['password'] = 'Bạn chưa nhập mật khẩu';
 }
 if ($password != $r_password){
  $err['r_password'] = 'Mật khẩu không trùng khớp';
 }
$email_check = mysqli_query($conn,"SELECT * FROM admin WHERE email='$email'");
$check = mysqli_num_rows($email_check);
if ($check) {
  $err['email'] = 'Email trùng khớp';
}
$pass = password_hash($password, PASSWORD_DEFAULT);
if (empty($err)){
  $query= mysqli_query($conn,"INSERT INTO admin(name,email,password) VALUES ('$name','$email','$pass')");
 if  ($query){
  header('location: login.php');
 }
 else {
  echo "Đăng ký thất bại";
 }
 }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/AdminLTE.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/style.css" />
 <link rel="stylesheet" type="text/css" href="css/style2.css">
  <script src="js/angular.min.js"></script>
  <script src="js/app.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="register.php"><b>Đăng ký tài khoản</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" name="name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        <div class="err"><?php  if (!empty($err['name'])) {echo $err['name'];}  ?></div> 
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
         <div class="err"><?php  if (!empty($err['email'])) {echo $err['email'];}  ?></div> 
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
         <div class="err"><?php  if (!empty($err['password'])) {echo $err['password'];}  ?></div> 
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="r_password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          <div class="err"><?php  if (!empty($err['r_password'])) {echo $err['r_password'];}  ?></div> 
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="login.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/adminlte.min.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/function.js"></script>
</body>
</html>
