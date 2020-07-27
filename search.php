<?php include 'header.php';
// phân trang php
// B1: lấy tổng số bản ghi của bảng
// $product = mysqli_query($conn,"SELECT * FROM product WHERE status=1");
if (isset($_POST['search'])){
  $search = $_POST['search'];
  $new_product= mysqli_query($conn,"SELECT * FROM product WHERE name LIKE '%$search%' and status=1");
$total = mysqli_num_rows($new_product);
// Bước 2 thiết lập số bản ghi trên 1 trang
$limit = 6;
// bước 3: tính số trang
$page=ceil($total/$limit);
// b4 lấy trang hiện tại
$cr_page=(isset($_GET['page'])? $_GET['page'] :1);
// b5 tính start
$start=($cr_page-1)*$limit;
// b6 mở query sử dụng limit
$query=mysqli_query($conn,"SELECT * FROM product WHERE name LIKE '%$search%' and status = 1 ORDER BY id DESC LIMIT $start,$limit ");
$pro=mysqli_fetch_assoc($query);
}
$category = mysqli_query($conn,"SELECT * FROM category WHERE status=1");
$banner= mysqli_query($conn,"SELECT * FROM banner WHERE status=1");
?>
<div class="container">
  <div class="row">
   <div class="col-md-3">
    <div class="panel panel-primary">
      <!-- Default panel contents -->
      <div class="panel-heading">Danh mục sản phẩm</div>
      <table class="table">
        <tbody>
         <?php foreach ($category as $key => $value) {
          ?>
          <tr>
            <td><a href="category.php?danh-muc=<?php echo $value['slug']; ?>"><?php echo $value['name']; ?></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<div class="col-md-9 banner">
  <div id="carousel-id" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php foreach ($banner as $key => $value) { ?>
        <li data-target="#carousel-id" data-slide-to="<?php echo $key ?>" class="<?php echo (($key==0))?'active':'' ?>"></li>
      <?php } ?>
    </ol>
    <div class="carousel-inner">
          <!--  <div class="item active">
               <img src="uploads/banner/1590333640banner.jpg" alt="">
             </div> -->
             <?php foreach ($banner as $key => $value) {
               ?>
               <div class="item <?php echo (($key==0))?'active':'' ?>">
                 <img src="uploads/banner/<?php echo $value['image'] ?>" alt="">
               </div>
             <?php } ?>

           </div>
           <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
           <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
         </div>
       </div>
     </div>
   </div>

   <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Tin tức</h3>
          </div>
          <div class="panel-body">
            Panel content
          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="panel panel-primary">
         <div class="panel-heading">
           <h3 class="panel-title">Sản phẩm tìm kiếm theo: <?php echo $search ?></h3>
         </div>
         <div class="panel-body">
          <div class="row">
            <?php foreach ($query as $key => $value) {

              ?>
              <div class="col-md-4 new-pro text-center">
                <div class="thumbnail">
                  <img src="uploads/product/<?php echo $value['image'] ?>" alt="" style="max-height: 150px">
                  <div class="caption">
                    <div class="ten-sp">
                      <p class=""><?php echo mb_strimwidth($value['name'], 0, 71, "...");?></p>
                    </div>
                    <!-- <div class="clearfix"></div> -->
                    <?php if ($value['sale_price']>0){ ?>
                      <p>
                        <span class="price"><?php echo number_format($value['sale_price']); ?> đ</span>
                        <del class="del-price"><?php echo number_format($value['price']); ?> đ</del>
                        <div class="sale">-<?php $percent = 100- (($value['sale_price'])/($value['price'])*100) ?><?php echo $percent.'%'; ?></div>
                      </p>
                    <?php } else{?>
                     <p class="price">
                      <?php echo number_format($value['price']); ?> đ
                    </p>
                  <?php } ?>
                  <p>
                    <a href="cart.php?id=<?php echo $value['id'] ?>" class="btn btn-primary">Mua hàng</a>
                    <a href="product-detail.php?san-pham=<?php echo $value['slug'] ?>" class="btn btn-default">Xem ngay</a>
                  </p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <ul class="pagination pull-right">
          <?php if ($cr_page >1){ ?>
          <li><a href="index.php?page=<?php echo ($cr_page-1); ?>">&laquo;</a></li>
        <?php } ?>
          <?php for ($i=1; $i <=$page ; $i++) {
            ?>
            <li class="<?php echo (($cr_page==$i)?'active':'') ?>"><a href="index.php?page=<?php echo $i ?>" ><?php echo $i ?></a></li>
          <?php } ?>
          <?php if ($cr_page < $page ){?>
          <li><a href="index.php?page=<?php echo ($cr_page+1); ?>">&raquo;</a></li>
        <?php } ?>
        </ul>
      </div>
    </div>

  </div>
</div>
</div>
<?php include 'footer.php'; ?>