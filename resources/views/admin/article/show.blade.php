@extends('admin.layaout')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('article.index')}}">Articles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </nav>
    </h1>

    <a href="{{route('article.edit', ['slug'=>$article->slug]) }}" class="btn btn-warning">Modifier</a>

</div>

<div class="row">
    <div class="col-12 col-lg-4">
        <img class="h-auto w-100" id="preview-image-before-upload" src="{{asset('storage/'.$article->urlToImage) }}" alt="" style="max-height: 250px; object-fit: contain">
    </div>
    <div class="col-12 col-lg-8 mt-3 mt-lg-0">

        <p><strong>Auteur :</strong> {{$article->author}} </p>
        <p><strong>Titre :</strong> {{$article->title}} </p>
        <p><strong>Publié le :</strong> {{$article->created_at}} </p>

        <div>
            <p><strong>Description :</strong></p>
            <p>&nbsp; &nbsp; &nbsp; &nbsp; {{$article->description}} </p>
        </div>

        <div>
            <p><strong>Contenu :</strong></p>
            <p>&nbsp; &nbsp; &nbsp; &nbsp; {{$article->content}} </p>
        </div>

        <p><strong>Source :</strong> {{$article->source ? $article->source : "Inconnu"}} </p>

        <p><strong>Lien :</strong> <a href="{{$article->url}}" target="_blank">{{$article->url}}</a> </p>

    </div>
</div>


@include('formerros')
@include('flash')

@endsection
