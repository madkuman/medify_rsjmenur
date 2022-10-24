<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Laporan</h3>
    </div>
    <div class="block-content">
        <div class="row row-deck">
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Stok Sekarang</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan stok yang tersedia saat ini</p>
                    </div>
                    <div class="block-content block-content-full">
                        <a href="{{url()->current()}}/stok-sekarang" class="btn btn-hero btn-sm btn-noborder btn-secondary" target="_blank">
                            Buat Laporan
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Kegiatan Kesehatan</h3>
                    </div>
                    <div class="block-content">
                        <p>Rekap obat masuk/keluar, stok sekarang dan stok kadaluarsa dalam kurun waktu tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-kegiatan-kesehatan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Obat Keluar</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan distribusi obat yang keluar dalam rentang tanggal tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-distribusi-obat-keluar">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Rekapitulasi Per Kategori</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan rekapitulasi obat per kategori</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-narkotika">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Penerimaan</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan penerimaan obat dalam rentang waktu tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-penerimaan">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="block block-bordered text-center">
                    <div class="block-header">
                        <h3 class="block-title">Laporan Stok Opname</h3>
                    </div>
                    <div class="block-content">
                        <p>Laporan hasil stok opname dalam rentang waktu tertentu</p>
                    </div>
                    <div class="block-content block-content-full">
                        <button class="btn btn-hero btn-sm btn-noborder btn-secondary" data-toggle="modal" data-target="#modal-stok-opname">
                            Buat Laporan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('farmasi.laporan.modals.laporan-modals-gudang')

@section('js')
    @include('farmasi.laporan.components.laporan-js-gudang')
@endsection