<?php
$my_address = $_POST['my_addr'];
// if (![$_GET['user_addr']]) {
//     $user_addr = $_GET['user_addr'];
// }
?>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=7bfb673c0f6bf2c1ea0c0bdce834d211&libraries=services"></script>
<script>
    // 주소-좌표 변환 객체를 생성합니다
    var geocoder = new kakao.maps.services.Geocoder();
    console.log(geocoder);
    // 주소로 좌표를 검색합니다
    console.log('<?= $my_address ?>');
    geocoder.addressSearch('<?= $my_address ?>', function(result, status) {
        console.log(result);
        // 정상적으로 검색이 완료됐으면 
        if (status === kakao.maps.services.Status.OK) {
            var coords = new kakao.maps.LatLng(result[0].x, result[0].y);
        }
        // ------------- 좌표를 로컬스토리지에 저장 -------------
        const getAddr = localStorage.getItem('my_addr');
        let parseAddr = JSON.parse(getAddr);
        const setAddr = {
            title: '<?= $my_address ?>',
            // 위도와 경도 저장
            coords: coords
        };
        let stringifyAddr = JSON.stringify(setAddr);
        if (getAddr !== stringifyAddr) {
            localStorage.clear();
            localStorage.setItem('my_addr', stringifyAddr);
        } else {
            localStorage.setItem('my_addr', stringifyAddr);
        }
        location.href = 'home.php';
    });
</script>