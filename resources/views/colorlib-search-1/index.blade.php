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


    <div class="s01">
        <fieldset>
            {{-- <legend><b>最安値で、今夜のお宿を</b></legend> --}}
        </fieldset>
        
            {{-- <div class="input-field first-wrap">
                <input id="search" type="text" placeholder="現在地から検索" />
            </div> --}}
            {{-- <div class="input-field second-wrap">
                <input id="location" type="text" placeholder="現在地から検索" />
            </div> --}}
            <div class="inner-form">
            <div class="input-field third-wrap">
                <form method="POST" action={{ route('articles.index') }}>
                    @method('get')
                    <input type="hidden" name="lat" value="lat" id="lat">
                    <input type="hidden" name="lng" value="lng" id="lng">
                    <input type="submit"  value="現在地から検索">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
@endsection