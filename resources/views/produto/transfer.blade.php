@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Cadastro Produto')])

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
                <h1>Transferência de Produto</h1>
                <hr />
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"> Relações de produto por estoque</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-header">
                                            <div class="row">
                                                <h4>Produto escolhido: <strong>PROD </strong> </h4>
                                                <h4>Estoque escolhido: <strong>ESTQ</strong> </h4>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="form-row align-justify">
                                                <div class="col-5">
                                                    <input type="text" autofocus list="prod" class="form-control" placeholder="Descrição do Produto">
                                                    <datalist class="" id="prod">
                                                        @foreach ($product_storages as $key => $product)
                                                        <option value="{{$product->product_id}}">{{$product->descricao}} - {{$product->estoque}} - {{$product->quantidade}}</option>
                                                        @endforeach
                                                    </datalist>
                                                    <input type="text" class="form-control" placeholder="Estoque" id="prod_estoque">
                                                    <input type="text" class="form-control" placeholder="Quantidade" id="prod_qtd">
                                                </div>
                                                <button type="button" name="button" class="btn btn-info">
                                                    Abrir Ordem<br />
                                                    <span class="material-icons">
                                                        swap_horiz
                                                    </span>
                                                </button>
                                                <div class="col-5">
                                                    <label for="estoque">Estoque</label>
                                                    <input type="email" class="form-control" id="estoque" placeholder="Estoque">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    @endsection

    @section('scripts')

    <script src="{{ asset('js/product.js') }}"></script>
    @endsection
