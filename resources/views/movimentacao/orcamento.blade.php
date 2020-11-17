@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Vendas')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h1>Orçamentos</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category">Orçamento abertos</p>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Total</th>
                                    <th>Desconto</th>
                                    <th>Total com Desconto</th>
                                    <th>Cliente</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($orcamentos as $key => $orcamento)
                              <tr>
                                  <td>{{$orcamento->id}}</td>
                                  <td> {{$orcamento->total}} </td>
                                  <td> {{$orcamento->valor_desconto}} </td>
                                  <td> {{$orcamento->preco_total_desconto}} </td>
                                  <td > {{$orcamento->nome}} </td>
                                  <td class="td-actions text-right">
                                  <form action="{{route('orcamento.close', ['id' => $orcamento->id])}}" method="post">
                                      @csrf
                                      @method('POST')
                                      <button type="submit" rel="tooltip" class="btn btn-success">
                                          <i class="material-icons">check</i>
                                      </button>
                                    </form>
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

@endsection
