<div class="js-inbox-nav d-none d-md-block">
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Gudang Farmasi</h3>
        </div>
        <div class="block-content">
            <ul class="nav nav-pills flex-column push">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'dashboard') active @endif" href="{{url('gudang')}}">
                        <span><i class="fa fa-fw fa-home mr-5"></i> Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'pengadaan') active @endif" href="{{url('gudang/pengadaan')}}">
                        <span><i class="fa fa-fw fa-money mr-5"></i> Penerimaan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'distribusi') active @endif" href="{{url('gudang/distribusi')}}">
                        <span><i class="fa fa-fw fa-code-fork mr-5"></i> Distribusi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'penghapusan') active @endif" href="{{url('gudang/penghapusan')}}">
                        <span><i class="fa fa-fw fa-trash mr-5"></i> Penghapusan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'item') active @endif" href="{{url('gudang/item')}}">
                        <span><i class="fa fa-fw fa-cube mr-5"></i> Barang</span>
                    </a>
                </li>
                @if($sidebar_active == 'item' || $sidebar_active == 'item_exp' || $sidebar_active == 'item_stok')
                <li class="nav-item">
                    <a style="padding-left: 28px;" class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'item_exp') active @endif" href="{{url('gudang/item-exp')}}">
                        <span> -&nbsp;&nbsp;<i class="fa fa-fw fa-cube mr-5"></i> Barang Expired</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a style="padding-left: 28px;" class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'item_stok') active @endif" href="{{url('gudang/item-stok')}}">
                        <span> -&nbsp;&nbsp;<i class="fa fa-fw fa-cube mr-5"></i> Barang Stok Tipis</span>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'kategori') active @endif" href="{{url('gudang/kategori')}}">
                        <span><i class="fa fa-fw fa-columns mr-5"></i> Kategori Barang</span>
                    </a>
                </li>
{{--
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'supplier') active @endif" href="{{url('gudang/supplier')}}">
                        <span><i class="fa fa-fw fa-truck mr-5"></i> Supplier</span>
                    </a>
                </li>
--}}
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'laporan') active @endif" href="{{url('gudang/laporan')}}">
                        <span><i class="fa fa-fw fa-files-o mr-5"></i> Laporan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center justify-content-between @if($sidebar_active == 'stokopname') active @endif" href="{{url('gudang/stokopname')}}">
                        <span><i class="fa fa-fw fa-files-o mr-5"></i> Stok Opname</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>