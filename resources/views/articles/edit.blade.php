@extends('layouts.main')

@section('title', '編集画面')
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


<section>
    <article class="card shadow">
        <figure class="m-3">
            <div class="row">
                <div class="col-6">
                    <img src="{{ $article->image_url }}" width="100%">
                </div>
                <div class="col-6">
                    <figcaption>

                        <form action="{{ route('articles.update', $article) }}" method="post" id="form">
                            @csrf
                            @method('patch')
                            <div class="mb-3">
                                <label for="caption" class="form-label">宿名を入力してください</label>
                                <input type="text" name="caption" id="caption" class="form-control"
                                    value="{{ old('caption', $article->caption) }}">
                            </div>
                            <div>
                                <label for="info" class="form-label">説明を入力してください</label>
                                <textarea name="info" id="info" rows="5"
                                    class="form-control">{{ old('info', $article->info) }}</textarea>
                                <br>
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">電話番号を入力してください</label>
                                <input type="tel" name="phone_number" id="phone_number" pattern="[\d\-]*"
                                    class="form-control" value="{{ old('phone_number', $article->phone_number) }}">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">住所を入力してください</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    value="{{ old('address', $article->address) }}">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm mb-2" for="title">
                                    地域
                                </label>
                                <input type="radio" name="category_id" value=1 {{ old('category_id',
                                    $article->category_id) === 1 ? 'checked' : '' }}>八幡平<br>
                                <input type="radio" name="category_id" value=2 {{ old('category_id',
                                    $article->category_id) === 2 ? 'checked' : '' }}>安比高原<br>
                                <input type="radio" name="category_id" value=3 {{ old('category_id',
                                    $article->category_id) === 3 ? 'checked' : '' }}>焼走<br>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm mb-2" for="title">
                                    当日の対応状況
                                </label>
                                <input type="radio" name="status_id" value=1 {{ old('status_id', $article->status_id)
                                === 1 ? 'checked' : '' }}>◎
                                受け入れ可能<br>
                                <input type="radio" name="status_id" value=2 {{ old('status_id', $article->status_id)
                                === 2 ? 'checked' : '' }}>☓
                                受け入れ不可<br>
                            </div>
                            <input type="hidden" id="latitude" name="latitude" value="{{ $article->latitude }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ $article->longitude }}">
                            <div id="map" style="height:50vh;"></div>
                        </form>
                    </figcaption>
                </div>
            </div>
        </figure>
    </article>

    <div class="d-grid gap-3 col-6 mx-auto">
        <input type="submit" value="更新" form="form" style="width:90%;padding:10px;font-size:30px;"  class="btn btn-radius-solid btn--shadow">
        <a href="{{ route('articles.index') }}" class="btn btn-radius-solid btn--shadow">戻る</a>
    </div>

</section>
@endsection

@section('script')
@include('partial.map')
<script>
    const lat = document.getElementById('latitude');
        const lng = document.getElementById('longitude');
        @if (!empty($article))
            const marker = L.marker([{{ $article->latitude }}, {{ $article->longitude }}], {draggable: true})
                .bindPopup("{{ $article->name }}", {closeButton: false})
                .addTo(map);
            marker.on('dragend', function(e) {
                // 座標は、e.target.getLatLng()で取得
                lat.value = e.target.getLatLng()['lat'];
                lng.value = e.target.getLatLng()['lng'];
            });
        @endif
</script>
@endsection