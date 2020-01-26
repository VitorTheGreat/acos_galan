@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Cadastro Fornecedor')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h1>Cadastro Fornecedor</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Insira os dados do fornecedor</p>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <form>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Razão Social">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="CNPJ">
                              </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="E-mail">
                                  </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Telefone">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Celular">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="I.E.">
                            </div>
                            </div>
                            <br>
                            <h5>Endereço</h5>
                            <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="Endereço (ex: Rua)">
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="Bairro">
                                </div>
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="CEP">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Cidade">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-1 form-group">
                                    <label for="exampleFormControlSelect1">Estado/UF</label>
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
