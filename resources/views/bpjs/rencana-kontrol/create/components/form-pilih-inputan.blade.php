<div class="form-group row">
    <label class="col-12 control-label">Pilih Inputan</label>
    <div class="col-12">
        <div class="custom-control custom-radio custom-control-inline my-10">
            <input class="custom-control-input input-type" type="radio" name="input_type" id="type1" value="1" checked>
            <label class="custom-control-label" for="type1">Pilih Pasien</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline my-10">
            <input class="custom-control-input input-type" type="radio" name="input_type" id="type2" value="2">
        <label class="custom-control-label" for="type2">Input <span class="swaper-sep-kartu-text">@if($jenis == '2') No SEP @else No Kartu @endif</span></label>
        </div>
    </div>
</div>