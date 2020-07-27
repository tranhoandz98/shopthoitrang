<?php include 'header.php';
	$id=$user['id'];
$users_query=mysqli_query($conn,"SELECT * FROM users WHERE id=$id");
$users=mysqli_fetch_assoc($users_query);
if (isset($_POST['name'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$address=$_POST['address'];
	$phone=$_POST['phone'];

	$query= mysqli_query($conn,"UPDATE users SET name='$name',email='$email',address='$address',phone='$phone' WHERE id=$id");
	if ($query){
		header('location: index.php');
	}
	else echo "Cập nhật thất bại";
}
?>

<div class="container">
	<div class="row">
		<div class="col-md-5">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Cập nhật thông tin tài khoản</h3>
				</div>
				<div class="panel-body">

					<form action="" method="POST" class="" role="form">
						<div class="form-group">
							<label class="" for="">Họ và tên</label>
							<input type="text" class="form-control" id="" placeholder="Input field" name="name" required="required" value="<?php echo $users['name'] ?>">
						</div>
						<div class="form-group">
							<label class="" for="">Email</label>
							<input type="email" class="form-control" id="" placeholder="Input field" name="email" required="required" value="<?php echo $users['email'] ?>">
						</div>
						<div class="form-group">
							<label class="" for="">Số điện thoại</label>
							<input type="text" class="form-control" id="" placeholder="Input field" name="phone" required="required" value="<?php echo $users['phone'] ?>">
						</div>
						<div class="form-group">
							<label class="" for="">Địa chỉ</label>
							<input type="text" class="form-control" id="" placeholder="Input field" name="address" required="required" value="<?php echo $users['address'] ?>">
						</div>
						<button type="submit" class="btn btn-primary">Cập nhật</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>