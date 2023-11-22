<?php

include '../src/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = htmlspecialchars($_POST['email']);
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = htmlspecialchars(sha1($_POST['pass']));
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:../public/index.php');
   }else{
      $message[] = 'nhập sai email hoặc mật khẩu!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../public/css/style.css">

</head>
<body>
   
<?php include '../partials/user_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>đăng nhập</h3>
      <input type="email" name="email" required placeholder="Nhập địa chỉ email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="Nhập mật khẩu" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="đăng nhập" class="btn" name="submit">
      <p>Bạn đã có tài khoản?</p>
      <a href="user_register.php" class="option-btn">đăng ký</a>
   </form>

</section>

<?php include '../partials/footer.php'; ?>

<script src="../public/js/script.js"></script>

</body>
</html>