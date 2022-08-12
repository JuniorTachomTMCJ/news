<!-- Content Row -->
<div class="row">
    @if(count($errors))
    <div class="form-group col-12">
        <div class="alert alert-danger">
            <ul class="my-0">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
