<div class="row">
    <div class="col-12">
        <div class="block" style="background-color: #FCFCFD">
            <div class="block-content container pb-10">
                <a href="{{url('igd/triage/baru')}}" class="btn btn-primary pull-right">+ Triage</a>
                <!-- <a href="{{url('pasien')}}" class="btn btn-primary pull-right">+ Daftarkan Pasien Baru ke IGD</a> -->
                <h4><span class="text-muted font-w400">IGD / </span> @yield('subtitle')</h4>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('igd/ruangan')}}"><i class="fa fa-stethoscope"></i> Ruangan IGD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('igd/histori-transaksi')}}"><i class="fa fa-address-book"></i> Histori Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link link-effect" id="toolbarDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i> Antrian</a>
                        <div class="dropdown-menu" aria-labelledby="toolbarDrop">
                            <a class="dropdown-item" href="{{url('igd/antrian-screen')}}">
                                <i class="fa fa-fw fa-tv mr-5"></i>Layar Antrian
                            </a>
                            <a class="dropdown-item" href="{{url('igd/antrian-mesin')}}">
                                <i class="fa fa-fw fa-ticket mr-5"></i>Mesin Antrian
                            </a>
                            <a class="dropdown-item" href="{{url('igd/antrian-button')}}">
                                <i class="fa fa-fw fa-volume-up mr-5"></i>Panggil Pasien Berikutnya
                            </a>
                            <a class="dropdown-item" href="{{url('igd/antrian-list')}}">
                                <i class="fa fa-fw fa-list-ul mr-5"></i>List Semua Antrian
                            </a>
                        </div>

                       
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('igd/statistik')}}"><i class="fa fa-bar-chart"></i> Laporan & Statistik</a>
                    </li>
                    @if(Auth::user()->admin)
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('igd/pengaturan')}}"><i class="fa fa-cog"></i> Pengaturan</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>