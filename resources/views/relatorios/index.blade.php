@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Relatórios de Vendas')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h1>Relatórios de Vendas</h1>
                <hr />

                <div class="row">
                        <div class="col-md-4">
                                <div class="card card-stats">
                                  <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">
                                            calendar_view_day
                                        </i>
                                    </div>
                                <p class="card-category">Vendas desse mês - <strong>{{now()->format('F')}}</strong></p>
                                    <h3 class="card-title">R$ {{$total_vendas_mes->total_mes}}
                                    </h3>
                                  </div>
                                  <div class="card-footer">
                                    <div class="stats">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="card card-stats">
                                  <div class="card-header card-header-success card-header-icon">
                                    <div class="card-icon">
                                            <i class="material-icons">
                                                    date_range
                                            </i>                                                    
                                    </div>
                                    <p class="card-category">Vendas dessa semana</p>
                                    <p class="card-category"><strong>{{now()->startOfWeek()->format('d/m/Y')}} à {{now()->endOfWeek()->format('d/m/Y')}}</strong></p>
                                    <h3 class="card-title">R$ {{$total_vendas_semana->total_semana}}</h3>
                                  </div>
                                  <div class="card-footer">
                                    <div class="stats">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-4">
                                <div class="card card-stats">
                                  <div class="card-header card-header-danger card-header-icon">
                                    <div class="card-icon">
                                            <i class="material-icons">
                                                    today
                                            </i>
                                    </div>
                                    <p class="card-category">Vendas de hoje - <strong>{{now()->format('d/m/Y')}} </strong></p>
                                    <h3 class="card-title">R$ {{$total_vendas_hoje->total_hoje}}</h3>
                                  </div>
                                  <div class="card-footer">
                                    <div class="stats">
                                    </div>
                                  </div>
                                </div>
                              </div>
                </div>
                <hr />

                <div class="row">
                        <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-text card-header-primary">
                                      <div class="card-text">
                                        <h4 class="card-title">Vendas Geral</h4>
                                      </div>
                                    </div>
                                    <div class="card-body">
                                            {{-- <div class="form-row col-12"> 
                                                    <form action='#' method="get">
                                                        @csrf
                                                        <input placeholder="Pesquisa" name="search_query" type="text"/>
                                                        <button type="submit" class="btn btn-primary"/> Pesquisar </button>
                                                    </form>
                                                    <form action='#' method="get">
                                                            @csrf
                                                            <input hidden name="search_query" type="text" value=""/>
                                                            <button type="submit" class="btn btn-info"/> Mostrar todos </button>
                                                    </form>
                                                </div> --}}
                                            <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data da Venda</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total Venda (c/desconto)</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($vendas_geral as $key => $venda)
                                                            <tr>
                                                                <td>{{$venda->id}}</td>
                                                                <td>{{$venda->updated_at}}</td>
                                                                <td>{{$venda->nome}}</td>
                                                                <td>{{$venda->vendedor}} - {{$venda->loja}}</td>
                                                                <td>{{$venda->total_produtos}} produto(s)</td>
                                                                <td>{{$venda->valor_desconto}}</td>
                                                                <td>{{$venda->total}}</td>
                                                                <td>{{$venda->valor_pago}}</td>
                                                                <td>{{$venda->troco}}</td>
                                                                <td>{{$venda->metodo_pagamento}}</td>
                                                                <td class="td-actions text-right">
                                                                <a rel="tooltip" class="btn btn-info btn-simple" href="{{route('details.venda', ['id' => $venda->id])}}">
                                                                            <i class="material-icons">receipt</i>
                                                                        </a>
                                                                    </td>
                               
                                                            </tr>
                                                        @endforeach                                            
                                                    </tbody>
                                                </table>
                                                {{ $vendas_geral->links() }}
                                    </div>
                                </div>
                            </div>
                </div>

                <hr />
                <div class="row">
                        <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-text card-header-primary">
                                      <div class="card-text">
                                        <h4 class="card-title">Vendas de Hoje</h4>
                                      </div>
                                    </div>
                                    <div class="card-body">
                                            {{-- <div class="form-row col-12"> 
                                                    <form action='#' method="get">
                                                        @csrf
                                                        <input placeholder="Pesquisa" name="search_query" type="text"/>
                                                        <button type="submit" class="btn btn-primary"/> Pesquisar </button>
                                                    </form>
                                                    <form action='#' method="get">
                                                            @csrf
                                                            <input hidden name="search_query" type="text" value=""/>
                                                            <button type="submit" class="btn btn-info"/> Mostrar todos </button>
                                                    </form>
                                                </div> --}}
                                            <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data da Venda</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total Venda (c/desconto)</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            @foreach ($vendas_hoje as $key => $venda)
                                                            <tr>
                                                                <td>{{$venda->id}}</td>
                                                                <td>{{$venda->updated_at}}</td>
                                                                <td>{{$venda->nome}}</td>
                                                                <td>{{$venda->vendedor}} - {{$venda->loja}}</td>
                                                                <td>{{$venda->total_produtos}} produto(s)</td>
                                                                <td>{{$venda->valor_desconto}}</td>
                                                                <td>{{$venda->preco_total_desconto}}</td>
                                                                <td>{{$venda->valor_pago}}</td>
                                                                <td>{{$venda->troco}}</td>
                                                                <td>{{$venda->metodo_pagamento}}</td>
                                                                <td class="td-actions text-right">
                                                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                                                                            <i class="material-icons">receipt</i>
                                                                        </button>
                                                                    </td>
                               
                                                            </tr>
                                                        @endforeach 
                                                     
                                                    </tbody>
                                                </table>
                                                {{ $vendas_hoje->links() }}
                                    </div>
                                </div>
                            </div>
                </div>

                <hr />
                <div class="row">
                        <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-text card-header-primary">
                                      <div class="card-text">
                                        <h4 class="card-title">Vendas Semana</h4>
                                      </div>
                                    </div>
                                    <div class="card-body">
                                            {{-- <div class="form-row col-12"> 
                                                    <form action='#' method="get">
                                                        @csrf
                                                        <input placeholder="Pesquisa" name="search_query" type="text"/>
                                                        <button type="submit" class="btn btn-primary"/> Pesquisar </button>
                                                    </form>
                                                    <form action='#' method="get">
                                                            @csrf
                                                            <input hidden name="search_query" type="text" value=""/>
                                                            <button type="submit" class="btn btn-info"/> Mostrar todos </button>
                                                    </form>
                                                </div> --}}
                                            <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data da Venda</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total Venda (c/desconto)</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            @foreach ($vendas_semana as $key => $venda)
                                                            <tr>
                                                                <td>{{$venda->id}}</td>
                                                                <td>{{$venda->updated_at}}</td>
                                                                <td>{{$venda->nome}}</td>
                                                                <td>{{$venda->vendedor}} - {{$venda->loja}}</td>
                                                                <td>{{$venda->total_produtos}} produto(s)</td>
                                                                <td>{{$venda->valor_desconto}}</td>
                                                                <td>{{$venda->preco_total_desconto}}</td>
                                                                <td>{{$venda->valor_pago}}</td>
                                                                <td>{{$venda->troco}}</td>
                                                                <td>{{$venda->metodo_pagamento}}</td>
                                                                <td class="td-actions text-right">
                                                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                                                                            <i class="material-icons">receipt</i>
                                                                        </button>
                                                                    </td>
                               
                                                            </tr>
                                                        @endforeach 
                                                     
                                                    </tbody>
                                                </table>
                                                {{ $vendas_semana->links() }}
                                    </div>
                                </div>
                            </div>
                </div>

                <hr />
                <div class="row">
                        <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-text card-header-primary">
                                      <div class="card-text">
                                        <h4 class="card-title">Vendas do Mês</h4>
                                      </div>
                                    </div>
                                    <div class="card-body">
                                            {{-- <div class="form-row col-12"> 
                                                    <form action='#' method="get">
                                                        @csrf
                                                        <input placeholder="Pesquisa" name="search_query" type="text"/>
                                                        <button type="submit" class="btn btn-primary"/> Pesquisar </button>
                                                    </form>
                                                    <form action='#' method="get">
                                                            @csrf
                                                            <input hidden name="search_query" type="text" value=""/>
                                                            <button type="submit" class="btn btn-info"/> Mostrar todos </button>
                                                    </form>
                                                </div> --}}
                                            <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data da Venda</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total Venda (c/desconto)</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($vendas_mes as $key => $venda)
                                                        <tr>
                                                            <td>{{$venda->id}}</td>
                                                            <td>{{$venda->updated_at}}</td>
                                                            <td>{{$venda->nome}}</td>
                                                            <td>{{$venda->vendedor}} - {{$venda->loja}}</td>
                                                            <td>{{$venda->total_produtos}} produto(s)</td>
                                                            <td>{{$venda->valor_desconto}}</td>
                                                            <td>{{$venda->preco_total_desconto}}</td>
                                                            <td>{{$venda->valor_pago}}</td>
                                                            <td>{{$venda->troco}}</td>
                                                            <td>{{$venda->metodo_pagamento}}</td>
                                                            <td class="td-actions text-right">
                                                                    <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                                                                        <i class="material-icons">receipt</i>
                                                                    </button>
                                                                </td>
                           
                                                        </tr>
                                                    @endforeach 
                                                 
                                                </tbody>
                                            </table>
                                            {{ $vendas_mes->links() }}
                                    </div>
                                </div>
                            </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection

