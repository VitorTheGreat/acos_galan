@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Vendas')])

@section('content')
<div class="content">
    <div class="container-fluid">


        <div class="row">
            <div class="col-md-12">
                <a href="/" class="btn btn-primary">Voltar</a>
                    <div class="card bg-info">
                            <div class="card-body">
                                <h5 class="card-category card-category-social text-center">
                                    <i class="fa fa-money"></i> VENDA REALIZADA COM SUCESSO <i class="fa fa-money"></i> 
                                </h5>
                                <h4 class="card-title text-center">
                                    <a href="#" class="btn btn-primary">Imprimir Via para Entrega</a>
                                </h4>

                                <div class="row">
                                        <h2>Resumo</h2>
                                    </div>
                        
                                <div class="card-stats">

                                            <div class="row">
                                                <ul>
                                                    <li>Usuario: Teste</li>
                                                    <li>Cliente: Fulano</li>
                                                    <li>Total: R$ 50,00</li>
                                                </ul>
                                            </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>

    </div>
</div>

@endsection
