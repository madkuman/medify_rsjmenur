
    <li class="nav-header">
        <a class="nav-link ">
            <p>Rawat Inap</p>
        </a>
    </li>
    <li class="nav-item {{ ($routeFlag == 1) ? "active" : "no-active" }} {{-- active --}}">
        <a class="nav-link" data-toggle="collapse" href="#transaksiSidebar">
            <i class="fa fa-exchange"></i>
            <p>
                Transaksi
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse {{ ($routeFlag == 1) ? "show" : "no-show" }} {{-- show --}}" id="transaksiSidebar">
            <ul class="nav">
                <li class="nav-item {{ ($link == "transaksi/pendaftaran/permintaan") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('rawatinap/transaksi/pendaftaran')}}">
                        <span class="sidebar-mini"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Permintaan Rawat Inap</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "transaksi/pendaftaran/histori") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('rawatinap/transaksi/histori')}}">
                        <span class="sidebar-mini"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Histori Transaksi</span>
                        <span class="sidebar-line"></span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item {{ ($routeFlag == 2) ? "active" : "no-active" }}">
        <a class="nav-link" href="{{url('rawatinap/bangsal')}}">
            <i class="fa fa-truck"></i>
            <p>
                Ruangan
            </p>
        </a>
    </li>