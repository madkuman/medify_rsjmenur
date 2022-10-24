<div class="row">
    <div class="col-12">
        <div class="block" style="background-color: #FCFCFD">
            <div class="block-content container pb-10">
                <h4><span class="text-muted font-w400">Rawat Inap / </span> @yield('subtitle')</h4>
                <ul class="nav full-only">
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('rawatinap/bangsal')}}"><i class="fa fa-bed"></i> Ruangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('rawatinap/transaksi/pendaftaran')}}"><i class="fa fa-stethoscope"></i> Permintaan Rawat Inap</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('rawatinap/histori-transaksi')}}"><i class="fa fa-address-book"></i> Histori Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('rawatinap/cari')}}"><i class="fa fa-search"></i> Cari Pasien</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('rawatinap/statistik')}}"><i class="fa fa-bar-chart"></i> Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('rawatinap/info-bangsal')}}"><i class="fa fa-info"></i> Informasi Ruangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('rawatinap/info-bangsal/screen-tv')}}"><i class="fa fa-fw fa-tv"></i> Screen TV</a>
                    </li>

                    @if(Auth::user()->admin)
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('rawatinap/pengaturan')}}"><i class="fa fa-cog"></i> Pengaturan</a>
                    </li>
                    @endif
                </ul>
                <ul class="nav mobile-block row">
                    <li class="nav-item col-12">
                        <a class="nav-link link-effect active" href="{{url('rawatinap/bangsal')}}"><i class="fa fa-bed"></i> Ruangan</a>
                    </li>
                    <li class="nav-item col-12">
                        <a class="nav-link link-effect active" href="{{url('rawatinap/transaksi/pendaftaran')}}"><i class="fa fa-stethoscope"></i> Permintaan Rawat Inap</a>
                    </li>
                    <li class="nav-item col-12">
                        <a class="nav-link link-effect active" href="{{url('rawatinap/histori-transaksi')}}"><i class="fa fa-address-book"></i> Histori Transaksi</a>
                    </li>
                    <li class="nav-item col-12">
                        <a class="nav-link link-effect" href="{{url('rawatinap/cari')}}"><i class="fa fa-search"></i> Cari Pasien</a>
                    </li>
                    <li class="nav-item col-12">
                        <a class="nav-link link-effect" href="{{url('rawatinap/statistik')}}"><i class="fa fa-bar-chart"></i> Laporan & Statistik</a>
                    </li>
                    @if(Auth::user()->admin)
                    <li class="nav-item">
                        <a class="nav-link link-effect" href="{{url('rawatinap/pengaturan')}}"><i class="fa fa-cog"></i> Pengaturan</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>