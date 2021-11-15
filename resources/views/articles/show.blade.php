@extends('layouts.main')
@section('title', '')
@section('content')

    <link rel="stylesheet" href="{{ asset('css/app') }}">
    <section>

        <article class="card shadow position-relative">

            <figure class="m-3">
                <div class="row">
                    <div class="col-6">
                        <table>
                            <tr>
                                @foreach ($article->image_urls as $url)
                                    <article class="w-full px-4 md:w-1/4 text-xl text-gray-800 leading-normal">
                                        <td><img src="{{ $url }}" width="100%"></td>
                                    </article>
                                @endforeach
                                </tr>
                        </table>
                    </div>
                    <div class="col-6 logo">
                        <figcaption>
                            <h1>
                                <b>{{ $article->caption }}</b> | 当日対応: {{ $article->status->name }}
                                <hr>
                                <br>
                            </h1>
                            <h3>
                                {{ $article->info }}
                                <br>

                            </h3>
                            <tr>
                                <th>地域 :</th>
                                <td>{{ $article->category->name }}</td>
                                <br>
                            </tr>
                            <tr>
                                <th>電話番号 :</th>
                                <td><a href="tel:{{ $article->phone_number }}">{{ $article->phone_number }}</a></td>
                            </tr>

                        </figcaption>
                    </div>
                </div>
            </figure>
            @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}">
                    <i class="fas fa-edit position-absolute top-0 end-0 fs-1"></i>
                </a>
            @endcan
        </article>
    </section>
    @can('delete', $article)
        <form action="{{ route('articles.destroy', $article) }}" method="post" id="form">
            @csrf
            @method('delete')
        </form>
        <div class="d-grid col-6 mx-auto gap-3 logo">
            <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-lg">戻る</a>
            <input type="submit" value="削除" form="form" class="btn btn-danger btn-lg"
                onclick="if (!confirm('本当に削除してよろしいですか？')) {return false};">
        </div>
    @endcan
@endsection
