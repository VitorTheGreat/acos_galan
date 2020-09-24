@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  {{-- <div class="content">
    <div class="container-fluid">
        <h1 class="text-center">Aços Galan</h1>
    </div>
  </div> --}}

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
                    <tr>
                      <td>{{$transfer->estoque_a_fornecer}}</td>
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
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
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
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-success">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Daily Sales</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Email Subscriptions</h4>
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
              <h4 class="card-title">Completed Tasks</h4>
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
