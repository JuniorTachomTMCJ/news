@extends('admin.layaout')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('article.index')}}">Articles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nouveau</li>
            </ol>
        </nav>
    </h1>

</div>


@include('formerros')
@include('flash')

<form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data" class="mb-3">
    @csrf
    <div class="form-group">
        <label for="author">Auteur</label>
        <input type="text" class="form-control" name="author" id="author" aria-describedby="authorHelp" value="{{old('author') }}">
        @error('author')
        <small id="authorHelp" class="form-text text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelp" value="{{old('title') }}">
        @error('title')
        <small id="titleHelp" class="form-text text-danger">{{$message}}</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="descriptionHelp">{{old('description') }}</textarea>
        @error('description')
        <small id="descriptionHelp" class="form-text text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea class="form-control" name="content" id="content" rows="5" aria-describedby="contentHelp">{{old('content') }}</textarea>
        @error('content')
        <small id="contentHelp" class="form-text text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="mb-3">
        <img class="h-100 w-auto" id="preview-image-before-upload" src="" alt="" style="max-height: 250px; object-fit: contain">
    </div>

    <div class="form-group">
        <label for="image" class="btn btn-dark">Ajouter une image</label>
        <input type="file" class="form-control-file none" name="image" id="image" style="display: none">
    </div>

    <div class="form-group">
        <label for="categories">Categorie(s) <small>Choissez les categories</small> </label>
        <select class="custom-select" multiple name="categories[]" id="categories" aria-placeholder="Choissez les categories">
            @foreach ($categories as $category)
            <option value="{{$category->id}}" {{ (collect(old('categories'))->contains($category->id)) ? 'selected':'' }}>{{$category->label}}</option>
            @endforeach
        </select>
        @error('categories')
        <small id="" class="form-text text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="source">Source</label>
        <input type="text" class="form-control" name="source" id="source" aria-describedby="sourceHelp" value="{{old('source')}}">
        @error('source')
        <small id="sourceHelp" class="form-text text-danger">{{$message}}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="url">Lien</label>
        <input type="url" class="form-control" name="url" id="url" aria-describedby="urlHelp" value="{{old('url')}}" />
        @error('url')
        <small id="urlHelp" class="form-text text-danger">{{$message}}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>


@section('script')
<script type="text/javascript">
    $(document).ready(function(e) {
        $('#image').change(function() {
            let reader = new FileReader();

            reader.onload = (e) => {

                $('#preview-image-before-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

    });

</script>
@endsection

@endsection
