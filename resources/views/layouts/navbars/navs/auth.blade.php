<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
    <div class="container-fluid">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
              <a class="nav-link" href="/" aria-haspopup="true" aria-expanded="false">
                  Home
              </a>
          </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#!" id="cadastroDropDown" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Cadastro
                </a>
                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="cadastroDropDown">
                    <a class="dropdown-item" href="/cliente">Cliente</a>
                    <a class="dropdown-item" href="/produto">Produto</a>
                    <a class="dropdown-item" href="/fornecedor">Fornecedor</a>
                    <a class="dropdown-item" href="/estoque">Estoque</a>
                    <a class="dropdown-item" href="/user">Usuário</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="movimentacaoDropDown" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Movimentação
                </a>
                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="movimentacaoDropDown">
                    <a class="dropdown-item" href="/movimentacao/vendas">Vendas</a>
                    <a class="dropdown-item" href="/movimentacao/orcamento">Orçamentos</a>
                    <a class="dropdown-item" href="/movimentacao/trocas">Trocas de mercadoria</a>
                    <a class="dropdown-item" href="/movimentacao/compras">Compras</a>
                    <a class="dropdown-item" href="/movimentacao/pedidos-compra">Pedidos de Compra</a>
                    <a class="dropdown-item" href="/movimentacao/saida-caixa">Saídas do Caixa</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Pesquise um produto...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <p class="d-lg-none d-md-block">
                            {{ __('Account') }}
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        <a class="dropdown-item" href="#">{{ __('Settings') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
