<?php

include ("../src/connect.php");

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location: ../public/index_admin.php?act=admin_accounts');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin accounts</title>

   <link rel="icon" type="image/x-icon" href="../public/images/icon-link.png"/>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../public/css/admin_style.css">

</head>
<body>

<section class="accounts">

   <h1 class="heading">Tài khoản quản trị</h1>

   <div class="box-container">

   <div class="box">
      <p>Thêm quản trị viên</p>
      <a href="../admin/register_admin.php" class="option-btn">đăng ký tài khoản</a>
   </div>

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `admins`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> ID quản trị: <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> Tên quản trị : <span><?= $fetch_accounts['name']; ?></span> </p>
      <div class="flex-btn">
         <a href="../admin/admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('bạn có chắc chắn xóa tài khoản quản trị này không?')" class="delete-btn">xóa</a>
         <?php
            if($fetch_accounts['id'] == $admin_id){
               echo '<a href="../admin/update_profile.php" class="option-btn">cập nhật</a>';
            }
         ?>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">không có tài khoản nào!</p>';
      }
   ?>

   </div>

</section>












<script src="../public/js/admin_script.js"></script>
   
</body>
</html>