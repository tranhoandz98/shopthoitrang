<?php include 'header.php';
if (isset($_POST['name'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$r_password=$_POST['r_password'];
	$address=$_POST['address'];
	$phone=$_POST['phone'];
	$err=[];
	if (($password)!=($r_password)) $err['r_password']= 'Mật khẩu không trùng khớp';
	if (empty($err)){
	$pass=password_hash($password, PASSWORD_DEFAULT);
	$query= mysqli_query($conn,"INSERT INTO users(name,email,password,phone,address) VALUES ('$name','$email','$pass','$phone','$address')");
	if ($query){
		header('location: login.php');
	}
	else echo "Đăng ký thất bại";
}
}

 ?>

<div class="container">
	<div class="col-md-5">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Đăng ký tài khoản</h3>
			</div>
			<div class="panel-body">

				<form action="" method="POST" class="" role="form">
					<div class="form-group">
						<label class="" for="">Họ và tên</label>
						<input type="text" class="form-control" id="" placeholder="Input field" name="name" required="required">
					</div>
					<div class="form-group">
						<label class="" for="">Email</label>
						<input type="email" class="form-control" id="" placeholder="Input field" name="email" required="required">
					</div>
					<div class="form-group">
						<label class="" for="">Mật khẩu</label>
						<input type="password" class="form-control" id="" placeholder="Input field" name="password" required="required">
					</div>
					<div class="form-group">
						<label class="" for="">Nhập lại Mật khẩu</label>
						<input type="password" class="form-control" id="" placeholder="Input field" name="r_password" required="required">
						<span class="err"><?php if (!empty($err['r_password'])) {echo ($err['r_password']); } ?></span>
					</div>
					<div class="form-group">
						<label class="" for="">Số điện thoại</label>
						<input type="text" class="form-control" id="" placeholder="Input field" name="phone" required="required">
					</div>
					<div class="form-group">
						<label class="" for="">Địa chỉ</label>
						<input type="text" class="form-control" id="" placeholder="Input field" name="address" required="required">
					</div>
					<a href="login.php" class="btn bg-orange">Đăng nhập</a>
					<button type="submit" class="btn btn-primary">Đăng Ký</button>
				</form>

			</div>
		</div>
	</div>
	
</div>
<?php include 'footer.php'; ?>