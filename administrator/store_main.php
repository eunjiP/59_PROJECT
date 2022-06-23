<?php
include_once "../db/db_store.php";
include_once "../db/db_store_login.php";
include_once "function.php";
include_once "../check_reserve_for_store.php";
session_start();

$login = $_SESSION['login_store'];

if (!isset($login)) {
    header("location: store_login.php");
}
$login_email = $login['store_email'];
$store_num = $login['store_num'];

$param = ["store_num" => $store_num];


$result = owner_login($login);

$store_name = $result['store_nm'];
$store_info = $result['store_info'];
$store_sales_day = $result['sales_day'];
$sales_time = $result['sales_time'];
$store_notice = $result['store_notice'];

//메인 페이지 카드별 이름 설정

$card_name1 = $store_name . " 가게 소개";
$card_name2 = "영업 요일";
$card_name3 = "가게 이미지";
$card_name4 = "영업시간";
$card_name5 = "영업 임시휴일";
$card_name6 = "공지 한마디";
$card_name7 = "메뉴 등록";
$card_name8 = "메뉴 편집";
$card_name9 = "쿠폰 추가";
$card_name10 = "주문 현황";
$card_name11 = "메뉴 접수";



//for문 돌리기위해 배열값 넣어줌

$week_value = [
    "월",
    "화",
    "수",
    "목",
    "금",
    "토",
    "일"
];
$week_id = [
    "mon",
    "tue",
    "wed",
    "thu",
    "fri",
    "sat",
    "sun"
];
$menu_cate = [
    "한식",
    "분식",
    "패스트푸드",
    "도시락",
    "중식",
    "양식",
    "일식",
    "커피/디저트",
    "네일샵",
    "헤어샵",
    "취미",
    "운동"
];
$menu_count_cd = [
    "회",
    "개"
];


// DB에서 데이터 불러오기용 문자열 자르기
$sales_day_arr = explode(" ", $store_sales_day);
$sales_time_arr = explode(",", $sales_time);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shrikhand&display=swap" rel="stylesheet">
    <!-- chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- 이미지 input -->

    <link rel="stylesheet" href="../css/components/image-input.css">
    <link rel="stylesheet" href="store.css">

    <title>사업자 메인 페이지</title>
</head>

<body>
    <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image_bg">
                    <img class="image" src="../img/logo.png" alt="logo">
                </span>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#store_notice">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">공지 한마디</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#store_info">
                            <i class='bx bx-bar-chart-alt-2 icon'></i>
                            <span class="text nav-text">가게 소개</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#store_img">
                            <i class='bx bx-bell icon'></i>
                            <span class="text nav-text">가게 이미지</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#store_week">
                            <i class='bx bx-pie-chart-alt icon'></i>
                            <span class="text nav-text">영업 요일</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#store_time">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">영업 시간</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#store_menu_input">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">메뉴 등록</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#store_menu_edit">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">메뉴 편집</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">주문내역</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">정산내역</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">쿠폰</span>

                        </a>
                    </li>
                </ul>
            </div>
            <!-- 로그아웃 버튼 -->
            <div class="bottom-content">

                <li class="">
                    <?= 로그아웃($login_email) ?>
                    </a>
                </li>
                <li class="mode">
                    <div class="moon-sun">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text">Dark Mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>





    <section class="container home">


        <!-- 상단 문구 -->
        <div class="">
            <?= 상단문구($store_name) ?>

            <div class="listing-card">

                <ul class="listing-card__list">
                    <!-- 월매출 그래프 -->
                    <li class="listing-card__item">
                        <div class="item__box">
                            <div class="graph-item">
                                <div class="graph-title">월간매출액</div>
                                <div class="graph-content">
                                    <h1 class="graph-value"><strong>2,540,700</strong>원</h1>
                                    <h3>+2.45%</h3>
                                </div>
                            </div>
                            <canvas id="monthly_sales"></canvas>
                        </div>
                    </li>
                    <script>
                        var bar_ctx = document.getElementById('monthly_sales').getContext('2d');
                        var gradient = bar_ctx.createLinearGradient(0, 0, 0, 500);
                        gradient.addColorStop(0, '#10B981');
                        gradient.addColorStop(1, '#fff');

                        var bar_chart = new Chart(bar_ctx, {
                            type: 'bar',
                            data: {
                                labels: ["11", "12", "1", "2", "3", "4"],
                                datasets: [{
                                    label: '월간 매출액',
                                    data: [12, 19, 3, 8, 14, 5],
                                    backgroundColor: gradient,
                                    hoverBackgroundColor: gradient,
                                    borderRadius: 10,
                                    hoverBorderWidth: 2,
                                    hoverBorderColor: 'green',
                                    barPercentage: 0.2
                                }]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        labels: {
                                            // This more specific font property overrides the global property
                                            font: {
                                                size: 12
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    </script>
                    <!-- 주간구독수 -->
                    <li class="listing-card__item">
                        <div class="item__box">
                            <div class="graph-item">
                                <div class="graph-title ">주간구독수</div>
                                <div class="graph-content">
                                    <h1 class="graph-value"><strong>82</strong>건</h1>
                                    <h3>+2.45%</h3>
                                </div>
                            </div>

                            <canvas id="monthly_sub"></canvas>
                        </div>
                    </li>
                    <script>
                        new Chart(document.getElementById("monthly_sub"), {
                            type: 'line',
                            data: {
                                labels: ['월', '화', '수', '목', '금', '토', '일'],
                                datasets: [{
                                    data: [20, 8, 16, 10, 14, 8, 14],
                                    label: "이번 주 구독수",
                                    borderColor: "#10B981",
                                    fill: false,
                                    tension: 0.2
                                }, {
                                    data: [13, 14, 10, 10, 5, 13, 10],
                                    label: "저번 주 구독수",
                                    borderColor: "#6AD2FF",
                                    fill: false,
                                    tension: 0.2
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: '주간 구독수'
                                    },
                                },
                                interaction: {
                                    intersect: false,
                                },
                                scales: {
                                    x: {
                                        display: true,
                                        title: {
                                            display: true
                                        }
                                    },
                                    y: {
                                        display: true,
                                        title: {
                                            display: true,
                                        },
                                        suggestedMin: 0,
                                        suggestedMax: 25
                                    }
                                }
                            },
                        });
                    </script>
                    <!-- 요청처리현황 -->
                    <li class="listing-card__item">
                        <div class="item__box">
                            <div class="list-header">
                                <div class="list-header__title">
                                    요청 처리 현황 <i class="fa-solid fa-angle-right"></i>
                                </div>
                                <div class="list-header__month">
                                    최근 1개월
                                </div>
                            </div>
                            <div class="sub-status__box">
                                <div class="box-item">
                                    <div class="box-item__title yellow-box">대기</div>
                                    <div><strong>1</strong>건</div>
                                </div>
                                <div class="box-item">
                                    <div class="box-item__title green-box">진행</div>
                                    <div><strong>3</strong>건</div>
                                </div>
                                <div class="box-item">
                                    <div class="box-item__title red-box">반려</div>
                                    <div><strong>0</strong>건</div>
                                </div>
                                <div class="box-item">
                                    <div class="box-item__title gray-box">취소</div>
                                    <div><strong>1</strong>건</div>
                                </div>
                                <div class="box-item">
                                    <div class="box-item__title gray-box">승인</div>
                                    <div><strong>5</strong>건</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- 전체리뷰 -->
                    <li class="listing-card__item">
                        <div class="item__box">
                            <div class="list-header">
                                <div class="list-header__title">
                                    전체 리뷰 <i class="fa-solid fa-angle-right"></i>
                                </div>
                            </div>
                            <div class="sub-status__box">
                                <div class="box-item">
                                    <div class="box-item__title gray-box">전체</div>
                                    <div><strong>150</strong>건</div>
                                </div>
                                <div class="box-item">
                                    <div class="box-item__title yellow-box">대기</div>
                                    <div><strong>25</strong>건</div>
                                </div>
                                <div class="box-item ">
                                    <div class="box-item__title red-box">차단</div>
                                    <div><strong>1</strong>건</div>
                                </div>
                            </div>
                        </div>
                    </li> 
                    <!-- 공지 -->
                    <li class="listing-card__item">
                        <?= 공지($card_name6, $store_notice) ?>
                    </li>
                    <!-- 가게 소개 -->
                    <li class="listing-card__item">
                        <?= 가게소개($card_name1, $store_info) ?>
                    </li>
                    <!-- 가게 이미지 -->
                    <li class="listing-card__item">
                        <?= 가게이미지($card_name3, $store_name) ?>
                        <script src="../js/image-input.js"></script>
                    </li>


                    <!-- 영업 요일 -->
                    <li class="listing-card__item">
                        <?= 영업요일($card_name2, $week_value, $week_id, $sales_day_arr) ?>
                    </li>

                    <!-- 영업 시간 -->
                    <li class="listing-card__item">
                        <?= 영업시간($card_name4, $sales_time_arr) ?>
                    </li>


                    <!-- 메뉴 등록 -->
                    <li class="listing-card__item">
                        <?= 메뉴등록($card_name7, $menu_cate, $menu_count_cd) ?>
                    </li>


                    <!-- 메뉴 편집 -->

                    <li class="listing-card__item">


                        <div id='store_menu_edit' class='listing-card__info--top'>
                            <strong class='listing-card__name'> <?= $card_name8 ?> > </strong>

                        </div>
                        <?php

                        $row = menu_edit($param);
                        foreach ($row as $item) {
                            $menu_num = $item['menu_num'];
                            $store_menu_cate = $item['menu_cate'];
                            $menu_nm = $item['menu_nm'];
                            $price = $item['price'];
                            $subed_price = $item['subed_price'];
                            $subed_count = $item['subed_count'];
                            $cd_unit = $item['cd_unit'];
                            $menu_intro = $item['menu_intro'];
                            $menu_photo = $item['menu_photo'];
                            $menu_img =  "../img/store/" . $store_name . "/Menu_img/" . $menu_photo;
                            $adr = "this.src='https://cdn.pixabay.com/photo/2015/12/22/04/00/photo-1103594_960_720.png'";


                            echo '<div><img class="menu_img" src="' . $menu_img . '" onerror="' . $adr . '" >';

                            // $_GET[menu_detail]

                            echo "$menu_nm 1달 구독 <span class='detail__icon' ><i class='fa-solid fa-bars'></i></span><br>  <div class='detail_ctnt'>
                            <form action='store_menu_edit.php' method='post' enctype='multipart/form-data'>";

                            메뉴편집($menu_num, $menu_nm, $menu_intro, $price, $subed_price, $store_menu_cate, $subed_count, $cd_unit);
                            echo "</div></form>";
                        }
                        ?>
                        </form>
                    </li>

                    <!-- 주문 현황 -->
                    <!-- 
                    구독자 이름 (t_user 의 user_nm)
                    예약 시간 09:30 (t_usedsub 에서 reservation_date)  취소/접수 버튼
                    구독 메뉴 아메리카노(t_menu의 menu_nm) 총 12회(t_menu의 subed_count / cd_unit) 남음
                    취소사유 -->
                    <li class="listing-card__item">

                        <div class='listing-card__info'>
                            <div class='listing-card__info--top'></div>
                                <strong class='listing-card__name'> 주문 현황 > </strong>
                                    
                                    <?php
                                        $row = reserve_menu($store_num);
                                        if(isset($row)){
                                            foreach($row as $item){
                                                if(isset($item['subed_count']) && isset($item['reservation_date'])){
                                                    
                                                    $remain_count = $item['remaining_count'];
                                                    $reserve_at = substr($item['reservation_date'],11,5);                                                        
                                                    $menu_num = $item['menu_num'];
                                                    $user_num = $item['user_num'];
                                                    $sub_num = $item['sub_num'];
                                                    $cd_sub_status = $item['cd_sub_status'];
                                                    $menu_nm = reserve_menu2($menu_num);
                                                    $user_nm = reserve_menu3($user_num);
                                                    $cd_unit_int = reserve_menu4($user_num);
                                                    $cd_unit_int==1 ? $cd_unit = "회" : $cd_unit = "개";
                                                    if($cd_sub_status==0){
                                                    echo "  <div> $user_nm 님$sub_num</div> 
                                                            <div> 예약 시간 $reserve_at 
                                                                <form action='store_menu_reserve.php' method='post'>
                                                                    <input name='reserve' value='$sub_num' style='display:none;'></input>
                                                                    <button class='btn' >취소</button>
                                                                    <button class='btn' onclick='<script>clickReserve()</script>'>접수</button>
                                                                </form>
                                                                
                                                            </div> 
                                                            <div>구독 메뉴 $menu_nm 총 $remain_count$cd_unit 남음 </div>";
                                                    }
                                                }
                                                
                                            }
                                        }
                                        
                                    ?>
                                    </form>
                                    
                                    
                                
                            <div> &nbsp </div>

                    </li>

                    <!-- 주문 완료

                    <li class="listing-card__item">
                        <div class='listing-card__info--top'>
                            <strong class='listing-card__name'> 주문 접수 > </strong>
                                <span>
                                    <button class='btn' type='reset' >취소</button>
                                    <button class='btn' type='submit' >등록</button>
                                </span>
                        </div>
                        <div> &nbsp </div>
                    </li> -->

            </div>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/6a1759ba21.js" crossorigin="anonymous"></script>
    <script src="store.js"></script>
    <script src="../image-input/image-input.js"></script>
</body>

</html>