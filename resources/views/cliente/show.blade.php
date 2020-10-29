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

            <a href="/cliente" clas="btn btn-primary">Voltar</a>

        <div class="row">
                  <div class="card">
                      <div class="card-header card-header-primary">
                        {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Clientes {{$customer->nome}}</p>
                      </div>
                      <div class="card-body">
        
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
                                            <button type="button" rel="tooltip" class="btn btn-warning" title="Editar Cliente" data-toggle="modal" data-target="#cliente-{{$customer->id}}">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                    </td>
                                </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
            </div>
        </div>

    </div>

      {{-- Modal Edit --}}
      <div class="modal fade" id="cliente-{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar Cliente:<br /> <strong>{{$customer->nome}}</strong></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('customer.update', ['customer' => $customer->id])}}" method="POST">
                            @method('PATCH')
                            @csrf
                            <h5>Dados Pessoais</h5>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome" value="{{$customer->nome}}">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="CPF" name="cpf" id="cpf" value="{{$customer->cpf}}">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="RG" name="rg" id="rg" value="{{$customer->rg}}">
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="E-mail" name="email" id="email" value="{{$customer->email}}">
                                  </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Telefone" name="telefone" id="telefone" value="{{$customer->telefone}}">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Celular" name="celular" id="celular" value="{{$customer->celular}}">
                              </div>
                            </div>
                            <br>
                            <h5>Endereço</h5>
                            <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="Endereço (ex: Rua)" name="endereco" id="endereco" value="{{$customer->endereco}}">
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="Bairro" name="bairro" id="bairro" value="{{$customer->bairro}}">
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="CEP" name="cep" id="cep" value="{{$customer->cep}}">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Cidade" name="cidade" id="cidade" value="{{$customer->cidade}}">
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
@endsection
