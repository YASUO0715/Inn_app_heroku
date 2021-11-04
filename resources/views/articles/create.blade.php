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
                        <input type="radio" name="status_id" value=1
                            {{ old('status_id') === 1 ? 'checked' : '' }}>◎<br>
                        <input type="radio" name="status_id" value=2
                            {{ old('status_id') === 2 ? 'checked' : '' }}>☓<br>
                    </div>
                </div>
            </div>
            <input type="submit">
        </form>
    </div>
@endsection
