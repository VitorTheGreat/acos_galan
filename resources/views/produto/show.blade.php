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

<a href="/produto" clas="btn btn-primary">Voltar</a>

        <div class="card">
            <div class="card-header card-header-primary">
                {{-- <h4 class="card-title ">Simple Table</h4>  --}}
            <p class="card-category">Produto {{$product->descricao}}</p>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Descrição</th>
                                <th>EAN</th>
                                <th>KG/MT (Fracionada)</th>
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
                            <tr>
                                <td class="text-center">{{$product->id}}</td>
                                <td>{{$product->descricao}}</td>
                                <td>{{$product->ean}}</td>
                                <td>{{number_format($product->qtd_fracionada, 3, ',', '')}}</td>
                                <td>R$ {{number_format($product->preco_unitario, 2, ',', '')}}</td>
                                <td>R$ {{number_format($product->preco_compra, 2, ',', '')}}</td>
                                <td>{{number_format($product->ipi, 2, ',', '')}}%</td>
                                <td>{{number_format($product->icms, 2, ',', '')}}%</td>
                                <td>R$ {{number_format($product->preco_custo, 2, ',', '')}}</td>
                                <td>{{number_format($product->lucro, 2, ',', '')}}%</td>
                                <td>R$ {{number_format($product->preco_venda, 2, ',', '')}}</td>
                                <td>{{$product->ncm}}</td>
                                <td>{{$product->csosn}}</td>
                                <td>{{$product->fornecedor}}</td>
                                <td>{{$product->total_produtos}}</td>
                                <td>{{$product->unidade_venda}}</td>
                                <td class="td-actions text-right">
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
                                        {{-- <button type="submit" rel="tooltip" class="btn btn-danger" title="Deletar Produto">
                                            <i class="material-icons">delete_forever</i>
                                        </button> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Modal Edit --}}
    <div class="modal fade" id="product-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Alterar Produto:<br /> <strong>{{$product->descricao}}</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('produto.update', ['product' => $product->id])}}" method="POST">
                        @method('PATCH')
                        @csrf
                        {{-- gambs para passar no request, ver depois isso --}}
                        <input hidden name="storage_id" value="1"/>
                        <input hidden name="unidade_venda" value="1"/>
                        <div class="form-row">
                                <div class="col form-group">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" class="form-control" placeholder="Descrição" id="descricao_edit" name="descricao" value="{{$product->descricao}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-5 form-group">
                                    <label for="ean">EAN</label>
                                    <input type="text" class="form-control" placeholder="EAN" id="ean_edit" name="ean" value="{{$product->ean}}">
                                </div>
                            </div>
                            <hr />
                            <div class="form-row">
                                <div class="col-10">
                                        <div class="card">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item text-danger">
                                                        <p>
                                                            Atenção, o campo quantidade não altera a quantidade é apenas para re-calcular os preços
                                                            Para alterar a quantidade, va para a seção de ESTOQUES do produto!
                                                        </p>
                                                    </li>
                                                </ul>
                                            </div>
                                </div>

                            </div>
                            <div class="form-row">
                                    <div class="col-2 form-group">
                                        <label for="">Quantidade</label>
                                        <input type="text" class="form-control" placeholder="Quantidade" id="quantidade_edit" name="quantidade" value="0">
                                    </div>
                                </div>
                            <div class="form-row">
                                <div class="col-4 form-group">
                                    <label for="">Quantidade Fracionada</label>
                                    <input type="text" class="form-control data-kilo" placeholder="Kilo ou Metro" id="qtd_fracionada_edit" name="qtd_fracionada" value="{{number_format($product->qtd_fracionada, 3, ',', '')}}">
                                </div>
                                <div class="col-4 form-group">
                                    <label for="">Preço</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                R$
                                            </span>
                                        </div>
                                    <input class="form-control data-money" type="text" name="preco_unitario" id="preco_unitario_edit" placeholder="Preço unitário" value="{{number_format($product->preco_unitario, 2, ',', '')}}">
                                    </div>
                                </div>
                                <div class="col-4 form-group">
                                    <label for="">Custo bruto / Preço Compra</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                R$
                                            </span>
                                        </div>
                                    <input type="text" class="form-control data-money" id="preco_compra_edit" name="preco_compra" placeholder="Preço Compra (unidade)" value="{{number_format($product->preco_compra, 2, ',', '')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-2 form-group">
                                    <label for="">% IPI</label>
                                <input type="text" class="form-control data-percent" placeholder="% IPI" id="ipi_edit" name="ipi" value="{{number_format($product->ipi, 2, ',', '')}}">
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">% ICMS</label>
                                    <input type="text" class="form-control data-percent" placeholder="% ICMS" id="icms_edit" name="icms" value="{{number_format($product->icms, 2, ',', '')}}">
                                </div>
                                <div class="col-4 form-group">
                                    <label for="">Preço de Custo (com taxas)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                R$
                                            </span>
                                        </div>
                                        <input type="text" class="form-control data-money" placeholder="Preço de Custo (com taxas)" id="preco_custo_edit" name="preco_custo" value="{{number_format($product->preco_custo, 2, ',', '')}}">
                                    </div>
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">% Lucro</label>
                                    <input type="text" class="form-control data-percent" placeholder="% Lucro" id="lucro_edit" name="lucro" value="{{number_format($product->lucro, 2, ',', '')}}">
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Preço de Venda</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                R$
                                            </span>
                                        </div>
                                    <input type="text" class="form-control data-money" placeholder="Preço de Venda (unidade)" id="preco_venda_edit" name="preco_venda" value="{{number_format($product->preco_venda, 2, ',', '')}}">
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="form-row">
                                <div class="col-4 form-group">
                                    <label for="">NCM</label>
                                    <input type="text" class="form-control" placeholder="NCM" id="ncm_edit" name="ncm" value="{{$product->ncm}}">
                                </div>
                                <div class="col-4 form-group">
                                    <label for="">CSOSN</label>
                                    <input type="text" class="form-control" placeholder="CSOSN" id="csosn_edit" name="csosn" value="{{$product->csosn}}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-6 form-group">
                                    <label for="exampleFormControlSelect1">Fornecedor</label>
                                    <select class="form-control" data-style="btn btn-link" id="supplier_id_edit" name="supplier_id">
                                        @foreach ($suppliers as $key => $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->razao_social}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-warning">alterar Informações do produto</button>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Storages --}}

    <div class="modal fade" id="product-{{$product->id}}-storage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_within_storages as $key_storage => $prod_storage)
                                @if ($product->id == $prod_storage->product_id)
                                <tr>
                                    <td>{{$prod_storage->quantidade}}</td>
                                    <td>{{$prod_storage->unidade_venda}}</td>
                                    <td>{{$prod_storage->estoque}}</td>
                                    <td class="td-actions">
                                            <button title="Aumentar Estoque"  class="btn btn-info" type="button" data-toggle="collapse" data-target="#prod_storage-{{$prod_storage->product_id.$prod_storage->storage_id}}" aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="material-icons">add_box</i>
                                            </button>
                                    </td>
                                    <div class="collapse" id="prod_storage-{{$prod_storage->product_id.$prod_storage->storage_id}}">
                                        <div class="card card-body">
                                            <div class="card-header">
                                                <h4 class="card-title">Aumentar quantidade do produto: <strong>{{$product->descricao}}</strong> no estoque: <strong>{{$prod_storage->estoque}}</strong></h4>
                                            </div>
                                            <form action="{{route('produto.storage')}}" method="post">
                                                @method('PATCH')
                                                    @csrf
                                                    {{-- {{$prod_storage->product_id . ' - ' . $prod_storage->storage_id}} --}}
                                                    <input hidden name="product_id" value="{{$prod_storage->product_id}}" />
                                                    <input hidden name="storage_id" value="{{$prod_storage->storage_id}}" />
                                                    <div class="col-6 form-group">
                                                            <label for="">Quantidade a aumentar</label>
                                                        <input type="number" class="form-control" placeholder="Quantidade" id="quantidade" name="quantidade" min="0" value="0">
                                                    </div>

                                                    <button class="btn btn-warning" type="submit">
                                                           Aumentar <i class="material-icons">add_box</i>
                                                    </button>
                                            </form>
                                        </div>
                                    </div>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-body">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Outros Estoques</h4>
                        </div>
                        <div class="card card-body">
                            <div class="card-header">
                                <h4 class="card-title">Atualizar quantidade do produto: <strong>{{$product->descricao}}</strong></h4>
                                <div class="card">
                                    <ul class="list-group list-group-flush">
                                        <p class="text-danger">
                                            Atenção, nesse campo você ira alterar a quantidade total do produto em estoque ou adicionar quantidade a um novo estoque.
                                            Tome cuidado ao alterar o estoque para não inserir dados errados, confira antes:
                                            <ol>
                                                <li>Se o estoque escolhido é realmente o correto a ser alterado</li>
                                                <li>Tenha certeza se você quer alterar a quantidade total do estoque escolhido</li>
                                                <li>Para inserir mais quantidade ao estoque, use os campos acima para o estoque desejado</li>
                                            </ol>
                                        </p>
                                    </ul>
                                </div>
                            </div>
                            <form action="{{route('produtoteste', ['id' => $product->id])}}" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <input hidden name="product_id" value="{{$product->id}}" />
                                    <div class="form-row">
                                            <div class="col-6 form-group">
                                                <select class="form-control" data-style="btn btn-link" id="storage_id" name="storage_id">
                                                    @foreach ($storages as $key => $storage)
                                                    <option value="{{$storage->id}}">{{$storage->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6 form-group">
                                                    <input type="number" class="form-control" placeholder="Quantidade" id="quantidade" name="quantidade" min="0" value="0">
                                            </div>
                                        </div>
                                    <button class="btn btn-info" type="submit">
                                            Atualizar <i class="material-icons">add_box</i>
                                    </button>
                            </form>
                        </div>                                     
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Transfer --}}
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
                                        <input type="number" class="form-control" placeholder="Quantidade" id="qtd_prod" name="qtd_prod" max="{{$prod_storage->quantidade}}" min="1" value="1" required>
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

</div>

@endsection

@section('scripts')
<script src="{{ asset('js/product.js') }}"></script>
@endsection
