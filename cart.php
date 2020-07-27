<?php 
include 'header.php';
if (isset($_GET['id'])){
	$id=$_GET['id'];
}
$action= (isset($_GET['action'])? $_GET['action']:'add');

$quantity = (isset($_GET['quantity'])? $_GET['quantity']:1);

if ($quantity<0){
	$quantity=1;
}
$query = mysqli_query($conn,"SELECT * FROM product WHERE id=$id");
if ($query){
$product = mysqli_fetch_assoc($query);
}
$item=[
'id'=>$product['id'],
'name'=>$product['name'],
'image'=>$product['image'],
'price'=>($product['sale_price']>0)?$product['sale_price']:$product['price'],
'quantity'=>$quantity
];
if ($action == 'add'){
		if (isset($_SESSION['cart'][$id])){
			$_SESSION['cart'][$id]['quantity']+=$quantity;
		}
		else{
			$_SESSION['cart'][$id]=$item;
		}
}
if ($action == 'update'){
		if (isset($_SESSION['cart'][$id])){
			$_SESSION['cart'][$id]['quantity']=$quantity;
		}
}
if ($action == 'delete'){
		unset($_SESSION['cart'][$id]);
}
header('location: view-cart.php');
 // thêm mới vào giỏ hàng
 // cập nhật giỏ hàng
 // xóa giỏ hàng

 ?>
