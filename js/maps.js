var currentInfoWindow = null;
var markers = []								//参照を開放

function getMap() {
	geocoder = new google.maps.Geocoder()
	geocoder.geocode(
		{'address': '大阪市北区梅田3-3-1'},
		function (results, status) {						// geocodeデータ取得成功
			if (status == google.maps.GeocoderStatus.OK) {
				console.log('map読み込み(検索) 成功')
				var latlng = results[0].geometry.location	// 取得した座標
				// 現在位置のlatlngを取得
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(
						function (position) {
							console.log("位置情報が取得できました")
							latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
						},
						function (error) {
							switch(error.code) {
								case 1:
									alert("位置情報の利用が許可されていません")
									break
								case 2:
									alert("現在位置が取得できませんでした")
									break
								case 3:
									alert("タイムアウトになりました")
									break
								default:
									alert("その他のエラー(エラーコード:" + error.code +")")
							}
						}
					)
				}
				else {
					alert("この端末では位置情報は取得できません")
				}
				var opts = {
					zoom: 14,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map = new google.maps.Map(document.getElementById('map'), opts)
				// マーカー情報の生成
				var markerFirst = new google.maps.Marker({
					position: latlng,
					map: map,
					icon: 'http://maps.google.com/mapfiles/ms/micons/yellow-dot.png'
				})
				var infoWindow = new google.maps.InfoWindow({content: '大阪市北区梅田3-3-1'})	// InfoWindowを追加
				// マーカーにイベントを付与する
				markerFirst.addListener('click', function() {
					// 他で開かれているInfoWindowを閉じる
					if (currentInfoWindow) {
						currentInfoWindow.close()
					}
					infoWindow.open(map, markerFirst)
					currentInfoWindow = infoWindow
				})
			}
		}
	)
}

function geocoding() {
	geocoder = new google.maps.Geocoder()
	geocoder.geocode(
		{'address': $("[name='geocode']").val(), 'language': 'ja'},
		function (results, status) {						// geocodeデータ取得成功
			if (status == google.maps.GeocoderStatus.OK) {
				console.log('map読み込み(検索) 成功')
				var latlng = results[0].geometry.location	// 取得した座標
				// マーカー情報の生成
				var marker = new google.maps.Marker({
					position: latlng,
					map: map,
					icon: 'http://maps.google.com/mapfiles/ms/micons/blue-dot.png'
				})
				// InfoWindowを追加
				var infoWindow = new google.maps.InfoWindow({
					content: $("[name='geocode']").val()
				})
				// マーカーにイベントを付与する
				marker.addListener('click', function() {
					// 他で開かれているInfoWindowを閉じる
					if (currentInfoWindow) {
						currentInfoWindow.close()
					}
					infoWindow.open(map, marker)
					currentInfoWindow = infoWindow
				})
				markers.push(marker)						// マーカ追加
				map.setCenter(latlng)						// google.maps.Map()コンストラクタに定義されているsetCenter()メソッドで、geocodeから出力した座標latlngを地図の中心点に設定する。
				map.setZoom(16.5)							// マーカー追加先にズームする
			}
			else {											// geocodeデータ取得失敗
				console.log('map読み込み失敗。APIキーに問題あり？')
			}
		}
	)
}

function maptypeSwitch() {
	switch ($("[name='maptype']").val()) {
		case 'SATELLITE':
			var opt = {mapTypeId: google.maps.MapTypeId.SATELLITE}
			break
		case 'HYBRID':
			var opt = {mapTypeId: google.maps.MapTypeId.SATELLITE}
			break
		case 'TERRAIN':
			var opt = {mapTypeId: google.maps.MapTypeId.SATELLITE}
			break
		case 'ROADMAP':
		default:
			var opt = {mapTypeId: google.maps.MapTypeId.ROADMAP}
	}
	map.setOptions(opt);									// オプション変更を適用
}

function deleteMakers() {
	//生成済マーカーを順次すべて削除する
	for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(null);
	}
	markers = []											// 参照を開放
}
