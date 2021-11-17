@extends('layouts.main')
@section('title', '')
@section('content')


    <section class="row position-relative logo" data-masonry='{ "percentPosition": true }'>
        @foreach ($articles as $article)
            <div class="col-6 col-md-4 col-lg-3 col-sl-2 mb-4">
                <article class="card position-relative">
                    <img src="{{ $article->image_url }}" class="card-img-top">
                    <div class="card-title mx-3">
                        <a href="{{ route('articles.show', $article) }}" class="text-decoration-none stretched-link">
                            {{ $article->caption }} | 空室状況 : {{ $article->status->name }}<br>
                        </a>
                    </div>
                </article>
            </div>
        @endforeach
    </section>
    <div id="map" style="height:50vh;"></div>

    @if (empty($self_article))
        <a href="{{ route('articles.create') }}" class="position-fixed fs-1 bottom-right-50 zindex-sticky">
            <i class="fas fa-plus-circle"></i>
        </a>
    @endif
@endsection

@section('script')
    @include('partial.map')
    <script>
        @if (!empty($article))
            @foreach ($articles as $article)
                L.marker([{{ $article->latitude }},{{ $article->longitude }}])
                    .bindPopup('<a href="{{ route('articles.show', $article) }}">{{ $article->name }}</a>', {closeButton: false})
                    .addTo(map);
            @endforeach
        @endif
    </script>
@endsection

