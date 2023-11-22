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

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = htmlspecialchars($_POST['prev_pass']);
   $old_pass = htmlspecialchars(sha1($_POST['old_pass']));
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = htmlspecialchars(sha1($_POST['new_pass']));
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = htmlspecialchars(sha1($_POST['cpass']));
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = 'please enter old password!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'old password not matched!';
   }elseif($new_pass != $cpass){
      $message[] = 'confirm password not matched!';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$cpass, $user_id]);
         $message[] = 'cập nhật mật khẩu thành công!';
      }else{
         $message[] = 'vui lòng nhập mật khẩu mới!';
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
      <h3>cập nhật tài khoản</h3>
      <input type="hidden" name="prev_pass" value="<?= $fetch_profile["password"]; ?>">
      <input type="text" name="name" required placeholder="Nhập tên của bạn" maxlength="20"  class="box" value="<?= $fetch_profile["name"]; ?>">
      <input type="email" name="email" required placeholder="Nhập email của bạn" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile["email"]; ?>">
      <input type="password" name="old_pass" placeholder="Nhập mật khẩu hiện tại" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="Nhập mật khẩu mới" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" placeholder="Xác thực lại mật khẩu mới" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="cập nhật tài khoản" class="btn" name="submit">
   </form>

</section>













<?php include '../partials/footer.php'; ?>

<script src="../public/js/script.js"></script>

</body>
</html>