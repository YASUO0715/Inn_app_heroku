@extends('layouts.main')
@section('title', '')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="{{ asset('css/app') }}">
<section>

    <article class="card shadow position-relative">

        <figure class="m-3" text-lg>
            <div class="row">
                <div class="col-6">
                    <table>
                        <tr>
                            @foreach ($article->image_urls as $url)
                            <article class="w-full px-px md:w-2/4 text-xl text-gray-800 leading-normal">
                                {{-- <td><img src="{{ $url }}" width="100%"></td>
                                <td><img src="{{ $url }}" width="100%"></td> --}}
                                <div class="slider">
                                <td><a href="{{ $url }}" data-lightbox="group"><img src="{{ $url }}" width="300"
                                            height="300"></a>
                                <td>
                                </div>
                            </article>
                            @endforeach
                        </tr>
                    </table>
                </div>
                <div class="col-6 logo">
                    <figcaption>
                        <h1>
                            <b>{{ $article->caption }}</b> | 当日の対応状況: {{ $article->status->name }}
                            <hr>
                            <br>
                        </h1>
                        <h3>
                            {{ $article->info }}
                            <br>

                        </h3>
                        <tr>
                            <th>地域 :</th>
                            <td>{{ $article->category->name }}</td>
                            <br>
                        </tr>
                        <tr>
                            <th>電話番号 :</th>
                            <td><a href="tel:{{ $article->phone_number }}">{{ $article->phone_number }}</a></td>
                            <br>
                        </tr>
                        <tr>
                            <th>住所 :</th>
                            <td>{{ $article->address }}</td>
                            <br>
                        </tr>
                        <tr>
                            <th>金額 :</th>
                            <td>{{ $article->price }}円</td>
                            <br>
                        </tr>
                    
                    </figcaption>
                </div>
            </div>
        </figure>
        <br>
    </article>
</section>

<br>


<div id="map" style="width: 100%; height: 500px;">
</div>

<script>
    function initMap() {

            var target = document.getElementById('map'); //マップを表示する要素を指定
            var address = '{{ $article->address }}'; //住所を指定
            var geocoder = new google.maps.Geocoder

            geocoder.geocode({
                address: address
            }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    console.log(results)
                    console.log(results[0].geometry.location);

                    var map = new google.maps.Map(target, {
                        center: results[0].geometry.location,
                        zoom: 18
                    });

                    var marker = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: map,
                        animation: google.maps.Animation.DROP,
                        icon: href="{{ asset('images/icon8.png') }}",
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

<br>
@can('delete', $article)
<form action="{{ route('articles.destroy', $article) }}" method="post" id="form">
    @csrf
    @method('delete')
</form>
<div class="d-grid col-6 mx-auto gap-3 logo">
    <a href="{{ route('articles.index') }}" class="btn btn-radius-solid btn--shadow">TOPページへ<i
            class="fas fa-angle-right fa-position-right"></i></a>
    @can('update', $article)
    <a href="{{ route('articles.edit', $article) }}">
        <i class="btn btn-radius-solid btn--shadow">編集する</i>
    </a>
    @endcan
    <input type="submit" value="削除" form="form" class="btn btn-radius-solid btn--shadow"
        onclick="if (!confirm('本当に削除してよろしいですか？')) {return false};">
</div>
@endcan
@endsection