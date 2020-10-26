@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

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

      <h1 class="text-center">Bem-vindo ao Aços Galan System</h1>
      <hr />
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Ordens de transferencia</h4>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>Estoque a Fornecer</th>
                  <th>Estoque a Receber</th>
                  <th>Produto</th>
                  <th>Quantidade</th>
                  <th>Responsavel pela Retirada</th>
                  <th>Status da Ordem</th>
                  <th>#</th>
                </thead>
                <tbody>
                  @foreach ($transfers as $key => $transfer)
                  @if (auth()->user()->storage_id == $transfer->estoque_fornece || auth()->user()->role_id == 1)
                  <tr>
                      <td>{{$transfer->estoque_a_fornecer}} (Esta loja)</td>
                      <td>{{$transfer->estoque_a_receber}}</td> 
                      <td>{{$transfer->descricao}}</td>
                      <td>{{$transfer->quantidade}}</td>
                      <td>{{$transfer->responsavel_retira}}</td>
                      <td>{{$transfer->status_transferencia}}</td>
                      <td class="td-actions">
                        @if ($transfer->status_transferencia == 'ordem_aberta')
                            <form action="{{route('transfer.close', ['transfer' => $transfer->id])}}" method="post">
                            @method('PATCH')
                                @csrf
                                <input type="text" name="responsavel_entrega" placeholder="Responsavel pela Entrega" required>
                                <button type="submit" rel="tooltip" class="btn btn-success" title="Fechar Ordem">
                                    <i class="material-icons">done</i>
                                </button>
                            </form>
                        @elseif($transfer->status_transferencia == 'ordem_fechada')
                        <form action="{{route('transfer.pdf', ['transfer' => $transfer->id])}}" method="get">
                            @csrf
                            <button type="submit" rel="tooltip" class="btn btn-warning" title="Imprimir Ordem">
                                <i class="material-icons">print</i>
                            </button>
                        </form>
                        @endif
                    </td>
                    </tr>
                  @endif
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


    @if (auth()->user()->role_id == 1)
    {{-- <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <i class="material-icons">content_copy</i>
              </div>
              <p class="card-category">Used Space</p>
              <h3 class="card-title">49/50
                <small>GB</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-danger">warning</i>
                <a href="#pablo">Get More Space...</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">store</i>
              </div>
              <p class="card-category">Revenue</p>
              <h3 class="card-title">$34,245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">date_range</i> Last 24 Hours
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <i class="material-icons">info_outline</i>
              </div>
              <p class="card-category">Fixed Issues</p>
              <h3 class="card-title">75</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">local_offer</i> Tracked from Github
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <i class="fa fa-twitter"></i>
              </div>
              <p class="card-category">Followers</p>
              <h3 class="card-title">+245</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">update</i> Just Updated
              </div>
            </div>
          </div>
        </div>
      </div> --}}

      <h3>Relatórios de Vendas</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Vendas Semanal - <strong> 26/10/2020 a 30/10/2020</strong></h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Vendas Mensal - <strong> OUT - 2020</strong></h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div>

      <h3>Relatórios de Orçamentos</h3>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart2"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Orçamentos Semanal - <strong> 26/10/2020 a 30/10/2020</strong></h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart2"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Orçamentos Mensal - <strong> OUT - 2020</strong></h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush
