<main id="main-container">
    <div class="bg-image" style="background-image: url('assets/img/lab.jpg');">
        <div class="bg-black-op-75">
            <div class="content content-top content-full text-center">
                <div class="py-20">
                    <h1 class="h2 font-w700 text-white mb-10">Laboratorium Patologi Anatomi</h1>
                    
                </div>
            </div>

            <div class="container bg-white mb-20 px-0">
                <div class="content-header px-0" >
                    <!-- Left Section -->
                    <div class="content-header-section bg-info"  >
                        <h4 class="pt-20 px-20 text-white"> <i class="fa fa-gitlab" ></i></h4>
                    </div>

                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <ul class="nav-main-header">
                            <li>
                                <a @if($header == "transaksi") class="active" @endif href="{{url('labpa')}}">
                                    <i class="si si-home d-none d-xl-inline-block"></i> Transaksi
                                </a>
                            </li>
                            <li>
                                <a @if($header == "verifikasi") class="active" @endif href="{{url('labpa/transaksi/verifikasi')}}">
                                    <i class="si si-eye d-none d-xl-inline-block"></i> Verifikasi Transaksi
                                </a>
                            </li>
                            <li>
                                <a @if($header == "histori") class="active" @endif href="{{url('labpa/histori')}}">
                                    <i class="si si-flag d-none d-xl-inline-block"></i> Histori Transaksi
                                </a>
                            </li>
                            <li>
                                <a @if($header == "laporan") class="active" @endif href="{{url('labpa/laporan')}}">
                                    <i class="fa fa-bar-chart"></i> Laporan Statistik
                                </a>
                            </li>
                            <li>
                                <a @if($header == "pengaturan") class="active" @endif href="{{url('labpa/pengaturan')}}">
                                    <i class="si si-settings d-none d-xl-inline-block"></i> Pengaturan
                                </a>
                            </li>
                        </ul>

                        <div class="btn-group mobile-block" role="group">
                            <button type="button" class="btn btn-dual-secondary" id="btnGroupDrop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-navicon"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -138px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <a class="dropdown-item" href="{{url('labpa')}}">
                                    <i class="si si-home"></i> Transaksi
                                </a>
                                <a class="dropdown-item" href="{{url('labpa/transaksi/verifikasi')}}">
                                    <i class="si si-eye"></i> Verifikasi Transaksi
                                </a>
                                <a class="dropdown-item" href="{{url('labpa/histori')}}">
                                    <i class="si si-flag"></i> Histori Transaksi
                                </a>
                                <a class="dropdown-item" href="{{url('labpa/laporan')}}">
                                    <i class="fa fa-bar-chart"></i> Laporan Statistik
                                </a>
                                <a class="dropdown-item" href="{{url('labpa/pengaturan')}}">
                                    <i class="si si-settings"></i> Pengaturan
                                </a>
                            </div>
                        </div>


                    </div>


                    <!-- Right Section -->
                    <div class="content-header-section bg-info">
                        <h4 class="pt-20 px-20 text-white"><i class="fa fa-gitlab"></i></h4>
                    </div>
                </div>
            </div>

        </div>


    </div>
