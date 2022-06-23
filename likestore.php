<?php
include_once "db/db_list.php";
$page_name = "찜 가게 list";
session_start();
if (isset($_SESSION['login_user'])) {
    $login_user = $_SESSION['login_user'];
} else {
    echo "<script>
        alert('로그인 후 이용 가능합니다.');
        window.location.href = 'login.php';
        </script>";
}
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
    <link rel="stylesheet" href="css/screens/likestore.css">
    <link rel="stylesheet" href="css/screens/store_list.css">
    <title>59 - 찜리스트</title>
</head>

<body>
    <div class="container">
        <header>
            <?php
            include_once "header.php";
            ?>
        </header>
        <main class="likestore_main">
            <?php
            $user_num = $login_user['user_num'];
            $param = [
                'user_num' => $user_num
            ];
            if (search_like($param)['cnt'] === '0') { ?>
                <div class="likestore__null">
                    <div class="likestore__null__bigfont">찜한 구독이 없어요</div>
                    <div class="likestore__null__smallfont">하트를 눌러 마음에 드는 구독을 찜해보세요.</div>
                </div>
            <?php } else { ?>
                <div class="likestore_list">
                    <?php $result = sel_like_stores($param);
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <a href="store-detail.php?store_num=<?= $row['store_num'] ?>">
                            <div class="list__item">
                                <div class="list__store__img"><img src="img/store/<?=$row['store_nm']?>/Main_img/<?=$row['store_photo']?>"></div>
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
        </main>
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
    </div>
    <script>
        const lat = JSON.parse(localStorage.getItem('my_addr'))['coords']['La'];
        const lng = JSON.parse(localStorage.getItem('my_addr'))['coords']['Ma'];

        const storeLat = document.querySelectorAll('#store_lat');
        const storeLng = document.querySelectorAll('#store_lng');
        const locat = document.querySelectorAll('.list__store__location');


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
            locat[i].innerHTML += `${Math.round(result * 10) / 10} KM`;
        }
    </script>
</body>

</html>