<?php
include_once '../db/db_store_and_menu.php';

// $store_num = $_GET['store_num'];
$param = [
  'store_num' => 1
];

$cates = select_menu_cate($param);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js" defer></script>
  <link rel="stylesheet" href="swiper.css">
  <script src="swiper.js" defer></script>
  <style>
    .cate {
      width: 500px;
      height: 100vh;
      padding-top: 50px;
    }
  </style>
</head>


<body>
  <div class="swiper_box">
    <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <?php foreach ($cates as $index => $cate) { ?>
          <div class="swiper-slide">
            <a href="#cate<?= $index ?>"><?= $cate['menu_cate'] ?></a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="cate-box">
    <?php foreach ($cates as $index => $cate) { ?>
      <div id="cate<?= $index ?>" class="cate">
        <?= $cate['menu_cate'] ?>
      </div>
    <?php } ?>
  </div>
</body>

</html>