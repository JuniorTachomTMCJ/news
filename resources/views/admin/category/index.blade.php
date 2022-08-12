@extends('admin.layaout')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categories</h1>
    <!-- Button trigger modal add -->
    <button type="button" class="d-sm-inline-block btn btn-primary shadow-sm" data-toggle="modal" data-target="#add">
        Créer
    </button>
</div>


@include('formerros')
@include('flash')

<!-- DataTales Categories -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des categories</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nom</th>
                        <th style="width: 20%" class="text-right">Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->label }}</td>
                        <td class="text-right" s>
                            <div class="dropdown">
                                <a class="btn btn-info dropdown" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Options <i class="fas fa-ellipsis-v"></i>
                                    <span class="caret"></span>
                                    <span class="sr-only">Split button!</span>
                                </a>

                                <div class="dropdown-menu">
                                    <!-- Button trigger modal Edit -->
                                    <button type="button" class="dropdown-item " data-toggle="modal" data-target="#editModal-{{$category->id}}">
                                        Modifier
                                    </button>

                                    <a href="{{route('article.show.articles', ['slug'=> $category->slug])}}" class="dropdown-item ">Voir les articles</a>
                                    <div class="dropdown-divider"></div>

                                    <!-- Button trigger modal Delete -->
                                    <button type="button" class="dropdown-item text-danger " data-toggle="modal" data-target="#deleteModal-{{$category->id}}">
                                        Supprimer
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Edit-->
                            <div class="modal fade" id="editModal-{{$category->id}}" tabindex="-1" aria-labelledby="editModalLabel-{{$category->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="modal-content needs-validation" method="post" action="{{ route('category.update', ['category'=> $category]) }}" novalidate>
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-{{$category->id}}">Modifier categorie</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="label" class="form-label">Nom </label>
                                                <input type="text" class="form-control" name="label" id="label" aria-describedby="labelHelp" placeholder="Entrer le nom" value="{{$category->label}}">
                                                @error('label')
                                                <div id="labelHelp" class="invalid-feedback d-block">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuler</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Modal Delete-->
                            <div class="modal fade" id="deleteModal-{{$category->id}}" tabindex="-1" aria-labelledby="deleteModal-{{$category->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="modal-content needs-validation" method="post" action="{{ route('category.destroy', ['category'=> $category]) }}" novalidate>
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{$category->id}}">Supprimer categorie</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-left">Etes-vous sûr de vouloir vraiment supprimer cette catégorie ? Ce processus sera irreversible.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuler</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Add-->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content needs-validation" method="post" action="{{ route('category.store') }}" novalidate>
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Nouvelle categorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="label" class="form-label">Nom </label>
                    <input type="text" class="form-control" name="label" id="label" aria-describedby="labelHelp" placeholder="Entrer le nom" value="{{old('label') }}">
                    @error('label')
                    <div id="labelHelp" class="invalid-feedback d-block">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

@endsection
