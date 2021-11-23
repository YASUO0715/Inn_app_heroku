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

<main class='flex flex-wrap'>
<article class=" w-full lg:w-1/2 px-4 md:w-1/4">
<section class="row position-relative logo" >
    @foreach ($articles as $article)
    @if ($article->status->name === "◎")
    <div class="col-6 col-md-4 col-lg-3 col-sl-2 mb-4">
        <article class="card position-relative">
            <img src="{{ $article->image_url }}" class="card-img-top">
            <div class="card-title mx-3">
                {{ round($article->distance, 1) }} km<br>
                <a href="{{ route('articles.show', $article) }}" class="text-decoration-none stretched-link">
                    {{ $article->caption }} <br>
                    {{-- 当日の対応状況 : {{ $article->status->name }}<br> --}}
                    金額:{{ $article->price }} 円
                </a>
            </div>
        </article>
    </div>
    @endif
    @endforeach
</section>
</article>
<aside class='w-full lg:w-1/2'>
<div id="map" style="width: 100%; height: 1000px;">
</div>

<script>
    function initMap() {

            var target = document.getElementById('map'); //マップを表示する要素を指定
            var address = '{{ $article->address }}'; //住所を指定
            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({
                address: address
            }, function(results, status) {
                if (status === 'OK' && results[0]) {

                    console.log(results[0].geometry.location);

                    var map = new google.maps.Map(target, {
                        center: results[0].geometry.location,
                        zoom: 10
                    });

                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map,
                        animation: google.maps.Animation.DROP
                    });

                } else {
                    //住所が存在しない場合の処理
                    alert('住所が正しくないか存在しません。');
                    target.style.display = 'none';
                }
            });
        }
</script>
<script src="//maps.google.com/maps/api/js?key={{ config('services.google-map.apikey') }}&callback=initMap"></script>
</aside>
</main>


@endsection