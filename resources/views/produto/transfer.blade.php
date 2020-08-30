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
                        {{-- <h4 class="card-title ">Simple Table</h4>  --}}
                        <h4 class="card-title"> Relações de produto por estoque</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('produto.search')}}" method="get">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col">
                                    <h4 for="descricao">Insira o nome do produto</h4>
                                    <input type="text" class="form-control" id="search" placeholder="Descrição Produto">
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Product desc.</th>
                                                    <th>Quantidade</th>
                                                    <th>Unidade Venda</th>
                                                    <th>Estoque</th>
                                                    <th>Transferir</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product_within_storages as $key_storage => $prod_storage)
                                                <tr>
                                                    <td>{{$prod_storage->descricao}}</td>
                                                    <td>{{$prod_storage->quantidade}}</td>
                                                    <td>{{$prod_storage->unidade_venda}}</td>
                                                    <td>{{$prod_storage->estoque}}</td>
                                                    <td>
                                                        <button type="submit" rel="tooltip" class="btn btn-info" title="Transferir Produto">
                                                            <i class="material-icons">swap_horiz</i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
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


    </div>

    @endsection

    @section('scripts')
    <script type="text/javascript">
        //testing autocomplete

        const src = "{{ route('produto.search') }}";

        $("#search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: src,
                    data: {
                        term: request.term
                    },
                    dataType: "json",
                    success: function(data) {
                        // var resp = $.map(data, function(obj) {
                        //     console.log('search obj => ', obj);
                        //     return obj;
                        // });
                        console.log('res => ', data)
                        response(data);
                    }
                });
            },
            minLength: 3
        });
    </script>
    <script src="{{ asset('js/product.js') }}"></script>
    @endsection
