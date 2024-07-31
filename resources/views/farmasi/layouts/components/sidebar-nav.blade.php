<div class="js-inbox-nav">
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{session('farmasi')->nama}}</h3>
            <div class="block-options">
                <div class="btn-group" role="group">
                    @if(session('farmasi')->is_produksi)
                    <a class="btn btn-rounded btn-secondary mr-5" href="{{url('farmasi/'.session('farmasi')->slug.'/produksi')}}"><span><i class="fa fa-fw fa-pills mr-5"></i> Produksi</span></a>
                    @endif

                    @if (session('farmasi')->jenis < 4)
                        <a class="btn btn-rounded btn-secondary mr-5" href="{{url('farmasi/'.session('farmasi')->slug.'/paket-obat')}}"><span><i class="fa fa-fw fa-pills mr-5"></i> Paket Obat</span></a>
                        <button type="button" class="btn btn-rounded btn-secondary" data-toggle="modal" data-target="#modal-shift">
                            Shift saat ini: {{session('farmasi')->current_shift->nama ?? '-'}}
                        </button>
                    @endif
                </div>
                <div class="dropdown">
                    <button type="button" class="btn-block-option" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/dashboard')}}"><i class="fa fa-fw fa-home mr-5"></i> Dashboard</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/transaksi')}}"><i class="fa fa-fw fa-money mr-5"></i> Transaksi</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/distribusi')}}"><i class="fa fa-fw fa-code-fork mr-5"></i> Distribusi</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/pengadaan')}}"><i class="fa fa-fw fa-truck mr-5"></i> Pembelian</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/penghapusan')}}"><i class="fa fa-fw fa-trash mr-5"></i> Penghapusan</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/item')}}"><i class="fa fa-fw fa-cube mr-5"></i>Stok</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/item-exp')}}"><i class="fa fa-fw fa-cube mr-5"></i>Stok Expired</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/item-stok')}}"><i class="fa fa-fw fa-cube mr-5"></i>Stok Kosong</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/stokopname')}}"><i class="fa fa-fw fa-calendar-check mr-5"></i> Stok Opname</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv')}}"><i class="fa fa-fw fa-tv mr-5"></i> Screen TV</a>
                        <a class="dropdown-item mobile-block" href="{{url('farmasi/'.session('farmasi')->slug.'/laporan')}}"><i class="fa fa-fw fa-files-o mr-5"></i> Laporan</a>


                        <a class="dropdown-item full-only" href="{{url('farmasi')}}">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Kembali Ke Halaman Awal
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item full-only" id="pengaturan">
                            <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Pengaturan
                        </a>
                        <a class="dropdown-item full-only" href="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv/pengaturan')}}">
                            <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Pengaturan Layar Antrian
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar-content full-only">

            <div class="content-side content-side-full pt-10"  style="overflow: visible;">
                <ul class="nav-main-header">
                    <li>
                        <a @if($sidebar_active == 'dashboard') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/dashboard')}}"><span><i class="fa fa-fw fa-home mr-5"></i> Dashboard</span></a>
                    </li>
                    <li>
                    @if (session('farmasi')->jenis < 4)
                        <a @if($sidebar_active == 'transaksi') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/transaksi')}}"><span><i class="fa fa-fw fa-money mr-5"></i> Transaksi</span></a>
                    @else
                        <a @if($sidebar_active == 'pengadaan') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/pengadaan')}}"><span><i class="fa fa-fw fa-money mr-5"></i> Penerimaan</span></a>
                    @endif
                    </li>
                    <li>
                        <a @if($sidebar_active == 'distribusi') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/distribusi')}}"><span><i class="fa fa-fw fa-code-fork mr-5"></i> Distribusi</span></a>
                    </li>
                    @if (session('farmasi')->jenis < 4)
                    <li>
                        <a @if($sidebar_active == 'pengadaan') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/pengadaan')}}"><span><i class="fa fa-fw fa-truck mr-5"></i> Pembelian</span></a>
                    </li>
                    @endif
                    <li>
                        <a @if($sidebar_active == 'penghapusan') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/penghapusan')}}"><span><i class="fa fa-fw fa-trash mr-5"></i> Penghapusan</span></a>
                    </li>
                    <li>
                        <a @if($sidebar_active == 'item') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/item')}}"><span><i class="fa fa-fw fa-cube mr-5"></i> Barang</span></a>
                    </li>
                    {{-- <li>
                        <div class="btn-group" role="group">
                            <a class="btn btn-square dropdown-toggle @if($sidebar_active == 'item') active @endif" id="page-header-options-dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span><i class="fa fa-fw fa-cube mr-5"></i> Barang</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="page-header-options-dropdown2">
                                <a href="{{url('farmasi/'.session('farmasi')->slug.'/item')}}" class="dropdown-item">
                                    <i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;Stok
                                </a>
                                <a href="{{url('farmasi/'.session('farmasi')->slug.'/item-exp')}}" class="dropdown-item">
                                    <i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;Stok Expired
                                </a>
                                <a href="{{url('farmasi/'.session('farmasi')->slug.'/item-stok')}}" class="dropdown-item">
                                    <i class="fa fa-cube" aria-hidden="true"></i>&nbsp;&nbsp;Stok Kosong
                                </a>
                            </div>
                        </div>
                    </li> --}}
                    <li>
                        <a @if($sidebar_active == 'stokopname') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/stokopname')}}"><span><i class="fa fa-fw fa-calendar-check mr-5"></i> Stok Opname</span></a>
                    </li>
                    @if (session('farmasi')->jenis == 4)
                    <li>
                        <a @if($sidebar_active == 'laporan') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/laporan')}}"><span><i class="fa fa-fw fa-files-o mr-5"></i> Laporan</span></a>
                    </li>
                    @else
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-square dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Lainnya</button>
                            <div class="dropdown-menu" aria-labelledby="btn_dropdown_kasus">
                                <a @if($sidebar_active == 'laporan') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/laporan')}}"><span><i class="fa fa-fw fa-files-o mr-5"></i> Laporan</span></a>
                                <a @if($sidebar_active == 'screen') class="active" @endif href="{{url('farmasi/'.session('farmasi')->slug.'/screen-tv')}}"><span><i class="fa fa-fw fa-tv mr-5"></i> Layar Antrian</span></a>
                            </div>
                        </div>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>

@include('farmasi.layouts.components.modal-setting')
@include('farmasi.layouts.components.modal-shift')