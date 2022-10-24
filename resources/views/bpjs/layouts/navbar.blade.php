
    <div class="row">
        <div class="col-12">
            <div class="block" style="background-color: #FCFCFD">
                <div class="block-content container pb-10">
                    <h4><span class="text-muted font-w400">BPJS / </span> @yield('subtitle')</h4>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link link-effect active" href="{{url('bpjs')}}"><i class="fa fa-envelope"></i> SEP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-effect|" href="{{url('bpjs/sep/internal')}}"><i class="fa fa-envelope"></i> SEP Internal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-effect" href="{{url('bpjs/pengajuan')}}"><i class="fa fa-file"></i> Pengajuan SEP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-effect" href="{{url('bpjs/approve')}}"><i class="fa fa-check"></i> Approval SEP</a>
                        </li>
                        <div class="btn-group" role="group">
                            <a type="button" class="btn btn-square dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-forward"></i> Rujukan</a>
                            <div class="dropdown-menu" aria-labelledby="btn_dropdown_kasus">
                                <a class="nav-link link-effect" href="{{url('bpjs/rujukan')}}">Rujukan</a>
                                <a class="nav-link link-effect" href="{{url('bpjs/rujukan-keluar')}}">Rujukan Keluar</a>
                                <a class="nav-link link-effect" href="{{url('bpjs/rujuk-balik')}}">Rujuk Balik</a>
                                <a class="nav-link link-effect" href="{{url('bpjs/rujukan-list-khusus')}}">Rujukan Khusus</a>
                            </div>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link link-effect" href="{{url('bpjs/monitoring/kunjungan')}}"><i class="fa fa-users"></i> Kunjungan Peserta</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle link-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-television"></i> Monitoring
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{url('bpjs/monitoring-pasien')}}">Pasien</a>
                                <a class="dropdown-item" href="{{url('bpjs/monitoring/kelengkapan-berkas')}}">Kelengkapan Berkas</a>
                                <a class="dropdown-item" href="{{url('bpjs/monitoring/data-klaim')}}">Data Klaim</a>
                                <a class="dropdown-item" href="{{url('bpjs/monitoring/potensi-klaim')}}">Potensi Klaim</a>
                                <a class="dropdown-item" href="{{url('bpjs/monitoring/plafon-kasus')}}">Plafon Kasus</a>
                            </div>
                        </li>
                        <div class="btn-group" role="group">
                            <a type="button" class="btn btn-square dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-prescription-bottle-alt"></i> Rencana Kontrol</a>
                            <div class="dropdown-menu" aria-labelledby="btn_dropdown_kasus">
                                <a class="nav-link link-effect" href="{{url('bpjs/rencana-kontrol/2')}}">SKDP</a>
                                <a class="nav-link link-effect" href="{{url('bpjs/rencana-kontrol/1')}}">SPRI</a>
                            </div>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link link-effect" href="{{url('bpjs/rujukan-listsarana-ppkr')}}"><i class="fas fa-hospital"></i> List Sarana PPK Rujukan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-effect" href="{{url('bpjs/referensi')}}"><i class="fas fa-book"></i> Referensi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
