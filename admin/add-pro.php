<?php include 'header.php';
$cate = mysqli_query($conn,"SELECT * FROM category");

if (isset($_POST['name'])){
	$name= $_POST['name'];
	$price= $_POST['price'];
	$sale_price= $_POST['sale_price'];
	$id_cate= $_POST['id_cate'];
	$slug= $_POST['slug'];
	$status= $_POST['status'];
	$dess= $_POST['dess'];
	$quantity= $_POST['quantity'];
// up load ảnh sản phẩm
	if (isset($_FILES['image'])){
		$file=$_FILES['image'];
		$file_name=time().$file['name'];
		if ($file['type']=='image/jpeg' || $file['type']=='image/jpg' || $file['type']=='image/png' ){
			move_uploaded_file($file['tmp_name'], '../uploads/product/'.$file_name);}
			else {
				Echo "Không đúng định dạng";
				$file_name='';
			}
		}
// up load nhiều file ảnh mô tả sản phẩm
		if (isset($_FILES['images'])){
			$files=$_FILES['images'];
			$file_names=$files['name'];
			foreach ($file_names as $key => $value) {
				$anh=time().$value;
				move_uploaded_file($files['tmp_name'][$key], '../uploads/product/'.$anh);
			};
		}
		$sql = "INSERT INTO product(name,slug,id_cate,price,sale_price,image,status,dess) VALUES('$name','$slug','$id_cate','$price','$sale_price','$file_name','$status','$dess')";
		$query = mysqli_query($conn,$sql);
		$id_pro=mysqli_insert_id($conn);

		foreach ($file_names as $key => $value) {
			$anh=time().$value;
			mysqli_query($conn,"INSERT INTO img_pro(id_pro,image) VALUES('$id_pro','$anh')");
		}
// kết thúc
		if ($query){
			header('location: product.php');
		}
		else echo "Lỗi";
	}
	?>
	<div class="content">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Thêm mới sản phẩm</h3>
				</div>
				<div class="panel-body">
					<div class="<co></co>l-md-9">
						<form action="" method="POST" role="form" enctype="multipart/form-data">

							<div class="form-group">
							<label for="">Tên sản phẩm</label>
							<input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục" name="name" onchange="ChangeToSlug()">
						</div>
						<div class="form-group">
							<label for="">Slug</label>
							<input type="text" class="form-control" id="slug" placeholder="slug" name="slug" >
						</div>
							<div class="form-group">
								<label for="">Danh mục sản phẩm</label>
								<select name="id_cate"  class="form-control" required="required">
									<option value="">--Danh mục--</option>
									<?php foreach ($cate as $key => $value) {

										?>
										<option value="<?php echo $value['id'] ?>"> <?php echo $value['name'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="">Số lượng</label>
								<input type="text" class="form-control" id="" placeholder="Số lượng sản phẩm" name="quantity">
							</div>
							<div class="form-group">
								<label for="">Giá</label>
								<input type="text" class="form-control" id="" placeholder="Giá" name="price">
							</div>
							<div class="form-group">
								<label for="">Giá khuyến mại</label>
								<input type="text" class="form-control" id="" placeholder="Giá khuyến mại" name="sale_price">
							</div>
							<div class="form-group">
								<label for="">Ảnh sản phẩm</label>
								<input type="file" class="form-control" id="" placeholder="Input field" name="image">
							</div>
							<div class="form-group">
								<label for="">Ảnh mô tả</label>
								<input type="file" class="form-control" id="" placeholder="Input field" name="images[]" multiple="multiple">
							</div>
							<div class="form-group">
								<label for="">Trạng thái</label>
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
							</div>
							<div class="form-group">
								<label for="">Dess</label>
								<textarea name="dess" id="dess" class="form-control" rows="3" required="required"></textarea>
							</div>



							<button type="submit" class="btn btn-primary">Thêm mới</button>
						</form>
					</div>
				</div>
			</div>
	</div>
	<?php include 'footer.php' ?>