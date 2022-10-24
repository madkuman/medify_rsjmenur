<div class="dokter-container">
    <div class="form-group dokter-radio">
        <div class="custom-control custom-radio custom-control-inline mb-5">
            
            <input class="custom-control-input" type="radio" name="dokter-jenis" id="radio-button-1-{{$id_radio}}" value="rsal"  checked>
            <label class="custom-control-label" for="radio-button-1-{{$id_radio}}">RS</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline mb-5">
            <input class="custom-control-input" type="radio" name="dokter-jenis" id="radio-button-2-{{$id_radio}}" value="luar">
            <label class="custom-control-label" for="radio-button-2-{{$id_radio}}">Dokter Luar</label>
        </div>
    </div>
    <div class="form-group dokter-luar hide">
        <label>Dokter</label>
        <input type="text" name="dokter-luar" class="dokter-luar form-control" placeholder="Nama Dokter" value="">
    </div>
    <div class="form-group dokter-rsal">
        <label>Dokter</label>
        <select class="js-select2 form-control" name="dokter-rsal" style="width: 100%;">
            <option value="" selected="" disabled>Pilih dokter</option>
            @foreach($dokter as $d)
            <option value="{{$d->id}}" >{{$d->name}}</option>
            @endforeach
        </select>
    </div>
</div>