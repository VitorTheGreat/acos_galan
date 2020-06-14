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
                <h1>Cadastro Produto</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Insira os dados do produto</p>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <form>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Descrição" id="descricao" name-"descricao">
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="col-2 form-group">
                                    <input type="text" class="form-control" placeholder="Quantidade" id="quantidade" name="quantidade">
                                </div>
                              <div class="col-1 form-group">
                                <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1">
                                    <option value="">Unidade de venda</option>
                                    <option value="br">Barra (br)</option>
                                    <option value="lt">Lata (lt)</option>
                                    <option value="kg">Kilo (kg)</option>
                                    <option value="mt">Metro (mt)</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 form-group">
                                    <input class="form-control" type="text" name="" id="" placeholder="Peso (kg)" id="peso_kg" name="peso_kg">
                                </div>
                                <div class="col-1 form-group">
                                    <input class="form-control" type="text" name="" id="" placeholder="Preço">
                                </div>
                            </div>
                            <div class="form-row">
                                  <div class="col-2 form-group">
                                    <input type="text" class="form-control" placeholder="Custo Bruto / Preço Compra (unidade)">
                                  </div>
                                  <div class="col-2 form-group">
                                    <input type="text" class="form-control" placeholder="% IPI">
                                  </div>
                                  <div class="col-2 form-group">
                                    <input type="text" class="form-control" placeholder="% ICMS">
                                  </div>
                                  <div class="col-2 form-group">
                                    <input type="text" class="form-control" placeholder="Preço de Custo" disabled>
                                  </div>
                                  <div class="col-2 form-group">
                                    <input type="text" class="form-control" placeholder="% Lucro">
                                  </div>
                                  <div class="col-2 form-group">
                                    <input type="text" class="form-control" placeholder="Preço de Venda (unidade)" disabled>
                                  </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 form-group">
                                  <input type="text" class="form-control" placeholder="QTD Estoque">
                                </div>
                                <div class="col-1 form-group">
                                    <input type="text" class="form-control" placeholder="NCM">
                                  </div>
                                  <div class="col-1 form-group">
                                    <input type="text" class="form-control" placeholder="CSOSN">
                                  </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 form-group">
                                    <label for="exampleFormControlSelect1">Fornecedor</label>
                                    <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1">
                                      @foreach ($suppliers as $key => $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->razao_social}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label for="exampleFormControlSelect1">Loja/Estoque Fisico</label>
                                    <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1">
                                      @foreach ($storages as $key => $storage)
                                        <option value="{{$storage->id}}">{{$storage->name}}</option>
                                      @endforeach
                                    </select>
                                </div>

                            </div>
                            <button type="button" class="btn btn-success">Cadastrar</button>
                          </form>
                      </div>
                    </div>
                  </div>
            </div>
        </div>

    </div>
</div>

@endsection
