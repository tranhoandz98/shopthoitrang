 <?php include 'header.php';
$orders=mysqli_query($conn,"SELECT orders.*,users.name as 'Name' FROM orders JOIN users ON orders.id_user=users.id ");
 ?>
<div class="container">
	<div class="col-md-11">
	<div class="panel panel-info">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-3">
					<h3 class="panel-title">Danh sách đơn hàng</h3>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<table class="table table-bordered table-hover" id="myTable">
				<thead>
					<tr>
						<th>Mã đơn hàng</th>
						<th>Tên khách hàng</th>
						<th>Tổng tiền</th>
						<th>Ngày đặt</th>
						<th>Trạng thái</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($orders as $key => $value) {
					 ?>
					<tr>
						<td> <?php echo $value['id'] ?></td>
						<td> <?php echo $value['Name'] ?>
						</td>
						<td> <?php echo number_format($value['total_price']) ?></td>
						<td><?php echo $value['creadted_at'] ?></td>
						<td> 
							<?php 
								if ($value['status']==0){ ?>
						<span class="label bg-black">Chưa xử lý</span>
					<?php }elseif ($value['status']==1) {?>
						<span class="label bg-yellow">Đang xử lý</span>
						<?php }elseif ($value['status']==2) {?>
							<span class="label bg-green">Đã xử lý</span>
						<?php }elseif ($value['status']==3) {?>
							<span class="label bg-green">Đang giao hàng</span>
						<?php }elseif ($value['status']==4) {?>
							<span class="label bg-red">Đã hủy hàng</span>
								<?php } ?>

							</td>
						<td>
							<a href="order-detail.php?id=<?php echo $value['id'] ?>" class="label bg-blue">Xem chi tiết</a>
						 </td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	</div>
</div>
<?php include 'footer.php'; ?>