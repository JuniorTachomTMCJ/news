@extends('admin.layaout')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Articles</h1>
    <a href="{{route('article.create')}}" class="d-sm-inline-block btn btn-primary shadow-sm">Créer</a>
</div>


@include('formerros')
@include('flash')

<!-- DataTales Articles -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des articles</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Auteur</th>
                        <th>Titre</th>
                        <th>Publié le</th>
                        <th style="width: 20%" class="text-right">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Auteur</th>
                        <th>Titre</th>
                        <th>Publié le</th>
                        <th style="width: 20%" class="text-right">Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($articles as $article)
                    <tr>
                        <td>{{ $article->author }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->created_at }}</td>
                        <td class="text-right">
                            <div class="dropdown no-arrow mb-4">
                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Options <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                    <a class="dropdown-item" href="{{ route('article.show', ['slug' => $article->slug]) }}">Détails</a>
                                    <a class="dropdown-item" href="{{ route('article.edit', ['slug' => $article->slug]) }}">Modifier</a>
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item text-danger " data-toggle="modal" data-target="#deleteModal-{{$article->id}}">
                                        Supprimer
                                    </button>
                                </div>
                            </div>

                            <!-- Modal Delete-->
                            <div class="modal fade" id="deleteModal-{{$article->id}}" tabindex="-1" aria-labelledby="deleteModal-{{$article->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form class="modal-content needs-validation" method="post" action="{{ route('article.destroy', ['slug'=> $article->slug]) }}" novalidate>
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel-{{$article->id}}">Supprimer Article</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-left">Etes-vous sûr de vouloir vraiment supprimer cet article ? Ce processus sera irreversible.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
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

@endsection
