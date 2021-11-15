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
            <button class="btn-search" type="button" >現在地から検索</button>
          </div>
        </div>
      </form>
    </div>
  </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
@endsection