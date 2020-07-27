<?php include 'header.php';
if (isset($_GET['id'])){
	$id=$_GET['id'];
	$cate = mysqli_query($conn,"SELECT * FROM category");
	$product = mysqli_query($conn,"SELECT * FROM product WHERE id=$id");
	$pro=mysqli_fetch_assoc($product);
	$img_pro = mysqli_query($conn,"SELECT * FROM img_pro WHERE id_pro=$id");
	$img_product=mysqli_fetch_assoc($img_pro);
}
if (isset($_POST['name'])){
	$name= $_POST['name'];
	$price= $_POST['price'];
	$sale_price= $_POST['sale_price'];
	$slug=$_POST['slug'];
	$id_cate= $_POST['id_cate'];
	$status= $_POST['status'];
	$dess= $_POST['dess'];
	$quantity= $_POST['quantity'];
// up load ảnh sản phẩm

	if (isset($_FILES['image'])){
		$file=$_FILES['image'];
		$file_name=time().$file['name'];
		if (empty($file['name'])){
			$file_name=$pro['image'];
		}
		else{
			unlink('../uploads/product/'.$pro['image']);
			if ($file['type']=='image/jpeg' || $file['type']=='image/jpg' || $file['type']=='image/png' ){
				move_uploaded_file($file['tmp_name'], '../uploads/product/'.$file_name);}
				else {
					Echo "Không đúng định dạng";
					$file_name='';
				}
			}
		}
// end up load ảnh sp

// up load nhiều file ảnh mô tả sản phẩm
		if (isset($_FILES['images'])){
			$files=$_FILES['images'];
			$file_names=$files['name'];
			if (!empty($file_names['0'])){
				mysqli_query($conn,"DELETE FROM img_pro WHERE id_pro=$id");
				foreach ($img_pro as $key => $value) {
					unlink('../uploads/product/'.$value['image']);
				}
				foreach ($file_names as $key => $value) {
					move_uploaded_file($files['tmp_name'][$key], '../uploads/product/'.$value);}
					foreach ($file_names as $key => $value) {
						mysqli_query($conn,"INSERT INTO img_pro(id_pro,image) VALUES('$id','$value')");
					}
				}
			}

// end upload file

			$sql = "UPDATE product SET name='$name',id_cate='$id_cate',price='$price',sale_price='$sale_price',image='$file_name',status='$status',dess='$dess',slug='$slug',quantity='$quantity' WHERE id=$id ";
			$query = mysqli_query($conn,$sql);

			if ($query){
				header('location: product.php');
			}
			else echo "Lỗi";
		}
		?>
		<div class="content">
			<div class="box">
				<h3 class="box-header">Sửa sản phẩm</h3>
				<div class="box-body">
						<form action="" method="POST" role="form" enctype="multipart/form-data">
							<div class="form-group">
								<label for="">Tên sản phẩm</label>
								<input type="text" class="form-control" id="name" placeholder="Tên sản phẩm" name="name" value="<?php echo $pro['name'] ?>">
							</div>
							<div class="form-group">
								<label for="">Slug</label>
								<input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" value="<?php echo $pro['slug'] ?>">
							</div>
							<div class="form-group">
								<label for="">Danh mục sản phẩm</label>
								<select name="id_cate"  class="form-control" required="required">
									<option value="">--Danh mục--</option>
									<?php foreach ($cate as $key => $value) {
										?>
										<option value="<?php echo $value['id'] ?>" <?php echo (($pro['id_cate']==$value['id']?'selected':'')) ?>> <?php echo $value['name'] ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="">Số lượng sản phẩm</label>
								<input type="text" class="form-control" id="" placeholder="Số lượng sản phẩm" name="price" value="<?php echo $pro['quantity'] ?>">
							</div>
							<div class="form-group">
								<label for="">Giá</label>
								<input type="text" class="form-control" id="" placeholder="Giá" name="price" value="<?php echo $pro['price'] ?>">
							</div>
							<div class="form-group">
								<label for="">Giá khuyến mại</label>
								<input type="text" class="form-control" id="" placeholder="Giá khuyến mại" name="sale_price" value="<?php echo $pro['sale_price'] ?>">
							</div>
							<div class="form-group">
								<label for="">Ảnh sản phẩm</label>
								<input type="file" class="form-control" id="" placeholder="Ảnh sản phẩm" name="image">
								<img src="../uploads/product/<?php echo $pro['image'] ?>" alt="" style="width: 150px">
							</div>
							<div class="form-group">
								<label for="">Ảnh mô tả</label>
								<input type="file" class="form-control" id="" placeholder="Ảnh mô tả sản phẩm" name="images[]" multiple="multiple">
								<?php foreach ($img_pro as $key => $value) {
									?>
									<div class="col-md-4">
										<a href="#" class="thumbnail">
											<img src="../uploads/product/<?php echo $value['image'] ?>" alt="">
										</a>
									</div>

								<?php } ?>
								<div class="clearfix">

								</div>
							</div>
							<div class="form-group">
								<label for="">Trạng thái</label>
								<div class="radio">
									<label>
										<input type="radio" name="status" id="input" value="1" <?php echo (($pro['status']==1)?'checked':'')?> >
										Hiện
									</label>
									<label>
										<input type="radio" name="status" id="input" value="0" <?php echo (($pro['status']==0)?'checked':'')?> >
										Ẩn
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="">Dess</label>
								<textarea name="dess" id="dess" class="form-control" rows="3" required="required">
									<?php echo $pro['dess'] ?>
								</textarea>
							</div>
							<button type="submit" class="btn btn-primary">Cập nhật</button>
						</form>
				</div>
			</div>
		</div>
		<?php include 'footer.php' ?>