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
                                        <div class="col-3 form-group">
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
                        
                        <div class="form-row col-12"> 
                            <form action={{route('produto')}} method="get">
                                @csrf
                                <input placeholder="Pesquisa por Descrição" name="search_query" type="text"/>
                                <button type="submit" class="btn btn-primary"/> Pesquisar </button>
                            </form>
                            <form action={{route('produto')}} method="get">
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
                                        <th class="text-right">Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products_view as $key => $product)
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
                                                <a class="btn btn-info" title="Ver" href="/produto/{{$product->id}}">
                                                    <i class="material-icons">receipt</i>
                                                </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $products_view->links() }}
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
