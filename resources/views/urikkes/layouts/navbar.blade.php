

<div class="row">
    <div class="col-12">
        <div class="block" style="background-color: #FCFCFD">
            <div class="block-content container pb-10">
                <h4><span class="text-muted font-w400">Medical Checkup / </span> @yield('subtitle')</h4>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('urikkes/histori-transaksi')}}"><i class="fa fa-address-book"></i> Histori Pemeriksaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('urikkes/pemeriksaan-harian')}}"><i class="fa fa-tachometer"></i> Pemeriksaan Harian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('urikkes/laporan')}}"><i class="fa fa-print"></i> Laporan</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link link-effect active" href="{{url('urikkes/pengaturan')}}"><i class="fa fa-cog"></i> Pengaturan</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
