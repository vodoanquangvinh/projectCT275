<?php


   include '../src/connect.php';

   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
      $user_id = '';
   };

   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../public/css/style.css">

</head>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo">It.<span>BOOK</span></a>

      <nav class="navbar">
         <a href="../public/index.php">TRANG CHỦ</a>
         <a href="../public/index.php?act=about">VỀ CHÚNG TÔI</a>
         <a href="../public/index.php?act=orders">ĐƠN HÀNG</a>
         <a href="../public/index.php?act=shop">MUA HÀNG</a>
      </nav>

      <div class="icons">
         <?php

            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_counts = $count_cart_items->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="../user/search_page.php"><i class="fas fa-search"></i></a>
         <a href="../user/cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_counts; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile["name"]; ?></p>
         <a href="../user/update_user.php" class="btn">cập nhật tài khoản</a>
         <div class="flex-btn">
            <a href="../user/user_register.php" class="option-btn">đăng ký</a>
            <a href="../user/user_login.php" class="option-btn">đăng nhập</a>
         </div>
         <a href="partials/user_logout.php" class="delete-btn" onclick="return confirm('bạn có muốn đăng xuất khỏi website?');">đăng xuất</a> 
         <?php
            }else{
         ?>
         <p>vui lòng đăng nhập hoặc đăng ký!</p>
         <div class="flex-btn">
            <a href="../user/user_register.php" class="option-btn">đăng ký</a>
            <a href="../user/user_login.php" class="option-btn">đăng nhập</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>