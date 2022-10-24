<div class="row justify-content-center item-row item-wrapper">
    <div class="col-3">
        <div class="form-group text-left">
            <select class="js-select2 form-control" id="tarif-telekonsultasi-{{$index}}" name="tarif_telekonsultasi_id[]" style="width: 100%;"required>
                <option value="" selected disabled>Pilih</option>
                @foreach($tarif_telekonsultasi as $item)
                    <option value="{{$item->id}}" @if(isset($row->tarif_id) && !empty($row->tarif_id) && $row->tarif_id== $item->id) selected @endif>{{$item->master->deskripsi ?? 'Tarif Unknown'}} -
                        @if($item->kelas_id == 0) Semua Kelas
                        @else {{$item->kelas->nama ?? 'Kelas Unknown'}}
                        @endif
                        - {{number_format($item->harga,0)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group text-left">
            <input type="number" class="form-control form-control-lg" id="durasi-{{$index}}" placeholder="Durasi (detik)" name="durasi[]" @if(isset($row->durasi) && !empty($row->durasi)) value="{{$row->durasi}}" @endif  required>
        </div>
    </div>
    <div class="col-1">
        <button type="button" class="btn btn-sm btn-outline-danger mr-5 btnRemove">
            <i class="fa fa-trash"></i>
        </button>
    </div>
</div>