<?php 
include '../config_db/connect.php';
if (isset($_GET['id'])){
	$id=$_GET['id'];
	$banner=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM banner WHERE id=$id"));
unlink('../uploads/banner/'.$banner['image']);
$query=mysqli_query($conn,"DELETE FROM banner WHERE id=$id");
if ($query){
	header('location: banner.php');
}
}
 ?>