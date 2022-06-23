<?php
include_once "db/db_list.php";

$get_cate_nm = $_GET['cate_nm'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/screens/store_list.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js" defer></script>
    <script src="js/swiper.js" defer></script>
    <title>59 - list</title>

</head>

<body>
    <div class="container">
        <header class="list__header">
            <?php
            include_once "list_header.php";
            ?>
        </header>
        <main class="list__main">
            <div class="list__main__top mySwiper">
                <?php
                include_once "db/db_list.php";
                $result = sel_categories();
                ?>
                <div class="top__list swiper-wrapper">
                    <div class="top__item tabs__toggle swiper-slide">
                        <input type="radio" name="tabs__name" id="모두보기" value="모두보기">
                        <label for="모두보기" class="tabs__name">모두보기</label>
                    </div>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($get_cate_nm == $row['cate_nm']) { ?>
                            <div class="top__item tabs__toggle swiper-slide">
                                <input type="radio" name="tabs__name" id="<?= $row['cate_nm'] ?>" value="<?= $row['cate_nm'] ?>" checked>
                                <label for="<?= $row['cate_nm'] ?>" class="tabs__name"><?= $row['cate_nm'] ?></label>
                            </div>
                        <?php } else { ?>
                            <div class="top__item tabs__toggle swiper-slide">
                                <input type="radio" name="tabs__name" id="<?= $row['cate_nm'] ?>" value="<?= $row['cate_nm'] ?>">
                                <label for="<?= $row['cate_nm'] ?>" class="tabs__name"><?= $row['cate_nm'] ?></label>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="list__main__list">
                <div class="tabs__body">
                    <div class="top__nav">
                        <div id="nav__right">주변가게보기</div>
                    </div>
                    <div class="tabs__content">
                        <?php
                        include_once "db/db_list.php";
                        $result = sel_store_list();

                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="tabs__item">
                                <a href="store-detail.php?store_num=<?= $row['store_num'] ?>" class="allDisplayA">
                                    <div class="list__item">
                                        <div class="list__store__img">
                                            <?php if($row['store_photo'] === 'null') {
                                                print "<img src='https://cdn.pixabay.com/photo/2020/04/17/19/48/city-5056657_960_720.png' alt=''>";
                                            } else {
                                                print "<img src='img/store/{$row['store_nm']}/Main_img/{$row['store_photo']}'>";
                                            } ?>
                                        </div>
                                        <!-- <div class="list__store__img"><img src="img/store/그린네일/Main_img/9c4708ab-ca93-745d-86b7-06eea7c5e0dc.jpg"></div> -->
                                        <div class="list__store__info">
                                            <div class="store__info__nm"><?= $row['store_nm'] ?></div>
                                            <div class="store__info__info"><?= $row['info'] ?></div>
                                            <?php
                                            $param = [
                                                'store_num' => $row['store_num']
                                            ];
                                            $star = store_star($param);
                                            if (!$star) {
                                                $star = "";
                                            } else {
                                                $star = $star['star'];
                                            }
                                            if ($star == "") { ?>
                                                <div class='store__info__star_rating'><i class='fa-solid fa-star'></i></div>
                                            <?php } else { ?>
                                                <div class='store__info__star_rating'><i class='fa-solid fa-star'><?= intval($star) ?></i></div>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" name="" value="<?= $row['store_lat'] ?>" id="all_store_lat">
                                        <input type="hidden" name="" value="<?= $row['store_lng'] ?>" id="all_store_lng">
                                        <div id="all__list__store__location"><i class="fa-solid fa-location-dot"></i> </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                    include_once "db/db_list.php";
                    $result = sel_categories();
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="tabs__content">
                            <?php
                            $cate = $row['cate_num'];
                            $param = [
                                'cate' => $cate
                            ];
                            $stores = sel_cate_store($param);
                            while ($row = mysqli_fetch_assoc($stores)) { ?>
                                <a href="store-detail.php?store_num=<?= $row['store_num'] ?>" class="displayA">
                                    <div class="list__item">
                                        <div class="list__store__img">
                                            <?php if($row['store_photo'] === 'null') {
                                                print "<img src='https://cdn.pixabay.com/photo/2020/04/17/19/48/city-5056657_960_720.png' alt=''>";
                                            } else {
                                                print "<img src='img/store/{$row['store_nm']}/Main_img/{$row['store_photo']}'>";
                                            } ?>
                                        </div>
                                        <!-- <div class="list__store__img"><img src="img/store/그린네일/Main_img/9c4708ab-ca93-745d-86b7-06eea7c5e0dc.jpg"></div> -->
                                        <div class="list__store__info">
                                            <div class="store__info__nm"><?= $row['store_nm'] ?></div>
                                            <div class="store__info__info"><?= $row['info'] ?></div>
                                            <?php
                                            $param = [
                                                'store_num' => $row['store_num']
                                            ];
                                            $star = store_star($param);
                                            if (!$star) {
                                                $star = "";
                                            } else {
                                                $star = $star['star'];
                                            }
                                            if ($star == "") { ?>
                                                <div class='store__info__star_rating'><i class='fa-solid fa-star'></i></div>
                                            <?php } else { ?>
                                                <div class='store__info__star_rating'><i class='fa-solid fa-star'><?= intval($star) ?></i></div>
                                            <?php } ?>
                                        </div>
                                        <input type="hidden" name="" value="<?= $row['store_lat'] ?>" id="ctg_store_lat">
                                        <input type="hidden" name="" value="<?= $row['store_lng'] ?>" id="ctg_store_lng">
                                        <div class="list__store__location"><i class="fa-solid fa-location-dot"></i> </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </main>
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
        <script>
            //a태그 대신 자바스크립트로 페이지 이동
            const row = document.querySelector('#nav__right');
            row.addEventListener("click", function() {
                location.href = `map_test.php`;
            });


            let tabs = document.querySelectorAll('.tabs__toggle'),
                contents = document.querySelectorAll('.tabs__content');

            let cateNm = document.querySelectorAll('.tabs__name');

            for (let i = 0; i < cateNm.length; i++) {
                if (document.querySelector('input[type="radio"]:checked').value == cateNm[i].innerHTML) {
                    // console.log(cateNm[i].innerHTML);
                    contents.forEach((content) => {
                        content.classList.remove('is-active');
                    });
                    tabs.forEach((tab) => {
                        tab.classList.remove('is-active');
                    });
                    tabs[i].classList.add('is-active');
                    contents[i].classList.add('is-active');
                    // console.log(tabs[i].innerHTML);
                    document.querySelector('input[type="radio"]').checked = false;
                    tabs[i].style.backgroundColor = 'var(--main-pink)';
                }
            }

            tabs.forEach((tab, index) => {
                tab.addEventListener('click', () => {
                    contents.forEach((content) => {
                        content.classList.remove('is-active');
                    });
                    tabs.forEach((tab) => {
                        tab.classList.remove('is-active');
                        tab.style.backgroundColor = "";
                    });
                    cateNm[index].checked = true;
                    contents[index].classList.add('is-active');
                    tabs[index].classList.add('is-active');
                    tabs[index].style.backgroundColor = 'var(--main-pink)';
                });
            });

            const lat = JSON.parse(localStorage.getItem('my_addr'))['coords']['La'];
            const lng = JSON.parse(localStorage.getItem('my_addr'))['coords']['Ma'];

            const allStoreLat = document.querySelectorAll('#all_store_lat');
            const allStoreLng = document.querySelectorAll('#all_store_lng');

            const ctgStoreLat = document.querySelectorAll('#all_store_lat');
            const ctgStoreLng = document.querySelectorAll('#all_store_lng');

            const locat = document.querySelectorAll('#all__list__store__location');
            const locat2 = document.querySelectorAll('.list__store__location');

            const displayA = document.querySelectorAll('.displayA');
            const allDisplayA = document.querySelectorAll('.allDisplayA');

            function getDistanceFromLatLonInKm(lat1, lng1, lat2, lng2) {
                function deg2rad(deg) {
                    return deg * (Math.PI / 180)
                }

                var R = 6371; // Radius of the earth in km
                var dLat = deg2rad(lat2 - lat1); // deg2rad below
                var dLon = deg2rad(lng2 - lng1);
                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var d = R * c; // Distance in km
                return d;
            }
            for (let i = 0; i < allStoreLat.length; i++) {
                let result = getDistanceFromLatLonInKm(lat, lng, allStoreLat[i].value, allStoreLng[i].value);
                if(result < 5) {
                    locat[i].innerHTML += `${Math.round(result * 10) / 10} KM`;
                } else {
                    allDisplayA[i].style.display = 'none';
                }
            }

            for (let i = 0; i < ctgStoreLat.length; i++) {
                let result = getDistanceFromLatLonInKm(lat, lng, ctgStoreLat[i].value, ctgStoreLng[i].value);
                if(result < 5) {
                    locat2[i].innerHTML += `${Math.round(result * 10) / 10} KM`;
                } else {
                    displayA[i].style.display = 'none';
                }
            }
            
        </script>
    </div>
</body>

</html>