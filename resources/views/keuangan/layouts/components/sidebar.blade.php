<nav id="sidebar">
    <div id="sidebar-scroll">
        <div class="sidebar-content">
            <div class="content-header content-header-fullrow bg-black-op-10">
                <div class="content-header-section text-center align-parent">
                    <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r mt-10" data-toggle="layout" data-action="sidebar_close">
                        <i class="fa fa-times text-danger fa-2x"></i>
                    </button>

                </div>
            </div>
            
            <div class="content-side content-side-full">
                <ul class="nav-main">
                    <li>
                        <a @if($sidebar_active == 'dashboard') class="active" @endif href="{{url('keuangan/dashboard')}}"><i class="si si-home"></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a @if($sidebar_active == 'pemasukan') class="active" @endif href="{{url('keuangan/pemasukan')}}"><i class="si si-basket"></i><span>Pemasukan</span></a>
                    </li>
                    <li>
                        <a @if($sidebar_active == 'paket_pemasukan') class="active" @endif href="{{url('keuangan/paket-pemasukan')}}"><i class="si si-basket"></i><span>Paket Penerimaan</span></a>
                    </li>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i>Pengeluaran</a>
                        <ul>
                            <li>
                                <a href="{{url('keuangan/po')}}">PO</a>
                            </li>
                            <li>
                                <a href="{{url('keuangan/penerimaan')}}">Penerimaan</a>
                            </li>
                            <li>
                                <a href="{{url('keuangan/pjk')}}">PJK</a>
                            </li>
                            @if(Session('group_is_proga'))
                            <li>
                                <a href="{{url('keuangan/pjk')}}">SPP</a>
                            </li>
                            @endif
                            <li>
                                <a href="{{url('keuangan/pjk')}}">UJI</a>
                            </li>
                            <li>
                                <a href="{{url('keuangan/pjk')}}">BK</a>
                            </li>
                            <li>
                                <a href="{{url('keuangan/pjk')}}">Transaksi File</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-puzzle"></i>Tagihan / Piutang</a>
                        <ul>
                            <li>
                                <a href="{{url('keuangan/piutang')}}">Tagihan / Piutang</a>
                            </li>
                            <li>
                                <a href="{{url('keuangan/penagihan')}}">Penagihan</a>
                            </li>
                            <li>
                                <a href="{{url('keuangan/penagihan-siap')}}">Penagihan Siap Bayar</a>
                            </li>
                            <li>
                                <a href="{{url('keuangan/deposit')}}">Deposit</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a @if($sidebar_active == 'tarif') class="active" @endif href="{{url('keuangan/tarif')}}"><i class="si si-calculator"></i><span>Tarif</span></a>
                    </li>

                        <li>
                            <a @if($sidebar_active == 'jasa-medis') class="active" @endif href="{{url('keuangan/jasa-medis')}}"><i class="si si-cup"></i><span>Jasa Medis</span></a>
                        </li>

                    <li>
                        <a @if($sidebar_active == 'laporan') class="active" @endif href="{{url('keuangan/laporan')}}"><i class="si si-bar-chart"></i><span>Laporan</span></a>
                    </li>
                    
                    <li>
                        <a @if($sidebar_active == 'kategori') class="active" @endif href="{{url('keuangan/pengaturan')}}"><i class="si si-settings"></i><span>Pengaturan</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="bg-white mb-20" >
    <div class="sidebar-content">

        <div class="content-side content-side-full d-none d-lg-block"  style="overflow: visible !important;">
            <ul class="nav-main-header">
                <li>
                    <a @if($sidebar_active == 'dashboard') class="active" @endif href="{{url('keuangan/dashboard')}}"><i class="si si-home"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                </li>

                {{-- <li class="nav-main-heading"><span class="sidebar-mini-visible">UI</span><span class="sidebar-mini-hidden">Menu Utama</span></li> --}}

                <li>
                    <a @if($sidebar_active == 'pemasukan') class="active" @endif href="{{url('keuangan/pemasukan')}}"><i class="si si-basket"></i><span class="sidebar-mini-hide">Pemasukan</span></a>
                </li>
                <li>
                    <a @if($sidebar_active == 'paket_pemasukan') class="active" @endif href="{{url('keuangan/paket-pemasukan')}}"><i class="si si-basket"></i><span class="sidebar-mini-hide">Paket Penerimaan</span></a>
                </li>

                <li>
                    <div class="btn-group" role="group">
                        <a class="btn btn-square dropdown-toggle" id="page-header-options-dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="si si-action-redo" aria-hidden="true"></i>Pengeluaran
                        </a>
                        <div class="dropdown-menu" aria-labelledby="page-header-options-dropdown2">
                            <a href="{{url('keuangan/po')}}" class="dropdown-item">
                                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;PO
                            </a>
                            <a href="{{url('keuangan/penerimaan')}}" class="dropdown-item">
                                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Penerimaan
                            </a>
                            <a href="{{url('keuangan/pjk')}}" class="dropdown-item">
                                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;PJK
                            </a>
                            @if(Session('group_is_proga'))
                            <a href="{{url('keuangan/spp')}}" class="dropdown-item">
                                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;SPP
                            </a>
                            @endif
                            <a href="{{url('keuangan/uji')}}" class="dropdown-item">
                                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;UJI
                            </a>
                            <a href="{{url('keuangan/pengeluaran')}}" class="dropdown-item">
                                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;BK
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{url('keuangan/transaksi-file')}}" class="dropdown-item">
                                <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Transaksi File
                            </a>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="btn-group" role="group">
                        <a class="btn btn-square dropdown-toggle" id="page-header-options-dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="si si-tag" aria-hidden="true"></i>Tagihan / Piutang
                        </a>
                        <div class="dropdown-menu" aria-labelledby="page-header-options-dropdown2">
                            <a href="{{url('keuangan/piutang')}}" class="dropdown-item">
                                <i class="si si-tag" aria-hidden="true"></i>&nbsp;&nbsp;Tagihan / Piutang
                            </a>
                            <a href="{{url('keuangan/penagihan')}}" class="dropdown-item">
                                <i class="si si-tag" aria-hidden="true"></i>&nbsp;&nbsp;Penagihan
                            </a>
                            <a href="{{url('keuangan/penagihan-siap')}}" class="dropdown-item">
                                <i class="si si-tag" aria-hidden="true"></i>&nbsp;&nbsp;Penagihan Siap Bayar
                            </a>
                            <a href="{{url('keuangan/deposit')}}" class="dropdown-item">
                                <i class="si si-tag" aria-hidden="true"></i>&nbsp;&nbsp;Deposit
                            </a>
                        </div>
                    </div>
                </li>

                <li>
                    <a @if($sidebar_active == 'tarif') class="active" @endif href="{{url('keuangan/tarif')}}"><i class="si si-calculator"></i><span class="sidebar-mini-hide">Tarif</span></a>
                </li>
                {{--
                <li>
                    <a @if($sidebar_active == 'jasa-medis') class="active" @endif href="{{url('keuangan/jasa-medis')}}"><i class="si si-cup"></i><span class="sidebar-mini-hide">Jasa Medis</span></a>
                </li>
                --}}

                <li>
                    <a @if($sidebar_active == 'laporan') class="active" @endif href="{{url('keuangan/laporan')}}"><i class="si si-bar-chart"></i><span class="sidebar-mini-hide">Laporan</span></a>
                </li>
                
                <li>
                    <a @if($sidebar_active == 'kategori') class="active" @endif href="{{url('keuangan/pengaturan')}}"><i class="si si-settings"></i><span class="sidebar-mini-hide">Pengaturan</span></a>
                </li>
            </ul>
        </div>

        <div class="content-header-section text-center">
            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none mb-10" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon fa-2x"></i>
            </button>
        </div>
    </div>
</div>