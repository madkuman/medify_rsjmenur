<div class="modal fade" id="edit-pendidikan{{$pend->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-popout modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-transparent mb-0">
                <div class="block-content row py-20">
                    <h4 class="col-md-3 mb-0">
                        Edit Pendidikan
                    </h4>
                    <form method="POST" class="col-md-12" action="{{route('edit.pendidikan')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="pend_id" value="{{$pend->id}}">
                        <h6 class="font-size-s font-w400 mt-5">Ubah atau hapus informasi pendidikan yang telah ada</h5>
                        <hr style="border-top: 2px solid #0b72c6">
                        <div class="text-center my-15">
                            <div class="form-group row">
                                <input type="text" class="col-md-4 form-control ml-15" name="institution" value="{{$pend->institusi}}" placeholder="Tempat Pendidikan" required>
                                <input type="text" class="col-md-3 form-control ml-5" name="faculty" value="{{$pend->departemen}}" placeholder="Jurusan, Fakultas" required>
                                <input type="number" class="col-md-2 form-control ml-5" name="year_start" value="{{$pend->tahun_masuk}}" placeholder="Tahun Mulai" required>
                                <input type="number" class="col-md-2 form-control ml-5" name="year_finish" value="{{$pend->tahun_tamat}}" placeholder="Tahun Selesai" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete-pendidikan{{$pend->id}}" data-dismiss="modal">
                            <i class="fa fa-trash"></i> Hapus Entry
                        </button>
                        <button type="submit" name="submit" class="btn btn-xs btn-primary float-right">
                            Simpan
                        </button>
                        <button type="button" id="submitgroup" class="btn btn-xs btn-default float-right mr-5" data-dismiss="modal" aria-label="Close">
                            Batal
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>