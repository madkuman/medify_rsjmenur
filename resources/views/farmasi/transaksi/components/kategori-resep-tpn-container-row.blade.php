<tr class="hh-parent" data-index="{{ $index }}">
    <td class="table-number"></td>
    <td>
        <select name="kategori_resep_tpn[daftar_obat][{{ $index }}][item_farmasi_id]" class="form-control select2-select-obat hh-obat has-required" style="width: 100%;max-width: 100%">
            @if (isset($item))
                <option value="{{ $item->obat_detail->id }}">{{ $item->nama_obat }}</option>
            @endif
        </select>
        <input type="hidden" name="kategori_resep_tpn[daftar_obat][{{ $index }}][subtotal]" class="hh-hidden-subtotal">
    </td>
    <td><input type="number" name="kategori_resep_tpn[daftar_obat][{{ $index }}][dosis]" min="0" step="0.01" value="{{ $item->dosis }}" class="form-control hh-dosis has-required"></td>
    <td><input type="number" name="kategori_resep_tpn[daftar_obat][{{ $index }}][jumlah]" min="0" step="0.01" value="{{ $item->jumlah }}" class="form-control hh-jumlah has-required"></td>
    <td class="hh-kemasan">{{ $kemasan }}</td>
    <td class="hh-satuan"></td>
    <td class="hh-subtotal"></td>
    <td><button type="button" class="btn btn-sm btn-danger btn-delete-row"><i class="fas fa-trash"></i></button></td>
</tr>