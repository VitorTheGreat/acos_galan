@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Detalhes de Venda')])

@section('content')
<div class="content">
    <div class="container-fluid">

    <a href="/relatorios" clas="btn btn-primary">Voltar</a>

        <div class="card">
            <div class="card-header card-header-primary">
                {{-- <h4 class="card-title ">Simple Table</h4>  --}}
            <p class="card-category">Detalhes da Venda</p>
            </div>
            <div class="card-body">

                <div class="">
                    <div class="row">
                        <div class="col">
                        <h4>Vendedor: <strong>{{$venda[0]->vendedor}} </strong> Loja: <strong> {{$venda[0]->loja}}</strong></h4>
                        </div>
                    </div>
                    <table class="table">
                        <h3>Cliente</h3>
                            <thead>
                                <tr>
                                    <th><strong>Nome</strong></th>
                                    <th><strong>Endereço</strong></th>
                                    <th><strong>Telefones</strong></th>
                                    <th><strong>Documento</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>{{$venda[0]->nome}}</strong></td>
                                    <td><strong>{{$venda[0]->endereco}} - {{$venda[0]->bairro}} - {{$venda[0]->cep}} - {{$venda[0]->cidade}}</strong></td>
                                    <td><strong>{{$venda[0]->telefone}} - {{$venda[0]->celular}}</strong></td>
                                    <td><strong>{{$venda[0]->cpf}}</strong></td>
                                </tr>
                            </tbody>
                    </table>

                    <h4>Produtos</h4>
                    <table class="table">
                            <thead>
                                <tr>
                                    <th><strong>Produto</strong></th>
                                    <th><strong>Preço Unitario</strong></th>
                                    <th><strong>Quantidade</strong></th>
                                    <th><strong>Preco Total</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($venda as $key => $item)
                                    <tr>
                                        <td><strong>{{$item->descricao}}</strong></td>
                                        <td><strong>{{$item->preco_venda_final}}</strong></td>
                                        <td><strong>{{$item->quantidade}}</strong></td>
                                        <td><strong>{{$item->sub_total_produto}}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br />
                
                <h4>Pagamento</h4>
                    <div class="row">
                        <div class="col-2">
                            <h5>Metodo de Pagamento</h5>
                            <strong>{{$venda[0]->metodo_pagamento}}</strong>
                        </div>
                        <div class="col">
                                <h5>Desconto</h5>
                                <strong>{{$venda[0]->valor_desconto}}</strong>
                        </div>
                        <div class="col">
                                <h5>Preco total com Desconto</h5>
                                <strong>{{$venda[0]->preco_total_desconto}}</strong>
                        </div>
                        <div class="col">
                                <h5>Preco total sem Desconto</h5>
                                <strong>{{$venda[0]->total}}</strong>
                        </div>
                        <div class="col">
                                <h5>Valor Pago</h5>
                                <strong>{{$venda[0]->valor_pago}}</strong>
                        </div>
                        
                        <div class="col">
                                <h5>Troco</h5>
                               <strong> {{$venda[0]->troco}}</strong>
                        </div>
                    </div>
                    
                    <br />
                    <br />

                    <div class="row">
                        <div class="col">
                            
                            <h5>Observação</h5>
                            <strong>{{$venda[0]->observacao}}</strong>
                        </div>
                    </div>
                    <br />
                <a href="{{'/movimentacao/vendaPDF/'.$venda[0]->id}}" class="btn btn-info" target="_blank">Imprimir Comprovante de venda/Orçamento</a>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('js/product.js') }}"></script>
@endsection
