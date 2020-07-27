<?php include 'header.php';
if ($_GET['san-pham']){
  $slug=$_GET['san-pham'];
  $product = mysqli_query($conn,"SELECT * FROM product WHERE slug='$slug'");
  $pro=mysqli_fetch_assoc($product);
}
if (isset($_GET['id'])){
  $id=$_GET['id'];
$quantity = (isset($_GET['quantity'])? $_GET['quantity']:1);
if ($quantity<0){
  $quantity=1;
}
$item=[
'id'=>$pro['id'],
'name'=>$pro['name'],
'image'=>$pro['image'],
'price'=>($pro['sale_price']>0)?$pro['sale_price']:$pro['price'],
'quantity'=>$quantity
];
if (isset($_SESSION['cart'][$id])){
      $_SESSION['cart'][$id]['quantity']+=$quantity;
    }
    }
?>
<div class="container detail">
  <div class="row">
    <div class="col-md-6">
      <div class="zoom-box pic-detail" >
        <img class="pic-main" src="uploads/product/<?php echo $pro['image'] ?>">
      </div>
    </div>
    <div class="col-md-6">
      <h4 class="name-pro"><?php echo $pro['name'] ?></h4>
      <form action="cart.php">
        <?php if ($pro['sale_price']>0){ ?>
         <p class="price"><?php echo number_format($pro['sale_price']); ?> đ</p>
         <p>Tiết kiệm: <?php $percent = 100-((($pro['sale_price'])/($pro['price'])*100)); ?> <span class="text-red"><?php echo $percent ?>%</span> (<?php echo number_format(($percent/100*$pro['price'])) ?> đ)</p>
         <p>Giá thị trường: <?php echo number_format($pro['price'])  ?> đ</p>
       <?php }else{ ?>
        <p class="price"><?php echo number_format($pro['price']); ?> đ</p>
      <?php } ?>
      <div class="form-group form-inline">
       <label for="">Số lượng</label>
       <button class="btn">-</button>
       <input type="number" class="form-control" id="" value="1" name="quantity">
       <button class="btn">+</button>
       <input type="hidden" name="id" value="<?php echo $pro['id'] ?>">
     </div>
     <a href="product-detail.php?id=<?php echo $pro['id'] ?>&san-pham=<?php echo $pro['slug'] ?>" class="btn bg-orange"><i class="fa fa-fw fa-shopping-cart"></i> Thêm vào giỏ hàng</a>
     <button type="submit" class="btn bg-red"> Mua hàng</button>
   </div>
 </form>
</div>

<div class="clearfix"></div>
<!-- Thông tin sản phẩm -->
<div class="row dess">
 <div class="col-md-10">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Mô tả sản phẩm</h3>
    </div>
    <div class="panel-body">
      <?php echo $pro['dess'] ?>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php'; ?>