<?php include 'header.php';
	$id_us=$user['id'];
	$users_query=mysqli_query($conn,"SELECT * FROM users WHERE id=$id_us");
	$users=mysqli_fetch_assoc($users_query);
if(isset($_POST['name'])){

	$add_ship = $_POST['add_ship'];
	$note =  $_POST['note'];
	$id_user = $user['id'];
	$total_price = price_total($cart);
	$sql = "INSERT INTO orders(id_user,total_price,address_ship,note) VALUES ('$id_user','$total_price','$add_ship','$note')";

	$query = mysqli_query($conn,$sql);
	$id = mysqli_insert_id($conn);
	foreach ($cart as $key => $value) {
		$price = $value['price'];
		$quantity = $value['quantity'];
		$sql_detail = mysqli_query($conn,"INSERT INTO order_detail(id_order,id_pro,price,quantity) VALUES ('$id','$key','$price','$quantity') ");
	}
	if ($query){
	unset($_SESSION['cart']);
	header('location: mess.php');
} 
else echo "lỗi";
	

}
?>
<?php if (!empty($user)){ ?>
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"></h3>
					</div>
					<div class="panel-body">
						<form action="" method="POST" role="form">
							<div class="form-group">
								<label for="">Tên khách hàng</label>
								<input type="text" class="form-control" id="" placeholder="Input field" value="<?php echo $users['name'] ?>" name="name">
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="email" class="form-control" id="" placeholder="Input field" value="<?php echo $users['email'] ?>">
							</div>
							<div class="form-group">
								<label for="">Số điện thoại</label>
								<input type="text" class="form-control" id="" placeholder="Input field" value="<?php echo $users['phone'] ?>">
							</div>
							<div class="form-group">
								<label for="">Địa chỉ</label>
								<input type="text" class="form-control" id="old_addr" placeholder="Input field" value="<?php echo $users['address'] ?>">
							</div>

							<div class="form-group">
								<label for="">Địa chỉ nhận hàng</label>
								<input type="text" class="form-control" id="new_addr" placeholder="Input field" name="add_ship">
							</div>
							<div class="checkbox" name="" id="">
								<label for="addr">
									<input type="checkbox" value="" id="addr">
									Giống địa chỉ mặc định
								</label>
							</div>
							<div class="form-group">
								<label for="">Ghi chú</label>
								<textarea name="note" id="input" class="form-control" rows="3" required="required"></textarea >
							</div>
							<button type="submit" class="btn btn-primary">Xác nhận thanh toán</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Danh sách sản phẩm</h3>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>STT</th>
										<th>Ảnh sp</th>
										<th>Tên sản phẩm</th>
										<th>Số lượng </th>
										<th>Đơn giá </th>
										<th>Thành tiền </th>
									</tr>
								</thead>
								<tbody>
									<?php $stt=1 ?>
									<?php foreach ($cart as $key => $value) {
										?>
										<tr>
											<td><?php echo $stt++ ?></td>
											<td><img src="uploads/product/<?php echo $value['image'] ?>" alt="" style="width:50px"></td>
											<td><?php echo $value['name'] ?></td>
											<td><?php echo $value['quantity'] ?></td>
											<td><?php echo number_format($value['price']) ?></td>
											<td><?php echo number_format($value['price']*$value['quantity']) ?></td>
										<?php } ?>
									</tr>
									<tr class="text-red text-center">
										<td>Tổng tiền</td>
										<td colspan="5"><?php echo number_format(price_total($cart)) ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } else{ ?>
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Mời đăng nhập để tiếp tục</strong> <a href="login.php">Đăng nhập</a>
	</div>
<?php } ?>
<?php include 'footer.php'; ?>
<script>
	$("#addr").click( function(){
		if($(this).is(':checked') ){
			var old_addr = $("#old_addr").val();
			$("#new_addr").val(old_addr);
		}
	});
</script>