<?php

include ("../src/connect.php");

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_user = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_user->execute([$delete_id]);
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE user_id = ?");
   $delete_orders->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart->execute([$delete_id]);
   header('location: ../public/index_admin.php?act=users_accounts');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users accounts</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../public/css/admin_style.css">

</head>
<body>

<section class="accounts">

   <h1 class="heading">tài khoản người dùng</h1>

   <div class="box-container">

   <?php
      $select_accounts = $conn->prepare("SELECT * FROM `users`");
      $select_accounts->execute();
      if($select_accounts->rowCount() > 0){
         while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> ID người dùng : <span><?= $fetch_accounts['id']; ?></span> </p>
      <p> Tên người dùng : <span><?= $fetch_accounts['name']; ?></span> </p>
      <p> Địa chỉ email : <span><?= $fetch_accounts['email']; ?></span> </p>
      <a href="../admin/users_accounts.php?delete=<?= $fetch_accounts['id']; ?>" onclick="return confirm('Bạn chắc chắn xóa tài khoản người dùng này? Mọi thông tin liên quan đều sẽ bị xóa!')" class="delete-btn">xóa</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">không có tài khoản người dùng nào!</p>';
      }
   ?>

   </div>

</section>

<script src="../public/js/admin_script.js"></script>
   
</body>
</html>