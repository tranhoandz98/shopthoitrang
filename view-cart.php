<?php include 'header.php'; 
$cart = (isset($_SESSION['cart']))? $_SESSION['cart']:[];
?>
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title">Danh sách đơn hàng</h3>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>STT</th>
				<th>Ảnh sản phẩm</th>
				<th>Tên sản phẩm</th>
				<th>Số lượng</th>
				<th>Giá</th>
				<th>Thành tiền</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($cart as $key => $value) {
				?>
				<tr>
					<td><?php echo $key ?></td>
					<td><img src="uploads/product/<?php echo $value['image'] ?>" alt="" class="anh-sp"></td>

					<td><?php echo $value['name'] ?></td>
					<td>
						<form action="cart.php">
							<div class="row">
								<div class="col-md-7">
									<input type="number" value="<?php echo $value['quantity'] ?>" class="form-control" name="quantity">
								</div>
								<input type="hidden" name="id" value="<?php echo $value['id'] ?>">
								<input type="hidden" name="action" value="update">
								<div class="col-md-5">
									<button class="btn btn-primary" type="submit">Cập nhật</button>
								</div>
							</div>
						</form>
					</td>
					<td><?php echo number_format($value['price']) ?>đ</td>
					<td><?php echo number_format($value['quantity']*$value['price']) ?>đ</td>
					<td><a href="cart.php?id=<?php echo $value['id']?>&action=delete" class="btn btn-danger">Xóa</a></td>
				</tr>
			<?php } ?>
			<tr class="text-red text-center">
				<td>Tổng tiền</td>
				<td colspan="6"><?php echo number_format(price_total($cart)); ?>đ</td>
			</tr>
			<tr>
			</tr>
		</tbody>
	</table>
	<a href="checkout.php" class="btn btn-primary">Đặt hàng</a>
		</div>
	</div>
	
</div>
<?php include 'footer.php'; ?>