@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Cadastro Produto')])

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
                <h1>Cadastro Cliente</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Insira os dados do cliente</p>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <form method="POST" action="{{route('customer.store')}}">
                          @csrf
                            <h5>Dados Pessoais</h5>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="CPF" name="cpf" id="cpf">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="RG" name="rg" id="rg">
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="E-mail" name="email" id="email">
                                  </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Telefone" name="telefone" id="telefone">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Celular" name="celular" id="celular">
                              </div>
                            </div>
                            <br>
                            <h5>Endereço</h5>
                            <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="Endereço (ex: Rua)" name="endereco" id="endereco">
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="Bairro" name="bairro" id="bairro">
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="CEP" name="cep" id="cep">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Cidade" name="cidade" id="cidade">
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
                  <hr>
                  <div class="card">
                      <div class="card-header card-header-primary">
                        {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                        <p class="card-category"> Clientes Cadastrados</p>
                      </div>
                      <div class="card-body">
                          <div class="form-row col-12"> 
                              <form action={{route('customer')}} method="get">
                                  @csrf
                                  <input placeholder="Pesquisa por Nome" name="search_query" type="text"/>
                                  <button type="submit" class="btn btn-primary"/> Pesquisar </button>
                              </form>
                              <form action={{route('customer')}} method="get">
                                      @csrf
                                      <input hidden name="search_query" type="text" value=""/>
                                      <button type="submit" class="btn btn-info"/> Mostrar todos </button>
                              </form>
                          </div>
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>CPF</th>
                                    <th>RG</th>
                                    <th>Telefone</th>
                                    <th>Celular</th>
                                    <th>Endereço</th>
                                    <th class="text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($customers as $key => $customer)
                                <tr>
                                    <td class="text-center">{{$customer->id}}</td>
                                    <td>{{$customer->nome}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->cpf}}</td>
                                    <td>{{$customer->rg}}</td>
                                    <td>{{$customer->telefone}}</td>
                                    <td>{{$customer->celular}}</td>
                                    <td>{{$customer->endereco}} CEP:{{$customer->cep}} - {{$customer->bairro}} - {{$customer->cidade}}/{{$customer->states_id}}</td>
                                    <td class="td-actions text-right">
                                        <a class="btn btn-info" title="Ver" href="/cliente/{{$customer->id}}">
                                          <i class="material-icons">receipt</i>
                                      </a>
                                    </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                      {{$customers->links()}}
                    </div>
            </div>
        </div>

    </div>
</div>
@endsection
