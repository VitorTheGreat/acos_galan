@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Vendas')])

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
                <h1>Vender</h1>
                <hr>
                @if (!$selling)
                <div class="row">
                    <div class="col-3">
                        <form action="{{route('vendas.abrir')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <button type="submit" class="btn btn-info">Abrir Venda</button>
                                </div>
                                <div class="col">
                                    <label for="customer_id">Cliente</label>
                                    <select class="form-control" data-style="btn btn-link" id="customer_id" name="customer_id">
                                        @foreach ($customers as $key => $customer)
                                        <option value="{{$customer->id}}">{{$customer->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                @if ($selling)
                <div class="card">
                    <div class="card-header card-header-primary">
                        {{-- <h4 class="card-title ">Simple Table</h4>  --}}
                        <h4 class="card-category">Usuario: <strong>{{auth()->user()->name}}</strong> - Loja <strong>{{auth()->user()->storage_id}}</strong> - Venda Nº: <strong>{{$selling->id}}</strong> </h4>
                    </div>
                    <div class="card-body">
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Tabela:
                                        <span class="material-icons">
                                            money_off
                                        </span>
                                    </span>
                                </div>
                                <select class="form-control" data-style="btn btn-link" id="tabela" name="tabela">
                                    <option value="0">Preço Normal</option>
                                    <option value="7.5">7,5 %</option>
                                    <option value="5">5 %</option>
                                    <option value="2.5">2.5 %</option>
                                </select>
                            </div>
                        </div>
                        <br />
                            @if ($selling->customer_id === 1)
                            <h5>Dados Cliente</h5>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Nome">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Endereço">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Telefone">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Documento (RG ou CPF)">
                                </div>
                            </div>
                            @endif
                            <br>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Produto(s)</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('sellingItem.store', ['sellings_id' => $selling->id])}}" method="post">
                                                @method('POST')
                                                @csrf
                                                <div class="form-row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <input type="text" autofocus list="prod" class="form-control" placeholder="Descrição ou EAN" name="product_id">
                                                            <datalist class="" id="prod">
                                                                @foreach ($products as $key => $product)
                                                                <option value="{{$product->product_id}}">{{$product->descricao}} - {{$product->preco_venda}}</option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>

                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success">Inserir Produto</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Produtos Inseridos</h4>
                                        </div>
                                        <div class="card-body">
                                                <div class="table-responsive">
                                                        <table class="table table-shopping">
                                                            <thead>
                                                                <tr>
                                                                    <th>Produto</th>
                                                                    <th class="text-right">Preço Unitário</th>
                                                                    <th class="text-right">Qtd</th>
                                                                    <th class="text-right">Preço Total <strong><span class="percentage"></span></strong></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (session('cart'))
                                                                    @foreach (session('cart') as $product_id => $item)
                                                                        <tr data-id="{{$product_id}}">
                                                                            <td class="td-name">
                                                                                <br><small>{{$item['product_name']}}</small>
                                                                            </td>
                                                                            <td class="td-number">
                                                                            <small>R$ </small><input type="number" data-real-price="{{$item['preco_venda']}}" min="1" value="{{$item['preco_venda']}}" name="preco_venda" type="text" style="width: 90px;"/>
                                                                            </td>
                                                                            <td class="td-number">
                                                                            <input value="{{$item['quantidade']}}" type="number" min="1" type="text" name="quantidade" style="width: 50px;"/>
                                                                            </td>
                                                                            <td class="td-number preco_venda_final">
                                                                                <small>R$ </small>{{$item['sub_total_produto']}}
                                                                            </td>
                                                                            <td class="td-actions">
                                                                                <form action="{{route('sellingItem.remove', ['id' => $product_id])}}" method="post">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type ="submit" data-placement="left" class="btn btn-simple">
                                                                                        <i class="material-icons">close</i>
                                                                                    </button>

                                                                                </form>
                                                                            </td>
                                                                        </tr> 
                                                                    @endforeach
                                                                    @else 
                                                                    <tr>
                                                                        <td>
                                                                            <p>Sem produtos nessa venda</p>
                                                                        <td>
                                                                    </tr>
                                                                @endif

                                                            </tbody>
                                                        </table>
                                                      </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <span class="col-9"></span>
                                <div class="col-3">
                                    <span>TOTAL</span><br />
                                    <span>R$</span> <input style="font-size: 50px; height: 80px;" type="text" class="form-control" placeholder="Total" disabled name="total_venda">
                                </div>
                            </div>
                        <a href="{{route('vendas.sold')}}" class="btn btn-success"> Concluir Venda </a>
                            <button class="btn btn-info"> Salvar Orçamento </button>
                            <button class="btn btn-danger"> Cancelar Venda </button>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/sellings.js') }}"></script>
@endsection