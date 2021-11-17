@extends('layouts.main')
@section('title', '新規登録')
@section('content')

    @if ($errors->any())
        <div class="error">
            <p>
                <b>{{ count($errors) }}件のエラーがあります。</b>
            </p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-8 col-offset-2 mx-auto logo">
        @include('partial.flash')
        @include('partial.errors')
        <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                @csrf

                <div class="row m-3">
                    <div class="mb-3">
                        <label for="file" class="form-label"><b>画像ファイルを選択してください</b></label>
                        <input type="file" name="file[]" id="file" class="form-control" multiple>
                    </div>

                    <div class="mb-3">
                        <label for="caption" class="form-label"><b>題名を入力してください</b></label>
                        <input type="text" name="caption" id="caption" class="form-control" {{ old('caption') }}>
                    </div>
                    <div>
                        <label for="info" class="form-label"><b>説明を入力してください</b></label>
                        <textarea name="info" id="info" rows="5" class="form-control"
                            value="{{ old('info') }}"></textarea></textarea>
                        <br>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label"><b>電話番号を入力してください</b></label>
                        <input type="tel" name="phone_number" id="phone_number" class="form-control" pattern="[\d\-]*"
                            {{ old('phone_number') }}>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label"><b>住所を入力してください</b></label>
                        <input type="text" name="address" id="address" class="form-control" {{ old('address') }}>
                    </div>

                    <div class="mb-4">
                        <br>
                        <label class="block text-gray-700 text-sm mb-2" for="title">
                            <b>地域</b>
                        </label>
                        <input type="radio" name="category_id" value=1
                            {{ old('category_id') === 1 ? 'checked' : '' }}>八幡平<br>
                        <input type="radio" name="category_id" value=2
                            {{ old('category_id') === 2 ? 'checked' : '' }}>安比高原<br>
                        <input type="radio" name="category_id" value=3
                            {{ old('category_id') === 3 ? 'checked' : '' }}>焼走<br>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm mb-2" for="title">
                            <b>当日の対応状況</b>
                        </label>
                        <input type="radio" name="status_id" value=1 {{ old('status_id') === 1 ? 'checked' : '' }}>◎<br>
                        <input type="radio" name="status_id" value=2 {{ old('status_id') === 2 ? 'checked' : '' }}>☓<br>
                    </div>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                </div>
            </div>
            <div id="map" style="height: 50vh;"></div>
            <input type="submit">
        </form>
    </div>
@endsection

@section('script')
    @include('partial.map')
    <script>
        const lat = document.getElementById('latitude');
        const lng = document.getElementById('longitude');
        let clicked;
        map.on('click', function(e) {
            if (clicked !== true) {
                clicked = true;
                const marker = L.marker([e.latlng['lat'], e.latlng['lng']], {
                    draggable: true
                }).addTo(map);
                lat.value = e.latlng['lat'];
                lng.value = e.latlng['lng'];
                marker.on('dragend', function(e) {
                    // 座標は、e.target.getLatLng()で取得
                    lat.value = e.target.getLatLng()['lat'];
                    lng.value = e.target.getLatLng()['lng'];
                });
            }
        });
    </script>
@endsection
