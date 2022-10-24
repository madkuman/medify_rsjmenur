<div class="js-inbox-nav d-none d-md-block">
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Gudang Inventori</h3>
        </div>
        <div class="block-content">
            <ul class="nav nav-pills flex-column push">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'dashboard') active @endif" href="{{route('admin.home')}}">
                        <span><i class="fa fa-fw fa-home mr-5"></i> Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'pengadaan') active @endif" href="{{route('transaction.index')}}">
                        <span><i class="fa fa-fw fa-money mr-5"></i> Pengadaan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'kategori') active @endif" href="{{route('category.index')}}">
                        <span><i class="fa fa-fw fa-code-fork mr-5"></i> Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'item') active @endif" href="{{route('items_template.index')}}">
                        <span><i class="fa fa-fw fa-cube mr-5"></i> Barang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'supplier') active @endif" href="{{route('supplier.index')}}">
                        <span><i class="fa fa-fw fa-truck mr-5"></i> Supplier</span>
                    </a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'laporan') active @endif" href="{{route('admin.laporan')}}">
                        <span><i class="fa fa-fw fa-files-o mr-5"></i> Laporan</span>
                    </a>
                </li>
            -->
            </ul>
        </div>
    </div>
</div>
