@if (session('status'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Sucesso!</strong> {{session('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    @foreach ($errors->all() as $error)
        <strong> Error - </strong> {{$error}} </span> <br />
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
