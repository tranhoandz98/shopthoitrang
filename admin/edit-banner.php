<?php include 'header.php';
if (isset($_GET['id'])){
	$id=$_GET['id'];
$banner=mysqli_query($conn,"SELECT * FROM banner WHERE id=$id");
$ban = mysqli_fetch_assoc($banner);
}
if (isset($_POST['name'])){
	$name=$_POST['name'];
	$slug=$_POST['slug'];
	$status=$_POST['status'];

	if (isset($_FILES['image'])){
		$file=$_FILES['image'];
		$file_name=time().$file['name'];
		if (empty($file['name'])){
			$file_name=$ban['image'];
		}
		else{
			unlink('../uploads/product/'.$banner['image']);
			if ($file['type']=='image/jpeg' || $file['type']=='image/jpg' || $file['type']=='image/png' ){
				move_uploaded_file($file['tmp_name'], '../uploads/product/'.$file_name);}
				else {
					Echo "Không đúng định dạng";
					$file_name='';
				}
			}
		}
	mysqli_query($conn,"UPDATE banner SET name='$name',slug='$slug',status='$status',image='$file_name' WHERE id=$id");
	header('location: banner.php');
}


 ?>
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Thêm mới banner</h3>
				</div>
				<div class="panel-body">
					<form action="" method="POST" role="form" enctype="multipart/form-data">
					
						<div class="form-group">
							<label for="">Tên banner</label>
							<input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục" name="name" onchange="ChangeToSlug()" value="<?php echo $ban['name'] ?>">
						</div>
						<div class="form-group">
							<label for="">Slug</label>
							<input type="text" class="form-control" id="slug" placeholder="slug" name="slug" value="<?php echo $ban['slug'] ?>">
						</div>
						<div class="form-group">
							<label for="">Image</label>
							<input type="file" class="form-control" id="slug" placeholder="image" name="image" >
							<img src="../uploads/banner/<?php echo $ban['image'] ?>" alt="" style="width: 150px">
						</div>
						<div class="radio">
							<label>
								<input type="radio" name="status" id="input" value="1" <?php echo (($ban['status']==1)?'checked':'') ?>>
								Hiện
							</label>

							<label>
								<input type="radio" name="status" id="input" value="0" <?php echo (($ban['status']==0)?'checked':'') ?>>
								Ẩn
							</label>
						</div>
						<button type="submit" class="btn btn-primary" name="submit">Cập nhật </button>
					</form>
				</div>
			</div>
		</div>
		<!-- <div class="col-md-8">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Danh sách banner</h3>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên banner</th>
								<th>Image</th>
								<th>Trạng thái</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($category as $key => $value) {
							?>
							<tr>
								<td><?php echo $key+1 ?></td>
								<td><?php echo $value['name'] ?>
								<span class="pull-right">
								<a href="edit-banner.php?id=<?php echo $value['id'] ?>" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i></a>

								<a href="delete-banner.php?id=<?php echo $value['id'] ?>" class="btn btn-danger"><i class="fa fa-fw fa-remove"></i></a>
								</span>
								</td>
								<td><img src="../uploads/banner/<?php echo $value['image'] ?>" alt="" style="width: 50px"></td>
								<td><?php echo (($value['status']==1?'Hiện':'Ẩn')) ?></td>
								
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div> -->
	</div>
</div>
<?php include 'footer.php' ?>