
    <div class="row">
        <div class="col-12">
            <div class="block" style="background-color: #FCFCFD">
                <div class="block-content container pb-10">
                    <a href="{{url('pasien/baru')}}" class="btn btn-primary pull-right full-only">+ Pasien Baru</a>
                    <h4><span class="text-muted font-w400">Pasien / </span> @yield('subtitle')</h4>
                    <a href="{{url('pasien/baru')}}" class="btn btn-primary mobile-block" style="width: 100%">+ Pasien Baru</a>
                    <ul class="nav full-only">
                        <li class="nav-item">
                            <a class="nav-link link-effect active" href="{{url('pasien/dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-effect active" href="{{url('pasien/list-pasien')}}"><i class="fa fa-wheelchair"></i> Daftar Pasien</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-effect" href="{{url('pasien/laporan')}}"><i class="fa fa-file"></i> Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-effect" href="{{url('pasien/laporan-v2')}}"><i class="fa fa-file"></i> Laporan <span class="badge badge-primary">New</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-effect" href="{{url('pasien/statistik')}}"><i class="fa fa-bar-chart"></i> Statistik</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fa fa-calendar"></i> Daftar Online</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{url('pasien/daftar-online')}}">Daftar Pasien Online</a>
                                <a class="dropdown-item" href="{{url('pasien/pasien-baru-online')}}">Pasien Baru</a>
                                <a class="dropdown-item" href="{{url('pasien/daftar-online-batal')}}">Daftar Pasien Batal Online</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><i class="fa fa-calendar"></i> Antrian Pasien</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                               <a class="dropdown-item" href="{{url('pasien/antrian-pasien')}}">Mesin Antrian</a>
                                <a class="dropdown-item" href="{{url('pasien/pengaturan-loket')}}">Pengaturan Loket</a>
                                <a class="dropdown-item" href="{{url('pasien/konfirmasi-antrian')}}">Konfirmasi Antrian</a>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav row mobile-block">
                        <li class="nav-item col-12">
                            <a class="nav-link link-effect active" href="{{url('pasien/dashboard')}}"><i class="fa fa-tachometer"></i> Dashboard</a>
                        </li>
                        <li class="nav-item col-12">
                            <a class="nav-link link-effect active" href="{{url('pasien/list-pasien')}}"><i class="fa fa-wheelchair"></i> Daftar Pasien</a>
                        </li>
                        <li class="nav-item col-12">
                            <a class="nav-link link-effect" href="{{url('pasien/laporan')}}"><i class="fa fa-file"></i> Laporan</a>
                        </li>
                        <li class="nav-item col-12">
                            <a class="nav-link link-effect" href="{{url('pasien/statistik')}}"><i class="fa fa-bar-chart"></i> Statistik</a>
                        </li>
                        <li class="nav-item col-12">
                            <a class="nav-link link-effect" href="{{url('pasien/daftar-online')}}"><i class="fa fa-calendar"></i> Daftar Pasien Online</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
