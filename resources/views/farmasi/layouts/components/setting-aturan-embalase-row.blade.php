<tr>
    <td>
        <input type="hidden" name="embalase[{{ $index }}][id]" value="{{ $item->id }}">
        <select name="embalase[{{ $index }}][perusahaan_tipe_id]" id="" class="form-control js-select2"
            data-placeholder="Pilih Jenis Pembayaran" style="width: 100%">
            <option></option>
            @foreach (session('perusahaan_tipe') as $tipe)
                <option value="{{ $tipe->id }}" @if (($item->perusahaan_tipe_id ?? 0) == $tipe->id) selected="" @endif>
                    {{ $tipe->nama }}
                </option>
            @endforeach
            <option value="0" @if (($item->perusahaan_tipe_id ?? 0) == 0) selected="" @endif> Lainnya</option>
        </select>
    </td>
    <td>
        <select name="embalase[{{ $index }}][tipe_racikan_id]" id=""
            class="form-control js-select2 select-embalase-tipe_racikan_id" data-placeholder="Pilih Kategori" style="width: 100%">
            <option></option>
            <option value="0" @if (($item->tipe_racikan_id ?? 0) == 0) selected="" @endif> Semua</option>
            @foreach (getTipeRacikan() as $key => $value)
                <option value="{{ $value->id }}" {{ ($item->tipe_racikan_id ?? 0) == $value->id ? 'selected' : '' }}>{{ $value->nama }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select name="embalase[{{ $index }}][jenis_embalase]" id=""
            class="form-control js-select2 select-embalase-jenis_embalase" data-placeholder="Pilih Kategori" style="width: 100%">
            <option value="per-obat" {{ ($item->jenis_embalase ?? 'per-obat') == 'per-obat' ? 'selected' : '' }}>Per Obat</option>
            <option value="per-jumlah-obat" {{ ($item->jenis_embalase ?? 'per-obat') == 'per-jumlah-obat' ? 'selected' : '' }}>Per Jumlah Obat</option>
        </select>
    </td>
    <td>
        <input type="number" name="embalase[{{ $index }}][harga]" class="form-control" placeholder="Harga"
            min="0" value="{{ isset($item->harga) ? round($item->harga) : '' }}">
    </td>
    <td>
        <button type="button" class="btn btn-lg btn-circle btn-outline-danger btn-remove-embalase">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>