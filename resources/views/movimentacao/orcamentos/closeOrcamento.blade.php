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
                                    <h4>Conclusão Venda - Orçamento</h4>
                                    <form action="{{route('orcamento.finish', ['id' => $orcamento[0]->id])}}" method="POST">
                                        @method('POST')
                                        @csrf
                                            <h4>Cliente</h4>
                                            <table class="table">
                                                {{-- <input type="hidden" name="nome" value="{{$orcamento[0]->nome}}">
                                                <input type="hidden" name="endereco" value="{{$orcamento[0]->endereco}}">
                                                <input type="hidden" name="telefone" value="{{$orcamento[0]->telefone}}"> --}}
                                                <input type="hidden" name="cpf" value="{{$orcamento[0]->cpf}}">
                                                {{-- <input type="hidden" name="rg" value="0000">
                                                <input type="hidden" name="email" value="noemail@.com">
                                                <input type="hidden" name="celular" value="{{$orcamento[0]->celular}}">
                                                <input type="hidden" name="bairro" value="{{$orcamento[0]->bairro}}">
                                                <input type="hidden" name="cep" value="{{$orcamento[0]->cep}}">
                                                <input type="hidden" name="cidade" value="{{$orcamento[0]->cidade}}">
                                                <input type="hidden" name="states_id" value="1"> --}}
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
                                                            <td><strong>{{$orcamento[0]->nome}}</strong></td>
                                                            <td><strong>{{$orcamento[0]->endereco}} - {{$orcamento[0]->bairro}} - {{$orcamento[0]->cep}} - {{$orcamento[0]->cidade}}</strong></td>
                                                            <td><strong>{{$orcamento[0]->telefone}} - {{$orcamento[0]->celular}}</strong></td>
                                                            <td><strong>{{$orcamento[0]->cpf}}</strong></td>
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
                                                        @foreach ($orcamento as $key =>  $item)
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
                                                    <select class="form-control" data-style="btn btn-link" name="metodo_pagamento" id="metodo_pagamento">
                                                    <option value="{{$orcamento[0]->metodo_pagamento}}">{{$orcamento[0]->metodo_pagamento}}</option>
                                                    <option disabled> </option>
                                                        <option value="Cartão de Crédito 1x">Cartão de Crédito 1x</option>
                                                        <option value="Cartão de Crédito 2x">Cartão de Crédito 2x</option>
                                                        <option value="Cartão de Crédito 3x">Cartão de Crédito 3x</option>
                                                        <option value="Cartão de Crédito 4x">Cartão de Crédito 4x</option>
                                                        <option value="Cartão de Débito">Cartão de Débito</option>
                                                        <option value="Dinheiro / à vista">Dinheiro / à vista</option>
                                                        <option value="Cheque">Cheque</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <div>Desconto: 
                                                    <input type="number" name="desconto" id="desconto" min="0" step="0.01" value="{{$orcamento[0]->valor_desconto}}" /></div> <br />
                                                </div>
                                                <div class="col">
                                                <div>Valor Pago:
                                                     <input type="number" name="valor_pago" id="valor_pago" value="{{$orcamento[0]->valor_pago}}"step="0.01" required />
                                                    </div> <br />
                                                </div>
                                                <div class="col">
                                                    <input type="number" hidden value="{{$orcamento[0]->preco_total_desconto}}" name="sub_total_real" />
                                                    <input type="number" name="sub_total" id="sub_total" data-sub-total-real="{{$orcamento[0]->preco_total_desconto}}" value="{{$orcamento[0]->preco_total_desconto}}" step="0.01" hidden />
                                                    <h4 class="sub_total"><strong>Total: 
                                                        <span>{{$orcamento[0]->preco_total_desconto}}</span>
                                                    </h4>
                                                </div>
                                                <div class="col">
                                                    <input type="number" name="troco" id="troco" value="0" step="0.01" hidden />
                                                    <h4 class="troco"><strong>Troco: <span><span></strong></h4>
                                                </div>
                                                
                                            </div>

                                        <br />
                                        
                                            <button type="submit" class="btn btn-success" name="btn_selling" value="close_selling" id="close_selling">Fechar Venda</button>
                                            {{-- <button type="submit" class="btn btn-info" name="btn_selling" value="save_budget" id="save_budget"> Salvar Orçamento </button> --}}
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