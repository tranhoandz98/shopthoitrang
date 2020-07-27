<?php include 'header.php';
$category=mysqli_query($conn,"SELECT * FROM banner");
if (isset($_POST['name'])){
	$name=$_POST['name'];
	$slug=$_POST['slug'];
	$status=$_POST['status'];

	if (isset($_FILES['image'])){
		$file=$_FILES['image'];
		$file_name=time().$file['name'];
		if ($file['type']=='image/jpeg' || $file['type']=='image/jpg' || $file['type']=='image/png' ){
			move_uploaded_file($file['tmp_name'], '../uploads/banner/'.$file_name);}
			else {
				Echo "Không đúng định dạng";
				$file_name='';
			}
		}
	mysqli_query($conn,"INSERT INTO banner(name,slug,status,image) VALUES ('$name','$slug','$status','$file_name')");
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
							<input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục" name="name" onchange="ChangeToSlug()">
						</div>
						<div class="form-group">
							<label for="">Slug</label>
							<input type="text" class="form-control" id="slug" placeholder="slug" name="slug" >
						</div>
						<div class="form-group">
							<label for="">Image</label>
							<input type="file" class="form-control" id="slug" placeholder="image" name="image" >
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
		<div class="col-md-8">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Danh sách banner</h3>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-hover" id=myTable>
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên banner</th>
								<th>Image</th>
								<th>Trạng thái</th>
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

								<a href="delete-banner.php?id=<?php echo $value['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa k') "><i class="fa fa-fw fa-remove"></i></a>
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
		</div>
	</div>
</div>
<?php include 'footer.php' ?>