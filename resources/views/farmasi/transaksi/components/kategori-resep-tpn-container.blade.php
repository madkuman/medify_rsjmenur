@php
    $is_edit_permintaan = request()->edit_permintaan ?? 0;
    $resep_detail = $transaksi->ori_detail->resep_detail[0] ?? null;
    $resep_detail_final = $transaksi->final_detail->resep_detail[0];
    if ($resep_detail == null) {
        $resep_detail = $resep_detail_final;
    }
@endphp
<div class="px-3">
    <div class="row">
        <div class="col-md-6">
            <table class="table-vcenter" cellpadding="5px" style="width: 100%">
                <tr>
                    <th width="200px">Kategori</th>
                    <td width="1">:</td>
                    <td>{{ $resep_detail->nama_obat }}</td>
                </tr>
                <tr>
                    <th>Alergi Obat</th>
                    <td>:</td>
                    <td>{{ $resep_detail->tpn_alergi }}</td>
                </tr>
                <tr>
                    <th>BB</th>
                    <td>:</td>
                    <td>{{ $resep_detail->tpn_berat_badan }}</td>
                </tr>
                <tr>
                    <th>Diagnosis</th>
                    <td>:</td>
                    <td>{{ $resep_detail->tpn_diagnosis }}</td>
                </tr>
                <tr>
                    <th>Jumlah TPN</th>
                    <td>:</td>
                    <td>{{ $resep_detail->tpn_jumlah_tpn }}</td>
                </tr>
                <tr>
                    <th>Kemasan</th>
                    <td>:</td>
                    <td>{{ $resep_detail->tpn_kemasan }}</td>
                </tr>
                <tr>
                    <th>Rute Pemberian</th>
                    <td>:</td>
                    <td>{{ $resep_detail->tpn_rute_pemberian }}</td>
                </tr>
                <tr>
                    <th>Aturan Penggunaan</th>
                    <td>:</td>
                    <td>{{ $resep_detail->tpn_aturan_penggunaan }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th>Nama Obat</th>
                        <th>Dosis yang diperlukan (mL)</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resep_detail->racikan as $item)
                        <tr>
                            <td>{{ $item->nama_obat }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td>{{ $item->tpn_catatan }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-secondary">
                        <th>Volume Total</th>
                        <th class="text-center">{{ $resep_detail->racikan->sum('jumlah') }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    @if (!empty($transaksi->final_detail->konfirmasi_permintaan_at))
        @include('farmasi.transaksi.components.kategori-resep-tpn-table-sudah-dikonfirmasi')
    @else
        @include('farmasi.transaksi.components.kategori-resep-tpn-table-belum-dikonfirmasi')
    @endif
</div>
