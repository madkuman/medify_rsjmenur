<div class="modal fade" id="modal-shift" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{url('farmasi/'.session('farmasi')->slug)}}/edit-shift">
                {{csrf_field()}}
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header">
                    <h3 class="block-title">Pengaturan Shift</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-12">
                            @if(count(session('aturan_shift')))
                                <div class="form-group row mx-0">
                                    <label class="col-12 pl-0">Ganti Shift</label>
                                    <select class="js-select2 form-control" name="shift" style="width: 100%">
                                        @foreach(session('aturan_shift') as $s)
                                            <option value="{{$s->id}}" @if(session('farmasi')->current_shift_id == $s->id) selected @endif>{{$s->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <h6>Aturan Shift masih kosong, silahkan buat terlebih dahulu</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-square" data-dismiss="modal">Batalkan</button>
                <button type="submit" class="btn btn-primary btn-square" id="saveBtn" @if(!count(session('aturan_shift'))) disabled="" @endif>
                    <i class="fa fa-save"></i> Konfirmasi
                </button>
            </div>
        </form>
        </div>
    </div>
</div>