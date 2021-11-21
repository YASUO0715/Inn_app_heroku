@extends('layouts.main')
@section('title', '')

{{--
<meta charset="utf-8">
<style>
    #right-panel {
        font-family: 'Roboto', 'sans-serif';
        line-height: 30px;
        padding-left: 10px;
    }

    #right-panel select,
    #right-panel input {
        font-size: 15px;
    }

    #right-panel select {
        width: 100%;
    }

    #right-panel i {
        font-size: 12px;
    }

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    #map {
        height: 100%;
        width: 50%;
    }

    #right-panel {
        float: right;
        width: 48%;
        padding-left: 2%;
    }

    #output {
        font-size: 11px;
    }
</style> --}}

@section('content')

<script>
    navigator.geolocation.getCurrentPosition((position) => {
//緯度
let lat = position.coords.latitude;
//経度
let lng = position.coords.longitude;

const hiddenField = document.getElementById('lat');
// 値をセット
hiddenField.value = lat

const hiddenField2 = document.getElementById('lng');
// 値をセット
hiddenField2.value = lng

console.log(lat);
console.log(lng);
});
</script>

<form method="POST" action={{ route('articles.create') }}>
    @method('get')
    <input type="hidden" name="lat" value="lat" id="lat">
    <input type="hidden" name="lng" value="lng" id="lng">
</form>

<section class="row position-relative logo" data-masonry='{ "percentPosition": true }'>
    @foreach ($articles as $article)
    <div class="col-6 col-md-4 col-lg-3 col-sl-2 mb-4">
        <article class="card position-relative">
            <img src="{{ $article->image_url }}" class="card-img-top">
            <div class="card-title mx-3">
                {{ $article->distance }}
                <a href="{{ route('articles.show', $article) }}" class="text-decoration-none stretched-link">
                    {{ $article->caption }} | 空室状況 : {{ $article->status->name }}<br>
                </a>
            </div>
        </article>
    </div>
    @endforeach
</section>



{{--

<body>
    <div id="right-panel">
        <div id="inputs">
            <pre>
                        出発地点 = 現在地
                        行き先1 = 東京都千代田区日比谷公園１
                        行き先2 = 有栖川宮記念公園
                        
                </pre>
        </div>
        <div>
            <strong>Results</strong>
        </div>
        <div id="output"></div>
    </div>
    <div id="map"></div>

    <script>
        function initMap() {
                // geolocation に対応しているか否かを確認
                if ("geolocation" in navigator) {
                    var opt = {
                        "enableHighAccuracy": true,
                        "timeout": 10000,
                        "maximumAge": 0,
                    };
                    navigator.geolocation.getCurrentPosition(setLocation, showErr, opt);
                } else {
                    alert("ブラウザが位置情報取得に対応していません");
                }
            }

            function deleteMarkers(markersArray) {
                for (let i = 0; i < markersArray.length; i++) {
                    markersArray[i].setMap(null);
                }
                markersArray = [];
            }




            function setLocation(pos) {
                const bounds = new google.maps.LatLngBounds();
                const markersArray = [];
                // 緯度・経度を取得
                const lat = pos.coords.latitude;
                const lng = pos.coords.longitude;
                // 定数lat,lng をconsoleに出力
                const origin = {
                    lat: lat,
                    lng: lng
                };
                console.log(lat);
                console.log(lng);

                const map = new google.maps.Map(document.getElementById("map"), {
                    center: origin,
                    zoom: 10,
                });
                // initialize services
                const geocoder = new google.maps.Geocoder();
                const service = new google.maps.DistanceMatrixService();
                // build request
                const origin1 = origin;
                
                const destinationB = {
                    lat: 50.087,
                    lng: 14.421
                };
                const request = {
                    origins: [origin1],
                    destinations: [destinationB],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false,
                };

                // put request on page
                // document.getElementById("request").innerText = JSON.stringify(
                //     request,
                //     null,
                //     2
                // );
                // get distance matrix response
                service.getDistanceMatrix(request).then((response) => {
                    // put response
                    // document.getElementById("response").innerText = JSON.stringify(
                    //     response,
                    //     null,
                    //     2
                    // );

                    // show on map
                    const originList = response.originAddresses;
                    const destinationList = response.destinationAddresses;

                    const showGeocodedAddressOnMap = (asDestination) => {
                        const handler = ({
                            results
                        }) => {
                            map.fitBounds(bounds.extend(results[0].geometry.location));
                            markersArray.push(
                                new google.maps.Marker({
                                    map,
                                    position: results[0].geometry.location,
                                    label: asDestination ? "D" : "O",
                                })
                            );
                        };
                        return handler;
                    };

                    for (let i = 0; i < originList.length; i++) {
                        const results = response.rows[i].elements;
                        geocoder.geocode({
                            address: originList[i]
                        }).then(showGeocodedAddressOnMap(false));
                        for (let j = 0; j < results.length; j++) {
                            geocoder
                                .geocode({
                                    address: destinationList[j]
                                }).then(showGeocodedAddressOnMap(true));
                        }
                    }
                });
            }


            // // エラー時に呼び出される関数
            function showErr(err) {
                switch (err.code) {
                    case 1:
                        alert("位置情報の利用が許可されていません");
                        break;
                    case 2:
                        alert("デバイスの位置が判定できません");
                        break;
                    case 3:
                        alert("タイムアウトしました");
                        break;
                    default:
                        alert(err.message);
                }
            }


            // //ここの上から追加
            //         function initMap() {
            //             var bounds = new google.maps.LatLngBounds;
            //             var markersArray = [];

            //             var origin = "東京タワー";
            //             var destination1 = "東京都千代田区日比谷公園１";
            //             var destination2 = "有栖川宮記念公園";
            //             var destination3 = "国会議事堂";
            //             var destination4 = "日比谷公園";
            //             var destination5 = "青山学院大学";
            //             var destination6 = "慶應義塾大学";
            //             var destination7 = "霞が関ビルディング";
            //             var destination8 = "新宿御苑";
            //             var destination9 = "東京スカイツリー";
            //             var destination10 = "明治神宮";


            //             var destinationIcon = 'https://chart.googleapis.com/chart?' +
            //                 'chst=d_map_pin_letter&chld=D|FF0000|000000';
            //             var originIcon = 'https://chart.googleapis.com/chart?' +
            //                 'chst=d_map_pin_letter&chld=O|FFFF00|000000';
            //             var map = new google.maps.Map(document.getElementById('map'), {
            //                 center: {
            //                     lat: 35.682687351146555,
            //                     lng: 139.7017801073458
            //                 },
            //                 zoom: 10
            //             });
            //             var geocoder = new google.maps.Geocoder;

            //             var service = new google.maps.DistanceMatrixService;
            //             service.getDistanceMatrix({
            //                 origins: [origin],
            //                 destinations: [destination1, destination2,destination3,destination4,destination5,destination6,destination7,destination8,destination9,destination10],
            //                 travelMode: 'DRIVING',
            //                 unitSystem: google.maps.UnitSystem.METRIC,
            //                 avoidHighways: false,
            //                 avoidTolls: false
            //             }, function(response, status) {
            //                 if (status !== 'OK') {
            //                     alert('Error was: ' + status);
            //                 } else {
            //                     var originList = response.originAddresses;
            //                     var destinationList = response.destinationAddresses;
            //                     var outputDiv = document.getElementById('output');
            //                     outputDiv.innerHTML = '';
            //                     deleteMarkers(markersArray);

            //                     var showGeocodedAddressOnMap = function(asDestination) {
            //                         var icon = asDestination ? destinationIcon : originIcon;
            //                         return function(results, status) {
            //                             if (status === 'OK') {
            //                                 map.fitBounds(bounds.extend(results[0].geometry.location));
            //                                 markersArray.push(new google.maps.Marker({
            //                                     map: map,
            //                                     position: results[0].geometry.location,
            //                                     icon: icon
            //                                 }));
            //                             } else {
            //                                 alert('Geocode was not successful due to: ' + status);
            //                             }
            //                         };
            //                     };

            //                     for (var i = 0; i < originList.length; i++) {
            //                         var results = response.rows[i].elements;
            //                         geocoder.geocode({
            //                                 'address': originList[i]
            //                             },
            //                             showGeocodedAddressOnMap(false));
            //                         for (var j = 0; j < results.length; j++) {
            //                             geocoder.geocode({
            //                                     'address': destinationList[j]
            //                                 },
            //                                 showGeocodedAddressOnMap(true));
            //                             outputDiv.innerHTML += originList[i] + ' to ' + destinationList[j] +
            //                                 ': ' + results[j].distance.text + ' in ' +
            //                                 results[j].duration.text + '<br>';
            //                         }
            //                     }
            //                 }
            //             });
            //         }

            //         function deleteMarkers(markersArray) {
            //             for (var i = 0; i < markersArray.length; i++) {
            //                 markersArray[i].setMap(null);
            //             }
            //             markersArray = [];
            //         }
    </script>
    <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initMap" async
        defer>
    </script>
</body> --}}
{{-- <div id="map" style="height:50vh;"></div>

@if (empty($self_article))
<a href="{{ route('articles.create') }}" class="position-fixed fs-1 bottom-right-50 zindex-sticky">
    <i class="fas fa-plus-circle"></i>
</a>
@endif
@endsection

@section('script')
@include('partial.map')
<script>
    @if (!empty($article))
            @foreach ($articles as $article)
                L.marker([{{ $article->latitude }},{{ $article->longitude }}])
                    .bindPopup('<a href="{{ route('articles.show', $article) }}">{{ $article->name }}</a>', {closeButton: false})
                    .addTo(map);
            @endforeach
        @endif
</script> --}}
@endsection