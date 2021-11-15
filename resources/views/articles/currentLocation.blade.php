
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link rel="stylesheet" href="{{ asset('css/main') }}">
    <link rel="stylesheet" href="{{ asset('images/Sample.png') }}">
</head>

<body>
    <div id="map" style="height:500px">
    </div>
    <script>
     // currentLocation.jsで使用する定数latに、controllerで定義した$latをいれて、currentLocation.jsに渡す
            const lat = {{ $lat }};

            // currentLocation.jsで使用する定数lngに、controllerで定義した$lngをいれて、currentLocation.jsに渡す
            const lng = {{ $lng }};
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>
    <script src="{{ asset('/js/currentLocation.js') }}"></script>
    <script src="{{ asset('/js/setLocation.js') }}"></script>
    {{-- <script src="{{ asset('/js/result.js') }}"></script> --}}
    <script
        src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyDv9viG81lt4Coli1u2CQbgkfqGKbUCfe4&callback=initMap"
        async defer>
    </script>

</body>

</html>
