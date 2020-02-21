@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Vendas')])

@section('content')
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <h1>Vendas</h1>
                <hr>
                <div class="card">
                    <div class="card-header card-header-primary">
                      {{--  <h4 class="card-title ">Simple Table</h4>  --}}
                      <p class="card-category"> Vendas/Orçamento</p>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">

                      </div>
                    </div>
                  </div>
            </div>
        </div>

    </div>
</div>

@endsection
