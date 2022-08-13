@extends('front.layout')

@section('content')
<div class="row bg-white rounded-3 p-4 ">

    @if ($article instanceof stdClass)
    <div class="col">
        <div class="row mb-3">
            <div class="">
                <h1>{{$article->title}}</h1>
                <p class="fs-13 mb-2"> {{date('d-m-Y H:i:s', strtotime($article->publishedAt)) }} </p>
                <p class="fs-13 mb-2"> {{$article->author}}
                    @if ($article->source->name)
                    - {{$article->source->name}}
                    @endif
                </p>

            </div>
        </div>
        <div class="row mb-3 overflow-hidden" style="max-height: 300px;">
            <img src="{{$article->urlToImage}}" alt="{{$article->title}}" class="img-fluid">
        </div>
        <div class="row">
            <h3>{{$article->description}}</h3>

            <p>{{$article->content}}</p>

            <a href="{{$article->url}}" target="_blank" class="text-decoration-none">Aller à l'article</a>
        </div>
    </div>
    @else
    <div class="col">
        <div class="row mb-3">
            <div class="">
                <h1>{{$article->title}}</h1>
                <p class="fs-13 mb-2"> {{date('d-m-Y H:i:s', strtotime($article->created_at)) }} </p>
                <p class="fs-13 mb-2"> {{$article->author}}
                    @if ($article->source)
                    - {{$article->source}}
                    @endif
                </p>

            </div>
        </div>
        <div class="row mb-3 overflow-hidden" style="max-height: 300px;">
            <img src="{{asset('storage/'. $article->urlToImage)}}" alt="{{$article->title}}" class="img-fluid">
        </div>
        <div class="row">
            <h3>{{$article->description}}</h3>

            <p>{{$article->content}}</p>

            @if ($article->url)
            <a href="{{$article->url}}" target="_blank" class="text-decoration-none">Aller à l'article</a>
            @endif
        </div>
    </div>
    @endif

</div>
@endsection
