{{-- Leaflet用のCSSとJavaScriptを読み込み --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>

<script>
    // 地図描画エリアを作成
    const map = L.map('map');

    // 中心座標とzoomを指定
    map.setView([{{ $latitude }}, {{ $longitude }}], {{ $zoom }});

    // 表示するタイルを指定
    L.tileLayer('http://tile.openstreetmap.jp/{z}/{x}/{y}.png').addTo(map);
</script>
