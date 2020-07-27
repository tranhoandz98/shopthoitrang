<?php include 'header.php';
if(isset($_POST['email'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$err=[];
	$check = mysqli_query($conn,"SELECT * FROM users WHERE email = '$email'");
	$data=mysqli_fetch_assoc($check);
	$pass_veri=password_verify($password, $data['password']);
	if(mysqli_num_rows($check) and $pass_veri){
		$_SESSION['user'] = $data;
		header('location: checkout.php');
	}
	else{
		//báo lỗi
		 $err['err']="Tài khoản hoặc mk ko đúng";
	}

}
?>
<div class="container">
	<div class="row"></div>
	<div class="col-md-5">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Đăng nhập tài khoản</h3>
			</div>
			<div class="panel-body">

				<form action="" method="POST" class="" role="form">

					<div class="form-group">
						<label class="" for="">Email</label>
						<input type="email" class="form-control" id="" placeholder="Input field" name="email" required="required">
						<span class="err"><?php if (!empty($err['err'])) {echo $err['err'];} ?> </span>
					</div>
					<div class="form-group">
						<label class="" for="">Mật khẩu</label>
						<input type="password" class="form-control" id="" placeholder="Input field" name="password" required="required">
								<span class="err"><?php if (!empty($err['err'])) {echo $err['err'];} ?> </span>
					</div>
					<button type="submit" class="btn btn-primary">Đăng nhập</button>
					<a href="register.php" class="btn bg-orange">Đăng ký</a>
				</form>

			</div>
		</div>
	</div>
</div>
</div>
<?php include 'footer.php'; ?>