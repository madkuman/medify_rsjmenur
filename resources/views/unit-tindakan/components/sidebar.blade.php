
    <li class="nav-header">
        <a class="nav-link ">
            <p>Gudang Farmasi</p>
        </a>
    </li>
    <li class="nav-item {{ ($routeFlag == 1) ? "active" : "no-active" }} {{-- active --}}">
        <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
            <i class="fa fa-exchange"></i>
            <p>
                Transaksi
                <b class="caret"></b>
            </p>
        </a>
        @php $link = Request::path() @endphp
        <div class="collapse {{ ($routeFlag == 1) ? "show" : "no-show" }} {{-- show --}}" id="componentsExamples">
            <ul class="nav">
                <li class="nav-item {{ ($link == "warehouse/transaction/today" || $link == "warehouse") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/transaction/today')}}">
                        <span class="sidebar-mini"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Transaksi Terbaru</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "warehouse/transaction/new") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/transaction/new')}}">
                        <span class="sidebar-mini"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Tambah Transaksi</span>
                        <span class="sidebar-line"></span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "warehouse/transaction") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/transaction')}}">
                        <span class="sidebar-mini"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Rekap Transaksi</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item {{ ($routeFlag == 4) ? "active" : "no-active" }} {{-- active --}}">
        <a class="nav-link" data-toggle="collapse" href="#componentPengadaan">
            <i class="fa fa-suitcase" aria-hidden="true"></i>
            <p>
                Pengadaan
                <b class="caret"></b>
            </p>
        </a>
        @php $link = Request::path() @endphp
        <div class="collapse {{ ($routeFlag == 4) ? "show" : "no-show" }} {{-- show --}}" id="componentPengadaan">
            <ul class="nav">
                <li class="nav-item {{ ($link == "warehouse/pengadaan/today" || $link == "warehouse") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/pengadaan/today')}}">
                        <span class="sidebar-mini"><i class="fa fa-refresh" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Pengadaan Terbaru</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "warehouse/pengadaan/new") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/pengadaan/new')}}">
                        <span class="sidebar-mini"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Tambah Pengadaan</span>
                        <span class="sidebar-line"></span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "warehouse/transaction") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/pengadaan')}}">
                        <span class="sidebar-mini"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Rekap Pengadaan</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item {{ ($routeFlag == 2) ? "active" : "no-active" }}">
        <a class="nav-link" data-toggle="collapse" href="#formsExamples">
            <i class="fa fa-truck"></i>
            <p>
                Supplier
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse {{ ($routeFlag == 2) ? "show" : "no-show" }}" id="formsExamples">
            <ul class="nav">
                <li class="nav-item {{ ($link == "warehouse/supplier") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/supplier')}}">
                        <span class="sidebar-mini"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Daftar Supplier</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "warehouse/supplier/new") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/supplier/new')}}">
                        <span class="sidebar-mini"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Tambah Supplier</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    <li class="nav-item {{ ($routeFlag == 3) ? "active" : "no-active" }}">
        <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
            <i class="fa fa-cubes"></i>
            <p>
                Barang
                <b class="caret"></b>
            </p>
        </a>
        <div class="collapse {{ ($routeFlag == 3) ? "show" : "no-active" }}" id="tablesExamples">
            <ul class="nav">
                <li class="nav-item {{ ($link == "warehouse/item") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/item')}}">
                        <span class="sidebar-mini"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Daftar Barang</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "warehouse/item/create") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/item/create')}}">
                        <span class="sidebar-mini"><i class="fa fa-plus" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Tambah Barang</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "warehouse/log") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/item/log')}}">
                        <span class="sidebar-mini"><i class="fa fa-history" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Mutasi Barang</span>
                    </a>
                </li>
                <li class="nav-item {{ ($link == "warehouse/category") ? "active" : "no-active" }}">
                    <a class="nav-link" href="{{url('warehouse/category')}}">
                        <span class="sidebar-mini"><i class="fa fa-list" aria-hidden="true"></i></span>
                        <span class="sidebar-normal">Kategori Barang</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>