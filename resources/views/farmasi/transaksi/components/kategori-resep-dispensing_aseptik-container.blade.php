<div class="row">
    <div class="col-12">
        @if (!empty($transaksi->final_detail->konfirmasi_permintaan_at))
            @include('farmasi.transaksi.components.kategori-resep-dispensing_aseptik-table-sudah-dikonfirmasi')
        @else
            @include('farmasi.transaksi.components.kategori-resep-dispensing_aseptik-table-belum-dikonfirmasi')
        @endif
    </div>
</div>
