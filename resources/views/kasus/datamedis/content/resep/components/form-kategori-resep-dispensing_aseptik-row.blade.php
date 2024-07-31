<tr class="hh-parent" data-index="{{ $index }}">
    <td class="table-number">1</td>
    <td>
        <select name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $index }}][obat]" class="form-control select2-select-obat hh-obat_permintaan has-required" style="width: 100%;max-width: 100%"></select>
    </td>
    <td><input type="text" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $index }}][dosis_yang_dibutuhkan]" class="form-control"></td>
    <td><input type="text" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $index }}][dosis]" class="form-control hh-jumlah_permintaan has-required"></td>
    <td>
        <select name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $index }}][obat_pelarut]" class="form-control select2-select-obat hh-obat_pelarut has-required" style="width: 100%;max-width: 100%"></select>
    </td>
    <td>
        <textarea name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $index }}][nama_obat]" class="form-control kategori-racikan has-required" rows="1"></textarea>
    </td>
    <td><input type="number" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $index }}][jumlah]" min="0" step="0.01" class="form-control hh-jumlah has-required"></td>
    <td>
        <input type="text" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $index }}][aturan_penggunaan]" class="form-control">
    </td>
    <td>
        <input type="text" name="kategori_resep_dispensing_aseptik[daftar_obat][{{ $index }}][catatan]" class="form-control">
    </td>
    <td><button type="button" class="btn btn-sm btn-danger btn-delete-row"><i class="fas fa-trash"></i></button></td>
</tr>