
    <li class="nav-header">
        <a class="nav-link ">
            <p>Rawat Jalan</p>
        </a>
    </li>
    <li class="nav-item {{ ($routeFlag == 1) ? "active" : "no-active" }} {{-- active --}}">
        <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
            <i class="fa fa-exchange"></i>
            <p>
                Poliklinik
                <b class="caret"></b>
            </p>
        </a>
        @php $link = Request::path() @endphp
        <div class="collapse {{ ($routeFlag == 1) ? "show" : "no-show" }} {{-- show --}}" id="componentsExamples">
            <ul class="nav">
                <li class="nav-item {{ ($link == "rawatjalan/poliklinik") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('rawatjalan/poliklinik')}}">
                        <span class="sidebar-mini"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Daftar Poliklinik</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "rawatjalan/poliklinik/antrian") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('rawatjalan/poliklinik/antrian')}}">
                        <span class="sidebar-mini"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Daftar Antrian</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "rawatjalan/poliklinik/antrian/baru") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('rawatjalan/poliklinik/antrian/baru')}}">
                        <span class="sidebar-mini"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Antrian Baru</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item {{ ($routeFlag == 2) ? "active" : "no-active" }} {{-- active --}}">
        <a class="nav-link" data-toggle="collapse" href="#historyExamples">
            <i class="fa fa-exchange"></i>
            <p>
                Transaksi
                <b class="caret"></b>
            </p>
        </a>
        @php $link = Request::path() @endphp
        <div class="collapse {{ ($routeFlag == 2) ? "show" : "no-show" }} {{-- show --}}" id="historyExamples">
            <ul class="nav">
                <li class="nav-item {{ ($link == "rawatjalan/poliklinik/historis") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('rawatjalan/poliklinik/historis')}}">
                        <span class="sidebar-mini"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Histori Transaksi</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "rawatjalan/poliklinik/statistik") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('rawatjalan/poliklinik/statistik')}}">
                        <span class="sidebar-mini"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Statistik</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>