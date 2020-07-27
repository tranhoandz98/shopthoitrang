<?php include 'config_db/connect.php';
session_start();
$cart = (isset($_SESSION['cart']))? $_SESSION['cart']:[];
include 'cart-function.php';
$category = mysqli_query($conn,"SELECT * FROM category WHERE status=1");
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Trang chủ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="admin/css/bootstrap.min.css">
  <link rel="stylesheet" href="admin/css/font-awesome.min.css">
  <link rel="stylesheet" href="admin/css/AdminLTE.css">
  <link rel="stylesheet" href="admin/css/_all-skins.min.css">
  <link rel="stylesheet" href="admin/css/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="admin/magnify-image-hover/css/jquery.jqZoom.css">
  <link rel="stylesheet" href="admin/css/style.css" />
  <link rel="stylesheet" type="text/css" href="admin/css/style2.css">
  <script src="admin/js/angular.min.js"></script>
  <script src="admin/js/app.js"></script>
</head>
<body>
  <header>  
    <nav class="navbar navbar-inverse menu">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
           <ul class="nav navbar-nav">
             <li class="">
              <a href="index.php">Trang chủ</a>
            </li>
            <li class="">
              <a href="#">Giới thiệu</a>
            </li>
            <li class="">
              <a href="index.php">Sản phẩm</a>
            </li>
            <li>
              <a href="#">Danh mục</a>
              <ul class="nav">
                <?php foreach ($category as $key => $value) {
                 ?>
                 <li><a href="category.php?danh-muc=<?php echo $value['slug']; ?>"><?php echo $value['name']; ?></a></li>
               <?php } ?>
             </ul>
           </li> 
           <!-- <li class="tim">
            <form action="search.php" method="POST" class="form-inline" role="form" class="search">
              <span class="form-group">
                <label class="sr-only" for="">label</label>
                <input type="text" class="form-control" id="" placeholder="Nhập từ cần tìm kiếm" name="search">
              </span>
             <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form></li> -->
          </ul>
        </div>

        <div class="col-md-4 ">
          <ul class="nav navbar-nav">
            <li>
              <a href="view-cart.php">Giỏ hàng <span class="badge bg-olive"><?php echo sub_cart($cart); ?></span></a>
            </li> 
            <?php if (empty($user)){ ?>
              <li class="pull-right">
                <a href="login.php">Đăng nhập<p></p></a>
              </li>
              <li class="pull-right">
                <a href="register.php">Đăng ký</a>
              </li>
            <?php }else{ ?>
              <li class="pull-right">
                <!-- Single button -->
                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Chào <?php echo $user['name'] ?><span class="caret"></span>
                 </button>
                 <ul class="dropdown-menu">
                  <li><a href="user-infor.php">Cập nhật tài khoản</a></li>
                  <li><a href="cart-detail.php?id=<?php echo $user['id'] ?>">Chi tiết đơn hàng</a></li>
                  <li role="separator"></li>
                  <li><a href="logout.php">Đăng xuất</a></li>
                </ul>
              </div>
            </li>
          <?php } ?>

        </ul>
      </div>
    </div>
    <div class="clearfix"></div>



  </div>
</nav>
</header>