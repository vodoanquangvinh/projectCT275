<?php

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>
</head>
<body>

<section class="orders">

   <h1 class="heading">đơn hàng</h1>

   <div class="box-container">

   <?php
      if($user_id == ''){
         echo '<p class="empty">Vui lòng đăng nhập để xem đơn hàng</p>';
      }else{
         $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
         $select_orders->execute([$user_id]);
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>Thời gian : <span><?= $fetch_orders['placed_on']; ?></span></p>
      <p>Tên khác hàng : <span><?= $fetch_orders['name']; ?></span></p>
      <p>Địa chỉ email : <span><?= $fetch_orders['email']; ?></span></p>
      <p>Số điện thoại : <span><?= $fetch_orders['number']; ?></span></p>
      <p>Địa chỉ : <span><?= $fetch_orders['address']; ?></span></p>
      <p>Phương thức thanh toán : <span><?= $fetch_orders['method']; ?></span></p>
      <p>Tổng sản phẩm : <span><?= $fetch_orders['total_products']; ?></span></p>
      <p>Tổng tiền: <span><?= number_format($fetch_orders['total_price']); ?> VNĐ</span></p>
      <p>Trạng thái đơn hàng : <span style="color:<?php if($fetch_orders['payment_status'] == 'Chờ xác nhận'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">bạn hiện không có đơn hàng nào!</p>';
      }
      }
   ?>

   </div>

</section>

</body>
</html>