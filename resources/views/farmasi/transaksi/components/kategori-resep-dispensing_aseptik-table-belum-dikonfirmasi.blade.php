<div class="table-responsive" style="max-height: calc(100vh - 100px);">
<input type="hidden" name="kategori_resep_dispensing_aseptik[resep_ori_id]" value="{{ $transaksi->ori_detail->id }}">
<table class="table table-bordered table-vcenter table-main table-sticky-header" data-last_index="{{ $transaksi->ori_detail->resep_detail->count() - 1 }}">
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
            <th rowspan="2" style="border-bottom: 1px solid;">BUD</th>
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
                $item_final = $transaksi->final_detail->resep_detail->where('resep_detail_ori_id', $item->id)->first();
                if ($item_final == null) {
                    $item_final = $transaksi->final_detail->resep_detail[$key] ?? null;
                }
                if ($item_final != null) {
                    $racikan_obat_permintaan_final = $item_final->racikan[0] ?? null;
                    $racikan_obat_pelarut_final = $item_final->racikan[1] ?? null;
                }
            @endphp
            <tr class="hh-parent" data-index="{{ $loop->index }}">
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $racikan_obat_permintaan->obat_detail->item_detail->nama }}
                    <input type="hidden" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][resep_detail_id]"
                        value="{{ $item->id }}">
                    <input type="hidden" class="hh-obat_permintaan" value="{{ $racikan_obat_permintaan->obat_detail->id }}">
                    <input type="hidden" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][embalase]" class="hh-embalase">
                    <input type="hidden" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][laba]" class="hh-laba">
                    <input type="hidden" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][subtotal_obat_permintaan]"
                        class="hh-input-subtotal_obat_permintaan">
                    <input type="hidden" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][subtotal_obat_pelarut]"
                        class="hh-input-subtotal_obat_pelarut">
                </td>
                <td>{{ $racikan_obat_permintaan->dispensing_aseptik_dosis_yang_dibutuhkan }}</td>

                <td>{{ $racikan_obat_permintaan->dispensing_aseptik_dosis }}</td>
                <td><input type="text" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][dilayani]"
                        value="{{ $racikan_obat_permintaan_final->dosis }}" class="form-control" required></td>
                <td><input type="number" min="0" step="0.01"
                        name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][jumlah]"
                        value="{{ $racikan_obat_permintaan_final->jumlah }}" class="form-control hh-jumlah_permintaan" required></td>
                <td>{{ $racikan_obat_permintaan->obat_detail->item_detail->satuan }}</td>

                <td>
                    {{ $racikan_obat_pelarut->obat_detail->item_detail->nama }}
                    <input type="hidden" class="hh-obat_pelarut" value="{{ $racikan_obat_pelarut->obat_detail->id }}">
                </td>
                <td></td>
                <td><input type="text" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][pelarut_dilayani]"
                        value="{{ $racikan_obat_pelarut_final->dosis }}" class="form-control" required></td>
                <td><input type="number" min="0" step="0.01"
                        name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][pelarut_jumlah]"
                        value="{{ $racikan_obat_pelarut_final->jumlah }}" class="form-control hh-jumlah_pelarut" required></td>
                <td>{{ $racikan_obat_pelarut->obat_detail->item_detail->satuan }}</td>

                <td>{{ $item->nama_obat }}</td>
                <td>
                    {{ $item->jumlah }}
                    <input type="hidden" class="hh-jumlah" value="{{ $item->jumlah }}">
                </td>
                <td>{{ $item->aturan }}</td>
                <td><input type="text" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $loop->index }}][bud]" style="width: 100px"
                        value="{{ $item_final->dispensing_aseptik_bud }}" class="form-control"></td>
                <td>{{ $item->dispensing_aseptik_catatan }}</td>
                <td class="hh-subtotal_obat_permintaan"></td>
                <td class="hh-subtotal_obat_pelarut"></td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="table-secondary">
            <th colspan="17" class="text-center">Total</th>
            <th class="header-total_obat_permintaan"></th>
            <th class="header-total_obat_pelarut"></th>
        </tr>
        <tr class="table-secondary">
            <th colspan="18" class="text-center">Total 2</th>
            <th class="header-total_obat"></th>
        </tr>
        <tr class="table-secondary">
            <th colspan="18" class="text-center">Embalase Jasa Penyiapan Sediaan Dispensing Aseptik</th>
            <th class="header-embalase"></th>
        </tr>
        <tr class="table-secondary">
            <th colspan="18" class="text-center">Total Akhir</th>
            <th class="header-total"></th>
        </tr>
    </tfoot>
</table>
</div>