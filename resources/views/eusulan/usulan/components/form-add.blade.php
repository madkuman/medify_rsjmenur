<tr class="item-row item-wrapper">

    <td class="headcol">
        <div class="form-group">
            <h1 id="harga-hid-{{$index}}" hidden></h1>
            <select class="js-select2 form-control akun-rekening-select" id="akun-rekening-select2-{{$index}}" name="akun_rekening[]" required
                    style="width: 100%;" data-placeolder="Cari Barang" onchange="changeBarang({{$index}})">
                <option value="{{$row->akun_rekening_id ?? ''}}" @if(isset($row->akun_rekening_id) && !empty($row->akun_rekening_id)) selected @endif>{{isset($row->akun_rekening_id) && !empty($row->akun_rekening_id) ? $row->akun_rekening->kode.' - '.$row->akun_rekening->nama : ''}}</option>
            </select>
        </div>
    </td>
    <td class="headcol-1">
        <div class="form-group">
            <h1 id="harga-hid-{{$index}}" hidden></h1>
            <select class="js-select2 form-control barang-select" id="barang-select2-{{$index}}" name="barang[]" required
                    style="width: 100%;" data-placeolder="Cari Barang">
                <option value="{{$row->barang_id ?? ''}}" @if(isset($row->barang_id) && !empty($row->barang_id)) selected @endif>{{isset($row->barang_id) && !empty($row->barang_id) ? $row->barang->kode.' - '.$row->barang->nama : ''}}</option>
            </select>
        </div>
    </td>
    <td align="center" style="vertical-align: middle">
        <div class="form-group">
            <label class="css-control-primary css-checkbox">
                <input type="checkbox" class="checkbox-important" style="width: 40px !important;height: 40px;" id="penting-{{$index}}" name="penting[{{(int)$index - 1}}]" @if(isset($row->penting) && $row->penting) checked @endif>
                <span class="css-control-indicator"></span>
            </label>
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" class="form-control" id="kegiatan-{{$index}}"
                   name="kegiatan[]" placeholder="Kegiatan" value="{{$row->kegiatan ?? ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="number" class="form-control" id="jumlah-{{$index}}" required
                   onchange="changeSubtotal({{$index}})" name="jumlah[]" placeholder="Jumlah"
                   autocomplete="off" value="{{$row->jumlah ?? ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" class="form-control" id="satuan-{{$index}}" required
                   name="satuan[]" placeholder="Satuan" value="{{$row->satuan ?? ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="number" class="form-control" id="harga-{{$index}}" name="harga[]" required
                   placeholder="Harga Satuan" onchange="changeSubtotal({{$index}})" value="{{$row->harga ?? ''}}"
            >
        </div>
    </td>
    <td>
        <div class="form-group subtotal-group">
            <input type="text" class="form-control subtotal" id="subtotal-{{$index}}" name="subtotal[]"
                   placeholder="Subtotal" readonly="" value="{{isset($row) && !empty($row->jumlah) && !empty($row->harga) ? $row->jumlah * $row->harga : ''}}">
            <input type="hidden" name="log_id[]" value="{{$row->id ?? 0}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" class="form-control" id="link-{{$index}}"
                   name="link[]" placeholder="Link 1" value="{{$row->link ?? ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" class="form-control" id="link-{{$index}}"
                   name="link2[]" placeholder="Link 2" value="{{$row->link ?? ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" class="form-control" id="link-{{$index}}"
                   name="link3[]" placeholder="Link 3" value="{{$row->link ?? ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" class="form-control" id="spesifikasi-{{$index}}"
                   name="spesifikasi[]" placeholder="Spesifikasi Barang" value="{{$row->spesifikasi ?? ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input type="text" class="form-control" id="justifikasi-{{$index}}"
                   name="justifikasi[]" placeholder="Justifikasi" value="{{$row->justifikasi ?? ''}}">
        </div>
    </td>
    <td>
        @if(isset($row->dokumen_id) && !empty($row->dokumen_id))
            <div class="form-group" id="block-edit-log-usulan-file-{{$index}}">
                <a href="javascript:void(0)" class="btn btn-primary" onclick="popupwindow('{{url('').'/'.$row->dokumen->path}}')">Lihat</a>
                <input type="hidden" name="log_usulan_file_exclude[{{$index}}]" id="input-log-usulan-file-{{$index}}" value="">
                <button type="button" class="btn btn-alt-danger" onclick="deleteLogUsulanFile({{$index}},{{$row->dokumen_id}})">
                    Hapus
                </button>
            </div>
            <div class="form-group d-none" id="block-create-log-usulan-file-{{$index}}">
                <div class="custom-file">
                    <input class="custom-file-input" type="file" id="file-{{$index}}" name="log_usulan_file[]" accept=".pdf"/>
                    <label class="custom-file-label">Pilih file..</label>
                </div>
            </div>
        @else
            <div class="form-group">
                <div class="custom-file">
                    <input class="custom-file-input" type="file" id="file-{{$index}}" name="log_usulan_file[]" accept=".pdf"/>
                    <label class="custom-file-label">Pilih file..</label>
                </div>
            </div>
        @endif
    </td>
    <td>
        <div class="form-group">
            <button type="button" class="btn btn-lg btn-circle btn-outline-danger btnRemove">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </td>
</tr>