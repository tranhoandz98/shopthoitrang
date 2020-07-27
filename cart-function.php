<?php 
function price_total($cart){
	$price_total=0;
	foreach ($cart as $key => $value) {
		$price_total+=$value['price']*$value['quantity'];
	}
	return $price_total;
}
 ?>
 <?php 
function sub_cart($cart){
	$sub=0;
	foreach ($cart as $ke => $valu) {
		$sub+=$valu['quantity'];
	}
	return $sub;
}
  ?>

