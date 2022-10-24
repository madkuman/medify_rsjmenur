<div class="js-inbox-nav d-none d-md-block">
  <div class="block">
    <div class="block-header block-header-default">
      <h3 class="block-title">Kamar Jenazah</h3>
    </div>
    <div class="block-content">
      <ul class="nav nav-pills flex-column push">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'dashboard') active @endif" href="{{url('kamarjenazah')}}">
            <span><i class="fa fa-fw fa-home mr-5"></i> Dashboard</span>
          </a>

        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'transaksi') active @endif" href="{{url('kamarjenazah/transaksi')}}">
            <span><i class="fa fa-fw fa-money mr-5"></i> Riwayat Transaksi
            </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'layanan') active @endif" href="{{url('kamarjenazah/layanan')}}">
            <span><i class="fa fa-fw fa-book mr-5"></i> Daftar Layanan
            </span>
          </a>
        </li>
      </ul>
      <hr>
      <a href="@yield('url')" class="nav-link d-flex align-items-center justify-content-between">
        <span class="text-primary">@yield('toprightmenu')
        </span>
      </a>

    </div>
  </div>
</div>
