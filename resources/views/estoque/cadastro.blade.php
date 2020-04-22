@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Cadastro Estoque')])

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

        <div class="row">
            <div class="col-md-12">
                <h1>Cadastro Estoque</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Insira os dados do novo estoque</p>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <form action="/cadastro/estoque" method="POST">
                          @csrf
                            <h5>Dados Pessoais</h5>
                            <div class="form-row">
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Nome Estoque/Nome Loja" id="name" name="name">
                              </div>
                              <div class="col">
                                <input type="text" class="form-control" placeholder="Local" id="local" name="local">
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                          </form>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="card">
                      <div class="card-header card-header-primary">
                        {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                        <p class="card-category"> Estoques Cadastrados</p>
                      </div>
                      <div class="card-body">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Job Position</th>
                                    <th>Since</th>
                                    <th class="text-right">Salary</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td>Andrew Mike</td>
                                    <td>Develop</td>
                                    <td>2013</td>
                                    <td class="text-right">&euro; 99,225</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info">
                                            <i class="material-icons">person</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-success">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td>John Doe</td>
                                    <td>Design</td>
                                    <td>2012</td>
                                    <td class="text-right">&euro; 89,241</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-round">
                                            <i class="material-icons">person</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-round">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-round">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td>Alex Mike</td>
                                    <td>Design</td>
                                    <td>2010</td>
                                    <td class="text-right">&euro; 92,144</td>
                                    <td class="td-actions text-right">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-simple">
                                            <i class="material-icons">person</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-success btn-simple">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button type="button" rel="tooltip" class="btn btn-danger btn-simple">
                                            <i class="material-icons">close</i>
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
@endsection
