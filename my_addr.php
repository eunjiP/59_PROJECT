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
    <title>59 - My address</title>
</head>

<body>
    <div class="container">
        <header>
            <?php
            $page_name = "구독 주소 설정";
            include_once "header.php";
            ?>
        </header>
        <main class="my_addr--main">
            <form action="my_addr_proc.php" method="post">
                <div class="my_addr--form--input">
                    <div class="input--top">
                        <i class='fa-solid fa-magnifying-glass'></i>
                        <input type="text" id="my_address" name="my_addr" placeholder="건물명, 도로명 또는 지번으로 검색">
                    </div>
                </div>
                <div class="my_addr--form--button">
                    <input class="my_addr--button" type="submit" value="주소 설정">
                </div>
            </form>
            <div id="my_address-box">
                <div>현재 위치로 주소설정 원하는 경우</div>
                <div>아래의 버튼을 누르고 위치 정보에 동의 해주세요</div>
                <button class="my_addr--button" onclick="getLocation()">현재 위치로 주소설정</button>
                <div id="current-location"></div>
                <div id="current-addr"></div>
            </div>
        </main>
        <footer>
            <?php
            include_once "footer.html";
            ?>
        </footer>
    </div>
    <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=7bfb673c0f6bf2c1ea0c0bdce834d211&libraries=services"></script>
    <script>
        const currentLocation = document.querySelector("#current-location");
        const currentAddr = document.querySelector("#current-addr");

        // 주소-좌표 변환 객체를 생성합니다
        var geocoder = new kakao.maps.services.Geocoder();

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                currentLocation.innerHTML = "Geolocation is not supported by this browser.";
            }

        }

        function showPosition(position) {
            currentLocation.innerHTML = `<div>Latitude: ${position.coords.latitude}</div><div>Longitude: ${position.coords.longitude}</div>`;
            // 좌표로 주소 데이터 확인
            let lat = position.coords.latitude;
            let lng = position.coords.longitude;
            getAddr(lat, lng);
            // 좌표로 도로명, 지번주소 가져오는 함수
            function getAddr(lat, lng) {
                let geocoder = new kakao.maps.services.Geocoder();
                let coord = new kakao.maps.LatLng(lat, lng);
                console.log(coord);
                let callback = function(result, status) {
                    if (status === kakao.maps.services.Status.OK) {
                        var detailAddr = !!result[0].road_address ? '<div>도로명주소 : ' + result[0].road_address.address_name + '</div>' : '';
            detailAddr += result[0].address.address_name;
                        console.log(detailAddr);
                        // currentAddr.innerHTML = detailAddr;
                        my_address.value = detailAddr;
                        // ------------- 좌표를 로컬스토리지에 저장 -------------
                        const getAddr = localStorage.getItem('my_addr');
                        let parseAddr = JSON.parse(getAddr);
                        const setAddr = {
                            // 도로명 주소가 없을 시 지번주소로 저장
                            title: !!result[0].road_address ? result[0].road_address.address_name : result[0].address.address_name,
                            // 위도와 경도 저장
                            coords: coord
                        };
                        let stringifyAddr = JSON.stringify(setAddr);
                        if (getAddr !== stringifyAddr) {
                            localStorage.clear();
                            localStorage.setItem('my_addr', stringifyAddr);
                        } else {
                            localStorage.setItem('my_addr', stringifyAddr);
                        }
                        // location.href = 'home.php';
                    }

                }
                geocoder.coord2Address(coord.getLng(), coord.getLat(), callback);

            }
        }


    </script>

</body>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script>
    window.onload = function() {
        document.getElementById("my_address").addEventListener("click", function() { //주소입력칸을 클릭하면
            //카카오 지도 발생
            new daum.Postcode({
                oncomplete: function(data) { //선택시 입력값 세팅
                    document.getElementById("my_address").value = data.address; // 주소 넣기
                }
            }).open();
        });
    }
</script>

</html>