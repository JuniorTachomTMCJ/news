@extends('admin.layaout')

@section('content')
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
              </ol>
        </h1>
        
    </div>

    <!-- Content Row -->
    <div class="row">

        <form action="" class="col-12">
            <div class="mb-3">
              <label for="name" class="form-label">Nom </label>
              <input type="text" class="form-control" name="name" id="name" aria-describedby="name" placeholder="Entrer le nom">
              <small id="name" class="form-text text-muted">Veuillez entrer le nom</small>
            </div>
        </form>
    </div>
@endsection