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
   <title>about</title>
</head>

<body>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="../public/images/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>Tại sao bạn nên chọn chúng tôi?</h3>
         <p>It.Book là một trang web bán sách trực tuyến được rất nhiều người yêu thích. Đây được xem là một thư viện online chuyên cung cấp những cuốn sách hữu ích cho mọi người. Với một bộ sưu tập đa dạng và phong phú, trang web này đã trở thành một điểm đến tuyệt vời cho những người yêu sách và tìm kiếm kiến thức từ khắp nơi trên thế giới.</p>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">đánh giá của khách hàng</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <h3>Đánh giá</h3>
         <img src="../public/images/pic-1.png" alt="">
         <p>Tôi đã đặt 16 cuốn để đọc. Nội dung rất hay và tôi đã giới thiệu cho người thân của mình.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         
      </div>

      <div class="swiper-slide slide">
         <h3>Đánh giá</h3>
         <img src="../public/images/pic-2.png" alt="">
         <p>Chất lượng sách tốt, giao hàng rất nhanh...tôi thích lắm! 5 sao nhé!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         
      </div>

      <div class="swiper-slide slide">
         <h3>Đánh giá</h3>
         <img src="../public/images/pic-3.png" alt="">
         <p>Chị đã mua hàng ở đây, giá sách rất rẻ. Chị còn mua 10 quyển cho chồng chị.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         
      </div>

      <div class="swiper-slide slide">
         <h3>Đánh giá</h3>
         <img src="../public/images/pic-4.png" alt="">
         <p>Shop hỗ trợ tư vấn sách tận tình cho tôi. Thái độ tốt, rất đáng trãi nghiệm...5 sao 5 sao</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         
      </div>

      <div class="swiper-slide slide">
         <h3>Đánh giá</h3>
         <img src="../public/images/pic-5.png" alt="">
         <p>It.Book không làm mình thất vọng, đa dạng các loại sách, dễ dàng lựa chọn sách mà mình thích.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         
      </div>

      <div class="swiper-slide slide">
         <h3>Đánh giá</h3>
         <img src="../public/images/pic-6.png" alt="">
         <p>Eoơi.cuốn sách năm 1599 còn bán nữa kìa. Tôi đã tìm nó ở rất lâu mà không tìm thấy!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         
      </div>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="../public/js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>