<tr class="hh-parent" data-index="{{ $index }}">
    <td class="table-number" style="padding-top: 17.5px">1</td>
    <td>
        <select name="kategori_resep_default[daftar_obat][{{ $index }}][kategori]" class="form-control js-select select-kategori">
            <option value="generik" selected>Generik</option>
            <option value="racikan">Racikan</option>
        </select>
    </td>
    <td>
        <div class="kategori-generik">
            <select name="kategori_resep_default[daftar_obat][{{ $index }}][item_farmasi_id]" class="form-control select2-select-obat hh-obat has-required" style="width: 100%;max-width: 100%"></select>
        </div>
        <div class="kategori-racikan" style="display: none">
            <textarea name="kategori_resep_default[daftar_obat][{{ $index }}][nama_obat]" class="form-control has-required" rows="1"></textarea>
            <button type="button" class="btn btn-sm btn-outline-primary btn-add-racikan mt-2" data-last_index_racikan="0">Tambah Detail Obat</button>
        </div>
    </td>
    <td>
        <div class="kategori-generik">
            <input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][dosis]" min="0" step="0.01" class="form-control hh-dosis has-required">
        </div>
    </td>
    <td class="only-bpjs">
        <div class="kategori-generik">
            <input type="text" readonly class="form-control hh-restriksi">
        </div>
    </td>
    <td>
        <div class="kategori-generik">
            <input type="text" readonly class="form-control hh-kekuatan">
        </div>
    </td>
    <td><input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][jumlah]" min="0" step="0.01" class="form-control hh-jumlah has-required"></td>
    <td>
        <div class="kategori-generik">
            <input type="text" readonly class="form-control hh-satuan">
        </div>
        <div class="kategori-racikan" style="display: none">
            <select name="kategori_resep_default[daftar_obat][{{ $index }}][tipe_racikan_id]" class="form-control js-select hh-tipe-racikan">
                @foreach (getTipeRacikan(1) as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->nama }}</option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <input type="text" name="kategori_resep_default[daftar_obat][{{ $index }}][aturan_penggunaan]" class="form-control">
    </td>
    <td>
        <div class="kategori-generik">
            <input type="text" readonly class="form-control hh-subtotal">
        </div>
    </td>
    <td style="padding-top: 15px"><button type="button" class="btn btn-sm btn-danger btn-delete-row"><i class="fas fa-trash"></i></button></td>
</tr>