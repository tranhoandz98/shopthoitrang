 <?php include 'header.php';
$product = mysqli_query($conn, "SELECT product.*,category.name as 'cate_id' FROM product JOIN category ON product.id_cate=category.id");
// B1 tính tổng số bản ghi
$total = mysqli_num_rows($product);
// B2 đếm số trang trên 1 bản ghi
$limit = 3;
// b3 tính số trang
$page = ceil($total / $limit);
// b4 tính trang hiện tại
$cr_page = (isset($_GET['page'])) ? $_GET['page'] : 1;
// Tính trang start
$start = ($cr_page - 1) * $limit;
$query = mysqli_query($conn, "SELECT product.*,category.name as 'cate_id' FROM product JOIN category ON product.id_cate=category.id LIMIT $start,$limit")
?>
 <div class="content">
 		<div class="panel panel-info">
 			<div class="panel-heading">
 				<div class="row">
 					<div class="col-md-3">
 						<h3 class="panel-title">Danh sách sản phẩm</h3>
 					</div>
 				</div>
 			</div>
 			<div class="panel-body">
 				<table class="table table-bordered table-hover" id="">
 					<thead>
 						<tr>
 							<th>STT</th>
 							<th>Hình ảnh</th>
 							<th>Tên</th>
 							<th>Danh mục</th>
 							<th>Giá</th>
 							<th>Giá khuyến mại</th>
 							<th>Số lượng</th>
 							<th>Trạng thái</th>
 						</tr>
 					</thead>
 					<tbody>
 						<?php foreach ($query as $key => $value) {?>
 							<tr>
 								<td> <?php echo $key + 1 ?></td>
 								<td><img src="../uploads/product/<?php echo $value['image'] ?>" alt="" style="width:50px"></td>
 								<td> <?php echo $value['name'] ?>
 								<span class="pull-right">
 									<a href="edit-pro.php?id=<?php echo $value['id'] ?>" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i></a>

 									<a href="dele-pro.php?id=<?php echo $value['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa k') "><i class="fa fa-fw fa-remove"></i></a>
 								</span>

 							</td>
 							<td> <?php echo $value['cate_id'] ?></td>
 							<td> <?php echo number_format($value['price']) ?></td>
 							<td> <?php echo number_format($value['sale_price']) ?></td>
 							<td><?php echo $value['quantity'] ?></td>
 							<td> <?php echo (($value['status'] == 0 ? '<span class="label bg-red">Ẩn</span>' : '<span class="label bg-green">Hiện</span>')) ?></td>
 						</tr>
 					<?php }?>
 				</tbody>
 			</table>
 			<ul class="pagination pagination-sm pull-right">
 				<?php if ($cr_page > 1) {
	?>
 				<li><a href="product.php?page=<?php echo $cr_page - 1 ?>">&laquo;</a></li>
 			<?php }?>
 				<?php for ($i = 1; $i <= $page; $i++) {?>
 				<li><a href="product.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
 			<?php }?>
 			<?php if ($cr_page < $page) {
	?>
 				<li><a href="product.php?page=<?php echo $cr_page + 1 ?>">&raquo;</a></li>
 			<?php }?>
 			</ul>
 		</div>
 	</div>
</div>
<?php include 'footer.php';?>