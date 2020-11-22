@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Fechar Venda')])

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
                <div class="card">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Conclusão Venda</h4>
                                    <form action="{{route('vendas.sold')}}" method="POST">
                                        @method('POST')
                                        @csrf
                                            <h4>Cliente</h4>
                                            <table class="table">
                                                <input type="hidden" name="nome" value="{{$customerData['nome']}}">
                                                <input type="hidden" name="endereco" value="{{$customerData['endereco']}}">
                                                <input type="hidden" name="telefone" value="{{$customerData['telefone']}}">
                                                <input type="hidden" name="cpf" value="{{$customerData['cpf']}}">
                                                <input type="hidden" name="rg" value="{{$customerData['rg']}}">
                                                <input type="hidden" name="email" value="{{$customerData['email']}}">
                                                <input type="hidden" name="celular" value="{{$customerData['celular']}}">
                                                <input type="hidden" name="bairro" value="{{$customerData['bairro']}}">
                                                <input type="hidden" name="cep" value="{{$customerData['cep']}}">
                                                <input type="hidden" name="cidade" value="{{$customerData['cidade']}}">
                                                <input type="hidden" name="states_id" value="{{$customerData['states_id']}}">
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
                                                            <td><strong>{{$customerData['nome']}}</strong></td>
                                                            <td><strong>{{$customerData['endereco']}} - {{$customerData['bairro']}} - {{$customerData['cep']}} - {{$customerData['cidade']}}</strong></td>
                                                            <td><strong>{{$customerData['telefone']}} - {{$customerData['celular']}}</strong></td>
                                                            <td><strong>{{$customerData['cpf']}}</strong></td>
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
                                                        @foreach ($cart as $key =>  $item)
                                                            <tr>
                                                                <td><strong>{{$item['product_name']}}</strong></td>
                                                                <td><strong>{{$item['preco_venda']}}</strong></td>
                                                                <td><strong>{{$item['quantidade']}}</strong></td>
                                                                <td><strong>{{$item['sub_total_produto']}}</strong></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <br />
                                        
                                        <h4>Pagamento</h4>
                                            <div class="row">
                                                <div class="col-2">
                                                    <select class="form-control" data-style="btn btn-link" name="metodo_pagamento" id="metodo_pagamento">
                                                        <option value="Cartão de Crédito 1x">Cartão de Crédito 1x</option>
                                                        <option value="Cartão de Crédito 2x">Cartão de Crédito 2x</option>
                                                        <option value="Cartão de Crédito 3x">Cartão de Crédito 3x</option>
                                                        <option value="Cartão de Crédito 4x">Cartão de Crédito 4x</option>
                                                        <option value="Cartão de Crédito 5x">Cartão de Crédito 5x</option>
                                                        <option value="Cartão de Crédito 6x">Cartão de Crédito 6x</option>
                                                        <option value="Cartão de Crédito 7x">Cartão de Crédito 7x</option>
                                                        <option value="Cartão de Crédito 8x">Cartão de Crédito 8x</option>
                                                        <option value="Cartão de Crédito 9x">Cartão de Crédito 9x</option>
                                                        <option value="Cartão de Crédito 10x">Cartão de Crédito 10x</option>
                                                        <option value="Transferencia bancaria">Transferencia bancaria</option>
                                                        <option value="Faturado">Faturado</option>
                                                        <option value="Cartão de Débito">Cartão de Débito</option>
                                                        <option value="Dinheiro / à vista">Dinheiro / à vista</option>
                                                        <option value="Cheque">Cheque</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <div>Desconto: <input type="number" name="desconto" id="desconto" min="0" step="0.01" value="0" /></div> <br />
                                                </div>
                                                <div class="col">
                                                <div>Valor Pago: <input type="number" name="valor_pago" id="valor_pago" value="{{$sub_total}}"step="0.01" required /></div> <br />
                                                </div>
                                                <div class="col">
                                                    <input type="number" hidden value="{{$sub_total}}" name="sub_total_real" />
                                                    <input type="number" name="sub_total" id="sub_total" data-sub-total-real="{{$sub_total}}" value="{{$sub_total}}" step="0.01" hidden />
                                                    <h4 class="sub_total"><strong>Total: <span>{{$sub_total}}</span></h4>
                                                </div>
                                                <div class="col">
                                                    <input type="number" name="troco" id="troco" value="0" step="0.01" hidden />
                                                    <h4 class="troco"><strong>Troco: <span><span></strong></h4>
                                                </div>
                                                
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <h4 class="troco"><strong>observacao: <span><span></strong></h4>
                                                    <textarea type="text" name="observacao" id="observacao" /></textarea>
                                                </div>
                                            </div>

                                        <br />
                                        
                                            <button type="submit" class="btn btn-success" name="btn_selling" value="close_selling" id="close_selling">Fechar Venda</button>
                                            <button type="submit" class="btn btn-info" name="btn_selling" value="save_budget" id="save_budget"> Salvar Orçamento </button>
                                        </form>
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
<script src="{{ asset('js/closeSelling.js') }}"></script>
@endsection