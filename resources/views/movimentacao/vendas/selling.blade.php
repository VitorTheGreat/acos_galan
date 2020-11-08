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
                            <div class="row">

                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Produto(s)</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('sellingItem.store', ['sellings_id' => $selling->id])}}" method="post">
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
                                                                    <option value="7.5">7,5 %</option>
                                                                    <option value="5">5 %</option>
                                                                    <option value="2.5">2.5 %</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="submit" class="btn btn-info" id="btn_aplly_table">Aplicar Tabela</button>
                                                            </div>
                                               
                                                </div>
                                                <div class="form-row">
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
                                                            <input type="number" class="form-control" placeholder="Quantidade" name="quantidade" min="0.1" step="0.01">
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
                            <form action="{{route('vendas.closeSelling')}}" method="POST">
                                    @method('POST')
                                    @csrf
                                    @if ($selling->customer_id === 1)
                                    <h5>Dados Cliente</h5>
                                    <h5>Dados Pessoais</h5>
                                    <div class="form-row">
                                      <div class="col">
                                        <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome">
                                      </div>
                                      <div class="col">
                                        <input type="text" class="form-control" placeholder="CPF" name="cpf" id="cpf">
                                      </div>
                                      <div class="col">
                                        <input type="text" class="form-control" placeholder="RG" name="rg" id="rg">
                                      </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="E-mail" name="email" id="email">
                                          </div>
                                      <div class="col">
                                        <input type="text" class="form-control" placeholder="Telefone" name="telefone" id="telefone">
                                      </div>
                                      <div class="col">
                                        <input type="text" class="form-control" placeholder="Celular" name="celular" id="celular">
                                      </div>
                                    </div>
                                    <br>
                                    <h5>Endereço</h5>
                                    <div class="form-row">
                                        <div class="col">
                                          <input type="text" class="form-control" placeholder="Endereço (ex: Rua)" name="endereco" id="endereco" required>
                                        </div>
                                        <div class="col">
                                          <input type="text" class="form-control" placeholder="Bairro" name="bairro" id="bairro" required>
                                        </div>
                                        <div class="col">
                                          <input type="text" class="form-control" placeholder="CEP" name="cep" id="cep">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" placeholder="Cidade" name="cidade" id="cidade">
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
                                    @endif
                                    <br/>
                                
                                    <button type="submit" class="btn btn-success"> Fechar Venda </button>
                                    <button class="btn btn-info"> Salvar Orçamento </button>
                                    <button class="btn btn-danger"> Cancelar Venda </button>
                            </form>

                            
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