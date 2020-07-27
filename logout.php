<?php include 'header.php';
unset($_SESSION['cart']);
unset($_SESSION['user']);
header('location: index.php');
 ?>