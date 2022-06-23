  <div class="swiper_box">
    <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <?php foreach ($cates as $cate) { ?>
          <div class="swiper-slide">
            <a href="#<?= $cate['menu_cate'] ?>"><?= $cate['menu_cate'] ?></a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>