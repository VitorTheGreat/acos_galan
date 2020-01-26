@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Cadastro Produto')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h1>Cadastro Produto</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Insira os dados do produto</p>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <form>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Descrição">
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="Quantidade">
                                  </div>
                              <div class="col-1">
                                <input type="text" class="form-control" placeholder="Unidade Venda">
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1">
                                    <input class="form-control" type="text" name="" id="" placeholder="Peso (kg)">
                                </div>
                                <div class="col-1">
                                    <input class="form-control" type="text" name="" id="" placeholder="Preço">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-2">
                                    <input type="text" class="form-control" placeholder="Custo Bruto / Preço Compra">
                                  </div>
                                  <div class="col-2">
                                    <input type="text" class="form-control" placeholder="% IPI">
                                  </div>
                                  <div class="col-2">
                                    <input type="text" class="form-control" placeholder="% ICMS">
                                  </div>
                                  <div class="col-2">
                                    <input type="text" class="form-control" placeholder="Preço de Custo" disabled>
                                  </div>
                                  <div class="col-2">
                                    <input type="text" class="form-control" placeholder="% Lucro">
                                  </div>
                                  <div class="col-2">
                                    <input type="text" class="form-control" placeholder="Preço de Venda" disabled>
                                  </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1">
                                  <input type="text" class="form-control" placeholder="Estoque">
                                </div>
                                <div class="col-1">
                                    <input type="text" class="form-control" placeholder="NCM">
                                  </div>
                                  <div class="col-1">
                                    <input type="text" class="form-control" placeholder="CSOSN">
                                  </div>
                            </div>
                            <div class="form-row">
                                <div class="col form-group">
                                    <label for="exampleFormControlSelect1">Fornecedor</label>
                                    <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1">
                                      <option>SP</option>
                                      <option>RJ</option>
                                      <option>SE</option>
                                      <option>4</option>
                                      <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success">Cadastrar</button>
                          </form>
                      </div>
                    </div>
                  </div>
            </div>
        </div>

    </div>
</div>

@endsection
