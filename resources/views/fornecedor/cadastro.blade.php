@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Cadastro Fornecedor')])

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

        <div class="row">
            <div class="col-md-12">
                <h1>Cadastro Fornecedor</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Insira os dados do fornecedor</p>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <form method="POST" action="/cadastro/fornecedor">
                          @csrf
                            <div class="form-row">
                              <div class="col form-group">
                                <input type="text" class="form-control" placeholder="Razão Social" id="razao_social" name="razao_social">
                              </div>
                              <div class="col form-group">
                                <input type="text" class="form-control" placeholder="CNPJ" id="cnpj" name="cnpj">
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="E-mail" id="email" name="email">
                                  </div>
                              <div class="col form-group">
                                <input type="text" class="form-control" placeholder="Telefone" id="telefone" name="telefone">
                              </div>
                              <div class="col form-group">
                                <input type="text" class="form-control" placeholder="I.E." id="ie" name="ie">
                            </div>
                            </div>
                            <br>
                            <h5>Endereço</h5>
                            <div class="form-row">
                                <div class="col form-group">
                                  <input type="text" class="form-control" placeholder="Endereço (ex: Rua)" id="endereco" name="endereco">
                                </div>
                                <div class="col form-group">
                                  <input type="text" class="form-control" placeholder="Bairro" id="bairro" name="bairro">
                                </div>
                                <div class="col form-group">
                                  <input type="text" class="form-control" placeholder="CEP" id="cep" name="cep">
                                </div>
                                <div class="col form-group">
                                    <input type="text" class="form-control" placeholder="Cidade" id="cidade" name="cidade">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 form-group">
                                    <label for="exampleFormControlSelect1">Estado/UF</label>
                                    <select class="form-control" data-style="btn btn-link" id="states_id" name="states_id">
                                      @foreach ($states as $key => $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                          </form>
                      </div>
                    </div>
                  </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header card-header-primary">
                  {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                  <p class="card-category"> Fornecedores Cadastrados</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                          <tr>
                              <th class="text-center">#</th>
                              <th>Razão Social</th>
                              <th>E-mail</th>
                              <th>CNPJ</th>
                              <th>I.E.</th>
                              <th>Telefone</th>
                              <th>Endereço</th>
                              <th class="text-right">Ações</th>
                          </tr>
                      </thead>
                      <tbody>
                        @foreach ($suppliers as $key => $supplier)
                          <tr>
                              <td class="text-center">{{$supplier->id}}</td>
                              <td>{{$supplier->razao_social}}</td>
                              <td>{{$supplier->email}}</td>
                              <td>{{$supplier->cnpj}}</td>
                              <td>{{$supplier->ie}}</td>
                              <td>{{$supplier->telefone}}</td>
                              <td>{{$supplier->endereco}} CEP:{{$supplier->cep}} - {{$supplier->bairro}} - {{$supplier->bairro}} - {{$supplier->cidade}}/{{$supplier->states_id}}</td>
                              <td class="td-actions text-right">
                                  <button type="button" rel="tooltip" class="btn btn-success" title="Editar Estoque">
                                      <i class="material-icons">edit</i>
                                  </button>
                                  <button type="button" rel="tooltip" class="btn btn-danger" title="Deletar Estoque">
                                      <i class="material-icons">close</i>
                                  </button>
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
@endsection
