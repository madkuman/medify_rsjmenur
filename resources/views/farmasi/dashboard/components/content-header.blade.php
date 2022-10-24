<div class="pb-3">
    <div class="row gutters-tiny js-appear-enabled animated fadeIn" data-toggle="appear">
        <div class="col-lg-4 col-12">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    @if (session('farmasi')->jenis < 4)
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{$transaksi}}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Transaksi Hari Ini</div>
                    @else
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{$pengadaan}}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Penerimaan Hari Ini</div>
                    @endif
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-12">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    @if (session('farmasi')->jenis < 4)
                        <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="780" class="js-count-to-enabled">{{$distribusi}}</span></div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Distribusi Hari Ini</div>
                    @else
                        <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000" data-to="780" class="js-count-to-enabled">{{$distribusi}}</span></div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Permintaan Hari Ini</div>
                    @endif
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-12">
            <a class="block block-link-shadow text-right" href="javascript:void(0)">
                <div class="block-content block-content-full clearfix">
                    @if (session('farmasi')->jenis < 4)
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="15">{{$pengadaan}}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Pembelian Hari Ini</div>
                    @else
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="15">{{$item}}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Barang Baru</div>
                    @endif
                </div>
            </a>
        </div>
    </div>
</div>