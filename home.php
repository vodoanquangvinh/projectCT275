<?php

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include '../partials/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>
</head>
<body>

<div class="home-bg">

<section class="home">

   <div class="swiper mySwiper">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="../public/images/home-img-1.png" alt="">
         </div>
         <div class="content">
            <span>Giảm giá lên đến 50%</span>
            <h3>Tiểu thuyết trinh thám</h3>
            <a href="../public/index.php?act=shop" class="btn">Mua ngay</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="../public/images/home-img-2.png" alt="">
         </div>
         <div class="content">
            <span>Hàng chính hãng 100%</span>
            <h3>Sách khoa học</h3>
            <a href="../public/index.php?act=shop" class="btn">Mua ngay</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="../public/images/home-img-3.png" alt="">
         </div>
         <div class="content">
            <span>Phụ kiện đi kèm hấp dẫn</span>
            <h3>Kỹ năng sống</h3>
            <a href="../public/index.php?act=shop" class="btn">Mua ngay</a>
         </div>
      </div>

   </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">các thể loại sách</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="../user/category.php?category=sách khoa học" class="swiper-slide slide">
      <img src="../public/images/icon-1.png" alt="">
      <h3>Sách khoa học</h3>
   </a>

   <a href="../user/category.php?category=truyện cười" class="swiper-slide slide">
      <img src="../public/images/icon-2.png" alt="">
      <h3>Truyện cười</h3>
   </a>

   <a href="../user/category.php?category=truyện tranh" class="swiper-slide slide">
      <img src="../public/images/icon-3.png" alt="">
      <h3>Truyện tranh</h3>
   </a>

   <a href="../user/category.php?category=truyện ngắn" class="swiper-slide slide">
      <img src="../public/images/icon-4.png" alt="">
      <h3>Truyện ngắn</h3>
   </a>

   <a href="../user/category.php?category=thơ ca" class="swiper-slide slide">
      <img src="../public/images/icon-5.png" alt="">
      <h3>Thơ ca</h3>
   </a>

   <a href="../user/category.php?category=tiểu thuyết" class="swiper-slide slide">
      <img src="../public/images/icon-6.png" alt="">
      <h3>Tiểu thuyết</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">sản phẩm mới nhất</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <a href="../user/quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="../uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span></span><?= number_format($fetch_product['price']); ?><span> VNĐ</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="thêm vào giỏ hàng" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">Không có sản phẩm nào!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

</body>
</html>

