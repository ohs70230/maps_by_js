<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/style.css">
	<title>Maps by js</title>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?= file_get_contents($_SERVER['DOCUMENT_ROOT'].'/googleMaps_api_key.txt'); ?>"></script>
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/maps.js"></script>
</head>
<body>
<h1>GoogleMapsAPIを使用した地図操作</h1>
<div class="container">
	<div id="map"></div>
	<div id="setting">
		<table>
			<tr>
				<th>地図の種類</th>
				<td>
					<select name="maptype" onchange="maptypeSwitch()">
						<option value="ROADMAP">ロードマップ</option>
						<option value="SATELLITE">衛生写真</option>
						<option value="HYBRID">ロードマップ / 衛生写真</option>
						<option value="TERRAIN">地形情報</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>マップタイプ</th>
				<td>
					<div class="toggle-buttons">
						<input type="radio" name="mapTypeControl" value="true" onchange="map.setOptions({mapTypeControl:true})">
						<label for="on" class="switch-on">有効</span></label>
						<input type="radio" name="mapTypeControl" value="false" onchange="map.setOptions({mapTypeControl:false})">
						<label for="off" class="switch-off">無効</span></label>
					</div>
				</td>
			</tr>
			<tr>
				<th>全画面表示</th>
				<td>
					<div class="toggle-buttons">
						<input type="radio" name="fullscreenControl" value="true" onchange="map.setOptions({fullscreenControl:true})">
						<label for="on" class="switch-on">有効</span></label>
						<input type="radio" name="fullscreenControl" value="false" onchange="map.setOptions({fullscreenControl:false})">
						<label for="off" class="switch-off">無効</span></label>
					</div>
				</td>
			</tr>
			<tr>
				<th>ストリートビュー</th>
				<td>
					<div class="toggle-buttons">
						<input type="radio" name="streetViewControl" value="true" onchange="map.setOptions({streetViewControl:true})">
						<label for="on" class="switch-on">有効</span></label>
						<input type="radio" name="streetViewControl" value="false" onchange="map.setOptions({streetViewControl:false})">
						<label for="off" class="switch-off">無効</span></label>
					</div>
				</td>
			</tr>
			<tr>
				<th>ズーム</th>
				<td>
					<div class="toggle-buttons">
						<input type="radio" name="zoomControl" value="true" onchange="map.setOptions({zoomControl:true})">
						<label for="on" class="switch-on">有効</span></label>
						<input type="radio" name="zoomControl" value="false" onchange="map.setOptions({zoomControl:false})">
						<label for="off" class="switch-off">無効</span></label>
					</div>
				</td>
			</tr>
			<tr>
				<th>ジオコーディング</th>
				<td>
					<div class="geocoding">
						<input type="text" name="geocode" size="25" placeholder="大阪府大阪市北区梅田3-3-1">
						<button id="sendGeocode">検索</button>
					</div>
				</td>
			</tr>
			<tr>
				<th>マーカー一括削除</th>
				<td>
					<div class="maker-reset">
						<button id="makerReset">削除</button>
					</div>
				</td>
			</tr>
		</table>
	</div>
</div>

<script>
	$(document).ready(function() {
		getMap()
	})

	$('[name="maptype"]').on('change', function() {
		console.log('mapType変更')
	})

	$('[name="mapTypeControl"]').on('change', function() {
		console.log('mapTypeControl変更')
	})

	$('[name="fullscreenControl"]').on('change', function() {
		console.log('fullscreenControl変更')
	})

	$('[name="streetViewControl"]').on('change', function() {
		console.log('streetViewControl変更')
	})

	$('[name="zoomControl"]').on('change', function() {
		console.log('zoomControl変更')
	})


	$('#sendGeocode').on('click', function() {
		console.log("sendGeocodeが押された")
		geocoding()
	})

	$('#makerReset').on('click', function() {
		console.log("makerResetが押された")
		deleteMakers()
	})

</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=APIKEY&callback=getMap" async defer></script> -->
</body>
</html>