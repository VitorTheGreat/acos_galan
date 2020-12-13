@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Relatórios dos Orçamentos')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h1>Relatórios dos Orçamentos</h1>
                <hr />
                @if (auth()->user()->role_id == 1)
                <div class="row">
                        <div class="col-md-4">
                                <div class="card card-stats">
                                  <div class="card-header card-header-warning card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">
                                            calendar_view_day
                                        </i>
                                    </div>
                                <p class="card-category">Orçamentos desse mês - <strong>{{now()->format('F')}}</strong></p>
                                    <h3 class="card-title">R$ {{$total_orcamentos_mes->total_mes}}
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
                                    <p class="card-category">Orçamentos dessa semana</p>
                                    <p class="card-category"><strong>{{now()->startOfWeek()->format('d/m/Y')}} à {{now()->endOfWeek()->format('d/m/Y')}}</strong></p>
                                    <h3 class="card-title">R$ {{$total_orcamentos_semana->total_semana}}</h3>
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
                                    <p class="card-category">Orçamentos de hoje - <strong>{{now()->format('d/m/Y')}} </strong></p>
                                    <h3 class="card-title">R$ {{$total_orcamentos_hoje->total_hoje}}</h3>
                                  </div>
                                  <div class="card-footer">
                                    <div class="stats">
                                    </div>
                                  </div>
                                </div>
                              </div>
                </div>
                <hr />
                @endif

                <div class="row">
                        <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-text card-header-primary">
                                      <div class="card-text">
                                        <h4 class="card-title">Orçamentos Geral</h4>
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
                                                            <th>Data da orcamento</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total orcamento (c/desconto)</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orcamentos_geral as $key => $orcamento)
                                                            <tr>
                                                                <td>{{$orcamento->id}}</td>
                                                                <td>{{$orcamento->updated_at}}</td>
                                                                <td>{{$orcamento->nome}}</td>
                                                                <td>{{$orcamento->vendedor}} - {{$orcamento->loja}}</td>
                                                                <td>{{$orcamento->total_produtos}} produto(s)</td>
                                                                <td>{{$orcamento->valor_desconto}}</td>
                                                                <td>{{$orcamento->total}}</td>
                                                                <td>{{$orcamento->valor_pago}}</td>
                                                                <td>{{$orcamento->troco}}</td>
                                                                <td>{{$orcamento->metodo_pagamento}}</td>
                                                                <td class="td-actions text-right">
                                                                <a rel="tooltip" class="btn btn-info btn-simple" href="{{route('details.orcamento', ['id' => $orcamento->id])}}">
                                                                            <i class="material-icons">receipt</i>
                                                                        </a>
                                                                    </td>
                               
                                                            </tr>
                                                        @endforeach                                            
                                                    </tbody>
                                                </table>
                                                {{ $orcamentos_geral->links() }}
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
                                        <h4 class="card-title">orcamentos de Hoje</h4>
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
                                                            <th>Data da orcamento</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total orcamento (c/desconto)</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            @foreach ($orcamentos_hoje as $key => $orcamento)
                                                            <tr>
                                                                <td>{{$orcamento->id}}</td>
                                                                <td>{{$orcamento->updated_at}}</td>
                                                                <td>{{$orcamento->nome}}</td>
                                                                <td>{{$orcamento->vendedor}} - {{$orcamento->loja}}</td>
                                                                <td>{{$orcamento->total_produtos}} produto(s)</td>
                                                                <td>{{$orcamento->valor_desconto}}</td>
                                                                <td>{{$orcamento->preco_total_desconto}}</td>
                                                                <td>{{$orcamento->valor_pago}}</td>
                                                                <td>{{$orcamento->troco}}</td>
                                                                <td>{{$orcamento->metodo_pagamento}}</td>
                                                                <td class="td-actions text-right">
                                                                        <a rel="tooltip" class="btn btn-info btn-simple" href="{{route('details.orcamento', ['id' => $orcamento->id])}}">
                                                                                <i class="material-icons">receipt</i>
                                                                            </a>
                                                                    </td>
                               
                                                            </tr>
                                                        @endforeach 
                                                     
                                                    </tbody>
                                                </table>
                                                {{ $orcamentos_hoje->links() }}
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
                                        <h4 class="card-title">orcamentos Semana</h4>
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
                                                            <th>Data da orcamento</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total orcamento (c/desconto)</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                            @foreach ($orcamentos_semana as $key => $orcamento)
                                                            <tr>
                                                                <td>{{$orcamento->id}}</td>
                                                                <td>{{$orcamento->updated_at}}</td>
                                                                <td>{{$orcamento->nome}}</td>
                                                                <td>{{$orcamento->vendedor}} - {{$orcamento->loja}}</td>
                                                                <td>{{$orcamento->total_produtos}} produto(s)</td>
                                                                <td>{{$orcamento->valor_desconto}}</td>
                                                                <td>{{$orcamento->preco_total_desconto}}</td>
                                                                <td>{{$orcamento->valor_pago}}</td>
                                                                <td>{{$orcamento->troco}}</td>
                                                                <td>{{$orcamento->metodo_pagamento}}</td>
                                                                <td class="td-actions text-right">
                                                                        <a rel="tooltip" class="btn btn-info btn-simple" href="{{route('details.orcamento', ['id' => $orcamento->id])}}">
                                                                                <i class="material-icons">receipt</i>
                                                                            </a>
                                                                    </td>
                               
                                                            </tr>
                                                        @endforeach 
                                                     
                                                    </tbody>
                                                </table>
                                                {{ $orcamentos_semana->links() }}
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
                                        <h4 class="card-title">orcamentos do Mês</h4>
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
                                                            <th>Data da orcamento</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total orcamento (c/desconto)</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orcamentos_mes as $key => $orcamento)
                                                        <tr>
                                                            <td>{{$orcamento->id}}</td>
                                                            <td>{{$orcamento->updated_at}}</td>
                                                            <td>{{$orcamento->nome}}</td>
                                                            <td>{{$orcamento->vendedor}} - {{$orcamento->loja}}</td>
                                                            <td>{{$orcamento->total_produtos}} produto(s)</td>
                                                            <td>{{$orcamento->valor_desconto}}</td>
                                                            <td>{{$orcamento->preco_total_desconto}}</td>
                                                            <td>{{$orcamento->valor_pago}}</td>
                                                            <td>{{$orcamento->troco}}</td>
                                                            <td>{{$orcamento->metodo_pagamento}}</td>
                                                            <td class="td-actions text-right">
                                                                    <a rel="tooltip" class="btn btn-info btn-simple" href="{{route('details.orcamento', ['id' => $orcamento->id])}}">
                                                                            <i class="material-icons">receipt</i>
                                                                        </a>
                                                                </td>
                           
                                                        </tr>
                                                    @endforeach 
                                                 
                                                </tbody>
                                            </table>
                                            {{ $orcamentos_mes->links() }}
                                    </div>
                                </div>
                            </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection

