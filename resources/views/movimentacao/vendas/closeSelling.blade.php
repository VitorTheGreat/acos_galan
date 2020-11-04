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

                                    <div>
                                        {{-- {{$cart}} --}}

                                        <div>
                                            <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Produto</th>
                                                            <th>Preço Unitario</th>
                                                            <th>Quantidade</th>
                                                            <th>Preco Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($cart as $key =>  $item)
                                                            <tr>
                                                                <td>{{$item['product_name']}}</td>
                                                                <td>{{$item['preco_venda']}}</td>
                                                                <td>{{$item['quantidade']}}</td>
                                                                <td>{{$item['sub_total_produto']}}</td>
                                                            </tr>
                                                
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div style="font-size: 20px; ">
                                                    {{-- @foreach ($customerData as $key => $item) --}}
                                                        <div>Nome: <strong>{{$customerData['nome_cliente']}} </strong> </div>
                                                        <div>Endereço:<strong> {{$customerData['endereco_cliente']}} </strong> </div>
                                                        <div>Telefone: <strong>{{$customerData['telefone_cliente']}} </strong> </div>
                                                        <div>Documento:<strong>{{$customerData['documento_cliente']}} </strong> </div>
                                                    {{-- @endforeach --}}
                                                </div>
                                                <br />
                                        </div>

                                        <div >
                                            <div class="col-2">
                                                <select class="form-control" data-style="btn btn-link" name="metodo_pagamento" id="metodo_pagamento">
                                                    <option value="">Cartão de Crédito 1x</option>
                                                    <option value="">Cartão de Crédito 2x</option>
                                                    <option value="">Cartão de Crédito 3x</option>
                                                    <option value="">Cartão de Crédito 4x</option>
                                                    <option value="">Cartão de Débito</option>
                                                    <option value="">Dinheiro / à vista</option>
                                                    <option value="">Cheque</option>
                                                </select>

                                            </div>

                                            <div>Desconto: <input type="text" name="desconto" /></div> <br />
                                            
                                            <div>Valor Pago: <input type="text" name="valor_pago" /></div> <br />

                                            <p>Total: {{$sub_total}}</p>

                                            <p>Troco: R$ 00,00</p>

                                        </div>
                                        <br />
                                        <button type="submit" class="btn btn-success" id="close_selling">Fechar Venda</button>
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
<script src="{{ asset('js/sellings.js') }}"></script>
@endsection