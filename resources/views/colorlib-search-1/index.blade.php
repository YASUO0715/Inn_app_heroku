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

                document.getElementById("submit_button").disabled = false;
            });
    </script>


    <div class="backgroundimage">
        <fieldset>
            
        </fieldset>

        <div class="cur_button">
            <form name="cur_location" method="POST" action={{ route('articles.index') }} disabled>
                @method('get')
                <input type="hidden" name="lat" value="lat" id="lat">
                <input type="hidden" name="lng" value="lng" id="lng">
                <button type="submit" id="submit_button" value="近くの本日泊まれる宿を検索"
                    style="width:100%;padding:10px;font-size:1.5rem;" disabled>近くの本日泊まれる宿を検索</button>
            </form>
        </div>





    </div>
</body>

</html>
@endsection