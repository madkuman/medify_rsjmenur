<tr class="hh-parent" data-index="{{ $index }}"
    data-last_racikan_index={{ !empty($item_final->racikan) ? count($item_final->racikan) : 0 }}>
    <td>{{ $loop->iteration }}</td>
    <td>
        <b>{{ $item->tipe ? 'Racikan: ' : '' }}</b>
        {{ $item->nama_obat }}
    </td>
    <td style="background-color: #CAEDFF">
        @if ($item->tipe)
            <select name="kategori_resep_default[daftar_obat][{{ $index }}][tipe_racikan_id]"
                class="form-control has-required hh-tipe-racikan" style="width: 100%;max-width: 100%;">
                @foreach (getTipeRacikan(1) as $slug => $item_kategori_resep)
                    <option value="{{ $item_kategori_resep->id }}"
                        {{ $item_kategori_resep->id == ($item_final->tipe_racikan_id ?? $item->tipe_racikan_id) ? 'selected' : '' }}>
                        {{ $item_kategori_resep->nama }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-sm btn-block btn-primary btn-tambah-detail-racikan mt-3">Tambah Detail
                Racikan</button>
        @else
            <select name="kategori_resep_default[daftar_obat][{{ $index }}][item_farmasi_id]"
                class="form-control select2-select-obat hh-obat has-required" style="width: 100%;max-width: 100%">
                @if (isset($item_final))
                    <option value="{{ $item_final->obat_detail->id }}">{{ $item_final->nama_obat }}</option>
                @endif
            </select>
        @endif
        <input type="hidden" class="select-kategori" value="{{ $item->tipe ? 'racikan' : 'generik' }}">
        <input type="hidden" name="kategori_resep_default[daftar_obat][{{ $index }}][resep_detail_id]"
            value="{{ $item->id }}">
        <input type="hidden" name="kategori_resep_default[daftar_obat][{{ $index }}][harga]"
            class="hh-input-harga">
        <input type="hidden" name="kategori_resep_default[daftar_obat][{{ $index }}][embalase]"
            class="hh-embalase">
        <input type="hidden" name="kategori_resep_default[daftar_obat][{{ $index }}][laba]" class="hh-laba">
        <input type="hidden" name="kategori_resep_default[daftar_obat][{{ $index }}][subtotal]"
            class="hh-input-subtotal">
    </td>
    <td>{{ $item->jumlah }}</td>
    <td style="background-color: #CAEDFF">
        @if ($transaksi->attr_is_harian)
            <div class="input-group" style="width: 300px">
                <input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][jumlah]"
                    min="0" step="0.01" value="{{ $item_final->jumlah }}"
                    class="form-control hh-jumlah hh-calc-harian">
                <input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][hari7]"
                    min="0" step="0.01"
                    value="{{ isset($item_final->hari7) ? $item_final->hari7 : $item_final->jumlah }}"
                    class="form-control hh-hari7 hh-calc-harian has-required">
                <input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][hari23]"
                    min="0" step="0.01" value="{{ isset($item_final->hari23) ? $item_final->hari23 : 0 }}"
                    class="form-control hh-hari23 hh-calc-harian has-required">
                <input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][dukunganrs]"
                    min="0" step="0.01"
                    value="{{ isset($item_final->dukunganrs) ? $item_final->dukunganrs : 0 }}"
                    class="form-control hh-dukunganrs hh-calc-harian has-required">
            </div>
        @else
            <input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][jumlah]"
                min="0" step="0.01" value="{{ $item_final->jumlah }}"
                class="form-control hh-jumlah has-required">
        @endif
    </td>
    <td>{{ $item->aturan }}</td>
    <td style="background-color: #CAEDFF"><input type="text"
            name="kategori_resep_default[daftar_obat][{{ $index }}][aturan]" value="{{ $item->aturan }}"
            class="form-control"></td>
    <td style="background-color: #CAEDFF"><input style="min-width:55px" type="number"
            name="kategori_resep_default[daftar_obat][{{ $index }}][aturan_per_jam][1]"
            value="{{ !empty($item_final) ? $item_final->aturan_per_jam_1 : '' }}" step="0.01" min="0"
            class="form-control hh-aturan-per-jam" data-jam="1" style="width: 75px;"></td>
    <td style="background-color: #CAEDFF"><input style="min-width:55px" type="number"
            name="kategori_resep_default[daftar_obat][{{ $index }}][aturan_per_jam][2]"
            value="{{ !empty($item_final) ? $item_final->aturan_per_jam_2 : '' }}" step="0.01" min="0"
            class="form-control hh-aturan-per-jam" data-jam="2" style="width: 75px;"></td>
    <td style="background-color: #CAEDFF"><input style="min-width:55px" type="number"
            name="kategori_resep_default[daftar_obat][{{ $index }}][aturan_per_jam][3]"
            value="{{ !empty($item_final) ? $item_final->aturan_per_jam_3 : '' }}" step="0.01" min="0"
            class="form-control hh-aturan-per-jam" data-jam="3" style="width: 75px;"></td>
    <td style="background-color: #CAEDFF"><input style="min-width:55px" type="number"
            name="kategori_resep_default[daftar_obat][{{ $index }}][aturan_per_jam][4]"
            value="{{ !empty($item_final) ? $item_final->aturan_per_jam_4 : '' }}" step="0.01" min="0"
            class="form-control hh-aturan-per-jam" data-jam="4" style="width: 75px;"></td>
    <td style="background-color: #CAEDFF"><input style="min-width:55px" type="number"
            name="kategori_resep_default[daftar_obat][{{ $index }}][aturan_per_jam][5]"
            value="{{ !empty($item_final) ? $item_final->aturan_per_jam_5 : '' }}" step="0.01" min="0"
            class="form-control hh-aturan-per-jam" data-jam="5" style="width: 75px;"></td>
    <td style="background-color: #CAEDFF"><input type="text"
            name="kategori_resep_default[daftar_obat][{{ $index }}][petunjuk_minum]"
            value="{{ $item_final->default_petunjuk_minum }}" class="form-control"></td>
    <td style="background-color: #CAEDFF"><input type="text"
            name="kategori_resep_default[daftar_obat][{{ $index }}][catatan]"
            value="{{ $item_final->default_catatan }}" class="form-control"></td>
    <td class="hh-harga"></td>
    <td class="hh-subtotal"></td>
</tr>
@if ($item->tipe)
    @foreach ($item_final->racikan ?? ($item->racikan ?? []) as $item_racikan)
        @include(
            'farmasi.transaksi.components.kategori-resep-default-table-belum-dikonfirmasi-row-racikan',
            ['index' => $index, 'racikan_index' => $loop->index, 'item_racikan' => $item_racikan]
        )
    @endforeach
@endif
