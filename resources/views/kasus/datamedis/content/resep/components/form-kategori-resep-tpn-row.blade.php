<tr class="hh-parent" data-index="{{ $index }}">
    <td class="table-number">1</td>
    <td>
        <select name="kategori_resep_tpn[daftar_obat][{{ $index }}][item_farmasi_id]" class="form-control select2-select-obat hh-obat has-required" style="width: 100%;max-width: 100%"></select>
    </td>
    <td><input type="number" name="kategori_resep_tpn[daftar_obat][{{ $index }}][jumlah]" min="0" step="0.01" class="form-control hh-jumlah has-required"></td>
    <td><input type="text" name="kategori_resep_tpn[daftar_obat][{{ $index }}][catatan]" class="form-control"></td>
    <td><button type="button" class="btn btn-sm btn-danger btn-delete-row"><i class="fas fa-trash"></i></button></td>
</tr>