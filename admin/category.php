<?php include 'header.php';

if (isset($_POST['search'])) {
	$search = $_POST['search'];
	$category = mysqli_query($conn, "SELECT * FROM category WHERE name LIKE '%$search%'");
	$total = mysqli_num_rows($category);
// B2 đếm số bản ghi trên 1 trang
	$limit = 3;
// B3 tính số trang
	$page = ceil($total / $limit);
// B4 lấy số trang hiện tại
	$cr_page = (isset($_GET['page'])) ? $_GET['page'] : 1;
// B5 tính trang start
	$start = ($cr_page - 1) * $limit;
// B6 query limit
	$query = mysqli_query($conn, "SELECT * FROM category WHERE name LIKE '%$search%' LIMIT $start,$limit ");
} else {
	$category = mysqli_query($conn, "SELECT * FROM category");
// B1 tính tổng bản ghi
	$total = mysqli_num_rows($category);
// B2 đếm số bản ghi trên 1 trang
	$limit = 3;
// B3 tính số trang
	$page = ceil($total / $limit);
// B4 lấy số trang hiện tại
	$cr_page = (isset($_GET['page'])) ? $_GET['page'] : 1;
// B5 tính trang start
	$start = ($cr_page - 1) * $limit;
// B6 query limit
	$query = mysqli_query($conn, "SELECT * FROM category LIMIT $start,$limit");
}

// inser dữ liệu vào bảng
if (isset($_POST['name'])) {
	$name = $_POST['name'];
	$slug = $_POST['slug'];
	$status = $_POST['status'];
	mysqli_query($conn, "INSERT INTO category(name,slug,status) VALUES ('$name','$slug','$status')");
	header('location: category.php');
}
?>
<div class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Thêm mới danh mục</h3>
				</div>
				<div class="panel-body">
					<form action="" method="POST" role="form">

						<div class="form-group">
							<label for="">Tên danh mục</label>
							<input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục" name="name" onchange="ChangeToSlug()">
						</div>
						<div class="form-group">
							<label for="">Slug</label>
							<input type="text" class="form-control" id="slug" placeholder="slug" name="slug" >
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="status" id="input" value="1" checked="checked">
								Hiện
							</label>
							<label>
								<input type="radio" name="status" id="input" value="0">
								Ẩn
							</label>
						</div>
						<button type="submit" class="btn btn-primary" name="submit">Thêm mới</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Danh sách danh mục</h3>
				</div>
				<div class="panel-body">
					<form action="" method="POST" class="form-inline" role="form">

						<div class="form-group">
							<label for="">Tìm kiếm</label>
							<input type="text" class="form-control" id="" placeholder="Bạn muốn tìm gì" name="search">
						</div>
						<button type="submit" class="btn btn-primary">Tìm kiếm</button>
					</form>
					<table class="table table-bordered table-hover" >
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên danh mục</th>
								<th>Trạng thái</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($query as $key => $value) {?>
								<tr>
									<td><?php echo $key + 1 ?></td>
									<td><?php echo $value['name'] ?>
									<span class="pull-right">
										<a href="edit-category.php?id=<?php echo $value['id'] ?>" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i></a>

										<a href="delete-cate.php?id=<?php echo $value['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa k') "><i class="fa fa-fw fa-remove"></i></a>
									</span>
								</td>
								<td ><?php echo (($value['status'] == 0 ? '<span class="label bg-red">Ẩn</span>' : '<span class="label bg-green">Hiện</span>')) ?></td>

								</tr>
							<?php }?>
						</tbody>
					</table>

			</div>
			</div>
			<ul class="pagination pull-right">
				<?php if ($cr_page > 1) {?>
					<li><a href="category.php?page=<?php echo $cr_page - 1 ?>">&laquo;</a></li>
				<?php }?>
					<?php for ($i = 1; $i <= $page; $i++) {?>
					<li><a href="category.php?page=<?php echo $i ?>"><?php echo $i; ?></a></li>
				<?php }?>
				<?php if ($cr_page < $page) {?>
					<li><a href="category.php?page=<?php echo $cr_page + 1 ?>">&raquo;</a></li>
				<?php }?>
				</ul>
	</div>
</div>
</div>
<?php include 'footer.php'?>