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
                <h1>Produto</h1>
                <hr />
                {{-- <a href="#" class="btn btn-info">Incluir/Distribuir estoque</a> --}}
                <div class="card">
                    <div class="card-header card-header-primary">
                        {{-- <h4 class="card-title ">Simple Table</h4>  --}}
                        <h4 class="card-title"> Insira os dados do produto</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('produto.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" placeholder="Descrição" id="descricao" name="descricao" value="{{old('descricao')}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-2 form-group">
                                    <label for="ean">EAN</label>
                                    <input type="text" class="form-control" placeholder="EAN" id="ean" name="ean" value="{{old('ean')}}">
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Quantidade</label>
                                    <input type="text" class="form-control" placeholder="Quantidade" id="quantidade" name="quantidade" value="{{old('quantidade')}}">
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
                            <hr />
                            <div class="form-row">
                                <div class="col-2 form-group">
                                    <label for="">Quantidade Fracionada</label>
                                    <input type="text" class="form-control data-kilo" placeholder="Kilo ou Metro" id="qtd_fracionada" name="qtd_fracionada" value="{{old('qtd_fracionada')}}">
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Preço</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                R$
                                            </span>
                                        </div>
                                        <input class="form-control data-money" type="text" name="preco_unitario" id="preco_unitario" placeholder="Preço unitário" value="{{old('preco_unitario')}}">
                                    </div>
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Custo bruto / Preço Compra</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                R$
                                            </span>
                                        </div>
                                        <input type="text" class="form-control data-money" id="preco_compra" name="preco_compra" placeholder="Preço Compra (unidade)" value="{{old('preco_compra')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-2 form-group">
                                    <label for="">% IPI</label>
                                    <input type="text" class="form-control data-percent" placeholder="% IPI" id="ipi" name="ipi" value="{{old('ipi')}}">
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">% ICMS</label>
                                    <input type="text" class="form-control data-percent" placeholder="% ICMS" id="icms" name="icms" value="{{old('icms')}}">
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Preço de Custo (com taxas)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                R$
                                            </span>
                                        </div>
                                        <input type="text" class="form-control data-money" placeholder="Preço de Custo (com taxas)" id="preco_custo" name="preco_custo" value="{{old('preco_custo')}}">
                                    </div>
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">% Lucro</label>
                                    <input type="text" class="form-control data-percent" placeholder="% Lucro" id="lucro" name="lucro" value="{{old('lucro')}}">
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Preço de Venda</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                R$
                                            </span>
                                        </div>
                                        <input type="text" class="form-control data-money" placeholder="Preço de Venda (unidade)" id="preco_venda" name="preco_venda" value="{{old('preco_venda')}}">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-row">
                                <div class="col-2 form-group">
                                    <label for="">NCM</label>
                                    <input type="text" class="form-control" placeholder="NCM" id="ncm" name="ncm" value="{{old('ncm')}}">
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">CSOSN</label>
                                    <input type="text" class="form-control" placeholder="CSOSN" id="csosn" name="csosn" value="{{old('csosn')}}">
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
                                        <th>Descrição</th>
                                        <th>EAN</th>
                                        <th>QTD Fracionada</th>
                                        <th>Preço Unitário</th>
                                        <th>Preço Compra</th>
                                        <th>IPI</th>
                                        <th>ICMS</th>
                                        <th>Preço Custo</th>
                                        <th>Lucro</th>
                                        <th>Preço Venda</th>
                                        <th>NCM</th>
                                        <th>CSOSN</th>
                                        <th>Fornecedor</th>
                                        <th>QTD Total</th>
                                        <th>Und. Venda</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <td class="text-center">{{$product->id}}</td>
                                        <td>{{$product->descricao}}</td>
                                        <td>{{$product->ean}}</td>
                                        <td>{{$product->qtd_fracionada}}</td>
                                        <td>{{$product->preco_unitario}}</td>
                                        <td>{{$product->preco_compra}}</td>
                                        <td>{{$product->ipi}}</td>
                                        <td>{{$product->icms}}</td>
                                        <td>{{$product->preco_custo}}</td>
                                        <td>{{$product->lucro}}</td>
                                        <td>{{$product->preco_venda}}</td>
                                        <td>{{$product->ncm}}</td>
                                        <td>{{$product->csosn}}</td>
                                        <td>{{$product->fornecedor}}</td>
                                        <td>{{$product->total_produtos}}</td>
                                        <td>{{$product->unidade_venda}}</td>
                                        <td class="td-actions text-right">
                                            <form action="{{route('produto.destroy', ['product' => $product->id])}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" rel="tooltip" class="btn btn-primary" title="Transferir" data-toggle="modal" data-target="#product-{{$product->id}}-transfer">
                                                    <i class="material-icons">swap_horiz</i>
                                                </button>
                                                <button type="button" rel="tooltip" class="btn btn-info" title="Ver Estoques" data-toggle="modal" data-target="#product-{{$product->id}}-storage">
                                                    <i class="material-icons">storage</i>
                                                </button>
                                                <button type="button" rel="tooltip" class="btn btn-warning" title="Editar Produto" data-toggle="modal" data-target="#product-{{$product->id}}">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <button type="submit" rel="tooltip" class="btn btn-danger" title="Deletar Produto">
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
    @foreach ($products as $key => $product)
    <div class="modal fade" id="product-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alterar Produto:<br /> {{$product->descricao}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form action="/cadastro/estoque/{{$storage->id}}" method="POST"> --}}
                    <form action="{{route('produto.update', ['supplier' => $product])}}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div>{{$product->id}}</div>
                        <button type="submit" class="btn btn-warning">alterar</button>
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

    {{-- Modal Storages --}}
    @foreach ($products as $key => $product)
    <div class="modal fade" id="product-{{$product->id}}-storage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Estoques com o produto: <br /> <strong>{{$product->descricao}}</strong></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Quantidade</th>
                                <th>Unidade Venda</th>
                                <th>Estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_within_storages as $key_storage => $prod_storage)
                            @if ($product->id == $prod_storage->product_id)
                            <tr>
                                <td>{{$prod_storage->quantidade}}</td>
                                <td>{{$prod_storage->unidade_venda}}</td>
                                <td>{{$prod_storage->estoque}}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- Modal Transfer --}}
    @foreach ($products as $key => $product)
    <div class="modal fade" id="product-{{$product->id}}-transfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Transferir Produto: <br /> <strong>{{$product->descricao}}</strong></h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($product_within_storages as $key_storage => $prod_storage)
                            @if ($product->id == $prod_storage->product_id)
                            <br />
                            <form action="{{route('transfer.open')}}" method="POST">
                                @csrf
                                <h5><strong>Estoque a enviar:</strong> {{$prod_storage->estoque}} - Estoque disponivel: {{$prod_storage->quantidade}}</h5>
                                <input type="text" id="responsavel_retira" class="form-control" placeholder="Responsavel a Retirar" name="responsavel_retira" required>
                                <div class="form-row no-wrap">
                                    <div class="col-4">
                                        <input type="text" id="prod_estoque" name="estoque_fornece" value="{{$prod_storage->storage_id}}" hidden>
                                        <input type="text" id="prod_id" name="prod_id" value="{{$prod_storage->product_id}}" hidden>
                                        <input type="text" id="status_transferencia" name="status_transferencia" value="ordem_aberta" hidden>
                                        <input type="number" class="form-control" placeholder="Quantidade" id="qtd_prod" name="qtd_prod" max="{{$prod_storage->quantidade}}" value="1" required>
                                    </div>
                                    <button type="submit" class="btn btn-info">
                                        Abrir Ordem
                                    </button>
                                    <div class="col-4">
                                        <select class="form-control" data-style="btn btn-link" id="estoque_recebe" name="estoque_recebe">
                                            @foreach ($storages as $key => $storage)
                                            @if ($storage->id != $prod_storage->storage_id)
                                            <option value="{{$storage->id}}">{{$storage->name}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </form>
                            @endif
                            @endforeach
                        </div>
                    </div>
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

@section('scripts')
<script src="{{ asset('js/product.js') }}"></script>
@endsection
