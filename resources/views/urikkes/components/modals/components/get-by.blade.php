
<div class="form-group">
    <div class="custom-control custom-radio custom-control-inline mb-5">
        <input class="custom-control-input get-by" type="radio" name="get_by" value="nrp" id="{{$modal_tipe}}-get_by1" data-field="{{$modal_tipe}}-nrp_form">
        <label class="custom-control-label" for="{{$modal_tipe}}-get_by1">NRP</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline mb-5">
        <input class="custom-control-input get-by" type="radio" name="get_by" value="satker" id="{{$modal_tipe}}-get_by2" data-field="{{$modal_tipe}}-satker_form">
        <label class="custom-control-label" for="{{$modal_tipe}}-get_by2">Satker </label>
    </div>
    <div class="custom-control custom-radio custom-control-inline mb-5">
        <input class="custom-control-input get-by" type="radio" name="get_by" value="satker-pilihan" id="{{$modal_tipe}}-get_by3" data-field="{{$modal_tipe}}-no_form">
        <label class="custom-control-label" for="{{$modal_tipe}}-get_by3">Satker Pilihan (Auto)</label>
    </div>
</div>
<fieldset id="{{$modal_tipe}}-no_form">

</fieldset>
<fieldset id="{{$modal_tipe}}-nrp_form" class="nrp_form" style="display: none;">
    <label>Request Per NRP (Dipisahkan dengan Tab)</label>
    <div class="form-group">
        <input type="text" name="nrp" class="js-tags-input form-control form-control-lg nrp" placeholder="Masukkan satu atau lebih NRP dipisahkan dengan tab" required="">
    </div>
</fieldset>
<fieldset id="{{$modal_tipe}}-satker_form" class="satker_form" style="display: none;">
    <label for="tanggal_min col">Kesatuan</label>
    <div class="form-group row">
        <div class="col-6">
            <select type="text" class=" form-control js-select2 custom-select kesatuan-select" id="kesatuan" name="kesatuan" required="" data-satker="{{$modal_tipe}}">
                <option></option>
                @foreach($kesatuan as $item)
                <option value="{{$item->id}}">{{$item->nama}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <label for="tanggal_min col">Satker  <i id="{{$modal_tipe}}-satker-loading" class="fa fa-asterisk fa-spin text-info satker-loading"></i> </label>
    <div class="form-group row">
        <div class="col-6">
            <select type="text" class="form-control js-select2 custom-select satker-select" id="{{$modal_tipe}}-satker" name="satker" required="">
                <option></option>
            </select>
        </div>
    </div>
</fieldset>