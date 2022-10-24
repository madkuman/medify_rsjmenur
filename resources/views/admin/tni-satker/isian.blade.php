<div class="row">
    <div class="col-4">
        <label>Kotama</label>
        <select class="form-control col-12 select-2"name="kotama_id[]">
            <option value=""></option>
            @foreach($kotama_list as $kotama)
            <option value="{{ $kotama->id }}"
                @if(!empty($data) && $data->kotama_id == $kotama->id)
                selected
                @endif >{{ $kotama->nama }}</option>
                @endforeach
            </select>    
        </div>
        <div class="col-4">
            <label>Nama</label>
            <div class="" style="margin-bottom: 6px !important;">
                <input type="text" class="form-control" name="nama[]">
            </div>
        </div>
        <div class="col-3">
            <label>Kode</label>
            <div class="" style="margin-bottom: 6px !important;">
                <input type="text" class="form-control" name="kode[]">
            </div>
        </div>
        <div class="col-1 text-center" style="padding-top:25px;">
            <button type="button" class="btn btn-circle btn-outline-danger mr-5 mb-5 btnRemove">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    </div>