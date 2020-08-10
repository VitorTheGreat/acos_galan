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
                <hr />
                <div class="card">
                    <div class="card-header card-header-primary">
                        {{-- <h4 class="card-title ">Simple Table</h4>  --}}
                        <p class="card-category"> Insira os dados do produto</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{route('produto.store')}}" method="post">
                                @csrf
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
                                        <select class="form-control" id="unidade_venda" name="unidade_venda">
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
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    R$
                                                </span>
                                            </div>
                                            <input class="form-control data-money" type="text" name="preco_peso" id="preco_peso" placeholder="Preço (kg)">
                                        </div>
                                    </div>
                                    <div class="col-1 form-group">
                                        <label for="">Custo bruto</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    R$
                                                </span>
                                            </div>
                                            <input type="text" class="form-control data-money" id="preco_compra" name="preco_compra" placeholder="Custo Bruto / Preço Compra (unidade)">
                                        </div>
                                    </div>
                                    <div class="col-2 form-group">
                                        <label for="">% IPI</label>
                                        <input type="text" class="form-control data-percent" placeholder="% IPI" id="ipi" name="ipi">
                                    </div>
                                    <div class="col-2 form-group">
                                        <label for="">% ICMS</label>
                                        <input type="text" class="form-control data-percent" placeholder="% ICMS" id="icms" name="icms">
                                    </div>
                                    <div class="col-2 form-group">
                                        <label for="">Preço de Custo</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    R$
                                                </span>
                                            </div>
                                            <input type="text" class="form-control data-money" placeholder="Preço de Custo" id="preco_custo" name="preco_custo">
                                        </div>
                                    </div>
                                    <div class="col-2 form-group">
                                        <label for="">% Lucro</label>
                                        <input type="text" class="form-control data-percent" placeholder="% Lucro" id="lucro" name="lucro">
                                    </div>
                                    <div class="col-2 form-group">
                                        <label for="">preço de Venda</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    R$
                                                </span>
                                            </div>
                                            <input type="text" class="form-control data-money" placeholder="Preço de Venda (unidade)" id="preco_venda" name="preco_venda">
                                        </div>
                                    </div>
                                    <div class="col-2 form-group">
                                        <label for="">NCM</label>
                                        <input type="text" class="form-control" placeholder="NCM" id="ncm" name="ncm">
                                    </div>
                                    <div class="col-2 form-group">
                                        <label for="">CSOSN</label>
                                        <input type="text" class="form-control" placeholder="CSOSN" id="csosn" name="csosn">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-6 form-group">
                                        <label for="exampleFormControlSelect1">Fornecedor</label>
                                        <select class="form-control" data-style="btn btn-link" id="supplier_id" name="supplier_id">
                                            @foreach ($suppliers as $key => $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->razao_social}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6 form-group">
                                        <label for="exampleFormControlSelect1">Loja/Estoque Fisico</label>
                                        <select class="form-control" data-style="btn btn-link" id="storage_id" name="storage_id">
                                            @foreach ($storages as $key => $storage)
                                            <option value="{{$storage->id}}">{{$storage->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="card">
                    <div class="card-header card-header-primary">
                        {{-- <h4 class="card-title ">Simple Table</h4>  --}}
                        <p class="card-category">Produtos Cadastrados</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nome</th>
                                        <th>Local</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td></td>
                                        <td></td>
                                        <td class="td-actions text-right">
                                            {{-- <form action="estoque/{{$storage->id}}" method="post"> --}}
                                            <form>

                                                <button type="button" rel="tooltip" class="btn btn-warning" title="Editar Estoque" data-toggle="modal" data-target="#asd">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <button type="submit" rel="tooltip" class="btn btn-danger" title="Deletar Estoque">
                                                    <i class="material-icons">delete_forever</i>
                                                </button>
                                            </form>
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
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/product.js') }}"></script>
@endsection
