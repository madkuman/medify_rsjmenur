<div class="dokter-container">
    <div class="form-group dokter-radio">
        <div class="custom-control custom-radio custom-control-inline mb-5">
                
                @if(!empty($transaksi->dokter_id && $transaksi->dokter_id != 0 )) @php $show_rsal = 1 @endphp
                @else @php $show_rsal = 0 @endphp
                @endif
            
            <input class="custom-control-input" type="radio" name="dokter-jenis" id="radio-button-1-{{$id_radio}}" value="rsal" @if($show_rsal) checked @endif>
            <label class="custom-control-label" for="radio-button-1-{{$id_radio}}">RS</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline mb-5">
            <input class="custom-control-input" type="radio" name="dokter-jenis" id="radio-button-2-{{$id_radio}}" value="luar" @if(!$show_rsal) checked @endif>
            <label class="custom-control-label" for="radio-button-2-{{$id_radio}}">Dokter Luar</label>
        </div>
    </div>
    <div class="form-group dokter-luar @if($show_rsal) hide @endif">
        <label>Dokter</label>
        <input type="text" name="dokter-luar" class="dokter-luar form-control" placeholder="Nama Dokter" value="{{$transaksi->dokter_nama}}">
    </div>
    <div class="form-group dokter-rsal @if(!$show_rsal) hide @endif">
        <label>Dokter</label>
        <select class="js-select2 form-control" name="dokter-rsal" style="width: 100%;">
            <option value="" selected="" disabled>Pilih dokter</option>
            @foreach($dokter as $key => $d)
            <option value="{{$d->id}}" @if(!empty($transaksi->dokter)) @if($d->id == $transaksi->dokter->id) selected @endif @else @if($key == 0) selected @endif @endif>{{$d->name}}</option>
            @endforeach
        </select>
    </div>
</div>