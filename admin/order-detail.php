<?php include 'header.php';
if (isset($_GET['id'])){
	// lấy id đơn hàng
	$id_order = $_GET['id'];
	$order_query=mysqli_query($conn,"SELECT * FROM orders WHERE id=$id_order");
	$orders=mysqli_fetch_assoc($order_query);
	// lấy id người dùng
	$id_user=$orders['id_user'];
	$users_query=mysqli_query($conn,"SELECT * FROM users WHERE id=$id_user");
	$users=mysqli_fetch_assoc($users_query);

	// lấy ra danh sách sản phẩm trong đơn hàng
	$product=mysqli_query($conn,"SELECT order_detail.id_order,order_detail.quantity,order_detail.price,product.name,product.image FROM order_detail JOIN product on order_detail.id_pro=product.id WHERE order_detail.id_order=$id_order");
	if (isset($_POST['status'])){
		$status=$_POST['status'];
		$query =mysqli_query($conn,"UPDATE orders SET status='$status' WHERE id='$id_order'");
		if ($query){
			header('location: order.php');
		} else echo "Cập nhật thất bại";
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<h4 class="box-header">Thông tin khách hàng mã đơn: <?php echo $orders['id']?></h4>
				<div class="box-body">
					<p>Tên khách hàng: <?php echo $users['name'] ?></p>
					<p>Số điện thoại: <?php echo $users['phone'] ?></p>
					<p>Địa chỉ nhận hàng: <?php echo $orders['address_ship'] ?></p>
					<p>Ghi chú: <?php echo $orders['note'] ?></p>
					<p>Ngày đặt hàng: <?php echo $orders['creadted_at'] ?></p>
					<p>Trạng thái: <?php if ($orders['status']==0) { ?>
						Chưa xử lý
					<?php }elseif ($orders['status']==1){?>
						Đang xử lý
					<?php }elseif ($orders['status']==2){?>
						Đã xử lý
					<?php }elseif ($orders['status']==3){?>
						Đang giao hàng
					<?php }elseif ($orders['status']==4){?>
						Đã hủy hàng
					<?php } ?>
				</p>
			</div>
		</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Panel title</h3>
				</div>
				<div class="panel-body">
					Panel content
				</div>
			</div>
		</div>
	</div>

<div class="box">
	<div class="row">
	<h3 class="box-header">Chi tiết đơn hàng</h3>
		<div class="col-md-6">
			<div class="box-body">
				<table class="table table-hover table-bordered" id="myTable">
					<thead>
						<tr>
							<th>STT</th>
							<th>Tên sản phẩm</th>
							<th>Ảnh</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<th>Thành tiền</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($product as $key => $value){	?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $value['name'] ?></td>
								<td><img src="../uploads/product/<?php echo $value['image'] ?>" alt="" width=100></td>
								<td><?php echo $value['quantity'] ?></td>
								<td><?php echo number_format($value['price']) ?> đ</td>
								<td><?php echo number_format($value['price']*$value['quantity']) ?> đ</td>
							</tr>
						<?php } ?>
						<tr class="text-red text-center text-bold">	
							<td>Tổng tiền</td>
							<td colspan="5"><?php echo number_format(price_total($product))?> đ</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="box-footer">
				<div class="col-md-4">
					<form action="" method="POST" role="form" class="form form-inline">
						<label for="">Trạng thái</label>
						<div class="form-group">		
							<select name="status" id="input" class="form-control" required="required">
								<option value="0">Chưa xử lý </option>
								<option value="1">Đang xử lý </option>
								<option value="2">Đã xử lý</option>
								<option value="3">Đang giao hàng</option>
								<option value="4">Đã hủy hàng</option>
							</select>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
				</div>
			</div>
		</div>
	</div>

	</div>
</div>	
<?php include 'footer.php'; ?>
