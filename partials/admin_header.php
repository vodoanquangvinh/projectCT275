<?php

   include '../src/connect.php';


   if(isset($_SESSION['admin_id'])){
      $admin_id = $_SESSION['admin_id'];
   }else{
      $admin_id = '';
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

<header class="header">

   <section class="flex">

      <a href="../admin/dashboard.php" class="logo">Admin<span>It.BOOK</span></a>

      <nav class="navbar">
         <a href="../admin/dashboard.php">TRANG CHỦ</a>
         <a href="../public/index_admin.php?act=products">SẢN PHẨM</a>
         <a href="../public/index_admin.php?act=placed_orders">ĐƠN HÀNG</a>
         <a href="../public/index_admin.php?act=admin_accounts">QUẢN TRỊ</a>
         <a href="../public/index_admin.php?act=users_accounts">NGƯỜI DÙNG</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="../admin/update_profile.php" class="btn">cập nhật tài khoản</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">đăng ký</a>
            <a href="../public/index_admin.php" class="option-btn">đăng nhập</a>
         </div>
         <a href="../partials/admin_logout.php" class="delete-btn" onclick="return confirm('bạn sẽ đăng xuất khỏi bảng điều khiển?');">đăng xuất</a> 
      </div>

   </section>

</header>