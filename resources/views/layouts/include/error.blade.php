@foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="">
        <strong class="m-2">{{ $error }}</strong>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title=""
            title=""></button>
    </div>
@endforeach
