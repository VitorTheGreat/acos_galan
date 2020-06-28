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
                <h1>Cadastro de Produto</h1>
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
                              <div class="col form-group">
                                <label for="">Descrição</label>
                                <input type="text" class="form-control" placeholder="Descrição" id="descricao" name="descricao">
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="col-2 form-group">
                                  <label for="">Quantidade</label>
                                    <input type="text" class="form-control" placeholder="Quantidade" id="quantidade" name="quantidade">
                                </div>
                                <div class="col-2 form-group">
                                  <select class="form-control" id="exampleFormControlSelect1">
                                      <option value="">Unidade de venda</option>
                                      <option value="br">Barra (br)</option>
                                      <option value="lt">Lata (lt)</option>
                                      <option value="kg">Kilo (kg)</option>
                                      <option value="mt">Metro (mt)</option>
                                      <option value="pc">Peça (pç)</option>
                                  </select>
                                </div>
                                </div>
                            <div class="form-row">
                                  <div class="col-1 form-group">
                                    <label for="peso_kg">Peso (gr)</label>
                                      <input class="form-control data-kilo" type="text" placeholder="Peso (gr)" id="peso" name="peso">
                                  </div>
                                  <div class="col-1 form-group">
                                    <label for="">Preço</label>
                                      <input class="form-control data-money" type="text" name="preco_kg" id="preco_kg" placeholder="Preço (kg)">
                                  </div>
                                  <div class="col-2 form-group">
                                    <label for="">Custo bruto</label>
                                    <input type="text" class="form-control data-money" id="custo_bruto" name="custo_bruto" placeholder="Custo Bruto / Preço Compra (unidade)">
                                  </div>
                                  <div class="col-2 form-group">
                                    <label for="">% IPI</label>
                                    <input type="text" class="form-control data-percent" placeholder="% IPI" id="ipi">
                                  </div>
                                  <div class="col-2 form-group">
                                    <label for="">% ICMS</label>
                                    <input type="text" class="form-control data-percent" placeholder="% ICMS" id="icms">
                                  </div>
                                  <div class="col-2 form-group">
                                    <label for="">Preço de Custo</label>
                                    <input type="text" class="form-control data-money" placeholder="Preço de Custo" disabled>
                                  </div>
                                  <div class="col-2 form-group">
                                    <label for="">% Lucro</label>
                                    <input type="text" class="form-control data-percent" placeholder="% Lucro" id="lucro">
                                  </div>
                                  <div class="col-2 form-group">
                                    <label for="">preço de Venda</label>
                                    <input type="text" class="form-control data-money" placeholder="Preço de Venda (unidade)" disabled>
                                  </div>
                                  <div class="col-3 form-group">
                                    <label for="">NCM</label>
                                    <input type="text" class="form-control" placeholder="NCM">
                                  </div>
                                  <div class="col-3 form-group">
                                    <label for="">CSOSN</label>
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
