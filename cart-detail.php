<?php include 'header.php';
if (isset($_GET['id'])){
	// lấy id đơn hàng
	$id_user = $_GET['id'];
	$order_query=mysqli_query($conn,"SELECT * FROM orders WHERE id_user=$id_user");
	$orders=mysqli_fetch_assoc($order_query);
	$id_order=$orders['id'];
	// lấy id người dùng
	$users_query=mysqli_query($conn,"SELECT * FROM users WHERE id=$id_user");
	$users=mysqli_fetch_assoc($users_query);
	// lấy ra danh sách sản phẩm trong đơn hàng
}
 ?>
<div class="content">
	<?php foreach ($order_query as $key => $value) {
		$id_or=$value['id'];
		$product=mysqli_query($conn,"SELECT order_detail.id_order,order_detail.quantity,order_detail.price,product.name,product.image FROM order_detail JOIN product on order_detail.id_pro=product.id WHERE order_detail.id_order=$id_or");
	 ?>
	<div class="row">
		<div class="col-md-6">
			
		</div>
		</div>
		<div class="col-md-9">
			<div class="box">
		<h3 class="box-header">Chi tiết đơn hàng</h3>
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
						<td><img src="uploads/product/<?php echo $value['image'] ?>" alt="" width=100></td>
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
	</div>	
		</div>
	</div>
<?php } ?>

	
</div>
<?php include 'footer.php'; ?>
