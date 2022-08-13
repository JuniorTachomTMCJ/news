@extends('front.layout')

@section('breadcrumb')
<nav class="breadcrumb bg-white p-4">

    <a class="breadcrumb-item" href="{{route('front.articles')}}">Articles</a>
    <span class="breadcrumb-item active" aria-current="page">{{$label}}</span>

</nav>
@endsection

@section('content')
<div class="row bg-white rounded-3 p-4">
    @foreach ($articles as $article)
    @if ($article instanceof stdClass)
    <div class="row mb-4 article">
        <div class="col-12 col-lg-3 article-img rounded-3 mb-4 mb-lg-0">
            <img class="rounded-3 w-100" src="{{ $article->urlToImage }}" alt="{{$article->title}}">
        </div>
        <div class="col-12 col-lg-9">
            <h3 class="mb-2 font-weight-bold ">{{$article->title}}</h3>
            <p class="fs-13 mb-2"> {{date('d-m-Y H:i:s', strtotime($article->publishedAt)) }} </p>
            <p>{{$article->description}}</p>
            <a href="{{route('front.article.detail', ['slug'=>$article->publishedAt, 'online'=>'true'])}}" class="btn btn-outline-dark">Lire plus <i class="fa-solid fa-arrow-right-long ml-2"></i></a>
        </div>
    </div>
    @else
    <div class="row mb-4 article">
        <div class="col-12 col-lg-3 article-img rounded-3 mb-4 mb-lg-0">
            <img class="rounded-3 w-100" src="{{ asset('storage/'. $article->urlToImage ) }}" alt="{{$article->title}}">
        </div>
        <div class="col-12 col-lg-9">
            <h3 class="mb-2 font-weight-bold ">{{$article->title}}</h3>
            <p class="fs-13 mb-2"> {{$article->created_at->format('d-m-Y H:i:s')}} </p>
            <p>{{$article->description}}</p>
            <a href="{{route('front.article.detail', ['slug'=>$article->slug, 'online'=>'false'])}}" class="btn btn-outline-dark">Lire plus <i class="fa-solid fa-arrow-right-long ml-2"></i></a>

        </div>
    </div>
    @endif

    @endforeach
</div>
</section>

@endsection
