<?php

include '../src/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['order'])){

   $name = htmlspecialchars($_POST['name']);
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = htmlspecialchars($_POST['number']);
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = htmlspecialchars($_POST['email']);
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = htmlspecialchars($_POST['method']);
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address =  htmlspecialchars($_POST['flat']) .', '. htmlspecialchars($_POST['street']) .', '. htmlspecialchars($_POST['city']) .', '. htmlspecialchars($_POST['state']) .', '. htmlspecialchars($_POST['country']) .' - '. htmlspecialchars($_POST['pin_code']);
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);

      $message[] = 'đơn hàng được đặt thành công!';
   }else{
      $message[] = 'giỏ hàng còn trống';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../public/css/style.css">

</head>
<body>
   
<?php include '../partials/user_header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>giỏ hàng của bạn</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
               $total_products = implode($cart_items);
               $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>(<?= $fetch_cart['price'].'VNĐ x '. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">giỏ hàng của bạn còn trống!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">Tổng cộng : <span><?= $grand_total; ?> VNĐ</span></div>
      </div>

      <h3>đơn đặt hàng của bạn</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Tên của bạn :</span>
            <input type="text" name="name" placeholder="Nhập tên của bạn" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>Số điện thoại:</span>
            <input type="number" name="number" placeholder="Nhập số điện thoại" class="box" required>
         </div>
         <div class="inputBox">
            <span>Địa chỉ email :</span>
            <input type="email" name="email" placeholder="Nhập địa chỉ email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Phương thức thanh toán :</span>
            <select name="method" class="box" required>
               <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
               <option value="Thanh toán qua thẻ ngân hàng">Thanh toán qua thẻ ngân hàng</option>
               <option value="Thanh toán bằng ví Momo">Thanh toán qua ví MoMo</option>
               <option value="Thanh toán online">Thanh toán online</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Địa chỉ nhà :</span>
            <input type="text" name="flat" placeholder="Nhập địa chỉ nhà" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Tên đường :</span>
            <input type="text" name="street" placeholder="Nhập tên đường" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Khu vực:</span>
            <input type="text" name="city" placeholder="Nhập khu vực" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Xã/Phường :</span>
            <input type="text" name="state" placeholder="Nhập Xã/Phường" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Huyện/Quận:</span>
            <input type="text" name="country" placeholder="Nhập Huyện/Quận" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Tỉnh/Thành phố :</span>
            <input type="text"  name="pin_code" placeholder="Nhập Huyện/Quận" class="box" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="Đặt hàng">

   </form>

</section>













<?php include '../partials/footer.php'; ?>

<script src="../public/js/script.js"></script>

</body>
</html>