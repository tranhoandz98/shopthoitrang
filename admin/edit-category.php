<?php include 'header.php';
if (isset($_GET['id'])){
	$id=$_GET['id'];
	$cate=mysqli_query($conn,"SELECT * FROM category WHERE id=$id");
	$category=mysqli_fetch_assoc($cate);
}
if (isset($_POST['name'])){
	$name=$_POST['name'];
	$slug=$_POST['slug'];
	$status=$_POST['status'];
	$query=mysqli_query($conn,"UPDATE category SET name='$name',slug='$slug',status='$status' WHERE id=$id");
	if ($query){
	header('location: category.php');
	}
	else echo "Lỗi";
}
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Sửa danh mục</h3>
				</div>
				<div class="panel-body">
					<form action="" method="POST" role="form">
					
						<div class="form-group">
							<label for="">Tên danh mục</label>
							<input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục" name="name" value="<?php echo $category['name'] ?>" onchange="ChangeToSlug()" >
						</div>
						<div class="form-group">
							<label for="">Slug</label>
							<input type="text" class="form-control" id="slug" placeholder="slug" name="slug" value="<?php echo $category['slug'] ?>">
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="status" id="input" value="1" <?php echo (($category['status']==1?'checked':'')) ?>>
								Hiện
							</label>
							<label>
								<input type="radio" name="status" id="input" value="0" <?php echo (($category['status']==0?'checked':'')) ?>>
								Ẩn
							</label>
						</div>
						<button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
					</form>
				</div>
			</div>
		</div>

	</div>
</div>
<?php include 'footer.php' ?>