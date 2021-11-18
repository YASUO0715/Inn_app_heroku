<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    @include('layouts.header')
    @yield('content')
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
    @yield('script')
</body>

</html>
