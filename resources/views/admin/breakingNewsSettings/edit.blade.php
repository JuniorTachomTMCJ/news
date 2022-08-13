@extends('admin.layaout')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('breakingNews.index')}}">Nouvelles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Paramettres</li>
            </ol>
        </nav>
    </h1>

</div>


@include('formerros')
@include('flash')

<div class="row text-center align-items-center p-2" style="height: 192px" id="preview">

    @if ($breakingNews)
    <p class="col">
        {{$breakingNews->content}}
    </p>
    @else
    <p class="col">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem voluptas nihil necessitatibus, earum dolor quo iste quis ullam, veritatis iusto totam, sit provident quae vero eligendi consequatur suscipit odit laborum?</p>

    @endif
</div>

<form action="{{ route('breakingNews.setting.update', ['setting'=> $breakingNewsSettings]) }}" method="post" class="mb-3">
    @csrf
    @method('PUT')

    <div class="row mt-4">
        <div class="mb-3 col">
            <label for="textColor" class="form-label">Couleur du texte</label>
            <input type="color" class="form-control" name="textColor" id="textColor" aria-describedby="textColorHelp" placeholder="" value="{{old('textColor', $breakingNewsSettings->text_color) }}" style="max-width: 100px;">

            @error('textColor')
            <small id="textColorHelp" class="form-text text-danger">{{$message}}</small>
            @enderror
        </div>

        <div class="mb-3 col">
            <label for="bgColor" class="form-label">Couleur de Fond</label>
            <input type="color" class="form-control" name="bgColor" id="bgColor" aria-describedby="bgColorHelp" placeholder="" value="{{old('bgColor', $breakingNewsSettings->bg_color) }}" style="max-width: 100px;">

            @error('bgColor')
            <small id="bgColorHelp" class="form-bg bg-danger">{{$message}}</small>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>


@section('script')
<script type="text/javascript">
    $(document).ready(function(e) {

        let preview = document.querySelector('#preview');
        let textColor = document.querySelector('#textColor');
        let bgColor = document.querySelector('#bgColor');

        preview.style.color = textColor.value;
        preview.style.backgroundColor = bgColor.value;

        textColor.addEventListener('input', (e) => {
            preview.style.color = e.target.value;
        });

        bgColor.addEventListener('input', (e) => {
            preview.style.backgroundColor = e.target.value;
        });

    });

</script>
@endsection

@endsection
