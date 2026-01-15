<div class="row">
    <div class="col-12">
        @if (!empty($transaksi->final_detail->konfirmasi_permintaan_at) || count($transaksi->copy_resep) != 0)
            @include('farmasi.transaksi.components.kategori-resep-default-table-sudah-dikonfirmasi')
        @else
            @include('farmasi.transaksi.components.kategori-resep-default-table-belum-dikonfirmasi')
        @endif
    </div>
</div>
