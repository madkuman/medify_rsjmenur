<main id="main-container">
    <div class="bg-flower mb-20 px-0">
        <div class="content-header left px-0 container" >
                <div class="content-header-section">
                    <h4 class="pt-20 px-20 text-white"> <i class="fa fa-flask" ></i> LAB PK</h4>
                </div>

                <div class="content-header-section pl-20">
                    <ul class="nav-main-header">
                        <li>
                            <a @if($header == "transaksi") class="active" @endif href="{{url('labpk')}}">
                                <i class="fal fa-home d-none d-xl-inline-block"></i> Transaksi
                            </a>
                        </li>
                        <li>
                            <a @if($header == "verifikasi") class="active" @endif href="{{url('labpk/transaksi/verifikasi')}}">
                                <i class="fal fa-check d-none d-xl-inline-block"></i> Verifikasi Transaksi
                            </a>
                        </li>
                        <li>
                            <a  @if($header == "histori") class="active" @endif href="{{url('labpk/histori')}}">
                                <i class="fal fa-book d-none d-xl-inline-block"></i> Histori Transaksi
                            </a>
                        </li>
                        <li>
                            <a @if($header == "monitoring") class="active" @endif href="{{url('labpk/monitoring')}}">
                                <i class="fa fa-tv"></i> Monitoring
                            </a>
                        </li>
                        <li>
                            <a @if($header == "laporan") class="active" @endif href="{{url('labpk/laporan')}}">
                                <i class="fa fa-bar-chart"></i> Laporan
                            </a>
                        </li>
                        <li>
                            <a @if($header == "pengaturan") class="active" @endif href="{{url('labpk/pengaturan')}}">
                                <i class="si si-settings d-none d-xl-inline-block"></i> Pengaturan
                            </a>
                        </li>
                    </ul>

                    <div class="btn-group mobile-block" role="group">
                        <button type="button" class="btn btn-dual-secondary" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -138px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a class="dropdown-item" href="{{url('labpk')}}">
                                <i class="si si-home"></i> Transaksi
                            </a>
                            <a class="dropdown-item" href="{{url('labpk/transaksi/verifikasi')}}">
                                <i class="si si-eye"></i> Verifikasi Transaksi
                            </a>
                            <a class="dropdown-item"  href="{{url('labpk/histori')}}">
                                <i class="si si-flag"></i> Histori Transaksi
                            </a>
                            <a class="dropdown-item" href="{{url('labpk/laporan')}}">
                                <i class="fa fa-bar-chart"></i> Laporan Statistik
                            </a>
                            <a class="dropdown-item" href="{{url('labpk/pengaturan')}}">
                                <i class="si si-settings"></i> Pengaturan
                            </a>
                        </div>
                    </div>
                </div>
        </div>


    </div>
