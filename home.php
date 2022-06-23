<?php
session_start();
$login_user = $_SESSION['login_user'];
?>
<!-- 은지 - Home -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>59 - HOME</title>
    <script src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/screens/store_list.css">

</head>

<body>
    <div class="container">
        <header class="home--header">
            <?php
            include_once "main-header.html";
            ?>
        </header>
        <main class="home--main">
            <div id="top">
                <a href="search.php">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="home__main__top">Search</span>
                    <i class="fa-solid fa-sliders"></i>
                </a>
            </div>
            <?php
            include_once "main-banner.php";
            ?>
            <!-- main 카테고리 -->
            <div class="home__categories">
                <?php
                include_once "db/db_list.php";
                $result = sel_categories();

                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="category">
                        <a href="list.php?cate_nm=<?= $row['cate_nm'] ?>">
                            <div class="category__img"><img src="img/banner_icon/<?= $row['cate_nm'] ?>.png"></div>
                            <div class="category__name"><?= $row['cate_nm'] ?></div>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <!-- 맞춤 추천 부분 -->
            <div class="recommend">
                <?php
                if (isset($_SESSION['login_user'])) { ?>
                    <div class="recommend--nav">
                        <div>맞춤 추천</div>
                    </div>
                    <div class="recommend--list">
                        <?php
                        include_once("db/db_list.php");
                        $user_num = $login_user['user_num'];
                        $param = [
                            'user_num' => $user_num
                        ];
                        $users_num = sel_user_recom($param);

                        while ($row = mysqli_fetch_assoc($users_num)) {
                            $param = [
                                'store_num' => $row['store_num']
                            ];
                            $stores = sel_result_store($param);
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
                                        <input type="hidden" name="" value="<?= $row['store_lat'] ?>" id="store_lat">
                                        <input type="hidden" name="" value="<?= $row['store_lng'] ?>" id="store_lng">
                                        <div class="list__store__location"><i class="fa-solid fa-location-dot"></i> </div>
                                    </div>
                                </a>
                        <?php }
                        } ?>
                    </div>
                <?php } else { 
                    ?>
                    <script>
                        if (localStorage.getItem('my_addr') !== null) {
                           document.write('<div class="recommend--nav">거리순 추천</div>')
                           document.write('</div>');
                           <?php  
                            $dis_result = sel_store_list();
                            while($d_row = mysqli_fetch_assoc($dis_result)) {
                            $store_nm = $d_row['store_nm']; 
                            $store_num = $d_row['store_num'];
                            $store_lat = $d_row['store_lat'];
                            $store_lng = $d_row['store_lng'];
                            $store_info = $d_row['info'];
                            $s_photo = $d_row['store_photo'];

                            $param = [
                                'store_num' => $store_num
                            ];
                            $star = store_star($param);
                            if (!$star) {
                                $star = "";
                            } else {
                                $star = $star['star'];
                            }
                            ?>
                            document.write('<a href="store-detail.php?store_num=<?= $store_num ?>" class="displayA">');
                            document.write('<div class="list__item">');
                            document.write('<div class="list__store__img">');
                            <?php if($s_photo == 'null') { ?>
                                document.write('<img src="img/store_main.webp">');
                            <?php } else { ?>
                                document.write('<img src="img/store/<?=$store_nm?>/Main_img/<?=$s_photo?>">');
                            <?php } ?>
                            document.write('</div>');
                            document.write('<div class="list__store__info">');
                            document.write('<div class="store__info__nm"><?= $store_nm ?></div>');
                            document.write('<div class="store__info__info"><?= $store_info ?></div>');         
                            <?php if($star == "") { ?>
                                 document.write('<div class="store__info__star_rating"><i class="fa-solid fa-star"></i></div>');
                            <?php } else { ?>
                                document.write('<div class="store__info__star_rating"><i class="fa-solid fa-star"><?= intval($star) ?></i></div>')
                            <?php } ?>
                            document.write('</div>');
                            document.write('<input type="hidden" name="" value="<?= $store_lat ?>" id="store_lat">');
                            document.write('<input type="hidden" name="" value="<?= $store_lng ?>" id="store_lng">');
                            document.write('<div class="list__store__location"><i class="fa-solid fa-location-dot"></i> </div>');
                            document.write('</div>');
                            document.write('</a>');                           
                        <?php }?>
                        } else {
                            document.write('<div class="recommend--nav">로그인, 거리설정 전</div>');
                            document.write('</div>');
                            document.write('<div>로그인 또는 거리 설정 시에는 더 많은 맞춤추천이 가능합니다!</div>')
                        }
                    </script>
                <?php } ?>
            </div>
            <div id="kakao-talk-channel-chat-button" data-channel-public-id="_kxastb" data-title="consult" data-size="small" data-color="yellow" data-shape="pc" data-support-multiple-densities="true" class="home__main__kakao"></div>
        </main>
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
    </div>
    <script src="js/slideShow.js"></script>
    <script>
        window.kakaoAsyncInit = function() {
            Kakao.Channel.createChatButton({
                container: '#kakao-talk-channel-chat-button',
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://developers.kakao.com/sdk/js/kakao.channel.min.js';
            fjs.parentNode.insertBefore(js, fjs);
        })(document, 'script', 'kakao-js-sdk');

        const lat = JSON.parse(localStorage.getItem('my_addr'))['coords']['La'];
        const lng = JSON.parse(localStorage.getItem('my_addr'))['coords']['Ma'];

        const storeLat = document.querySelectorAll('#store_lat');
        const storeLng = document.querySelectorAll('#store_lng');
        const locat = document.querySelectorAll('.list__store__location');
        const displayA = document.querySelectorAll('.displayA');

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
        for (let i = 0; i < storeLat.length; i++) {
            let result = getDistanceFromLatLonInKm(lat, lng, storeLat[i].value, storeLng[i].value);
            if (result < 5) {
                locat[i].innerHTML += `${Math.round(result * 10) / 10} KM`;
            } else {
                displayA[i].style.display = 'none';
            }
        }
    </script>
</body>

</html>