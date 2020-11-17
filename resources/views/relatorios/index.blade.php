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
                                    <p class="card-category">Vendas desse mês - <strong>NOVEMBRO</strong></p>
                                    <h3 class="card-title">R$ 50.000,00
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
                                    <p class="card-category"><strong>01/11/2020 à 07/11/2020</strong></p>
                                    <h3 class="card-title">R$ 30.000,00</h3>
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
                                    <p class="card-category">Vendas de hoje</p>
                                    <h3 class="card-title">R$ 10.000,00</h3>
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
                                            <div class="form-row col-12"> 
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
                                                </div>
                                            <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data da Venda</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total Venda</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>07/11/2020</td>
                                                            <td>Vitor</td>
                                                            <td>Shigueo - Loja 2</td>
                                                            <td>5 produtos</td>
                                                            <td>R$ 00,00</td>
                                                            <td>R$ 50,00</td>
                                                            <td>R$ 50,00</td>
                                                            <td>R$ 00,00</td>
                                                            <td>Dinheiro á vista</td>
                                                            <td class="td-actions text-right">
                                                                    <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                                                                        <i class="material-icons">receipt</i>
                                                                    </button>
                                                                </td>
                           
                                                        </tr>
                                                     
                                                    </tbody>
                                                </table>
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
                                            <div class="form-row col-12"> 
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
                                                </div>
                                            <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data da Venda</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total Venda</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>07/11/2020</td>
                                                            <td>Vitor</td>
                                                            <td>Shigueo - Loja 2</td>
                                                            <td>5 produtos</td>
                                                            <td>R$ 00,00</td>
                                                            <td>R$ 50,00</td>
                                                            <td>R$ 50,00</td>
                                                            <td>R$ 00,00</td>
                                                            <td>Dinheiro á vista</td>
                                                            <td class="td-actions text-right">
                                                                    <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                                                                        <i class="material-icons">receipt</i>
                                                                    </button>
                                                                </td>
                           
                                                        </tr>
                                                     
                                                    </tbody>
                                                </table>
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
                                            <div class="form-row col-12"> 
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
                                                </div>
                                            <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data da Venda</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total Venda</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>07/11/2020</td>
                                                            <td>Vitor</td>
                                                            <td>Shigueo - Loja 2</td>
                                                            <td>5 produtos</td>
                                                            <td>R$ 00,00</td>
                                                            <td>R$ 50,00</td>
                                                            <td>R$ 50,00</td>
                                                            <td>R$ 00,00</td>
                                                            <td>Dinheiro á vista</td>
                                                            <td class="td-actions text-right">
                                                                    <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                                                                        <i class="material-icons">receipt</i>
                                                                    </button>
                                                                </td>
                           
                                                        </tr>
                                                     
                                                    </tbody>
                                                </table>
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
                                            <div class="form-row col-12"> 
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
                                                </div>
                                            <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data da Venda</th>
                                                            <th>Cliente</th>
                                                            <th>Vendedor - Loja</th>
                                                            <th>Quantidade de Produtos</th>
                                                            <th>Desconto</th>
                                                            <th>Total Venda</th>
                                                            <th>Valor Pago</th>
                                                            <th>Troco</th>
                                                            <th>Metodo Pagamento</th>
                                                            <th>#</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>07/11/2020</td>
                                                            <td>Vitor</td>
                                                            <td>Shigueo - Loja 2</td>
                                                            <td>5 produtos</td>
                                                            <td>R$ 00,00</td>
                                                            <td>R$ 50,00</td>
                                                            <td>R$ 50,00</td>
                                                            <td>R$ 00,00</td>
                                                            <td>Dinheiro á vista</td>
                                                            <td class="td-actions text-right">
                                                                    <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                                                                        <i class="material-icons">receipt</i>
                                                                    </button>
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

</div>

@endsection

