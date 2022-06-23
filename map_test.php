<?php
	include_once "db/db_list.php";

	$result = sel_store_list();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/screens/map_maker.css">
	<script src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
	<title>59 - Map</title>
</head>
<body>
	<div class="container">
		<header class="store--header">
			<?php include_once "store-header.html" ?>
		</header>
		<main class="map-main">
			<div id="map"></div>
		</main>
		<footer>
			<?php include_once "footer.html" ?>
		</footer>
	</div>

	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=7bfb673c0f6bf2c1ea0c0bdce834d211"></script>
	<script>
		if(localStorage.getItem('my_addr') === null) {
			alert('주소 등록 후 이용해주세요');
        	window.location.href = `home.php`;
		}
		const lat = JSON.parse(localStorage.getItem('my_addr'))['coords']['La'];
        const lng = JSON.parse(localStorage.getItem('my_addr'))['coords']['Ma'];

		var container = document.getElementById('map');
		var options = {
			center: new kakao.maps.LatLng(lat, lng),
			level: 3
		};

		let re = <?=$result?>;
		console.log(re);

		var map = new kakao.maps.Map(container, options);

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
		let num = 1;
		// while(<?=$row = mysqli_fetch_assoc($result)?>) {
		// 	const distance = getDistanceFromLatLonInKm(lat, lng, <?=$row['store_lat']?>, <?=$row['store_lng']?>);
		// 	if(distance < 5) {
		// 		var marker= new kakao.maps.Marker({
		// 			map: map, 
		// 			position: new kakao.maps.LatLng(<?=$row['store_lat']?>, <?=$row['store_lng']?>)
		// 		});

		// 		var content = '<div class="wrap">' + 
		// 		'    <div class="info">' + 
		// 		'        <div class="title">' + 
		// 		'            <?=$row['store_nm']?>' + 
		// 		'            <div class="close" onclick="closeOverlay()" title="닫기"></div>' + 
		// 		'        </div>' + 
		// 		'        <div class="body">' + 
		// 		'            <div class="img">' +
		// 		'                <img src="https://th.bing.com/th/id/R.d3261088f85b2e66916ffe94f3a02694?rik=J6IM%2bUQ9wKhKbQ&riu=http%3a%2f%2fdaejeonc.greenart.co.kr%2fupimage%2fnew_campus%2f20180117134431%5b1%5d.jpg&ehk=pOFT3q%2bsLYy3%2fPulFPDQSLtvmNG7z2YgB0BVH4tFAYw%3d&risl=&pid=ImgRaw&r=0" width="73" height="70">' +
		// 		'           </div>' + 
		// 		'            <div class="desc">' + 
		// 		'                <div class="ellipsis">대구광역시 중구 중앙대로 394</div>' + 
		// 		'                <div class="jibun ellipsis">053-572-1005</div>' + 
		// 		'                <div><a href="https://daegu.greenart.co.kr/" target="_blank" class="link">홈페이지</a></div>' + 
		// 		'            </div>' + 
		// 		'        </div>' + 
		// 		'    </div>' +    
		// 		'</div>';

		// 		var overlay = new kakao.maps.CustomOverlay({
		// 			content: content,
		// 			map: map,
		// 			position: marker.getPosition()       
		// 		});

		// 		kakao.maps.event.addListener(marker, 'click', function() {
		// 			overlay.setMap(map);
		// 		});

		// 		function closeOverlay() {
		// 			overlay.setMap(null);     
		// 		};
		// 	}
		// }



		// 지도에 마커를 표시합니다 
		var marker = new kakao.maps.Marker({
			map: map, 
			position: new kakao.maps.LatLng(35.868354, 128.594054)
		});

		var content = '<div class="wrap">' + 
            '    <div class="info">' + 
            '        <div class="title">' + 
            '            그린컴퓨터아트학원' + 
            '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' + 
            '        </div>' + 
            '        <div class="body">' + 
            '            <div class="img">' +
            '                <img src="https://th.bing.com/th/id/R.d3261088f85b2e66916ffe94f3a02694?rik=J6IM%2bUQ9wKhKbQ&riu=http%3a%2f%2fdaejeonc.greenart.co.kr%2fupimage%2fnew_campus%2f20180117134431%5b1%5d.jpg&ehk=pOFT3q%2bsLYy3%2fPulFPDQSLtvmNG7z2YgB0BVH4tFAYw%3d&risl=&pid=ImgRaw&r=0" width="73" height="70">' +
            '           </div>' + 
            '            <div class="desc">' + 
            '                <div class="ellipsis">대구광역시 중구 중앙대로 394</div>' + 
            '                <div class="jibun ellipsis">053-572-1005</div>' + 
            '                <div><a href="https://daegu.greenart.co.kr/" target="_blank" class="link">홈페이지</a></div>' + 
            '            </div>' + 
            '        </div>' + 
            '    </div>' +    
            '</div>';

		// var positions = [
		// 	{
		// 		title: '그린컴퓨터학원', 
		// 		latlng: new kakao.maps.LatLng(35.868354, 128.594054)
		// 	},
		// 	{
		// 		title: '삼송빵집 본점', 
		// 		latlng: new kakao.maps.LatLng(35.868634, 128.593509)
		// 	},
		// 	{
		// 		title: '킨다소바', 
		// 		latlng: new kakao.maps.LatLng(35.868765, 128.593948)
		// 	},
		// 	{
		// 		title: '머핀레스토랑',
		// 		latlng: new kakao.maps.LatLng(35.868100, 128.594178)
		// 	}
		// ];

		// 마커 위에 커스텀오버레이를 표시합니다
		// 마커를 중심으로 커스텀 오버레이를 표시하기위해 CSS를 이용해 위치를 설정했습니다
		var overlay = new kakao.maps.CustomOverlay({
			content: content,
			map: map,
			position: marker.getPosition()       
		});

		// 마커를 클릭했을 때 커스텀 오버레이를 표시합니다
		kakao.maps.event.addListener(marker, 'click', function() {
			overlay.setMap(map);
		});

		// 커스텀 오버레이를 닫기 위해 호출되는 함수입니다 
		function closeOverlay() {
			overlay.setMap(null);     
		};


		var marker2 = new kakao.maps.Marker({
			map: map, 
			position: new kakao.maps.LatLng(35.868765, 128.593948)
		});

		var content2 = '<div class="wrap">' + 
            '    <div class="info">' + 
            '        <div class="title">' + 
            '            칸다소바' + 
            '            <div class="close" onclick="closeOverlay()" title="닫기"></div>' + 
            '        </div>' + 
            '        <div class="body">' + 
            '            <div class="img">' +
            '                <img src="https://th.bing.com/th/id/R.d3261088f85b2e66916ffe94f3a02694?rik=J6IM%2bUQ9wKhKbQ&riu=http%3a%2f%2fdaejeonc.greenart.co.kr%2fupimage%2fnew_campus%2f20180117134431%5b1%5d.jpg&ehk=pOFT3q%2bsLYy3%2fPulFPDQSLtvmNG7z2YgB0BVH4tFAYw%3d&risl=&pid=ImgRaw&r=0" width="73" height="70">' +
            '           </div>' + 
            '            <div class="desc">' + 
            '                <div class="ellipsis">대구광역시 중구 중앙대로 394</div>' + 
            '                <div class="jibun ellipsis">053-572-1005</div>' + 
            '                <div><a href="https://daegu.greenart.co.kr/" target="_blank" class="link">홈페이지</a></div>' + 
            '            </div>' + 
            '        </div>' + 
            '    </div>' +    
            '</div>';
		
		var overlay = new kakao.maps.CustomOverlay({
			content: content2,
			map: map,
			position: marker2.getPosition()       
		});

		kakao.maps.event.addListener(marker2, 'click', function() {
			overlay.setMap(map);
		});

		// function closeOverlay() {
		// 	overlay.setMap(null);     
		// }

	</script>
</body>
</html>