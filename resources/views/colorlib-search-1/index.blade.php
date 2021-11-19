@extends('layouts.main')
@section('content')
    <html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="author" content="colorlib.com">
        <link rel="stylesheet" href="{{ asset('images/Sample.png') }}">
        <link href="css/main.css" rel="stylesheet" />
    </head>

    <body>
        <script>
            function setLocation(pos) {
            // 緯度・経度を取得
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            // 定数lat,lng をconsoleに出力
            console.log(lat);
            console.log(lng);
            
            }
            
            // エラー時に呼び出される関数
            function showErr(err) {
            switch (err.code) {
            case 1 :
            alert("位置情報の利用が許可されていません");
            break;
            case 2 :
            alert("デバイスの位置が判定できません");
            break;
            case 3 :
            alert("タイムアウトしました");
            break;
            default :
            alert(err.message);
            }
            }
            
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
        </script>
        
        <div class="s01">
            <form>
                <fieldset>
                    {{-- <legend><b>最安値で、今夜のお宿を</b></legend> --}}
                </fieldset>
                <div class="inner-form">
                    {{-- <div class="input-field first-wrap">
                    <input id="search" type="text" placeholder="現在地から検索" />
                </div> --}}
                    {{-- <div class="input-field second-wrap">
                    <input id="location" type="text" placeholder="現在地から検索" />
                </div> --}}
                    <div class="input-field third-wrap">
                        <button class="btn-search" type="button" onclick="location.href='/articles'">現在地から検索</button>
                    </div>
                </div>
            </form>
        </div>
    </body><!-- This templates was made by Colorlib (https://colorlib.com) -->

    </html>
@endsection
