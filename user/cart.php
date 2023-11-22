<?php

include '../src/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'số lượng sản phẩm đã được cập nhật';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../public/css/style.css">

</head>
<body>
   
<?php include '../partials/user_header.php'; ?>

<section class="products shopping-cart">

   <h3 class="heading">giỏ hàng</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <a href="../user/quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
      <img src="../uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
      <div class="name"><?= $fetch_cart['name']; ?></div>
      <div class="flex">
         <div class="price"><?= number_format($fetch_cart['price']); ?> VNĐ</div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
         <button type="submit" class="fas fa-edit" name="update_qty"></button>
      </div>
      <div class="sub-total"> tạm tính : <span><?= number_format($sub_total = ($fetch_cart['price'] * $fetch_cart['quantity'])); ?> VNĐ</span> </div>
      <input type="submit" value="xóa khỏi giỏ hàng" onclick="return confirm('bạn có chắc xóa sản phẩm ra khỏi đơn hàng không?');" class="delete-btn" name="delete">
   </form>
   <?php
   $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">giỏ hàng của bạn còn trống</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>Tổng cộng : <span><?= number_format($grand_total); ?> VNĐ</span></p>
      <a href="../public/index.php?act=shop" class="option-btn">tiếp tục mua hàng</a>
      <a href="../user/cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('bạn có chắc chắn xóa tất cả sản phẩm ra khỏi giỏ hàng?');">làm trống giỏ hàng</a>
      <a href="../user/checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">kiểm tra đơn hàng</a>
   </div>

</section>

<?php include '../partials/footer.php'; ?>

<script src="../public/js/script.js"></script>

</body>
</html>