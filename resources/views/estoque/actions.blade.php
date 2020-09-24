@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Cadastro Estoque')])

@section('content')
<div class="content">
    <div class="container-fluid">

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

@if (session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong> Error - </strong> {{session('error')}} </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif

        <div class="row">
            <div class="col-md-12">
                <h1>Cadastro Estoque</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Insira os dados do novo estoque</p>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        {{-- <form action="/cadastro/estoque" method="POST"> --}}
                        <form action="{{route('estoque.store')}}" method="POST">
                          @csrf
                            <h5>Dados do Estoque</h5>
                            <div class="form-row">
                              <div class="col form-group">
                                <input type="text" class="form-control" placeholder="Nome Estoque/Nome Loja" id="name" name="name">
                              </div>
                              <div class="col form-group">
                                <input type="text" class="form-control" placeholder="Local" id="local" name="local">
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                          </form>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="card">
                      <div class="card-header card-header-primary">
                        {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                        <p class="card-category"> Estoques Cadastrados</p>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nome do Estoque</th>
                                    <th>Local</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($storages as $key => $storage)
                                <tr>
                                    <td class="text-center">{{$storage->id}}</td>
                                    <td>{{$storage->name}}</td>
                                    <td>{{$storage->local}}</td>
                                    <td class="td-actions text-right">
                                        {{-- <form action="estoque/{{$storage->id}}"  method="post"> --}}
                                        <form action="{{route('estoque.destroy', ['storage' => $storage])}}"  method="post">
                                          @method('DELETE')
                                          @csrf
                                          <button type="button" rel="tooltip" class="btn btn-warning" title="Editar Estoque" data-toggle="modal" data-target="#storage-{{$storage->id}}">
                                              <i class="material-icons">edit</i>
                                          </button>
                                          <button type="submit" rel="tooltip" class="btn btn-danger" title="Deletar Estoque">
                                              <i class="material-icons">delete_forever</i>
                                          </button>
                                        </form>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
            </div>
        </div>

    </div>

    {{-- Modal Edit --}}
    @foreach ($storages as $key => $storage)
      <div class="modal fade" id="storage-{{$storage->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alterar Estoque:<br /> {{$storage->name}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{-- <form action="/cadastro/estoque/{{$storage->id}}" method="POST"> --}}
              <form action="{{route('estoque.update', ['storage' => $storage])}}" method="POST">
                @method('PATCH')
                @csrf
                <h5>Digite os dados a serem alterados</h5>
                  <div class="form-row">
                    <div class="col form-group">
                      <input type="text" class="form-control" placeholder="Nome Estoque/Nome Loja" id="name" name="name" value="{{$storage->name}}">
                    </div>
                    <div class="col form-group">
                      <input type="text" class="form-control" placeholder="Local" id="local" name="local" value="{{$storage->local}}">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-warning">Alterar</button>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
              {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
          </div>
        </div>
      </div>
    @endforeach

</div>
@endsection
