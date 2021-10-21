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
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm mb-2" for="title">
                                        地域
                                    </label>
                                    <input type="radio" name="category_id" value=1
                                        {{ old('category_id', $article->category_id) === 1 ? 'checked' : '' }}>八幡平<br>
                                    <input type="radio" name="category_id" value=2
                                        {{ old('category_id', $article->category_id) === 2 ? 'checked' : '' }}>安比高原<br>
                                    <input type="radio" name="category_id" value=3
                                        {{ old('category_id', $article->category_id) === 3 ? 'checked' : '' }}>焼走<br>
                                </div>
                            </form>
                        </figcaption>
                    </div>
                </div>
            </figure>
        </article>

        <div class="d-grid gap-3 col-6 mx-auto">
            <input type="submit" value="更新" form="form" class="btn btn-success btn-lg">
            <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-lg">戻る</a>
        </div>
    </section>
@endsection
