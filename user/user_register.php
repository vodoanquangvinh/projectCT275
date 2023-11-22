<?php

include '../src/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = htmlspecialchars($_POST['name']);
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = htmlspecialchars($_POST['email']);
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = htmlspecialchars(sha1($_POST['pass']));
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = htmlspecialchars(sha1($_POST['cpass']));
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'Email bạn nhập đã tồn tại, vui lòng kiểm tra lại hoặc đăng nhập!';
   }else{
      if($pass != $cpass){
         $message[] = 'mật khẩu xác nhận không trùng khớp!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'đăng ký thành công!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../public/css/style.css">

</head>
<body>
   
<?php include '../partials/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>đăng ký</h3>
      <input type="text" name="name" required placeholder="Nhập họ tên của bạn" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="Nhập địa chỉ email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Nhập mật khẩu của bạn" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="Nhập lại mật khẩu của bạn" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="đăng ký" class="btn" name="submit">
      <p>Bạn đã có tài khoản?</p>
      <a href="user_login.php" class="option-btn">đăng nhập</a>
   </form>

</section>













<?php include '../partials/footer.php'; ?>

<script src="../public/js/script.js"></script>

</body>
</html>