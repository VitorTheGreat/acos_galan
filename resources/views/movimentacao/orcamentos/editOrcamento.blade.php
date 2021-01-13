@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Editar Orçamento')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h1>Editar Orçamento </h1>
                <hr>
          
            </div>
        </div>

                <div class="card">
                    <div class="card-header card-header-primary">
                        {{-- <h4 class="card-title ">Simple Table</h4>  --}}
                        <h4 class="card-category">Usuario: <strong>{{auth()->user()->name}}</strong> - Loja <strong>{{auth()->user()->storage_id}}</strong> - Orcamento Nº: <strong>{{$selling->id}}</strong> </h4>
                    </div>
                    <div class="card-body">
                            <div class="row">

                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Produto(s)</h4>
                                        </div>
                                        <div class="card-body">

                                            <form action="{{route('edit.orcamento.table', ['id' => $selling->id])}}" method="post">
                                                @method('POST')
                                                @csrf
                                                <div class="col-6 row">
                                                    <small class="text-danger">Lembre-se de aplicar a tabela antes de fechar a venda</small>
                                                        <div class="col-6 input-group">
                                                                <div class="input-group-prepend">
                                                                        <span class="input-group-text">
                                                                            Tabela:
                                                                            <span class="material-icons">
                                                                                money_off
                                                                            </span>
                                                                        </span>
                                                                    </div>
                                                                <select class="form-control" data-style="btn btn-link" id="tabela" name="tabela">
                                                                    <option value="{{session('tabela')}}" selected>{{session('tabela')}} %</option>
                                                                    <option value="" disabled>  </option>
                                                                    <option value="0">0 %</option>
                                                                    <option value="13">13 %</option>
                                                                    <option value="10">10 %</option>
                                                                    <option value="7.5">7,5 %</option>
                                                                    <option value="5">5 %</option>
                                                                    <option value="2.5">2.5 %</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="submit" class="btn btn-info" id="btn_aplly_table">Aplicar Tabela</button>
                                                            </div>

                                                </div>
                                                </form>
                                            <form action="{{route('sellingItem.store', ['sellings_id' => $selling->id])}}" method="post">
                                                @method('POST')
                                                @csrf
                                                <div class="form-row">
                                                <input hidden value="{{session('tabela')}}" name="tabela"/>
                                                    <div class="col-9">
                                                        <div class="form-group">
                                                            <input type="text" autofocus list="prod" class="form-control" placeholder="Descrição ou EAN" name="product_id" id="prod_input_insert">
                                                            <datalist class="" id="prod">
                                                                @foreach ($products as $key => $product)
                                                                    <option value="{{$product->product_id}}">{{$product->descricao}} - R$ <b>{{$product->preco_venda}}</b> - Qtd: <b>{{$product->quantidade}}</b></option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <input hidden type="number" class="form-control" placeholder="Quantidade" name="quantidade" min="0.1" value="1" step="0.01">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-success" id="btn_insert_prod">Inserir Produto</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
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
                                                                    <th class="text-right">Preço Unitário <span class="percentage"></span></th>
                                                                    <th class="text-right">KG/MT </th>
                                                                    <th class="text-right">Preço (kg/mt) </th>
                                                                    <th class="text-right">Qtd</th>
                                                                    <th class="text-right">Preço Total <strong></strong></th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (session('cart'))
                                                                    @foreach (session('cart') as $product_id => $item)
                                                                        <tr data-id="{{$product_id}}">
                                                                            <td class="td-name">
                                                                                <strong><br>{{$item['product_name']}}</strong>
                                                                            </td>
                                                                            <td class="td-number">
                                                                                <small>R$ </small><input type="number" data-real-price="{{$item['preco_base']}}" min="1" value="{{$item['preco_venda']}}" name="preco_venda" type="text" style="width: 90px;" disabled/>
                                                                            </td>
                                                                            <td class="td-number">
                                                                                {{$item['kg_mt']}}
                                                                            </td>
                                                                            <td class="td-number">
                                                                                R$ {{$item['preco_kg_mt']}}
                                                                            </td>
                                                                            <td class="td-number">
                                                                                <form action="{{route('edit.orcamento.quantity', ['prod_id' => $product_id, 'selling_id' => $item['sellings_id']])}}" method="post">
                                                                                    @csrf
                                                                                    @method('post')
                                                                                    <input value="{{$item['quantidade']}}" type="number" min="1" type="text" name="quantidade" style="width: 50px;"/>
                                                                                    <button type ="submit" data-placement="left" class="btn btn-success" style="width: 35px; height: 33px; padding: 0;">
                                                                                        <i class="material-icons">add_box</i>
                                                                                    </button>

                                                                                </form>
                                                                            </td>
                                                                            <td class="td-number preco_venda_final">
                                                                                <small>R$ </small>{{$item['sub_total_produto']}}
                                                                            </td>
                                                                            <td class="td-actions">
                                                                                <form action="{{route('edit.orcamento.removeItem', ['prod_id' => $product_id, 'selling_id' => $item['sellings_id']])}}" method="post">
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
                            <form action="{{route('orcamento.close', ['id' => $selling->id])}}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <input hidden name="customer_id" id="customer_id" value="{{$selling->customer_id}}" />
                        
                                    <br/>

                                    <button type="submit" class="btn btn-success"> Fechar Orcamento </button>

                            </form>

                            <form action="{{route('vendas.destroy', ['selling' => $selling->id])}}" method="post">
                                @method('DELETE')
                                @csrf

                                <button type="submit" class="btn btn-danger"> Cancelar Orcamento </button>
                            </form>

                    </div>
                </div>

    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/sellings.js') }}"></script>
@endsection

