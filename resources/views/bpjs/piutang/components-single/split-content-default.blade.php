<div class="row mb-20">
    @if(!empty($piutang->pasien_id))
    <div class="col-3">
        <label>Jenis Pembayaran <i class="fa fa-spin fa-spinner text-primary" style="display: none" id="pasien_pembayaran_loading"></i></label>
        <select class="form-control split-pasien-pembayaran" id="pasien-pembayaran" name="pasien_pembayaran_id[]" style="width: 100%;" data-placeholder="Pilih Jenis Pembayaran">
            <option value="0" data-perusahaan-id="0">Tanpa Referensi Pembayaran</option>
            @foreach($pembayaran as $item)
                <option value="{{$item->id}}" data-perusahaan-id="{{$item->perusahaan->perusahaan_keuangan_id}}">{{$item->perusahaan->nama}}</option>
            @endforeach
        </select>
    </div>
    @endif
    <div class="col-3">
        <label>Perusahaan</label>
        <select class="js-select2 form-control split-perusahaan" data-id="1" name="perusahaan[]" style="width: 100%">
            @foreach($perusahaan as $item)
            <option value="{{$item->id}}">{{$item->nama}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <label>PJ Pembayaran</label>
        <input type="text" class="form-control split-pihak-ketiga" name="pihak_ketiga[]">
    </div>
    <div class="col-2">
        <label>Total</label>
        <input type="text" class="form-control split-total" name="total[]">
        <small class="text-invalid text-danger hide">Tidak Bisa Bernilai Kosong</small>
    </div>
    <div class="col-2">
        <label>Delete</label><br>
        <button class="btn btn-circle btn-outline-danger split-remove-button" type="button"><i class="fa fa-trash"></i></button>
    </div>
</div>