<footer class="footer">

   <section class="grid">

      <div class="box">
         <h3>truy cập nhanh</h3>
         <a href="../home.php"> <i class="fas fa-angle-right"></i> trang chủ</a>
         <a href="../user/about.php"> <i class="fas fa-angle-right"></i> về chúng tôi</a>
         <a href="../user/shop.php"> <i class="fas fa-angle-right"></i> mua hàng</a>
      </div>

      <div class="box">
         <h3>liên kết</h3>
         <a href="../user/user_login.php"> <i class="fas fa-angle-right"></i> đăng nhập</a>
         <a href="../user/user_register.php"> <i class="fas fa-angle-right"></i> đăng ký</a>
         <a href="../user/cart.php"> <i class="fas fa-angle-right"></i> giỏ hàng</a>
         <a href="../user/orders.php"> <i class="fas fa-angle-right"></i> đơn hàng</a>
      </div>

      <div class="box">
         <h3>Thông tin chúng tôi</h3>
         <a href="tel:1234567890"><i class="fas fa-phone"></i> 0949 332 107</a>
         <a href="tel:11122233333"><i class="fas fa-phone"></i> 0332 148 867</a>
         <a href="mailto:shaikh@gmail.com"><i class="fas fa-envelope"></i> congngheweb@gmail.com</a>
         <a href="https://www.google.com/myplace"><i class="fas fa-map-marker-alt"></i> ninh kieu, can tho, viet nam </a>
      </div>

      <div class="box">
         <h3>Theo dõi chúng tôi</h3>
         <a href="#"><i class="fab fa-facebook-f"></i>facebook</a>
         <a href="#"><i class="fab fa-twitter"></i>twitter</a>
         <a href="#"><i class="fab fa-instagram"></i>instagram</a>
         <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
      </div>

   </section>

   <div class="credit"> BÀI PROJECT CỦA <span>VÕ ĐOÀN QUANG VINH</span> | TẠ CHÂU THIÊN ĐỈNH</div>

</footer>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="../public/js/script.js"></script>

<script>

var swiper = new Swiper(".mySwiper", {
      cssMode: true,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
      },
      mousewheel: true,
      keyboard: true,
    });

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>