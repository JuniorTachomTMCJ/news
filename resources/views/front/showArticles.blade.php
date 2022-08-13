@extends('front.layout')

{{-- @section('content')
<section class="py-4">
    <div class="container">
        <div class="">
            <div class="article-item">
                <div class="article-img" style="height: 400px">
                    <img src="{{asset('storage/'.$articles[0]->urlToImage)}}" alt="{{$articles[0]->title}}">
</div>
<div class="article-body">
    <h4 class="article-title">{{$articles[0]->title}}</h4>
    <p class="article-description d-flex align-items-center gap-2">{{$articles[0]->description}}</p>

    <div class="article-date d-flex align-items-center gap-2">
        <p><i class="fa-solid fa-calendar-days"></i> {{$articles[0]->created_at->format('d-m-Y')}} </p>
        <p><i class="fa-regular fa-clock"></i> {{$articles[0]->created_at->format('H:i:s')}} </p>
    </div>
</div>
<div class="article-body">
    <a href="#" class="article-link btn">Voir plus <i class="fa-solid fa-arrow-right"></i></a>
</div>
</div>
</div>

<div class="article-items mt-4">
    @for ($i = 1; $i < count($articles); $i++) @if ($articles[$i]->id)
        <div class="article-item">
            <div class="article-img">
                <img src="{{asset('storage/'.$articles[$i]->urlToImage)}}" alt="{{$articles[$i]->title}}">
            </div>
            <div class="article-body">
                <h4 class="article-title">{{$articles[$i]->title}}</h4>
                <p class="article-description d-flex align-items-center gap-2">{{$articles[$i]->description}}</p>

                <div class="article-date d-flex align-items-center gap-2">
                    <p><i class="fa-solid fa-calendar-days"></i> {{$articles[$i]->created_at->format('d-m-Y')}} </p>
                    <p><i class="fa-regular fa-clock"></i> {{$articles[$i]->created_at->format('H:i:s')}} </p>
                </div>
            </div>
            <div class="article-body">
                <a href="#" class="article-link btn">Voir plus <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        @else
        @endif


        @endfor
</div>
</div>
</section>

@endsection --}}

@section('content')
<section class="py-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-3 p-4">
                <div class="row bg-white rounded-3 p-4">
                    <h2>Category</h2>
                    <ul class="list-unstyled ">
                        @foreach ($categories as $category)
                        <li class="mb-1">
                            <a class="text-decoration-none " href="{{route('article.show.articles', ['slug', $category->slug])}}}">
                                {{ $category->label}}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>

            <div class="col-9 p-4">
                <div class="row bg-white rounded-3 p-4">
                    @foreach ($articles as $article)
                    @if ($article instanceof stdClass)
                    <div class="row mb-4 article">
                        <div class="col-3 article-img rounded-3">
                            <img class="rounded-3" src="{{ $article->urlToImage }}" alt="{{$article->title}}">
                        </div>
                        <div class="col-9">
                            <h3 class="mb-2 font-weight-bold ">{{$article->title}}</h3>
                            <p class="fs-13 mb-2"> {{date('d-m-Y H:i:s', strtotime($article->publishedAt)) }} </p>
                            <p>{{$article->description}}</p>
                            <a href="#" class="btn btn-outline-dark">Lire plus <i class="fa-solid fa-arrow-right-long ml-2"></i></a>
                        </div>
                    </div>
                    @else
                    <div class="row mb-4 article">
                        <div class="col-3 article-img rounded-3">
                            <img class="rounded-3" src="{{ asset('storage/'. $article->urlToImage ) }}" alt="{{$article->title}}">
                        </div>
                        <div class="col-9">
                            <h3 class="mb-2 font-weight-bold ">{{$article->title}}</h3>
                            <p class="fs-13 mb-2"> {{$article->created_at->format('d-m-Y H:i:s')}} </p>
                            <p>{{$article->description}}</p>
                        </div>
                    </div>
                    @endif

                    @endforeach
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
