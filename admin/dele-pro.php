<?php 
include '../config_db/connect.php';
if (isset($_GET['id'])){
$id = $_GET['id'];

$que = mysqli_query($conn,"SELECT * FROM img_pro WHERE id_pro=$id");
foreach ($que as $key => $value) {
	unlink('../uploads/product/'.$value['image']);
}
mysqli_query($conn,"DELETE FROM img_pro WHERE id_pro=$id");
$pro=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM product WHERE id=$id"));
unlink('../uploads/product/'.$pro['image']);
$query = mysqli_query($conn,"DELETE FROM product WHERE id=$id");
if ($query) {
	header('location: product.php');
}
else echo "lỗi";
}
 ?>
