
    <li class="nav-header">
        <a class="nav-link ">
            <p>IGD</p>
        </a>
    </li>
    <li class="nav-item {{ ($routeFlag == 1) ? "active" : "no-active" }} {{-- active --}}">
        <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
            <i class="fa fa-exchange"></i>
            <p>
                Ruangan
                <b class="caret"></b>
            </p>
        </a>
        @php $link = Request::path() @endphp
        <div class="collapse {{ ($routeFlag == 1) ? "show" : "no-show" }} {{-- show --}}" id="componentsExamples">
            <ul class="nav">
                <li class="nav-item {{ ($link == "igd/ruangan") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('igd/ruangan')}}">
                        <span class="sidebar-mini"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Ruangan</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "igd/ruangan/baru") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('igd/ruangan/baru')}}">
                        <span class="sidebar-mini"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Pendaftaran Pasien</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    