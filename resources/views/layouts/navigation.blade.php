<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="{{route('dashboard')}}" class="logo">
          <img src="{{asset('storage/TradeHubLogo_new.png')}}"
            alt="navbar brand"
            class="navbar-brand"
            height="40"
          />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item active">
            <a
              href="{{route('dashboard')}}"
            >
              <i class="fas fa-home"></i>
              <p>{{__('Beranda')}}</p>
            </a>
          </li>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">{{__('Data')}}</h4>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#base">
              <i class="fas fa-database"></i>
              <p>{{__('Master')}}</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="base">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('product')}}">
                    <span class="sub-item">{{__('Produk / Barang')}}</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('kontak')}}">
                    <span class="sub-item">{{__('Kontak')}}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">{{__('Transaksi')}}</h4>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#sidebarLayouts">
              <i class="fas fa-file-invoice-dollar"></i>
              <p>{{__('Transaksi Masuk')}}</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="sidebarLayouts">
              <ul class="nav nav-collapse">
                <li>
                  <a data-bs-toggle="collapse" href="#subnav1">
                    <span class="sub-item">{{__('Penjualan')}}</span>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse" id="subnav1">
                    <ul class="nav nav-collapse subnav">
                      <li>
                        <a href="{{route('jual_langsung')}}">
                          <span class="sub-item">{{__('Penjualan Langsung')}}</span>
                        </a>
                      </li>
                      <li>
                        <a href="{{route('jual_titip')}}">
                          <span class="sub-item">{{__('Titip Jual')}}</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#forms">
              <i class="fas fa-hand-holding-usd"></i>
              <p>{{__('Transaksi Keluar')}}</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="forms">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('cost')}}">
                    <span class="sub-item">{{__('Pembelian / Pencatatan Beban')}}</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          {{-- <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">{{__('Laporan')}}</h4>
          </li> --}}
        </ul>
      </div>
    </div>
  </div>