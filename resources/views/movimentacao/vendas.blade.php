@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Vendas')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h1>Vendas</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Vendas/Orçamento</p>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <form>
                          <h5>Vendedor</h5>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" value="" placeholder="Vendedor" name="">
                              </div>
                            </div>
                            <br>
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
                                <input type="text" class="form-control" placeholder="celular">
                              </div>
                            </div>
                            <br>
                            <h5>Produto(s)</h5>
                            <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="ID Produto (barcode)">
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="Descrição">
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="QTD">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Preço do produto" disabled>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Total" disabled>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Peso">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Valor/KG" disabled>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Total" disabled>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success">Inserir Produto</button>
                          </form>
                      </div>
                    </div>
                  </div>
            </div>
        </div>

    </div>
</div>

@endsection
