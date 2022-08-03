<?php
include_once "db/db_list.php";

$search_txt = $_GET['search_txt'];

$param = [
    'search_txt' => $search_txt
];

$result = search_result_list($param);
$result_count = search_result_count($param);
if(!$result_count['cnt']) {
    $mag = $result_count['cnt'] . "개가 검색되었습니다.";
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
    <script defer src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/screens/store_list.css">
    <title>59 - search</title>
    <style>
        .search_list_main {
            padding-top: 122px;
            margin: 0 32px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="search_list__header">
            <?php
            include_once "list_header.php";
            ?>
        </header>
        <main class="search_list_main">
            <div class="search__main__list">
                <div id="search_mag">
                    <?= $mag ?>
                </div>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    $store_num = $row['store_num'];
                    $param = [
                        'store_num' => $store_num
                    ];
                    $re_store = sel_result_store($param);
                    $row = mysqli_fetch_assoc($re_store);
                    $star = store_star($param);
                    if (!$star) {
                        $star = "";
                    } else {
                        $star = $star['star'];
                    } ?>
                    <a href="store-detail.php?store_num=<?= $row['store_num'] ?>" class="displayA">
                        <div class="list__item">
                            <div class="list__store__img">
                                <?php if($row['store_photo'] === 'null') {
                                    print "<img src='https://cdn.pixabay.com/photo/2020/04/17/19/48/city-5056657_960_720.png' alt=''>";
                                } else {
                                    print "<img src='img/store/{$row['store_nm']}/Main_img/{$row['store_photo']}'>";
                                } ?>
                            </div>
                            <div class="list__store__info">
                                <div class="store__info__nm"><?= $row['store_nm'] ?></div>
                                <div class="store__info__info"><?= $row['info'] ?></div>
                                <?php
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
                <?php } ?>
            </div>
        </main>
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
    </div>
</body>
    <script>
    const lat = JSON.parse(localStorage.getItem('my_addr'))['coords']['La'];
    const lng = JSON.parse(localStorage.getItem('my_addr'))['coords']['Ma'];
    const storeLat = document.querySelectorAll('#store_lat');
    const storeLng = document.querySelectorAll('#store_lng');
    const locat = document.querySelectorAll('.list__store__location');
    const displayA = document.querySelectorAll('.displayA');
    const divMag = document.querySelector('#search_mag');
    let count = 0;

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
        if(result < 5) {
            locat[i].innerHTML += `${Math.round(result * 10) / 10} KM`;
            count++;
        } else {
            displayA[i].style.display = 'none';
        }
    }
    divMag.innerHTML = `${count}개가 검색되었습니다.`;
    </script>
</html>