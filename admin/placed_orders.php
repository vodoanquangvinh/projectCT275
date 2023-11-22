<?php

include '../src/connect.php';

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'đã cập nhật trạng thái thành công!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location: ../public/index_admin.php?act=placed_orders');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../public/css/admin_style.css">

</head>
<body>

<section class="orders">

<h1 class="heading">đơn hàng</h1>

<div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders`");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> Thời gian : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> Tên khác hàng : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> Số điện thoại : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> Địa chỉ : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> Tổng sản phẩm : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> Tổng tiền : <span><?= number_format($fetch_orders['total_price']); ?> VNĐ</span> </p>
      <p> Phương thức thanh toán : <span><?= $fetch_orders['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
            <option value="Chờ xác nhận">Chờ xác nhận</option>
            <option value="Đã hoàn tất đơn hàng">Đã hoàn tất đơn hàng</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="Cập nhật" class="option-btn" name="update_payment">
         <a href="../admin/placed_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('bạn chắc chắn xóa đơn hàng này không?');">Xóa</a>
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">không có đơn hàng nào!</p>';
      }
   ?>

</div>

</section>

</section>












<script src="../public/js/admin_script.js"></script>
   
</body>
</html>