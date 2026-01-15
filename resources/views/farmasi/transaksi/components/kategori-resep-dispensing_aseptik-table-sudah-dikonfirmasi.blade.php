<div class="table-responsive" style="max-height: calc(100vh - 100px);">
<table class="table table-bordered table-vcenter table-sticky-header" data-last_index="{{ $transaksi->ori_detail->resep_detail->count() - 1 }}">
    <thead>
        <tr>
            <th rowspan="2" style="border-bottom: 1px solid">No</th>
            <th rowspan="2" style="border-bottom: 1px solid">Permintaan Obat</th>
            <th rowspan="2" style="border-bottom: 1px solid">Dosis yang dibutuhkan</th>
            <th colspan="4">Dosis</th>
            <th rowspan="2" style="border-bottom: 1px solid">Nama Pelarut</th>
            <th colspan="4">Dosis (mL)</th>
            <th rowspan="2" style="border-bottom: 1px solid">Nama IV Admx.</th>
            <th rowspan="2" style="border-bottom: 1px solid">Volume Akhir Campuran (mL)</th>
            <th rowspan="2" style="border-bottom: 1px solid">Aturan Pakai</th>
            <th rowspan="2" style="border-bottom: 1px solid">BUD</th>
            <th rowspan="2" style="border-bottom: 1px solid">Catatan</th>
            <th rowspan="2" style="border-bottom: 1px solid">Harga Obat</th>
            <th rowspan="2" style="border-bottom: 1px solid">Harga Pelarut</th>
        </tr>
        <tr>
            <th style="border-bottom: 1px solid">Diminta</th>
            <th style="border-bottom: 1px solid">Dilayani</th>
            <th style="border-bottom: 1px solid">Jumlah</th>
            <th style="border-bottom: 1px solid">Satuan</th>
            <th style="border-bottom: 1px solid">Diminta</th>
            <th style="border-bottom: 1px solid">Dilayani</th>
            <th style="border-bottom: 1px solid">Jumlah</th>
            <th style="border-bottom: 1px solid">Satuan</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_obat_permintaan = 0;
            $total_obat_pelarut = 0;
            $total_embalase = 0;
        @endphp
        @php
            $list_resep_detail = $transaksi->ori_detail->resep_detail;
            # sometimes ori gk punya detail, aneh gaming
            if ($list_resep_detail->count() == 0) {
                if (isset($transaksi->final_detail)) {
                    $list_resep_detail = $transaksi->final_detail->resep_detail;
                }
            }
        @endphp
        @foreach ($list_resep_detail as $key => $item)
            @php
                $racikan_obat_permintaan = $item->racikan->where('dispensing_aseptik_jenis_racikan', 'obat_permintaan')->first();
                $racikan_obat_pelarut = $item->racikan->where('dispensing_aseptik_jenis_racikan', 'obat_pelarut')->first();
                $item_final = $transaksi->final_detail->resep_detail[$key] ?? null;
                if ($item_final != null) {
                    $racikan_obat_permintaan_final = $item_final->racikan[0] ?? null;
                    $racikan_obat_pelarut_final = $item_final->racikan[1] ?? null;
                }
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $racikan_obat_permintaan->obat_detail->item_detail->nama }}
                </td>
                <td>{{ $racikan_obat_permintaan->dispensing_aseptik_dosis_yang_dibutuhkan }}</td>

                <td>{{ $racikan_obat_permintaan->dispensing_aseptik_dosis }}</td>
                <td>{{ $racikan_obat_permintaan_final->dosis }}</td>
                <td>{{ $racikan_obat_permintaan_final->jumlah }}</td>
                <td>{{ $racikan_obat_permintaan->obat_detail->item_detail->satuan }}</td>

                <td>
                    {{ $racikan_obat_pelarut->obat_detail->item_detail->nama }}
                </td>
                <td></td>
                <td>{{ $racikan_obat_pelarut_final->dosis }}</td>
                <td>{{ $racikan_obat_pelarut_final->jumlah }}</td>
                <td>{{ $racikan_obat_pelarut->obat_detail->item_detail->satuan }}</td>
                <td>{{ $item->nama_obat }}</td>
                <td>
                    {{ $item->jumlah }}
                </td>
                <td>{{ $item->aturan }}</td>
                <td>{{ $item_final->dispensing_aseptik_bud }}</td>
                <td>{{ $item->dispensing_aseptik_catatan }}</td>
                <td>{{ $racikan_obat_permintaan_final->subtotal }}</td>
                <td>{{ $racikan_obat_pelarut_final->subtotal }}</td>
            </tr>
            @php
                $total_obat_permintaan += $racikan_obat_permintaan_final->subtotal;
                $total_obat_pelarut += $racikan_obat_pelarut_final->subtotal;
                $total_embalase += $item_final->embalase;
            @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr class="table-secondary">
            <th colspan="17" class="text-center">Total</th>
            <th>{{ formatCurrency($total_obat_permintaan, '') }}</th>
            <th>{{ formatCurrency($total_obat_pelarut, '') }}</th>
        </tr>
        <tr class="table-secondary">
            <th colspan="18" class="text-center">Total 2</th>
            <th>{{ formatCurrency($total_obat_pelarut + $total_obat_permintaan, '') }}</th>
        </tr>
        <tr class="table-secondary">
            <th colspan="18" class="text-center">Embalase Jasa Penyiapan Sediaan Dispensing Aseptik</th>
            <th>{{ formatCurrency($total_embalase, '') }}</th>
        </tr>
        <tr class="table-secondary">
            <th colspan="18" class="text-center">Total Akhir</th>
            <th>{{ formatCurrency($total_obat_permintaan + $total_obat_pelarut + $total_embalase, '') }}</th>
        </tr>
    </tfoot>
</table>
</div>