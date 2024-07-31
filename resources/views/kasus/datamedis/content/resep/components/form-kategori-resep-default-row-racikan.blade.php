<tr class="hh-parent-{{ $index }}" data-racikan_index="{{ $racikan_index }}">
    <td></td>
    <td>

    </td>
    <td>
        <select name="kategori_resep_default[daftar_obat][{{ $index }}][racikan][{{ $racikan_index }}][item_farmasi_id]"
            class="form-control select2-select-obat hh-racikan-obat has-required" style="width: 100%;max-width: 100%"></select>
    </td>
    <td><input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][racikan][{{ $racikan_index }}][dosis]" min="0" step="0.01" class="form-control hh-racikan-dosis has-required"></td>
    <td class="only-bpjs"><input type="text" readonly class="form-control hh-racikan-restriksi"></td>
    <td><input type="text" readonly class="form-control hh-racikan-kekuatan"></td>
    <td><input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][racikan][{{ $racikan_index }}][jumlah]" min="0" step="0.01" readonly class="form-control hh-racikan-jumlah has-required"></td>
    <td></td>
    <td></td>
    <td><input type="text" readonly class="form-control hh-racikan-subtotal"></td>
    <td style="padding-top: 15px"><button type="button" class="btn btn-sm btn-danger btn-delete-row"><i class="fas fa-trash"></i></button></td>
</tr>