@extends('admin.layaout')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Nouvelles</h1>
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
        <h6 class="m-0 font-weight-bold text-primary">Liste des nouvelles</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Contenu</th>
                        <th>Statut</th>
                        <th style="width: 20%" class="text-right">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Contenu</th>
                        <th>Statut</th>
                        <th style="width: 20%" class="text-right">Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($breakingNewsList as $breakingNews)
                    <tr>
                        <td>{{ $breakingNews->content }}</td>
                        <td class="@if ($breakingNews->active)
                            text-success
                            @else
                            text-danger
                        @endif  ">{{ $breakingNews->statusString() }}</td>
                        <td class="text-right" s>
                            <div class="dropdown">
                                <a class="btn btn-info dropdown" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    Options <i class="fas fa-ellipsis-v"></i>
                                    <span class="caret"></span>
                                    <span class="sr-only">Split button!</span>
                                </a>

                                <div class="dropdown-menu">
                                    <!-- Button trigger modal Edit -->
                                    <button type="button" class="dropdown-item " data-toggle="modal" data-target="#editModal-{{$breakingNews->id}}">
                                        Modifier
                                    </button>

                                    <!-- Button trigger modal Delete -->
                                    <button type="button" class="dropdown-item text-danger " data-toggle="modal" data-target="#deleteModal-{{$breakingNews->id}}">
                                        Supprimer
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Edit-->
                            <div class="modal fade" id="editModal-{{$breakingNews->id}}" tabindex="-1" aria-labelledby="editModalLabel-{{$breakingNews->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="modal-content needs-validation" method="post" action="{{ route('breakingNews.update', ['breakingNews'=> $breakingNews]) }}" novalidate>
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel-{{$breakingNews->id}}">Modifier categorie</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="content" class="form-label">Contenu </label>
                                                <textarea type="text" class="form-control" name="content" id="content" aria-describedby="contentHelp" placeholder="Entrer le texte" rows="5">{{$breakingNews->content }}</textarea>
                                                @error('content')
                                                <div id="contentHelp" class="invalid-feedback d-block">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <div class="form-check mr-3">
                                                    <input class="form-check-input" type="radio" name="status" id="activeEdit" value="1" {{$breakingNews->active ? "checked":""  }}>
                                                    <label class="form-check-label" for="activeEdit">
                                                        Activée
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" value="0" id="desactiveEdit" {{$breakingNews->active ? "":"checked"  }}>
                                                    <label class="form-check-label" for="desactiveEdit">
                                                        Désactivé
                                                    </label>
                                                </div>
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
                            <div class="modal fade" id="deleteModal-{{$breakingNews->id}}" tabindex="-1" aria-labelledby="deleteModal-{{$breakingNews->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="modal-content needs-validation" method="post" action="{{ route('breakingNews.destroy', ['breakingNews'=> $breakingNews]) }}" novalidate>
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{$breakingNews->id}}">Supprimer categorie</h5>
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
        <form class="modal-content needs-validation" method="post" action="{{ route('breakingNews.store') }}" novalidate>
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Création de la nouvelle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="content" class="form-label">Contenu </label>
                    <textarea type="text" class="form-control" name="content" id="content" aria-describedby="contentHelp" placeholder="Entrer le texte" rows="5">{{old('content') }}</textarea>
                    @error('content')
                    <div id="contentHelp" class="invalid-feedback d-block">{{$message}}</div>
                    @enderror
                </div>

                <div class="d-flex align-items-center">
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="radio" name="status" id="active" value="1" checked>
                        <label class="form-check-label" for="active">
                            Activée
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="0" id="desactive">
                        <label class="form-check-label" for="desactive">
                            Désactivé
                        </label>
                    </div>
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
