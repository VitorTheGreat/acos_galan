@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Vendas')])

@section('content')
<div class="content">
    <div class="container-fluid">

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
                        <h4 class="card-category">Usuario: <strong>{{auth()->user()->name}}</strong> - Venda Nº: <strong>{{$selling->id}}</strong> </h4>
                    </div>
                    <div class="card-body">
                        <div class="col-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <span class="material-icons">
                                            money_off
                                        </span>
                                    </span>
                                </div>
                                <select class="form-control" data-style="btn btn-link" id="tabela" name="tabela">
                                    <option value="preco_normal">Preço Normal</option>
                                    <option value="7.5">7,5 %</option>
                                    <option value="5">5 %</option>
                                    <option value="2.5">2.5 %</option>
                                </select>
                            </div>
                        </div>
                        <br />
                        <div class="table-responsive">
                            <form>
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

                                <h5>Produto(s)</h5>
                                <div class="form-row">

                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text" autofocus list="descricao_prod" class="form-control" placeholder="Descrição ou EAN">
                                            <datalist class="form-control" id="descricao_prod">
                                                @foreach ($products as $key => $product)
                                                <option value="{{$product->id}}">{{$product->descricao}}</option>
                                                @endforeach
                                            </datalist>
                                        </div>

                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" placeholder="QTD">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="form-control" placeholder="Preço Unidade">
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control" placeholder="Sub Total" disabled>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <span class="col-10"></span>
                                    <div class="col-2">
                                        <input type="text" class="form-control" placeholder="Total" disabled>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Inserir Produto</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection
