<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/styles.css">
	<title>59 - Map</title>
	<script src="https://kit.fontawesome.com/57749be668.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/styles.css">
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
		var container = document.getElementById('map');
		var options = {
			center: new kakao.maps.LatLng(35.868354, 128.594054),
			level: 3
		};

		var map = new kakao.maps.Map(container, options);

		// //마커1개
		// // 마커가 표시될 위치입니다 
		// var markerPosition  = new kakao.maps.LatLng(35.868354, 128.594054); 

		// // 마커를 생성합니다
		// var marker = new kakao.maps.Marker({
		// 	position: markerPosition
		// });

		// // 마커가 지도 위에 표시되도록 설정합니다
		// marker.setMap(map);

		// // 아래 코드는 지도 위의 마커를 제거하는 코드입니다
		// // marker.setMap(null);   

		//마커를 여러개
		// 마커를 표시할 위치와 title 객체 배열입니다 
		var positions = [{
				title: '그린컴퓨터학원',
				latlng: new kakao.maps.LatLng(35.868354, 128.594054)
			},
			{
				title: '삼송빵집 본점',
				latlng: new kakao.maps.LatLng(35.868634, 128.593509)
			},
			{
				title: '킨다소바',
				latlng: new kakao.maps.LatLng(35.868765, 128.593948)
			},
			{
				title: '머핀레스토랑',
				latlng: new kakao.maps.LatLng(35.868100, 128.594178)
			}
		];

		// 마커 이미지의 이미지 주소입니다
		var imageSrc = "https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/markerStar.png";

		for (var i = 0; i < positions.length; i++) {

			// 마커 이미지의 이미지 크기 입니다
			var imageSize = new kakao.maps.Size(24, 35);

			// 마커 이미지를 생성합니다    
			var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize);

			// 마커를 생성합니다
			var marker = new kakao.maps.Marker({
				map: map, // 마커를 표시할 지도
				position: positions[i].latlng, // 마커를 표시할 위치
				title: positions[i].title, // 마커의 타이틀, 마커에 마우스를 올리면 타이틀이 표시됩니다
				image: markerImage // 마커 이미지 
			});
		}
	</script>
</body>

</html>