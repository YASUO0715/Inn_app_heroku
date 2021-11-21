@extends('layouts.main')
@section('title', '')
@section('content')


    <link rel="stylesheet" href="{{ asset('css/app') }}">
    <section>

        <article class="card shadow position-relative">

            <figure class="m-3">
                <div class="row">
                    <div class="col-6">
                        <table>
                            <tr>
                                @foreach ($article->image_urls as $url)
                                    <article class="w-full px-4 md:w-1/4 text-xl text-gray-800 leading-normal">
                                        <td><img src="{{ $url }}" width="100%"></td>
                                    </article>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                    <div class="col-6 logo">
                        <figcaption>
                            <h1>
                                <b>{{ $article->caption }}</b> | 当日対応: {{ $article->status->name }}
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
                            </tr>
                        </figcaption>
                    </div>
                </div>
            </figure>
            <br>


            {{-- <script
            src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('services.google-map.apikey') }}&callback=initMap"
            async defer>
        </script> --}}

            @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}">
                    <i class="fas fa-edit position-absolute top-0 end-0 fs-1"></i>
                </a>
            @endcan
        </article>
    </section>

    <br>


    <div id="map" style="width: 600px; height: 500px;">
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
                        zoom: 18
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

    @can('delete', $article)
        <form action="{{ route('articles.destroy', $article) }}" method="post" id="form">
            @csrf
            @method('delete')
        </form>
        <div class="d-grid col-6 mx-auto gap-3 logo">
            <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-lg">戻る</a>
            <input type="submit" value="削除" form="form" class="btn btn-danger btn-lg"
                onclick="if (!confirm('本当に削除してよろしいですか？')) {return false};">
        </div>
    @endcan
@endsection


{{-- <div id="map" style="height:50vh;"></div>
@section('script')
@include('partial.map')
<script>
    @if (!empty($article)) 
            L.marker([{{ $article->latitude }},{{ $article->longitude }}])
                .bindPopup("{{ $article->name }}", {closeButton: false})
                .addTo(map);
        @endif
</script>
@endsection --}}
