<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/styles.css">
	<title>59 - Map</title>
	<style>
#mapwrap{position:relative;overflow:hidden;}
.category, .category *{margin:0;padding:0;color:#000;}   
.category {position:absolute;overflow:hidden;top:10px;left:10px;width:110px;height:50px;z-index:10;border:1px solid black;font-family:'Malgun Gothic','맑은 고딕',sans-serif;font-size:12px;text-align:center;background-color:#fff;}
.category .menu_selected {background:#FF5F4A;color:#fff;border-left:1px solid #915B2F;border-right:1px solid #915B2F;margin:0 -1px;} 
.category li{list-style:none;float:left;width:50px;height:45px;padding-top:5px;cursor:pointer;} 
.category .ico_comm {display:block;margin:0 auto 2px;width:22px;height:26px;background:url('https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/category.png') no-repeat;} 
.category .ico_coffee {background-position:-10px 0;}  
.category .ico_store {background-position:-10px -36px;}   
.category .ico_carpark {background-position:-10px -72px;} 
</style>
</head>
<body>
<div id="mapwrap"> 
    <!-- 지도가 표시될 div -->
    <div id="map" style="width: var(--mobile-width);
    height: var(--mobile-height);"></div>
    <!-- 지도 위에 표시될 마커 카테고리 -->
    <div class="category">
        <ul>
            <li id="coffeeMenu" onclick="changeMarker('coffee')">
                <span class="ico_comm ico_coffee"></span>
                커피숍
            </li>
            <li id="storeMenu" onclick="changeMarker('store')">
                <span class="ico_comm ico_store"></span>
                편의점
            </li>
            <!-- <li id="carparkMenu" onclick="changeMarker('carpark')">
                <span class="ico_comm ico_carpark"></span>
                주차장
            </li> -->
        </ul>
    </div>
</div>

	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=7bfb673c0f6bf2c1ea0c0bdce834d211"></script>
	<script>
		var container = document.getElementById('map');
		var options = {
			center: new kakao.maps.LatLng(35.868354, 128.594054),
			level: 3
		};

		var map = new kakao.maps.Map(container, options);

		// 커피숍 마커가 표시될 좌표 배열입니다
		var coffeePositions = [ 
			new kakao.maps.LatLng(35.868805, 128.593865),
			new kakao.maps.LatLng(35.869403, 128.594279),
			new kakao.maps.LatLng(35.869516, 128.593548),
			new kakao.maps.LatLng(35.869236, 128.593123),
			new kakao.maps.LatLng(35.868057, 128.593847),
			new kakao.maps.LatLng(35.867538, 128.594071),
			new kakao.maps.LatLng(35.867329, 128.594166)                
		];

		// 편의점 마커가 표시될 좌표 배열입니다
		var storePositions = [
			new kakao.maps.LatLng(35.868308, 128.593458),
			new kakao.maps.LatLng(35.868320, 128.594012),
			new kakao.maps.LatLng(35.868044, 128.593852),
			new kakao.maps.LatLng(35.866346, 128.593688),
			new kakao.maps.LatLng(35.866326, 128.592815),
			new kakao.maps.LatLng(35.866441, 128.592479),
			new kakao.maps.LatLng(35.867566, 128.596410)
		];
		// var carparkPositions = [];

		var markerImageSrc = 'https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/category.png';  // 마커이미지의 주소입니다. 스프라이트 이미지 입니다
			coffeeMarkers = [], // 커피숍 마커 객체를 가지고 있을 배열입니다
			storeMarkers = [],
			// carparkMarkers = [];

			
		createCoffeeMarkers(); // 커피숍 마커를 생성하고 커피숍 마커 배열에 추가합니다
		createStoreMarkers(); // 편의점 마커를 생성하고 편의점 마커 배열에 추가합니다
		// createCarparkMarkers();

		changeMarker('coffee'); // 지도에 커피숍 마커가 보이도록 설정합니다    

		// 마커이미지의 주소와, 크기, 옵션으로 마커 이미지를 생성하여 리턴하는 함수입니다
		function createMarkerImage(src, size, options) {
			var markerImage = new kakao.maps.MarkerImage(src, size, options);
			return markerImage;            
		}

		// 좌표와 마커이미지를 받아 마커를 생성하여 리턴하는 함수입니다
		function createMarker(position, image) {
			var marker = new kakao.maps.Marker({
				position: position,
				image: image
			});
			
			return marker;  
		}   
		
		// 커피숍 마커를 생성하고 커피숍 마커 배열에 추가하는 함수입니다
		function createCoffeeMarkers() {
			
			for (var i = 0; i < coffeePositions.length; i++) {  
				
				var imageSize = new kakao.maps.Size(22, 26),
					imageOptions = {  
						spriteOrigin: new kakao.maps.Point(10, 0),    
						spriteSize: new kakao.maps.Size(36, 98)  
					};     
				
				// 마커이미지와 마커를 생성합니다
				var markerImage = createMarkerImage(markerImageSrc, imageSize, imageOptions),    
					marker = createMarker(coffeePositions[i], markerImage);  
				
				// 생성된 마커를 커피숍 마커 배열에 추가합니다
				coffeeMarkers.push(marker);
			}     
		}

		// 커피숍 마커들의 지도 표시 여부를 설정하는 함수입니다
		function setCoffeeMarkers(map) {        
			for (var i = 0; i < coffeeMarkers.length; i++) {  
				coffeeMarkers[i].setMap(map);
			}        
		}

		// 편의점 마커를 생성하고 편의점 마커 배열에 추가하는 함수입니다
		function createStoreMarkers() {
			for (var i = 0; i < storePositions.length; i++) {
				
				var imageSize = new kakao.maps.Size(22, 26),
					imageOptions = {   
						spriteOrigin: new kakao.maps.Point(10, 36),    
						spriteSize: new kakao.maps.Size(36, 98)  
					};       
			
				// 마커이미지와 마커를 생성합니다
				var markerImage = createMarkerImage(markerImageSrc, imageSize, imageOptions),    
					marker = createMarker(storePositions[i], markerImage);  

				// 생성된 마커를 편의점 마커 배열에 추가합니다
				storeMarkers.push(marker);    
			}        
		}

		// 편의점 마커들의 지도 표시 여부를 설정하는 함수입니다
		function setStoreMarkers(map) {        
			for (var i = 0; i < storeMarkers.length; i++) {  
				storeMarkers[i].setMap(map);
			}        
		}
// 편의점 마커들의 지도 표시 여부를 설정하는 함수입니다
function setStoreMarkers(map) {        
    for (var i = 0; i < storeMarkers.length; i++) {  
        storeMarkers[i].setMap(map);
    }        
}

// // 주차장 마커를 생성하고 주차장 마커 배열에 추가하는 함수입니다
// function createCarparkMarkers() {
//     for (var i = 0; i < carparkPositions.length; i++) {
        
//         var imageSize = new kakao.maps.Size(22, 26),
//             imageOptions = {   
//                 spriteOrigin: new kakao.maps.Point(10, 72),    
//                 spriteSize: new kakao.maps.Size(36, 98)  
//             };       
     
//         // 마커이미지와 마커를 생성합니다
//         var markerImage = createMarkerImage(markerImageSrc, imageSize, imageOptions),    
//             marker = createMarker(carparkPositions[i], markerImage);  

//         // 생성된 마커를 주차장 마커 배열에 추가합니다
//         carparkMarkers.push(marker);        
//     }                
// }

// // 주차장 마커들의 지도 표시 여부를 설정하는 함수입니다
// function setCarparkMarkers(map) {        
//     for (var i = 0; i < carparkMarkers.length; i++) {  
//         carparkMarkers[i].setMap(map);
//     }        
// }

		// 카테고리를 클릭했을 때 type에 따라 카테고리의 스타일과 지도에 표시되는 마커를 변경합니다
function changeMarker(type){
    
    var coffeeMenu = document.getElementById('coffeeMenu');
    var storeMenu = document.getElementById('storeMenu');
    // var carparkMenu = document.getElementById('carparkMenu');
    
    // 커피숍 카테고리가 클릭됐을 때
    if (type === 'coffee') {
    
        // 커피숍 카테고리를 선택된 스타일로 변경하고
        coffeeMenu.className = 'menu_selected';
        
        // 편의점과 주차장 카테고리는 선택되지 않은 스타일로 바꿉니다
        storeMenu.className = '';
        // carparkMenu.className = '';
        
        // 커피숍 마커들만 지도에 표시하도록 설정합니다
        setCoffeeMarkers(map);
        setStoreMarkers(null);
        // setCarparkMarkers(null);
        
    } else if (type === 'store') { // 편의점 카테고리가 클릭됐을 때
    
        // 편의점 카테고리를 선택된 스타일로 변경하고
        coffeeMenu.className = '';
        storeMenu.className = 'menu_selected';
        // carparkMenu.className = '';
        
        // 편의점 마커들만 지도에 표시하도록 설정합니다
        setCoffeeMarkers(null);
        setStoreMarkers(map);
        // setCarparkMarkers(null);
        
    } 
	// else if (type === 'carpark') { // 주차장 카테고리가 클릭됐을 때
     
    //     // 주차장 카테고리를 선택된 스타일로 변경하고
    //     coffeeMenu.className = '';
    //     storeMenu.className = '';
    //     carparkMenu.className = 'menu_selected';
        
    //     // 주차장 마커들만 지도에 표시하도록 설정합니다
    //     setCoffeeMarkers(null);
    //     setStoreMarkers(null);
    //     setCarparkMarkers(map);  
    // }    
} 
	</script>
</body>
</html>