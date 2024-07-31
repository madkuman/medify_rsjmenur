<tr class="hh-parent-{{ $index }} hh-parent-{{ $index}}-{{ $racikan_index }}" data-racikan_index="{{ $racikan_index }}">
    <td></td>
    <td></td>
    <td style="background-color: #CAEDFF">
        <select name="kategori_resep_default[daftar_obat][{{ $index }}][racikan][{{ $racikan_index }}][item_farmasi_id]" class="form-control select2-select-obat hh-racikan-obat has-required" style="width: 100%;max-width: 100%">
            @if (isset($item_racikan))
                <option value="{{ $item_racikan->obat_detail->id }}">{{ $item_racikan->nama_obat }}</option>
            @endif
        </select>
    </td>
    <td></td>
    <td style="background-color: #CAEDFF"><input type="number" name="kategori_resep_default[daftar_obat][{{ $index }}][racikan][{{ $racikan_index }}][jumlah]" min="0" step="0.01" value="{{ $item_racikan->jumlah }}" class="form-control hh-racikan-jumlah has-required"></td>
    <td><button type="button" class="btn btn-sm btn-danger btn-delete-row"><i class="fas fa-trash"></i></button></td>
    <td style="background-color: #CAEDFF"></td>
    <td style="background-color: #CAEDFF"></td>
    <td style="background-color: #CAEDFF"></td>
    <td style="background-color: #CAEDFF"></td>
    <td style="background-color: #CAEDFF"></td>
    <td style="background-color: #CAEDFF"></td>
    <td style="background-color: #CAEDFF"></td>
    <td style="background-color: #CAEDFF"></td>
    <td></td>
    <td></td>
</tr>